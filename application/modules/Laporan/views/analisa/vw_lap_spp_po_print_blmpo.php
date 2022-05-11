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
        <table border="0" class="center" width="100%">
            <tr>
                <td></td>
                <td>
                    <h1>LAPORAN SPP vs PO (SPP Belum Realisasi)</h1>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">
                    <h3> PERIODE : <?= $periode; ?></h3>
                </td>
            </tr>
            <tr>
                <td>PT MULIA SAWIT AGRO LESTARI (<?= $lokasi; ?>)</td>
                <td></td>
                <td>By MIPS</td>
            </tr>

        </table>
        <hr>
        <hr>
        <table class="singleborder" width="100%" rules="rows">
            <tr>
                <th width="3%">No.</th>
                <th width="12%">Kode Barang</th>
                <th width="25%">Nama Barang</th>
                <th width="10%">Keterangan</th>
                <th width="5%">Satuan</th>
                <th width="5%">Qty SPP</th>
                <th width="15%">Qty PO</th>
                <th width="15%">Saldo SPP</th>
            </tr>
            <?php if (empty($ppo)) { ?>
                <tr style="background-color: #d6d6c2;">
                    <td style="text-align: center;" colspan="8">Tidak ada data</td>
                </tr>
                <br>

                <tr>
                    <td style="text-align: center;" colspan="8">Tidak ada data</td>
                </tr>
                <?php } else {
                $nomer = 1;
                if (isset($ppo)) {
                    foreach ($ppo as $d) {
                ?>
                        <tr style="background-color: #d6d6c2;">
                            <td><?= $nomer++ ?></td>
                            <td><?= date_format(date_create($d->tglppo), "d/m/Y"); ?></td>
                            <td colspan="2"><?= $d->noreftxt ?></td>
                            <td colspan="4"></td>
                        </tr>
                        <br>
                        <?php
                        $noref = $d->noppo;
                        $query = "SELECT * FROM item_ppo WHERE noppo ='$noref'";
                        $item_ppo = $this->db_logistik_pt->query($query)->result();
                        $no = 1;
                        if (isset($item_ppo)) {
                            foreach ($item_ppo as $dt) {

                        ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $dt->kodebar ?></td>
                                    <td><?= $dt->nabar ?></td>
                                    <td><?= $dt->ket ?></td>
                                    <td><?= $dt->sat ?></td>
                                    <td><?= $dt->qty ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        <?php }
                        } ?>
            <?php }
                }
            } ?>

            <tr>
                <td colspan="8">
                    <hr>
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td colspan="2">Total</td>
                <td colspan="3"><?= $jmlQTYSpp->qty; ?></td>
            </tr>

        </table>

    </div>
    <br>
    <table class="singleborder">
        <thead>
            <tr>
                <td>Summary</td>
            </tr>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total SPP = <?= $jumlah->jmlh ?> <br> Total Item Barang = <?= $jmlbrg->jmlh ?> <br> Total Qty Barang = <?= $jmlQTYSpp->qty; ?> </td>
            </tr>
        </tbody>
    </table>
    <br>
    <i>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>
</body>

</html>