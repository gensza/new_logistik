<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order (PO)</title>
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
    <h3 style="margin-bottom: 0;">PT. MULIA SAWIT AGRO LESTARI </h3>
    <h6 style="z-index: 0; margin-top: -10px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>
    <div style="text-align: center;">
        <h1>REGISTER PURCHASE ORDER (PO)</h1>
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
                    <td>Nomor PO</td>
                    <td>Tanggal PO</td>
                    <td>Nomor Ref SPP</td>
                    <td>Tanggal Ref SPP</td>
                    <td>Keterangan</td>
                    <td>Kode-Nama Supplier</td>
                    <td>Kode-Nama Pemesan</td>
                    <td>Pembayaran</td>
                </tr>
                <tr>
                    <td colspan="9">
                        <hr>
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($po as $list_po) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $list_po->noreftxt; ?></td>
                        <td><?= date_format((date_create($list_po->tglpo)), "d/m/Y"); ?></td>
                        <td><?= $list_po->no_refppo; ?></td>
                        <td><?= date_format((date_create($list_po->tgl_refppo)), "d/m/Y"); ?></td>
                        <td><?= $list_po->ket; ?></td>
                        <td><?= $list_po->kode_supply . "-" . $list_po->nama_supply; ?></td>
                        <td><?= $list_po->kode_pemesan . "-" . $list_po->pemesan; ?></td>
                        <td><?= $list_po->bayar . " - " . $list_po->tempo_bayar . " Hari"; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="7">
                            <table border="0" width="100%">
                                <thead>
                                    <tr>
                                        <td>Kode Barang</td>
                                        <td>Nama Barang</td>
                                        <td>Satuan</td>
                                        <td>Kuantitas</td>
                                        <td style="text-align: right;">Harga Satuan</td>
                                        <td style="text-align: right;">Total</td>
                                        <td style="text-align: right;">PPN 10%</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <hr>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = 0;
                                    $noref = "'" . $list_po->noreftxt . "'";
                                    $query = "SELECT * FROM item_po WHERE batal = '0' $lokasi  AND noref = $noref";
                                    $item_po = $this->db_logistik_pt->query($query)->result();
                                    foreach ($item_po as $list_item_po) {
                                        $total = $total + (($list_item_po->harga) * $list_item_po->qty);
                                    ?>
                                        <tr>
                                            <td><?= $list_item_po->kodebar; ?></td>
                                            <td><?= $list_item_po->nabar; ?></td>
                                            <td><?= $list_item_po->sat; ?></td>
                                            <td><?= $list_item_po->qty; ?></td>
                                            <td style="text-align: right;">Rp <?= number_format($list_item_po->harga, 2); ?></td>
                                            <td style="text-align: right;">Rp <?= number_format((($list_item_po->harga) * $list_item_po->qty), 2); ?></td>
                                            <td style="text-align: right;">Rp 0.00</td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td colspan="2">
                                            <hr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td>Total PO:</td>
                                        <td style="text-align: right;">Rp <?= number_format($total, 2) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <i>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>
    </div>
</body>

</html>