<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');

        // Wajib login
        if (!$this->session->userdata('id_user')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Profil Saya - Hastaka Holiday';
        $data['user'] = $this->User_model->get_user_by_id($this->session->userdata('id_user'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('profil', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profil - Hastaka Holiday';
        $data['user'] = $this->User_model->get_user_by_id($this->session->userdata('id_user'));

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim|min_length[3]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('profil_edit', $data);
            $this->load->view('templates/footer');
        } else {
            $update = [
                'nama_lengkap' => $this->input->post('nama_lengkap', TRUE)
            ];

            $password = $this->input->post('password');
            if (!empty($password)) {
                $update['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $this->User_model->update_user($this->session->userdata('id_user'), $update);

            // Update session nama
            $this->session->set_userdata('nama_lengkap', $update['nama_lengkap']);

            $this->session->set_flashdata('success', 'Profil berhasil diupdate!');
            redirect('profil');
        }
    }
}
