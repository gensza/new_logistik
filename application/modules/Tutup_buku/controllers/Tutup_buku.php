<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tutup_buku extends CI_Controller
{

      public function __construct()
      {
            parent::__construct();

            $db_pt = check_db_pt();
            // $this->db_logistik = $this->load->database('db_logistik',TRUE);
            $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);

            // $this->db_logistik = $this->load->database('db_logistik', TRUE);

            $this->load->model('M_tutup_buku');
      }

      public function tutup_buku_act()
      {
            $stockawal = $this->M_tutup_buku->insert_stockawal();
            $stockawal_bulanan = $this->M_tutup_buku->insert_stockawal_bulanan();

            $result = true;

            echo json_encode($result);
      }

      // public function index()
      // {
      //       $pass = 1;

      //       $pass2 = $this->input->post('pass');
      //       if ($pass == $pass2) {
      //             $this->cek_password();
      //       } else {
      //             $return = false;
      //             echo json_encode($return);
      //       }
      // }

      // public function cek_password()
      // {
      //       // $return = true;

      //       $get_stock_awal = $this->M_tutup_buku->get_stock_awal();

      //       echo json_encode($get_stock_awal);
      //       // var_dump($get_stock_awal);
      //       // die;
      // }
}

/* End of file Tutup_buku.php */
