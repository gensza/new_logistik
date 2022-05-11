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
    <?php
    if (empty($tgl[0]->devisi)) {
        echo '<h2>Data tidak ditemukan pada Divisi tersebut!</h2>';
    } else {
        echo '<h3 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $tgl[0]->devisi . '</h3>';
    }
    if ($alamat != '01') {
        echo '';
    } else {
        echo '<h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    }
    ?>
    <div style="text-align: center;">
        <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; "><u>REGISTER MASUK BARANG (LPB)</u></h3>
    </div>
    <div style="text-align: center; padding-left: 3px; font-size: 12px;margin-top: -1%;">
        <h3 style="font-size:10px;font-weight:normal;margin-bottom: 0%;">PERIODE : <?= date_format(date_create($tanggal1), "d/m/Y") . " - " . date_format(date_create($tanggal2), "d/m/Y"); ?></h3>
    </div>
    <?php
    foreach ($tgl as $list_tgl) { ?>

        <table border="0" width="100%">
            <thead>
                <tr>
                    <td style="text-align: left;"><b> Tanggal LPB : <?= date_format(date_create($list_tgl->tgl), 'd M Y'); ?></b></td>
                    <td style="text-align: right;"><i>By System MIPS (<?= date("d-m-Y H:i:s"); ?>)</i></td>
                </tr>
            </thead>
        </table>
        <table class="singleborder" border="1" width="100%">
            <thead style="text-align: center; ">
                <tr>
                    <td style="width: 8%; font-weight: bold;">No. LPB</td>
                    <td style="width: 8%; font-weight: bold;">No. PO</td>
                    <td style="width: 15%; font-weight: bold;">Kode Barang</td>
                    <td style="width: 15%; font-weight: bold;">Nama Barang</td>
                    <td style="width: 5%; font-weight: bold;">SAT</td>
                    <td style="width: 10%; font-weight: bold;">QTY</td>
                    <td style="width: 20%; font-weight: bold;">Group</td>
                    <td style="font-weight: bold;">KETERANGAN</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                $tgl1 = "'" . $list_tgl->tgl . "'";
                $query = "SELECT * FROM masukitem WHERE tgl = $tgl1 AND kode_dev = '$lokasi1' AND batal = '0'";
                $per_tgl = $this->db_logistik_pt->query($query)->result();
                foreach ($per_tgl as $list_per_tgl) {
                    $query1 = "SELECT grp FROM kodebar WHERE kodebar = '" . $list_per_tgl->kodebar . "'";
                    $grp1 = $this->db_logistik->query($query1)->row();
                ?>
                    <tr>
                        <td style="text-align: center;"><?= $list_per_tgl->ttg; ?></td>
                        <td style="text-align: center;"><?= $list_per_tgl->nopo; ?></td>
                        <td style="text-align: center;"><?= $list_per_tgl->kodebar; ?></td>
                        <td style="text-align: center;"><?= $list_per_tgl->nabar; ?></td>
                        <td style="text-align: center;"><?= $list_per_tgl->satuan; ?></td>
                        <td style="text-align: center;"><?= $list_per_tgl->qty; ?></td>
                        <td style="text-align: center;">
                            <?php
                            if ($grp1 == NULL) {
                                echo "-";
                            } else {
                                echo $grp1->grp;
                            } ?>
                        </td>
                        <td><?= $list_per_tgl->ket; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
    <?php } ?>
    <?php
    switch ($lokasi1) {
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
    <table width="100%">
        <?php if ($posisi !== 'Sriwijaya Estate') { ?>
            <tr>
                <td style="text-align: center; width: 25%;">Disetujui Oleh,<br><br><br><br><br><br>________________________</td>
                <td style="text-align: center; width: 25%;">Diperiksa,<br><br><br><br><br><br>________________________</td>
                <td style="text-align: center; width: 25%;">Dicatat,<br><br><br><br><br><br>________________________</td>
                <td style="text-align: right; width: 25%;"><?= $posisi; ?>, <?= date('d M Y'); ?><br><br><br><br><br><br></td>
            </tr>
        <?php } else { ?>
            <tr>
                <td style="text-align: center; width: 25%;">Disetujui Oleh,<br><br><br><br><br><br>________________________ <br><br>G. Manager</td>
                <td style="text-align: center; width: 25%;">Diperiksa,<br><br><br><br><br><br>________________________ <br><br>KTU</td>
                <td style="text-align: center; width: 25%;">Dicatat,<br><br><br><br><br><br>________________________ <br><br>Ka. Gudang</td>
                <td style="text-align: right; width: 25%;"><?= $posisi; ?>, <?= date('d M Y'); ?><br><br><br><br><br><br></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>