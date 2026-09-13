<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas_model extends CI_Model {

    public function get_all_fasilitas()
    {
        return $this->db->order_by('id_fasilitas', 'ASC')->get('fasilitas')->result();
    }

    public function get_fasilitas_paginated($limit, $offset)
    {
        return $this->db->order_by('id_fasilitas', 'ASC')->limit($limit)->offset($offset)->get('fasilitas')->result();
    }

    public function count_fasilitas()
    {
        return $this->db->count_all_results('fasilitas');
    }

    public function get_fasilitas_by_id($id)
    {
        return $this->db->get_where('fasilitas', ['id_fasilitas' => $id])->row();
    }

    public function tambah_fasilitas($data)
    {
        return $this->db->insert('fasilitas', $data);
    }

    public function update_fasilitas($id, $data)
    {
        return $this->db->update('fasilitas', $data, ['id_fasilitas' => $id]);
    }

    public function is_used_in_paket($id_fasilitas)
    {
        $this->db->where('id_fasilitas', $id_fasilitas);
        $this->db->from('paket_fasilitas');
        return $this->db->count_all_results() > 0;
    }

    public function hapus_fasilitas($id)
    {
        if ($this->is_used_in_paket($id)) {
            return FALSE;
        }
        return $this->db->delete('fasilitas', ['id_fasilitas' => $id]);
    }

    public function get_by_paket($id_paket)
    {
        $this->db->select('fasilitas.*');
        $this->db->join('paket_fasilitas', 'paket_fasilitas.id_fasilitas = fasilitas.id_fasilitas');
        $this->db->where('paket_fasilitas.id_paket', $id_paket);
        $this->db->order_by('fasilitas.id_fasilitas', 'ASC');
        return $this->db->get('fasilitas')->result();
    }

    public function count_by_paket($id_paket)
    {
        $this->db->where('paket_fasilitas.id_paket', $id_paket);
        return $this->db->count_all_results('paket_fasilitas');
    }

    public function set_fasilitas_paket($id_paket, $id_fasilitas_arr)
    {
        $this->db->delete('paket_fasilitas', ['id_paket' => $id_paket]);
        if (!empty($id_fasilitas_arr)) {
            foreach ($id_fasilitas_arr as $id_fasilitas) {
                $this->db->insert('paket_fasilitas', [
                    'id_paket' => $id_paket,
                    'id_fasilitas' => $id_fasilitas
                ]);
            }
        }
    }
}