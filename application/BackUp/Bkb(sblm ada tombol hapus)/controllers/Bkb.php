<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bkb extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_bkb');
        $this->load->model('M_approval_bkb');
        $this->load->model('M_approval_rev_qty');
        $this->load->model('M_get_bpb');

        $db_pt = check_db_pt();
        // $this->db_logistik = $this->load->database('db_logistik',TRUE);
        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);

        // DB logistik CENTER
        $this->db_logistik_center = $this->load->database('db_logistik_center', TRUE);

        //DB MSAL
        $this->db_logistik_msal = $this->load->database('db_logistik_msal', TRUE);

        //DB MAPA
        $this->db_logistik_mapa = $this->load->database('db_logistik_mapa', TRUE);

        if (!$this->session->userdata('id_user')) {
            $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
            $this->session->set_flashdata('pesan', $pemberitahuan);
            redirect('Login');
        }

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = [
            'title' => 'Bukti Keluar Barang'
        ];

        $this->template->load('template', 'v_dataBkb', $data);
    }

    public function input()
    {
        $data = [
            'title' => 'Bukti Keluar Barang'
        ];

        $data['pt_mutasi'] = $this->db_logistik_center->get('tb_pt')->result_array();

        $this->template->load('template', 'v_inputBkb', $data);
    }

    // //Start Data Table Server Side
    public function get_data_bkb()
    {
        $list = $this->M_bkb->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<button class="btn btn-success btn-xs fa fa-eye" id="detail_bkb" name="detail_bkb"
                        data-noref="' . $field->NO_REF . '"
                        data-toggle="tooltip" data-placement="top" title="detail" onClick="detail_bkb(' . $field->id . ')">
                        </button>
                        <a href="' . site_url('Bkb/cetak/' . $field->SKBTXT . '/' . $field->id) . '" target="_blank" class="btn btn-danger btn-xs fa fa-print" id="a_print_lpb"></a>';
            $row[] = $no;
            $row[] = $field->NO_REF;
            $row[] = $field->nobpb;
            $row[] = $field->no_mutasi;
            $row[] = $field->bag;
            $row[] = $field->keperluan;
            $row[] = date("Y-m-d", strtotime($field->tgl));
            $row[] = $field->USER;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_bkb->count_all(),
            "recordsFiltered" => $this->M_bkb->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    // //End Start Data Table Server Side

    // public function select2_get_bpb()
    // {
    //     $data = $this->M_bkb->get_bpb();
    //     echo json_encode($data);
    // }

    // //Start Data Table Server Side
    public function get_data_bpb()
    {
        $list = $this->M_get_bpb->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<button class="btn btn-success btn-xs" id="data_bpb" name="data_bpb"
                        data-norefbpb="' . $field->norefbpb . '"
                        data-toggle="tooltip" data-placement="top" title="detail">pilih
                        </button>';
            $row[] = $no;
            $row[] = $field->norefbpb;
            $row[] = $field->keperluan;
            $row[] = date("Y-m-d", strtotime($field->tglinput));
            $row[] = $field->user;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_get_bpb->count_all(),
            "recordsFiltered" => $this->M_get_bpb->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    // //End Start Data Table Server Side

    public function get_data_bpb_qr()
    {
        $noref = $this->input->post('noref');
        $result = $this->M_bkb->get_data_bpb_qr($noref);
        echo json_encode($result);
    }

    public function get_tahun_tanam()
    {
        $coa_material = $this->input->post('coa_material');
        $result = $this->M_bkb->get_tahun_tanam($coa_material);
        echo json_encode($result);
    }

    public function get_stok()
    {
        $kodebar = $this->input->post('kodebar');
        $txtperiode = $this->input->post('txtperiode');
        $kode_dev = $this->input->post('kode_dev');
        $result = $this->M_bkb->get_stok($kodebar, $txtperiode, $kode_dev);
        echo json_encode($result);
    }

    public function saveBkb()
    {
        $sess_lokasi = $this->session->userdata('status_lokasi');
        $id_user = $this->session->userdata('id_user');

        if ($sess_lokasi == "HO") {
            $text1 = "PST";
            $text2 = "BWJ";
            $dig_1 = "1";
            $dig_2 = "1";
        } else if ($sess_lokasi == "SITE") {
            $text1 = "EST";
            $text2 = "SWJ";
            $dig_1 = "6";
            $dig_2 = "6";
        } else if ($sess_lokasi == "RO") {
            $text1 = "ROM";
            $text2 = "PKY";
            $dig_1 = "2";
            $dig_2 = "2";
        } else if ($sess_lokasi == "PKS") {
            $text1 = "FAC";
            $text2 = "SWJ";
            $dig_1 = "3";
            $dig_2 = "3";
        }

        // $query_id_stockkeluar = "SELECT MAX(id)+1 as id_stockkeluar FROM stockkeluar";
        // $generate_id_stockkeluar = $this->db_logistik_pt->query($query_id_stockkeluar)->row();
        // $id_stockkeluar = $generate_id_stockkeluar->id_stockkeluar;
        // if (empty($id_stockkeluar)) {
        //     $id_stockkeluar = 1;
        // }

        // $query_id_keluarbrgitem = "SELECT MAX(id)+1 as id_keluarbrgitem FROM keluarbrgitem";
        // $generate_id_keluarbrgitem = $this->db_logistik_pt->query($query_id_keluarbrgitem)->row();
        // $id_keluarbrgitem = $generate_id_keluarbrgitem->id_keluarbrgitem;
        // if (empty($id_keluarbrgitem)) {
        //     $id_keluarbrgitem = 1;
        // }

        $digit = $dig_1 . $dig_2;

        $query_stockkeluar = "SELECT MAX(SUBSTRING(SKBTXT, 3)) as maxid_skb from stockkeluar WHERE SKBTXT LIKE '$digit%'";
        $generate_stockkeluar = $this->db_logistik_pt->query($query_stockkeluar)->row();
        $noUrut_stockkeluar = (int)($generate_stockkeluar->maxid_skb);
        $noUrut_stockkeluar++;
        $print_stockkeluar = sprintf("%05s", $noUrut_stockkeluar);

        $format_m_y = date("m/Y");

        if (empty($this->input->post('hidden_no_bkb'))) {
            $skb = $digit . $print_stockkeluar; //7201159 atau 1200903 atau 6271722 atau 7230088
        } else {
            $skb = $this->input->post('hidden_no_bkb');
        }

        $mutasi = $this->input->post('mutasi');

        if (empty($this->input->post('hidden_no_ref_bkb'))) {
            if ($mutasi == '1') {
                $no_ref = $text1 . "-BKB-MUTASI/" . $text2 . "/" . $format_m_y . "/" . $skb; //EST-BKB/SWJ/06/15/001159 atau //EST-BKB/SWJ/10/18/71722
            } else {
                $no_ref = $text1 . "-BKB/" . $text2 . "/" . $format_m_y . "/" . $skb; //EST-BKB/SWJ/06/15/001159 atau //EST-BKB/SWJ/10/18/71722
            }
        } else {
            $no_ref = $this->input->post('hidden_no_ref_bkb');
        }

        // $skb = $this->input->post('txt_no_bpb');
        $nobpb = $this->input->post('txt_no_bpb');
        // if (empty($nobpb) || $nobpb == "-") {
        //     $nobpb = $skb;
        // }

        $alokasi = $this->input->post('cmb_alokasi_est');

        $tgl = date("Y-m-d", strtotime($this->input->post('txt_tgl_bkb')));
        $thn = date("Y", strtotime($this->input->post('txt_tgl_bkb')));

        $sess_periode = $this->session->userdata('periode');
        $periode1 = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');
        // $periode1 = date("Y-m-d",strtotime($sess_periode));
        // $txtperiode = date("Ym",strtotime($sess_periode));
        $txttgl = date("Ymd", strtotime($this->input->post('txt_tgl_bkb')));

        $kodebar = $this->input->post('hidden_kode_barang');
        $nabar = $this->input->post('hidden_nama_barang');
        $qty = $this->input->post('txt_qty_diminta');
        $qty2 = $this->input->post('txt_qty_disetujui');

        $afd_unit = $this->input->post('cmb_afd_unit');
        $blok = $this->input->post('cmb_blok_sub');
        $satuan = $this->input->post('hidden_satuan');
        $grup_brg = $this->input->post('hidden_grup_barang');

        $kode_dev = $this->input->post('kode_dev');

        $kode_devisi_mutasi = $this->input->post('kode_devisi_mutasi');

        $kode_pt_mutasi = $this->input->post('kode_pt_mutasi');

        // Mencari alias di PT tujuan untuk mencari nama devisi tujuan
        $data['get_pt_mutasi'] = $this->db_logistik_center->get_where('tb_pt', ['kode_pt' => $kode_pt_mutasi])->row_array();

        //jika pt Tujuan
        if ($data['get_pt_mutasi']['alias'] == 'MSAL') {
            $data['get_devisi_mutasi'] = $this->db_logistik_msal->get_where('tb_devisi', ['kodetxt' => $kode_devisi_mutasi])->row_array();
        } elseif ($data['get_pt_mutasi']['alias'] == 'MAPA') {
            $data['get_devisi_mutasi'] = $this->db_logistik_mapa->get_where('tb_devisi', ['kodetxt' => $kode_devisi_mutasi])->row_array();
        }

        // mendapatkan nilai rata2
        $nilai_keluarbrgitem = $this->M_bkb->get_rata2_nilai($kodebar, $qty2, $txtperiode);

        // $datastockkeluar['id']              = $id_stockkeluar;
        $datastockkeluar['tgl']             = $tgl . " 00:00:00";
        $datastockkeluar['skb']             = $skb;
        $datastockkeluar['SKBTXT']          = $skb;
        $datastockkeluar['NO_REF']          = $no_ref;
        $datastockkeluar['nobpb']           = $nobpb;
        // jika mutasi
        if ($mutasi == '1') {
            $datastockkeluar['mutasi']              = '1';
            $datastockkeluar['no_mutasi']           = $no_ref;
            $datastockkeluar['kode_devisi_mutasi']  = $kode_devisi_mutasi;
            $datastockkeluar['devisi_mutasi']       = $data['get_devisi_mutasi']['PT'];
            $datastockkeluar['kode_pt_mutasi']      = $kode_pt_mutasi;
            $datastockkeluar['pt_mutasi']           = $data['get_pt_mutasi']['nama_pt'];
        } else {
            $datastockkeluar['mutasi']              = NULL;
            $datastockkeluar['no_mutasi']           = NULL;
            $datastockkeluar['kode_devisi_mutasi']  = NULL;
            $datastockkeluar['devisi_mutasi']       = NULL;
            $datastockkeluar['kode_pt_mutasi']      = NULL;
            $datastockkeluar['pt_mutasi']           = NULL;
        }
        $datastockkeluar['tglinput']        = date('Y-m-d H:i:s');
        $datastockkeluar['txttgl']          = $txttgl;
        $datastockkeluar['thn']             = $thn;
        $datastockkeluar['periode1']        = $periode1 . " 00:00:00";
        $datastockkeluar['periode2']        = NULL;
        $datastockkeluar['txtperiode1']     = $txtperiode;
        $datastockkeluar['txtperiode2']     = NULL;
        $datastockkeluar['alokasi']         = $alokasi;
        $datastockkeluar['pt']              = $this->session->userdata('pt');
        $datastockkeluar['kode']            = $this->session->userdata('kode_pt');
        $datastockkeluar['devisi']          = $this->input->post('devisi');
        $datastockkeluar['kode_dev']        = $kode_dev;
        $datastockkeluar['kpd']             = $this->input->post('txt_diberikan_kpd');
        $datastockkeluar['keperluan']       = $this->input->post('txt_untuk_keperluan');
        $datastockkeluar['bag']             = $this->input->post('cmb_bagian');
        $datastockkeluar['batal']           = '0';
        $datastockkeluar['id_user']         = $id_user;
        $datastockkeluar['USER']            = $this->session->userdata('user');
        $datastockkeluar['SUB']             = NULL;
        $datastockkeluar['USER1']           = NULL;
        $datastockkeluar['cetak']           = '0';
        $datastockkeluar['posting']         = '0';

        // $datakeluarbrgitem['id']            = $id_keluarbrgitem;
        $datakeluarbrgitem['kodebar']       = $kodebar;
        $datakeluarbrgitem['kodebartxt']    = $kodebar;
        $datakeluarbrgitem['nabar']         = $nabar;
        $datakeluarbrgitem['satuan']        = $satuan;
        $datakeluarbrgitem['grp']           = $grup_brg;
        $datakeluarbrgitem['alokasi']       = $alokasi;
        $datakeluarbrgitem['kodept']        = $this->session->userdata('kode_pt');
        $datakeluarbrgitem['nobpb']         = $nobpb;
        $datakeluarbrgitem['pt']            = $this->session->userdata('pt');
        $datakeluarbrgitem['kode_dev']      = $kode_dev;
        $datakeluarbrgitem['devisi']        = $this->input->post('devisi');
        $datakeluarbrgitem['afd']           = $afd_unit;
        $datakeluarbrgitem['blok']          = $blok;
        $datakeluarbrgitem['qty']           = $qty;
        $datakeluarbrgitem['qty2']          = $qty2;
        $datakeluarbrgitem['nilai_item']    = $nilai_keluarbrgitem;
        $datakeluarbrgitem['tgl']           = $tgl . " 00:00:00";
        $datakeluarbrgitem['skb']           = $skb;
        $datakeluarbrgitem['SKBTXT']        = $skb;
        $datakeluarbrgitem['NO_REF']        = $no_ref;
        $datakeluarbrgitem['tglinput']      = date('Y-m-d H:i:s');
        $datakeluarbrgitem['txttgl']        = $txttgl;
        $datakeluarbrgitem['thn']           = $thn;
        $datakeluarbrgitem['periode']       = $this->session->userdata('Ymd_periode') . " 00:00:00";
        $datakeluarbrgitem['txtperiode']    = $txtperiode;
        $datakeluarbrgitem['noadjust']      = "0";
        $datakeluarbrgitem['ket']           = $this->input->post('txt_ket_rinci');
        $datakeluarbrgitem['kodebeban']     = $this->input->post('hidden_kodebebantxt');
        $datakeluarbrgitem['kodebebantxt']  = $this->input->post('hidden_kodebebantxt');
        $datakeluarbrgitem['ketbeban']      = $this->input->post('cmb_bahan');
        $datakeluarbrgitem['kodesub']       = $this->input->post('hidden_no_acc');
        $datakeluarbrgitem['kodesubtxt']    = $this->input->post('hidden_no_acc');
        $datakeluarbrgitem['ketsub']        = $this->input->post('hidden_nama_acc');
        $datakeluarbrgitem['batal']         = '0';
        $datakeluarbrgitem['USER']          = $this->session->userdata('user');
        $datakeluarbrgitem['cetak']         = '0';
        $datakeluarbrgitem['posting']       = '0';

        if (empty($this->input->post('hidden_no_bkb'))) {
            if ($mutasi == '1') {
                $savedatastockkeluar_mutasi = $this->M_bkb->savedatastockkeluar_mutasi($datastockkeluar);
                $savedatakeluarbrgitem_mutasi = $this->M_bkb->savedatakeluarbrgitem_mutasi($datakeluarbrgitem);
            }
            $savedatastockkeluar_mutasi = NULL;
            $savedatakeluarbrgitem_mutasi = NULL;
            $savedatastockkeluar = $this->M_bkb->savedatastockkeluar($datastockkeluar);
            $savedatakeluarbrgitem = $this->M_bkb->savedatakeluarbrgitem($datakeluarbrgitem, $kodebar, $nobpb, $no_ref);
        } else {
            $savedatastockkeluar_mutasi = NULL;
            $savedatakeluarbrgitem_mutasi = NULL;
            $savedatastockkeluar = NULL;

            if ($mutasi == '1') {
                $savedatakeluarbrgitem_mutasi = $this->M_bkb->savedatakeluarbrgitem_mutasi($datakeluarbrgitem);
            }

            $savedatakeluarbrgitem = $this->M_bkb->savedatakeluarbrgitem($datakeluarbrgitem, $kodebar, $nobpb, $no_ref);
        }

        // update stockawal_bulanan_devisi
        $result_update_stockawal_bulanan_devisi = $this->M_bkb->update_stockawal_bulanan_devisi($kodebar, $qty2, $txtperiode, $kode_dev);

        //update stokawal
        $result_update_qtykeluar = $this->M_bkb->update_stockawal($kodebar, $qty2, $txtperiode);

        $query_id = "SELECT MAX(id) as id_stockkeluar FROM stockkeluar WHERE id_user = '$id_user' AND NO_REF = '$no_ref' ";
        $generate_id = $this->db_logistik_pt->query($query_id)->row();
        $id_stockkeluar = $generate_id->id_stockkeluar;

        $data = [
            'update_stockawal_bulanan_devisi' => $result_update_stockawal_bulanan_devisi,
            'datastockkeluar' => $savedatastockkeluar,
            'datakeluarbrgitem' => $savedatakeluarbrgitem,
            'result_update_qtykeluar' => $result_update_qtykeluar,
            'savedatastockkeluar_mutasi' => $savedatastockkeluar_mutasi,
            'savedatakeluarbrgitem_mutasi' => $savedatakeluarbrgitem_mutasi,
            'no_bkb' => $skb,
            'noref_bkb' => $no_ref,
            'id_stockkeluar' => $id_stockkeluar,
            'txtperiode' => $txtperiode
        ];

        echo json_encode($data);
    }

    function cetak()
    {
        $no_bkb = $this->uri->segment('3');
        $id = $this->uri->segment('4');

        $data['no_bkb'] = $no_bkb;
        $data['id'] = $id;
        $data['stockkeluar'] = $this->db_logistik_pt->get_where('stockkeluar', array('id' => $id, 'SKBTXT' => $no_bkb))->row();
        $data['keluarbrgitem'] = $this->db_logistik_pt->get_where('keluarbrgitem', array('SKBTXT' => $no_bkb, 'NO_REF' => $data['stockkeluar']->NO_REF))->result();

        $data['urut'] = $this->M_bkb->urut_cetak($data['stockkeluar']->NO_REF);

        $noref = $data['stockkeluar']->NO_REF;
        $this->qrcode($no_bkb, $id, $noref);

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

        $lokasibuatbkb = substr($noref, 0, 3);
        switch ($lokasibuatbkb) {
            case 'PST': // HO
                $lokasibkb = "HO";
                break;
            case 'ROM': // RO
                $lokasibkb = "RO";
                break;
            case 'FAC': // PKS
                $lokasibkb = "PKS";
                break;
            case 'EST': // SITE
                $lokasibkb = "SITE";
                break;
            default:
                break;
        }

        // $mpdf->SetHTMLHeader('<h4>PT MULIA SAWIT AGRO LESTARI</h4>');
        $mpdf->SetHTMLHeader('
                            <table width="100%" border="0" align="center">
                                <tr>
                                    <td rowspan="2" width="15%" height="10px"><!--img width="10%" height="60px" style="padding-left:8px" src="././assets/img/msal.jpg"--></td>
                                    <td align="center" style="font-size:14px;font-weight:bold;">PT Mulia Sawit Agro Lestari (' . $lokasibkb . ')</td>
                                </tr>
                                <!--tr>
                                    <td align="center">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
                                    </td>
                                </tr-->
                            </table>
                            <hr style="width:100%;margin:0px;">
                            ');
        // $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');

        $html = $this->load->view('v_bkbPrint', $data, true);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function qrcode($no_bkb, $id, $noref)
    {
        $this->load->library('ciqrcode');
        // header("Content-Type: image/png");

        $config['cacheable']    = false; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/bkb/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $id . '_' . $no_bkb . '.png'; //buat name dari qr code

        // $params['data'] = site_url('bkb/cetak/'.$no_bkb.'/'.$id); //data yang akan di jadikan QR CODE
        $params['data'] = $noref; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
    }

    function get_detail_approval()
    {
        $id_stockkeluar = $this->input->post('id_stockkeluar');
        $no_ref = $this->M_approval_bkb->get_noref($id_stockkeluar);
        $this->M_approval_bkb->getWhere($no_ref['NO_REF']);

        $list = $this->M_approval_bkb->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            if ($d->status_kasie_gudang == "1") {
                $status = "<span style='color: green'><b>DISETUJUI<br>" . $d->tgl_kasie_gudang . "</b></span>";
            } else {
                $status = "DALAM PROSES";
            }

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $d->id;
            $row[] = '<font face="Verdana" size="2">' . $d->kodebar . '</font>';
            $row[] = '<font face="Verdana" size="2">' . $d->nabar . '</font>';
            $row[] = '<font face="Verdana" size="2">' . $d->satuan . '</font>';
            $row[] = '<font face="Verdana" size="2">' . $d->qty . '</font>';
            $row[] = '<font face="Verdana" size="2">' . $d->qty2 . '</font>';
            $row[] = $status;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_approval_bkb->count_all(),
            "recordsFiltered" => $this->M_approval_bkb->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function approval_bkb()
    {
        $id_item_bkb = $this->input->post('id_item_bkb');
        $output = $this->M_approval_bkb->approval_bkb($id_item_bkb);

        echo json_encode($output);
    }

    public function rev_qty()
    {
        $no_ref_bpb = $this->input->post('no_ref_bpb');
        $kodebar = $this->input->post('kodebar');
        $req_rev_qty = $this->input->post('req_rev_qty');

        $output = $this->M_approval_bkb->rev_qty($no_ref_bpb, $kodebar, $req_rev_qty);

        echo json_encode($output);
    }

    public function approval_rev_qty()
    {
        $data = [
            'title' => 'Approval Revisi QTY'
        ];

        $this->template->load('template', 'v_approval_rev_qty', $data);
    }

    //Start Data Table Server Side
    public function get_data_rev_qty()
    {
        $list = $this->M_approval_rev_qty->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<button class="btn btn-warning btn-xs" id="approve_rev_qty" name="approve_rev_qty"
                        data-id_approval_bpb="' . $field->id . '" data-norefbpb="' . $field->norefbpb . '"
                        data-kodebar="' . $field->kodebar . '" data-qty_rev="' . $field->qty_rev . '"
                        data-toggle="tooltip" data-placement="top" title="detail">
                        Approve</button>';
            $row[] = $no;
            $row[] = $field->norefbpb;
            $row[] = $field->kodebar;
            $row[] = $field->nabar;
            $row[] = $field->qty_diminta;
            $row[] = $field->qty_rev;
            $row[] = $field->user_req_rev_qty;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_approval_rev_qty->count_all(),
            "recordsFiltered" => $this->M_approval_rev_qty->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    // //End Start Data Table Server Side

    public function ktu_approve_rev_qty()
    {
        $id_approval_bpb = $this->input->post('id_approval_bpb');
        $norefbpb = $this->input->post('norefbpb');
        $kodebar = $this->input->post('kodebar');
        $qty_rev = $this->input->post('qty_rev');

        $output = $this->M_approval_rev_qty->ktu_approve_rev_qty($id_approval_bpb, $norefbpb, $kodebar, $qty_rev);

        echo json_encode($output);
    }

    public function get_devisi_mutasi()
    {
        $kode_pt = $this->input->post('kode_pt');

        $data['pt_mutasi'] = $this->db_logistik_center->get_where('tb_pt', ['kode_pt' => $kode_pt])->row_array();

        if ($data['pt_mutasi']['alias'] == 'MSAL') {
            $output = $this->db_logistik_msal->get('tb_devisi')->result_array();
        } elseif ($data['pt_mutasi']['alias'] == 'MAPA') {
            $output = $this->db_logistik_mapa->get('tb_devisi')->result_array();
        }
        //pt peak dan psam belum!!

        // $output = $this->M_bkb->get_devisi_mutasi($kode_pt);

        echo json_encode($output);
    }
}
