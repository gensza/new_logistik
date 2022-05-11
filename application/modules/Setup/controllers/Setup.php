<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setup extends CI_Controller
{
      public function __construct()
      {
            parent::__construct();
            $this->load->model('M_setup');
            $this->db_logistik_center = $this->load->database('db_logistik_center', TRUE);

            if (!$this->session->userdata('id_user')) {
                  $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
                  $this->session->set_flashdata('pesan', $pemberitahuan);
                  redirect('Login');
            }

            date_default_timezone_set('Asia/Jakarta');
      }

      public function supplier()
      {
            $data = [
                  'tittle' => 'Data Supplier',
            ];
            $this->template->load('template', 'v_supplier', $data);
      }

      //Start Data Table Server Side
      function get_data_supplier()
      {
            $list = $this->M_setup->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {
                  $no++;
                  $row = array();
                  $row[] = '<button class="btn btn-warning btn-xs fa fa-edit" style="font-size: 11px;"
                    data-toggle="tooltip" data-placement="top" title="edit" onClick="editSupplier(' . $field->id . ')">
                    </button>
                    <button class="btn btn-danger btn-xs fa fa-trash" style="font-size: 11px;"
                    data-toggle="tooltip" data-placement="top" title="hapus" onClick="hapusSupplier(' . $field->id . ')">
                    </button>
                ';
                  $row[] = $no;
                  $row[] = $field->kode;
                  $row[] = $field->account;
                  $row[] = $field->supplier;
                  $row[] = $field->alamat;
                  $row[] = $field->tlp;
                  $row[] = $field->sales;

                  $data[] = $row;
            }

            $output = array(
                  "draw" => $_POST['draw'],
                  "recordsTotal" => $this->M_setup->count_all(),
                  "recordsFiltered" => $this->M_setup->count_filtered(),
                  "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
      }
      //End Start Data Table Server Side

      public function simpan_data()
      {
            $query = "SELECT MAX(kode) as maxkode from supplier";
            $generate = $this->db_logistik_center->query($query)->row();
            $noUrut = (int)($generate->maxkode);
            $noUrut++;
            $kode = sprintf("%03s", $noUrut);

            // jika
            if (empty($this->input->post('hidden_id_sup'))) {
                  $data_supplier['kode'] = $kode;
            }
            $data_supplier['supplier'] = $this->input->post('nama_sup');
            $data_supplier['alamat'] = $this->input->post('alamat');
            $data_supplier['tlp'] = $this->input->post('telp');
            $data_supplier['fax'] = $this->input->post('fax');
            $data_supplier['usaha'] = $this->input->post('jenis_usaha');
            $data_supplier['sales'] = $this->input->post('sales');
            $data_supplier['lama'] = $this->input->post('lama_pembayaran');
            $data_supplier['lamatxt'] = $this->input->post('lama_pembayaran_txt');
            $data_supplier['npwp'] = $this->input->post('npwp');
            $data_supplier['pkp'] = $this->input->post('pkp');
            $data_supplier['norek'] = $this->input->post('norek');
            $data_supplier['namabank'] = $this->input->post('nama_bank');
            $data_supplier['atasnama'] = $this->input->post('atas_nama');
            $data_supplier['account'] = $this->input->post('account');
            $data_supplier['nama_account'] = $this->input->post('nama_sup');
            $data_supplier['pph'] = $this->input->post('pph');
            $data_supplier['pph_rule'] = '-';

            $hidden_account = $this->input->post('hidden_account');

            if (empty($this->input->post('hidden_id_sup'))) {
                  $cari_account = $this->db_logistik_center->get_where('supplier', array('account' => $data_supplier['account']))->num_rows();
            } else {
                  if ($hidden_account != $data_supplier['account']) {
                        $cari_account = $this->db_logistik_center->get_where('supplier', array('account' => $data_supplier['account']))->num_rows();
                  } else {
                        $cari_account = 0;
                  }
            }

            if ($cari_account >= 1) {
                  $data_return = 'account_exist';
            } else {
                  if (empty($this->input->post('hidden_id_sup'))) {
                        $data_return = $this->db_logistik_center->insert('supplier', $data_supplier);
                  } else {
                        $id = $this->input->post('hidden_id_sup');
                        $this->db_logistik_center->set($data_supplier);
                        $this->db_logistik_center->where('id', $id);
                        $data_return = $this->db_logistik_center->update('supplier');
                  }
            }

            echo json_encode($data_return);
      }

      public function cari_data_edit()
      {
            $id = $this->input->post('id');

            $data = $this->db_logistik_center->get_where('supplier', array('id' => $id))->row_array();

            echo json_encode($data);
      }

      public function hapusSupplier()
      {
            $id = $this->input->post('id');

            $data = $this->db_logistik_center->delete('supplier', array('id' => $id));

            echo json_encode($data);
      }
}

/* End of file Controllername.php */
