<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Retur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_retur');
        // $this->load->model('M_approval_bkb');
        $this->load->model('M_cari_bkbitem');
        $this->load->model('M_get_bkb');
        $this->load->model('M_approval_retur');
        $this->load->model('M_retur_gl');

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

        // DB GL
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

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = [
            'title' => 'data Retur BKB',
        ];
        $this->template->load('template', 'v_dataRetur', $data);
    }

    public function input()
    {
        $data = [
            'title' => 'Input Retur BKB',
        ];
        $this->template->load('template', 'v_inputRetur', $data);
    }

    public function edit_retur()
    {
        $id_retskb = $this->uri->segment('3');

        $data = [
            'title' => 'Edit Retur BKB',
            'id_retskb' => $id_retskb
        ];
        $this->template->load('template', 'v_editRetur', $data);
    }

    public function cari_retur_edit()
    {
        $id_retskb = $this->input->post('id_retskb');

        $output = $this->M_retur->cari_retur_edit($id_retskb);

        echo json_encode($output);
    }

    //Start Data Table Server Side
    public function get_data_retur()
    {
        $list = $this->M_retur->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            if ($field->status_approval == '1') {
                $aksi = '<button class="btn btn-success btn-xs fa fa-eye" id="approval_retur" name="approval_retur"
                data-id_retskb="' . $field->id . '" data-norefretur="' . $field->norefretur . '" 
                data-toggle="tooltip" data-placement="top" title="detail">
                </button>
                <a href="' . site_url('Retur/cetak/' . $field->noretur . '/' . $field->id) . '" target="_blank" class="btn btn-danger btn-xs fa fa-print" id="a_print_lpb"></a>';
            } else {
                if ($field->batal == 1) {
                    # code...
                    $aksi = '<button class="btn btn-success btn-xs fa fa-eye" id="approval_retur" name="approval_retur"
                    data-id_retskb="' . $field->id . '" data-norefretur="' . $field->norefretur . '" data-batal="' . $field->batal . '"
                    data-toggle="tooltip" data-placement="top" title="detail">
                    </button>
                   
                    <a href="' . site_url('Retur/cetak/' . $field->noretur . '/' . $field->id) . '" target="_blank" class="btn btn-danger btn-xs fa fa-print" id="a_print_lpb"></a>';
                } else {
                    $aksi = '<button class="btn btn-success btn-xs fa fa-eye" id="approval_retur" name="approval_retur"
                    data-id_retskb="' . $field->id . '" data-norefretur="' . $field->norefretur . '" data-batal="' . $field->batal . '"
                    data-toggle="tooltip" data-placement="top" title="detail">
                    </button>
                    <button class="btn btn-xs btn-warning fa fa-edit" id="edit_retur" name="edit_retur"
                    data-id_retskb="' . $field->id . '" 
                    data-toggle="tooltip" data-placement="top" title="detail" onClick="return false">
                    </button>
                    <a href="' . site_url('Retur/cetak/' . $field->noretur . '/' . $field->id) . '" target="_blank" class="btn btn-danger btn-xs fa fa-print" id="a_print_lpb"></a>';
                    # code...
                }
            }

            $no++;
            $row = array();
            $row[] = $aksi;
            $row[] = $no;
            $row[] = date("Y-m-d", strtotime($field->tgl));
            $row[] = $field->norefretur;
            $row[] = $field->norefbkb;
            $row[] = $field->bag;
            $row[] = $field->no_ba;
            $row[] = $field->keterangan;
            $row[] = $field->user;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_retur->count_all(),
            "recordsFiltered" => $this->M_retur->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    //End Start Data Table Server Side

    public function get_qty_bkb()
    {
        $kodebar = $this->input->post('kodebar');
        $norefbkb = $this->input->post('norefbkb');
        $data = $this->M_retur->get_qty_bkb($kodebar, $norefbkb);

        echo json_encode($data);
    }

    // //Start Data Table Server Side
    public function get_data_bkb()
    {
        $list = $this->M_get_bkb->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<button class="btn btn-success btn-xs" id="data_bkb" name="data_bkb"
                        data-no_ref="' . $field->NO_REF . '" data-devisi="' . $field->devisi . '"
                        data-kode_dev="' . $field->kode_dev . '" data-bag="' . $field->bag . '"
                        data-skb="' . $field->skb . '" data-pt="' . $field->pt . '"
                        data-kode="' . $field->kode . '" data-tgl_bkb="' . $field->tgl . '"
                        data-toggle="tooltip" data-placement="top" title="detail">pilih
                        </button>';
            $row[] = $no;
            $row[] = date("Y-m-d", strtotime($field->tglinput));
            $row[] = $field->NO_REF;
            $row[] = $field->devisi;
            $row[] = $field->bag;
            $row[] = $field->keperluan;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_get_bkb->count_all(),
            "recordsFiltered" => $this->M_get_bkb->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    // //End Start Data Table Server Side

    public function get_data_bkb_qr()
    {
        $noref = $this->input->post('noref');
        $result = $this->M_retur->get_data_bkb_qr($noref);
        echo json_encode($result);
    }

    // public function get_tahun_tanam()
    // {
    //     $coa_material = $this->input->post('coa_material');
    //     $result = $this->M_bkb->get_tahun_tanam($coa_material);
    //     echo json_encode($result);
    // }

    public function get_stok()
    {
        $kodebar = $this->input->post('kodebar');
        $txtperiode = $this->input->post('txtperiode');
        $kode_dev = $this->input->post('kode_dev');
        $result = $this->M_retur->get_stok($kodebar, $txtperiode, $kode_dev);
        echo json_encode($result);
    }

    public function saveRetur()
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

        $digit = $dig_1 . $dig_2;

        $query_retskb = "SELECT MAX(SUBSTRING(noretur, 3)) as maxid_skb from retskb WHERE noretur LIKE '$digit%'";
        $generate_retskb = $this->db_logistik_pt->query($query_retskb)->row();
        $noUrut_retskb = (int)($generate_retskb->maxid_skb);
        $noUrut_retskb++;
        $print_retskb = sprintf("%05s", $noUrut_retskb);

        $format_m_y = date("m/Y");

        if (empty($this->input->post('hidden_noretur'))) {
            $noretur = $digit . $print_retskb; //7201159 atau 1200903 atau 6271722 atau 7230088
        } else {
            $noretur = $this->input->post('hidden_noretur');
        }

        if (empty($this->input->post('hidden_norefretur'))) {
            $norefretur = $text1 . "-RETUR/" . $text2 . "/" . $format_m_y . "/" . $noretur; //EST-BKB/SWJ/06/15/001159 atau //EST-BKB/SWJ/10/18/71722
        } else {
            $norefretur = $this->input->post('hidden_norefretur');
        }

        $nobkb = $this->input->post('hidden_nobkb');
        $norefbkb = $this->input->post('hidden_norefbkb');

        $tgl = date("Y-m-d", strtotime($this->input->post('txt_tgl_retur')));
        $thn = date("Y", strtotime($this->input->post('txt_tgl_retur')));

        $periode1 = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');
        $txttgl = date("Ymd", strtotime($this->input->post('txt_tgl_retur')));

        $kodebar = $this->input->post('hidden_kode_barang');
        $nabar = $this->input->post('txt_barang');
        $sat = $this->input->post('hidden_satuan_brg');
        $grp = $this->input->post('hidden_grup_barang');
        $quantiti = $this->input->post('txt_qty_retur');
        $devisi = $this->input->post('hidden_devisi');
        $kode_dev = $this->input->post('hidden_kode_dev');
        $no_ba = $this->input->post('no_ba');

        $data_retskb['noretur']         = $noretur;
        $data_retskb['norefretur']      = $norefretur;
        $data_retskb['tgl']             = $tgl;
        $data_retskb['nobkb']           = $nobkb;
        $data_retskb['norefbkb']        = $norefbkb;
        $data_retskb['tglinput']        = date("Y-m-d H:i:s");
        $data_retskb['txttgl']          = $txttgl;
        $data_retskb['thn']             = $thn;
        $data_retskb['periode1']        = $periode1;
        $data_retskb['periode2']        = NULL;
        $data_retskb['txtperiode1']     = $txtperiode;
        $data_retskb['txtperiode2']     = NULL;
        $data_retskb['pt']              = $this->input->post('hidden_nama_pt');
        $data_retskb['kode']            = $this->input->post('hidden_kode_pt');
        $data_retskb['devisi']          = $devisi;
        $data_retskb['kode_dev']        = $kode_dev;
        $data_retskb['no_ba']           = str_replace(' ', '', $no_ba);
        $data_retskb['keterangan']      = $this->input->post('keterangan');
        $data_retskb['bag']             = $this->input->post('bagian');
        $data_retskb['batal']           = "0";
        $data_retskb['alasan_batal']    = NULL;
        $data_retskb['id_user']         = $id_user;
        $data_retskb['user']            = $this->session->userdata('user');
        $data_retskb['cetak']           = "0";

        $data_retskbitem['noretur']         = $noretur;
        $data_retskbitem['norefretur']      = $norefretur;
        $data_retskbitem['kodebar']         = $kodebar;
        $data_retskbitem['kodebartxt']      = $this->input->post('hidden_kode_barang');
        $data_retskbitem['nabar']           = $nabar;
        $data_retskbitem['satuan']          = $sat;
        $data_retskbitem['grp']             = $grp;
        $data_retskbitem['kodept']          = $this->input->post('hidden_kode_pt');
        $data_retskbitem['pt']              = $this->input->post('hidden_nama_pt');
        $data_retskbitem['tmtbm']           = $this->input->post('cmb_tm_tbm');
        $data_retskbitem['afd']             = $this->input->post('cmb_afd_unit');
        $data_retskbitem['blok']            = $this->input->post('cmb_blok_sub');
        $data_retskbitem['thntanam']        = $this->input->post('cmb_tahun_tanam');
        $data_retskbitem['qty']             = $quantiti;
        $data_retskbitem['tgl']             = $tgl;
        $data_retskbitem['nobkb']           = $nobkb;
        $data_retskbitem['norefbkb']        = $norefbkb;
        $data_retskbitem['tglinput']        = date("Y-m-d H:i:s");
        $data_retskbitem['txttgl']          = $txttgl;
        $data_retskbitem['thn']             = $thn;
        $data_retskbitem['periode']         = $this->session->userdata('Ymd_periode');
        $data_retskbitem['txtperiode']      = $txtperiode;
        $data_retskbitem['ket']             = $this->input->post('txt_ket_rinci');
        $data_retskbitem['kodebeban']       = $this->input->post('hidden_kodebeban');
        $data_retskbitem['kodebebantxt']    = $this->input->post('hidden_kodebeban');
        $data_retskbitem['ketbeban']        = $this->input->post('txt_account_beban');
        $data_retskbitem['kodesub']         = $this->input->post('hidden_kodesub');
        $data_retskbitem['kodesubtxt']      = $this->input->post('hidden_kodesub');
        $data_retskbitem['ketsub']          = $this->input->post('txt_sub_beban');
        $data_retskbitem['batal']           = "0";
        $data_retskbitem['alasan_batal']    = NULL;
        $data_retskbitem['id_user']         = $id_user;
        $data_retskbitem['user']            = $this->session->userdata('user');


        //histori
        $data_retskb_histori['noretur']         = $noretur;
        $data_retskb_histori['norefretur']      = $norefretur;
        $data_retskb_histori['tgl']             = $tgl;
        $data_retskb_histori['nobkb']           = $nobkb;
        $data_retskb_histori['norefbkb']        = $norefbkb;
        $data_retskb_histori['tglinput']        = date("Y-m-d H:i:s");
        $data_retskb_histori['txttgl']          = $txttgl;
        $data_retskb_histori['thn']             = $thn;
        $data_retskb_histori['periode1']        = $periode1;
        $data_retskb_histori['periode2']        = NULL;
        $data_retskb_histori['txtperiode1']     = $txtperiode;
        $data_retskb_histori['txtperiode2']     = NULL;
        $data_retskb_histori['pt']              = $this->input->post('hidden_nama_pt');
        $data_retskb_histori['kode']            = $this->input->post('hidden_kode_pt');
        $data_retskb_histori['devisi']          = $devisi;
        $data_retskb_histori['kode_dev']        = $kode_dev;
        $data_retskb_histori['no_ba']           = str_replace(' ', '', $no_ba);
        $data_retskb_histori['keterangan']      = $this->input->post('keterangan');
        $data_retskb_histori['bag']             = $this->input->post('bagian');
        $data_retskb_histori['batal']           = "0";
        $data_retskb_histori['alasan_batal']    = NULL;
        $data_retskb_histori['id_user']         = $id_user;
        $data_retskb_histori['user']            = $this->session->userdata('user');
        $data_retskb_histori['cetak']           = "0";
        $data_retskb_histori['keterangan_transaksi']  = "INPUT RETUR";
        $data_retskb_histori['log']  =  $this->session->userdata('user') . " membuat RETUR baru $nobkb";
        $data_retskb_histori['tgl_transaksi']  = date("Y-m-d H:i:s");
        $data_retskb_histori['user_transaksi']  = $this->session->userdata('user');
        $data_retskb_histori['client_ip']  = $this->input->ip_address();
        $data_retskb_histori['client_platform']  = $this->platform->agent();


        $data_retskbitem_histori['noretur']         = $noretur;
        $data_retskbitem_histori['norefretur']      = $norefretur;
        $data_retskbitem_histori['kodebar']         = $kodebar;
        $data_retskbitem_histori['kodebartxt']      = $this->input->post('hidden_kode_barang');
        $data_retskbitem_histori['nabar']           = $nabar;
        $data_retskbitem_histori['satuan']          = $sat;
        $data_retskbitem_histori['grp']             = $grp;
        $data_retskbitem_histori['kodept']          = $this->input->post('hidden_kode_pt');
        $data_retskbitem_histori['pt']              = $this->input->post('hidden_nama_pt');
        $data_retskbitem_histori['tmtbm']           = $this->input->post('cmb_tm_tbm');
        $data_retskbitem_histori['afd']             = $this->input->post('cmb_afd_unit');
        $data_retskbitem_histori['blok']            = $this->input->post('cmb_blok_sub');
        $data_retskbitem_histori['thntanam']        = $this->input->post('cmb_tahun_tanam');
        $data_retskbitem_histori['qty']             = $quantiti;
        $data_retskbitem_histori['tgl']             = $tgl;
        $data_retskbitem_histori['nobkb']           = $nobkb;
        $data_retskbitem_histori['norefbkb']        = $norefbkb;
        $data_retskbitem_histori['tglinput']        = date("Y-m-d H:i:s");
        $data_retskbitem_histori['txttgl']          = $txttgl;
        $data_retskbitem_histori['thn']             = $thn;
        $data_retskbitem_histori['periode']         = $this->session->userdata('Ymd_periode');
        $data_retskbitem_histori['txtperiode']      = $txtperiode;
        $data_retskbitem_histori['ket']             = $this->input->post('txt_ket_rinci');
        $data_retskbitem_histori['kodebeban']       = $this->input->post('hidden_kodebeban');
        $data_retskbitem_histori['kodebebantxt']    = $this->input->post('hidden_kodebeban');
        $data_retskbitem_histori['ketbeban']        = $this->input->post('txt_account_beban');
        $data_retskbitem_histori['kodesub']         = $this->input->post('hidden_kodesub');
        $data_retskbitem_histori['kodesubtxt']      = $this->input->post('hidden_kodesub');
        $data_retskbitem_histori['ketsub']          = $this->input->post('txt_sub_beban');
        $data_retskbitem_histori['batal']           = "0";
        $data_retskbitem_histori['alasan_batal']    = NULL;
        $data_retskbitem_histori['id_user']         = $id_user;
        $data_retskbitem_histori['user']            = $this->session->userdata('user');
        $data_retskbitem_histori['keterangan_transaksi']  = "INPUT ITEM RETUR";
        $data_retskbitem_histori['log']  = $this->session->userdata('user') . " membuat RETUR baru $noretur";
        $data_retskbitem_histori['tgl_transaksi']  = date("Y-m-d H:i:s");
        $data_retskbitem_histori['user_transaksi']  = $this->session->userdata('user');
        $data_retskbitem_histori['client_ip']  = $this->input->ip_address();
        $data_retskbitem_histori['client_platform']  = $this->platform->agent();
        //end

        //-------------------------KEBUTUHAN SAVE KE LPB----------------------/
        $lokasibuatpo = substr($norefbkb, 0, 3);
        switch ($lokasibuatpo) {
            case 'PST': // HO
                $ref_1 = "PST-LPB-RET";
                $ref_2 = "BWJ";
                break;
            case 'ROM': // RO
                $ref_1 = "ROM-LPB-RET";
                $ref_2 = "PKY";
                break;
            case 'FAC': // PKS
                $ref_1 = "FAC-LPB-RET";
                $ref_2 = "SWJ";
                break;
            case 'EST': // SITE
                $ref_1 = "EST-LPB-RET";
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

        $kode_devisi    = $this->input->post('hidden_kode_dev');
        $digit1 = preg_replace("/[^1-9]/", "", $kode_devisi);

        $digit1_2 = $digit1 . $digit2;

        $hitung_digit1_2 = strlen($digit1_2);
        $query_masuk_item = "SELECT MAX(SUBSTRING(ttgtxt, $hitung_digit1_2+1)) as maxttg from masukitem WHERE ttg LIKE '$digit1_2%'";
        $generate_masuk_item = $this->db_logistik_pt->query($query_masuk_item)->row();
        $noUrut_masuk_item = (int)($generate_masuk_item->maxttg);
        $noUrut_masuk_item++;
        $print_masuk_item = sprintf("%05s", $noUrut_masuk_item);

        $ref_3 = date("m/y", strtotime($this->input->post('txt_tgl_retur')));

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

        $data_stokmasuk = [
            'tgl' => $tgl,
            'kd_dept' => '0',
            'ket_dept' => $this->input->post('bagian'),
            'nopo' => $noretur,
            'nopotxt' => $noretur,
            'LOKAL' => '0',
            'ASSET' => '0',
            'kode_supply' => '0',
            'nama_supply' => '-',
            'ttg' => $no_lpb,
            'ttgtxt' => $no_lpb,
            'no_pengtr' => '-',
            'lokasi_gudang' => '-',
            'ket' => $this->input->post('keterangan'),
            'tglinput' => date("Y-m-d H:i:s"),
            'txttgl' => $txttgl,
            'thn' => $thn,
            'periode1' => $periode1,
            'periode2' => NULL,
            'txtperiode1' => $txtperiode,
            'txtperiode2' => NULL,
            'pt' => $this->session->userdata('pt'),
            'kode' => $this->session->userdata('kode_pt'),
            'devisi' => $devisi,
            'kode_dev' => $kode_dev,
            'jenis_lpb' => '2', //2 itu lpb retur
            'lokasi' => $this->session->userdata('status_lokasi'),
            'tglppo' => '-',
            'norefppo' => '-',
            'tglpo' => $this->input->post('hidden_tgl_bkb'),
            'refpo' => $norefretur,
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
            'nopo' => $noretur,
            'nopotxt' => $noretur,
            'LOKAL' => '0',
            'ASSET' => '0',
            'pt' => $this->session->userdata('pt'),
            'devisi' => $devisi,
            'kode_dev' => $kode_dev,
            'afd' => '-',
            'kodebar' => $this->input->post('hidden_kode_barang'),
            'kodebartxt' => $this->input->post('hidden_kode_barang'),
            'nabar' => $nabar,
            'satuan' => $sat,
            'grp' => $grp,
            'qtypo' => $this->input->post('txt_qty_bkb'),
            'qty' => $quantiti,
            'tgl' => $tgl,
            'tglpo' => $this->input->post('hidden_tgl_bkb'),
            'ttg' => $no_lpb,
            'ttgtxt' => $no_lpb,
            'tglinput' => date("Y-m-d H:i:s"),
            'txttgl' => $txttgl,
            'thn' => $thn,
            'periode' => $periode1,
            'txtperiode' => $txtperiode,
            'noadjust' => '0',
            'ket' => $this->input->post('txt_ket_rinci'),
            'lokasi' => $this->session->userdata('status_lokasi'),
            'norefppo' => '0',
            'refpo' => $norefretur,
            'noref' => $no_ref_lpb,
            'BATAL' => '0',
            'alasan_batal' => '0',
            'kurs' => 'Rp',
            'konversi' => '0',
            'id_user' => $id_user,
            'USER' => $this->session->userdata('user'),
            'cetak' => '0',
            'posting' => '0',
            'qtyditerima' => '0',
        ];


        //-------------------------END KEBUTUHAN SAVE KE LPB----------------------/

        $harga_item_bkb = $this->M_retur->cari_harga_bkb($norefbkb, $kodebar);

        $data_register_stok = [
            'kodebar' => $kodebar,
            'kodebartxt' => $kodebar,
            'namabar' => $nabar,
            'grup' => $grp,
            'tgl' => $periode1,
            'tgltxt' => date("Ymd", strtotime($periode1)),
            'potxt' => '-',
            'ttgtxt' => $noretur,
            'skbtxt' => '-',
            'adjttgtxt' => '-',
            'adjskbtxt' => '-',
            'retttgtxt' => '-',
            'retskbtxt' => '-',
            'no_slrh' => $noretur,
            'ket' => $this->input->post('txt_ket_rinci'),
            'harga' => $harga_item_bkb,
            'qty' => $quantiti,
            'masuk_qty' => $quantiti,
            'keluar_qty' => '0',
            'status' => 'LPB',
            'kodept' => $this->session->userdata('kode_pt'),
            'namapt' => $this->session->userdata('pt'),
            'devisi' => $devisi,
            'kode_dev' => $kode_dev,
            'txtperiode' => $txtperiode,
            'lokasi' => $this->session->userdata('status_lokasi'),
            'refpo' => '-',
            'noref' => $norefretur,
            'id_user' => $id_user,
            'USER' => $this->session->userdata('user'),
        ];


        $cari_kodebar_stock_awal = $this->M_retur->cari_kodebar($kodebar, $txtperiode);

        if (empty($this->input->post('hidden_noretur'))) {
            $savedataretskb = $this->M_retur->savedataretskb($data_retskb);
            $savedataretskbitem = $this->M_retur->savedataretskbitem($data_retskbitem);
            $savedatastokmasuk = $this->M_retur->savedatastokmasuk($data_stokmasuk);
            $savedatamasukitem = $this->M_retur->savedatamasukitem($data_masukitem);
            $saveregisterstok = $this->M_retur->saveRegisterStok($data_register_stok);

            $savehistoriretskb = $this->M_retur->savehistoriretskb($data_retskb_histori);
            $savehistoriretskbitem = $this->M_retur->savehistoriretskbitem($data_retskbitem_histori);
            $item_exist = 0;

            // insert to GL
            $result_insert_to_gl_header = $this->insert_lpb_to_header_entry_gl($noretur, $kode_dev, $norefretur);
            $result_insert_lpb_to_entry_gl_dr = $this->insert_lpb_to_entry_gl_dr($noretur, $harga_item_bkb, $quantiti, $kode_dev, $kodebar, $norefretur, $nabar, $norefbkb);
            $result_insert_lpb_to_entry_gl_cr = $this->insert_lpb_to_entry_gl_cr($noretur, $harga_item_bkb, $quantiti, $kode_dev, $kodebar, $norefretur, $nabar, $norefbkb, $data_retskbitem['kodesub'], $data_retskbitem['ketsub']);
        } else {
            //cek item jika sudah ada tidak bisa save
            $cek_barang_exist = $this->M_retur->cek_barang_exist($kodebar, $norefretur);
            if ($cek_barang_exist >= 1) {
                $item_exist = 1;
                $savedataretskb = NULL;
                $savedataretskbitem = NULL;
                $savedatastokmasuk = NULL;
                $savedatamasukitem = NULL;
                $result_insert_to_gl_header = NULL;
                $result_insert_lpb_to_entry_gl_dr = NULL;
                $result_insert_lpb_to_entry_gl_cr = NULL;
            } else {
                $item_exist = 0;
                $savedataretskb = NULL;
                $savedatastokmasuk = NULL;
                $savedataretskbitem = $this->M_retur->savedataretskbitem($data_retskbitem);
                $savedatamasukitem = $this->M_retur->savedatamasukitem($data_masukitem);
                $saveregisterstok = $this->M_retur->saveRegisterStok($data_register_stok);

                $savehistoriretskbitem = $this->M_retur->savehistoriretskbitem($data_retskbitem_histori);


                // insert to GL
                $result_insert_to_gl_header = NULL;
                $result_insert_lpb_to_entry_gl_dr = $this->insert_lpb_to_entry_gl_dr($noretur, $harga_item_bkb, $quantiti, $kode_dev, $kodebar, $norefretur, $nabar, $norefbkb);
                $result_insert_lpb_to_entry_gl_cr = $this->insert_lpb_to_entry_gl_cr($noretur, $harga_item_bkb, $quantiti, $kode_dev, $kodebar, $norefretur, $nabar, $norefbkb, $data_retskbitem['kodesub'], $data_retskbitem['ketsub']);
            }
        }

        // jika item sudah ada maka tidak mejalankan script didalam
        if ($item_exist == 1) {
            $result_insert_stok_awal_harian = NULL;
            $result_insert_stok_awal_bulanan = NULL;
            $result_update_stok_awal = NULL;
        } else {

            //insert stock awal
            if ($cari_kodebar_stock_awal == 0) {

                $this->insert_stokawal($kodebar, $data_masukitem['nabar'], $data_masukitem['satuan'], $data_masukitem['grp'], $norefbkb, $quantiti);
            }

            //insert stock awal harian sama seperti LPB
            $result_insert_stok_awal_harian = $this->insert_stok_awal_harian($kodebar, $nabar, $sat, $grp, $norefbkb, $quantiti, $devisi, $kode_dev);

            // insert stock awal bulanan sama seperli LPB
            $result_insert_stok_awal_bulanan = $this->insert_stok_awal_bulanan_devisi($kodebar, $nabar, $sat, $grp, $quantiti, $devisi, $kode_dev);

            // update stock awal sama seperli di LPB
            $result_update_stok_awal = $this->update_stok_awal($kodebar, $txtperiode);
        }

        $query_id = "SELECT MAX(id) as id_retskb FROM retskb WHERE id_user = '$id_user' AND norefretur = '$norefretur' ";
        $generate_id = $this->db_logistik_pt->query($query_id)->row();
        $id_retskb = $generate_id->id_retskb;

        $query_id = "SELECT MAX(id) as id_retskbitem FROM ret_skbitem WHERE id_user = '$id_user' AND norefretur = '$norefretur' ";
        $generate_id = $this->db_logistik_pt->query($query_id)->row();
        $id_retskbitem = $generate_id->id_retskbitem;

        $query_id = "SELECT MAX(id) as id_stokmasuk FROM stokmasuk WHERE id_user = '$id_user' AND noref = '$no_ref_lpb' ";
        $generate_id = $this->db_logistik_pt->query($query_id)->row();
        $id_stokmasuk = $generate_id->id_stokmasuk;

        $query_id = "SELECT MAX(id) as id_masukitem FROM masukitem WHERE id_user = '$id_user' AND noref = '$no_ref_lpb' ";
        $generate_id = $this->db_logistik_pt->query($query_id)->row();
        $id_masukitem = $generate_id->id_masukitem;

        $query_id = "SELECT MAX(id) as id_register_stok FROM register_stok WHERE id_user = '$id_user' AND noref = '$norefretur' ";
        $generate_id = $this->db_logistik_pt->query($query_id)->row();
        $id_register_stok = $generate_id->id_register_stok;

        $data = [
            'insert_stok_awal_harian' => $result_insert_stok_awal_harian,
            'insert_stok_awal_bulanan' => $result_insert_stok_awal_bulanan,
            'update_stok_awal' => $result_update_stok_awal,
            'dataretskb' => $savedataretskb,
            'dataretskbitem' => $savedataretskbitem,
            'datastokmasuk' => $savedatastokmasuk,
            'datamasukitem' => $savedatamasukitem,
            'saveregisterstok' => $saveregisterstok,
            'result_insert_to_gl_header' => $result_insert_to_gl_header,
            'result_insert_lpb_to_entry_gl_dr' => $result_insert_lpb_to_entry_gl_dr,
            'result_insert_lpb_to_entry_gl_cr' => $result_insert_lpb_to_entry_gl_cr,
            'no_retur' => $noretur,
            'noref_retur' => $norefretur,
            'no_lpb' => $no_lpb,
            'noref_lpb' => $no_ref_lpb,
            'id_retskb' => $id_retskb,
            'id_stokmasuk' => $id_stokmasuk,
            'id_masukitem' => $id_masukitem,
            'id_retskbitem' => $id_retskbitem,
            'id_register_stok' => $id_register_stok,
            'txtperiode' => $txtperiode,
            'item_exist' => $item_exist
        ];

        echo json_encode($data);
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

        return $this->M_retur_gl->insert_lpb_to_header_entry_gl($header_entry);
    }

    function insert_lpb_to_entry_gl_dr($no_lpb, $harga_item_po, $quantiti, $kode_dev, $kodebar, $no_ref_lpb, $nabar, $no_ref_po)
    {
        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');
        $status_lokasi = $this->session->userdata('status_lokasi');
        $user = $this->session->userdata('user');

        $totharga = $harga_item_po * $quantiti;

        $data_noac_gl = $this->M_retur_gl->get_data_noac_gl($kodebar);

        $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';

        //var untuk save ke entry
        $entry["date"] = date("Y-m-d");
        $entry["sbu"] = $kode_dev;
        $entry["noac"] = $kodebar;
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
            return $this->M_retur_gl->insert_lpb_to_entry_gl_dr($entry, $entry["noref"]);
        } else {
            return 0;
        }
    }

    function insert_lpb_to_entry_gl_cr($no_lpb, $harga_item_po, $quantiti, $kode_dev, $kodebar, $no_ref_lpb, $nabar, $no_ref_po, $kodesub, $ketsub)
    {
        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');
        $status_lokasi = $this->session->userdata('status_lokasi');
        $user = $this->session->userdata('user');

        $totharga = $harga_item_po * $quantiti;

        $data_noac_gl = $this->M_retur_gl->get_data_noac_beban($kodesub);

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
        $entry["descac"] = $ketsub;
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
            return $this->M_retur_gl->insert_lpb_to_entry_gl_cr($entry, $entry["noref"]);
        } else {
            return 0;
        }
    }

    function insert_stokawal($kodebar, $nabar, $satuan, $grp, $no_ref_bkb, $qty)
    {
        $harga_item_bkb = $this->M_retur->cari_harga_bkb($no_ref_bkb, $kodebar);
        $saldoakhir_nilai = $harga_item_bkb * $qty;

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

    function insert_stok_awal_harian($kodebar, $nabar, $sat, $grp, $no_ref_bkb, $qty, $devisi, $kode_dev)
    {

        $harga_item_bkb = $this->M_retur->cari_harga_bkb($no_ref_bkb, $kodebar);
        $saldoakhir_nilai = $harga_item_bkb * $qty;

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

        $cek_stokawal_harian = $this->M_retur->cek_stokawal_harian($kodebar, $data_insert_stok_harian['periode'], $kode_dev);

        if ($cek_stokawal_harian >= 1) {
            //update stok awal harian
            return $this->M_retur->updateStokAwalHarian($kodebar, $data_insert_stok_harian['periode'], $data_insert_stok_harian['txtperiode'], $qty, $harga_item_bkb, $kode_dev);
        } else {
            //insert stok awal harian
            return $this->M_retur->saveStokAwalHarian($data_insert_stok_harian);
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

        $cek_stokawal_bulanan_devisi = $this->M_retur->cek_stok_awal_bulanan_devisi($kodebar, $data_insert_stok_bulanan['txtperiode'], $kode_dev);

        if ($cek_stokawal_bulanan_devisi >= 1) {
            //update stok awal bulanan devisi
            return $this->M_retur->updateStokAwalBulananDevisi($kodebar, $data_insert_stok_bulanan['txtperiode'], $qty, $kode_dev);
        } else {
            //insert stok awal bulanan devisi
            return $this->M_retur->saveStokAwalBulananDevisi($data_insert_stok_bulanan);
        }
    }

    function update_stok_awal($kodebar, $txtperiode)
    {
        //saldoakhir_nilai
        $sum_harga_kodebar = $this->M_retur->sum_harga_kodebar_harian($kodebar, $txtperiode);

        //saldo akhir qty
        $sum_saldo_qty_kodebar = $this->M_retur->sum_saldo_qty_kodebar_harian($kodebar, $txtperiode);

        //nilai_masuk
        $sum_nilai_masuk = $this->M_retur->sum_nilai_masuk_harian($kodebar, $txtperiode);

        //qty masuk
        $sum_qty_kodebar = $this->M_retur->sum_qty_kodebar_harian($kodebar, $txtperiode);

        $data_update = [
            'saldoakhir_nilai' => $sum_harga_kodebar,

            'saldoakhir_qty' => $sum_saldo_qty_kodebar,

            'nilai_masuk' => $sum_nilai_masuk->nilai_masuk_harian,

            'QTY_MASUK' => $sum_qty_kodebar->qty_harian
        ];

        return $this->M_retur->updateStokAwal($data_update, $kodebar, $txtperiode);
    }

    public function updateRetur()
    {
        $id_masukitem = $this->input->post('hidden_id_masukitem');
        $id_retskbitem = $this->input->post('hidden_id_retskbitem');
        $id_register_stok = $this->input->post('hidden_id_register_stok');
        $txtperiode = $this->input->post('hidden_txtperiode');
        $kode_dev = $this->input->post('hidden_kode_dev');
        $no_ref_bkb = $this->input->post('hidden_norefbkb');
        $edit = $this->input->post('edit');
        $norefretur = $this->input->post('hidden_norefretur');

        $skb_item = $this->db_logistik_pt->query("SELECT * FROM ret_skbitem WHERE id='$id_retskbitem'")->row();

        $data_retskbitem_histori['noretur']         = $skb_item->noretur;
        $data_retskbitem_histori['norefretur']      = $skb_item->norefretur;
        $data_retskbitem_histori['kodebar']         = $this->input->post('hidden_kode_barang');
        $data_retskbitem_histori['kodebartxt']      = $this->input->post('hidden_kode_barang');
        $data_retskbitem_histori['nabar']           = $this->input->post('txt_barang');
        $data_retskbitem_histori['satuan']          = $this->input->post('hidden_satuan_brg');
        $data_retskbitem_histori['grp']             = $this->input->post('hidden_grup_barang');
        $data_retskbitem_histori['kodept']          = $skb_item->kodept;
        $data_retskbitem_histori['pt']              = $skb_item->pt;
        $data_retskbitem_histori['tmtbm']           = $this->input->post('cmb_tm_tbm');
        $data_retskbitem_histori['afd']             = $this->input->post('cmb_afd_unit');
        $data_retskbitem_histori['blok']            = $this->input->post('cmb_blok_sub');
        $data_retskbitem_histori['thntanam']        = $this->input->post('cmb_tahun_tanam');
        $data_retskbitem_histori['qty']             = $this->input->post('txt_qty_retur');
        $data_retskbitem_histori['tgl']             = $skb_item->tgl;
        $data_retskbitem_histori['nobkb']           = $skb_item->nobkb;
        $data_retskbitem_histori['norefbkb']        = $skb_item->norefbkb;
        $data_retskbitem_histori['tglinput']        = $skb_item->tglinput;
        $data_retskbitem_histori['txttgl']          = $skb_item->txttgl;
        $data_retskbitem_histori['thn']             = $skb_item->thn;
        $data_retskbitem_histori['periode']         = $this->session->userdata('Ymd_periode');
        $data_retskbitem_histori['txtperiode']      = $skb_item->txtperiode;
        $data_retskbitem_histori['ket']             = $this->input->post('txt_ket_rinci');
        $data_retskbitem_histori['kodebeban']       = $this->input->post('hidden_kodebeban');
        $data_retskbitem_histori['kodebebantxt']    = $this->input->post('hidden_kodebeban');
        $data_retskbitem_histori['ketbeban']        = $this->input->post('txt_account_beban');
        $data_retskbitem_histori['kodesub']         = $this->input->post('hidden_kodesub');
        $data_retskbitem_histori['kodesubtxt']      = $this->input->post('hidden_kodesub');
        $data_retskbitem_histori['ketsub']          = $this->input->post('txt_sub_beban');
        $data_retskbitem_histori['batal']           = "0";
        $data_retskbitem_histori['alasan_batal']    = NULL;
        $data_retskbitem_histori['id_user']         = $skb_item->id_user;
        $data_retskbitem_histori['user']            = $this->session->userdata('user');
        $data_retskbitem_histori['keterangan_transaksi']  = "UPDATE ITEM RETUR";
        $data_retskbitem_histori['log']  = $this->session->userdata('user') . " mengubah ITEM RETUR $skb_item->noretur";
        $data_retskbitem_histori['tgl_transaksi']  = date("Y-m-d H:i:s");
        $data_retskbitem_histori['user_transaksi']  = $this->session->userdata('user');
        $data_retskbitem_histori['client_ip']  = $this->input->ip_address();
        $data_retskbitem_histori['client_platform']  = $this->platform->agent();
        $savehistoriretskbitem = $this->M_retur->savehistoriretskbitem($data_retskbitem_histori);

        $data_masukitem = [
            'qty' => $this->input->post('txt_qty_retur'),
            'ket' => $this->input->post('txt_ket_rinci'),
        ];

        $data_register_stok = [
            'qty' => $this->input->post('txt_qty_retur'),
            'masuk_qty' => $this->input->post('txt_qty_retur'),
            'ket' => $this->input->post('txt_ket_rinci'),
        ];

        $data_item_retur = [
            'kodebar' => $this->input->post('hidden_kode_barang'),
            'kodebartxt' => $this->input->post('hidden_kode_barang'),
            'nabar' => $this->input->post('txt_barang'),
            'grp' => $this->input->post('hidden_grup_barang'),
            'satuan' => $this->input->post('hidden_satuan_brg'),
            'tmtbm' => $this->input->post('cmb_tm_tbm'),
            'blok' => $this->input->post('cmb_blok_sub'),
            'afd' => $this->input->post('cmb_afd_unit'),
            'thntanam' => $this->input->post('cmb_tahun_tanam'),
            'kodebeban' => $this->input->post('hidden_kodebeban'),
            'kodebebantxt' => $this->input->post('hidden_kodebeban'),
            'ketbeban' => $this->input->post('txt_account_beban'),
            'kodesub' => $this->input->post('hidden_kodesub'),
            'kodesubtxt' => $this->input->post('hidden_kodesub'),
            'ketsub' => $this->input->post('txt_sub_beban'),
            'qty' => $this->input->post('txt_qty_retur'),
            'ket' => $this->input->post('txt_ket_rinci'),
        ];

        //cari harga
        $harga_item_bkb = $this->M_retur->cari_harga_bkb($no_ref_bkb, $data_item_retur['kodebar']);

        //cari periode di masukitem
        $periode = $this->M_retur->cari_periode_barang($id_retskbitem);

        //update stok awal harian
        if ($periode['qty'] != $data_item_retur['qty']) {
            $data_editStokAwalHarian = $this->M_retur->editStokAwalHarian($data_item_retur['kodebar'], $periode['periode'], $periode['qty'], $data_item_retur['qty'], $harga_item_bkb, $kode_dev);
            $data_editStokAwalBulananDevisi = $this->M_retur->editStokAwalBulananDevisi($data_item_retur['kodebar'], $periode['txtperiode'], $periode['qty'], $data_item_retur['qty'], $kode_dev);
            $data_edit_gl = $this->M_retur_gl->edit_gl($data_item_retur['kodebar'], $harga_item_bkb, $data_item_retur['qty'], $norefretur);
        } else {
            $data_editStokAwalHarian = 'no edit';
            $data_editStokAwalBulananDevisi = 'no edit';
            $data_edit_gl = 'no edit';
        }

        //update stok awal
        $update_stockawal = $this->update_stok_awal($data_item_retur['kodebar'], $txtperiode);

        $result_update = $this->M_retur->update_retur($id_retskbitem, $data_item_retur);

        if ($edit == '1') {
            $result_update_masukitem = $this->M_retur->update_masukitem_edit($norefretur, $data_item_retur['kodebar'], $data_masukitem);
            $result_update_register_stok = $this->M_retur->update_register_stok_edit($norefretur, $data_item_retur['kodebar'], $data_register_stok);
        } else {
            $result_update_masukitem = $this->M_retur->update_masukitem($id_masukitem, $data_masukitem);
            $result_update_register_stok = $this->M_retur->update_register_stok($id_register_stok, $data_register_stok);
        }

        $output = [
            'update' => $result_update,
            'update_masukitem' => $result_update_masukitem,
            'update_register_stok' => $result_update_register_stok,
            'editStokAwalHarian' => $data_editStokAwalHarian,
            'editStokAwalBulananDevisi' => $data_editStokAwalBulananDevisi,
            'edit_gl' => $data_edit_gl,
            'update_stockawal' => $update_stockawal
        ];

        echo json_encode($output);
    }

    public function cancelUpdateRetur()
    {
        $id_retskbitem = $this->input->post('hidden_id_retskbitem');

        $output = $this->db_logistik_pt->get_where('ret_skbitem', ['id' => $id_retskbitem])->row_array();

        echo json_encode($output);
    }

    function cetak()
    {
        $noretur = $this->uri->segment('3');
        $id = $this->uri->segment('4');

        // $data['no_lpb'] = $no_lpb;
        // $data['id'] = $id;
        $data['retskb'] = $this->db_logistik_pt->get_where('retskb', array('id' => $id, 'noretur' => $noretur))->row();
        $data['ret_skbitem'] = $this->db_logistik_pt->get_where('ret_skbitem', array('noretur' => $noretur, 'norefretur' => $data['retskb']->norefretur))->result();
        $norefretur = $data['retskb']->norefretur;

        $data['urut'] = $this->M_retur->urut_cetak($norefretur);

        $this->qrcode($noretur, $id, $norefretur);

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

        if ($data['retskb']->batal == 1) {
            # code...
            $mpdf->SetWatermarkImage(
                '././assets/img/batal.png',
                0.3,
                '',
                array(25, 5)
            );
            $mpdf->showWatermarkImage = true;
        }
        // $lokasibuatlpb = substr($noref, 0, 3);
        // switch ($lokasibuatlpb) {
        //     case 'LPB': // HO
        //         $data['lokasilpb'] = "HO";
        //         break;
        //     case 'ROM': // RO
        //         $data['lokasilpb'] = "RO";
        //         break;
        //     case 'FAC': // PKS
        //         $data['lokasilpb'] = "PKS";
        //         break;
        //     case 'EST': // SITE
        //         $data['lokasilpb'] = "SITE";
        //         break;
        //     default:
        //         break;
        // }

        // $mpdf->SetHTMLHeader('<h4>PT MULIA SAWIT AGRO LESTARI</h4>');
        // $mpdf->SetHTMLHeader('
        //                     <table width="100%" border="0" align="center">
        //                         <tr>
        //                             <td rowspan="5" align="center" style="font-size:14px;font-weight:bold;">' . $data['retskb']->devisi . '</td>
        //                         </tr>
        //                         <!--tr>
        //                             <td align="center" rowspan="5">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
        //                             </td>
        //                         </tr-->
        //                     </table>
        //                     <hr style="width:100%;margin-top:7px;">
        //                     ');
        // $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');

        $html = $this->load->view('v_returPrint', $data, true);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function qrcode($no_retur, $id, $norefretur)
    {
        $this->load->library('Ciqrcode');
        // header("Content-Type: image/png");

        $config['cacheable']    = false; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/retur_bkb/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $id . '_' . $no_retur . '.png'; //buat name dari qr code

        // $params['data'] = site_url('lpb/cetak/'.$no_lpb.'/'.$id); //data yang akan di jadikan QR CODE
        $params['data'] = $norefretur; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
    }

    //Start Data Table Server Side
    function get_data_bkbitem()
    {
        // mengambil periode bulan ini
        $txtperiode = $this->session->userdata('ym_periode');

        $norefbkb = $this->input->post('norefbkb');
        $this->M_cari_bkbitem->getWhere($norefbkb);
        $list = $this->M_cari_bkbitem->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<button class="btn btn-success btn-xs" id="data_barang" name="data_barang"
                    data-nabar="' . $field->nabar . '" data-kodebar="' . $field->kodebar . '" 
                    data-satuan="' . $field->satuan . '" data-grp="' . $field->grp . '"
                    data-qty2="' . $field->qty2 . '" data-afd="' . $field->afd . '"
                    data-blok="' . $field->blok . '" data-kodebeban="' . $field->kodebeban . '"
                    data-kodesub="' . $field->kodesub . '" data-kode_dev="' . $field->kode_dev . '"
                    data-ketsub="' . $field->ketsub . '" data-txtperiode="' . $txtperiode . '" 
                    data-ketbeban="' . $field->ketbeban . '" data-no_ref="' . $field->NO_REF . '"
                    data-tmtbm="' . $field->tmtbm . '" data-thntanam="' . $field->thntanam . '"
                    data-toggle="tooltip" data-placement="top" title="Pilih" onClick="return false">
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
            "recordsTotal" => $this->M_cari_bkbitem->count_all(),
            "recordsFiltered" => $this->M_cari_bkbitem->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    //End Start Data Table Server Side

    public function get_qty_retur()
    {
        $no_ref = $this->input->post('no_ref');
        $kodebar = $this->input->post('kodebar');

        $output = $this->M_retur->get_qty_retur($no_ref, $kodebar);

        echo json_encode($output);
    }

    public function batalItemRetur()
    {
        $id_retskbitem = $this->input->post('hidden_id_retskbitem');
        $id_masukitem = $this->input->post('hidden_id_masukitem');
        $id_register_stok = $this->input->post('hidden_id_register_stok');
        $kodebar = $this->input->post('kodebar');
        $norefretur = $this->input->post('hidden_norefretur');
        $delete_item_retur = $this->input->post('delete_item_retur');
        $alasan = $this->input->post('alasan');

        $skb_item = $this->db_logistik_pt->query("SELECT * FROM ret_skbitem WHERE id='$id_retskbitem'")->row();
        $data_retskbitem_histori['noretur']         = $skb_item->noretur;
        $data_retskbitem_histori['norefretur']      = $skb_item->norefretur;
        $data_retskbitem_histori['kodebar']         = $skb_item->kodebar;
        $data_retskbitem_histori['kodebartxt']      = $skb_item->kodebartxt;
        $data_retskbitem_histori['nabar']           = $skb_item->nabar;
        $data_retskbitem_histori['satuan']          = $skb_item->satuan;
        $data_retskbitem_histori['grp']             = $skb_item->grp;
        $data_retskbitem_histori['kodept']          = $skb_item->kodept;
        $data_retskbitem_histori['pt']              = $skb_item->pt;
        $data_retskbitem_histori['tmtbm']           = $skb_item->tmtbm;
        $data_retskbitem_histori['afd']             = $skb_item->afd;
        $data_retskbitem_histori['blok']            = $skb_item->blok;
        $data_retskbitem_histori['thntanam']        = $skb_item->thntanam;
        $data_retskbitem_histori['qty']             = $skb_item->qty;
        $data_retskbitem_histori['tgl']             = $skb_item->tgl;
        $data_retskbitem_histori['nobkb']           = $skb_item->nobkb;
        $data_retskbitem_histori['norefbkb']        = $skb_item->norefbkb;
        $data_retskbitem_histori['tglinput']        = $skb_item->tglinput;
        $data_retskbitem_histori['txttgl']          = $skb_item->txttgl;
        $data_retskbitem_histori['thn']             = $skb_item->thn;
        $data_retskbitem_histori['periode']         = $skb_item->periode;
        $data_retskbitem_histori['txtperiode']      = $skb_item->txtperiode;
        $data_retskbitem_histori['ket']             = $skb_item->ket;
        $data_retskbitem_histori['kodebeban']       = $skb_item->kodebeban;
        $data_retskbitem_histori['kodebebantxt']    = $skb_item->kodebebantxt;
        $data_retskbitem_histori['ketbeban']        = $skb_item->ketbeban;
        $data_retskbitem_histori['kodesub']         = $skb_item->kodesub;
        $data_retskbitem_histori['kodesubtxt']      = $skb_item->kodesubtxt;
        $data_retskbitem_histori['ketsub']          = $skb_item->ketsub;
        $data_retskbitem_histori['batal']           = "0";
        $data_retskbitem_histori['alasan_batal']    = NULL;
        $data_retskbitem_histori['id_user']         = $skb_item->id_user;
        $data_retskbitem_histori['user']            = $this->session->userdata('user');
        $data_retskbitem_histori['keterangan_transaksi']  = "BATAL ITEM RETUR";
        $data_retskbitem_histori['log']  = $this->session->userdata('user') . " membatalkan RETUR $skb_item->noretur";
        $data_retskbitem_histori['tgl_transaksi']  = date("Y-m-d H:i:s");
        $data_retskbitem_histori['user_transaksi']  = $this->session->userdata('user');
        $data_retskbitem_histori['client_ip']  = $this->input->ip_address();
        $data_retskbitem_histori['client_platform']  = $this->platform->agent();
        $savehistoriretskbitem = $this->M_retur->savehistoriretskbitem($data_retskbitem_histori);

        $isi_batal = array('batal' => 1, 'alasan_batal' => $alasan);
        // $data = $this->db_logistik_pt->delete('ret_skbitem', array('id' => $id_retskbitem));
        $data = $this->M_retur->updateBatalitem($id_retskbitem, $isi_batal);

        if ($delete_item_retur == '1') {
            $data1 = $this->db_logistik_pt->delete('masukitem', array('kodebar' => $kodebar, 'refpo' => $norefretur));
            $data2 = $this->db_logistik_pt->delete('register_stok', array('kodebar' => $kodebar, 'noref' => $norefretur));
        } else {
            $data1 = $this->db_logistik_pt->delete('masukitem', array('id' => $id_masukitem));
            $data2 = $this->db_logistik_pt->delete('register_stok', array('id' => $id_register_stok));
        }

        $output = [
            'data' => $data,
            'data1' => $data1,
            'data2' => $data2,
        ];

        echo json_encode($output);
    }
    public function deleteItemRetur()
    {
        $id_retskbitem = $this->input->post('hidden_id_retskbitem');
        $id_masukitem = $this->input->post('hidden_id_masukitem');
        $id_register_stok = $this->input->post('hidden_id_register_stok');
        $kodebar = $this->input->post('kodebar');
        $norefretur = $this->input->post('hidden_norefretur');
        $delete_item_retur = $this->input->post('delete_item_retur');

        $skb_item = $this->db_logistik_pt->query("SELECT * FROM ret_skbitem WHERE id='$id_retskbitem'")->row();
        $data_retskbitem_histori['noretur']         = $skb_item->noretur;
        $data_retskbitem_histori['norefretur']      = $skb_item->norefretur;
        $data_retskbitem_histori['kodebar']         = $skb_item->kodebar;
        $data_retskbitem_histori['kodebartxt']      = $skb_item->kodebartxt;
        $data_retskbitem_histori['nabar']           = $skb_item->nabar;
        $data_retskbitem_histori['satuan']          = $skb_item->satuan;
        $data_retskbitem_histori['grp']             = $skb_item->grp;
        $data_retskbitem_histori['kodept']          = $skb_item->kodept;
        $data_retskbitem_histori['pt']              = $skb_item->pt;
        $data_retskbitem_histori['tmtbm']           = $skb_item->tmtbm;
        $data_retskbitem_histori['afd']             = $skb_item->afd;
        $data_retskbitem_histori['blok']            = $skb_item->blok;
        $data_retskbitem_histori['thntanam']        = $skb_item->thntanam;
        $data_retskbitem_histori['qty']             = $skb_item->qty;
        $data_retskbitem_histori['tgl']             = $skb_item->tgl;
        $data_retskbitem_histori['nobkb']           = $skb_item->nobkb;
        $data_retskbitem_histori['norefbkb']        = $skb_item->norefbkb;
        $data_retskbitem_histori['tglinput']        = $skb_item->tglinput;
        $data_retskbitem_histori['txttgl']          = $skb_item->txttgl;
        $data_retskbitem_histori['thn']             = $skb_item->thn;
        $data_retskbitem_histori['periode']         = $skb_item->periode;
        $data_retskbitem_histori['txtperiode']      = $skb_item->txtperiode;
        $data_retskbitem_histori['ket']             = $skb_item->ket;
        $data_retskbitem_histori['kodebeban']       = $skb_item->kodebeban;
        $data_retskbitem_histori['kodebebantxt']    = $skb_item->kodebebantxt;
        $data_retskbitem_histori['ketbeban']        = $skb_item->ketbeban;
        $data_retskbitem_histori['kodesub']         = $skb_item->kodesub;
        $data_retskbitem_histori['kodesubtxt']      = $skb_item->kodesubtxt;
        $data_retskbitem_histori['ketsub']          = $skb_item->ketsub;
        $data_retskbitem_histori['batal']           = "0";
        $data_retskbitem_histori['alasan_batal']    = NULL;
        $data_retskbitem_histori['id_user']         = $skb_item->id_user;
        $data_retskbitem_histori['user']            = $this->session->userdata('user');
        $data_retskbitem_histori['keterangan_transaksi']  = "DELETE ITEM RETUR";
        $data_retskbitem_histori['log']  = $this->session->userdata('user') . " menghapus ITEM RETUR $skb_item->noretur";
        $data_retskbitem_histori['tgl_transaksi']  = date("Y-m-d H:i:s");
        $data_retskbitem_histori['user_transaksi']  = $this->session->userdata('user');
        $data_retskbitem_histori['client_ip']  = $this->input->ip_address();
        $data_retskbitem_histori['client_platform']  = $this->platform->agent();
        $savehistoriretskbitem = $this->M_retur->savehistoriretskbitem($data_retskbitem_histori);

        $ret_skbitem = $this->db_logistik_pt->delete('ret_skbitem', array('id' => $id_retskbitem));

        if ($delete_item_retur == '1') {
            $masukitem = $this->db_logistik_pt->delete('masukitem', array('kodebar' => $kodebar, 'refpo' => $norefretur));
            $register_stok = $this->db_logistik_pt->delete('register_stok', array('kodebar' => $kodebar, 'noref' => $norefretur));
        } else {
            $masukitem = $this->db_logistik_pt->delete('masukitem', array('id' => $id_masukitem));
            $register_stok = $this->db_logistik_pt->delete('register_stok', array('id' => $id_register_stok));
        }

        //delete ke GL
        $delete_gl = $this->db_mips_gl->delete('entry', array('kodebar' => $kodebar, 'noref' => $norefretur));

        $output = [
            'ret_skbitem' => $ret_skbitem,
            'masukitem' => $masukitem,
            'register_stok' => $register_stok,
            'delete_gl' => $delete_gl
        ];

        echo json_encode($output);
    }

    public function cekReturItem()
    {
        $norefretur = $this->input->post('norefretur');

        $data = $this->M_retur->cekReturItem($norefretur);

        echo json_encode($data);
    }

    public function cekDataRetur()
    {
        $norefretur = $this->input->post('norefretur');

        $data = $this->M_retur->cekDataRetur($norefretur);

        echo json_encode($data);
    }

    public function batalRetur()
    {
        $norefretur = $this->input->post('norefretur');
        $alasan = $this->input->post('alasan');

        $ret_skb = $this->db_logistik_pt->query("SELECT * FROM retskb WHERE norefretur='$norefretur'")->row();
        $data_retskb_histori['noretur']         = $ret_skb->noretur;
        $data_retskb_histori['norefretur']      = $ret_skb->norefretur;
        $data_retskb_histori['tgl']             = $ret_skb->tgl;
        $data_retskb_histori['nobkb']           = $ret_skb->nobkb;
        $data_retskb_histori['norefbkb']        = $ret_skb->norefbkb;
        $data_retskb_histori['tglinput']        = $ret_skb->tglinput;
        $data_retskb_histori['txttgl']          = $ret_skb->txttgl;
        $data_retskb_histori['thn']             = $ret_skb->thn;
        $data_retskb_histori['periode1']        = $ret_skb->periode1;
        $data_retskb_histori['periode2']        = NULL;
        $data_retskb_histori['txtperiode1']     = $ret_skb->txtperiode1;
        $data_retskb_histori['txtperiode2']     = NULL;
        $data_retskb_histori['pt']              = $ret_skb->pt;
        $data_retskb_histori['kode']            = $ret_skb->kode;
        $data_retskb_histori['devisi']          = $ret_skb->devisi;
        $data_retskb_histori['kode_dev']        = $ret_skb->kode_dev;
        $data_retskb_histori['no_ba']           = $ret_skb->no_ba;
        $data_retskb_histori['keterangan']      = $ret_skb->keterangan;
        $data_retskb_histori['bag']             = $ret_skb->bag;
        $data_retskb_histori['batal']           = "1";
        $data_retskb_histori['alasan_batal']    = $alasan;
        $data_retskb_histori['id_user']         = $ret_skb->id_user;
        $data_retskb_histori['user']            = $this->session->userdata('user');
        $data_retskb_histori['cetak']           = $ret_skb->cetak;
        $data_retskb_histori['keterangan_transaksi']  = "BATAL RETUR";
        $data_retskb_histori['log']  = $this->session->userdata('user') . " membatalkan RETUR $ret_skb->noretur";
        $data_retskb_histori['tgl_transaksi']  = date("Y-m-d H:i:s");
        $data_retskb_histori['user_transaksi']  = $this->session->userdata('user');
        $data_retskb_histori['client_ip']  = $this->input->ip_address();
        $data_retskb_histori['client_platform']  = $this->platform->agent();
        $this->M_retur->savehistoriretskb($data_retskb_histori);

        $isi_batal = array('batal' => 1, 'alasan_batal' => $alasan);

        $data = $this->M_retur->updateBatal($norefretur, $isi_batal);
        $data1 = $this->M_retur->deleteStokMasuk($norefretur);

        $output = [
            'data' => $data,
            'data1' => $data1
        ];

        echo json_encode($output);
    }
    public function deleteRetur()
    {
        $norefretur = $this->input->post('norefretur');

        $ret_skb = $this->db_logistik_pt->query("SELECT * FROM retskb WHERE norefretur='$norefretur'")->row();
        $data_retskb_histori['noretur']         = $ret_skb->noretur;
        $data_retskb_histori['norefretur']      = $ret_skb->norefretur;
        $data_retskb_histori['tgl']             = $ret_skb->tgl;
        $data_retskb_histori['nobkb']           = $ret_skb->nobkb;
        $data_retskb_histori['norefbkb']        = $ret_skb->norefbkb;
        $data_retskb_histori['tglinput']        = $ret_skb->tglinput;
        $data_retskb_histori['txttgl']          = $ret_skb->txttgl;
        $data_retskb_histori['thn']             = $ret_skb->thn;
        $data_retskb_histori['periode1']        = $ret_skb->periode;
        $data_retskb_histori['periode2']        = NULL;
        $data_retskb_histori['txtperiode1']     = $ret_skb->txtperiode;
        $data_retskb_histori['txtperiode2']     = NULL;
        $data_retskb_histori['pt']              = $ret_skb->pt;
        $data_retskb_histori['kode']            = $ret_skb->kode;
        $data_retskb_histori['devisi']          = $ret_skb->devisi;
        $data_retskb_histori['kode_dev']        = $ret_skb->kode_dev;
        $data_retskb_histori['no_ba']           = $ret_skb->no_ba;
        $data_retskb_histori['keterangan']      = $ret_skb->keterangan;
        $data_retskb_histori['bag']             = $ret_skb->bag;
        $data_retskb_histori['batal']           = "1";
        $data_retskb_histori['alasan_batal']    = NULL;
        $data_retskb_histori['id_user']         = $ret_skb->id_user;
        $data_retskb_histori['user']            = $this->session->userdata('user');
        $data_retskb_histori['cetak']           = $ret_skb->cetak;
        $data_retskb_histori['keterangan_transaksi']  = "BATAL RETUR";
        $data_retskb_histori['log']  = $this->session->userdata('user') . " membatalkan RETUR $ret_skb->noretur";
        $data_retskb_histori['tgl_transaksi']  = date("Y-m-d H:i:s");
        $data_retskb_histori['user_transaksi']  = $this->session->userdata('user');
        $data_retskb_histori['client_ip']  = $this->input->ip_address();
        $data_retskb_histori['client_platform']  = $this->platform->agent();
        $savehistoriretskb = $this->M_retur->savehistoriretskb($data_retskb_histori);

        $deleteretur = $this->M_retur->deleteRetur($norefretur);
        $deletestokmasuk = $this->M_retur->deleteStokMasuk($norefretur);
        $delete_header_entry = $this->db_mips_gl->delete('header_entry', array('noref' => $norefretur));

        $output = [
            'deleteretur' => $deleteretur,
            'deletestokmasuk' => $deletestokmasuk,
            'delete_header_entry' => $delete_header_entry
        ];

        echo json_encode($output);
    }

    public function cekNoBa()
    {
        $no_ba = $this->input->post('no_ba');
        $no_ba_str = str_replace(' ', '', $no_ba);
        $data = $this->M_retur->cekNoBa($no_ba_str);

        if ($data['no_ba'] == $no_ba_str) {
            $data = 1;
        } else {
            $data = 0;
        }

        echo json_encode($data);
    }

    public function str()
    {
        $kalimat = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
        $text = str_replace(' ', '', $kalimat); // kode untuk menghilangkan spasi
        echo $text;
    }

    function get_detail_approval()
    {
        $id_retskb = $this->input->post('id_retskb');
        $result_noref = $this->M_approval_retur->get_noref($id_retskb);
        $this->M_approval_retur->getWhere($result_noref['norefretur']);

        $list = $this->M_approval_retur->get_datatables();
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
            $row[] = $d->kodebar;
            $row[] = $d->nabar;
            $row[] = $d->satuan;
            $row[] = $d->qty;
            $row[] = $d->ket;
            // $row[] = $status;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_approval_retur->count_all(),
            "recordsFiltered" => $this->M_approval_retur->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function approval_retur()
    {
        $id_ret_skbitem = $this->input->post('id_ret_skbitem');
        $output = $this->M_approval_retur->approval_retur($id_ret_skbitem);

        echo json_encode($output);
    }
}
