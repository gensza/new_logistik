<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Verdana;
            font-size: 8px;
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
            margin-top: 0px #ccc;
            margin-bottom: 3px;
        }

        td {
            vertical-align: text-top;
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
                    <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LAPORAN SPP vs PO</h1>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>PT MULIA SAWIT AGRO LESTARI (<?= $lokasi; ?>)</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PERIODE : <?= $periode; ?></td>
                <td>By MIPS</td>
            </tr>
        </table>
        <hr>
        <hr>
        <table width="100%" border="0">
            <thead>
                <tr style="background-color: #d6d6c2;">
                    <th>Nomor SPP</th>
                    <th>No. Ref SPP</th>
                    <th colspan="2">Tgl SPP</th>
                    <th colspan="3">Alokasi</th>
                    <th colspan="9">User Input</th>
                </tr>

                <tr>
                    <th>Kode Barang&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Nama Barang&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Satuan&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Qty Diminta&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Durasi SPP&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Tgl PO&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>No PO&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Supplier&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Qty PO&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Saldo SPP&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Harga Satuan PO&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Total Harga PO&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <th>Keterangan&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr>


            </thead>
            <tbody>
                <?php
                foreach ($ppo as $list_ppo) {
                ?>
                    <!-- untuk spp -->
                    <tr style="background-color: #d6d6c2;">
                        <td><?= $list_ppo->noppotxt; ?></td>
                        <td><?= $list_ppo->noreftxt; ?></td>
                        <td colspan="2"><?= date_format(date_create($list_ppo->tglppo), "d/m/Y"); ?></td>
                        <td colspan="3"><?= $list_ppo->LOKASI; ?></td>
                        <td colspan="9"><?= $list_ppo->user; ?></td>
                    </tr>
                    <!-- slesai spp -->
                    <tr>
                        <td colspan="13">
                            <hr>
                        </td>
                    </tr>
                    <table width="100%" border="0">
                        <tr>
                            <td>
                                <table width="100%" border="0">

                                    <tbody>

                                        <?php
                                        $noppotxt = $list_ppo->noppotxt;
                                        $query = "SELECT noppotxt, noreftxt,kodebar, nabar, sat, qty FROM item_ppo WHERE noppotxt ='$noppotxt'";
                                        $item_ppo = $this->db_logistik_pt->query($query)->result();

                                        foreach ($item_ppo as $dt) {
                                        ?>
                                            <tr>
                                                <td><?= $dt->kodebar ?></td>
                                                <td><?= $dt->nabar ?></td>
                                                <td><?= $dt->sat ?></td>
                                                <td><?= $dt->qty ?></td>
                                                <td>23 Hari</td>
                                            </tr>

                                        <?php }

                                        ?>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table width="100%" border="0">

                                    <tbody>
                                        <?php
                                        $noref = $list_ppo->noreftxt;
                                        $query = "SELECT * FROM item_po WHERE batal = '0' AND refppo ='$noref'";
                                        $po = $this->db_logistik_pt->query($query)->result();

                                        if (empty($po)) {
                                        ?>
                                            <tr>
                                                <td colspan="8" style="color: red;">Spp belum di PO kan</td>


                                            </tr>
                                            <?php } else {
                                            if (isset($po)) {
                                                foreach ($po as $d) { ?>
                                                    <tr>
                                                        <td><?= date_format(date_create($d->tglpo), "d/m/Y"); ?></td>
                                                        <td><?= $d->nopo; ?></td>
                                                        <td><?= $d->nopo; ?></td>
                                                        <td><?= $d->qty; ?></td>
                                                        <td><?= $d->nopo; ?></td>
                                                        <td>Rp. <?= number_format($d->harga, 2, ',', '.'); ?> </td>
                                                        <td>Rp. <?= number_format($d->jumharga, 2, ',', '.'); ?> </td>
                                                        <td><?= $d->ket; ?></td>

                                                    </tr>


                                        <?php }
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <!-- untuk PO -->

                    <!-- selesai PO -->

                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>