<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivitas_model extends CI_Model {

    public function get_all_aktivitas()
    {
        return $this->db->order_by('id_aktivitas', 'ASC')->get('aktivitas_wisata')->result();
    }

    public function get_aktivitas_paginated($limit, $offset)
    {
        return $this->db->order_by('id_aktivitas', 'ASC')->limit($limit)->offset($offset)->get('aktivitas_wisata')->result();
    }

    public function count_aktivitas()
    {
        return $this->db->count_all_results('aktivitas_wisata');
    }

    public function get_aktivitas_by_id($id)
    {
        return $this->db->get_where('aktivitas_wisata', ['id_aktivitas' => $id])->row();
    }

    public function tambah_aktivitas($data)
    {
        return $this->db->insert('aktivitas_wisata', $data);
    }

    public function update_aktivitas($id, $data)
    {
        return $this->db->update('aktivitas_wisata', $data, ['id_aktivitas' => $id]);
    }

    public function hapus_aktivitas($id)
    {
        return $this->db->delete('aktivitas_wisata', ['id_aktivitas' => $id]);
    }

    public function get_by_paket($id_paket)
    {
        $this->db->select('aktivitas_wisata.*');
        $this->db->join('paket_aktivitas', 'paket_aktivitas.id_aktivitas = aktivitas_wisata.id_aktivitas');
        $this->db->where('paket_aktivitas.id_paket', $id_paket);
        $this->db->order_by('aktivitas_wisata.id_aktivitas', 'ASC');
        return $this->db->get('aktivitas_wisata')->result();
    }

    public function set_aktivitas_paket($id_paket, $id_aktivitas_arr)
    {
        $this->db->delete('paket_aktivitas', ['id_paket' => $id_paket]);
        if (!empty($id_aktivitas_arr)) {
            foreach ($id_aktivitas_arr as $id_aktivitas) {
                $this->db->insert('paket_aktivitas', [
                    'id_paket' => $id_paket,
                    'id_aktivitas' => $id_aktivitas
                ]);
            }
        }
    }
}