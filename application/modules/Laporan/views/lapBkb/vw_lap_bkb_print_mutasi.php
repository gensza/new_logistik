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
    if (empty($bmut[0]->devisi)) {
        echo '<h2>Data tidak ditemukan pada Divisi tersebut!</h2>';
    } else {
        echo '<h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $bmut[0]->devisi . '</h2>';
    }

    if ($alamat != '01') {
        echo '';
    } else {
        echo '<h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    }
    ?>
    <div style="text-align: center;">
        <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; "><u>REGISTER KELUAR BARANG (BKB) MUTASI</u></h3>
    </div>
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: left;"><b> PERIODE : <?= $periode; ?></b></td>
                <td style="text-align: right;"><i>By System MIPS</i></td>
            </tr>
        </thead>
    </table>
    <table width="100%" border="1" class="singleborder">
        <thead style="text-align: center;">
            <tr>
                <td style="font-weight: bold; width: 5%; text-align: center;">No</td>
                <td style="font-weight: bold; width: 10%; text-align: center;">Tgl</td>
                <td style="font-weight: bold; width: 10%; text-align: center;">No. BKB</td>
                <td style="font-weight: bold; width: 15%; text-align: center;">Kode Barang</td>
                <td style="font-weight: bold; width: 20%; text-align: center;">Nama Barang</td>
                <td style="font-weight: bold; width: 5%; text-align: center;">Sat</td>
                <td style="font-weight: bold; width: 10%; text-align: center;">Qty</td>
                <td style="font-weight: bold; width: 10%; text-align: center;">Mutasi PT</td>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($bmut)) { ?>
                <tr>
                    <td style="text-align: center;" colspan="8">Tidak ada data</td>
                </tr>
                <?php } else {
                $no = 1;
                foreach ($bmut as $bm) { ?>
                    <tr>
                        <td style="text-align: center;"><?= $no++; ?></td>
                        <td style="text-align: center;"><?= date_format(date_create($bm->tgl), 'd/m/Y'); ?></td>
                        <td style="text-align: center;"><?= $bm->skb; ?></td>
                        <td style="text-align: center;"><?= $bm->kodebar; ?></td>
                        <td style="text-align: left;"><?= $bm->nabar; ?></td>
                        <td style="text-align: center;"><?= $bm->satuan; ?></td>
                        <td style="text-align: right;"><?= number_format($bm->qty, 2); ?></td>
                        <td style="text-align: center;"><?= $bm->pt_mutasi; ?></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
    <br>
    <div style="text-align: right; ">
        Sriwijaya Estate, 19 August 2020
    </div>
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: center;">Disetujui Oleh, <br><br><br><br><br>(___________________) <br><br>G.Manager</td>
                <td style="text-align: center;">Diperiksa, <br><br><br><br><br>(___________________) <br><br>KTU</td>
                <td style="text-align: center;">Dicatat, <br><br><br><br><br>(___________________) <br> <br>Kasie Gudang</td>
            </tr>
        </thead>
    </table>
</body>

</html>