<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Paket_model');
        $this->load->model('Transaksi_model');
    }

    public function index()
    {
        // Cek pemesanan berdasarkan kode booking (untuk publik)
        $kode = $this->input->get('kode');
        $data['title'] = 'Cek Pesanan - Hastaka Holiday';
        $data['pemesanan'] = null;
        $data['kode'] = $kode;

        if ($kode) {
            $data['pemesanan'] = $this->Transaksi_model->get_pemesanan_by_kode($kode);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('pemesanan', $data);
        $this->load->view('templates/footer');
    }

    public function booking($id_paket)
    {
        // Wajib login
        if (!$this->session->userdata('id_user')) {
            $this->session->set_userdata('redirect_after_login', current_url());
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu untuk melakukan pemesanan.');
            redirect('auth/login');
        }

        // Admin tidak boleh memesan paket
        if ($this->session->userdata('role') == 'admin') {
            $this->session->set_flashdata('error', 'Admin tidak dapat melakukan pemesanan paket.');
            redirect('admin/dashboard');
        }

        $data['title'] = 'Booking Paket - Hastaka Holiday';
        $data['paket'] = $this->Paket_model->get_paket_by_id($id_paket);

        if (!$data['paket']) {
            $this->session->set_flashdata('error', 'Paket tidak ditemukan!');
            redirect('paket');
        }

        $this->form_validation->set_rules('tgl_keberangkatan', 'Tanggal Keberangkatan', 'required');
        $this->form_validation->set_rules('jam_keberangkatan', 'Jam Keberangkatan', 'required');
        $this->form_validation->set_rules('jumlah_peserta', 'Jumlah Peserta', 'required|numeric');
        $this->form_validation->set_rules('nama_pemesan', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('no_telepon', 'No. Telepon', 'required|trim');
        $this->form_validation->set_rules('titik_kumpul', 'Titik Kumpul', 'required|trim');
        $this->form_validation->set_rules('catatan', 'Catatan', 'trim');
        $this->form_validation->set_rules('tipe_pembayaran', 'Tipe Pembayaran', 'required|in_list[full,dp]');

        // Custom validation: min peserta
        $min_peserta = $data['paket']->min_peserta ?? 1;
        $this->form_validation->set_rules('jumlah_peserta', 'Jumlah Peserta', "required|numeric|callback__check_min_peserta[$min_peserta]");

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('booking_form', $data);
            $this->load->view('templates/footer');
        } else {
            $jumlah = $this->input->post('jumlah_peserta', TRUE);
            $total = $data['paket']->harga * $jumlah;
            $tipe_pembayaran = $this->input->post('tipe_pembayaran', TRUE);
            $jumlah_dp = 0;
            $total_bayar = $total;

            if ($tipe_pembayaran == 'dp') {
                $jumlah_dp = (int) ceil($total * 0.2);
                $total_bayar = $jumlah_dp;
            }

            // Upload bukti transfer
            $bukti_transfer = '';
            if (!empty($_FILES['bukti_transfer']['name'])) {
                $upload = $this->_upload_bukti();
                if ($upload['status']) {
                    $bukti_transfer = $upload['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'Upload bukti transfer gagal: ' . $upload['error']);
                    redirect('pemesanan/booking/' . $id_paket);
                }
            }

            $pemesanan_data = [
                'id_user' => $this->session->userdata('id_user'),
                'id_paket' => $id_paket,
                'tgl_keberangkatan' => $this->input->post('tgl_keberangkatan', TRUE),
                'jam_keberangkatan' => $this->input->post('jam_keberangkatan', TRUE),
                'jumlah_peserta' => $jumlah,
                'nama_pemesan' => $this->input->post('nama_pemesan', TRUE),
                'no_telepon' => $this->input->post('no_telepon', TRUE),
                'titik_kumpul' => $this->input->post('titik_kumpul', TRUE),
                'total_bayar' => $total_bayar,
                'catatan' => $this->input->post('catatan', TRUE),
                'status_pemesanan' => 'pending',
                'bukti_transfer' => $bukti_transfer,
                'tipe_pembayaran' => $tipe_pembayaran,
                'jumlah_dp' => $jumlah_dp
            ];

            $id_pemesanan = $this->Transaksi_model->buat_pemesanan($pemesanan_data);
            redirect('pemesanan/invoice/' . $id_pemesanan);
        }
    }

    public function invoice($id)
    {
        // Wajib login
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('auth/login');
        }

        $data['title'] = 'Invoice - Hastaka Holiday';
        $data['pemesanan'] = $this->Transaksi_model->get_pemesanan_by_id($id);

        if (!$data['pemesanan']) {
            $this->session->set_flashdata('error', 'Invoice tidak ditemukan!');
            redirect('home');
        }

        // Pastikan hanya pemilik yang bisa lihat
        if ($data['pemesanan']->id_user != $this->session->userdata('id_user') && $this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak!');
            redirect('home');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('invoice', $data);
        $this->load->view('templates/footer');
    }

    public function riwayat()
    {
        // Wajib login
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('auth/login');
        }

        $data['title'] = 'Riwayat Pemesanan - Hastaka Holiday';
        $data['pemesanan'] = $this->Transaksi_model->get_pemesanan_by_user($this->session->userdata('id_user'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('riwayat', $data);
        $this->load->view('templates/footer');
    }

    // Callback: check minimum peserta
    public function _check_min_peserta($value, $min)
    {
        if ((int) $value < (int) $min) {
            $this->form_validation->set_message('_check_min_peserta', "Jumlah Peserta minimal {$min} orang untuk paket ini.");
            return FALSE;
        }
        return TRUE;
    }

    // Helper: Upload Bukti Transfer
    private function _upload_bukti()
    {
        $upload_path = FCPATH . 'application/assets/images/bukti/';

        if (!is_dir($upload_path)) {
            @mkdir($upload_path, 0755, TRUE);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = 'bukti_' . time() . '_' . rand(100, 999);
        $config['overwrite']     = FALSE;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload('bukti_transfer')) {
            return ['status' => TRUE, 'file_name' => $this->upload->data('file_name')];
        } else {
            return ['status' => FALSE, 'error' => $this->upload->display_errors('', '')];
        }
    }
}
