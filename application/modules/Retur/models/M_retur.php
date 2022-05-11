<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_retur extends CI_Model
{
    // Start Data Table Server Side
    var $table = 'retskb'; //nama tabel dari database
    var $column_order = array(null, 'id', 'norefretur', 'noretur', 'tgl', 'bag', 'devisi', 'keterangan', 'user', 'no_ba'); //field yang ada di table user
    var $column_search = array('id', 'norefretur', 'noretur', 'tgl', 'bag', 'devisi', 'keterangan', 'user', 'no_ba'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $kode_dev = $this->session->userdata('kode_dev');
        $lokasi = $this->session->userdata('status_lokasi');

        $this->db_logistik_pt->from($this->table);
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
    //End Data Table Server Side

    // public function get_bpb()
    // {
    //     // $query = "SELECT id_aset,nama_aset,id_kat_non FROM tb_non_aset WHERE id_kat_non = '" . $this->input->post('id') . "'";
    //     $noref = $this->input->get('noref');
    //     $query = "SELECT norefbpb FROM bpb WHERE norefbpb LIKE '%$noref%' AND batal = 0 AND approval = '1' AND status_bkb = '0'";
    //     return $this->db_logistik_pt->query($query)->result_array();
    // }

    public function get_data_bkb_qr($noref)
    {
        $kode_dev = $this->session->userdata('kode_dev');

        $this->db_logistik_pt->select('NO_REF, skb, pt, kode, kode_dev, devisi, bag');
        $this->db_logistik_pt->where(['NO_REF' => $noref, 'kode_dev' => $kode_dev, 'batal' => 0]);
        $this->db_logistik_pt->from('stockkeluar');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function get_tahun_tanam($coa_material)
    {
        $this->db_logistik_pt->select('thn_tanam, tmtbm');
        $this->db_logistik_pt->where('coa_material', $coa_material);
        $this->db_logistik_pt->from('tahun_tanam');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function get_stok($kodebar, $txtperiode, $kode_dev)
    {
        $this->db_logistik_pt->select('saldoawal_qty, QTY_MASUK, QTY_KELUAR');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_bulanan_devisi');
        $stock_awal = $this->db_logistik_pt->get()->row_array();

        $tambah_saldo = $stock_awal['saldoawal_qty'] + $stock_awal['QTY_MASUK'];
        $stok = $tambah_saldo - $stock_awal['QTY_KELUAR'];
        // $stok = $stock_awal['QTY_MASUK'] - $stock_awal['QTY_KELUAR'];
        return $stok;
    }

    public function savedataretskb($data)
    {
        return $this->db_logistik_pt->insert('retskb', $data);
    }
    public function savehistoriretskb($data)
    {
        return $this->db_logistik_pt->insert('retskb_history', $data);
    }

    public function savedataretskbitem($data)
    {
        return $this->db_logistik_pt->insert('ret_skbitem', $data);
    }
    public function savehistoriretskbitem($data)
    {
        return $this->db_logistik_pt->insert('ret_skbitem_history', $data);
    }

    public function savedatastokmasuk($data)
    {
        return $this->db_logistik_pt->insert('stokmasuk', $data);
    }

    public function savedatamasukitem($data)
    {
        return $this->db_logistik_pt->insert('masukitem', $data);
    }

    public function saveRegisterStok($data)
    {
        return $this->db_logistik_pt->insert('register_stok', $data);
    }

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

    public function update_retur($id_retskbitem, $data_item_retur)
    {
        $this->db_logistik_pt->where('id', $id_retskbitem);
        return $this->db_logistik_pt->update('ret_skbitem', $data_item_retur);
    }

    public function update_masukitem($id_masukitem, $data_masukitem)
    {
        $this->db_logistik_pt->where('id', $id_masukitem);
        return $this->db_logistik_pt->update('masukitem', $data_masukitem);
    }

    public function update_register_stok($id_register_stok, $data_register_stok)
    {
        $this->db_logistik_pt->where('id', $id_register_stok);
        return $this->db_logistik_pt->update('register_stok', $data_register_stok);
    }

    public function update_masukitem_edit($norefretur, $kodebar, $data_masukitem)
    {
        $this->db_logistik_pt->where(['refpo' => $norefretur, 'kodebar' => $kodebar]);
        return $this->db_logistik_pt->update('masukitem', $data_masukitem);
    }

    public function update_register_stok_edit($norefretur, $kodebar, $data_register_stok)
    {
        $this->db_logistik_pt->where(['noref' => $norefretur, 'kodebar' => $kodebar]);
        return $this->db_logistik_pt->update('register_stok', $data_register_stok);
    }

    public function cari_harga_bkb($no_ref_bkb, $kodebar)
    {
        $this->db_logistik_pt->select('qty2, nilai_item');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'NO_REF' => $no_ref_bkb]);
        $this->db_logistik_pt->from('keluarbrgitem');
        $data = $this->db_logistik_pt->get()->row_array();

        $harga = $data['nilai_item'] / $data['qty2'];
        return $harga;
    }

    public function cari_kodebar($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select('kodebar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal');
        return $this->db_logistik_pt->get()->num_rows();
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
    }

    public function saveStokAwalHarian($data)
    {
        return $this->db_logistik_pt->insert('stockawal_harian', $data);
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

    public function sum_saldo_qty_kodebar_harian($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select_sum('QTY_MASUK', 'qty_masuk');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        $return_saldo_qty_harian =  $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('QTY_KELUAR', 'qty_keluar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        $return_saldo_qty_stockawal =  $this->db_logistik_pt->get()->row();

        $sum_saldo_qty_stockawal = $return_saldo_qty_harian->qty_masuk - $return_saldo_qty_stockawal->qty_keluar;

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
        $this->db_logistik_pt->select_sum('nilai_masuk', 'nilai_masuk');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        $return_saldo_awal_harian = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('nilai_keluar', 'nilai_keluar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        $return_nilaikeluar_stockawal =  $this->db_logistik_pt->get()->row();

        $sum_saldo_nilai_stockawal = $return_saldo_awal_harian->nilai_masuk - $return_nilaikeluar_stockawal->nilai_keluar;

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

    public function cari_periode_barang($id)
    {
        $this->db_logistik_pt->select('periode, qty, txtperiode');
        $this->db_logistik_pt->where('id', $id);
        $this->db_logistik_pt->from('ret_skbitem');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function editStokAwalHarian($kodebar, $periode, $qty_masukitem, $qty_input, $harga, $kode_dev)
    {
        $this->db_logistik_pt->select('QTY_MASUK, saldoakhir_qty, saldoakhir_nilai, nilai_masuk');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $data_stockawal_harian = $this->db_logistik_pt->get()->row_array();

        //jika qty masukitem > dari qty yang di input saat edit, maka QTY_MASUK - hasil pengurangan (qty masukitem - qty input) 
        if ($qty_masukitem > $qty_input) {
            $kurangin_awal = $qty_masukitem - $qty_input;
            $qty_edit_dikali_kurawal = $kurangin_awal * $harga;
            $total_qty_masuk = $data_stockawal_harian['QTY_MASUK'] - $kurangin_awal;
            $total_saldoakhir_qty = $data_stockawal_harian['saldoakhir_qty'] - $kurangin_awal;
            $total_saldoakhir_nilai = $data_stockawal_harian['saldoakhir_nilai'] - $qty_edit_dikali_kurawal;
            $total_nilai_masuk = $data_stockawal_harian['nilai_masuk'] - $qty_edit_dikali_kurawal;
        } elseif ($qty_masukitem < $qty_input) {
            $kurangin_awal = $qty_input - $qty_masukitem;
            $qty_edit_dikali_kurawal = $kurangin_awal * $harga;
            $total_qty_masuk = $data_stockawal_harian['QTY_MASUK'] + $kurangin_awal;
            $total_saldoakhir_qty = $data_stockawal_harian['saldoakhir_qty'] + $kurangin_awal;
            $total_saldoakhir_nilai = $data_stockawal_harian['saldoakhir_nilai'] + $qty_edit_dikali_kurawal;
            $total_nilai_masuk = $data_stockawal_harian['nilai_masuk'] + $qty_edit_dikali_kurawal;
        } else {
            $total_qty_masuk = $data_stockawal_harian['QTY_MASUK'];
            $total_saldoakhir_qty = $data_stockawal_harian['saldoakhir_qty'];
            $total_saldoakhir_nilai = $data_stockawal_harian['saldoakhir_nilai'];
            $total_nilai_masuk = $data_stockawal_harian['nilai_masuk'];
        }

        // return $total_harga;
        $this->db_logistik_pt->set('saldoakhir_qty', $total_saldoakhir_qty);
        $this->db_logistik_pt->set('saldoakhir_nilai', $total_saldoakhir_nilai);
        $this->db_logistik_pt->set('QTY_MASUK', $total_qty_masuk);
        $this->db_logistik_pt->set('nilai_masuk', $total_nilai_masuk);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        return $this->db_logistik_pt->update('stockawal_harian');
    }

    public function editStokAwalBulananDevisi($kodebar, $txtperiode, $qty_masukitem, $qty_input, $kode_dev)
    {
        $this->db_logistik_pt->select('QTY_MASUK, saldoakhir_qty');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_bulanan_devisi');
        $data_stockawal_bulanan_devisi = $this->db_logistik_pt->get()->row_array();

        if ($qty_masukitem > $qty_input) {
            $kurangin_awal = $qty_masukitem - $qty_input;
            $total_qty_masuk = $data_stockawal_bulanan_devisi['QTY_MASUK'] - $kurangin_awal;
            $total_saldoakhir_qty = $data_stockawal_bulanan_devisi['saldoakhir_qty'] - $kurangin_awal;
        } elseif ($qty_masukitem < $qty_input) {
            $kurangin_awal = $qty_input - $qty_masukitem;
            $total_qty_masuk = $data_stockawal_bulanan_devisi['QTY_MASUK'] + $kurangin_awal;
            $total_saldoakhir_qty = $data_stockawal_bulanan_devisi['saldoakhir_qty'] + $kurangin_awal;
        } else {
            $total_qty_masuk = $data_stockawal_bulanan_devisi['QTY_MASUK'];
            $total_saldoakhir_qty = $data_stockawal_bulanan_devisi['saldoakhir_qty'];
        }

        $this->db_logistik_pt->set('saldoakhir_qty', $total_saldoakhir_qty);
        $this->db_logistik_pt->set('QTY_MASUK', $total_qty_masuk);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        return $this->db_logistik_pt->update('stockawal_bulanan_devisi');
    }

    public function get_qty_retur($no_ref, $kodebar)
    {
        $this->db_logistik_pt->select_sum('qty', 'qty');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'norefbkb' => $no_ref]);
        $this->db_logistik_pt->from('ret_skbitem');
        return $this->db_logistik_pt->get()->row();
    }

    public function cek_barang_exist($kodebar, $norefretur)
    {
        $this->db_logistik_pt->select('kodebar');
        $this->db_logistik_pt->from('ret_skbitem');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'norefretur' => $norefretur]);
        return $this->db_logistik_pt->get()->num_rows();
    }

    public function deleteRetur($norefretur)
    {
        return $this->db_logistik_pt->delete('retskb', array('norefretur' => $norefretur));
    }

    public function deleteStokMasuk($norefretur)
    {
        return $this->db_logistik_pt->delete('stokmasuk', array('refpo' => $norefretur));
    }

    public function cekReturItem($norefretur)
    {
        $this->db_logistik_pt->select('norefretur');
        $this->db_logistik_pt->from('ret_skbitem');
        $this->db_logistik_pt->where('norefretur', $norefretur);
        $this->db_logistik_pt->where('batal !=', 1);
        return $this->db_logistik_pt->get()->num_rows();
    }

    public function cekDataRetur($norefretur)
    {
        $this->db_logistik_pt->select('norefretur');
        $this->db_logistik_pt->from('ret_skbitem');
        $this->db_logistik_pt->where('norefretur', $norefretur);
        $this->db_logistik_pt->where('batal !=', 1);
        return $this->db_logistik_pt->get()->num_rows();
    }

    public function cekNoBa($no_ba)
    {
        $this->db_logistik_pt->select('no_ba');
        $this->db_logistik_pt->from('retskb');
        $this->db_logistik_pt->where('no_ba', $no_ba);
        return $this->db_logistik_pt->get()->row_array();
    }

    public function cari_retur_edit($id_retskb)
    {
        $this->db_logistik_pt->select('noretur, norefretur, kode_dev, devisi, norefbkb');
        $this->db_logistik_pt->from('retskb');
        $this->db_logistik_pt->where('id', $id_retskb);
        $retskb = $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select('id, kodebar, nabar, grp, satuan, afd, blok, qty, ket, ketbeban, kodebeban, ketsub, kodesub, txtperiode, tmtbm, thntanam');
        $this->db_logistik_pt->from('ret_skbitem');
        $this->db_logistik_pt->where('norefretur', $retskb['norefretur']);
        $ret_skbitem = $this->db_logistik_pt->get()->result_array();

        $return_data = [
            'retskb' => $retskb,
            'ret_skbitem' => $ret_skbitem,
        ];
        return $return_data;
    }

    public function get_qty_bkb($kodebar, $norefbkb)
    {
        $this->db_logistik_pt->select('qty2');
        $this->db_logistik_pt->from('keluarbrgitem');
        $this->db_logistik_pt->where(['NO_REF' => $norefbkb, 'kodebar' => $kodebar]);
        return $this->db_logistik_pt->get()->row_array();
    }

    public function updateBatalitem($id_retskbitem, $isi_batal)
    {
        $this->db_logistik_pt->where('id', $id_retskbitem);
        $this->db_logistik_pt->update('ret_skbitem',  $isi_batal);

        return TRUE;
    }
    public function updateBatal($norefretur, $isi_batal)
    {
        // $this->db_logistik_pt->delete('retskb', array('norefretur' => $norefretur));
        $this->db_logistik_pt->where('norefretur', $norefretur);
        $this->db_logistik_pt->update('retskb',  $isi_batal);

        return TRUE;
    }

    // public function update_stockawal_bulanan_devisi($kodebar, $qty2, $txtperiode, $kode_dev)
    // {
    //     $this->db_logistik_pt->select('QTY_KELUAR, saldoakhir_qty');
    //     $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
    //     $this->db_logistik_pt->from('stockawal_bulanan_devisi');
    //     $stock_awal = $this->db_logistik_pt->get()->row_array();

    //     $jumlah = $stock_awal['QTY_KELUAR'] + $qty2;

    //     $saldoakhir_qty = $stock_awal['saldoakhir_qty'] - $qty2;

    //     $this->db_logistik_pt->set('QTY_KELUAR', $jumlah);
    //     $this->db_logistik_pt->set('saldoakhir_qty', $saldoakhir_qty);
    //     $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
    //     return $this->db_logistik_pt->update('stockawal_bulanan_devisi');
    // }

    // public function get_rata2_nilai($kodebar, $qty2, $txtperiode)
    // {
    //     $this->db_logistik_pt->select('saldoakhir_qty, saldoakhir_nilai');
    //     $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
    //     $this->db_logistik_pt->from('stockawal');
    //     $stock_awal = $this->db_logistik_pt->get()->row_array();

    //     $rata2 = $stock_awal['saldoakhir_nilai'] / $stock_awal['saldoakhir_qty'];

    //     $jumlah_nilai =  $qty2 * $rata2;

    //     return $jumlah_nilai;
    // }
}

/* End of file ModelName.php */
