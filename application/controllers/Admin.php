<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Paket_model $Paket_model
 * @property User_model $User_model
 * @property Transaksi_model $Transaksi_model
 * @property SAW_model $SAW_model
 * @property Kategori_model $Kategori_model
 * @property Destinasi_model $Destinasi_model
 * @property Fasilitas_model $Fasilitas_model
 * @property Klien_model $Klien_model
 * @property Aktivitas_model $Aktivitas_model
 */
class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Proteksi admin
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
        $this->load->model('User_model');
        $this->load->model('Paket_model');
        $this->load->model('Transaksi_model');
        $this->load->model('SAW_model');
        $this->load->model('Kategori_model');
        $this->load->model('Destinasi_model');
        $this->load->model('Fasilitas_model');
        $this->load->model('Klien_model');
        $this->load->model('Aktivitas_model');
    }

    // ========== DASHBOARD ==========
    public function dashboard()
    {
        $data['title'] = 'Dashboard Admin - Hastaka Holiday';
        $data['is_admin'] = TRUE;
        $data['total_paket'] = $this->Paket_model->count_paket();
        $data['paket_tersedia'] = $this->Paket_model->count_paket_tersedia();
        $data['total_pelanggan'] = $this->User_model->count_pelanggan();
        $data['pelanggan_aktif'] = $this->User_model->count_pelanggan_aktif();
        $data['transaksi_berjalan'] = $this->Transaksi_model->count_transaksi_berjalan();
        $data['pendapatan_bulan_ini'] = $this->Transaksi_model->get_pendapatan_bulanan(date('m'), date('Y'));
        $data['pendapatan_tahun_ini'] = $this->Transaksi_model->get_pendapatan_tahunan(date('Y'));
        $data['transaksi_terbaru'] = array_slice($this->Transaksi_model->get_all_pemesanan(), 0, 5);

        // Data untuk chart: pendapatan 12 bulan terakhir
        $data['chart_bulan'] = [];
        $data['chart_pendapatan'] = [];
        for ($i = 11; $i >= 0; $i--) {
            $ts = strtotime("-$i months");
            $bln = date('m', $ts);
            $thn = date('Y', $ts);
            $data['chart_bulan'][] = date('M Y', $ts);
            $data['chart_pendapatan'][] = (int) $this->Transaksi_model->get_pendapatan_bulanan($bln, $thn);
        }

        // Data untuk chart: status transaksi
        $all_transaksi = $this->Transaksi_model->get_all_pemesanan();
        $status_count = ['pending' => 0, 'dikonfirmasi' => 0, 'selesai' => 0, 'dibatalkan' => 0];
        foreach ($all_transaksi as $t) {
            if (isset($status_count[$t->status_pemesanan])) {
                $status_count[$t->status_pemesanan]++;
            }
        }
        $data['status_count'] = $status_count;

        $data['content_view'] = 'admin/dashboard';
        $this->load->view('admin', $data);
    }

    // ========== CRUD PAKET WISATA ==========
    public function paket($page = 0)
    {
        $data['title'] = 'Kelola Paket Wisata - Admin';
        $limit = 10;
        $offset = (int) $page * $limit;
        $this->_fix_missing_foto();
        $data['paket'] = $this->Paket_model->get_all_paket();
        $data['content_view'] = 'admin/paket';
        $this->load->view('admin', $data);
    }

    // Fix foto yang tidak ada di disk
    private function _fix_missing_foto()
    {
        $upload_path = FCPATH . 'application/assets/images/paket/';
        $paket_list = $this->Paket_model->get_all_paket();

        // Kumpulkan semua file paket_* yang ada di disk
        $files = glob($upload_path . 'paket_*.{jpeg,jpg,png,gif}', GLOB_BRACE);
        if (empty($files)) return;

        rsort($files); // Urutkan dari yang terbaru
        $file_index = 0;
        $total_files = count($files);

        foreach ($paket_list as $p) {
            if (!empty($p->foto) && !file_exists($upload_path . $p->foto)) {
                // Foto tidak ada di disk, assign file yang tersedia
                if ($file_index < $total_files) {
                    $new_foto = basename($files[$file_index]);
                    $this->Paket_model->update_paket($p->id_paket, ['foto' => $new_foto]);
                    $file_index++;
                }
            }
        }
    }

    public function paket_tambah()
    {
        $this->form_validation->set_rules('nama_paket', 'Nama Paket', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('durasi_hari', 'Durasi', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Paket - Admin';
            $data['kategori_list'] = $this->Kategori_model->get_all_kategori();
            $data['destinasi_list'] = $this->Destinasi_model->get_all_destinasi();
            $data['fasilitas_list'] = $this->Fasilitas_model->get_all_fasilitas();
            $data['selected_destinasi'] = [];
            $data['selected_fasilitas'] = [];
            $data['aktivitas_list'] = $this->Aktivitas_model->get_all_aktivitas();
            $data['selected_aktivitas'] = [];
            $data['content_view'] = 'admin/paket_form';
            $this->load->view('admin', $data);
        } else {
            // Hitung jumlah destinasi dari checkbox
            $id_destinasi_arr = $this->input->post('destinasi') ?: [];
            $id_fasilitas_arr = $this->input->post('fasilitas') ?: [];
            $id_aktivitas_arr = $this->input->post('aktivitas') ?: [];

            $data = [
                'nama_paket' => $this->input->post('nama_paket', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'durasi_hari' => $this->input->post('durasi_hari', TRUE),
                'jumlah_destinasi' => count($id_destinasi_arr),
                'jumlah_aktivitas' => count($id_aktivitas_arr),
                'min_peserta' => $this->input->post('min_peserta', TRUE) ?: 1,
                'status' => $this->input->post('status', TRUE) ?: 'tersedia'
            ];

            // Upload foto
            if (!empty($_FILES['foto']['name'])) {
                $upload = $this->_upload_foto();
                if ($upload['status']) {
                    $data['foto'] = $upload['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'Upload foto gagal: ' . $upload['error']);
                    redirect('admin/paket/tambah');
                }
            }

            $id_paket = $this->Paket_model->tambah_paket($data);

            // Simpan pivot destinasi, fasilitas & aktivitas
            $this->Destinasi_model->set_destinasi_paket($id_paket, $id_destinasi_arr);
            $this->Fasilitas_model->set_fasilitas_paket($id_paket, $id_fasilitas_arr);
            $this->Aktivitas_model->set_aktivitas_paket($id_paket, $id_aktivitas_arr);

            // Update nilai alternatif SAW
            $kriteria = $this->Paket_model->get_all_kriteria();
            foreach ($kriteria as $kr) {
                $nilai_default = 0;
                if ($kr->kode_kriteria == 'C1') $nilai_default = $data['harga'];
                if ($kr->kode_kriteria == 'C2') $nilai_default = $data['durasi_hari'];
                if ($kr->kode_kriteria == 'C3') $nilai_default = count($id_destinasi_arr);
                if ($kr->kode_kriteria == 'C4') $nilai_default = count($id_aktivitas_arr);
                $this->Paket_model->update_nilai($id_paket, $kr->id_kriteria, $nilai_default);
            }

            $this->session->set_flashdata('success', 'Paket wisata berhasil ditambahkan!');
            redirect('admin/paket');
        }
    }

    public function paket_edit($id)
    {
        $data['title'] = 'Edit Paket - Admin';
        $data['paket'] = $this->Paket_model->get_paket_by_id($id);
        if (!$data['paket']) {
            $this->session->set_flashdata('error', 'Paket tidak ditemukan!');
            redirect('admin/paket');
        }

        $this->form_validation->set_rules('nama_paket', 'Nama Paket', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('durasi_hari', 'Durasi', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['kategori_list'] = $this->Kategori_model->get_all_kategori();
            $data['destinasi_list'] = $this->Destinasi_model->get_all_destinasi();
            $data['fasilitas_list'] = $this->Fasilitas_model->get_all_fasilitas();
            $data['selected_destinasi'] = array_map(function($d) { return $d->id_destinasi; }, $this->Destinasi_model->get_by_paket($id));
            $data['selected_fasilitas'] = array_map(function($f) { return $f->id_fasilitas; }, $this->Fasilitas_model->get_by_paket($id));
            $data['aktivitas_list'] = $this->Aktivitas_model->get_all_aktivitas();
            $data['selected_aktivitas'] = array_map(function($a) { return $a->id_aktivitas; }, $this->Aktivitas_model->get_by_paket($id));
            $data['content_view'] = 'admin/paket_form';
            $this->load->view('admin', $data);
        } else {
            $id_destinasi_arr = $this->input->post('destinasi') ?: [];
            $id_fasilitas_arr = $this->input->post('fasilitas') ?: [];
            $id_aktivitas_arr = $this->input->post('aktivitas') ?: [];

            $update = [
                'nama_paket' => $this->input->post('nama_paket', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'durasi_hari' => $this->input->post('durasi_hari', TRUE),
                'jumlah_destinasi' => count($id_destinasi_arr),
                'jumlah_aktivitas' => count($id_aktivitas_arr),
                'min_peserta' => $this->input->post('min_peserta', TRUE) ?: 1,
                'status' => $this->input->post('status', TRUE) ?: 'tersedia'
            ];

            if (!empty($_FILES['foto']['name'])) {
                $upload = $this->_upload_foto();
                if ($upload['status']) {
                    $update['foto'] = $upload['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'Upload foto gagal: ' . $upload['error']);
                    redirect('admin/paket/edit/' . $id);
                }
            }

            $this->Paket_model->update_paket($id, $update);

            // Update pivot destinasi, fasilitas & aktivitas
            $this->Destinasi_model->set_destinasi_paket($id, $id_destinasi_arr);
            $this->Fasilitas_model->set_fasilitas_paket($id, $id_fasilitas_arr);
            $this->Aktivitas_model->set_aktivitas_paket($id, $id_aktivitas_arr);

            // Update nilai alternatif SAW
            $kriteria = $this->Paket_model->get_all_kriteria();
            foreach ($kriteria as $kr) {
                $nilai = 0;
                if ($kr->kode_kriteria == 'C1') $nilai = $update['harga'];
                if ($kr->kode_kriteria == 'C2') $nilai = $update['durasi_hari'];
                if ($kr->kode_kriteria == 'C3') $nilai = count($id_destinasi_arr);
                if ($kr->kode_kriteria == 'C4') $nilai = count($id_aktivitas_arr);
                $this->Paket_model->update_nilai($id, $kr->id_kriteria, $nilai);
            }

            $this->session->set_flashdata('success', 'Paket wisata berhasil diupdate!');
            redirect('admin/paket');
        }
    }

    public function paket_hapus($id)
    {
        $this->Paket_model->hapus_paket($id);
        $this->session->set_flashdata('success', 'Paket wisata berhasil dihapus!');
        redirect('admin/paket');
    }

    // ========== NILAI ALTERNATIF ==========
    public function nilai($id_paket)
    {
        $data['title'] = 'Nilai Alternatif - Admin';
        $data['paket'] = $this->Paket_model->get_paket_by_id($id_paket);
        $data['kriteria'] = $this->Paket_model->get_all_kriteria();
        $data['nilai'] = $this->Paket_model->get_nilai_by_paket($id_paket);

        if (!$data['paket']) {
            redirect('admin/paket');
        }

        if ($this->input->method() == 'post') {
            foreach ($data['kriteria'] as $kr) {
                $nilai = $this->input->post('nilai_' . $kr->id_kriteria, TRUE);
                if ($nilai !== null) {
                    $this->Paket_model->update_nilai($id_paket, $kr->id_kriteria, $nilai);
                }
            }
            $this->session->set_flashdata('success', 'Nilai alternatif berhasil diupdate!');
            redirect('admin/nilai/' . $id_paket);
        }

        $data['content_view'] = 'admin/nilai_form';
        $this->load->view('admin', $data);
    }

    // ========== MANAJEMEN KRITERIA ==========
    public function kriteria()
    {
        $data['title'] = 'Kelola Kriteria SAW - Admin';
        $data['kriteria'] = $this->Paket_model->get_all_kriteria();

        $data['content_view'] = 'admin/kriteria';
        $this->load->view('admin', $data);
    }

    public function kriteria_edit($id)
    {
        $data['title'] = 'Edit Kriteria - Admin';
        $data['kriteria'] = $this->Paket_model->get_kriteria_by_id($id);

        if (!$data['kriteria']) {
            $this->session->set_flashdata('error', 'Kriteria tidak ditemukan!');
            redirect('admin/kriteria');
        }

        $this->form_validation->set_rules('nama_kriteria', 'Nama Kriteria', 'required|trim');
        $this->form_validation->set_rules('bobot', 'Bobot', 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[1]');
        $this->form_validation->set_rules('sifat', 'Sifat', 'required|in_list[benefit,cost]');

        if ($this->form_validation->run() == FALSE) {
        $data['content_view'] = 'admin/kriteria_edit';
        $this->load->view('admin', $data);
    } else {
            $update = [
                'nama_kriteria' => $this->input->post('nama_kriteria', TRUE),
                'bobot' => $this->input->post('bobot', TRUE),
                'sifat' => $this->input->post('sifat', TRUE)
            ];

            $this->Paket_model->update_kriteria($id, $update);
            $this->session->set_flashdata('success', 'Kriteria berhasil diupdate!');
            redirect('admin/kriteria');
        }
    }

    // ========== MANAJEMEN USERS ==========
    public function users($page = 0)
    {
        $data['title'] = 'Kelola Pelanggan - Admin';
        $limit = 15;
        $offset = (int) $page * $limit;
        $data['users'] = $this->User_model->get_all_users();
        $data['content_view'] = 'admin/users';
        $this->load->view('admin', $data);
    }

    public function users_toggle($id)
    {
        $this->User_model->toggle_status($id);
        $this->session->set_flashdata('success', 'Status user berhasil diubah!');
        redirect('admin/users');
    }

    // ========== TRANSAKSI ==========
    public function transaksi($page = 0)
    {
        $data['title'] = 'Kelola Transaksi - Admin';
        $limit = 15;
        $offset = (int) $page * $limit;
        $data['transaksi'] = $this->Transaksi_model->get_pemesanan_paginated($limit, $offset);
        $data['total_transaksi'] = $this->Transaksi_model->count_pemesanan();
        $data['total_pages'] = (int) ceil($data['total_transaksi'] / $limit);
        $data['current_page'] = (int) $page;
        $data['content_view'] = 'admin/transaksi';
        $this->load->view('admin', $data);
    }

    public function transaksi_konfirmasi($id)
    {
        $this->Transaksi_model->update_status($id, 'dikonfirmasi');
        $this->session->set_flashdata('success', 'Transaksi berhasil dikonfirmasi!');
        redirect('admin/transaksi');
    }

    public function transaksi_batalkan($id)
    {
        $this->Transaksi_model->update_status($id, 'dibatalkan');
        $this->session->set_flashdata('success', 'Transaksi berhasil dibatalkan!');
        redirect('admin/transaksi');
    }

    // ========== LAPORAN ==========
    public function laporan()
    {
        $data['title'] = 'Laporan - Admin';
        $data['tgl_mulai'] = $this->input->get('tgl_mulai') ?: date('Y-m-01');
        $data['tgl_selesai'] = $this->input->get('tgl_selesai') ?: date('Y-m-d');
        $data['laporan'] = $this->Transaksi_model->get_laporan_periode($data['tgl_mulai'], $data['tgl_selesai']);

        $data['content_view'] = 'admin/laporan';
        $this->load->view('admin', $data);
    }

    // ========== KATEGORI PROGRAM ==========
    public function kategori($page = 0)
    {
        $data['title'] = 'Kelola Kategori Program - Admin';
        $limit = 10;
        $offset = (int) $page * $limit;
        $data['kategori'] = $this->Kategori_model->get_kategori_paginated($limit, $offset);
        $data['total_kategori'] = $this->Kategori_model->count_kategori();
        $data['total_pages'] = (int) ceil($data['total_kategori'] / $limit);
        $data['current_page'] = (int) $page;
        $data['content_view'] = 'admin/kategori';
        $this->load->view('admin', $data);
    }

    public function kategori_tambah()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim');
        $this->form_validation->set_rules('sasaran', 'Sasaran', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Kategori - Admin';
            $data['content_view'] = 'admin/kategori_form';
            $this->load->view('admin', $data);
        } else {
            $insert = [
                'nama_kategori' => $this->input->post('nama_kategori', TRUE),
                'sasaran' => $this->input->post('sasaran', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'icon' => $this->input->post('icon', TRUE) ?: 'school'
            ];
            $this->Kategori_model->tambah_kategori($insert);
            $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan!');
            redirect('admin/kategori');
        }
    }

    public function kategori_edit($id)
    {
        $data['title'] = 'Edit Kategori - Admin';
        $data['kategori'] = $this->Kategori_model->get_kategori_by_id($id);
        if (!$data['kategori']) { redirect('admin/kategori'); }

        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|trim');
        $this->form_validation->set_rules('sasaran', 'Sasaran', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['content_view'] = 'admin/kategori_form';
            $this->load->view('admin', $data);
        } else {
            $update = [
                'nama_kategori' => $this->input->post('nama_kategori', TRUE),
                'sasaran' => $this->input->post('sasaran', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'icon' => $this->input->post('icon', TRUE) ?: 'school'
            ];
            $this->Kategori_model->update_kategori($id, $update);
            $this->session->set_flashdata('success', 'Kategori berhasil diupdate!');
            redirect('admin/kategori');
        }
    }

    public function kategori_hapus($id)
    {
        $this->Kategori_model->hapus_kategori($id);
        $this->session->set_flashdata('success', 'Kategori berhasil dihapus!');
        redirect('admin/kategori');
    }

    // ========== DESTINASI ==========
    public function destinasi($page = 0, $filter_kota = null)
    {
        $data['title'] = 'Kelola Destinasi - Admin';
        $limit = 15;
        $offset = (int) $page * $limit;
        $kotafilter = $this->input->get('kota');

        if ($kotafilter) {
            // Get filtered data with pagination
            $data['destinasi'] = $this->Destinasi_model->get_destinasi_by_kota_paginated($kotafilter, $limit, $offset);
            $data['filter_kota'] = $kotafilter;
            $data['total_destinasi'] = $this->Destinasi_model->count_destinasi_by_kota($kotafilter);
            $data['total_pages'] = (int) ceil($data['total_destinasi'] / $limit);
            $data['current_page'] = (int) $page;
        } else {
            // Get all data with pagination
            $data['destinasi'] = $this->Destinasi_model->get_destinasi_paginated($limit, $offset);
            $data['filter_kota'] = null;
            $data['total_destinasi'] = $this->Destinasi_model->count_destinasi();
            $data['total_pages'] = (int) ceil($data['total_destinasi'] / $limit);
            $data['current_page'] = (int) $page;
        }
        $data['kota_list'] = $this->Destinasi_model->get_kota_list();

        $data['content_view'] = 'admin/destinasi';
        $this->load->view('admin', $data);
    }

    public function destinasi_tambah()
    {
        $this->form_validation->set_rules('nama_destinasi', 'Nama Destinasi', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Destinasi - Admin';
            $data['kota_list'] = $this->Destinasi_model->get_kota_list();
            $data['content_view'] = 'admin/destinasi_form';
            $this->load->view('admin', $data);
        } else {
            $insert = [
                'nama_destinasi' => $this->input->post('nama_destinasi', TRUE),
                'kota' => $this->input->post('kota', TRUE),
                'jenis' => 'wisata',
                'deskripsi' => $this->input->post('deskripsi', TRUE)
            ];
            $this->Destinasi_model->tambah_destinasi($insert);
            $this->session->set_flashdata('success', 'Destinasi berhasil ditambahkan!');
            redirect('admin/destinasi');
        }
    }

    public function destinasi_edit($id)
    {
        $data['title'] = 'Edit Destinasi - Admin';
        $data['destinasi'] = $this->Destinasi_model->get_destinasi_by_id($id);
        if (!$data['destinasi']) { redirect('admin/destinasi'); }
        $data['kota_list'] = $this->Destinasi_model->get_kota_list();

        $this->form_validation->set_rules('nama_destinasi', 'Nama Destinasi', 'required|trim');
        $this->form_validation->set_rules('kota', 'Kota', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['kota_list'] = $this->Destinasi_model->get_kota_list();
            $data['content_view'] = 'admin/destinasi_form';
            $this->load->view('admin', $data);
        } else {
            $update = [
                'nama_destinasi' => $this->input->post('nama_destinasi', TRUE),
                'kota' => $this->input->post('kota', TRUE),
                'jenis' => 'wisata',
                'deskripsi' => $this->input->post('deskripsi', TRUE)
            ];
            $this->Destinasi_model->update_destinasi($id, $update);
            $this->session->set_flashdata('success', 'Destinasi berhasil diupdate!');
            redirect('admin/destinasi');
        }
    }

    public function destinasi_hapus($id)
    {
        $this->Destinasi_model->hapus_destinasi($id);
        $this->session->set_flashdata('success', 'Destinasi berhasil dihapus!');
        redirect('admin/destinasi');
    }

    // ========== FASILITAS ==========
    public function fasilitas($page = 0)
    {
        $data['title'] = 'Kelola Fasilitas - Admin';
        $limit = 10;
        $offset = (int) $page * $limit;
        $data['fasilitas'] = $this->Fasilitas_model->get_fasilitas_paginated($limit, $offset);
        $data['total_fasilitas'] = $this->Fasilitas_model->count_fasilitas();
        $data['total_pages'] = (int) ceil($data['total_fasilitas'] / $limit);
        $data['current_page'] = (int) $page;
        $data['content_view'] = 'admin/fasilitas';
        $this->load->view('admin', $data);
    }

    public function fasilitas_tambah()
    {
        $this->form_validation->set_rules('nama_fasilitas', 'Nama Fasilitas', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Fasilitas - Admin';
            $data['content_view'] = 'admin/fasilitas_form';
            $this->load->view('admin', $data);
        } else {
            $insert = [
                'nama_fasilitas' => $this->input->post('nama_fasilitas', TRUE),
                'icon' => $this->input->post('icon', TRUE) ?: 'check_circle',
                'deskripsi' => $this->input->post('deskripsi', TRUE)
            ];
            $this->Fasilitas_model->tambah_fasilitas($insert);
            $this->session->set_flashdata('success', 'Fasilitas berhasil ditambahkan!');
            redirect('admin/fasilitas');
        }
    }

    public function fasilitas_edit($id)
    {
        $data['title'] = 'Edit Fasilitas - Admin';
        $data['fasilitas'] = $this->Fasilitas_model->get_fasilitas_by_id($id);
        if (!$data['fasilitas']) { redirect('admin/fasilitas'); }

        $this->form_validation->set_rules('nama_fasilitas', 'Nama Fasilitas', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['content_view'] = 'admin/fasilitas_form';
            $this->load->view('admin', $data);
        } else {
            $update = [
                'nama_fasilitas' => $this->input->post('nama_fasilitas', TRUE),
                'icon' => $this->input->post('icon', TRUE) ?: 'check_circle',
                'deskripsi' => $this->input->post('deskripsi', TRUE)
            ];
            $this->Fasilitas_model->update_fasilitas($id, $update);
            $this->session->set_flashdata('success', 'Fasilitas berhasil diupdate!');
            redirect('admin/fasilitas');
        }
    }

    public function fasilitas_hapus($id)
    {
        $this->Fasilitas_model->hapus_fasilitas($id);
        $this->session->set_flashdata('success', 'Fasilitas berhasil dihapus!');
        redirect('admin/fasilitas');
    }

    // ========== AKTIVITAS WISATA ==========
    public function aktivitas($page = 0)
    {
        $data['title'] = 'Kelola Aktivitas Wisata - Admin';
        $limit = 10;
        $offset = (int) $page * $limit;
        $data['aktivitas'] = $this->Aktivitas_model->get_aktivitas_paginated($limit, $offset);
        $data['total_aktivitas'] = $this->Aktivitas_model->count_aktivitas();
        $data['total_pages'] = (int) ceil($data['total_aktivitas'] / $limit);
        $data['current_page'] = (int) $page;
        $data['content_view'] = 'admin/aktivitas';
        $this->load->view('admin', $data);
    }

    public function aktivitas_tambah()
    {
        $this->form_validation->set_rules('nama_aktivitas', 'Nama Aktivitas', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Aktivitas - Admin';
            $data['content_view'] = 'admin/aktivitas_form';
            $this->load->view('admin', $data);
        } else {
            $insert = [
                'nama_aktivitas' => $this->input->post('nama_aktivitas', TRUE),
                'icon' => $this->input->post('icon', TRUE) ?: 'hiking',
                'deskripsi' => $this->input->post('deskripsi', TRUE)
            ];
            $this->Aktivitas_model->tambah_aktivitas($insert);
            $this->session->set_flashdata('success', 'Aktivitas berhasil ditambahkan!');
            redirect('admin/aktivitas');
        }
    }

    public function aktivitas_edit($id)
    {
        $data['title'] = 'Edit Aktivitas - Admin';
        $data['aktivitas'] = $this->Aktivitas_model->get_aktivitas_by_id($id);
        if (!$data['aktivitas']) { redirect('admin/aktivitas'); }

        $this->form_validation->set_rules('nama_aktivitas', 'Nama Aktivitas', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['content_view'] = 'admin/aktivitas_form';
            $this->load->view('admin', $data);
        } else {
            $update = [
                'nama_aktivitas' => $this->input->post('nama_aktivitas', TRUE),
                'icon' => $this->input->post('icon', TRUE) ?: 'hiking',
                'deskripsi' => $this->input->post('deskripsi', TRUE)
            ];
            $this->Aktivitas_model->update_aktivitas($id, $update);
            $this->session->set_flashdata('success', 'Aktivitas berhasil diupdate!');
            redirect('admin/aktivitas');
        }
    }

    public function aktivitas_hapus($id)
    {
        $this->Aktivitas_model->hapus_aktivitas($id);
        $this->session->set_flashdata('success', 'Aktivitas berhasil dihapus!');
        redirect('admin/aktivitas');
    }

    // ========== HELPER: Upload Foto ==========
    private function _upload_foto()
    {
        $upload_path = FCPATH . 'application/assets/images/paket/';

        // Pastikan direktori upload ada dan bisa ditulis
        if (!is_dir($upload_path)) {
            @mkdir($upload_path, 0755, TRUE);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = 'paket_' . time() . '_' . rand(100, 999);
        $config['overwrite']     = FALSE;

        // Load library sekali saja
        if (!isset($this->upload)) {
            $this->load->library('upload');
        }

        // Initialize dengan config baru — ini WAJIB karena CI3 tidak
        // menerapkan config baru jika library sudah pernah di-load
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto')) {
            return ['status' => TRUE, 'file_name' => $this->upload->data('file_name')];
        } else {
            return ['status' => FALSE, 'error' => $this->upload->display_errors('', '')];
        }
    }

    // ========== CRUD KLIEN ==========
    public function klien($page = 0)
    {
        $data['title'] = 'Kelola Klien - Admin';
        $limit = 10;
        $offset = (int) $page * $limit;
        $data['klien'] = $this->Klien_model->get_klien_paginated($limit, $offset);
        $data['total_klien'] = $this->Klien_model->count_klien();
        $data['total_pages'] = (int) ceil($data['total_klien'] / $limit);
        $data['current_page'] = (int) $page;
        $data['content_view'] = 'admin/klien';
        $this->load->view('admin', $data);
    }

    public function klien_tambah()
    {
        $this->form_validation->set_rules('nama_klien', 'Nama Klien', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|in_list[sekolah,perusahaan,instansi,komunitas]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Klien - Admin';
            $data['content_view'] = 'admin/klien_form';
            $this->load->view('admin', $data);
        } else {
            $insert = [
                'nama_klien' => $this->input->post('nama_klien', TRUE),
                'jenis' => $this->input->post('jenis', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'website' => $this->input->post('website', TRUE),
                'tanggal_kerjasama' => $this->input->post('tanggal_kerjasama', TRUE) ?: null,
            ];

            // Upload logo
            if (!empty($_FILES['logo']['name'])) {
                $upload = $this->_upload_logo_klien();
                if ($upload['status']) {
                    $insert['logo'] = $upload['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'Upload logo gagal: ' . $upload['error']);
                    redirect('admin/klien/tambah');
                }
            }

            $this->Klien_model->tambah_klien($insert);
            $this->session->set_flashdata('success', 'Klien berhasil ditambahkan!');
            redirect('admin/klien');
        }
    }

    public function klien_edit($id)
    {
        $data['title'] = 'Edit Klien - Admin';
        $data['klien'] = $this->Klien_model->get_klien_by_id($id);
        if (!$data['klien']) {
            $this->session->set_flashdata('error', 'Klien tidak ditemukan!');
            redirect('admin/klien');
        }

        $this->form_validation->set_rules('nama_klien', 'Nama Klien', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis', 'required|in_list[sekolah,perusahaan,instansi,komunitas]');

        if ($this->form_validation->run() == FALSE) {
            $data['content_view'] = 'admin/klien_form';
            $this->load->view('admin', $data);
        } else {
            $update = [
                'nama_klien' => $this->input->post('nama_klien', TRUE),
                'jenis' => $this->input->post('jenis', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'website' => $this->input->post('website', TRUE),
                'tanggal_kerjasama' => $this->input->post('tanggal_kerjasama', TRUE) ?: null,
            ];

            // Upload logo baru (opsional)
            if (!empty($_FILES['logo']['name'])) {
                $upload = $this->_upload_logo_klien();
                if ($upload['status']) {
                    $update['logo'] = $upload['file_name'];
                    // Hapus logo lama
                    if (!empty($data['klien']->logo)) {
                        $old_path = FCPATH . 'application/assets/images/klien/' . $data['klien']->logo;
                        if (file_exists($old_path)) @unlink($old_path);
                    }
                }
            }

            $this->Klien_model->update_klien($id, $update);
            $this->session->set_flashdata('success', 'Klien berhasil diupdate!');
            redirect('admin/klien');
        }
    }

    public function klien_hapus($id)
    {
        $klien = $this->Klien_model->get_klien_by_id($id);
        if ($klien) {
            // Hapus logo jika ada
            if (!empty($klien->logo)) {
                $old_path = FCPATH . 'application/assets/images/klien/' . $klien->logo;
                if (file_exists($old_path)) @unlink($old_path);
            }
            $this->Klien_model->hapus_klien($id);
            $this->session->set_flashdata('success', 'Klien berhasil dihapus!');
        }
        redirect('admin/klien');
    }

    // Helper: Upload Logo Klien
    private function _upload_logo_klien()
    {
        $upload_path = FCPATH . 'application/assets/images/klien/';

        if (!is_dir($upload_path)) {
            @mkdir($upload_path, 0755, TRUE);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 1024; // 1MB
        $config['file_name']     = 'klien_' . time() . '_' . rand(100, 999);
        $config['overwrite']     = FALSE;

        if (!isset($this->upload)) {
            $this->load->library('upload');
        }

        $this->upload->initialize($config);

        if ($this->upload->do_upload('logo')) {
            return ['status' => TRUE, 'file_name' => $this->upload->data('file_name')];
        } else {
            return ['status' => FALSE, 'error' => $this->upload->display_errors('', '')];
        }
    }
}