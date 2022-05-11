<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pp extends CI_Model
{

    var $table = 'po'; //nama tabel dari database
    var $column_order = array(null, 'id', 'tglpo', 'nopotxt', 'noreftxt', 'kode_supply', 'nama_supply', 'totalbayar', 'bayar', 'grup', 'terbayar', 'ppn', 'jenis_spp'); //field yang ada di table supplier  
    var $column_search = array('noreftxt', 'nopotxt', 'nama_supply', 'tglpo'); //field yang diizin untuk pencarian 
    var $order = array('id' => 'DESC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set('Asia/Jakarta');
    }

    private function _get_datatables_query()
    {
        // $Value = ;
        $txtperiode = $this->session->userdata('ym_periode');
        $lokasi_sesi = $this->session->userdata('status_lokasi');
        $this->db_logistik_pt->from($this->table);
        if ($lokasi_sesi == 'HO') {
            $this->db_logistik_pt->where('jenis_spp !=', 'SPPI');
            // $this->db_logistik_pt->where('terbayar !=', '1');
            $this->db_logistik_pt->where('batal !=', '1');
            $this->db_logistik_pt->where('periodetxt', $txtperiode);
        } else {
            # code...
            if ($lokasi_sesi == 'SITE') {
                $this->db_logistik_pt->where_in('jenis_spp', array('SPPI', 'SPPA', 'SPPK'));
                $this->db_logistik_pt->like('noreftxt', 'EST', 'both');
                $this->db_logistik_pt->where('kirim', '1');
                // $this->db_logistik_pt->where('terbayar !=', '1');
                $this->db_logistik_pt->where('batal !=', '1');
                $this->db_logistik_pt->where('periodetxt', $txtperiode);
                # code...
            } else if ($lokasi_sesi == 'PKS') {
                $this->db_logistik_pt->where_in('jenis_spp', array('SPPI', 'SPPA', 'SPPK'));
                $this->db_logistik_pt->like('noreftxt', 'FAC', 'both');
                $this->db_logistik_pt->where('kirim', '1');
                // $this->db_logistik_pt->where('terbayar !=', '1');
                $this->db_logistik_pt->where('batal !=', '1');
                $this->db_logistik_pt->where('periodetxt', $txtperiode);
                # code...
            } else if ($lokasi_sesi == 'RO') {
                $this->db_logistik_pt->where_in('jenis_spp', array('SPPI', 'SPPA', 'SPPK'));
                $this->db_logistik_pt->like('noreftxt', 'ROM', 'both');
                $this->db_logistik_pt->where('kirim', '1');
                // $this->db_logistik_pt->where('terbayar !=', '1');
                $this->db_logistik_pt->where('batal !=', '1');
                $this->db_logistik_pt->where('periodetxt', $txtperiode);
                # code...
            }
        }


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

    function caripo($noref)
    {
        $data = $this->db_logistik_pt->query("SELECT id, tglpo, nopo,noreftxt, nopotxt, kode_supply, nama_supply, bayar, totalbayar, ppn, pph FROM po WHERE noreftxt='$noref' ")->row();
        return $data;
    }

    function ambilpo($id, $noref)
    {
        $data = $this->db_logistik_pt->query("SELECT id, tglpo, nopo,noreftxt, nopotxt, kode_supply, nama_supply, bayar, totalbayar, ppn, pph, jenis_spp FROM po WHERE id='$id' AND noreftxt='$noref' ")->row();
        return $data;
    }

    function ambilpoqr($noref)
    {
        $data = $this->db_logistik_pt->query("SELECT id, tglpo, nopo,noreftxt, nopotxt, kode_supply, nama_supply, bayar, totalbayar, ppn, pph, jenis_spp, terbayar FROM po WHERE  noreftxt='$noref' ")->row();
        return $data;
    }
    function simpan_pp()
    {
        $query_id_pp = "SELECT MAX(id)+1 as id_pp FROM pp";
        $generate_id_pp = $this->db_logistik_pt->query($query_id_pp)->row();
        $id_pp = $generate_id_pp->id_pp;
        if (empty($id_pp)) {
            $id_pp = 1;
        }

        $sess_lokasi = $this->session->userdata('status_lokasi');

        $kode_devisi =  $this->session->userdata('kode_dev');
        $data['devisi'] = $this->db_logistik_pt->get_where('tb_devisi', array('kodetxt' => $kode_devisi))->row_array();



        if ($sess_lokasi == "HO") {
            $text1 = "PST";
            $text2 = "BWJ";
            $dig_1 = "1";
            $dig_2 = "1";
        } else if ($sess_lokasi == "SITE") {
            $text1 = "EST";
            $text2 = "SWJ";
            $dig_1 = "6";
            $dig_2 = "6";
        } else if ($sess_lokasi == "RO") {
            $text1 = "ROM";
            $text2 = "PKY";
            $dig_1 = "2";
            $dig_2 = "2";
        } else if ($sess_lokasi == "PKS") {
            $text1 = "FAC";
            $text2 = "SWJ";
            $dig_1 = "3";
            $dig_2 = "3";
        }

        $query_no_pp = "SELECT MAX(SUBSTR(nopptxt,3,4)) AS max_id_pp FROM pp ORDER BY id DESC";
        $generate_id_pp = $this->db_logistik_pt->query($query_no_pp)->row();
        $noUrut_pp = (int)($generate_id_pp->max_id_pp);
        $noUrut_pp++;
        $print_pp = sprintf("%04s", $noUrut_pp);
        $format_m_y = date("m/Y");

        if (empty($this->input->post('hidden_no_pp'))) {
            $nopp = $dig_1 . $dig_2 . $print_pp;
        } else {
            $nopp = $this->input->post('hidden_no_pp');
        }

        if (empty($this->input->post('hidden_refpp'))) {
            $refpp = $text1 . "-PP/" . $text2 . "/" . $format_m_y . "/" . $dig_1 . $dig_2 . $print_pp; //EST-BKB/SWJ/06/15/001159 atau //EST-BKB/SWJ/10/18/71722
        } else {
            $refpp = $this->input->post('hidden_refpp');
        }


        $tglpp = date("Y-m-d H:i:s", strtotime($this->input->post('txt_tgl_pp')));
        $tglpptxt = date("Ymd", strtotime($this->input->post('txt_tgl_pp')));
        $tglpo = date("Y-m-d H:i:s", strtotime($this->input->post('txt_tgl_po')));
        $tglpotxt = date("Ymd", strtotime($this->input->post('txt_tgl_po')));
        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');

        if (!empty($this->input->post('txt_tgl_voucher'))) {
            $tgl_vou = date("Y-m-d", strtotime($this->input->post('txt_tgl_voucher')));
            $tgl_voutxt = date("Ymd", strtotime($this->input->post('txt_tgl_voucher')));
        } else {
            $tgl_vou = NULL;
            $tgl_voutxt = NULL;
        }

        if ($this->input->post('txt_no_voucher')) {
            $no_vou = $this->input->post('txt_no_voucher');
        } else {
            $no_vou = NULL;
        }

        $jumlah = $this->input->post('txt_jumlah');
        $jum = $this->input->post('jumlah');
        $jumlahplus = $this->input->post('jumlahplus');

        $total_po = $this->input->post('txt_total_po');

        $data_pp['id']              = $id_pp;
        $data_pp['nopp']            = $nopp;
        $data_pp['nopptxt']         = $nopp;
        $data_pp['nopo']            = $this->input->post('hidden_no_po');
        $data_pp['nopotxt']         = $this->input->post('hidden_no_po');
        $data_pp['tglpp']           = $tglpp;
        $data_pp['tglpptxt']        = $tglpptxt;
        $data_pp['tglpo']           = $tglpo;
        $data_pp['tglpotxt']        = $tglpotxt;
        $data_pp['ref_pp']          = $refpp;
        $data_pp['ref_po']          = $this->input->post('txt_no_ref_po');
        $data_pp['kode_supply']     = $this->input->post('kd_supplier');
        $data_pp['kode_supplytxt']  = $this->input->post('kd_supplier');
        $data_pp['nama_supply']     = $this->input->post('txt_supplier');
        $data_pp['kepada']          = $this->input->post('txt_dibayar_ke');
        $data_pp['bayar']           = $this->input->post('txt_pembayaran');
        $data_pp['KURS']            = $this->input->post('hidden_kurs');
        $data_pp['jumlah']          = $jumlah;
        $data_pp['pajak']           = $this->input->post('txt_pajak');
        $data_pp['jumlahpo']        = $this->input->post('txt_nilai_po');
        $data_pp['KODE_BPO']        = $this->input->post('txt_nilai_bpo1');
        $data_pp['jumlah_bpo']      = $this->input->post('txt_nilai_bpo2');
        $data_pp['total_po']        = $total_po;
        $data_pp['terbilang']       = $this->input->post('txt_terbilang');
        $data_pp['ket']             = $this->input->post('txt_keterangan');
        // $data_pp['pt']              = $this->session->userdata('app_pt')." ".$this->session->userdata('status_lokasi');
        $data_pp['pt']              = $data['devisi']['PT'];
        $data_pp['kodept']          = $kode_devisi;
        $data_pp['periode']         = $periode . " 00:00:00";
        $data_pp['txtperiode']      = $txtperiode;
        $data_pp['user']            = $this->session->userdata('user');
        $data_pp['tglisi']          = date("Y-m-d H:i:s");
        $data_pp['status_vou']      = "0";
        // $data_pp['status_vou']      = "1";
        $data_pp['no_vou']          = $no_vou;
        $data_pp['no_voutxt']       = $no_vou;
        $data_pp['tgl_vou']         = $tgl_vou;
        $data_pp['tgl_voutxt']      = $tgl_voutxt;
        $data_pp['tgl_bayar_real']  = NULL;
        $data_pp['kasir_bayar']     = $this->input->post('txt_jumlah');
        $data_pp['kode_budget']     = "0";
        $data_pp['grup']            = $this->input->post('hidden_grup');
        $data_pp['main_account']    = $this->input->post('hidden_main_account');
        $data_pp['nama_account']    = $this->input->post('hidden_nama_account');
        $data_pp['batal']           = "0";

        //cek po
        $id_po = $this->input->post('hidden_id_po');
        $noref_po = $this->input->post('txt_no_ref_po');
        $ambilpo = $this->db_logistik_pt->query("SELECT terbayar FROM po WHERE id='$id_po' AND noreftxt='$noref_po'")->row();
        $hasil = $ambilpo->terbayar;

        $tot_terbayar = 1;


        $query_id_logistik_caba = "SELECT max(id)+1 as new_id FROM pp_logistik";
        $data_logistik_caba = $this->db_caba->query($query_id_logistik_caba)->row();

        $id_pplogistik_caba = $data_logistik_caba->new_id;
        if (empty($data_logistik_caba->new_id)) {
            $id_pplogistik_caba = "1";
        }

        $data_pplogistikdicaba['id']                = $id_pplogistik_caba;
        $data_pplogistikdicaba['RM']                = "0";
        $data_pplogistikdicaba['nopp']              = $nopp;
        $data_pplogistikdicaba['nopptxt']           = $nopp;
        $data_pplogistikdicaba['nopo']              = $this->input->post('hidden_no_po');
        $data_pplogistikdicaba['nopotxt']           = $this->input->post('hidden_no_po');
        $data_pplogistikdicaba['ref_pp']            = $refpp;
        $data_pplogistikdicaba['ref_po']            = $this->input->post('txt_no_ref_po');
        $data_pplogistikdicaba['tglpp']             = $tglpp;
        $data_pplogistikdicaba['tglpptxt']          = $tglpptxt;
        $data_pplogistikdicaba['tglpo']             = $tglpo;
        $data_pplogistikdicaba['tglpotxt']          = $tglpotxt;
        $data_pplogistikdicaba['kode_supply']       = $this->input->post('kd_supplier');
        $data_pplogistikdicaba['kode_supplytxt']    = $this->input->post('kd_supplier');
        $data_pplogistikdicaba['nama_supply']       = $this->input->post('txt_supplier');
        $data_pplogistikdicaba['kepada']            = $this->input->post('txt_dibayar_ke');
        $data_pplogistikdicaba['bayar']             = $this->input->post('txt_pembayaran');
        $data_pplogistikdicaba['jumlah']            = $jumlah;
        $data_pplogistikdicaba['PAJAK']             = $this->input->post('txt_pajak');
        $data_pplogistikdicaba['COA_PAJAK']         = NULL;
        $data_pplogistikdicaba['jumlahpo']          = $this->input->post('txt_nilai_po');
        $data_pplogistikdicaba['HARGAPO']           = $this->input->post('txt_nilai_po');
        $data_pplogistikdicaba['terbilang']         = $this->input->post('txt_terbilang');
        $data_pplogistikdicaba['ket']               = $this->input->post('txt_keterangan');
        // $data_pplogistikdicaba['pt']                = $this->session->userdata('app_pt')." ".$this->session->userdata('status_lokasi');
        $data_pplogistikdicaba['pt']                = $data['devisi']['PT'];
        $data_pplogistikdicaba['kodept']            = $kode_devisi;
        $data_pplogistikdicaba['periode']           = $periode . " 00:00:00";
        $data_pplogistikdicaba['txtperiode']        = $txtperiode;
        $data_pplogistikdicaba['user']              = $this->session->userdata('user');
        $data_pplogistikdicaba['tglisi']            = date("Y-m-d H:i:s");
        $data_pplogistikdicaba['status_vou']        = "0";
        // $data_pplogistikdicaba['no_vou']            = $no_vou;
        // $data_pplogistikdicaba['no_voutxt']         = $no_vou;
        // $data_pplogistikdicaba['tgl_vou']           = $tgl_vou;
        // $data_pplogistikdicaba['tgl_voutxt']        = $tgl_voutxt;
        $data_pplogistikdicaba['TGL_BAYAR_REAL']    = NULL;
        $data_pplogistikdicaba['kode_budget']       = "0";
        $data_pplogistikdicaba['grup']              = $this->input->post('hidden_grup');
        $data_pplogistikdicaba['main_account']      = $this->input->post('hidden_main_account');
        $data_pplogistikdicaba['nama_account']      = $this->input->post('hidden_nama_account');
        $data_pplogistikdicaba['jum_bpo']           = $this->input->post('txt_nilai_bpo2');
        $data_pplogistikdicaba['kode_bpo']          = $this->input->post('txt_nilai_bpo1');
        $data_pplogistikdicaba['ket_bpo']           = "Biaya atas PO:" . $this->input->post('txt_no_ref_po');
        $data_pplogistikdicaba['batal']             = "0";

        if (empty($this->input->post('hidden_no_pp'))) {
            $this->db_logistik_pt->insert('pp', $data_pp);
            if ($this->db_logistik_pt->affected_rows() > 0) {
                $bool_pp = TRUE;
            } else {
                $bool_pp = FALSE;
            }

            $data_pp['keterangan_transaksi'] = "INPUT PP";
            $data_pp['log'] = $this->session->userdata('user') . " membuat PP baru $nopp";
            $data_pp['tgl_transaksi'] = date('Y-m-d H:i:s');
            $data_pp['user_transaksi'] = $this->session->userdata('user');
            $data_pp['client_ip'] = $this->input->ip_address();
            $data_pp['client_platform'] = $this->platform->agent();



            $this->db_caba->insert('pp_logistik', $data_pplogistikdicaba);
            if ($this->db_caba->affected_rows() > 0) {
                $bool_pp_logistik_caba = TRUE;
            } else {
                $bool_pp_logistik_caba = FALSE;
            }

            $no_ref_po = $this->input->post('txt_no_ref_po');
            $query_jumlah_sudah_bayar = "SELECT SUM(jumlah) AS jumlah FROM pp where ref_po = '$no_ref_po' AND batal <> 1";
            $get_jumlah_sudah_bayar = $this->db_logistik_pt->query($query_jumlah_sudah_bayar)->row();

            $sdh_bayar = $get_jumlah_sudah_bayar->jumlah;


            if ($bool_pp === TRUE) {
                return array('status' => TRUE, 'nopp' => $nopp, 'que' => $data_pplogistikdicaba, 'idpp' => $id_pp, 'sdh_bayar' => $sdh_bayar, 'norefpp' => $refpp, 'nopp' => $nopp, 'norefpo' => $no_ref_po);
            } else {
                return FALSE;
            }
        } else {
            $id_pp = $this->input->post('id_pp');
            $no_pp = $this->input->post('hidden_no_pp');

            $user = $this->session->userdata('user');
            $ip = $this->input->ip_address();
            $platform = $this->platform->agent();

            // $query_1 = "INSERT INTO pp_history SELECT null, a.*,'DATA LAMA (SEBELUM UPDATE)','$user mengupdate PP $no_pp', NOW(), '$user', '$ip', '$platform' FROM pp a WHERE a.id = $id_pp AND a.nopptxt = $no_pp";
            // // var_dump($query_1);exit();
            // $this->db_logistik_pt->query($query_1);
            // if ($this->db_logistik_pt->affected_rows() > 0) {
            //     $bool_pp_history = TRUE;
            // } else {
            //     $bool_pp_history = FALSE;
            // }

            $this->db_caba->set($data_pplogistikdicaba);
            $this->db_caba->where('id', $id_pp);
            $this->db_caba->where('nopptxt', $no_pp);
            $this->db_caba->update('pp_logistik');
            if ($this->db_caba->affected_rows() > 0) {
                $bool_pp = TRUE;
            } else {
                $bool_pp = FALSE;
            }

            $this->db_logistik_pt->set($data_pp);
            $this->db_logistik_pt->where('id', $id_pp);
            $this->db_logistik_pt->where('nopptxt', $no_pp);
            $this->db_logistik_pt->update('pp');
            if ($this->db_logistik_pt->affected_rows() > 0) {
                $bool_pp = TRUE;
            } else {
                $bool_pp = FALSE;
            }

            $no_ref_po = $this->input->post('txt_no_ref_po');
            $query_jumlah_sudah_bayar = "SELECT SUM(jumlah) AS jumlah FROM pp where ref_po = '$no_ref_po' AND batal <> 1";
            $get_jumlah_sudah_bayar = $this->db_logistik_pt->query($query_jumlah_sudah_bayar)->row();

            $sdh_bayar = $get_jumlah_sudah_bayar->jumlah;

            if ($bool_pp === TRUE) {
                return array('status' => TRUE, 'idpp' => $id_pp, 'sdh_bayar' => $sdh_bayar, 'norefpp' => $refpp, 'nopp' => $nopp, 'norefpo' => $no_ref_po);
            } else {
                return FALSE;
            }
        }
    }

    public function update_pp()
    {

        $id_pp = $this->input->post('id_pp');
        $nopo = $this->input->post('hidden_no_po');
        $tglpp = date("Y-m-d H:i:s", strtotime($this->input->post('txt_tgl_pp')));
        $tglpptxt = date("Ymd", strtotime($this->input->post('txt_tgl_pp')));
        $tglpo = date("Y-m-d H:i:s", strtotime($this->input->post('txt_tgl_po')));
        $tglpotxt = date("Ymd", strtotime($this->input->post('txt_tgl_po')));
        $periode = $this->session->userdata('Ymd_periode');
        $txtperiode = $this->session->userdata('ym_periode');

        if (!empty($this->input->post('txt_tgl_voucher'))) {
            $tgl_vou = date("Y-m-d", strtotime($this->input->post('txt_tgl_voucher')));
            $tgl_voutxt = date("Ymd", strtotime($this->input->post('txt_tgl_voucher')));
        } else {
            $tgl_vou = NULL;
            $tgl_voutxt = NULL;
        }

        if ($this->input->post('txt_no_voucher')) {
            $no_vou = $this->input->post('txt_no_voucher');
        } else {
            $no_vou = NULL;
        }

        $jumlah = $this->input->post('txt_jumlah');
        $total_po = $this->input->post('txt_total_po');

        $kode_devisi =  $this->session->userdata('kode_dev');
        $data['devisi'] = $this->db_logistik_pt->get_where('tb_devisi', array('kodetxt' => $kode_devisi))->row_array();

        // $data_pp['id']              = $id_pp;
        $data_pp['tglpp']           = $tglpp;
        $data_pp['tglpptxt']        = $tglpptxt;
        $data_pp['tglpo']           = $tglpo;
        $data_pp['tglpotxt']        = $tglpotxt;
        $data_pp['ref_po']          = $this->input->post('txt_no_ref_po');
        $data_pp['kode_supply']     = $this->input->post('kd_supplier');
        $data_pp['kode_supplytxt']  = $this->input->post('kd_supplier');
        $data_pp['nama_supply']     = $this->input->post('txt_supplier');
        $data_pp['kepada']          = $this->input->post('txt_dibayar_ke');
        $data_pp['bayar']           = $this->input->post('txt_pembayaran');
        $data_pp['KURS']            = $this->input->post('hidden_kurs');
        $data_pp['jumlah']          = $jumlah;
        $data_pp['pajak']           = $this->input->post('txt_pajak');
        $data_pp['jumlahpo']        = $this->input->post('txt_nilai_po');
        $data_pp['KODE_BPO']        = $this->input->post('txt_nilai_bpo1');
        $data_pp['jumlah_bpo']      = $this->input->post('txt_nilai_bpo2');
        $data_pp['total_po']        = $total_po;
        $data_pp['terbilang']       = $this->input->post('txt_terbilang');
        $data_pp['ket']             = $this->input->post('txt_keterangan');
        $data_pp['pt']              = $data['devisi']['PT'];
        $data_pp['kodept']          = $kode_devisi;
        $data_pp['periode']         = $periode . " 00:00:00";
        $data_pp['txtperiode']      = $txtperiode;
        $data_pp['user']            = $this->session->userdata('user');
        $data_pp['tglisi']          = date("Y-m-d H:i:s");
        $data_pp['status_vou']      = "0";
        $data_pp['no_vou']          = $no_vou;
        $data_pp['no_voutxt']       = $no_vou;
        $data_pp['tgl_vou']         = $tgl_vou;
        $data_pp['tgl_voutxt']      = $tgl_voutxt;
        $data_pp['tgl_bayar_real']  = NULL;
        $data_pp['kasir_bayar']     = $this->input->post('txt_jumlah');
        $data_pp['kode_budget']     = "0";
        $data_pp['grup']            = $this->input->post('hidden_grup');
        $data_pp['batal']           = "0";


        $data_pplogistikdicaba['tglpp']             = $tglpp;
        $data_pplogistikdicaba['tglpptxt']          = $tglpptxt;
        $data_pplogistikdicaba['tglpo']             = $tglpo;
        $data_pplogistikdicaba['tglpotxt']          = $tglpotxt;
        $data_pplogistikdicaba['kode_supply']       = $this->input->post('kd_supplier');
        $data_pplogistikdicaba['kode_supplytxt']    = $this->input->post('kd_supplier');
        $data_pplogistikdicaba['nama_supply']       = $this->input->post('txt_supplier');
        $data_pplogistikdicaba['kepada']            = $this->input->post('txt_dibayar_ke');
        $data_pplogistikdicaba['bayar']             = $this->input->post('txt_pembayaran');
        $data_pplogistikdicaba['jumlah']            = $jumlah;
        $data_pplogistikdicaba['PAJAK']             = $this->input->post('txt_pajak');
        $data_pplogistikdicaba['COA_PAJAK']         = NULL;
        $data_pplogistikdicaba['jumlahpo']          = $this->input->post('txt_nilai_po');
        $data_pplogistikdicaba['HARGAPO']           = $this->input->post('txt_nilai_po');
        $data_pplogistikdicaba['terbilang']         = $this->input->post('txt_terbilang');
        $data_pplogistikdicaba['ket']               = $this->input->post('txt_keterangan');
        // $data_pplogistikdicaba['pt']                = $this->session->userdata('app_pt')." ".$this->session->userdata('status_lokasi');
        $data_pplogistikdicaba['pt']                = $data['devisi']['PT'];
        $data_pplogistikdicaba['kodept']            = $kode_devisi;
        $data_pplogistikdicaba['periode']           = $periode . " 00:00:00";
        $data_pplogistikdicaba['txtperiode']        = $txtperiode;
        $data_pplogistikdicaba['user']              = $this->session->userdata('user');
        $data_pplogistikdicaba['tglisi']            = date("Y-m-d H:i:s");
        $data_pplogistikdicaba['status_vou']        = "0";
        $data_pplogistikdicaba['TGL_BAYAR_REAL']    = NULL;
        $data_pplogistikdicaba['kode_budget']       = "0";
        $data_pplogistikdicaba['grup']              = $this->input->post('hidden_grup');
        $data_pplogistikdicaba['main_account']      = $this->input->post('hidden_main_account');
        $data_pplogistikdicaba['nama_account']      = $this->input->post('hidden_nama_account');
        $data_pplogistikdicaba['jum_bpo']           = $this->input->post('txt_nilai_bpo2');
        $data_pplogistikdicaba['kode_bpo']          = $this->input->post('txt_nilai_bpo1');
        $data_pplogistikdicaba['ket_bpo']           = "Biaya atas PO:" . $this->input->post('txt_no_ref_po');
        $data_pplogistikdicaba['batal']             = "0";


        $this->db_logistik_pt->where('id', $id_pp);
        $this->db_logistik_pt->update('pp', $data_pp);
        if ($this->db_logistik_pt->affected_rows() > 0) {
            $bool_pp = TRUE;
        } else {
            $bool_pp = FALSE;
        }




        $this->db_caba->set($data_pplogistikdicaba);
        $this->db_caba->where('ref_pp', $this->input->post('hidden_refpp'));
        $this->db_caba->update('pp_logistik');

        $refpo = $this->input->post('txt_no_ref_po');
        $query_jumlah_sudah_bayar = "SELECT SUM(kasir_bayar) AS kasir_bayar FROM pp WHERE ref_po = '$refpo' AND batal <> 1";
        $get_jumlah_sudah_bayar = $this->db_logistik_pt->query($query_jumlah_sudah_bayar)->row();

        $sdh_bayar = $get_jumlah_sudah_bayar->kasir_bayar;


        if ($bool_pp === TRUE) {
            return array('status' => TRUE, 'idpp' => $id_pp, 'sdh_bayar' => $sdh_bayar, 'norefpo' => $refpo);
        } else {
            return array('status_pp' => $bool_pp);;
        }
        // return $data_pp;
    }

    function updatePO($refpo, $data_po)
    {
        $this->db_logistik_pt->where('noreftxt', $refpo);
        $this->db_logistik_pt->update('po', $data_po);
        return TRUE;
    }

    function update_terbayar_po()
    {
        $id = $this->input->post('id_po');
        $nopp = $this->input->post('no_pp');
        $data = array('terbayar' => $this->input->post('terbayar'), 'nopp' => $nopp);
        $this->db_logistik_pt->where('id', $id);
        $this->db_logistik_pt->update('po', $data);
        return TRUE;
    }
    function update_batal_pp()
    {
        $id = $this->input->post('id_pp');
        $alasan = $this->input->post('alasan');

        // $pp = $this->db_logistik_pt->query("SELECT * FROM pp WHERE id='$id'")->row();
        // $pp_histori['id']              = $id;
        // $pp_histori['nopp']            = $pp->nopp;
        // $pp_histori['nopptxt']         = $pp->nopptxt;
        // $pp_histori['nopo']            = $pp->nopo;
        // $pp_histori['nopotxt']         = $pp->nopotxt;
        // $pp_histori['tglpp']           = $pp->tglpp;
        // $pp_histori['tglpptxt']        = $pp->tglpptxt;
        // $pp_histori['tglpo']           = $pp->tglpo;
        // $pp_histori['tglpotxt']        = $pp->tglpotxt;
        // $pp_histori['ref_pp']          = $pp->ref_pp;
        // $pp_histori['ref_po']          = $pp->ref_po;
        // $pp_histori['kode_supply']     = $pp->kode_supply;
        // $pp_histori['kode_supplytxt']  = $pp->kode_supplytxt;
        // $pp_histori['nama_supply']     = $pp->nama_supply;
        // $pp_histori['kepada']          = $pp->kepada;
        // $pp_histori['bayar']           = $pp->bayar;
        // $pp_histori['KURS']            = $pp->KURS;
        // $pp_histori['jumlah']          = $pp->jumlah;
        // $pp_histori['pajak']           = $pp->pajak;
        // $pp_histori['jumlahpo']        = $pp->jumlahpo;
        // $pp_histori['KODE_BPO']        = $pp->KODE_BPO;
        // $pp_histori['jumlah_bpo']      = $pp->jumlah_bpo;
        // $pp_histori['total_po']        = $pp->total_po;
        // $pp_histori['terbilang']       = $pp->terbilang;
        // $pp_histori['ket']             = $pp->ket;
        // $pp_histori['pt']              = $this->session->userdata('pt');
        // $pp_histori['kodept']          = $this->session->userdata('kode_pt');
        // $pp_histori['periode']         = $pp->periode . " 00:00:00";
        // $pp_histori['txtperiode']      = $pp->txtperiode;
        // $pp_histori['user']            = $this->session->userdata('user');
        // $pp_histori['tglisi']          = date("Y-m-d H:i:s");
        // $pp_histori['status_vou']      = "0";
        // // $pp_histori['status_vou']      = "1";
        // $pp_histori['no_vou']          = $pp->no_vou;
        // $pp_histori['no_voutxt']       = $pp->no_voutxt;
        // $pp_histori['tgl_vou']         = $pp->tgl_vou;
        // $pp_histori['tgl_voutxt']      = $pp->tgl_voutxt;
        // $pp_histori['tgl_bayar_real']  = NULL;
        // $pp_histori['kasir_bayar']     = $pp->kasir_bayar;
        // $pp_histori['kode_budget']     = "0";
        // $pp_histori['grup']            = $pp->grup;
        // $pp_histori['main_account']    = $pp->main_account;
        // $pp_histori['nama_account']    = $pp->nama_account;
        // $pp_histori['batal']           = "0";
        // $pp_histori['keterangan_transaksi'] = "BATAL PP";
        // $pp_histori['log'] = $this->session->userdata('user') . " membatalkan PP $pp->nopp";
        // $pp_histori['tgl_transaksi'] = date('Y-m-d H:i:s');
        // $pp_histori['user_transaksi'] = $this->session->userdata('user');
        // $pp_histori['client_ip'] = $this->input->ip_address();
        // $pp_histori['client_platform'] = $this->platform->agent();
        // $this->db_logistik_pt->insert('pp_history', $pp_histori);


        $data = array('batal' => 1, 'alasan_batal' => $alasan);
        $this->db_logistik_pt->where('id', $id);
        $this->db_logistik_pt->update('pp', $data);
        return TRUE;
    }
    function batal_pp_log()
    {
        $refpp = $this->input->post('refpp');
        $data = array('batal' => 1);
        $this->db_caba->where('ref_pp', $refpp);
        $this->db_caba->update('pp_logistik', $data);
        return TRUE;
    }
    function update_po_ter()
    {
        $nopo = $this->input->post('nopo');
        $cekdatapp = $this->db_logistik_pt->query("SELECT * FROM pp WHERE nopo='$nopo' AND batal <> 1")->num_rows();
        if ($cekdatapp > 1) {
            $data_po = array('terbayar' => 0);
            # code...
        } else {
            $data_po = array('terbayar' => 0, 'nopp' => NULL);
            # code...
        }

        $this->db_logistik_pt->where('nopo', $nopo);
        $this->db_logistik_pt->update('po', $data_po);
        return TRUE;
    }

    function cancel_update_pp()
    {
        $id = $this->input->post('id_pp');

        $query = $this->db_logistik_pt->query("SELECT * FROM pp WHERE id='$id'")->result();
        return $query;
    }
}

/* End of file M_pp.php */
