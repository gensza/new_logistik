<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pp');
        $this->load->model('M_dataPP');
        $this->load->model('M_detail');

        $db_pt = check_db_pt();
        // $this->db_logistik = $this->load->database('db_logistik', TRUE);
        $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);

        if ($this->session->userdata('kode_dev') == '01') {
            $this->db_caba = $this->load->database('db_caba_' . $db_pt, TRUE); //HO
        } elseif ($this->session->userdata('kode_dev') == '02') {
            $this->db_caba = $this->load->database('db_caba_' . $db_pt . '_ro', TRUE); //RO
        } elseif ($this->session->userdata('kode_dev') == '03') {
            $this->db_caba = $this->load->database('db_caba_' . $db_pt . '_pks', TRUE); //PKS
        } else {
            $this->db_caba = $this->load->database('db_caba_' . $db_pt . '_site', TRUE); //SITE
        }

        if (!$this->session->userdata('id_user')) {
            $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
            $this->session->set_flashdata('pesan', $pemberitahuan);
            redirect('Login');
        }
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('form_validation');
    }

    function list_pp()
    {
        $data = $this->input->post('data');
        $this->M_dataPP->where_datatables($data);
        $list = $this->M_dataPP->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $hasil) {
            $no++;
            $row   = array();
            $id = $hasil->id;
            $refpp = $hasil->ref_pp;
            $ref_po = $hasil->ref_po;
            $noref = str_replace('/', '.', $refpp);
            $norefpo = str_replace('/', '.', $ref_po);

            if ($hasil->batal == 1) {
                $row[] = '
                <a href="' .  site_url('Pp/cetak/' .  $noref . '/' . $id) . '" target="_blank" title="Cetak PP" class="btn btn-primary btn-xs fa fa-print" id="a_print_po"></a>
                <a href="javascript:;" id="a_delete_pp">
                <button class="btn btn-info btn-xs fa fa-eye" id="btn_detail" name="btn_batal_pp" data-toggle="tooltip" style="padding-right:8px;" data-placement="top" title="Detail PP" onClick="detail(' . $id . ',' . $hasil->batal  . ')">
                </button>
            </a>
                ';

                $status = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-danger">batal</span></h5>';


                # code...
            } else {
                if ($hasil->status_vou == 1) {

                    $status = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-success">Cashbank</span></h5>';
                    # code...
                    $row[] = '<a href="' .  site_url('Pp/cetak/' .  $noref . '/' . $id) . '" target="_blank" title="Cetak PP" class="btn btn-primary btn-xs fa fa-print" id="a_print_po"></a>
                    <a href="javascript:;" id="a_delete_pp">
                    <button class="btn btn-info btn-xs fa fa-eye" id="btn_detail" name="btn_batal_pp" data-toggle="tooltip" style="padding-right:8px;" data-placement="top" title="Detail PP" onClick="detail(' . $id . ',' . $hasil->batal  . ')">
                    </button>
                    </a>';
                } else {
                    $status = '<h5 style="margin-top:0px; margin-bottom:0px;"><span class="badge badge-warning">Proses</span></h5>';
                    # code...
                    $row[] = '<a href="' . site_url('Pp/edit_pp/' . $id . '/' . $noref) . '" class="btn btn-warning fa fa-edit btn-xs" data-toggle="tooltip" data-placement="top" title="Update PP" id="btn_edit_pp"></a>
        
                    <a href="' .  site_url('Pp/cetak/' .  $noref . '/' . $id) . '" target="_blank" title="Cetak PP" class="btn btn-primary btn-xs fa fa-print" id="a_print_po"></a>
                    <a href="javascript:;" id="a_delete_pp">
                        <button class="btn btn-info btn-xs fa fa-eye" id="btn_detail" name="btn_batal_pp" data-toggle="tooltip" style="padding-right:8px;" data-placement="top" title="Detail PP" onClick="detail(' . $id . ',' . $hasil->batal  . ')">
                        </button>
                    </a>';
                }
            }

            $row[] = $no . ".";
            $row[] = $hasil->ref_pp;
            // $row[] = $hasil->ref_po;
            $row[] = date('d-m-Y', strtotime($hasil->tglpp));
            // $row[] = date('d-m-Y', strtotime($hasil->tglpo));
            $row[] = $hasil->nama_supply;
            $row[] = $hasil->user;
            $row[] = '<p style="word-break: break-word; margin-top:0px; margin-bottom: 0px;">' . htmlspecialchars($hasil->ket) . ' </p>';

            $row[] = $status;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_dataPP->count_all(),
            "recordsFiltered" => $this->M_dataPP->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function detail_pp()
    {
        $id = $this->input->post('id');
        $this->M_detail->where_datatables($id);
        $list = $this->M_detail->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $hasil) {
            $no++;

            $row   = array();
            // sum kasir bayar pada tabel pp
            $query_jumlah_sudah_bayar = "SELECT SUM(kasir_bayar) AS kasir_bayar FROM pp where ref_po = '$hasil->ref_po' AND batal <> 1";
            $get_jumlah_sudah_bayar = $this->db_logistik_pt->query($query_jumlah_sudah_bayar)->row();
            // endsum

            $row[] = $no . ".";
            $row[] = $hasil->ref_po;
            $row[] = date('d-m-Y', strtotime($hasil->tglpo));
            $row[] = $hasil->bayar;
            $row[] = number_format($hasil->total_po, 2, ",", ".");
            $row[] = number_format($hasil->kasir_bayar, 2, ",", ".");
            if ($hasil->status_vou == 1) {
                # code...
                $row[] = number_format($get_jumlah_sudah_bayar->kasir_bayar, 2, ",", ".");
            } else {
                $row[] = number_format("0", 2, ",", ".");
                # code...
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_detail->count_all(),
            "recordsFiltered" => $this->M_detail->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function ambilnorefPP()
    {
        $id = $this->input->post('id');
        $data = $this->db_logistik_pt->query("SELECT ref_pp, status_vou, no_voutxt FROM pp WHERE id='$id'")->row();
        echo json_encode($data);
    }

    public function index()
    {
        $data = [
            'title' => 'Permohonan Pembayaran',
        ];

        $this->template->load('template', 'v_dataPP', $data);
    }

    public function input()
    {
        $data = [
            'title' => 'Input Permohonan Pembayaran',
        ];

        $this->template->load('template', 'v_inputPp', $data);
    }

    public function edit_pp()
    {
        $data = [
            'title' => 'Update Permohonan Pembayaran',
        ];

        $this->template->load('template', 'v_editPP', $data);
    }

    public function list_po()
    {

        $list = $this->M_pp->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $d) {

            $row = array();

            $ref_po = $d->noreftxt;

            // untuk mengambil kode dan nama barang
            $query_kodebar = "SELECT nabar, kodebar FROM item_po WHERE noref = '$ref_po'";
            $get_kodebar = $this->db_logistik_pt->query($query_kodebar)->row();
            // endsum
            // untuk sum harga dan qty pada item_Po
            $query_harga_po = "SELECT SUM(harga) AS hargapo FROM item_po WHERE noref = '$ref_po'";
            $get_harga_po = $this->db_logistik_pt->query($query_harga_po)->row();
            // endsum
            // untuk sum harga dan qty pada item_Po
            $query_qty_po = "SELECT SUM(qty) AS qty FROM item_po WHERE noref = '$ref_po'";
            $get_qty_po = $this->db_logistik_pt->query($query_qty_po)->row();
            // endsum
            // untuk sum diskon
            $query_diskon = "SELECT disc AS diskon FROM item_po WHERE noref = '$ref_po'";
            $get_diskon = $this->db_logistik_pt->query($query_diskon)->row();
            // endsum


            // untuk sum jumlah bpo pada item_po
            $query_jumlah_bpo = "SELECT SUM(JUMLAHBPO) AS jumlahbpo FROM item_po where noref = '$ref_po'";
            $get_jumlah_bpo = $this->db_logistik_pt->query($query_jumlah_bpo)->row();
            // endsum

            // sum kasir bayar pada tabel pp
            $query_jumlah_sudah_bayar = "SELECT SUM(kasir_bayar) AS kasir_bayar FROM pp where ref_po = '$ref_po' AND batal <> 1";
            $get_jumlah_sudah_bayar = $this->db_logistik_pt->query($query_jumlah_sudah_bayar)->row();
            // endsum

            //kurs
            $query_kurs = "SELECT DISTINCT kurs FROM item_po WHERE nopo = '$d->nopotxt' AND noref = '$ref_po'";
            $get_kurs = $this->db_logistik_pt->query($query_kurs)->row();

            if ($get_kodebar->kodebar == '102505700000002' && $d->jenis_spp == 'SPP') {
                $ppn = $d->ppn;
                if ($ppn == 10) {
                    $jml_ppn = "0.1";
                } else {
                    $jml_ppn = "0";
                }
                if ($d->pph == NULL) {
                    $jml_pph = $d->pph / 100;
                } else {
                    $jml_pph = $d->pph / 100;
                }
                $hargadasarppn = $get_harga_po->hargapo * $jml_ppn;
                $hargadasar = $get_harga_po->hargapo + $hargadasarppn;
                $qty_harga = $get_qty_po->qty * $hargadasar;
                $disc = $get_diskon->diskon / 100;
                $jumharga_pre = $qty_harga - ($qty_harga * $disc);

                $hargapphqty = $get_harga_po->hargapo * $get_qty_po->qty;
                $hargaPlusPPH = $hargapphqty * $jml_pph;
                // $hargaPPh = $get_harga_po->hargapo +  $hargaPlusPPH;

                $ongkirplusppn = $get_jumlah_bpo->jumlahbpo * $jml_ppn;
                $ongkir = $get_jumlah_bpo->jumlahbpo +  $ongkirplusppn;

                $biayalain =  $ongkir * $get_qty_po->qty;

                $hasil = $qty_harga;
                //saldo
                $saldo =  ($hasil + $biayalain + $hargaPlusPPH) - $get_jumlah_sudah_bayar->kasir_bayar;
                if ($saldo < 0) {
                    # code...
                    $sisa = 0;
                } else {
                    # code...
                    $sisa = $saldo;
                }
            } else {

                //ppn
                $ppn = $d->ppn;
                if ($ppn == 10) {
                    $jml_ppn = $ppn / 100;
                    $total_ppn = ($d->totalbayar - $get_jumlah_bpo->jumlahbpo) * $jml_ppn;
                    $hasil = ($d->totalbayar - $get_jumlah_bpo->jumlahbpo) + $total_ppn;
                    // $isi = $hasil - ($hasil * $diskon);
                } else {
                    // $isi = $harga - ($harga * $diskon);
                    $hasil = $d->totalbayar - $get_jumlah_bpo->jumlahbpo;
                }

                $biayalain = $get_jumlah_bpo->jumlahbpo;
                // $duapersen = ($d->totalbayar + $get_jumlah_bpo->jumlahbpo) ;

                //saldo
                $saldo = ($hasil + $get_jumlah_bpo->jumlahbpo) - $get_jumlah_sudah_bayar->kasir_bayar;

                if ($saldo < 0) {
                    # code...
                    $sisa = 0;
                } else {
                    # code...
                    $sisa = $saldo;
                }
            }


            // $saldo = $tot - ($tot * $diskon);
            $norefspp = "'" . $d->noreftxt . "'";
            $nopo = "'" . $d->nopotxt . "'";

            // $row[] = $d->id;
            $row[] =  '<a href="javascript:;" id="btn_pilhspp">
            <button type="button" onClick="pilih_pp(' . $d->id . ',' . $norefspp . ',' . $nopo . ',' . $sisa . ')" id="pilih_pp_' . $d->id . '" class="btn btn-success waves-effect waves-light btn-xs">Pilih</button>
            </a>';

            $row[] = date_format(date_create($d->tglpo), 'd-m-Y');
            $row[] = $d->noreftxt;
            $row[] = $d->nopotxt;
            // $row[] = $d->kode_supply;
            $row[] = $d->nama_supply;
            $row[] = $d->bayar;
            // $row[] = number_format($get_harga_po->hargapo);
            $row[] = number_format($hasil, 2, ",", ".");
            $row[] = number_format($biayalain, 2, ",", ".");
            $row[] = number_format($get_jumlah_sudah_bayar->kasir_bayar, 2, ",", ".");
            $row[] = number_format($sisa, 2, ",", ".");
            $row[] = $get_kurs->kurs;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_pp->count_all(),
            "recordsFiltered" => $this->M_pp->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function ambilpo()
    {
        $id = $this->input->post('id');
        $refpo = $this->input->post('refpo');
        $no_po = $this->input->post('nopo');
        $dt = $this->M_pp->ambilpo($id, $refpo);

        $query_kodebar = "SELECT nabar, kodebar, qty FROM item_po WHERE noref = '$refpo'";
        $get_kodebar = $this->db_logistik_pt->query($query_kodebar)->row();

        // untuk sum harga dan qty pada item_Po
        $query_harga_po = "SELECT SUM(harga*qty) AS hargapo FROM item_po WHERE noref = '$refpo'";
        $get_harga_po = $this->db_logistik_pt->query($query_harga_po)->row();
        $query_harga = "SELECT SUM(harga) AS hargapo FROM item_po WHERE noref = '$refpo'";
        $get_harga = $this->db_logistik_pt->query($query_harga)->row();
        // endsum

        // untuk sum jumlah bpo pada item_po
        $query_jumlah_bpo = "SELECT SUM(JUMLAHBPO) AS jumlahbpo FROM item_po where noref = '$refpo'";
        $get_jumlah_bpo = $this->db_logistik_pt->query($query_jumlah_bpo)->row();
        // endsum

        // sum kasir bayar pada tabel pp
        $query_jumlah_sudah_bayar = "SELECT SUM(kasir_bayar) AS kasir_bayar FROM pp where ref_po = '$refpo' AND batal <> 1";
        $get_jumlah_sudah_bayar = $this->db_logistik_pt->query($query_jumlah_sudah_bayar)->row();
        // endsum

        //kurs
        $query_kurs = "SELECT DISTINCT kurs FROM item_po WHERE nopo = '$no_po' AND noref = '$refpo'";
        $get_kurs = $this->db_logistik_pt->query($query_kurs)->row();


        if ($get_kodebar->kodebar == '102505700000002' && $dt->jenis_spp == 'SPP') {
            # code...
            //ppn
            $ppn = $dt->ppn;
            if ($ppn == 10) {
                $jml_ppn = $ppn / 100;
                //ppn
                $nilaidasar = $get_harga->hargapo * $get_kodebar->qty;
                $hargadasar = $nilaidasar * $jml_ppn;
                $hasil_ppn = $get_harga->hargapo + $hargadasar;
                $ongkirplusqty = $get_jumlah_bpo->jumlahbpo * $get_kodebar->qty;
                $ongkir_ppn = $ongkirplusqty * $jml_ppn;
                $ongkir = $get_jumlah_bpo->jumlahbpo + $ongkir_ppn;
            } else {
                //ppn
                $ongkir_ppn = 0;
                $hasil_ppn = 0;
                $ongkir = $get_jumlah_bpo->jumlahbpo;
            }

            //pph
            $pph = $dt->pph;
            if ($pph != 0) {
                $jml_pph = $pph / 100;
                $nilaidasarpph = $get_harga->hargapo * $get_kodebar->qty;
                $hargadasarpph = $nilaidasarpph * $jml_pph;
                $total_pph = $get_harga->hargapo + $hargadasarpph;
            } else {
                $total_pph = 0;
            }

            //pajak
            // $p = $hasil_ppn + $total_pph + $ongkir_ppn;
            $p = $hargadasar + $ongkir_ppn + $hargadasarpph;
            // $pajak = number_format(round($p), 2, ",", ".");
            $pajak = $p;
            //tootal po
            $ttlpo = $get_harga_po->hargapo + $p;
            // $total_po = number_format($ttlpo), 2, ",", ".");
            $total_po = $dt->totalbayar;
            //nilai po
            $nilai_po = $get_harga->hargapo * $get_kodebar->qty;
            // $nilai_po = number_format($get_harga_po->hargapo), 2, ",", ".");
            //bpo
            $bpo = $get_jumlah_bpo->jumlahbpo * $get_kodebar->qty;
            // $bpo = number_format($get_jumlah_bpo->jumlahbpo), 2, ",", ".");
            //saldo
            $sisa_saldo = ($dt->totalbayar) - $get_jumlah_sudah_bayar->kasir_bayar;
            $saldo = $sisa_saldo;
            // $saldo = number_format($sisa_saldo), 2, ",", ".");
            //tglpo
            $tglpo = date_format(date_create($dt->tglpo), 'Y/m/d');
            //kurs
            $kurs = $get_kurs->kurs;
            //terbayar
            $bayar = $get_jumlah_sudah_bayar->kasir_bayar;
            // $bayar = number_format(round($get_jumlah_sudah_bayar->kasir_bayar), 2, ",", ".");
            $kaleng = "GENZA KALENG";
        } else {
            # code...
            //ppn
            $ppn = $dt->ppn;
            if ($ppn == 10) {
                $jml_ppn = $ppn / 100;
                //ppn
                $hasil_ppn = $get_harga_po->hargapo * $jml_ppn;
            } else {
                //ppn
                $hasil_ppn = 0;
            }

            //pph
            $pph = $dt->pph;
            if ($pph != 0) {
                $jml_pph = $pph / 100;
                $total_pph = $get_harga_po->hargapo * $jml_pph;
            } else {
                $total_pph = 0;
            }

            //pajak
            $p = $hasil_ppn + $total_pph;
            // $pajak = number_format(round($p), 2, ",", ".");
            $pajak = $p;
            //tootal po
            $ttlpo = $get_harga_po->hargapo + $p;
            // $total_po = number_format($ttlpo), 2, ",", ".");
            $total_po = $dt->totalbayar;
            //nilai po
            $nilai_po = $get_harga_po->hargapo;
            // $nilai_po = number_format($get_harga_po->hargapo), 2, ",", ".");
            //bpo
            $bpo = $get_jumlah_bpo->jumlahbpo;
            // $bpo = number_format($get_jumlah_bpo->jumlahbpo), 2, ",", ".");
            //saldo
            $sisa_saldo = ($dt->totalbayar) - $get_jumlah_sudah_bayar->kasir_bayar;
            $saldo = $sisa_saldo;
            // $saldo = number_format($sisa_saldo), 2, ",", ".");
            //tglpo
            $tglpo = date_format(date_create($dt->tglpo), 'Y/m/d');
            //kurs
            $kurs = $get_kurs->kurs;
            //terbayar
            $bayar = $get_jumlah_sudah_bayar->kasir_bayar;
            // $bayar = number_format(round($get_jumlah_sudah_bayar->kasir_bayar), 2, ",", ".");
            $kaleng = "";
        }



        $data = [
            'po' => $dt,
            'pajak' => $pajak,
            'nilaipo' => $nilai_po,
            'totalpo' => $total_po,
            'bpo' => $bpo,
            'bayar' => $bayar,
            'saldo' => $saldo,
            'tglpo' => $tglpo,
            'kurs' => $kurs,
            'kaleng' => $kaleng,
        ];

        echo json_encode($data);
    }

    function caripo()
    {
        $refpo = $this->input->post('refpo');

        $dt = $this->M_pp->ambilpoqr($refpo);

        // untuk sum harga dan qty pada item_Po
        $query_kodebar = "SELECT nabar, kodebar, qty FROM item_po WHERE noref = '$refpo'";
        $get_kodebar = $this->db_logistik_pt->query($query_kodebar)->row();

        // untuk sum harga dan qty pada item_Po
        $query_harga_po = "SELECT SUM(harga*qty) AS hargapo FROM item_po WHERE noref = '$refpo'";
        $get_harga_po = $this->db_logistik_pt->query($query_harga_po)->row();
        $query_harga = "SELECT SUM(harga) AS hargapo FROM item_po WHERE noref = '$refpo'";
        $get_harga = $this->db_logistik_pt->query($query_harga)->row();
        // endsum

        // untuk sum jumlah bpo pada item_po
        $query_jumlah_bpo = "SELECT SUM(JUMLAHBPO) AS jumlahbpo FROM item_po where noref = '$refpo'";
        $get_jumlah_bpo = $this->db_logistik_pt->query($query_jumlah_bpo)->row();
        // endsum

        // sum kasir bayar pada tabel pp
        $query_jumlah_sudah_bayar = "SELECT SUM(kasir_bayar) AS kasir_bayar FROM pp where ref_po = '$refpo' AND batal <> 1";
        $get_jumlah_sudah_bayar = $this->db_logistik_pt->query($query_jumlah_sudah_bayar)->row();
        // endsum

        //kurs
        $query_kurs = "SELECT DISTINCT kurs FROM item_po WHERE noref = '$refpo'";
        $get_kurs = $this->db_logistik_pt->query($query_kurs)->row();

        if ($get_kodebar->kodebar == '102505700000002' && $dt->jenis_spp == 'SPP') {
            $ppn = $dt->ppn;
            if ($ppn == 10) {
                $jml_ppn = $ppn / 100;
                //ppn
                $nilaidasar = $get_harga->hargapo * $get_kodebar->qty;
                $hargadasar = $nilaidasar * $jml_ppn;
                $hasil_ppn = $get_harga->hargapo + $hargadasar;
                $ongkirplusqty = $get_jumlah_bpo->jumlahbpo * $get_kodebar->qty;
                $ongkir_ppn = $ongkirplusqty * $jml_ppn;
                $ongkir = $get_jumlah_bpo->jumlahbpo + $ongkir_ppn;
            } else {
                //ppn
                $ongkir_ppn = 0;
                $hasil_ppn = 0;
                $ongkir = $get_jumlah_bpo->jumlahbpo;
            }

            //pph
            $pph = $dt->pph;
            if ($pph != 0) {
                $jml_pph = $pph / 100;
                $nilaidasarpph = $get_harga->hargapo * $get_kodebar->qty;
                $hargadasarpph = $nilaidasarpph * $jml_pph;
                $total_pph = $get_harga->hargapo + $hargadasarpph;
            } else {
                $total_pph = 0;
            }

            //pajak
            // $p = $hasil_ppn + $total_pph + $ongkir_ppn;
            $p = $hargadasar + $ongkir_ppn + $hargadasarpph;
            // $pajak = number_format(round($p), 2, ",", ".");
            $pajak = $p;
            //tootal po
            $ttlpo = $get_harga_po->hargapo + $p;
            // $total_po = number_format($ttlpo), 2, ",", ".");
            $total_po = $dt->totalbayar;
            //nilai po
            $nilai_po = $get_harga->hargapo * $get_kodebar->qty;
            // $nilai_po = number_format($get_harga_po->hargapo), 2, ",", ".");
            //bpo
            $bpo = $get_jumlah_bpo->jumlahbpo * $get_kodebar->qty;
            // $bpo = number_format($get_jumlah_bpo->jumlahbpo), 2, ",", ".");
            //saldo
            $sisa_saldo = ($dt->totalbayar) - $get_jumlah_sudah_bayar->kasir_bayar;
            $saldo = $sisa_saldo;
            // $saldo = number_format($sisa_saldo), 2, ",", ".");
            //tglpo
            $tglpo = date_format(date_create($dt->tglpo), 'Y/m/d');
            //kurs
            $kurs = $get_kurs->kurs;
            //terbayar
            $bayar = $get_jumlah_sudah_bayar->kasir_bayar;
            // $bayar = number_format(round($get_jumlah_sudah_bayar->kasir_bayar), 2, ",", ".");
            $kaleng = "GENZA KALENG";
        } else {
            //ppn
            $ppn = $dt->ppn;
            if ($ppn == 10) {
                $jml_ppn = $ppn / 100;
                //ppn
                $hasil_ppn = $get_harga_po->hargapo * $jml_ppn;
            } else {
                //ppn
                $hasil_ppn = 0;
            }

            //pph
            $pph = $dt->pph;
            if ($pph != 0) {
                $jml_pph = $pph / 100;
                $total_pph = $get_harga_po->hargapo * $jml_pph;
            } else {
                $total_pph = 0;
            }

            //pajak
            $p = $hasil_ppn + $total_pph;
            // $pajak = number_format(round($p), 2, ",", ".");
            $pajak = $p;
            //tootal po
            $ttlpo = $get_harga_po->hargapo + $p;
            // $total_po = number_format($ttlpo), 2, ",", ".");
            $total_po = $dt->totalbayar;
            //nilai po
            $nilai_po = $get_harga_po->hargapo;
            // $nilai_po = number_format($get_harga_po->hargapo), 2, ",", ".");
            //bpo
            $bpo = $get_jumlah_bpo->jumlahbpo;
            // $bpo = number_format($get_jumlah_bpo->jumlahbpo), 2, ",", ".");
            //saldo
            $sisa_saldo = ($dt->totalbayar) - $get_jumlah_sudah_bayar->kasir_bayar;
            $saldo = $sisa_saldo;
            // $saldo = number_format($sisa_saldo), 2, ",", ".");
            //tglpo
            $tglpo = date_format(date_create($dt->tglpo), 'Y/m/d');
            //kurs
            $kurs = $get_kurs->kurs;
            //terbayar
            $bayar = $get_jumlah_sudah_bayar->kasir_bayar;
            // $bayar = number_format(round($get_jumlah_sudah_bayar->kasir_bayar), 2, ",", ".");
            $kaleng = "";
        }


        // $bayar = number_format(round($get_jumlah_sudah_bayar->kasir_bayar), 2, ",", ".");

        $data = [
            'po' => $dt,
            'pajak' => $pajak,
            'nilaipo' => $nilai_po,
            'totalpo' => $total_po,
            'bpo' => $bpo,
            'bayar' => $bayar,
            'saldo' => $saldo,
            'tglpo' => $tglpo,
            'kurs' => $kurs,
        ];

        echo json_encode($data);
    }

    public function update_terbayar_po()
    {
        $data = $this->M_pp->update_terbayar_po();
        echo json_encode($data);
    }
    public function simpan_pp()
    {
        $data = $this->M_pp->simpan_pp();
        echo json_encode($data);
    }

    function sum_total_bayar()
    {
        $noref = $this->input->post('noref');
        $data = $this->db_logistik_pt->query("SELECT SUM(jumlah) AS totalbayar FROM pp WHERE ref_po='$noref' AND batal <> 1")->row();
        echo json_encode($data);
    }

    public function cetak()
    {
        $no_ref = $this->uri->segment('3');
        $no_pp = str_replace('.', '/',  $no_ref);

        $id = $this->uri->segment('4');

        $this->qrcode($no_pp, $id);

        $data['data_pp'] = $this->db_logistik_pt->get_where('pp', array('ref_pp' => $no_pp, 'id' => $id))->row();
        $data['po'] = $this->db_logistik_pt->get_where('po', array('noreftxt' => $data['data_pp']->ref_po))->row();
        $data['devisi'] = $this->db_logistik_pt->get_where('tb_devisi', array('kodetxt' => $data['data_pp']->ref_po))->row();

        $this->db_logistik_pt->where('id', $id);
        $this->db_logistik_pt->where('ref_pp', $no_pp);
        $cek = $this->db_logistik_pt->get_where('pp');
        if ($cek->num_rows() > 0) {
            $cek = $cek->row();
            $jml_ = (int)$cek->jml_cetak;
            // echo $jml_;
            $up = [
                'jml_cetak' => $jml_ + 1
            ];
            $this->db_logistik_pt->where('id', $id);
            $this->db_logistik_pt->where('ref_pp', $no_pp);
            $this->db_logistik_pt->update('pp', $up);
        } else {
            $ins = [
                'jml_cetak' => 1
            ];
            $this->db_logistik_pt->where('id', $id);
            $this->db_logistik_pt->where('ref_pp', $no_pp);
            $this->db_logistik_pt->update('pp', $ins);
            // $this->db_logistik_pt->insert('po', $ins);
        }

        $data['qrcode'] = 'BPB-' . $id . '.png';

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            // 'format' => [190, 236],
            'margin_top' => '3',
            'margin_left' => '3',
            'margin_right' => '3',
            'orientation' => 'P'
        ]);
        // $mpdf->SetHTMLFooter('<h4>footer Nih</h4>');
        if ($cek->batal == 1) {
            # code...
            $mpdf->SetWatermarkImage(
                '././assets/img/batal.png',
                0.3,
                '',
                array(25, 5)
            );
            $mpdf->showWatermarkImage = true;
        }

        $html = $this->load->view('v_pp_print', $data, true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    function qrcode($no_pp, $id)
    {
        $this->load->library('ciqrcode');
        // header("Content-Type: image/png");

        $config['cacheable']    = false; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/qrcode/pp/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = 'BPB-' . $id . '.png'; //buat name dari qr code

        $params['data'] = $no_pp; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
    }

    function get_data_pp()
    {
        $id_pp = $this->input->post('id');
        $data_pp = $this->db_logistik_pt->get_where('pp', array('id' => $id_pp))->row();

        $ref_po = $data_pp->ref_po;
        $data_po = $this->db_logistik_pt->get_where('po', array('noreftxt' => $ref_po))->row();

        $query_jumlah_sudah_bayar = "SELECT SUM(jumlah) AS jumlah FROM pp where ref_po = '$ref_po'";
        // var_dump("SELECT SUM(jumlah) AS jumlah FROM pp where ref_po = '$ref_po'");exit();
        $get_jumlah_sudah_bayar = $this->db_logistik_pt->query($query_jumlah_sudah_bayar)->row();
        // var_dump($get_jumlah_sudah_bayar->jumlah);exit();
        echo json_encode(array('data_pp' => $data_pp, 'sudah_bayar' => $get_jumlah_sudah_bayar->jumlah, 'data_po' => $data_po));
    }

    function update_pp()
    {
        $data = $this->M_pp->update_pp();
        echo json_encode($data);
    }

    function cancel_update_pp()
    {
        $data = $this->M_pp->cancel_update_pp();
        echo json_encode($data);
    }

    function deletePP()
    {

        $po = $this->M_pp->update_po_ter();
        $pp_logistik = $this->M_pp->batal_pp_log();
        $pp = $this->M_pp->update_batal_pp();

        $data = [
            'pp_logistik' => $pp_logistik,
            'pp' => $pp,
            'po' => $po,
        ];

        echo json_encode($data);
    }
}
