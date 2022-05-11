<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_bkb extends CI_Model
{
    // start server side table
    var $table = 'stockkeluar'; //nama tabel dari database
    var $column_order = array(null, 'id', 'NO_REF', 'nobpb', 'no_mutasi', 'bag', 'keperluan', 'tgl', 'USER', 'approval'); //field yang ada di table user
    var $column_search = array('id', 'NO_REF', 'nobpb', 'no_mutasi', 'bag', 'keperluan', 'tgl', 'USER', 'approval'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        // $role_user = $this->session->userdata('user');
        $lokasi = $this->session->userdata('status_lokasi');
        $kode_dev = $this->session->userdata('kode_dev');
        if ($lokasi != 'HO') {
            $this->db_logistik_pt->where('kode_dev', $kode_dev);
        }

        $this->db_logistik_pt->from($this->table);
        // $this->db_logistik_pt->where('user', $role_user);
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
        $kode_dev = $this->session->userdata('kode_dev');

        $this->db_logistik_pt->select('norefbpb, bag, alokasi, user, keperluan, bhn_bakar, jn_alat, no_kode, hm_km, lok_kerja, devisi, kode_dev, status_mutasi');
        $this->db_logistik_pt->where(['norefbpb' => $noref, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('bpb');
        $data_bpb = $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select('afd, blok, kodebebantxt, ketbeban, nabar, qty, qty_disetujui, satuan, kodesubtxt, ketsub, kodebar, ket, grp, status_item_bkb, approval_item, req_rev_qty_item, periode, tmtbm, thntanam');
        $this->db_logistik_pt->where('norefbpb', $noref);
        $this->db_logistik_pt->from('bpbitem');
        $data_item_bpb = $this->db_logistik_pt->get()->result_array();

        $d_return = [
            'data_bpb' => $data_bpb,
            'data_item_bpb' => $data_item_bpb
        ];
        return $d_return;
    }

    public function get_data_bpb_qr_mut($noref)
    {
        $this->db_logistik_center->select('norefbpb, bag, alokasi, user, keperluan, bhn_bakar, jn_alat, no_kode, hm_km, lok_kerja, devisi, kode_dev, status_mutasi, kode_pt_req_mutasi, pt_req_mutasi');
        $this->db_logistik_center->where('norefbpb', $noref);
        $this->db_logistik_center->from('bpb_mutasi');
        $data_bpb = $this->db_logistik_center->get()->row_array();

        $this->db_logistik_center->select('afd, blok, kodebebantxt, ketbeban, nabar, qty, qty_disetujui, satuan, kodesubtxt, ketsub, kodebar, ket, grp, status_item_bkb, approval_item, req_rev_qty_item, periode, tmtbm, thntanam');
        $this->db_logistik_center->where('norefbpb', $noref);
        $this->db_logistik_center->from('bpbitem_mutasi');
        $data_item_bpb = $this->db_logistik_center->get()->result_array();

        $d_return = [
            'kode_dev' => $this->session->userdata('kode_dev'),
            'devisi' => $this->session->userdata('devisi'),
            'data_bpb' => $data_bpb,
            'data_item_bpb' => $data_item_bpb
        ];
        return $d_return;
    }

    // public function get_tahun_tanam($coa_material)
    // {
    //     $this->db_logistik_pt->select('thntanam, kategori');
    //     $this->db_logistik_pt->where('coakerja', $coa_material);
    //     $this->db_logistik_pt->from('item_pekerjaan');
    //     return $this->db_logistik_pt->get()->row_array();
    // }

    public function get_stok($kodebar, $txtperiode, $kode_dev)
    {
        $txtperiode = $this->session->userdata('ym_periode');

        $sql_sum_stok = "SELECT SUM(QTY_MASUK) AS qty_masuk, SUM(QTY_KELUAR) AS qty_keluar FROM stockawal_bulanan_devisi WHERE txtperiode <= '$txtperiode' AND kodebar = '$kodebar' AND kode_dev = '$kode_dev'";

        $stock_awal = $this->db_logistik_pt->query($sql_sum_stok)->row_array();

        $stok = $stock_awal['qty_masuk'] - $stock_awal['qty_keluar'];

        return $stok;
    }

    public function savedatastockkeluar($data)
    {
        return $this->db_logistik_pt->insert('stockkeluar', $data);
    }
    public function savehistoristockkeluar($data)
    {
        return $this->db_logistik_pt->insert('stockkeluar_history', $data);
    }
    public function savehistorikeluarbrgitem($data)
    {
        return $this->db_logistik_pt->insert('keluarbrgitem_history', $data);
    }

    public function savedatastockkeluar_mutasi($data)
    {
        return $this->db_logistik_center->insert('tb_mutasi', $data);
    }

    public function savedatakeluarbrgitem_mutasi($data)
    {
        return $this->db_logistik_center->insert('tb_mutasi_item', $data);
    }

    public function saveRegisterStok($data)
    {
        return $this->db_logistik_pt->insert('register_stok', $data);
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
        }
    }

    // public function update_stockawal($kodebar, $qty2, $txtperiode)
    // {
    //     $this->db_logistik_pt->select('QTY_KELUAR, saldoakhir_qty, saldoakhir_nilai, nilai_keluar');
    //     $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
    //     $this->db_logistik_pt->from('stockawal');
    //     $stock_awal = $this->db_logistik_pt->get()->row_array();

    //     $jumlah = $stock_awal['QTY_KELUAR'] + $qty2;

    //     $rata2 = $stock_awal['saldoakhir_nilai'] / $stock_awal['saldoakhir_qty'];

    //     $tambah_nilai_keluar = $rata2 * $qty2;

    //     $nilai_keluar = $stock_awal['nilai_keluar'] + $tambah_nilai_keluar;

    //     $kurangin_saldoakhir_nilai = $stock_awal['saldoakhir_nilai'] - $tambah_nilai_keluar;

    //     $saldoakhir_qty = $stock_awal['saldoakhir_qty'] - $qty2;

    //     $this->db_logistik_pt->set('saldoakhir_qty', $saldoakhir_qty);
    //     $this->db_logistik_pt->set('saldoakhir_nilai', $kurangin_saldoakhir_nilai);
    //     $this->db_logistik_pt->set('nilai_keluar', $nilai_keluar);
    //     $this->db_logistik_pt->set('QTY_KELUAR', $jumlah);
    //     $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
    //     return $this->db_logistik_pt->update('stockawal');
    // }

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
        // $this->db_logistik_pt->select('saldoakhir_qty, saldoakhir_nilai');
        // $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode <=' => $txtperiode]);
        // $this->db_logistik_pt->from('stockawal');
        // $stock_awal = $this->db_logistik_pt->get()->row_array();

        $sql_rata2 = "SELECT SUM(saldoakhir_nilai) AS saldoakhir_nilai, SUM(saldoakhir_qty) AS saldoakhir_qty FROM stockawal WHERE txtperiode <= '$txtperiode' AND kodebar = '$kodebar'";
        $stock_awal = $this->db_logistik_pt->query($sql_rata2)->row_array();

        $rata2 = $stock_awal['saldoakhir_nilai'] / $stock_awal['saldoakhir_qty'];

        $jumlah_nilai =  $qty2 * $rata2;

        return $jumlah_nilai;
    }

    public function get_rata2_nilai_untuk_register($kodebar, $txtperiode)
    {

        $sql_rata2 = "SELECT SUM(saldoakhir_nilai) AS saldoakhir_nilai, SUM(saldoakhir_qty) AS saldoakhir_qty FROM stockawal_harian WHERE txtperiode <= '$txtperiode' AND kodebar = '$kodebar'";
        $stock_awal = $this->db_logistik_pt->query($sql_rata2)->row_array();

        $rata2 = $stock_awal['saldoakhir_nilai'] / $stock_awal['saldoakhir_qty'];

        return $rata2;
    }

    public function cek_stockawal($kodebar, $txtperiode, $kode_dev)
    {
        $this->db_logistik_pt->select('saldoakhir_qty, saldoakhir_nilai');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_bulanan_devisi');
        $stock_awal_num_rows = $this->db_logistik_pt->get()->num_rows();

        $this->db_logistik_pt->select('saldoakhir_qty, saldoakhir_nilai');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal');
        $stock_awal = $this->db_logistik_pt->get()->row_array();

        if ($stock_awal_num_rows >= 1) {
            if ($stock_awal['saldoakhir_nilai'] == 0 or $stock_awal['saldoakhir_qty'] == 0) {
                $result = 0;
                return $result;
            } else {
                $result = 1;
                return $result;
            }
        } else {
            $result = 0;
            return $result;
        }
    }

    public function get_data_keluarbrgitem($id_keluarbrgitem)
    {
        $this->db_logistik_pt->select('kodebar, qty2, kode_dev, txtperiode, periode, nilai_item, NO_REF');
        $this->db_logistik_pt->where(['id' => $id_keluarbrgitem]);
        $this->db_logistik_pt->from('keluarbrgitem');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function update_stockawal_bulanan_devisi_edit($get_data_keluarbrgitem)
    {
        $kodebar = $get_data_keluarbrgitem['kodebar'];
        $qty2 = $get_data_keluarbrgitem['qty2'];
        $kode_dev = $get_data_keluarbrgitem['kode_dev'];
        $txtperiode = $get_data_keluarbrgitem['txtperiode'];

        $this->db_logistik_pt->select('QTY_KELUAR, saldoakhir_qty');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_bulanan_devisi');
        $stock_awal = $this->db_logistik_pt->get()->row_array();

        $jumlah = $stock_awal['QTY_KELUAR'] - $qty2;

        $saldoakhir_qty = $stock_awal['saldoakhir_qty'] + $qty2;

        $this->db_logistik_pt->set('QTY_KELUAR', $jumlah);
        $this->db_logistik_pt->set('saldoakhir_qty', $saldoakhir_qty);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
        return $this->db_logistik_pt->update('stockawal_bulanan_devisi');
    }

    public function update_stockawal_edit($get_data_keluarbrgitem)
    {
        $kodebar = $get_data_keluarbrgitem['kodebar'];
        $qty2 = $get_data_keluarbrgitem['qty2'];
        $txtperiode = $get_data_keluarbrgitem['txtperiode'];
        $nilai_item = $get_data_keluarbrgitem['nilai_item'];

        $this->db_logistik_pt->select('QTY_KELUAR, saldoakhir_qty, saldoakhir_nilai, nilai_keluar, nilai_masuk, nilai_keluar, QTY_MASUK, QTY_KELUAR');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal');
        $stock_awal = $this->db_logistik_pt->get()->row_array();

        $qty_keluar = $stock_awal['QTY_KELUAR'] - $qty2;

        $nilai_keluar = $stock_awal['nilai_keluar'] - $nilai_item;

        $kurangin_saldoakhir_nilai = $stock_awal['saldoakhir_nilai'] + $nilai_item;

        $saldoakhir_qty = $stock_awal['saldoakhir_qty'] + $qty2;

        $this->db_logistik_pt->set('saldoakhir_qty', $saldoakhir_qty);
        $this->db_logistik_pt->set('saldoakhir_nilai', $kurangin_saldoakhir_nilai);
        $this->db_logistik_pt->set('nilai_keluar', $nilai_keluar);
        $this->db_logistik_pt->set('QTY_KELUAR', $qty_keluar);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        return $this->db_logistik_pt->update('stockawal');
    }

    public function update_stockawal_harian_delete($get_data_keluarbrgitem)
    {
        $kodebar = $get_data_keluarbrgitem['kodebar'];
        $qty2 = $get_data_keluarbrgitem['qty2'];
        $txtperiode = $get_data_keluarbrgitem['txtperiode'];
        $periode = $get_data_keluarbrgitem['periode'];
        $kode_dev = $get_data_keluarbrgitem['kode_dev'];
        $nilai_item = $get_data_keluarbrgitem['nilai_item'];

        $this->db_logistik_pt->select('saldoakhir_qty, saldoakhir_nilai, nilai_keluar, QTY_KELUAR');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $stock_awal_harian = $this->db_logistik_pt->get()->row_array();

        $qty_keluar = $stock_awal_harian['QTY_KELUAR'] - $qty2;

        $nilai_keluar = $stock_awal_harian['nilai_keluar'] - $nilai_item;

        $kurangin_saldoakhir_nilai = $stock_awal_harian['saldoakhir_nilai'] + $nilai_item;

        $saldoakhir_qty = $stock_awal_harian['saldoakhir_qty'] + $qty2;

        $this->db_logistik_pt->set('saldoakhir_qty', $saldoakhir_qty);
        $this->db_logistik_pt->set('saldoakhir_nilai', $kurangin_saldoakhir_nilai);
        $this->db_logistik_pt->set('nilai_keluar', $nilai_keluar);
        $this->db_logistik_pt->set('QTY_KELUAR', $qty_keluar);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        return $this->db_logistik_pt->update('stockawal_harian');
    }

    public function cekDataBkbItem($noref_bkb)
    {
        $this->db_logistik_pt->select('kodebar');
        $this->db_logistik_pt->where(['NO_REF' => $noref_bkb, 'batal' => 0]);
        $this->db_logistik_pt->from('keluarbrgitem');
        return $this->db_logistik_pt->get()->num_rows();
    }

    public function update_status_item_bkb($kodebar, $norefbpb)
    {
        $this->db_logistik_pt->set('status_item_bkb', NULL);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'norefbpb' => $norefbpb]);
        return $this->db_logistik_pt->update('bpbitem');
    }

    public function update_status_bkb($norefbpb)
    {
        $this->db_logistik_pt->set('status_bkb', 0);
        $this->db_logistik_pt->where('norefbpb', $norefbpb);
        return $this->db_logistik_pt->update('bpb');
    }

    public function update_status_item_bkb_mutasi($kodebar, $norefbpb)
    {
        $this->db_logistik_center->set('status_item_bkb', NULL);
        $this->db_logistik_center->where(['kodebar' => $kodebar, 'norefbpb' => $norefbpb]);
        return $this->db_logistik_center->update('bpbitem_mutasi');
    }

    public function update_status_bkb_mutasi($norefbpb)
    {
        $this->db_logistik_center->set('status_bkb', 0);
        $this->db_logistik_center->where('norefbpb', $norefbpb);
        return $this->db_logistik_center->update('bpb_mutasi');
    }

    public function cek_status_approve($noref_bkb)
    {
        $this->db_logistik_pt->select('kodebar');
        $this->db_logistik_pt->where(['NO_REF' => $noref_bkb, 'approval' => 0]);
        $this->db_logistik_pt->from('keluarbrgitem');
        $result = $this->db_logistik_pt->get()->num_rows();

        if ($result == 0) {
            $this->db_logistik_pt->set('approval', '1');
            $this->db_logistik_pt->where(['NO_REF' => $noref_bkb]);
            return $this->db_logistik_pt->update('stockkeluar');
        }
    }

    public function get_noac_gl($nama_noac)
    {
        $this->db_logistik_center->select('noac, nama');
        $this->db_logistik_center->where(['nama' => $nama_noac, 'general' => '301005000000000']); // general15 itu kategori PT mutasi
        $this->db_logistik_center->from('noac');
        return $this->db_logistik_center->get()->row_array();
    }

    public function ubah_status_bpb_mutasi($norefbpb, $kodebar)
    {
        //ubah status bpbitem menjadi 1 where kodebar AND NOREF
        $this->db_logistik_center->set('status_item_bkb', 1);
        $this->db_logistik_center->where(['kodebar' => $kodebar, 'norefbpb' => $norefbpb]);
        $this->db_logistik_center->update('bpbitem_mutasi');

        //$count_bpbitem = count bpbitem where kodebar AND noref;
        $this->db_logistik_center->select('norefbpb');
        $this->db_logistik_center->where('norefbpb', $norefbpb);
        $this->db_logistik_center->from('bpbitem_mutasi');
        $count_bpbitem = $this->db_logistik_center->count_all_results();

        //$count_keluarbrgitem = count keluarbrgitem where kodebar AND noref;
        $this->db_logistik_pt->select('nobpb');
        $this->db_logistik_pt->where('nobpb', $norefbpb);
        $this->db_logistik_pt->from('keluarbrgitem');
        $count_keluarbrgitem = $this->db_logistik_pt->count_all_results();

        if ($count_bpbitem == $count_keluarbrgitem) {
            //  update status bpb menjadi 1 where noref
            $this->db_logistik_center->set('status_bkb', 1);
            $this->db_logistik_center->where('norefbpb', $norefbpb);
            return $this->db_logistik_center->update('bpb_mutasi');
        }
    }

    public function update_stockawal_harian($kodebar, $qty2, $kode_dev, $periode, $txtperiode)
    {
        //mencari harga rata2
        $harga_stok_awal = $this->get_rata2_nilai($kodebar, $qty2, $txtperiode);

        $this->db_logistik_pt->select_sum('saldoakhir_nilai', 'nilai_saldo_awal');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $sum_harian_nilai = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('saldoakhir_qty', 'saldoqty');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $sum_harian_saldo_qty = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('nilai_keluar', 'nilaikeluar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $sum_nilai_keluar = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('QTY_KELUAR', 'qtykeluar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        $this->db_logistik_pt->from('stockawal_harian');
        $sum_qty_keluar = $this->db_logistik_pt->get()->row();

        //saldoakhir_nilai
        $saldo_total_harian_nilai = $sum_harian_nilai->nilai_saldo_awal - $harga_stok_awal;

        //saldoakhir_qty
        $saldo_total_harian_qty = $sum_harian_saldo_qty->saldoqty - $qty2;

        //nilai_keluar
        $saldo_nilai_masuk = $sum_nilai_keluar->nilaikeluar + $harga_stok_awal;

        //QTY_Keluar
        $saldo_qty_keluar = $sum_qty_keluar->qtykeluar + $qty2;

        $this->db_logistik_pt->set('saldoakhir_nilai', $saldo_total_harian_nilai);
        $this->db_logistik_pt->set('saldoakhir_qty', $saldo_total_harian_qty);
        $this->db_logistik_pt->set('nilai_keluar', $saldo_nilai_masuk);
        $this->db_logistik_pt->set('QTY_KELUAR', $saldo_qty_keluar);
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
        return $this->db_logistik_pt->update('stockawal_harian');
    }

    public function sum_saldo_qty_kodebar_harian($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select_sum('QTY_MASUK', 'qty_masuk');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        $return_qty_masuk = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('QTY_KELUAR', 'qty_keluar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        $return_qty_keluar =  $this->db_logistik_pt->get()->row();

        $sum_saldo_qty_stockawal = $return_qty_masuk->qty_masuk - $return_qty_keluar->qty_keluar;
        return $sum_saldo_qty_stockawal;
    }

    public function sum_qty_kodebar_harian($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select_sum('QTY_KELUAR', 'qty_keluar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        return $this->db_logistik_pt->get()->row();
    }

    public function sum_harga_kodebar_harian($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select_sum('nilai_masuk', 'nilaimasuk');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        $return_nilai_masuk = $this->db_logistik_pt->get()->row();

        $this->db_logistik_pt->select_sum('nilai_keluar', 'nilaikeluar');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
        $this->db_logistik_pt->from('stockawal_harian');
        $return_nilai_keluar =  $this->db_logistik_pt->get()->row();

        $sum_saldo_nilai_stockawal = $return_nilai_masuk->nilaimasuk - $return_nilai_keluar->nilaikeluar;
        return $sum_saldo_nilai_stockawal;
    }

    public function sum_nilai_keluar_harian($kodebar, $txtperiode)
    {
        $this->db_logistik_pt->select_sum('nilai_keluar', 'nilai_keluar_harian');
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

    public function saveStokAwalBulananDevisi($data)
    {
        return $this->db_logistik_pt->insert('stockawal_bulanan_devisi', $data);
    }

    public function updatebatalitem($id_keluarbrgitem, $isibatal)
    {
        $this->db_logistik_pt->where('id', $id_keluarbrgitem);
        return $this->db_logistik_pt->update('keluarbrgitem',  $isibatal);
    }
    public function updatebatal($noref_bkb, $isibatal)
    {
        $this->db_logistik_pt->where('NO_REF', $noref_bkb);
        return $this->db_logistik_pt->update('stockkeluar',  $isibatal);
    }
}

/* End of file ModelName.php */
