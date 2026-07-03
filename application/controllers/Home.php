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
        $data['paket_populer'] = $this->Paket_model->get_paket_populer(3);
         $data['bus_partner'] = $this->Partner_model->get_all_bus();
        
        if (empty($data['bus_partner'])) {
            $data['bus_partner'] = [
                (object)['nama' => 'Bus Pariwisata A', 'gambar' => 'bus1.svg', 'kota' => 'Surabaya'],
                (object)['nama' => 'Bus Pariwisata B', 'gambar' => 'bus2.svg', 'kota' => 'Malang'],
                (object)['nama' => 'Bus Pariwisata C', 'gambar' => 'bus3.svg', 'kota' => 'Jakarta'],
                (object)['nama' => 'Bus Pariwisata D', 'gambar' => 'bus4.svg', 'kota' => 'Bandung'],
                (object)['nama' => 'Bus Pariwisata E', 'gambar' => 'bus5.svg', 'kota' => null],
            ];
        }

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
