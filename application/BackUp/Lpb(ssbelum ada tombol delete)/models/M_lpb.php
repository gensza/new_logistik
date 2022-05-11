<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_lpb extends CI_Model
{
    // start server side table
    var $table = 'stokmasuk'; //nama tabel dari database
    var $column_order = array(null, 'ttg', 'noref', 'nopo', 'refpo', 'nama_supply', 'ket', 'tglinput', 'USER', 'mutasi'); //field yang ada di table user
    var $column_search = array('ttg', 'noref', 'nopo', 'refpo', 'nama_supply', 'ket', 'tglinput', 'USER', 'mutasi'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $role_user = $this->session->userdata('user');
        $this->db_logistik_pt->from($this->table);
        $this->db_logistik_pt->where('user', $role_user);
        // $this->db_logistik_pt->select('id', 'tglpo', 'noreftxt', 'nopotxt', 'nama_supply', 'lokasi_beli');
        // $this->db_logistik_pt->from('po');
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
    // end server side table

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

    public function get_data_po_qr($noref)
    {
        $this->db_logistik_pt->select('tglpo, noreftxt, nopotxt, nama_supply, kode_supply, lokasi_beli, tglppo, no_refppo');
        $this->db_logistik_pt->where('noreftxt', $noref);
        $this->db_logistik_pt->from('po');
        $data_po = $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select('kodebar, nabar, qty, sat, ket, status_item_lpb, refppo');
        $this->db_logistik_pt->where('noref', $noref);
        $this->db_logistik_pt->from('item_po');
        $data_item_po = $this->db_logistik_pt->get()->result_array();

        $d_return = [
            'data_po' => $data_po,
            'data_item_po' => $data_item_po
        ];
        return $d_return;
    }

    public function sumqty($kodebar, $noreftxt, $qty, $refppo)
    {
        $this->db_logistik_pt->select_sum('qty', 'qty_lpb');
        $this->db_logistik_pt->where(['BATAL !=' => 1, 'kodebar' => $kodebar, 'refpo' => $noreftxt, 'norefppo' => $refppo]);
        $this->db_logistik_pt->from('masukitem');
        $sumqty_lpb = $this->db_logistik_pt->get()->row();

        $result = $qty - $sumqty_lpb->qty_lpb;
        return $result;
    }

    public function get_nopo()
    {
        // $query = "SELECT id_aset,nama_aset,id_kat_non FROM tb_non_aset WHERE id_kat_non = '" . $this->input->post('id') . "'";
        $lokasi = $this->session->userdata('status_lokasi');

        $noref = $this->input->get('noref');
        if ($lokasi == 'SITE') {
            $query = "SELECT noreftxt FROM po WHERE noreftxt LIKE '%$noref%' AND status_lpb = 0 AND lokasi = 'SITE' ORDER BY id DESC";
        } else {
            $query = "SELECT noreftxt FROM po WHERE noreftxt LIKE '%$noref%' AND status_lpb = 0 ORDER BY id DESC";
        }

        return $this->db_logistik_pt->query($query)->result_array();
    }

    // public function get_data_after_save($nopotxt, $no_lpb)
    // {

    //     $this->db_logistik_pt->select('kodebar, nabar, qty, sat, ket, nopotxt');
    //     $this->db_logistik_pt->where('nopotxt', $nopotxt);
    //     $this->db_logistik_pt->from('item_po');
    //     $this->db_logistik_pt->order_by('nopotxt', 'ASC');
    //     $data_item_po = $this->db_logistik_pt->get()->result_array();

    //     $this->db_logistik_pt->select('kodebar, ASSET, nabar, satuan, grp, qty, ket');
    //     $this->db_logistik_pt->where('nopotxt', $nopotxt);
    //     $this->db_logistik_pt->where('ttg', $no_lpb);
    //     $this->db_logistik_pt->order_by('nopotxt', 'ASC');
    //     $this->db_logistik_pt->from('masukitem');
    //     $data_item_lpb = $this->db_logistik_pt->get()->result_array();

    //     $d_return = [
    //         'data_item_po' => $data_item_po,
    //         'data_item_lpb' => $data_item_lpb
    //     ];
    //     return $d_return;
    // }

    public function updateLpb($data_item_lpb, $id)
    {
        $this->db_logistik_pt->where('id', $id);
        return $this->db_logistik_pt->update('masukitem', $data_item_lpb);
    }

    public function cancelUpdateItemLpb($id_item_lpb)
    {
        $this->db_logistik_pt->select('ASSET, qty, ket');
        $this->db_logistik_pt->from('masukitem');
        $this->db_logistik_pt->where('id', $id_item_lpb);
        return $this->db_logistik_pt->get()->row_array();
    }

    // public function get_detail_item_lpb($no_lpb)
    // {
    //     $this->db_logistik_pt->select('kodebar, nabar, satuan, grp, ket, qty, nopo');
    //     $this->db_logistik_pt->from('masukitem');
    //     $this->db_logistik_pt->where('ttg', $no_lpb);
    //     return $this->db_logistik_pt->get()->result_array();
    // }

    public function cari_lpb_edit($id_stokmasuk)
    {
        $this->db_logistik_pt->select('nopo, refpo, nama_supply, kode_supply, tgl, lokasi_gudang, no_pengtr, noref, ttgtxt, ket, kode_dev');
        $this->db_logistik_pt->from('stokmasuk');
        $this->db_logistik_pt->where('id', $id_stokmasuk);
        $data_lpb = $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select('kodebar, ASSET, nabar, satuan, grp, qtypo, qty, ket, id, txtperiode, norefppo');
        $this->db_logistik_pt->where('noref', $data_lpb['noref']);
        $this->db_logistik_pt->from('masukitem');
        $data_item_lpb = $this->db_logistik_pt->get()->result_array();

        $data = [
            'data_lpb' => $data_lpb,
            'data_item_lpb' => $data_item_lpb
        ];
        return $data;
    }

    // public function cariQtyPo($refpo, $kodebar)
    // {
    //     $this->db_logistik_pt->select('qty');
    //     $this->db_logistik_pt->where(['noref' => $refpo, 'kodebar' => $kodebar]);
    //     $this->db_logistik_pt->from('item_po');
    //     return $this->db_logistik_pt->get()->row_array();
    // }

    public function sumqty_edit($kodebar, $refpo, $norefppo)
    {
        $this->db_logistik_pt->select('qty');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'noref' => $refpo, 'refppo' => $norefppo]);
        $this->db_logistik_pt->from('item_po');
        $qty_po = $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select_sum('qty', 'qty_lpb');
        $this->db_logistik_pt->where(['BATAL !=' => 1, 'kodebar' => $kodebar, 'refpo' => $refpo, 'norefppo' => $norefppo]);
        $this->db_logistik_pt->from('masukitem');
        $sumqty_lpb = $this->db_logistik_pt->get()->row();

        $result = $qty_po['qty'] - $sumqty_lpb->qty_lpb;
        return $result;
    }

    // public function getQtyPo($kodebar, $noref)
    // {
    //     $this->db_logistik_pt->select('qty');
    //     $this->db_logistik_pt->where(['kodebar' => $kodebar, 'noref' => $noref]);
    //     $this->db_logistik_pt->from('item_po');
    //     return $this->db_logistik_pt->get()->row_array();
    // }

    // public function getQtyMutasi($kodebar, $noref)
    // {
    //     $this->db_logistik_center->select('qty2');
    //     $this->db_logistik_center->where(['kodebar' => $kodebar, 'NO_REF' => $noref]);
    //     $this->db_logistik_center->from('tb_mutasi_item');
    //     return $this->db_logistik_center->get()->row_array();
    // }

    public function get_sisa_lpb($kodebar, $refpo, $norefppo)
    {
        $this->db_logistik_pt->select_sum('qty', 'qty_lpb');
        $this->db_logistik_pt->where(['BATAL !=' => 1, 'kodebar' => $kodebar, 'refpo' => $refpo, 'norefppo' => $norefppo]);
        $this->db_logistik_pt->from('masukitem');
        return $this->db_logistik_pt->get()->row();
    }

    // public function getSisaLpb($qty_po, $kodebar, $no_lpb)
    // {
    //     $this->db_logistik_pt->select_sum('qty', 'qty_lpb');
    //     $this->db_logistik_pt->where(['BATAL !=' => 1, 'kodebar' => $kodebar, 'ttg' => $no_lpb]);
    //     $this->db_logistik_pt->from('masukitem');
    //     $sumqty_lpb = $this->db_logistik_pt->get()->row();

    //     $result = $qty_po - $sumqty_lpb->qty_lpb;
    //     return $result;
    // }

    public function cari_harga_po($no_ref_po, $kodebar, $norefppo)
    {
        $this->db_logistik_pt->select('harga');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'noref' => $no_ref_po, 'refppo' => $norefppo]);
        $this->db_logistik_pt->from('item_po');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function cari_harga_mutasi($no_ref_po, $kodebar)
    {
        $this->db_logistik_center->select('qty2, nilai_item');
        $this->db_logistik_center->where(['kodebar' => $kodebar, 'NO_REF' => $no_ref_po]);
        $this->db_logistik_center->from('tb_mutasi_item');
        $data = $this->db_logistik_center->get()->row_array();

        $harga = $data['nilai_item'] / $data['qty2'];
        return $harga;
    }

    public function saveStokAwalHarian($data)
    {
        return $this->db_logistik_pt->insert('stockawal_harian', $data);
    }

    public function cari_kodebar($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select('kodebar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal');
        return $this->db_logistik_pt->get()->num_rows();
    }

    public function sum_saldo_qty_kodebar_harian($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select_sum('saldoakhir_qty', 'saldo_qty_harian');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        $return_saldo_qty_harian = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('QTY_KELUAR', 'qty_keluar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal');
        $return_saldo_qty_stockawal =  $this->db_logistik_pt->get()->row();

        $sum_saldo_qty_stockawal = $return_saldo_qty_harian->saldo_qty_harian - $return_saldo_qty_stockawal->qty_keluar;
        return $sum_saldo_qty_stockawal;
    }

    public function sum_qty_kodebar_harian($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select_sum('QTY_MASUK', 'qty_harian');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        return $this->db_logistik_pt->get()->row();
    }

    public function sum_harga_kodebar_harian($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select_sum('saldoakhir_nilai', 'saldo_awal_harian');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        $return_saldo_awal_harian = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('nilai_keluar', 'nilaikeluar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal');
        $return_nilaikeluar_stockawal =  $this->db_logistik_pt->get()->row();

        $sum_saldo_nilai_stockawal = $return_saldo_awal_harian->saldo_awal_harian - $return_nilaikeluar_stockawal->nilaikeluar;
        return $sum_saldo_nilai_stockawal;
    }

    public function sum_nilai_masuk_harian($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select_sum('nilai_masuk', 'nilai_masuk_harian');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        return $this->db_logistik_pt->get()->row();
    }

    public function updateStokAwal($data_update, $kodebar, $txtperiode)
    {
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        return $this->db_logistik_pt->update('stockawal', $data_update);
    }

    public function cek_stokawal_harian($kodebar, $periode, $kode_dev)
    {
        $this->db_logistik_pt->select('kodebar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        return $this->db_logistik_pt->get()->num_rows();
    }

    public function updateStokAwalHarian($kodebar, $periode, $txtperiode, $qty, $harga, $kode_dev)
    {
        //stok awal harian
        $this->db_logistik_pt->select_sum('QTY_MASUK', 'qtymasuk');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $sum_harian_qty = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('saldoakhir_qty', 'saldoqty');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $sum_harian_saldo_qty = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('saldoakhir_nilai', 'nilai_saldo_awal');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $sum_harian_nilai = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('nilai_masuk', 'nilaimasuk');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $sum_nilai_masuk = $this->db_logistik_pt->get()->row();

        $harga_stok_awal = $harga * $qty;

        //saldoakhir_nilai
        $saldo_awal_harian = $sum_harian_nilai->nilai_saldo_awal + $harga_stok_awal;

        //saldoakhir_qty
        $saldo_total_harian = $sum_harian_saldo_qty->saldoqty + $qty;

        //nilai_masuk
        $saldo_nilai_masuk = $sum_nilai_masuk->nilaimasuk + $harga_stok_awal;

        //QTY_MASUK
        $total_harian = $sum_harian_qty->qtymasuk + $qty;

        $this->db_logistik_pt->set('saldoakhir_nilai', $saldo_awal_harian);
        $this->db_logistik_pt->set('saldoakhir_qty', $saldo_total_harian);
        $this->db_logistik_pt->set('nilai_masuk', $saldo_nilai_masuk);
        $this->db_logistik_pt->set('QTY_MASUK', $total_harian);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        return $this->db_logistik_pt->update('stockawal_harian');

        //stok awal
        // $this->db_logistik_pt->select('QTY_MASUK, saldoakhir_nilai');
        // $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        // $this->db_logistik_pt->from('stockawal');
        // $stok_awal = $this->db_logistik_pt->get()->row();

        // $update_qty_stok_awal = $stok_awal->QTY_MASUK + $qty;

        // $update_harga_stok_awal = $stok_awal->saldoakhir_nilai + $harga_stok_awal;

        // $this->db_logistik_pt->set('QTY_MASUK', $update_qty_stok_awal);
        // $this->db_logistik_pt->set('saldoakhir_nilai', $update_harga_stok_awal);
        // $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode]);
        // $this->db_logistik_pt->update('stockawal');
    }

    public function cari_periode_barang($id)
    {
        $this->db_logistik_pt->select('periode, qty, txtperiode');
        $this->db_logistik_pt->where('id', $id);
        $this->db_logistik_pt->from('masukitem');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function editStokAwalHarian($kodebar, $periode, $qty_masukitem, $qty_input, $harga, $kode_dev)
    {
        $this->db_logistik_pt->select_sum('QTY_MASUK', 'qtymasuk');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $sum_harian = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('saldoakhir_qty', 'saldoakhir_qty');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $sum_saldoakhir_qty = $this->db_logistik_pt->get()->row();

        // $this->db_logistik_pt->select_sum('nilai_masuk', 'nilaimasuk');
        // $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        // $this->db_logistik_pt->from('stockawal_harian');
        // $sum_nilai_masuk = $this->db_logistik_pt->get()->row();

        //jika qty masukitem > dari qty yang di input saat edit, maka QTY_MASUK - hasil pengurangan (qty masukitem - qty input) 
        if ($qty_masukitem > $qty_input) {
            $kurangin_awal = $qty_masukitem - $qty_input;
            $total_stok_harian = $sum_harian->qtymasuk - $kurangin_awal;
            $total_saldoakhir_qty = $sum_saldoakhir_qty->saldoakhir_qty - $kurangin_awal;
        } elseif ($qty_masukitem < $qty_input) {
            $kurangin_awal = $qty_input - $qty_masukitem;
            $total_stok_harian = $sum_harian->qtymasuk + $kurangin_awal;
            $total_saldoakhir_qty = $sum_saldoakhir_qty->saldoakhir_qty + $kurangin_awal;
        } else {
            $total_stok_harian = $sum_harian->qtymasuk;
            $total_saldoakhir_qty = $sum_saldoakhir_qty->saldoakhir_qty;
        }
        // $total_harian = $sum_harian->qtymasuk + $qty;

        $total_harga = $harga * $total_stok_harian;
        $total_nilai_masuk = $harga * $total_stok_harian;

        // return $total_harga;

        $this->db_logistik_pt->set('saldoakhir_qty', $total_saldoakhir_qty);
        $this->db_logistik_pt->set('QTY_MASUK', $total_stok_harian);
        $this->db_logistik_pt->set('saldoakhir_nilai', $total_harga);
        $this->db_logistik_pt->set('nilai_masuk', $total_nilai_masuk);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        return $this->db_logistik_pt->update('stockawal_harian');

        // $result = [
        //     'kodebar' => $kodebar,
        //     'periode' => $periode,
        //     'qty_masukitem' => $qty_masukitem,
        //     'qty_input' => $qty_input,
        //     'harga' => $harga,
        //     'kode_dev' => $kode_dev,
        // ];
        // return $result;
    }

    public function editStokAwalBulananDevisi($kodebar, $txtperiode, $qty_masukitem, $qty_input, $kode_dev)
    {
        $this->db_logistik_pt->select_sum('QTY_MASUK', 'qtymasuk');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_bulanan_devisi');
        $sum_qty_masuk = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('saldoakhir_qty', 'saldoakhir_qty');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_bulanan_devisi');
        $sum_saldoakhir_qty = $this->db_logistik_pt->get()->row();

        if ($qty_masukitem > $qty_input) {
            $kurangin_awal = $qty_masukitem - $qty_input;
            $total_qty_masuk = $sum_qty_masuk->qtymasuk - $kurangin_awal;
            $total_saldoakhir_qty = $sum_saldoakhir_qty->saldoakhir_qty - $kurangin_awal;
        } elseif ($qty_masukitem < $qty_input) {
            $kurangin_awal = $qty_input - $qty_masukitem;
            $total_qty_masuk = $sum_qty_masuk->qtymasuk + $kurangin_awal;
            $total_saldoakhir_qty = $sum_saldoakhir_qty->saldoakhir_qty + $kurangin_awal;
        } else {
            $total_qty_masuk = $sum_qty_masuk->qtymasuk;
            $total_saldoakhir_qty = $sum_saldoakhir_qty->saldoakhir_qty;
        }

        $this->db_logistik_pt->set('saldoakhir_qty', $total_saldoakhir_qty);
        $this->db_logistik_pt->set('QTY_MASUK', $total_qty_masuk);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        return $this->db_logistik_pt->update('stockawal_bulanan_devisi');
    }

    public function updateStatusItemLpb($no_ref_po, $kodebar, $refppo)
    {
        //update status jadi 1 atau sudah abis qty lpb nya
        $this->db_logistik_pt->set('status_item_lpb', 1);
        $this->db_logistik_pt->where(['noref' => $no_ref_po, 'kodebar' => $kodebar, 'refppo' => $refppo]);
        $this->db_logistik_pt->update('item_po');

        $this->db_logistik_pt->select('noref');
        $this->db_logistik_pt->where(['noref' => $no_ref_po]);
        $this->db_logistik_pt->from('item_po');
        $count_item_po = $this->db_logistik_pt->count_all_results();

        $this->db_logistik_pt->select_sum('status_item_lpb', 'sum_item_lpb');
        $this->db_logistik_pt->where(['noref' => $no_ref_po]);
        $this->db_logistik_pt->from('item_po');
        $sumqty_lpb = $this->db_logistik_pt->get()->row();

        if ($count_item_po == $sumqty_lpb->sum_item_lpb) {
            $this->db_logistik_pt->set('status_lpb', 1);
            $this->db_logistik_pt->where('noreftxt', $no_ref_po);
            $this->db_logistik_pt->update('po');
        }
    }

    public function updateStatusItemLpb2($no_ref_po, $kodebar, $refppo)
    {
        $this->db_logistik_pt->set('status_item_lpb', 0);
        $this->db_logistik_pt->where(['noref' => $no_ref_po, 'kodebar' => $kodebar, 'refppo' => $refppo]);
        $this->db_logistik_pt->update('item_po');

        $this->db_logistik_pt->set('status_lpb', 0);
        $this->db_logistik_pt->where('noreftxt', $no_ref_po);
        $this->db_logistik_pt->update('po');
    }

    public function urut_cetak($no_lpb)
    {
        $this->db_logistik_pt->set('cetak', 'cetak+1', FALSE);
        $this->db_logistik_pt->where('ttg', $no_lpb);
        $this->db_logistik_pt->update('stokmasuk');

        $this->db_logistik_pt->select('cetak');
        $this->db_logistik_pt->from('stokmasuk');
        $this->db_logistik_pt->where('ttg', $no_lpb);
        return $this->db_logistik_pt->get()->row_array();
    }

    public function cek_stok_awal_bulanan_devisi($kodebar, $txtperiode, $kode_dev)
    {
        $this->db_logistik_pt->select('kodebar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_bulanan_devisi');
        return $this->db_logistik_pt->get()->num_rows();
    }

    public function updateStokAwalBulananDevisi($kodebar, $txtperiode, $qty, $kode_dev)
    {
        $this->db_logistik_pt->select('QTY_MASUK, saldoakhir_qty');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_bulanan_devisi');
        $stok_awal = $this->db_logistik_pt->get()->row();

        $total_qty = $stok_awal->QTY_MASUK + $qty;
        $total_saldo_qty = $stok_awal->saldoakhir_qty + $qty;

        $this->db_logistik_pt->set('QTY_MASUK', $total_qty);
        $this->db_logistik_pt->set('saldoakhir_qty', $total_saldo_qty);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        return $this->db_logistik_pt->update('stockawal_bulanan_devisi');
    }

    public function saveStokAwalBulananDevisi($data)
    {
        return $this->db_logistik_pt->insert('stockawal_bulanan_devisi', $data);
    }

    public function updatePoAfterLpb($no_ref_po)
    {
        $this->db_logistik_pt->set('sudah_lpb', 1);
        $this->db_logistik_pt->where('noreftxt', $no_ref_po);
        return $this->db_logistik_pt->update('po');
    }

    public function cari_kodebar_masukitem($kodebar, $no_ref_lpb)
    {
        $this->db_logistik_pt->select('kodebar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'noref' => $no_ref_lpb]);
        $this->db_logistik_pt->from('masukitem');
        return $this->db_logistik_pt->get()->num_rows();
    }
}

/* End of file ModelName.php */
