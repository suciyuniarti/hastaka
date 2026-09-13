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

        // ============================================
        // REFACTOR: Gunakan hitung_saw() sebagai SUMBER PERHITUNGAN TUNGGAL
        // Ini memastikan nilai V dan ranking konsisten dengan halaman Hasil Rekomendasi
        // ============================================
        
        // Hitung total bobot input untuk normalisasi bobot
        $total_bobot_input = array_sum($bobot);

        // Normalisasi bobot (Wj) - konsisten dengan cara perhitungan di model
        $data['bobot_normalisasi'] = [];
        foreach ($bobot as $kode => $nilai) {
            $data['bobot_normalisasi'][$kode] = $total_bobot_input > 0 ? round($nilai / $total_bobot_input, 4) : 0;
        }

        // Panggil hitung_saw() SATU KALI untuk mendapatkan seluruh hasil perhitungan
        // Hasil ini sudah terurut berdasarkan nilai V (ranking) dan mengandung detail normalisasi
        $hasil_saw = $this->SAW_model->hitung_saw($bobot, []);

        // Ambil matriks keputusan untuk ditampilkan di view
        $data['matriks_keputusan'] = $this->SAW_model->get_matriks_keputusan();

        // Ambil max/min per kriteria untuk ditampilkan di view
        $max_min = $this->SAW_model->get_max_min_per_kriteria();
        $data['max_min'] = [];
        foreach ($max_min as $mm) {
            $data['max_min'][$mm->kode_kriteria] = [
                'max' => $mm->max_val,
                'min' => $mm->min_val,
                'sifat' => $mm->sifat
            ];
        }

        // ============================================
        // Bangun matriks_normalisasi dari hasil hitung_saw()
        // Format disesuaikan dengan yang diharapkan view
        // ============================================
        $data['matriks_normalisasi'] = [];
        foreach ($hasil_saw as $item) {
            $id_paket_hasil = $item['id_paket'];
            $data['matriks_normalisasi'][$id_paket_hasil] = [
                'nama_paket' => $item['nama_paket'],
                'nilai' => []
            ];
            
            // Ambil detail normalisasi per kriteria dari hasil hitung_saw()
            foreach ($item['detail'] as $detail) {
                $kode_kr = $detail['kode'];
                $data['matriks_normalisasi'][$id_paket_hasil]['nilai'][$kode_kr] = [
                    'nilai_asli' => $detail['nilai_asli'],
                    'normalisasi' => $detail['normalisasi'],
                    'sifat' => $detail['sifat'],
                    'max' => isset($data['max_min'][$kode_kr]) ? $data['max_min'][$kode_kr]['max'] : null,
                    'min' => isset($data['max_min'][$kode_kr]) ? $data['max_min'][$kode_kr]['min'] : null
                ];
            }
        }

        // ============================================
        // Bangun nilai_v_semua dari hasil hitung_saw()
        // Format disesuaikan dengan yang diharapkan view
        // ============================================
        $data['nilai_v_semua'] = [];
        foreach ($hasil_saw as $index => $item) {
            $detail_perhitungan = [];
            
            // Reconstruct detail perhitungan untuk view
            foreach ($item['detail'] as $detail) {
                $kode_kr = $detail['kode'];
                $w = isset($data['bobot_normalisasi'][$kode_kr]) ? $data['bobot_normalisasi'][$kode_kr] : 0;
                $r = $detail['normalisasi'];
                $kontribusi = $r * $w;
                
                $detail_perhitungan[] = [
                    'kode' => $detail['kode'],
                    'nama' => $detail['nama'],
                    'rij' => $r,
                    'wj' => $w,
                    'kontribusi' => $kontribusi
                ];
            }
            
            $data['nilai_v_semua'][] = [
                'nama_paket' => $item['nama_paket'],
                'nilai_v' => $item['nilai_v'],
                'detail' => $detail_perhitungan
            ];
        }

        // ============================================
        // Cari ranking paket yang sedang dilihat menggunakan id_paket
        // (bukan nama_paket) untuk konsistensi
        // ============================================
        $data['ranking_paket'] = 0;
        foreach ($hasil_saw as $index => $item) {
            if ($item['id_paket'] == $id_paket) {
                $data['ranking_paket'] = $index + 1; // Ranking dimulai dari 1
                break;
            }
        }

        // ============================================
        // Generate penjelasan dinamis menggunakan data dari hitung_saw()
        // ============================================
        // Cari detail normalisasi untuk paket yang sedang dilihat
        $nilai_normalisasi_paket = [];
        if (isset($data['matriks_normalisasi'][$id_paket]['nilai'])) {
            $nilai_normalisasi_paket = $data['matriks_normalisasi'][$id_paket]['nilai'];
        }
        
        $data['penjelasan'] = $this->generate_penjelasan(
            $data['paket']->nama_paket, 
            $data['bobot_normalisasi'], 
            $nilai_normalisasi_paket
        );

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
