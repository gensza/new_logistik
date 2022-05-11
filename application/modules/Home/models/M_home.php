<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{
    // Start Data Table Server Side
    var $table = 'tb_mutasi'; //nama tabel dari database
    var $column_order = array(null, 'tgl', 'no_mutasi', 'pt', 'devisi', 'pt_mutasi', 'devisi_mutasi'); //field yang ada di table user
    var $column_search = array('tgl', 'no_mutasi', 'pt', 'devisi', 'pt_mutasi', 'devisi_mutasi'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query()
    {
        $kode_pt_login = $this->session->userdata('kode_pt_login');
        $kode_dev = $this->session->userdata('kode_dev');
        $lokasi = $this->session->userdata('status_lokasi');

        if ($lokasi == 'SITE') {
            $noref = 'EST';
            # code...
        } elseif ($lokasi == 'PKS') {
            # code...
            $noref = 'FAC';
        } elseif ($lokasi == 'RO') {
            # code...
            $noref = 'ROM';
        }

        if ($lokasi != 'HO') {
            // $this->db_logistik_center->like('no_mutasi', $noref, 'both');
            $this->db_logistik_center->where(['kode_pt_mutasi' => $kode_pt_login, 'status_lpb' => 0, 'kode_devisi_mutasi' => $kode_dev]);
            $this->db_logistik_center->from($this->table);
            # code...
        } else {
            $this->db_logistik_center->where(['kode_pt_mutasi' => $kode_pt_login, 'status_lpb' => 0]);
            $this->db_logistik_center->from($this->table);
        }


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

    public function count_spp()
    {
        $role_user = $this->session->userdata('user');
        $lokasi = $this->session->userdata('status_lokasi');
        $kode_dev = $this->session->userdata('kode_dev');
        $kode_dept = $this->session->userdata('kode_dept');

        $this->db_logistik_pt->select('noreftxt');
        $this->db_logistik_pt->where('status2', '0');
        // $this->db_logistik_pt->where('kodedept', $kode_dept);
        if ($lokasi == 'HO') {
            $this->db_logistik_pt->where('jenis !=', 'SPPI');
            $this->db_logistik_pt->like('lokasi', 'HO');
        } elseif ($lokasi == 'SITE') {
            $this->db_logistik_pt->like('noreftxt', 'EST', 'both');
        } elseif ($lokasi == 'PKS') {
            $this->db_logistik_pt->like('noreftxt', 'FAC', 'both');
        } elseif ($lokasi == 'RO') {
            $this->db_logistik_pt->like('noreftxt', 'ROM', 'both');
        }
        if ($lokasi != 'HO') {
            $this->db_logistik_pt->where('kode_dev', $kode_dev);
        }
        $this->db_logistik_pt->from('ppo');
        $count_spp = $this->db_logistik_pt->count_all_results();

        $pt = $this->session->userdata('devisi');
        $dept = $this->session->userdata('nama_dept');
        if ($lokasi != 'HO') {
            $this->db_logistik_center->like('pt', $pt);
        }
        $this->db_logistik_center->where('namadept', $dept);
        $this->db_logistik_center->from('ppo_tmp');
        $count_spp_no_coa = $this->db_logistik_center->count_all_results();


        $this->db_logistik_pt->select('noreftxt');
        $this->db_logistik_pt->where('status2', '1');
        if ($lokasi == 'HO') {
            $this->db_logistik_pt->where('jenis !=', 'SPPI');
        } elseif ($lokasi == 'SITE') {
            $this->db_logistik_pt->like('noreftxt', 'EST', 'both');
        } elseif ($lokasi == 'PKS') {
            $this->db_logistik_pt->like('noreftxt', 'FAC', 'both');
        } elseif ($lokasi == 'RO') {
            $this->db_logistik_pt->like('noreftxt', 'ROM', 'both');
        }
        if ($lokasi != 'HO') {
            $this->db_logistik_pt->where('kode_dev', $kode_dev);
        }
        $this->db_logistik_pt->from('ppo');
        $count_spp_approved = $this->db_logistik_pt->count_all_results();

        $this->db_logistik_pt->select('noreftxt');
        $this->db_logistik_pt->from('po');
        if ($lokasi == 'SITE') {
            $this->db_logistik_pt->like('noreftxt', 'EST', 'both');
            $this->db_logistik_pt->where('kirim', '1');
            # code...
        } else if ($lokasi == 'PKS') {
            $this->db_logistik_pt->like('noreftxt', 'FAC', 'both');
            $this->db_logistik_pt->where('kirim', '1');
            # code...
        } else if ($lokasi == 'RO') {
            $this->db_logistik_pt->like('noreftxt', 'ROM', 'both');
            $this->db_logistik_pt->where('kirim', '1');
            # code...
        }
        $count_po = $this->db_logistik_pt->count_all_results();

        $this->db_logistik_pt->select('noreftxt');
        $this->db_logistik_pt->from('stokmasuk');
        if ($lokasi != 'HO') {
            if ($lokasi == 'SITE') {
                $this->db_logistik_pt->like('noref', 'EST', 'both');
            } elseif ($lokasi == 'PKS') {
                $this->db_logistik_pt->like('noref', 'FAC', 'both');
            } elseif ($lokasi == 'RO') {
                $this->db_logistik_pt->like('noref', 'ROM', 'both');
            }
        }
        if ($lokasi != 'HO') {
            $this->db_logistik_pt->where('kode_dev', $kode_dev);
        }
        $count_lpb = $this->db_logistik_pt->count_all_results();

        $this->db_logistik_pt->select('norefbpb');
        $this->db_logistik_pt->from('bpb');
        $this->db_logistik_pt->where(['approval' => '0']);
        $count_bpb = $this->db_logistik_pt->count_all_results();

        $this->db_logistik_pt->select('norefbpb');
        $this->db_logistik_pt->from('bpb');
        $this->db_logistik_pt->where(['approval' => '1']);
        $count_bpb_approved = $this->db_logistik_pt->count_all_results();

        $this->db_logistik_pt->select('NO_REF');
        $this->db_logistik_pt->from('stockkeluar');
        if ($lokasi != 'HO') {
            $this->db_logistik_pt->where('kode_dev', $kode_dev);
        }
        $count_bkb = $this->db_logistik_pt->count_all_results();

        $this->db_logistik_pt->select('norefbpb');
        $this->db_logistik_pt->from('approval_bpb');
        $this->db_logistik_pt->where(['flag_req_rev_qty' => '1']);
        $count_bkb_rev_qty = $this->db_logistik_pt->count_all_results();

        $this->db_logistik_pt->select('no_pp');
        $this->db_logistik_pt->from('pp');
        $this->db_logistik_pt->where(['user' => $role_user]);
        $count_pp = $this->db_logistik_pt->count_all_results();

        $result = [
            'count_spp' => $count_spp,
            'count_spp_no_coa' => $count_spp_no_coa,
            'count_pp' => $count_pp,
            'count_spp_approved' => $count_spp_approved,
            'count_po' => $count_po,
            'count_lpb' => $count_lpb,
            'count_bpb' => $count_bpb,
            'count_bpb_approved' => $count_bpb_approved,
            'count_bkb' => $count_bkb,
            'count_bkb_rev_qty' => $count_bkb_rev_qty
        ];
        return $result;
    }

    public function get_grp_coa()
    {
        $grp = $this->input->get('grp');
        $data = $this->db_logistik_center->query("SELECT DISTINCT(nama) FROM `noac` WHERE nama LIKE '%$grp%' AND `noac` LIKE '%1025%' AND `type` LIKE 'G' ORDER BY NOID DESC")->result();
        return $data;
    }
}

/* End of file M_home.php */
