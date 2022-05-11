<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_m');
        $this->load->library('bcrypt');

        $db_pt = check_db_pt();
        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);

        if (!$this->session->userdata('id_user')) {
            $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
            $this->session->set_flashdata('pesan', $pemberitahuan);
            redirect('Login');
        }
    }
    public function index()
    {
        $data = [
            'tittle'          => 'Data User',
            'user'              => $this->User_m->get_user()
        ];
        $this->template->load('template', 'v_user', $data);
    }

    public function tambah()
    {
        # code...

        $data = [
            'tittle' => 'Tambah Data User',
            'level' => $this->User_m->level_user(),
            'devisi' => $this->User_m->cariDevisi(),
            'dept' => $this->User_m->dept(),
        ];
        $this->template->load('template', 'v_tambahUser', $data);
    }

    public function tambahUser()
    {
        # code...
        $password = $this->input->post('password');
        $hash_pass = $this->bcrypt->hash_password($password);
        $kode_level = $this->input->post('level');
        $data['data_level'] = $this->User_m->get_level($kode_level);
        $kodedept = $this->input->post('kodedept');

        $caridept = $this->db_logistik_pt->get_where('dept', array('kode' => $kodedept))->row_array();

        $data = array(
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'status_lokasi' => $this->input->post('lokasi'),
            'kode_level' => $kode_level,
            'level' => $data['data_level']['level'],
            'password' => $hash_pass,
            'status_lokasi_site' => $this->input->post('devisi'),
            'kodedept' => $caridept['kode'],
            'namadept' =>  $caridept['nama'],
        );

        $cari_username = $this->db_logistik_pt->get_where('user', array('username' => $data['username']))->num_rows();

        if ($cari_username == 1) {
            $data_return = 'username_exist';
        } else {
            $data_return = $this->User_m->tambahUser($data);
        }
        echo json_encode($data_return);
    }

    public function edit($id = null)
    {
        $data = [
            'tittle'          => 'Edit Data User',
            'user'              => $this->User_m->get_id($id)
        ];
        $this->template->load('template', 'v_editUser', $data);
    }

    public function edit_post()
    {
        # code...
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $username = $this->input->post('usr');
        $data = array(
            'user_id' => $id,
            'user_nama' => $nama,
            'username' => $username
        );
        $this->User_m->update_user($id, $data);
        $this->session->set_flashdata("pesan", "<div class=\"alert alert-success alert-dismissible show fade\">
                    <div class=\"alert-body\">
                    <button class=\"close\" data-dismiss=\"alert\">
                        <span>×</span>
                    </button>
                    Data Admin Berhasil Disimpan
                    </div>
                </div>");

        redirect(base_url('User'));
    }

    public function delete($id)
    {
        # code...
        $data = array('user_id' => $id);
        $this->User_m->delete($data);
        $this->session->set_flashdata("pesan", "<div class=\"sufee-alert alert with-close alert-success alert-dismissible fade show\" id=\"alert\">
			<span class=\"badge badge-pill badge-success\"></span>
			Data Berhasil Dihapus
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
				<span aria-hidden=\"true\">×</span>
			</button></div>");
        redirect(base_url('User'));
    }
}
