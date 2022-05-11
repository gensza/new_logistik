<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_lapSpp extends CI_Model
{
    // Start Data Table Server Side
    var $table = 'ppo'; //nama tabel dari database
    var $column_order = array(null, 'id', 'tglppo', 'namadept', 'noreftxt', 'kodedept'); //field yang ada di table user
    var $column_search = array('id', 'tglppo', 'namadept', 'noreftxt'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function data_spp($cmb_devisi, $lap_cmb_bagian, $tglAwal, $tglAkhir)
    {
        // global $nopo;
        $this->cmb_devisi = $cmb_devisi;
        $this->lap_cmb_bagian = $lap_cmb_bagian;
        $this->tglAwal = $tglAwal;
        $this->tglAkhir = $tglAkhir;
        // return $nopo;
    }

    private function _get_datatables_query()
    {
        $devisi = $this->cmb_devisi;
        $bagian = $this->lap_cmb_bagian;

        $tglAwal = $this->tglAwal;
        $tglAkhir = $this->tglAkhir;
        // $tglAwal = "2021-05-26";
        // $tglAkhir = "2021-06-25";

        if ($devisi == 'Semua') {
            if ($bagian == 'Semua') {
                # code...
                $this->db_logistik_pt->from('ppo')
                    ->select('noreftxt, namadept, po, status,kodedept, kode_dev, date(tglppo) as tglppo')
                    ->where("date(tglppo) >=", $tglAwal)
                    ->where("date(tglppo) <=", $tglAkhir);
            } else {
                $this->db_logistik_pt->from('ppo')
                    ->select('noreftxt, namadept, po, status,kodedept, kode_dev, date(tglppo) as tglppo')
                    ->where("kodedept", $bagian)
                    ->where("date(tglppo) >=", $tglAwal)
                    ->where("date(tglppo) <=", $tglAkhir);
                # code...
            }
        } else {
            if ($bagian == 'Semua') {
                # code...
                $this->db_logistik_pt->from('ppo')
                    ->select('noreftxt, namadept, po, status,kodedept, kode_dev, date(tglppo) as tglppo')
                    ->where("kode_dev", $devisi)
                    ->where("date(tglppo) >=", $tglAwal)
                    ->where("date(tglppo) <=", $tglAkhir);
            } else {
                $this->db_logistik_pt->from('ppo')
                    ->select('noreftxt, namadept, po, status,kodedept, kode_dev, date(tglppo) as tglppo')
                    ->where("kode_dev", $devisi)
                    ->where("kodedept", $bagian)
                    ->where("date(tglppo) >=", $tglAwal)
                    ->where("date(tglppo) <=", $tglAkhir);
                # code...
            }
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
    //End Data Table Server Side

}

/* End of file M_lapSpp.php */
