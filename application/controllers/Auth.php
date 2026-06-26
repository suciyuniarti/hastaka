<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login()
    {
        // Jika sudah login, redirect sesuai role
        if ($this->session->userdata('id_user')) {
            if ($this->session->userdata('role') == 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('home');
            }
        }

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login - Hastaka Holiday';
            $this->load->view('templates/header', $data);
            $this->load->view('login');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);

            $user = $this->User_model->get_user_by_email($email);

            if ($user) {
                if ($user->status == 'nonaktif') {
                    $this->session->set_flashdata('error', 'Akun Anda telah dinonaktifkan. Hubungi administrator.');
                    redirect('auth/login');
                }

                if (password_verify($password, $user->password)) {
                    $session_data = [
                        'id_user' => $user->id_user,
                        'nama_lengkap' => $user->nama_lengkap,
                        'email' => $user->email,
                        'role' => $user->role,
                        'logged_in' => TRUE
                    ];
                    $this->session->set_userdata($session_data);

                    if ($user->role == 'admin') {
                        redirect('admin/dashboard');
                    } else {
                        // Redirect back ke halaman sebelumnya jika ada
                        $redirect = $this->session->userdata('redirect_after_login');
                        if ($redirect) {
                            $this->session->unset_userdata('redirect_after_login');
                            redirect($redirect);
                        }
                        redirect('home');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Password salah!');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('error', 'Email tidak terdaftar!');
                redirect('auth/login');
            }
        }
    }

    public function register()
    {
        if ($this->session->userdata('id_user')) {
            redirect('home');
        }

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email sudah terdaftar. Gunakan email lain.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Register - Hastaka Holiday';
            $this->load->view('templates/header', $data);
            $this->load->view('register');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap', TRUE),
                'email' => $this->input->post('email', TRUE),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
                'role' => 'pelanggan',
                'status' => 'aktif'
            ];

            $this->User_model->register($data);
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
            redirect('auth/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Anda telah logout.');
        redirect('auth/login');
    }

    // ========== LUPA KATA SANDI ==========
    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Lupa Kata Sandi - Hastaka Holiday';
            $this->load->view('templates/header', $data);
            $this->load->view('forgot_password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', TRUE);
            $user = $this->User_model->get_user_by_email($email);

            if (!$user) {
                $this->session->set_flashdata('error', 'Email tidak terdaftar dalam sistem.');
                redirect('auth/forgot_password');
            }

            if ($user->status == 'nonaktif') {
                $this->session->set_flashdata('error', 'Akun Anda dinonaktifkan. Hubungi administrator.');
                redirect('auth/forgot_password');
            }

            // Generate token
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $this->User_model->set_reset_token($user->id_user, $token, $expires);

            // Karena tidak ada email, tampilkan link reset langsung
            $reset_link = base_url('auth/reset_password/' . $token);
            $this->session->set_flashdata('success',
                'Token reset berhasil dibuat! <br><br>' .
                '<div class="bg-white border border-brand-200 rounded-xl p-4 mt-2">' .
                '<p class="text-xs text-gray-500 mb-1">Link reset kata sandi:</p>' .
                '<a href="' . $reset_link . '" class="text-brand-600 font-semibold text-sm break-all hover:underline">' . $reset_link . '</a>' .
                '<p class="text-xs text-amber-600 mt-2">Link berlaku 1 jam. Klik link di atas untuk mengatur ulang kata sandi.</p>' .
                '</div>'
            );
            redirect('auth/forgot_password');
        }
    }

    public function reset_password($token = null)
    {
        if (!$token) {
            $this->session->set_flashdata('error', 'Token reset tidak valid.');
            redirect('auth/forgot_password');
        }

        $user = $this->User_model->get_user_by_reset_token($token);

        if (!$user) {
            $this->session->set_flashdata('error', 'Token reset tidak valid atau sudah kedaluwarsa.');
            redirect('auth/forgot_password');
        }

        // Cek apakah token sudah expired
        if (strtotime($user->reset_expires) < time()) {
            $this->User_model->clear_reset_token($user->id_user);
            $this->session->set_flashdata('error', 'Token reset sudah kedaluwarsa. Silakan request ulang.');
            redirect('auth/forgot_password');
        }

        $this->form_validation->set_rules('password', 'Kata Sandi Baru', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Kata Sandi', 'required|trim|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Reset Kata Sandi - Hastaka Holiday';
            $data['token'] = $token;
            $this->load->view('templates/header', $data);
            $this->load->view('reset_password', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $new_password = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);
            $this->User_model->update_user($user->id_user, [
                'password' => $new_password
            ]);
            $this->User_model->clear_reset_token($user->id_user);

            $this->session->set_flashdata('success', 'Kata sandi berhasil diubah! Silakan login dengan kata sandi baru.');
            redirect('auth/login');
        }
    }
}
