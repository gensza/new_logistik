<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_brg extends CI_Model
{

    var $table = 'stockawal'; //nama tabel dari database
    var $column_order = array(null,  'kodebar', 'nabar', 'grp', 'satuan', 'txtperiode'); //field yang ada di table supplier  
    var $column_search = array('kodebar', 'nabar', 'grp', 'satuan', 'txtperiode'); //field yang diizin untuk pencarian 
    var $order = array('kodebar' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // public function where_datatables($kodedev)
    // {
    //     $this->kodedev = $kodedev;
    //     // return $nopo;
    // }

    private function _get_datatables_query()
    {
        // $Value = ;

        $txtperiode = $this->session->userdata('ym_periode');

        $this->db_logistik_pt->distinct();
        $this->db_logistik_pt->select('kodebar, nabar, grp, satuan, txtperiode');
        $this->db_logistik_pt->from($this->table);
        // $this->db_logistik_pt->where('txtperiode', $txtperiode);
        $this->db_logistik_pt->group_by('kodebar');


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

/* End of file M_brg.php */
