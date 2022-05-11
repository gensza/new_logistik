<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_po extends CI_Model
{
    var $table = 'item_ppo'; //nama tabel dari database
    var $column_order = array(null, 'id', 'noppo', 'tglppo', 'noreftxt', 'qty', 'namadept', 'kodebar', 'nabar', 'ket'); //field yang ada di table supplier  
    var $column_search = array('tglppo', 'noreftxt',  'namadept', 'kodebar', 'nabar'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function where_datatables($id, $kodedev)
    {
        // global $nopo;
        $this->id = $id;
        $this->kodedev = $kodedev;
        // return $nopo;
    }


    private function _get_datatables_query()
    {
        // $Value = ;
        // $lokasi = $this->session->userdata('status_lokasi');

        // $this->db_logistik_pt->where('LOKASI', $lokasi);
        $lokasi = $this->id;
        $kodedev = $this->kodedev;

        $this->db_logistik_pt->from($this->table);
        $this->db_logistik_pt->where('po', 0);
        $this->db_logistik_pt->where('status2', 1);
        $this->db_logistik_pt->where('jenis !=', 'SPPI');
        // $this->db_logistik_pt->where('LOKASI', $lokasi);
        $this->db_logistik_pt->where('kode_dev', $kodedev);
        // if ($lokasi == "PKS") {

        //     $this->db_logistik_pt->where('po', 0);
        //     $this->db_logistik_pt->where('status2', 1);
        //     $this->db_logistik_pt->where('jenis !=', 'SPPI');
        //     $this->db_logistik_pt->where('LOKASI', $lokasi);
        //     $this->db_logistik_pt->where('kode_dev', $kodedev);
        // } elseif ($lokasi == "SITE") {


        //     $this->db_logistik_pt->where('po', 0);
        //     $this->db_logistik_pt->where('status2', 1);
        //     $this->db_logistik_pt->where('jenis !=', 'SPPI');
        //     $this->db_logistik_pt->where('LOKASI', $lokasi);
        //     $this->db_logistik_pt->where('kode_dev', $kodedev);
        //     # code...
        // } elseif ($lokasi == "RO") {


        //     $this->db_logistik_pt->where('po', 0);
        //     $this->db_logistik_pt->where('status2', 1);
        //     $this->db_logistik_pt->where('jenis !=', 'SPPI');
        //     $this->db_logistik_pt->where('LOKASI', $lokasi);
        //     $this->db_logistik_pt->where('kode_dev', $kodedev);
        //     # code...
        // } else {

        //     $this->db_logistik_pt->where('po', 0);
        //     $this->db_logistik_pt->where('status2', 1);
        //     $this->db_logistik_pt->where('jenis !=', 'SPPI');
        //     $this->db_logistik_pt->where('kode_dev', $kodedev);
        // }



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

    public function cekdata($refspp)
    {
        $data1 = $this->db_logistik_pt->query("SELECT noreftxt, COUNT(id) AS jmlhSPP1 FROM item_ppo WHERE noreftxt='$refspp' AND po='0'")->row_array();
        $data2 = $this->db_logistik_pt->query("SELECT noreftxt, COUNT(id) AS jmlhSPP2 FROM item_ppo WHERE noreftxt='$refspp' AND po='1'")->row_array();

        $data_return = [
            'data1' => $data1,
            'data2' => $data2,
            'noref' => $data1
        ];

        return $data_return;
    }

    public function konfirbatal($noref_po, $alasan)
    {
        $data = array('batal' => 1, 'alasan_batal' => $alasan);
        $this->db_logistik_pt->where('noreftxt', $noref_po);
        $this->db_logistik_pt->update('po', $data);
        return TRUE;
    }
    public function updatePPO2($refspp, $data_ppo)
    {
        $this->db_logistik_pt->where('noreftxt', $refspp);
        $this->db_logistik_pt->update('ppo', $data_ppo);
        return TRUE;
    }
    public function updatePPO3($refspp, $kodebar, $data_itemppo)
    {
        $this->db_logistik_pt->where(['noreftxt' => $refspp, 'kodebar' => $kodebar]);
        $this->db_logistik_pt->update('item_ppo', $data_itemppo);
        return TRUE;
    }

    public function get_detail_ppo($no_spp, $no_ref_spp)
    {
        $query = "SELECT id, noppo, noppotxt, tglppo, noref, noreftxt, tglref, tglppo, tgltrm,devisi, kodedept, namadept, ket, pt, kodept, lokasi, status, status2, po, jenis FROM ppo WHERE noppo = '$no_spp' AND noreftxt = '$no_ref_spp' ORDER BY id DESC";
        $data = $this->db_logistik_pt->query($query);
        return $data;
    }

    public function get_detail_item_ppo($id, $no_ref_spp, $kodebar)
    {
        $query = "SELECT id, noppo, noppotxt, tglppo, noref, noreftxt, kodebartxt, nabar, tglppo, qty, qty2, kodedept, namadept, ket, kodept, namapt, lokasi, status, status2, po, sat FROM item_ppo WHERE id = '$id' AND noreftxt = '$no_ref_spp' AND kodebartxt = '$kodebar' ORDER BY id DESC";
        $data = $this->db_logistik_pt->query($query);
        return $data;
    }

    public function get_supplier()
    {
        $supplier = "SELECT kode, supplier FROM supplier ORDER BY id DESC";
        $query = $this->db_logistik_center->query($supplier)->result_array();
        return $query;
    }

    public function get_sup()
    {
        // $query = "SELECT id_aset,nama_aset,id_kat_non FROM tb_non_aset WHERE id_kat_non = '" . $this->input->post('id') . "'";
        $toko = $this->input->get('toko');
        $query = "SELECT id, kode, supplier FROM supplier WHERE supplier LIKE '%$toko%'";
        $t = $this->db_logistik_center->query($query)->result_array();
        return $t;
    }

    public function get_spp()
    {
        $noref = $this->input->get('noref');
        $tgl = $this->input->get('tgl');
        $query = "SELECT id, noppo, jenis, noreftxt, tglppo, tglref, tglppotxt, namadept FROM ppo WHERE jenis = 'SPPI' AND po='0' AND (noreftxt LIKE '%$noref%' OR tglppo LIKE '%$tgl%') ORDER BY id DESC";
        $d = $this->db_logistik_pt->query($query)->result_array();
        return $d;
    }

    public function get_id($idspp, $noreftxt)
    {
        $query = "SELECT p.*,p.id as id_spp,i.*,i.status2 as statusaprove, i.ket as ket_item_spp FROM ppo p LEFT JOIN item_ppo i ON p.noreftxt = i.noreftxt WHERE i.noreftxt='$noreftxt' AND i.po = '0' AND i.jenis != 'SPP'";
        $data = $this->db_logistik_pt->query($query)->result_array();
        return $data;
    }

    public function cek_qty($id_item_spp)
    {
        $data = $this->db_logistik_pt->query("SELECT qty, qty2 FROM item_ppo WHERE id='$id_item_spp'")->row();
        return $data;
    }

    public function get_itemppo()
    {
        $query = "SELECT * FROM item_ppo WHERE id = '" . $this->input->post('id') . "'";
        $data = $this->db_logistik_pt->query($query)->result_array();
        return $data;
    }

    public function namaDept($kd_dept)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->where('kode', $kd_dept);
        $this->db_logistik_pt->from('dept');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function updatePO($no_id, $dataupdate)
    {
        $this->db_logistik_pt->where('id', $no_id);
        $this->db_logistik_pt->update('po', $dataupdate);

        return TRUE;
    }
    public function updateItem($no_id_item, $dataupdateitem)
    {
        $this->db_logistik_pt->where('id', $no_id_item);
        return $this->db_logistik_pt->update('item_po',  $dataupdateitem);
    }
    public function updatePPO($id_ppo, $ppo)
    {
        $this->db_logistik_pt->where('id', $id_ppo);
        $this->db_logistik_pt->update('item_ppo',  $ppo);

        return TRUE;
    }
    public function updatePPO4($id_ppo, $ppo)
    {
        $this->db_logistik_pt->where('noreftxt', $id_ppo);
        $this->db_logistik_pt->update('item_ppo',  $ppo);

        return TRUE;
    }

    function update_alasan($noref_ppo, $alasan)
    {
        $data = array('alasan_batal' => $alasan);
        $this->db_logistik_pt->where('noreftxt', $noref_ppo);
        $this->db_logistik_pt->update('po', $data);
        return TRUE;
    }
    function update_ppn($nilai)
    {
        $data = array('ppn' => $nilai);
        $this->db_logistik_center->where('id', 1);
        $this->db_logistik_center->update('tb_ppn', $data);
        return TRUE;
    }
    public function editPPO($no_id, $ppo)
    {
        $this->db_logistik_pt->where('id', $no_id);
        $this->db_logistik_pt->update('ppo',  $ppo);

        return TRUE;
    }

    public function cancelUpdateItemPO($id_po_item, $id_po)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('item_po');
        $this->db_logistik_pt->where('id', $id_po_item);
        $data_item_po =  $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('po');
        $this->db_logistik_pt->where('noreftxt', $id_po);
        $data_po =  $this->db_logistik_pt->get()->row_array();

        $data_return = [
            'data_item_po' => $data_item_po,
            'data_po' => $data_po,
        ];

        return $data_return;
    }

    public function cancelItemPO($id_po_item)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('item_po');
        $this->db_logistik_pt->where('id', $id_po_item);
        $data_item_po =  $this->db_logistik_pt->get()->row_array();
        return $data_item_po;
    }

    public function deletePO($norefpo)
    {
        $this->db_logistik_pt->delete('po', array('noreftxt' => $norefpo));
        $this->db_logistik_pt->delete('item_po', array('noref' => $norefpo));
        return TRUE;
    }

    public function batalPO($id_po, $norefpo)
    {
        $this->db_logistik_pt->delete('po', array('id' => $id_po, 'noreftxt' => $norefpo));
        $this->db_logistik_pt->delete('item_po', array('noref' => $norefpo));
        return TRUE;
    }

    public function cari_item_po($kodebar, $qty, $ket)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('item_po');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'qty' => $qty, 'ket' => $ket]);
        return $this->db_logistik_pt->get()->num_rows();
    }

    public function cari_po_edit($nopo, $refspp)
    {
        $this->db_logistik_pt->select('*, date(tglppo) as tglspp, date(tglpo) as tgl_po');
        $this->db_logistik_pt->from('po');
        $this->db_logistik_pt->where('noreftxt', $nopo);
        $po = $this->db_logistik_pt->get()->row_array();

        // $this->db_logistik_pt->select('*');
        // $this->db_logistik_pt->from('item_po');
        // $this->db_logistik_pt->where('noref', $nopo);
        // $item_po = $this->db_logistik_pt->get()->result_array();

        $item_po = $this->db_logistik_pt->query("SELECT p.*, s.qty2 FROM item_po p LEFT JOIN item_ppo s ON p.id_item_spp=s.id WHERE p.noref='$nopo'")->result_array();


        $data = [
            'po' => $po,
            'item_po' => $item_po,
        ];

        return $data;
    }

    public function cariDevisi()
    {
        $lokasi = $this->session->userdata('status_lokasi');

        if ($lokasi == 'SITE') {
            $this->db_logistik_pt->select('PT, kodetxt');
            $this->db_logistik_pt->where('lokasi', 'SITE');
            $this->db_logistik_pt->from('tb_devisi');
            $this->db_logistik_pt->order_by('lokasi', 'ASC');
            return $this->db_logistik_pt->get()->result_array();
        } else {
            $this->db_logistik_pt->select('PT, kodetxt');
            $this->db_logistik_pt->from('tb_devisi');
            $this->db_logistik_pt->order_by('lokasi', 'ASC');
            return $this->db_logistik_pt->get()->result_array();
        }
    }

    function cek_devisi($kode_dev)
    {
        $query = $this->db_logistik_pt->query("SELECT kodetxt, PT FROM tb_devisi WHERE kodetxt='$kode_dev'")->row();
        return $query;
    }

    public function cari_po($norefpo, $norefppo, $kodebar, $new_jumharga)
    {
        $this->db_logistik_pt->select('jumharga');
        $this->db_logistik_pt->where(['noref' => $norefpo, 'refppo' => $norefppo, 'kodebar' => $kodebar]);
        $this->db_logistik_pt->from('item_po');
        $data = $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select_sum('jumharga');
        $this->db_logistik_pt->where(['noref' => $norefpo]);
        $this->db_logistik_pt->from('item_po');
        $sum_jumharga = $this->db_logistik_pt->get()->row();

        if ($data['jumharga'] > $new_jumharga) {
            $kurangin_awal = $data['jumharga'] - $new_jumharga;
            $totjum = $sum_jumharga->jumharga - $kurangin_awal;
        } elseif ($data['jumharga'] < $new_jumharga) {
            $kurangin_awal = $new_jumharga - $data['jumharga'];
            $totjum = $sum_jumharga->jumharga + $kurangin_awal;
        } else {
            $totjum = $data['jumharga'];
        }
        return $totjum;
    }


    function cek_lpb($noref)
    {
        $query = $this->db_logistik_pt->query("SELECT noreftxt, sudah_lpb FROM po WHERE noreftxt='$noref'")->row();

        if ($query !== 0) {
            $data = [
                'status' => true
            ];
        } else {
            $data = [
                'status' => false
            ];
        }

        return $data;
    }
    function cek_isi($noref)
    {
        $query = $this->db_logistik_pt->query("SELECT noreftxt, sudah_lpb FROM po WHERE noreftxt='$noref'")->row();

        if ($query !== 0) {
            $data = [
                'status' => true
            ];
        } else {
            $data = [
                'status' => false
            ];
        }

        return $data;
    }


    function cari_noref_itempo($noref_po)
    {
        $this->db_logistik_pt->select('noref');
        $this->db_logistik_pt->from('item_po');
        $this->db_logistik_pt->where(['noref' => $noref_po]);
        return $this->db_logistik_pt->get()->num_rows();
    }

    function update_qty2_item_ppo($hasil_qty, $norefppo, $kodebar)
    {
        $this->db_logistik_pt->where(['noreftxt' => $norefppo, 'kodebar' => $kodebar]);
        $this->db_logistik_pt->set('qty2', $hasil_qty);
        $this->db_logistik_pt->update('item_ppo');
    }
}

/* End of file M_po.php */
