<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Po extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('M_po');
        $this->load->model('M_data');
        $this->load->model('M_cariSPP');
        $this->load->model('M_detail');
        $db_pt = check_db_pt();
        // $this->db_logistik = $this->load->database('db_logistik',TRUE);
        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);
        if (!$this->session->userdata('id_user')) {
            $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
            $this->session->set_flashdata('pesan', $pemberitahuan);
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('form_validation');
    }

    function get_ajax()
    {
        // $id = $this->input->post('data');
        // $this->M_po->where_datatables($id);
        $list = $this->M_po->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $d->id;
            $row[] = $d->noppo;
            $row[] = date_format(date_create($d->tglppo), 'd-m-Y');
            $row[] = $d->noreftxt;
            $row[] = $d->namadept;
            $row[] = $d->kodebar;
            $row[] = $d->nabar;
            $row[] = '<p style="word-break: break-word">' . htmlspecialchars($d->ket) . ' </p>';

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_po->count_all(),
            "recordsFiltered" => $this->M_po->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
    function detail()
    {
        $id = $this->input->post('id');
        $this->M_detail->where_datatables($id);
        $list = $this->M_detail->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            // $row[] = '<font style="padding: 0.6em;" face="Verdana" size="2">' . $d->nopo . '</font>';
            // $row[] =  $d->noref;
            $row[] =  $d->refppo;
            // $row[] =  $d->grup ;
            $row[] =  '<p style="word-break: break-word;">' . $d->nabar . '<br>' . $d->kodebar . '</p>';
            $row[] =  $d->qty;
            // $row[] = $d->tglpo;
            $row[] = date_format(date_create($d->tglpo), 'd-m-Y');
            // $row[] = $d->ket;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_detail->count_all(),
            "recordsFiltered" => $this->M_detail->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function edit($id)
    {
        $dt = str_replace('.', '/', $id);

        $po = $this->db_logistik_pt->query("SELECT nopo, pph, ppn FROM po WHERE noreftxt='$dt'")->row();

        $data = [
            'no_po' => $po->nopo,
            'nopo' => $dt,
            'pph' => $po->pph,
            'ppn' => $po->ppn,
            'sesi_sl' => $this->session->userdata('status_lokasi')
        ];


        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";


        $this->template->Load('template', 'v_edit_po', $data);
    }

    public function cari_po_edit()
    {
        $nopo = $this->input->post('nopo');
        $result = $this->M_po->cari_po_edit($nopo);

        echo json_encode($result);
    }

    public function dataPO()
    {
        $list = $this->M_data->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            $no++;
            $noref = str_replace('/', '.', $d->noreftxt);

            if ($d->sudah_lpb == 1) {
                $aksi = '
                <button type="button" id="detail" data-id="' . $d->noreftxt . '"  onClick="return false" class="btn btn-success btn-xs fa fa-eye" title="Detail"></button> 
                <a href="' . base_url('Po/cetak/' . $noref . '/' . $d->id) . '" target="_blank" type="button" id="cetak" class="btn btn-primary btn-xs fa fa-print" title="Cetak">
                </a>
                ';
            } else {
                $aksi = '
                <button type="button" id="edit" data-id="' . $d->noreftxt . '"  onClick="return false" class="btn btn-warning btn-xs fa fa-edit title="Edit"></button>
                <button type="button" id="detail" data-id="' . $d->noreftxt . '"  onClick="return false" class="btn btn-success btn-xs fa fa-eye" title="Detail"></button> 
                <a href="' . base_url('Po/cetak/' . $noref . '/' . $d->id) . '" target="_blank" id="cetak" class="btn btn-primary btn-xs fa fa-print" style="margin-top: 2px;" title="Cetak">
                </a>
                ';
            }

            $row = array();
            $row[] = $aksi;
            $row[] = $no . ".";
            $row[] = $d->noreftxt;
            $row[] = date_format(date_create($d->tglpo), 'd-m-Y');
            $row[] = $d->no_refppo;
            $row[] = date_format(date_create($d->tgl_refppo), 'd-m-Y');
            $row[] = $d->nama_supply;
            $row[] = '<p style="word-break: break-word">' . htmlspecialchars($d->ket) . ' </p>';
            $row[] = $d->terbayar;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_data->count_all(),
            "recordsFiltered" => $this->M_data->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }


    public function get_carispp()
    {
        $list = $this->M_cariSPP->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            $no++;
            $row = array();
            $row[] = '<button class="btn btn-success btn-xs" id="data_spp" name="data_spp"
                    data-id="' . $d->id . '" data-jenis="' . $d->jenis . '"  data-noreftxt="' . $d->noreftxt . '" data-toggle="tooltip" data-placement="top" title="Pilih" onClick="return false">Pilih</button>';
            $row[] =  date_format(date_create($d->tglppo), 'd-m-Y');
            $row[] = $d->noreftxt;
            $row[] = $d->namadept;
            // $row[] = '<div class="ribbon ribbon-danger float-right" id="pesan_"><i class="mdi mdi-access-point mr-1"></i>Habis!</div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_cariSPP->count_all(),
            "recordsFiltered" => $this->M_cariSPP->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function cetak()
    {
        $nopo = str_replace('.', '/', $this->uri->segment('3'));

        $id = $this->uri->segment('4');

        $this->db_logistik_pt->where('id', $id);
        $this->db_logistik_pt->where('noreftxt', $nopo);
        $cek = $this->db_logistik_pt->get_where('po');

        if ($cek->num_rows() > 0) {
            $cek = $cek->row();
            $jml_ = (int)$cek->jml_cetak;
            // echo $jml_;
            $up = [
                'jml_cetak' => $jml_ + 1
            ];
            $this->db_logistik_pt->where('id', $id);
            $this->db_logistik_pt->where('noreftxt', $nopo);
            $this->db_logistik_pt->update('po', $up);
        } else {
            $ins = [
                'jml_cetak' => 1
            ];
            $this->db_logistik_pt->where('id', $id);
            $this->db_logistik_pt->where('noreftxt', $nopo);
            $this->db_logistik_pt->update('po', $ins);
            // $this->db_logistik_pt->insert('po', $ins);
        }

        $data['pt'] = $this->db_logistik_pt->get_where('pt', array('kodetxt' => '01'))->row();

        $data['po'] = $this->db_logistik_pt->get_where('po', array('noreftxt' => $nopo, 'id' => $id))->row();

        $kode_supplier = $data['po']->kode_supply;
        $qrcode = $data['po']->qr_code;

        // $data['supplier'] = $this->db_logistik_pt->get_where('supplier', array('kode'=>$kode_supplier))->row();

        $query_supplier = "SELECT * FROM supplier WHERE kode = '$kode_supplier' AND account IS NOT NULL";
        $data['supplier'] = $this->db_logistik_pt->query($query_supplier)->row();

        $no_refpo = $data['po']->noreftxt;
        // $no_refspp = $data['po']->no_refppo;
        $data['item_po'] = $this->db_logistik_pt->get_where('item_po', array('noref' => $nopo, 'noref' => $no_refpo))->result();

        $query = "SELECT SUM(jumharga) as totalbayar FROM item_po WHERE noref = '$no_refpo'";
        $data_jum = $this->db_logistik_pt->query($query)->row();

        $query = "SELECT SUM(JUMLAHBPO) as biayalain FROM item_po WHERE noref = '$no_refpo'";
        $data_jum2 = $this->db_logistik_pt->query($query)->row();

        $data['dikurangi_biayalain'] = $data_jum->totalbayar - $data_jum2->biayalain;

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => [190, 236],
            'margin_top' => '28',
            'orientation' => 'P'
        ]);

        // $mpdf->SetWatermarkImage('././assets/img/terbayar.png');
        // $mpdf->showWatermarkImage = true;

        if ($data['po']->terbayar == "1") {
            $mpdf->SetWatermarkText('TERBAYAR');
            $mpdf->showWatermarkText = true;
        }

        if ($data['po']->terbayar == "2") {
            $mpdf->SetWatermarkText('BAYAR SEBAGIAN');
            $mpdf->showWatermarkText = true;
        }

        // $namapt = $data['po']->namapt;
        $namapt = $data['po']->namapt;
        $alamat_ho = $this->session->userdata('alamat_ho');
        $alamat_site = $this->session->userdata('alamat_site');
        $logo_pt = $this->session->userdata('logo_pt');
        $lokasi = $data['po']->lokasi;
        switch ($lokasi) {
            case 'HO':
                $mpdf->SetHTMLHeader('
                <table width="100%" border="0">
                    <tr>
                        <td rowspan="3"  width="8%" height="10px" align="right"><img width="10%" height="60px" style="padding-left:8px" src="././assets/logo/' . $logo_pt . '"></td>
                    <tr>
                    <td align="left" style="font-size:8.5px;"><h3 style="font-size:14px;font-weight:bold;"> ' . $namapt . ' </h3>
                    ' . $alamat_ho . '
                    </td>
                    <td width="10%" height="10px" align="center"><img width="10%" height="60px" style="padding-right:8px" src="././assets/qrcode/po/' .  $qrcode . '"></td>
                    </tr>
                   
                </table>
                
                ');
                break;
            case 'SITE':
            case 'RO':
            case 'PKS':
                $mpdf->SetHTMLHeader('
                <table width="100%" border="0">
                    <tr>
                        <td rowspan="3"  width="10%" height="10px" align="right"><img width="10%" height="65px" style="padding-left:8px" src="././assets/logo/' . $logo_pt . '"></td>
                    <tr>
                    <td align="left" style="font-size:8.5px; vertical-align: top; "><h3 style="font-size:14px; font-weight:bold;">' . $namapt . '</h3>
                    ' . $alamat_site . '
                    </td>
                    <td width="10%" height="10px" align="center"><img width="10%" height="60px" style="padding-right:8px" src="././assets/qrcode/po/' .  $qrcode . '"></td>
                    </tr>
                   
                </table>
                
                ');
                break;
            default:
                break;
        }
        // $mpdf->SetHTMLHeader('<h4>PT MULIA SAWIT AGRO LESTARI</h4>');

        // $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');

        $html = $this->load->view('v_po_print', $data, true);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function index()
    {
        $data = [
            'title' => "Permohonan Order",

        ];
        $this->template->load('template', 'v_dataPo', $data);
    }

    public function input()
    {
        $data = [
            'title' => "Permohonan Order",
            'sesi_sl' => $this->session->userdata('status_lokasi'),
            'devisi' => $this->M_po->cariDevisi()
        ];
        $this->template->load('template', 'v_inputPo', $data);
    }

    public function inputv1()
    {
        $data = [
            'title' => "Permohonan Order",
            'sesi_sl' => $this->session->userdata('status_lokasi')
        ];
        $this->template->load('template', 'v_inputPoIdris', $data);
    }

    public function getPo()
    {
        $data = $this->M_po->get_supplier();
        echo json_encode($data);
    }

    public function getSpp()
    {
        $data = $this->M_po->get_spp();
        echo json_encode($data);
    }

    public function getPoo()
    {
        $data = $this->M_po->get_sup();
        echo json_encode($data);
    }

    public function getid()
    {
        $id = $this->input->post('idspp');
        $noreftxt = $this->input->post('noreftxt');
        $jenis = $this->input->post('jenis');
        $data = $this->M_po->get_id($id, $noreftxt);
        echo json_encode($data);
    }
    public function getitem()
    {
        $data = $this->M_po->get_itemppo();
        echo json_encode($data);
    }

    function sum_ppo()
    {
        $refspp = $this->input->post('refspp');
        $kodebar = $this->input->post('kodebar');

        $queryPPO = "SELECT noreftxt, kodebar, qty, qty2 FROM item_ppo WHERE noreftxt = '$refspp' AND kodebar = '$kodebar' ";
        $data_qty_ppo = $this->db_logistik_pt->query($queryPPO)->row();

        $sisa_qty_ppo  =  number_format($data_qty_ppo->qty - $data_qty_ppo->qty2, 0);

        $data_ppo =  array(
            'po' => 1
        );
        $data_itemppo =  array(
            'po' => 1
        );

        if ($sisa_qty_ppo == 0) {
            $this->M_po->updatePPO2($refspp, $data_ppo);
        } else {
            $this->M_po->updatePPO3($refspp, $kodebar, $data_itemppo);
        }
    }

    function cekdataspp()
    {
        // $noref = "EST-SPPI/SWJ/07/21/6600073";
        $refspp = $this->input->post('refspp');
        $data = $this->M_po->cekdata($refspp);

        echo json_encode($data);
    }

    function updatePPO()
    {
        $refspp = $this->input->post('refspp');
        $data_ppo =  array(

            'po' => 1
        );

        $data = $this->M_po->updatePPO2($refspp, $data_ppo);

        echo json_encode($data);
    }

    function total_bayar()
    {
        $no_po = $this->input->post('no_po');
        $no_ref_po = $this->input->post('no_ref_po');
        $ppn = $this->input->post('ppn');
        $pph = $this->input->post('pph');

        $po = $this->db_logistik_pt->query("SELECT ppn, pph FROM po WHERE nopo = '$no_po' AND noreftxt = '$no_ref_po'")->row();

        $query = "SELECT SUM(jumharga) as totalbayar FROM item_po WHERE nopo = '$no_po' AND noref = '$no_ref_po'";
        $data = $this->db_logistik_pt->query($query)->row();

        $query = "SELECT SUM(JUMLAHBPO) as biayalain FROM item_po WHERE nopo = '$no_po' AND noref = '$no_ref_po'";
        $data2 = $this->db_logistik_pt->query($query)->row();

        $dikurangi_biayalain = $data->totalbayar - $data2->biayalain;

        if ($ppn == 10) {
            $notif = true;
            $jml_ppn = $ppn / 100;
            $total_ppn = $dikurangi_biayalain * $jml_ppn;
        } else {
            $notif = false;
            $total_ppn = 0;
        }

        if ($pph != 0) {
            $jml_pph = $pph / 100;
            $total_pph = $dikurangi_biayalain * $jml_pph;
        } else {
            $total_pph = 0;
        }

        $totbay = $data->totalbayar + $total_ppn + $total_pph;

        $dataedit['totalbayar'] = $totbay;
        $this->db_logistik_pt->set($dataedit);
        $this->db_logistik_pt->where('nopotxt', $no_po);
        $this->db_logistik_pt->where('noreftxt', $no_ref_po);
        $this->db_logistik_pt->update('po');
        if ($this->db_logistik_pt->affected_rows() > 0) {
            $bool_update_po = TRUE;
        } else {
            $bool_update_po = FALSE;
        }

        $output = [
            'notif' => $notif,
            'totbay' => $totbay,
            'total_ppn' => $total_ppn,
            'total_pph' => $total_pph,
        ];

        echo json_encode($output);
    }

    public function get_detail_spp()
    {
        $id = $this->input->post('id');
        $no_spp = $this->input->post('no_spp');
        $no_ref_spp = $this->input->post('no_ref_spp');
        $kodebar = $this->input->post('kodebar');

        $ppo = $this->M_po->get_detail_ppo($no_spp, $no_ref_spp)->row();
        $item_ppo = $this->M_po->get_detail_item_ppo($id, $no_ref_spp, $kodebar)->result();

        echo json_encode(array($ppo, $item_ppo));
    }


    public function save()
    {

        $data['nama_dept'] = $this->M_po->namaDept($this->input->post("hidden_kode_departemen"));
        $lokasibuatspp = substr($this->input->post('hidden_no_ref'), 0, 3);
        switch ($lokasibuatspp) {
            case 'PST': // HO
                $lokasispp = 1;
                break;
            case 'ROM': // RO
                $lokasispp = 2;
                break;
            case 'EST': // SITE
                $lokasispp = 6;
                break;
            case 'FAC': // PKS
                $lokasispp = 3;
                break;
            default:
                break;
        }

        $lokasibuatpo = $this->session->userdata('status_lokasi');
        switch ($lokasibuatpo) {
            case 'HO':
                $lokasipo = 1;
                $kodepo = "BWJ";
                break;
            case 'RO':
                $lokasipo = 2;
                $kodepo = "PKY";
                break;
            case 'SITE':
                $lokasipo = 2;
                $kodepo = "SWJ";
                break;
            case 'PKS':
                $lokasipo = 2;
                $kodepo = "SWJ";
                break;
            default:
                break;
        }

        $key = $lokasispp . $lokasipo;

        $query_po = "SELECT MAX(SUBSTRING(nopotxt, 3)) as maxpo from po WHERE nopotxt LIKE '$key%'";
        $generate_po = $this->db_logistik_pt->query($query_po)->row();
        $noUrut = (int)($generate_po->maxpo);
        $noUrut++;
        $print = sprintf("%05s", $noUrut);

        if (empty($this->input->post('hidden_no_po'))) {
            $no_po = $lokasispp . $lokasipo . $print;
            $nopo = $lokasispp . $lokasipo . $print;
        } else {
            $no_po = $this->input->post('hidden_no_po');
            $nopo = $this->input->post('hidden_no_po');
        }

        $query_id = "SELECT MAX(id)+1 as no_id FROM po";
        $generate_id = $this->db_logistik_pt->query($query_id)->row();
        $no_id = $generate_id->no_id;
        if (empty($no_id)) {
            $no_id = 1;
        }

        $query_id_item = "SELECT MAX(id)+1 as no_id_item FROM item_po";
        $generate_id_item = $this->db_logistik_pt->query($query_id_item)->row();
        $no_id_item = $generate_id_item->no_id_item;
        if (empty($no_id_item)) {
            $no_id_item = 1;
        }

        $hidden_jenis_spp = $this->input->post('hidden_jenis_spp');

        if (!empty($this->input->post('hidden_no_ref_po'))) {
            $norefpo = $this->input->post('hidden_no_ref_po');
        } else {
            // Est/swj/PO-Lokal/11/18/00034 atau Fac/swj/jkt/12/18/6100005 atau Est-POA/swj/jkt/12/18/6100004 atau Est2/swj/jkt/01/16/7100029
            if ($hidden_jenis_spp == "SPP") {
                # code...
                $norefpo = $lokasibuatspp . "/" . $kodepo . "/PO/JKT/" . date('m') . "/" . date('y') . "/" . $no_po;
            } else if ($hidden_jenis_spp == "SPPA") {
                $norefpo = $lokasibuatspp . "/" . $kodepo . "/POA/JKT/" . date('m') . "/" . date('y') . "/" . $no_po;
            } else if ($hidden_jenis_spp == "SPPI") {
                $norefpo = $lokasibuatspp . "/" . $kodepo . "/PO-LOKAL/JKT/" . date('m') . "/" . date('y') . "/" . $no_po;
            } else if ($hidden_jenis_spp == "SPPK") {
                $norefpo = $lokasibuatspp . "/" . $kodepo . "/PO-KHUSUS/JKT/" . date('m') . "/" . date('y') . "/" . $no_po;
            } else {
                $norefpo = $lokasibuatspp . "/" . $kodepo . "/JKT/" . date('m') . "/" . date('y') . "/" . $no_po;
            }
        }

        $tgl_po = date("Y-m-d", strtotime($this->input->post('txt_tgl_po')));
        $tgl_po_txt = date("Ymd", strtotime($this->input->post('txt_tgl_po')));

        $tgl_ppo = date("Y-m-d", strtotime($this->input->post('hidden_tanggal')));
        $tgl_ppo_txt = date("Ymd", strtotime($this->input->post('hidden_tanggal')));

        $tgl_ref = date("Y-m-d", strtotime($this->input->post('hidden_tgl_ref')));
        $tgl_ref_txt = date("Ymd", strtotime($this->input->post('hidden_tgl_ref')));

        if ($this->input->post('cmb_dikirim_ke_kebun') == 'Y') {
            $dikirim_ke_kebun = 1;
        } else {
            $dikirim_ke_kebun = 0;
        }

        if ($this->input->post('txt_disc') != "0" || $this->input->post('txt_disc') != "0.00" || $this->input->post('txt_biaya_lain') != "0" || $this->input->post('txt_biaya_lain') != "0.00") {
            $qty_harga = $this->input->post('txt_qty') * $this->input->post('txt_harga');
            $disc = $this->input->post('txt_disc') / 100;
            $jumharga_pre = $qty_harga - ($qty_harga * $disc);
            $biaya_lain = $this->input->post('txt_biaya_lain');
            $jumharga = $jumharga_pre + $biaya_lain;
        } else {
            $jumharga = $this->input->post('txt_qty') * $this->input->post('txt_harga');
        }

        $pph = $this->input->post('txt_pph');
        if (empty($pph)) {
            $pph = "0";
        }

        //SUM total bayar karna untuk SITE tidak boleh lebih dari 1,5jt
        $txt_jumlah = $this->input->post('txt_jumlah');
        $query = "SELECT SUM(jumharga) as totalbayar FROM item_po WHERE nopo = '$no_po' AND noref = '$norefpo'";
        $data_totbay = $this->db_logistik_pt->query($query)->row();
        if (empty($data_totbay)) {
            $totbay = 0;
        } else {
            $totbay = $data_totbay->totalbayar;
        }
        $totalbayar = $totbay + $txt_jumlah;

        $tanggalQR = date('Y-m-d');

        //  generate qrcode
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/po/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $nopo . '_' . $tanggalQR . '.png'; //buat name dari qr code sesuai dengan nopo

        $params['data'] = $norefpo; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/qrcode/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        // end generate qrcode

        $kode_dev = $this->input->post('devisi');
        $data['devisi'] = $this->db_logistik_pt->get_where('tb_devisi', array('kodetxt' => $kode_dev))->row_array();
        $norefspp = $this->input->post('hidden_no_ref');

        $datainsert = [
            'id' => $no_id,
            'kd_dept' => $data['nama_dept']['kode'],
            'ket_dept' => $this->input->post('hidden_departemen'),
            'kode_dev' => $this->input->post('hidden_kode_devisi'),
            'devisi' => $this->input->post('hidden_devisi'),
            'grup' => $this->input->post('cmb_jenis_budget'),
            'jenis_spp' =>  $this->input->post('hidden_jenis_spp'),
            'kode_budet' => "0",
            'kd_subbudget' => "0",
            'ket_subbudget' => NULL,
            'nama_supply' => $this->input->post('txt_kode_supplier'),
            'kode_supply' => $this->input->post('txt_supplier'),
            'kode_pemesan' => $this->input->post('txt_kode_pemesan'),
            'pemesan' => $this->input->post('txt_pemesan'),
            'nopo' => $no_po,
            'nopotxt' =>  $no_po,
            'noppo' =>  $this->input->post('txt_no_spp'),
            'noppotxt' => $this->input->post('txt_no_spp'),
            'no_refppo' => $norefspp,
            'tgl_refppo' =>  $this->input->post('hidden_tglref'),
            'tgl_reftxt' =>  date("Ymd"),
            'tglpo' =>  date("Y-m-d  H:i:s"),
            'tglpotxt' =>  date("Ymd"),
            'tglppo' =>  $tgl_ppo,
            'tglppotxt' =>   $tgl_ppo_txt,
            'bayar' => $this->input->post('cmb_status_bayar'),
            'tempo_bayar' => $this->input->post('txt_tempo_pembayaran'),
            'lokasikirim' => $this->input->post('txt_lokasi_pengiriman'),
            'tempo_kirim' => $this->input->post('txt_tempo_pengiriman'),
            'lokasi_beli' => $this->input->post('cmb_lokasi_pembelian'),
            'ket' => $this->input->post('txt_keterangan'),
            'kodept' => $this->session->userdata('kode_pt'),
            'namapt' => $this->session->userdata('pt'),
            'ket_acc' => $this->input->post('txt_no_penawaran'),
            'periode' => date('Y-m-d H:i:s'),
            'periodetxt' => date('Ym'),
            'thn' => date('Y'),
            'tglisi' => date('Y-m-d H:i:s'),
            'user' => $this->session->userdata('user'),
            'pph' =>  $this->input->post('cmb_pph'),
            'ppn' =>  $this->input->post('cmb_ppn'),
            'totalbayar' =>  $this->input->post('txt_total_pembayaran'),
            'ket_kirim' => $this->input->post('txt_ket_pengiriman'),
            'lokasi' => $this->session->userdata('status_lokasi'),
            'noreftxt' => $norefpo,
            'uangmuka' => $this->input->post('txt_uang_muka'),
            'voucher' => $this->input->post('txt_no_voucher'),
            'terbayar' => "0",
            'nopp' => NULL,
            'batal' => "0",
            'kirim' => $dikirim_ke_kebun,
            'qr_code' => $image_name
        ];

        $datainsertitem = [
            'id' => $no_id_item,
            'nopo' => $no_po,
            'nopotxt' => $no_po,
            'noppo' => $this->input->post('txt_no_spp'),
            'noppotxt' => $this->input->post('txt_no_spp'),
            'refppo' => $norefspp,
            'tglppo' =>  $tgl_ppo,
            'tglppotxt' => $tgl_ppo_txt,
            'tglpo' =>  date("Y-m-d"),
            'tglpotxt' => date("Ymd"),
            'kodebar' => $this->input->post('hidden_kode_brg'),
            'kodebartxt' => $this->input->post('hidden_kode_brg'),
            'nabar' => $this->input->post('hidden_nama_brg'),
            'sat' => $this->input->post('hidden_satuan_brg'),
            'qty' => $this->input->post('txt_qty'),
            'harga' => $this->input->post('txt_harga'),
            'jumharga' => $jumharga,
            'kodept' => $this->input->post('hidden_kodept'),
            'namapt' => $this->input->post('hidden_namapt'),
            'periode' => date('Y-m-d H:i:s'),
            'periodetxt' => date('Ym'),
            'thn' => date('Y'),
            'merek' => $this->input->post('txt_merk'),
            'tglisi' => date('Y-m-d H:i:s'),
            'user' => $this->session->userdata('user'),
            'ket' => $this->input->post('txt_keterangan_rinci'),
            'noref' => $norefpo,
            'lokasi' => $this->session->userdata('status_lokasi'),
            'hargasblm' => $this->input->post('txt_harga'),
            'disc' => $this->input->post('txt_disc'),
            'kurs' => $this->input->post('cmb_kurs'),
            'kode_budget' => "0",
            'grup' => $this->input->post('cmb_jenis_budget'),
            'main_acct' => "0",
            'nama_main' => NULL,
            'batal' => "0",
            'cek_pp' => "0",
            'KODE_BPO' => "0",
            'JUMLAHBPO' => $this->input->post('txt_biaya_lain'),
            'kode_bebanbpo' => Null,
            'nama_bebanbpo' => $this->input->post('txt_keterangan_biaya_lain'),
            'konversi' => "0"
        ];

        if ($this->session->userdata('status_lokasi') == "SITE") {
            if ($totalbayar > 1500000) {
                $site_lebih_dari15 = 1;
                $data1 = NULL;
                $data2 = NULL;
            } else {
                $id_ppo = $this->input->post('id_item');
                $data_ppo =  array(
                    'qty2' => $this->input->post('txt_qty'),
                    'po' => 1
                );
                $this->M_po->updatePPO($id_ppo, $data_ppo);

                $site_lebih_dari15 = 0;
                $data1 = $this->db_logistik_pt->insert('po', $datainsert);
                $data2 = $this->db_logistik_pt->insert('item_po', $datainsertitem);
            }
        } else {
            $id_ppo = $this->input->post('id_item');
            $data_ppo =  array(
                'qty2' => $this->input->post('txt_qty'),
                'po' => 1
            );
            $this->M_po->updatePPO($id_ppo, $data_ppo);

            $site_lebih_dari15 = 0;
            $data1 = $this->db_logistik_pt->insert('po', $datainsert);
            $data2 = $this->db_logistik_pt->insert('item_po', $datainsertitem);
        }

        $data_return = [
            'data' => $data1,
            'data2' => $data2,
            'nopo' => $no_po,
            'noref' => $norefpo,
            'refspp' => $norefspp,
            'id_po' => $no_id,
            'id_item' => $no_id_item,
            'site_lebih_dari15' => $site_lebih_dari15
        ];


        // $data = $this->M_po->savePO($datainsert, $datainsertitem);
        echo json_encode($data_return);
    }

    public function saveItem()
    {
        $data['nama_dept'] = $this->M_po->namaDept($this->input->post("hidden_kode_departemen"));
        $lokasibuatspp = substr($this->input->post('hidden_no_ref'), 0, 3);
        switch ($lokasibuatspp) {
            case 'PST': // HO
                $lokasispp = 1;
                break;
            case 'ROM': // RO
                $lokasispp = 2;
                break;
            case 'EST': // SITE
                $lokasispp = 3;
                break;
            case 'FAC': // PKS
                $lokasispp = 6;
                break;
            default:
                break;
        }

        $lokasibuatpo = $this->session->userdata('status_lokasi');
        switch ($lokasibuatpo) {
            case 'HO':
                $lokasipo = 1;
                $kodepo = "BWJ";
                break;
            case 'RO':
                $lokasipo = 2;
                $kodepo = "PKY";
                break;
            case 'SITE':
                $lokasipo = 3;
                $kodepo = "SWJ";
                break;
            case 'PKS':
                $lokasipo = 6;
                $kodepo = "SWJ";
                break;
            default:
                break;
        }

        $key = $lokasispp . $lokasipo;

        $query_po = "SELECT MAX(SUBSTRING(nopotxt, 3)) as maxpo from po WHERE nopotxt LIKE '$key%'";
        $generate_po = $this->db_logistik_pt->query($query_po)->row();
        $noUrut = (int)($generate_po->maxpo);
        $noUrut++;
        $print = sprintf("%05s", $noUrut);


        $hidden_jenis_spp = $this->input->post('hidden_jenis_spp');

        $no_po = $this->input->post('hidden_no_po');
        $norefpo = $this->input->post('hidden_no_ref_po');


        $query_id_item = "SELECT MAX(id)+1 as no_id_item FROM item_po";
        $generate_id_item = $this->db_logistik_pt->query($query_id_item)->row();
        $no_id_item = $generate_id_item->no_id_item;
        if (empty($no_id_item)) {
            $no_id_item = 1;
        }

        $tgl_ppo = date("Y-m-d", strtotime($this->input->post('hidden_tanggal')));
        $tgl_ppo_txt = date("Ymd", strtotime($this->input->post('hidden_tanggal')));

        if ($this->input->post('txt_disc') != "0" || $this->input->post('txt_disc') != "0.00" || $this->input->post('txt_biaya_lain') != "0" || $this->input->post('txt_biaya_lain') != "0.00") {
            $qty_harga = $this->input->post('txt_qty') * $this->input->post('txt_harga');
            $disc = $this->input->post('txt_disc') / 100;
            $jumharga_pre = $qty_harga - ($qty_harga * $disc);
            $biaya_lain = $this->input->post('txt_biaya_lain');
            $jumharga = $jumharga_pre + $biaya_lain;
        } else {
            $jumharga = $this->input->post('txt_qty') * $this->input->post('txt_harga');
        }

        $pph = $this->input->post('txt_pph');
        if (empty($pph)) {
            $pph = "0";
        }
        $norefspp = $this->input->post('hidden_no_ref');

        //SUM total bayar karna untuk SITE tidak boleh lebih dari 1,5jt
        $txt_jumlah = $this->input->post('txt_jumlah');
        $query = "SELECT SUM(jumharga) as totalbayar FROM item_po WHERE nopo = '$no_po' AND noref = '$norefpo'";
        $data_totbay = $this->db_logistik_pt->query($query)->row();
        if (empty($data_totbay)) {
            $totbay = 0;
        } else {
            $totbay = $data_totbay->totalbayar;
        }
        $totalbayar = $totbay + $txt_jumlah;

        $datainsertitem = [
            'id' => $no_id_item,
            'nopo' => $no_po,
            'nopotxt' => $no_po,
            'noppo' => $this->input->post('txt_no_spp'),
            'noppotxt' => $this->input->post('txt_no_spp'),
            'refppo' => $norefspp,
            'tglppo' =>  $tgl_ppo,
            'tglppotxt' =>  $tgl_ppo_txt,
            'tglpo' =>  date("Y-m-d"),
            'tglpotxt' => date("Ymd"),
            'kodebar' => $this->input->post('hidden_kode_brg'),
            'kodebartxt' => $this->input->post('hidden_kode_brg'),
            'nabar' => $this->input->post('hidden_nama_brg'),
            'sat' => $this->input->post('hidden_satuan_brg'),
            'qty' => $this->input->post('txt_qty'),
            'harga' => $this->input->post('txt_harga'),
            'jumharga' => $jumharga,
            'kodept' => $this->input->post('hidden_kodept'),
            'namapt' => $this->input->post('hidden_namapt'),
            'periode' => date('Y-m-d H:i:s'),
            'periodetxt' => date('Ym'),
            'thn' => date('Y'),
            'merek' => $this->input->post('txt_merk'),
            'tglisi' => date('Y-m-d H:i:s'),
            'user' => $this->session->userdata('user'),
            'ket' => $this->input->post('txt_keterangan_rinci'),
            'noref' => $norefpo,
            'lokasi' => $this->session->userdata('status_lokasi'),
            'hargasblm' => $this->input->post('txt_harga'),
            'disc' => $this->input->post('txt_disc'),
            'kurs' => $this->input->post('cmb_kurs'),
            'kode_budget' => "0",
            'grup' => $this->input->post('cmb_jenis_budget'),
            'main_acct' => "0",
            'nama_main' => NULL,
            'batal' => "0",
            'cek_pp' => "0",
            'KODE_BPO' => "0",
            'JUMLAHBPO' => $this->input->post('txt_biaya_lain'),
            'kode_bebanbpo' => Null,
            'nama_bebanbpo' => $this->input->post('txt_keterangan_biaya_lain'),
            'konversi' => "0"
        ];

        if ($this->session->userdata('status_lokasi') == "SITE") {
            if ($totalbayar > 1500000) {
                $site_lebih_dari15 = 1;
                $data = NULL;
            } else {
                $id_ppo = $this->input->post('id_item');
                $data_ppo =  array(
                    'qty2' => $this->input->post('txt_qty'),
                    'po' => 1
                );
                $this->M_po->updatePPO($id_ppo, $data_ppo);

                $site_lebih_dari15 = 0;
                $data = $this->db_logistik_pt->insert('item_po', $datainsertitem);
            }
        } else {
            $id_ppo = $this->input->post('id_item');
            $data_ppo =  array(
                'qty2' => $this->input->post('txt_qty'),
                'po' => 1
            );
            $this->M_po->updatePPO($id_ppo, $data_ppo);

            $site_lebih_dari15 = 0;
            $data = $this->db_logistik_pt->insert('item_po', $datainsertitem);
        }

        $data_return = [
            'data' => $data,
            'nopo' => $no_po,
            'noref' => $norefpo,
            'refspp' => $norefspp,
            'id_item' => $no_id_item,
            'site_lebih_dari15' => $site_lebih_dari15
        ];


        // $data = $this->M_po->savePO($datainsert, $datainsertitem);
        echo json_encode($data_return);
    }

    private function _cek_flag_po($no_po)
    {
        $no_spp = $this->input->post('txt_no_spp');
        $no_ref_spp = $this->input->post('hidden_no_ref');
        $kodebar = $this->input->post('hidden_kode_brg');

        $cek_spp = "SELECT * FROM item_ppo WHERE noppotxt = '$no_spp' AND noreftxt = '$no_ref_spp'";
        $num_row_spp = $this->db_logistik_pt->query($cek_spp)->num_rows();

        $cek_po = "SELECT * FROM item_po WHERE noppotxt = '$no_spp' AND refppo = '$no_ref_spp' AND nopotxt = '$no_po'";
        $num_row_po = $this->db_logistik_pt->query($cek_po)->num_rows();

        $dataedititempo['po'] = '1';
        $this->db_logistik_pt->set($dataedititempo);
        $this->db_logistik_pt->where('noreftxt', $no_ref_spp);
        $this->db_logistik_pt->where('noppotxt', $no_spp);
        $this->db_logistik_pt->where('kodebartxt', $kodebar);
        $this->db_logistik_pt->update('item_ppo');

        if ($num_row_spp == $num_row_po) {
            $dataeditpo['po'] = '1';
            $this->db_logistik_pt->set($dataeditpo);
            $this->db_logistik_pt->where('noreftxt', $no_ref_spp);
            $this->db_logistik_pt->where('noppotxt', $no_spp);
            $this->db_logistik_pt->update('ppo');
        }
    }

    function cek_po()
    {
        $noref_po = $this->input->post('noref_po');
        $output = $this->M_po->cari_noref_itempo($noref_po);
        echo json_encode($output);
    }

    public function deletePO_data()
    {

        $id_po_item = $this->input->post('hidden_id_po_item');

        $get_po = $this->db_logistik_pt->get_where('item_po', array('id' => $id_po_item))->row();

        // $id_ppo = $this->input->post('id_item');
        $refspp = $get_po->refppo;
        $kodebar = $get_po->kodebar;

        $data_ppo2 =  array(
            'po' => 0
        );
        $data = $this->M_po->updatePPO2($refspp, $data_ppo2);

        //cari id di item_ppo
        $get_ppo = $this->db_logistik_pt->get_where('item_ppo', array('noreftxt' => $refspp, 'kodebar' => $kodebar))->row();
        $id_ppo = $get_ppo->id;

        $data_ppo =  array(
            'qty2' => NULL,
            'po' => 0
        );
        $this->M_po->updatePPO($id_ppo, $data_ppo);

        $norefpo = $this->input->post('norefpo');
        $data = $this->M_po->deletePO($norefpo);

        echo json_encode($data);
    }

    public function hapus_rinci_data()
    {

        $id_po_item = $this->input->post('hidden_id_po_item');

        $get_po = $this->db_logistik_pt->get_where('item_po', array('id' => $id_po_item))->row();

        // $id_ppo = $this->input->post('id_item');
        $refspp = $get_po->refppo;
        $kodebar = $get_po->kodebar;

        $data_ppo2 =  array(
            'po' => 0
        );
        $data = $this->M_po->updatePPO2($refspp, $data_ppo2);

        //cari id di item_ppo
        $get_ppo = $this->db_logistik_pt->get_where('item_ppo', array('noreftxt' => $refspp, 'kodebar' => $kodebar))->row();
        $id_ppo = $get_ppo->id;

        $data_ppo =  array(
            'qty2' => NULL,
            'po' => 0
        );
        $this->M_po->updatePPO($id_ppo, $data_ppo);

        $data = $this->db_logistik_pt->delete('item_po', array('id' => $id_po_item));
        echo json_encode($data);
    }

    public function deletePO()
    {

        $id_ppo = $this->input->post('id_item');
        $refspp = $this->input->post('hidden_no_ref_spp');

        $data_ppo2 =  array(
            'po' => 0
        );
        $data = $this->M_po->updatePPO2($refspp, $data_ppo2);

        $data_ppo =  array(
            'qty2' => NULL,
            'po' => 0
        );
        $this->M_po->updatePPO($id_ppo, $data_ppo);

        $norefpo = $this->input->post('norefpo');
        $data = $this->M_po->deletePO($norefpo);

        echo json_encode($data);
    }

    public function batalPO()
    {

        $id_ppo = $this->input->post('refspp');
        $refspp = $this->input->post('refspp');
        // $idspp = $this->input->post('idspp');


        $data_ppo2 =  array(
            'po' => 0
        );
        $data = $this->M_po->updatePPO2($refspp, $data_ppo2);

        $data_ppo =  array(
            'qty2' => NULL,
            'po' => 0
        );
        $this->M_po->updatePPO4($id_ppo, $data_ppo);



        $norefpo = $this->input->post('noref_po');
        $data = $this->M_po->deletePO($norefpo);

        echo json_encode($data);
    }

    public function hapus_rinci()
    {

        $id_po_item = $this->input->post('hidden_id_po_item');

        $id_ppo = $this->input->post('id_item');
        $refspp = $this->input->post('hidden_no_ref_spp');

        $data_ppo2 =  array(
            'po' => 0
        );
        $data = $this->M_po->updatePPO2($refspp, $data_ppo2);

        $data_ppo =  array(
            'qty2' => NULL,
            'po' => 0
        );
        $this->M_po->updatePPO($id_ppo, $data_ppo);

        $data = $this->db_logistik_pt->delete('item_po', array('id' => $id_po_item));
        echo json_encode($data);
    }

    public function updateItem()
    {
        $no_id_item = $this->input->post('id_item');
        $norefpo = $this->input->post('hidden_no_ref_po');
        $norefppo = $this->input->post('hidden_no_ref_spp');
        $kodebar = $this->input->post('hidden_kode_brg');
        // $no_po = $this->input->post('hidden_no_po');

        if ($this->input->post('txt_disc') != "0" || $this->input->post('txt_disc') != "0.00" || $this->input->post('txt_biaya_lain') != "0" || $this->input->post('txt_biaya_lain') != "0.00") {
            $qty_harga = $this->input->post('txt_qty') * $this->input->post('txt_harga');
            $disc = $this->input->post('txt_disc') / 100;
            $jumharga_pre = $qty_harga - ($qty_harga * $disc);
            $biaya_lain = $this->input->post('txt_biaya_lain');
            $jumharga = $jumharga_pre + $biaya_lain;
        } else {
            $jumharga = $this->input->post('txt_qty') * $this->input->post('txt_harga');
        }

        // $tgl_ppo = date("Y-m-d", strtotime($this->input->post('hidden_tanggal')));
        // $tgl_ppo_txt = date("Ymd", strtotime($this->input->post('hidden_tanggal')));

        // $tgl_ref = date("Y-m-d", strtotime($this->input->post('hidden_tgl_ref')));
        // $tgl_ref_txt = date("Ymd", strtotime($this->input->post('hidden_tgl_ref')));

        $dataupdateitem = [
            // 'nopo' => $no_po,
            // 'nopotxt' => $no_po,
            // 'noppo' => $this->input->post('txt_no_spp'),
            // 'noppotxt' => $this->input->post('txt_no_spp'),
            // 'tglppo' =>  $tgl_ppo,
            // 'tglppotxt' =>  $tgl_ppo_txt,
            // 'kodebar' => $this->input->post('hidden_kode_brg'),
            // 'kodebartxt' => $this->input->post('hidden_kode_brg'),
            // 'nabar' => $this->input->post('hidden_nama_brg'),
            // 'sat' => $this->input->post('hidden_satuan_brg'),
            // 'qty' => $this->input->post('txt_qty'),
            // 'kodept' => $this->input->post('hidden_kodept'),
            // 'namapt' => $this->input->post('hidden_namapt'),
            // 'user' => $this->session->userdata('user'),
            // 'noref' => $norefpo,
            // 'lokasi' => $this->session->userdata('status_lokasi'),
            // 'kode_budget' => "0",
            // 'grup' => $this->input->post('cmb_jenis_budget'),
            // 'main_acct' => "0",
            // 'nama_main' => NULL,
            // 'batal' => "0",
            // 'cek_pp' => "0",
            // 'KODE_BPO' => "0",
            // 'kode_bebanbpo' => Null,
            // 'konversi' => "0"
            // 'refppo' => $this->input->post('hidden_no_ref'),
            'harga' => $this->input->post('txt_harga'),
            'jumharga' => $jumharga,
            'merek' => $this->input->post('txt_merk'),
            'ket' => $this->input->post('txt_keterangan_rinci'),
            'hargasblm' => $this->input->post('txt_harga'),
            'disc' => $this->input->post('txt_disc'),
            'kurs' => $this->input->post('cmb_kurs'),
            'JUMLAHBPO' => $this->input->post('txt_biaya_lain'),
            'nama_bebanbpo' => $this->input->post('txt_keterangan_biaya_lain'),
        ];

        //SUM total bayar karna untuk SITE tidak boleh lebih dari 1,5jt
        /*         $query = "SELECT SUM(jumharga) as totalbayar FROM item_po WHERE noref = '$norefpo'";
        $data_totbay = $this->db_logistik_pt->query($query)->row();
        if (empty($data_totbay)) {
            $totbay = 0;
        } else {
            $totbay = $data_totbay->totalbayar;
        }
        $totalbayar = $totbay + $txt_jumlah; */

        $txt_jumlah = $this->input->post('txt_jumlah');

        //cari PO where kodebar norefpo norefppo
        $cari_po = $this->M_po->cari_po($norefpo, $norefppo, $kodebar, $txt_jumlah);

        if ($this->session->userdata('status_lokasi') == "SITE") {
            if ($cari_po > 1500000) {
                $updateitem = 'site15';
            } else {
                $updateitem = $this->M_po->updateItem($no_id_item, $dataupdateitem);
            }
        } else {
            $updateitem = $this->M_po->updateItem($no_id_item, $dataupdateitem);
        }
        echo json_encode($updateitem);
    }

    // public function update()
    // {

    //     $no_id = $this->input->post('hidden_id_po');
    //     $no_id_item = $this->input->post('hidden_id_po_item');
    //     $norefpo = $this->input->post('hidden_no_ref_po');
    //     $no_po = $this->input->post('hidden_no_po');


    //     if ($this->input->post('cmb_dikirim_ke_kebun') == 'Y') {
    //         $dikirim_ke_kebun = 1;
    //     } else {
    //         $dikirim_ke_kebun = 0;
    //     }


    //     if ($this->input->post('txt_disc') != "0" || $this->input->post('txt_disc') != "0.00") {
    //         $qty_harga = $this->input->post('txt_qty') * $this->input->post('txt_harga');
    //         $disc = $this->input->post('txt_disc') / 100;
    //         $jumharga = $qty_harga - ($qty_harga * $disc);
    //     } else {
    //         $jumharga = $this->input->post('txt_qty') * $this->input->post('txt_harga');
    //     }


    //     $dataupdate = [
    //         'kd_dept' => $this->input->post('hidden_kode_departemen'),
    //         'ket_dept' => $this->input->post('hidden_departemen'),
    //         'grup' => $this->input->post('cmb_jenis_budget'),
    //         'kode_budet' => "0",
    //         'kd_subbudget' => "0",
    //         'ket_subbudget' => NULL,
    //         'kode_supply' => $this->input->post('txt_supplier'),
    //         'nama_supply' => $this->input->post('txt_kode_supplier'),
    //         'kode_pemesan' => $this->input->post('txt_kode_pemesan'),
    //         'pemesan' => $this->input->post('txt_pemesan'),
    //         'nopo' => $no_po,
    //         'nopotxt' =>  $no_po,
    //         'noppo' => $this->input->post('txt_no_spp'),
    //         'noppotxt' => $this->input->post('txt_no_spp'),
    //         'no_refppo' => $this->input->post('hidden_no_ref'),
    //         'tgl_refppo' =>  $this->input->post('hidden_tglref'),
    //         'tgl_reftxt' =>  date("Ymd"),
    //         'tglpo' =>  date("Y-m-d  H:i:s"),
    //         'tglpotxt' =>  date("Ymd"),
    //         'tglppo' =>  date("Y-m-d"),
    //         'tglppotxt' =>   date("Ymd"),
    //         'bayar' => $this->input->post('cmb_status_bayar'),
    //         'tempo_bayar' => $this->input->post('txt_tempo_pembayaran'),
    //         'lokasikirim' => $this->input->post('txt_lokasi_pengiriman'),
    //         'tempo_kirim' => $this->input->post('txt_tempo_pengiriman'),
    //         'lokasi_beli' => $this->input->post('cmb_lokasi_pembelian'),
    //         'ket' => $this->input->post('txt_keterangan'),
    //         'kodept' => $this->session->userdata('kode_pt'),
    //         'namapt' => $this->session->userdata('pt'),


    //         'ket_acc' => $this->input->post('txt_no_penawaran'),
    //         'periode' => date('Y-m-d H:i:s'),
    //         'periodetxt' => date('Ym'),
    //         'thn' => date('Y'),
    //         'tglisi' => date('Y-m-d H:i:s'),
    //         'user' => $this->session->userdata('user'),
    //         'ppn' =>  $this->input->post('cmb_ppn'),
    //         'totalbayar' =>  $this->input->post('txt_total_pembayaran'),
    //         'ket_kirim' => $this->input->post('txt_ket_pengiriman'),
    //         'lokasi' => $this->session->userdata('status_lokasi'),
    //         'noreftxt' => $norefpo,
    //         'uangmuka' => $this->input->post('txt_uang_muka'),
    //         'voucher' => $this->input->post('txt_no_voucher'),
    //         'terbayar' => "0",
    //         'nopp' => NULL,
    //         'batal' => "0",
    //         'kirim' => $dikirim_ke_kebun
    //     ];



    //     $dataupdateitem = [
    //         'nopo' => $no_po,
    //         'nopotxt' => $no_po,
    //         'noppo' => $this->input->post('txt_no_spp'),
    //         'noppotxt' => $this->input->post('txt_no_spp'),
    //         'refppo' => $this->input->post('hidden_no_ref'),
    //         'tglpo' =>  date("Y-m-d"),
    //         'tglpotxt' => date("Ymd"),
    //         'kodebar' => $this->input->post('hidden_kode_brg'),
    //         'kodebartxt' => $this->input->post('hidden_kode_brg'),
    //         'nabar' => $this->input->post('hidden_nama_brg'),
    //         'sat' => $this->input->post('hidden_satuan_brg'),
    //         'qty' => $this->input->post('txt_qty'),
    //         'harga' => $this->input->post('txt_harga'),
    //         'jumharga' => $jumharga,
    //         'kodept' => $this->input->post('hidden_kodept'),
    //         'namapt' => $this->input->post('hidden_namapt'),
    //         'periode' => date('Y-m-d H:i:s'),
    //         'periodetxt' => date('Ym'),
    //         'thn' => date('Y'),
    //         'merek' => $this->input->post('txt_merk'),
    //         'tglisi' => date('Y-m-d H:i:s'),
    //         'user' => $this->session->userdata('user'),
    //         'ket' => $this->input->post('txt_keterangan_rinci'),
    //         'noref' => $norefpo,
    //         'lokasi' => $this->session->userdata('status_lokasi'),
    //         'hargasblm' => $this->input->post('txt_harga'),
    //         'disc' => $this->input->post('txt_disc'),
    //         'kurs' => $this->input->post('cmb_kurs'),
    //         'kode_budget' => "0",
    //         'grup' => $this->input->post('cmb_jenis_budget'),
    //         'main_acct' => "0",
    //         'nama_main' => NULL,
    //         'batal' => "0",
    //         'cek_pp' => "0",
    //         'KODE_BPO' => "0",
    //         'JUMLAHBPO' => $this->input->post('txt_biaya_lain'),
    //         'kode_bebanbpo' => Null,
    //         'nama_bebanbpo' => $this->input->post('txt_keterangan_biaya_lain'),
    //         'konversi' => "0"
    //     ];


    //     // $query =  "SELECT qty, qty2 FROM item_ppo WHERE id = '" . $this->input->post('id_item') . "' ";
    //     // $d = $this->db->query($query)->row();
    //     // $qtyy = $d->qty;
    //     // $qty2 = $d->qty2;
    //     // if ($qty2 == null) {
    //     //     $tmbhQTY = $this->input->post('txt_qty');
    //     //     $id_ppo = $this->input->post('id_item');
    //     //     $data_ppo =  array(
    //     //         'qty2' => $tmbhQTY
    //     //     );
    //     //     $this->M_po->updatePPO($id_ppo, $data_ppo);
    //     // } else {
    //     //     $a = $this->input->post('txt_qty');
    //     //     $qty = $qty2 + $a;
    //     //     $id_ppo = $this->input->post('id_item');
    //     //     $data_ppo =  array(
    //     //         'qty2' => $qty,

    //     //     );
    //     //     $this->M_po->updatePPO($id_ppo, $data_ppo);
    //     // }


    //     // $chek =  "SELECT qty, qty2 FROM item_ppo WHERE id = '" . $this->input->post('id_item') . "' ";
    //     // $ambil = $this->db->query($chek)->row();
    //     // $qtyy = $ambil->qty;
    //     // $qtyy2 = $ambil->qty2;

    //     // if ($qtyy == $qtyy2) {

    //     //     $id_ppo = $this->input->post('id_item');
    //     //     $data_ppo =  array(
    //     //         'po' => 1
    //     //     );
    //     //     $this->M_po->updatePPO($id_ppo, $data_ppo);
    //     // }


    //     $updatepo = $this->M_po->updatePO($no_id, $dataupdate);
    //     $updateitem = $this->M_po->updateItem($no_id_item, $dataupdateitem);


    //     // $data = $this->M_po->savePO($datainsert, $datainsertitem);
    //     echo json_encode($updatepo, $updateitem);
    // }

    public function cancel_ubah_rinci()
    {
        $id_po_item = $this->input->post('id_po_item');
        $id_po  = $this->input->post('id_po');

        $data = $this->M_po->cancelUpdateItemPO($id_po_item, $id_po);

        echo json_encode($data);
    }
    public function cancel_item()
    {
        $id_po_item = $this->input->post('id_po_item');
        // $id_po  = $this->input->post('id_po');

        $data = $this->M_po->cancelItemPO($id_po_item);

        echo json_encode($data);
    }

    function cek_lpb()
    {
        $noref = $this->input->post('noref');
        $data = $this->M_po->cek_lpb($noref);
        echo json_encode($data);
    }

    function cek_isi()
    {
        $noref = $this->input->post('noref');
        $data = $this->M_po->cek_isi($noref);
        echo json_encode($data);
    }

    function po_edit()
    {
        $data['nama_dept'] = $this->M_po->namaDept($this->input->post("hidden_kode_departemen"));
        $lokasibuatspp = substr($this->input->post('hidden_no_ref'), 0, 3);
        switch ($lokasibuatspp) {
            case 'PST': // HO
                $lokasispp = 1;
                break;
            case 'ROM': // RO
                $lokasispp = 2;
                break;
            case 'EST': // SITE
                $lokasispp = 3;
                break;
            case 'FAC': // PKS
                $lokasispp = 6;
                break;
            default:
                break;
        }

        $lokasibuatpo = $this->session->userdata('status_lokasi');
        switch ($lokasibuatpo) {
            case 'HO':
                $lokasipo = 1;
                $kodepo = "BWJ";
                break;
            case 'RO':
                $lokasipo = 2;
                $kodepo = "PKY";
                break;
            case 'SITE':
                $lokasipo = 3;
                $kodepo = "SWJ";
                break;
            case 'PKS':
                $lokasipo = 6;
                $kodepo = "SWJ";
                break;
            default:
                break;
        }

        $key = $lokasispp . $lokasipo;

        $query_po = "SELECT MAX(SUBSTRING(nopotxt, 3)) as maxpo from po WHERE nopotxt LIKE '$key%'";
        $generate_po = $this->db_logistik_pt->query($query_po)->row();
        $noUrut = (int)($generate_po->maxpo);
        $noUrut++;
        $print = sprintf("%05s", $noUrut);


        $hidden_jenis_spp = $this->input->post('hidden_jenis_spp');

        $no_po = $this->input->post('hidden_no_po');
        $norefpo = $this->input->post('hidden_no_ref_po');


        $query_id_item = "SELECT MAX(id)+1 as no_id_item FROM item_po";
        $generate_id_item = $this->db_logistik_pt->query($query_id_item)->row();
        $no_id_item = $generate_id_item->no_id_item;
        if (empty($no_id_item)) {
            $no_id_item = 1;
        }

        $tgl_ppo = date("Y-m-d", strtotime($this->input->post('hidden_tanggal')));
        $tgl_ppo_txt = date("Ymd", strtotime($this->input->post('hidden_tanggal')));

        if ($this->input->post('txt_disc') != "0" || $this->input->post('txt_disc') != "0.00" || $this->input->post('txt_biaya_lain') != "0" || $this->input->post('txt_biaya_lain') != "0.00") {
            $qty_harga = $this->input->post('txt_qty') * $this->input->post('txt_harga');
            $disc = $this->input->post('txt_disc') / 100;
            $jumharga_pre = $qty_harga - ($qty_harga * $disc);
            $biaya_lain = $this->input->post('txt_biaya_lain');
            $jumharga = $jumharga_pre + $biaya_lain;
        } else {
            $jumharga = $this->input->post('txt_qty') * $this->input->post('txt_harga');
        }

        $pph = $this->input->post('txt_pph');
        if (empty($pph)) {
            $pph = "0";
        }
        $norefspp = $this->input->post('hidden_no_ref');

        //SUM total bayar karna untuk SITE tidak boleh lebih dari 1,5jt
        $txt_jumlah = $this->input->post('txt_jumlah');
        $query = "SELECT SUM(jumharga) as totalbayar FROM item_po WHERE nopo = '$no_po' AND noref = '$norefpo'";
        $data_totbay = $this->db_logistik_pt->query($query)->row();
        if (empty($data_totbay)) {
            $totbay = 0;
        } else {
            $totbay = $data_totbay->totalbayar;
        }
        $totalbayar = $totbay + $txt_jumlah;

        $datainsertitem = [
            'id' => $no_id_item,
            'nopo' => $this->input->post('hidden_no_po'),
            'nopotxt' => $this->input->post('hidden_no_po'),
            'noppo' => $this->input->post('txt_no_spp'),
            'noppotxt' => $this->input->post('txt_no_spp'),
            'refppo' => $this->input->post('hidden_no_ref'),
            'tglppo' =>  $tgl_ppo,
            'tglppotxt' =>  $tgl_ppo_txt,
            'tglpo' =>  date("Y-m-d"),
            'tglpotxt' => date("Ymd"),
            'kodebar' => $this->input->post('hidden_kode_brg'),
            'kodebartxt' => $this->input->post('hidden_kode_brg'),
            'nabar' => $this->input->post('hidden_nama_brg'),
            'sat' => $this->input->post('hidden_satuan_brg'),
            'qty' => $this->input->post('txt_qty'),
            'harga' => $this->input->post('txt_harga'),
            'jumharga' => $jumharga,
            'kodept' => $this->input->post('hidden_kodept'),
            'namapt' => $this->input->post('hidden_namapt'),
            'periode' => date('Y-m-d H:i:s'),
            'periodetxt' => date('Ym'),
            'thn' => date('Y'),
            'merek' => $this->input->post('txt_merk'),
            'tglisi' => date('Y-m-d H:i:s'),
            'user' => $this->session->userdata('user'),
            'ket' => $this->input->post('txt_keterangan_rinci'),
            'noref' => $this->input->post('hidden_no_ref_po'),
            'lokasi' => $this->session->userdata('status_lokasi'),
            'hargasblm' => $this->input->post('txt_harga'),
            'disc' => $this->input->post('txt_disc'),
            'kurs' => $this->input->post('cmb_kurs'),
            'kode_budget' => "0",
            'grup' => $this->input->post('cmb_jenis_budget'),
            'main_acct' => "0",
            'nama_main' => NULL,
            'batal' => "0",
            'cek_pp' => "0",
            'KODE_BPO' => "0",
            'JUMLAHBPO' => $this->input->post('txt_biaya_lain'),
            'kode_bebanbpo' => Null,
            'nama_bebanbpo' => $this->input->post('txt_keterangan_biaya_lain'),
            'konversi' => "0"
        ];

        if ($this->session->userdata('status_lokasi') == "SITE") {
            if ($totalbayar > 1500000) {
                $site_lebih_dari15 = 1;
                $data = NULL;
            } else {
                $id_ppo = $this->input->post('id_item');
                $data_ppo =  array(
                    'qty2' => $this->input->post('txt_qty'),
                    'po' => 1
                );
                $this->M_po->updatePPO($id_ppo, $data_ppo);

                $site_lebih_dari15 = 0;
                $data = $this->db_logistik_pt->insert('item_po', $datainsertitem);
            }
        } else {
            $id_ppo = $this->input->post('id_item');
            $data_ppo =  array(
                'qty2' => $this->input->post('txt_qty'),
                'po' => 1
            );
            $this->M_po->updatePPO($id_ppo, $data_ppo);

            $site_lebih_dari15 = 0;
            $data = $this->db_logistik_pt->insert('item_po', $datainsertitem);
        }

        $data_return = [
            'data' => $data,
            'nopo' => $no_po,
            'noref' => $norefpo,
            'refspp' => $norefspp,
            'id_item' => $no_id_item,
            'site_lebih_dari15' => $site_lebih_dari15
        ];


        // $data = $this->M_po->savePO($datainsert, $datainsertitem);
        echo json_encode($data_return);
    }
}

/* End of file Po.php */
