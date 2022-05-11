<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_spp_noCoa extends CI_Model
{

    var $table = 'ppo_tmp'; //nama tabel dari database
    var $column_order = array(null, 'id', 'noppotxt', 'noreftxt', 'tglref', 'tglppo', 'tgltrm', 'namadept', 'lokasi', 'ket', 'user'); //field yang ada di table user
    var $column_search = array('noppotxt', 'noreftxt', 'tglref', 'tglppo', 'tgltrm', 'namadept', 'lokasi', 'ket', 'user'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC', 'noreftxt' => 'DESC', 'tglref' => 'DESC'); // default order 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function where_datatables($data)
    {
        $this->data = $data;
    }

    private function _get_datatables_query()
    {
        $filter = $this->data;
        $lokasi = $this->session->userdata('status_lokasi');
        $pt = $this->session->userdata('devisi');
        $kode_dept = $this->session->userdata('kode_dept');


        $this->db_logistik_center->from($this->table);
        if ($lokasi == 'HO') {
            // $this->db_logistik_center->where('kodedept', $kode_dept);
            if ($filter == 'HO') {
                $this->db_logistik_center->where('jenis !=', 'SPPI');
                $this->db_logistik_center->like('noreftxt', 'PST', 'both');
            } elseif ($filter == 'SITE') {
                $this->db_logistik_center->like('noreftxt', 'EST', 'both');
            } elseif ($filter == 'RO') {
                $this->db_logistik_center->like('noreftxt', 'ROM', 'both');
            } elseif ($filter == 'PKS') {
                $this->db_logistik_center->like('noreftxt', 'FAC', 'both');
            }
        } else {
            $this->db_logistik_center->like('pt', $pt);
            $this->db_logistik_center->where('kodedept', $kode_dept);

            if ($lokasi == 'SITE') {
                $this->db_logistik_center->like('noreftxt', 'EST', 'both');
            } elseif ($lokasi == 'PKS') {
                $this->db_logistik_center->like('noreftxt', 'FAC', 'both');
            } elseif ($lokasi == 'RO') {
                $this->db_logistik_center->like('noreftxt', 'ROM', 'both');
            }
        }

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db_logistik_center->group_start();
                    $this->db_logistik_center->like($item, $_POST['search']['value']);
                } else {
                    $this->db_logistik_center->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db_logistik_center->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db_logistik_center->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db_logistik_center->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db_logistik_center->limit($_POST['length'], $_POST['start']);
        $query = $this->db_logistik_center->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db_logistik_center->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db_logistik_center->from($this->table);
        return $this->db_logistik_center->count_all_results();
    }
}

/* End of file M_spp_noCoa.php */
