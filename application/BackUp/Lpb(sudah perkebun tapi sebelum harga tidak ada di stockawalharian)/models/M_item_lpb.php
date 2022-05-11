<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_item_lpb extends CI_Model
{

    // // start server side table
    // // var $nopo = 3300004;
    // // var $nopo = $this->input->post('nopo');
    // var $table = 'item_po'; //nama tabel dari database
    // var $column_order = array(null, 'kodebar', 'nabar', 'qty', 'sat', 'ket'); //field yang ada di table user
    // var $column_search = array('kodebar', 'nabar', 'qty', 'sat', 'ket'); //field yang diizin untuk pencarian 
    // var $order = array('id' => 'desc'); // default order 

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->database();
    // }

    // public function where_datatables($nopo)
    // {
    //     // global $nopo;
    //     $this->no_po = $nopo;
    //     // return $nopo;
    // }

    // private function _get_datatables_query()
    // {
    //     $eee = $this->no_po;
    //     // $nopo = $this->input->post('nopo');
    //     $this->db_logistik_pt->from($this->table);
    //     $this->db_logistik_pt->where('nopo', $eee);
    //     // $this->db_logistik_pt->select('id', 'tglpo', 'noreftxt', 'nopotxt', 'nama_supply', 'lokasi_beli');
    //     // $this->db_logistik_pt->from('po');
    //     // $this->db_logistik_pt->order_by('id', 'desc');

    //     $i = 0;

    //     foreach ($this->column_search as $item) // looping awal
    //     {
    //         if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
    //         {

    //             if ($i === 0) // looping awal
    //             {
    //                 $this->db_logistik_pt->group_start();
    //                 $this->db_logistik_pt->like($item, $_POST['search']['value']);
    //             } else {
    //                 $this->db_logistik_pt->or_like($item, $_POST['search']['value']);
    //             }

    //             if (count($this->column_search) - 1 == $i)
    //                 $this->db_logistik_pt->group_end();
    //         }
    //         $i++;
    //     }

    //     if (isset($_POST['order'])) {
    //         $this->db_logistik_pt->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    //     } else if (isset($this->order)) {
    //         $order = $this->order;
    //         $this->db_logistik_pt->order_by(key($order), $order[key($order)]);
    //     }
    // }

    // function get_datatables()
    // {
    //     $this->_get_datatables_query();
    //     if ($_POST['length'] != -1)
    //         $this->db_logistik_pt->limit($_POST['length'], $_POST['start']);
    //     $query = $this->db_logistik_pt->get();
    //     return $query->result();
    // }

    // function count_filtered()
    // {
    //     $this->_get_datatables_query();
    //     $query = $this->db_logistik_pt->get();
    //     return $query->num_rows();
    // }

    // public function count_all()
    // {
    //     $this->db_logistik_pt->from($this->table);
    //     return $this->db_logistik_pt->count_all_results();
    // }
    // // end server side table

    // public function sumqty($kodebar, $nopo)
    // {
    //     $this->db_logistik_pt->select_sum('qty', 'qty_lpb');
    //     $this->db_logistik_pt->where(['batal !=' => 1, 'kodebar' => $kodebar, 'nopo' => $nopo]);
    //     $this->db_logistik_pt->from('masukitem');
    //     return $this->db_logistik_pt->get()->row();
    // }

    public function saveLpb($data_stokmasuk)
    {
        return $this->db_logistik_pt->insert('stokmasuk', $data_stokmasuk);
    }

    public function saveLpb2($data_masukitem)
    {
        return $this->db_logistik_pt->insert('masukitem', $data_masukitem);
    }
}

/* End of file M_item_lpb.php */
