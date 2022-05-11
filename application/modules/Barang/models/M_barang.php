<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_barang extends CI_Model
{

    var $table = 'kodebar'; //nama tabel dari database
    var $column_order = array(null, 'id', 'kodebar', 'kodebartxt', 'nabar', 'grp', 'satuan'); //field yang ada di table supplier  
    var $column_search = array('id', 'kodebar', 'kodebartxt', 'nabar', 'grp', 'satuan'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        // $Value = ;
        $this->db_logistik_center->select('id, kodebar, kodebartxt, nabar, grp, satuan');
        $this->db_logistik_center->from('kodebar');
        // $this->db_logistik_center->where('po', 0);
        $this->db_logistik_center->order_by('id', 'desc');


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

    function simpan_master_barang()
    {
        $query_id = "SELECT MAX(id)+1 as no_id FROM kodebar";
        $generate_id = $this->db_logistik_center->query($query_id)->row();
        $no_id = $generate_id->no_id;
        if (empty($no_id)) {
            $no_id = 1;
        }

        $data_master_barang["kodebar"]    = $this->input->post('txt_kd_barang');
        $data_master_barang["kodebartxt"] = $this->input->post('txt_kd_barang');
        $data_master_barang["nabar"]      = $this->input->post('txt_nm_barang');
        $data_master_barang["grp"]        = $this->input->post('cmb_grup_barang');
        $data_master_barang["satuan"]     = $this->input->post('cmb_satuan');
        $data_master_barang["spek"]       = $this->input->post('txt_spesifikasi');
        $data_master_barang["nopart"]     = $this->input->post('txt_nmr_part');
        $data_master_barang["ket"]        = $this->input->post('txt_keterangan');
        $data_master_barang["inputtgl"]   = date("Y-m-d H:i:s");
        $data_master_barang["pt"]         = $this->session->userdata('pt');
        $data_master_barang["kode"]       = $this->session->userdata('kode_pt');

        if (empty($this->input->post('hidden_id'))) {


            $this->db_logistik_center->insert('kodebar', $data_master_barang);
            if ($this->db_logistik_center->affected_rows() > 0) {
                // $bool_master_barang = TRUE;
                return TRUE;
            } else {
                // $bool_master_barang = FALSE;
                return FALSE;
            }
        } else {
            $id = $this->input->post('hidden_id');



            $this->db_logistik_center->set($data_master_barang);
            $this->db_logistik_center->where('id', $id);
            $this->db_logistik_center->update('kodebar');
            // var_dump($this->db_logistik_center->last_query());exit();
            if ($this->db_logistik_center->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
}

/* End of file M_barang.php */
