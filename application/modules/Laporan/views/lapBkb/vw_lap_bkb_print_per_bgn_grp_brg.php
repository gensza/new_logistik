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

        .singleborder {
            border-collapse: collapse;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <?php
    if (empty($bt[0]->devisi)) {
        echo '<h2>Data tidak ditemukan pada Divisi tersebut!</h2>';
    } else {
        echo '<h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $bt[0]->devisi . '</h2>';
    }
    if ($alamat != '01') {
        echo '';
    } else {
        echo '<h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    }
    ?>
    <div style="text-align: center;">
        <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; "><u>REGISTER KELUAR BARANG (BKB)</u></h3>
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
                            <b>Bagian : -</b>
                        <?php } ?>
                    </td>
                    <td style="text-align: right;"><br><br><i>By System MIPS</i></td>
                </tr>
            </thead>
        </table>
        <br>
        <table width="100%" border="1" class="singleborder">
            <thead style="text-align: center;">
                <tr>
                    <td style="text-align: center; font-weight: bold; width:5%">No</td>
                    <td style="text-align: center; font-weight: bold; width:10%">Tgl</td>
                    <td style="text-align: center; font-weight: bold; width:10%">No. BKB</td>
                    <td style="text-align: center; font-weight: bold; width:5%">Sat</td>
                    <td style="text-align: center; font-weight: bold; width:5%">Qty</td>
                    <td style="text-align: center; font-weight: bold; width:15%">Kode Beban</td>
                    <td style="text-align: center; font-weight: bold; width:25%">Nama Beban</td>
                    <td style="text-align: center; font-weight: bold; width:25%">Keterangan</td>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data</td>
                </tr>

                <tr>
                    <td colspan="8" style="text-align: center;">Tidak ada data</td>
                </tr>

                <tr>
                    <td colspan="4" style="text-align: right; padding-right: 10px;">Total :</td>
                    <td colspan="4"> 0</td>
                </tr>

            </tbody>
        </table>
        <br>
        <?php } else {
        foreach ($bt as $b) { ?>
            <table border="0" width="100%">
                <thead>
                    <tr>
                        <td style="text-align: left;"><b> PERIODE : <?= $periode; ?> </b><br>
                            <b>Devisi : <?= $devisi; ?></b><br>
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
            <br>
            <table width="100%" border="1" class="singleborder">
                <thead style="text-align: center;">
                    <tr>
                        <td style="text-align: center; font-weight: bold; width:5%">No</td>
                        <td style="text-align: center; font-weight: bold; width:10%">Tgl</td>
                        <td style="text-align: center; font-weight: bold; width:10%">No. BKB</td>
                        <td style="text-align: center; font-weight: bold; width:5%">Sat</td>
                        <td style="text-align: center; font-weight: bold; width:5%">Qty</td>
                        <td style="text-align: center; font-weight: bold; width:15%">Kode Beban</td>
                        <td style="text-align: center; font-weight: bold; width:25%">Nama Beban</td>
                        <td style="text-align: center; font-weight: bold; width:25%">Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') {
                        $query = "SELECT DISTINCT a.kodebar, a.nabar, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' AND a.afd ='$b->afd' ORDER BY a.nabar ASC";
                    } else {
                        $query = "SELECT DISTINCT a.kodebar, a.nabar, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = 'TEKNIK' ORDER BY a.nabar ASC";
                    }
                    $no = 1;
                    $btn = $this->db_logistik_pt->query($query)->result();
                    if (empty($btn)) { ?>
                        <tr>
                            <td colspan="2">-</td>
                            <td colspan="6">-</td>
                        </tr>

                        <tr>
                            <td style="text-align: center;" colspan="8">Tidak ada data</td>
                        </tr>

                        <tr>
                            <td colspan="4" style="text-align: right; padding-right: 10px;">Total :</td>
                            <td colspan="4"> 0</td>
                        </tr>
                        <?php } else {
                        foreach ($btn as $bn) { ?>
                            <tr>
                                <td colspan="2"><?= $bn->kodebar; ?></td>
                                <td colspan="6"><?= $bn->nabar; ?></td>
                            </tr>
                            <?php
                            if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') {
                                $query = "SELECT a.*, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.kodebar = '$bn->kodebar' AND a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' AND a.afd ='$b->afd'";
                            } else {
                                $query = "SELECT a.*, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.kodebar = '$bn->kodebar' AND a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian'";
                            }
                            $bpr = $this->db_logistik_pt->query($query)->result();
                            $total = 0;
                            foreach ($bpr as $bp) {
                                $total += $bp->qty;
                            ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no++; ?></td>
                                    <td style="text-align: center;"><?= date_format(date_create($bp->tgl), 'd/m/Y'); ?></td>
                                    <td style="text-align: center;"><?= $bp->skb; ?></td>
                                    <td style="text-align: center;"><?= $bp->satuan; ?></td>
                                    <td style="text-align: right;"><?= number_format($bp->qty2, 2); ?></td>
                                    <td style="text-align: center;"><?= $bp->kodesub; ?></td>
                                    <td style="text-align: left;"><?= $bp->ketsub; ?></td>
                                    <td style="text-align: left;"><?= $bp->ket; ?></td>
                                </tr>
                            <?php }  ?>
                            <tr>
                                <td colspan="4" style="text-align: right; padding-right: 10px;">Total :</td>
                                <td colspan="4"> <?= number_format($total, 2); ?></td>
                            </tr>
                    <?php }
                    }  ?>
                </tbody>
            </table>
            <br>
    <?php }
    }
    ?>
    <i>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>
    <div style="text-align: right; ">
        <?php
        switch ($lokasi) {
            case '01':
                $posisi = 'HO';
                break;
            case '02':
                $posisi = 'RO';
                break;
            case '03':
                $posisi = 'PKS';
                break;
            default:
                $posisi = 'Sriwijaya Estate';
                break;
        }
        ?>
        <small><?= $posisi; ?>, <?= date("d M Y"); ?></small>
    </div>
    <br><br>
    <table border="0" width="100%">
        <thead>
            <?php if ($posisi !== 'Sriwijaya Estate') { ?>
                <tr>
                    <td style="text-align: center;">Disetujui Oleh, <br><br><br><br><br>(___________________) <br><br></td>
                    <td style="text-align: center;">Diperiksa, <br><br><br><br><br>(___________________) <br><br></td>
                    <td style="text-align: center;">Dicatat, <br><br><br><br><br>(___________________) <br> <br></td>
                </tr>
            <?php } else { ?>
                <tr>
                    <td style="text-align: center;">Disetujui Oleh, <br><br><br><br><br>(___________________) <br><br>G.Manager</td>
                    <td style="text-align: center;">Diperiksa, <br><br><br><br><br>(___________________) <br><br>KTU</td>
                    <td style="text-align: center;">Dicatat, <br><br><br><br><br>(___________________) <br> <br>Kasie Gudang</td>
                </tr>
            <?php } ?>
        </thead>
    </table>
</body>

</html>