<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_cari_bkbitem extends CI_Model
{

      // Start Data Table Server Side
      var $table = 'keluarbrgitem'; //nama tabel dari database
      var $column_order = array(null, 'id', 'kodebar', 'nabar', 'grp', 'satuan', 'qty2', 'afd', 'blok', 'kodebeban', 'ketbeban', 'kodesub', 'ketsub', 'kode_dev', 'txtperiode', 'NO_REF', 'tmtbm', 'thntanam'); //field yang ada di table user
      var $column_search = array('id', 'kodebar', 'nabar', 'grp', 'satuan', 'qty2', 'afd', 'blok', 'kodebeban', 'ketbeban', 'kodesub', 'ketsub', 'kode_dev', 'txtperiode', 'NO_REF', 'tmtbm', 'thntanam'); //field yang diizin untuk pencarian 
      var $order = array('id' => 'asc'); // default order 

      public function __construct()
      {
            parent::__construct();
            $this->load->database();
      }

      public function getWhere($norefbpb)
      {
            $this->n_r = $norefbpb;
      }

      private function _get_datatables_query()
      {
            $norefbpb = $this->n_r;
            $this->db_logistik_pt->where('NO_REF', $norefbpb);
            $this->db_logistik_pt->from($this->table);

            $i = 0;

            foreach ($this->column_search as $item) // looping awal
            {
                  if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
                  {

                        if ($i === 0) // looping awal
                        {
                              $this->db_logistik_pt->group_start();
                              $this->db_logistik_pt->like($item, $_POST['search']['value']);
                        } else {
                              $this->db_logistik_pt->or_like($item, $_POST['search']['value']);
                        }

                        if (count($this->column_search) - 1 == $i)
                              $this->db_logistik_pt->group_end();
                  }
                  $i++;
            }

            if (isset($_POST['order'])) {
                  $this->db_logistik_pt->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else if (isset($this->order)) {
                  $order = $this->order;
                  $this->db_logistik_pt->order_by(key($order), $order[key($order)]);
            }
      }

      function get_datatables()
      {
            $this->_get_datatables_query();
            if ($_POST['length'] != -1)
                  $this->db_logistik_pt->limit($_POST['length'], $_POST['start']);
            $query = $this->db_logistik_pt->get();
            return $query->result();
      }

      function count_filtered()
      {
            $this->_get_datatables_query();
            $query = $this->db_logistik_pt->get();
            return $query->num_rows();
      }

      public function count_all()
      {
            $this->db_logistik_pt->from($this->table);
            return $this->db_logistik_pt->count_all_results();
      }
      //End Data Table Server Side

}

/* End of file M_cari_bkbitem.php */
