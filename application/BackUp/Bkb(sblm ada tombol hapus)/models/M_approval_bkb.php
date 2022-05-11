<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_approval_bkb extends CI_Model
{

    var $table = 'keluarbrgitem'; //nama tabel dari database
    // var $column_order = array(null, 'keluarbrgitem.id', 'keluarbrgitem.NO_REF',  'keluarbrgitem.kodebar', 'keluarbrgitem.nabar', 'keluarbrgitem.satuan', 'keluarbrgitem.qty', 'keluarbrgitem.qty2', 'approval_bkb.status_kasie_gudang'); //field yang ada di table supplier  
    var $column_search = array('keluarbrgitem.id', 'keluarbrgitem.NO_REF', 'keluarbrgitem.kodebar', 'keluarbrgitem.nabar', 'keluarbrgitem.satuan', 'keluarbrgitem.qty', 'keluarbrgitem.qty2', 'approval_bkb.status_kasie_gudang'); //field yang diizin untuk pencarian 
    var $order = array('keluarbrgitem.id' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getWhere($no_ref)
    {
        $this->n_r = $no_ref;
    }

    private function _get_datatables_query()
    {
        $no_ref = $this->n_r;
        $this->db_logistik_pt->select('keluarbrgitem.id, keluarbrgitem.SKBTXT, keluarbrgitem.NO_REF, keluarbrgitem.kodebar, keluarbrgitem.nabar, keluarbrgitem.satuan, keluarbrgitem.qty, keluarbrgitem.qty2, approval_bkb.status_kasie_gudang, approval_bkb.tgl_kasie_gudang');
        $this->db_logistik_pt->from($this->table);
        $this->db_logistik_pt->join('approval_bkb', 'approval_bkb.no_id_item_bkb = keluarbrgitem.id', 'left');
        $this->db_logistik_pt->where('keluarbrgitem.NO_REF', $no_ref);

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

    public function get_noref($id_stockkeluar)
    {
        $this->db_logistik_pt->select('NO_REF');
        $this->db_logistik_pt->from('stockkeluar');
        $this->db_logistik_pt->where('id', $id_stockkeluar);
        return $this->db_logistik_pt->get()->row_array();
    }

    public function approval_bkb($id_item_bkb)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->where('no_id_item_bkb', $id_item_bkb);
        $this->db_logistik_pt->from('approval_bkb');
        $cek = $this->db_logistik_pt->get()->num_rows();

        if ($cek >= 1) {
            $cek_r = 0;
            return $cek_r;
        } else {
            $this->db_logistik_pt->select('*');
            $this->db_logistik_pt->from('keluarbrgitem');
            $this->db_logistik_pt->where('id', $id_item_bkb);
            $data_item_bkb = $this->db_logistik_pt->get()->row_array();

            $insert_bkb_approval = [
                'no_id_item_bkb' => $id_item_bkb,
                'no_bkb' => $data_item_bkb['SKBTXT'],
                'no_ref_bkb' => $data_item_bkb['NO_REF'],
                'kodebar' => $data_item_bkb['kodebar'],
                'nabar' => $data_item_bkb['nabar'],
                'qty_diminta' => $data_item_bkb['qty'],
                'status_kasie_gudang' => '1',
                'tgl_kasie_gudang' => date("Y-m-d H:i:s")
            ];
            return $this->db_logistik_pt->insert('approval_bkb', $insert_bkb_approval);
        }
    }

    public function rev_qty($no_ref_bpb, $kodebar, $qty_rev)
    {
        $user = $this->session->userdata('user');

        $this->db_logistik_pt->set('flag_req_rev_qty', '1');
        $this->db_logistik_pt->set('user_req_rev_qty', $user);
        $this->db_logistik_pt->set('qty_rev', $qty_rev);
        $this->db_logistik_pt->where(['norefbpb' => $no_ref_bpb, 'kodebar' => $kodebar]);
        $this->db_logistik_pt->update('approval_bpb');

        $this->db_logistik_pt->set('req_rev_qty_item', '1');
        $this->db_logistik_pt->where(['norefbpb' => $no_ref_bpb, 'kodebar' => $kodebar]);
        $this->db_logistik_pt->update('bpbitem');

        return true;
    }
}

/* End of file M_approval_bkb.php */
