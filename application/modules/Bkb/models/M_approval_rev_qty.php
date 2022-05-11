<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_approval_rev_qty extends CI_Model
{

    var $table = 'approval_bpb'; //nama tabel dari database
    var $column_order = array(null, 'id', 'norefbpb', 'kodebar', 'nabar', 'qty_diminta', 'user_req_rev_qty'); //field yang ada di table supplier  
    var $column_search = array('id', 'norefbpb', 'kodebar', 'nabar', 'qty_diminta', 'user_req_rev_qty'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $role_user = $this->session->userdata('user');

        $this->db_logistik_pt->from($this->table);
        $this->db_logistik_pt->where('flag_req_rev_qty', '1');


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

    public function ktu_approve_rev_qty($id_approval_bpb, $norefbpb, $kodebar, $qty_rev)
    {
        $date = date('Y-m-d H:i:s');
        $this->db_logistik_pt->set('flag_req_rev_qty', '2');
        $this->db_logistik_pt->set('tgl_appr_req_ktu', $date);
        $this->db_logistik_pt->where(['id' => $id_approval_bpb, 'norefbpb' => $norefbpb]);
        $this->db_logistik_pt->update('approval_bpb');

        $this->db_logistik_pt->set('req_rev_qty', '1');
        $this->db_logistik_pt->where('norefbpb', $norefbpb);
        $this->db_logistik_pt->update('bpb');

        $this->db_logistik_pt->set('req_rev_qty_item', '2');
        $this->db_logistik_pt->set('qty_disetujui', $qty_rev);
        $this->db_logistik_pt->where(['norefbpb' => $norefbpb, 'kodebar' => $kodebar]);
        $this->db_logistik_pt->update('bpbitem');

        return true;
    }
}

/* End of file M_approval_rev_qty.php */
