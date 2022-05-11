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
    <h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;"><?= $dev; ?></h2>
    <?php if ($alamat != '01') {
        echo '';
    } else {
        echo '<h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    } ?>
    <div style="text-align: center;">
        <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; "><u>REGISTER KELUAR BARANG (BKB)</u></h3>
    </div>
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
                    <td style="text-align: right;"><br><br><i>By System MIPS</i></td>
                </tr>
            </thead>
        </table>
        <table width="100%" class="singleborder" border="1">
            <thead style="text-align: center;">
                <tr>
                    <td style="text-align: center; width: 5%;"><b>Blok</b></td>
                    <td style="text-align: center; width: 10%;"><b>Qty</b></td>
                    <td style="text-align: center; width: 5%;"><b>Sat</b></td>
                    <td style="text-align: center; width: 10%;"><b>Nominal</b></td>
                    <td style="text-align: center; width: 15%;"><b>Kode Beban</b></td>
                    <td style="text-align: center; width: 25%;"><b>Nama Beban</b></td>
                    <td style="text-align: center; width: 30%;"><b>Keterangan</b></td>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td colspan="7" style="text-align: center;"><b>Tidak ada data </b></td>
                </tr>

                <tr>
                    <td style="text-align: center;" colspan="7"><b>Tidak ada data</b></td>
                </tr>
                <tr>
                    <td><b>Total</b></td>
                    <td style="text-align: right;"><b>0</b></td>
                    <td></td>
                    <td style="text-align: right;"><b>0</b></td>
                    <td colspan="3"></td>
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
                        <td style="text-align: right;"><br><br><i>By System MIPS</i></td>
                    </tr>
                </thead>
            </table>
            <br>
            <table width="100%" class="singleborder" border="1">
                <thead style="text-align: center;">
                    <tr>
                        <td style="text-align: center; width: 5%;"><b>Blok</b></td>
                        <td style="text-align: center; width: 10%;"><b>Qty</b></td>
                        <td style="text-align: center; width: 5%;"><b>Sat</b></td>
                        <td style="text-align: center; width: 10%;"><b>Nominal</b></td>
                        <td style="text-align: center; width: 15%;"><b>Kode Beban</b></td>
                        <td style="text-align: center; width: 25%;"><b>Nama Beban</b></td>
                        <td style="text-align: center; width: 30%;"><b>Keterangan</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') {
                        $query = "SELECT DISTINCT a.kodebar, a.nabar, a.satuan, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' AND a.afd ='$b->afd' ORDER BY a.kodebar ASC";
                    } else {
                        $query = "SELECT DISTINCT a.kodebar, a.nabar, a.satuan, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' ORDER BY a.kodebar ASC";
                    }
                    $bpk = $this->db_logistik_pt->query($query)->result();
                    foreach ($bpk as $bk) { ?>
                        <tr>
                            <td colspan="7"><b><?= $bk->kodebar; ?> &nbsp; <?= $bk->nabar; ?> </b></td>
                        </tr>
                        <?php
                        if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') {
                            $query1 = "SELECT DISTINCT a.blok, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.kodebar = '$bk->kodebar' AND a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' AND a.afd ='$b->afd'";
                        } else {
                            $query1 = "SELECT DISTINCT a.blok, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.kodebar = '$bk->kodebar' AND a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian'";
                        }
                        $bpr = $this->db_logistik_pt->query($query1)->result();
                        $no = 1;
                        $total = 0;
                        $total_h = 0;
                        foreach ($bpr as $bp) {
                            if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') {
                                $query2 = "SELECT a.blok, a.satuan, a.kodesub, a.ket, a.ketsub, a.kodebar, SUM(IF(a.blok = '$bp->blok', a.qty2, 0)) AS t_qty, b.bag, a.nilai_item FROM keluarbrgitem a, stockkeluar b WHERE a.kodebar = '$bk->kodebar' AND a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' AND a.afd ='$b->afd'";
                            } else {
                                $query2 = "SELECT a.blok, a.satuan, a.kodesub, a.ket, a.ketsub, a.kodebar, SUM(IF(a.blok = '$bp->blok', a.qty2, 0)) AS t_qty, b.bag, a.nilai_item FROM keluarbrgitem a, stockkeluar b WHERE a.kodebar = '$bk->kodebar' AND a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian'";
                            }
                            $bsh = $this->db_logistik_pt->query($query2)->result();
                            foreach ($bsh as $bh) {
                                $total += $bh->t_qty;

                                $total_h += ($bh->t_qty * $bh->nilai_item);
                        ?>
                                <tr>
                                    <td style="text-align: center;"><?= $bp->blok; ?></td>
                                    <td style="text-align: right;"><?= number_format($bh->t_qty, 2); ?></td>
                                    <td style="text-align: center;"><?= $bh->satuan; ?></td>
                                    <td style="text-align: right;"><?= number_format(($bh->t_qty * $bh->nilai_item), 2); ?></td>
                                    <td style="text-align: center;"><?= $bh->kodesub ?></td>
                                    <td style="text-align: left;"><?= $bh->ketsub; ?></td>
                                    <td style="text-align: left;"><?= $bh->ket; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        <tr>
                            <td><b>Total</b></td>
                            <td style="text-align: right;"><b><?= number_format($total, 2); ?></b></td>
                            <td></td>
                            <td style="text-align: right;"><b><?= number_format($total_h, 2); ?></b></td>
                            <td colspan="3"></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
    <?php }
    } ?>
</body>

</html>