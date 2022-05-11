<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lap extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $db_pt = check_db_pt();
        $this->db_logistik = $this->load->database('db_logistik', TRUE);
        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);

        if (!$this->session->userdata('id_user')) {
            $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
            $this->session->set_flashdata('pesan', $pemberitahuan);
            redirect('Login');
        }
    }

    ///laporan rinci stok
    function get_kodebar()
    {
        // $query = "SELECT kodebartxt, nabar FROM kodebar";
        // $data = $this->db_logistik->query($query)->result();
        $query = "SELECT DISTINCT kodebartxt, nabar FROM stockawal ORDER BY kodebartxt ASC";
        $data = $this->db_logistik_pt->query($query)->result();
        echo json_encode($data);
    }

    function get_pt()
    {
        $lokasi = $this->session->userdata('status_lokasi');
        if ($lokasi == 'SITE') {
            $query = "SELECT PT, kodetxt FROM tb_devisi WHERE lokasi = '$lokasi' ORDER BY kodetxt ASC";
        } else if ($lokasi == 'RO') {
            $query = "SELECT PT, kodetxt FROM tb_devisi WHERE lokasi = '$lokasi' ORDER BY kodetxt ASC";
        } else if ($lokasi == 'PKS') {
            $query = "SELECT PT, kodetxt FROM tb_devisi WHERE lokasi = '$lokasi' ORDER BY kodetxt ASC";
        } else {
            $query = "SELECT PT, kodetxt FROM tb_devisi ORDER BY kodetxt ASC";
        }

        $data = $this->db_logistik_pt->query($query)->result();
        echo json_encode($data);
    }

    public function print_stock()
    {
        $pt = $this->uri->segment(3);
        $kd_stock_1 = $this->uri->segment(4);
        $kd_stock_2 = $this->uri->segment(5);
        $pilihan = $this->uri->segment(7);

        $periode = $this->uri->segment(6);

        $d_periode =  date("j", strtotime($periode));

        if ($d_periode >= 26) {
            $txtperiode = date('Ym', strtotime($periode . " +1 month"));
            $p1 = date_format(date_create($periode), 'Y-m-') . '26';
            $periode = date('Y-m-d', strtotime($periode . " +1 month"));
            $p2 = date_format(date_create($periode), 'Y-m-') . '25';
        } else {
            $txtperiode = date('Ym', strtotime($periode));
            $periode = date('Y-m-d', strtotime($periode));
            $p1 = date('Y-m-d', strtotime($periode . " -1 month"));
            $p1 = date_format(date_create($p1), 'Y-m-') . '26';
            $p2 = date_format(date_create($periode), 'Y-m-') . '25';
        }

        $data['kd_stock_1'] = $kd_stock_1;
        $data['kd_stock_2'] = $kd_stock_2;
        $data['pt'] = $pt;
        $data['ym_periode'] = $txtperiode;
        $data['periode_str'] = $periode;

        if ($pilihan == "Rinci") {

            $periode = date_format(date_create($periode), 'M Y');

            if ($pt == 'Semua') {

                $this->db_logistik_pt->distinct();
                $this->db_logistik_pt->select('kodebar, nabar, pt, satuan');
                $this->db_logistik_pt->from('stockawal');
                // jika kode barang di isi
                if ($kd_stock_1 != 'Semua' and $kd_stock_2 != 'Semua') {
                    if ($kd_stock_1 == $kd_stock_2) {
                        $this->db_logistik_pt->where('kodebar', $kd_stock_1);
                    }
                }
                $data['kode_stock'] = $this->db_logistik_pt->get()->result();
            } else {
                $this->db_logistik_pt->distinct();
                $this->db_logistik_pt->select('kodebar, nabar, devisi, satuan');
                $this->db_logistik_pt->from('stockawal_bulanan_devisi');
                // jika kode barang di isi
                if ($kd_stock_1 != 'Semua' and $kd_stock_2 != 'Semua') {
                    if ($kd_stock_1 == $kd_stock_2) {
                        $this->db_logistik_pt->where('kodebar', $kd_stock_1);
                    }
                }
                $this->db_logistik_pt->where('kode_dev', $pt);
                $data['kode_stock'] = $this->db_logistik_pt->get()->result();
            }

            $data['kode_dev'] = $pt;
            $data['alamat'] = $pt;
            $data['periode'] = $periode;
            $data['txtperiode'] = $txtperiode;
            $data['p1'] = $p1;
            $data['p2'] = $p2;


            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => [190, 236],
                // 'margin_top' => '2',
                'orientation' => 'P'
            ]);

            $html = $this->load->view('lapRS/vw_lap_rinci_tampil', $data, true);
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else if ($pilihan == "Summary") {

            if ($pt == 'Semua') {
                $this->db_logistik_pt->distinct();
                $this->db_logistik_pt->select('grp');
                $this->db_logistik_pt->from('stockawal');
                // jika kode barang di isi
                if ($kd_stock_1 != 'Semua' and $kd_stock_2 != 'Semua') {
                    if ($kd_stock_1 == $kd_stock_2) {
                        $this->db_logistik_pt->where('kodebar', $kd_stock_1);
                    }
                }
                $data['grp_stockawal'] = $this->db_logistik_pt->get()->result();
            } else {
                $this->db_logistik_pt->distinct();
                $this->db_logistik_pt->select('grp, devisi');
                $this->db_logistik_pt->from('stockawal_bulanan_devisi');
                $this->db_logistik_pt->where('kode_dev', $pt);
                // jika kode barang di isi
                if ($kd_stock_1 != 'Semua' and $kd_stock_2 != 'Semua') {
                    if ($kd_stock_1 == $kd_stock_2) {
                        $this->db_logistik_pt->where('kodebar', $kd_stock_1);
                    }
                }
                $data['grp_stockawal'] = $this->db_logistik_pt->get()->result();
            }

            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => [190, 236],
                // 'margin_top' => '2',
                'orientation' => 'P'
            ]);

            $data['kode_dev'] = $pt;
            $data['txtperiode'] = $txtperiode;
            $data['alamat'] = $pt;

            $html = $this->load->view('lapRS/vw_lap_summary', $data, true);
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else if ($pilihan == "Nilai_Rupiah") {
            // if($kd_stock_1 == "Semua"){
            // 	$query_stockawal = "SELECT kodebartxt, nabar, saldoawal_qty, saldoawal_nilai, KODE, txtperiode, satuan, HARGAPORAT, nilai_masuk, QTY_MASUK, QTY_KELUAR, saldoakhir_qty, saldoakhir_nilai FROM stockawal WHERE KODE = '$pt' AND txtperiode = '$ym_periode'";
            // }
            // else{
            // 	$query_stockawal = "SELECT kodebartxt, nabar, saldoawal_qty, saldoawal_nilai, KODE, txtperiode, satuan, HARGAPORAT, nilai_masuk, QTY_MASUK, QTY_KELUAR, saldoakhir_qty, saldoakhir_nilai FROM stockawal WHERE (kodebartxt BETWEEN '$kd_stock_1' AND '$kd_stock_2') AND KODE = '$pt' AND txtperiode = '$ym_periode'";
            // }
            if ($pt == 'Semua') {
                $this->db_logistik_pt->distinct();
                $this->db_logistik_pt->select('grp');
                $this->db_logistik_pt->from('stockawal');
                // jika kode barang di isi
                if ($kd_stock_1 != 'Semua' and $kd_stock_2 != 'Semua') {
                    if ($kd_stock_1 == $kd_stock_2) {
                        $this->db_logistik_pt->where('kodebar', $kd_stock_1);
                    }
                }
                $data['grp_stockawal'] = $this->db_logistik_pt->get()->result();
            } else {
                $this->db_logistik_pt->distinct();
                $this->db_logistik_pt->select('grp, devisi');
                $this->db_logistik_pt->from('stockawal_bulanan_devisi');
                $this->db_logistik_pt->where('kode_dev', $pt);
                // jika kode barang di isi
                if ($kd_stock_1 != 'Semua' and $kd_stock_2 != 'Semua') {
                    if ($kd_stock_1 == $kd_stock_2) {
                        $this->db_logistik_pt->where('kodebar', $kd_stock_1);
                    }
                }
                $data['grp_stockawal'] = $this->db_logistik_pt->get()->result();
            }

            $data['kode_dev'] = $pt;
            $data['txtperiode'] = $txtperiode;
            $data['alamat'] = $pt;

            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => [190, 236],
                // 'margin_top' => '2',
                'orientation' => 'P'
            ]);

            $html = $this->load->view('lapRS/vw_lap_nilai_rupiah', $data, true);
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else if ($pilihan == "Rupiah_Rata_-_Rata_Harian") {

            // if($kd_stock_1 == "Semua"){
            // 	$query_stockawal_harian = "SELECT kodebartxt, nabar, saldoawal_qty, saldoawal_nilai, KODE, txtperiode, satuan, HARGAPORAT, nilai_masuk, QTY_MASUK, QTY_KELUAR, saldoakhir_qty, saldoakhir_nilai, tgl_transaksi, qty_masuk_per_tgl, qty_keluar_per_tgl FROM stockawal_harian WHERE KODE = '$pt' AND txtperiode = '$ym_periode' ORDER BY tgl_transaksi ASC, kodebartxt ASC";
            // }
            // else{
            // 	$query_stockawal_harian = "SELECT kodebartxt, nabar, saldoawal_qty, saldoawal_nilai, KODE, txtperiode, satuan, HARGAPORAT, nilai_masuk, QTY_MASUK, QTY_KELUAR, saldoakhir_qty, saldoakhir_nilai, tgl_transaksi, qty_masuk_per_tgl, qty_keluar_per_tgl FROM stockawal_harian WHERE (kodebartxt BETWEEN '$kd_stock_1' AND '$kd_stock_2') AND KODE = '$pt' AND txtperiode = '$ym_periode' ORDER BY tgl_transaksi ASC, kodebartxt ASC";
            // }
            $query_stockawal_harian = "SELECT DISTINCT grp FROM stockawal_harian WHERE KODE = '$pt' AND txtperiode = '$txtperiode' ORDER BY grp ASC";
            $data['grp_stockawal_harian'] = $this->db_logistik_pt->query($query_stockawal_harian)->result();

            $this->load->view('lapRS/vw_lap_nilai_rupiah_harian', $data);

            $mpdf = new \Mpdf\Mpdf([
                'mode' => 'utf-8',
                'format' => [190, 236],
                // 'margin_top' => '2',
                'orientation' => 'P'
            ]);
        }
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
    }

    function print_lap_data_tr_semua()
    {
        $tglawal = $this->uri->segment(3) . '-' . $this->uri->segment(4) . '-' . $this->uri->segment(5);
        $tglakhir = $this->uri->segment(6) . '-' . $this->uri->segment(7) . '-' . $this->uri->segment(8);

        $tgl1 = date_format(date_create($tglawal), 'Y-m-d');
        $tgl2 = date_format(date_create($tglakhir), 'Y-m-d');

        $isi = $this->db_logistik_pt->query("SELECT a.tglppo, a.noreftxt, b.tglpo, b.noreftxt as refpo, c.tgl, c.noref, datediff(a.tglppo,c.tgl) AS spp_lpb, datediff(a.tglppo,b.tglpo) AS spp_po, datediff(b.tglpo,c.tgl) AS po_lpb FROM ppo a,po b, stokmasuk c WHERE a.noreftxt=b.no_refppo AND a.noreftxt=c.norefppo AND a.tglppo BETWEEN '$tgl1' AND '$tgl2' ORDER BY a.tglppo DESC")->result();

        $data['durasi'] = $isi;
        $data['lokasi1'] = "Tes";
        $data['periode'] = $tglawal . '-' . $tglakhir;
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_top' => '15',
            'orientation' => 'p'
        ]);

        $html = $this->load->view('analisa/vw_lap_data_tr_print_semua', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();


        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
    }
}

/* End of file Lap.php */
