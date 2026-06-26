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
}
