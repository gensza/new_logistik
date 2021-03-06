<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPB</title>
    <style>
        body {
            font-family: Verdana;
            font-size: 11px;
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
            padding-left: 5px;
            padding-right: 5px;
        }

        .singleborder {
            border-collapse: collapse;
            border: 1px solid black;

        }
    </style>
</head>

<body>
    <?php
    if (empty($item_lpb[0]->devisi)) {
        echo '<h2>Data tidak ditemukan pada Divisi tersebut!</h2>';
    } else {
        echo '<h3 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $item_lpb[0]->devisi . '</h3>';
    }

    if ($alamat != '01') {
        echo '';
    } else {
        echo '<h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    }
    ?>

    <div style="text-align: center;">
        <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; "><u> Register Laporan Penerimaan Barang (LPB)</u></h3>
        <table border="0" class="center">
            <tr>
                <td>PERIODE</td>
                <td>:</td>
                <td><?= $periode; ?></td>
            </tr>
        </table>
        <p align="right" style="margin-top: -2%;margin-bottom: 2px;"><small>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></small></p>
        <table class="singleborder" width="100%" border="1">
            <thead>
                <tr>
                    <td style="width: 7%; text-align:center; font-weight:bold;">No. LPB</td>
                    <td style="width: 7%; text-align:center; font-weight:bold;">Tanggal</td>
                    <td style="width: 7%; text-align:center; font-weight:bold;">No. PO</td>
                    <td style="width: 14%; text-align:center; font-weight:bold;">Supplier</td>
                    <td style="width: 14%; text-align:center; font-weight:bold;">Nama Barang</td>
                    <td style="width: 4%; text-align:center; font-weight:bold;">Sat</td>
                    <td style="width: 10%; text-align:center; font-weight:bold;">Qty</td>
                    <td style="width: 10%; text-align:center; font-weight:bold;">Kode Barang</td>
                    <td style="width: 15%; text-align:center; font-weight:bold;">Keterangan</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($item_lpb as $list_item_lpb) {
                    $total += $list_item_lpb->qty;
                ?>
                    <tr>
                        <td style="text-align:center;"><?= $list_item_lpb->ttg; ?></td>
                        <td style="text-align:center;"><?= date_format(date_create($list_item_lpb->tglinput), "d/m/Y"); ?></td>
                        <td style="text-align:center;"><?= $list_item_lpb->nopo; ?></td>
                        <td style="text-align:left;"><?= $list_item_lpb->nama_supply; ?></td>
                        <td style="text-align:left;"><?= $list_item_lpb->nabar; ?></td>
                        <td style="text-align:center;"><?= $list_item_lpb->satuan; ?></td>
                        <td style="text-align:right;"><?= number_format($list_item_lpb->qty, 2); ?></td>
                        <td style="text-align:center;"><?= $list_item_lpb->kodebar; ?></td>
                        <td style="text-align:left;"><?= $list_item_lpb->ket; ?></td>
                    </tr>
                <?php } ?>

                <tr>
                    <td style="text-align:center;" colspan="9">Total : <?= number_format($total, 2); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="text-align: right;">
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
        <small><?= $posisi; ?>, <?= date("d-m-Y"); ?></small>
    </div>
    <br>
    <table width="100%">
        <tr>
            <td style="text-align: center;">Disetujui Oleh,<br><br><br><br><br><br>________________________</td>
            <td style="text-align: center;">Diketahui,<br><br><br><br><br><br>________________________</td>
            <td style="text-align: center;">Diperiksa,<br><br><br><br><br><br>________________________</td>
            <td style="text-align: center;">Dicatat,<br><br><br><br><br><br>________________________</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

</body>

</html>