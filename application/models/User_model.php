<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_all_users()
    {
        return $this->db->order_by('created_at', 'DESC')->get('users')->result();
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where('users', ['id_user' => $id])->row();
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function register($data)
    {
        return $this->db->insert('users', $data);
    }

    public function update_user($id, $data)
    {
        return $this->db->update('users', $data, ['id_user' => $id]);
    }

    public function toggle_status($id)
    {
        $user = $this->get_user_by_id($id);
        if (!$user) {
            return FALSE;
        }
        $new_status = ($user->status == 'aktif') ? 'nonaktif' : 'aktif';
        return $this->db->update('users', ['status' => $new_status], ['id_user' => $id]);
    }

    public function count_pelanggan()
    {
        return $this->db->where('role', 'pelanggan')->count_all_results('users');
    }

    public function count_pelanggan_aktif()
    {
        return $this->db->where(['role' => 'pelanggan', 'status' => 'aktif'])->count_all_results('users');
    }

    // ========== RESET PASSWORD ==========
    public function set_reset_token($id_user, $token, $expires)
    {
        return $this->db->update('users', [
            'reset_token' => $token,
            'reset_expires' => $expires
        ], ['id_user' => $id_user]);
    }

    public function get_user_by_reset_token($token)
    {
        return $this->db->get_where('users', ['reset_token' => $token])->row();
    }

    public function clear_reset_token($id_user)
    {
        return $this->db->update('users', [
            'reset_token' => null,
            'reset_expires' => null
        ], ['id_user' => $id_user]);
    }
}
