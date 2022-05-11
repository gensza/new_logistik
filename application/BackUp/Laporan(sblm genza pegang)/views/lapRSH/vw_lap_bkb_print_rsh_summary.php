<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Verdana;
            font-size: 9px;
            font-style: normal;
            font-variant: normal;
            font-weight: 300;
            line-height: 10px;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }

        hr {
            margin-top: 0px;
            margin-bottom: 3px;
        }

        td {
            vertical-align: text-top;
        }

        .singleborder {
            border-collapse: collapse;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h2 style="margin-bottom: 0;">PT. MULIA SAWIT AGRO LESTARI</h2>
    <h5 style="margin-top: 5px;"> JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, Kebayoran Baru, Jakarta Selatan, DKI Jakarta Raya - 12140</h5>
    <div style="text-align: center;">
        <h3>Register Summary Harian Material Gudang</h3>
    </div>
    <br>
    <?php
    foreach ($kode_stock as $ks) {
        $saldo = "SELECT saldoakhir_qty, satuan FROM stockawal WHERE kodebar = '$ks->kodebar' AND txtperiode < '$txtperiode' ORDER BY periode DESC LIMIT 1";
        $saldo = $this->db_logistik_pt->query($saldo)->row();
    ?>
        <table border="0" width="100%">
            <thead>
                <tr>
                    <td style="text-align: left;"><b> PERIODE : <?= $periode; ?> </b></td>
                    <td style="text-align: right;"><i>By System MIPS</i></td>
                </tr>
                <tr>
                    <td style="text-align: left;"><b> <?= $ks->kodebar; ?> &nbsp; <?= $ks->nabar; ?></b></td>
                    <td style="text-align: right;"><b>Saldo Sebelum Periode : <?php if ($saldo != NULL) echo number_format($saldo->saldoakhir_qty, 2) . ' ' . $saldo->satuan;
                                                                                else ''; ?></b></td>
                </tr>
            </thead>
        </table>
        <br>
        <table width="100%" class="singleborder" border="1">
            <thead style="text-align: center;">
                <tr>
                    <td>No</td>
                    <td>Tgl</td>
                    <td>Qty Masuk</td>
                    <td>Qty Keluar</td>
                    <td>Saldo</td>
                    <td>Keterangan</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $s_a = $saldo->saldoakhir_qty;
                $lokasi = (int)$lokasi;
                $q_sum = "SELECT * FROM (SELECT tgl AS tgl_b, COUNT(tgl) AS jml_tgl_b, SUM(qty) AS jml_qty_b FROM keluarbrgitem WHERE tgl BETWEEN '$p1' AND '$p2' AND kodebar='$ks->kodebar' AND batal='0' GROUP BY tgl) AS BKB LEFT JOIN (SELECT tgl AS tgl_l, COUNT(tgl) AS jml_tgl_l, SUM(qty) AS jml_qty_l FROM masukitem WHERE tgl BETWEEN '$p1' AND '$p2' AND kodebar='$ks->kodebar' AND batal='0' GROUP BY tgl) AS LPB ON LPB.tgl_l = BKB.tgl_b";
                $q_sum = $this->db_logistik_pt->query($q_sum)->result();
                $s_a = $saldo->saldoakhir_qty;
                $gt_lpb = 0;
                $gt_bkb = 0;
                foreach ($q_sum as $qs) {
                    $s_a = $s_a + $qs->jml_qty_l - $qs->jml_qty_b;
                    $gt_lpb += $qs->jml_qty_l;
                    $gt_bkb += $qs->jml_qty_b;
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $no++; ?></td>
                        <td style="text-align: center;"><?= date_format(date_create($qs->tgl_b), 'd/m/Y'); ?></td>
                        <td style="text-align: right;"><?= number_format($qs->jml_qty_l, 2); ?></td>
                        <td style="text-align: right;"><?= number_format($qs->jml_qty_b, 2); ?></td>
                        <td style="text-align: right;"><?= number_format(($s_a), 2); ?></td>
                        <td></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td style="text-align: center;" colspan="2"><b>GRAND TOTAL</b></td>
                    <td style="text-align: right;"><b><?= number_format($gt_lpb, 2); ?></b></td>
                    <td style="text-align: right;"><b><?= number_format($gt_bkb, 2); ?></b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="text-align: center;" colspan="6"><b>Saldo : <?= number_format($s_a, 2); ?></b></td>
                </tr>

            </tbody>
        </table>
    <?php } ?>
    <br>
    <i>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>
    <div style="text-align: right; ">
        AirLangga Est, 19 August 2020
    </div>
    <br><br>
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: center;">Disetujui Oleh, <br><br><br><br><br>(___________________) <br><br>KTU</td>
                <td style="text-align: center;">Diketahui Oleh, <br><br><br><br><br>(___________________) <br><br>G. Manager</td>
                <td style="text-align: center;">Diperiksa Oleh, <br><br><br><br><br>(___________________) <br><br>Kasie Gudang</td>
                <td style="text-align: center;">Dibuat Oleh, <br><br><br><br><br>(___________________) <br> <br>Krani</td>
            </tr>
        </thead>
    </table>
</body>

</html>