<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_detail_sppNoCoa extends CI_Model
{

    var $table = 'item_ppo_tmp'; //nama tabel dari database
    var $column_order = array(null, 'id', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'STOK', 'ket', 'grup'); //field yang ada di table supplier  
    var $column_search = array('id', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'STOK', 'ket'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'ASC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getWhere($noreftxt)
    {
        $this->n_r = $noreftxt;
    }

    private function _get_datatables_query()
    {
        $noreftxt = $this->n_r;
        $this->db_logistik_center->from($this->table);
        $this->db_logistik_center->where('noreftxt', $noreftxt);

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

    public function get_noref($id_ppo)
    {
        $this->db_logistik_center->select('noreftxt');
        $this->db_logistik_center->from('ppo_tmp');
        $this->db_logistik_center->where('id', $id_ppo);
        return $this->db_logistik_center->get()->row_array();
    }
}

/* End of file M_detail_sppNoCoa.php */
