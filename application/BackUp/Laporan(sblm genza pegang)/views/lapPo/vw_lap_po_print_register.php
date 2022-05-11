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

        .singleborder {
            border-collapse: collapse;
            border: 1px solid black;
        }

        #tabelPO tr td {
            border: 1px solid #4d4d4d;
        }
    </style>
</head>

<body>
    <?php
    if ($lokasi1 == '') {

        echo '<h3 style="margin-bottom: 0;"> PT. MULIA SAWIT AGRO LESTARI</h3><h6 style="z-index: 0; margin-top: -10px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    } else {
        if ($lokasi1 == 'SITE')
            echo '<h3 style="margin-bottom: 0;"> PT. MULIA SAWIT AGRO LESTARI (ESTATE)</h3><h6 style="z-index: 0; margin-top: -10px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
        else
            echo '<h3 style="margin-bottom: 0;"> PT. MULIA SAWIT AGRO LESTARI (' . $lokasi1 . ')</h3><h6 style="z-index: 0; margin-top: -10px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    }
    ?>
    <!-- <div style="margin-top: 10px; margin-bottom: 10;"></div> -->
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
                <td><?= date('d/m/Y'); ?></td>
            </tr>
        </table>
        <br>
        <!-- <p align="right" style="margin-top: 0px;margin-bottom: 0px;"><small>By System MIPS (<?= date("d-m-Y H:i:s"); ?>)</small></p> -->
        <!-- <hr>
        <hr> -->
        <table border="1" class="singleborder">
            <thead>
                <tr>
                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.6em;">No</th>
                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.6em;">Nomor PO</th>
                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.6em;">Tanggal PO</th>
                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.6em;">Nomor Ref SPP</th>
                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.6em;">Tanggal Ref SPP</th>
                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.6em;">Keterangan</th>
                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.6em;">Kode-Nama Supplier</th>
                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.6em;">Kode-Nama Pemesan</th>
                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.6em;">Pembayaran</th>
                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.6em;">PPN (%)</th>
                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.6em;">Lokasi Pengiriman</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($lokasi1 == "") {
                    $lokasi = "";
                } else {
                    $lokasi = "AND lokasi = '" . $lokasi1 . "'";
                }
                foreach ($po as $list_po) { ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $list_po->nopotxt; ?></td>
                        <td><?= date_format(date_create($list_po->tglpo), "Y/m/d"); ?></td>
                        <td><?= $list_po->no_refppo; ?></td>
                        <td><?= date_format(date_create($list_po->tgl_refppo), "Y/m/d"); ?></td>
                        <td><?= $list_po->ket; ?></td>
                        <td><?= $list_po->kode_supply; ?> - <?= $list_po->nama_supply ?></td>
                        <td><?= $list_po->kode_pemesan; ?> - <?= $list_po->pemesan ?></td>
                        <td><?= $list_po->bayar; ?> - <?= $list_po->tempo_bayar; ?> Hari</td>
                        <td><?= $list_po->ppn; ?></td>
                        <td><?= $list_po->lokasikirim; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="9">
                            <table border="1" id="tabelPO" class="singleborder" width="100%">
                                <thead>
                                    <tr>
                                        <td style="width:20%">Kode Barang</td>
                                        <td style="width:20%">Nama Barang</td>
                                        <td style="width:5%">Satuan</td>
                                        <td style="width:8%">Kuantitas</td>
                                        <td style="width:20%">Harga Satuan</td>
                                        <td style="width:20%">Total</td>
                                        <td style="width:7%">PPN 10%</td>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $noref = "'" . $list_po->noreftxt . "'";
                                    $query = "SELECT * FROM item_po WHERE batal = '0' $lokasi  AND noref = $noref";
                                    $item_po = $this->db_logistik_pt->query($query)->result();
                                    foreach ($item_po as $list_item_po) { ?>
                                        <tr>
                                            <td><?= $list_item_po->kodebartxt; ?></td>
                                            <td><?= $list_item_po->nabar; ?></td>
                                            <td><?= $list_item_po->sat; ?></td>
                                            <td><?= $list_item_po->qty; ?></td>
                                            <?php if ($this->session->userdata('status_lokasi') == "HO") { ?>
                                                <td><?= $list_item_po->harga; ?></td>
                                                <td><?= $list_item_po->qty * $list_item_po->harga; ?></td>
                                                <td><?= $list_po->ppn ?></td>
                                            <?php } else { ?>
                                                <td><?= $list_item_po->harga; ?></td>
                                                <td><?= $list_item_po->qty * $list_item_po->harga; ?></td>
                                                <td><?= $list_po->ppn ?></td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </td>
                        <!-- <td></td>
                    <td></td> -->
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
        <br>
    </div>
    <i style="float: left;">printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>

</body>

</html>