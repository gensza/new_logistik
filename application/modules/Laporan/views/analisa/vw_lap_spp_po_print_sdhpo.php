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
                    <h1>LAPORAN SPP vs PO (Realisasi)</h1>
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
    </div>
    <table width="100%">
        <thead>
            <tr style="background-color: #d6d6c2;">
                <td>No</td>
                <td>Nomor SPP</td>
                <td>No. Ref SPP</td>
                <td colspan="2">Tgl SPP</td>
                <td colspan="3">Alokasi</td>
                <td colspan="10">User Input</td>
            </tr>
            <tr>
                <td colspan="18">
                    <hr>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
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
                <td>Keterangan</td>
            </tr>
            <tr>
                <td colspan="18">
                    <hr>
                </td>
            </tr>
            <?php
            $nomer = 1;
            if (isset($ppo)) {
                foreach ($ppo as $d) { ?>
                    <tr style="background-color: #d6d6c2;">
                        <td><?= $nomer++ ?></td>
                        <td><?= $d->noppo ?></td>
                        <td><?= $d->noreftxt ?></td>
                        <td colspan="2"><?= date_format(date_create($d->tglppo), "d/m/Y"); ?></td>
                        <td colspan="3"><?= $d->namadept ?></td>
                        <td colspan="10"><?= $d->user ?></td>
                    </tr>
                    <?php
                    $noref = $d->noppo;
                    $query = "SELECT * FROM item_po WHERE noppo ='$noref' ";
                    $po = $this->db_logistik_pt->query($query)->result();
                    $no = 1;
                    if (isset($po)) {
                        foreach ($po as $dt) {
                            $t1 =  date_format(date_create($d->tglppo), "Y/m/d");
                            $t2 =  date_format(date_create($dt->tglpo), "Y/m/d");
                            $tgl1 = new DateTime($t1);
                            $tgl2 = new DateTime($t2);
                            $durasi = $tgl2->diff($tgl1)->days;
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $dt->kodebar ?></td>
                                <td><?= $dt->nabar ?></td>
                                <td><?= $dt->sat ?></td>
                                <td><?= $dt->qty ?></td>
                                <td><?= date_format(date_create($dt->tglpo), "d/m/Y"); ?></td>
                                <td>&nbsp;&nbsp;&nbsp;<?= $durasi; ?> Hari</td>
                                <td><?= $dt->nopo ?></td>
                                <?php
                                $nopo = $dt->nopo;
                                $query = "SELECT nopo, nama_supply FROM po WHERE nopo ='$nopo'";
                                $po = $this->db_logistik_pt->query($query)->result();

                                foreach ($po as $data) {
                                ?>
                                    <td><?= $data->nama_supply ?></td>
                                <?php } ?>
                                <td><?= $dt->qty ?></td>
                                <td>Rp. <?= number_format($dt->harga, 2, ',', '.'); ?></td>
                                <td><?= $dt->ket ?></td>
                            </tr>
                    <?php }
                    }
                    ?>
            <?php }
            } ?>
        </tbody>
    </table>
    <br>
    <i>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>
    <hr>
    <br>
    <br>
    <table border="1" width="20%">
        <tr>
            <td>Summary</td>
        </tr>
        <tr>
            <td>
                Total SPP : <?= $jumlahspp->jmlh; ?> <br>
                Total Item Barang : <?= $jumlahItem->jmlh; ?><br>
                Total QTY SPP Barang : <?= $jmlQTYSpp->qty; ?> <br>
                Total QTY PO Barang : <?= $jmlQTYPO->qty; ?>
            </td>
        </tr>
    </table>
</body>

</html>