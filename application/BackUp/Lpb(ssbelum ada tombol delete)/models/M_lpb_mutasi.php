<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_lpb_mutasi extends CI_Model
{

      public function get_bkb_mutasi()
      {
            $noref = $this->input->get('noref');

            $kode_pt_login = $this->session->userdata('kode_pt_login');
            $role_user = $this->session->userdata('user');

            $query = "SELECT NO_REF FROM tb_mutasi WHERE NO_REF LIKE '%$noref%' AND USER = '$role_user' AND kode_pt_mutasi = '$kode_pt_login' ORDER BY id DESC";
            return $this->db_logistik_center->query($query)->result_array();
      }

      public function get_data_mutasi_item($noref)
      {
            $this->db_logistik_center->select('NO_REF, tgl, bag, kpd, keperluan, pt, devisi, pt_mutasi, devisi_mutasi, kode_devisi_mutasi');
            $this->db_logistik_center->where('NO_REF', $noref);
            $this->db_logistik_center->from('tb_mutasi');
            $data_mutasi = $this->db_logistik_center->get()->row_array();

            $this->db_logistik_center->select('kodebar, nabar, satuan, grp, qty2, ket');
            $this->db_logistik_center->where('NO_REF', $noref);
            $this->db_logistik_center->from('tb_mutasi_item');
            $data_item_mutasi = $this->db_logistik_center->get()->result_array();

            $d_return = [
                  'data_mutasi' => $data_mutasi,
                  'data_item_mutasi' => $data_item_mutasi
            ];
            return $d_return;
      }

      public function sumqtymutasi($kodebar, $noref, $qty)
      {
            $this->db_logistik_pt->select_sum('qty', 'qty_lpb');
            $this->db_logistik_pt->where(['BATAL !=' => 1, 'kodebar' => $kodebar, 'refpo' => $noref]);
            $this->db_logistik_pt->from('masukitem');
            $sumqty_lpb = $this->db_logistik_pt->get()->row();

            $result = $qty - $sumqty_lpb->qty_lpb;
            return $result;
      }

      public function updateStatusItemLpb_mutasi($no_ref_po, $kodebar)
      {
            //update status jadi 1 atau sudah abis qty lpb nya
            $this->db_logistik_center->set('status_item_lpb', 1);
            $this->db_logistik_center->where(['NO_REF' => $no_ref_po, 'kodebar' => $kodebar]);
            $this->db_logistik_center->update('tb_mutasi_item');

            $this->db_logistik_center->select('NO_REF');
            $this->db_logistik_center->where(['NO_REF' => $no_ref_po]);
            $this->db_logistik_center->from('tb_mutasi_item');
            $count_item_po = $this->db_logistik_center->count_all_results();

            $this->db_logistik_center->select_sum('status_item_lpb', 'sum_item_lpb');
            $this->db_logistik_center->where(['NO_REF' => $no_ref_po]);
            $this->db_logistik_center->from('tb_mutasi_item');
            $sumqty_lpb = $this->db_logistik_center->get()->row();

            if ($count_item_po == $sumqty_lpb->sum_item_lpb) {
                  $this->db_logistik_center->set('status_lpb', 1);
                  $this->db_logistik_center->where('NO_REF', $no_ref_po);
                  $this->db_logistik_center->update('tb_mutasi');
            }
      }

      public function updateStatusItemLpb2_mutasi($no_ref_po, $kodebar)
      {
            $this->db_logistik_center->set('status_item_lpb', 0);
            $this->db_logistik_center->where(['NO_REF' => $no_ref_po, 'kodebar' => $kodebar]);
            $this->db_logistik_center->update('tb_mutasi_item');

            $this->db_logistik_center->set('status_lpb', NULL);
            $this->db_logistik_center->where('NO_REF', $no_ref_po);
            $this->db_logistik_center->update('tb_mutasi');
      }
}

/* End of file M_lpb_mutasi.php */
