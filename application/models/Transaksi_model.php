<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    public function get_pemesanan_akomodasi_by_id_pemesanan($id_pemesanan)
    {
        $this->db->select('id_akomodasi, nama_akomodasi, harga_per_orang, jumlah_peserta, subtotal');
        $this->db->from('pemesanan_akomodasi');
        $this->db->where('id_pemesanan', $id_pemesanan);
        $this->db->order_by('id_akomodasi', 'ASC');
        return $this->db->get()->result();
    }

    public function get_pemesanan_akomodasi_by_ids(array $id_pemesanan_list)
    {
        if (empty($id_pemesanan_list)) {
            return [];
        }
        $this->db->select('id_pemesanan, id_akomodasi, nama_akomodasi, harga_per_orang, jumlah_peserta, subtotal');
        $this->db->from('pemesanan_akomodasi');
        $this->db->where_in('id_pemesanan', $id_pemesanan_list);
        $this->db->order_by('id_pemesanan, id_akomodasi', 'ASC');
        return $this->db->get()->result();
    }

    public function get_all_pemesanan()
    {
        $this->db->select('pemesanan.*, users.nama_lengkap, users.email, paket_wisata.nama_paket, paket_wisata.harga');
        $this->db->join('users', 'users.id_user = pemesanan.id_user');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = pemesanan.id_paket');
        $this->db->order_by('pemesanan.tgl_transaksi', 'DESC');
        return $this->db->get('pemesanan')->result();
    }

    public function get_pemesanan_paginated($limit, $offset)
    {
        $this->db->select('pemesanan.*, users.nama_lengkap, users.email, paket_wisata.nama_paket, paket_wisata.harga');
        $this->db->join('users', 'users.id_user = pemesanan.id_user');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = pemesanan.id_paket');
        $this->db->order_by('pemesanan.tgl_transaksi', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get('pemesanan')->result();
    }

    public function count_pemesanan()
    {
        return $this->db->count_all_results('pemesanan');
    }

    public function get_pemesanan_by_id($id)
    {
        $this->db->select('pemesanan.*, users.nama_lengkap, users.email, paket_wisata.nama_paket, paket_wisata.harga, paket_wisata.deskripsi, paket_wisata.foto');
        $this->db->join('users', 'users.id_user = pemesanan.id_user');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = pemesanan.id_paket');
        $this->db->where('pemesanan.id_pemesanan', $id);
        return $this->db->get('pemesanan')->row();
    }

    public function get_pemesanan_by_kode($kode)
    {
        $this->db->select('pemesanan.*, users.nama_lengkap, users.email, paket_wisata.nama_paket, paket_wisata.harga, paket_wisata.deskripsi, paket_wisata.foto');
        $this->db->join('users', 'users.id_user = pemesanan.id_user');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = pemesanan.id_paket');
        $this->db->where('pemesanan.kode_booking', $kode);
        return $this->db->get('pemesanan')->row();
    }

    public function get_pemesanan_by_user($id_user)
    {
        $this->db->select('pemesanan.*, paket_wisata.nama_paket, paket_wisata.harga, paket_wisata.foto');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = pemesanan.id_paket');
        $this->db->where('pemesanan.id_user', $id_user);
        $this->db->order_by('pemesanan.tgl_transaksi', 'DESC');
        return $this->db->get('pemesanan')->result();
    }

    public function buat_pemesanan($data)
    {
        $data['kode_booking'] = $this->generate_kode_booking();
        $this->db->insert('pemesanan', $data);
        return $this->db->insert_id();
    }

    public function update_status($id, $status)
    {
        return $this->db->update('pemesanan', ['status_pemesanan' => $status], ['id_pemesanan' => $id]);
    }

    public function count_transaksi_berjalan()
    {
        return $this->db->where_in('status_pemesanan', ['pending', 'dikonfirmasi'])->count_all_results('pemesanan');
    }

    public function get_pendapatan_bulanan($bulan, $tahun)
    {
        $this->db->select_sum('total_bayar');
        $this->db->where('status_pemesanan', 'dikonfirmasi');
        $this->db->where('MONTH(tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $result = $this->db->get('pemesanan')->row();
        return $result ? $result->total_bayar : 0;
    }

    public function get_pendapatan_tahunan($tahun)
    {
        $this->db->select_sum('total_bayar');
        $this->db->where('status_pemesanan', 'dikonfirmasi');
        $this->db->where('YEAR(tgl_transaksi)', $tahun);
        $result = $this->db->get('pemesanan')->row();
        return $result ? $result->total_bayar : 0;
    }

    public function get_laporan_periode($tgl_mulai, $tgl_selesai)
    {
        $this->db->select('pemesanan.*, users.nama_lengkap, paket_wisata.nama_paket');
        $this->db->join('users', 'users.id_user = pemesanan.id_user');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = pemesanan.id_paket');
        $this->db->where('pemesanan.tgl_transaksi >=', $tgl_mulai);
        $this->db->where('pemesanan.tgl_transaksi <=', $tgl_selesai . ' 23:59:59');
        $this->db->order_by('pemesanan.tgl_transaksi', 'DESC');
        return $this->db->get('pemesanan')->result();
    }

    /**
     * Get detailed transaction data for modal display
     * Includes akomodasi details and payment breakdown
     */
    public function get_detail_transaksi($id_pemesanan)
    {
        // Get main transaction data
        // Note: no_telepon is NOT in users table, it's in pemesanan table (based on booking form)
        $pemesanan = $this->db->select('pemesanan.*, users.nama_lengkap, users.email, paket_wisata.nama_paket, paket_wisata.harga as harga_paket')
            ->join('users', 'users.id_user = pemesanan.id_user')
            ->join('paket_wisata', 'paket_wisata.id_paket = pemesanan.id_paket')
            ->where('pemesanan.id_pemesanan', $id_pemesanan)
            ->get('pemesanan')
            ->row();

        if (!$pemesanan) {
            return null;
        }

        // Get akomodasi details
        $akomodasi_list = $this->get_pemesanan_akomodasi_by_id_pemesanan($id_pemesanan);

        // Calculate payment breakdown
        $total_tagihan = (float) $pemesanan->harga_paket * (int) $pemesanan->jumlah_peserta;
        $total_akomodasi = 0;
        foreach ($akomodasi_list as $ak) {
            $total_akomodasi += (float) $ak->subtotal;
        }
        $total_harga_sebenarnya = $total_tagihan + $total_akomodasi;
        $total_dp_dibayar = (float) $pemesanan->total_bayar;
        $sisa_lunasi = $total_harga_sebenarnya - $total_dp_dibayar;

        return [
            'id_pemesanan' => $pemesanan->id_pemesanan,
            'kode_booking' => $pemesanan->kode_booking,
            'nama_lengkap' => $pemesanan->nama_lengkap,
            'email' => $pemesanan->email,
            'no_telepon' => isset($pemesanan->no_telepon) ? $pemesanan->no_telepon : null, // From pemesanan table
            'nama_paket' => $pemesanan->nama_paket,
            'tgl_keberangkatan' => $pemesanan->tgl_keberangkatan,
            'jam_keberangkatan' => isset($pemesanan->jam_keberangkatan) ? $pemesanan->jam_keberangkatan : null,
            'jumlah_peserta' => (int) $pemesanan->jumlah_peserta,
            'titik_kumpul' => isset($pemesanan->titik_kumpul) ? $pemesanan->titik_kumpul : null,
            'tipe_pembayaran' => isset($pemesanan->tipe_pembayaran) ? $pemesanan->tipe_pembayaran : 'full',
            'status_pemesanan' => $pemesanan->status_pemesanan,
            'bukti_transfer' => isset($pemesanan->bukti_transfer) ? $pemesanan->bukti_transfer : null,
            'harga_paket' => (float) $pemesanan->harga_paket,
            'akomodasi_list' => $akomodasi_list,
            'payment_breakdown' => [
                'total_tagihan' => $total_tagihan,
                'total_akomodasi' => $total_akomodasi,
                'total_harga_sebenarnya' => $total_harga_sebenarnya,
                'total_dp_dibayar' => $total_dp_dibayar,
                'sisa_lunasi' => $sisa_lunasi
            ]
        ];
    }

    private function generate_kode_booking()
    {
        $prefix = 'HST';
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        return $prefix . $date . $random;
    }
}
