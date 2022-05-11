<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bkb extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_bkb');
        $this->load->model('M_bkb_gl');
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
        //DB psam
        $this->db_logistik_psam = $this->load->database('db_logistik_psam', TRUE);
        //DB peak
        $this->db_logistik_peak = $this->load->database('db_logistik_peak', TRUE);
        //DB kpp
        $this->db_logistik_kpp = $this->load->database('db_logistik_kpp', TRUE);
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
        $data['noref_bpb'] = str_replace('.', '/', $this->uri->segment('3'));

        $data['pt_mutasi'] = $this->db_logistik_center->get('tb_pt')->result_array();

        $this->template->load('template', 'v_inputBkb', $data);
    }

    public function cari_pt_mutasi()
    {
        $output = $this->db_logistik_center->get('tb_pt')->result_array();

        echo json_encode($output);
    }

    // //Start Data Table Server Side
    public function get_data_bkb()
    {
        $list = $this->M_bkb->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;

            if ($field->approval == 1) {
                $aksi = '<button class="btn btn-success btn-xs fa fa-eye" id="detail_bkb" name="detail_bkb"
                data-noref="' . $field->NO_REF . '" data-id="' . $field->id . '" 
                data-toggle="tooltip" data-placement="top" title="detail">
                </button>
                <a href="' . site_url('Bkb/cetak/' . $field->SKBTXT . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_lpb"></a>';
            } else {
                if ($field->batal == 1) {
                    # code...
                    $aksi = '<button class="btn btn-success btn-xs fa fa-eye" id="detail_bkb" name="detail_bkb"
                    data-noref="' . $field->NO_REF . '" data-id="' . $field->id . '" data-batal="' . $field->batal . '"
                    data-toggle="tooltip" data-placement="top" title="detail">
                    </button>
                    
                    <a href="' . site_url('Bkb/cetak/' . $field->SKBTXT . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_lpb"></a>';
                } else {
                    # code...
                    $aksi = '<button class="btn btn-success btn-xs fa fa-eye" id="detail_bkb" name="detail_bkb"
                    data-noref="' . $field->NO_REF . '" data-id="' . $field->id . '" data-batal="' . $field->batal . '"
                    data-toggle="tooltip" data-placement="top" title="detail">
                    </button>
                    <button class="btn btn-xs btn-warning fa fa-edit" id="edit_bkb" name="edit_bkb"
                    data-id="' . $field->id . '"
                    data-toggle="tooltip" data-placement="top" title="detail" onClick="return false">
                    </button>
                    <a href="' . site_url('Bkb/cetak/' . $field->SKBTXT . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_lpb"></a>';
                }
            }

            $row = array();
            $row[] = $aksi;
            $row[] = $no;
            $row[] = date("d-m-Y", strtotime($field->tgl));
            $row[] = $field->NO_REF;
            $row[] = $field->nobpb;
            $row[] = $field->no_mutasi;
            $row[] = $field->bag;
            $row[] = $field->keperluan;
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

    public function edit_bkb()
    {
        $data = [
            'title' => 'Edit BKB'
        ];

        $id_stockkeluar = $this->uri->segment('3');

        $data['data_stockkeluar'] = $this->db_logistik_pt->get_where('stockkeluar', ['id' => $id_stockkeluar])->row_array();

        $data['noref_bkb_edit'] = $data['data_stockkeluar']['NO_REF'];

        $this->template->load('template', 'v_bkbEdit', $data);
    }

    public function get_data_bkb_edit()
    {
        $noref_bkb = $this->input->post('noref_bkb');

        $stockkeluar = $this->db_logistik_pt->get_where('stockkeluar', ['NO_REF' => $noref_bkb])->row_array();

        $keluarbrgitem = $this->db_logistik_pt->get_where('keluarbrgitem', ['NO_REF' => $noref_bkb])->result_array();

        $data = [
            'stockkeluar' => $stockkeluar,
            'keluarbrgitem' => $keluarbrgitem,
        ];

        echo json_encode($data);
    }

    public function KembalikanNilaiStock()
    {
        $id_keluarbrgitem = $this->input->post('id_keluarbrgitem');

        //get keperluan data update
        $get_data_keluarbrgitem = $this->M_bkb->get_data_keluarbrgitem($id_keluarbrgitem);

        // mengembalikan stock awal bulanan
        $update_stockawal_bulanan_devisi_edit = $this->M_bkb->update_stockawal_bulanan_devisi_edit($get_data_keluarbrgitem);

        // mengembalikan stock awal harian
        $update_stockawal_harian = $this->M_bkb->update_stockawal_harian_delete($get_data_keluarbrgitem);

        // mengembalikan stock awal
        $update_stockawal_edit = $this->M_bkb->update_stockawal_edit($get_data_keluarbrgitem);

        $data_edit_gl = $this->M_bkb_gl->edit_gl($get_data_keluarbrgitem);

        $data_return = [
            'update_stockawal_bulanan_devisi_edit' => $update_stockawal_bulanan_devisi_edit,
            'update_stockawal_edit' => $update_stockawal_edit,
            'update_stockawal_harian' => $update_stockawal_harian,
            'data_edit_gl' => $data_edit_gl,
        ];

        echo json_encode($data_return);
    }

    public function batalItemBkb()
    {
        $id_keluarbrgitem = $this->input->post('id_keluarbrgitem');
        $id_register_stok = $this->input->post('id_register_stok');
        $kodebar = $this->input->post('kodebar');
        $norefbpb = $this->input->post('norefbpb');
        $mutasi = $this->input->post('mutasi');
        $mutasi_pt = $this->input->post('mutasi_pt');
        $id_mutasi_item = $this->input->post('id_mutasi_item');
        $cmb_blok_sub = $this->input->post('cmb_blok_sub');
        $edit = $this->input->post('edit');
        $noref_bkb = $this->input->post('noref_bkb');
        $alasan = $this->input->post('alasan');

        //histori itemm bkb
        $get_item = $this->db_logistik_pt->query("SELECT * FROM keluarbrgitem WHERE id='$id_keluarbrgitem'")->row();
        $datakeluarbrgitem['kodebar']       = $kodebar;
        $datakeluarbrgitem['kodebartxt']    = $kodebar;
        $datakeluarbrgitem['nabar']         = $get_item->nabar;
        $datakeluarbrgitem['satuan']        = $get_item->satuan;
        $datakeluarbrgitem['grp']           = $get_item->grp;
        $datakeluarbrgitem['alokasi']       = $get_item->alokasi;
        $datakeluarbrgitem['kodept']        = $get_item->kodept;
        $datakeluarbrgitem['nobpb']         = $get_item->nobpb;
        $datakeluarbrgitem['pt']            = $this->session->userdata('pt');
        $datakeluarbrgitem['kode_dev']      = $get_item->kode_dev;
        $datakeluarbrgitem['devisi']        = $get_item->devisi;
        $datakeluarbrgitem['tmtbm']         = $get_item->tmtbm;
        $datakeluarbrgitem['afd']           = $get_item->afd;
        $datakeluarbrgitem['blok']          = $get_item->blok;
        $datakeluarbrgitem['thntanam']      = $get_item->thntanam;
        $datakeluarbrgitem['qty']           = $get_item->qty;
        $datakeluarbrgitem['qty2']          = $get_item->qty2;
        $datakeluarbrgitem['nilai_item']    = $get_item->nilai_item;
        $datakeluarbrgitem['tgl']           = $get_item->tgl . " 00:00:00";
        $datakeluarbrgitem['skb']           = $get_item->skb;
        $datakeluarbrgitem['SKBTXT']        = $get_item->SKBTXT;
        $datakeluarbrgitem['NO_REF']        = $get_item->NO_REF;
        $datakeluarbrgitem['tglinput']      = date('Y-m-d H:i:s');
        $datakeluarbrgitem['txttgl']        = $get_item->txttgl;
        $datakeluarbrgitem['thn']           = $get_item->thn;
        $datakeluarbrgitem['periode']       = $this->session->userdata('Ymd_periode') . " 00:00:00";
        $datakeluarbrgitem['txtperiode']    = $get_item->txtperiode;
        $datakeluarbrgitem['noadjust']      = "0";
        $datakeluarbrgitem['ket']           = $get_item->ket;
        $datakeluarbrgitem['kodebeban']     = $get_item->kodebeban;
        $datakeluarbrgitem['kodebebantxt']  = $get_item->kodebebantxt;
        $datakeluarbrgitem['ketbeban']      = $get_item->ketbeban;
        $datakeluarbrgitem['kodesub']       = $get_item->kodesub;
        $datakeluarbrgitem['kodesubtxt']    = $get_item->kodesubtxt;
        $datakeluarbrgitem['ketsub']        = $get_item->ketsub;
        $datakeluarbrgitem['batal']         = '0';
        $datakeluarbrgitem['id_user']       = $get_item->id_user;
        $datakeluarbrgitem['USER']          = $this->session->userdata('user');
        $datakeluarbrgitem['cetak']         = $get_item->cetak;
        $datakeluarbrgitem['posting']       = '0';
        $datakeluarbrgitem['keterangan_transaksi'] = 'INPUT BKB';
        $datakeluarbrgitem['log'] = $this->session->userdata('user') . " membatalkan ITEM BKB $get_item->skb";
        $datakeluarbrgitem['tgl_transaksi'] = date("Y-m-d H:i:s");
        $datakeluarbrgitem['user_transaksi'] = $this->session->userdata('user');
        $datakeluarbrgitem['client_ip'] = $this->input->ip_address();
        $datakeluarbrgitem['client_platform'] = $this->platform->agent();
        $simpanhistoriitembkb = $this->M_bkb->savehistorikeluarbrgitem($datakeluarbrgitem);

        //end

        //ubah status_item_bkb di bpbitem
        $update_bpb_item = $this->M_bkb->update_status_item_bkb($kodebar, $norefbpb);
        //ubah status_bkb di bpb
        $update_bpb = $this->M_bkb->update_status_bkb($norefbpb);

        //ubah status_item_bkb di bpbitem_mutasi dan status_bkb di bpb_mutasi
        if ($mutasi_pt == '1') {
            $update_bpb_item_mutasi = $this->M_bkb->update_status_item_bkb_mutasi($kodebar, $norefbpb);
            $update_bpb_mutasi = $this->M_bkb->update_status_bkb_mutasi($norefbpb);
        } else {
            $update_bpb_item_mutasi = NULL;
            $update_bpb_mutasi = NULL;
        }

        if ($edit == 1) {
            $delete_register = $this->db_logistik_pt->delete('register_stok', array('kodebar' => $kodebar, 'noref' => $noref_bkb));
        } else {
            $delete_register = $this->db_logistik_pt->delete('register_stok', array('id' => $id_register_stok));
        }

        $isibatal = array(
            'batal' => 1,
            'alasan_batal' => $alasan
        );
        // $deletebkb = $this->db_logistik_pt->delete('keluarbrgitem', array('id' => $id_keluarbrgitem));
        $deletebkb = $this->M_bkb->updatebatalitem($id_keluarbrgitem, $isibatal);

        if ($mutasi == 1) {
            if ($edit == 1) {
                //jika dihapus nya lewat data BKB
                $this->db_logistik_center->where(['kodebar' => $kodebar, 'blok' => $cmb_blok_sub, 'NO_REF' => $noref_bkb]);
                $this->db_logistik_center->delete('tb_mutasi_item');
            } else {
                $this->db_logistik_center->delete('tb_mutasi_item', array('id' => $id_mutasi_item));
            }
        }

        $data = [
            'delete_register' => $delete_register,
            'update_bpb' => $update_bpb,
            'update_bpb_item' => $update_bpb_item,
            'update_bpb_item_mutasi' => $update_bpb_item_mutasi,
            'update_bpb_mutasi' => $update_bpb_mutasi,
            'deletebkb' => $deletebkb
        ];

        echo json_encode($data);
    }
    public function hapusItemBkb()
    {
        $id_keluarbrgitem = $this->input->post('id_keluarbrgitem');
        $id_register_stok = $this->input->post('id_register_stok');
        $kodebar = $this->input->post('kodebar');
        $norefbpb = $this->input->post('norefbpb');
        $mutasi = $this->input->post('mutasi');
        $mutasi_pt = $this->input->post('mutasi_pt');
        $id_mutasi_item = $this->input->post('id_mutasi_item');
        $cmb_blok_sub = $this->input->post('cmb_blok_sub');
        $edit = $this->input->post('edit');
        $noref_bkb = $this->input->post('noref_bkb');

        //histori itemm bkb
        $get_item = $this->db_logistik_pt->query("SELECT * FROM keluarbrgitem WHERE id='$id_keluarbrgitem'")->row();
        $datakeluarbrgitem['kodebar']       = $kodebar;
        $datakeluarbrgitem['kodebartxt']    = $kodebar;
        $datakeluarbrgitem['nabar']         = $get_item->nabar;
        $datakeluarbrgitem['satuan']        = $get_item->satuan;
        $datakeluarbrgitem['grp']           = $get_item->grp;
        $datakeluarbrgitem['alokasi']       = $get_item->alokasi;
        $datakeluarbrgitem['kodept']        = $get_item->kodept;
        $datakeluarbrgitem['nobpb']         = $get_item->nobpb;
        $datakeluarbrgitem['pt']            = $this->session->userdata('pt');
        $datakeluarbrgitem['kode_dev']      = $get_item->kode_dev;
        $datakeluarbrgitem['devisi']        = $get_item->devisi;
        $datakeluarbrgitem['tmtbm']         = $get_item->tmtbm;
        $datakeluarbrgitem['afd']           = $get_item->afd;
        $datakeluarbrgitem['blok']          = $get_item->blok;
        $datakeluarbrgitem['thntanam']      = $get_item->thntanam;
        $datakeluarbrgitem['qty']           = $get_item->qty;
        $datakeluarbrgitem['qty2']          = $get_item->qty2;
        $datakeluarbrgitem['nilai_item']    = $get_item->nilai_item;
        $datakeluarbrgitem['tgl']           = $get_item->tgl . " 00:00:00";
        $datakeluarbrgitem['skb']           = $get_item->skb;
        $datakeluarbrgitem['SKBTXT']        = $get_item->SKBTXT;
        $datakeluarbrgitem['NO_REF']        = $get_item->NO_REF;
        $datakeluarbrgitem['tglinput']      = date('Y-m-d H:i:s');
        $datakeluarbrgitem['txttgl']        = $get_item->txttgl;
        $datakeluarbrgitem['thn']           = $get_item->thn;
        $datakeluarbrgitem['periode']       = $this->session->userdata('Ymd_periode') . " 00:00:00";
        $datakeluarbrgitem['txtperiode']    = $get_item->txtperiode;
        $datakeluarbrgitem['noadjust']      = "0";
        $datakeluarbrgitem['ket']           = $get_item->ket;
        $datakeluarbrgitem['kodebeban']     = $get_item->kodebeban;
        $datakeluarbrgitem['kodebebantxt']  = $get_item->kodebebantxt;
        $datakeluarbrgitem['ketbeban']      = $get_item->ketbeban;
        $datakeluarbrgitem['kodesub']       = $get_item->kodesub;
        $datakeluarbrgitem['kodesubtxt']    = $get_item->kodesubtxt;
        $datakeluarbrgitem['ketsub']        = $get_item->ketsub;
        $datakeluarbrgitem['batal']         = '0';
        $datakeluarbrgitem['id_user']       = $get_item->id_user;
        $datakeluarbrgitem['USER']          = $this->session->userdata('user');
        $datakeluarbrgitem['cetak']         = $get_item->cetak;
        $datakeluarbrgitem['posting']       = '0';
        $datakeluarbrgitem['keterangan_transaksi'] = 'DELETE ITEM BKB';
        $datakeluarbrgitem['log'] = $this->session->userdata('user') . " menghapus ITEM BKB $get_item->skb";
        $datakeluarbrgitem['tgl_transaksi'] = date("Y-m-d H:i:s");
        $datakeluarbrgitem['user_transaksi'] = $this->session->userdata('user');
        $datakeluarbrgitem['client_ip'] = $this->input->ip_address();
        $datakeluarbrgitem['client_platform'] = $this->platform->agent();
        $simpanhistoriitembkb = $this->M_bkb->savehistorikeluarbrgitem($datakeluarbrgitem);

        //end

        //ubah status_item_bkb di bpbitem
        $update_bpb_item = $this->M_bkb->update_status_item_bkb($kodebar, $norefbpb);
        //ubah status_bkb di bpb
        $update_bpb = $this->M_bkb->update_status_bkb($norefbpb);

        //ubah status_item_bkb di bpbitem_mutasi dan status_bkb di bpb_mutasi
        if ($mutasi_pt == '1' or $mutasi == '1') {
            $update_bpb_item_mutasi = $this->M_bkb->update_status_item_bkb_mutasi($kodebar, $norefbpb);
            $update_bpb_mutasi = $this->M_bkb->update_status_bkb_mutasi($norefbpb);
        } else {
            $update_bpb_item_mutasi = NULL;
            $update_bpb_mutasi = NULL;
        }

        if ($edit == 1) {
            $delete_register = $this->db_logistik_pt->delete('register_stok', array('kodebar' => $kodebar, 'noref' => $noref_bkb));
        } else {
            $delete_register = $this->db_logistik_pt->delete('register_stok', array('id' => $id_register_stok));
        }

        $deletebkb = $this->db_logistik_pt->delete('keluarbrgitem', array('id' => $id_keluarbrgitem));

        if ($mutasi == 1) {
            if ($edit == 1) {
                //jika dihapus nya lewat data BKB
                $this->db_logistik_center->where(['kodebar' => $kodebar, 'blok' => $cmb_blok_sub, 'NO_REF' => $noref_bkb]);
                $this->db_logistik_center->delete('tb_mutasi_item');
            } else {
                $this->db_logistik_center->delete('tb_mutasi_item', array('id' => $id_mutasi_item));
            }
        }

        //delete ke GL
        $delete_gl = $this->db_mips_gl->delete('entry', array('kodebar' => $kodebar, 'noref' => $noref_bkb));

        $data = [
            'delete_register' => $delete_register,
            'update_bpb' => $update_bpb,
            'update_bpb_item' => $update_bpb_item,
            'update_bpb_item_mutasi' => $update_bpb_item_mutasi,
            'update_bpb_mutasi' => $update_bpb_mutasi,
            'deletebkb' => $deletebkb,
            'delete_gl' => $delete_gl
        ];

        echo json_encode($data);
    }

    public function cekDataBkb()
    {
        $noref_bkb = $this->input->post('noref_bkb');
        $data =  $this->db_logistik_pt->get_where('keluarbrgitem', array('NO_REF' => $noref_bkb))->num_rows();

        echo json_encode($data);
    }

    public function cekDataBkbItem()
    {
        $noref_bkb = $this->input->post('noref_bkb');

        $output = $this->M_bkb->cekDataBkbItem($noref_bkb);

        // if ($output >= 1) {
        //     $this->M_bkb->cek_status_approve($noref_bkb);
        // }

        echo json_encode($output);
    }

    public function hapusBkb()
    {
        $noref_bkb = $this->input->post('noref_bkb');
        $mutasi = $this->input->post('mutasi');
        $id_mutasi = $this->input->post('id_mutasi');
        $edit = $this->input->post('edit');

        //histori
        $get_bkb = $this->db_logistik_pt->query("SELECT * FROM stockkeluar WHERE NO_REF='$noref_bkb'")->row();
        $datastockkeluar['tgl']             = $get_bkb->tgl . " 00:00:00";
        $datastockkeluar['skb']             = $get_bkb->skb;
        $datastockkeluar['SKBTXT']          = $get_bkb->SKBTXT;
        $datastockkeluar['NO_REF']          = $noref_bkb;
        $datastockkeluar['nobpb']           = $get_bkb->nobpb;

        $datastockkeluar['mutasi']              = $get_bkb->mutasi;
        $datastockkeluar['no_mutasi']           = $get_bkb->no_mutasi;
        $datastockkeluar['kode_devisi_mutasi']  = $get_bkb->kode_devisi_mutasi;
        $datastockkeluar['devisi_mutasi']       = $get_bkb->devisi_mutasi;
        $datastockkeluar['kode_pt_mutasi']      = $get_bkb->kode_pt_mutasi;
        $datastockkeluar['pt_mutasi']           = $get_bkb->pt_mutasi;

        $datastockkeluar['tglinput']        = $get_bkb->tglinput;
        $datastockkeluar['txttgl']          = $get_bkb->txttgl;
        $datastockkeluar['thn']             = $get_bkb->thn;
        $datastockkeluar['periode1']        = $get_bkb->periode1 . " 00:00:00";
        $datastockkeluar['periode2']        = NULL;
        $datastockkeluar['txtperiode1']     = $get_bkb->txtperiode1;
        $datastockkeluar['txtperiode2']     = NULL;
        $datastockkeluar['alokasi']         = $get_bkb->alokasi;
        $datastockkeluar['pt']              = $this->session->userdata('pt');
        $datastockkeluar['kode']            = $this->session->userdata('kode_pt');
        $datastockkeluar['devisi']          = $get_bkb->devisi;
        $datastockkeluar['kode_dev']        = $get_bkb->kode_dev;
        $datastockkeluar['kpd']             = $get_bkb->kpd;
        $datastockkeluar['keperluan']       = $get_bkb->keperluan;
        $datastockkeluar['bag']             = $get_bkb->bag;
        $datastockkeluar['batal']           = $get_bkb->batal;
        $datastockkeluar['id_user']         = $get_bkb->id_user;
        $datastockkeluar['USER']            = $this->session->userdata('user');
        $datastockkeluar['SUB']             = NULL;
        $datastockkeluar['USER1']           = NULL;
        $datastockkeluar['cetak']           = $get_bkb->cetak;
        $datastockkeluar['bhn_bakar']       = $get_bkb->bhn_bakar;
        $datastockkeluar['jn_alat']         = $get_bkb->jn_alat;
        $datastockkeluar['no_kode']         = $get_bkb->no_kode;
        $datastockkeluar['hm_km']           = $get_bkb->hm_km;
        $datastockkeluar['lok_kerja']       = $get_bkb->lok_kerja;
        $datastockkeluar['posting']         = '0';
        $datastockkeluar['keterangan_transaksi'] = 'HAPUS BKB';
        $datastockkeluar['log'] = $this->session->userdata('user') . " menghapus BKB $get_bkb->skb";
        $datastockkeluar['tgl_transaksi'] = date("Y-m-d H:i:s");
        $datastockkeluar['user_transaksi'] = $this->session->userdata('user');
        $datastockkeluar['client_ip'] = $this->input->ip_address();
        $datastockkeluar['client_platform'] = $this->platform->agent();
        $simpanhistoribkb = $this->M_bkb->savehistoristockkeluar($datastockkeluar);
        //end

        $delete_stockkeluar = $this->db_logistik_pt->delete('stockkeluar', array('NO_REF' => $noref_bkb));

        $delete_header_entry = $this->db_mips_gl->delete('header_entry', array('noref' => $noref_bkb));

        if ($mutasi == 1) {
            if ($edit == 1) {
                $delete_mutasi = $this->db_logistik_center->delete('tb_mutasi', array('NO_REF' => $noref_bkb));
            } else {
                $delete_mutasi = $this->db_logistik_center->delete('tb_mutasi', array('id' => $id_mutasi));
            }
        } else {
            $delete_mutasi = NULL;
        }

        $data = [
            'delete_stockkeluar' => $delete_stockkeluar,
            'delete_header_entry' => $delete_header_entry,
            'delete_mutasi' => $delete_mutasi,
        ];

        echo json_encode($data);
    }
    public function batalBkb()
    {
        $noref_bkb = $this->input->post('noref_bkb');
        $mutasi = $this->input->post('mutasi');
        $id_mutasi = $this->input->post('id_mutasi');
        $edit = $this->input->post('edit');
        $alasan = $this->input->post('alasan');

        //histori
        $get_bkb = $this->db_logistik_pt->query("SELECT * FROM stockkeluar WHERE NO_REF='$noref_bkb'")->row();
        $datastockkeluar['tgl']             = $get_bkb->tgl . " 00:00:00";
        $datastockkeluar['skb']             = $get_bkb->skb;
        $datastockkeluar['SKBTXT']          = $get_bkb->SKBTXT;
        $datastockkeluar['NO_REF']          = $noref_bkb;
        $datastockkeluar['nobpb']           = $get_bkb->nobpb;

        $datastockkeluar['mutasi']              = $get_bkb->mutasi;
        $datastockkeluar['no_mutasi']           = $get_bkb->no_mutasi;
        $datastockkeluar['kode_devisi_mutasi']  = $get_bkb->kode_devisi_mutasi;
        $datastockkeluar['devisi_mutasi']       = $get_bkb->devisi_mutasi;
        $datastockkeluar['kode_pt_mutasi']      = $get_bkb->kode_pt_mutasi;
        $datastockkeluar['pt_mutasi']           = $get_bkb->pt_mutasi;

        $datastockkeluar['tglinput']        = $get_bkb->tglinput;
        $datastockkeluar['txttgl']          = $get_bkb->txttgl;
        $datastockkeluar['thn']             = $get_bkb->thn;
        $datastockkeluar['periode1']        = $get_bkb->periode1 . " 00:00:00";
        $datastockkeluar['periode2']        = NULL;
        $datastockkeluar['txtperiode1']     = $get_bkb->txtperiode1;
        $datastockkeluar['txtperiode2']     = NULL;
        $datastockkeluar['alokasi']         = $get_bkb->alokasi;
        $datastockkeluar['pt']              = $this->session->userdata('pt');
        $datastockkeluar['kode']            = $this->session->userdata('kode_pt');
        $datastockkeluar['devisi']          = $get_bkb->devisi;
        $datastockkeluar['kode_dev']        = $get_bkb->kode_dev;
        $datastockkeluar['kpd']             = $get_bkb->kpd;
        $datastockkeluar['keperluan']       = $get_bkb->keperluan;
        $datastockkeluar['bag']             = $get_bkb->bag;
        $datastockkeluar['batal']           = $get_bkb->batal;
        $datastockkeluar['id_user']         = $get_bkb->id_user;
        $datastockkeluar['USER']            = $this->session->userdata('user');
        $datastockkeluar['SUB']             = NULL;
        $datastockkeluar['USER1']           = NULL;
        $datastockkeluar['cetak']           = $get_bkb->cetak;
        $datastockkeluar['bhn_bakar']       = $get_bkb->bhn_bakar;
        $datastockkeluar['jn_alat']         = $get_bkb->jn_alat;
        $datastockkeluar['no_kode']         = $get_bkb->no_kode;
        $datastockkeluar['hm_km']           = $get_bkb->hm_km;
        $datastockkeluar['lok_kerja']       = $get_bkb->lok_kerja;
        $datastockkeluar['posting']         = '0';
        $datastockkeluar['keterangan_transaksi'] = 'BATAL BKB';
        $datastockkeluar['log'] = $this->session->userdata('user') . " membatalkan BKB $get_bkb->skb";
        $datastockkeluar['tgl_transaksi'] = date("Y-m-d H:i:s");
        $datastockkeluar['user_transaksi'] = $this->session->userdata('user');
        $datastockkeluar['client_ip'] = $this->input->ip_address();
        $datastockkeluar['client_platform'] = $this->platform->agent();
        $simpanhistoribkb = $this->M_bkb->savehistoristockkeluar($datastockkeluar);
        //end


        $isibatal = array(
            'batal' => 1,
            'alasan_batal' => $alasan
        );
        // $data = $this->db_logistik_pt->delete('stockkeluar', array('NO_REF' => $noref_bkb));
        $data = $this->M_bkb->updatebatal($noref_bkb, $isibatal);

        if ($mutasi == 1) {
            if ($edit == 1) {
                $this->db_logistik_center->delete('tb_mutasi', array('NO_REF' => $noref_bkb));
            } else {
                $this->db_logistik_center->delete('tb_mutasi', array('id' => $id_mutasi));
            }
        }

        echo json_encode($data);
    }

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
            $row[] = date("d-m-Y", strtotime($field->tglinput));
            $row[] = $field->norefbpb;
            $row[] = $field->devisi;
            $row[] = $field->bag;
            $row[] = $field->keperluan;
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
        if (substr($noref, 8, 3) == 'MUT') {
            $result = $this->M_bkb->get_data_bpb_qr_mut($noref);
        } else {
            $result = $this->M_bkb->get_data_bpb_qr($noref);
        }
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
        } else if ($sess_lokasi == "SITE") {
            $text1 = "EST";
            $text2 = "SWJ";
        } else if ($sess_lokasi == "RO") {
            $text1 = "ROM";
            $text2 = "PKY";
        } else if ($sess_lokasi == "PKS") {
            $text1 = "FAC";
            $text2 = "SWJ";
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

        $kode_devisi = $this->input->post('kode_dev');
        $dig_1 = preg_replace("/[^1-9]/", "", $kode_devisi);

        if ($this->session->userdata('status_lokasi') == "HO") {
            $dig_2 = "1";
        } else {
            $dig_2 = "2";
        }

        $digit = $dig_1 . $dig_2;

        $hitung_digit1_2 = strlen($digit);
        $query_stockkeluar = "SELECT MAX(SUBSTRING(SKBTXT, $hitung_digit1_2+1)) as maxid_skb from stockkeluar WHERE SKBTXT LIKE '$digit%'";
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
            $no_ref = $text1 . "-BKB/" . $text2 . "/" . $format_m_y . "/" . $skb; //EST-BKB/SWJ/06/15/001159 atau //EST-BKB/SWJ/10/18/71722
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
        $devisi = $this->input->post('devisi');

        $kode_devisi_mutasi = $this->input->post('kode_devisi_mutasi');

        $kode_pt_mutasi = $this->input->post('kode_pt_mutasi');

        // Mencari alias di PT tujuan untuk mencari nama devisi tujuan
        $data['get_pt_mutasi'] = $this->db_logistik_center->get_where('tb_pt', ['kode_pt' => $kode_pt_mutasi])->row_array();

        //jika pt Tujuan
        if ($data['get_pt_mutasi']['alias'] == 'MSAL') {
            $data['get_devisi_mutasi'] = $this->db_logistik_msal->get_where('tb_devisi', ['kodetxt' => $kode_devisi_mutasi])->row_array();
        } elseif ($data['get_pt_mutasi']['alias'] == 'MAPA') {
            $data['get_devisi_mutasi'] = $this->db_logistik_mapa->get_where('tb_devisi', ['kodetxt' => $kode_devisi_mutasi])->row_array();
        } elseif ($data['get_pt_mutasi']['alias'] == 'PSAM') {
            $data['get_devisi_mutasi'] = $this->db_logistik_psam->get_where('tb_devisi', ['kodetxt' => $kode_devisi_mutasi])->row_array();
        } elseif ($data['get_pt_mutasi']['alias'] == 'PEAK') {
            $data['get_devisi_mutasi'] = $this->db_logistik_peak->get_where('tb_devisi', ['kodetxt' => $kode_devisi_mutasi])->row_array();
        } elseif ($data['get_pt_mutasi']['alias'] == 'KPP') {
            $data['get_devisi_mutasi'] = $this->db_logistik_kpp->get_where('tb_devisi', ['kodetxt' => $kode_devisi_mutasi])->row_array();
        }

        //cek apakah sudah ada barang nya atau belum di stockawal
        $cek_stockawal = $this->M_bkb->cek_stockawal($kodebar, $txtperiode, $kode_dev);
        if ($cek_stockawal == 1) {
            // mendapatkan nilai rata2
            $nilai_keluarbrgitem = $this->M_bkb->get_rata2_nilai($kodebar, $qty2, $txtperiode);
        } else {
            //insert stokc awal dan dapatkan rata2 nya
            $nilai_keluarbrgitem = $this->insert_stokawal($kodebar, $nabar, $satuan, $grup_brg, $qty2, $txtperiode);
        }

        // membuat noref Mutasi
        if ($mutasi == 1) {
            // if ($data['get_devisi_mutasi']['lokasi'] == 'SITE') {
            //     $text1_mutasi = 'EST';
            // } elseif ($data['get_devisi_mutasi']['lokasi'] == 'RO') {
            //     $text1_mutasi = 'ROM';
            // } elseif ($data['get_devisi_mutasi']['lokasi'] == 'PKS') {
            //     $text1_mutasi = 'FAC';
            // } elseif ($data['get_devisi_mutasi']['lokasi'] == 'HO') {
            //     $text1_mutasi = 'PST';
            // }

            $kode_pt_login = $this->session->userdata('kode_pt_login');
            $no_ref_mutasi = $text1 . "-BKB/MUT/" . $kode_pt_login . "/" . $text2 . "/" . $format_m_y . "/" . $skb; //EST-BKB/SWJ/06/15/001159 atau //EST-BKB/SWJ/10/18/71722
        }

        $mutasi_dari_devisi = $this->input->post('devisi');
        if ($mutasi == 1) {
            $keperluan = 'MUTASI dari BKB NO. ' . $skb . ' ' . $mutasi_dari_devisi;
            $diberikan_kpd = $data['get_devisi_mutasi']['lokasi'];
            $ket = 'MUTASI dari BKB NO. ' . $skb . ' ' . $mutasi_dari_devisi;
        } else {
            $keperluan = $this->input->post('txt_untuk_keperluan');
            $diberikan_kpd = $this->input->post('txt_diberikan_kpd');
            $ket = $this->input->post('txt_ket_rinci');
        }

        // $datastockkeluar['id']              = $id_stockkeluar;
        $datastockkeluar['tgl']             = $tgl . " 00:00:00";
        $datastockkeluar['skb']             = $skb;
        $datastockkeluar['SKBTXT']          = $skb;
        $datastockkeluar['NO_REF']          = $no_ref;
        $datastockkeluar['nobpb']           = $nobpb;
        // jika mutasi
        if ($mutasi == '1') {
            $datastockkeluar['mutasi']              = '1';
            $datastockkeluar['no_mutasi']           = $no_ref_mutasi;
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
        $datastockkeluar['pt']              = $this->session->userdata('devisi');
        $datastockkeluar['kode']            = $this->session->userdata('kode_dev');
        $datastockkeluar['devisi']          = $this->input->post('devisi');
        $datastockkeluar['kode_dev']        = $kode_dev;
        $datastockkeluar['kpd']             = $diberikan_kpd;
        $datastockkeluar['keperluan']       = $keperluan;
        $datastockkeluar['bag']             = $this->input->post('cmb_bagian');
        $datastockkeluar['batal']           = '0';
        $datastockkeluar['id_user']         = $id_user;
        $datastockkeluar['USER']            = $this->session->userdata('user');
        $datastockkeluar['SUB']             = NULL;
        $datastockkeluar['USER1']           = NULL;
        $datastockkeluar['cetak']           = '0';
        $datastockkeluar['bhn_bakar']       = $this->input->post('bhnbakar');
        $datastockkeluar['jn_alat']         = $this->input->post('txt_jns_alat');
        $datastockkeluar['no_kode']         = $this->input->post('txt_kd_nmr');
        $datastockkeluar['hm_km']           = $this->input->post('txt_hm_km');
        $datastockkeluar['lok_kerja']       = $this->input->post('txt_lokasi_kerja');
        $datastockkeluar['posting']         = '0';

        // $datakeluarbrgitem['id']            = $id_keluarbrgitem;
        $datakeluarbrgitem['kodebar']       = $kodebar;
        $datakeluarbrgitem['kodebartxt']    = $kodebar;
        $datakeluarbrgitem['nabar']         = $nabar;
        $datakeluarbrgitem['satuan']        = $satuan;
        $datakeluarbrgitem['grp']           = $grup_brg;
        $datakeluarbrgitem['alokasi']       = $alokasi;
        $datakeluarbrgitem['kodept']        = $this->session->userdata('kode_dev');
        $datakeluarbrgitem['nobpb']         = $nobpb;
        $datakeluarbrgitem['pt']            = $this->session->userdata('devisi');
        $datakeluarbrgitem['kode_dev']      = $kode_dev;
        $datakeluarbrgitem['devisi']        = $this->input->post('devisi');
        $datakeluarbrgitem['tmtbm']         = $this->input->post('cmb_tm_tbm');
        $datakeluarbrgitem['afd']           = $afd_unit;
        $datakeluarbrgitem['blok']          = $blok;
        $datakeluarbrgitem['thntanam']      = $this->input->post('cmb_tahun_tanam');
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
        $datakeluarbrgitem['ket']           = $ket;
        $datakeluarbrgitem['kodebeban']     = $this->input->post('hidden_kodebebantxt');
        $datakeluarbrgitem['kodebebantxt']  = $this->input->post('hidden_kodebebantxt');
        $datakeluarbrgitem['ketbeban']      = $this->input->post('cmb_bahan');
        $datakeluarbrgitem['kodesub']       = $this->input->post('hidden_no_acc');
        $datakeluarbrgitem['kodesubtxt']    = $this->input->post('hidden_no_acc');
        $datakeluarbrgitem['ketsub']        = $this->input->post('hidden_nama_acc');
        $datakeluarbrgitem['batal']         = '0';
        $datakeluarbrgitem['id_user']       = $id_user;
        $datakeluarbrgitem['USER']          = $this->session->userdata('user');
        $datakeluarbrgitem['cetak']         = '0';
        $datakeluarbrgitem['posting']       = '0';

        $nilai_keluarbrgitem_untuk_register = $this->M_bkb->get_rata2_nilai_untuk_register($kodebar, $txtperiode);

        $data_register_stok = [
            'kodebar' => $kodebar,
            'kodebartxt' => $kodebar,
            'namabar' => $nabar,
            'grup' => $grup_brg,
            'tgl' => $periode1,
            'tgltxt' => date("Ymd", strtotime($periode1)),
            'potxt' => '-',
            'ttgtxt' => $skb,
            'skbtxt' => '-',
            'adjttgtxt' => '-',
            'adjskbtxt' => '-',
            'retttgtxt' => '-',
            'retskbtxt' => '-',
            'no_slrh' => $skb,
            'ket' => $this->input->post('txt_ket_rinci'),
            'harga' => $nilai_keluarbrgitem_untuk_register,
            'qty' => $qty2,
            'masuk_qty' => '0',
            'keluar_qty' => $qty2,
            'status' => 'BKB',
            'kodept' => $this->session->userdata('kode_pt'),
            'namapt' => $this->session->userdata('pt'),
            'kode_dev' => $kode_dev,
            'devisi' => $this->input->post('devisi'),
            'txtperiode' => $txtperiode,
            'lokasi' => $this->session->userdata('status_lokasi'),
            'refpo' => '-',
            'noref' => $no_ref,
            'id_user' => $id_user,
            'USER' => $this->session->userdata('user'),
        ];

        // jika brang belum ada di stockawal
        if ($nilai_keluarbrgitem == '0') {
            $data = [
                'nilai_keluarbrgitem' => $nilai_keluarbrgitem
            ];

            echo json_encode($data);
        } else {
            if (empty($this->input->post('hidden_no_bkb'))) {
                if ($mutasi == '1') {
                    $savedatastockkeluar_mutasi = $this->M_bkb->savedatastockkeluar_mutasi($datastockkeluar);
                    $savedatakeluarbrgitem_mutasi = $this->M_bkb->savedatakeluarbrgitem_mutasi($datakeluarbrgitem);
                }
                $savedatastockkeluar_mutasi = NULL;
                $savedatakeluarbrgitem_mutasi = NULL;
                $savedatastockkeluar = $this->M_bkb->savedatastockkeluar($datastockkeluar);
                $savedatakeluarbrgitem = $this->M_bkb->savedatakeluarbrgitem($datakeluarbrgitem, $kodebar, $nobpb, $no_ref);
                $saveregisterstok = $this->M_bkb->saveRegisterStok($data_register_stok);

                //histori
                $datastockkeluar['keterangan_transaksi'] = 'INPUT BKB';
                $datastockkeluar['log'] = $this->session->userdata('user') . " membuat BKB $skb";
                $datastockkeluar['tgl_transaksi'] = date("Y-m-d H:i:s");
                $datastockkeluar['user_transaksi'] = $this->session->userdata('user');
                $datastockkeluar['client_ip'] = $this->input->ip_address();
                $datastockkeluar['client_platform'] = $this->platform->agent();
                $simpanhistoribkb = $this->M_bkb->savehistoristockkeluar($datastockkeluar);

                $datakeluarbrgitem['keterangan_transaksi'] = 'INPUT BKB';
                $datakeluarbrgitem['log'] = $this->session->userdata('user') . " membuat ITEM BKB $skb";
                $datakeluarbrgitem['tgl_transaksi'] = date("Y-m-d H:i:s");
                $datakeluarbrgitem['user_transaksi'] = $this->session->userdata('user');
                $datakeluarbrgitem['client_ip'] = $this->input->ip_address();
                $datakeluarbrgitem['client_platform'] = $this->platform->agent();
                $simpanhistoriitembkb = $this->M_bkb->savehistorikeluarbrgitem($datakeluarbrgitem);

                //end histori

                // insert to GL
                $result_insert_to_gl_header = $this->insert_bkb_to_header_entry_gl($skb, $kode_dev, $no_ref);
                $result_insert_bkb_to_entry_gl_cr = $this->insert_bkb_to_entry_gl_cr($skb, $nilai_keluarbrgitem_untuk_register, $qty2, $kode_dev, $kodebar, $no_ref, $nabar, $nobpb, $ket);
                $result_insert_bkb_to_entry_gl_dr = $this->insert_bkb_to_entry_gl_dr($skb, $nilai_keluarbrgitem_untuk_register, $qty2, $kode_dev, $kodebar, $no_ref, $nabar, $nobpb, $datakeluarbrgitem['kodesub'], $datakeluarbrgitem['ketsub'], $ket);
            } else {
                $savedatastockkeluar_mutasi = NULL;
                $savedatakeluarbrgitem_mutasi = NULL;
                $savedatastockkeluar = NULL;

                if ($mutasi == '1') {
                    $savedatakeluarbrgitem_mutasi = $this->M_bkb->savedatakeluarbrgitem_mutasi($datakeluarbrgitem);
                }

                $savedatakeluarbrgitem = $this->M_bkb->savedatakeluarbrgitem($datakeluarbrgitem, $kodebar, $nobpb, $no_ref);
                $saveregisterstok = $this->M_bkb->saveRegisterStok($data_register_stok);

                //HISTORI ITEM
                $datakeluarbrgitem['keterangan_transaksi'] = 'INPUT ITEM BKB';
                $datakeluarbrgitem['log'] = $this->session->userdata('user') . " membuat ITEM BKB $skb";
                $datakeluarbrgitem['tgl_transaksi'] = date("Y-m-d H:i:s");
                $datakeluarbrgitem['user_transaksi'] = $this->session->userdata('user');
                $datakeluarbrgitem['client_ip'] = $this->input->ip_address();
                $datakeluarbrgitem['client_platform'] = $this->platform->agent();
                $simpanhistoriitembkb = $this->M_bkb->savehistorikeluarbrgitem($datakeluarbrgitem);
                //END HISTORI

                // insert to GL
                $result_insert_to_gl_header = NULL;
                $result_insert_bkb_to_entry_gl_cr = $this->insert_bkb_to_entry_gl_cr($skb, $nilai_keluarbrgitem_untuk_register, $qty2, $kode_dev, $kodebar, $no_ref, $nabar, $nobpb, $ket);
                $result_insert_bkb_to_entry_gl_dr = $this->insert_bkb_to_entry_gl_dr($skb, $nilai_keluarbrgitem_untuk_register, $qty2, $kode_dev, $kodebar, $no_ref, $nabar, $nobpb, $datakeluarbrgitem['kodesub'], $datakeluarbrgitem['ketsub'], $ket);
            }

            // insert/update stockawal_bulanan_devisi
            $result_insert_stok_awal_bulanan = $this->insert_stok_awal_bulanan_devisi($kodebar, $nabar, $satuan, $grup_brg, $qty2, $devisi, $kode_dev);

            // insert/update stockawal_harian
            $result_insert_stok_awal_harian = $this->insert_stok_awal_harian($kodebar, $nabar, $satuan, $grup_brg, $qty2, $devisi, $kode_dev, $periode1, $txtperiode);

            //update stokawal
            $result_update_qtykeluar = $this->update_stok_awal($kodebar, $txtperiode);

            $query_id = "SELECT MAX(id) as id_stockkeluar FROM stockkeluar WHERE id_user = '$id_user' AND NO_REF = '$no_ref' ";
            $generate_id = $this->db_logistik_pt->query($query_id)->row();
            $id_stockkeluar = $generate_id->id_stockkeluar;

            $query_id = "SELECT MAX(id) as id_keluarbrgitem FROM keluarbrgitem WHERE id_user = '$id_user' AND NO_REF = '$no_ref' ";
            $generate_id = $this->db_logistik_pt->query($query_id)->row();
            $id_keluarbrgitem = $generate_id->id_keluarbrgitem;

            $query_id = "SELECT MAX(id) as id_register_stok FROM register_stok WHERE id_user = '$id_user' AND noref = '$no_ref' ";
            $generate_id = $this->db_logistik_pt->query($query_id)->row();
            $id_register_stok = $generate_id->id_register_stok;

            if ($mutasi == 1) {
                $query_id = "SELECT MAX(id) as id_mutasi FROM tb_mutasi WHERE id_user = '$id_user' AND NO_REF = '$no_ref' ";
                $generate_id = $this->db_logistik_center->query($query_id)->row();
                $id_mutasi = $generate_id->id_mutasi;

                $query_id = "SELECT MAX(id) as id_mutasi_item FROM tb_mutasi_item WHERE id_user = '$id_user' AND NO_REF = '$no_ref' ";
                $generate_id = $this->db_logistik_center->query($query_id)->row();
                $id_mutasi_item = $generate_id->id_mutasi_item;
            } else {
                $id_mutasi = NULL;
                $id_mutasi_item = NULL;
            }

            $data = [
                'result_insert_stok_awal_bulanan' => $result_insert_stok_awal_bulanan,
                'datastockkeluar' => $savedatastockkeluar,
                'datakeluarbrgitem' => $savedatakeluarbrgitem,
                'result_update_qtykeluar' => $result_update_qtykeluar,
                'savedatastockkeluar_mutasi' => $savedatastockkeluar_mutasi,
                'savedatakeluarbrgitem_mutasi' => $savedatakeluarbrgitem_mutasi,
                'result_insert_stok_awal_harian' => $result_insert_stok_awal_harian,
                'saveregisterstok' => $saveregisterstok,
                'no_bkb' => $skb,
                'noref_bkb' => $no_ref,
                'id_stockkeluar' => $id_stockkeluar,
                'id_keluarbrgitem' => $id_keluarbrgitem,
                'id_mutasi' => $id_mutasi,
                'id_mutasi_item' => $id_mutasi_item,
                'id_register_stok' => $id_register_stok,
                'txtperiode' => $txtperiode,
                'insert_to_gl_header' => $result_insert_to_gl_header,
                'insert_bkb_to_entry_gl_cr' => $result_insert_bkb_to_entry_gl_cr,
                'insert_bkb_to_entry_gl_dr' => $result_insert_bkb_to_entry_gl_dr
            ];

            echo json_encode($data);
        }
    }

    function insert_bkb_to_header_entry_gl($no_bkb, $kode_dev, $no_ref_bkb)
    {
        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');
        $status_lokasi = $this->session->userdata('status_lokasi');
        $user = $this->session->userdata('user');

        $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';

        //var untuk save ke header entry
        $header_entry["date"] = date("Y-m-d");
        $header_entry["periode"] = $periodes;
        $header_entry["ref"] = 'BKB-' . $no_bkb;
        $header_entry["totaldr"] = 0;
        $header_entry["totalcr"] = 0;
        $header_entry["periodetxt"] = $txtperiode;
        $header_entry["modul"] = 'LOGISTIK';
        $header_entry["lokasi"] = $status_lokasi;
        $header_entry["SBU"] = $kode_dev;
        $header_entry["USER"] = $user;
        $header_entry["noref"] = $no_ref_bkb;

        return $this->M_bkb_gl->insert_bkb_to_header_entry_gl($header_entry);
    }

    function insert_bkb_to_entry_gl_cr($no_bkb, $harga_item_po, $quantiti, $kode_dev, $kodebar, $no_ref_bkb, $nabar, $no_ref_po, $ket)
    {
        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');
        $status_lokasi = $this->session->userdata('status_lokasi');
        $user = $this->session->userdata('user');

        $totharga = $harga_item_po * $quantiti;

        $data_noac_gl = $this->M_bkb_gl->get_data_noac_gl($kodebar);

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
        $entry["dc"] = 'C';
        $entry["dr"] = 0;
        $entry["cr"] = $totharga;
        $entry["periode"] = $periodes;
        $entry["converse"] = 0;
        $entry["ref"] = 'BKB-' . $no_bkb;
        $entry["noref"] = $no_ref_bkb;
        $entry["descac"] = $nabar;
        $entry["ket"] = 'BKB:' . $nabar . '(' . $quantiti . '/' . $totharga . ')/' . $ket;
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
            return $this->M_bkb_gl->insert_bkb_to_entry_gl_cr($entry, $entry["noref"]);
        } else {
            return 0;
        }
    }

    function insert_bkb_to_entry_gl_dr($no_bkb, $harga_item_po, $quantiti, $kode_dev, $kodebar, $no_ref_bkb, $nabar, $no_ref_po, $kodesub, $ketsub, $ket)
    {
        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');
        $status_lokasi = $this->session->userdata('status_lokasi');
        $user = $this->session->userdata('user');

        $totharga = $harga_item_po * $quantiti;

        $data_noac_gl = $this->M_bkb_gl->get_data_noac_beban($kodesub);

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
        $entry["ref"] = 'BKB-' . $no_bkb;
        $entry["noref"] = $no_ref_bkb;
        $entry["descac"] = $ketsub;
        $entry["ket"] = 'BKB:' . $nabar . '(' . $quantiti . '/' . $totharga . ')/' . $ket;
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
            return $this->M_bkb_gl->insert_bkb_to_entry_gl_dr($entry, $entry["noref"]);
        } else {
            return 0;
        }
    }

    function insert_stok_awal_bulanan_devisi($kodebar, $nabar, $sat, $grp, $qty2, $devisi, $kode_dev)
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
            'saldoakhir_qty' => -$qty2, // sengaja dikasih mines 
            'tglinput' => date("Y-m-d H:i:s"),
            'thn' => date("Y"),
            'QTY_KELUAR' => $qty2,
            'periode' => $this->session->userdata('Ymd_periode'),
            'txtperiode' => $this->session->userdata('ym_periode'),
            'ket' => '-',
            'account' => '-',
            'ket_account' => '-',
            'tgl_transaksi' => date("Y-m-d H:i:s")
        ];

        $cek_stokawal_bulanan_devisi = $this->M_bkb->cek_stok_awal_bulanan_devisi($kodebar, $data_insert_stok_bulanan['txtperiode'], $kode_dev);

        if ($cek_stokawal_bulanan_devisi >= 1) {
            //update stok awal bulanan devisi
            return $this->M_bkb->update_stockawal_bulanan_devisi($kodebar, $qty2, $data_insert_stok_bulanan['txtperiode'], $kode_dev);
        } else {
            //insert stok awal bulanan devisi
            return $this->M_bkb->saveStokAwalBulananDevisi($data_insert_stok_bulanan);
        }
    }

    function insert_stokawal($kodebar, $nabar, $satuan, $grp, $qty2, $txtperiode)
    {

        $nilai_keluarbrgitem = $this->M_bkb->get_rata2_nilai($kodebar, $qty2, $txtperiode);

        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');

        $pt = $this->session->userdata('pt');
        $KODE = $this->session->userdata('kode_pt');

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
        $data_input_stock_awal["saldoakhir_qty"] = -$qty2; // sengaja dikasih mines
        $data_input_stock_awal["saldoakhir_nilai"] = -$nilai_keluarbrgitem; // sengaja dikasih mines
        $data_input_stock_awal["nilai_masuk"] = 0;
        $data_input_stock_awal["nilai_keluar"] = $nilai_keluarbrgitem;
        $data_input_stock_awal["QTY_MASUK"] = 0;
        $data_input_stock_awal["QTY_KELUAR"] = $qty2;
        $data_input_stock_awal["HARGARAT"] = 0;
        $data_input_stock_awal["periode"] = $periode;
        $data_input_stock_awal["txtperiode"] = $txtperiode;
        $data_input_stock_awal["account"] = "-";
        $data_input_stock_awal["ket_account"] = "-";

        $this->db_logistik_pt->insert('stockawal', $data_input_stock_awal);

        // mengembalikan nilai harga rata2 * qty
        return $nilai_keluarbrgitem;
    }

    function insert_stok_awal_harian($kodebar, $nabar, $satuan, $grup_brg, $qty2, $devisi, $kode_dev, $tgl, $txtperiode)
    {

        $nilai_keluarbrgitem = $this->M_bkb->get_rata2_nilai($kodebar, $qty2, $txtperiode);

        $data_insert_stok_harian = [
            'pt' => $this->session->userdata('pt'),
            'KODE' => $this->session->userdata('kode_pt'),
            'devisi' => $devisi,
            'kode_dev' => $kode_dev,
            'afd' => '-',
            'kodebar' => $kodebar,
            'kodebartxt' => $kodebar,
            'nabar' => $nabar,
            'satuan' => $satuan,
            'grp' => $grup_brg,
            'saldoawal_qty' => 0,
            'saldoawal_nilai' => 0,
            'tglinput' => date("Y-m-d H:i:s"),
            'thn' => date("Y"),
            'saldoakhir_qty' => -$qty2, // sengaja dikasih mines
            'saldoakhir_nilai' => -$nilai_keluarbrgitem, // sengaja dikasih mines
            'nilai_keluar' => $nilai_keluarbrgitem,
            'QTY_KELUAR' => $qty2,
            'periode' => $tgl,
            'txtperiode' => $txtperiode,
            'ket' => '-',
            'account' => '-',
            'ket_account' => '-',
            'tgl_transaksi' => date("Y-m-d H:i:s")
        ];

        $cek_stokawal_harian = $this->M_bkb->cek_stokawal_harian($kodebar, $tgl, $kode_dev);

        if ($cek_stokawal_harian >= 1) {
            //update stok awal harian
            return $this->M_bkb->update_stockawal_harian($kodebar, $qty2, $kode_dev, $tgl, $txtperiode);
        } else {
            //insert stok awal harian
            return $this->M_bkb->saveStokAwalHarian($data_insert_stok_harian);
        }
    }

    function update_stok_awal($kodebar, $txtperiode)
    {

        //saldoakhir_nilai
        $sum_harga_kodebar = $this->M_bkb->sum_harga_kodebar_harian($kodebar, $txtperiode);

        //saldo akhir qty
        $sum_saldo_qty_kodebar = $this->M_bkb->sum_saldo_qty_kodebar_harian($kodebar, $txtperiode);

        //nilai_masuk
        $sum_nilai_keluar = $this->M_bkb->sum_nilai_keluar_harian($kodebar, $txtperiode);

        //qty masuk
        $sum_qty_kodebar = $this->M_bkb->sum_qty_kodebar_harian($kodebar, $txtperiode);

        $data_update = [
            'saldoakhir_nilai' => $sum_harga_kodebar,

            'saldoakhir_qty' => $sum_saldo_qty_kodebar,

            'nilai_keluar' => $sum_nilai_keluar->nilai_keluar_harian,

            'QTY_KELUAR' => $sum_qty_kodebar->qty_keluar
        ];

        return $this->M_bkb->updateStokAwal($data_update, $kodebar, $txtperiode);
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
        $batal = $data['stockkeluar']->batal;
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
            'format' => 'A4',
            // 'setAutoTopMargin' => 'stretch',
            'margin_top' => '2',
            'margin_left' => '5',
            'margin_right' => '5',
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
        // $mpdf->SetHTMLHeader('
        //                     <table width="100%" border="0" align="center">
        //                         <tr>
        //                             <td rowspan="2" width="15%" height="10px"><!--img width="10%" height="60px" style="padding-left:8px" src="././assets/img/msal.jpg"--></td>
        //                             <td align="center" style="font-size:14px;font-weight:bold;">PT Mulia Sawit Agro Lestari (' . $lokasibkb . ')</td>
        //                         </tr>
        //                         <!--tr>
        //                             <td align="center">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
        //                             </td>
        //                         </tr-->
        //                     </table>
        //                     <hr style="width:100%;margin:0px;">
        //                     ');
        // $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');

        if ($batal == 1) {
            # code...
            $mpdf->SetWatermarkImage(
                '././assets/img/batal.png',
                0.3,
                '',
                array(25, 10)
            );
            $mpdf->showWatermarkImage = true;
        }

        if ($data['stockkeluar']->mutasi == 1) {
            $html = $this->load->view('v_bkbPrint_mutasi', $data, true);
        } else {
            $html = $this->load->view('v_bkbPrint', $data, true);
        }

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
            // if ($d->status_kasie_gudang == "1") {
            //     $status = "<span style='color: green'><b>DISETUJUI" . $d->tgl_kasie_gudang . "</b></span>";
            // } else {
            //     $status = "DALAM PROSES";
            // }

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $d->id;
            $row[] = $d->kodebar;
            $row[] = $d->nabar;
            $row[] = $d->satuan;
            $row[] = $d->qty;
            $row[] = $d->qty2;
            $row[] = $d->ket;

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
            $this->db_logistik_msal->where('lokasi !=', 'HO');
            $this->db_logistik_msal->where('lokasi !=', 'RO');
            $this->db_logistik_msal->order_by('kodetxt', 'asc');
            $output = $this->db_logistik_msal->get('tb_devisi')->result_array();
        } elseif ($data['pt_mutasi']['alias'] == 'MAPA') {
            $this->db_logistik_mapa->where('lokasi !=', 'HO');
            $this->db_logistik_mapa->where('lokasi !=', 'RO');
            $this->db_logistik_mapa->order_by('kodetxt', 'asc');
            $output = $this->db_logistik_mapa->get('tb_devisi')->result_array();
        } elseif ($data['pt_mutasi']['alias'] == 'PSAM') {
            $this->db_logistik_psam->where('lokasi !=', 'HO');
            $this->db_logistik_psam->where('lokasi !=', 'RO');
            $this->db_logistik_psam->order_by('kodetxt', 'asc');
            $output = $this->db_logistik_psam->get('tb_devisi')->result_array();
        } elseif ($data['pt_mutasi']['alias'] == 'PEAK') {
            $this->db_logistik_peak->where('lokasi !=', 'HO');
            $this->db_logistik_peak->where('lokasi !=', 'RO');
            $this->db_logistik_peak->order_by('kodetxt', 'asc');
            $output = $this->db_logistik_peak->get('tb_devisi')->result_array();
        } elseif ($data['pt_mutasi']['alias'] == 'KPP') {
            $this->db_logistik_kpp->where('lokasi !=', 'HO');
            $this->db_logistik_kpp->where('lokasi !=', 'RO');
            $this->db_logistik_kpp->order_by('kodetxt', 'asc');
            $output = $this->db_logistik_kpp->get('tb_devisi')->result_array();
        } else {
            $output = NULL;
        }

        echo json_encode($output);
    }

    public function get_noac_gl()
    {
        $nama_noac = $this->input->post('nama_noac');
        $output = $this->M_bkb->get_noac_gl($nama_noac);

        echo json_encode($output);
    }

    public function ubah_status_bpb_mutasi()
    {
        $noref_bpb = $this->input->post('no_ref_bpb');
        $kodebar = $this->input->post('kodebar');

        $output = $this->M_bkb->ubah_status_bpb_mutasi($noref_bpb, $kodebar);

        echo json_encode($output);
    }
}
