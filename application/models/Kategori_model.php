<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

    public function get_all_kategori()
    {
        return $this->db->order_by('id_kategori', 'ASC')->get('kategori_program')->result();
    }

    public function get_kategori_paginated($limit, $offset)
    {
        return $this->db->order_by('id_kategori', 'ASC')->limit($limit)->offset($offset)->get('kategori_program')->result();
    }

    public function get_kategori_by_id($id)
    {
        return $this->db->get_where('kategori_program', ['id_kategori' => $id])->row();
    }

    public function count_kategori()
    {
        return $this->db->count_all_results('kategori_program');
    }

    public function tambah_kategori($data)
    {
        return $this->db->insert('kategori_program', $data);
    }

    public function update_kategori($id, $data)
    {
        return $this->db->update('kategori_program', $data, ['id_kategori' => $id]);
    }

    public function hapus_kategori($id)
    {
        return $this->db->delete('kategori_program', ['id_kategori' => $id]);
    }
}
