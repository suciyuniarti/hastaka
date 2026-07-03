<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_model extends CI_Model {

    public function get_all_active()
    {
        return $this->db->where('is_active', 'y')->order_by('id_bank', 'ASC')->get('bank')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('bank', ['id_bank' => $id])->row();
    }

    public function tambah_bank($data)
    {
        $this->db->insert('bank', $data);
        return $this->db->insert_id();
    }

    public function update_bank($id, $data)
    {
        $this->db->where('id_bank', $id);
        return $this->db->update('bank', $data);
    }

    public function hapus_bank($id)
    {
        $this->db->where('id_bank', $id);
        return $this->db->delete('bank');
    }
}