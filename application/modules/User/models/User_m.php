<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{

    function get_user()
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('tbuser');

        $query = $this->db_logistik_pt->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function dept()
    {
        $this->db_logistik_pt->select('kode, nama');
        $this->db_logistik_pt->from('dept');
        return $this->db_logistik_pt->get()->result_array();
    }

    public function level_user()
    {
        return $this->db_logistik_pt->get('level_user')->result_array();
    }

    public function tambahUser($data)
    {
        return $this->db_logistik_pt->insert('user', $data);
    }

    public function get_level($data)
    {
        return $this->db_logistik_pt->get_where('level_user', array('kode_level' => $data))->row_array();
    }

    function get_id($id)
    {
        $query = $this->db_logistik_pt->where('user_id', $id);
        $q = $this->db_logistik_pt->get('tbuser');
        $data = $q->result();

        return $data;
    }

    function update_user($id, $data)
    {
        $this->db_logistik_pt->where('user_id', $id);
        $this->db_logistik_pt->update('tbuser', $data);

        return TRUE;
    }

    function delete($data)
    {
        $this->db_logistik_pt->where($data);
        $this->db_logistik_pt->delete('tbuser');
        return TRUE;
    }

    public function cariDevisi()
    {
        $lokasi = $this->session->userdata('status_lokasi');
        $kode_dev = $this->session->userdata('kode_dev');

        if ($lokasi == 'HO') {
            $this->db_logistik_pt->select('PT, kodetxt');
            $this->db_logistik_pt->from('tb_devisi');
            $this->db_logistik_pt->order_by('kodetxt', 'ASC');
            return $this->db_logistik_pt->get()->result_array();
        } else {
            $this->db_logistik_pt->select('PT, kodetxt');
            // $this->db_logistik_pt->where('kodetxt', $kode_dev);
            $this->db_logistik_pt->from('tb_devisi');
            $this->db_logistik_pt->order_by('kodetxt', 'ASC');
            return $this->db_logistik_pt->get()->result_array();
        }
    }
}
