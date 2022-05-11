<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_spp extends CI_Model
{
    // Start Data Table Server Side
    var $table = 'kodebar'; //nama tabel dari database
    var $column_order = array(null, 'id', 'kodebar', 'nabar', 'grp', 'satuan'); //field yang ada di table user
    var $column_search = array('id', 'kodebar', 'nabar', 'grp'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {

        $this->db_logistik_center->from($this->table);

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

    public function cariDevisi()
    {
        $lokasi = $this->session->userdata('status_lokasi');
        $kode_dev = $this->session->userdata('kode_dev');

        if ($lokasi == 'HO') {
            $this->db_logistik_pt->select('PT, kodetxt');
            $this->db_logistik_pt->from('tb_devisi');
            $this->db_logistik_pt->order_by('kodetxt', 'ASC');
            return $this->db_logistik_pt->get()->result_array();
        } else {
            $this->db_logistik_pt->select('PT, kodetxt');
            $this->db_logistik_pt->where('kodetxt', $kode_dev);
            $this->db_logistik_pt->from('tb_devisi');
            $this->db_logistik_pt->order_by('kodetxt', 'ASC');
            return $this->db_logistik_pt->get()->result_array();
        }
    }

    public function dept()
    {
        $this->db_logistik_pt->select('kode, nama');
        $this->db_logistik_pt->from('dept');
        return $this->db_logistik_pt->get()->result_array();
    }

    public function namaDept($kd_dept)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->where('kode', $kd_dept);
        $this->db_logistik_pt->from('dept');
        return $this->db_logistik_pt->get()->row_array();
    }

    public function get_stok($kodebar, $txtperiode, $kode_dev)
    {
        $txtperiode = $this->session->userdata('ym_periode');

        $sql_sum_stok = "SELECT SUM(QTY_MASUK) AS qty_masuk, SUM(QTY_KELUAR) AS qty_keluar FROM stockawal_bulanan_devisi WHERE txtperiode <= '$txtperiode' AND kodebar = '$kodebar' AND kode_dev = '$kode_dev'";

        $stock_awal = $this->db_logistik_pt->query($sql_sum_stok)->row_array();

        $stok = $stock_awal['qty_masuk'] - $stock_awal['qty_keluar'];

        return $stok;
    }

    // public function stokAwal($kd_bar)
    // {
    //     $this->db_logistik_pt->select_sum('QTY_MASUK', 'qty_masuk');
    //     $this->db_logistik_pt->where('kodebartxt', $kd_bar);
    //     $this->db_logistik_pt->from('stockawal');
    //     return $this->db_logistik_pt->get()->row();
    // }

    // public function sumMasuk($kd_bar)
    // {
    //     $this->db_logistik_pt->select_sum('qty', 'stokmasuk');
    //     $this->db_logistik_pt->where('kodebartxt', $kd_bar);
    //     $this->db_logistik_pt->from('masukitem');
    //     return $this->db_logistik_pt->get()->row();
    // }

    // public function sumKeluar($kd_bar)
    // {
    //     $this->db_logistik_pt->select_sum('qty', 'stokkeluar');
    //     $this->db_logistik_pt->where('kodebartxt', $kd_bar);
    //     $this->db_logistik_pt->from('keluarbrgitem');
    //     return $this->db_logistik_pt->get()->row();
    // }

    public function saveSpp($data_ppo)
    {
        return $this->db_logistik_pt->insert('ppo', $data_ppo);
    }
    public function saveSpp_tmp($data_ppo)
    {
        return $this->db_logistik_center->insert('ppo_tmp', $data_ppo);
    }
    public function saveSppHistori($data_ppo_histori)
    {
        return $this->db_logistik_pt->insert('ppo_history', $data_ppo_histori);
    }

    public function saveSpp2($data_item_ppo)
    {
        return $this->db_logistik_pt->insert('item_ppo', $data_item_ppo);
    }
    public function saveSpp2_tmp($data_item_ppo)
    {
        return $this->db_logistik_center->insert('item_ppo_tmp', $data_item_ppo);
    }
    public function saveSpp3($data_item_ppo)
    {
        return $this->db_logistik_pt->insert('item_ppo_history', $data_item_ppo);
    }

    public function cancelUpdateItemSpp($id_item_ppo, $id_ppo)
    {
        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where('id', $id_item_ppo);
        $data_item_ppo =  $this->db_logistik_pt->get()->row_array();

        $this->db_logistik_pt->select('*');
        $this->db_logistik_pt->from('ppo');
        $this->db_logistik_pt->where('id', $id_ppo);
        $data_ppo =  $this->db_logistik_pt->get()->row_array();

        $data_return = [
            'data_item_ppo' => $data_item_ppo,
            'data_ppo' => $data_ppo,
        ];

        return $data_return;
    }

    public function updateSpp($id_ppo, $data_ppo)
    {
        $this->db_logistik_pt->where('id', $id_ppo);
        $this->db_logistik_pt->update('ppo', $data_ppo);
        return TRUE;
    }

    public function updateSpp2($id_item_ppo, $data_item_ppo)
    {
        $this->db_logistik_pt->where('id', $id_item_ppo);
        $this->db_logistik_pt->update('item_ppo', $data_item_ppo);
        return TRUE;
    }

    public function deleteSpp($noref_ppo)
    {
        $this->db_logistik_pt->delete('ppo', array('noreftxt' => $noref_ppo));
        $this->db_logistik_pt->delete('item_ppo', array('noreftxt' => $noref_ppo));
        return TRUE;
    }

    //new batal spp
    public function batalSpp($noref_ppo, $alasan)
    {
        $data = array('status' => 'BATAL', 'status2' => 5, 'nama_main' => $alasan);
        $this->db_logistik_pt->where('noreftxt', $noref_ppo);
        $this->db_logistik_pt->update('ppo', $data);
        return TRUE;
    }

    function update_alasan($noref_ppo, $alasan)
    {
        $data = array('nama_main' => $alasan);
        $this->db_logistik_pt->where('noreftxt', $noref_ppo);
        $this->db_logistik_pt->update('ppo', $data);
        return TRUE;
    }
    //end new batal spp

    public function cari_item_spp($kodebar, $noreftxt)
    {
        $this->db_logistik_pt->select('kodebar');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'noreftxt' => $noreftxt]);
        return $this->db_logistik_pt->get()->num_rows();
    }
    public function cari_item_spp_tmp($kodebar, $noreftxt)
    {
        $this->db_logistik_pt->select('kodebar');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where(['kodebar' => $kodebar, 'noreftxt' => $noreftxt]);
        return $this->db_logistik_pt->get()->num_rows();
    }

    public function urut_cetak($noppo)
    {
        $this->db_logistik_pt->set('main_acct', 'main_acct+1', FALSE);
        $this->db_logistik_pt->where('noppo', $noppo);
        $this->db_logistik_pt->update('ppo');

        $this->db_logistik_pt->select('main_acct');
        $this->db_logistik_pt->from('ppo');
        $this->db_logistik_pt->where('noppo', $noppo);
        return $this->db_logistik_pt->get()->row_array();
    }
    public function urut_cetak_no_coa($noppo)
    {
        $this->db_logistik_center->set('main_acct', 'main_acct+1', FALSE);
        $this->db_logistik_center->where('noppo', $noppo);
        $this->db_logistik_center->update('ppo_tmp');

        $this->db_logistik_center->select('main_acct');
        $this->db_logistik_center->from('ppo_tmp');
        $this->db_logistik_center->where('noppo', $noppo);
        return $this->db_logistik_center->get()->row_array();
    }

    public function cari_noref_itemppo($noref_spp)
    {
        $this->db_logistik_pt->select('noreftxt');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where(['noreftxt' => $noref_spp]);
        return $this->db_logistik_pt->get()->num_rows();
    }

    public function cek_status_approve($noref_spp)
    {
        $this->db_logistik_pt->select('noreftxt');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where(['noreftxt' => $noref_spp, 'status2' => '0']);
        $result = $this->db_logistik_pt->get()->num_rows();

        if ($result == 0) {
            $this->db_logistik_pt->set('status2', '1');
            $this->db_logistik_pt->where('noreftxt', $noref_spp);
            return $this->db_logistik_pt->update('ppo');
        }
    }

    public function cek_semua_approval($noref_spp)
    {
        $this->db_logistik_pt->select('noreftxt');
        $this->db_logistik_pt->from('item_ppo');
        $this->db_logistik_pt->where(['noreftxt' => $noref_spp, 'status2' => '0']);
        return $this->db_logistik_pt->get()->num_rows();
    }

    public function get_grp_coa()
    {
        $grp = $this->input->get('grp');
        $data = $this->db_logistik_center->query("SELECT DISTINCT(nama) FROM `noac` WHERE nama LIKE '%$grp%' AND `noac` LIKE '%1025%' AND `type` = 'G' ORDER BY NOID DESC")->result();
        return $data;
    }

    public function updateNocoa($data, $id, $alias)
    {
        $this->logistik_pt = $this->load->database('db_logistik_' . $alias, TRUE);
        $this->logistik_pt->set($data);
        $this->logistik_pt->where('id', $id);
        return $this->logistik_pt->update('item_ppo');

        // $this->db_logistik_center->set($data);
        // $this->db_logistik_center->where('id', $id);
        // return $this->db_logistik_center->update('item_ppo');
    }

    public function update_spp_tmp($noref, $kodebar, $spp_tmp, $pt, $alias)
    {


        # code...
        $this->db_logistik_center->set($spp_tmp);
        $this->db_logistik_center->where([
            'noreftxt' => $noref,
            'kodebar' => $kodebar,
            'namapt' => $pt
        ]);
        return $this->db_logistik_center->update('item_ppo_tmp');
    }

    public function cari_spp($noref)
    {
        $data = $this->db_logistik_pt->query("SELECT * FROM `ppo` WHERE noreftxt='$noref' ORDER BY id DESC")->num_rows();
        return $data;
    }

    public function update_spp($noref)
    {
        $data = array('status2' => '9');
        $this->db_logistik_pt->set($data);
        $this->db_logistik_pt->where('noreftxt', $noref);
        return $this->db_logistik_pt->update('ppo');
        # code...
    }
}

/* End of file M_spp.php */
