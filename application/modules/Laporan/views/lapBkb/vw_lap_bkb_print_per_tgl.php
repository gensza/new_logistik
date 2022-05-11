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
    <?php
    if (empty($p_tgl[0]->devisi)) {
        echo '<h2>Data tidak ditemukan pada Divisi tersebut!</h2>';
    } else {
        echo '<h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $p_tgl[0]->devisi . '</h2>';
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
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: left;">
                    PERIODE : <?= $tgl1; ?>-<?= $tgl2; ?></td>
            </tr>
        </thead>
    </table>
    <?php if (empty($p_tgl)) { ?>
        <table border="0" width="100%">
            <thead>
                <tr>
                    <td style="text-align: left;"><b>Tgl BKB : -</b></td>
                    <td style="text-align: right;"><i>By System MIPS</i></td>
                </tr>
            </thead>
        </table>
        <table class="singleborder" width="100%" border="1">
            <thead style="text-align: center;">
                <tr>
                    <td rowspan="2" style="font-weight: bold; width: 5%;">No BKB</td>
                    <td rowspan="2" style="font-weight: bold; width: 10%;">Kode Barang</td>
                    <td rowspan="2" style="font-weight: bold; width: 17%;">Nama Barang</td>
                    <td rowspan="2" style="font-weight: bold; width: 3%;">Sat</td>
                    <td rowspan="2" style="font-weight: bold; width: 5%;">Qty</td>
                    <td style="font-weight: bold; width: 21%;" colspan="3">Alokasi</td>
                    <td rowspan="2" style="font-weight: bold; width: 10%;">Kode Beban</td>
                    <td rowspan="2" style="font-weight: bold; width: 16%;">Nama Beban</td>
                    <td rowspan="2" style="font-weight: bold; width: 13%;">Keterangan</td>
                </tr>
                <tr>
                    <td>AFD</td>
                    <td>Blok</td>
                    <td>Bagian/Devisi</td>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td style="text-align: center;" colspan="11">Tidak ada data</td>
                </tr>

            </tbody>
        </table>
        <?php } else {
        foreach ($p_tgl as $lp_tgl) { ?>
            <table border="0" width="100%">
                <thead>
                    <tr>
                        <td style="text-align: left;"><b>Tgl BKB : <?= date_format(date_create($lp_tgl->tgl), "d M Y") ?></b></td>
                        <td style="text-align: right;"><i>By System MIPS</i></td>
                    </tr>
                </thead>
            </table>
            <table class="singleborder" width="100%" border="1">
                <thead style="text-align: center;">
                    <tr>
                        <td rowspan="2" style="font-weight: bold; width: 5%;">No BKB</td>
                        <td rowspan="2" style="font-weight: bold; width: 10%;">Kode Barang</td>
                        <td rowspan="2" style="font-weight: bold; width: 17%;">Nama Barang</td>
                        <td rowspan="2" style="font-weight: bold; width: 3%;">Sat</td>
                        <td rowspan="2" style="font-weight: bold; width: 5%;">Qty</td>
                        <td style="font-weight: bold; width: 21%;" colspan="3">Alokasi</td>
                        <td rowspan="2" style="font-weight: bold; width: 10%;">Kode Beban</td>
                        <td rowspan="2" style="font-weight: bold; width: 16%;">Nama Beban</td>
                        <td rowspan="2" style="font-weight: bold; width: 13%;">Keterangan</td>
                    </tr>
                    <tr>
                        <td>AFD</td>
                        <td>Blok</td>
                        <td>Bagian/Devisi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $thisDate = date_format(date_create($lp_tgl->tgl), 'Y-m-d');
                    $tgltxt1 = str_replace('/', '-', $tgl1);
                    $tgltxt2 = str_replace('/', '-', $tgl2);
                    $tgltxt1 = date_format(date_create($tgltxt1), "Y-m-d");
                    $tgltxt2 = date_format(date_create($tgltxt2), "Y-m-d");
                    if ($bag == 'HRD.-.UMUM') $bag = 'UMUM.-.HRD';
                    $bag = str_replace('.', ' ', $bag);
                    $bag = str_replace('-', '&', $bag);

                    if ($bag == 'Semua') {
                        $query = "SELECT a.*, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND a.tgl BETWEEN '$tgltxt1' AND '$tgltxt2' AND a.kode_dev ='$lokasi' AND a.batal='0' AND a.tgl LIKE '%$thisDate%'";
                    } else {
                        $query = "SELECT a.*, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND a.tgl BETWEEN '$tgltxt1' AND '$tgltxt2' AND a.kode_dev ='$lokasi' AND a.batal='0' AND b.bag = '$bag' AND a.tgl LIKE '%$thisDate%'";
                    }

                    $bkb_tgl = $this->db_logistik_pt->query($query)->result();
                    foreach ($bkb_tgl as $bt) { ?>
                        <tr>
                            <td><?= $bt->skb; ?></td>
                            <td><?= $bt->kodebar; ?></td>
                            <td><?= $bt->nabar; ?></td>
                            <td><?= $bt->satuan; ?></td>
                            <td style="text-align: right;"><?= number_format($bt->qty2, 2); ?></td>
                            <td style="text-align: center;"><?= $bt->afd; ?></td>
                            <td style="text-align: center;"><?= $bt->blok; ?></td>
                            <td style="text-align: center;"><?= $bt->bag; ?></td>
                            <td><?= $bt->kodebeban; ?></td>
                            <td><?= $bt->ketsub; ?></td>
                            <td><?= $bt->ket; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
    <?php }
    } ?>
    <br>
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