<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dataPP extends CI_Model
{

    var $table = 'pp'; //nama tabel dari database
    var $column_order = array(null, 'id', 'nopptxt', 'nopotxt', 'ref_pp', 'user', 'tglpp', 'tglpo', 'ref_po', 'kode_supplytxt', 'nama_supply', 'kepada', 'bayar', 'KURS', 'jumlah', 'jumlahpo', 'total_po', 'terbilang', 'ket', 'pt', 'kodept', 'periode', 'user', 'tglisi', 'status_vou', 'no_voutxt', 'tgl_vou', 'kasir_bayar', 'grup', 'batal'); //field yang ada di table supplier  
    var $column_search = array('ref_pp', 'tglpp', 'tglpo', 'ref_po', 'nama_supply'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function where_datatables($data)
    {
        // global $nopo;
        $this->data = $data;
        // return $nopo;
    }

    private function _get_datatables_query()
    {
        // $Value = ;
        $data = $this->data;
        $txtperiode = $this->session->userdata('ym_periode');
        $lokasi_sesi = $this->session->userdata('status_lokasi');
        $kodept = $this->session->userdata('kode_dev');

        if ($lokasi_sesi == 'HO') {
            $this->db_logistik_pt->from($this->table);
            if ($data == 'HO') {
                $this->db_logistik_pt->where('kodept', '01');
            } elseif ($data == 'SITE') {
                $this->db_logistik_pt->where('kodept', '06');
            } elseif ($data == 'PKS') {
                $this->db_logistik_pt->where('kodept', '03');
            } elseif ($data == 'RO') {
                $this->db_logistik_pt->where('kodept', '02');
            } else {
                $this->db_logistik_pt->where('txtperiode', $txtperiode);
            }
            // $this->db_logistik_pt->like('ref_po', 'PST', 'both');
            // $this->db_logistik_pt->where('kodept', $kodept);
        } else {
            # code...
            $this->db_logistik_pt->from($this->table);
            $this->db_logistik_pt->where('txtperiode', $txtperiode);
            // $this->db_logistik_pt->like('ref_po', 'EST', 'both');
            $this->db_logistik_pt->where('kodept', $kodept);
            // if ($lokasi_sesi == 'SITE') {
            //     # code...
            // } else if ($lokasi_sesi == 'PKS') {
            //     $this->db_logistik_pt->where('txtperiode', $txtperiode);
            //     // $this->db_logistik_pt->like('ref_po', 'FAC', 'both');
            //     $this->db_logistik_pt->where('kodept', $kodept);

            //     # code...
            // } else if ($lokasi_sesi == 'RO') {
            //     $this->db_logistik_pt->where('txtperiode', $txtperiode);
            //     // $this->db_logistik_pt->like('ref_po', 'ROM', 'both');
            //     $this->db_logistik_pt->where('kodept', $kodept);

            //     # code...
            // }
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
}

/* End of file M_dataPP.php */
