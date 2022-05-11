<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_detail_spp_no_coa extends CI_Model
{

    var $table = 'item_ppo'; //nama tabel dari database
    var $column_order = array(null, 'id', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'STOK', 'ket', 'grup'); //field yang ada di table supplier  
    var $column_search = array('id', 'noreftxt', 'kodebar', 'nabar', 'sat', 'qty', 'STOK', 'ket'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'ASC'); // default order 



    public function getWhere($noreftxt, $pt, $alias)
    {
        $this->n_r = $noreftxt;
        $this->pt = $pt;




        $this->logistik_pt = $this->load->database('db_logistik_' . $alias, TRUE);
    }

    private function _get_datatables_query()
    {
        $noreftxt = $this->n_r;
        $pt = $this->pt;
        $this->logistik_pt->from($this->table);
        $this->logistik_pt->where(['noreftxt' => $noreftxt, 'namapt' => $pt]);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->logistik_pt->group_start();
                    $this->logistik_pt->like($item, $_POST['search']['value']);
                } else {
                    $this->logistik_pt->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->logistik_pt->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->logistik_pt->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->logistik_pt->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->logistik_pt->limit($_POST['length'], $_POST['start']);
        $query = $this->logistik_pt->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->logistik_pt->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->logistik_pt->from($this->table);
        return $this->logistik_pt->count_all_results();
    }

    public function get_noref($id_ppo)
    {
        $this->db_logistik_center->select('noreftxt');
        $this->db_logistik_center->from('ppo_tmp');
        $this->db_logistik_center->where('id', $id_ppo);
        return $this->db_logistik_center->get()->row_array();
    }
}

/* End of file M_detail_spp_no_coa.php */
