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
        <h3>MONITORING PO VS LPB</h3>
        TAHUN : <?= date('Y'); ?>
    </div>
    <br>
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: left;"><small><i><br> Belum LPB / Kurang</i></small></td>
                <td style="text-align: right;"><small><i>Date : <?= date('d/m/Y'); ?> <br> By System MIPS &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Time : <?= date('H:i:s'); ?></i></small></td>
            </tr>
        </thead>
    </table>
    <hr>
    <hr>
    <table width="100%" rules="rows">
        <thead>
            <tr>
                <th>Nomor PO</th>
                <th>Tanggal PO</th>
                <th>Nama Supplier</th>
                <th>Nama Barang</th>
                <th>Merk / Jenis</th>
                <th>Pembayaran</th>
                <th>Qty PO</th>
                <th>Tgl LPB</th>
                <th>No LPB</th>
                <th>Qty LPB</th>
                <th>Selisih</th>
            </tr>
            <tr>
                <td colspan="11">
                    <hr>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($belum)) { ?>
                <tr>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                </tr>
                <tr>
                    <td colspan="11">
                        <hr>
                    </td>
                </tr>
                <?php } else {

                if (isset($belum)) {
                    foreach ($belum as $data) {
                        $status = $data->status_item_lpb;
                ?>
                        <tr>
                            <td><?= $data->noref ?></td>
                            <td><?= date_format(date_create($data->tglpo), "d/m/Y"); ?></td>
                            <td><?= $data->nama_supply ?></td>
                            <td><?= $data->kodebar ?> <?= $data->nabar ?></td>
                            <td><?= $data->merek ?></td>
                            <td><?= $data->bayar ?> <?php if ($data->tempo_bayar != 0) {
                                                        echo $data->tempo_bayar . " Hari";
                                                    } else {
                                                        echo "0 Hari";
                                                    } ?></td>
                            <!-- <?php if ($status != 1) {
                                        echo "<td style='color:red;'>" . $data->qty . "</td>";
                                    } else {
                                        echo "<td>" . $data->qty . "</td>";
                                    } ?> -->
                            <td><?= $data->qty ?></td>

                            <?php
                            $refpo = $data->noref;
                            $kodebar = $data->kodebar;
                            $lpb = $this->db_logistik_pt->query("SELECT qtypo, qty, tgl, ttg FROM masukitem WHERE refpo='$refpo' AND kodebar='$kodebar' ORDER BY id DESC")->result();
                            foreach ($lpb as $d) {
                                $hitung = $d->qtypo - $d->qty;

                            ?>
                                <td><?= date_format(date_create($d->tgl), "d/m/Y"); ?></td>
                                <td><?= $d->ttg ?></td>
                                <td style="text-align: center;"><?= $d->qty ?></td>
                                <td style="color: red;"><?= $hitung ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td colspan="11">
                                <hr>
                            </td>
                        </tr>
            <?php }
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>