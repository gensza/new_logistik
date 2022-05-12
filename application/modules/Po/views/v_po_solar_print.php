<!DOCTYPE html>
<html>
<?php
$alamat_supplier = (!empty($supplier->alamat)) ? $supplier->alamat : "-";
$tlp_supplier = (!empty($supplier->tlp)) ? $supplier->tlp : "-";
$fax_supplier = (!empty($supplier->fax)) ? $supplier->fax : "-";

$pot_ppn_format = ($po->ppn == $ppn->ppn) ? number_format($dikurangi_biayalain * 0.1, 2, ",", ".") : "0";
$pot_ppn = ($po->ppn == $ppn->ppn) ? ($dikurangi_biayalain * 0.1) : "0";

$jml_pph = $po->pph / 100;
$hit_pph_format = ($po->pph != NULL) ? number_format($dikurangi_biayalain * $jml_pph, 2, ",", ".") : "0";
$hit_pph = ($po->pph != NULL) ? ($dikurangi_biayalain * $jml_pph) : "0";
// var_dump($hit_pph);
// exit();
// $total_bayar_format = number_format($totbay, 2, ",", ".");
// $total_bayar = $po->totalbayar;
function kekata($x)
{
    $x = abs($x);
    $angka = array(
        "", "satu", "dua", "tiga", "empat", "lima",
        "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
    );
    $temp = "";
    if ($x < 12) {
        $temp = " " . $angka[$x];
    } else if ($x < 20) {
        $temp = kekata($x - 10) . " belas";
    } else if ($x < 100) {
        $temp = kekata($x / 10) . " puluh" . kekata($x % 10);
    } else if ($x < 200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x < 1000) {
        $temp = kekata($x / 100) . " ratus" . kekata($x % 100);
    } else if ($x < 2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x < 1000000) {
        $temp = kekata($x / 1000) . " ribu" . kekata($x % 1000);
    } else if ($x < 1000000000) {
        $temp = kekata($x / 1000000) . " juta" . kekata($x % 1000000);
    } else if ($x < 1000000000000) {
        $temp = kekata($x / 1000000000) . " milyar" . kekata(fmod($x, 1000000000));
    } else if ($x < 1000000000000000) {
        $temp = kekata($x / 1000000000000) . " trilyun" . kekata(fmod($x, 1000000000000));
    }
    return $temp;
}

function terbilang($x, $style = 4)
{
    if ($x < 0) {
        $hasil = "minus " . trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }
    return $hasil;
}

if ($po->lokasi == 'HO') {
    $alamat_lok = $this->session->userdata('alamat_ho');
} else {
    $alamat_lok = $this->session->userdata('alamat_site');
}

$alamat_ho = $this->session->userdata('alamat_ho');
$alamat_site = $this->session->userdata('alamat_site');
$logo_pt = $this->session->userdata('logo_pt');
$lokasi = $this->session->userdata('status_lokasi');
$nama_pt = $this->session->userdata('nama_pt');
?>

<head>
    <style type="text/css">
        #tabel_po tr td {
            /*font-size: 12px;*/
            border: 1px solid black;
        }

        body {
            font-family: Verdana;
            font-size: 8px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 20px;
        }

        .singleborder {
            border-collapse: collapse;
            border: 1px solid black;
        }

        #tr_content td.noborder {
            /*border: none;*/
            border-bottom: 0px solid #FFF;
            border-top: 0px solid #FFF;
        }

        #tr_content td.noborder2 {
            border-top: 0px solid #FFF;
            border-right: 0px solid #FFF;
            border-bottom: 0px solid #FFF;
            border-left: 0px solid #FFF;
        }

        h4 {
            font-weight: normal;
            margin: 0px;
            text-align: center;
        }
    </style>
    <title>Pesanan Pembelian</title>
</head>

<body>
    <table width="100%" border="0">
        <tr>
            <td rowspan="3" width="10%" height="10px" align="right"><img width="10%" height="60px" style="padding-left:8px" src="././assets/logo/<?= $logo_pt ?>"></td>
        <tr>
            <td align="left" style="font-size:8.5px;" valign="top">
                <h3 style="font-size:14px;font-weight:bold;"> <?= $po->devisi ?></h3>
                <?php if ($this->session->userdata('status_lokasi') == 'HO') { ?>
                    <?= $alamat_lok ?>
                <?php } ?>
            </td>
            <td width="10%" height="10px" align="center"><img width="10%" height="60px" style="padding-right:8px" src="./assets/qrcode/po/<?php echo $id . "_" . $nopo; ?>.png"></td>
        </tr>
    </table>
    <?php
    if ($this->session->userdata('status_lokasi') == 'HO') {
    ?>
        <hr>
        <table border="0">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $po->namapt ?></td>
            </tr>
            <br>
            <tr>
                <td>No. NPWP</td>
                <td>:</td>
                <td><?= $pt->npwp; ?></td>
            </tr>
            <tr>
                <td valign="top">Alamat NPWP</td>
                <td valign="top">:</td>
                <td align="justify">
                    <?= $pt->alamatnpwp; ?>
                </td>
            </tr>
        </table>
    <?php } ?>


    <hr>
    <h3 align="right" style="margin-bottom: 0px;margin-top: 0px; font-weight: normal;"><small>Jakarta, <?= date('d-m-Y', strtotime($po->tglpo)); ?></small></h3>
    <h2 align="center" style="margin: 0px;margin-top: -10px;">PESANAN PEMBELIAN</h2>
    <!-- <p align="center" style="margin-top: 0px;font-size: 12px;">
    No. PP : <?= $po->noreftxt; ?> <br />
    No. SPP : <?= $po->no_refppo; ?>
  </p> -->
    <h3 style="font-weight: normal;margin-top: -8px; margin-bottom:0px; font-size: 8; text-align: center;">
        No.&nbsp;PO&nbsp;:&nbsp;<?= $po->noreftxt; ?>
    </h3>
    <table border="0" align="right" style="margin-top: -20px; margin-bottom:-1px;">
        <?php foreach ($spp as $d) { ?>
            <tr>
                <td>
                    <h3 style="font-weight: normal;  word-break: break-word; font-size: 8;">
                        No.&nbsp;SPP&nbsp;:-&nbsp;<?= $d->refppo; ?>
                    </h3>
                </td>
            </tr>
        <?php } ?>
    </table>

    <!-- <h3 align="right" style="font-weight: normal; margin-top: -20px; margin-bottom:-1px; word-break: break-word; font-size: 8;">
    -&nbsp;<?= $po->no_refppo; ?>
  </h3> -->

    <table border="1" class="singleborder" width="100%">
        <tr>
            <td width="58%" style="padding:5px;">
                Kepada YTH,<br />
                <?= $supplier->supplier; ?><br />
                <?php if ($this->session->userdata('status_lokasi') != 'HO') { ?>
                <?php } else { ?>
                    <?= $alamat_supplier; ?><br />
                    Tlp. <?= $tlp_supplier; ?><br />
                    Fax. <?= $fax_supplier; ?><br />
                <?php } ?>
            </td>
            <td width="60%" style="padding:5px;">
                <br />
                No. Penawaran&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $po->ket_acc; ?><br />
                Syarat Pembayaran : Pembayaran <?= $po->tempo_bayar; ?> hari setelah dokumen diterima lengkap<br />
                Jadwal Pengiriman&nbsp;&nbsp; : <?= $po->ket_kirim; ?> <br />
                Alamat Penyerahan : <?= $po->lokasikirim; ?> <br />
            </td>
        </tr>
    </table>
    <table border="1" class="singleborder" width="100%">
        <thead>
            <tr>
                <td align="center" width="3%">No</td>
                <td align="center" width="15%">Kode Barang</td>
                <td align="center" width="15%">Nama Barang</td>
                <td align="center" width="16%">Merk</td>
                <td align="center" width="4%">No. Part</td>
                <td align="center" width="8%">Qty</td>
                <td align="center" width="5%">SAT</td>
                <td align="center" width="15%">Harga&nbsp;Satuan</td>
                <td align="center" width="5%">Disc %</td>
                <td align="center" width="15%" colspan="2">Total&nbsp;Harga</td>

            </tr>
        </thead>
        <tbody>

            <?php
            $no = 1;
            $jumlah_biaya_lain = 0;
            $jum_totbay = 0;
            $hargadasarppn = 0;
            $hargadasar = 0;
            $ongkirppn = 0;
            $ongkir = 0;
            $hargaPlusPPH = 0;
            $hargaPPh = 0;
            $hargaongkir = 0;
            $ppntotal = 0;
            $nama_bebanbpo = array();
            foreach ($item_po as $list_item) {
                //harga dasar plus ppn 10% ( untuk mengambil total harga)
                if ($po->ppn == $ppn->ppn) {
                    $ppn = "0.1";
                } else {
                    $ppn = "0";
                }
                if ($po->pph == NULL) {
                    $jml_pph = $po->pph / 100;
                } else {
                    $jml_pph = $po->pph / 100;
                }

                $hargaongkir = $list_item->harga + $list_item->JUMLAHBPO;
                $qty_harga = $list_item->qty * $hargaongkir;
                $harga_item = $list_item->qty * $list_item->harga;
                $disc = $list_item->disc / 100;
                $jumharga_item = $harga_item - ($harga_item * $disc);
                $jumharga_pre = $qty_harga - ($qty_harga * $disc);

                $ppntotal = $jumharga_pre * $ppn;

                $hargaPlusPPH = $harga_item * $jml_pph;
                $pph = $hargaPlusPPH;
                $hargaPPh = $list_item->harga +  $hargaPlusPPH;
                //done harga dasar
            ?>
                <tr id="tr_content">
                    <td class="noborder" rowspan="2" align="center"><?= $no; ?></td>
                    <td class="noborder2" align="left"><?= $list_item->kodebartxt; ?></td>
                    <td class="noborder2" align="left"><?= $list_item->nabar; ?></td>
                    <td class="noborder2" align="left"><?= htmlspecialchars($list_item->merek); ?></td>
                    <td class="noborder" rowspan="2" align="center">-</td>
                    <td class="noborder" rowspan="2" align="center"><?= number_format($list_item->qty, 2, ",", "."); ?></td>
                    <td class="noborder" rowspan="2" align="center"><?= $list_item->sat; ?></td>
                    <?php if ($this->session->userdata('status_lokasi') != 'HO' && $po->jenis_spp != 'SPPI') { ?>
                        <td class="noborder" rowspan="2" align="right"><?= $list_item->kurs; ?>&nbsp;</td>
                        <td class="noborder" rowspan="2" align="center"></td>
                        <td class="noborder" rowspan="2" colspan="2" align="right"><?= $list_item->kurs; ?>&nbsp;</td>
                    <?php } else if ($this->session->userdata('status_lokasi') != 'HO' && $po->jenis_spp == 'SPPI') { ?>

                        <td class="noborder" rowspan="2" align="right"><?= $list_item->kurs; ?>&nbsp;<?= number_format($list_item->harga, 2, ",", "."); ?></td>
                        <td class="noborder" rowspan="2" align="center"><?= $list_item->disc; ?></td>
                        <td class="noborder" rowspan="2" colspan="2" align="right"><?= $list_item->kurs; ?>&nbsp;<?= number_format($jumharga_item, 2, ",", "."); ?></td>
                    <?php } else { ?>
                        <td class="noborder" rowspan="2" align="right"><?= $list_item->kurs; ?>&nbsp;<?= number_format($list_item->harga, 2, ",", "."); ?></td>
                        <td class="noborder" rowspan="2" align="center"><?= $list_item->disc; ?></td>
                        <td class="noborder" rowspan="2" colspan="2" align="right"><?= $list_item->kurs; ?>&nbsp;<?= number_format($jumharga_item, 2, ",", "."); ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td style="border: none;" colspan="3" rowspan="1">*<?= $list_item->ket; ?></td>
                    <!-- <td style="border: none;" colspan="3" rowspan="1">*<?= htmlspecialchars($list_item->ket); ?></td> -->
                </tr>
            <?php
                array_push($nama_bebanbpo, $list_item->nama_bebanbpo);
                // $jumlah_biaya_lain += $list_item->JUMLAHBPO;
                $jum_totbay += $jumharga_pre;
                //untuk mengambil ppn ongkir
                $ongkirppn = $list_item->JUMLAHBPO * $ppn;
                $ppnOngkir = $ongkirppn * $list_item->qty;
                $jumlah_biaya_lain = $list_item->JUMLAHBPO + $ongkirppn;
                $ongkirqty = $list_item->JUMLAHBPO * $list_item->qty;
                $no++;
            }
            ?>
        </tbody>
    </table>

    <table border="1" class="singleborder" width="100%">
        <tr>
            <td colspan="8" width="448px" rowspan="8" valign="top">
                <b>Keterangan : </b><br />
                <?= $po->ket; ?><br />
                <!-- <?= htmlspecialchars($po->ket); ?><br /> -->
                <b>Keterangan pembayaran: </b><br />
                Nama Pemilik&nbsp; : <?= $supplier->atasnama ?><br />
                No. Rekening&nbsp; : <?= $supplier->norek ?><br />
            </td>
            <td colspan="3">Biaya Lainnya (<?= join(", ", $nama_bebanbpo); ?>)</td>
            <td colspan="2" align="right"><?= $list_item->kurs; ?>. <?= number_format($ongkirqty, 2, ",", "."); ?></td>

        </tr>
        <tr>
            <td colspan="3">SUB TOTAL</td>
            <td colspan="2" align="right"><?= $list_item->kurs; ?>. <?= number_format($jumharga_item + $ongkirqty, 2, ",", "."); ?></td>
        </tr>
        <tr>
            <td colspan="3">PPN <?= $po->ppn ?>%</td>
            <td colspan="2" align="right"><?= $list_item->kurs; ?>. <?= number_format($ppntotal, 2, ",", "."); ?></td>

        </tr>
        <tr>
            <td colspan="3">PPH (<?= $po->pph ?>%)</td>
            <td colspan="2" align="right"><?= $list_item->kurs; ?>. <?= number_format($pph, 2, ",", "."); ?></td>
        </tr>

        <!-- <tr>
            <td colspan="3"></td>
            <td colspan="2"></td>
        </tr> -->

        <!-- <tr>
            <td colspan="3"></td>
            <td colspan="2" align="right"></td>
        </tr> -->
        <tr>
            <td colspan="3">GRAND TOTAL</td>
            <td colspan="2" align="right">
                <?php
                $isi = $jumharga_item + $ppntotal + $pph + $ongkirqty;

                ?>
                <br />
                <?= $list_item->kurs; ?>. <?= number_format($isi, 2, ",", "."); ?>
            </td>
        </tr>

    </table>
    <table border="1" class="singleborder" width="100%">
        <?php
        $total = $jumharga_item + $ppntotal + $pph + $ongkirqty;
        // var_dump("iyayayay".$total);exit();


        $kur = $list_item->kurs;
        if ($kur == "Rp") {
            $kurs = "Rupiah";
        }
        ?>
        <tr>
            <td colspan="10"><b>Terbilang : <?= terbilang($total, $style = 3) . '&nbsp;' . $kurs ?></b></td>
        </tr>

    </table>

    <table border="1" class="singleborder" width="100%">

        <?php
        $lokasi_sesi = $this->session->userdata('status_lokasi');
        switch ($po->lokasi) {
            case 'PKS':
            case 'SITE':
            case 'RO':
        ?>
                <tr>
                    <td align="center" width="98px" colspan="5" height="50">
                        Menyetujui,<br />
                        <br />
                        <br />
                        <br />
                        <br />
                        (Supplier)
                    </td>
                    <td align="center" colspan="5" height="50">
                        Dibuat oleh,<br />
                        <br />
                        <br />
                        <br />
                        <br />
                        (KTU)
                    </td>
                    <td align="center" colspan="5" height="50">
                        Menyetujui,<br />
                        <br />
                        <br />
                        <br />
                        <br />
                        (G. Manager)
                    </td>
                </tr>

            <?php
                break;
            case 'HO':
            ?>

                <tr>
                    <td align="center" width="100px" colspan="5" height="50">
                        Menyetujui,<br />
                        <br />
                        <br />
                        <br />
                        <br />
                        (Supplier)
                    </td>
                    <td align="center" colspan="5" height="50">
                        Dibuat oleh,<br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <?php
                        $total = $po->totalbayar;
                        if ($total > 5000000) { ?>
                            (Manager Purchasing)
                        <?php } else { ?>
                            (Purchasing)
                        <?php } ?>
                    </td>
                    <td align="center" colspan="5" height="50">
                        Menyetujui,<br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <?php
                        $total = $po->totalbayar;
                        if ($total > 5000000) { ?>
                            (Direktur Pembelian)
                        <?php } else { ?>
                            (Manager Purchasing)
                        <?php } ?>
                    </td>
                </tr>

        <?php
                break;
            default:
                break;
        }
        ?>

    </table>

    <table border="0" width="100%">
        <tr>
            <td><b>Catatan : Mohon dicek kembali pesanan pembelian ini, apabila setuju tolong diteken dan dicap perusahaan/toko</b></td>
            <td style="text-align: right;">User : <?php echo $this->session->userdata('user'); ?></td>
        </tr>
        <tr>
            <td colspan="2"><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?>,&nbsp;<?= $this->platform->agent(); ?>,&nbsp;Cetakan Ke : <?= $po->jml_cetak ?></i></td>
        </tr>
        <tr>
            <td colspan="2"><i>Print generated by MIPS</i></td>
        </tr>
        <tr>
            <td style="color: crimson;" colspan="2">Revisi :</td>
        </tr>
        <?php if ($po->batal != 0) { ?>
            <tr>
                <td style="color: crimson;" colspan="2">Alasan batal : <?= $po->alasan_batal; ?></td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>