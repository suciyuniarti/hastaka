<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property Paket_model $Paket_model
 * @property Destinasi_model $Destinasi_model
 * @property Fasilitas_model $Fasilitas_model
 * @property Aktivitas_model $Aktivitas_model
 */
class Paket extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Paket_model');
        $this->load->model('Destinasi_model');
        $this->load->model('Fasilitas_model');
        $this->load->model('Aktivitas_model');
    }

public function index()
    {
        $data['title'] = 'Paket Wisata - Hastaka Holiday';
        $data['paket'] = $this->Paket_model->get_all_paket_untuk_publik();

        // Attach fasilitas_count to each paket
        foreach ($data['paket'] as &$p) {
            $p->fasilitas_count = $this->Fasilitas_model->count_by_paket($p->id_paket);
        }
        unset($p);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('paket', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Paket - Hastaka Holiday';
        $data['paket'] = $this->Paket_model->get_paket_by_id($id);

        if (!$data['paket']) {
            $this->session->set_flashdata('error', 'Paket tidak ditemukan!');
            redirect('paket');
        }

        $data['nilai'] = $this->Paket_model->get_nilai_by_paket($id);
        $data['destinasi_paket'] = $this->Destinasi_model->get_by_paket($id);
        $data['fasilitas_paket'] = $this->Fasilitas_model->get_by_paket($id);
        $data['aktivitas_paket'] = $this->Aktivitas_model->get_by_paket($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('detail_paket', $data);
        $this->load->view('templates/footer');
    }
}
