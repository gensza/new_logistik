<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER SURAT PERMINTAAN PEMBELIAN (SPP)</title>
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
    <h3 style="font-size:14px;font-weight:bold; margin-bottom: -1%;"><?= $lokasi1 ?></h3>

    <?php
    if ($lok != '01') {
        echo '';
    } else {
        echo '<h6 style="z-index: 0; margin-top: -10px; margin-bottom: -2%;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    }
    ?>
    <div style="text-align: center;">
        <h3 style="font-size:11px;font-weight:bold; margin-bottom: -1%;">REGISTER SURAT PERMINTAAN PEMBELIAN (SPP)</h3>
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
        <p align="right" style="margin-top: -3%;margin-bottom: 0px;"><small>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></small></p>
        <table border="1" class="singleborder" width="100%">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="8%">No SPP</th>
                    <th width="8%">Tanggal SPP</th>
                    <th width="20%">Nomor Ref SPP</th>
                    <th width="10%">Nama Pemohon</th>
                    <th width="10%" colspan="7">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($spp)) { ?>
                    <tr>
                        <td>1</td>
                        <td colspan="11" style="text-align: center;">Tidak ada data</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="10">
                            <table border="1" id="tabelPO" class="singleborder" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width:20%">Kode Barang</th>
                                        <th style="width:20%">Nama Barang</th>
                                        <th style="width:5%">Satuan</th>
                                        <th style="width:8%">Kuantitas</th>
                                    </tr>

                                </thead>
                                <tbody>

                                    <tr>
                                        <td colspan="4" style="text-align: center;">Tidak ada data </td>

                                    </tr>

                                </tbody>
                            </table>

                        </td>

                    </tr>
                    <?php } else {
                    if ($lokasi2 == "") {
                        $lokasi = "";
                    } else {
                        $lokasi = "AND LOKASI = '$lokasi2'";
                    }
                    if (isset($spp)) {
                        $no = 1;
                        foreach ($spp as $d) {
                    ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d->noppo; ?></td>
                                <td><?= date_format(date_create($d->tglppo), "d/m/Y"); ?></td>
                                <td><?= $d->noreftxt; ?></td>
                                <td><?= $d->user; ?></td>
                                <td colspan="7"><?= $d->ket; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="10">
                                    <table border="1" id="tabelPO" class="singleborder" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width:20%">Kode Barang</th>
                                                <th style="width:20%">Nama Barang</th>
                                                <th style="width:5%">Satuan</th>
                                                <th style="width:8%">Kuantitas</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php
                                            $noref = "'" . $d->noreftxt . "'";
                                            $query = "SELECT kodebar, nabar, sat, qty FROM item_ppo WHERE noreftxt = $noref $lokasi";
                                            $item_ppo = $this->db_logistik_pt->query($query)->result();
                                            foreach ($item_ppo as $dt) { ?>
                                                <tr>
                                                    <td><?= $dt->kodebar ?> </td>
                                                    <td><?= $dt->nabar ?></td>
                                                    <td><?= $dt->sat ?></td>
                                                    <td><?= $dt->qty ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </td>

                            </tr>
                <?php }
                    }
                } ?>
            </tbody>
        </table>

    </div>


</body>

</html>