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
    <h3 style="font-size:14px;font-weight:bold;margin-bottom: 0%;">PT. MULIA SAWIT AGRO LESTARI (<?= $lokasi; ?>)</h3>
    <?php if ($alamat != '01') {
        echo '';
    } else {
        echo '<h6 style="z-index: 0; margin-top: -1%;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    }

    ?>
    <div style="text-align: center;">

        <table border="0" class="center" style="margin-top: -1%;">
            <tr>
                <td style="text-align: center;" colspan="3">
                    <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%;">PERMOHONAN PEMBAYARAN (PP)</h3>
                </td>
            </tr>
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
        <p align="right" style="margin-top: -2%;margin-bottom: 0px;"><small>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></small></p>
        <hr>
        <hr>
        <table border="0" class="center" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor PP</th>
                    <th>Tanggal PP</th>
                    <th>Tanggal PO</th>
                    <th>Nomor PO</th>
                    <th>Nomor Voucher</th>
                    <th>Tanggal Voucher</th>
                    <th>Nama Supplier</th>
                    <th>Jumlah Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pp)) {
                    $total = 0;
                ?>
                    <tr>
                        <td>1</td>
                        <td colspan="7" style="text-align: center;"><b>Tidak ada data</b></td>

                        <td>
                            <table border="0" width="100%">
                                <tr>
                                    <td>Rp</td>
                                    <td style="text-align: right;">0.00</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php } else {
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
                <?php }
                } ?>

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