<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Paket_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Kategori_model');
        $this->load->model('Partner_model');
    }

    public function index()
    {
        $data['title'] = 'Hastaka Holiday - Rekomendasi Paket Wisata';
        $data['paket_terbaru'] = $this->Paket_model->get_paket_terbaru(3);
        
        // Data referensi bus statis dari assets/images/bus/
        $data['bus_partner'] = [
            ['nama' => 'TAM Jetbus 5+ MHD Mercy', 'gambar' => 'bus1.jpg'],
            ['nama' => 'Pandawa 87 Mercy', 'gambar' => 'bus2.jpg'],
            ['nama' => 'Gagak Rimang Mercy', 'gambar' => 'bus3.jpg'],
            ['nama' => 'Jackal Holiday Mercy', 'gambar' => 'bus4.jpg'],
        ];

        // Data referensi hotel statis dari assets/images/hotel/
        $data['hotel_partner'] = [
            ['nama' => 'BURZA HOTEL YOGYA ', 'gambar' => 'hotel1.jpg'],
            ['nama' => 'FAVE HOTEL SEMARANG', 'gambar' => 'hotel2.jpg'],
            ['nama' => 'GRAND PACIFIC BANDUNG', 'gambar' => 'hotel3.jpg'],
        ];

        // Data pelanggan yang login (untuk dashboard pelanggan)
        $data['user_logged_in'] = $this->session->userdata('id_user');
        $data['user_role'] = $this->session->userdata('role');

        if ($this->session->userdata('id_user') && $this->session->userdata('role') == 'pelanggan') {
            $id_user = $this->session->userdata('id_user');
            $pemesanan_user = $this->Transaksi_model->get_pemesanan_by_user($id_user);
            $data['total_booking'] = count($pemesanan_user);

            $total_spent = 0;
            $booking_aktif = 0;
            foreach ($pemesanan_user as $p) {
                if (in_array($p->status_pemesanan, ['pending', 'dikonfirmasi'])) {
                    $booking_aktif++;
                }
                if ($p->status_pemesanan == 'dikonfirmasi') {
                    $total_spent += $p->total_bayar;
                }
            }
            $data['booking_aktif'] = $booking_aktif;
            $data['total_spent'] = $total_spent;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('home', $data);
        $this->load->view('templates/footer');
    }

    public function clients()
    {
        $data['title'] = 'Klien Kami - Hastaka Holiday';
        $data['klien'] = $this->db->order_by('jenis', 'ASC')->order_by('nama_klien', 'ASC')->get('klien')->result();
        $data['total_klien'] = count($data['klien']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('clients', $data);
        $this->load->view('templates/footer');
    }

    public function program()
    {
        $data['title'] = 'Program - Hastaka Holiday';
        $data['kategori'] = $this->Kategori_model->get_all_kategori();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('program', $data);
        $this->load->view('templates/footer');
    }
}
