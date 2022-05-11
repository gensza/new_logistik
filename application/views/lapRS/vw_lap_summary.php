<!DOCTYPE html>
<html>

<head>
    <title>Register Pemakaian Stock Material Gudang</title>
    <style type="text/css">
        table {
            /*font-size: 12px;*/
            /*border: 1px solid #dddddd;*/
            border-collapse: collapse;
        }

        body {
            font-family: Verdana;
            font-size: 9px;
            font-style: normal;
            font-variant: normal;
            font-weight: 300;
            line-height: 10px;
        }

        th {
            padding: 5px;
        }

        td {
            padding: 3px;
        }
    </style>
</head>

<body>
    <table width="100%" border="0" style="margin-bottom: -10px;">
        <tr>
            <td colspan="2">
                <?php
                if ($kode_dev == 'Semua') {
                    echo '<h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $this->session->userdata('nama_pt') . '</h2>';
                } else {
                    if (empty($grp_stockawal[0]->devisi)) {
                        echo '<h2 style="margin-bottom: 0;">Tidak ada stok barang di divisi tersebut!</h2>';
                    } else {
                        echo '<h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $grp_stockawal[0]->devisi . '</h2>';
                    }
                }

                if ($alamat != '01') {
                    echo '';
                } else {
                    echo '<h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; ">Register Summary Pemakaian Stock Material Gudang</h3>
            </td>
        </tr>
        <tr>
            <?php
            $Ymd_periode = $periode_str;
            $periode = date("F Y", strtotime($Ymd_periode));
            ?>
            <td width="50%" align="left"><b>Periode : <?= $periode; ?> </b></td>
            <td width="50%" align="right"><small>By MIPS</small></td>
        </tr>
    </table>
    <br>

    <?php
    if (empty($grp_stockawal)) {
    ?>
        <table border="1" width="100%" align="center">
            <thead>
                <th>No</th>
                <th>Account</th>
                <th>Nama Barang</th>
                <th>SAT</th>
                <th>Saldo Awal</th>
                <th>QTY Masuk (LPB)</th>
                <th>QTY Keluar (BKB)</th>
                <th>Saldo Akhir</th>
            </thead>
            <tbody>
                <tr>
                    <td colspan="8">Tidak ada data</td>
                </tr>
            </tbody>
        </table>
    <?php
    } else {
    ?>
        <table border="1" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Account</th>
                    <th>Nama Barang</th>
                    <th>SAT</th>
                    <th>Saldo Awal</th>
                    <th>QTY Masuk (LPB)</th>
                    <th>QTY Keluar (BKB)</th>
                    <th>Saldo Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grandtotal_saldoawal_qty = "0";
                $grandtotal_QTY_MASUK = "0";
                $grandtotal_QTY_KELUAR = "0";
                $grandtotal_saldoakhir_qty = "0";
                foreach ($grp_stockawal as $list_grp) {
                    $grp = $list_grp->grp;
                ?>
                    <tr>
                        <td colspan="8"><?= $grp;  ?></td>
                    </tr>
                    <?php
                    $kode_dev2 = (int)$kode_dev;
                    if ($kode_dev == "Semua") {
                        $query_stockawal = "SELECT kodebartxt, nabar, saldoawal_qty, saldoawal_nilai, KODE, txtperiode, satuan, QTY_MASUK, QTY_KELUAR, saldoakhir_qty FROM stockawal WHERE txtperiode = '$txtperiode' AND grp = '$grp'";
                    } else {
                        $query_stockawal = "SELECT kodebartxt, nabar, saldoawal_qty, saldoawal_nilai, KODE, txtperiode, satuan, QTY_MASUK, QTY_KELUAR, saldoakhir_qty FROM stockawal_bulanan_devisi WHERE txtperiode = '$txtperiode' AND grp = '$grp' AND kode_dev IN('$kode_dev','$kode_dev2')";
                    }
                    $stockawal = $this->db_logistik_pt->query($query_stockawal)->result();
                    $subtotal_saldoawal_qty = "0";
                    $subtotal_QTY_MASUK = "0";
                    $subtotal_QTY_KELUAR = "0";
                    $subtotal_saldoakhir_qty = "0";
                    $no = 1;
                    foreach ($stockawal as $list_stockawal) {

                        //mendapatkan stockawal
                        if ($kode_dev == 'Semua') {
                            $q_saldo = "SELECT saldoakhir_qty, satuan FROM stockawal_bulanan_devisi WHERE kodebartxt = '$list_stockawal->kodebartxt' AND txtperiode < '$txtperiode'";
                        } else {
                            $q_saldo = "SELECT saldoakhir_qty, satuan FROM stockawal_bulanan_devisi WHERE kodebartxt = '$list_stockawal->kodebartxt' AND txtperiode < '$txtperiode' AND kode_dev IN('$kode_dev','$kode_dev2')";
                        }
                        $saldo_r = $this->db_logistik_pt->query($q_saldo)->num_rows();
                        if ($saldo_r >= 1) {
                            $saldo = $this->db_logistik_pt->query($q_saldo)->row_array();
                        } else {
                            $saldo = [
                                'saldoakhir_qty' => '0'
                            ];
                        }

                        $saldo_akhir = $list_stockawal->saldoakhir_qty + $saldo['saldoakhir_qty'];
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $list_stockawal->kodebartxt; ?></td>
                            <td><?= $list_stockawal->nabar; ?></td>
                            <td><?= $list_stockawal->satuan; ?></td>
                            <td><?= number_format($saldo['saldoakhir_qty'], 2); ?></td>
                            <td><?= number_format($list_stockawal->QTY_MASUK, 2); ?></td>
                            <td><?= number_format($list_stockawal->QTY_KELUAR, 2); ?></td>
                            <td><?= number_format($saldo_akhir, 2); ?></td>
                        </tr>
                    <?php
                        $subtotal_saldoawal_qty = round($subtotal_saldoawal_qty, 2) + round($saldo['saldoakhir_qty'], 2);
                        $subtotal_QTY_MASUK = round($subtotal_QTY_MASUK, 2) + round($list_stockawal->QTY_MASUK, 2);
                        $subtotal_QTY_KELUAR = round($subtotal_QTY_KELUAR, 2) + round($list_stockawal->QTY_KELUAR, 2);
                        $subtotal_saldoakhir_qty = (round($subtotal_saldoawal_qty, 2) + round($subtotal_QTY_MASUK, 2)) - round($subtotal_QTY_KELUAR, 2);
                        $no++;
                    }
                    ?>
                    <tr>
                        <td style="background-color: lightgray;" colspan="4" align="right">SUBTOTAL</td>
                        <td style="background-color: lightgray;"><?= number_format($subtotal_saldoawal_qty, 2); ?></td>
                        <td style="background-color: lightgray;"><?= number_format($subtotal_QTY_MASUK, 2); ?></td>
                        <td style="background-color: lightgray;"><?= number_format($subtotal_QTY_KELUAR, 2); ?></td>
                        <td style="background-color: lightgray;"><?= number_format($subtotal_saldoakhir_qty, 2); ?></td>
                    </tr>
                <?php
                    $grandtotal_saldoawal_qty = round($grandtotal_saldoawal_qty, 2) + round($subtotal_saldoawal_qty, 2);
                    $grandtotal_QTY_MASUK = round($grandtotal_QTY_MASUK, 2) + round($subtotal_QTY_MASUK, 2);
                    $grandtotal_QTY_KELUAR = round($grandtotal_QTY_KELUAR, 2) + round($subtotal_QTY_KELUAR, 2);
                    $grandtotal_saldoakhir_qty = round($grandtotal_saldoakhir_qty, 2) + round($subtotal_saldoakhir_qty, 2);
                }
                ?>
                <tr>
                    <td colspan="4" align="right">GRANDTOTAL</td>
                    <td><?= number_format($grandtotal_saldoawal_qty, 2); ?></td>
                    <td><?= number_format($grandtotal_QTY_MASUK, 2); ?></td>
                    <td><?= number_format($grandtotal_QTY_KELUAR, 2); ?></td>
                    <td><?= number_format($grandtotal_saldoakhir_qty, 2); ?></td>
                </tr>
            </tbody>
        </table>
    <?php
    }
    ?>
    <br>
    <table width="80%" align="center" border="0">
        <thead>
            <tr>
                <td align="center">Disetujui Oleh,</td>
                <td align="center">Diketahui Oleh,</td>
                <td align="center">Diperiksa Oleh,</td>
                <td align="center">Dibuat Oleh,</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td height="70px" valign="bottom" align="center">(________________________)</td>
                <td height="70px" valign="bottom" align="center">(________________________)</td>
                <td height="70px" valign="bottom" align="center">(________________________)</td>
                <td height="70px" valign="bottom" align="center">(________________________)</td>
            </tr>
            <tr>
                <td align="center">KTU</td>
                <td align="center">GM</td>
                <td align="center">Kasie Gudang</td>
                <td align="center">Krani</td>
            </tr>
        </tbody>
    </table>
</body>

</html>