<?php


defined('BASEPATH') or exit('No direct script access allowed');

class admin_m extends CI_Model
{
    public function get_admin()
    {
        # code...
        $this->db->select('*');
        $this->db->from('tb_admin');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }
    function add_admin($data)
    {
        $this->db->insert('tb_admin', $data);
        return TRUE;
    }

    function prosesLogin($username)
    {
        $this->db->where('username', $username);

        return $this->db->get('tb_admin')->row();
    }

    public function get($id = null)
    {
        $this->db->from('tb_admin');
        if ($id != null) {
            $this->db->where('id_admin', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_id($id)
    {
        $query = $this->db->where('id_admin', $id);
        $q = $this->db->get('tb_admin');
        $data = $q->result();

        return $data;
    }

    function viewDataByID($username)
    {
        $query = $this->db->where('username', $username);
        $q = $this->db->get('tb_admin');
        $data = $q->result();

        return $data;
    }

    function checkDataUsrbyID($id, $pass)
    {
        $this->db->where('id_admin', $id);
        $this->db->where('password', $pass);

        return $this->db->get('tb_admin')->row();
    }

    function update_admin($id, $data)
    {
        $this->db->where('id_admin', $id);
        $this->db->update('tb_admin', $data);

        return TRUE;
    }
    // function changepassUser($id, $data)
    // {
    //     $this->db->where('id_user', $id);
    //     $this->db->update('tb_admin', $data);

    //     return TRUE;
    // }
}

/* End of file ModelName.php */