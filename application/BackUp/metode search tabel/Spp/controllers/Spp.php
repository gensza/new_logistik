<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_spp');

        $db_pt = check_db_pt();
        // $this->db_logistik = $this->load->database('db_logistik',TRUE);
        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);

        $this->db_logistik = $this->load->database('db_logistik', TRUE);

        if (!$this->session->userdata('id_user')) {
            $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
            $this->session->set_flashdata('pesan', $pemberitahuan);
            redirect('Login');
        }
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
            $row[] = '<a href="javascript:;" id="btn_data_barang">
                    <button class="btn btn-success btn-xs" id="data_barang" name="data_barang" data-toggle="tooltip" data-placement="top" title="Pilih" onClick="return false">
                        Pilih
                    </button>
                </a>
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

        $data['dept'] = $this->M_spp->dept();

        // $kobar = $this->db_logistik->get('kodebar')->result_array();
        // var_dump($kobar);
        // die;

        $this->template->load('template', 'v_input_spp', $data);
    }

    public function sppApproval()
    {
        $this->template->load('template', 'v_spp_approval');
    }
}

/* End of file Controllername.php */