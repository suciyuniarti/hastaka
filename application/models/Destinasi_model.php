<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Destinasi_model extends CI_Model {

    public function get_all_destinasi()
    {
        return $this->db->order_by('kota', 'ASC')->order_by('nama_destinasi', 'ASC')
                        ->get('destinasi')->result();
    }

    public function get_destinasi_paginated($limit, $offset)
    {
        return $this->db->order_by('kota', 'ASC')->order_by('nama_destinasi', 'ASC')
                        ->limit($limit)->offset($offset)->get('destinasi')->result();
    }

    public function count_destinasi()
    {
        return $this->db->count_all_results('destinasi');
    }

    public function get_destinasi_by_id($id)
    {
        return $this->db->get_where('destinasi', ['id_destinasi' => $id])->row();
    }

    public function get_destinasi_by_kota($kota)
    {
        return $this->db->get_where('destinasi', ['kota' => $kota])->result();
    }

    public function get_destinasi_by_kota_paginated($kota, $limit, $offset)
    {
        return $this->db->order_by('kota', 'ASC')->order_by('nama_destinasi', 'ASC')
                        ->where('kota', $kota)
                        ->limit($limit)->offset($offset)
                        ->get('destinasi')->result();
    }

    public function count_destinasi_by_kota($kota)
    {
        return $this->db->where('kota', $kota)->count_all_results('destinasi');
    }

    public function get_kota_list()
    {
        $this->db->select('kota');
        $this->db->distinct();
        $this->db->order_by('kota', 'ASC');
        $result = $this->db->get('destinasi')->result();
        return array_column($result, 'kota');
    }

    public function tambah_destinasi($data)
    {
        return $this->db->insert('destinasi', $data);
    }

    public function update_destinasi($id, $data)
    {
        return $this->db->update('destinasi', $data, ['id_destinasi' => $id]);
    }

    public function is_used_in_paket($id_destinasi)
    {
        $this->db->where('id_destinasi', $id_destinasi);
        $this->db->from('paket_destinasi');
        return $this->db->count_all_results() > 0;
    }

    public function hapus_destinasi($id)
    {
        if ($this->is_used_in_paket($id)) {
            return FALSE;
        }
        return $this->db->delete('destinasi', ['id_destinasi' => $id]);
    }

    public function get_by_paket($id_paket)
    {
        $this->db->select('destinasi.*');
        $this->db->join('paket_destinasi', 'paket_destinasi.id_destinasi = destinasi.id_destinasi');
        $this->db->where('paket_destinasi.id_paket', $id_paket);
        $this->db->order_by('destinasi.kota', 'ASC');
        return $this->db->get('destinasi')->result();
    }

    public function set_destinasi_paket($id_paket, $id_destinasi_arr)
    {
        $this->db->delete('paket_destinasi', ['id_paket' => $id_paket]);
        if (!empty($id_destinasi_arr)) {
            foreach ($id_destinasi_arr as $id_destinasi) {
                $this->db->insert('paket_destinasi', [
                    'id_paket' => $id_paket,
                    'id_destinasi' => $id_destinasi
                ]);
            }
        }
    }
}