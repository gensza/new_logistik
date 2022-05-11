<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_bpb_mutasi extends CI_Model
{

      // Start Data Table Server Side
      var $table = 'bpb_mutasi'; //nama tabel dari database
      var $column_order = array(null, 'bpb_mutasi.norefbpb', 'bpb_mutasi.tglbpb', 'bpb_mutasi.bag', 'bpb_mutasi.keperluan', 'bpb_mutasi.status_mutasi', 'bpb_mutasi.kode_dev', 'bpb_mutasi.kode_pt_req_mutasi', 'bpbitem_mutasi.ketsub'); //field yang ada di table user
      var $column_search = array('bpb_mutasi.norefbpb', 'bpb_mutasi.tglbpb', 'bpb_mutasi.bag', 'bpb_mutasi.keperluan', 'bpb_mutasi.status_mutasi', 'bpb_mutasi.kode_dev', 'bpb_mutasi.kode_pt_req_mutasi', 'bpbitem_mutasi.ketsub'); //field yang diizin untuk pencarian 
      var $order = array('bpb_mutasi.norefbpb'  => 'DESC'); // default order 

      public function __construct()
      {
            parent::__construct();
            $this->load->database();
      }

      private function _get_datatables_query()
      {

            $this->db_logistik_center->distinct();
            $this->db_logistik_center->select('bpb_mutasi.norefbpb, bpb_mutasi.tglbpb, bpb_mutasi.bag, bpb_mutasi.keperluan, bpb_mutasi.status_mutasi, bpb_mutasi.kode_dev, bpb_mutasi.kode_pt_req_mutasi, bpbitem_mutasi.ketsub');
            $this->db_logistik_center->from($this->table);
            $this->db_logistik_center->join('bpbitem_mutasi', 'bpb_mutasi.norefbpb = bpbitem_mutasi.norefbpb', 'left');
            $this->db_logistik_center->where(['bpb_mutasi.status_bkb' => '0', 'bpb_mutasi.approval' => '1']);

            // $this->db_logistik_center->group_by('bpb_mutasi.norefbpb');
            // $this->db_logistik_center->query("SELECT distinct bpb_mutasi.norefbpb, bpb_mutasi.tglbpb, bpb_mutasi.bag, bpb_mutasi.keperluan FROM bpb_mutasi left join bpbitem_mutasi ON bpb_mutasi.norefbpb = bpbitem_mutasi.norefbpb where bpbitem_mutasi.ketsub = 'PSAM, PT'");

            $i = 0;

            foreach ($this->column_search as $item) // looping awal
            {
                  if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
                  {

                        if ($i === 0) // looping awal
                        {
                              $this->db_logistik_center->group_start();
                              $this->db_logistik_center->like($item, $_POST['search']['value']);
                        } else {
                              $this->db_logistik_center->or_like($item, $_POST['search']['value']);
                        }

                        if (count($this->column_search) - 1 == $i)
                              $this->db_logistik_center->group_end();
                  }
                  $i++;
            }

            if (isset($_POST['order'])) {
                  $this->db_logistik_center->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else if (isset($this->order)) {
                  $order = $this->order;
                  $this->db_logistik_center->order_by(key($order), $order[key($order)]);
            }
      }

      function get_datatables()
      {
            $this->_get_datatables_query();
            if ($_POST['length'] != -1)
                  $this->db_logistik_center->limit($_POST['length'], $_POST['start']);
            $query = $this->db_logistik_center->get();
            return $query->result();
      }

      function count_filtered()
      {
            $this->_get_datatables_query();
            $query = $this->db_logistik_center->get();
            return $query->num_rows();
      }

      public function count_all()
      {
            $this->db_logistik_center->from($this->table);
            return $this->db_logistik_center->count_all_results();
      }
      //End Data Table Server Side
}

/* End of file M_bpb_mutasi.php */
