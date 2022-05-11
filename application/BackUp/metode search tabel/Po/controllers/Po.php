<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Po extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_po');
        $db_pt = check_db_pt();

        // $this->db_logistik = $this->load->database('db_logistik',TRUE);
        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);
    }

    function get_ajax()
    {
        $list = $this->M_po->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $d->kode;
            $row[] = $d->supplier;
            $row[] = $d->usaha;
            // $row[] = '<img src=" ' . site_url('assets/uploads/tiket/' . $d->foto) . '" width="60px">';
            $row[] = '<button type="button" class="btn btn-success" style="margin:2px;" title="Pilih" id="pilih" data-id="' . $d->id . '" data-kode="' . $d->kode . '" data-supplier="' . $d->supplier . '" > Pilih</button>';




            // add html for action

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
        ];
        $this->template->load('template', 'v_inputPo', $data);
    }

    public function getPo()
    {
        $data = $this->M_po->get_supplier();
        echo json_encode($data);
    }
}

/* End of file Po.php */
