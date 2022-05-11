<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_data_spp_approval extends CI_Model
{

    var $table = 'ppo'; //nama tabel dari database
    var $column_order = array(null, 'id', 'noppotxt', 'noreftxt', 'tglref', 'tglppo', 'tgltrm', 'namadept', 'lokasi', 'ket', 'user'); //field yang ada di table user
    var $column_search = array('noppotxt', 'noreftxt', 'tglref', 'tglppo', 'tgltrm', 'namadept', 'lokasi', 'ket', 'user'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC', 'noreftxt' => 'DESC', 'tglref' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $lokasi = $this->session->userdata('status_lokasi');
        $kode_dev = $this->session->userdata('kode_dev');

        $this->db_logistik_pt->from($this->table);
        if ($lokasi == 'HO') {
            $this->db_logistik_pt->where('jenis !=', 'SPPI');
            $this->db_logistik_pt->like('lokasi', 'HO');
        } elseif ($lokasi == 'SITE') {
            $this->db_logistik_pt->like('noreftxt', 'EST', 'both');
        } elseif ($lokasi == 'PKS') {
            $this->db_logistik_pt->like('noreftxt', 'FAC', 'both');
        } elseif ($lokasi == 'RO') {
            $this->db_logistik_pt->like('noreftxt', 'ROM', 'both');
        }
        $this->db_logistik_pt->where_in('status2', array(0, 2));

        if ($lokasi != 'HO') {
            $this->db_logistik_pt->where('kode_dev', $kode_dev);
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

    public function getDetailSppApproval($noppo)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where('noppotxt', $noppo);
        return $this->db_logistik_pt->get()->result_array();
    }

    public function approval_spp1($id)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->where('no_id_item_ppo', $id);
        $this->db_logistik_pt->from('approval_spp');
        $cek = $this->db_logistik_pt->get()->num_rows();

        if ($cek >= 1) {
            $cek_r = 0;
            return $cek_r;
        } else {
            $this->db_logistik_pt->select('*');
            $this->db_logistik_pt->from('item_ppo');
            $this->db_logistik_pt->where('id', $id);
            $data_item_ppo = $this->db_logistik_pt->get()->row_array();

            $data_insert = [
                'no_id_item_ppo' => $id,
                'noppotxt' => $data_item_ppo['noppotxt'],
                'tglppotxt' => $data_item_ppo['tglppotxt'],
                'noreftxt' => $data_item_ppo['noreftxt'],
                'kodebartxt' => $data_item_ppo['kodebartxt'],
                'nabar' => $data_item_ppo['nabar'],
                'sat' => $data_item_ppo['sat'],
                'qty' => $data_item_ppo['qty'],
                'stok' => $data_item_ppo['STOK'],
                'status' => $data_item_ppo['status'],
                'po' => $data_item_ppo['po'],
                'kodedept' => $data_item_ppo['kodedept'],
                'namadept' => $data_item_ppo['namadept'],
                'dept_head1' => '1',
                'tgl_dept_head1' => date("Y-m-d H:i:s")
            ];

            $data_update_item_ppo = [
                'status' => 'DISETUJUI',
                'status2' => '1',
                'TGL_APPROVE' => date("Y-m-d H:i:s")
            ];

            $this->db_logistik_pt->where('id', $id);
            $this->db_logistik_pt->update('item_ppo', $data_update_item_ppo);

            $this->db_logistik_pt->select_sum('status2', 'sum_status2');
            $this->db_logistik_pt->where('noppotxt', $data_item_ppo['noppotxt']);
            $this->db_logistik_pt->from('item_ppo');
            $return_sum = $this->db_logistik_pt->get()->row();

            $this->db_logistik_pt->select('status2');
            $this->db_logistik_pt->where('noppotxt', $data_item_ppo['noppotxt']);
            $this->db_logistik_pt->from('item_ppo');
            $return_count = $this->db_logistik_pt->count_all_results();

            if ($return_sum->sum_status2 == $return_count) {
                $data_sum_count = [
                    'status' => 'DISETUJUI',
                    'status2' => '1',
                    'TGL_APPROVE' => date("Y-m-d H:i:s")
                ];

                $this->db_logistik_pt->where('noppotxt', $data_item_ppo['noppotxt']);
                $this->db_logistik_pt->update('ppo', $data_sum_count);
            } else {
                $data_sum_count = [
                    'status' => 'SEBAGIAN',
                    'status2' => '2',
                    'TGL_APPROVE' => date("Y-m-d H:i:s")
                ];

                $this->db_logistik_pt->where('noppotxt', $data_item_ppo['noppotxt']);
                $this->db_logistik_pt->update('ppo', $data_sum_count);
            }

            return $this->db_logistik_pt->insert('approval_spp', $data_insert);
        }
    }
}
