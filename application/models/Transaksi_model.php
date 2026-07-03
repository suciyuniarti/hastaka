<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    // Catatan: pada skema database, tabel `pemesanan` memakai kolom `id_akomodasi`.
    // Apabila kolom tersebut tidak ada (mis. schema belum sinkron), query JOIN ke `akomodasi`
    // akan gagal dengan error 1054.


    public function get_all_pemesanan()
    {
        $this->db->select('pemesanan.*, users.nama_lengkap, users.email, paket_wisata.nama_paket, paket_wisata.harga, akomodasi.nama_akomodasi, akomodasi.icon as akomodasi_icon, akomodasi.harga_tambahan as harga_akomodasi');
        $this->db->join('users', 'users.id_user = pemesanan.id_user');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = pemesanan.id_paket');
        $this->db->join('akomodasi', 'akomodasi.id_akomodasi = pemesanan.id_akomodasi', 'left');
        $this->db->order_by('pemesanan.tgl_transaksi', 'DESC');
        return $this->db->get('pemesanan')->result();
    }

    public function get_pemesanan_paginated($limit, $offset)
    {
        $this->db->select('pemesanan.*, users.nama_lengkap, users.email, paket_wisata.nama_paket, paket_wisata.harga, akomodasi.nama_akomodasi, akomodasi.icon as akomodasi_icon, akomodasi.harga_tambahan as harga_akomodasi');
        $this->db->join('users', 'users.id_user = pemesanan.id_user');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = pemesanan.id_paket');
        $this->db->join('akomodasi', 'akomodasi.id_akomodasi = pemesanan.id_akomodasi', 'left');
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
        $this->db->select('pemesanan.*, users.nama_lengkap, users.email, paket_wisata.nama_paket, paket_wisata.harga, paket_wisata.deskripsi, paket_wisata.foto, akomodasi.nama_akomodasi, akomodasi.icon as akomodasi_icon, akomodasi.harga_tambahan as harga_akomodasi');
        $this->db->join('users', 'users.id_user = pemesanan.id_user');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = pemesanan.id_paket');
        $this->db->join('akomodasi', 'akomodasi.id_akomodasi = pemesanan.id_akomodasi', 'left');
        $this->db->where('pemesanan.id_pemesanan', $id);
        return $this->db->get('pemesanan')->row();
    }

    public function get_pemesanan_by_kode($kode)
    {
        $this->db->select('pemesanan.*, users.nama_lengkap, users.email, paket_wisata.nama_paket, paket_wisata.harga, paket_wisata.deskripsi, paket_wisata.foto, akomodasi.nama_akomodasi, akomodasi.icon as akomodasi_icon, akomodasi.harga_tambahan as harga_akomodasi');
        $this->db->join('users', 'users.id_user = pemesanan.id_user');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = pemesanan.id_paket');
        $this->db->join('akomodasi', 'akomodasi.id_akomodasi = pemesanan.id_akomodasi', 'left');
        $this->db->where('pemesanan.kode_booking', $kode);
        return $this->db->get('pemesanan')->row();
    }

    public function get_pemesanan_by_user($id_user)
    {
        $this->db->select('pemesanan.*, paket_wisata.nama_paket, paket_wisata.harga, paket_wisata.foto, akomodasi.nama_akomodasi, akomodasi.icon as akomodasi_icon, akomodasi.harga_tambahan as harga_akomodasi');
        $this->db->join('paket_wisata', 'paket_wisata.id_paket = pemesanan.id_paket');
        $this->db->join('akomodasi', 'akomodasi.id_akomodasi = pemesanan.id_akomodasi', 'left');
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

    private function generate_kode_booking()
    {
        $prefix = 'HST';
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
        return $prefix . $date . $random;
    }
}
