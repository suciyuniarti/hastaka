<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klien_model extends CI_Model {

    public function get_all_klien()
    {
        return $this->db->order_by('jenis, nama_klien')->get('klien')->result();
    }

    public function get_klien_paginated($limit, $offset)
    {
        return $this->db->order_by('jenis, nama_klien')->limit($limit)->offset($offset)->get('klien')->result();
    }

    public function count_klien()
    {
        return $this->db->count_all('klien');
    }

    public function get_klien_by_id($id)
    {
        return $this->db->get_where('klien', ['id_klien' => $id])->row();
    }

    public function tambah_klien($data)
    {
        return $this->db->insert('klien', $data);
    }

    public function update_klien($id, $data)
    {
        return $this->db->update('klien', $data, ['id_klien' => $id]);
    }

    public function hapus_klien($id)
    {
        return $this->db->delete('klien', ['id_klien' => $id]);
    }
}