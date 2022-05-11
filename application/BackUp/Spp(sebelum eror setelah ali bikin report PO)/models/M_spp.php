<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_spp extends CI_Model
{
    // Start Data Table Server Side
    var $table = 'kodebar'; //nama tabel dari database
    var $column_order = array(null, 'id', 'kodebar', 'nabar', 'grp', 'satuan'); //field yang ada di table user
    var $column_search = array('id', 'kodebar', 'nabar', 'grp'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

        $this->db_logistik->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db_logistik->group_start();
                    $this->db_logistik->like($item, $_POST['search']['value']);
                } else {
                    $this->db_logistik->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db_logistik->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db_logistik->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db_logistik->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db_logistik->limit($_POST['length'], $_POST['start']);
        $query = $this->db_logistik->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db_logistik->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db_logistik->from($this->table);
        return $this->db_logistik->count_all_results();
    }
    //End Data Table Server Side

    public function cariDevisi()
    {
        $lokasi = $this->session->userdata('status_lokasi');

        if ($lokasi == 'SITE') {
            $this->db_logistik_pt->select('PT, kodetxt');
            $this->db_logistik_pt->where('kodetxt', '06');
            $this->db_logistik_pt->or_where('kodetxt', '07');
            $this->db_logistik_pt->from('pt_copy');
            $this->db_logistik_pt->order_by('kodetxt', 'ASC');
            return $this->db_logistik_pt->get()->result_array();
        } else {
            $this->db_logistik_pt->select('PT, kodetxt');
            $this->db_logistik_pt->from('pt_copy');
            $this->db_logistik_pt->order_by('kodetxt', 'ASC');
            return $this->db_logistik_pt->get()->result_array();
        }
    }

    public function dept()
    {
        $this->db_logistik_pt->select('kode, nama');
        $this->db_logistik_pt->from('dept');
        return $this->db_logistik_pt->get()->result_array();
    }

    public function namaDept($kd_dept)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->where('kode', $kd_dept);
        $this->db_logistik_pt->from('dept');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function stokAwal($kd_bar)
    {
        $this->db_logistik_pt->select_sum('QTY_MASUK', 'qty_masuk');
        $this->db_logistik_pt->where('kodebartxt', $kd_bar);
        $this->db_logistik_pt->from('stockawal');
        return $this->db_logistik_pt->get()->row();
    }

    public function sumMasuk($kd_bar)
    {
        $this->db_logistik_pt->select_sum('qty', 'stokmasuk');
        $this->db_logistik_pt->where('kodebartxt', $kd_bar);
        $this->db_logistik_pt->from('masukitem');
        return $this->db_logistik_pt->get()->row();
    }

    public function sumKeluar($kd_bar)
    {
        $this->db_logistik_pt->select_sum('qty', 'stokkeluar');
        $this->db_logistik_pt->where('kodebartxt', $kd_bar);
        $this->db_logistik_pt->from('keluarbrgitem');
        return $this->db_logistik_pt->get()->row();
    }

    public function saveSpp($data_ppo)
    {
        return $this->db_logistik_pt->insert('ppo', $data_ppo);
    }

    public function saveSpp2($data_item_ppo)
    {
        return $this->db_logistik_pt->insert('item_ppo', $data_item_ppo);
    }

    public function cancelUpdateItemSpp($id_item_ppo, $id_ppo)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where('id', $id_item_ppo);
        $data_item_ppo =  $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('ppo');
        $this->db_logistik_pt->where('id', $id_ppo);
        $data_ppo =  $this->db_logistik_pt->get()->row_array();

        $data_return = [
            'data_item_ppo' => $data_item_ppo,
            'data_ppo' => $data_ppo,
        ];

        return $data_return;
    }

    public function updateSpp($id_ppo, $data_ppo)
    {
        $this->db_logistik_pt->where('id', $id_ppo);
        $this->db_logistik_pt->update('ppo', $data_ppo);
        return TRUE;
    }

    public function updateSpp2($id_item_ppo, $data_item_ppo)
    {
        $this->db_logistik_pt->where('id', $id_item_ppo);
        $this->db_logistik_pt->update('item_ppo', $data_item_ppo);
        return TRUE;
    }

    public function deleteSpp($no_spp)
    {
        $this->db_logistik_pt->delete('ppo', array('noppo' => $no_spp));
        $this->db_logistik_pt->delete('item_ppo', array('noppo' => $no_spp));
        return TRUE;
    }

    public function cari_item_spp($kodebar, $noreftxt)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'noreftxt' => $noreftxt]);
        return $this->db_logistik_pt->get()->num_rows();
    }

    public function urut_cetak($noppo)
    {
        $this->db_logistik_pt->set('main_acct', 'main_acct+1', FALSE);
        $this->db_logistik_pt->where('noppo', $noppo);
        $this->db_logistik_pt->update('ppo');

        $this->db_logistik_pt->select('main_acct');
        $this->db_logistik_pt->from('ppo');
        $this->db_logistik_pt->where('noppo', $noppo);
        return $this->db_logistik_pt->get()->row_array();
    }
}

/* End of file M_spp.php */
