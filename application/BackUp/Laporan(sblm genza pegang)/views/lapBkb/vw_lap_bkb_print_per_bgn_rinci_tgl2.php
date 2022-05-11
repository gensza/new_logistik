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
        <h3><u>REGISTER KELUAR BARANG (BKB)</u></h3>
    </div>
    <br>
    <table border="0" width="100%">
        <thead>
            <tr>
                <!-- <td style="text-align: left;">
                        <b> PERIODE : <?= $periode; ?> </b><br>
                        <b>Devisi : <?= $dev; ?></b><br>
                        <b>AFD : <?= $b->afd; ?></b></td>
                    <td style="text-align: right;"><br><br><i>By System MIPS</i></td> -->
            </tr>
        </thead>
    </table>
    <br>
    <table width="100%" class="singleborder" border="1">
        <thead>
            <tr>
                <td style="font-weight: bold; text-align:center; width: 5%">Blok</td>
                <td style="font-weight: bold; text-align:center; width: 8%">Tgl</td>
                <td style="font-weight: bold; text-align:center; width: 5%">No BKB</td>
                <td style="font-weight: bold; text-align:center; width: 12%">Kode Barang</td>
                <td style="font-weight: bold; text-align:center; width: 15%">Nama Barang</td>
                <td style="font-weight: bold; text-align:center; width: 5%">Sat</td>
                <td style="font-weight: bold; text-align:center; width: 7%">Qty</td>
                <td style="font-weight: bold; text-align:center; width: 12%">Kode Beban</td>
                <td style="font-weight: bold; text-align:center; width: 15%">Nama Beban</td>
                <td style="font-weight: bold; text-align:center; width: 15%">Keterangan</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($list_afd as $bn) { ?>
                <tr>
                    <td style="text-align: center;"><?= $bn->blok; ?></td>
                    <td style="text-align: center;"><?= date_format(date_create($bn->tgl), 'd/m/Y'); ?></td>
                    <td style="text-align: center;"><?= $bn->skb; ?></td>
                    <td style="text-align: center;"><?= $bn->kodebar; ?></td>
                    <td><?= $bn->nabar; ?></td>
                    <td style="text-align: center;"><?= $bn->satuan; ?></td>
                    <td style="text-align: right;"><?= number_format($bn->qty, 2); ?></td>
                    <td style="text-align: center;"><?= $bn->kodesubtxt; ?></td>
                    <td><?= $bn->ketsub; ?></td>
                    <td><?= $bn->ket; ?></td>
                </tr>
            <?php }  ?>
        </tbody>
    </table>
    <br>
    <i>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>
</body>

</html>