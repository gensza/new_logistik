<!DOCTYPE html>
<html>


<head>
    <style type="text/css">
        #tabel_po tr td {
            /*font-size: 12px;*/
            border: 1px solid #dddddd;
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
    </style>
    <title>Pesanan Pembelian</title>
</head>

<body>
    <table width="100%" border="0">
        <tr>
            <td rowspan="3" width="10%" height="10px" align="right"><img width="10%" height="60px" style="padding-left:8px" src="././assets/img/msal.jpg"></td>
            <td align="left" style="font-size:14px;font-weight:bold;margin-bottom:0px;">PT MULIA SAWIT AGRO LESTARI</td>
            
        </tr>
        <tr>
            <td align="left" style="margin-top:0px;">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
            </td>
            <td width="10%" height="10px" align="right"><img width="10%" height="60px" style="padding-right:8px" src="<?php echo base_url() ?>assets/qrcode/po/<?=$po->qr_code?>"></td>
        </tr>
    </table>
    <hr style="width:100%;margin:0px;">
    <table>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?= $pt->PT; ?></td>
        </tr>
        <tr>
            <td>No. NPWP</td>
            <td>:</td>
            <td><?= $pt->npwp; ?></td>
        </tr>
        <tr>
            <td valign="top">Alamat NPWP</td>
            <td valign="top">:</td>
            <td align="justify"><?= $pt->alamatnpwp; ?></td>
        </tr>
    </table>
    <hr>
    <p align="right" style="margin-bottom: 0px;margin-top: 0px;"><small>Jakarta, <?= date('d-m-Y') ?></small></p>
    <h2 align="center" style="margin: 0px;">PESANAN PEMBELIAN</h2>
    </p>
    <h4 align="center" style="font-weight: normal;margin: 0px;">
        No. PP : <?= $po->noreftxt; ?>
        <div style="text-align: right;">
            No. SPP : <?= $po->no_refppo; ?>
        </div>
    </h4>
    <table border="1" class="singleborder" width="100%" id="tabel_po">
        <tr>
            <td style="padding:5px;" colspan="4">
                Kepada YTH,<br />
                <?= $po->nama_supply; ?><br />
                Tlp. <?= $supply->tlp; ?><br />
                Fax. <?= $supply->fax; ?><br />
            </td>
            <td style="padding: 5px;" colspan="6">
                <br />
                Syarat Pembayaran : Pembayaran <?= $po->tempo_bayar;?> hari setelah dokumen diterima lengkap<br />
                Jadwal Pengiriman : SEGERA<br />
                Alamat Penyerahan : JAKARTA <br />
            </td>
        </tr>
        <tr>
            <td align="center">No</td>
            <td align="center" width="30px">Kode Barang</td>
            <td align="center" width="50px">Nama Barang</td>
            <td align="center">Merk</td>
            <td align="center">No. Part</td>
            <td align="center">Qty</td>
            <td align="center">SAT</td>
            <td align="center">Harga Satuan</td>
            <td align="center">Disc %</td>
            <td align="center">Total Harga</td>
        </tr>
        <?php
        $no = 1;
        $subtotal = 0;
        foreach ($item_po as $ipo) { ?>
            <tr id="tr_content">
                <td class="noborder" rowspan="2" align="center" valign="top"><?= $no; ?></td>
                <td class="noborder2" align="center" valign="top"><?= $ipo->kodebar; ?></td>
                <td class="noborder2" align="center" valign="top"><?= $ipo->nabar; ?></td>
                <td class="noborder2" align="center" valign="top"><?= $ipo->merek; ?></td>
                <td class="noborder" rowspan="2" align="center"></td>
                <td class="noborder" rowspan="2" align="center"><?= $ipo->qty; ?></td>
                <td class="noborder" rowspan="2" align="center"><?= $ipo->sat; ?></td>
                <td class="noborder" rowspan="2" align="right">
                    <?php
                    if ($this->session->userdata('status_lokasi') !== "HO") {
                        echo "";
                    } else {
                        echo number_format($ipo->harga, 2);
                    }
                    ?>
                </td>
                <td class="noborder" rowspan="2" align="center"><?= $ipo->disc; ?></td>
                <td class="noborder" rowspan="2" align="right">
                    <?php
                    if ($this->session->userdata('status_lokasi') !== "HO") {
                        echo "";
                    } else {
                        echo number_format($ipo->jumharga, 2);
                        $subtotal = $subtotal + ($ipo->jumharga);
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">* <?= $ipo->ket; ?></td>
            </tr>
        <?php } ?>

        <tr>
            <td colspan="6" rowspan="3" valign="top">
                <b>Keterangan : </b><br />
                Nama Pemilik : <?= $supply->atasnama; ?><br />
                No. Rekening : <?= $supply->namabank; ?> / <?= $supply->norek; ?><br />
                Uang Muka : Rp 0.00<br />
            </td>
            <td colspan="2">SUB TOTAL</td>
            <td colspan="2" align="right">Rp
                <?php
                if ($this->session->userdata('status_lokasi') !== "HO") {
                    echo "";
                } else {
                    echo number_format($subtotal, 2);
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">PPN 10%</td>
            <td colspan="2" align="right">Rp
                <?php
                $ppn = 0;
                if ($po->ppn == "Y") {
                    $ppn = (10 * $subtotal) / 100;
                }
                if ($this->session->userdata('status_lokasi') !== "HO") {
                    echo "";
                } else {
                    echo number_format($ppn, 2);
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">TOTAL</td>
            <td colspan="2" align="right">
                <?php
                if ($this->session->userdata('status_lokasi') !== "HO") {
                    echo "";
                } else {
                    echo number_format(($subtotal - $ppn), 2);
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="10"><b>Terbilang : </b>
                <?php
                function penyebut($nilai)
                {
                    $nilai = abs($nilai);
                    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
                    $temp = "";
                    if ($nilai < 12) {
                        $temp = " " . $huruf[$nilai];
                    } else if ($nilai < 20) {
                        $temp = penyebut($nilai - 10) . " Belas";
                    } else if ($nilai < 100) {
                        $temp = penyebut($nilai / 10) . " Puluh" . penyebut($nilai % 10);
                    } else if ($nilai < 200) {
                        $temp = " Seratus" . penyebut($nilai - 100);
                    } else if ($nilai < 1000) {
                        $temp = penyebut($nilai / 100) . " Ratus" . penyebut($nilai % 100);
                    } else if ($nilai < 2000) {
                        $temp = " Seribu" . penyebut($nilai - 1000);
                    } else if ($nilai < 1000000) {
                        $temp = penyebut($nilai / 1000) . " Ribu" . penyebut($nilai % 1000);
                    } else if ($nilai < 1000000000) {
                        $temp = penyebut($nilai / 1000000) . " Juta" . penyebut($nilai % 1000000);
                    } else if ($nilai < 1000000000000) {
                        $temp = penyebut($nilai / 1000000000) . " Milyar" . penyebut(fmod($nilai, 1000000000));
                    } else if ($nilai < 1000000000000000) {
                        $temp = penyebut($nilai / 1000000000000) . " Trilyun" . penyebut(fmod($nilai, 1000000000000));
                    }
                    return $temp;
                }

                function terbilang($nilai)
                {
                    if ($nilai < 0) {
                        $hasil = "minus " . trim(penyebut($nilai));
                    } else {
                        $hasil = trim(penyebut($nilai));
                    }
                    return $hasil;
                }

                echo terbilang($subtotal - $ppn)." Rupiah";
                ?>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="4" height="50">
                Menyetujui,<br />
                <br />
                <br />
                <br />
                <br />
                (Supplier)
            </td>
            <td align="center" colspan="3" height="50">
                Dibuat oleh,<br />
                <br />
                <br />
                <br />
                <br />
                (Purchasing)
            </td>
            <td align="center" colspan="3" height="50">
                Menyetujui,<br />
                <br />
                <br />
                <br />
                <br />
                (Direktur Pembelian)
            </td>
        </tr>
    </table>
    <p style="padding: 0px;margin: 0px;"><small><b>Catatan : Mohon dicek kembali pesanan pembelian ini, apabila setuju tolong diteken dan dicap perusahaan/toko lalu difax kembali ke 021-7231819</b></small></p>
    <p style="padding: 0px;margin: 0px;"><small><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?> <?= $this->platform->agent(); ?></i></small><br />
        <small>Print generated by MIPS</small>
    </p>
</body>

</html>