<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_spp');
        $this->load->model('M_data_spp');
        $this->load->model('M_data_spp_approval');
        $this->load->model('M_approval_spp');

        $this->load->model('M_spp_noCoa');
        $this->load->model('M_detail_sppNoCoa');
        $this->load->model('M_spp_approval_noCOA');
        $this->load->model('M_brg_serupa');
        $this->load->model('M_approval_spp_no_coa');

        $db_pt = check_db_pt();

        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);
        $this->db_logistik_center = $this->load->database('db_logistik_center', TRUE);

        if (!$this->session->userdata('id_user')) {
            $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
            $this->session->set_flashdata('pesan', $pemberitahuan);
            redirect('Login');
        }

        date_default_timezone_set('Asia/Jakarta');
    }

    public function koreksi_coa()
    {
        $nabar = $this->input->post('nabar');
        $dt = $this->db_logistik_center->query("SELECT nabar FROM `kodebar` WHERE nabar LIKE '%$nabar%' ORDER BY id DESC")->result();
        $isi = $this->db_logistik_center->query("SELECT nabar FROM `kodebar` WHERE nabar LIKE '%$nabar%' ORDER BY id DESC")->num_rows();

        $data = [
            'data' => $dt,
            'isi' => $isi
        ];

        echo json_encode($data);
    }

    //Start Data Table Server Side
    function get_data_barang()
    {
        $list = $this->M_spp->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<button class="btn btn-success btn-xs" style="font-size: 11px;" id="data_barang" name="data_barang"
                    data-nabar="' . $field->nabar . '" data-kodebar="' . $field->kodebar . '" data-satuan="' . $field->satuan . '" data-grp="' . $field->grp . '" data-toggle="tooltip" data-placement="top" title="Pilih" onClick="return false">
                        Pilih
                    </button>
                ';
            $row[] = $no;
            $row[] = $field->kodebar;
            $row[] = $field->nabar;
            $row[] = $field->grp;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_spp->count_all(),
            "recordsFiltered" => $this->M_spp->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function get_data_barang_serupa()
    {
        $nabar = $this->input->post('nabar');
        $this->M_brg_serupa->nabar($nabar);
        $list = $this->M_brg_serupa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<button class="btn btn-success btn-xs" style="font-size: 11px;" id="data_barang_serupa" name="data_barang_serupa"
                    data-nabar="' . $field->nabar . '" data-kodebar="' . $field->kodebar . '" data-satuan="' . $field->satuan . '" data-grp="' . $field->grp . '" data-toggle="tooltip" data-placement="top" title="Pilih" onClick="return false">
                        Pilih
                    </button>
                ';
            $row[] = $no;
            $row[] = $field->kodebar;
            $row[] = $field->nabar;
            $row[] = $field->grp;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_brg_serupa->count_all(),
            "recordsFiltered" => $this->M_brg_serupa->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    //End Start Data Table Server Side
    public function satuan()
    {
        # code...
        $satuan = $this->db_logistik_center->query("SELECT * FROM satuan ORDER BY id DESC")->result();
        echo json_encode($satuan);
    }


    public function index()
    {
        $this->template->load('template', 'v_spp');
    }
    public function dataNoCoa()
    {
        $this->template->load('template', 'v_sppNoCoa');
    }

    public function sppBaru()
    {
        $data['sesi_sl'] = $this->session->userdata('status_lokasi');

        $data['devisi'] = $this->M_spp->cariDevisi();

        $data['dept'] = $this->M_spp->dept();

        $this->template->load('template', 'v_input_spp', $data);
    }

    public function sppNoCoa()
    {
        $data['sesi_sl'] = $this->session->userdata('status_lokasi');

        $data['devisi'] = $this->M_spp->cariDevisi();

        $data['dept'] = $this->M_spp->dept();

        $this->template->load('template', 'v_input_spp_noCoa', $data);
    }

    public function getStok()
    {
        $txtperiode  = $this->session->userdata('ym_periode');

        $kodebar = $this->input->post('kd_bar');
        $kode_dev = $this->input->post('kode_dev');

        $data = $this->M_spp->get_stok($kodebar, $txtperiode, $kode_dev);

        // if (empty($stockawal)) {
        //     $get_stockawal = "0";
        // } else {
        //     $get_stockawal = $stockawal->QTY_MASUK;
        // }

        // $summasuk = $this->M_spp->sumMasuk($kd_bar);

        // $sumkeluar = $this->M_spp->sumKeluar($kd_bar);

        // $data = $stockawal->qty_masuk - $sumkeluar->stokkeluar;

        echo json_encode($data);
    }

    function hitungIsiItem()
    {
        $noref = $this->input->post('noref_ppo');
        $data = $this->db_logistik_pt->query("SELECT * FROM item_ppo WHERE noreftxt='$noref'")->num_rows();
        echo json_encode($data);
    }

    public function saveSpp()
    {
        $id_user = $this->session->userdata('id_user');
        $cmb_alokasi = $this->input->post("cmb_alokasi");

        $data['nama_dept'] = $this->M_spp->namaDept($this->input->post("cmb_departemen"));
        // var_dump($data['nama_dept']['nama']);
        // die;

        if ($cmb_alokasi == "HO") {
            $text1 = "PST";
            $text2 = "BWJ";
            // $dig_1 = "1";
        } else if ($cmb_alokasi == "SITE") {
            // $text1 = $cmb_estate;
            $text1 = "EST";
            $text2 = "SWJ";
            // $dig_1 = "6";
        } else if ($cmb_alokasi == "RO") {
            $text1 = "ROM";
            $text2 = "PKY";
            // $dig_1 = "2";
        } else if ($cmb_alokasi == "PKS") {
            $text1 = "FAC";
            $text2 = "SWJ";
            // $dig_1 = "3";
        }

        //dig_1 itu kebun
        $kode_devisi    = $this->input->post('kode_dev');
        $nmr_depan_dev = preg_replace("/[^1-9]/", "", $kode_devisi);

        if ($this->session->userdata('status_lokasi') == "HO") {
            $dig_2 = "1";
        } else {
            $dig_2 = "2";
        }

        $key = $nmr_depan_dev . $dig_2;

        $hitung_key = strlen($key);
        $query_ppo = "SELECT MAX(SUBSTRING(noppotxt, $hitung_key+1)) as maxspp from ppo WHERE noppotxt LIKE '$key%'";
        $generate_ppo = $this->db_logistik_pt->query($query_ppo)->row();
        $noUrut = (int)($generate_ppo->maxspp);
        $noUrut++;
        $print = sprintf("%05s", $noUrut);

        if (empty($this->input->post('hidden_no_spp'))) {
            $nospp = $nmr_depan_dev . $dig_2 . $print;
        } else {
            $nospp = $this->input->post('hidden_no_spp');
        }

        $tgl_trm = date("Y-m-d", strtotime($this->input->post('txt_tgl_terima')));

        $getmonth = date("m", strtotime($this->input->post('txt_tgl_ref')));
        $getyear = date("y", strtotime($this->input->post('txt_tgl_ref')));

        $noref = $text1 . "-" . $_POST['cmb_jenis_permohonan'] . "/" . $text2 . "/" . $getmonth . "/" . $getyear . "/" . $nospp;

        $periode = date("Y-m-d", strtotime($this->session->userdata('Ymd_periode')));
        $d_periode =  date("j", strtotime($periode));
        if ($d_periode >= 26) {
            $periodetxt = date("Ym", strtotime($this->session->userdata('Ymd_periode') . " +1 month"));
        } else {
            $periodetxt = date("Ym", strtotime($this->session->userdata('Ymd_periode')));
        }
        $thn = date("Y", strtotime($this->session->userdata('Ymd_periode')));

        $data['devisi'] = $this->db_logistik_pt->get_where('tb_devisi', array('kodetxt' => $kode_devisi))->row_array();



        if ($this->input->post('hidden_kode_brg') != 0) {
            # code...
            $status2 = 0;
            $status = 'DALAM PROSES';
            $kodebarang_sementara = $this->input->post('hidden_kode_brg');


            $data_ppo = [
                'kpd' => 'Bagian Purchasing',
                'noppo' => $nospp,
                'noppotxt' => $nospp,
                'jenis' => $this->input->post('cmb_jenis_permohonan'),
                'tglppo' => $this->input->post('txt_tgl_spp'),
                'tglppotxt' => date("Ymd", strtotime($this->input->post('txt_tgl_spp'))),
                'tgltrm' => $tgl_trm . date(" H:i:s"),
                'kodedept' => $this->input->post('cmb_departemen'),
                'namadept' => $data['nama_dept']['nama'],
                'kode_dev' => $kode_devisi,
                'devisi' => $data['devisi']['PT'],
                'noref' => $nospp,
                'noreftxt' => $noref,
                'tglref' => $periode,
                'ket' => $this->input->post('txt_keterangan'),
                'no_acc' => 0,
                'ket_acc' => "",
                'pt' => $data['devisi']['PT'],
                'kodept' => $kode_devisi,
                'periode' => $periode,
                'periodetxt' => $periodetxt,
                'thn' => $thn,
                'tglisi' => date("Y-m-d H:i:s"),
                'id_user' => $id_user,
                'user' => $this->session->userdata('user'),
                'status' => $status,
                'status2' => $status2,
                'lokasi' => $this->session->userdata('status_lokasi'),
                'po' => 0,
                'kode_budget' => 0,
                'grup' => 0,
                'main_acct' => 0,
                'nama_main' => 0,
            ];
        } else {
            $status2 = 9;
            $status = 'TANPA COA';
            $kodebarang_sementara = mt_rand(1000, 9999);

            $data_ppo = [
                'kpd' => 'Bagian Purchasing',
                'noppo' => $nospp,
                'noppotxt' => $nospp,
                'jenis' => $this->input->post('cmb_jenis_permohonan'),
                'tglppo' => $this->input->post('txt_tgl_spp'),
                'tglppotxt' => date("Ymd", strtotime($this->input->post('txt_tgl_spp'))),
                'tgltrm' => $tgl_trm . date(" H:i:s"),
                'kodedept' => $this->input->post('cmb_departemen'),
                'namadept' => $data['nama_dept']['nama'],
                'kode_dev' => $kode_devisi,
                'devisi' => $data['devisi']['PT'],
                'noref' => $nospp,
                'noreftxt' => $noref,
                'tglref' => $periode,
                'ket' => $this->input->post('txt_keterangan'),
                'no_acc' => 0,
                'ket_acc' => "",
                'pt' => $data['devisi']['PT'],
                'kodept' => $kode_devisi,
                'periode' => $periode,
                'periodetxt' => $periodetxt,
                'thn' => $thn,
                'tglisi' => date("Y-m-d H:i:s"),
                'id_user' => $id_user,
                'user' => $this->session->userdata('user'),
                'status' => $status,
                'status2' => $status2,
                'lokasi' => $this->session->userdata('status_lokasi'),
                'po' => 0,
                'kode_budget' => 0,
                'grup' => 0,
                'main_acct' => 0,
                'nama_main' => 0,
            ];

            $data_ppo_tmp = [
                'kpd' => 'Bagian Purchasing',
                'noppo' => $nospp,
                'noppotxt' => $nospp,
                'jenis' => $this->input->post('cmb_jenis_permohonan'),
                'tglppo' => $this->input->post('txt_tgl_spp'),
                'tglppotxt' => date("Ymd", strtotime($this->input->post('txt_tgl_spp'))),
                'tgltrm' => $tgl_trm . date(" H:i:s"),
                'kodedept' => $this->input->post('cmb_departemen'),
                'namadept' => $data['nama_dept']['nama'],
                'kode_dev' => $kode_devisi,
                'devisi' => $data['devisi']['PT'],
                'noref' => $nospp,
                'noreftxt' => $noref,
                'tglref' => $periode,
                'ket' => $this->input->post('txt_keterangan'),
                'no_acc' => 0,
                'ket_acc' => "",
                'pt' => $data['devisi']['PT'],
                'kodept' => $kode_devisi,
                'periode' => $periode,
                'periodetxt' => $periodetxt,
                'thn' => $thn,
                'tglisi' => date("Y-m-d H:i:s"),
                'id_user' => $id_user,
                'user' => $this->session->userdata('user'),
                'status' => $status,
                'status2' => $status2,
                'lokasi' => $this->session->userdata('status_lokasi'),
                'po' => 0,
                'kode_budget' => 0,
                'grup' => 0,
                'main_acct' => 0,
                'nama_main' => 0,
                'alias' => $this->session->userdata('app_pt')
            ];
        }



        $data_item_ppo = [
            'noppo' => $nospp,
            'noppotxt' => $nospp,
            'jenis' => $this->input->post('cmb_jenis_permohonan'),
            'tglppo' => $this->input->post('txt_tgl_spp'),
            'tglppotxt' => date("Ymd", strtotime($this->input->post('txt_tgl_spp'))),
            'kodedept' => $this->input->post('cmb_departemen'),
            'namadept' => $data['nama_dept']['nama'],
            'noref' => $nospp,
            'noreftxt' => $noref,
            'kodebar' => $kodebarang_sementara,
            'kodebartxt' => $kodebarang_sementara,
            'nabar' => strtoupper($this->input->post('hidden_nama_brg')),
            'sat' => $this->input->post('hidden_satuan_brg'),
            'qty' => $this->input->post('txt_qty'),
            'qty2' => NULL,
            'stok' => $this->input->post('hidden_stok'),
            'harga' => "0",
            'jumharga' => "0",
            'namapt' => $data['devisi']['PT'],
            'kodept' => $kode_devisi,
            'kode_dev' => $kode_devisi,
            'devisi' => $data['devisi']['PT'],
            'periode' => $periode,
            'periodetxt' => $periodetxt,
            'thn' => $thn,
            'ket' => $this->input->post('txt_keterangan_rinci'),
            'tglisi' => date("Y-m-d H:i:s"),
            'id_user' => $id_user,
            'user' => $this->session->userdata('user'),
            'status' => $status,
            'status2' => $status2,
            'ada_penawar' => '',
            'lokasi' => $this->session->userdata('status_lokasi'),
            'po' => "0",
            'saldo_po' => "0",
            'kode_budget' => "0",
            'grup' => $this->input->post('hidden_grup_brg'),
            'main_acct' => "0",
            'nama_main' => "",
        ];

        //cek koneksi
        $con = $this->db_logistik_pt;

        $connected = $con->initialize();
        if (!$connected) {
            // ga ada koneksi
            $data_return = 'conn_failed';
        } else {
            if (empty($this->input->post('hidden_no_spp'))) {
                /* kondisi untuk insert ke spp tmp */
                $data = $this->M_spp->saveSpp($data_ppo);
                $data2 = $this->M_spp->saveSpp2($data_item_ppo);
                if ($this->input->post('hidden_kode_brg') == 0) {
                    # code...

                    $data = $this->M_spp->saveSpp_tmp($data_ppo_tmp);
                    $data2 = $this->M_spp->saveSpp2_tmp($data_item_ppo);
                }
                /* end */
                $item_exist = 0;
            } else {

                $cek_isi_item = $this->M_spp->cari_item_spp($data_item_ppo['kodebar'], $data_item_ppo['noreftxt']);



                if ($cek_isi_item >= 1) {
                    $item_exist = 1;
                    $data = NULL;
                    $data2 = NULL;
                } else {
                    $data2 = $this->M_spp->saveSpp2($data_item_ppo);
                    if ($this->input->post('hidden_kode_brg') == 0) {
                        $data2 = $this->M_spp->saveSpp2_tmp($data_item_ppo);
                    }
                    $item_exist = 0;
                    $data = NULL;
                }
            }

            // cari id terakhir
            $query_id = "SELECT MAX(id) as id_ppo FROM ppo WHERE id_user = '$id_user' AND noreftxt ='$noref'";
            $generate_id = $this->db_logistik_pt->query($query_id)->row();
            $id_ppo = $generate_id->id_ppo;

            $query_id_item = "SELECT MAX(id) as id_item_ppo FROM item_ppo WHERE id_user = '$id_user' AND noreftxt ='$noref'";
            $generate_id_item = $this->db_logistik_pt->query($query_id_item)->row();
            $id_item_ppo = $generate_id_item->id_item_ppo;


            $cek_spp = $this->M_spp->cari_spp($data_ppo['noref']);
            if ($cek_spp >= 1) {
                /* update status ppo */
                $spp = $this->M_spp->update_spp($data_ppo['noref']);
            }

            $data_return = [
                'data' => $data,
                'data2' => $data2,
                'nospp' => $nospp,
                'noref' => $noref,
                'id_ppo' => $id_ppo,
                'id_item_ppo' => $id_item_ppo,
                'item_exist' => $item_exist
            ];
        }

        echo json_encode($data_return);
    }

    public function tes()
    {
        $mt_rand = mt_rand(1000, 9999);

        echo $mt_rand;
    }

    public function saveSppNoCoa()
    {
        $id_user = $this->session->userdata('id_user');
        $cmb_alokasi = $this->input->post("cmb_alokasi");

        $data['nama_dept'] = $this->M_spp->namaDept($this->input->post("cmb_departemen"));
        // var_dump($data['nama_dept']['nama']);
        // die;

        if ($cmb_alokasi == "HO") {
            $text1 = "PST";
            $text2 = "BWJ";
            // $dig_1 = "1";
        } else if ($cmb_alokasi == "SITE") {
            // $text1 = $cmb_estate;
            $text1 = "EST";
            $text2 = "SWJ";
            // $dig_1 = "6";
        } else if ($cmb_alokasi == "RO") {
            $text1 = "ROM";
            $text2 = "PKY";
            // $dig_1 = "2";
        } else if ($cmb_alokasi == "PKS") {
            $text1 = "FAC";
            $text2 = "SWJ";
            // $dig_1 = "3";
        }

        //dig_1 itu kebun
        $kode_devisi    = $this->input->post('kode_dev');
        $nmr_depan_dev = preg_replace("/[^1-9]/", "", $kode_devisi);

        if ($this->session->userdata('status_lokasi') == "HO") {
            $dig_2 = "1";
        } else {
            $dig_2 = "2";
        }

        $key = $nmr_depan_dev . $dig_2;

        $hitung_key = strlen($key);
        $query_ppo = "SELECT MAX(SUBSTRING(noppotxt, $hitung_key+1)) as maxspp from ppo_tmp WHERE noppotxt LIKE '$key%'";
        $generate_ppo = $this->db_logistik_center->query($query_ppo)->row();
        $noUrut = (int)($generate_ppo->maxspp);
        $noUrut++;
        $print = sprintf("%05s", $noUrut);

        if (empty($this->input->post('hidden_no_spp'))) {
            $nospp = $nmr_depan_dev . $dig_2 . $print;
        } else {
            $nospp = $this->input->post('hidden_no_spp');
        }

        $tgl_trm = date("Y-m-d", strtotime($this->input->post('txt_tgl_terima')));

        $getmonth = date("m", strtotime($this->input->post('txt_tgl_ref')));
        $getyear = date("y", strtotime($this->input->post('txt_tgl_ref')));

        $noref = $text1 . "-" . $_POST['cmb_jenis_permohonan'] . "/" . $text2 . "/" . $getmonth . "/" . $getyear . "/" . $nospp;

        $periode = date("Y-m-d", strtotime($this->session->userdata('Ymd_periode')));
        $d_periode =  date("j", strtotime($periode));
        if ($d_periode >= 26) {
            $periodetxt = date("Ym", strtotime($this->session->userdata('Ymd_periode') . " +1 month"));
        } else {
            $periodetxt = date("Ym", strtotime($this->session->userdata('Ymd_periode')));
        }
        $thn = date("Y", strtotime($this->session->userdata('Ymd_periode')));

        $data['devisi'] = $this->db_logistik_pt->get_where('tb_devisi', array('kodetxt' => $kode_devisi))->row_array();

        $data_ppo = [
            'kpd' => 'Bagian Purchasing',
            'noppo' => $nospp,
            'noppotxt' => $nospp,
            'jenis' => $this->input->post('cmb_jenis_permohonan'),
            'tglppo' => $this->input->post('txt_tgl_spp'),
            'tglppotxt' => date("Ymd", strtotime($this->input->post('txt_tgl_spp'))),
            'tgltrm' => $tgl_trm . date(" H:i:s"),
            'kodedept' => $this->input->post('cmb_departemen'),
            'namadept' => $data['nama_dept']['nama'],
            'kode_dev' => $kode_devisi,
            'devisi' => $data['devisi']['PT'],
            'noref' => $nospp,
            'noreftxt' => $noref,
            'tglref' => $periode,
            'ket' => $this->input->post('txt_keterangan'),
            'no_acc' => 0,
            'ket_acc' => "",
            'pt' => $this->session->userdata('pt'),
            'kodept' => $this->session->userdata('kode_pt'),
            'periode' => $periode,
            'periodetxt' => $periodetxt,
            'thn' => $thn,
            'tglisi' => date("Y-m-d H:i:s"),
            'id_user' => $id_user,
            'user' => $this->session->userdata('user'),
            'status' => 'DALAM PROSES',
            'status2' => '0',
            'lokasi' => $this->session->userdata('status_lokasi'),
            'po' => 0,
            'kode_budget' => 0,
            'grup' => 0,
            'main_acct' => 0,
            'nama_main' => 0,
        ];



        $data_item_ppo = [
            'noppo' => $nospp,
            'noppotxt' => $nospp,
            'jenis' => $this->input->post('cmb_jenis_permohonan'),
            'tglppo' => $this->input->post('txt_tgl_spp'),
            'tglppotxt' => date("Ymd", strtotime($this->input->post('txt_tgl_spp'))),
            'kodedept' => $this->input->post('cmb_departemen'),
            'namadept' => $data['nama_dept']['nama'],
            'noref' => $nospp,
            'noreftxt' => $noref,
            'kodebar' => 0,
            'kodebartxt' => 0,
            'nabar' => $this->input->post('hidden_nama_brg'),
            'sat' => $this->input->post('hidden_satuan_brg'),
            'qty' => $this->input->post('txt_qty'),
            'qty2' => NULL,
            'stok' => $this->input->post('hidden_stok'),
            'harga' => "0",
            'jumharga' => "0",
            'kodept' => $this->session->userdata('kode_pt'),
            'namapt' => $this->session->userdata('pt'),
            'kode_dev' => $kode_devisi,
            'devisi' => $data['devisi']['PT'],
            'periode' => $periode,
            'periodetxt' => $periodetxt,
            'thn' => $thn,
            'ket' => $this->input->post('txt_keterangan_rinci'),
            'tglisi' => date("Y-m-d H:i:s"),
            'id_user' => $id_user,
            'user' => $this->session->userdata('user'),
            'status' => 'DALAM PROSES',
            'status2' => '0',
            'ada_penawar' => '',
            'lokasi' => $this->session->userdata('status_lokasi'),
            'po' => "0",
            'saldo_po' => "0",
            'kode_budget' => "0",
            'grup' => "0",
            'main_acct' => "0",
            'nama_main' => "",
        ];



        //cek koneksi
        $con = $this->db_logistik_pt;

        $connected = $con->initialize();
        if (!$connected) {
            // ga ada koneksi
            $data_return = 'conn_failed';
        } else {
            if (empty($this->input->post('hidden_no_spp'))) {
                $data = $this->M_spp->saveSpp_tmp($data_ppo);

                $data2 = $this->M_spp->saveSpp2_tmp($data_item_ppo);
                $item_exist = 0;
            } else {

                $cek_isi_item = $this->M_spp->cari_item_spp($data_item_ppo['kodebar'], $data_item_ppo['noreftxt']);

                if ($cek_isi_item >= 1) {
                    $item_exist = 1;
                    $data = NULL;
                    $data2 = NULL;
                } else {
                    $data2 = $this->M_spp->saveSpp2_tmp($data_item_ppo);
                    $item_exist = 0;
                    $data = NULL;
                }
            }

            // cari id terakhir
            $query_id = "SELECT MAX(id) as id_ppo FROM ppo_tmp WHERE id_user = '$id_user' AND noreftxt ='$noref'";
            $generate_id = $this->db_logistik_center->query($query_id)->row();
            $id_ppo = $generate_id->id_ppo;

            $query_id_item = "SELECT MAX(id) as id_item_ppo FROM item_ppo_tmp WHERE id_user = '$id_user' AND noreftxt ='$noref'";
            $generate_id_item = $this->db_logistik_center->query($query_id_item)->row();
            $id_item_ppo = $generate_id_item->id_item_ppo;

            $data_return = [
                'data' => $data,
                'data2' => $data2,
                'nospp' => $nospp,
                'noref' => $noref,
                'id_ppo' => $id_ppo,
                'id_item_ppo' => $id_item_ppo,
                'item_exist' => $item_exist
            ];
        }

        echo json_encode($data_return);
    }

    public function saveSppEdit()
    {
        $periode = date("Y-m-d", strtotime($this->input->post('hidden_periode')));
        $d_periode =  date("j", strtotime($periode));
        if ($d_periode >= 26) {
            $periodetxt = date("Ym", strtotime($this->input->post('hidden_periode') . " +1 month"));
        } else {
            $periodetxt = date("Ym", strtotime($this->input->post('hidden_periode')));
        }
        $thn = date("Y", strtotime($this->input->post('hidden_periode')));
        $id_user = $this->session->userdata('id_user');
        $noref = $this->input->post('hidden_noref_spp');
        $nospp = $this->input->post('hidden_no_spp');

        $data_item_ppo = [
            'noppo' => $nospp,
            'noppotxt' => $nospp,
            'tglppo' => $this->input->post('hidden_tglppo'),
            'tglppotxt' => date("Ymd", strtotime($this->input->post('hidden_tglppo'))),
            'kodedept' => $this->input->post('hidden_kodedept'),
            'namadept' => $this->input->post('hidden_namadept'),
            'noref' => $nospp,
            'noreftxt' => $noref,
            'kodebar' => $this->input->post('hidden_kode_brg'),
            'kodebartxt' => $this->input->post('hidden_kode_brg'),
            'nabar' => $this->input->post('hidden_nama_brg'),
            'sat' => $this->input->post('hidden_satuan_brg'),
            'qty' => $this->input->post('txt_qty'),
            'qty2' => NULL,
            'stok' => $this->input->post('hidden_stok'),
            'harga' => "0",
            'jumharga' => "0",
            'kodept' => $this->session->userdata('kode_pt'),
            'namapt' => $this->session->userdata('pt'),
            'periode' => $periode,
            'periodetxt' => $periodetxt,
            'thn' => $thn,
            'ket' => $this->input->post('txt_keterangan_rinci'),
            'tglisi' => date("Y-m-d H:i:s"),
            'id_user' => $id_user,
            'user' => $this->session->userdata('user'),
            'status' => 'DALAM PROSES',
            'status2' => '0',
            'ada_penawar' => '',
            'lokasi' => $this->session->userdata('status_lokasi'),
            'po' => "0",
            'saldo_po' => "0",
            'kode_budget' => "0",
            'grup' => "0",
            'main_acct' => "0",
            'nama_main' => "",
        ];
        $data_item_ppo_histori = [
            'noppo' => $nospp,
            'noppotxt' => $nospp,
            'tglppo' => $this->input->post('hidden_tglppo'),
            'tglppotxt' => date("Ymd", strtotime($this->input->post('hidden_tglppo'))),
            'kodedept' => $this->input->post('hidden_kodedept'),
            'namadept' => $this->input->post('hidden_namadept'),
            'noref' => $nospp,
            'noreftxt' => $noref,
            'kodebar' => $this->input->post('hidden_kode_brg'),
            'kodebartxt' => $this->input->post('hidden_kode_brg'),
            'nabar' => $this->input->post('hidden_nama_brg'),
            'sat' => $this->input->post('hidden_satuan_brg'),
            'qty' => $this->input->post('txt_qty'),
            'qty2' => NULL,
            'stok' => $this->input->post('hidden_stok'),
            'harga' => "0",
            'jumharga' => "0",
            'kodept' => $this->session->userdata('kode_pt'),
            'namapt' => $this->session->userdata('pt'),
            'periode' => $periode,
            'periodetxt' => $periodetxt,
            'thn' => $thn,
            'ket' => $this->input->post('txt_keterangan_rinci'),
            'tglisi' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata('user'),
            'status' => 'DALAM PROSES',
            'status2' => '0',
            'ada_penawar' => '-',
            'lokasi' => $this->session->userdata('status_lokasi'),
            'po' => "0",
            'saldo_po' => "0",
            'kode_budget' => "0",
            'grup' => "0",
            'main_acct' => "0",
            'nama_main' => "",
            'keterangan_transaksi' => "UPDATE SPP",
            'log' => $this->session->userdata('user') . " mengubah ITEM SPP $nospp",
            'tgl_transaksi' => date("Y-m-d H:i:s"),
            'user_transaksi' => $this->session->userdata('user'),
            'client_ip' => $this->input->ip_address(),
            'client_platform' =>  $this->platform->agent(),
        ];

        $cek_isi_item = $this->M_spp->cari_item_spp($data_item_ppo['kodebar'], $data_item_ppo['noreftxt']);

        if ($cek_isi_item >= 1) {
            $item_exist = 1;
            $data = NULL;
            $data2 = NULL;
        } else {
            $data2 = $this->M_spp->saveSpp2($data_item_ppo);
            $data_item_histori = $this->M_spp->saveSpp3($data_item_ppo_histori);
            $item_exist = 0;
            $data = NULL;
        }

        // cari id terakhir
        $query_id = "SELECT MAX(id) as id_ppo FROM ppo WHERE id_user = '$id_user' AND noreftxt ='$noref'";
        $generate_id = $this->db_logistik_pt->query($query_id)->row();
        $id_ppo = $generate_id->id_ppo;

        $query_id_item = "SELECT MAX(id) as id_item_ppo FROM item_ppo WHERE id_user = '$id_user' AND noreftxt ='$noref'";
        $generate_id_item = $this->db_logistik_pt->query($query_id_item)->row();
        $id_item_ppo = $generate_id_item->id_item_ppo;

        $data_return = [
            'data' => $data,
            'data2' => $data2,
            'nospp' => $nospp,
            'noref' => $noref,
            'id_ppo' => $id_ppo,
            'id_item_ppo' => $id_item_ppo,
            'item_exist' => $item_exist
        ];
        echo json_encode($data_return);
    }

    public function cancelUpdateItemSpp()
    {
        $id_item_ppo = $this->input->post('hidden_id_item_ppo');
        $id_ppo = $this->input->post('hidden_id_ppo');

        $data = $this->M_spp->cancelUpdateItemSpp($id_item_ppo, $id_ppo);

        echo json_encode($data);
    }

    public function updateSpp()
    {
        // $data['nama_dept'] = $this->M_spp->namaDept($this->input->post("cmb_departemen"));

        $tgl_trm = date("Y-m-d", strtotime($this->input->post('txt_tgl_terima')));

        $noref = $this->input->post('noref');

        $id_ppo = $this->input->post('hidden_id_ppo');
        $id_item_ppo = $this->input->post('hidden_id_item_ppo');
        $cek = $this->db_logistik_pt->query("SELECT * FROM item_ppo WHERE id='$id_item_ppo'")->row();

        // $data_ppo = [
        //     'jenis' => $this->input->post('cmb_jenis_permohonan'),
        //     'tgltrm' => $tgl_trm . date(" H:i:s"),
        //     'kodedept' => $this->input->post('txt_kode_departemen'),
        //     'namadept' => $data['nama_dept']['nama'],
        //     'ket' => $this->input->post('txt_keterangan'),
        // ];

        $data_item_ppo = [
            // 'kodedept' => $this->input->post('txt_kode_departemen'),
            // 'namadept' => $data['nama_dept']['nama'],
            'kodebar' => $this->input->post('hidden_kode_brg'),
            'kodebartxt' => $this->input->post('hidden_kode_brg'),
            'nabar' => $this->input->post('hidden_nama_brg'),
            'sat' => $this->input->post('hidden_satuan_brg'),
            'qty' => $this->input->post('txt_qty'),
            'stok' => $this->input->post('hidden_stok'),
            'ket' => $this->input->post('txt_keterangan_rinci'),
        ];
        $data_item_ppo_histori = [
            'noppo' => $cek->noppo,
            'noppotxt' => $cek->noppotxt,
            'tglppo' => $cek->tglppo,
            'tglppotxt' => $cek->tglppotxt,
            'kodedept' => $cek->kodedept,
            'namadept' => $cek->namadept,
            'noref' => $cek->noref,
            'noreftxt' => $cek->noreftxt,
            'kodebar' => $cek->kodebar,
            'kodebartxt' => $cek->kodebartxt,
            'nabar' => $cek->nabar,
            'sat' => $cek->sat,
            'qty' => $cek->qty,
            'qty2' => NULL,
            'stok' => $cek->STOK,
            'harga' => "0",
            'jumharga' => "0",
            'kodept' => $this->session->userdata('kode_pt'),
            'namapt' => $this->session->userdata('pt'),
            'periode' => $cek->periode,
            'periodetxt' => $cek->periodetxt,
            'thn' => $cek->thn,
            'ket' => $cek->ket,
            'tglisi' => $cek->tglisi,
            'user' => $this->session->userdata('user'),
            'status' => $cek->status,
            'status2' => $cek->status2,
            'ada_penawar' => '-',
            'lokasi' => $this->session->userdata('status_lokasi'),
            'po' => "0",
            'saldo_po' => "0",
            'kode_budget' => "0",
            'grup' => "0",
            'main_acct' => "0",
            'nama_main' => "-",
            'keterangan_transaksi' => "UPDATE SPP",
            'log' => $this->session->userdata('user') . " mengubah ITEM SPP $cek->noppo",
            'tgl_transaksi' => date("Y-m-d H:i:s"),
            'user_transaksi' => $this->session->userdata('user'),
            'client_ip' => $this->input->ip_address(),
            'client_platform' =>  $this->platform->agent(),
        ];

        // $data = $this->M_spp->updateSpp($id_ppo, $data_ppo);

        $cari_kodebar = $this->db_logistik_pt->get_where('item_ppo', array('id' => $id_item_ppo))->row_array();

        if ($cari_kodebar['kodebar'] != $data_item_ppo['kodebar']) {
            $cek_isi_item = $this->M_spp->cari_item_spp($data_item_ppo['kodebar'], $noref);
            if ($cek_isi_item >= 1) {
                $item_exist = 1;
                $data2 = NULL;
            } else {
                $item_exist = NULL;
                $data2 = $this->M_spp->updateSpp2($id_item_ppo, $data_item_ppo);
                $data_item_histori = $this->M_spp->saveSpp3($data_item_ppo_histori);
            }
        } else {
            $data2 = $this->M_spp->updateSpp2($id_item_ppo, $data_item_ppo);
            $data_item_histori = $this->M_spp->saveSpp3($data_item_ppo_histori);
            $item_exist = NULL;
        }

        $data_return = [
            'data2' => $data2,
            'item_exist' => $item_exist,
        ];

        echo json_encode($data_return);
    }

    public function deleteItemSpp()
    {
        $id_ppo = $this->input->post('hidden_id_ppo');
        $id_ppo_item = $this->input->post('hidden_id_item_ppo');
        $cek = $this->db_logistik_pt->query("SELECT * FROM item_ppo WHERE id='$id_ppo_item'")->row();

        $data_item_ppo_histori = [
            'noppo' => $cek->noppo,
            'noppotxt' => $cek->noppotxt,
            'tglppo' => $cek->tglppo,
            'tglppotxt' => $cek->tglppotxt,
            'kodedept' => $cek->kodedept,
            'namadept' => $cek->namadept,
            'noref' => $cek->noref,
            'noreftxt' => $cek->noreftxt,
            'kodebar' => $cek->kodebar,
            'kodebartxt' => $cek->kodebartxt,
            'nabar' => $cek->nabar,
            'sat' => $cek->sat,
            'qty' => $cek->qty,
            'qty2' => NULL,
            'stok' => $cek->STOK,
            'harga' => "0",
            'jumharga' => "0",
            'kodept' => $this->session->userdata('kode_pt'),
            'namapt' => $this->session->userdata('pt'),
            'periode' => $cek->periode,
            'periodetxt' => $cek->periodetxt,
            'thn' => $cek->thn,
            'ket' => $cek->ket,
            'tglisi' => $cek->tglisi,
            'user' => $this->session->userdata('user'),
            'status' => $cek->status,
            'status2' => $cek->status2,
            'ada_penawar' => '-',
            'lokasi' => $this->session->userdata('status_lokasi'),
            'po' => "0",
            'saldo_po' => "0",
            'kode_budget' => "0",
            'grup' => "0",
            'main_acct' => "0",
            'nama_main' => "-",
            'keterangan_transaksi' => "DELETE SPP",
            'log' => $this->session->userdata('user') . " menghapus ITEM SPP $cek->noppo",
            'tgl_transaksi' => date("Y-m-d H:i:s"),
            'user_transaksi' => $this->session->userdata('user'),
            'client_ip' => $this->input->ip_address(),
            'client_platform' =>  $this->platform->agent(),
        ];
        $data_item_histori = $this->M_spp->saveSpp3($data_item_ppo_histori);

        $data = $this->db_logistik_pt->delete('item_ppo', array('id' => $id_ppo_item));

        echo json_encode($data);
    }

    public function deleteSpp()
    {
        $noref_ppo = $this->input->post('noref_ppo');
        $cek = $this->db_logistik_pt->query("SELECT * FROM ppo WHERE noreftxt='$noref_ppo'")->row();

        $data_ppo_histori = [
            'kpd' => 'Bagian Purchasing',
            'noppo' => $cek->noppo,
            'noppotxt' => $cek->noppotxt,
            'jenis' => $cek->jenis,
            'tglppo' => $cek->tglppo,
            'tglppotxt' => $cek->tglppotxt,
            'tgltrm' => $cek->tgltrm,
            'kodedept' => $cek->kodedept,
            'namadept' => $cek->namadept,

            'noref' => $cek->noref,
            'noreftxt' => $cek->noreftxt,
            'tglref' => $cek->tglref,
            'ket' => $cek->ket,
            'no_acc' => 0,
            'ket_acc' => "",
            'pt' => $this->session->userdata('pt'),
            'kodept' => $this->session->userdata('kode_pt'),
            'periode' => $cek->periode,
            'periodetxt' => $cek->periodetxt,
            'thn' => $cek->thn,
            'tglisi' => $cek->tglisi,
            'user' => $this->session->userdata('user'),
            'status' => $cek->status,
            'status2' => $cek->status2,
            'lokasi' => $this->session->userdata('status_lokasi'),
            'po' => 0,
            'kode_budget' => 0,
            'grup' => 0,
            'main_acct' => 0,
            'nama_main' => 0,
            'keterangan_transaksi' => 'DELETE SPP',
            'log' => $this->session->userdata('user') . " menghapus SPP $cek->noppo",
            'tgl_transaksi' => date("Y-m-d H:i:s"),
            'user_transaksi' => $this->session->userdata('user'),
            'client_ip' => $this->input->ip_address(),
            'client_platform' => $this->platform->agent(),
        ];
        $data_histori = $this->M_spp->saveSppHistori($data_ppo_histori);

        $data = $this->M_spp->deleteSpp($noref_ppo);

        echo json_encode($data);
    }
    //new batal spp
    public function batalSpp()
    {
        $noref_ppo = $this->input->post('noref_ppo');
        $alasan = $this->input->post('alasan');

        $cek = $this->db_logistik_pt->query("SELECT * FROM ppo WHERE noreftxt='$noref_ppo'")->row();

        $data_ppo_histori = [
            'kpd' => 'Bagian Purchasing',
            'noppo' => $cek->noppo,
            'noppotxt' => $cek->noppotxt,
            'jenis' => $cek->jenis,
            'tglppo' => $cek->tglppo,
            'tglppotxt' => $cek->tglppotxt,
            'tgltrm' => $cek->tgltrm,
            'kodedept' => $cek->kodedept,
            'namadept' => $cek->namadept,

            'noref' => $cek->noref,
            'noreftxt' => $cek->noreftxt,
            'tglref' => $cek->tglref,
            'ket' => $cek->ket,
            'no_acc' => 0,
            'ket_acc' => "",
            'pt' => $this->session->userdata('pt'),
            'kodept' => $this->session->userdata('kode_pt'),
            'periode' => $cek->periode,
            'periodetxt' => $cek->periodetxt,
            'thn' => $cek->thn,
            'tglisi' => $cek->tglisi,
            'user' => $this->session->userdata('user'),
            'status' => $cek->status,
            'status2' => $cek->status2,
            'lokasi' => $this->session->userdata('status_lokasi'),
            'po' => 0,
            'kode_budget' => 0,
            'grup' => 0,
            'main_acct' => 0,
            'nama_main' => 0,
            'keterangan_transaksi' => 'BATAL SPP',
            'log' => $this->session->userdata('user') . " membatalkan ITEM SPP $cek->noppo",
            'tgl_transaksi' => date("Y-m-d H:i:s"),
            'user_transaksi' => $this->session->userdata('user'),
            'client_ip' => $this->input->ip_address(),
            'client_platform' => $this->platform->agent(),
        ];
        $data_histori = $this->M_spp->saveSppHistori($data_ppo_histori);

        $data = $this->M_spp->batalSpp($noref_ppo, $alasan);

        echo json_encode($data);
    }

    //end batal spp

    public function sppApproval()
    {
        $this->template->load('template', 'v_spp_approval');
    }
    public function sppApproval_noCoa()
    {
        $data['pt'] = $this->db_logistik_center->get('tb_pt')->result_array();

        $this->template->load('template', 'v_spp_approval_noCoa', $data);
    }

    public function get_data_spp()
    {
        $data = $this->input->post('data');
        $this->M_data_spp->where_datatables($data);
        $list = $this->M_data_spp->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;

            if ($field->status2 == 1) {
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-success">Approved</span></h5>';
            } elseif ($field->status2 == 2) {
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-info">SEBAGIAN</span></h5>';
            } else if ($field->status2 == 5) {
                # code...
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-danger">DIBATALKAN</span></h5>';
            } else {
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-warning">DALAM<br>PROSES</span></h5>';
            }

            if ($field->po == 1) {
                $stat_po = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-success">PO</span></h5>';
            } else {
                $stat_po = '';
            }

            if ($field->status2 == 1) {
                $aks = '<button class="btn btn-success btn-xs fa fa-eye" id="detail_spp_approval" name="detail_spp_approval"
                        data-id_ppo="' . $field->id . '" data-noref_spp="' . $field->noreftxt . '"
                        data-toggle="tooltip" data-placement="top" title="Pilih" style="padding-right:8px;">
                        </button>
                        <a href="' . site_url('Spp/cetak/' . $field->noppotxt . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_spp"></a>';
            } else {
                if ($field->status2 == 5) {
                    # code...
                    $aks = '
                    <button class="btn btn-success btn-xs fa fa-eye" id="detail_spp_approval" name="detail_spp_approval"
                    data-id_ppo="' . $field->id . '" data-noref_spp="' . $field->noreftxt . '"
                    data-toggle="tooltip" data-placement="top" title="Pilih" style="padding-right:8px;">
                    </button>
                    <a href="' . site_url('Spp/cetak/' . $field->noppotxt . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_spp"></a>';
                } else {
                    $aks = '<button class="btn btn-xs btn-warning fa fa-edit" id="edit_spp" name="edit_spp"
                    data-id_ppo="' . $field->id . '"
                    data-toggle="tooltip" data-placement="top" title="detail" onClick="return false" style="padding-right:8px;">
                    </button>
                    <button class="btn btn-success btn-xs fa fa-eye" id="detail_spp_approval" name="detail_spp_approval"
                    data-id_ppo="' . $field->id . '" data-noref_spp="' . $field->noreftxt . '"
                    data-toggle="tooltip" data-placement="top" title="Pilih" style="padding-right:8px;">
                    </button>
                    <a href="' . site_url('Spp/cetak/' . $field->noppotxt . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_spp"></a>';
                    # code...
                }
            }
            $row = array();
            $row[] = $aks;
            $row[] = $no;
            $row[] = $field->noreftxt;
            $row[] = date('d-m-Y', strtotime($field->tglref));
            $row[] = date('d-m-Y', strtotime($field->tgltrm));
            $row[] = $field->namadept;
            $row[] = $field->lokasi;
            $row[] = '<p style="word-break: break-word; margin-top:0px; margin-bottom: 0px;">' . htmlspecialchars($field->ket) . ' </p>';
            $row[] = $stat;
            $row[] = $stat_po;
            $row[] = $field->user;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_data_spp->count_all(),
            "recordsFiltered" => $this->M_data_spp->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function get_spp_noCoa()
    {
        $data = $this->input->post('data');
        $this->M_spp_noCoa->where_datatables($data);
        $list = $this->M_spp_noCoa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;

            if ($field->status2 == 12) {
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-warning">MENUNGGU<br>ACCOUNTING</span></h5>';
            } elseif ($field->status2 == 11) {
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-info">SEBAGIAN</span></h5>';
            } else if ($field->status2 == 5) {
                # code...
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-danger">DIBATALKAN</span></h5>';
            } else {
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-warning">DALAM<br>PROSES</span></h5>';
            }

            if ($field->status2 == 1) {
                $aks = '<button class="btn btn-success btn-xs fa fa-eye" id="detail_spp_approval" name="detail_spp_approval"
                        data-id_ppo="' . $field->id . '" data-noref_spp="' . $field->noreftxt . '"
                        data-toggle="tooltip" data-placement="top" title="Pilih" style="padding-right:8px;">
                        </button>
                        <a href="' . site_url('Spp/cetak_no_coa/' . $field->noppotxt . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_spp"></a>';
            } else {
                if ($field->status2 == 5) {
                    # code...
                    $aks = '
                    <button class="btn btn-success btn-xs fa fa-eye" id="detail_spp_approval" name="detail_spp_approval"
                    data-id_ppo="' . $field->id . '" data-noref_spp="' . $field->noreftxt . '"
                    data-toggle="tooltip" data-placement="top" title="Pilih" style="padding-right:8px;">
                    </button>
                    <a href="' . site_url('Spp/cetak_no_coa/' . $field->noppotxt . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_spp"></a>';
                } else {
                    $aks = '<button class="btn btn-xs btn-warning fa fa-edit" id="edit_spp" name="edit_spp"
                    data-id_ppo="' . $field->id . '"
                    data-toggle="tooltip" data-placement="top" title="detail" onClick="return false" style="padding-right:8px;">
                    </button>
                    <button class="btn btn-success btn-xs fa fa-eye" id="detail_spp_approval" name="detail_spp_approval"
                    data-id_ppo="' . $field->id . '" data-noref_spp="' . $field->noreftxt . '"
                    data-toggle="tooltip" data-placement="top" title="Pilih" style="padding-right:8px;">
                    </button>
                    <a href="' . site_url('Spp/cetak_no_coa/' . $field->noppotxt . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_spp"></a>';
                    # code...
                }
            }
            $row = array();
            $row[] = $aks;
            $row[] = $no;
            $row[] = $field->noreftxt;
            $row[] = date('d-m-Y', strtotime($field->tglref));
            $row[] = date('d-m-Y', strtotime($field->tgltrm));
            $row[] = $field->namadept;
            $row[] = $field->lokasi;
            $row[] = '<p style="word-break: break-word; margin-top:0px; margin-bottom: 0px;">' . htmlspecialchars($field->ket) . ' </p>';
            $row[] = $stat;
            $row[] = $field->user;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_spp_noCoa->count_all(),
            "recordsFiltered" => $this->M_spp_noCoa->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function getDetailSpp()
    {
        $noppo = $this->input->post('hidden_noppotxt');
        $result = $this->M_data_spp->getDetailSpp($noppo);

        echo json_encode($result);
    }

    public function data_spp_approval_noCOA()
    {
        $data = $this->input->post('data');
        $this->M_approval_spp_no_coa->where_datatables($data);
        $list = $this->M_approval_spp_no_coa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            if ($field->status2 == 2) {
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-info">SEBAGIAN</span></h5>';
            } else {
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-warning">DALAM<br>PROSES</span></h5>';
            }

            $norefspp = "'" . $field->noreftxt . "'";
            $pt = "'" . $field->pt . "'";
            $alias = "'" . $field->alias . "'";

            $row = array();
            $row[] = '<a href="javascript:;" id="spp_appproval">
            <button class="btn btn-info btn-xs" id="detail_spp_approval" name="detail_spp_approval" data-toggle="tooltip" data-placement="top" title="Approval" onClick="modalSppApprove(' . $field->id . ',' . $norefspp . ',' . $pt . ',' . $alias . ')" > Approval
            </button>
        </a>';
            // $row[] = '<button class="btn btn-info btn-xs" style="font-size: 11px;" id="detail_spp_approval" name="detail_spp_approval"
            // data-id_ppo="' . $field->id . '" data-noref_spp="' . $field->noreftxt . '"
            // data-toggle="tooltip" data-placement="top" title="Approve">Approve
            // </button>';
            $row[] = $no;
            $row[] = $field->noreftxt;
            $row[] = $field->pt;
            $row[] = $field->namadept;
            $row[] = $field->lokasi;
            $row[] = $stat;
            $row[] = $field->user;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_approval_spp_no_coa->count_all(),
            "recordsFiltered" => $this->M_approval_spp_no_coa->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    public function get_data_spp_approval()
    {
        $list = $this->M_data_spp_approval->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            if ($field->status2 == 2) {
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-info">SEBAGIAN</span></h5>';
            } else {
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-warning">DALAM<br>PROSES</span></h5>';
            }

            $row = array();
            $row[] = '<button class="btn btn-info btn-xs" style="font-size: 11px;" id="detail_spp_approval" name="detail_spp_approval"
            data-id_ppo="' . $field->id . '" data-noref_spp="' . $field->noreftxt . '"
            data-toggle="tooltip" data-placement="top" title="Approve">Approve
            </button>';
            $row[] = $no;
            $row[] = $field->noreftxt;
            $row[] = date('d-m-Y', strtotime($field->tglref));
            $row[] = date('d-m-Y', strtotime($field->tgltrm));
            $row[] = $field->namadept;
            $row[] = $field->lokasi;
            $row[] = '<p style="word-break: break-word; margin-top:0px; margin-bottom: 0px;">' . htmlspecialchars($field->ket) . '</p>';
            $row[] = $stat;
            $row[] = $field->user;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_data_spp_approval->count_all(),
            "recordsFiltered" => $this->M_data_spp_approval->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    public function get_spp_approvalNoCoa()
    {
        $list = $this->M_spp_approvalNoCoa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            if ($field->status2 == 2) {
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-info">SEBAGIAN</span></h5>';
            } else {
                $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-warning">DALAM<br>PROSES</span></h5>';
            }

            $row = array();
            $row[] = '<button class="btn btn-info btn-xs" style="font-size: 11px;" id="detail_spp_approval" name="detail_spp_approval"
            data-id_ppo="' . $field->id . '" data-noref_spp="' . $field->noreftxt . '"
            data-toggle="tooltip" data-placement="top" title="Approve">Approve
            </button>';
            $row[] = $no;
            $row[] = $field->noreftxt;
            $row[] = date('d-m-Y', strtotime($field->tglref));
            $row[] = date('d-m-Y', strtotime($field->tgltrm));
            $row[] = $field->namadept;
            $row[] = $field->lokasi;
            $row[] = '<p style="word-break: break-word; margin-top:0px; margin-bottom: 0px;">' . htmlspecialchars($field->ket) . '</p>';
            $row[] = $stat;
            $row[] = $field->user;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_spp_approvalNoCoa->count_all(),
            "recordsFiltered" => $this->M_spp_approvalNoCoa->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function getDetailSppApproval()
    {
        $noppo = $this->input->post('hidden_noppotxt');
        $result = $this->M_data_spp_approval->getDetailSppApproval($noppo);

        echo json_encode($result);
    }

    public function approval_spp1()
    {
        $id_item_spp = $this->input->post('id_item_spp');
        $result = $this->M_data_spp_approval->approval_spp1($id_item_spp);

        echo json_encode($result);
    }

    public function edit_spp()
    {
        $id_ppo = $this->uri->segment('3');
        $data['id_ppo_edit'] = $id_ppo;

        $this->template->load('template', 'v_spp_edit', $data);
    }

    public function cari_spp_edit()
    {
        $id_ppo = $this->input->post('id_ppo');
        $result = $this->M_data_spp->cari_spp_edit($id_ppo);

        echo json_encode($result);
    }

    function update_alasan()
    {
        $noref_ppo = $this->input->post('noref_ppo');
        $alasan_edit = $this->input->post('alasan');
        $result = $this->M_spp->update_alasan($noref_ppo, $alasan_edit);

        echo json_encode($result);
    }

    function cetak()
    {
        $nospp = $this->uri->segment('3');
        $id = $this->uri->segment('4');
        $data['id'] = $id;
        $data['nospp'] = $nospp;

        $data['urut'] = $this->M_spp->urut_cetak($nospp);

        $data['ppo'] = $this->db_logistik_pt->get_where('ppo', array('noppotxt' => $nospp, 'id' => $id))->row();

        $noreftxt = $data['ppo']->noreftxt;
        $data['item_ppo'] = $this->db_logistik_pt->get_where('item_ppo', array('noreftxt' => $noreftxt))->result();

        $query_approval = "SELECT DISTINCT nama_approval_ktu, tgl_approval_ktu, nama_approval_dept_head, tgl_approval_dept_head, nama_approval_gm, tgl_approval_gm FROM item_ppo_approval WHERE noreftxt = '$noreftxt' AND status2_ktu = '4' AND status2_dept_head = '1'";
        $data['item_ppo_approval'] = $this->db_logistik_pt->query($query_approval)->row();

        $noref = $data['ppo']->noreftxt;
        $this->qrcode($nospp, $id, $noref);
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => [190, 236],
            'format' => 'A4',
            // 'setAutoTopMargin' => 'stretch',
            'margin_top' => '2',
            'margin_left' => '5',
            'margin_right' => '5',
            'orientation' => 'P'
        ]);

        // $pdf = new \Mpdf\Mpdf([
        // 			'mode' => 'utf-8',
        // 			'format' => 'A4'.($orientation == 'L' ? '-L' : ''),
        // 			'orientation' => $orientation,
        // 			'margin_left' => $margin_left,
        // 			'margin_right' => $margin_right,
        // 			'margin_top' => $margin_top,
        // 			'margin_bottom' => $margin_bottom,
        // 			'margin_header' => 0,
        // 			'margin_footer' => 0,
        // 		]);

        // $mpdf->SetHTMLHeader('<h3>' . $data['ppo']->devisi . '</h3>');
        // $mpdf->SetHTMLHeader('
        //                     <table width="100%" border="0" align="center">
        //                         <tr>
        //                             <td rowspan="2" width="15%" height="10px"><img width="10%" height="60px" style="padding-left:8px" src="././assets/img/msal.jpg"></td>
        //                             <td align="center" style="font-size:14px;font-weight:bold;">PT Mulia Sawit Agro Lestari</td>
        //                         </tr>
        //                         <tr>
        //                             <td align="center">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
        //                             </td>
        //                         </tr>
        //                     </table>
        //                     <hr style="width:100%;">
        //                     ');
        // $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');

        if ($data['ppo']->status2 == 5) {
            # code...
            $mpdf->SetWatermarkImage(
                '././assets/img/batal.png',
                0.3,
                '',
                array(25, 5)
            );
            $mpdf->showWatermarkImage = true;
        }

        // var_dump($data) . die();

        $html = $this->load->view('v_spp_print', $data, true);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    function cetak_no_coa()
    {
        $nospp = $this->uri->segment('3');
        $id = $this->uri->segment('4');
        $data['id'] = $id;
        $data['nospp'] = $nospp;

        $data['urut'] = $this->M_spp->urut_cetak_no_coa($nospp);

        $data['ppo'] = $this->db_logistik_center->get_where('ppo_tmp', array('noppotxt' => $nospp, 'id' => $id))->row();

        $noreftxt = $data['ppo']->noreftxt;
        $data['item_ppo'] = $this->db_logistik_center->get_where('item_ppo_tmp', array('noreftxt' => $noreftxt))->result();

        $query_approval = "SELECT DISTINCT nama_approval_ktu, tgl_approval_ktu, nama_approval_dept_head, tgl_approval_dept_head, nama_approval_gm, tgl_approval_gm FROM item_ppo_approval WHERE noreftxt = '$noreftxt' AND status2_ktu = '4' AND status2_dept_head = '1'";
        $data['item_ppo_approval'] = $this->db_logistik_pt->query($query_approval)->row();

        $noref = $data['ppo']->noreftxt;
        $this->qrcode($nospp, $id, $noref);
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => [190, 236],
            'format' => 'A4',
            // 'setAutoTopMargin' => 'stretch',
            'margin_top' => '2',
            'margin_left' => '5',
            'margin_right' => '5',
            'orientation' => 'P'
        ]);

        // $pdf = new \Mpdf\Mpdf([
        // 			'mode' => 'utf-8',
        // 			'format' => 'A4'.($orientation == 'L' ? '-L' : ''),
        // 			'orientation' => $orientation,
        // 			'margin_left' => $margin_left,
        // 			'margin_right' => $margin_right,
        // 			'margin_top' => $margin_top,
        // 			'margin_bottom' => $margin_bottom,
        // 			'margin_header' => 0,
        // 			'margin_footer' => 0,
        // 		]);

        // $mpdf->SetHTMLHeader('<h3>' . $data['ppo']->devisi . '</h3>');
        // $mpdf->SetHTMLHeader('
        //                     <table width="100%" border="0" align="center">
        //                         <tr>
        //                             <td rowspan="2" width="15%" height="10px"><img width="10%" height="60px" style="padding-left:8px" src="././assets/img/msal.jpg"></td>
        //                             <td align="center" style="font-size:14px;font-weight:bold;">PT Mulia Sawit Agro Lestari</td>
        //                         </tr>
        //                         <tr>
        //                             <td align="center">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
        //                             </td>
        //                         </tr>
        //                     </table>
        //                     <hr style="width:100%;">
        //                     ');
        // $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');

        if ($data['ppo']->status2 == 5) {
            # code...
            $mpdf->SetWatermarkImage(
                '././assets/img/batal.png',
                0.3,
                '',
                array(25, 5)
            );
            $mpdf->showWatermarkImage = true;
        }

        $html = $this->load->view('v_spp_print', $data, true);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function qrcode($nospp, $id, $noref)
    {
        $this->load->library('Ciqrcode');
        // header("Content-Type: image/png");

        $config['cacheable']    = false; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/spp/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $id . '_' . $nospp . '.png'; //buat name dari qr code

        // $params['data'] = site_url('lpb/cetak/'.$no_lpb.'/'.$id); //data yang akan di jadikan QR CODE
        $params['data'] = $noref; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
    }

    function get_detail_approval()
    {
        $id_ppo = $this->input->post('id_ppo');
        $noreftxt = $this->M_approval_spp->get_noref($id_ppo);
        $this->M_approval_spp->getWhere($noreftxt['noreftxt']);
        $list = $this->M_approval_spp->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            if ($d->status2 == "1") {
                $tgl_approve = date('d-m-Y H:i:s', strtotime($d->TGL_APPROVE));
                $status = "<h6 style='color: green; margin-top:0px; margin-bottom:0px;'><b>DISETUJUI (" . $tgl_approve . ")</b></h6>";
            } else {
                $status = "<h6 style='margin-top:0px; margin-bottom:0px;'>DALAM PROSES</h6>";
            }
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $d->id;
            $row[] = $d->kodebar;
            $row[] = $d->nabar;
            $row[] = $d->sat;
            $row[] = $d->qty;
            $row[] = $d->STOK;
            $row[] = '<p style="word-break: break-word; margin-top:0px; margin-bottom:0px;">' . htmlspecialchars($d->ket) . '</p>';
            // $row[] = '<button class="btn btn-xs btn-primary" type="button" disabled>Qty</button>';
            $row[] = $status;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_approval_spp->count_all(),
            "recordsFiltered" => $this->M_approval_spp->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function get_detail_noCoa()
    {
        $id_ppo = $this->input->post('id_ppo');
        $noreftxt = $this->M_detail_sppNoCoa->get_noref($id_ppo);
        $this->M_detail_sppNoCoa->getWhere($noreftxt['noreftxt']);
        $list = $this->M_detail_sppNoCoa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            if ($d->status2 == "1") {
                $tgl_approve = date('d-m-Y H:i:s', strtotime($d->TGL_APPROVE));
                $status = "<h6 style='color: green; margin-top:0px; margin-bottom:0px;'><b>DISETUJUI (" . $tgl_approve . ")</b></h6>";
            } else {
                $status = "<h6 style='margin-top:0px; margin-bottom:0px;'>DALAM PROSES</h6>";
            }
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $d->kodebar;
            $row[] = $d->nabar;
            $row[] = $d->sat;
            $row[] = $d->qty;
            $row[] = $d->STOK;
            $row[] = '<p style="word-break: break-word; margin-top:0px; margin-bottom:0px;">' . htmlspecialchars($d->ket) . '</p>';
            // $row[] = '<button class="btn btn-xs btn-primary" type="button" disabled>Qty</button>';
            $row[] = $status;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_detail_sppNoCoa->count_all(),
            "recordsFiltered" => $this->M_detail_sppNoCoa->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function detail_approval_noCOA()
    {
        $id_ppo = $this->input->post('id_ppo');
        $noreftxt = $this->M_detail_sppNoCoa->get_noref($id_ppo);
        $this->M_detail_sppNoCoa->getWhere($noreftxt['noreftxt']);
        $list = $this->M_detail_sppNoCoa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            if ($d->status2 != 9) {
                $status = "<h5 style='margin-top:0px; margin-bottom:0px;'><span class='badge badge-warning'>Menunggu<br>Accounting</span></h5>";
                $nabar = '<input type="text" class="form-control form-control-sm bg-light" id="nama_' . $d->id . '" value="' . $d->nabar . '" disabled>';
                $grp = '<input type="text" class="form-control form-control-sm bg-light" id="grp_coa_' . $d->id . '" value="' . $d->grup . '" disabled>';
            } else {
                $nabar = '<a href="javascript:;" id="namabarang">
                <input type="text" class="form-control form-control-sm" onkeyup="inputtest(' . $d->id . ')" id="nama_' . $d->id . '" value="' . $d->nabar . '">
                <input type="hidden" id="id_nocoa_' . $d->id . '" value="' . $d->id . '">
                <input type="hidden" id="noref_' . $d->id . '" value="' . $d->noreftxt . '">
                <input type="hidden" id="kodebar_' . $d->id . '" value="' . $d->kodebar . '">
                </a>';

                $grp = "<select class='form-control form-control-sm grp_coa' id='grp_coa_" . $d->id . "' onClick='get_grub(" . $d->id . ")'  style='font-size: 12px;'> 
                <option value='" . $d->grup . "' selected>  $d->grup </option>
           </select>";


                $status = '
                <a href="javascript:;" id="btn_appprove">
                <button type="button" onClick="validasi_approve(' . $d->id . ')" id="simpan_approve_' . $d->id . '" class="btn btn-success waves-effect waves-light btn-xs"><i class="mdi mdi-check-all"></i></button>
                </a>
                <a href="javascript:;" id="btn_no_appprove">
                <button type="button" class="btn btn-danger waves-effect waves-light btn-xs" id="no_approve_' . $d->id . '"><i class="mdi mdi-close"></i></button>
                </a>
                <label id="status_approve_' . $d->id . '"></label>
                ';
            }


            $no++;
            $row = array();
            $row[] = $no . ".";
            // $row[] = $d->nabar;
            $row[] = $nabar;
            $row[] = $grp;
            // $row[] = $status;
            $row[] = $status;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_detail_sppNoCoa->count_all(),
            "recordsFiltered" => $this->M_detail_sppNoCoa->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function approve_noCOA()
    {
        $id = $this->input->post('id');
        $noref = $this->input->post('noref');
        $kodebar = $this->input->post('kodebar');
        $nama = $this->input->post('nama');
        $grp = $this->input->post('grp');
        $status = $this->input->post('status');
        $pt = $this->input->post('pt');
        $alias = $this->input->post('alias');

        $spp_tmp = array(
            'status2' => 1
        );
        $this->M_spp->update_spp_tmp($noref, $kodebar, $spp_tmp, $pt, $alias);

        $data = array('nabar' => $nama, 'grup' => $grp, 'status2' => $status, 'TGL_APPROVE' => date('Y-m-d H:i:s'));
        $d = $this->M_spp->updateNocoa($data, $id, $alias);
        echo json_encode($d);
    }

    function update_ppo_tmp()
    {
        $ref = $this->input->post('noref');
        $alias = $this->input->post('alias');
        $pt = $this->input->post('pt');

        $this->logistik_pt = $this->load->database('db_logistik_' . $alias, TRUE);
        $item1 = $this->logistik_pt->query("SELECT * FROM item_ppo WHERE noreftxt='$ref'")->num_rows();
        $item2 = $this->logistik_pt->query("SELECT * FROM item_ppo WHERE noreftxt='$ref' AND status2='12'")->num_rows();

        if ($item1 == $item2) {
            $data = array('status' => 'MENUNGGU ACCOUNTING', 'status2' => '12');
            $yy = $this->logistik_pt->update('ppo', $data, array('noreftxt' => $ref));

            $dt = array('status' => 'MENUNGGU ACCOUNTING', 'status2' => '12');
            $this->db_logistik_center->update('ppo_tmp', $dt, array('noreftxt' => $ref, 'pt' => $pt));
        } else {
            $data = array('status' => 'SEBAGIAN', 'status2' => '11');
            $yy = $this->logistik_pt->update('ppo', $data, array('noreftxt' => $ref));

            $dt = array('status' => 'SEBAGIAN', 'status2' => '11');
            $this->db_logistik_center->update('ppo_tmp', $dt, array('noreftxt' => $ref, 'pt' => $pt));
        }

        echo json_encode($yy);
    }

    function get_grp_coa()
    {
        $data = $this->M_spp->get_grp_coa();
        echo json_encode($data); # code...
    }

    public function cari_noref_itemppo()
    {
        $noref_spp = $this->input->post('noref_spp');

        $output = $this->M_spp->cari_noref_itemppo($noref_spp);

        if ($output >= 1) {
            $this->M_spp->cek_status_approve($noref_spp);
        }

        echo json_encode($output);
    }

    public function cek_semua_approval()
    {
        $noref_spp = $this->input->post('noref_spp');

        $output = $this->M_spp->cek_semua_approval($noref_spp);

        echo json_encode($output);
    }
}

/* End of file Controllername.php */