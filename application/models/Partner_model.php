<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Get all bus partners
    public function get_all_bus()
    {
        // Check if table exists
        $table_exists = $this->db->query("SHOW TABLES LIKE 'partner_bus'")->num_rows() > 0;
        if (!$table_exists) {
            return [];
        }
        return $this->db->order_by('nama', 'ASC')->get('partner_bus')->result();
    }

    // Get all hotel partners
    public function get_all_hotel()
    {
        // Check if table exists
        $table_exists = $this->db->query("SHOW TABLES LIKE 'partner_hotel'")->num_rows() > 0;
        if (!$table_exists) {
            return [];
        }
        return $this->db->order_by('bintang', 'ASC')->get('partner_hotel')->result();
    }

    // Get bus by ID
    public function get_bus_by_id($id)
    {
        return $this->db->get_where('partner_bus', ['id' => $id])->row();
    }

    // Get hotel by ID
    public function get_hotel_by_id($id)
    {
        return $this->db->get_where('partner_hotel', ['id' => $id])->row();
    }

    // Add bus partner
    public function tambah_bus($data)
    {
        $this->db->insert('partner_bus', $data);
        return $this->db->insert_id();
    }

    // Add hotel partner
    public function tambah_hotel($data)
    {
        $this->db->insert('partner_hotel', $data);
        return $this->db->insert_id();
    }

    // Update bus partner
    public function update_bus($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('partner_bus', $data);
    }

    // Update hotel partner
    public function update_hotel($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('partner_hotel', $data);
    }

    // Delete bus partner
    public function hapus_bus($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('partner_bus');
    }

    // Delete hotel partner
    public function hapus_hotel($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('partner_hotel');
    }

    // Upload gambar partner
    private function _upload_gambar($type, $old_file = null)
    {
        $upload_path = FCPATH . 'application/assets/images/partner/';
        
        if (!is_dir($upload_path)) {
            @mkdir($upload_path, 0755, TRUE);
        }

        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = $type . '_' . time() . '_' . rand(100, 999);
        $config['overwrite']     = FALSE;

        if (!isset($this->upload)) {
            $this->load->library('upload');
        }

        $this->upload->initialize($config);

        if ($this->upload->do_upload('gambar')) {
            $new_file = $this->upload->data('file_name');
            // Hapus file lama jika ada
            if ($old_file && file_exists($upload_path . $old_file)) {
                @unlink($upload_path . $old_file);
            }
            return ['status' => TRUE, 'file_name' => $new_file];
        } else {
            return ['status' => FALSE, 'error' => $this->upload->display_errors('', '')];
        }
    }

    // Update bus dengan gambar
    public function update_bus_with_image($id, $data, $old_gambar = null)
    {
        if (!empty($_FILES['gambar']['name'])) {
            $upload = $this->_upload_gambar('bus', $old_gambar);
            if ($upload['status']) {
                $data['gambar'] = $upload['file_name'];
            } else {
                return ['status' => FALSE, 'error' => $upload['error']];
            }
        }
        
        $this->db->where('id', $id);
        $this->db->update('partner_bus', $data);
        return ['status' => TRUE];
    }

    // Update hotel dengan gambar
    public function update_hotel_with_image($id, $data, $old_gambar = null)
    {
        if (!empty($_FILES['gambar']['name'])) {
            $upload = $this->_upload_gambar('hotel', $old_gambar);
            if ($upload['status']) {
                $data['gambar'] = $upload['file_name'];
            } else {
                return ['status' => FALSE, 'error' => $upload['error']];
            }
        }
        
        $this->db->where('id', $id);
        $this->db->update('partner_hotel', $data);
        return ['status' => TRUE];
    }

    // Tambah bus dengan gambar
    public function tambah_bus_with_image($data)
    {
        if (!empty($_FILES['gambar']['name'])) {
            $upload = $this->_upload_gambar('bus');
            if ($upload['status']) {
                $data['gambar'] = $upload['file_name'];
            } else {
                return ['status' => FALSE, 'error' => $upload['error']];
            }
        }
        
        $this->db->insert('partner_bus', $data);
        return ['status' => TRUE, 'id' => $this->db->insert_id()];
    }

    // Tambah hotel dengan gambar
    public function tambah_hotel_with_image($data)
    {
        if (!empty($_FILES['gambar']['name'])) {
            $upload = $this->_upload_gambar('hotel');
            if ($upload['status']) {
                $data['gambar'] = $upload['file_name'];
            } else {
                return ['status' => FALSE, 'error' => $upload['error']];
            }
        }
        
        $this->db->insert('partner_hotel', $data);
        return ['status' => TRUE, 'id' => $this->db->insert_id()];
    }
}
