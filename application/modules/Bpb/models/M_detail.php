<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_detail extends CI_Model
{

    var $table = 'bpbitem'; //nama tabel dari database
    var $column_order = array(null, 'id', 'norefbpb', 'nabar', 'kodebar', 'devisi', 'qty'); //field yang ada di table supplier  
    var $column_search = array('nabar', 'kodebar', 'devisi'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function where_datatables($id)
    {
        // global $nopo;
        $this->id = $id;
        // return $nopo;
    }


    private function _get_datatables_query()
    {

        $eee = $this->id;
        // $Value = ;
        $lokasi_sesi = $this->session->userdata('status_lokasi');
        // $user = $this->session->userdata('user');
        $this->db_logistik_pt->from($this->table);
        $this->db_logistik_pt->where('norefbpb', $eee);
        $this->db_logistik_pt->order_by('id', 'desc');


        // $d = "SELECT p.id, p.no_refppo , p.nopo, p.tglpo, p.nama_supply, i.nabar, i.nopo, p.ket, p.terbayar FROM po p LEFT JOIN item_po i ON p.nopo = i.nopo ORDER BY p.id DESC";
        // $this->db_logistik_pt->query($d);


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

/* End of file M_detail.php */
