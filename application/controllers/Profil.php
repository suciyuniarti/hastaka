<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');

        // Wajib login
        if (!$this->session->userdata('id_user')) {
            $this->session->set_userdata('redirect_after_login', current_url());
            log_message('debug', 'redirect_after_login set to: ' . current_url());
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

    public function ubah_password()
    {
        $id_user = $this->session->userdata('id_user');
        $user = $this->User_model->get_user_by_id($id_user);

        if (!$user) {
            redirect('profil');
        }

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required',
            array('required' => 'Password Lama wajib diisi.'));

        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[6]',
            array(
                'required'   => 'Password Baru wajib diisi.',
                'min_length' => 'Password Baru minimal 6 karakter.'
            ));

        $this->form_validation->set_rules('password_konfirmasi', 'Konfirmasi Password Baru', 'required|matches[password_baru]',
            array(
                'required' => 'Konfirmasi Password Baru wajib diisi.',
                'matches'  => 'Konfirmasi Password Baru tidak cocok dengan Password Baru.'
            ));

        if ($this->form_validation->run() == FALSE) {
            // Tampilkan kembali halaman profil dengan error inline (form_error)
            $data['title'] = 'Profil Saya - Hastaka Holiday';
            $data['user'] = $user;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('profil', $data);
            $this->load->view('templates/footer');
            return;
        }

        // Verifikasi password lama
        if (!password_verify($this->input->post('password_lama'), $user->password)) {
            $this->session->set_flashdata('error_password', 'Password lama yang Anda masukkan salah.');
            redirect('profil');
        }

        $this->User_model->update_user($id_user, [
            'password' => password_hash($this->input->post('password_baru'), PASSWORD_DEFAULT)
        ]);

        $this->session->set_flashdata('success', 'Password berhasil diubah!');
        redirect('profil');
    }
}
