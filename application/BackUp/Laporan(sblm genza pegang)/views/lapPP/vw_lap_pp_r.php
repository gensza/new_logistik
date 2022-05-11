<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Pembayaran (PP)</title>
    <style>
        body {
            font-family: Verdana;
            font-size: 8px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 20px;
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
    </style>
</head>

<body>
    <h3 style="margin-bottom: 0;">PT. MULIA SAWIT AGRO LESTARI (<?= $lokasi; ?>)</h3>
    <h6 style="z-index: 0; margin-top: -10px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>
    <div style="text-align: center;">
        <h1>PERMOHONAN PEMBAYARAN (PP)</h1>
        <table border="0" class="center">
            <tr>
                <td>PERIODE</td>
                <td>:</td>
                <td><?= $periode; ?></td>
            </tr>
            <tr>
                <td>TANGGAL CETAK</td>
                <td>:</td>
                <td><?= date("d/m/Y"); ?></td>
            </tr>
        </table>
        <p align="right" style="margin-top: 0px;margin-bottom: 0px;"><small>By MIPS</small></p>
        <hr>
        <hr>
        <table border="0" class="center" width="100%">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nomor PP</td>
                    <td>Tanggal PP</td>
                    <td>Tanggal PO</td>
                    <td>Nomor PO</td>
                    <td>Nomor Voucher</td>
                    <td>Tanggal Voucher</td>
                    <td>Nama Supplier</td>
                    <td>Jumlah Pembayaran</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total = 0;
                foreach ($pp as $list_pp) {
                    $total += $list_pp->jumlah;
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $list_pp->nopp; ?></td>
                        <td><?= date_format((date_create($list_pp->tglpp)), "d/m/Y"); ?></td>
                        <td><?= date_format((date_create($list_pp->tglpo)), "d/m/Y"); ?></td>
                        <td><?= $list_pp->ref_po; ?></td>
                        <td><?= $list_pp->no_voutxt; ?></td>
                        <td><?= date_format((date_create($list_pp->tgl_vou)), "d/m/Y"); ?></td>
                        <td><?= $list_pp->nama_supply; ?></td>
                        <td>
                            <table border="0" width="100%">
                                <tr>
                                    <td>Rp</td>
                                    <td style="text-align: right;"><?= number_format(($list_pp->jumlah), 2) ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
        <hr>
    </div>
    <div style="text-align: right;">
        <h3>TOTAL : <?= number_format($total, 2); ?></h3>
    </div>
</body>
</body>

</html>