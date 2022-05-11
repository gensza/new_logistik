<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_approval_retur extends CI_Model
{
      var $table = 'ret_skbitem'; //nama tabel dari database
      // var $column_order = array(null, 'id', 'kodebar', 'nabar', 'satuan', 'qty', 'ket'); //field yang ada di table supplier  
      var $column_search = array('ret_skbitem.id', 'ret_skbitem.kodebar', 'ret_skbitem.nabar', 'ret_skbitem.satuan', 'ret_skbitem.qty', 'ret_skbitem.ket', 'approval_retur.status_kasie_gudang', 'approval_retur.tgl_kasie_gudang'); //field yang diizin untuk pencarian 
      var $order = array('ret_skbitem.id' => 'DESC'); // default order 

      public function __construct()
      {
            parent::__construct();
            $this->load->database();
      }

      public function getWhere($norefretur)
      {
            $this->n_r = $norefretur;
      }

      private function _get_datatables_query()
      {
            $norefretur = $this->n_r;
            $this->db_logistik_pt->select('ret_skbitem.id, ret_skbitem.kodebar, ret_skbitem.nabar, ret_skbitem.satuan, ret_skbitem.qty, ret_skbitem.ket, approval_retur.status_kasie_gudang, approval_retur.tgl_kasie_gudang');
            $this->db_logistik_pt->from($this->table);
            $this->db_logistik_pt->join('approval_retur', 'approval_retur.id_ret_skbitem = ret_skbitem.id', 'left');
            $this->db_logistik_pt->where('ret_skbitem.norefretur', $norefretur);

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

      public function get_noref($id_retskb)
      {
            $this->db_logistik_pt->select('norefretur');
            $this->db_logistik_pt->from('retskb');
            $this->db_logistik_pt->where('id', $id_retskb);
            return $this->db_logistik_pt->get()->row_array();
      }

      public function approval_retur($id_ret_skbitem)
      {
            $this->db_logistik_pt->select('id_ret_skbitem');
            $this->db_logistik_pt->where('id_ret_skbitem', $id_ret_skbitem);
            $this->db_logistik_pt->from('approval_retur');
            $cek = $this->db_logistik_pt->get()->num_rows();

            if ($cek >= 1) {
                  $cek_r = 0;
                  return $cek_r;
            } else {

                  $this->db_logistik_pt->select('*');
                  $this->db_logistik_pt->from('ret_skbitem');
                  $this->db_logistik_pt->where('id', $id_ret_skbitem);
                  $data_item_retur = $this->db_logistik_pt->get()->row_array();
                  $norefretur = $data_item_retur['norefretur'];

                  $insert_retur_approval = [
                        'id_ret_skbitem' => $id_ret_skbitem,
                        'noretur' => $data_item_retur['noretur'],
                        'norefretur' => $data_item_retur['norefretur'],
                        'kodebar' => $data_item_retur['kodebar'],
                        'nabar' => $data_item_retur['nabar'],
                        'qty' => $data_item_retur['qty'],
                        'status_kasie_gudang' => '1',
                        'tgl_kasie_gudang' => date("Y-m-d H:i:s")
                  ];

                  $this->db_logistik_pt->insert('approval_retur', $insert_retur_approval);

                  //update status approve di retskb jadi 1 (approved)
                  $this->db_logistik_pt->set('status_approval', '1');
                  $this->db_logistik_pt->where('norefretur', $norefretur);
                  return $this->db_logistik_pt->update('retskb');
            }
      }
}

/* End of file M_data_retur.php */
