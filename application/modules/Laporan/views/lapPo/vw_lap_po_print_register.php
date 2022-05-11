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

        .singleborder2 {
            border-collapse: collapse;
            border: 1px;
        }

        #tabelPO tr td {
            border: 1px solid #4d4d4d;
        }
    </style>
</head>

<body>

    <h3 style="font-size:14px;font-weight:bold; margin-bottom: -1%;"><?= $lokasi1 ?></h3>

    <?php
    if ($lok != '01') {
        echo '';
    } else {
        echo '<h6 style="z-index: 0; margin-top: -10px;margin-bottom: -2%;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    }
    ?>

    <!-- <div style="margin-top: 10px; margin-bottom: 10;"></div> -->
    <div style="text-align: center;">
        <h3 style="font-size:11px;font-weight:bold; margin-bottom: -1%;">REGISTER PURCHASE ORDER (PO)</h3>
        <table border="0" class="center">
            <tr>
                <td>PERIODE</td>
                <td>:</td>
                <td><?= date_format(date_create($tgl1), "d/m/Y") . ' - ' . date_format(date_create($tgl2), "d/m/Y"); ?></td>
            </tr>
            <tr>
                <td>TANGGAL CETAK</td>
                <td>:</td>
                <td><?= date('d/m/Y'); ?></td>
            </tr>
        </table>
        <p align="right" style="margin-top: -2%;margin-bottom: -1%;"><small>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></small></p>
        <table border="1" class="singleborder" width="100%">
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
                <?php if (empty($po)) { ?>
                    <tr>
                        <td>1</td>
                        <td colspan="10" style="text-align: center;">Tidak ada data</td>
                    </tr>
                    <tr>
                        <td colspan="11">
                            <table border="1" id="tabelPO" class="singleborder2" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:20%">Kode Barang</th>
                                        <th style="width:20%">Nama Barang</th>
                                        <th style="width:5%">Satuan</th>
                                        <th style="width:8%">Kuantitas</th>
                                        <th style="width:20%">Harga Satuan</th>
                                        <th style="width:20%">Total</th>
                                        <th style="width:7%">PPN 10%</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    <tr>
                                        <!-- <td colspan="2"></td> -->
                                        <td colspan="7" style="text-align: center;">Tidak ada data</td>

                                    </tr>

                                </tbody>
                            </table>

                        </td>
                    </tr>

                    <?php } else {
                    $no = 1;
                    if ($lokasi2 == "") {
                        $lokasi = "";
                    } else {
                        $lokasi = "AND lokasi = '" . $lokasi2 . "'";
                    }
                    foreach ($po as $list_po) { ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $list_po->nopotxt; ?></td>
                            <td><?= date_format(date_create($list_po->tglpo), "d/m/Y"); ?></td>
                            <td><?= $list_po->no_refppo; ?></td>
                            <td><?= date_format(date_create($list_po->tgl_refppo), "d/m/Y"); ?></td>
                            <td><?= $list_po->ket; ?></td>
                            <td><?= $list_po->kode_supply; ?> - <?= $list_po->nama_supply ?></td>
                            <td><?= $list_po->kode_pemesan; ?> - <?= $list_po->pemesan ?></td>
                            <td><?= $list_po->bayar; ?> - <?= $list_po->tempo_bayar; ?> Hari</td>
                            <td><?= $list_po->ppn; ?></td>
                            <td><?= $list_po->lokasikirim; ?></td>
                        </tr>
                        <tr>
                            <td colspan="11">
                                <table border="1" id="tabelPO" class="singleborder" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width:20%">Kode Barang</th>
                                            <th style="width:20%">Nama Barang</th>
                                            <th style="width:5%">Satuan</th>
                                            <th style="width:8%">Kuantitas</th>
                                            <th style="width:20%">Harga Satuan</th>
                                            <th style="width:20%">Total</th>
                                            <th style="width:7%">PPN 10%</th>
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
                                                <?php if ($this->session->userdata('status_lokasi') != "HO") { ?>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                <?php } else { ?>
                                                    <td><?= number_format($list_item_po->harga, 2); ?></td>
                                                    <td><?= number_format($list_item_po->qty * $list_item_po->harga, 2); ?></td>
                                                    <td><?= number_format($list_po->ppn, 2) ?></td>
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
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


</body>

</html>