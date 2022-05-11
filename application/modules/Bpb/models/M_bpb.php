<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_bpb extends CI_Model
{

    var $table = 'noac'; //nama tabel dari database
    var $column_order = array(null, 'NOID', 'noac', 'nama', 'group', 'type'); //field yang ada di table user
    var $column_search = array('noac', 'nama', 'group', 'type'); //field yang diizin untuk pencarian 
    var $order = array('noac' => 'ASC'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function where_datatables($dt, $pt, $cmb_bahan, $mutasi_pt, $mutasi_lokal, $devisi, $sub_kategori)
    {
        // global $nopo;
        $this->dt = $dt;
        $this->pt = $pt;
        $this->cmb_bahan = $cmb_bahan;
        $this->mutasi_pt = $mutasi_pt;
        $this->mutasi_lokal = $mutasi_lokal;
        $this->devisi = $devisi;
        $this->sub_kategori = $sub_kategori;
        // return $nopo;
    }

    private function _get_datatables_query()
    {
        $grub = $this->dt;
        $pt = $this->pt;
        $bahan = $this->cmb_bahan;
        $mutasi_pt = $this->mutasi_pt;
        $mutasi_lokal = $this->mutasi_lokal;
        $devisi = $this->devisi;
        $sub_kategori = $this->sub_kategori;

        // $this->db_logistik_center->where('type !=', 'G');
        $this->db_logistik_center->from($this->table);
        if ($bahan != '-' and $mutasi_pt != 'mutasi_pt' and $mutasi_lokal != 'mutasi_lokal') {
            $this->db_logistik_center->like('noac', $grub, 'both');
        } else if ($mutasi_pt == 'mutasi_pt') {
            if ($pt == '02') {
                # code...
                $this->db_logistik_center->where('nama', 'PSAM, PT');
            } elseif ($pt == '04') {
                # code...
                $this->db_logistik_center->or_where('nama', 'MAPA, PT');
            } elseif ($pt == '01') {
                # code...
                $this->db_logistik_center->or_where('nama', 'MSAL, PT');
            } elseif ($pt == '03') {
                # code...
                $this->db_logistik_center->or_where('nama', 'PEAK, PT');
            } elseif ($pt == '05') {
                # code...
                $this->db_logistik_center->or_where('nama', 'KPP, PT');
            }
        } else if ($mutasi_lokal == 'mutasi_lokal') {
            if ($devisi == '06') {
                # code...
                //kalo nambah kebun berarti yang dibawah ini ditambahkan manual
                $this->db_logistik_center->where_in(
                    'noac',
                    [
                        100300000000000,
                        100301000000000,
                        100304000000000,
                        100302000000000
                    ]
                );
                // $this->db_logistik_center->or_like('nama', 'HUBUNGAN INTRA COMPANY EST 1 <> EST 3', 'both');
                // $this->db_logistik_center->or_like('nama', 'HUBUNGAN INTRA COMPANY EST 1 <> PKS', 'both');
            } else if ($devisi == '07') {
                $this->db_logistik_center->where_in(
                    'noac',
                    [
                        100300000000000,
                        100301000000000,
                        100305000000000,
                        100303000000000
                    ]
                );
                # code...
            } elseif ($devisi == '03') {
                $this->db_logistik_center->where_in(
                    'noac',
                    [
                        100300000000000,
                        100302000000000,
                        100303000000000,
                        100306000000000,
                    ]
                );
                # code...
                // $this->db_logistik_center->like('nama', 'HUBUNGAN INTRA COMPANY', 'both');
            }
        } else if ($sub_kategori != '0') {
            $this->db_logistik_center->where('noac', $sub_kategori);
        }
        //  else {
        //     $tm = '7005';
        //     $tbm = '2024';
        //     $landclearing = '2090';
        //     $pembibitan = '2095';
        //     $this->db_logistik_center->like('noac', $tm, 'match');
        //     $this->db_logistik_center->or_like('noac', $tbm, 'match');
        //     $this->db_logistik_center->or_like('noac', $landclearing, 'match');
        //     $this->db_logistik_center->or_like('noac', $pembibitan, 'match');
        //     # code...
        // }

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
    // end server side table

    public function cariDevisi()
    {
        $lokasi = $this->session->userdata('status_lokasi');
        $lokasi_kebun = $this->session->userdata('kode_dev');

        if ($lokasi != 'HO') {
            return $this->db_logistik_pt->query("SELECT PT, kodetxt FROM tb_devisi WHERE kodetxt='$lokasi_kebun'")->row();
        } else {
            $this->db_logistik_pt->select('PT, kodetxt');
            $this->db_logistik_pt->from('tb_devisi');
            $this->db_logistik_pt->order_by('lokasi', 'ASC');
            return $this->db_logistik_pt->get()->result_array();
        }
    }
    public function cariPT()
    {
        $lokasi = $this->session->userdata('nama_pt');

        return $this->db_logistik_center->query("SELECT kode_pt, nama_pt FROM tb_pt WHERE nama_pt != '$lokasi'")->result_array();
    }

    public function get_stok($kodebar, $txtperiode, $kode_dev)
    {
        $txtperiode = $this->session->userdata('ym_periode');

        $sql_sum_stok = "SELECT SUM(QTY_MASUK) AS qty_masuk, SUM(QTY_KELUAR) AS qty_keluar FROM stockawal_bulanan_devisi WHERE txtperiode <= '$txtperiode' AND kodebar = '$kodebar' AND kode_dev = '$kode_dev'";

        $stock_awal = $this->db_logistik_pt->query($sql_sum_stok)->row_array();

        $stok = $stock_awal['qty_masuk'] - $stock_awal['qty_keluar'];

        return $stok;
    }

    function simpan_rinci_bpb()
    {
        $keperluan      = $this->input->post('txt_untuk_keperluan');
        $kode_devisi    = $this->input->post('devisi');
        $tgl            = date("Y-m-d", strtotime($this->input->post('txt_tgl_bpb')));
        $bagian         = $this->input->post('cmb_bagian');
        $alokasi        = $this->input->post('cmb_alokasi_est');
        $afd_unit       = $this->input->post('cmb_afd_unit');
        $blok_sub       = $this->input->post('cmb_blok_sub');
        $tm_tbm          = $this->input->post('cmb_tm_tbm');
        $bahan          = $this->input->post('cmb_bahan');
        $thun_tanam          = $this->input->post('cmb_tahun_tanam');
        $no_acc         = $this->input->post('hidden_no_acc');
        $nama_acc       = $this->input->post('hidden_nama_acc');
        $kodebar        = $this->input->post('hidden_kode_barang');
        $nabar          = $this->input->post('hidden_nama_barang');
        $grup           = $this->input->post('hidden_grup_barang');
        $satuan         = $this->input->post('hidden_satuan');
        $qty            = $this->input->post('txt_qty_diminta');
        $ket            = $this->input->post('txt_ket_rinci');
        $sess_lokasi    = $this->session->userdata('status_lokasi');
        $periode        = $this->session->userdata('ym_periode');
        $nobkb_ro       = "";
        $nopo_ro        = "";

        $bhnbakar        = $this->input->post('bhnbakar');
        $jns_alat        = $this->input->post('jns_alat');
        $kd_nmr        = $this->input->post('kd_nmr');
        $hm_km        = $this->input->post('hm_km');
        $lokasi_kerja       = $this->input->post('lokasi_kerja');

        $sess_lokasi = $this->session->userdata('status_lokasi');
        $kode_devisi = $this->input->post('devisi');

        $untuk_ket = $this->db_logistik_pt->query("SELECT PT FROM tb_devisi WHERE kodetxt='$kode_devisi'")->row();
        $devv = $untuk_ket->PT;

        $dig_1 = preg_replace("/[^1-9]/", "", $kode_devisi);

        if ($sess_lokasi == "HO") {
            $text1 = "PST";
            $text2 = "BWJ";
            // $dig_1 = "1";
            $dig_2 = "1";
        } else if ($sess_lokasi == "SITE") {
            $text1 = "EST";
            $text2 = "SWJ";
            // $dig_1 = "6";
            $dig_2 = "2";
        } else if ($sess_lokasi == "RO") {
            $text1 = "ROM";
            $text2 = "PKY";
            // $dig_1 = "2";
            $dig_2 = "2";
        } else if ($sess_lokasi == "PKS") {
            $text1 = "FAC";
            $text2 = "SWJ";
            // $dig_1 = "3";
            $dig_2 = "2";
        }

        $digit = $dig_1 . $dig_2;

        $hitung_digit1_2 = strlen($digit);
        $query_bpb = "SELECT MAX(SUBSTRING(nobpb, $hitung_digit1_2+1)) as max_nobpb from bpb WHERE nobpb LIKE '$digit%'";
        $generate_bpb = $this->db_logistik_pt->query($query_bpb)->row();
        $noUrut_bpb = (int)($generate_bpb->max_nobpb);
        $noUrut_bpb++;
        $print_bpb = sprintf("%05s", $noUrut_bpb);

        if (empty($this->input->post('hidden_no_bpb'))) {
            $nobpb = $digit . $print_bpb;
        } else {
            $nobpb = $this->input->post('hidden_no_bpb');
        }

        $format_m_y = date("m/Y");

        if (empty($this->input->post('hidden_no_ref_bpb'))) {
            $noref_bpb = $text1 . "-BPB/" . $text2 . "/" . $format_m_y . "/" . $nobpb; //EST-BPB/SWJ/06/15/001159 atau //EST-BPB/SWJ/10/18/71722
        } else {
            $noref_bpb = $this->input->post('hidden_no_ref_bpb');
        }

        $kode_pt_login = $this->session->userdata('kode_pt_login');

        if ($this->input->post('hidden_mutasi_pt') == 'mutasi_pt') {
            $statusmutasi = 1;
            $norefbpb = $text1 . "-BPB/" . "MUT/" . $kode_pt_login . "/" . $text2 . "/" . $format_m_y . "/" . $nobpb; //EST-BPB/SWJ/06/15/001159 atau //EST-BPB/SWJ/10/18/71722
            $keterangan = $ket . "(Mutasi dari  $devv)";
        } elseif ($this->input->post('hidden_mutasi_lokal') == 'mutasi_lokal') {
            $statusmutasi = 2;
            $norefbpb = $text1 . "-BPB/" . "MUT/" . $kode_pt_login . "/" . $text2 . "/" . $format_m_y . "/" . $nobpb; //EST-BPB/SWJ/06/15/001159 atau //EST-BPB/SWJ/10/18/71722
            $keterangan = $ket . "(Mutasi dari  $nama_acc)";
            // $nama_acc
        } else {
            $norefbpb = $noref_bpb;
            $statusmutasi = 0;
            $keterangan = $this->input->post('txt_ket_rinci');
        }

        $data['devisi'] = $this->db_logistik_pt->get_where('tb_devisi', array('kodetxt' => $kode_devisi))->row_array();

        // jika tanaman pakai where ini, jika bukan tanaman tidak pakai query dibawah ini
        if ($tm_tbm == 'TM') {
            $tm_tbm1 = '7005';
            $kodebeban = $tm_tbm1 . $afd_unit . $thun_tanam . $bahan;
        } else if ($tm_tbm == 'TBM') {
            $tm_tbm1 = '2024';
            $kodebeban = $tm_tbm1 . $afd_unit . $thun_tanam . $bahan;
        } else if ($tm_tbm == 'LANDCLEARING') {
            $tm_tbm1 = '2090';
            $kodebeban = $tm_tbm1 . $afd_unit . $thun_tanam . $bahan;
        } else if ($tm_tbm == 'PEMBIBITAN') {
            $tm_tbm1 = '2095';
            $kodebeban = $tm_tbm1 . $afd_unit . $thun_tanam . $bahan;
        } else {
            $tm_tbm1 = '';
            $kodebeban = NULL;
        }
        $ketbebanfix = $this->input->post('hidden_nama_bahan');

        $databpb['nobpb']           = $nobpb;
        $databpb['norefbpb']        = $norefbpb;
        $databpb['nobkb_ro']        = $nobkb_ro;
        $databpb['nopo_ro']         = $nopo_ro;
        $databpb['tglbpb']          = $tgl . date(' H:i:s');
        $databpb['tglinput']        = date('Y-m-d');
        $databpb['jaminput']        = date('H:i:s');
        $databpb['periode']         = $periode;
        $databpb['alokasi']         = $alokasi;
        $databpb['pt']              = $this->session->userdata('pt');
        $databpb['kode']            = $this->session->userdata('kode_pt');
        $databpb['devisi']          = $data['devisi']['PT'];
        $databpb['kode_dev']        = $kode_devisi;
        $databpb['keperluan']       = $keperluan;
        $databpb['bag']             = $bagian;
        $databpb['batal']           = "0";
        $databpb['alasan_batal']    = NULL;
        $databpb['USER']            = $this->session->userdata('user');
        $databpb['cetak']           = "";
        $databpb['posting']         = "";
        $databpb['approval']        = "0";
        $databpb['req_rev_qty']        = "0";
        $databpb['bhn_bakar']        = $bhnbakar;
        $databpb['jn_alat']        = $jns_alat;
        $databpb['no_kode']        = $kd_nmr;
        $databpb['hm_km']        = $hm_km;
        $databpb['lok_kerja']        = $lokasi_kerja;
        $databpb['status_mutasi']        = $statusmutasi;

        $databpbitem['kodebar']       = $kodebar;
        $databpbitem['nabar']         = $nabar;
        $databpbitem['satuan']        = $satuan;
        $databpbitem['grp']           = $grup;
        $databpbitem['alokasi']       = $alokasi;
        $databpbitem['kodept']        = $this->session->userdata('kode_dev');
        $databpbitem['nobpb']         = $nobpb;
        $databpbitem['norefbpb']      = $norefbpb;
        $databpbitem['pt']            = $this->session->userdata('kode');
        $databpbitem['kode']          = $this->session->userdata('kode_dev');
        $databpbitem['devisi']        = $data['devisi']['PT'];
        $databpbitem['kode_dev']      = $kode_devisi;
        $databpbitem['qty']           = $qty;
        $databpbitem['qty_disetujui'] = "0";
        $databpbitem['tglbpb']        = $tgl . date(' H:i:s');
        $databpbitem['tglinput']      = date('Y-m-d');
        $databpbitem['jaminput']      = date('H:i:s');
        $databpbitem['periode']       = $periode;
        $databpbitem['ket']           = $keterangan;
        $databpbitem['afd']           = $afd_unit;
        $databpbitem['blok']          = $blok_sub;
        $databpbitem['tmtbm']           = $tm_tbm;
        $databpbitem['thntanam']          = $thun_tanam;
        $databpbitem['noadjust']      = "0";
        $databpbitem['kodebebantxt']  = $kodebeban;
        $databpbitem['ketbeban']      = $ketbebanfix;
        $databpbitem['kodesubtxt']    = $no_acc;
        $databpbitem['ketsub']        = $nama_acc;
        $databpbitem['batal']         = "0";
        $databpbitem['alasan_batal']  = NULL;
        $databpbitem['USER']          = $this->session->userdata('user');
        $databpbitem['cetak']         = "";
        $databpbitem['posting']       = "";

        //histori bpb
        // $databpb_history['nobpb']           = $nobpb;
        // $databpb_history['norefbpb']        = $norefbpb;
        // $databpb_history['nobkb_ro']        = $nobkb_ro;
        // $databpb_history['nopo_ro']         = $nopo_ro;
        // $databpb_history['tglbpb']          = $tgl . date(' H:i:s');
        // $databpb_history['tglinput']        = date('Y-m-d');
        // $databpb_history['jaminput']        = date('H:i:s');
        // $databpb_history['periode']         = $periode;
        // $databpb_history['alokasi']         = $alokasi;
        // $databpb_history['pt']              = $this->session->userdata('pt');
        // $databpb_history['kode']            = $this->session->userdata('kode_pt');
        // $databpb_history['devisi']          = $data['devisi']['PT'];
        // $databpb_history['kode_dev']        = $kode_devisi;
        // $databpb_history['keperluan']       = $keperluan;
        // $databpb_history['bag']             = $bagian;
        // $databpb_history['batal']           = "0";
        // $databpb_history['alasan_batal']    = NULL;
        // $databpb_history['USER']            = $this->session->userdata('user');
        // $databpb_history['cetak']           = "";
        // $databpb_history['posting']         = "";
        // $databpb_history['approval']        = "0";
        // $databpb_history['req_rev_qty']        = "0";
        // $databpb_history['bhn_bakar']        = $bhnbakar;
        // $databpb_history['jn_alat']        = $jns_alat;
        // $databpb_history['no_kode']        = $kd_nmr;
        // $databpb_history['hm_km']        = $hm_km;
        // $databpb_history['lok_kerja']        = $lokasi_kerja;
        // $databpb_history['status_mutasi']        = $statusmutasi;
        // $databpb_history['keterangan_transaksi'] = 'INPUT BPB';
        // $databpb_history['log'] = $this->session->userdata('user') . " menambahkan BPB $nobpb";
        // $databpb_history['tgl_transaksi'] = date("Y-m-d H:i:s");
        // $databpb_history['user_transaksi'] = $this->session->userdata('user');
        // $databpb_history['client_ip'] = $this->input->ip_address();
        // $databpb_history['client_platform'] = $this->platform->agent();

        // $databpbitem_history['kodebar']       = $kodebar;
        // $databpbitem_history['nabar']         = $nabar;
        // $databpbitem_history['satuan']        = $satuan;
        // $databpbitem_history['grp']           = $grup;
        // $databpbitem_history['alokasi']       = $alokasi;
        // $databpbitem_history['kodept']        = $this->session->userdata('kode_pt');
        // $databpbitem_history['nobpb']         = $nobpb;
        // $databpbitem_history['norefbpb']      = $norefbpb;
        // $databpbitem_history['pt']            = $this->session->userdata('pt');
        // $databpbitem_history['kode']          = $this->session->userdata('kode_pt');
        // $databpbitem_history['devisi']        = $data['devisi']['PT'];
        // $databpbitem_history['kode_dev']      = $kode_devisi;
        // $databpbitem_history['qty']           = $qty;
        // $databpbitem_history['qty_disetujui'] = "0";
        // $databpbitem_history['tglbpb']        = $tgl . date(' H:i:s');
        // $databpbitem_history['tglinput']      = date('Y-m-d');
        // $databpbitem_history['jaminput']      = date('H:i:s');
        // $databpbitem_history['periode']       = $periode;
        // $databpbitem_history['ket']           = $keterangan;
        // $databpbitem_history['afd']           = $afd_unit;
        // $databpbitem_history['blok']          = $blok_sub;
        // $databpbitem_history['tmtbm']           = $tm_tbm;
        // $databpbitem_history['thntanam']          = $thun_tanam;
        // $databpbitem_history['noadjust']      = "0";
        // $databpbitem_history['kodebebantxt']  = $kodebeban;
        // $databpbitem_history['ketbeban']      = $ketbebanfix;
        // $databpbitem_history['kodesubtxt']    = $no_acc;
        // $databpbitem_history['ketsub']        = $nama_acc;
        // $databpbitem_history['batal']         = "0";
        // $databpbitem_history['alasan_batal']  = NULL;
        // $databpbitem_history['USER']          = $this->session->userdata('user');
        // $databpbitem_history['cetak']         = "";
        // $databpbitem_history['posting']       = "";
        // $databpbitem_history['keterangan_transaksi'] = 'INPUT ITEM BPB';
        // $databpbitem_history['log'] = $this->session->userdata('user') . " menambahkan ITEM BPB $nobpb";
        // $databpbitem_history['tgl_transaksi'] = date("Y-m-d H:i:s");
        // $databpbitem_history['user_transaksi'] = $this->session->userdata('user');
        // $databpbitem_history['client_ip'] = $this->input->ip_address();
        // $databpbitem_history['client_platform'] = $this->platform->agent();

        $query_max_id_approval_bpb = "SELECT max(id)+1 as max_id_approval_bpb from approval_bpb";
        $data_max_id_approval_bpb = $this->db_logistik_pt->query($query_max_id_approval_bpb)->row();

        $no_id_approval = $data_max_id_approval_bpb->max_id_approval_bpb;

        if (empty($no_id_approval)) {
            $no_id_approval = "1";
        }

        if (empty($this->input->post('hidden_no_bpb'))) {

            $this->db_logistik_pt->insert('bpb', $databpb);
            if ($this->db_logistik_pt->affected_rows() > 0) {
                $bool_bpb = TRUE;
            } else {
                $bool_bpb = FALSE;
            }

            $this->db_logistik_pt->insert('bpbitem', $databpbitem);
            if ($this->db_logistik_pt->affected_rows() > 0) {
                $bool_bpbitem = TRUE;
            } else {
                $bool_bpbitem = FALSE;
            }

            // $historibpb = $this->db_logistik_pt->insert('bpb_history', $databpb_history);

            // $historiItem = $this->db_logistik_pt->insert('bpbitem_history', $databpbitem_history);
            //end histori

            $ambil_bpb =  $this->db_logistik_pt->query("SELECT id FROM bpb WHERE norefbpb='$norefbpb'")->row();
            $ambil_item =  $this->db_logistik_pt->query("SELECT id FROM bpbitem WHERE norefbpb='$norefbpb' AND kodebar='$kodebar'")->row();
            $data_approval_bpb['id_bpbitem']        = $ambil_item->id;
            $data_approval_bpb['no_bpb']            = $nobpb;
            $data_approval_bpb['norefbpb']          = $norefbpb;
            $data_approval_bpb['kodebar']           = $kodebar;
            $data_approval_bpb['nabar']             = $nabar;
            $data_approval_bpb['qty_diminta']       = $qty;
            // $data_approval_bpb['qty_disetujui'] = "0";
            $data_approval_bpb['status_ktu']        = "0";
            $data_approval_bpb['tgl_ktu']           = NULL;
            $data_approval_bpb['ket_ktu']           = NULL;
            // $data_approval_bpb['status_mgr']        = "0";
            // $data_approval_bpb['tgl_mgr']           = NULL;
            // $data_approval_bpb['ket_mgr']           = NULL;
            $data_approval_bpb['status_gm']         = "0";
            $data_approval_bpb['tgl_gm']            = NULL;
            $data_approval_bpb['ket_gm']            = NULL;
            $data_approval_bpb['flag_req_rev_qty']  = "0";

            if ($this->input->post('hidden_mutasi_pt') == 'mutasi_pt') {
                $databpb['kode_pt_req_mutasi'] = $this->session->userdata('kode_pt_login');
                $databpb['pt_req_mutasi'] = $this->session->userdata('nama_pt');
                $this->db_logistik_center->insert('bpb_mutasi', $databpb);

                $this->db_logistik_center->insert('bpbitem_mutasi', $databpbitem);
                $this->db_logistik_center->insert('approval_bpb', $data_approval_bpb);
            } else if ($this->input->post('hidden_mutasi_lokal') == 'mutasi_lokal') {
                $databpb['kode_pt_req_mutasi'] = $this->session->userdata('kode_pt_login');
                $databpb['pt_req_mutasi'] = $this->session->userdata('nama_pt');
                $this->db_logistik_center->insert('bpb_mutasi', $databpb);

                $this->db_logistik_center->insert('bpbitem_mutasi', $databpbitem);
                $this->db_logistik_center->insert('approval_bpb', $data_approval_bpb);
                # code...
            }

            $this->db_logistik_pt->insert('approval_bpb', $data_approval_bpb);
            if ($this->db_logistik_pt->affected_rows() > 0) {
                $bool_approval_bpb = TRUE;
            } else {
                $bool_approval_bpb = FALSE;
            }

            if ($bool_bpb === TRUE && $bool_bpbitem === TRUE && $bool_approval_bpb === TRUE) {
                return array('status' => TRUE, 'nobpb' => $nobpb, 'id_bpb' => $ambil_bpb->id, 'id_bpbitem' => $ambil_item->id, 'norefbpb' => $norefbpb, 'kodebar' => $kodebar, 'kode_dev' => $kode_devisi, 'id_approve' => $no_id_approval);
            } else {
                return FALSE;
            }
        } else {
            $nobpb      = $this->input->post('hidden_no_bpb');
            $kodebar    = $this->input->post('hidden_kode_barang');
            $nabar      = $this->input->post('hidden_nama_barang');

            $query = "SELECT * FROM bpbitem WHERE norefbpb = '$norefbpb' AND kodebar = '$kodebar'";
            $check_brg = $this->db_logistik_pt->query($query);

            if ($check_brg->num_rows() > 0) {
                return "kodebar_exist";
            }
            /*** Jika barang belum pernah ditambahkan pada LPB yang sama ***/
            else {
                $this->db_logistik_pt->insert('bpbitem', $databpbitem);
                if ($this->db_logistik_pt->affected_rows() > 0) {
                    $bool_bpbitem = TRUE;
                } else {
                    $bool_bpbitem = FALSE;
                }

                // $historiItem = $this->db_logistik_pt->insert('bpbitem_history', $databpbitem_history);

                $ambil_bpb =  $this->db_logistik_pt->query("SELECT id FROM bpb WHERE norefbpb='$norefbpb'")->row();
                $ambil_item =  $this->db_logistik_pt->query("SELECT id FROM bpbitem WHERE norefbpb='$norefbpb' AND kodebar='$kodebar'")->row();
                $data_approval_bpb['id_bpbitem']        = $ambil_item->id;
                $data_approval_bpb['no_bpb']            = $nobpb;
                $data_approval_bpb['norefbpb']          = $norefbpb;
                $data_approval_bpb['kodebar']           = $kodebar;
                $data_approval_bpb['nabar']             = $nabar;
                $data_approval_bpb['qty_diminta']       = $qty;
                // $data_approval_bpb['qty_disetujui'] = "0";
                $data_approval_bpb['status_ktu']        = "0";
                $data_approval_bpb['tgl_ktu']           = NULL;
                $data_approval_bpb['ket_ktu']           = NULL;
                // $data_approval_bpb['status_mgr']        = "0";
                // $data_approval_bpb['tgl_mgr']           = NULL;
                // $data_approval_bpb['ket_mgr']           = NULL;
                $data_approval_bpb['status_gm']         = "0";
                $data_approval_bpb['tgl_gm']            = NULL;
                $data_approval_bpb['ket_gm']            = NULL;
                $data_approval_bpb['flag_req_rev_qty']  = "0";

                if ($this->input->post('hidden_mutasi_pt') == 'mutasi_pt') {
                    $this->db_logistik_center->insert('bpbitem_mutasi', $databpbitem);
                    $this->db_logistik_center->insert('approval_bpb', $data_approval_bpb);
                } elseif ($this->input->post('hidden_mutasi_lokal') == 'mutasi_lokal') {
                    $this->db_logistik_center->insert('bpbitem_mutasi', $databpbitem);
                    $this->db_logistik_center->insert('approval_bpb', $data_approval_bpb);
                    # code...
                }

                $this->db_logistik_pt->insert('approval_bpb', $data_approval_bpb);
                if ($this->db_logistik_pt->affected_rows() > 0) {
                    $bool_approval_bpb = TRUE;
                } else {
                    $bool_approval_bpb = FALSE;
                }

                if ($bool_bpbitem === TRUE && $bool_approval_bpb === TRUE) {
                    return array('status' => TRUE, 'nobpb' => $nobpb, 'id_bpb' => $ambil_bpb->id, 'id_bpbitem' => $ambil_item->id, 'norefbpb' => $norefbpb, 'kodebar' => $kodebar, 'kode_dev' => $kode_devisi, 'id_approve' => $no_id_approval);
                } else {
                    return FALSE;
                }
            }
        }
    }

    function ubah_rinci_bpb()
    {
        $id_bpbitem = $this->input->post('hidden_id_bpbitem');
        $norefbpb = $this->input->post('hidden_no_ref_bpb');
        $bahan   = $this->input->post('cmb_bahan');
        $tm_tbm          = $this->input->post('cmb_tm_tbm');
        $afd_unit       = $this->input->post('cmb_afd_unit');
        $thun_tanam          = $this->input->post('cmb_tahun_tanam');
        $mut = $this->input->post('hidden_mutasi_pt');
        $mutlok = $this->input->post('hidden_mutasi_lokal');


        // jika tanaman pakai where ini, jika bukan tanaman tidak pakai query dibawah ini
        if ($tm_tbm == 'TM') {
            $tm_tbm1 = '7005';
            $kodebeban = $tm_tbm1 . $afd_unit . $thun_tanam . $bahan;
        } else if ($tm_tbm == 'TBM') {
            $tm_tbm1 = '2024';
            $kodebeban = $tm_tbm1 . $afd_unit . $thun_tanam . $bahan;
        } else if ($tm_tbm == 'LANDCLEARING') {
            $tm_tbm1 = '2090';
            $kodebeban = $tm_tbm1 . $afd_unit . $thun_tanam . $bahan;
        } else if ($tm_tbm == 'PEMBIBITAN') {
            $tm_tbm1 = '2095';
            $kodebeban = $tm_tbm1 . $afd_unit . $thun_tanam . $bahan;
        } else {
            $tm_tbm1 = '';
            $kodebeban = NULL;
        }
        $ketbebanfix = $this->input->post('hidden_nama_bahan');
        $kodebar = $this->input->post('hidden_kode_barang');

        $databpbitem['afd']             = $this->input->post('cmb_afd_unit');
        $databpbitem['blok']           = $this->input->post('cmb_blok_sub');
        $databpbitem['kodebebantxt']  = $kodebeban;
        $databpbitem['ketbeban']     = $ketbebanfix;
        $databpbitem['kodesubtxt']  = $this->input->post('hidden_no_acc');
        $databpbitem['ketsub']     = $this->input->post('hidden_nama_acc');
        $databpbitem['kodebar']   = $kodebar;
        $databpbitem['tmtbm']           = $tm_tbm;
        $databpbitem['thntanam']          = $thun_tanam;
        $databpbitem['nabar']    = $this->input->post('hidden_nama_barang');
        $databpbitem['grp']     = $this->input->post('hidden_grup_barang');
        $databpbitem['satuan'] = $this->input->post('hidden_satuan');
        $databpbitem['qty']   = $this->input->post('txt_qty_diminta');
        $databpbitem['ket']  = $this->input->post('txt_ket_rinci');

        $databpbitemMut = array(
            'afd' => $this->input->post('cmb_afd_unit'),
            'blok' => $this->input->post('cmb_blok_sub'),
            'kodebebantxt' => $kodebeban,
            'ketbeban' => $ketbebanfix,
            'kodesubtxt' => $this->input->post('hidden_no_acc'),
            'ketsub' => $this->input->post('hidden_nama_acc'),
            'kodebar' => $kodebar,
            'tmtbm' => $tm_tbm,
            'thntanam' => $thun_tanam,
            'nabar' => $this->input->post('hidden_nama_barang'),
            'grp' => $this->input->post('hidden_grup_barang'),
            'satuan' => $this->input->post('hidden_satuan'),
            'qty' => $this->input->post('txt_qty_diminta'),
            'ket' => $this->input->post('txt_ket_rinci'),
        );
        $data_approval_bpb = array(
            'kodebar' => $kodebar,
            'nabar' => $this->input->post('hidden_nama_barang'),
            'qty_diminta' => $this->input->post('txt_qty_diminta')
        );

        if ($mut == 'mutasi_pt' || $mutlok == 'mutasi_lokal') {
            # code...
            $this->update_item_mutasi($norefbpb, $databpbitemMut);
            $this->update_approve($id_bpbitem, $data_approval_bpb);
            $this->update_approve_center($id_bpbitem, $data_approval_bpb);
        }

        //cek data exist
        $query = "SELECT kodebar FROM bpbitem WHERE id = '$id_bpbitem'";
        $check_brg = $this->db_logistik_pt->query($query)->row_array();

        if ($check_brg['kodebar'] != $kodebar) {
            $cek_item = "SELECT kodebar FROM bpbitem WHERE norefbpb = '$norefbpb' AND kodebar = '$kodebar'";
            $cek_isi_item = $this->db_logistik_pt->query($cek_item)->num_rows();
            if ($cek_isi_item >= 1) {
                return "kodebar_exist";
            } else {
                $this->db_logistik_pt->set($databpbitem);
                $this->db_logistik_pt->where('id', $id_bpbitem);
                return $this->db_logistik_pt->update('bpbitem');

                $this->db_logistik_pt->set($data_approval_bpb);
                $this->db_logistik_pt->where('norefbpb', $id_bpbitem);
                return $this->db_logistik_pt->update('approval_bpb');

                //histori
                // $get_bpb = $this->db_logistik_pt->query("SELECT * FROM bpbitem WHERE id='$id_bpbitem'")->row();
                // $databpbitem['kodebar']       = $get_bpb->kodebar;
                // $databpbitem['nabar']         = $get_bpb->nabar;
                // $databpbitem['satuan']        = $get_bpb->satuan;
                // $databpbitem['grp']           = $get_bpb->grp;
                // $databpbitem['alokasi']       = $get_bpb->alokasi;
                // $databpbitem['kodept']        = $this->session->userdata('kode_pt');
                // $databpbitem['nobpb']         = $get_bpb->nobpb;
                // $databpbitem['norefbpb']      = $get_bpb->norefbpb;
                // $databpbitem['pt']            = $this->session->userdata('pt');
                // $databpbitem['kode']          = $this->session->userdata('kode_pt');
                // $databpbitem['devisi']        = $get_bpb->devisi;
                // $databpbitem['kode_dev']      = $get_bpb->kode_dev;
                // $databpbitem['qty']           = $get_bpb->qty;
                // $databpbitem['qty_disetujui'] = $get_bpb->qty_disetujui;
                // $databpbitem['tglbpb']        = $get_bpb->tglbpb . date(' H:i:s');
                // $databpbitem['tglinput']      = $get_bpb->tglinput;
                // $databpbitem['jaminput']      = $get_bpb->jaminput;
                // $databpbitem['periode']       = $get_bpb->periode;
                // $databpbitem['ket']           = $get_bpb->ket;
                // $databpbitem['afd']           = $get_bpb->afd;
                // $databpbitem['blok']          = $get_bpb->blok;
                // $databpbitem['tmtbm']           = $get_bpb->tmtbm;
                // $databpbitem['thntanam']          = $get_bpb->thntanam;
                // $databpbitem['noadjust']      = $get_bpb->noadjust;
                // $databpbitem['kodebebantxt']  = $get_bpb->kodebebantxt;
                // $databpbitem['ketbeban']      = $get_bpb->ketbeban;
                // $databpbitem['kodesubtxt']    = $get_bpb->kodesubtxt;
                // $databpbitem['ketsub']        = $get_bpb->ketsub;
                // $databpbitem['batal']         = $get_bpb->batal;
                // $databpbitem['alasan_batal']  = $get_bpb->alasan_batal;
                // $databpbitem['USER']          = $this->session->userdata('user');
                // $databpbitem['cetak']         = $get_bpb->cetak;
                // $databpbitem['posting']       = $get_bpb->posting;
                // $databpbitem['keterangan_transaksi'] = 'UPDATE ITEM BPB';
                // $databpbitem['log'] = $this->session->userdata('user') . " mengubah ITEM BPB $get_bpb->nobpb";
                // $databpbitem['tgl_transaksi'] = date("Y-m-d H:i:s");
                // $databpbitem['user_transaksi'] = $this->session->userdata('user');
                // $databpbitem['client_ip'] = $this->input->ip_address();
                // $databpbitem['client_platform'] = $this->platform->agent();
                // $historiItem = $this->db_logistik_pt->insert('bpbitem_history', $databpbitem);
                //end
            }
        } else {
            $this->db_logistik_pt->set($databpbitem);
            $this->db_logistik_pt->where('id', $id_bpbitem);
            return $this->db_logistik_pt->update('bpbitem');

            $this->db_logistik_pt->set($data_approval_bpb);
            $this->db_logistik_pt->where('norefbpb', $id_bpbitem);
            return $this->db_logistik_pt->update('approval_bpb');

            //histori
            // $get_bpb = $this->db_logistik_pt->query("SELECT * FROM bpbitem WHERE id='$id_bpbitem'")->row();
            // $databpbitem['kodebar']       = $get_bpb->kodebar;
            // $databpbitem['nabar']         = $get_bpb->nabar;
            // $databpbitem['satuan']        = $get_bpb->satuan;
            // $databpbitem['grp']           = $get_bpb->grp;
            // $databpbitem['alokasi']       = $get_bpb->alokasi;
            // $databpbitem['kodept']        = $this->session->userdata('kode_pt');
            // $databpbitem['nobpb']         = $get_bpb->nobpb;
            // $databpbitem['norefbpb']      = $get_bpb->norefbpb;
            // $databpbitem['pt']            = $this->session->userdata('pt');
            // $databpbitem['kode']          = $this->session->userdata('kode_pt');
            // $databpbitem['devisi']        = $get_bpb->devisi;
            // $databpbitem['kode_dev']      = $get_bpb->kode_dev;
            // $databpbitem['qty']           = $get_bpb->qty;
            // $databpbitem['qty_disetujui'] = $get_bpb->qty_disetujui;
            // $databpbitem['tglbpb']        = $get_bpb->tglbpb . date(' H:i:s');
            // $databpbitem['tglinput']      = $get_bpb->tglinput;
            // $databpbitem['jaminput']      = $get_bpb->jaminput;
            // $databpbitem['periode']       = $get_bpb->periode;
            // $databpbitem['ket']           = $get_bpb->ket;
            // $databpbitem['afd']           = $get_bpb->afd;
            // $databpbitem['blok']          = $get_bpb->blok;
            // $databpbitem['tmtbm']           = $get_bpb->tmtbm;
            // $databpbitem['thntanam']          = $get_bpb->thntanam;
            // $databpbitem['noadjust']      = $get_bpb->noadjust;
            // $databpbitem['kodebebantxt']  = $get_bpb->kodebebantxt;
            // $databpbitem['ketbeban']      = $get_bpb->ketbeban;
            // $databpbitem['kodesubtxt']    = $get_bpb->kodesubtxt;
            // $databpbitem['ketsub']        = $get_bpb->ketsub;
            // $databpbitem['batal']         = $get_bpb->batal;
            // $databpbitem['alasan_batal']  = $get_bpb->alasan_batal;
            // $databpbitem['USER']          = $this->session->userdata('user');
            // $databpbitem['cetak']         = $get_bpb->cetak;
            // $databpbitem['posting']       = $get_bpb->posting;
            // $databpbitem['keterangan_transaksi'] = 'UPDATE ITEM BPB';
            // $databpbitem['log'] = $this->session->userdata('user') . " mengubah ITEM BPB $get_bpb->nobpb";
            // $databpbitem['tgl_transaksi'] = date("Y-m-d H:i:s");
            // $databpbitem['user_transaksi'] = $this->session->userdata('user');
            // $databpbitem['client_ip'] = $this->input->ip_address();
            // $databpbitem['client_platform'] = $this->platform->agent();
            // $historiItem = $this->db_logistik_pt->insert('bpbitem_history', $databpbitem);
            //end
        }
    }

    function update_item_mutasi($norefbpb, $databpbitem)
    {
        $this->db_logistik_center->where('norefbpb', $norefbpb);
        $this->db_logistik_center->update('bpbitem_mutasi', $databpbitem);
        return TRUE;
    }
    function update_approve_center($id_bpbitem, $data_approval_bpb)
    {

        $this->db_logistik_center->where('id_bpbitem', $id_bpbitem);
        $this->db_logistik_center->update('approval_bpb', $data_approval_bpb);
        return TRUE;
        // $this->db_logistik_center->set($data_approval_bpb);
        // $this->db_logistik_center->where(['id_bpbitem', $id_bpbitem]);
        // return $this->db_logistik_center->update('approval_bpb');
    }
    function update_approve($id_bpbitem, $data_approval_bpb)
    {

        $this->db_logistik_pt->where('id_bpbitem', $id_bpbitem);
        $this->db_logistik_pt->update('approval_bpb', $data_approval_bpb);
        return TRUE;
        // $this->db_logistik_center->set($data_approval_bpb);
        // $this->db_logistik_center->where(['id_bpbitem', $id_bpbitem]);
        // return $this->db_logistik_center->update('approval_bpb');
    }
    public function updateitem($nobpb, $norefbpb, $kodebar, $dataedit_approval)
    {

        $mutasi = "SELECT nobpb, kodebar, norefbpb, approval_item FROM bpbitem_mutasi WHERE nobpb='$nobpb' AND norefbpb='$norefbpb' AND kodebar='$kodebar' ";
        $mutasi_pt = $this->db_logistik_center->query($mutasi);

        if ($mutasi_pt->num_rows() > 0) {
            # code...
            $this->db_logistik_pt->where('no_bpb', $nobpb);
            $this->db_logistik_pt->where('norefbpb', $norefbpb);
            $this->db_logistik_pt->where('kodebar', $kodebar);
            $this->db_logistik_pt->update('approval_bpb', $dataedit_approval);

            #approve mutasi
            $this->db_logistik_center->where('no_bpb', $nobpb);
            $this->db_logistik_center->where('norefbpb', $norefbpb);
            $this->db_logistik_center->where('kodebar', $kodebar);
            $this->db_logistik_center->update('approval_bpb', $dataedit_approval);
        } else {
            # code...
            $this->db_logistik_pt->where('no_bpb', $nobpb);
            $this->db_logistik_pt->where('norefbpb', $norefbpb);
            $this->db_logistik_pt->where('kodebar', $kodebar);
            $this->db_logistik_pt->update('approval_bpb', $dataedit_approval);
        }

        return TRUE;
    }
    public function update_item($nobpb, $norefbpb, $aprrove, $kodebar, $alasan)
    {
        $mutasi = "SELECT nobpb, kodebar, norefbpb, approval_item FROM bpbitem_mutasi WHERE nobpb='$nobpb' AND norefbpb='$norefbpb' AND kodebar='$kodebar' ";
        $mutasi_pt = $this->db_logistik_center->query($mutasi);


        if ($mutasi_pt->num_rows() > 0) {
            // jika di db center mutasinya ada
            $this->db_logistik_pt->set('approval', '1');
            $this->db_logistik_pt->where('nobpb', $nobpb);
            $this->db_logistik_pt->where('norefbpb', $norefbpb);
            $this->db_logistik_pt->update('bpb');


            $this->db_logistik_center->set('approval', '1');
            $this->db_logistik_center->where('nobpb', $nobpb);
            $this->db_logistik_center->where('norefbpb', $norefbpb);
            $this->db_logistik_center->update('bpb_mutasi');

            //update mutasi

            if ($aprrove == '1') {
                $this->db_logistik_center->set('approval_item', '1');
            } else {
                $this->db_logistik_center->set('approval_item', '0');
                $this->db_logistik_center->set('batal', '1');
                $this->db_logistik_center->set('alasan_batal', $alasan);
            }
            $this->db_logistik_center->where('nobpb', $nobpb);
            $this->db_logistik_center->where('norefbpb', $norefbpb);
            $this->db_logistik_center->where('kodebar', $kodebar);
            $bpbitem_mutasi =  $this->db_logistik_center->update('bpbitem_mutasi');


            //approval bpb item (merubah status approval_item menjadi 1)
            if ($aprrove == '1') {
                $this->db_logistik_pt->set('approval_item', '1');
            } else {
                $this->db_logistik_pt->set('approval_item', '0');
                $this->db_logistik_pt->set('batal', '1');
                $this->db_logistik_pt->set('alasan_batal', $alasan);
            }
            $this->db_logistik_pt->where('nobpb', $nobpb);
            $this->db_logistik_pt->where('norefbpb', $norefbpb);
            $this->db_logistik_pt->where('kodebar', $kodebar);
            $item_bpb = $this->db_logistik_pt->update('bpbitem');


            $data = [
                'bpbitem_mutasi' => $bpbitem_mutasi,
                'item_bpb' => $item_bpb,
            ];

            return $data;
        } else {
            $this->db_logistik_pt->set('approval', '1');
            $this->db_logistik_pt->where('nobpb', $nobpb);
            $this->db_logistik_pt->where('norefbpb', $norefbpb);
            $this->db_logistik_pt->update('bpb');
            //approval bpb item (merubah status approval_item menjadi 1)
            if ($aprrove == '1') {
                $this->db_logistik_pt->set('approval_item', '1');
            } else {
                $this->db_logistik_pt->set('approval_item', '0');
                $this->db_logistik_pt->set('batal', '1');
                $this->db_logistik_pt->set('alasan_batal', $alasan);
            }
            $this->db_logistik_pt->where('nobpb', $nobpb);
            $this->db_logistik_pt->where('norefbpb', $norefbpb);
            $this->db_logistik_pt->where('kodebar', $kodebar);
            $data = $this->db_logistik_pt->update('bpbitem');

            return $data;
        }



        // return TRUE;
    }

    public function cekAprrove($nobpb, $kodebar, $norefbpb)
    {
        $cek = "SELECT nobpb, kodebar, norefbpb, approval_item FROM bpbitem WHERE nobpb='$nobpb' AND norefbpb='$norefbpb' AND kodebar='$kodebar' ";

        $approve = $this->db_logistik_pt->query($cek)->row();

        $d = $approve->approval_item;


        if ($d === null) {
            $data = [
                'status' => true,
            ];
        } else {
            $data = [
                'status' => false,
            ];
        }

        return $data;
    }

    public function batalAprrove($nobpb, $kodebar, $norefbpb)
    {
        $cek = "SELECT nobpb, kodebar, norefbpb, batal FROM bpbitem WHERE nobpb='$nobpb' AND norefbpb='$norefbpb' AND kodebar='$kodebar' ";
        // $query = "SELECT nobpb, kodebar, norefbpb, approval_item FROM bpbitem WHERE nobpb='$nobpb' AND norefbpb='$norefbpb' AND kodebar='$kodebar' ";

        $approve = $this->db_logistik_pt->query($cek)->row();
        // $dt = $this->db_logistik_pt->query($query)->row();

        $d = $approve['batal'];


        // $c = $dt->approval_item;

        if ($d != 0) {
            $data = [
                'status' => false
            ];
        } else {
            $data = [
                'status' => true
            ];
        }

        return $data;
    }


    public function batalbpbMut($id_bpb,  $noref, $alasan)
    {
        //old batal mutasi
        // $this->db_logistik_center->delete('bpb_mutasi', array('id' => $id_bpb, 'norefbpb' => $noref));
        // $this->db_logistik_center->delete('bpbitem_mutasi', array('norefbpb' => $noref));
        // $this->db_logistik_center->delete('approval_bpb', array('norefbpb' => $noref));

        // $this->db_logistik_pt->delete('bpb', array('id' => $id_bpb, 'norefbpb' => $noref));
        // $this->db_logistik_pt->delete('bpbitem', array('norefbpb' => $noref));
        // $this->db_logistik_pt->delete('approval_bpb', array('norefbpb' => $noref));

        //new batal bpb mutasi
        $data = array('batal' => 1, 'alasan_batal' => $alasan);
        $this->db_logistik_center->where(['norefbpb' => $noref]);
        $this->db_logistik_center->update('bpbitem_mutasi', $data);

        $this->db_logistik_center->where(['norefbpb' => $noref]);
        $this->db_logistik_center->update('bpb_mutasi', $data);

        $this->db_logistik_pt->where(['id' => $id_bpb, 'norefbpb' => $noref]);
        $this->db_logistik_pt->update('bpb', $data);

        $this->db_logistik_pt->where(['norefbpb' => $noref]);
        $this->db_logistik_pt->update('bpbitem', $data);


        return TRUE;
    }
    public function batalbpb($id_bpb,  $noref, $alasan)
    {
        //old batal bpb
        // $this->db_logistik_pt->delete('bpb', array('id' => $id_bpb, 'norefbpb' => $noref));
        // $this->db_logistik_pt->delete('bpbitem', array('norefbpb' => $noref));
        // $this->db_logistik_pt->delete('approval_bpb', array('norefbpb' => $noref));

        //new batal bpb
        $data = array('batal' => 1, 'alasan_batal' => $alasan);
        $this->db_logistik_pt->where(['id' => $id_bpb, 'norefbpb' => $noref]);
        $this->db_logistik_pt->update('bpb', $data);

        $this->db_logistik_pt->where(['norefbpb' => $noref]);
        $this->db_logistik_pt->update('bpbitem', $data);
        return TRUE;
    }
}

/* End of file M_bpb.php */
