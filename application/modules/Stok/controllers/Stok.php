<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Stok extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $db_pt = check_db_pt();
        $this->db_logistik = $this->load->database('db_logistik', TRUE);
        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);
        $this->db_logistik_center = $this->load->database('db_logistik_center', TRUE);
        $this->load->model('M_stok');
        $this->load->model('M_stok_harian');
        $this->load->model('M_stok_bulanan');
        $this->load->model('M_barang');
        // $this->load->model('Barang/M_barang');
    }

    function get_ajax()
    {
        $list = $this->M_stok->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {

            if ($d->saldoakhir_nilai == 0 or $d->saldoakhir_qty == 0) {
                $rata2 = 0;
            } else {
                $rata2 = $d->saldoakhir_nilai / $d->saldoakhir_qty;
            }
            // $akhir_qty = $d->QTY_MASUK - $d->QTY_KELUAR;
            $row = array();
            $id    = $d->id;
            $no++;
            $row[] = '<a href="javascript:;" class="btn btn-info fa fa-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detail Barang" id="btn_detail_barang" onclick="detail_barang(' . $d->kodebartxt . ',' . $id . ')"></a>';
            $row[] = $no . ".";
            $row[] = $d->txtperiode;
            $row[] = $d->kodebartxt;
            $row[] = $d->nabar;
            $row[] = $d->satuan;
            $row[] = $d->grp;
            $row[] = $d->saldoawal_qty;
            $row[] = $d->saldoawal_nilai;
            $row[] = $d->QTY_MASUK;
            $row[] = $d->QTY_KELUAR;
            $row[] = $d->nilai_masuk;
            $row[] = $d->nilai_keluar;
            $row[] = $d->saldoakhir_qty;
            $row[] = $d->saldoakhir_nilai;
            $row[] = $rata2;
            $row[] = $d->ket;
            $row[] = $d->minstok;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_stok->count_all(),
            "recordsFiltered" => $this->M_stok->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function index()
    {
        $data = [
            'title' => "Stock Awal",
        ];
        $this->template->load('template', 'v_stok', $data);
    }

    public function stok_harian()
    {
        $data = [
            'title' => "Stock Awal Harian",
        ];
        $this->template->load('template', 'v_stok_harian', $data);
    }

    public function stok_bulanan_devisi()
    {
        $data = [
            'title' => "Stock Bulanan Devisi",
        ];
        $this->template->load('template', 'v_stok_bulanan_devisi', $data);
    }

    function detail_stock()
    {
        $id = $this->input->post('id');
        $kodebar = $this->input->post('kodebar');

        $data = $this->db_logistik_pt->get_where('stockawal', array('id' => $id, 'kodebartxt' => $kodebar))->row();
        echo json_encode($data);
    }

    function list_barang()
    {
        $list = $this->M_barang->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            $no++;
            $id    = $d->id;
            $row = array();
            $row[] = $no . ".";
            $row[] = $d->kodebar;
            $row[] = $d->nabar;
            $row[] = $d->grp;
            $row[] = $d->satuan;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_barang->count_all(),
            "recordsFiltered" => $this->M_barang->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function simpan_stock()
    {
        $data = $this->M_stok->simpan_stock();
        echo json_encode($data);
    }

    function get_ajax_harian()
    {
        $list = $this->M_stok_harian->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {

            // $akhir_qty = $d->QTY_MASUK - $d->QTY_KELUAR;
            $row = array();
            $id    = $d->id;
            $no++;
            // $row[] = '<a href="javascript:;" class="btn btn-info fa fa-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detail Barang" id="btn_detail_barang" onclick="detail_barang(' . $d->kodebartxt . ',' . $id . ')"></a>';
            $row[] = $no . ".";
            $row[] = $d->txtperiode;
            $row[] = date("Y-m-d", strtotime($d->periode));
            $row[] = $d->devisi;
            $row[] = $d->kodebartxt;
            $row[] = $d->nabar;
            $row[] = $d->satuan;
            $row[] = $d->grp;
            $row[] = $d->saldoawal_qty;
            $row[] = $d->saldoawal_nilai;
            $row[] = $d->nilai_masuk;
            $row[] = $d->QTY_MASUK;
            $row[] = $d->nilai_keluar;
            $row[] = $d->QTY_KELUAR;
            $row[] = $d->ket;
            $row[] = $d->minstok;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_stok_harian->count_all(),
            "recordsFiltered" => $this->M_stok_harian->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_bulanan()
    {
        $list = $this->M_stok_bulanan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {

            // $akhir_qty = $d->QTY_MASUK - $d->QTY_KELUAR;
            $row = array();
            $id    = $d->id;
            $no++;
            // $row[] = '<a href="javascript:;" class="btn btn-info fa fa-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detail Barang" id="btn_detail_barang" onclick="detail_barang(' . $d->kodebartxt . ',' . $id . ')"></a>';
            $row[] = $no . ".";
            $row[] = $d->txtperiode;
            $row[] = $d->devisi;
            $row[] = $d->kodebartxt;
            $row[] = $d->nabar;
            $row[] = $d->satuan;
            $row[] = $d->grp;
            $row[] = $d->saldoawal_qty;
            $row[] = $d->saldoawal_nilai;
            $row[] = $d->QTY_MASUK;
            $row[] = $d->QTY_KELUAR;
            $row[] = $d->saldoakhir_qty;
            $row[] = $d->ket;
            $row[] = $d->minstok;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_stok_bulanan->count_all(),
            "recordsFiltered" => $this->M_stok_bulanan->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
}

/* End of file Stok.php */
