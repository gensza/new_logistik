<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_data_spp extends CI_Model
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

    public function where_datatables($data)
    {
        $this->data = $data;
    }

    private function _get_datatables_query()
    {
        $filter = $this->data;
        $lokasi = $this->session->userdata('status_lokasi');
        $kode_dev = $this->session->userdata('kode_dev');
        $kode_dept = $this->session->userdata('kode_dept');


        $this->db_logistik_pt->from($this->table);
        $this->db_logistik_pt->where_in('status2', array(0, 1, 2, 3, 4, 5, 6, 7, 8));
        if ($lokasi == 'HO') {
            $this->db_logistik_pt->where('kodedept', $kode_dept);
            if ($filter == 'HO') {
                $this->db_logistik_pt->where('jenis !=', 'SPPI');
                $this->db_logistik_pt->like('noreftxt', 'PST', 'both');
            } elseif ($filter == 'SITE') {
                $this->db_logistik_pt->like('noreftxt', 'EST', 'both');
            } elseif ($filter == 'RO') {
                $this->db_logistik_pt->like('noreftxt', 'ROM', 'both');
            } elseif ($filter == 'PKS') {
                $this->db_logistik_pt->like('noreftxt', 'FAC', 'both');
            }
        } else {
            // $this->db_logistik_pt->where('kode_dev', $kode_dev);
            $this->db_logistik_pt->where('kodedept', $kode_dept);

            if ($lokasi == 'SITE') {
                $this->db_logistik_pt->like('noreftxt', 'EST', 'both');
            } elseif ($lokasi == 'PKS') {
                $this->db_logistik_pt->like('noreftxt', 'FAC', 'both');
            } elseif ($lokasi == 'RO') {
                $this->db_logistik_pt->like('noreftxt', 'ROM', 'both');
            }
        }
        // $this->db_logistik_pt->select('id, noppotxt, noreftxt, tglref,tglppo,tgltrm,namadept,lokasi,ket,user');
        // $this->db_logistik_pt->order_by('id', 'desc');

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

    public function getDetailSpp($noppo)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where('noppotxt', $noppo);
        return $this->db_logistik_pt->get()->result_array();
    }

    public function cari_spp_edit($id_ppo)
    {
        $this->db_logistik_pt->select('id, noref, noreftxt, kodedept, namadept, periode, kode_dev, tglppo, status2');
        $this->db_logistik_pt->from('ppo');
        $this->db_logistik_pt->where('id', $id_ppo);
        $ppo = $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select('kodebar, nabar,qty, STOK, sat, ket, noref, noreftxt, id, status2');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where('noreftxt', $ppo['noreftxt']);
        $item_ppo = $this->db_logistik_pt->get()->result_array();

        $data = [
            'ppo' => $ppo,
            'item_ppo' => $item_ppo
        ];

        return $data;
    }
}
