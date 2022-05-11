<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{

    var $table = 'kodebar'; //nama tabel dari database
    var $column_order = array(null, 'id', 'kodebartxt', 'nabar', 'nopart', 'grp', 'satuan'); //field yang ada di table user
    var $column_search = array('kodebartxt', 'nabar', 'nopart', 'grp', 'satuan'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $lokasi = $this->session->userdata('status_lokasi');

        $this->db_logistik_center->from($this->table);
        if ($lokasi == 'SITE') {
            $this->db_logistik_center->where('kode', '06');
            $this->db_logistik_center->or_where('kode', '07');
        } elseif ($lokasi == 'RO') {
            $this->db_logistik_center->where('kode', '02');
        } elseif ($lokasi == 'PKS') {
            $this->db_logistik_center->where('kode', '03');
        }

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db_logistik_center->group_start();
                    $this->db_logistik_center->like($item, $_POST['search']['value']);
                } else {
                    $this->db_logistik_center->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db_logistik_center->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db_logistik_center->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db_logistik_center->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db_logistik_center->limit($_POST['length'], $_POST['start']);
        $query = $this->db_logistik_center->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db_logistik_center->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db_logistik_center->from($this->table);
        return $this->db_logistik_center->count_all_results();
    }
    // end server side table


    function get_data_spp()
    {
        $data = array();
        $start = $_POST['start'];
        $length = $_POST['length'];
        $no = $start + 1;

        $cmb_devisi = $this->input->post('cmb_devisi');
        $lap_cmb_bagian = $this->input->post('lap_cmb_bagian');
        $txt_periode = str_replace('/', '-', $this->input->post('tanggalawalSPP'));
        $txt_periode1 = str_replace('/', '-', $this->input->post('tanggalakhirSPP'));
        $txt_periode = date_format(date_create($txt_periode), "Y/m/d");
        $txt_periode1 = date_format(date_create($txt_periode1), "Y/m/d");

        $rbt_pilihan = $this->input->post('rbt_pilihan');

        $tgl = "AND tglppo BETWEEN '$txt_periode' AND '$txt_periode1'";
        $dev1 = "AND kode_dev = '$cmb_devisi'";

        // switch ($cmb_devisi) {
        //     case '01':
        //         $dev = "AND lokasi = 'HO'";
        //         $dev1 = "AND kode_dev = '01'";
        //         break;
        //     case '02':
        //         $dev = "AND lokasi = 'RO'";
        //         $dev1 = "AND kode_dev = '02'";
        //         break;
        //     case '03':
        //         $dev = "AND lokasi = 'PKS'";
        //         $dev1 = "AND kode_dev = '03'";
        //         break;
        //     case '06':
        //         $dev = "AND noreftxt LIKE '%EST-%'";
        //         $dev1 = "AND kode_dev = '06'";
        //         break;
        //     case '07':
        //         $dev = "AND noreftxt LIKE '%EST2%'";
        //         $dev1 = "AND kode_dev = '07'";
        //         break;
        //     default:
        //         $dev = "";
        //         $dev1 = " ";
        //         break;
        // }

        if ($lap_cmb_bagian == "Semua") {
            $bag = "";
        } else {
            if ($lap_cmb_bagian == 'HRD & UMUM') $lap_cmb_bagian = 'UMUM & HRD';
            $bag = "AND namadept = '" . $lap_cmb_bagian . "'";
        }

        switch ($rbt_pilihan) {
            case 'proses':
                $rbt = "AND status = 'DALAM PROSES'";
                break;
            case 'setujui':
                $rbt = "AND status = 'DISETUJUI'";
                break;
            case 'sppi':
                $rbt = "AND noreftxt LIKE '%SPPI%'";
                break;
            case 'sppa':
                $rbt = "AND noreftxt LIKE '%SPPA%'";
                break;
            case 'semua':
                $rbt = "";
                break;
            default:
                $rbt = "";
                break;
        }

        if (!empty($_POST['search']['value'])) {
            $keyword = $_POST['search']['value'];
            $query = "SELECT noreftxt, tglppo, namadept, po, status, kode_dev FROM ppo 
            			WHERE tglppo BETWEEN '$txt_periode' AND '$txt_periode1' AND (noreftxt LIKE '%$keyword%' 
                        OR tglppo LIKE '%$keyword%'
                        OR namadept LIKE '%$keyword%')
            			ORDER BY id DESC";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        } else {
            $query = "SELECT noreftxt, tglppo, namadept, po, status, kode_dev FROM ppo WHERE tglppo BETWEEN '$txt_periode' AND '$txt_periode1' ORDER BY tglppo DESC";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        }
        foreach ($data_tabel as $hasil) {
            $noref = "'" . $hasil->noreftxt . "'";
            $noref = str_replace("/", ".", $noref);
            $tgl = date_create($hasil->tglppo);
            $row   = array();
            $row[] = $no++;
            $row[] = date_format($tgl, 'd/m/Y');
            $row[] = $hasil->namadept;
            $row[] = $hasil->noreftxt;
            $row[] = '<button class="btn btn-xs btn-success fa fa-print" id="btn_print" target="_blank" name="btn_print" type="button" data-toggle="tooltip" data-placement="right" title="Print" onclick="printClick(' . $noref . ')"></button>';
            $data[] = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $count_all,
            "recordsFiltered"   => $count_all,
            "data"              => $data,
        );
        return $output;
        // var_dump($query);
    }

    function get_list_po_cetakan()
    {
        $data = array();
        $start = $_POST['start'];
        $length = $_POST['length'];
        $no = $start + 1;

        $cmb_company = $this->input->post('cmb_company');
        $txt_periode2 = str_replace('/', '-', $this->input->post('txt_periode2'));
        $txt_periode3 = str_replace('/', '-', $this->input->post('txt_periode3'));

        $txt_periode2 = date_create($txt_periode2);
        $txt_periode2 = date_format($txt_periode2, "Y-m-d");
        $txt_periode3 = date_create($txt_periode3);
        $txt_periode3 = date_format($txt_periode3, "Y-m-d");

        switch ($cmb_company) {
            case '01':
                $dev = "AND kode_dev = '01'";
                break;
            case '02':
                $dev = "AND kode_dev = '02'";
                break;
            case '03':
                $dev = "AND kode_dev = '03'";
                break;
            case '06':
                $dev = "AND kode_dev = '06'";
                break;
            case '07':
                $dev = "AND kode_dev = '07'";
                break;
            default:
                $dev = "";
                break;
        }

        if (!empty($_POST['search']['value'])) {
            $keyword = $_POST['search']['value'];
            $query = "SELECT * FROM po WHERE tglpo BETWEEN '" . $txt_periode2 . "' AND '" . $txt_periode3 . "' $dev AND batal = '0' AND (no_refppo LIKE '%$keyword%' 
                        OR tglpo LIKE '%$keyword%'
                        OR nama_supply LIKE '%$keyword%'
                        OR noreftxt LIKE '%$keyword%')
            			ORDER BY id DESC";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        } else {
            $query = "SELECT * FROM po WHERE tglpo BETWEEN '" . $txt_periode2 . "' AND '" . $txt_periode3 . "' $dev AND batal = '0'";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        }

        foreach ($data_tabel as $hasil) {
            $tglpo = date_create($hasil->tglpo);
            $noreftxt = "'" . $hasil->noreftxt . "'";
            $noreftxt = str_replace("/", ".", $noreftxt);
            $no_refppo = "'" . $hasil->no_refppo . "'";
            $no_refppo = str_replace("/", ".", $no_refppo);
            $kode_supply = "'" . $hasil->kode_supply . "'";
            $row   = array();
            $row[] = $no++;
            $row[] = date_format($tglpo, "d-m-Y");
            $row[] = $hasil->noreftxt;
            $row[] = $hasil->no_refppo;
            $row[] = $hasil->nama_supply;
            $row[] = '<button class="btn btn-xs btn-success fa fa-print" id="btn_print" target="_blank" name="btn_print" type="button" data-toggle="tooltip" data-placement="right" title="Print" onclick="printLapPOCetClick(' . $noreftxt . ',' . $no_refppo . ',' . $kode_supply . ')"></button>';
            $data[] = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $count_all,
            "recordsFiltered"   => $count_all,
            "data"              => $data,
        );
        return $output;
        // var_dump($txt_periode2, $txt_periode3, $query);
    }

    function get_list_pp_cetakan()
    {
        $data = array();
        $start = $_POST['start'];
        $length = $_POST['length'];
        $no = $start + 1;

        $cmb_devisi1 = $this->input->post('cmb_devisi1');
        $txt_periode4 = str_replace('/', '-', $this->input->post('txt_periode4'));
        $txt_periode5 = str_replace('/', '-', $this->input->post('txt_periode5'));

        $txt_periode4 = date_create($txt_periode4);
        $txt_periode4 = date_format($txt_periode4, "Y-m-d");
        $txt_periode5 = date_create($txt_periode5);
        $txt_periode5 = date_format($txt_periode5, "Y-m-d");

        if (!empty($_POST['search']['value'])) {
            $keyword = $_POST['search']['value'];
            $query = "SELECT * FROM pp WHERE tglpp BETWEEN '" . $txt_periode4 . "' AND '" . $txt_periode5 . "' AND kodept = '$cmb_devisi1' AND batal = '0' AND ( 
                        tglpp LIKE '%$keyword%'
                        OR nama_supply LIKE '%$keyword%'
                        OR ref_po LIKE '%$keyword%'
                        OR nopp LIKE '%$keyword%')
            			ORDER BY id DESC";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        } else {
            $query = "SELECT * FROM pp WHERE tglpp BETWEEN '" . $txt_periode4 . "' AND '" . $txt_periode5 . "' AND kodept ='$cmb_devisi1' AND batal = '0'";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        }

        foreach ($data_tabel as $hasil) {
            $tglpp = date_create($hasil->tglpp);
            $nopp = "'" . $hasil->nopp . "'";
            $refpp =  $hasil->ref_pp;
            $ref_pp = str_replace("/", ".", $refpp);
            $id = $hasil->id;
            $kode_supply = "'" . $hasil->kode_supply . "'";
            $row   = array();
            $row[] = $no++;
            $row[] = date_format($tglpp, "d-m-Y");
            $row[] = $hasil->ref_pp;
            $row[] = $hasil->ref_po;
            $row[] = $hasil->nama_supply;
            $row[] = ' <a href="' .  site_url('Pp/cetak/' .  $ref_pp . '/' . $id) . '" target="_blank" title="Cetak PP" class="btn btn-primary btn-xs fa fa-print" id="a_print_po"></a>';
            $data[] = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $count_all,
            "recordsFiltered"   => $count_all,
            "data"              => $data,
        );
        return $output;
        // var_dump($txt_periode2, $txt_periode3, $query);
    }

    function get_list_lap_lpb_slip()
    {
        $data = array();
        $start = $_POST['start'];
        $length = $_POST['length'];
        $no = $start + 1;

        $cmb_devisi3 = $this->input->post('cmb_devisi3');
        $no_lpb = $this->input->post('no_lpb');
        $txt_periode12 = str_replace('/', '-', $this->input->post('txt_periode12'));
        $txt_periode13 = str_replace('/', '-', $this->input->post('txt_periode13'));

        $txt_periode12 = date_create($txt_periode12);
        $txt_periode12 = date_format($txt_periode12, "Y-m-d");
        $txt_periode13 = date_create($txt_periode13);
        $txt_periode13 = date_format($txt_periode13, "Y-m-d");
        if (!empty($_POST['search']['value'])) {
            $keyword = $_POST['search']['value'];
            $query = "SELECT a.*, a.id as id_stokmasuk, b.ket_dept FROM stokmasuk a, po b WHERE a.refpo = b.noreftxt AND a.tgl BETWEEN '" . $txt_periode12 . "' AND '" . $txt_periode13 . "' AND a.kode_dev ='$cmb_devisi3' AND a.BATAL = '0' AND ( 
                        a.tgl LIKE '%$keyword%'
                        OR a.refpo LIKE '%$keyword%'
                        OR a.noref LIKE '%$keyword%'
                        OR a.ttg LIKE '%$keyword%'
                        OR b.ket_dept LIKE '%$keyword%')
            			ORDER BY id DESC";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        } else {
            $query = "SELECT a.*, a.id as id_stokmasuk, b.ket_dept FROM stokmasuk a, po b WHERE a.refpo = b.noreftxt AND a.tgl BETWEEN '" . $txt_periode12 . "' AND '" . $txt_periode13 . "' AND a.kode_dev ='$cmb_devisi3' AND a.BATAL = '0'";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        }

        foreach ($data_tabel as $hasil) {
            $tgl = date_create($hasil->tgl);
            $no_lpb = $hasil->ttgtxt;
            $id = $hasil->id_stokmasuk;
            // $ket_dept = "'" . $hasil->ket_dept . "'";
            // $ket_dept = str_replace(' ','.',$ket_dept);
            // $ket_dept = str_replace('&','-',$ket_dept);
            $row   = array();
            $row[] = $no++;
            $row[] = date_format($tgl, "d-m-Y");
            $row[] = $hasil->refpo;
            $row[] = $hasil->noref;
            $row[] = $hasil->ket_dept;
            $row[] = '<a href="' . site_url('Lpb/cetak/' . $no_lpb . '/' . $id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_lpb"></a>';
            // $row[] = '<button class="btn btn-xs btn-success fa fa-print" id="btn_print" target="_blank" name="btn_print" type="button" data-toggle="tooltip" data-placement="right" title="Print" onclick="printLPBSlipClick(' . $no_lpb . ',' . $id . ')"></button>';
            $data[] = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $count_all,
            "recordsFiltered"   => $count_all,
            "data"              => $data,
        );
        return $output;
    }

    function get_list_lap_lpb_po()
    {
        $data = array();
        $start = $_POST['start'];
        $length = $_POST['length'];
        $no = $start + 1;

        $cmb_devisi3 = $this->input->post('cmb_devisi3');
        // $no_lpb = $this->input->post('no_lpb');
        $txt_periode12 = str_replace('/', '-', $this->input->post('txt_periode12'));
        $txt_periode13 = str_replace('/', '-', $this->input->post('txt_periode13'));

        $txt_periode12 = date_create($txt_periode12);
        $txt_periode12 = date_format($txt_periode12, "Y-m-d");
        $txt_periode13 = date_create($txt_periode13);
        $txt_periode13 = date_format($txt_periode13, "Y-m-d");
        if (!empty($_POST['search']['value'])) {
            $keyword = $_POST['search']['value'];
            $query = "SELECT * FROM stokmasuk WHERE tgl BETWEEN '" . $txt_periode12 . "' AND '" . $txt_periode13 . "' AND kode_dev ='$cmb_devisi3' AND BATAL = '0' AND ( 
                        tgl LIKE '%$keyword%'
                        OR refpo LIKE '%$keyword%'
                        OR noref LIKE '%$keyword%'
                        OR ttg LIKE '%$keyword%')
            			ORDER BY id DESC";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        } else {
            $query = "SELECT * FROM stokmasuk WHERE tgl BETWEEN '" . $txt_periode12 . "' AND '" . $txt_periode13 . "' AND kode_dev ='$cmb_devisi3' AND BATAL = '0'";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        }

        foreach ($data_tabel as $hasil) {
            $tgl = date_create($hasil->tgl);
            $noref = "'" . $hasil->noref . "'";
            $noref = str_replace("/", ".", $noref);
            $refpo = "'" . $hasil->refpo . "'";
            $refpo = str_replace("/", ".", $refpo);
            $periode1 = "'" . str_replace('/', '-', $this->input->post('txt_periode12')) . "'";
            $periode2 = "'" . str_replace('/', '-', $this->input->post('txt_periode13')) . "'";
            $row   = array();
            $row[] = $no++;
            $row[] = date_format($tgl, "d-m-Y");
            $row[] = $hasil->refpo;
            $row[] = $hasil->noref;
            $row[] = $hasil->nama_supply;
            $row[] = '<button class="btn btn-xs btn-success fa fa-print" id="btn_print" target="_blank" name="btn_print" type="button" data-toggle="tooltip" data-placement="right" title="Print" onclick="printLPBPOClick(' . $noref . ',' . $refpo . ',' . $periode1 . ',' . $periode2 . ')"></button>';
            $data[] = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $count_all,
            "recordsFiltered"   => $count_all,
            "data"              => $data,
        );
        return $output;
        // var_dump($query);
    }

    function get_list_lap_lpb_slip_r()
    {
        $data = array();
        $start = $_POST['start'];
        $length = $_POST['length'];
        $no = $start + 1;

        $cmb_devisi3 = $this->input->post('cmb_devisi3');
        // $no_lpb = $this->input->post('no_lpb');
        $txt_periode12 = str_replace('/', '-', $this->input->post('txt_periode12'));
        $txt_periode13 = str_replace('/', '-', $this->input->post('txt_periode13'));

        $txt_periode12 = date_create($txt_periode12);
        $txt_periode12 = date_format($txt_periode12, "Y-m-d");
        $txt_periode13 = date_create($txt_periode13);
        $txt_periode13 = date_format($txt_periode13, "Y-m-d");
        if (!empty($_POST['search']['value'])) {
            $keyword = $_POST['search']['value'];
            $query = "SELECT * FROM stokmasuk WHERE tgl BETWEEN '" . $txt_periode12 . "' AND '" . $txt_periode13 . "' AND kode ='$cmb_devisi3' AND BATAL = '0' AND refpo LIKE '%RET%' AND ( 
                        a.tgl LIKE '%$keyword%'
                        OR a.refpo LIKE '%$keyword%'
                        OR a.noref LIKE '%$keyword%'
                        OR a.ttg LIKE '%$keyword%'
                        OR b.ket_dept LIKE '%$keyword%')
            			ORDER BY id DESC";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        } else {
            $query = "SELECT * FROM stokmasuk WHERE tgl BETWEEN '" . $txt_periode12 . "' AND '" . $txt_periode13 . "' AND kode ='$cmb_devisi3' AND BATAL = '0' AND refpo LIKE '%RET%'";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        }
        $cmb_devisi3 = "'" . $cmb_devisi3 . "'";
        $cmb_devisi3 = str_replace("/", ".", $cmb_devisi3);
        foreach ($data_tabel as $hasil) {
            $tgl = date_create($hasil->tgl);
            $noref = "'" . $hasil->noref . "'";
            $noref = str_replace("/", ":", $noref);
            $noref = str_replace(" ", "-", $noref);
            $refpo = "'" . $hasil->refpo . "'";
            $refpo = str_replace("/", ".", $refpo);
            $row   = array();
            $row[] = $no++;
            $row[] = date_format($tgl, "d-m-Y");
            $row[] = $hasil->refpo;
            $row[] = $hasil->refpo;
            $row[] = $hasil->noref;
            $row[] = '<button class="btn btn-xs btn-success fa fa-print" id="btn_print" target="_blank" name="btn_print" type="button" data-toggle="tooltip" data-placement="right" title="Print" onclick="printLPBSlipRClick(' . $cmb_devisi3 . ',' . $noref . ',' . $refpo . ')"></button>';
            $data[] = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $count_all,
            "recordsFiltered"   => $count_all,
            "data"              => $data,
        );
        return $output;
    }


    function get_list_lap_slip_bkb()
    {
        $data = array();
        $start = $_POST['start'];
        $length = $_POST['length'];
        $no = $start + 1;

        $cmb_devisi4 = $this->input->post('cmb_devisi4');
        $cmb_bagian1 = $this->input->post('cmb_bagian1');
        if ($cmb_bagian1 == "HRD.-.UMUM") $cmb_bagian1 = "UMUM.-.HRD";
        $cmb_bagian1 = str_replace('-', '&', $cmb_bagian1);
        $cmb_bagian1 = str_replace('.', ' ', $cmb_bagian1);
        if ($cmb_bagian1 == 'Semua') {
            $q_bag = '';
        } else {
            $q_bag = "AND bag = '" . $cmb_bagian1 . "'";
        }

        $no_bkb = $this->input->post('no_bkb');
        $txt_periode14 = str_replace('/', '-', $this->input->post('txt_periode14'));
        $txt_periode15 = str_replace('/', '-', $this->input->post('txt_periode15'));

        $txt_periode14 = date_create($txt_periode14);
        $txt_periode14 = date_format($txt_periode14, "Y-m-d");
        $txt_periode15 = date_create($txt_periode15);
        $txt_periode15 = date_format($txt_periode15, "Y-m-d");
        if (!empty($_POST['search']['value'])) {
            $keyword = $_POST['search']['value'];
            $query = "SELECT * FROM stockkeluar WHERE kode_dev = '$cmb_devisi4' AND tgl BETWEEN '$txt_periode14' AND '$txt_periode15' $q_bag  AND ( 
                        tgl LIKE '%$keyword%'
                        OR bag LIKE '%$keyword%'
                        OR skb LIKE '%$keyword%'
                        OR NO_REF LIKE '%$keyword%'
                        OR nobpb LIKE '%$keyword%')
            			ORDER BY tgl ASC";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        } else {
            $query = "SELECT * FROM stockkeluar WHERE kode_dev = '$cmb_devisi4' AND tgl BETWEEN '$txt_periode14' AND '$txt_periode15' $q_bag ";
            $count_all = $this->db_logistik_pt->query($query)->num_rows();
            $data_tabel = $this->db_logistik_pt->query($query . " LIMIT $start,$length")->result();
        }
        $txt_periode14 = "'" . $txt_periode14 . "'";
        $txt_periode15 = "'" . $txt_periode15 . "'";
        foreach ($data_tabel as $hasil) {
            $tgl = date_create($hasil->tgl);
            $NO_REF = "'" . $hasil->NO_REF . "'";
            $NO_REF = str_replace("/", ".", $NO_REF);
            $skb = "'" . $hasil->skb . "'";
            $skb = str_replace("/", ".", $skb);
            $bag = "'" . $hasil->bag . "'";
            $bag = str_replace("/", ".", $bag);
            $id = $hasil->id;

            $row   = array();
            $row[] = $no++;
            $row[] = date_format($tgl, "d-m-Y");
            $row[] = $hasil->skb;
            $row[] = $hasil->NO_REF;
            $row[] = $hasil->bag;
            // $row[] = '<button class="btn btn-xs btn-success fa fa-print" id="btn_print" target="_blank" name="btn_print" type="button" data-toggle="tooltip" data-placement="right" title="Print" onclick="printBKBSlipClick(' . $noref . ',' . $refpo . ')"></button>';
            $row[] = '<a href="' . site_url('Bkb/cetak/' . $hasil->SKBTXT . '/' . $hasil->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_lpb"></a>';
            $data[] = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $count_all,
            "recordsFiltered"   => $count_all,
            "data"              => $data,
        );
        return $output;
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

    public function bybarang($devisi, $noref, $tanggalAwal, $tanggalAkhir)
    {
        $query = "SELECT i.kodebar, i.nabar, i.sat, i.noref, p.kode_dev, p.devisi FROM item_po i LEFT JOIN po p ON p.noreftxt=i.noref WHERE p.kode_dev='$devisi' AND i.noref='$noref' AND i.tglpo BETWEEN '$tanggalAwal' AND '$tanggalAkhir' ORDER BY p.id DESC";
        return $this->db_logistik_pt->query($query)->result();
    }

    public function bysup($devisi, $noref, $tanggalAwal, $tanggalAkhir)
    {
        $query = "SELECT kode_supply, nama_supply, refpo, noref FROM stokmasuk WHERE kode_dev='$devisi' AND refpo='$noref' AND tgl BETWEEN '$tanggalAwal' AND '$tanggalAkhir' ORDER BY id DESC";
        return $this->db_logistik_pt->query($query)->result();
    }

    public function po_blm_lpb($devisi, $tanggalAwal, $tanggalAkhir)
    {
        $query = "SELECT i.kodebar, i.nabar, i.noref, i.merek, i.qty, i.status_item_lpb, p.tglpo, p.bayar, p.nama_supply, p.tempo_bayar FROM item_po i LEFT JOIN po p ON p.noreftxt=i.noref WHERE p.kode_dev='$devisi' AND i.tglpo BETWEEN '$tanggalAwal' AND '$tanggalAkhir' AND status_lpb='0' ORDER BY p.id DESC";
        return $this->db_logistik_pt->query($query)->result();
    }
}

/* End of file M_laporan.php */
