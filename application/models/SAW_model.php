<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SAW_model extends CI_Model {

    /**
     * Mengambil seluruh matriks keputusan (X) dari database
     * Dikelompokkan per id_paket
     * Optional filter: by kategori and/or kota
     */
    public function get_matriks_keputusan($filter = [])
    {
        $this->db->select('nilai_alternatif.*, paket_wisata.nama_paket, paket_wisata.harga, paket_wisata.foto, paket_wisata.jumlah_destinasi, kriteria.kode_kriteria, kriteria.sifat');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = nilai_alternatif.id_paket');
        $this->db->join('kriteria', 'kriteria.id_kriteria = nilai_alternatif.id_kriteria');
        $this->db->where('paket_wisata.status', 'tersedia');
        $this->db->order_by('nilai_alternatif.id_paket', 'ASC');
        return $this->db->get('nilai_alternatif')->result();
    }

    /**
     * Tahap B: Menentukan Max dan Min per kriteria
     */
    public function get_max_min_per_kriteria($filter = [])
    {
        $this->db->select('nilai_alternatif.id_kriteria, kriteria.kode_kriteria, kriteria.sifat, MAX(nilai_alternatif.nilai) as max_val, MIN(nilai_alternatif.nilai) as min_val');
        $this->db->join('kriteria', 'kriteria.id_kriteria = nilai_alternatif.id_kriteria');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = nilai_alternatif.id_paket');
        $this->db->where('paket_wisata.status', 'tersedia');

        if (!empty($filter['kota'])) {
            $this->db->where('paket_wisata.id_paket IN (SELECT DISTINCT pd.id_paket FROM paket_destinasi pd JOIN destinasi d ON d.id_destinasi = pd.id_destinasi WHERE d.kota = ' . $this->db->escape($filter['kota']) . ')', NULL, FALSE);
        }

        $this->db->group_by('nilai_alternatif.id_kriteria, kriteria.kode_kriteria');
        return $this->db->get('nilai_alternatif')->result();
    }

    /**
     * Tahap C: Normalisasi Matriks (R)
     * Benefit: R = Nilai / Max
     * Cost:    R = Min / Nilai
     */
    public function normalisasi($nilai, $max, $min, $sifat)
    {
        if ($sifat == 'benefit') {
            return ($max > 0) ? $nilai / $max : 0;
        } else {
            if ((float) $nilai == 0.0) {
                return 1;
            }
            return ($nilai > 0) ? $min / $nilai : 0;
        }
    }

    /**
     * Tahap D & E: Hitung Nilai V dan Ranking
     * V[i] = sum(R[i][j] * W[j])
     * Optional filter: ['kategori' => id, 'kota' => nama_kota]
     */
    public function hitung_saw($bobot = [], $filter = [])
    {
        // Ambil daftar kriteria dari database SEKALI saja
        $kriteria_list = $this->db->order_by('id_kriteria', 'ASC')->get('kriteria')->result();

        // Bangun default_bobot dari database (fallback jika pelanggan tidak input preferensi)
        $default_bobot = [];
        foreach ($kriteria_list as $kr) {
            $default_bobot[$kr->kode_kriteria] = (float) $kr->bobot;
        }

        // Default bobot jika kosong (gunakan bobot dari database)
        if (empty($bobot)) {
            $bobot = $default_bobot;
        }

        // FIX: urutan validasi key dipindah sebelum normalisasi bobot
        // - Bentuk whitelist dari kode_kriteria pada tabel kriteria
        // - Buat $bobot_valid hanya berisi key yang ada di whitelist
        // - Abaikan key lain pada $bobot asli (mis. C5) supaya tidak memengaruhi total_bobot
        $kode_kriteria_whitelist = [];
        foreach ($kriteria_list as $kr) {
            $kode_kriteria_whitelist[$kr->kode_kriteria] = true;
        }

        $bobot_valid = [];
        foreach ($kode_kriteria_whitelist as $kode => $_) {
            $bobot_valid[$kode] = isset($bobot[$kode]) ? (float) $bobot[$kode] : 0;
        }

        // FIX: Guard jika total bobot 
        $total_bobot = array_sum($bobot_valid);
        if ($total_bobot <= 0) {
            $bobot_valid = $default_bobot;
            $total_bobot = array_sum($bobot_valid);
        }

        // Normalisasi bobot
        if ($total_bobot > 0) {
            foreach ($bobot_valid as $k => $v) {
                $bobot_valid[$k] = $v / $total_bobot;
            }
        }

        $bobot = $bobot_valid;

        // Ambil data matriks keputusan (dengan filter)
        $data_nilai = $this->get_matriks_keputusan($filter);

        // Ambil max/min per kriteria (dengan filter)
        $max_min = $this->get_max_min_per_kriteria($filter);
        $max_min_arr = [];
        foreach ($max_min as $mm) {
            $max_min_arr[$mm->kode_kriteria] = [
                'max' => $mm->max_val,
                'min' => $mm->min_val,
                'sifat' => $mm->sifat
            ];
        }

        // Kelompokkan data per paket
        $paket_data = [];
        foreach ($data_nilai as $dn) {
            $paket_data[$dn->id_paket]['nama_paket'] = $dn->nama_paket;
            $paket_data[$dn->id_paket]['harga'] = $dn->harga;
            $paket_data[$dn->id_paket]['foto'] = $dn->foto;
            $paket_data[$dn->id_paket]['jumlah_destinasi'] = $dn->jumlah_destinasi;
            $paket_data[$dn->id_paket]['id_paket'] = $dn->id_paket;
            $paket_data[$dn->id_paket]['nilai'][$dn->kode_kriteria] = $dn->nilai;
        }

        // Hitung normalisasi dan nilai V
        $hasil = [];
        foreach ($paket_data as $id_paket => $data) {
            $nilai_v = 0;
            $detail_normalisasi = [];

            foreach ($kriteria_list as $kr) {
                $nilai_xij = isset($data['nilai'][$kr->kode_kriteria]) ? $data['nilai'][$kr->kode_kriteria] : 0;

                // FIX: Guard max/min tidak ditemukan
                if (!isset($max_min_arr[$kr->kode_kriteria])) {
                    // Data kriteria tidak lengkap untuk paket/filter ini -> kontribusi = 0
                    // (skip kontribusi terhadap nilai_v)
                    continue;
                }
                $mm = $max_min_arr[$kr->kode_kriteria];

                // Normalisasi
                $r = $this->normalisasi($nilai_xij, $mm['max'], $mm['min'], $mm['sifat']);

                // Bobot untuk kriteria ini
                $w = isset($bobot[$kr->kode_kriteria]) ? $bobot[$kr->kode_kriteria] : 0;

                // Nilai V
                $kontribusi = $r * $w;
                $nilai_v += $kontribusi;

                $detail_normalisasi[] = [
                    'kode' => $kr->kode_kriteria,
                    'nama' => $kr->nama_kriteria,
                    'nilai_asli' => $nilai_xij,
                    'normalisasi' => round($r, 4),
                    'bobot' => round($w, 4),
                    'sifat' => $mm['sifat']
                ];
            }

            $hasil[] = [
                'id_paket' => $id_paket,
                'nama_paket' => $data['nama_paket'],
                'harga' => $data['harga'],
                'foto' => $data['foto'],
                'jumlah_destinasi_paket' => (int) ($data['jumlah_destinasi'] ?? 0),
                'nilai_v' => round($nilai_v, 4),
                'detail' => $detail_normalisasi
            ];
        }

        // Sorting: Nilai V terbesar ke terkecil
        usort($hasil, function($a, $b) {
            return $b['nilai_v'] <=> $a['nilai_v'];
        });

        return $hasil;
    }

    /**
     * Ambil semua kriteria untuk form bobot
     */
    public function get_kriteria_for_form()
    {
        return $this->db->order_by('id_kriteria', 'ASC')->get('kriteria')->result();
    }
}

