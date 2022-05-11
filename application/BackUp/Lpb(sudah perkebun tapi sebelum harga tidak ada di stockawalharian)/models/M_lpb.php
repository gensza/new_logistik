<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_lpb extends CI_Model
{
    // start server side table
    var $table = 'stokmasuk'; //nama tabel dari database
    var $column_order = array(null, 'ttg', 'noref', 'nopo', 'refpo', 'nama_supply', 'ket', 'tglinput', 'USER'); //field yang ada di table user
    var $column_search = array('ttg', 'noref', 'nopo', 'refpo', 'nama_supply', 'ket', 'tglinput', 'USER'); //field yang diizin untuk pencarian 
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

    public function get_data_po_qr($noref)
    {
        $this->db_logistik_pt->select('tglpo, noreftxt, nopotxt, nama_supply, kode_supply, lokasi_beli');
        $this->db_logistik_pt->where('noreftxt', $noref);
        $this->db_logistik_pt->from('po');
        $data_po = $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select('kodebar, nabar, qty, sat, ket');
        $this->db_logistik_pt->where('noref', $noref);
        $this->db_logistik_pt->from('item_po');
        $data_item_po = $this->db_logistik_pt->get()->result_array();

        $d_return = [
            'data_po' => $data_po,
            'data_item_po' => $data_item_po
        ];
        return $d_return;
    }

    public function sumqty($kodebar, $nopo, $qty)
    {
        $this->db_logistik_pt->select_sum('qty', 'qty_lpb');
        $this->db_logistik_pt->where(['BATAL !=' => 1, 'kodebar' => $kodebar, 'nopo' => $nopo]);
        $this->db_logistik_pt->from('masukitem');
        $sumqty_lpb = $this->db_logistik_pt->get()->row();

        $result = $qty - $sumqty_lpb->qty_lpb;
        return $result;
    }

    public function get_nopo()
    {
        // $query = "SELECT id_aset,nama_aset,id_kat_non FROM tb_non_aset WHERE id_kat_non = '" . $this->input->post('id') . "'";
        $noref = $this->input->get('noref');
        $query = "SELECT noreftxt FROM po WHERE noreftxt LIKE '%$noref%' AND status_lpb = 0";
        return $this->db_logistik_pt->query($query)->result_array();
    }

    public function get_data_after_save($nopotxt, $no_lpb)
    {

        $this->db_logistik_pt->select('kodebar, nabar, qty, sat, ket, nopotxt');
        $this->db_logistik_pt->where('nopotxt', $nopotxt);
        $this->db_logistik_pt->from('item_po');
        $this->db_logistik_pt->order_by('nopotxt', 'ASC');
        $data_item_po = $this->db_logistik_pt->get()->result_array();

        $this->db_logistik_pt->select('kodebar, ASSET, nabar, satuan, grp, qty, ket');
        $this->db_logistik_pt->where('nopotxt', $nopotxt);
        $this->db_logistik_pt->where('ttg', $no_lpb);
        $this->db_logistik_pt->order_by('nopotxt', 'ASC');
        $this->db_logistik_pt->from('masukitem');
        $data_item_lpb = $this->db_logistik_pt->get()->result_array();

        $d_return = [
            'data_item_po' => $data_item_po,
            'data_item_lpb' => $data_item_lpb
        ];
        return $d_return;
    }

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

    public function get_detail_item_lpb($no_lpb)
    {
        $this->db_logistik_pt->select('kodebar, nabar, satuan, grp, ket, qty, nopo');
        $this->db_logistik_pt->from('masukitem');
        $this->db_logistik_pt->where('ttg', $no_lpb);
        return $this->db_logistik_pt->get()->result_array();
    }

    public function cari_lpb_edit($no_lpb, $nopo)
    {
        $this->db_logistik_pt->select('stokmasuk.nopo, stokmasuk.refpo, stokmasuk.nama_supply, stokmasuk.kode_supply, stokmasuk.tgl, stokmasuk.lokasi_gudang, stokmasuk.no_pengtr, stokmasuk.noref, stokmasuk.ket, po.tglpo');
        $this->db_logistik_pt->from('po');
        $this->db_logistik_pt->join('stokmasuk', 'stokmasuk.nopo = po.nopo');
        $this->db_logistik_pt->where('ttg', $no_lpb);
        $data_lpb = $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select('kodebar, ASSET, nabar, satuan, grp, qty, ket, id');
        $this->db_logistik_pt->where('ttg', $no_lpb);
        $this->db_logistik_pt->from('masukitem');
        $data_item_lpb = $this->db_logistik_pt->get()->result_array();

        $data = [
            'data_lpb' => $data_lpb,
            'data_item_lpb' => $data_item_lpb
        ];
        return $data;
    }

    public function cariQtyPo($nopo, $kodebar)
    {
        $this->db_logistik_pt->select('qty');
        $this->db_logistik_pt->where(['nopo' => $nopo, 'kodebar' => $kodebar]);
        $this->db_logistik_pt->from('item_po');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function sumqty_edit($kodebar, $nopo)
    {
        $this->db_logistik_pt->select('qty');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'nopo' => $nopo]);
        $this->db_logistik_pt->from('item_po');
        $qty_po = $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select_sum('qty', 'qty_lpb');
        $this->db_logistik_pt->where(['BATAL !=' => 1, 'kodebar' => $kodebar, 'nopo' => $nopo]);
        $this->db_logistik_pt->from('masukitem');
        $sumqty_lpb = $this->db_logistik_pt->get()->row();

        $result = $qty_po['qty'] - $sumqty_lpb->qty_lpb;
        return $result;
    }

    public function getQtyPo($kodebar, $nopo)
    {
        $this->db_logistik_pt->select('qty');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'nopo' => $nopo]);
        $this->db_logistik_pt->from('item_po');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function getSisaLpb($qty_po, $kodebar, $no_lpb)
    {
        $this->db_logistik_pt->select_sum('qty', 'qty_lpb');
        $this->db_logistik_pt->where(['BATAL !=' => 1, 'kodebar' => $kodebar, 'ttg' => $no_lpb]);
        $this->db_logistik_pt->from('masukitem');
        $sumqty_lpb = $this->db_logistik_pt->get()->row();

        $result = $qty_po - $sumqty_lpb->qty_lpb;
        return $result;
    }

    public function cari_harga_po($no_ref_po, $kodebar)
    {
        $this->db_logistik_pt->select('harga');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'noref' => $no_ref_po]);
        $this->db_logistik_pt->from('item_po');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function saveStokAwal($data)
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

    public function sum_qty_kodebar_harian($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select_sum('QTY_MASUK', 'qty_harian');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        return $this->db_logistik_pt->get()->row();
    }

    public function sum_harga_kodebar_harian($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select_sum('saldoawal_nilai', 'saldo_awal_harian');
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

    public function updateStokAwalHarian($kodebar, $periode, $qty, $harga, $kode_dev)
    {
        $this->db_logistik_pt->select_sum('QTY_MASUK', 'qtymasuk');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $sum_harian = $this->db_logistik_pt->get()->row();

        $total_harian = $sum_harian->qtymasuk + $qty;
        //pakai harga yang mana?
        $total_harga = $harga * $total_harian;

        $this->db_logistik_pt->set('QTY_MASUK', $total_harian);
        $this->db_logistik_pt->set('saldoawal_nilai', $total_harga);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        return $this->db_logistik_pt->update('stockawal_harian');
    }

    public function cari_periode_barang($id)
    {
        $this->db_logistik_pt->select('periode, qty');
        $this->db_logistik_pt->where('id', $id);
        $this->db_logistik_pt->from('masukitem');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function editStokAwalHarian($kodebar, $periode, $qty_masukitem, $qty_input, $harga)
    {
        $this->db_logistik_pt->select_sum('QTY_MASUK', 'qtymasuk');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode]);
        $this->db_logistik_pt->from('stockawal_harian');
        $sum_harian = $this->db_logistik_pt->get()->row();

        //jika qty masukitem > dari qty yang di input saat edit, maka QTY_MASUK - hasil pengurangan (qty masukitem - qty input) 
        if ($qty_masukitem > $qty_input) {
            $kurangin_awal = $qty_masukitem - $qty_input;
            $total_stok_harian = $sum_harian->qtymasuk - $kurangin_awal;
        } elseif ($qty_masukitem < $qty_input) {
            $kurangin_awal = $qty_input - $qty_masukitem;
            $total_stok_harian = $sum_harian->qtymasuk + $kurangin_awal;
        } else {
            $total_stok_harian = $sum_harian;
        }
        // $total_harian = $sum_harian->qtymasuk + $qty;

        $total_harga = $harga * $total_stok_harian;

        // return $total_harga;

        $this->db_logistik_pt->set('QTY_MASUK', $total_stok_harian);
        $this->db_logistik_pt->set('saldoawal_nilai', $total_harga);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode]);
        return $this->db_logistik_pt->update('stockawal_harian');
    }

    public function updateStatusItemLpb($no_ref_po, $kodebar)
    {
        $this->db_logistik_pt->set('status_item_lpb', 1);
        $this->db_logistik_pt->where(['noref' => $no_ref_po, 'kodebar' => $kodebar]);
        $this->db_logistik_pt->update('item_po');

        $this->db_logistik_pt->select('kodebar');
        $this->db_logistik_pt->where(['noref' => $no_ref_po, 'kodebar' => $kodebar]);
        $this->db_logistik_pt->from('item_po');
        $count_item_po = $this->db_logistik_pt->get()->num_rows();

        $this->db_logistik_pt->select_sum('status_item_lpb', 'sum_item_lpb');
        $this->db_logistik_pt->where(['noref' => $no_ref_po, 'kodebar' => $kodebar]);
        $this->db_logistik_pt->from('item_po');
        $sumqty_lpb = $this->db_logistik_pt->get()->row();

        if ($count_item_po == $sumqty_lpb->sum_item_lpb) {
            $this->db_logistik_pt->set('status_lpb', 1);
            $this->db_logistik_pt->where('noreftxt', $no_ref_po);
            $this->db_logistik_pt->update('po');
        }
    }

    public function updateStatusItemLpb2($no_ref_po, $kodebar)
    {
        $this->db_logistik_pt->set('status_item_lpb', 0);
        $this->db_logistik_pt->where(['noref' => $no_ref_po, 'kodebar' => $kodebar]);
        return $this->db_logistik_pt->update('item_po');
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
}

/* End of file ModelName.php */
