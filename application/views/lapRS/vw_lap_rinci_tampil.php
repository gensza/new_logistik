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
            vertical-align: middle;
        }

        .singleborder {
            border-collapse: collapse;
            border: 0.2px solid black;
        }
    </style>
</head>

<body>
    <?php
    if ($kode_dev == 'Semua') {
        echo '<h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $this->session->userdata('nama_pt') . '</h2>';
    } else {
        if (empty($kode_stock[0]->devisi)) {
            echo '<h2 style="margin-bottom: 0;">Tidak ada stok barang di divisi tersebut!</h2>';
        } else {
            echo '<h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $kode_stock[0]->devisi . '</h2>';
        }
    }

    if ($alamat != '01') {
        echo '';
    } else {
        echo '<h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    }
    ?>
    <div style="text-align: center;">
        <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; ">Register Rincian Stock Harian Material Gudang</h3>
    </div>
    <br>
    <?php if (empty($kode_stock)) { ?>
        <table border="0" width="100%">
            <thead>
                <tr>
                    <td style="text-align: left;"><b> PERIODE : <?= $periode; ?> </b></td>
                    <td style="text-align: right;"><i>By System MIPS</i></td>
                </tr>
                <tr>
                    <td style="text-align: left;"><b>Tidak ada data</b></td>
                    <td style="text-align: right;">
                        <b>
                            Saldo Sebelum Periode : 0.00
                        </b>
                    </td>
                </tr>
            </thead>
        </table>
        <table width="100%" class="singleborder" border="1">
            <thead style="text-align: center;">
                <tr>
                    <td style="text-align: center; width: 5%;">No</td>
                    <td style="text-align: center; width: 10%;">Tgl</td>
                    <td style="text-align: center; width: 10%;">Nomor</td>
                    <td style="text-align: center; width: 40%;">Keterangan</td>
                    <td style="text-align: center; width: 10%;">Qty Masuk</td>
                    <td style="text-align: center; width: 10%;">Qty Keluar</td>
                    <td style="text-align: center; width: 15%;">Saldo</td>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td style="text-align: center;">1</td>
                    <td style="text-align: center;" colspan="9">Tidak ada data</td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="background-color: lightgray;"><b>SUB TOTAL</b></td>
                    <td style="background-color: lightgray; text-align: right"><b><?= number_format(0, 2); ?></b></td>
                    <td style="background-color: lightgray; text-align: right"><b><?= number_format(0, 2); ?></b></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: center;"><b>GRAND TOTAL</b></td>
                    <td style="text-align: right;"><b><?= number_format(0, 2); ?></b></td>
                    <td style="text-align: right;"><b><?= number_format(0, 2); ?></b></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="7" style="text-align: right; padding-right: 15%;">
                        <b>Saldo Akhir &nbsp;&nbsp;&nbsp;:
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format(0, 2); ?></b>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php } else {
        foreach ($kode_stock as $ks) {
            $kode_dev2 = (int)$kode_dev;
            if ($kode_dev == 'Semua') {
                $q_saldo = "SELECT SUM(saldoakhir_qty) AS saldoakhir_qty, satuan FROM stockawal_bulanan_devisi WHERE kodebar = '$ks->kodebar' AND txtperiode < '$txtperiode'";
            } else {
                $q_saldo = "SELECT saldoakhir_qty, satuan FROM stockawal_bulanan_devisi WHERE kodebar = '$ks->kodebar' AND txtperiode < '$txtperiode' AND kode_dev IN('$kode_dev','$kode_dev2')";
            }
            $saldo_r = $this->db_logistik_pt->query($q_saldo)->num_rows();
            if ($saldo_r >= 1) {
                $saldo = $this->db_logistik_pt->query($q_saldo)->row_array();
            } else {
                $saldo = [
                    'saldoakhir_qty' => '0'
                ];
            }

            // var_dump($saldo);
            // die;

        ?>
            <table border="0" width="100%">
                <thead>
                    <tr>
                        <td style="text-align: left;"><b> PERIODE : <?= $periode; ?> </b></td>
                        <td style="text-align: right;"><i>By System MIPS</i></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><b> <?= $ks->kodebar; ?> &nbsp; <?= $ks->nabar; ?></b></td>
                        <td style="text-align: right;">
                            <b>
                                Saldo Sebelum Periode : <?= number_format($saldo['saldoakhir_qty'], 2) . ' ' . $ks->satuan; ?>
                            </b>
                        </td>
                    </tr>
                </thead>
            </table>
            <table width="100%" class="singleborder" border="1">
                <thead style="text-align: center;">
                    <tr>
                        <td style="text-align: center; width: 5%;">No</td>
                        <td style="text-align: center; width: 10%;">Tgl</td>
                        <td style="text-align: center; width: 10%;">Nomor</td>
                        <td style="text-align: center; width: 40%;">Keterangan</td>
                        <td style="text-align: center; width: 10%;">Qty Masuk</td>
                        <td style="text-align: center; width: 10%;">Qty Keluar</td>
                        <td style="text-align: center; width: 15%;">Saldo</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $s_a =  $saldo['saldoakhir_qty'];
                    $p1_frmt = date_format(date_create($p1), "Ymd");
                    $p2_frmt = date_format(date_create($p2), "Ymd");

                    if ($kode_dev == 'Semua') {
                        $q_stok = "SELECT * FROM register_stok WHERE tgltxt BETWEEN '$p1_frmt' AND '$p2_frmt' AND kodebar = '$ks->kodebar' ORDER BY tgltxt ASC, masuk_qty DESC";
                    } else {
                        $q_stok = "SELECT * FROM register_stok WHERE tgltxt BETWEEN '$p1_frmt' AND '$p2_frmt' AND kodebar = '$ks->kodebar' AND kode_dev IN('$kode_dev','$kode_dev2') ORDER BY tgltxt ASC, masuk_qty DESC";
                    }

                    $q_stok = $this->db_logistik_pt->query($q_stok)->result();
                    $sub_tgl = '';
                    $sub_tgl1 = '';
                    $sub_tot_lpb = 0;
                    $sub_tot_bkb = 0;
                    $grand_lpb = 0;
                    $grand_bkb = 0;
                    $saldo_akh = 0;
                    foreach ($q_stok as $qs) { ?>
                        <?php
                        $sub_tgl1 = $sub_tgl;
                        $sub_tgl = date_format(date_create($qs->tgl), "Y-m-d");
                        if ($no == 1) {
                        } else if ($sub_tgl1 !== date_format(date_create($qs->tgl), "Y-m-d")) {

                        ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="background-color: lightgray;"><b>SUB TOTAL</b></td>
                                <td style="background-color: lightgray; text-align: right"><b><?= number_format($sub_tot_lpb, 2); ?></b></td>
                                <td style="background-color: lightgray; text-align: right"><b><?= number_format($sub_tot_bkb, 2); ?></b></td>
                                <td></td>
                            </tr>
                        <?php
                            $sub_tot_lpb = 0;
                            $sub_tot_bkb = 0;
                        }

                        ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++; ?></td>
                            <td style="text-align: center;"><?= date_format(date_create($qs->tgl), 'd/m/Y'); ?></td>
                            <td style="text-align: center;"><?= $qs->status . ' ' . $qs->ttgtxt; ?></td>
                            <td style="text-align: left;"><?= $qs->ket; ?></td>
                            <?php
                            $saldo_akh += $s_a;
                            if ($qs->status == 'LPB') {
                                $sub_tot_lpb += $qs->masuk_qty;
                                $grand_lpb += $qs->masuk_qty;
                            ?>
                                <td style="text-align: right;"><?= number_format($qs->masuk_qty, 2); ?></td>
                                <td style="text-align: right;"><?= number_format(0, 2); ?></td>
                                <td style="text-align: right;"><?= number_format(($s_a = $s_a +  $qs->masuk_qty), 2); ?></td>
                            <?php } else if ($qs->status == 'BKB') {
                                $sub_tot_bkb += $qs->keluar_qty;
                                $grand_bkb += $qs->keluar_qty;
                            ?>
                                <td style="text-align: right;"><?= number_format(0, 2); ?></td>
                                <td style="text-align: right;"><?= number_format($qs->keluar_qty, 2); ?></td>
                                <td style="text-align: right;"><?= number_format(($s_a = $s_a -  $qs->keluar_qty), 2); ?></td>
                            <?php } ?>
                        </tr>

                    <?php } ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="background-color: lightgray;"><b>SUB TOTAL</b></td>
                        <td style="background-color: lightgray; text-align: right"><b><?= number_format($sub_tot_lpb, 2); ?></b></td>
                        <td style="background-color: lightgray; text-align: right"><b><?= number_format($sub_tot_bkb, 2); ?></b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: center;"><b>GRAND TOTAL</b></td>
                        <td style="text-align: right;"><b><?= number_format($grand_lpb, 2); ?></b></td>
                        <td style="text-align: right;"><b><?= number_format($grand_bkb, 2); ?></b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="7" style="text-align: right; padding-right: 15%;">
                            <b>Saldo Akhir &nbsp;&nbsp;&nbsp;:
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= number_format($s_a, 2); ?></b>
                        </td>
                    </tr>
                </tbody>
            </table>
    <?php }
    } ?>
    <br>
    <i>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>
</body>

</html>