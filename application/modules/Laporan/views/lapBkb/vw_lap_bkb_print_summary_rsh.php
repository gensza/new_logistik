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
        <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; "><u> SUMMARY REGISTER KELUAR BARANG (BKB)</u></h3>
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
                    </td>
                    <td style="text-align: right;"><br><br><i>By System MIPS</i></td>
                </tr>
            </thead>
        </table>
        <table width="100%" border="1" class="singleborder">
            <thead style="text-align: center;">
                <tr>
                    <td style="font-weight: bold; width: 10%;">No</td>
                    <td style="font-weight: bold; width: 15%;">Kode Barang</td>
                    <td style="font-weight: bold; width: 30%;">Nama Barang</td>
                    <td style="font-weight: bold; width: 10%;">Sat</td>
                    <td style="font-weight: bold; width: 15%;">Qty</td>
                    <td style="font-weight: bold; width: 20%;">Total Nilai (Rp)</td>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td colspan="6"><b>- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -</b></td>
                </tr>

                <tr>
                    <td style="text-align: center;" colspan="6">Tidak ada data</td>
                </tr>

                <tr>
                    <td colspan="3" style="text-align: center;"> Sub Total </td>
                    <td></td>
                    <td style="text-align: right;">0</td>
                    <td style="text-align: right;">0</td>
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
            <table width="100%" border="1" class="singleborder">
                <thead style="text-align: center;">
                    <tr>
                        <td style="font-weight: bold; width: 10%;">No</td>
                        <td style="font-weight: bold; width: 15%;">Kode Barang</td>
                        <td style="font-weight: bold; width: 30%;">Nama Barang</td>
                        <td style="font-weight: bold; width: 10%;">Sat</td>
                        <td style="font-weight: bold; width: 15%;">Qty</td>
                        <td style="font-weight: bold; width: 20%;">Total Nilai (Rp)</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') {
                        $query = "SELECT DISTINCT `a`.`kodesub`, `a`.`ketsub`, `b`.`bag` FROM `keluarbrgitem` `a`, `stockkeluar` `b` WHERE `a`.`NO_REF` = `b`.`NO_REF` AND `a`.`kode_dev` = '$lokasi' AND `a`.`periode` BETWEEN '$p1' AND '$p2' AND `a`.`batal` = '0' AND `b`.`bag` = '$bagian' AND `a`.`afd` ='$b->afd' ORDER BY `a`.`kodesub` ASC";
                    } else {
                        $query = "SELECT DISTINCT `a`.`kodesub`, `a`.`ketsub`, `b`.`bag` FROM `keluarbrgitem` `a`, `stockkeluar` `b` WHERE `a`.`NO_REF` = `b`.`NO_REF` AND `a`.`kode_dev` = '$lokasi' AND `a`.`periode` BETWEEN '$p1' AND '$p2' AND `a`.`batal` = '0' AND `b`.`bag` = '$bagian' ORDER BY `a`.`kodesub` ASC";
                    }
                    $bpk = $this->db_logistik_pt->query($query)->result();
                    foreach ($bpk as $bk) { ?>
                        <tr>
                            <td colspan="6"><b><?= $bk->kodesub; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $bk->ketsub; ?></b></td>
                        </tr>
                        <?php
                        if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') {
                            $query1 = "SELECT DISTINCT a.kodebar,a.nabar, a.satuan, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.kodesub = '$bk->kodesub' AND a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' AND a.afd ='$b->afd'";
                        } else {
                            $query1 = "SELECT DISTINCT a.kodebar,a.nabar, a.satuan, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.kodesub = '$bk->kodesub' AND a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian'";
                        }
                        $bpr = $this->db_logistik_pt->query($query1)->result();
                        $no = 1;
                        $total = 0;
                        $total_h = 0;
                        foreach ($bpr as $bp) {
                            if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') {
                                $query2 = "SELECT a.kodebar,a.nabar, a.satuan, SUM(IF(a.kodebar = '$bp->kodebar', a.qty, 0)) AS t_qty, b.bag,a.nilai_item FROM keluarbrgitem a, stockkeluar b WHERE a.kodesub = '$bk->kodesub' AND a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' AND a.afd ='$b->afd' ORDER BY a.kodebar ASC";
                            } else {
                                $query2 = "SELECT a.kodebar,a.nabar, a.satuan, SUM(IF(a.kodebar = '$bp->kodebar', a.qty, 0)) AS t_qty, b.bag,a.nilai_item FROM keluarbrgitem a, stockkeluar b WHERE a.kodesub = '$bk->kodesub' AND a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' ORDER BY a.kodebar ASC";
                            }
                            $bsh = $this->db_logistik_pt->query($query2)->result();


                            foreach ($bsh as $bh) {
                                $total += $bh->t_qty;
                                $total_h += ($bh->t_qty * $bh->nilai_item); ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no++; ?></td>
                                    <td style="text-align: center;"><?= $bp->kodebar; ?></td>
                                    <td style="text-align: center;"><?= $bp->nabar; ?></td>
                                    <td style="text-align: center;"><?= $bp->satuan; ?></td>
                                    <td style="text-align: right;"><?= number_format($bh->t_qty, 2); ?></td>
                                    <td style="text-align: right;"><?= number_format($bh->t_qty * $bh->nilai_item, 2); ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        <tr>
                            <td colspan="3" style="text-align: center;"> Sub Total </td>
                            <td></td>
                            <td style="text-align: right;"><?= number_format($total, 2); ?></td>
                            <td style="text-align: right;"><?= number_format($total_h, 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    <?php }
    } ?>
</body>

</html>