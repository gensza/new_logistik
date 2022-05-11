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
    <h3 style="margin-bottom: 0;">PT. MULIA SAWIT AGRO LESTARI</h3>
    <h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>
    <div style="text-align: center;">
        <h1>MONITORING PO VS LPB</h1>
        <h3>TAHUN : <?= date('Y') ?></h3>
    </div>
    <table border="0" width="100%">
        <tr>
            <td colspan="2" style="text-align: right;">Date : <?= date('d/m/Y'); ?></td>
        </tr>
        <tr>
            <td> <i> SORT BY SUPPLIER</i></td>
            <td style="text-align: right;"> <i> By System MIPS</i> &nbsp;&nbsp;&nbsp; Time : <?= date('h:i:s'); ?></td>
        </tr>
    </table>
    <hr>
    <table rules="rows" width="100%">
        <tbody>
            <?php if (empty($sup)) { ?>
                <tr>
                    <td colspan="9">
                        <table class="singleborder" width="100%">
                            <thead>

                                <tr style="background-color: #d6d6c2;">
                                    <th style="width: 30%;">Tidak ada data</th>
                                    <th colspan="4"></th>
                                    <th colspan="2"></th>
                                </tr>
                            </thead>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>QTY</th>
                    <th>Tgl LPB</th>
                    <th>No. LPB</th>
                    <th>QTY Diterima</th>
                    <th>Selisih</th>
                </tr>
                <tr>
                    <td colspan="9">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td colspan="6">Tidak ada data</i></td>
                </tr>
                <tr>
                    <td colspan="9">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                    <td>Tidak ada data</td>
                </tr>

                <tr>
                    <td colspan="9">
                        <hr>
                    </td>
                </tr>
                <?php } else {

                if (isset($sup)) {
                    foreach ($sup as $data) {
                        $refpo = $data->refpo;
                        $po = $this->db_logistik_pt->query("SELECT tglpo, nopo, noreftxt, bayar, tempo_bayar FROM po WHERE noreftxt='$refpo' ORDER BY id DESC")->result();
                        foreach ($po as $d) {
                ?>
                            <tr>
                                <td colspan="9">
                                    <table class="singleborder" width="100%">
                                        <thead>

                                            <tr style="background-color: #d6d6c2;">
                                                <th style="width: 30%;"><?= $data->kode_supply ?> - <?= $data->nama_supply ?></th>
                                                <th colspan="4"></th>
                                                <th colspan="2"></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>QTY</th>
                                <th>Tgl LPB</th>
                                <th>No. LPB</th>
                                <th>QTY Diterima</th>
                                <th>Selisih</th>
                            </tr>
                            <tr>
                                <td colspan="9">
                                    <hr>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2"><?= $d->tglpo ?> &nbsp; <?= $d->nopo ?></td>
                                <td><?= $d->noreftxt ?></td>
                                <td colspan="6"><?= $d->bayar ?> <?php if ($d->tempo_bayar != 0) {
                                                                        echo $d->tempo_bayar . " Hari";
                                                                    } else {
                                                                    } ?></td>
                            </tr>

                            <tr>
                                <td colspan="9">
                                    <hr>
                                </td>
                            </tr>
                            <?php
                            $refpo = $d->noreftxt;
                            $reflpb = $data->noref;
                            $lpb = $this->db_logistik_pt->query("SELECT kodebar, nabar, satuan, qtypo, qty, tgl, noref FROM masukitem WHERE refpo='$refpo' AND noref='$reflpb' ORDER BY id DESC")->result();
                            $no = 1;
                            foreach ($lpb as $dt) {
                                $selisih = $dt->qtypo - $dt->qty;
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $dt->kodebar ?></td>
                                    <td><?= $dt->nabar ?></td>
                                    <td><?= $dt->satuan ?></td>
                                    <td><?= $dt->qtypo ?></td>
                                    <td style="text-align: center;"><?= date_format(date_create($dt->tgl), "d/m/Y"); ?></td>
                                    <td style="text-align: center;"><?= $dt->noref ?></td>
                                    <td style="text-align: center;"><?= $dt->qty ?></td>
                                    <td><?= $selisih . '.00'; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="9">
                                        <hr>
                                    </td>
                                </tr>
                            <?php } ?>

            <?php }
                    }
                }
            } ?>
        </tbody>
    </table>
</body>

</html>