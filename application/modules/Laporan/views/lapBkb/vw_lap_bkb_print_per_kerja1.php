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
            vertical-align: middle;
        }

        .singleborder {
            border-collapse: collapse;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h2 style="font-size:14px;font-weight:bold;margin-bottom: 1;"><?= $dev; ?></h2>
    <?php if ($alamat != '01') {
        echo '';
    } else {
        echo '<h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    } ?>
    <div style="text-align: center;">
        <h3 style="font-size:11px;font-weight:bold; margin-bottom: -1%;"><u>REGISTER KELUAR BARANG (BKB)</u></h3>
    </div>
    <br>
    <?php if (empty($bt)) { ?>
        <table border="0" width="100%">
            <thead>
                <tr>
                    <td style="text-align: left;"><b> PERIODE : <?= $periode; ?> </b><br>
                        <b>Devisi : <?= $dev; ?></b><br>
                        <?php if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') { ?>
                            <b>AFD : -</b>
                        <?php } else { ?>
                            <b>Bagian : <?= $bagian; ?></b>
                        <?php } ?>
                    </td>
                    <td style="text-align: right;"><br><br><i>By System MIPS</i></td>
                </tr>
            </thead>
        </table>
        <table width="100%" class="singleborder" border="1">
            <thead style="text-align: center;">
                <tr>
                    <td style="font-weight: bold; text-align: center; width: 5%;">Blok</td>
                    <td style="font-weight: bold; text-align: center; width: 8%;">Tgl</td>
                    <td style="font-weight: bold; text-align: center; width: 8%;">No BKB</td>
                    <td style="font-weight: bold; text-align: center; width: 12%;">Kode Barang</td>
                    <td style="font-weight: bold; text-align: center; width: 18%;">Nama Barang</td>
                    <td style="font-weight: bold; text-align: center; width: 5%;">Sat</td>
                    <td style="font-weight: bold; text-align: center; width: 10%;">Qty</td>
                    <td style="font-weight: bold; text-align: center; width: 10%;">Total Nilai (Rp)</td>
                    <td style="font-weight: bold; text-align: center; width: 24%;">Keterangan</td>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td colspan="8" style="text-align: center;">-</td>
                </tr>

                <tr>
                    <td style="text-align: center;" colspan="9">Tidak ada data</td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right; padding-right: 100px;"> Total </td>
                    <td></td>
                    <td style="text-align: right;">0</td>
                    <td style="text-align: right;">0</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <?php } else {
        foreach ($bt as $b) { ?>
            <table border="0" width="100%">
                <thead>
                    <tr>
                        <td style="text-align: left;"><b> PERIODE : <?= $periode; ?> </b><br>
                            <b>Devisi : <?= $dev; ?></b><br>
                            <?php if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') { ?>
                                <b>AFD : <?= $b->afd; ?></b>
                            <?php } else { ?>
                                <b>Bagian : <?= $bagian; ?></b>
                            <?php } ?>
                        </td>
                        <td style="text-align: right;"><br><br><i>By System MIPS</i></td>
                    </tr>
                </thead>
            </table>
            <table width="100%" class="singleborder" border="1">
                <thead style="text-align: center;">
                    <tr>
                        <td style="font-weight: bold; text-align: center; width: 5%;">Blok</td>
                        <td style="font-weight: bold; text-align: center; width: 8%;">Tgl</td>
                        <td style="font-weight: bold; text-align: center; width: 8%;">No BKB</td>
                        <td style="font-weight: bold; text-align: center; width: 12%;">Kode Barang</td>
                        <td style="font-weight: bold; text-align: center; width: 18%;">Nama Barang</td>
                        <td style="font-weight: bold; text-align: center; width: 5%;">Sat</td>
                        <td style="font-weight: bold; text-align: center; width: 10%;">Qty</td>
                        <td style="font-weight: bold; text-align: center; width: 10%;">Total Nilai (Rp)</td>
                        <td style="font-weight: bold; text-align: center; width: 24%;">Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') {
                        $query = "SELECT DISTINCT a.kodesub, a.ketsub, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' AND a.afd ='$b->afd' ORDER BY a.ketsub ASC";
                    } else {
                        $query = "SELECT DISTINCT a.kodesub, a.ketsub, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' ORDER BY a.ketsub ASC";
                    }
                    $bpk = $this->db_logistik_pt->query($query)->result();
                    foreach ($bpk as $bk) { ?>
                        <tr>
                            <td colspan="8"><b><?= $bk->kodesub; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $bk->ketsub; ?></b></td>
                        </tr>
                        <?php
                        if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') {
                            $query = "SELECT a.*, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.kodesub = '$bk->kodesub' AND a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' AND a.afd ='$b->afd'";
                        } else {
                            $query = "SELECT a.*, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.kodesub = '$bk->kodesub' AND a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian'";
                        }
                        $bpr = $this->db_logistik_pt->query($query)->result();

                        $total = 0;
                        $total_h = 0;
                        foreach ($bpr as $bp) {
                            $total += $bp->qty2;
                            $total_h += ($bp->qty2 * $bp->nilai_item);
                        ?>
                            <tr>
                                <td style="text-align: center;"><?= $bp->blok; ?></td>
                                <td style="text-align: center;"><?= date_format(date_create($bp->tgl), 'd/m/Y'); ?></td>
                                <td style="text-align: center;"><?= $bp->skb; ?></td>
                                <td style="text-align: center;"><?= $bp->kodebar; ?></td>
                                <td style="text-align: left;"><?= $bp->nabar; ?></td>
                                <td style="text-align: center;"><?= $bp->satuan; ?></td>
                                <td style="text-align: right;"><?= number_format($bp->qty2, 2); ?></td>
                                <td style="text-align: right;"><?= number_format(($bp->qty2 * $bp->nilai_item), 2); ?></td>
                                <td style="text-align: left;"><?= $bp->ket; ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="5" style="text-align: right; padding-right: 100px;"> Total </td>
                            <td></td>
                            <td style="text-align: right;"><?= number_format($total, 2); ?> </td>
                            <td style="text-align: right;"><?= number_format($total_h, 2); ?></td>
                            <td></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    <?php }
    } ?>
</body>

</html>