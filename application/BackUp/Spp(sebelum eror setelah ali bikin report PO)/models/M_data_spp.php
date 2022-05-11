<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_data_spp extends CI_Model
{

    var $table = 'ppo'; //nama tabel dari database
    var $column_order = array(null, 'id', 'noppotxt', 'noreftxt', 'tglref', 'tglppo', 'tgltrm', 'namadept', 'lokasi', 'ket', 'user'); //field yang ada di table user
    var $column_search = array('noppotxt', 'noreftxt', 'tglref', 'tglppo', 'tgltrm', 'namadept', 'lokasi', 'ket', 'user'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $role_user = $this->session->userdata('user');
        $this->db_logistik_pt->from($this->table);
        $this->db_logistik_pt->where('user', $role_user);
        // $this->db_logistik_pt->select('id, noppotxt, noreftxt, tglref,tglppo,tgltrm,namadept,lokasi,ket,user');
        // $this->db_logistik_pt->order_by('id', 'desc');

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db_logistik_pt->group_start();
                    $this->db_logistik_pt->like($item, $_POST['search']['value']);
                } else {
                    $this->db_logistik_pt->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db_logistik_pt->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db_logistik_pt->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db_logistik_pt->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db_logistik_pt->limit($_POST['length'], $_POST['start']);
        $query = $this->db_logistik_pt->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db_logistik_pt->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db_logistik_pt->from($this->table);
        return $this->db_logistik_pt->count_all_results();
    }

    public function getDetailSpp($noppo)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where('noppotxt', $noppo);
        return $this->db_logistik_pt->get()->result_array();
    }

    public function cari_spp_edit($noppo)
    {
        $this->db_logistik_pt->select('noref, noreftxt');
        $this->db_logistik_pt->from('ppo');
        $this->db_logistik_pt->where('noppo', $noppo);
        $ppo = $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select('kodebar, nabar,qty, STOK, sat, ket, noref, noreftxt, id');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where('noppo', $noppo);
        $item_ppo = $this->db_logistik_pt->get()->result_array();

        $data = [
            'ppo' => $ppo,
            'item_ppo' => $item_ppo
        ];

        return $data;
    }
}
