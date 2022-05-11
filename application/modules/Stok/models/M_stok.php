<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_stok extends CI_Model
{

    var $table = 'stockawal'; //nama tabel dari database
    var $column_order = array(null, 'id', 'kodebartxt', 'nabar', 'satuan', 'grp', 'saldoawal_qty', 'QTY_MASUK', 'QTY_KELUAR', 'saldoawal_nilai', 'saldoakhir_qty', 'saldoakhir_nilai', 'HARGARAT', 'ket', 'minstok', 'txtperiode', 'nilai_masuk', 'nilai_keluar'); //field yang ada di table supplier  
    var $column_search = array('id', 'kodebartxt', 'nabar', 'satuan', 'grp', 'saldoawal_qty', 'QTY_MASUK', 'QTY_KELUAR', 'saldoawal_nilai', 'saldoakhir_qty', 'saldoakhir_nilai', 'HARGARAT', 'ket', 'minstok', 'txtperiode', 'nilai_masuk', 'nilai_keluar'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $this->db_logistik_pt->from($this->table);
        $this->db_logistik_pt->order_by('id', 'desc');

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

    function simpan_stock()
    {
        // var_dump($_POST);
        // var_dump($_SESSION);
        // exit();
        // array(10) {
        //   ["txt_kode_barang"]=>string(15) "102505170000253"
        //   ["txt_nama_barang"]=>string(38) "HOSE HP 3/4 BSP X 480MM  PN 35AP/DA048"
        //   ["txt_satuan"]=>string(3) "PCS"
        //   ["txt_grup"]=>string(25) "SPARE PART BACKHOE LOADER"
        //   ["txt_min_stock_qty"]=>string(1) "5"
        //   ["txt_saldo_awal_nilai"]=>string(6) "200000"
        //   ["txt_saldo_awal_qty"]=>string(2) "20"
        //   ["txt_saldo_akhir_qty"]=>string(2) "20"
        //   ["txt_saldo_akhir_nilai"]=>string(6) "200000"
        //   ["txt_keterangan_stock_awal"]=>string(14) "tes keterangan"
        // }
        // $query_id = "SELECT MAX(id)+1 as no_id FROM stockawal";
        // $generate_id = $this->db_logistik_pt->query($query_id)->row();
        // $no_id = $generate_id->no_id;
        // if (empty($no_id)) {
        //     $no_id = 1;
        // } else {
        //     $no_id = $generate_id->no_id;
        // }

        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');
        // $periode = date("Y-m-d",strtotime($this->session->userdata('periode')));
        // $txtperiode = date("Ym",strtotime($this->session->userdata('periode')));

        $pt = $this->session->userdata('pt');
        $KODE = $this->session->userdata('kode_pt');
        $kodebar = $this->input->post('txt_kode_barang');

        // $data_input_stock_awal["id"] = $no_id;
        $data_input_stock_awal["pt"] = $pt;
        // $data_input_stock_awal["pt"] = $this->session->userdata('app_pt');
        $data_input_stock_awal["KODE"] = $KODE;
        $data_input_stock_awal["afd"] = "-";
        $data_input_stock_awal["kodebar"] = $kodebar;
        $data_input_stock_awal["kodebartxt"] = $kodebar;
        $data_input_stock_awal["nabar"] = $this->input->post('txt_nama_barang');
        $data_input_stock_awal["satuan"] = $this->input->post('txt_satuan');
        $data_input_stock_awal["grp"] = $this->input->post('txt_grup');
        $data_input_stock_awal["saldoawal_qty"] = $this->input->post('txt_saldo_awal_qty');
        $data_input_stock_awal["saldoawal_nilai"] = $this->input->post('txt_saldo_awal_nilai');
        $data_input_stock_awal["tglinput"] = date("Y-m-d H:i:s");
        $data_input_stock_awal["thn"] = date("Y");
        $data_input_stock_awal["saldoakhir_qty"] = $this->input->post('txt_saldo_akhir_qty');
        $data_input_stock_awal["saldoakhir_nilai"] = $this->input->post('txt_saldo_akhir_nilai');
        $data_input_stock_awal["QTY_MASUK"] = $this->input->post('txt_saldo_akhir_qty');
        $data_input_stock_awal["QTY_KELUAR"] = '0';
        $data_input_stock_awal["nilai_masuk"] = $this->input->post('txt_saldo_akhir_nilai');
        $data_input_stock_awal["nilai_keluar"] = '0';
        // $data_input_stock_awal["QTY_ADJMASUK"] = $this->input->post('');
        // $data_input_stock_awal["QTY_ADJKELUAR"] = $this->input->post('');
        // $data_input_stock_awal["HARGAPORAT"] = $this->input->post('');
        $data_input_stock_awal["periode"] = $periode . " 00:00:00";
        $data_input_stock_awal["txtperiode"] = $txtperiode;
        $data_input_stock_awal["ket"] = $this->input->post('txt_keterangan_stock_awal');
        $data_input_stock_awal["account"] = "-";
        $data_input_stock_awal["ket_account"] = "-";
        $data_input_stock_awal["minstok"] = $this->input->post('txt_min_stock_qty');

        $data_insert_stok_harian = [
            'pt' => $this->session->userdata('pt'),
            'KODE' => $this->session->userdata('kode_pt'),
            'devisi' => $this->session->userdata('devisi'),
            'kode_dev' => $this->session->userdata('kode_dev'),
            'afd' => '-',
            'kodebar' => $kodebar,
            'kodebartxt' => $kodebar,
            'nabar' => $this->input->post('txt_nama_barang'),
            'satuan' => $this->input->post('txt_satuan'),
            'grp' => $this->input->post('txt_grup'),
            'saldoawal_qty' => 0,
            'saldoawal_nilai' => 0,
            'tglinput' => date("Y-m-d H:i:s"),
            'thn' => date("Y"),
            'saldoakhir_qty' => $this->input->post('txt_saldo_akhir_qty'),
            'saldoakhir_nilai' => $this->input->post('txt_saldo_akhir_nilai'),
            'nilai_masuk' => $this->input->post('txt_saldo_akhir_nilai'),
            'QTY_MASUK' => $this->input->post('txt_saldo_akhir_qty'),
            'periode' => $this->session->userdata('Ymd_periode'),
            'txtperiode' => $this->session->userdata('ym_periode'),
            'ket' => '-',
            'account' => '-',
            'ket_account' => '-',
            'tgl_transaksi' => date("Y-m-d H:i:s")
        ];

        $data_insert_stok_bulanan = [
            'pt' => $this->session->userdata('pt'),
            'KODE' => $this->session->userdata('kode_pt'),
            'devisi' => $this->session->userdata('devisi'),
            'kode_dev' => $this->session->userdata('kode_dev'),
            'afd' => '-',
            'kodebar' => $kodebar,
            'kodebartxt' => $kodebar,
            'nabar' => $this->input->post('txt_nama_barang'),
            'satuan' => $this->input->post('txt_satuan'),
            'grp' => $this->input->post('txt_grup'),
            'saldoawal_qty' => 0,
            'saldoawal_nilai' => 0,
            'saldoakhir_qty' => $this->input->post('txt_saldo_akhir_qty'),
            'tglinput' => date("Y-m-d H:i:s"),
            'thn' => date("Y"),
            'QTY_MASUK' => $this->input->post('txt_saldo_akhir_qty'),
            'periode' => $this->session->userdata('Ymd_periode'),
            'txtperiode' => $this->session->userdata('ym_periode'),
            'ket' => '-',
            'account' => '-',
            'ket_account' => '-',
            'tgl_transaksi' => date("Y-m-d H:i:s")
        ];

        if (empty($this->input->post('hidden_id'))) {
            $get_stock_awal = $this->db_logistik_pt->get_where('stockawal', array('pt' => $pt, 'KODE' => $KODE, 'kodebartxt' => $kodebar, 'txtperiode' => $txtperiode));
            if ($get_stock_awal->num_rows() > 0) {
                return "barang_sudah_ada_di_stok_awal";
            } else {
                $this->db_logistik_pt->insert('stockawal', $data_input_stock_awal);
                // if ($this->db_logistik_pt->affected_rows() > 0) {
                //     return TRUE;
                // } else {
                //     return FALSE;
                // }

                $this->db_logistik_pt->insert('stockawal_harian', $data_insert_stok_harian);
                // if ($this->db_logistik_pt->affected_rows() > 0) {
                //     return TRUE;
                // } else {
                //     return FALSE;
                // }

                $this->db_logistik_pt->insert('stockawal_bulanan_devisi', $data_insert_stok_bulanan);
                // if ($this->db_logistik_pt->affected_rows() > 0) {
                //     return TRUE;
                // } else {
                //     return FALSE;
                // }
            }
        } else {
            $id = $this->input->post('hidden_id');

            $data_input_stock_awal["id"]   = $id;

            $this->db_logistik_pt->set($data_input_stock_awal);
            $this->db_logistik_pt->where('id', $id);
            $this->db_logistik_pt->update('stockawal');
            if ($this->db_logistik_pt->affected_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
}

/* End of file M_stok.php */
