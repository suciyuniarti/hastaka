<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akomodasi_model extends CI_Model {

    public function get_all_active()
    {
        return $this->db->where('is_active', 'y')->order_by('id_akomodasi', 'ASC')->get('akomodasi')->result();
    }

    public function get_all()
    {
        return $this->db->order_by('is_active', 'DESC')->order_by('id_akomodasi', 'ASC')->get('akomodasi')->result();
    }

    public function get_by_ids($ids)
    {
        if (empty($ids)) {
            return [];
        }
        $this->db->where_in('id_akomodasi', $ids);
        $this->db->where('is_active', 'y');
        return $this->db->get('akomodasi')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('akomodasi', ['id_akomodasi' => $id])->row();
    }

    public function tambah_akomodasi($data)
    {
        $this->db->insert('akomodasi', $data);
        return $this->db->insert_id();
    }

    public function update_akomodasi($id, $data)
    {
        $this->db->where('id_akomodasi', $id);
        return $this->db->update('akomodasi', $data);
    }

    public function hapus_akomodasi($id)
    {
        if ($this->is_used_in_paket($id)) {
            return FALSE;
        }
        $this->db->where('id_akomodasi', $id);
        return $this->db->delete('akomodasi');
    }

    public function set_akomodasi_paket($id_paket, $id_akomodasi_arr)
    {
        $this->db->where('id_paket', $id_paket);
        $this->db->delete('paket_akomodasi');

        if (!empty($id_akomodasi_arr)) {
            foreach ($id_akomodasi_arr as $id_ak) {
                $this->db->insert('paket_akomodasi', [
                    'id_paket' => $id_paket,
                    'id_akomodasi' => $id_ak
                ]);
            }
        }
    }

    public function get_by_paket($id_paket)
    {
        $this->db->select('akomodasi.*');
        $this->db->join('paket_akomodasi', 'paket_akomodasi.id_akomodasi = akomodasi.id_akomodasi');
        $this->db->where('paket_akomodasi.id_paket', $id_paket);
        $this->db->where('akomodasi.is_active', 'y');
        $this->db->order_by('akomodasi.id_akomodasi', 'ASC');
        return $this->db->get('akomodasi')->result();
    }

    public function get_paket_by_akomodasi($id_akomodasi)
    {
        $this->db->select('paket_wisata.*');
        $this->db->join('paket_akomodasi', 'paket_akomodasi.id_paket = paket_wisata.id_paket');
        $this->db->where('paket_akomodasi.id_akomodasi', $id_akomodasi);
        return $this->db->get('paket_wisata')->result();
    }

    public function set_paket_for_akomodasi($id_akomodasi, $id_paket_arr)
    {
        // Mulai transaksi database agar DELETE + INSERT bersifat atomik.
        // Jika salah satu gagal, seluruh perubahan di-rollback.
        $this->db->trans_start();

        // 1. Hapus SEMUA relasi lama untuk akomodasi ini (wajib, termasuk
        //    saat array kosong / tidak ada paket yang dicentang).
        $this->db->where('id_akomodasi', $id_akomodasi);
        $this->db->delete('paket_akomodasi');

        // 2. Insert ulang seluruh paket yang dipilih
        if (!empty($id_paket_arr)) {
            foreach ($id_paket_arr as $id_paket) {
                $this->db->insert('paket_akomodasi', [
                    'id_paket' => $id_paket,
                    'id_akomodasi' => $id_akomodasi
                ]);
            }
        }

        $this->db->trans_complete();

        // Return status transaksi: TRUE jika sukses, FALSE jika gagal
        return $this->db->trans_status();
    }

    public function is_used_in_paket($id_akomodasi)
    {
        $this->db->where('id_akomodasi', $id_akomodasi);
        $this->db->from('paket_akomodasi');
        return $this->db->count_all_results() > 0;
    }

    public function is_used_in_pemesanan($id_akomodasi)
    {
        $this->db->where('id_akomodasi', $id_akomodasi);
        $this->db->from('pemesanan_akomodasi');
        return $this->db->count_all_results() > 0;
    }
}
