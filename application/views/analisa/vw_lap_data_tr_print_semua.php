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
    <h2 style="margin-bottom: 0;">PT. MULIA SAWIT AGRO LESTARI</h2>
    <h5 style="margin-top: 5px;"> JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, Kebayoran Baru, Jakarta Selatan, DKI Jakarta Raya - 12140</h5>
    <div style="text-align: center;">
        <h3>LAPORAN HISTORY TRANSAKSI</h3>
        <b>PERIODE : 26/06/2020 - 25/07/2020</b>
    </div>
    <br>
    <div style="text-align: right;"><small>By System MIPS</small></div>
    <br>
    <table width="100%" class="singleborder" border="1">
        <thead style="text-align: center;">
            <tr>
                <td colspan="4">SPP</td>
                <td colspan="2">PO</td>
                <td colspan="2">LPB</td>
                <td colspan="3">Durasi (hari)</td>
            </tr>
            <tr>
                <td>Tgl</td>
                <td>Item Barang</td>
                <td>No SPP</td>
                <td>Approval HO</td>
                <td>Tgl PO</td>
                <td>No PO</td>
                <td>Tgl LPB</td>
                <td>No LPB</td>
                <td>SPP-LPB</td>
                <td>SPP-PO</td>
                <td>PO-LPB</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (isset($durasi)) {
                foreach ($durasi as $d) {
            ?>
                    <tr>
                        <td><?= date_format(date_create($d->tglppo), "d/m/Y"); ?></td>
                        <td><a href="">Barang</a></td>
                        <td><?= $d->noreftxt ?></td>
                        <td></td>
                        <td><?= date_format(date_create($d->tglpo), "d/m/Y"); ?></td>
                        <td><?= $d->refpo ?></td>
                        <td><?= date_format(date_create($d->tgl), "d/m/Y"); ?></td>
                        <td><?= $d->noref ?></td>
                        <td><?= str_replace('-', '', $d->spp_lpb) ?></td>
                        <td><?= str_replace('-', '', $d->spp_po) ?></td>
                        <td><?= str_replace('-', '', $d->po_lpb) ?></td>
                    </tr>

            <?php }
            } ?>
            <tr style="background-color: grey;">
                <td colspan="8" style="text-align: center; font-weight: bold;">Summary Rata-Rata</td>
                <td style="font-weight: bold;">21</td>
                <td style="font-weight: bold;">16</td>
                <td style="font-weight: bold;">5</td>
            </tr>
        </tbody>

    </table>
</body>

</html>