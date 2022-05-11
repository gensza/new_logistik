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
            margin-top: 0px;
            margin-bottom: 3px;
        }

        td {
            vertical-align: text-top;
        }
    </style>
</head>

<body>
    <h3 style="margin-bottom: 0;">PT. MULIA SAWIT AGRO LESTARI ESTATE1</h3>
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
                <td>PT MULIA SAWIT AGRO LESTARI (ESTATE1)</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PERIODE : 01/07/2020 - 31/07/2020</td>
                <td>By MIPS</td>
            </tr>
        </table>
        <hr>
        <hr>
        <table border="0" width="100%">
            <thead>
                <tr style="background-color: #d6d6c2;">
                    <td>Nomor SPP</td>
                    <td>No. Ref SPP</td>
                    <td colspan="2">Tgl SPP</td>
                    <td colspan="3">Alokasi</td>
                    <td colspan="9">User Input</td>
                </tr>
                <tr>
                    <td colspan="13">
                        <hr>
                    </td>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>Kode Barang</td>
                    <td>Nama Barang</td>
                    <td>Satuan</td>
                    <td>Qty Diminta</td>
                    <td>Tgl PO</td>
                    <td>Durasi SPP</td>
                    <td>No PO</td>
                    <td>Supplier</td>
                    <td>Qty PO</td>
                    <td>Saldo SPP</td>
                    <td>Harga Satuan PO</td>
                    <td>Total Harga PO</td>
                    <td>Keterangan</td>
                </tr>
                <tr>
                    <td colspan="13">
                        <hr>
                    </td>
                </tr>
                <?php
                foreach ($ppo as $list_ppo) {
                ?>
                    <tr style="background-color: #d6d6c2;">
                        <td><?= $list_ppo->noppotxt; ?></td>
                        <td><?= $list_ppo->noreftxt; ?></td>
                        <td colspan="2"><?= date_format(date_create($list_ppo->tglppo), "d/m/Y"); ?></td>
                        <td colspan="3"><?= $list_ppo->LOKASI; ?></td>
                        <td colspan="9"><?= $list_ppo->user; ?></td>
                    </tr>
                    <tr>
                        <td colspan="13">
                            <hr>
                        </td>
                    </tr>
                    <?php
                    $noref = $list_ppo->noreftxt;
                    $query = "SELECT * FROM item_po WHERE batal = '0' AND refppo ='$noref'";
                    $po = $this->db_logistik_pt->query($query)->result();

                    if (empty($po)) {
                        $noppotxt = $list_ppo->noppotxt;
                        $query = "SELECT noppotxt, noreftxt,kodebar, nabar, sat, qty FROM item_ppo WHERE noppotxt ='$noppotxt'";
                        $item_ppo = $this->db_logistik_pt->query($query)->result();

                        foreach ($item_ppo as $dt) {
                    ?>
                            <tr>
                                <td><?= $dt->kodebar ?></td>
                                <td style="color: red;"><?= $dt->nabar ?></td>
                                <td><?= $dt->sat ?></td>
                                <td><?= $dt->qty ?></td>
                                <td></td>
                                <td>Hari</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td colspan="13">
                                    <hr>
                                </td>
                            </tr>
                            <?php }
                    } else {

                        if (isset($po)) {
                            foreach ($po as $d) { ?>
                                <tr>
                                    <td><?= $d->kodebar ?></td>
                                    <td><?= $d->nabar ?></td>
                                    <td><?= $d->sat ?></td>
                                    <td><?= $d->qty ?></td>
                                    <td>23 Hari</td>
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
                    } ?>




                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>