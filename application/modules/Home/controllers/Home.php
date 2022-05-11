<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
            $this->session->set_flashdata('pesan', $pemberitahuan);
            redirect('Login');
        }

        $db_pt = check_db_pt();
        // $this->db_logistik = $this->load->database('db_logistik',TRUE);
        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);

        $this->db_logistik = $this->load->database('db_logistik', TRUE);

        $this->db_logistik_center = $this->load->database('db_logistik_center', TRUE);

        $this->load->model('M_home');
        $this->load->model('M_bpb_mutasi');
        $this->load->model('M_approval_spp_no_coa');
        $this->load->model('M_detail_spp_no_coa');
    }

    function detail_approval_noCOA()
    {
        $id_ppo = $this->input->post('id_ppo');
        $pt = $this->input->post('pt');
        $alias = strtolower($this->input->post('alias'));
        $noreftxt = $this->M_detail_spp_no_coa->get_noref($id_ppo);
        $this->M_detail_spp_no_coa->getWhere($noreftxt['noreftxt'], $pt, $alias);
        $list = $this->M_detail_spp_no_coa->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            $namapt = "'" . $d->namapt . "'";
            $ali = "'" . $alias . "'";
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

                $grp = "<select class='form-control form-control-sm grpCoa' id='grp_coa_" . $d->id . "' onClick='grub_coa(" . $d->id . ")'  style='font-size: 12px;'> 
                <option value='" . $d->grup . "' selected>  $d->grup </option>
           </select>";


                $status = '
                <a href="javascript:;" id="btn_appprove">
                <button type="button" onClick="validasi_acc(' . $d->id . ',' . $namapt . ',' . $ali . ')" id="simpan_approve_' . $d->id . '" class="btn btn-success waves-effect waves-light btn-xs"><i class="mdi mdi-check-all"></i></button>
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
            "recordsTotal" => $this->M_detail_spp_no_coa->count_all(),
            "recordsFiltered" => $this->M_detail_spp_no_coa->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function get_no_coa()
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

    function ubah_session_ymd()
    {
        if (isset($_POST['periode_ubah'])) {
            $periode = $this->input->post('periode_ubah');

            $d_periode =  date("j", strtotime($periode));

            if ($d_periode >= 26) {
                $ym_periode = date('Ym', strtotime($periode . " +1 month"));
            } else {
                $ym_periode = date('Ym', strtotime($periode));
            }

            $Ymd_periode =  date('Y-m-d', strtotime($periode));

            $this->session->set_userdata(array(
                'periode' => $periode,
                'ym_periode' => $ym_periode,
                'Ymd_periode' => $Ymd_periode,
            ));

            $data = TRUE;
        } else {
            $data = FALSE;
        }
        echo json_encode($data);
    }

    function get_grp_coa()
    {
        $data = $this->M_home->get_grp_coa();
        echo json_encode($data); # code...
    }


    public function index()
    {
        $data = [
            'tittle' => "Dashboard"
        ];
        $data['count'] = $this->M_home->count_spp();

        $data['pt_login'] = $this->session->userdata('app_pt');
        $data['pt_periode'] = $this->session->userdata('ym_periode');
        $data['pt'] = $this->db_logistik_center->get('tb_pt')->result_array();

        // var_dump($data['count']);
        // die;

        $this->template->load('template', 'dashboard', $data);
    }

    public function get_data_mutasi()
    {
        $list = $this->M_home->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = date('d-m-Y', strtotime($field->tgl));
            $row[] = $field->no_mutasi;
            $row[] = $field->pt;
            $row[] = $field->devisi_mutasi;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_home->count_all(),
            "recordsFiltered" => $this->M_home->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function get_data_bpb_mutasi()
    {
        $list = $this->M_bpb_mutasi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $kode_dev = $this->session->userdata('kode_dev');
        $pt_login = $this->session->userdata('app_pt');
        $kode_pt_login = $this->session->userdata('kode_pt_login');

        if ($pt_login == 'PSAM') {
            $pt_minta_bpb = 'PSAM, PT';
        } elseif ($pt_login == 'MAPA') {
            $pt_minta_bpb = 'MAPA, PT';
        } elseif ($pt_login == 'MSAL') {
            $pt_minta_bpb = 'MSAL, PT';
        } elseif ($pt_login == 'PEAK') {
            $pt_minta_bpb = 'PEAK, PT';
        } elseif ($pt_login == 'KPP') {
            $pt_minta_bpb = 'KPP, PT';
        } else {
            $pt_minta_bpb = '';
        }

        foreach ($list as $field) {

            $beban = substr($field->ketsub, 23);

            if ($beban == 'EST 1 <> EST 2') {
                // jika kode_dev == 06 berarti est1 > est2
                if ($field->kode_dev == '06') {
                    $kode_devisi_mutasi = '07';
                } else if ($field->kode_dev == '07') {
                    $kode_devisi_mutasi = '06';
                }
            } else if ($beban == 'EST 1 <> PKS') {
                // jika kode_dev == 06 berarti est1 > PKS
                if ($field->kode_dev == '06') {
                    $kode_devisi_mutasi = '03';
                } else if ($field->kode_dev == '03') {
                    $kode_devisi_mutasi = '06';
                }
            } else if ($beban == 'EST 2 <> PKS') {
                // jika kode_dev == 06 berarti est1 > PKS
                if ($field->kode_dev == '07') {
                    $kode_devisi_mutasi = '03';
                } else if ($field->kode_dev == '03') {
                    $kode_devisi_mutasi = '07';
                }
            }

            $no++;
            if ($field->status_mutasi == 1) {
                // bpb permintaan mutasi hanya tampil di estate 1
                if ($kode_dev == '06') {

                    if ($field->ketsub == $pt_minta_bpb) {
                        $row = array();
                        $row[] = $no;
                        $row[] = date('d-m-Y', strtotime($field->tglbpb));
                        $row[] = $field->norefbpb;
                        $row[] = $field->bag;
                        $row[] = $field->keperluan;

                        $data[] = $row;
                    }
                }
            } elseif ($field->status_mutasi == 2) {
                if ($kode_dev == $kode_devisi_mutasi and $field->kode_pt_req_mutasi == $kode_pt_login) {
                    $row = array();
                    $row[] = $no;
                    $row[] = date('d-m-Y', strtotime($field->tglbpb));
                    $row[] = $field->norefbpb;
                    $row[] = $field->bag;
                    $row[] = $field->keperluan;

                    $data[] = $row;
                }
            }
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_bpb_mutasi->count_all(),
            "recordsFiltered" => $this->M_bpb_mutasi->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}

/* End of file Home.php */
