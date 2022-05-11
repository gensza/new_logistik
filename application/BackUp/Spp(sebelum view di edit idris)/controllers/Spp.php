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

    //Start Data Table Server Side
    function get_data_barang()
    {
        $list = $this->M_spp->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = '<button class="btn btn-success btn-xs" id="data_barang" name="data_barang"
                    data-nabar="' . $field->nabar . '" data-kodebar="' . $field->kodebar . '" data-satuan="' . $field->satuan . '"
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
            "recordsTotal" => $this->M_spp->count_all(),
            "recordsFiltered" => $this->M_spp->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
    //End Start Data Table Server Side

    public function index()
    {
        $this->template->load('template', 'v_spp');
    }

    public function sppBaru()
    {
        $data['sesi_sl'] = $this->session->userdata('status_lokasi');

        $data['devisi'] = $this->M_spp->cariDevisi();

        $data['dept'] = $this->M_spp->dept();

        $this->template->load('template', 'v_input_spp', $data);
    }

    public function getStok()
    {
        $kd_bar = $this->input->get('kd_bar');

        // $ym_periode  = $this->session->userdata('ym_periode');

        $stockawal = $this->M_spp->stokAwal($kd_bar);

        if (empty($stockawal)) {
            $get_stockawal = "0";
        } else {
            $get_stockawal = $stockawal->QTY_MASUK;
        }

        // $summasuk = $this->M_spp->sumMasuk($kd_bar);

        $sumkeluar = $this->M_spp->sumKeluar($kd_bar);

        $data = $get_stockawal - $sumkeluar->stokkeluar;

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
            $dig_1 = "1";
        } else if ($cmb_alokasi == "SITE") {
            // $text1 = $cmb_estate;
            $text1 = "EST";
            $text2 = "SWJ";
            $dig_1 = "6";
        } else if ($cmb_alokasi == "RO") {
            $text1 = "ROM";
            $text2 = "PKY";
            $dig_1 = "2";
        } else if ($cmb_alokasi == "PKS") {
            $text1 = "FAC";
            $text2 = "SWJ";
            $dig_1 = "3";
        }

        if ($this->session->userdata('status_lokasi') == "HO") {
            $dig_2 = "1";
        } else if ($this->session->userdata('status_lokasi') == "RO") {
            $dig_2 = "2";
        } else if ($this->session->userdata('status_lokasi') == "PKS") {
            $dig_2 = "3";
        } else if ($this->session->userdata('status_lokasi') == "SITE") {
            $dig_2 = "6";
        }

        $key = $dig_1 . $dig_2;

        $query_ppo = "SELECT MAX(SUBSTRING(noppotxt, 3)) as maxspp from ppo WHERE noppotxt LIKE '$key%'";
        $generate_ppo = $this->db_logistik_pt->query($query_ppo)->row();
        $noUrut = (int)($generate_ppo->maxspp);
        $noUrut++;
        $print = sprintf("%05s", $noUrut);

        if (empty($this->input->post('hidden_no_spp'))) {
            $nospp = $dig_1 . $dig_2 . $print;
        } else {
            $nospp = $this->input->post('hidden_no_spp');
        }

        $tgl_trm = date("Y-m-d", strtotime($this->input->post('txt_tgl_terima')));

        $getmonth = date("m", strtotime($this->input->post('txt_tgl_ref')));
        $getyear = date("y", strtotime($this->input->post('txt_tgl_ref')));

        $noref = $text1 . "-" . $_POST['cmb_jenis_permohonan'] . "/" . $text2 . "/" . $getmonth . "/" . $getyear . "/" . $nospp;

        $periode = date("Y-m-d", strtotime($this->input->post('txt_tgl_ref')));
        $d_periode =  date("j", strtotime($periode));
        if ($d_periode >= 26) {
            $periodetxt = date("Ym", strtotime($this->input->post('txt_tgl_ref') . " +1 month"));
        } else {
            $periodetxt = date("Ym", strtotime($this->input->post('txt_tgl_ref')));
        }
        $thn = date("Y", strtotime($this->input->post('txt_tgl_ref')));

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
            'devisi' => $this->input->post('devisi'),
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
            'tglppo' => $this->input->post('txt_tgl_spp'),
            'tglppotxt' => date("Ymd", strtotime($this->input->post('txt_tgl_spp'))),
            'kodedept' => $this->input->post('cmb_departemen'),
            'namadept' => $data['nama_dept']['nama'],
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


        if (empty($this->input->post('hidden_no_spp'))) {
            $data = $this->M_spp->saveSpp($data_ppo);
            $data2 = $this->M_spp->saveSpp2($data_item_ppo);
            $item_exist = 0;
        } else {

            $cek_isi_item = $this->M_spp->cari_item_spp($data_item_ppo['kodebar'], $data_item_ppo['noreftxt']);

            if ($cek_isi_item >= 1) {
                $item_exist = 1;
                $data = NULL;
                $data2 = NULL;
            } else {
                $data2 = $this->M_spp->saveSpp2($data_item_ppo);
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
            }
        } else {
            $data2 = $this->M_spp->updateSpp2($id_item_ppo, $data_item_ppo);
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

        $data = $this->db_logistik_pt->delete('item_ppo', array('id' => $id_ppo_item));

        echo json_encode($data);
    }

    public function deleteSpp()
    {
        $no_spp = $this->input->post('no_spp');

        $data = $this->M_spp->deleteSpp($no_spp);

        echo json_encode($data);
    }

    public function sppApproval()
    {
        $this->template->load('template', 'v_spp_approval');
    }

    public function get_data_spp()
    {
        $list = $this->M_data_spp->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;

            if ($field->status2 == 1) {
                $stat = '<h5 style="margin-top:0px;"><span class="badge badge-success">Approved</span></h5>';
            } else {
                $stat = '<h5 style="margin-top:0px;"><span class="badge badge-warning">DALAM<br>PROSES</span></h5>';
            }

            if ($field->status2 == 1) {
                $aks = '<a href="' . site_url('spp/cetak/' . $field->noppotxt . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_spp"></a>';
            } else {
                $aks = '<button class="btn btn-xs btn-warning fa fa-edit" id="edit_spp" name="edit_spp"
                data-noppo="' . $field->noppo . '"
                data-toggle="tooltip" data-placement="top" title="detail" onClick="return false">
                </button>
                <button class="btn btn-danger btn-xs fa fa-trash" id="print_spp" name="print_spp"
                data-noppotxt="' . $field->noppotxt . '"
                data-toggle="tooltip" data-placement="top" title="Pilih" onClick="return false">
                </button>
                <a href="' . site_url('spp/cetak/' . $field->noppotxt . '/' . $field->id) . '" target="_blank" class="btn btn-primary btn-xs fa fa-print" id="a_print_spp"></a>';
            }
            $row = array();
            $row[] = $no;
            $row[] = $aks;
            $row[] = $field->noreftxt;
            $row[] = date('Y-m-d', strtotime($field->tglref));
            $row[] = date('Y-m-d', strtotime($field->tgltrm));
            $row[] = $field->namadept;
            $row[] = $field->lokasi;
            $row[] = $field->ket;
            $row[] = $stat;
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

    public function getDetailSpp()
    {
        $noppo = $this->input->post('hidden_noppotxt');
        $result = $this->M_data_spp->getDetailSpp($noppo);

        echo json_encode($result);
    }

    public function get_data_spp_approval()
    {
        $list = $this->M_data_spp_approval->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<button class="btn btn-info btn-xs" id="detail_spp_approval" name="detail_spp_approval"
                        data-noppotxt="' . $field->noppotxt . '"
                        data-toggle="tooltip" data-placement="top" title="Pilih" onClick="detail_approval(' . $field->id . ')">Approve
                        </button>';
            $row[] = $field->noreftxt;
            $row[] = date('Y-m-d', strtotime($field->tglref));
            $row[] = date('Y-m-d', strtotime($field->tgltrm));
            $row[] = $field->namadept;
            $row[] = $field->lokasi;
            $row[] = $field->ket;
            $row[] = '<h5 style="margin-top:0px;"><span class="badge badge-warning">DALAM<br>PROSES</span></h5>';
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

    public function edit_spp($noppo)
    {
        $data['noppo'] = $noppo;

        $this->template->load('template', 'v_spp_edit', $data);
    }

    public function cari_spp_edit()
    {
        $noppo = $this->input->post('noppo');
        $result = $this->M_data_spp->cari_spp_edit($noppo);

        echo json_encode($result);
    }

    function cetak()
    {
        $nospp = $this->uri->segment('3');
        $id = $this->uri->segment('4');

        $data['urut'] = $this->M_spp->urut_cetak($nospp);

        $data['ppo'] = $this->db_logistik_pt->get_where('ppo', array('noppotxt' => $nospp, 'id' => $id))->row();

        $noreftxt = $data['ppo']->noreftxt;
        $data['item_ppo'] = $this->db_logistik_pt->get_where('item_ppo', array('noreftxt' => $noreftxt))->result();

        $query_approval = "SELECT DISTINCT nama_approval_ktu, tgl_approval_ktu, nama_approval_dept_head, tgl_approval_dept_head, nama_approval_gm, tgl_approval_gm FROM item_ppo_approval WHERE noreftxt = '$noreftxt' AND status2_ktu = '4' AND status2_dept_head = '1'";
        $data['item_ppo_approval'] = $this->db_logistik_pt->query($query_approval)->row();

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => [190, 236],
            // 'format' => 'A4',
            // 'setAutoTopMargin' => 'stretch',
            'margin_top' => '15',
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

        $mpdf->SetHTMLHeader('<h3>' . $data['ppo']->devisi . '</h3>');
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

        $html = $this->load->view('v_spp_print', $data, true);

        $mpdf->WriteHTML($html);
        $mpdf->Output();
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
                $status = "<span style='color: green'><b>DISETUJUI<br>" . $d->TGL_APPROVE . "</b></span>";
            } else {
                $status = "DALAM PROSES";
            }
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $d->id;
            // $row[] = $d->noreftxt;
            $row[] = $d->kodebar;
            $row[] = $d->nabar;
            $row[] = $d->sat;
            $row[] = $d->qty;
            $row[] = $d->STOK;
            $row[] = $d->ket;
            $row[] = '<button class="btn btn-xs btn-primary" type="button" disabled>Qty</button>';
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
}

/* End of file Controllername.php */