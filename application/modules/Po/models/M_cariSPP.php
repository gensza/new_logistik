<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_cariSPP extends CI_Model
{
    // 
    var $table = 'ppo'; //nama tabel dari database
    var $column_order = array(null, 'id', 'noppo', 'jenis', 'noreftxt', 'tglppo', 'tglref', 'tglppotxt', 'namadept', 'ket'); //field yang ada di table supplier  
    var $column_search = array('noreftxt', 'tglppo', 'namadept'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $lokasi = $this->session->userdata('status_lokasi');
        $this->db_logistik_pt->from($this->table);
        if ($lokasi == 'SITE') {
            $this->db_logistik_pt->where_in('jenis', array('SPPI', 'SPPA', 'SPPK'));
            $this->db_logistik_pt->where('po', 0);
            $this->db_logistik_pt->where_in('status2', array(1, 2));
            $this->db_logistik_pt->like('noreftxt', 'EST', 'both');
            # code...
        } elseif ($lokasi == 'RO') {
            $this->db_logistik_pt->where_in('jenis', array('SPPI', 'SPPA', 'SPPK'));
            $this->db_logistik_pt->where('po', 0);
            $this->db_logistik_pt->where_in('status2', array(1, 2));
            $this->db_logistik_pt->like('noreftxt', 'ROM', 'both');
            # code...
        } elseif ($lokasi == 'PKS') {
            $this->db_logistik_pt->where_in('jenis', array('SPPI', 'SPPA', 'SPPK'));
            $this->db_logistik_pt->where('po', 0);
            $this->db_logistik_pt->where_in('status2', array(1, 2));
            $this->db_logistik_pt->like('noreftxt', 'FAC', 'both');
            # code...
        }


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
}

/* End of file M_cariSPP.php */
