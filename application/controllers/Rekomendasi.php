<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekomendasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SAW_model');
        $this->load->model('Paket_model');
        $this->load->model('Destinasi_model');
    }

    public function index()
    {
        $data['title'] = 'Rekomendasi Paket Wisata - Hastaka Holiday';
        $data['kriteria'] = $this->SAW_model->get_kriteria_for_form();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('rekomendasi', $data);
        $this->load->view('templates/footer');
    }

    public function hasil()
    {
        $data['title'] = 'Hasil Rekomendasi - Hastaka Holiday';

        // Ambil bobot dari form
        $bobot = [
            'C1' => $this->input->get_post('bobot_C1') ?: 1,
            'C2' => $this->input->get_post('bobot_C2') ?: 1,
            'C3' => $this->input->get_post('bobot_C3') ?: 1,
            'C4' => $this->input->get_post('bobot_C4') ?: 1,
        ];

        // Simpan bobot ke session untuk halaman perhitungan
        $this->session->set_userdata('bobot_rekomendasi', $bobot);

        // Ambil filter
        $filter = [];

        // LOG 1: Log bobot yang akan dikirim ke model
        log_message('debug', '=== CONTROLLER: Bobot sebelum kirim ke model ===');
        log_message('debug', 'Input dari form: ' . json_encode($bobot));

        $data['bobot'] = $bobot;
        $data['filter'] = $filter;
        $data['filter_kategori'] = null;
        $data['kriteria'] = $this->SAW_model->get_kriteria_for_form();
        $data['hasil'] = $this->SAW_model->hitung_saw($bobot, $filter);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('hasil_rekomendasi', $data);
        $this->load->view('templates/footer');
    }

    public function perhitungan($id_paket = null)
    {
        // Cek apakah ada bobot di session
        $bobot = $this->session->userdata('bobot_rekomendasi');
        if (empty($bobot)) {
            $this->session->set_flashdata('error', 'Silakan masukkan preferensi terlebih dahulu');
            redirect('rekomendasi');
        }

        $data['title'] = 'Detail Perhitungan SAW - Hastaka Holiday';

        // Ambil data paket yang sedang dilihat
        $data['paket'] = $this->db->get_where('paket_wisata', ['id_paket' => $id_paket])->row();
        
        if (!$data['paket']) {
            show_404();
        }

        // Ambil semua kriteria
        $data['kriteria'] = $this->SAW_model->get_kriteria_for_form();

        // Ambil bobot dari session
        $data['bobot_input'] = $bobot;

        // Hitung total bobot input
        $total_bobot_input = array_sum($bobot);

        // Normalisasi bobot (Wj)
        $data['bobot_normalisasi'] = [];
        foreach ($bobot as $kode => $nilai) {
            $data['bobot_normalisasi'][$kode] = $total_bobot_input > 0 ? round($nilai / $total_bobot_input, 4) : 0;
        }

        // Ambil matriks keputusan (Xij)
        $data['matriks_keputusan'] = $this->SAW_model->get_matriks_keputusan();

        // Ambil max/min per kriteria
        $max_min = $this->SAW_model->get_max_min_per_kriteria();
        $data['max_min'] = [];
        foreach ($max_min as $mm) {
            $data['max_min'][$mm->kode_kriteria] = [
                'max' => $mm->max_val,
                'min' => $mm->min_val,
                'sifat' => $mm->sifat
            ];
        }

        // Hitung normalisasi matriks (rij) untuk semua paket
        $data['matriks_normalisasi'] = [];
        foreach ($data['matriks_keputusan'] as $nilai) {
            $id_paket_loop = $nilai->id_paket;
            $kode_kr = $nilai->kode_kriteria;
            $nilai_xij = $nilai->nilai;
            
            if (!isset($data['matriks_normalisasi'][$id_paket_loop])) {
                $data['matriks_normalisasi'][$id_paket_loop] = [
                    'nama_paket' => $nilai->nama_paket,
                    'nilai' => []
                ];
            }

            if (isset($data['max_min'][$kode_kr])) {
                $mm = $data['max_min'][$kode_kr];
                $r = $this->SAW_model->normalisasi($nilai_xij, $mm['max'], $mm['min'], $mm['sifat']);
                $data['matriks_normalisasi'][$id_paket_loop]['nilai'][$kode_kr] = [
                    'nilai_asli' => $nilai_xij,
                    'normalisasi' => round($r, 4),
                    'sifat' => $mm['sifat'],
                    'max' => $mm['max'],
                    'min' => $mm['min']
                ];
            }
        }

        // Hitung nilai V untuk semua paket
        $data['nilai_v_semua'] = [];
        foreach ($data['matriks_normalisasi'] as $id_paket_loop => $data_paket) {
            $nilai_v = 0;
            $detail_perhitungan = [];
            
            foreach ($data['kriteria'] as $kr) {
                if (isset($data_paket['nilai'][$kr->kode_kriteria])) {
                    $r = $data_paket['nilai'][$kr->kode_kriteria]['normalisasi'];
                    $w = isset($data['bobot_normalisasi'][$kr->kode_kriteria]) ? $data['bobot_normalisasi'][$kr->kode_kriteria] : 0;
                    $kontribusi = $r * $w;
                    $nilai_v += $kontribusi;
                    
                    $detail_perhitungan[] = [
                        'kode' => $kr->kode_kriteria,
                        'nama' => $kr->nama_kriteria,
                        'rij' => $r,
                        'wj' => $w,
                        'kontribusi' => $kontribusi
                    ];
                }
            }
            
            $data['nilai_v_semua'][$id_paket_loop] = [
                'nama_paket' => $data_paket['nama_paket'],
                'nilai_v' => round($nilai_v, 4),
                'detail' => $detail_perhitungan
            ];
        }

        // Sorting by nilai V
        usort($data['nilai_v_semua'], function($a, $b) {
            return $b['nilai_v'] <=> $a['nilai_v'];
        });

        // Cari ranking paket yang sedang dilihat
        $data['ranking_paket'] = 0;
        foreach ($data['nilai_v_semua'] as $index => $item) {
            if ($item['nama_paket'] == $data['paket']->nama_paket) {
                $data['ranking_paket'] = $index + 1;
                break;
            }
        }

        // Generate penjelasan dinamis
        $data['penjelasan'] = $this->generate_penjelasan($data['paket']->nama_paket, $data['bobot_normalisasi'], $data['matriks_normalisasi'][$id_paket]['nilai']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('rekomendasi/perhitungan', $data);
        $this->load->view('templates/footer');
    }

    private function generate_penjelasan($nama_paket, $bobot_normalisasi, $nilai_normalisasi_paket)
    {
        // Cari kriteria dengan bobot tertinggi
        arsort($bobot_normalisasi);
        $kriteria_terpenting = key($bobot_normalisasi);
        $bobot_tertinggi = current($bobot_normalisasi);

        // Cari nilai rij untuk kriteria tersebut
        $nilai_rij = isset($nilai_normalisasi_paket[$kriteria_terpenting]) ? $nilai_normalisasi_paket[$kriteria_terpenting]['normalisasi'] : 0;

        // Tentukan apakah nilai baik atau terbaik
        $status_nilai = 'baik';
        if ($nilai_rij == 1.0) {
            $status_nilai = 'terbaik';
        } elseif ($nilai_rij >= 0.8) {
            $status_nilai = 'sangat baik';
        } elseif ($nilai_rij >= 0.6) {
            $status_nilai = 'cukup baik';
        }

        $penjelasan = "{$nama_paket} mendapat peringkat karena kamu memberikan bobot tinggi pada kriteria dengan bobot tertinggi dan nilainya {$status_nilai} di kriteria tersebut.";

        return $penjelasan;
    }
}
