<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lpb extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('M_lpb');
        $this->load->model('M_item_lpb');

        $db_pt = check_db_pt();
        // $this->db_logistik = $this->load->database('db_logistik',TRUE);
        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);

        $this->db_logistik = $this->load->database('db_logistik', TRUE);

        if (!$this->session->userdata('id_user')) {
            $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
            $this->session->set_flashdata('pesan', $pemberitahuan);
            redirect('Login');
        }

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title'] = 'Laporan Penerimaan Barang';
        $this->template->load('template', 'v_lpbIndex', $data);
    }

    public function input()
    {
        $data['title'] = 'Laporan Penerimaan Barang';

        // $data['devisi'] = $this->M_lpb->cariDevisi();

        $this->template->load('template', 'v_lpbInput', $data);
    }

    public function get_data_lpb()
    {
        $list = $this->M_lpb->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<button class="btn btn-success btn-xs fa fa-eye" id="detail_lpb" name="detail_lpb"
                        data-ttg="' . $field->ttg . '"
                        data-toggle="tooltip" data-placement="top" title="detail" onClick="return false">
                        </button>
                        <button class="btn btn-primary btn-xs fa fa-undo" id="undo_lpb" name="undo_lpb"
                        data-ttg="' . $field->ttg . '"
                        data-toggle="tooltip" data-placement="top" title="detail" onClick="return false">
                        </button>
                        <button class="btn btn-xs btn-warning fa fa-edit" id="edit_lpb" name="edit_lpb"
                        data-ttg="' . $field->ttg . '" data-nopo="' . $field->nopo . '"
                        data-toggle="tooltip" data-placement="top" title="detail" onClick="return false">
                        </button>
                        <a href="' . site_url('lpb/cetak/' . $field->ttg . '/' . $field->id) . '" target="_blank" class="btn btn-danger btn-xs fa fa-print" id="a_print_lpb"></a>';
            $row[] = $no;
            $row[] = $field->ttg;
            $row[] = $field->noref;
            $row[] = $field->nopo;
            $row[] = $field->refpo;
            $row[] = $field->nama_supply;
            $row[] = $field->ket;
            $row[] = $field->tglinput;
            $row[] = $field->USER;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_lpb->count_all(),
            "recordsFiltered" => $this->M_lpb->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    // public function get_data_item_po()
    // {
    //     $nopo = $this->input->post('nopo');
    //     $this->M_item_lpb->where_datatables($nopo);
    //     $list = $this->M_item_lpb->get_datatables();
    //     $data = array();
    //     $no = $_POST['start'];
    //     foreach ($list as $field) {

    //         $sumqty = $this->M_item_lpb->sumqty($field->kodebar, $field->nopo);
    //         $sumsisa = $field->qty - $sumqty->qty_lpb;
    //         $no++;
    //         $row = array();
    //         $row[] = '<button class="btn btn-success btn-xs" id="pilih_item_po" name="pilih_item_po"
    //                     data-kodebar="' . $field->kodebar . '" data-nabar="' . $field->nabar . '"
    //                     data-qty="' . $field->qty . '" data-sat="' . $field->sat . '"
    //                     data-ket="' . $field->ket . '" data-sumsisa="' . $sumsisa . '"
    //                     data-toggle="tooltip" data-placement="top" title="Pilih" onClick="return false">Pilih
    //                     </button>';
    //         $row[] = $no;
    //         $row[] = $field->kodebar;
    //         $row[] = $field->nabar;
    //         $row[] = $field->qty;
    //         $row[] = $sumqty->qty_lpb;
    //         $row[] = $sumsisa;
    //         $row[] = $field->sat;
    //         $row[] = $field->ket;

    //         $data[] = $row;
    //     }

    //     $output = array(
    //         "draw" => $_POST['draw'],
    //         "recordsTotal" => $this->M_item_lpb->count_all(),
    //         "recordsFiltered" => $this->M_item_lpb->count_filtered(),
    //         "data" => $data,
    //     );
    //     //output dalam format JSON
    //     echo json_encode($output);
    // }

    public function get_grup_barang()
    {
        $kodebar =  $this->input->post('kodebar');
        $data =  $this->db_logistik->get_where('kodebar', array('kodebartxt' => $kodebar))->row();
        echo json_encode($data);
    }

    public function saveLpb()
    {
        $id_user = $this->session->userdata('id_user');
        $lokasilpb = $this->session->userdata('status_lokasi'); //HO, RO, SITE, PKS
        $nopo = $this->input->post('txt_no_po');
        $refpo = $this->input->post('txt_ref_po');

        if ($refpo == "MUTASI") {
            $refpo = $this->input->post('hidden_no_ref_bkb');
        }

        $lokasibuatpo = substr($refpo, 0, 3);
        switch ($lokasibuatpo) {
            case 'PST': // HO
                $digit1 = "1";
                $ref_1 = "LPB";
                break;
            case 'ROM': // RO
                $digit1 = "2";
                $ref_1 = "ROM-LPB";
                break;
            case 'FAC': // PKS
                $digit1 = "3";
                $ref_1 = "FAC";
                break;
            case 'EST': // SITE
                $digit1 = "6";
                $ref_1 = "EST-LPB";
                break;
            default:
                break;
        }

        $polokal = substr($refpo, 8, 8); // PO-Lokal
        switch ($polokal) {
            case "PO-Lokal":
                $lokasilpb = $this->session->userdata('status_lokasi'); //HO, RO, SITE, PKS
                switch ($lokasilpb) {
                    case 'HO': // HO
                        $digit2 = "1";
                        break;
                    case 'RO': // RO
                        $digit2 = "2";
                        break;
                    case 'PKS': // PKS
                        $digit2 = "3";
                        break;
                    case 'SITE': // SITE
                        $digit2 = "6";
                        break;
                    default:
                        break;
                }
                break;
            default:
                if (substr($refpo, 4, 3) == "POA") {
                    $digit2 = "1";
                } else {
                    switch ($lokasilpb) {
                        case 'HO': // HO
                            $digit2 = "1";
                            break;
                        case 'RO': // RO
                            $digit2 = "2";
                            break;
                        case 'PKS': // PKS
                            $digit2 = "3";
                            break;
                        case 'SITE': // SITE
                            $digit2 = "6";
                            break;
                        default:
                            break;
                    }
                }
                break;
        }

        $digit1_2 = $digit1 . $digit2;

        switch ($lokasilpb) {
            case 'HO':
                $ref_2 = "PST";
                break;
            case 'SITE':
                $ref_2 = "SWJ";
                break;
            case 'PKS':
                $ref_2 = "SWJ";
                break;
            case 'RO':
                $ref_2 = "PKY";
                break;
            default:
                break;
        }

        $kodebar = $this->input->post('txt_kode_barang');
        $nabar = $this->input->post('txt_nama_brg');

        $query_masuk_item = "SELECT MAX(SUBSTRING(ttgtxt, 3)) as maxttg from masukitem WHERE ttg LIKE '$digit1_2%'";
        $generate_masuk_item = $this->db_logistik_pt->query($query_masuk_item)->row();
        $noUrut_masuk_item = (int)($generate_masuk_item->maxttg);
        $noUrut_masuk_item++;
        $print_masuk_item = sprintf("%05s", $noUrut_masuk_item);

        $ref_3 = date("m/y", strtotime($this->input->post('txt_tgl_terima')));

        if (empty($this->input->post('hidden_no_lpb'))) {
            $no_lpb = $digit1_2 . $print_masuk_item; // 6207836;
        } else {
            $no_lpb = $this->input->post('hidden_no_lpb');
        }

        if (empty($this->input->post('hidden_no_ref_lpb'))) {
            $no_ref_lpb = $ref_1 . "/" . $ref_2 . "/" . $ref_3 . "/" . $print_masuk_item; //LPB/PST/01/00233 // Est-LPB/swj/12/18/07836 // EST/SWJ/RETURN/642/XIV/12/2018
        } else {
            $no_ref_lpb = $this->input->post('hidden_no_ref_lpb');
        }

        $check_po = $this->input->post('txt_no_po');
        if (substr($check_po, 8, 8) == "PO-Lokal") {
            $po_lokal = "1";
        } else {
            $po_lokal = "0";
        }

        $check_asset = $this->input->post('chk_asset');
        if ($check_asset == "yes") {
            $asset = "1";
        } else {
            $asset = "0";
        }

        if (!empty($_POST['txt_bkb_dari_pt'])) {
            $mutasi = "1";
        } else {
            $mutasi = "0";
        }

        $tgl_terima = date("Y-m-d", strtotime($this->input->post('txt_tgl_terima')));

        $txttgl = date("Ymd", strtotime($this->input->post('txt_tgl_terima')));
        $thn = date("Y", strtotime($this->input->post('txt_tgl_terima')));
        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');

        $kodept = $this->session->userdata('kode_pt');
        // $periode = date("Y-m-d", strtotime($this->input->post('txt_tgl_terima')));
        // $txtperiode = date("Ym", strtotime($this->input->post('txt_tgl_terima')));

        // $query_get_po = "SELECT id, nopotxt, kode_supply, nama_supply FROM po WHERE nopotxt = '$nopo' AND noreftxt = '$refpo'";
        // $get_po = $this->db_logistik_pt->query($query_get_po)->row();

        $query_get_item_po = "SELECT id, nopotxt, kurs, konversi FROM item_po WHERE nopotxt = '$nopo' AND noref = '$refpo' AND kodebartxt = '$kodebar' AND nabar = '$nabar'";
        $get_item_po = $this->db_logistik_pt->query($query_get_item_po)->row();

        if (!empty($get_item_po)) {
            $kurs = $get_item_po->kurs;
            $konversi = $get_item_po->konversi;
        } else {
            $kurs = "Rp";
            $konversi = "0";
        }

        // if (!empty($get_po)) {
        //     $kode_supply = $get_po->kode_supply;
        //     $nama_supply = $get_po->nama_supply;
        // } else {
        //     $kode_supply = $this->input->post('txt_kd_supplier');
        //     $nama_supply = $this->input->post('txt_supplier');
        // }

        $no_po = $this->input->post('txt_no_po');
        $no_ref_po = $this->input->post('txt_ref_po');
        if ($no_ref_po == 'MUTASI') {
            $no_ref_po = str_replace("BKB", "MUTASI", $refpo);
        }

        $data_stokmasuk = [
            'tgl' => $tgl_terima,
            'nopo' => $no_po,
            'nopotxt' => $no_po,
            'LOKAL' => $po_lokal,
            'ASSET' => '0',
            'kode_supply' => $this->input->post('txt_kd_supplier'),
            'nama_supply' => $this->input->post('txt_supplier'),
            'ttg' => $no_lpb,
            'ttgtxt' => $no_lpb,
            'no_pengtr' => $this->input->post('txt_no_pengantar'),
            'lokasi_gudang' => $this->input->post('txt_lokasi_gudang'),
            'ket' => $this->input->post('txt_ket_pengiriman'),
            'tglinput' => date("Y-m-d H:i:s"),
            'txttgl' => $txttgl,
            'thn' => $thn,
            'periode1' => $periode,
            'periode2' => NULL,
            'txtperiode1' => $txtperiode,
            'txtperiode2' => NULL,
            'pt' => $this->session->userdata('pt'),
            'kode' => $kodept,
            'mutasi' => $mutasi,
            'lokasi' => $this->session->userdata('status_lokasi'),
            'refpo' => $no_ref_po,
            'noref' => $no_ref_lpb,
            'BATAL' => '0',
            'alasan_batal' => '0',
            'id_user' => $id_user,
            'USER' => $this->session->userdata('user'),
            'cetak' => '0',
            'posting' => '0',
            'approval' => '1',
            'approval_kasie' => '1',
            'approval_ktu' => '1',
            'flag_lpb' => '1'
        ];

        $data_masukitem = [
            'kdpt' => $this->session->userdata('kode_pt'),
            'nopo' => $no_po,
            'nopotxt' => $no_po,
            'LOKAL' => $po_lokal,
            'ASSET' => $asset,
            'pt' => $this->session->userdata('pt'),
            'afd' => '-',
            'kodebar' => $this->input->post('txt_kode_barang'),
            'kodebartxt' => $this->input->post('txt_kode_barang'),
            'nabar' => $this->input->post('txt_nama_brg'),
            'satuan' => $this->input->post('txt_satuan'),
            'grp' => $this->input->post('hidden_grup'),
            'qty' => $this->input->post('txt_qty'),
            'tgl' => $tgl_terima,
            'ttg' => $no_lpb,
            'ttgtxt' => $no_lpb,
            'tglinput' => date("Y-m-d H:i:s"),
            'txttgl' => $txttgl,
            'thn' => $thn,
            'periode' => $periode,
            'txtperiode' => $txtperiode,
            'noadjust' => '0',
            'ket' => $this->input->post('txt_ket_rinci'),
            'lokasi' => $this->session->userdata('status_lokasi'),
            'refpo' => $no_ref_po,
            'noref' => $no_ref_lpb,
            'BATAL' => '0',
            'alasan_batal' => '0',
            'kurs' => $kurs,
            'konversi' => $konversi,
            'id_user' => $id_user,
            'USER' => $this->session->userdata('user'),
            'cetak' => '0',
            'posting' => '0',
            'qtyditerima' => '0',
        ];

        if (empty($this->input->post('hidden_no_lpb'))) {
            $data = $this->M_item_lpb->saveLpb($data_stokmasuk);
            $data2 = $this->M_item_lpb->saveLpb2($data_masukitem);
        } else {
            $data = NULL;
            $data2 = $this->M_item_lpb->saveLpb2($data_masukitem);
        }

        $query_id = "SELECT MAX(id) as id_lpb FROM masukitem WHERE id_user = '$id_user' AND ttg = '$no_lpb' ";
        $generate_id = $this->db_logistik_pt->query($query_id)->row();
        $id_item_lpb = $generate_id->id_lpb;

        $data_return = [
            'data' => $data,
            'data2' => $data2,
            'nolpb' => $no_lpb,
            'id_item_lpb' => $id_item_lpb,
            'noreflpb' => $no_ref_lpb
        ];

        echo json_encode($data_return);
    }

    function sum_sisa_qty_po()
    {
        $no_ref_po = $this->input->post('no_ref_po');
        $no_po = $this->input->post('no_po');
        $kodebar = $this->input->post('kodebar');

        $query_qty_po = "SELECT id, nopotxt, noppotxt, refppo, noref, kodebartxt, nabar, qty, sat, ket FROM item_po WHERE nopotxt = '$no_po' AND noref = '$no_ref_po' AND kodebartxt = '$kodebar' ORDER BY id DESC";
        $data_qty_po = $this->db_logistik_pt->query($query_qty_po)->row();

        $query_sisa_qty_lpb = "SELECT SUM(qty) as qty_lpb FROM masukitem WHERE BATAL<>1 AND kodebartxt = '$kodebar' AND nopotxt = '$no_po' AND refpo = '$no_ref_po'";
        $data_sisa_qty_lpb = $this->db_logistik_pt->query($query_sisa_qty_lpb)->row();

        $sisa_qty_po  =  number_format($data_qty_po->qty - $data_sisa_qty_lpb->qty_lpb, 0);
        echo json_encode($sisa_qty_po);
    }

    public function get_data_po_qr()
    {
        $nopotxt = $this->input->post('nopotxt');
        $result = $this->M_lpb->get_data_po_qr($nopotxt);
        echo json_encode($result);
    }

    public function sum_qty()
    {
        $kodebar = $this->input->post('kodebar');
        $nopo = $this->input->post('nopo');
        $qty = $this->input->post('qty');
        $result = $this->M_lpb->sumqty($kodebar, $nopo, $qty);
        echo json_encode($result);
    }

    public function select2_get_po()
    {
        $data = $this->M_lpb->get_nopo();
        echo json_encode($data);
    }

    public function get_data_after_save()
    {
        $nopotxt = $this->input->post('nopotxt');
        $no_lpb = $this->input->post('no_lpb');
        $result = $this->M_lpb->get_data_after_save($nopotxt, $no_lpb);
        echo json_encode($result);
    }

    public function updateLpb()
    {
        $check_asset = $this->input->post('chk_asset');
        if ($check_asset == "yes") {
            $asset = "1";
        } else {
            $asset = "0";
        }

        $data_item_lpb = [
            'ASSET' => $asset,
            'qty' => $this->input->post('txt_qty'),
            'ket' => $this->input->post('txt_ket_rinci')
        ];
        $id = $this->input->post('hidden_id_item_lpb');

        $data = $this->M_lpb->updateLpb($data_item_lpb, $id);
        echo json_encode($data);
    }

    public function cancelUpdateItemLpb()
    {
        $id_item_lpb = $this->input->post('hidden_id_item_lpb');

        $data = $this->M_lpb->cancelUpdateItemLpb($id_item_lpb);

        echo json_encode($data);
    }

    public function get_detail_item_lpb()
    {
        $no_lpb = $this->input->post('no_lpb');

        $data = $this->M_lpb->get_detail_item_lpb($no_lpb);

        echo json_encode($data);
    }

    public function edit_lpb($no_lpb, $nopo)
    {
        $data['no_lpb'] = $no_lpb;
        $data['nopo'] = $nopo;

        $this->template->load('template', 'v_lpbEdit', $data);
    }

    public function cari_lpb_edit()
    {
        $no_lpb = $this->input->post('no_lpb');
        $nopo = $this->input->post('nopo');

        $data = $this->M_lpb->cari_lpb_edit($no_lpb, $nopo);

        echo json_encode($data);
    }

    public function cariQtyPo()
    {
        $nopo = $this->input->post('nopo');
        $kodebar = $this->input->post('kodebar');

        $data = $this->M_lpb->cariQtyPo($nopo, $kodebar);

        echo json_encode($data);
    }

    public function sum_qty_edit()
    {
        $kodebar = $this->input->post('kodebar');
        $nopo = $this->input->post('nopo');
        $result = $this->M_lpb->sumqty_edit($kodebar, $nopo);
        echo json_encode($result);
    }

    public function getQtyPo()
    {
        $kodebar = $this->input->post('kodebar');
        $nopo = $this->input->post('nopo');

        $result = $this->M_lpb->getQtyPo($kodebar, $nopo);
        echo json_encode($result);
    }

    public function getSisaLpb()
    {
        $qty_po = $this->input->post('qty_po');
        $kodebar = $this->input->post('kodebar');
        $no_lpb = $this->input->post('no_lpb');

        $result = $this->M_lpb->getSisaLpb($qty_po, $kodebar, $no_lpb);
        echo json_encode($result);
    }

    function cetak()
    {
        $no_lpb = $this->uri->segment('3');
        $id = $this->uri->segment('4');

        $data['no_lpb'] = $no_lpb;
        $data['id'] = $id;
        $data['stokmasuk'] = $this->db_logistik_pt->get_where('stokmasuk', array('id' => $id, 'ttgtxt' => $no_lpb))->row();
        $data['masukitem'] = $this->db_logistik_pt->get_where('masukitem', array('ttgtxt' => $no_lpb, 'noref' => $data['stokmasuk']->noref))->result();

        $noref = $data['stokmasuk']->noref;
        $this->qrcode($no_lpb, $id, $noref);
        // $data['po'] = $this->db_logistik_pt->get_where('po', array('nopotxt' => $data['stokmasuk']->nopotxt, 'noreftxt' => $data['stokmasuk']->refpo ))->row();

        // var_dump($data['po']);exit();
        // $mpdf = new \Mpdf\Mpdf([
        //                       'mode' => 'utf-8', 
        //                       // 'format' => [190, 236],
        //                       'format' => 'A4',
        //                       'setAutoTopMargin' => 'stretch',
        //                       'orientation' => 'P'
        //                   ]);
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => [190, 236],
            'setAutoTopMargin' => 'stretch',
            'orientation' => 'P'
        ]);

        $lokasibuatlpb = substr($noref, 0, 3);
        switch ($lokasibuatlpb) {
            case 'LPB': // HO
                $lokasilpb = "HO";
                break;
            case 'ROM': // RO
                $lokasilpb = "RO";
                break;
            case 'FAC': // PKS
                $lokasilpb = "PKS";
                break;
            case 'EST': // SITE
                $lokasilpb = "SITE";
                break;
            default:
                break;
        }

        // $mpdf->SetHTMLHeader('<h4>PT MULIA SAWIT AGRO LESTARI</h4>');
        $mpdf->SetHTMLHeader('
                            <table width="100%" border="0" align="center">
                                <tr>
                                    <td rowspan="5" width="15%" height="10px"><!--img width="10%" height="60px" style="padding-left:8px" src="././assets/img/msal.jpg"--></td>
                                    <td rowspan="5" align="center" style="font-size:14px;font-weight:bold;">PT Mulia Sawit Agro Lestari (' . $lokasilpb . ')</td>
                                    <td>Putih</td>
                                    <td>:</td>
                                    <td>Finance HO</td>
                                </tr>
                                <!--tr>
                                    <td align="center" rowspan="5">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
                                    </td>
                                </tr-->
                                <tr>
                                	<td>Merah</td>
                                	<td>:</td>
                                	<td>Accounting HO</td>
                                </tr>
                                <tr>
                                	<td>Kuning</td>
                                	<td>:</td>
                                	<td>Gudang Est</td>
                                </tr>
                                <tr>
                                	<td>Hijau</td>
                                	<td>:</td>
                                	<td>Accounting Est</td>
                                </tr>
                                <tr>
                                	<td>Biru</td>
                                	<td>:</td>
                                	<td>Purchasing HO</td>
                                </tr>
                            </table>
                            <hr style="width:100%;margin:0px;">
                            ');
        // $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');

        $html = $this->load->view('v_lpbPrint', $data, true);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function qrcode($no_lpb, $id, $noref)
    {
        $this->load->library('Ciqrcode');
        // header("Content-Type: image/png");

        $config['cacheable']    = false; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/lpb/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $id . '_' . $no_lpb . '.png'; //buat name dari qr code

        // $params['data'] = site_url('lpb/cetak/'.$no_lpb.'/'.$id); //data yang akan di jadikan QR CODE
        $params['data'] = $noref; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
    }
}
