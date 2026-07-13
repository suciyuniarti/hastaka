<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver|CI_DB_query_builder $db
 */
class Paket_model extends CI_Model {

    public function get_all_paket()
    {
        return $this->db->order_by('created_at', 'DESC')->get('paket_wisata')->result();
    }

    public function search_paket($keyword)
    {
        $this->db->like('nama_paket', $keyword);
        return $this->db->order_by('created_at', 'DESC')->get('paket_wisata')->result();
    }

    public function get_paket_tersedia()
    {
        return $this->db->where('status', 'tersedia')->order_by('nama_paket', 'ASC')->get('paket_wisata')->result();
    }

    public function get_paket_by_id($id)
    {
        return $this->db->get_where('paket_wisata', ['id_paket' => $id])->row();
    }

    public function get_paket_populer($limit = 3)
    {
        return $this->db->where('status', 'tersedia')
                        ->order_by('rating', 'DESC')
                        ->limit($limit)
                        ->get('paket_wisata')
                        ->result();
    }

    public function tambah_paket($data)
    {
        $this->db->insert('paket_wisata', $data);
        return $this->db->insert_id();
    }

    public function update_paket($id, $data)
    {
        return $this->db->update('paket_wisata', $data, ['id_paket' => $id]);
    }

    public function hapus_paket($id)
    {
        return $this->db->delete('paket_wisata', ['id_paket' => $id]);
    }

    public function count_paket()
    {
        return $this->db->count_all_results('paket_wisata');
    }

    public function count_paket_tersedia()
    {
        return $this->db->where('status', 'tersedia')->count_all_results('paket_wisata');
    }

    // ========== KRITERIA ==========
    public function get_all_kriteria()
    {
        return $this->db->order_by('id_kriteria', 'ASC')->get('kriteria')->result();
    }

    public function get_kriteria_by_id($id)
    {
        return $this->db->get_where('kriteria', ['id_kriteria' => $id])->row();
    }

    public function update_kriteria($id, $data)
    {
        return $this->db->update('kriteria', $data, ['id_kriteria' => $id]);
    }

    // ========== NILAI ALTERNATIF ==========
    public function get_nilai_by_paket($id_paket)
    {
        $this->db->select('nilai_alternatif.*, kriteria.kode_kriteria, kriteria.nama_kriteria, kriteria.sifat');
        $this->db->join('kriteria', 'kriteria.id_kriteria = nilai_alternatif.id_kriteria');
        $this->db->where('nilai_alternatif.id_paket', $id_paket);
        $this->db->order_by('kriteria.id_kriteria', 'ASC');
        return $this->db->get('nilai_alternatif')->result();
    }

    public function get_nilai_by_paket_kriteria($id_paket, $id_kriteria)
    {
        return $this->db->get_where('nilai_alternatif', [
            'id_paket' => $id_paket,
            'id_kriteria' => $id_kriteria
        ])->row();
    }

    public function update_nilai($id_paket, $id_kriteria, $nilai)
    {
        $existing = $this->get_nilai_by_paket_kriteria($id_paket, $id_kriteria);
        if ($existing) {
            return $this->db->update('nilai_alternatif', ['nilai' => $nilai], [
                'id_paket' => $id_paket,
                'id_kriteria' => $id_kriteria
            ]);
        } else {
            return $this->db->insert('nilai_alternatif', [
                'id_paket' => $id_paket,
                'id_kriteria' => $id_kriteria,
                'nilai' => $nilai
            ]);
        }
    }

    public function get_all_nilai_alternatif()
    {
        $this->db->select('nilai_alternatif.*, paket_wisata.nama_paket, kriteria.kode_kriteria, kriteria.sifat');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = nilai_alternatif.id_paket');
        $this->db->join('kriteria', 'kriteria.id_kriteria = nilai_alternatif.id_kriteria');
        $this->db->order_by('nilai_alternatif.id_paket', 'ASC');
        return $this->db->get('nilai_alternatif')->result();
    }
}
