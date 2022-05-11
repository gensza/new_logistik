<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bpb extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_bpb');
        $this->load->model('M_brg');
        $this->load->model('M_databpb');
        $this->load->model('M_listbpb');
        $this->load->model('M_detail');
        $db_pt = check_db_pt();
        // $this->db_logistik = $this->load->database('db_logistik', TRUE);
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
        $this->db_logistik_center = $this->load->database('db_logistik_center', TRUE);
        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);
        $this->db_personalia = $this->load->database('db_personalia_' . $db_pt, TRUE);
        if (!$this->session->userdata('id_user')) {
            $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
            $this->session->set_flashdata('pesan', $pemberitahuan);
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            'title' => 'Bon Permintaan Barang'
        ];

        $this->template->load('template', 'v_indexBpb', $data);
    }

    function get_all_cmb()
    {
        $id = $this->input->post('id');
        $bahan = $this->input->post('bahan');
        $bpbitem = $this->db_logistik_pt->query("SELECT tmtbm, thntanam, ketbeban,kodebebantxt FROM bpbitem WHERE id='$id'")->row();
        // $isi = substr($bahan, 0, 4);
        // $thun = substr($bahan, 6, 4);

        // if ($isi == '7005') {
        //     $data = 'TM';
        // } else if ($isi == '2024') {
        //     $data = 'TBM';
        //     # code...
        // } else if ($isi == '2090') {
        //     $data = 'LANDCLEARING';
        //     # code...
        // } else if ($isi == '2095') {
        //     $data = 'PEMBIBITAN';
        //     # code...
        // } else {
        //     $data = NULL;
        // }

        // if ($thun != null) {
        //     $tahun = $thun;
        // } else {
        //     $tahun = '-';
        // }
        $d = $bpbitem;
        // $query = "SELECT * FROM tahun_tanam WHERE coa_material = '$bahan' ORDER BY thn_tanam ASC";
        // $data = $this->db_logistik_pt->query($query)->row();
        echo json_encode($d);
    }

    function get_edit_bpb()
    {
        $id = $this->input->post('id');
        $no_bpb = $this->input->post('no_bpb');

        $query_bpb = "SELECT * FROM bpb WHERE id = '$id' AND nobpb = '$no_bpb'";

        $data_bpb = $this->db_logistik_pt->query($query_bpb)->row();

        $norefbpb = $data_bpb->norefbpb;

        $query_bpbitem = "SELECT * FROM bpbitem WHERE norefbpb = '$norefbpb'";
        $data_bpbitem = $this->db_logistik_pt->query($query_bpbitem)->result();

        echo json_encode(array('data_bpb' => $data_bpb, 'data_bpbitem' => $data_bpbitem));
    }

    public function input()
    {
        $data = [
            'title' => 'Bon Permintaan Barang'
        ];

        $data['devisi'] = $this->M_bpb->cariDevisi();
        $data['pt'] = $this->M_bpb->cariPT();

        $this->template->load('template', 'v_inputBpb', $data);
    }

    public function cari_dept()
    {
        $lokasi = $this->session->userdata('status_lokasi');
        if ($lokasi == 'SITE') {
            $query = "SELECT kode, nama FROM dept WHERE kode <> 3 ORDER BY kode ASC";
        } else if ($lokasi == 'PKS') {
            $query = "SELECT kode, nama FROM dept WHERE kode <> 1 AND kode <> 2 ORDER BY kode ASC";
            # code...
        } else {
            $query = "SELECT kode, nama FROM dept  ORDER BY kode ASC";
        }

        $data = $this->db_logistik_pt->query($query)->result();
        echo json_encode($data);
    }

    public function cari_station()
    {
        $query = "SELECT coa_unit, nama_unit FROM station ORDER BY nama_unit ASC";

        $data = $this->db_logistik_center->query($query)->result();
        echo json_encode($data);
    }

    public function cari_kategori_st()
    {
        $station = $this->input->post('cmb_station');
        $query_coa = "SELECT noac, nama FROM noac WHERE general = '$station'";
        $data = $this->db_logistik_center->query($query_coa)->result();

        echo json_encode($data);
    }

    public function cari_sub_kategori()
    {
        $kategori_st = $this->input->post('cmb_kategori_st');
        $query_coa = "SELECT noac, nama FROM noac WHERE general = '$kategori_st'";
        $data = $this->db_logistik_center->query($query_coa)->result();

        echo json_encode($data);
    }

    function pilih_afd()
    {
        $tm_tbm = $this->input->post('tm_tbm');

        // $query = "SELECT * FROM afd WHERE tmtbm = '$tmtbm' AND AFD <> '' ORDER BY afd ASC";
        // $data = $this->db_logistik_pt->query($query)->result();

        // $query = "SELECT DISTINCT(afd) FROM masterblok WHERE afd <> '00' ORDER BY afd ASC";
        $query = "SELECT DISTINCT(afd) FROM item_pekerjaan WHERE kategori='$tm_tbm' ORDER BY afd ASC";
        $data = $this->db_personalia->query($query)->result();
        echo json_encode($data);
    }

    function pilih_blok_sub()
    {
        $tm_tbm = $this->input->post('tm_tbm');
        $afd_unit = $this->input->post('afd_unit');
        $blok_sub = $this->input->post('blok_sub');
        switch ($tm_tbm) {
            case 'TM':
                $tmtbm = 'TM';
                break;
            default:
                $tmtbm = 'TBM';
                break;
        }
        $query_master_blok = "SELECT DISTINCT(blok) FROM masterblok WHERE afd = '$afd_unit'";
        $data = $this->db_personalia->query($query_master_blok)->result();

        // $data = array('data_thn_tanam'=>$data_thn_tanam,'data_master_blok'=>$data_master_blok);
        echo json_encode($data);
    }

    function pilih_tahun_tanam()
    {
        $tm_tbm = $this->input->post('tm_tbm');
        $afd_unit = $this->input->post('afd_unit');
        $blok_sub = $this->input->post('blok_sub');
        switch ($tm_tbm) {
            case 'TM':
                $tmtbm = 'TM';
                break;
            default:
                $tmtbm = 'TBM';
                break;
        }
        // $query_thn_tanam = "SELECT DISTINCT thn_tanam FROM tahun_tanam WHERE tmtbm = '$tmtbm' AND AFD = '$afd_unit' ORDER BY thn_tanam ASC";
        // $data_thn_tanam = $this->db_logistik_pt->query($query_thn_tanam)->result();
        $query_thn_tanam = "SELECT DISTINCT(tahuntanam) FROM masterblok WHERE afd = '$afd_unit' AND blok = '$blok_sub' ORDER BY tahuntanam ASC";
        $data = $this->db_personalia->query($query_thn_tanam)->result();

        echo json_encode($data);
    }

    function pilih_bahan()
    {
        $tm_tbm = $this->input->post('tm_tbm');
        $afd_unit = $this->input->post('afd_unit');
        $blok_sub = $this->input->post('blok_sub');
        $thn_tanam = $this->input->post('thn_tanam');
        // switch ($tm_tbm) {
        //     case 'TM':
        //         $tmtbm = 'TM';
        //         break;
        //     default:
        //         $tmtbm = 'TBM';
        //         break;
        // }
        // $query = "SELECT DISTINCT ket, coa_material FROM tahun_tanam WHERE tmtbm = '$tmtbm' AND AFD = '$afd_unit' AND thn_tanam = '$thn_tanam' ORDER BY thn_tanam ASC";
        $query = "SELECT DISTINCT(coa_material) FROM tahun_tanam WHERE tmtbm = '$tm_tbm' AND AFD = '$afd_unit' AND thn_tanam = '$thn_tanam'";
        $data_coa_material = $this->db_logistik_pt->query($query)->result();
        $data = array();
        foreach ($data_coa_material as $list_coa_material) {
            $data_coa = array();
            $noac = $list_coa_material->coa_material;
            $query_coa = "SELECT noac, nama FROM noac WHERE noac = '$noac'";
            $get_coa = $this->db_logistik_center->query($query_coa)->row();
            $data_coa[] = $get_coa->noac;
            $data_coa[] = $get_coa->nama;
            array_push($data, $data_coa);
        }
        echo json_encode($data);
    }

    public function data()
    {
        $list = $this->M_databpb->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $hasil) {
            $row   = array();
            $id = $hasil->id;

            $nobpb = "'" . $hasil->nobpb . "'";
            $norefbpb = "'" . $hasil->norefbpb . "'";
            $prove = "'" . $hasil->approval . "'";
            if ($hasil->batal == 1) {
                # code...
                $approval = '<a href="javascript:;" id="a_appproval">
                                <button class="btn btn-primary btn-xs" id="btn_approval" name="btn_approval" data-toggle="tooltip" data-placement="top" title="Approval" onClick="modalListApproval(' . $nobpb . ',' . $norefbpb . ',' .  $prove . ')" disabled> Approval
                                </button>
                            </a>';
            } else {
                $approval = '<a href="javascript:;" id="a_appproval">
                                <button class="btn btn-primary btn-xs" id="btn_approval" name="btn_approval" data-toggle="tooltip" data-placement="top" title="Approval" onClick="modalListApproval(' . $nobpb . ',' . $norefbpb . ',' .  $prove . ')"> Approval
                                </button>
                            </a>';
                # code...
            }

            if ($hasil->approval == '0') {
                if ($hasil->batal == 1) {
                    # code...
                    $print = "";
                    $ubah = '<button type="button" id="detail" data-id="' . $hasil->norefbpb . '" data-batal="' . $hasil->batal . '"  onClick="return false" class="btn btn-success btn-xs fa fa-eye" title="Detail" style="padding-right:8px;"></button>
                    <a href="' . site_url('Bpb/cetak/' . $hasil->nobpb . '/' . $id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_bpb"></a>';
                } else {
                    # code...
                    $print = "";
                    $ubah = '<button type="button" id="detail" data-id="' . $hasil->norefbpb . '" data-batal="' . $hasil->batal . '"  onClick="return false" class="btn btn-success btn-xs fa fa-eye" title="Detail" style="padding-right:8px;"></button>
                    <a href="' . site_url('Bpb/detail_bpb/' . $hasil->nobpb . '/' . $id) . '" target="_blank" class="btn btn-info fa fa-edit btn-xs" data-toggle="tooltip" data-placement="top" title="Update BPB" id="btn_detail_barang"></a>
                    <a href="' . site_url('Bpb/cetak/' . $hasil->nobpb . '/' . $id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_bpb"></a>';
                }
            } elseif ($hasil->approval == '2') {
                if ($hasil->batal == 1) {
                    # code...
                    $print = "";
                    $ubah = '<button type="button" id="detail" data-id="' . $hasil->norefbpb . '" data-batal="' . $hasil->batal . '" onClick="return false" class="btn btn-success btn-xs fa fa-eye" title="Detail" style="padding-right:8px;"></button>
                    <a href="' . site_url('Bpb/cetak/' . $hasil->nobpb . '/' . $id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_bpb"></a>';
                } else {
                    # code...
                    $print = "";
                    $ubah = '<button type="button" id="detail" data-id="' . $hasil->norefbpb . '" data-batal="' . $hasil->batal . '"  onClick="return false" class="btn btn-success btn-xs fa fa-eye" title="Detail" style="padding-right:8px;"></button>
                    <a href="' . site_url('Bpb/detail_bpb/' . $hasil->nobpb . '/' . $id) . '" target="_blank" class="btn btn-info fa fa-edit btn-xs" data-toggle="tooltip" data-placement="top" title="Update BPB" id="btn_detail_barang"></a>
                    <a href="' . site_url('Bpb/cetak/' . $hasil->nobpb . '/' . $id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_bpb"></a>';
                }
            } else {
                $print = '<button type="button" id="detail" data-id="' . $hasil->norefbpb . '" data-batal="' . $hasil->batal . '" onClick="return false" class="btn btn-success btn-xs fa fa-eye" title="Detail" style="padding-right:8px;"></button>
                <a href="' . site_url('Bpb/cetak/' . $hasil->nobpb . '/' . $id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_bpb"></a>';
                $ubah = "";
            }


            if ($hasil->approval == '0') {
                if ($hasil->batal == 1) {
                    # code...
                    $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-danger">DIBATALKAN</span></h5>';
                } else {
                    # code...
                    $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-warning">DALAM<br>PROSES</span></h5>';
                }
            } else if ($hasil->approval == '2') {
                if ($hasil->batal == 1) {
                    $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-danger">DIBATALKAN</span></h5>';
                    # code...
                } else {
                    # code...
                    $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-info">SEBAGIAN</span></h5>';
                }
            } else {
                if ($hasil->batal == 1) {
                    $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-danger">DIBATALKAN</span></h5>';
                    # code...
                } else {
                    # code...
                    $stat = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-success">Approved</span></h5>';
                }
            }


            $no++;
            $row[] = $ubah . $print;
            $row[] =  $no . ".";
            $row[] = $hasil->norefbpb;
            $query_bpbitem = "SELECT nabar FROM bpbitem WHERE nobpb = '$hasil->nobpb'";
            $data_bpbitem = $this->db_logistik_pt->query($query_bpbitem)->result();
            $data_detail = array();
            $data_detail_nama = array();
            foreach ($data_bpbitem as $bpbitem) {
                // $row_detail = array();
                // $row_detail[] = $masukitem->kodebartxt;
                array_push($data_detail_nama, $bpbitem->nabar);
            }
            $row[] = join(", ", $data_detail_nama);
            $row[] = $hasil->keperluan;
            $row[] = $hasil->tglinput;
            $row[] = $hasil->user;
            // $row[] = $approval_ktu;
            // $row[] = $approval_mgr;
            // $row[] = $approval_gm;
            $row[] = $stat;
            if ($this->session->userdata('level') == 'KTU' or $this->session->userdata('level') == 'Mill Manager') {
                # code...
                $row[] = $approval;
            }
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_databpb->count_all(),
            "recordsFiltered" => $this->M_databpb->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


    public function list_acc_beban()
    {
        $dt = $this->input->post('dt');
        $pt = $this->input->post('pt');
        $cmb_bahan = $this->input->post('cmb_bahan');
        $mutasi_pt = $this->input->post('mutasi_pt');
        $mutasi_lokal = $this->input->post('mutasi_lokal');
        $devisi = $this->input->post('devisi');
        $sub_kategori = $this->input->post('sub_kategori');
        $this->M_bpb->where_datatables($dt, $pt, $cmb_bahan, $mutasi_pt, $mutasi_lokal, $devisi, $sub_kategori);
        $list = $this->M_bpb->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->noac;
            $row[] = $field->nama;
            $row[] = $field->type;
            $row[] = $field->group;


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_bpb->count_all(),
            "recordsFiltered" => $this->M_bpb->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
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
            $row[] =  '<p style="word-break: break-word; margin-top:0px; margin-bottom: 0px;">' . $d->nabar . '</p>';
            $row[] =  '<p style="word-break: break-word; margin-top:0px; margin-bottom: 0px;">' . $d->kodebar . '</p>';
            $row[] =  $d->qty;
            $row[] =  $d->devisi;

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

    public function detail_bpb()
    {
        $this->template->load('template', 'v_edit');
    }

    function simpan_rinci_bpb()
    {
        $data = $this->M_bpb->simpan_rinci_bpb();
        echo json_encode($data);
    }

    function hapus_rinci()
    {

        $id_bpbitem = $this->input->post('hidden_id_bpbitem');
        $mut_pt = $this->input->post('hidden_mutasi_pt');
        $mut_lok = $this->input->post('hidden_mutasi_lokal');

        //histori
        $get_bpb = $this->db_logistik_pt->query("SELECT * FROM bpbitem WHERE id='$id_bpbitem'")->row();
        $databpbitem['kodebar']       = $get_bpb->kodebar;
        $databpbitem['nabar']         = $get_bpb->nabar;
        $databpbitem['satuan']        = $get_bpb->satuan;
        $databpbitem['grp']           = $get_bpb->grp;
        $databpbitem['alokasi']       = $get_bpb->alokasi;
        $databpbitem['kodept']        = $this->session->userdata('kode_pt');
        $databpbitem['nobpb']         = $get_bpb->nobpb;
        $databpbitem['norefbpb']      = $get_bpb->norefbpb;
        $databpbitem['pt']            = $this->session->userdata('pt');
        $databpbitem['kode']          = $this->session->userdata('kode_pt');
        $databpbitem['devisi']        = $get_bpb->devisi;
        $databpbitem['kode_dev']      = $get_bpb->kode_dev;
        $databpbitem['qty']           = $get_bpb->qty;
        $databpbitem['qty_disetujui'] = $get_bpb->qty_disetujui;
        $databpbitem['tglbpb']        = $get_bpb->tglbpb . date(' H:i:s');
        $databpbitem['tglinput']      = $get_bpb->tglinput;
        $databpbitem['jaminput']      = $get_bpb->jaminput;
        $databpbitem['periode']       = $get_bpb->periode;
        $databpbitem['ket']           = $get_bpb->ket;
        $databpbitem['afd']           = $get_bpb->afd;
        $databpbitem['blok']          = $get_bpb->blok;
        $databpbitem['tmtbm']           = $get_bpb->tmtbm;
        $databpbitem['thntanam']          = $get_bpb->thntanam;
        $databpbitem['noadjust']      = $get_bpb->noadjust;
        $databpbitem['kodebebantxt']  = $get_bpb->kodebeban;
        $databpbitem['ketbeban']      = $get_bpb->ketbeban;
        $databpbitem['kodesubtxt']    = $get_bpb->kodesubtxt;
        $databpbitem['ketsub']        = $get_bpb->ketsub;
        $databpbitem['batal']         = $get_bpb->batal;
        $databpbitem['alasan_batal']  = $get_bpb->alasan_batal;
        $databpbitem['USER']          = $this->session->userdata('user');
        $databpbitem['cetak']         = $get_bpb->cetak;
        $databpbitem['posting']       = $get_bpb->posting;
        $databpbitem['keterangan_transaksi'] = 'UPDATE ITEM BPB';
        $databpbitem['log'] = $this->session->userdata('user') . " mengubah ITEM BPB $get_bpb->nobpb";
        $databpbitem['tgl_transaksi'] = date("Y-m-d H:i:s");
        $databpbitem['user_transaksi'] = $this->session->userdata('user');
        $databpbitem['client_ip'] = $this->input->ip_address();
        $databpbitem['client_platform'] = $this->platform->agent();
        $historiItem = $this->db_logistik_pt->insert('bpbitem_history', $databpbitem);
        //end

        if ($mut_pt == 'mutasi_pt' || $mut_lok == 'mutasi_lokal') {
            # code...
            $noref = $this->db_logistik_pt->query("SELECT norefbpb FROM bpbitem WHERE id='$id_bpbitem'")->row();
            $data_delete_center = $this->db_logistik_center->delete('bpbitem_mutasi', array('norefbpb' => $noref->norefbpb));
            $data_delete_approval_center = $this->db_logistik_center->delete('approval_bpb', array('id_bpbitem' => $id_bpbitem));
        }


        $data_delete = $this->db_logistik_pt->delete('bpbitem', array('id' => $id_bpbitem));
        $data_delete_approval = $this->db_logistik_pt->delete('approval_bpb', array('id_bpbitem' => $id_bpbitem));

        if ($data_delete === TRUE && $data_delete_approval === TRUE) {
            $data = TRUE;
        } else {
            $data = FALSE;
        }
        echo json_encode($data);
    }

    function hapus_all()
    {

        $id_bpb = $this->input->post('hidden_id_bpb');
        $id_bpbitem = $this->input->post('hidden_id_bpbitem');
        $mut_pt = $this->input->post('hidden_mutasi_pt');
        $mut_lok = $this->input->post('hidden_mutasi_lokal');

        //histori
        $get_bpb = $this->db_logistik_pt->query("SELECT * FROM bpb WHERE id='$id_bpb'")->row();
        $databpb['nobpb']           = $get_bpb->nobpb;
        $databpb['norefbpb']        = $get_bpb->norefbpb;
        $databpb['nobkb_ro']        = $get_bpb->nobkb_ro;
        $databpb['nopo_ro']         = $get_bpb->nopo_ro;
        $databpb['tglbpb']          = $get_bpb->tglbpb . date(' H:i:s');
        $databpb['tglinput']        = $get_bpb->tglinput;
        $databpb['jaminput']        = $get_bpb->jaminput;
        $databpb['periode']         = $get_bpb->periode;
        $databpb['alokasi']         = $get_bpb->alokasi;
        $databpb['pt']              = $this->session->userdata('pt');
        $databpb['kode']            = $this->session->userdata('kode_pt');
        $databpb['devisi']          = $get_bpb->devisi;
        $databpb['kode_dev']        = $get_bpb->kode_dev;
        $databpb['keperluan']       = $get_bpb->keperluan;
        $databpb['bag']             = $get_bpb->bag;
        $databpb['batal']           = $get_bpb->batal;
        $databpb['alasan_batal']    = $get_bpb->alasan_batal;
        $databpb['USER']            = $this->session->userdata('user');
        $databpb['cetak']           = $get_bpb->cetak;
        $databpb['posting']         = $get_bpb->posting;
        $databpb['approval']        = $get_bpb->approval;
        $databpb['req_rev_qty']        = $get_bpb->req_rev_qty;
        $databpb['bhn_bakar']        = $get_bpb->bhn_bakar;
        $databpb['jn_alat']        = $get_bpb->jn_alat;
        $databpb['no_kode']        = $get_bpb->no_kode;
        $databpb['hm_km']        = $get_bpb->hm_km;
        $databpb['lok_kerja']        = $get_bpb->lok_kerja;
        $databpb['status_mutasi']        = $get_bpb->status_mutasi;
        $databpb['keterangan_transaksi'] = 'DELETE BPB';
        $databpb['log'] = $this->session->userdata('user') . " mengahpus BPB $get_bpb->nobpb";
        $databpb['tgl_transaksi'] = date("Y-m-d H:i:s");
        $databpb['user_transaksi'] = $this->session->userdata('user');
        $databpb['client_ip'] = $this->input->ip_address();
        $databpb['client_platform'] = $this->platform->agent();
        $historibpb = $this->db_logistik_pt->insert('bpb_history', $databpb);

        $get_itembpb = $this->db_logistik_pt->query("SELECT * FROM bpbitem WHERE id='$id_bpbitem'")->row();
        $databpbitem['kodebar']       = $get_itembpb->kodebar;
        $databpbitem['nabar']         = $get_itembpb->nabar;
        $databpbitem['satuan']        = $get_itembpb->satuan;
        $databpbitem['grp']           = $get_itembpb->grp;
        $databpbitem['alokasi']       = $get_itembpb->alokasi;
        $databpbitem['kodept']        = $this->session->userdata('kode_pt');
        $databpbitem['nobpb']         = $get_itembpb->nobpb;
        $databpbitem['norefbpb']      = $get_itembpb->norefbpb;
        $databpbitem['pt']            = $this->session->userdata('pt');
        $databpbitem['kode']          = $this->session->userdata('kode_pt');
        $databpbitem['devisi']        = $get_itembpb->devisi;
        $databpbitem['kode_dev']      = $get_itembpb->kode_dev;
        $databpbitem['qty']           = $get_itembpb->qty;
        $databpbitem['qty_disetujui'] = $get_itembpb->qty_disetujui;
        $databpbitem['tglbpb']        = $get_itembpb->tglbpb . date(' H:i:s');
        $databpbitem['tglinput']      = $get_itembpb->tglinput;
        $databpbitem['jaminput']      = $get_itembpb->jaminput;
        $databpbitem['periode']       = $get_itembpb->periode;
        $databpbitem['ket']           = $get_itembpb->ket;
        $databpbitem['afd']           = $get_itembpb->afd;
        $databpbitem['blok']          = $get_itembpb->blok;
        $databpbitem['tmtbm']           = $get_itembpb->tmtbm;
        $databpbitem['thntanam']          = $get_itembpb->thntanam;
        $databpbitem['noadjust']      = $get_itembpb->noadjust;
        $databpbitem['kodebebantxt']  = $get_itembpb->kodebeban;
        $databpbitem['ketbeban']      = $get_itembpb->ketbeban;
        $databpbitem['kodesubtxt']    = $get_itembpb->kodesubtxt;
        $databpbitem['ketsub']        = $get_itembpb->ketsub;
        $databpbitem['batal']         = $get_itembpb->batal;
        $databpbitem['alasan_batal']  = $get_itembpb->alasan_batal;
        $databpbitem['USER']          = $this->session->userdata('user');
        $databpbitem['cetak']         = $get_itembpb->cetak;
        $databpbitem['posting']       = $get_itembpb->posting;
        $databpbitem['keterangan_transaksi'] = 'DELETE ITEM BPB';
        $databpbitem['log'] = $this->session->userdata('user') . " menghapus ITEM BPB $get_itembpb->nobpb";
        $databpbitem['tgl_transaksi'] = date("Y-m-d H:i:s");
        $databpbitem['user_transaksi'] = $this->session->userdata('user');
        $databpbitem['client_ip'] = $this->input->ip_address();
        $databpbitem['client_platform'] = $this->platform->agent();
        $historiItem = $this->db_logistik_pt->insert('bpbitem_history', $databpbitem);
        //end

        if ($mut_pt == 'mutasi_pt' || $mut_lok == 'mutasi_lokal') {
            # code...
            $noref = $this->db_logistik_pt->query("SELECT norefbpb FROM bpbitem WHERE id='$id_bpbitem'")->row();
            $data_delete_center = $this->db_logistik_center->delete('bpbitem_mutasi', array('norefbpb' => $noref->norefbpb));
            $data_delete_approval_center = $this->db_logistik_center->delete('approval_bpb', array('id_bpbitem' => $id_bpbitem));
            $data_bpb_center = $this->db_logistik_center->delete('bpb_mutasi', array('norefbpb' => $noref->norefbpb));
        }


        $data_bpb = $this->db_logistik_pt->delete('bpb', array('id' => $id_bpb));
        $data_delete = $this->db_logistik_pt->delete('bpbitem', array('id' => $id_bpbitem));
        $data_delete_approval = $this->db_logistik_pt->delete('approval_bpb', array('id_bpbitem' => $id_bpbitem));


        if ($data_delete === TRUE && $data_bpb === TRUE && $data_delete_approval === TRUE) {
            $data = TRUE;
        } else {
            $data = FALSE;
        }
        echo json_encode($data);
    }

    function batalBPB()
    {
        $id_bpb = $this->input->post('idbpb');
        $alasan = $this->input->post('alasan');
        $noref = $this->input->post('noref');

        //histori
        $get_bpb = $this->db_logistik_pt->query("SELECT * FROM bpb WHERE id='$id_bpb'")->row();
        $databpb['nobpb']           = $get_bpb->nobpb;
        $databpb['norefbpb']        = $get_bpb->norefbpb;
        $databpb['nobkb_ro']        = $get_bpb->nobkb_ro;
        $databpb['nopo_ro']         = $get_bpb->nopo_ro;
        $databpb['tglbpb']          = $get_bpb->tglbpb . date(' H:i:s');
        $databpb['tglinput']        = $get_bpb->tglinput;
        $databpb['jaminput']        = $get_bpb->jaminput;
        $databpb['periode']         = $get_bpb->periode;
        $databpb['alokasi']         = $get_bpb->alokasi;
        $databpb['pt']              = $this->session->userdata('pt');
        $databpb['kode']            = $this->session->userdata('kode_pt');
        $databpb['devisi']          = $get_bpb->devisi;
        $databpb['kode_dev']        = $get_bpb->kode_dev;
        $databpb['keperluan']       = $get_bpb->keperluan;
        $databpb['bag']             = $get_bpb->bag;
        $databpb['batal']           = $get_bpb->batal;
        $databpb['alasan_batal']    = $get_bpb->alasan_batal;
        $databpb['USER']            = $this->session->userdata('user');
        $databpb['cetak']           = $get_bpb->cetak;
        $databpb['posting']         = $get_bpb->posting;
        $databpb['approval']        = $get_bpb->approval;
        $databpb['req_rev_qty']        = $get_bpb->req_rev_qty;
        $databpb['bhn_bakar']        = $get_bpb->bhn_bakar;
        $databpb['jn_alat']        = $get_bpb->jn_alat;
        $databpb['no_kode']        = $get_bpb->no_kode;
        $databpb['hm_km']        = $get_bpb->hm_km;
        $databpb['lok_kerja']        = $get_bpb->lok_kerja;
        $databpb['status_mutasi']        = $get_bpb->status_mutasi;
        $databpb['keterangan_transaksi'] = 'BATAL BPB';
        $databpb['log'] = $this->session->userdata('user') . " membatalkan BPB $get_bpb->nobpb";
        $databpb['tgl_transaksi'] = date("Y-m-d H:i:s");
        $databpb['user_transaksi'] = $this->session->userdata('user');
        $databpb['client_ip'] = $this->input->ip_address();
        $databpb['client_platform'] = $this->platform->agent();
        $historibpb = $this->db_logistik_pt->insert('bpb_history', $databpb);
        //end

        $mutasi_pt = $this->input->post('mutasi_pt');
        if ($mutasi_pt == 'mutasi_pt') {
            $data = $this->M_bpb->batalbpbMut($id_bpb, $noref, $alasan);
        } else {
            $data = $this->M_bpb->batalbpb($id_bpb, $noref, $alasan);
        }

        echo json_encode($data);
    }

    function batal()
    {
        $id_bpb = $this->input->post('id');
        $no_bpb = $this->input->post('no_bpb');
        $alasan =  $this->input->post('alasan');

        // $user = $this->session->userdata('user');
        // $ip = $this->input->ip_address();
        // $platform = $this->platform->agent();

        // $get_bpb = $this->db_logistik_pt->get_where('bpb', array('id' => $id_bpb, 'nobpb' => $no_bpb))->row();

        // $get_bpbitem = $this->db_logistik_pt->get_where('bpbitem', array('nobpb' => $no_bpb))->result();

        $dataedit['batal'] = "1";
        $dataedit['alasan_batal'] = $alasan;
        $this->db_logistik_pt->set($dataedit);
        $this->db_logistik_pt->where('id', $id_bpb);
        $this->db_logistik_pt->where('nobpb', $no_bpb);
        $this->db_logistik_pt->update('bpb');
        if ($this->db_logistik_pt->affected_rows() > 0) {
            $bool_bpb = TRUE;
        } else {
            $bool_bpb = FALSE;
        }

        $dataedit_bpbitem['batal'] = '1';
        $dataedit_bpbitem['alasan_batal'] = $alasan;
        $this->db_logistik_pt->set($dataedit_bpbitem);
        $this->db_logistik_pt->where('nobpb', $no_bpb);
        $this->db_logistik_pt->update('bpbitem');

        if ($this->db_logistik_pt->affected_rows() > 0) {
            $bool_bpbitem = TRUE;
        } else {
            $bool_bpbitem = FALSE;
        }

        if ($bool_bpb === TRUE && $bool_bpbitem === TRUE) {
            $data = TRUE;
        } else {
            $data = FALSE;
        }

        echo json_encode($data);
    }

    function cancel_ubah_rinci()
    {
        // $no_bpb = $this->input->post('hidden_no_bpb');
        // $id_bpb = $this->input->post('hidden_id_bpb');
        $hidden_id_bpbitem = $this->input->post('hidden_id_bpbitem');

        // $query_bpb = "SELECT * FROM bpb WHERE nobpb = '$no_bpb' AND id = '$id_bpb'";
        // $data_bpb = $this->db_logistik_pt->query($query_bpb)->row();

        $query_bpbitem = "SELECT * FROM bpbitem WHERE id = '$hidden_id_bpbitem'";
        $data_bpbitem = $this->db_logistik_pt->query($query_bpbitem)->row();
        echo json_encode(array('data_bpbitem' => $data_bpbitem));
    }

    function ubah_rinci_bpb()
    {
        $data = $this->M_bpb->ubah_rinci_bpb();
        echo json_encode($data);
    }

    function get_devisi()
    {
        $kodedev = $this->input->post('kodedev');
        $data = $this->db_logistik_pt->query("SELECT PT FROM tb_devisi WHERE kodetxt='$kodedev'")->row();
        echo json_encode($data);
    }

    function list_barang()
    {
        // $kodedev = $this->input->post('kode_dev');
        // $this->M_brg->where_datatables($kodedev);
        $list = $this->M_brg->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $no++;
            $row = array();
            $row[] = '<a href="javascript:;" id="btn_data_barang">
            <button class="btn btn-success btn-xs" id="data_barang" name="data_barang" data-toggle="tooltip" data-placement="top" title="Pilih" onClick="return false">Pilih</button></a>';
            $row[] = $no;
            $row[] = $field->kodebar;
            $row[] = $field->nabar;
            $row[] = $field->grp;
            $row[] = $field->satuan;
            $row[] = $field->txtperiode;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_brg->count_all(),
            "recordsFiltered" => $this->M_brg->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function cari_devisi()
    {
        $lokasi = $this->session->userdata('status_lokasi');
        if ($lokasi == 'SITE') {
            $query = "SELECT PT, kodetxt FROM pt_copy WHERE kodetxt IN ('06', '07') ORDER BY kodetxt ASC";
        } else if ($lokasi == 'HO') {
            $query = "SELECT PT, kodetxt FROM pt_copy ORDER BY kodetxt ASC";
        } else {
            $query = "SELECT PT, kodetxt FROM pt_copy WHERE PT LIKE '%$lokasi%' ORDER BY kodetxt ASC";
        }

        $data = $this->db_logistik_pt->query($query)->result();
        echo json_encode($data);
    }

    function sum_stok()
    {
        $kodebar = $this->input->post('kodbar');
        $kode_dev = $this->input->post('kode_dev');
        $hidden_txtperiode = $this->input->post('hidden_txtperiode');
        $data = $this->M_bpb->get_stok($kodebar, $hidden_txtperiode, $kode_dev);
        echo json_encode($data);
    }

    function sum_stok_booking()
    {
        $id = $this->input->post('kodbar');

        $kode_dev = $this->input->post('kode_dev');

        $query_booking = "SELECT SUM(qty) as stokbooking FROM bpbitem WHERE kodebar = '$id' AND kode_dev='$kode_dev' AND batal <> 1";
        $query_booking2 = "SELECT SUM(qty2) as stokbooking2 FROM keluarbrgitem WHERE kodebar = '$id' AND kode_dev='$kode_dev' AND batal <> 1 AND nobpb NOT LIKE '%MUT%'";
        $get_booking = $this->db_logistik_pt->query($query_booking)->row();
        $get_booking2 = $this->db_logistik_pt->query($query_booking2)->row();

        if (empty($get_booking->stokbooking)) {
            $data = 0;
        } else {
            $data = $get_booking->stokbooking - $get_booking2->stokbooking2;
        }

        echo json_encode($data);
    }

    function list_bpbitem()
    {
        $nobpb = $this->input->post('nobpb');
        $norefbpb = $this->input->post('norefbpb');
        $this->M_listbpb->where_datatables($nobpb, $norefbpb);
        $list = $this->M_listbpb->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $hasil) {
            $row   = array();
            $id = $hasil->id;

            $nobpb = "'" . $hasil->nobpb . "'";
            $norefbpb = "'" . $hasil->norefbpb . "'";
            $kodebar = "'" . $hasil->kodebar . "'";

            $AsistenAfd = "'AsistenAfd'";
            $KepalaKebun = "'KepalaKebun'";
            $KasieAgronomi = "'KasieAgronomi'";
            $KTU = "'KTU'";
            // $MGR = "'MGR'";
            $GM = "'GM'";

            $setuju = "'setuju'";
            $tidaksetuju = "'tidaksetuju'";
            $mengetahui = "'mengetahui'";
            $revqty = "'revqty'";

            $kode_level_sesi = $this->session->userdata('kode_level');
            // $lokasi = $this->session->userdata('status_lokasi');
            // $user_sesi = $this->session->userdata('user');
            $nobpb_query = $hasil->nobpb;
            $norefbpb_query = $hasil->norefbpb;
            $kodebar_query = $hasil->kodebar;
            $qty_diminta = $hasil->qty;

            /***** ASISTEN AFD *****/
            /***************/
            $query_status_asisten_afd = "SELECT status_asisten_afd, tgl_asisten_afd FROM approval_bpb WHERE status_asisten_afd <> '0' AND no_bpb = '$nobpb_query' AND norefbpb = '$norefbpb_query' AND kodebar = '$kodebar_query'";
            $get_status_asisten_afd = $this->db_logistik_pt->query($query_status_asisten_afd);
            if ($get_status_asisten_afd->num_rows() > 0) {
                $get_status_approval_asisten_afd = $this->db_logistik_pt->query($query_status_asisten_afd)->row();
                if ($get_status_approval_asisten_afd->status_asisten_afd ==  "1") {
                    $konfirmasi_asisten_afd = "<strong style='color:green;'>DISETUJUI <br/>" . $get_status_approval_asisten_afd->tgl_asisten_afd . "</strong><br/>";
                } else if ($get_status_approval_asisten_afd->status_asisten_afd ==  "2") {
                    $konfirmasi_asisten_afd = "<strong style='color:red'>TDK DISETUJUI <br/>" . $get_status_approval_asisten_afd->tgl_asisten_afd . "</strong><br/>";
                }
            } else {
                $list_level_approval_asisten_afd = "SELECT bpb_appr_asisten_afd FROM list_level_approval WHERE bpb_appr_asisten_afd = '$kode_level_sesi'";
                $get_appr_asisten_afd = $this->db_logistik_pt->query($list_level_approval_asisten_afd)->num_rows();

                if ($get_appr_asisten_afd > 0) {
                    $konfirmasi_asisten_afd = '<a href="javascript:;" id="a_appproval">
                                <button class="btn btn-success btn-xs fa fa-check" id="btn_setuju" name="btn_setuju" data-toggle="tooltip" data-placement="top" title="Setuju" onClick="konfirmasi(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $AsistenAfd . ',' . $setuju . ')">
                                </button>
                            </a>
                            <a href="javascript:;" id="a_appproval">
                                <button class="btn btn-danger btn-xs fa fa-times" id="btn_tdk_setuju" name="btn_tdk_setuju" data-toggle="tooltip" data-placement="top" title="Tdk Setuju" onClick="konfirmasi(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $AsistenAfd . ',' . $tidaksetuju . ')">
                                </button>
                            </a>
                            <!--a href="javascript:;" id="a_appproval">
                                <button class="btn btn-warning btn-xs" id="btn_rev_qty" name="btn_rev_qty" data-toggle="tooltip" data-placement="top" title="Rev Qty" onClick="revQty(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $AsistenAfd . ',' . $revqty . ')"> Rev Qty
                                </button>
                            </a-->
                            ';
                } else {
                    $konfirmasi_asisten_afd = "";
                }
            }

            /***** KEPALA KEBUN *****/
            /***************/
            $query_status_kepala_kebun = "SELECT status_kepala_kebun, tgl_kepala_kebun FROM approval_bpb WHERE status_kepala_kebun <> '0' AND no_bpb = '$nobpb_query' AND norefbpb = '$norefbpb_query' AND kodebar = '$kodebar_query'";
            $get_status_kepala_kebun = $this->db_logistik_pt->query($query_status_kepala_kebun)->num_rows();
            if ($get_status_kepala_kebun > 0) {
                $get_status_approval_kepala_kebun = $this->db_logistik_pt->query($query_status_kepala_kebun)->row();
                // var_dump($get_status_approval_kepala_kebun->status_kepala_kebun);
                if ($get_status_approval_kepala_kebun->status_kepala_kebun ==  "1") {
                    // var_dump($get_status_approval_kepala_kebun->status_kepala_kebun);
                    $konfirmasi_kepala_kebun = "<strong style='color:green;'>DISETUJUI <br/>" . $get_status_approval_kepala_kebun->tgl_kepala_kebun . "</strong><br/>";
                } else if ($get_status_approval_kepala_kebun->status_kepala_kebun ==  "2") {
                    $konfirmasi_kepala_kebun = "<strong style='color:red'>TDK DISETUJUI <br/>" . $get_status_approval_kepala_kebun->tgl_kepala_kebun . "</strong><br/>";
                }
            } else {
                $list_level_approval_kepala_kebun = "SELECT bpb_appr_kepala_kebun FROM list_level_approval WHERE bpb_appr_kepala_kebun = '$kode_level_sesi'";
                $get_appr_kepala_kebun = $this->db_logistik_pt->query($list_level_approval_kepala_kebun)->num_rows();

                if ($get_appr_kepala_kebun > 0) {
                    $konfirmasi_kepala_kebun = '<a href="javascript:;" id="a_appproval">
                                <button class="btn btn-success btn-xs fa fa-check" id="btn_setuju" name="btn_setuju" data-toggle="tooltip" data-placement="top" title="Setuju" onClick="konfirmasi(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $KepalaKebun . ',' . $setuju . ')">
                                </button>
                            </a>
                            <a href="javascript:;" id="a_appproval">
                                <button class="btn btn-danger btn-xs fa fa-times" id="btn_tdk_setuju" name="btn_tdk_setuju" data-toggle="tooltip" data-placement="top" title="Tdk Setuju" onClick="konfirmasi(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $KepalaKebun . ',' . $tidaksetuju . ')">
                                </button>
                            </a>
                            <a href="javascript:;" id="a_appproval">
                                <button class="btn btn-warning btn-xs" id="btn_rev_qty" name="btn_rev_qty" data-toggle="tooltip" data-placement="top" title="Rev Qty" onClick="revQty(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $KepalaKebun . ',' . $revqty . ')"> Rev Qty
                                </button>
                            </a>
                            ';
                } else {
                    $konfirmasi_kepala_kebun = "";
                }
            }

            /***** KASIE AGRONOMI *****/
            /***************/
            $query_status_kasie_agronomi = "SELECT status_kasie_agronomi, tgl_kasie_agronomi FROM approval_bpb WHERE status_kasie_agronomi <> '0' AND no_bpb = '$nobpb_query' AND norefbpb = '$norefbpb_query' AND kodebar = '$kodebar_query'";
            $get_status_kasie_agronomi = $this->db_logistik_pt->query($query_status_kasie_agronomi)->num_rows();

            if ($get_status_kasie_agronomi > 0) {
                $get_status_approval_kasie_agronomi = $this->db_logistik_pt->query($query_status_kasie_agronomi)->row();
                if ($get_status_approval_kasie_agronomi->status_kasie_agronomi ==  "3") {
                    $konfirmasi_kasie_agronomi = "<strong style='color:blue;'>MENGETAHUI <br/>" . $get_status_approval_kasie_agronomi->tgl_kasie_agronomi . "</strong><br/>";
                }
            } else {
                $list_level_approval_kasie_agronomi = "SELECT bpb_appr_kasie_agronomi FROM list_level_approval WHERE bpb_appr_kasie_agronomi = '$kode_level_sesi'";
                $get_appr_kasie_agronomi = $this->db_logistik_pt->query($list_level_approval_kasie_agronomi)->num_rows();

                if ($get_appr_kasie_agronomi > 0) {
                    $konfirmasi_kasie_agronomi = '<a href="javascript:;" id="a_appproval">
                                <button class="btn btn-info btn-xs" id="btn_konfirmasi_kasie_agronomi" name="btn_konfirmasi_kasie_agronomi" data-toggle="tooltip" data-placement="top" title="Mengetahui" onClick="konfirmasi(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $KasieAgronomi . ',' . $mengetahui . ')"> Mengetahui
                                </button>
                            </a>';
                } else {
                    $konfirmasi_kasie_agronomi = "";
                }
            }

            /***** KTU *****/
            /***************/
            // $query_status_ktu = "SELECT status_ktu, tgl_ktu FROM approval_bpb WHERE (status_ktu <> '0' AND status_asisten_afd = '1' AND status_kepala_kebun = '1') AND no_bpb = '$nobpb_query' AND norefbpb = '$norefbpb_query' AND kodebar = '$kodebar_query'";
            $query_status_ktu = "SELECT status_asisten_afd, status_kepala_kebun, status_ktu, tgl_ktu FROM approval_bpb WHERE status_ktu <> '0' AND no_bpb = '$nobpb_query' AND norefbpb = '$norefbpb_query' AND kodebar = '$kodebar_query'";
            $get_status_ktu = $this->db_logistik_pt->query($query_status_ktu);
            if ($get_status_ktu->num_rows() > 0) {
                $get_status_approval_ktu = $this->db_logistik_pt->query($query_status_ktu)->row();
                if ($get_status_approval_ktu->status_ktu ==  "1") {
                    $konfirmasi_ktu = "<strong style='color:green;'>DISETUJUI <br/>" . $get_status_approval_ktu->tgl_ktu . "</strong><br/>";
                } else if ($get_status_approval_ktu->status_ktu ==  "2") {
                    $konfirmasi_ktu = "<strong style='color:red'>TDK DISETUJUI <br/>" . $get_status_approval_ktu->tgl_ktu . "</strong><br/>";
                }
            } else {
                $query_status_asisten_afd_kabun = "SELECT status_asisten_afd, status_kepala_kebun, status_ktu, tgl_ktu FROM approval_bpb WHERE status_ktu = '0' AND no_bpb = '$nobpb_query' AND norefbpb = '$norefbpb_query' AND kodebar = '$kodebar_query'";
                $get_status_asisten_afd_kabun = $this->db_logistik_pt->query($query_status_asisten_afd_kabun)->row();

                // jika sudah disetujui Asisten AFD dan Kepala Kebun
                if (isset($get_status_asisten_afd_kabun)) {
                    if ($get_status_asisten_afd_kabun->status_asisten_afd == "1" && $get_status_asisten_afd_kabun->status_kepala_kebun == "1") {
                        $list_level_approval_ktu = "SELECT bpb_appr_ktu FROM list_level_approval WHERE bpb_appr_ktu = '$kode_level_sesi'";
                        $get_appr_ktu = $this->db_logistik_pt->query($list_level_approval_ktu)->num_rows();

                        if ($get_appr_ktu > 0) {
                            $konfirmasi_ktu = '<a href="javascript:;" id="a_appproval">
                                        <button class="btn btn-success btn-xs fa fa-check" id="btn_setuju" name="btn_setuju" data-toggle="tooltip" data-placement="top" title="Setuju" onClick="konfirmasi(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $KTU . ',' . $setuju . ')">
                                        </button>
                                    </a>
                                    <a href="javascript:;" id="a_appproval">
                                        <button class="btn btn-danger btn-xs fa fa-times" id="btn_tdk_setuju" name="btn_tdk_setuju" data-toggle="tooltip" data-placement="top" title="Tdk Setuju" onClick="konfirmasi(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $KTU . ',' . $tidaksetuju . ')">
                                        </button>
                                    </a>
                                    <a href="javascript:;" id="a_appproval">
                                        <button class="btn btn-warning btn-xs" id="btn_rev_qty" name="btn_rev_qty" data-toggle="tooltip" data-placement="top" title="Rev Qty" onClick="revQty(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $KTU . ',' . $revqty . ')"> Rev Qty
                                        </button>
                                    </a>
                                    ';
                        } else {
                            $konfirmasi_ktu = "";
                        }
                    } else {
                        $konfirmasi_ktu = "";
                    }
                } else {
                    $konfirmasi_ktu = "";
                }
            }

            /***** MGR *****/
            /***************/
            // $query_status_mgr = "SELECT status_mgr, tgl_mgr FROM approval_bpb WHERE status_mgr <> '0' AND no_bpb = '$nobpb_query' AND norefbpb = '$norefbpb_query' AND kodebar = '$kodebar_query'";
            // $get_status_mgr = $this->db_logistik_pt->query($query_status_mgr)->num_rows();

            // if($get_status_mgr > 0){
            //     $get_status_approval_mgr = $this->db_logistik_pt->query($query_status_mgr)->row();
            //     if($get_status_approval_mgr->status_mgr ==  "3"){
            //         $konfirmasi_mgr = "<strong style='color:blue;'>MENGETAHUI <br/>".$get_status_approval_mgr->tgl_mgr."</strong><br/>";
            //     }
            // }
            // else {
            //     $list_level_approval_mgr = "SELECT bpb_appr_mgr FROM list_level_approval WHERE bpb_appr_mgr = '$kode_level_sesi'";
            //     $get_appr_mgr = $this->db_logistik_pt->query($list_level_approval_mgr)->num_rows();

            //     if($get_appr_mgr > 0){
            //         $konfirmasi_mgr = '<a href="javascript:;" id="a_appproval">
            //                     <button class="btn btn-info btn-xs" id="btn_mengetahui" name="btn_mengetahui" data-toggle="tooltip" data-placement="top" title="Mengetahui" onClick="konfirmasi('.$nobpb.','.$norefbpb.','.$kodebar.','.$MGR.','.$mengetahui.')"> Mengetahui
            //                     </button>
            //                 </a>';
            //     }
            //     else {
            //         $konfirmasi_mgr = "";
            //     }
            // }

            /***** GM *****/
            /***************/
            $query_status_gm = "SELECT status_gm, tgl_gm FROM approval_bpb WHERE status_gm <> '0' AND no_bpb = '$nobpb_query' AND norefbpb = '$norefbpb_query' AND kodebar = '$kodebar_query'";
            $get_status_gm = $this->db_logistik_pt->query($query_status_gm)->num_rows();

            if ($get_status_gm > 0) {
                $get_status_approval_gm = $this->db_logistik_pt->query($query_status_gm)->row();
                if ($get_status_approval_gm->status_gm ==  "3") {
                    $konfirmasi_gm = "<strong style='color:blue;'>MENGETAHUI <br/>" . $get_status_approval_gm->tgl_gm . "</strong><br/>";
                }
            } else {
                $list_level_approval_gm = "SELECT bpb_appr_gm FROM list_level_approval WHERE bpb_appr_gm = '$kode_level_sesi'";
                $get_appr_gm = $this->db_logistik_pt->query($list_level_approval_gm)->num_rows();

                if ($get_appr_gm > 0) {
                    $konfirmasi_gm = '<a href="javascript:;" id="a_appproval">
                                <button class="btn btn-info btn-xs" id="btn_konfirmasi_gm" name="btn_konfirmasi_gm" data-toggle="tooltip" data-placement="top" title="Mengetahui" onClick="konfirmasi(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $GM . ',' . $mengetahui . ')"> Mengetahui
                                </button>
                            </a>';
                } else {
                    $konfirmasi_gm = "";
                }
            }


            // $row[] = '<a href="'.site_url('bpb/detail_bpb/'.$hasil->nobpb.'/'.$id).'" target="_blank" class="btn btn-info fa fa-edit btn-xs" data-toggle="tooltip" data-placement="top" title="Detail LPB" id="btn_detail_barang"> Ubah
            //     <a href="javascript:;" id="a_batal_bpb">
            //         <button class="btn btn-warning fa fa-undo btn-xs" id="btn_batal_bpb" name="btn_batal_bpb" data-toggle="tooltip" data-placement="top" title="Batal bpb" onClick="konfirmasiBatalBPB('.$id.','.$hasil->nobpb.')"> Batal
            //         </button>
            //     </a>
            //     <a href="'.site_url('bpb/cetak/'.$hasil->nobpb.'/'.$id).'" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_bpb"> Cetak
            //     </a>
            //     ';
            $row[] = $no++;
            $row[] = $hasil->nobpb;
            $row[] = $hasil->norefbpb;
            $row[] = $hasil->kodebar;
            $row[] = $hasil->nabar;
            $row[] = $hasil->qty;
            $row[] = $hasil->qty_disetujui;
            $row[] = $hasil->satuan;

            // $query_bpbitem = "SELECT nabar FROM bpbitem WHERE nobpb = '$hasil->nobpb'";
            // $data_bpbitem = $this->db_logistik_pt->query($query_bpbitem)->result();
            // $data_detail = array();
            // $data_detail_nama = array();
            // foreach ($data_bpbitem as $bpbitem){
            //     array_push($data_detail_nama, $bpbitem->nabar);
            // }
            // $row[] = join(", ",$data_detail_nama);
            $row[] = $konfirmasi_asisten_afd;
            $row[] = $konfirmasi_kepala_kebun;
            $row[] = $konfirmasi_kasie_agronomi;
            $row[] = $konfirmasi_ktu;
            // $row[] = $konfirmasi_mgr;
            $row[] = $konfirmasi_gm;
            $row[] = "";
            $row[] = "";
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_listbpb->count_all(),
            "recordsFiltered" => $this->M_listbpb->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function konfirmasi_approval()
    {
        // array(5) {
        //   ["nobpb"]=>string(7) "6600001"
        //   ["norefbpb"]=>string(25) "EST-BPB/SWJ/07/2019/00001"
        //   ["kodebar"]=>string(15) "102505420000001"
        //   ["jabatan"]=>string(3) "KTU"
        //   ["approval"]=>string(6) "setuju"
        // }

        $nobpb        = $this->input->post('nobpb');
        $norefbpb    = $this->input->post('norefbpb');
        $kodebar    = $this->input->post('kodebar');
        $jabatan    = $this->input->post('jabatan');
        $approval    = $this->input->post('approval');

        // if(empty(var)){

        // }
        // $dataedit['qty_disetujui'] 	= $qty_disetujui;

        switch ($jabatan) {
            case 'AsistenAfd':
                if ($approval == "setuju") {
                    $dataedit_approval['status_asisten_afd']     = "1";
                } elseif ($approval == "tidaksetuju") {
                    $dataedit_approval['status_asisten_afd']     = "2";
                }
                $dataedit_approval['tgl_asisten_afd']         = date('Y-m-d H:i:s');
                // $dataedit_approval['ket_asisten_afd'] 		= $ket_asisten_afd;
                break;
            case 'KepalaKebun':
                if ($approval == "setuju") {
                    $dataedit_approval['status_kepala_kebun']     = "1";
                } elseif ($approval == "tidaksetuju") {
                    $dataedit_approval['status_kepala_kebun']     = "2";
                }
                $dataedit_approval['tgl_kepala_kebun']         = date('Y-m-d H:i:s');
                // $dataedit_approval['ket_asisten_kepala_kebun'] 		= $ket_asisten_kepala_kebun;
                break;
            case 'KasieAgronomi':
                if ($approval == "mengetahui") {
                    $dataedit_approval['status_kasie_agronomi']     = "3";
                }
                $dataedit_approval['tgl_kasie_agronomi']         = date('Y-m-d H:i:s');
                // $dataedit_approval['ket_kasie_agronomi'] 		= $ket_kasie_agronomi;
                break;
            case 'KTU':
                if ($approval == "setuju") {
                    $dataedit_approval['status_ktu']     = "1";
                } elseif ($approval == "tidaksetuju") {
                    $dataedit_approval['status_ktu']     = "2";
                }
                $dataedit_approval['tgl_ktu']         = date('Y-m-d H:i:s');
                // $dataedit_approval['ket_ktu'] 		= $ket_ktu;
                break;
                // case 'MGR':
                // 	if($approval == "mengetahui"){
                // 		$dataedit_approval['status_mgr'] 	= "3";
                // 	}
                // 	$dataedit_approval['tgl_mgr'] 		= date('Y-m-d H:i:s');
                // 	// $dataedit_approval['ket_mgr'] 		= $ket_mgr;
                // 	break;
            case 'GM':
                if ($approval == "mengetahui") {
                    $dataedit_approval['status_gm']         = "3";
                }
                $dataedit_approval['tgl_gm']         = date('Y-m-d H:i:s');
                // $dataedit_approval['ket_gm'] 		= $ket_gm;
                break;
            default:
                break;
        }

        // $this->db_logistik_pt->trans_start();
        $this->db_logistik_pt->set($dataedit_approval);
        $this->db_logistik_pt->where('no_bpb', $nobpb);
        $this->db_logistik_pt->where('norefbpb', $norefbpb);
        $this->db_logistik_pt->where('kodebar', $kodebar);
        $this->db_logistik_pt->update('approval_bpb');
        // $this->db_logistik_pt->trans_complete();
        if ($this->db_logistik_pt->affected_rows() > 0) {
            $bool_approval_bpb = TRUE;
        } else {
            // if ($this->db_logistik_pt->trans_status() === FALSE){
            $bool_approval_bpb = FALSE;
            // }
            // else{
            // $bool_approval_bpb = TRUE;
            // }
        }

        // $count_item_appr = $this->db_logistik_pt->get_where('approval_bpb', array('status_ktu <>'=>'0','status_mgr <>'=>'0','status_gm <>'=>'0','no_bpb'=>$nobpb,'norefbpb'=>$norefbpb))->num_rows();

        // var_dump($jabatan);
        // var_dump($bool_approval_bpb);

        if ($jabatan == "KTU") {
            $query_qty = "SELECT qty FROM bpbitem WHERE nobpb = '$nobpb' AND norefbpb = '$norefbpb' AND kodebar = '$kodebar'";
            $get_qty = $this->db_logistik_pt->query($query_qty)->row();
            $qty_disetujui = $get_qty->qty;

            $dataedit_bpbitem['qty_disetujui'] = $qty_disetujui;

            $this->db_logistik_pt->set($dataedit_bpbitem);
            $this->db_logistik_pt->where('nobpb', $nobpb);
            $this->db_logistik_pt->where('norefbpb', $norefbpb);
            $this->db_logistik_pt->where('kodebar', $kodebar);
            $this->db_logistik_pt->update('bpbitem');
            // var_dump($this->db_logistik_pt->last_query());exit();

            // 	if ($this->db_logistik_pt->affected_rows() > 0){
            // 	    $bool_bpbitem = TRUE;
            // 	}
            // 	else{
            // 		$bool_bpbitem = FALSE;
            // 	}

            // 	var_dump($bool_bpbitem);
            // exit();


            $this->_count_item_appr($nobpb, $norefbpb);

            // if($bool_approval_bpb === TRUE && $bool_bpbitem === TRUE){
            if ($bool_approval_bpb === TRUE) {
                echo json_encode(TRUE);
            } else {
                return FALSE;
            }
        } else {
            $this->_count_item_appr($nobpb, $norefbpb);

            if ($bool_approval_bpb === TRUE) {
                echo json_encode(TRUE);
            } else {
                return FALSE;
            }
        }
    }

    function _count_item_appr($nobpb, $norefbpb)
    {
        $count_item_appr = $this->db_logistik_pt->get_where('approval_bpb', array('status_ktu' => '1', 'no_bpb' => $nobpb, 'norefbpb' => $norefbpb))->num_rows();
        $count_bpbitem = $this->db_logistik_pt->get_where('bpbitem', array('nobpb' => $nobpb, 'norefbpb' => $norefbpb))->num_rows();

        if ($count_item_appr == $count_bpbitem) {
            $dataedit_bpb['approval'] = "1";
            $this->db_logistik_pt->set($dataedit_bpb);
            $this->db_logistik_pt->where('nobpb', $nobpb);
            $this->db_logistik_pt->where('norefbpb', $norefbpb);
            $this->db_logistik_pt->update('bpb');
        }
    }

    function cetak1()
    {
        $no_bpb = $this->uri->segment('3');
        $id = $this->uri->segment('4');

        $data['no_bpb'] = $no_bpb;
        $data['id'] = $id;
        $data['bpb'] = $this->db_logistik_pt->get_where('bpb', array('id' => $id, 'nobpb' => $no_bpb))->row();
        $data['bpbitem'] = $this->db_logistik_pt->get_where('bpbitem', array('nobpb' => $no_bpb))->result();

        $noref = $data['bpb']->norefbpb;
        $this->qrcode($no_bpb, $id, $noref);

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

        // $mpdf->SetHTMLHeader('<h4>PT MULIA SAWIT AGRO LESTARI</h4>');
        $mpdf->SetHTMLHeader('
                            <table width="100%" border="0" align="center">
                                <tr>
                                	<td align="left" style="font-size:14px;font-weight:bold;">PT Mulia Sawit Agro Lestari</td>
                                </tr>

                                
                            </table>
                            ');
        // $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');

        if ($data['bpb']->batal == 1) {
            # code...
            $mpdf->SetWatermarkImage(
                '././assets/img/batal.png',
                0.3,
                '',
                array(25, 10)
            );
            $mpdf->showWatermarkImage = true;
        }

        $html = $this->load->view('v_cetakbpb', $data, true);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function cetak()
    {
        $no_bpb = $this->uri->segment('3');
        $id = $this->uri->segment('4');

        $this->db_logistik_pt->where('id', $id);
        $this->db_logistik_pt->where('nobpb', $no_bpb);
        $cek = $this->db_logistik_pt->get_where('bpb');

        if ($cek->num_rows() > 0) {
            $cek = $cek->row();
            $jml_ = (int)$cek->jml_cetak;
            $up = [
                'jml_cetak' => $jml_ + 1
            ];
            $this->db_logistik_pt->where('id', $id);
            $this->db_logistik_pt->where('nobpb', $no_bpb);
            $this->db_logistik_pt->update('bpb', $up);
        } else {
            $ins = [
                'jml_cetak' => 1
            ];
            $this->db_logistik_pt->insert('bpb', $ins);
        }


        $data['no_bpb'] = $no_bpb;
        $data['id'] = $id;
        $data['bpb'] = $this->db_logistik_pt->get_where('bpb', array('id' => $id, 'nobpb' => $no_bpb))->row();
        $data['bpbitem'] = $this->db_logistik_pt->get_where('bpbitem', array('nobpb' => $no_bpb))->result();
        $d = $this->db_logistik_pt->get_where('bpb', array('id' => $id, 'nobpb' => $no_bpb))->row();
        $noref = $d->norefbpb;
        $data['bpb_approval'] = $this->db_logistik_pt->get_where('approval_bpb', array('no_bpb' => $no_bpb, 'norefbpb' => $noref))->result();

        $this->qrcode($no_bpb, $id, $noref);

        // cek bahan bakar
        $this->db_logistik_pt->where('id', $id);
        $this->db_logistik_pt->where('nobpb', $no_bpb);
        $cekdata = $this->db_logistik_pt->get_where('bpb');
        $d = $cekdata->row();
        $isi = $d->bhn_bakar;

        if ($isi == "BBM") {
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                // 'format' => [190, 236],
                'margin_top' => '2',
                'margin_left' => '3',
                'margin_right' => '3',
                'orientation' => 'P'
            ]);

            // $mpdf->SetHTMLHeader('<h4>PT MULIA SAWIT AGRO LESTARI</h4>');
            // $mpdf->SetHTMLHeader('
            //                     <table width="100%" border="0" align="center">
            //                         <tr>
            //                             <td align="left" style="font-size:14px;font-weight:bold;">PT Mulia Sawit Agro Lestari</br><h5>Kebun / Unit</h5></td>
            //                             <td align="right" style="font-size:14px;font-weight:bold;"><img width="10%" height="10%" src=" ' . site_url('assets/qrcode/bpb/' . $id . "_" . $no_bpb . '.png') . '"></td>
            //                         </tr>




            //                     </table>
            //                     ');
            // $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');
            if ($data['bpb']->batal == 1) {
                # code...
                $mpdf->SetWatermarkImage(
                    '././assets/img/batal.png',
                    0.3,
                    '',
                    array(25, 10)
                );
                $mpdf->showWatermarkImage = true;
            }
            $html = $this->load->view('v_cetakbpb', $data, true);

            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            # code...
            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                // 'format' => [190, 236],
                'margin_top' => '2',
                'margin_left' => '3',
                'margin_right' => '3',
                'orientation' => 'P'
            ]);

            // $mpdf->SetHTMLHeader('<h4>PT MULIA SAWIT AGRO LESTARI</h4>');
            // $mpdf->SetHTMLHeader('
            //                     <table width="100%" border="0" align="center">
            //                         <tr>
            //                             <td align="center" style="font-size:14px;font-weight:bold;">PT Mulia Sawit Agro Lestari</td>
            //                         </tr>
            //                         <!-- <tr>
            //                             <td rowspan="2" width="15%" height="10px"><img width="10%" height="60px" style="padding-left:8px" src="' . base_url() . 'assets/img/msal.jpg"></td>
            //                             <td align="center" style="font-size:14px;font-weight:bold;">PT Mulia Sawit Agro Lestari</td>
            //                         </tr> -->
            //                         <!-- <tr>
            //                             <td align="center">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
            //                             </td>
            //                         </tr> -->
            //                     </table>
            //                     <hr style="width:100%;margin:0px;">
            //                     ');
            // $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');
            if ($data['bpb']->batal == 1) {
                # code...
                $mpdf->SetWatermarkImage(
                    '././assets/img/batal.png',
                    0.3,
                    '',
                    array(25, 10)
                );
                $mpdf->showWatermarkImage = true;
            }
            $html = $this->load->view('v_print_bpb', $data, true);

            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
    }

    function qrcode($no_bpb, $id, $noref)
    {
        $this->load->library('ciqrcode');

        $config['cacheable']    = false; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/bpb/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $id . '_' . $no_bpb . '.png'; //buat name dari qr code

        // $params['data'] = site_url('bpb/cetak/'.$no_bpb.'/'.$id); //data yang akan di jadikan QR CODE
        $params['data'] = $noref; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
    }

    function cek_approve()
    {
        $nobpb        = $this->input->post('nobpb');
        $norefbpb    = $this->input->post('norefbpb');
        $kodebar    = $this->input->post('kodebar');
        $setuju = $this->input->post('approval');

        // $data = $this->M_bpb->cekAprrove($nobpb, $kodebar, $norefbpb);
        if ($setuju == 1) {
            $data = $this->M_bpb->cekAprrove($nobpb, $kodebar, $norefbpb);
        } else if ($setuju == 0) {
            $data = $this->M_bpb->batalAprrove($nobpb, $norefbpb, $kodebar);
        }

        echo json_encode($data);
    }

    function approve()
    {
        $nobpb        = $this->input->post('nobpb');
        $norefbpb    = $this->input->post('norefbpb');
        $kodebar    = $this->input->post('kodebar');
        $setuju    = $this->input->post('approval');
        $alasan    = $this->input->post('alasan');

        if ($setuju == "1") {
            $approval = "1";
            $mengetahui = "3";
            $aprrove = "1";

            $this->M_bpb->update_item($nobpb, $norefbpb, $aprrove, $kodebar, $alasan);
        } else if ($setuju == "0") {
            $approval = "2";
            $mengetahui = "3";
            $aprrove = '0';

            $this->M_bpb->update_item($nobpb, $norefbpb, $aprrove, $kodebar, $alasan);
        }

        $dataedit_approval = array(
            'status_asisten_afd' => $approval,
            'tgl_asisten_afd' => date('Y-m-d H:i:s'),

            'status_kepala_kebun' => $approval,
            'tgl_kepala_kebun' => date('Y-m-d H:i:s'),

            'status_kasie_agronomi' => $approval,
            'tgl_kepala_kebun' => date('Y-m-d H:i:s'),

            'status_kasie_agronomi' => $approval,
            'tgl_kasie_agronomi' => date('Y-m-d H:i:s'),

            'status_ktu' => $approval,
            'tgl_ktu' => date('Y-m-d H:i:s'),

            'status_gm' => $mengetahui,
            'tgl_gm' => date('Y-m-d H:i:s')

        );



        $dataItem = $this->M_bpb->updateitem($nobpb, $norefbpb, $kodebar, $dataedit_approval);
        echo json_encode($dataItem);
    }

    function detail_itembpb()
    {
        $nobpb = $this->input->post('nobpb');
        $norefbpb = $this->input->post('norefbpb');
        $this->M_listbpb->where_datatables($nobpb, $norefbpb);
        $list = $this->M_listbpb->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {

            $setuju = "'setuju'";
            $tidaksetuju = "'tidaksetuju'";
            $nobpb = "'" . $d->nobpb . "'";
            $norefbpb = "'" . $d->norefbpb . "'";
            $kodebar = "'" . $d->kodebar . "'";
            $nobpb_query = $d->nobpb;
            $norefbpb_query = $d->norefbpb;
            $kodebar_query = $d->kodebar;

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $d->nobpb;
            $row[] = $d->norefbpb;
            $row[] = $d->kodebar;
            $row[] = $d->nabar;
            $row[] = $d->qty;
            $row[] = $d->qty_disetujui;
            $query_status_asisten_afd = "SELECT * FROM approval_bpb WHERE status_asisten_afd <> '0' AND no_bpb = '$nobpb_query' AND norefbpb = '$norefbpb_query' AND kodebar = '$kodebar_query'";
            $get_status_asisten_afd = $this->db_logistik_pt->query($query_status_asisten_afd);
            if ($get_status_asisten_afd->num_rows() > 0) {
                $get_status_approval_asisten_afd = $this->db_logistik_pt->query($query_status_asisten_afd)->row();
                if ($get_status_approval_asisten_afd->status_asisten_afd ==  "1") {
                    $button = "<strong style='color:green;' disabled>DISETUJUI <br/>" . $get_status_approval_asisten_afd->tgl_asisten_afd . "</strong><br/>";
                } else if ($get_status_approval_asisten_afd->status_asisten_afd ==  "2") {
                    $button = "<strong style='color:red' disabled>TDK DISETUJUI <br/>" . $get_status_approval_asisten_afd->tgl_asisten_afd . "</strong><br/>";
                }
            } else {
                $button = "<strong style='color:yellow'>DALAM PROSES</strong>";
                // $button = '<a href="javascript:;" id="a_appproval">
                //     <button class="btn btn-success btn-xs fa fa-check" id="btn_setuju" name="btn_setuju" data-toggle="tooltip" data-placement="top" title="Setuju" onClick="konfirmasi(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $setuju . ')">
                //     </button>
                // </a>
                // <a href="javascript:;" id="a_appproval">
                // <button class="btn btn-danger btn-xs fa fa-times" id="btn_tdk_setuju" name="btn_tdk_setuju" data-toggle="tooltip" data-placement="top" title="Tdk Setuju" onClick="konfirmasi(' . $nobpb . ',' . $norefbpb . ',' . $kodebar . ',' . $tidaksetuju . ')">
                // </button></a>';
            }
            $row[] = $button;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_listbpb->count_all(),
            "recordsFiltered" => $this->M_listbpb->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }
}
