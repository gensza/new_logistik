<?php

date_default_timezone_set("Asia/Jakarta");
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
        $db_pt = check_db_pt();
        $this->db_config = $this->load->database('db_conf_caba', TRUE);
        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);
        $this->db_logistik_center = $this->load->database('db_logistik_center', true);
        $this->db_logistik_msal = $this->load->database('db_logistik_msal', true);
        // $this->db_logistik_mapa = $this->load->database('db_logistik_mapa', true);
        // $this->db_logistik_peak = $this->load->database('db_logistik_peak', true);
        // $this->db_logistik_psam = $this->load->database('db_logistik_psam', true);
        // $this->db_logistik_kpp = $this->load->database('db_logistik_kpp', true);
    }

    public function index()
    {
        if ($this->session->userdata('id_user')) {
            redirect('Home');
        } else {
            $data['pt'] = $this->db_logistik_center->get('tb_pt')->result_array();

            $this->load->view('v_login', $data);
        }
    }

    public function proses()
    {
        if (isset($_POST['submit'])) {

            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));
            $periode = $this->security->xss_clean($this->input->post('periode'));

            $kode_pt_login = $this->input->post('kode_pt');

            // cari kode pt di tb central
            $data['get_tb_pt_central'] = $this->db_logistik_center->get_where('tb_pt', array('kode_pt' => $kode_pt_login))->row_array();

            // membuka PT awal sebelum mendapatkan session PT
            $pt_login = FALSE;
            if ($data['get_tb_pt_central']['alias'] == 'MSAL') {
                $pt_login = 'db_logistik_msal';
            } else if ($data['get_tb_pt_central']['alias'] == 'MAPA') {
                $pt_login = 'db_logistik_mapa';
            } else if ($data['get_tb_pt_central']['alias'] == 'PEAK') {
                $pt_login = 'db_logistik_peak';
            } else if ($data['get_tb_pt_central']['alias'] == 'PSAM') {
                $pt_login = 'db_logistik_psam';
            } else if ($data['get_tb_pt_central']['alias'] == 'KPP') {
                $pt_login = 'db_logistik_kpp';
            }

            $kodept = ltrim($kode_pt_login, '0');

            $get_username = $this->db_config->get_where('users', array('username' => $username, 'id_pt' => $kodept));
            $user = $get_username->row();

            $lokasi = $this->db_config->query("SELECT nama FROM `codegroup` WHERE group_n='LOKASI_USERS' AND value='$user->id_lokasi'")->row();
            if ($lokasi->nama == 'ESTATE') {
                $lok = 'SITE';
            } else {
                $lok = $lokasi->nama;
            }

            // mengambil devisi user login
            $get_devisi = $this->$pt_login->get_where('tb_devisi', array('kodetxt' => $user->id_lokasi));
            $devisi = $get_devisi->row();

            if ($get_username->num_rows() > 0) {

                switch ($lokasi->status_lokasi) {
                    case 'HO':
                        $get_pt = $this->$pt_login->get_where('pt', array('lokasi' => 'HO'));
                        $pt     = $get_pt->row();

                        $kode_pt = $pt->kodetxt;
                        $nama_pt = $pt->PT;
                        break;
                    case 'RO':
                        $get_pt = $this->$pt_login->get_where('pt', array('lokasi' => 'RO'));
                        $pt     = $get_pt->row();

                        $kode_pt = $pt->kodetxt;
                        $nama_pt = $pt->PT;
                        break;
                    case 'ESTATE':
                        $get_pt = $this->$pt_login->get_where('pt', array('lokasi' => 'SITE'));
                        $pt     = $get_pt->row();

                        $kode_pt = $pt->kodetxt;
                        $nama_pt = $pt->PT;
                        break;
                    case 'PKS':
                        $get_pt = $this->$pt_login->get_where('pt', array('lokasi' => 'PKS'));
                        $pt     = $get_pt->row();

                        $kode_pt = $pt->kodetxt;
                        $nama_pt = $pt->PT;
                        break;
                    default:
                        # code...
                        break;
                }

                $d_periode =  date("j", strtotime($periode));

                if ($d_periode >= 26) {
                    $ym_periode = date('Ym', strtotime($periode . " +1 month"));
                } else {
                    $ym_periode = date('Ym', strtotime($periode));
                }

                $Ymd_periode =  date('Y-m-d', strtotime($periode));

                if (password_verify($password, $user->password)) {
                    # code...
                    $this->session->set_userdata(array(
                        'id_user' => $user->id,
                        'user' => $user->nama,
                        'status_lokasi' => $lok, //HO, RO, SITE, PKS
                        'kode_pt_login' => $kode_pt_login,
                        'app_pt' => $data['get_tb_pt_central']['alias'], //MSAL, MAPA, PSAM, PEAK
                        'nama_pt' => $data['get_tb_pt_central']['nama_pt'], //MSAL, MAPA, PSAM, PEAK
                        'logo_pt' => $data['get_tb_pt_central']['logo'], //MSAL, MAPA, PSAM, PEAK
                        'alamat_ho' => $data['get_tb_pt_central']['deskripsi_ho'], //MSAL, MAPA, PSAM, PEAK
                        'alamat_site' => $data['get_tb_pt_central']['deskripsi_site'], //MSAL, MAPA, PSAM, PEAK
                        'kode_pt' => $kode_pt,
                        'pt' => $nama_pt,
                        'level' => $user->level,
                        'kode_level' => $user->kode_level,
                        'kode_dev' => $devisi->kodetxt,
                        'devisi' => $devisi->PT,
                        'status_login' => 'oke',
                        'periode' => $periode,
                        'ym_periode' => $ym_periode,
                        'Ymd_periode' => $Ymd_periode,
                        'pw' => $data['get_tb_pt_central']['alias'] . date('mdY'),
                        'kode_dept' => $user->kode_dept,
                        'nama_dept' => $user->dept,
                    ));
                    redirect('Home');
                } else {
                    $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"mdi mdi-alert-outline me-2\"></i> Password Salah!</div>");
                    redirect('Login');
                    # code...
                }
            } else {
                // echo "username atau password salah";
                $this->session->set_flashdata("pesan", "<div class=\"alert alert-danger\" id=\"alert\"><i class=\"mdi mdi-alert-outline me-2\"></i> Username tidak ditemukan</div>");
                redirect('Login');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }
}

/* End of file Login.php */
