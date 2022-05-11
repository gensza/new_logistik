<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_bkb extends CI_Model
{
    // start server side table
    var $table = 'stockkeluar'; //nama tabel dari database
    var $column_order = array(null, 'id', 'NO_REF', 'nobpb', 'no_mutasi', 'bag', 'keperluan', 'tgl', 'USER'); //field yang ada di table user
    var $column_search = array('id', 'NO_REF', 'nobpb', 'no_mutasi', 'bag', 'keperluan', 'tgl', 'USER'); //field yang diizin untuk pencarian 
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

    // public function get_bpb()
    // {
    //     // $query = "SELECT id_aset,nama_aset,id_kat_non FROM tb_non_aset WHERE id_kat_non = '" . $this->input->post('id') . "'";
    //     $noref = $this->input->get('noref');
    //     $query = "SELECT norefbpb FROM bpb WHERE norefbpb LIKE '%$noref%' AND batal = 0 AND approval = '1' AND status_bkb = '0'";
    //     return $this->db_logistik_pt->query($query)->result_array();
    // }

    public function get_data_bpb_qr($noref)
    {
        $this->db_logistik_pt->select('bag, alokasi, user, keperluan, bhn_bakar, jn_alat, no_kode, hm_km, lok_kerja, devisi, kode_dev');
        $this->db_logistik_pt->where('norefbpb', $noref);
        $this->db_logistik_pt->from('bpb');
        $data_bpb = $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select('afd, blok, kodebebantxt, ketbeban, nabar, qty, qty_disetujui, satuan, kodesubtxt, ketsub, kodebar, ket, grp, status_item_bkb, approval_item, req_rev_qty_item, periode');
        $this->db_logistik_pt->where('norefbpb', $noref);
        $this->db_logistik_pt->from('bpbitem');
        $data_item_bpb = $this->db_logistik_pt->get()->result_array();

        $d_return = [
            'data_bpb' => $data_bpb,
            'data_item_bpb' => $data_item_bpb
        ];
        return $d_return;
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

    public function savedatastockkeluar($data)
    {
        return $this->db_logistik_pt->insert('stockkeluar', $data);
    }

    public function savedatastockkeluar_mutasi($data)
    {
        return $this->db_logistik_center->insert('tb_mutasi', $data);
    }

    public function savedatakeluarbrgitem_mutasi($data)
    {
        return $this->db_logistik_center->insert('tb_mutasi_item', $data);
    }

    public function savedatakeluarbrgitem($data, $kodebar, $norefbpb, $no_ref_bkb)
    {
        $this->db_logistik_pt->insert('keluarbrgitem', $data);

        //ubah status bpbitem menjadi 1 where kodebar AND NOREF
        $this->db_logistik_pt->set('status_item_bkb', 1);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'norefbpb' => $norefbpb]);
        $this->db_logistik_pt->update('bpbitem');

        //$count_bpbitem = count bpbitem where kodebar AND noref;
        $this->db_logistik_pt->select('norefbpb');
        $this->db_logistik_pt->where('norefbpb', $norefbpb);
        $this->db_logistik_pt->from('bpbitem');
        $count_bpbitem = $this->db_logistik_pt->count_all_results();

        //$count_keluarbrgitem = count keluarbrgitem where kodebar AND noref;
        $this->db_logistik_pt->select('nobpb');
        $this->db_logistik_pt->where('nobpb', $norefbpb);
        $this->db_logistik_pt->from('keluarbrgitem');
        $count_keluarbrgitem = $this->db_logistik_pt->count_all_results();

        if ($count_bpbitem == $count_keluarbrgitem) {
            //  update status bpb menjadi 1 where noref
            $this->db_logistik_pt->set('status_bkb', 1);
            $this->db_logistik_pt->where('norefbpb', $norefbpb);
            return $this->db_logistik_pt->update('bpb');
        } else {
            return FALSE;
        }
    }

    public function update_stockawal($kodebar, $qty2, $txtperiode)
    {
        $this->db_logistik_pt->select('QTY_KELUAR, saldoakhir_qty, saldoakhir_nilai, nilai_keluar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal');
        $stock_awal = $this->db_logistik_pt->get()->row_array();

        $jumlah = $stock_awal['QTY_KELUAR'] + $qty2;

        $rata2 = $stock_awal['saldoakhir_nilai'] / $stock_awal['saldoakhir_qty'];

        $tambah_nilai_keluar = $rata2 * $qty2;

        $nilai_keluar = $stock_awal['nilai_keluar'] + $tambah_nilai_keluar;

        $kurangin_saldoakhir_nilai = $stock_awal['saldoakhir_nilai'] - $tambah_nilai_keluar;

        $saldoakhir_qty = $stock_awal['saldoakhir_qty'] - $qty2;

        $this->db_logistik_pt->set('saldoakhir_qty', $saldoakhir_qty);
        $this->db_logistik_pt->set('saldoakhir_nilai', $kurangin_saldoakhir_nilai);
        $this->db_logistik_pt->set('nilai_keluar', $nilai_keluar);
        $this->db_logistik_pt->set('QTY_KELUAR', $jumlah);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        return $this->db_logistik_pt->update('stockawal');
    }

    public function urut_cetak($no_ref_bkb)
    {
        $this->db_logistik_pt->set('cetak', 'cetak+1', FALSE);
        $this->db_logistik_pt->where('NO_REF', $no_ref_bkb);
        $this->db_logistik_pt->update('stockkeluar');

        $this->db_logistik_pt->select('cetak');
        $this->db_logistik_pt->from('stockkeluar');
        $this->db_logistik_pt->where('NO_REF', $no_ref_bkb);
        return $this->db_logistik_pt->get()->row_array();
    }

    public function update_stockawal_bulanan_devisi($kodebar, $qty2, $txtperiode, $kode_dev)
    {
        $this->db_logistik_pt->select('QTY_KELUAR, saldoakhir_qty');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_bulanan_devisi');
        $stock_awal = $this->db_logistik_pt->get()->row_array();

        $jumlah = $stock_awal['QTY_KELUAR'] + $qty2;

        $saldoakhir_qty = $stock_awal['saldoakhir_qty'] - $qty2;

        $this->db_logistik_pt->set('QTY_KELUAR', $jumlah);
        $this->db_logistik_pt->set('saldoakhir_qty', $saldoakhir_qty);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        return $this->db_logistik_pt->update('stockawal_bulanan_devisi');
    }

    public function get_rata2_nilai($kodebar, $qty2, $txtperiode)
    {
        $this->db_logistik_pt->select('saldoakhir_qty, saldoakhir_nilai');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal');
        $stock_awal = $this->db_logistik_pt->get()->row_array();

        $rata2 = $stock_awal['saldoakhir_nilai'] / $stock_awal['saldoakhir_qty'];

        $jumlah_nilai =  $qty2 * $rata2;

        return $jumlah_nilai;
    }
}

/* End of file ModelName.php */
