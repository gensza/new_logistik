<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Retur_m extends CI_Model
{

    // Start Data Table Server Side
    var $table = 'retskb'; //nama tabel dari database
    var $column_order = array(null, 'id', 'norefretur', 'noretur', 'tgl', 'bag', 'devisi', 'keterangan'); //field yang ada di table user
    var $column_search = array('id', 'norefretur', 'noretur', 'tgl', 'bag', 'devisi', 'keterangan'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getdata($cmb_devisi, $tanggalAwal, $tanggalAkhir)
    {
        $this->cmb_devisi = $cmb_devisi;
        $this->tanggalAwal = $tanggalAwal;
        $this->tanggalAkhir = $tanggalAkhir;
    }

    private function _get_datatables_query()
    {
        $devisi = $this->cmb_devisi;

        $tglAwal = $this->tanggalAwal;
        $tglAkhir = $this->tanggalAkhir;

        $this->db_logistik_pt->from($this->table)
            ->where("kode_dev", $devisi)
            ->where("date(tgl) >=", $tglAwal)
            ->where("date(tgl) <=", $tglAkhir);

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


    public function urut_cetak($norefretur)
    {
        $this->db_logistik_pt->set('cetak', 'cetak+1', FALSE);
        $this->db_logistik_pt->where('norefretur', $norefretur);
        $this->db_logistik_pt->update('retskb');

        $this->db_logistik_pt->select('cetak');
        $this->db_logistik_pt->where('norefretur', $norefretur);
        $this->db_logistik_pt->from('retskb');
        return $this->db_logistik_pt->get()->row_array();
    }
}

/* End of file Retur_m.php */
