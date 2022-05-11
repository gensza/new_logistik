<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lpb extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('M_lpb');
        $this->load->model('M_item_lpb');
        $this->load->model('M_lpb_mutasi');
        $this->load->model('M_detail_lpb');
        $this->load->model('M_lpb_gl');

        $db_pt = check_db_pt();

        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);

        $this->db_logistik = $this->load->database('db_logistik', TRUE);

        $this->db_logistik_center = $this->load->database('db_logistik_center', TRUE);

        // $this->db_mips_gl = $this->load->database('db_mips_gl_' . $db_pt, TRUE);

        if ($this->session->userdata('kode_dev') == '01') {
            $this->db_mips_gl = $this->load->database('db_mips_gl_' . $db_pt, TRUE); //HO
        } elseif ($this->session->userdata('kode_dev') == '02') {
            $this->db_mips_gl = $this->load->database('mips_gl_' . $db_pt . '_ro', TRUE); //RO
        } elseif ($this->session->userdata('kode_dev') == '03') {
            $this->db_mips_gl = $this->load->database('mips_gl_' . $db_pt . '_pks', TRUE); //PKS
        } else {
            $this->db_mips_gl = $this->load->database('mips_gl_' . $db_pt . '_site', TRUE); //SITE
        }

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

    function hitungIsiItem()
    {
        $noref = $this->input->post('ref_lpb');
        $data = $this->db_logistik_pt->query("SELECT * FROM masukitem WHERE noref='$noref'")->num_rows();
        echo json_encode($data);
    }

    public function input()
    {
        $data['title'] = 'Laporan Penerimaan Barang';

        $data['devisi'] = $this->M_lpb->cariDevisi();

        $this->template->load('template', 'v_lpbInput', $data);
    }

    public function get_data_lpb()
    {
        $data = $this->input->post('data');
        $this->M_lpb->where_datatables($data);
        $list = $this->M_lpb->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            if ($field->BATAL != 1) {
                # code...
                $row[] = '<button class="btn btn-xs btn-warning fa fa-edit" id="edit_lpb" name="edit_lpb"
                            data-id="' . $field->id . '" data-mutasi="' . $field->jenis_lpb . '"
                            data-toggle="tooltip" data-placement="top" title="detail" onClick="return false">
                            </button>
                            <button class="btn btn-success btn-xs fa fa-eye" id="detail_lpb" name="detail_lpb"
                            data-noref="' . $field->noref . '" data-mutasi="' . $field->jenis_lpb . '" data-batal="' . $field->BATAL . '"
                            data-toggle="tooltip" data-placement="top" title="detail" onClick="return false">
                            </button>
                            <a href="' . site_url('Lpb/cetak/' . $field->ttg . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_lpb"></a>';
            } else {
                # code...
                $row[] = '<button class="btn btn-success btn-xs fa fa-eye" id="detail_lpb" name="detail_lpb"
                                        data-noref="' . $field->noref . '" data-mutasi="' . $field->jenis_lpb . '" data-batal="' . $field->BATAL . '"
                                        data-toggle="tooltip" data-placement="top" title="detail" onClick="return false">
                                        </button>
                                        <a href="' . site_url('Lpb/cetak/' . $field->ttg . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_lpb"></a>';
            }

            $row[] = $no;
            $row[] = date("d-m-Y", strtotime($field->tgl));
            $row[] = date("d-m-Y", strtotime($field->tglinput));
            $row[] = $field->noref;
            $row[] = $field->refpo;
            $row[] = $field->nama_supply;
            $row[] = '<p style="word-break: break-word; margin-bottom: 0px;">' .  htmlspecialchars($field->ket) . ' </p>';
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

    public function get_grup_barang()
    {
        $kodebar =  $this->input->post('kodebar');
        $data =  $this->db_logistik_center->get_where('kodebar', array('kodebartxt' => $kodebar))->row();
        echo json_encode($data);
    }

    public function saveLpb()
    {
        $id_user = $this->session->userdata('id_user');
        $lokasilpb = $this->session->userdata('status_lokasi'); //HO, RO, SITE, PKS
        $nopo = $this->input->post('txt_no_po');
        $refpo = $this->input->post('txt_ref_po');

        // if ($refpo == "MUTASI") {
        //     $refpo = $this->input->post('hidden_no_ref_bkb');
        // }

        // $polokal = substr($refpo, 8, 8); // PO-Lokal
        // switch ($polokal) {
        //     case "PO-Lokal":
        //         $lokasilpb = $this->session->userdata('status_lokasi'); //HO, RO, SITE, PKS
        //         switch ($lokasilpb) {
        //             case 'HO': // HO
        //                 $digit2 = "1";
        //                 break;
        //             case 'RO': // RO
        //                 $digit2 = "4";
        //                 break;
        //             case 'PKS': // PKS
        //                 $digit2 = "3";
        //                 break;
        //             case 'SITE': // SITE
        //                 $digit2 = "2";
        //                 break;
        //             default:
        //                 break;
        //         }
        //         break;
        //     default:
        //         if (substr($refpo, 4, 3) == "POA") {
        //             $digit2 = "1";
        //         } else {
        //             switch ($lokasilpb) {
        //                 case 'HO': // HO
        //                     $digit2 = "1";
        //                     break;
        //                 case 'RO': // RO
        //                     $digit2 = "2";
        //                     break;
        //                 case 'PKS': // PKS
        //                     $digit2 = "2";
        //                     break;
        //                 case 'SITE': // SITE
        //                     $digit2 = "2";
        //                     break;
        //                 default:
        //                     break;
        //             }
        //         }
        //         break;
        // }

        // switch ($lokasilpb) {
        //     case 'HO':
        //         $ref_2 = "BWJ";
        //         break;
        //     case 'SITE':
        //         $ref_2 = "SWJ";
        //         break;
        //     case 'PKS':
        //         $ref_2 = "SWJ";
        //         break;
        //     case 'RO':
        //         $ref_2 = "PKY";
        //         break;
        //     default:
        //         break;
        // }

        $mutasi_ga = $this->input->post('mutasi');

        if ($mutasi_ga == '1') {
            $mutasi = "1";
            $noref_ppo = '0';
            $jenis_lpb = '1'; // 0 = lpb, 1 = lpb mutasi, 2 = lpb retur
            $alias_ref = '-MUT';
        } else {
            $mutasi = "0";
            $noref_ppo = $this->input->post('hidden_norefppo');
            $jenis_lpb = '0'; // 0 = lpb, 1 = lpb mutasi, 2 = lpb retur
            $alias_ref = '';
        }

        $lokasibuatpo = substr($refpo, 0, 3);
        switch ($lokasibuatpo) {
            case 'PST': // HO
                $ref_1 = "PST-LPB" . $alias_ref . "";
                $ref_2 = "BWJ";
                break;
            case 'ROM': // RO
                $ref_1 = "ROM-LPB" . $alias_ref . "";
                $ref_2 = "PKY";
                break;
            case 'FAC': // PKS
                $ref_1 = "FAC-LPB" . $alias_ref . "";
                $ref_2 = "SWJ";
                break;
            case 'EST': // SITE
                $ref_1 = "EST-LPB" . $alias_ref . "";
                $ref_2 = "SWJ";
                break;
            default:
                break;
        }

        if ($this->session->userdata('status_lokasi') == "HO") {
            $digit2 = "1";
        } else {
            $digit2 = "2";
        }

        $kode_devisi    = $this->input->post('devisi');
        $digit1 = preg_replace("/[^1-9]/", "", $kode_devisi);

        $digit1_2 = $digit1 . $digit2;

        $kodebar = $this->input->post('txt_kode_barang');
        $nabar = $this->input->post('txt_nama_brg');

        $hitung_digit1_2 = strlen($digit1_2);
        $query_masuk_item = "SELECT MAX(SUBSTRING(ttgtxt, $hitung_digit1_2+1)) as maxttg from masukitem WHERE ttg LIKE '$digit1_2%'";
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
            $no_ref_lpb = $ref_1 . "/" . $ref_2 . "/" . $ref_3 . "/" . $no_lpb; //LPB/PST/01/00233 // Est-LPB/swj/12/18/07836 // EST/SWJ/RETURN/642/XIV/12/2018
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

        $tgl_terima = date("Y-m-d H:i:s", strtotime($this->input->post('txt_tgl_terima')));

        $txttgl = date("Ymd", strtotime($this->input->post('txt_tgl_terima')));
        $thn = date("Y", strtotime($this->input->post('txt_tgl_terima')));
        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');

        $kodept = $this->session->userdata('kode_pt');
        // $periode = date("Y-m-d", strtotime($this->input->post('txt_tgl_terima')));
        // $txtperiode = date("Ym", strtotime($this->input->post('txt_tgl_terima')));

        // $query_get_po = "SELECT id, nopotxt, kode_supply, nama_supply FROM po WHERE nopotxt = '$nopo' AND noreftxt = '$refpo'";
        // $get_po = $this->db_logistik_pt->query($query_get_po)->row();

        //ini refppo dari header, kalo yg bawah dari item nya
        $refppo = $this->input->post('hidden_refppo');

        $query_get_item_po = "SELECT id, nopotxt, kurs, konversi FROM item_po WHERE nopotxt = '$nopo' AND noref = '$refpo' AND kodebartxt = '$kodebar' AND nabar = '$nabar' AND refppo = '$refppo'";
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
        // if ($no_ref_po == 'MUTASI') {
        //     $no_ref_po = str_replace("BKB", "MUTASI", $refpo);
        // }

        $kode_devisi = $this->input->post('devisi');
        $data['devisi'] = $this->db_logistik_pt->get_where('tb_devisi', array('kodetxt' => $kode_devisi))->row_array();

        $data_stokmasuk = [
            'tgl' => $tgl_terima,
            'kd_dept' => $this->input->post('hidden_kd_dept'),
            'ket_dept' => $this->input->post('hidden_ket_dept'),
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
            'pt' => $data['devisi']['PT'],
            'kode' => $kode_devisi,
            'devisi' => $data['devisi']['PT'],
            'kode_dev' => $kode_devisi,
            'jenis_lpb' => $jenis_lpb,
            'lokasi' => $this->session->userdata('status_lokasi'),
            'tglppo' => $this->input->post('hidden_tglppo'),
            'norefppo' => $noref_ppo,
            'tglpo' => $this->input->post('txt_tgl_po'),
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
        // $data_stokmasuk_histori = [
        //     'tgl' => $tgl_terima,
        //     'nopo' => $no_po,
        //     'nopotxt' => $no_po,
        //     'LOKAL' => $po_lokal,
        //     'ASSET' => '0',
        //     'kode_supply' => $this->input->post('txt_kd_supplier'),
        //     'nama_supply' => $this->input->post('txt_supplier'),
        //     'ttg' => $no_lpb,
        //     'ttgtxt' => $no_lpb,
        //     'no_pengtr' => $this->input->post('txt_no_pengantar'),
        //     'lokasi_gudang' => $this->input->post('txt_lokasi_gudang'),
        //     'ket' => $this->input->post('txt_ket_pengiriman'),
        //     'tglinput' => date("Y-m-d H:i:s"),
        //     'txttgl' => $txttgl,
        //     'thn' => $thn,
        //     'periode1' => $periode,
        //     'periode2' => NULL,
        //     'txtperiode1' => $txtperiode,
        //     'txtperiode2' => NULL,
        //     'pt' => $this->session->userdata('pt'),
        //     'kode' => $kodept,
        //     'lokasi' => $this->session->userdata('status_lokasi'),
        //     'refpo' => $no_ref_po,
        //     'noref' => $no_ref_lpb,
        //     'BATAL' => '0',
        //     'alasan_batal' => '0',
        //     'USER' => $this->session->userdata('user'),
        //     'cetak' => '0',
        //     'posting' => '0',
        //     'keterangan_transaksi' => 'INPUT LPB',
        //     'log' => $this->session->userdata('user') . " membuat LPB $no_lpb",
        //     'tgl_transaksi' => date("Y-m-d H:i:s"),
        //     'user_transaksi' => $this->session->userdata('user'),
        //     'client_ip' => $this->input->ip_address(),
        //     'client_platform' => $this->platform->agent(),
        // ];


        $data_masukitem = [
            'kdpt' => $kode_devisi,
            'nopo' => $no_po,
            'nopotxt' => $no_po,
            'LOKAL' => $po_lokal,
            'ASSET' => $asset,
            'pt' => $data['devisi']['PT'],
            'devisi' => $data['devisi']['PT'],
            'kode_dev' => $kode_devisi,
            'afd' => '-',
            'kodebar' => $this->input->post('txt_kode_barang'),
            'kodebartxt' => $this->input->post('txt_kode_barang'),
            'nabar' => $this->input->post('txt_nama_brg'),
            'satuan' => $this->input->post('txt_satuan'),
            'grp' => $this->input->post('hidden_grup'),
            'qtypo' => $this->input->post('hidden_qtypo'),
            'qty' => $this->input->post('txt_qty'),
            'tgl' => $tgl_terima,
            'tglpo' => $this->input->post('txt_tgl_po'),
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
            'norefppo' => $noref_ppo,
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
        // $data_masukitem_histori = [
        //     'kdpt' => $this->session->userdata('kode_pt'),
        //     'nopo' => $no_po,
        //     'nopotxt' => $no_po,
        //     'LOKAL' => $po_lokal,
        //     'ASSET' => $asset,
        //     'pt' => $this->session->userdata('pt'),
        //     'afd' => '-',
        //     'kodebar' => $this->input->post('txt_kode_barang'),
        //     'kodebartxt' => $this->input->post('txt_kode_barang'),
        //     'nabar' => $this->input->post('txt_nama_brg'),
        //     'satuan' => $this->input->post('txt_satuan'),
        //     'grp' => $this->input->post('hidden_grup'),
        //     'qty' => $this->input->post('txt_qty'),
        //     'tgl' => $tgl_terima,
        //     'ttg' => $no_lpb,
        //     'ttgtxt' => $no_lpb,
        //     'tglinput' => date("Y-m-d H:i:s"),
        //     'txttgl' => $txttgl,
        //     'thn' => $thn,
        //     'periode' => $periode,
        //     'txtperiode' => $txtperiode,
        //     'noadjust' => '0',
        //     'ket' => $this->input->post('txt_ket_rinci'),
        //     'lokasi' => $this->session->userdata('status_lokasi'),
        //     'refpo' => $no_ref_po,
        //     'noref' => $no_ref_lpb,
        //     'BATAL' => '0',
        //     'alasan_batal' => '0',
        //     'kurs' => $kurs,
        //     'konversi' => $konversi,
        //     'USER' => $this->session->userdata('user'),
        //     'cetak' => '0',
        //     'posting' => '0',
        //     'keterangan_transaksi' => 'INPUT ITEM LPB',
        //     'log' => $this->session->userdata('user') . " membuat ITEM LPB $no_lpb",
        //     'tgl_transaksi' => date("Y-m-d H:i:s"),
        //     'user_transaksi' => $this->session->userdata('user'),
        //     'client_ip' => $this->input->ip_address(),
        //     'client_platform' => $this->platform->agent(),
        // ];


        $quantiti = $this->input->post('txt_qty');

        // mencari harga PO untuk di input
        if ($mutasi == '1') {
            $harga_item_po = $this->M_lpb->cari_harga_mutasi($no_ref_po, $kodebar);
        } else {
            $result_harga_item_po = $this->M_lpb->cari_harga_po($no_ref_po, $kodebar, $noref_ppo);
            $harga_item_po = $result_harga_item_po['harga'];
        }

        $data_register_stok = [
            'kodebar' => $this->input->post('txt_kode_barang'),
            'kodebartxt' => $this->input->post('txt_kode_barang'),
            'namabar' => $this->input->post('txt_nama_brg'),
            'grup' => $this->input->post('hidden_grup'),
            'tgl' => $periode,
            'tgltxt' => date("Ymd", strtotime($periode)),
            'potxt' => '-',
            'ttgtxt' => $no_lpb,
            'skbtxt' => '-',
            'adjttgtxt' => '-',
            'adjskbtxt' => '-',
            'retttgtxt' => '-',
            'retskbtxt' => '-',
            'no_slrh' => $no_lpb,
            'ket' => $this->input->post('txt_ket_rinci'),
            'harga' => $harga_item_po,
            'qty' => $this->input->post('txt_qty'),
            'masuk_qty' => $this->input->post('txt_qty'),
            'masuk_qty' => $this->input->post('txt_qty'),
            'keluar_qty' => '0',
            'status' => 'LPB',
            'kodept' => $this->session->userdata('kode_pt'),
            'namapt' => $this->session->userdata('pt'),
            'devisi' => $data['devisi']['PT'],
            'kode_dev' => $kode_devisi,
            'txtperiode' => $txtperiode,
            'lokasi' => $this->session->userdata('status_lokasi'),
            'refpo' => '-',
            'noref' => $no_ref_lpb,
            'id_user' => $id_user,
            'USER' => $this->session->userdata('user'),
        ];

        $sat = $this->input->post('txt_satuan');
        $grp = $this->input->post('hidden_grup');

        $cari_kodebar_stock_awal = $this->M_lpb->cari_kodebar($kodebar, $txtperiode);

        //save lpb
        if (empty($this->input->post('hidden_no_lpb'))) {

            //insert stock awal
            if ($cari_kodebar_stock_awal == 0) {

                $this->insert_stokawal($kodebar, $data_masukitem['nabar'], $data_masukitem['satuan'], $data_masukitem['grp'], $no_ref_po, $quantiti, $mutasi, $data_masukitem['norefppo']);
            }

            $data_exist = NULL;
            $data = $this->M_item_lpb->saveLpb($data_stokmasuk);
            $data2 = $this->M_item_lpb->saveLpb2($data_masukitem);
            $data3 = $this->M_item_lpb->saveRegisterStok($data_register_stok);
            // $data4 =  $this->db_logistik_pt->insert('stokmasuk_history', $data_stokmasuk_histori);
            // $data5 =  $this->db_logistik_pt->insert('masukitem_history', $data_masukitem_histori);

            $result_insert_stok_awal_harian = $this->insert_stok_awal_harian($kodebar, $nabar, $sat, $grp, $no_ref_po, $quantiti, $data_stokmasuk['devisi'], $data_stokmasuk['kode_dev'], $mutasi, $data_masukitem['norefppo']);

            // insert stockawal_bulanan_devisi jika bulan ini barang blm ada maka insert else update
            $result_insert_stok_awal_bulanan = $this->insert_stok_awal_bulanan_devisi($kodebar, $nabar, $sat, $grp, $quantiti, $data_stokmasuk['devisi'], $data_stokmasuk['kode_dev']);

            $result_update_stok_awal = $this->update_stok_awal($kodebar, $txtperiode);

            // insert to GL
            $result_insert_to_gl_header = $this->insert_lpb_to_header_entry_gl($no_lpb, $data_stokmasuk['kode_dev'], $no_ref_lpb);
            $result_insert_lpb_to_entry_gl_dr = $this->insert_lpb_to_entry_gl_dr($no_lpb, $harga_item_po, $quantiti, $data_stokmasuk['kode_dev'], $kodebar, $no_ref_lpb, $nabar, $no_ref_po);
            $result_insert_lpb_to_entry_gl_cr = $this->insert_lpb_to_entry_gl_cr($no_lpb, $harga_item_po, $quantiti, $data_stokmasuk['kode_dev'], $kodebar, $no_ref_lpb, $nabar, $no_ref_po, $data_stokmasuk['kode_supply'], $data_stokmasuk['nama_supply'], $mutasi);
        } else {

            //cek ada kodebar yg sama atau tidak pada noref ini
            $cari_kodebar_masukitem = $this->M_lpb->cari_kodebar_masukitem($kodebar, $no_ref_lpb);

            if ($cari_kodebar_masukitem >= 1) {

                $data_exist = 'kodebar_exist';
                $data = NULL;
                $data2 = NULL;
                $data3 = NULL;
                $result_insert_stok_awal_harian = NULL;
                $result_insert_stok_awal_bulanan = NULL;
                $result_update_stok_awal = NULL;
                $id_lpb = NULL;
                $id_item_lpb = NULL;
                $result_insert_to_gl_header = NULL;
                $result_insert_lpb_to_entry_gl_dr = NULL;
                $result_insert_lpb_to_entry_gl_cr = NULL;
            } else {
                if ($cari_kodebar_stock_awal == 0) {

                    $this->insert_stokawal($kodebar, $data_masukitem['nabar'], $data_masukitem['satuan'], $data_masukitem['grp'], $no_ref_po, $quantiti, $mutasi, $data_masukitem['norefppo']);
                }

                $data_exist = NULL;
                $data = NULL;
                $data2 = $this->M_item_lpb->saveLpb2($data_masukitem);
                $data3 = $this->M_item_lpb->saveRegisterStok($data_register_stok);
                // $data4 = $this->db_logistik_pt->insert('masukitem_history', $data_masukitem_histori);

                $result_insert_stok_awal_harian = $this->insert_stok_awal_harian($kodebar, $nabar, $sat, $grp, $no_ref_po, $quantiti, $data_stokmasuk['devisi'], $data_stokmasuk['kode_dev'], $mutasi, $data_masukitem['norefppo']);

                // insert stockawal_bulanan_devisi jika bulan ini barang blm ada maka insert else update
                $result_insert_stok_awal_bulanan = $this->insert_stok_awal_bulanan_devisi($kodebar, $nabar, $sat, $grp, $quantiti, $data_stokmasuk['devisi'], $data_stokmasuk['kode_dev']);

                $result_update_stok_awal = $this->update_stok_awal($kodebar, $txtperiode);

                // insert to GL
                $result_insert_to_gl_header = NULL;
                $result_insert_lpb_to_entry_gl_dr = $this->insert_lpb_to_entry_gl_dr($no_lpb, $harga_item_po, $quantiti, $data_stokmasuk['kode_dev'], $kodebar, $no_ref_lpb, $nabar, $no_ref_po);
                $result_insert_lpb_to_entry_gl_cr = $this->insert_lpb_to_entry_gl_cr($no_lpb, $harga_item_po, $quantiti, $data_stokmasuk['kode_dev'], $kodebar, $no_ref_lpb, $nabar, $no_ref_po, $data_stokmasuk['kode_supply'], $data_stokmasuk['nama_supply'], $mutasi);
            }
        }

        $query_id = "SELECT MAX(id) as id_lpb FROM stokmasuk WHERE id_user = '$id_user' AND noref = '$no_ref_lpb' ";
        $generate_id = $this->db_logistik_pt->query($query_id)->row();
        $id_lpb = $generate_id->id_lpb;

        $query_id = "SELECT MAX(id) as id_item_lpb FROM masukitem WHERE id_user = '$id_user' AND noref = '$no_ref_lpb' ";
        $generate_id = $this->db_logistik_pt->query($query_id)->row();
        $id_item_lpb = $generate_id->id_item_lpb;

        $query_id = "SELECT MAX(id) as id_register_stok FROM register_stok WHERE id_user = '$id_user' AND noref = '$no_ref_lpb' ";
        $generate_id = $this->db_logistik_pt->query($query_id)->row();
        $id_register_stok = $generate_id->id_register_stok;

        $data_return = [
            'insert_stok_awal_bulanan' => $result_insert_stok_awal_bulanan,
            'insert_stok_harian' => $result_insert_stok_awal_harian,
            'update_stok' => $result_update_stok_awal,
            'data' => $data,
            'data2' => $data2,
            'insert_register_stok' => $data3,
            'nolpb' => $no_lpb,
            'id_lpb' => $id_lpb,
            'id_item_lpb' => $id_item_lpb,
            'id_register_stok' => $id_register_stok,
            'txtperiode' => $txtperiode,
            'noreflpb' => $no_ref_lpb,
            'data_exist' => $data_exist,
            'insert_lpb_to_entry_gl_dr' => $result_insert_lpb_to_entry_gl_dr,
            'insert_lpb_to_entry_gl_cr' => $result_insert_lpb_to_entry_gl_cr,
            'insert_to_gl_header' => $result_insert_to_gl_header
        ];

        echo json_encode($data_return);
    }

    function insert_lpb_to_header_entry_gl($no_lpb, $kode_dev, $no_ref_lpb)
    {
        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');
        $status_lokasi = $this->session->userdata('status_lokasi');
        $user = $this->session->userdata('user');

        $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';


        //var untuk save ke header entry
        $header_entry["date"] = date("Y-m-d");
        $header_entry["periode"] = $periodes;
        $header_entry["ref"] = 'LPB-' . $no_lpb;
        $header_entry["totaldr"] = 0;
        $header_entry["totalcr"] = 0;
        $header_entry["periodetxt"] = $txtperiode;
        $header_entry["modul"] = 'LOGISTIK';
        $header_entry["lokasi"] = $status_lokasi;
        $header_entry["SBU"] = $kode_dev;
        $header_entry["USER"] = $user;
        $header_entry["noref"] = $no_ref_lpb;

        return $this->M_lpb_gl->insert_lpb_to_header_entry_gl($header_entry);
    }

    function insert_lpb_to_entry_gl_cr($no_lpb, $harga_item_po, $quantiti, $kode_dev, $kodebar, $no_ref_lpb, $nabar, $no_ref_po, $kode_supply, $nama_supply, $mutasi)
    {
        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');
        $status_lokasi = $this->session->userdata('status_lokasi');
        $user = $this->session->userdata('user');

        $totharga = $harga_item_po * $quantiti;

        if ($mutasi == '1') {
            $data_noac_gl = $this->M_lpb_gl->get_data_noac_gl($kode_supply);
        } else {
            $data_noac_gl = $this->M_lpb_gl->get_data_noac_supplier($kode_supply);
        }

        $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';

        //var untuk save ke entry
        $entry["date"] = date("Y-m-d");
        $entry["sbu"] = $kode_dev;
        $entry["noac"] = $data_noac_gl['noac'];
        $entry["desc"] = '';
        $entry["group"] = $data_noac_gl['group'];
        $entry["type"] = $data_noac_gl['type'];
        $entry["level"] = $data_noac_gl['level'];
        $entry["general"] = $data_noac_gl['general'];
        $entry["dc"] = 'C';
        $entry["dr"] = 0;
        $entry["cr"] = $totharga;
        $entry["periode"] = $periodes;
        $entry["converse"] = 0;
        $entry["ref"] = 'LPB-' . $no_lpb;
        $entry["noref"] = $no_ref_lpb;
        $entry["descac"] = $data_noac_gl['nama'];
        $entry["ket"] = 'Hutang Supplier No.PO:' . $no_ref_po . '/' . $nabar;
        $entry["begindr"] = 0;
        $entry["begincr"] = 0;
        $entry["kurs"] = '';
        $entry["kursrate"] = '';
        $entry["tglkurs"] = '';
        $entry["periodetxt"] = $txtperiode;
        $entry["module"] = 'LOGISTIK';
        $entry["lokasi"] = $status_lokasi;
        $entry["POST"] = 0;
        $entry["tglinput"] = date("Y-m-d H:i:s");
        $entry["USER"] = $user;
        $entry["kodebar"] = $kodebar;

        if ($data_noac_gl != NULL) {
            return $this->M_lpb_gl->insert_lpb_to_entry_gl_cr($entry, $entry["ref"]);
        } else {
            return 0;
        }
    }

    function insert_lpb_to_entry_gl_dr($no_lpb, $harga_item_po, $quantiti, $kode_dev, $kodebar, $no_ref_lpb, $nabar, $no_ref_po)
    {
        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');
        $status_lokasi = $this->session->userdata('status_lokasi');
        $user = $this->session->userdata('user');

        $totharga = $harga_item_po * $quantiti;

        $data_noac_gl = $this->M_lpb_gl->get_data_noac_gl($kodebar);

        $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';

        //var untuk save ke entry
        $entry["date"] = date("Y-m-d");
        $entry["sbu"] = $kode_dev;
        $entry["noac"] = $data_noac_gl['noac'];
        $entry["desc"] = '';
        $entry["group"] = $data_noac_gl['group'];
        $entry["type"] = $data_noac_gl['type'];
        $entry["level"] = $data_noac_gl['level'];
        $entry["general"] = $data_noac_gl['general'];
        $entry["dc"] = 'D';
        $entry["dr"] = $totharga;
        $entry["cr"] = 0;
        $entry["periode"] = $periodes;
        $entry["converse"] = 0;
        $entry["ref"] = 'LPB-' . $no_lpb;
        $entry["noref"] = $no_ref_lpb;
        $entry["descac"] = $nabar;
        $entry["ket"] = 'Persediaan No.PO:' . $no_ref_po;
        $entry["begindr"] = 0;
        $entry["begincr"] = 0;
        $entry["kurs"] = '';
        $entry["kursrate"] = '';
        $entry["tglkurs"] = '';
        $entry["periodetxt"] = $txtperiode;
        $entry["module"] = 'LOGISTIK';
        $entry["lokasi"] = $status_lokasi;
        $entry["POST"] = 0;
        $entry["tglinput"] = date("Y-m-d H:i:s");
        $entry["USER"] = $user;
        $entry["kodebar"] = $kodebar;

        if ($data_noac_gl != NULL) {
            return $this->M_lpb_gl->insert_lpb_to_entry_gl_dr($entry, $entry["ref"]);
        } else {
            return 0;
        }
    }

    function insert_stok_awal_bulanan_devisi($kodebar, $nabar, $sat, $grp, $qty, $devisi, $kode_dev)
    {
        $data_insert_stok_bulanan = [
            'pt' => $this->session->userdata('pt'),
            'KODE' => $this->session->userdata('kode_pt'),
            'devisi' => $devisi,
            'kode_dev' => $kode_dev,
            'afd' => '-',
            'kodebar' => $kodebar,
            'kodebartxt' => $kodebar,
            'nabar' => $nabar,
            'satuan' => $sat,
            'grp' => $grp,
            'saldoawal_qty' => 0,
            'saldoawal_nilai' => 0,
            'saldoakhir_qty' => $qty,
            'tglinput' => date("Y-m-d H:i:s"),
            'thn' => date("Y"),
            'QTY_MASUK' => $qty,
            'periode' => $this->session->userdata('Ymd_periode'),
            'txtperiode' => $this->session->userdata('ym_periode'),
            'ket' => '-',
            'account' => '-',
            'ket_account' => '-',
            'tgl_transaksi' => date("Y-m-d H:i:s")
        ];

        $cek_stokawal_bulanan_devisi = $this->M_lpb->cek_stok_awal_bulanan_devisi($kodebar, $data_insert_stok_bulanan['txtperiode'], $kode_dev);

        if ($cek_stokawal_bulanan_devisi >= 1) {
            //update stok awal bulanan devisi
            return $this->M_lpb->updateStokAwalBulananDevisi($kodebar, $data_insert_stok_bulanan['txtperiode'], $qty, $kode_dev);
        } else {
            //insert stok awal bulanan devisi
            return $this->M_lpb->saveStokAwalBulananDevisi($data_insert_stok_bulanan);
        }
    }

    function insert_stokawal($kodebar, $nabar, $satuan, $grp, $no_ref_po, $qty, $mutasi, $norefppo)
    {
        if ($mutasi == '1') {
            $harga_item_po = $this->M_lpb->cari_harga_mutasi($no_ref_po, $kodebar);
            $saldoakhir_nilai = $harga_item_po * $qty;
        } else {
            $harga_item_po = $this->M_lpb->cari_harga_po($no_ref_po, $kodebar, $norefppo);
            $saldoakhir_nilai = $harga_item_po['harga'] * $qty;
        }

        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');

        $pt = $this->session->userdata('pt');
        $KODE = $this->session->userdata('kode_pt');
        $kodebar = $kodebar;

        $data_input_stock_awal["pt"] = $pt;
        $data_input_stock_awal["KODE"] = $KODE;
        $data_input_stock_awal["afd"] = "-";
        $data_input_stock_awal["kodebar"] = $kodebar;
        $data_input_stock_awal["kodebartxt"] = $kodebar;
        $data_input_stock_awal["nabar"] = $nabar;
        $data_input_stock_awal["satuan"] = $satuan;
        $data_input_stock_awal["grp"] = $grp;
        $data_input_stock_awal["saldoawal_qty"] = 0;
        $data_input_stock_awal["saldoawal_nilai"] = 0;
        $data_input_stock_awal["tglinput"] = date("Y-m-d H:i:s");
        $data_input_stock_awal["thn"] = date("Y");
        $data_input_stock_awal["saldoakhir_qty"] = $qty;
        $data_input_stock_awal["saldoakhir_nilai"] = $saldoakhir_nilai;
        $data_input_stock_awal["nilai_masuk"] = 0;
        $data_input_stock_awal["nilai_keluar"] = 0;
        $data_input_stock_awal["QTY_MASUK"] = $qty;
        $data_input_stock_awal["QTY_KELUAR"] = "0";
        $data_input_stock_awal["HARGARAT"] = "0";
        $data_input_stock_awal["periode"] = $periode;
        $data_input_stock_awal["txtperiode"] = $txtperiode;
        $data_input_stock_awal["account"] = "-";
        $data_input_stock_awal["ket_account"] = "-";

        $this->db_logistik_pt->insert('stockawal', $data_input_stock_awal);
    }

    function insert_stok_awal_harian($kodebar, $nabar, $sat, $grp, $no_ref_po, $qty, $devisi, $kode_dev, $mutasi, $norefppo)
    {

        if ($mutasi == '1') {
            $harga_item_po = $this->M_lpb->cari_harga_mutasi($no_ref_po, $kodebar);
            $saldoakhir_nilai = $harga_item_po * $qty;
        } else {
            $result_harga_item_po = $this->M_lpb->cari_harga_po($no_ref_po, $kodebar, $norefppo);
            $harga_item_po = $result_harga_item_po['harga'];
            $saldoakhir_nilai = $harga_item_po * $qty;
        }

        $data_insert_stok_harian = [
            'pt' => $this->session->userdata('pt'),
            'KODE' => $this->session->userdata('kode_pt'),
            'devisi' => $devisi,
            'kode_dev' => $kode_dev,
            'afd' => '-',
            'kodebar' => $kodebar,
            'kodebartxt' => $kodebar,
            'nabar' => $nabar,
            'satuan' => $sat,
            'grp' => $grp,
            'saldoawal_qty' => 0,
            'saldoawal_nilai' => 0,
            'tglinput' => date("Y-m-d H:i:s"),
            'thn' => date("Y"),
            'saldoakhir_qty' => $qty,
            'saldoakhir_nilai' => $saldoakhir_nilai,
            'nilai_masuk' => $saldoakhir_nilai,
            'QTY_MASUK' => $qty,
            'periode' => $this->session->userdata('Ymd_periode'),
            'txtperiode' => $this->session->userdata('ym_periode'),
            'ket' => '-',
            'account' => '-',
            'ket_account' => '-',
            'tgl_transaksi' => date("Y-m-d H:i:s")
        ];

        $cek_stokawal_harian = $this->M_lpb->cek_stokawal_harian($kodebar, $data_insert_stok_harian['periode'], $kode_dev);

        if ($cek_stokawal_harian >= 1) {
            //update stok awal harian
            return $this->M_lpb->updateStokAwalHarian($kodebar, $data_insert_stok_harian['periode'], $data_insert_stok_harian['txtperiode'], $qty, $harga_item_po, $kode_dev);
        } else {
            //insert stok awal harian
            return $this->M_lpb->saveStokAwalHarian($data_insert_stok_harian);
        }
    }

    function update_stok_awal($kodebar, $txtperiode)
    {
        //saldoakhir_nilai
        $sum_harga_kodebar = $this->M_lpb->sum_harga_kodebar_harian($kodebar, $txtperiode);

        //saldo akhir qty
        $sum_saldo_qty_kodebar = $this->M_lpb->sum_saldo_qty_kodebar_harian($kodebar, $txtperiode);

        //nilai_masuk
        $sum_nilai_masuk = $this->M_lpb->sum_nilai_masuk_harian($kodebar, $txtperiode);

        //qty masuk
        $sum_qty_kodebar = $this->M_lpb->sum_qty_kodebar_harian($kodebar, $txtperiode);

        $data_update = [
            'saldoakhir_nilai' => $sum_harga_kodebar,

            'saldoakhir_qty' => $sum_saldo_qty_kodebar,

            'nilai_masuk' => $sum_nilai_masuk->nilai_masuk_harian,

            'QTY_MASUK' => $sum_qty_kodebar->qty_harian
        ];

        return $this->M_lpb->updateStokAwal($data_update, $kodebar, $txtperiode);
    }


    function sum_sisa_qty_po()
    {
        $no_ref_po = $this->input->post('no_ref_po');
        $no_po = $this->input->post('no_po');
        $kodebar = $this->input->post('kodebar');
        $refppo = $this->input->post('refppo');

        //QTY PO nya di ambil
        $query_qty_po = "SELECT id, nopotxt, noppotxt, refppo, noref, kodebartxt, nabar, qty, sat, ket FROM item_po WHERE nopotxt = '$no_po' AND noref = '$no_ref_po' AND kodebartxt = '$kodebar' AND refppo = '$refppo'";
        $data_qty_po = $this->db_logistik_pt->query($query_qty_po)->row();

        //sum qty LPB nya udah berapa
        $query_sisa_qty_lpb = "SELECT SUM(qty) as qty_lpb FROM masukitem WHERE BATAL<>1 AND kodebartxt = '$kodebar' AND nopotxt = '$no_po' AND refpo = '$no_ref_po' AND norefppo = '$refppo'";
        $data_sisa_qty_lpb = $this->db_logistik_pt->query($query_sisa_qty_lpb)->row();

        $sisa_qty_po = $data_qty_po->qty - $data_sisa_qty_lpb->qty_lpb;

        if ($sisa_qty_po == 0) {
            $this->M_lpb->updateStatusItemLpb($no_ref_po, $kodebar, $refppo);
        } else {
            $this->M_lpb->updateStatusItemLpb2($no_ref_po, $kodebar, $refppo);
        }

        echo json_encode($sisa_qty_po);
    }

    public function get_data_po_qr()
    {
        $noref = $this->input->post('noref');
        $result = $this->M_lpb->get_data_po_qr($noref);
        echo json_encode($result);
    }

    public function sum_qty()
    {
        $kodebar = $this->input->post('kodebar');
        $noreftxt = $this->input->post('noreftxt');
        $qty = $this->input->post('qty');
        $refppo = $this->input->post('refppo');
        $result = $this->M_lpb->sumqty($kodebar, $noreftxt, $qty, $refppo);
        echo json_encode($result);
    }

    public function select2_get_po()
    {
        $data = $this->M_lpb->get_nopo();
        echo json_encode($data);
    }

    public function updateLpb()
    {
        $id = $this->input->post('hidden_id_item_lpb');
        $noref_lpb = $this->input->post('hidden_no_ref_lpb');
        $id_register_stok = $this->input->post('hidden_id_register_stok');
        $norefpo = $this->input->post('norefpo');
        $kodebar = $this->input->post('kodebar');
        $mutasi = $this->input->post('mutasi');
        $check_asset = $this->input->post('chk_asset');
        $txtperiode = $this->input->post('hidden_txtperiode');
        $kode_dev = $this->input->post('kode_dev');
        $refppo = $this->input->post('refppo');
        $edit = $this->input->post('edit');

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

        $data_update_register_stok = [
            'qty' => $this->input->post('txt_qty'),
            'masuk_qty' => $this->input->post('txt_qty'),
            'ket' => $this->input->post('txt_ket_rinci')
        ];

        //cari harga
        if ($mutasi == '1') {
            $harga_item_po = $this->M_lpb->cari_harga_mutasi($norefpo, $kodebar);
        } else {
            $result_harga_item_po = $this->M_lpb->cari_harga_po($norefpo, $kodebar, $refppo);
            $harga_item_po = $result_harga_item_po['harga'];
        }

        //cari periode di masukitem
        $periode = $this->M_lpb->cari_periode_barang($id);

        //update stok awal harian
        if ($periode['qty'] != $data_item_lpb['qty']) {
            $data_editStokAwalHarian = $this->M_lpb->editStokAwalHarian($kodebar, $periode['periode'], $periode['qty'], $data_item_lpb['qty'], $harga_item_po, $kode_dev);
            $data_editStokAwalBulananDevisi = $this->M_lpb->editStokAwalBulananDevisi($kodebar, $periode['txtperiode'], $periode['qty'], $data_item_lpb['qty'], $kode_dev);
            $data_edit_gl = $this->M_lpb_gl->edit_gl($kodebar, $harga_item_po, $data_item_lpb['qty'], $noref_lpb);
        } else {
            $data_editStokAwalHarian = 'no edit';
            $data_editStokAwalBulananDevisi = 'no edit';
            $data_edit_gl = 'no edit';
        }

        //update stok awal

        //insert histori
        // $get_lpb = $this->db_logistik_pt->get_where('masukitem', array('id' => $id))->row();
        // $data_masukitem_histori = [
        //     'kdpt' => $this->session->userdata('kode_pt'),
        //     'nopo' => $get_lpb->nopo,
        //     'nopotxt' => $get_lpb->nopotxt,
        //     'LOKAL' => $get_lpb->LOKAL,
        //     'ASSET' => $get_lpb->ASSET,
        //     'pt' => $this->session->userdata('pt'),
        //     'afd' => '-',
        //     'kodebar' => $get_lpb->kodebar,
        //     'kodebartxt' => $get_lpb->kodebartxt,
        //     'nabar' => $get_lpb->nabar,
        //     'satuan' => $get_lpb->satuan,
        //     'grp' => $get_lpb->grp,
        //     'qty' => $get_lpb->qty,
        //     'tgl' => $get_lpb->tgl,
        //     'ttg' => $get_lpb->ttg,
        //     'ttgtxt' => $get_lpb->ttgtxt,
        //     'tglinput' => $get_lpb->tglinput,
        //     'txttgl' => $get_lpb->txttgl,
        //     'thn' => $get_lpb->thn,
        //     'periode' => $get_lpb->periode,
        //     'txtperiode' => $get_lpb->txtperiode,
        //     'noadjust' => $get_lpb->noadjust,
        //     'ket' => $get_lpb->ket,
        //     'lokasi' => $this->session->userdata('status_lokasi'),
        //     'refpo' => $get_lpb->refpo,
        //     'noref' => $get_lpb->noref,
        //     'BATAL' => $get_lpb->BATAL,
        //     'alasan_batal' => $get_lpb->alasan_batal,
        //     'kurs' => $get_lpb->kurs,
        //     'konversi' => $get_lpb->konversi,
        //     'USER' => $this->session->userdata('user'),
        //     'cetak' => $get_lpb->cetak,
        //     'posting' => $get_lpb->posting,
        //     'keterangan_transaksi' => 'UPDATE ITEM LPB',
        //     'log' => $this->session->userdata('user') . " mengubah ITEM LPB $get_lpb->ttg",
        //     'tgl_transaksi' => date("Y-m-d H:i:s"),
        //     'user_transaksi' => $this->session->userdata('user'),
        //     'client_ip' => $this->input->ip_address(),
        //     'client_platform' => $this->platform->agent(),
        // ];
        // $this->db_logistik_pt->insert('masukitem_history', $data_masukitem_histori);
        //endss
        $update_stok_awal = $this->update_stok_awal($kodebar, $txtperiode);

        $data_update_lpb = $this->M_lpb->updateLpb($data_item_lpb, $id);

        if ($edit == '1') {
            $data_update_register_stok = $this->M_lpb->updateRegisterStok_edit($data_update_register_stok, $noref_lpb, $kodebar);
        } else {
            $data_update_register_stok = $this->M_lpb->updateRegisterStok($data_update_register_stok, $id_register_stok);
        }

        $data = [
            'harga_item_po' => $harga_item_po,
            'data_editStokAwalHarian' => $data_editStokAwalHarian,
            'data_editStokAwalBulananDevisi' => $data_editStokAwalBulananDevisi,
            'update_stok_awal' => $update_stok_awal,
            'data_update_lpb' => $data_update_lpb,
            'data_update_register_stok' => $data_update_register_stok,
            'data_edit_gl' => $data_edit_gl,
            'periode' => $periode,
        ];
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
        $noref = $this->input->post('noref');
        // $mutasi = $this->input->post('mutasi');
        // $noreftxt = $this->M_detail_lpb->get_noref($noref);
        $this->M_detail_lpb->getWhere($noref);
        $list = $this->M_detail_lpb->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            $no++;
            $row = array();
            $row[] = $no . ".";

            // if ($mutasi == '1') {
            //     $result_qty_po = $this->M_lpb->getQtyMutasi($d->kodebar, $d->refpo);
            //     $qty_po = $result_qty_po['qty2'];
            // } else {
            //     $result_qty_po = $this->M_lpb->getQtyPo($d->kodebar, $d->refpo);
            //     $qty_po = $result_qty_po['qty'];
            // }

            $sisa_lpb = $this->M_lpb->get_sisa_lpb($d->kodebar, $d->refpo, $d->norefppo);

            $result_sisa_lpb = $d->qtypo - $sisa_lpb->qty_lpb;

            $row[] = $d->kodebar;
            $row[] = $d->nabar;
            $row[] = $d->satuan;
            $row[] = $d->grp;
            $row[] = $d->qtypo;
            $row[] = $d->qty;
            $row[] = $result_sisa_lpb;
            $row[] = '<p style="word-break: break-word; margin-bottom: 0px;">' .  htmlspecialchars($d->ket) . ' </p>';


            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_detail_lpb->count_all(),
            "recordsFiltered" => $this->M_detail_lpb->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function edit_lpb()
    {
        $data['id_stokmasuk'] = $this->uri->segment('3');
        $mutasi = $this->uri->segment('4');
        if ($mutasi == 1) {
            $this->template->load('template', 'v_lpbEdit_mutasi', $data);
        } else {
            $this->template->load('template', 'v_lpbEdit', $data);
        }
    }

    public function cari_lpb_edit()
    {
        $id_stokmasuk = $this->input->post('id_stokmasuk');

        $data = $this->M_lpb->cari_lpb_edit($id_stokmasuk);

        echo json_encode($data);
    }

    public function sum_qty_edit()
    {
        $kodebar = $this->input->post('kodebar');
        $refpo = $this->input->post('refpo');
        $norefppo = $this->input->post('norefppo');
        $result = $this->M_lpb->sumqty_edit($kodebar, $refpo, $norefppo);
        echo json_encode($result);
    }

    function update_alasan()
    {
        $reflpb = $this->input->post('noref_lpb');
        $alasan_edit = $this->input->post('alasan');

        $isiedit = array(
            'alasan_batal' => $alasan_edit
        );
        $data = $this->M_lpb->update_alasan($reflpb, $isiedit);
        echo json_encode($data);
    }

    function cetak()
    {
        $no_lpb = $this->uri->segment('3');
        $id = $this->uri->segment('4');

        $data['no_lpb'] = $no_lpb;
        $data['id'] = $id;
        $data['stokmasuk'] = $this->db_logistik_pt->get_where('stokmasuk', array('id' => $id, 'ttgtxt' => $no_lpb))->row();
        $data['masukitem'] = $this->db_logistik_pt->get_where('masukitem', array('ttgtxt' => $no_lpb, 'noref' => $data['stokmasuk']->noref))->result();

        $data['urut'] = $this->M_lpb->urut_cetak($no_lpb);

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
            'format' => 'A4',
            // 'setAutoTopMargin' => 'stretch',
            'margin_top' => '2',
            'margin_left' => '5',
            'margin_right' => '5',
            'orientation' => 'P'
        ]);

        $lokasibuatlpb = substr($noref, 0, 3);
        switch ($lokasibuatlpb) {
            case 'PST': // HO
                $data['lokasilpb'] = "HO";
                break;
            case 'ROM': // RO
                $data['lokasilpb'] = "RO";
                break;
            case 'FAC': // PKS
                $data['lokasilpb'] = "PKS";
                break;
            case 'EST': // SITE
                $data['lokasilpb'] = "SITE";
                break;
            default:
                break;
        }

        // if ($data['stokmasuk']->lokasi == 'HO') {
        //     $alamat_lok = '<p style="font-size:8px">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru, JakartaSelatan, DKI Jakarta Raya-12140</p>';
        // } else {
        //     $alamat_lok = '';
        // }

        // $logo_pt = $this->session->userdata('logo_pt');
        // $mpdf->SetHTMLHeader('<h4>PT MULIA SAWIT AGRO LESTARI</h4>');
        // $mpdf->SetHTMLHeader('
        //     <table width="100%" border="0" align="center" style="margin-bottom:-30px;">
        //         <tr>
        //             <td rowspan="5" width="12%" height="10px"><img width="10%" height="60px" style="padding-left: 0px" src="././assets/logo/' . $logo_pt . '"></td>
        //             <td rowspan="5" align="left" style="vertical-align: text-top; padding-top:10px">
        //                 <b style="font-size:14px">' . $data['stokmasuk']->pt . '</b> <br>
        //                 ' . $alamat_lok . '
        //             </td>
        //             <td>Putih</td>
        //             <td>:</td>
        //             <td>Finance HO</td>
        //         </tr>
        //         <!--tr>
        //             <td align="center" rowspan="5">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
        //             </td>
        //         </tr-->
        //         <tr>
        //             <td>Merah</td>
        //             <td>:</td>
        //             <td>Accounting HO</td>
        //         </tr>
        //         <tr>
        //             <td>Kuning</td>
        //             <td>:</td>
        //             <td>Gudang Est</td>
        //         </tr>
        //         <tr>
        //             <td>Hijau</td>
        //             <td>:</td>
        //             <td>Accounting Est</td>
        //         </tr>
        //         <tr>
        //             <td>Biru</td>
        //             <td>:</td>
        //             <td>Purchasing HO</td>
        //         </tr>
        //     </table>
        // ');
        // $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');
        if ($data['stokmasuk']->BATAL == 1) {
            # code...
            $mpdf->SetWatermarkImage(
                '././assets/img/batal.png',
                0.3,
                '',
                array(25, 10)
            );
            $mpdf->showWatermarkImage = true;
        }



        if (substr($data['stokmasuk']->noref, 8, 3) == "MUT") {
            $html = $this->load->view('v_lpbPrint_mutasi', $data, true);
        } else {
            $html = $this->load->view('v_lpbPrint', $data, true);
        }

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

    public function updatePoAfterLpb()
    {
        $no_ref_po = $this->input->post('no_ref_po');

        $output = $this->M_lpb->updatePoAfterLpb($no_ref_po);

        echo json_encode($output);
    }

    //GENZA JANGAN DI HAPUS YA
    public function batalLpb()
    {
        $noreflpb = $this->input->post('noreflpb');
        $norefpo = $this->input->post('norefpo');
        $alasan = $this->input->post('alasan');

        //update sudah_lpb di po jadi 0
        $this->M_lpb->update_sudah_lpb_po($norefpo);

        //insert histori
        // $get_lpb = $this->db_logistik_pt->get_where('stokmasuk', array('noref' => $noreflpb))->row();
        // $data_stokmasuk_histori = [
        //     'tgl' => $get_lpb->tgl,
        //     'nopo' => $get_lpb->nopo,
        //     'nopotxt' => $get_lpb->nopotxt,
        //     'LOKAL' => $get_lpb->LOKAL,
        //     'ASSET' => $get_lpb->ASSET,
        //     'kode_supply' => $get_lpb->kode_supply,
        //     'nama_supply' => $get_lpb->nama_supply,
        //     'ttg' => $get_lpb->ttg,
        //     'ttgtxt' => $get_lpb->ttgtxt,
        //     'no_pengtr' => $get_lpb->no_pengtr,
        //     'lokasi_gudang' => $get_lpb->lokasi_gudang,
        //     'ket' => $get_lpb->ket,
        //     'tglinput' => $get_lpb->tglinput,
        //     'txttgl' => $get_lpb->txttgl,
        //     'thn' => $get_lpb->thn,
        //     'periode1' => $get_lpb->periode1,
        //     'periode2' => $get_lpb->periode2,
        //     'txtperiode1' => $get_lpb->txtperiode1,
        //     'txtperiode2' => $get_lpb->txtperiode2,
        //     'pt' => $this->session->userdata('pt'),
        //     'kode' => $get_lpb->kode,
        //     'lokasi' => $this->session->userdata('status_lokasi'),

        //     'refpo' => $get_lpb->refpo,
        //     'noref' => $get_lpb->noref,
        //     'BATAL' => $get_lpb->BATAL,
        //     'alasan_batal' => $get_lpb->alasan_batal,
        //     'USER' => $this->session->userdata('user'),
        //     'cetak' => $get_lpb->cetak,
        //     'posting' => $get_lpb->posting,
        //     'keterangan_transaksi' => 'BATAL LPB',
        //     'log' => $this->session->userdata('user') . " MEMBATALKAN LPB $get_lpb->ttg",
        //     'tgl_transaksi' => date("Y-m-d H:i:s"),
        //     'user_transaksi' => $this->session->userdata('user'),
        //     'client_ip' => $this->input->ip_address(),
        //     'client_platform' => $this->platform->agent(),
        // ];

        // $data4 =  $this->db_logistik_pt->insert('stokmasuk_history', $data_stokmasuk_histori);

        $delete_header_entry = $this->db_mips_gl->delete('header_entry', array('noref' => $noreflpb));

        $isibatal = array(
            'BATAL' => 1,
            'alasan_batal' => $alasan
        );
        // $data = $this->db_logistik_pt->delete('stokmasuk', array('noref' => $noreflpb));
        $data = $this->M_lpb->updatebatal($noreflpb, $isibatal);

        echo json_encode($data);
    }


    public function batalItemLpb()
    {
        $hidden_id_item_lpb = $this->input->post('hidden_id_item_lpb');
        $no_ref_lpb = $this->input->post('hidden_no_ref_lpb');
        $kodebar = $this->input->post('kodebar');
        $id_register_stok = $this->input->post('hidden_id_register_stok');
        $norefpo = $this->input->post('norefpo');
        $delete_stok_register = $this->input->post('delete_stok_register');
        $alasan = $this->input->post('alasan');

        //insert histori
        // $get_lpb = $this->db_logistik_pt->get_where('masukitem', array('id' => $hidden_id_item_lpb))->row();
        // $data_masukitem_histori = [
        //     'kdpt' => $this->session->userdata('kode_pt'),
        //     'nopo' => $get_lpb->nopo,
        //     'nopotxt' => $get_lpb->nopotxt,
        //     'LOKAL' => $get_lpb->LOKAL,
        //     'ASSET' => $get_lpb->ASSET,
        //     'pt' => $this->session->userdata('pt'),
        //     'afd' => '-',
        //     'kodebar' => $get_lpb->kodebar,
        //     'kodebartxt' => $get_lpb->kodebartxt,
        //     'nabar' => $get_lpb->nabar,
        //     'satuan' => $get_lpb->satuan,
        //     'grp' => $get_lpb->grp,
        //     'qty' => $get_lpb->qty,
        //     'tgl' => $get_lpb->tgl,
        //     'ttg' => $get_lpb->ttg,
        //     'ttgtxt' => $get_lpb->ttgtxt,
        //     'tglinput' => $get_lpb->tglinput,
        //     'txttgl' => $get_lpb->txttgl,
        //     'thn' => $get_lpb->thn,
        //     'periode' => $get_lpb->periode,
        //     'txtperiode' => $get_lpb->txtperiode,
        //     'noadjust' => $get_lpb->noadjust,
        //     'ket' => $get_lpb->ket,
        //     'lokasi' => $this->session->userdata('status_lokasi'),
        //     'refpo' => $get_lpb->refpo,
        //     'noref' => $get_lpb->noref,
        //     'BATAL' => $get_lpb->BATAL,
        //     'alasan_batal' => $get_lpb->alasan_batal,
        //     'kurs' => $get_lpb->kurs,
        //     'konversi' => $get_lpb->konversi,
        //     'USER' => $this->session->userdata('user'),
        //     'cetak' => $get_lpb->cetak,
        //     'posting' => $get_lpb->posting,
        //     'keterangan_transaksi' => 'BATAL ITEM LPB',
        //     'log' => $this->session->userdata('user') . " membatalkan ITEM LPB $get_lpb->ttg",
        //     'tgl_transaksi' => date("Y-m-d H:i:s"),
        //     'user_transaksi' => $this->session->userdata('user'),
        //     'client_ip' => $this->input->ip_address(),
        //     'client_platform' => $this->platform->agent(),
        // ];
        // $this->db_logistik_pt->insert('masukitem_history', $data_masukitem_histori);
        //endss

        $isibatal = array(
            'BATAL' => 1,
            'alasan_batal' => $alasan
        );
        // $delete_masukitem = $this->db_logistik_pt->delete('masukitem', array('id' => $hidden_id_item_lpb));
        $delete_masukitem = $this->M_lpb->updateItembatal($hidden_id_item_lpb, $isibatal);

        if ($delete_stok_register == '1') {
            $delete_regis = $this->db_logistik_pt->delete('register_stok', array('kodebar' => $kodebar, 'noref' => $no_ref_lpb));
        } else {
            $delete_regis = $this->db_logistik_pt->delete('register_stok', array('id' => $id_register_stok));
        }

        //delete ke GL
        $delete_gl = $this->db_mips_gl->delete('entry', array('kodebar' => $kodebar, 'noref' => $no_ref_lpb));

        //update sttaus_lpb di po jadi 0
        $update_lpb_po = $this->M_lpb->update_status_lpb_po($norefpo);

        $data = [
            'delete_masukitem' => $delete_masukitem,
            'delete_regis' => $delete_regis,
            'update_lpb_po' => $update_lpb_po,
            'delete_gl' => $delete_gl
        ];
        echo json_encode($data);
    }
    //END

    public function deleteItemLpb()
    {
        $hidden_id_item_lpb = $this->input->post('hidden_id_item_lpb');
        $no_ref_lpb = $this->input->post('hidden_no_ref_lpb');
        $kodebar = $this->input->post('kodebar');
        $id_register_stok = $this->input->post('hidden_id_register_stok');
        $norefpo = $this->input->post('norefpo');
        $delete_stok_register = $this->input->post('delete_stok_register');


        //insert histori
        // $get_lpb = $this->db_logistik_pt->get_where('masukitem', array('id' => $hidden_id_item_lpb))->row();
        // $data_masukitem_histori = [
        //     'kdpt' => $this->session->userdata('kode_pt'),
        //     'nopo' => $get_lpb->nopo,
        //     'nopotxt' => $get_lpb->nopotxt,
        //     'LOKAL' => $get_lpb->LOKAL,
        //     'ASSET' => $get_lpb->ASSET,
        //     'pt' => $this->session->userdata('pt'),
        //     'afd' => '-',
        //     'kodebar' => $get_lpb->kodebar,
        //     'kodebartxt' => $get_lpb->kodebartxt,
        //     'nabar' => $get_lpb->nabar,
        //     'satuan' => $get_lpb->satuan,
        //     'grp' => $get_lpb->grp,
        //     'qty' => $get_lpb->qty,
        //     'tgl' => $get_lpb->tgl,
        //     'ttg' => $get_lpb->ttg,
        //     'ttgtxt' => $get_lpb->ttgtxt,
        //     'tglinput' => $get_lpb->tglinput,
        //     'txttgl' => $get_lpb->txttgl,
        //     'thn' => $get_lpb->thn,
        //     'periode' => $get_lpb->periode,
        //     'txtperiode' => $get_lpb->txtperiode,
        //     'noadjust' => $get_lpb->noadjust,
        //     'ket' => $get_lpb->ket,
        //     'lokasi' => $this->session->userdata('status_lokasi'),
        //     'refpo' => $get_lpb->refpo,
        //     'noref' => $get_lpb->noref,
        //     'BATAL' => $get_lpb->BATAL,
        //     'alasan_batal' => $get_lpb->alasan_batal,
        //     'kurs' => $get_lpb->kurs,
        //     'konversi' => $get_lpb->konversi,
        //     'USER' => $this->session->userdata('user'),
        //     'cetak' => $get_lpb->cetak,
        //     'posting' => $get_lpb->posting,
        //     'keterangan_transaksi' => 'DELETE ITEM LPB',
        //     'log' => $this->session->userdata('user') . " menghapus ITEM LPB $get_lpb->ttg",
        //     'tgl_transaksi' => date("Y-m-d H:i:s"),
        //     'user_transaksi' => $this->session->userdata('user'),
        //     'client_ip' => $this->input->ip_address(),
        //     'client_platform' => $this->platform->agent(),
        // ];
        // $this->db_logistik_pt->insert('masukitem_history', $data_masukitem_histori);
        //endss

        $delete_masukitem = $this->db_logistik_pt->delete('masukitem', array('id' => $hidden_id_item_lpb));

        if ($delete_stok_register == '1') {
            $delete_regis = $this->db_logistik_pt->delete('register_stok', array('kodebar' => $kodebar, 'noref' => $no_ref_lpb));
        } else {
            $delete_regis = $this->db_logistik_pt->delete('register_stok', array('id' => $id_register_stok));
        }

        //delete ke GL
        $delete_gl = $this->db_mips_gl->delete('entry', array('kodebar' => $kodebar, 'noref' => $no_ref_lpb));

        //update sttaus_lpb di po jadi 0
        $update_lpb_po = $this->M_lpb->update_status_lpb_po($norefpo);

        $data = [
            'delete_masukitem' => $delete_masukitem,
            'delete_regis' => $delete_regis,
            'update_lpb_po' => $update_lpb_po,
            'delete_gl' => $delete_gl,
            'kodebar' => $kodebar,
            'no_ref_lpb' => $no_ref_lpb,
        ];
        echo json_encode($data);
    }

    public function cek_data_masukitem()
    {
        $noreflpb = $this->input->post('noreflpb');

        $output = $this->M_lpb->cek_data_masukitem($noreflpb);

        echo json_encode($output);
    }

    public function deleteLpb()
    {
        $noreflpb = $this->input->post('noreflpb');
        $norefpo = $this->input->post('norefpo');

        //update sudah_lpb di po jadi 0
        $this->M_lpb->update_sudah_lpb_po($norefpo);

        $delete_stokmasuk = $this->db_logistik_pt->delete('stokmasuk', array('noref' => $noreflpb));

        $delete_header_entry = $this->db_mips_gl->delete('header_entry', array('noref' => $noreflpb));

        $data = [
            'delete_stokmasuk' => $delete_stokmasuk,
            'delete_header_entry' => $delete_header_entry
        ];

        echo json_encode($data);
    }

    public function cekDataLpb()
    {
        $noreflpb = $this->input->post('noreflpb');
        $data =  $this->db_logistik_pt->get_where('masukitem', array('noref' => $noreflpb))->num_rows();

        echo json_encode($data);
    }


    // FOR LPB MUTASI PREN
    public function lpb_mutasi()
    {
        $data['noref_mutasi'] = str_replace('.', '/', $this->uri->segment('3'));
        $data['title'] = 'LPB Mutasi';
        $this->template->load('template', 'v_lpbInput_mutasi', $data);
    }

    public function select2_get_bkb_mutasi()
    {
        $data = $this->M_lpb_mutasi->get_bkb_mutasi();
        echo json_encode($data);
    }

    public function get_data_mutasi_item()
    {
        $noref = $this->input->post('noref');
        $result = $this->M_lpb_mutasi->get_data_mutasi_item($noref);
        echo json_encode($result);
    }

    public function sum_qty_mutasi()
    {
        $kodebar = $this->input->post('kodebar');
        $noref = $this->input->post('noref');
        $qty = $this->input->post('qty');
        $result = $this->M_lpb_mutasi->sumqtymutasi($kodebar, $noref, $qty);
        echo json_encode($result);
    }

    function sum_sisa_qty_mutasi()
    {
        $no_ref_po = $this->input->post('no_ref_po');
        $kodebar = $this->input->post('kodebar');

        $this->db_logistik_center->select('NO_REF');
        $this->db_logistik_center->where(['no_mutasi' => $no_ref_po]);
        $this->db_logistik_center->from('tb_mutasi');
        $data_tb_mutasi = $this->db_logistik_center->get()->row_array();
        $no_ref_po_mutasi = $data_tb_mutasi['NO_REF'];

        //QTY PO nya di ambil
        $query_qty_mutasi = "SELECT qty FROM tb_mutasi_item WHERE NO_REF = '$no_ref_po_mutasi' AND kodebartxt = '$kodebar'";
        $data_qty_mutasi = $this->db_logistik_center->query($query_qty_mutasi)->row();

        //sum qty LPB nya udah berapa
        $query_sisa_qty_lpb = "SELECT SUM(qty) as qty_lpb FROM masukitem WHERE BATAL<>1 AND kodebartxt = '$kodebar' AND refpo = '$no_ref_po'";
        $data_sisa_qty_lpb = $this->db_logistik_pt->query($query_sisa_qty_lpb)->row();

        $sisa_qty_po = $data_qty_mutasi->qty - $data_sisa_qty_lpb->qty_lpb;

        if ($sisa_qty_po == 0) {
            $this->M_lpb_mutasi->updateStatusItemLpb_mutasi($no_ref_po, $kodebar);
        } else {
            $this->M_lpb_mutasi->updateStatusItemLpb2_mutasi($no_ref_po, $kodebar);
        }

        echo json_encode($sisa_qty_po);
    }

    public function sum_qty_edit_mutasi()
    {
        $kodebar = $this->input->post('kodebar');
        $refpo = $this->input->post('refpo');
        $result = $this->M_lpb_mutasi->sum_qty_edit_mutasi($kodebar, $refpo);
        echo json_encode($result);
    }
}
