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
        <h4>TAHUN : <?= date('Y'); ?></h4>
    </div>
    <div style="text-align: right;">
        <small>Date : <?= date('d/m/Y'); ?></small><br>
        <small>Time : <?= date('h:i:s'); ?></small>
    </div>
    <br>
    <hr>
    <hr>
    <table roles="rows">
        <thead>
            <tr>
                <th style="font-weight: bold;">No</th>
                <th style="font-weight: bold;">Nomor PO</th>
                <th style="font-weight: bold;">Tanggal PO</th>
                <th style="font-weight: bold;">Nomor Ref. SPP</th>
                <th style="font-weight: bold;">Tanggal Ref. SPP</th>
                <th style="font-weight: bold;">Keterangan</th>
                <th style="font-weight: bold;">Kode - Nama Supplier</th>
                <th style="font-weight: bold;">Kode - Nama Pemesan</th>
                <th style="font-weight: bold;">Lokasi Pengiriman</th>
                <th style="font-weight: bold;" colspan="2">Pembayaran</th>
            </tr>
            <tr>
                <td colspan="20">

                    <hr>
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            $nomer = 1;
            if (isset($po)) {
                foreach ($po as $d) { ?>
                    <tr>
                        <td><?= $nomer++ ?></td>
                        <td> <?= $d->noreftxt ?></td>
                        <td><?= date_format(date_create($d->tglpo), "d/m/Y"); ?></td>
                        <td><?= $d->no_refppo ?></td>
                        <td><?= date_format(date_create($d->tgl_refppo), "d/m/Y"); ?></td>
                        <td><?= $d->ket ?></td>
                        <td><?= $d->kode_supply ?> - <?= $d->nama_supply ?></td>
                        <td><?= $d->user ?></td>
                        <td><?= $d->lokasi ?></td>
                        <td><?= $d->bayar ?></td>
                        <!-- <td>30</td> -->
                    </tr>

                    <tr>
                        <th colspan="2"></th>
                        <th style="font-weight: bold;">Kode Barang</th>
                        <th style="font-weight: bold;">Nama Barang</th>
                        <th style="font-weight: bold;">Satuan</th>
                        <th style="font-weight: bold;">Kuantitas</th>
                        <th style="font-weight: bold;">Tgl LPB</th>
                        <th style="font-weight: bold;">No LPB</th>
                        <th style="font-weight: bold;">Qty Diterima</th>
                        <th style="font-weight: bold;">Selisih</th>
                        <th></th>
                    </tr>
                    <?php
                    $noref = $d->noreftxt;
                    $query = "SELECT a.kodebar, a.nabar, a.tgl, a.satuan,a.qtypo, a.qty, a.ttgtxt FROM masukitem a WHERE a.refpo ='$noref' order by a.id DESC";
                    // $query = "SELECT a.kodebar, a.nabar, a.tgl, a.satuan, a.qty, a.ttgtxt, b.qty as qtypo FROM masukitem a, item_po b WHERE a.refpo=b.noref AND a.refpo ='$noref' order by a.id DESC";
                    $lpb = $this->db_logistik_pt->query($query)->result();
                    $no = 1;
                    if (isset($lpb)) {
                        foreach ($lpb as $dt) {
                    ?>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="9">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td><?= $dt->kodebar ?></td>
                                <td><?= $dt->nabar ?></td>
                                <td><?= $dt->satuan ?></td>
                                <td><?= $dt->qtypo ?></td>
                                <td><?= date_format(date_create($dt->tgl), "d/m/Y"); ?></td>
                                <td><?= $dt->ttgtxt ?></td>
                                <td><?= $dt->qty ?></td>
                                <td>0.00</td>
                                <td></td>
                            </tr>
                    <?php }
                    }
                    ?>

            <?php }
            } ?>
        </tbody>
    </table>
</body>

</html>