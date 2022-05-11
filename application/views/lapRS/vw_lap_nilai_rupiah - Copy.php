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
            font-size: 10px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 20px;
        }
    </style>
</head>

<body>
    <table width="100%" border="0">
        <tr>
            <td colspan="2">
                <h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;"><?= $namapt; ?></h2>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; ">Rincian Pemakaian Stock Material Gudang</h3>
            </td>
        </tr>
        <tr>
            <td colspan="2"><?= $namapt; ?></td>
        </tr>
        <tr>
            <?php
            // $Ymd_periode = $this->session->userdata('Ymd_periode');
            $Ymd_periode = $periode_str;
            $periode = date("F Y", strtotime($Ymd_periode));

            // $ym_periode_skrg = $this->session->userdata('ym_periode');
            ?>
            <td width="50%" align="left"><b>Periode : <?= $periode; ?> </b></td>
            <td width="50%" align="right">By MIPS</small></td>
        </tr>
    </table>

    <?php
    if (count($grp_stockawal) == "0") {
    ?>
        <table border="1" class="tablerinci" width="100%" align="center">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Account</th>
                    <th rowspan="2">Nama Barang</th>
                    <th rowspan="2">SAT</th>
                    <th rowspan="2">Harga PO Rata-Rata</th>
                    <th colspan="2">Saldo Awal</th>
                    <th colspan="2">Qty Masuk (LPB)</th>
                    <th colspan="2">Qty Keluar (BKB)</th>
                    <th colspan="2">Saldo Akhir</th>
                </tr>
                <tr>
                    <th>Qty</th>
                    <th>Rupiah</th>
                    <th>Qty</th>
                    <th>Rupiah</th>
                    <th>Qty</th>
                    <th>Rupiah</th>
                    <th>Qty</th>
                    <th>Rupiah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="13" style="text-align: center;">Tidak ada data</td>
                </tr>
            </tbody>
        </table>
    <?php
    } else {
    ?>
        <table border="1" class="tablerinci" width="100%" align="center">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Account</th>
                    <th rowspan="2">Nama Barang</th>
                    <th rowspan="2">SAT</th>
                    <th rowspan="2">Harga PO Rata-Rata</th>
                    <th colspan="2">Saldo Awal</th>
                    <th colspan="2">Qty Masuk (LPB)</th>
                    <th colspan="2">Qty Keluar (BKB)</th>
                    <th colspan="2">Saldo Akhir</th>
                </tr>
                <tr>
                    <th>Qty</th>
                    <th>Rupiah</th>
                    <th>Qty</th>
                    <th>Rupiah</th>
                    <th>Qty</th>
                    <th>Rupiah</th>
                    <th>Qty</th>
                    <th>Rupiah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grandtotal_saw_qty = "0";
                $grandtotal_saw_rp = "0";
                $grandtotal_lpb_qty = "0";
                $grandtotal_lpb_rp = "0";
                $grandtotal_bkb_qty = "0";
                $grandtotal_bkb_rp = "0";
                $grandtotal_sak_qty = "0";
                $grandtotal_sak_rp = "0";

                $no = 1;
                foreach ($grp_stockawal as $list_grp) {
                    $grp = $list_grp->grp;
                ?>
                    <tr>
                        <td colspan="13"><?= $grp;  ?></td>
                    </tr>
                    <?php
                    $h_porat = "0";
                    $saw_totalqty = "0";
                    $saw_totalrp = "0";
                    $lpb_totalqty = "0";
                    $lpb_totalrp = "0";
                    $bkb_totalqty = "0";
                    $bkb_totalrp = "0";
                    $sak_totalqty = "0";
                    $sak_totalrp = "0";
                    $porat = "0";

                    if ($kd_stock_1 == "Semua") {
                        $query_stockawal = "SELECT kodebartxt, nabar, saldoawal_qty, saldoawal_nilai, KODE, txtperiode, satuan, nilai_masuk,nilai_keluar, QTY_MASUK, QTY_KELUAR, saldoakhir_qty, saldoakhir_nilai FROM stockawal WHERE KODE = '$pt' AND txtperiode = '$ym_periode' AND grp = '$grp'";
                    } else {
                        $query_stockawal = "SELECT kodebartxt, nabar, saldoawal_qty, saldoawal_nilai, KODE, txtperiode, satuan, nilai_masuk,nilai_keluar, QTY_MASUK, QTY_KELUAR, saldoakhir_qty, saldoakhir_nilai FROM stockawal WHERE (kodebartxt BETWEEN '$kd_stock_1' AND '$kd_stock_2') AND KODE = '$pt' AND txtperiode = '$ym_periode' AND grp = '$grp'";
                    }
                    $stockawal = $this->db_logistik_pt->query($query_stockawal)->result();
                    foreach ($stockawal as $list_stockawal) {
                        $porat = $list_stockawal->saldoakhir_nilai / $list_stockawal->saldoakhir_qty;
                        $nilai_keluar = $list_stockawal->QTY_KELUAR * $porat;

                        $KODEBAR = $list_stockawal->kodebartxt;
                        $kdpt = $this->session->userdata('kode_pt');
                        $ym_periode_skrg = $this->session->userdata('ym_periode');
                    ?>
                        <tr>
                            <td align="center"><?= $no; ?></td>
                            <td align="center"><?= $list_stockawal->kodebartxt; ?></td>
                            <td align="left"><?= $list_stockawal->nabar; ?></td>
                            <td align="center"><?= $list_stockawal->satuan; ?></td>
                            <td align="right"><?= number_format($porat); ?></td>
                            <td align="right"><?= number_format($list_stockawal->saldoawal_qty, 2); ?></td>
                            <td align="right"><?= number_format($list_stockawal->saldoawal_nilai); ?></td>
                            <td align="right"><?= number_format($list_stockawal->QTY_MASUK, 2); ?></td>
                            <td align="right"><?= number_format($list_stockawal->nilai_masuk); ?></td>
                            <td align="right"><?= number_format($list_stockawal->QTY_KELUAR, 2); ?></td>
                            <td align="right"><?= number_format($list_stockawal->nilai_keluar, 2); ?></td>
                            <td align="right"><?= number_format($list_stockawal->saldoakhir_qty, 2); ?></td>
                            <td align="right"><?= number_format($list_stockawal->saldoakhir_nilai); ?></td>
                            <!-- <td><?php // print_r($list); 
                                        ?></td> -->
                        </tr>
                    <?php
                        // $h_porat = $h_porat + $list_stockawal->HARGAPORAT;
                        $saw_totalqty = round($saw_totalqty, 2) + round($list_stockawal->saldoawal_qty, 2);
                        $saw_totalrp = round($saw_totalrp, 2) + round($list_stockawal->saldoawal_nilai, 2);
                        $lpb_totalqty = round($lpb_totalqty, 2) + round($list_stockawal->QTY_MASUK, 2);
                        $lpb_totalrp = round($lpb_totalrp, 2) + round($list_stockawal->nilai_masuk, 2);
                        $bkb_totalqty = round($bkb_totalqty, 2) + round($list_stockawal->QTY_KELUAR, 2);
                        $bkb_totalrp = round($bkb_totalrp, 2) + round($list_stockawal->nilai_keluar, 2);
                        $sak_totalqty = round($sak_totalqty, 2) + round($list_stockawal->saldoakhir_qty, 2);
                        $sak_totalrp = round($sak_totalrp, 2) + round($list_stockawal->saldoakhir_nilai, 2);

                        $no++;
                    }
                    ?>
                    <tr>
                        <td height="10px" colspan="5">
                            <h5 align="right" height="10">SUB TOTAL</h5>
                        </td>
                        <!-- <td height="10px"></td> -->
                        <!-- <td height="10px"></td> -->
                        <td height="10px" align="right"><?= number_format($saw_totalqty, 2) ?></td>
                        <td height="10px" align="right"><?= number_format($saw_totalrp) ?></td>
                        <td height="10px" align="right"><?= number_format($lpb_totalqty, 2) ?></td>
                        <td height="10px" align="right"><?= number_format($lpb_totalrp) ?></td>
                        <td height="10px" align="right"><?= number_format($bkb_totalqty, 2) ?></td>
                        <td height="10px" align="right"><?= number_format($bkb_totalrp) ?></td>
                        <td height="10px" align="right"><?= number_format($sak_totalqty, 2) ?></td>
                        <td height="10px" align="right"><?= number_format($sak_totalrp) ?></td>
                    </tr>
                <?php
                    $grandtotal_saw_qty = round($grandtotal_saw_qty, 2) + round($saw_totalqty, 2);
                    $grandtotal_saw_rp = round($grandtotal_saw_rp, 2) + round($saw_totalrp, 2);
                    $grandtotal_lpb_qty = round($grandtotal_lpb_qty, 2) + round($lpb_totalqty, 2);
                    $grandtotal_lpb_rp = round($grandtotal_lpb_rp, 2) + round($lpb_totalrp, 2);
                    $grandtotal_bkb_qty = round($grandtotal_bkb_qty, 2) + round($bkb_totalqty, 2);
                    $grandtotal_bkb_rp = round($grandtotal_bkb_rp, 2) + round($bkb_totalrp, 2);
                    $grandtotal_sak_qty = round($grandtotal_sak_qty, 2) + round($sak_totalqty, 2);
                    $grandtotal_sak_rp = round($grandtotal_sak_rp, 2) + round($sak_totalrp, 2);
                }
                ?>
                <tr>
                    <td height="30px" colspan="5">
                        <h5 align="right">GRAND TOTAL</h5>
                    </td>
                    <td height="10px" align="right"><?= number_format($grandtotal_saw_qty, 2); ?></td>
                    <td height="10px" align="right"><?= number_format($grandtotal_saw_rp, 2); ?></td>
                    <td height="10px" align="right"><?= number_format($grandtotal_lpb_qty, 2); ?></td>
                    <td height="10px" align="right"><?= number_format($grandtotal_lpb_rp, 2); ?></td>
                    <td height="10px" align="right"><?= number_format($grandtotal_bkb_qty, 2); ?></td>
                    <td height="10px" align="right"><?= number_format($grandtotal_bkb_rp, 2); ?></td>
                    <td height="10px" align="right"><?= number_format($grandtotal_sak_qty, 2); ?></td>
                    <td height="10px" align="right"><?= number_format($grandtotal_sak_rp, 2); ?></td>
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
                <td align="center" colspan="2">Diperiksa Oleh,</td>
                <td align="center">Dibuat Oleh,</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td height="100px" valign="bottom" align="center">(________________________)</td>
                <td height="100px" valign="bottom" align="center">(________________________)</td>
                <td height="100px" valign="bottom" align="center">(________________________)</td>
                <td height="100px" valign="bottom" align="center">(________________________)</td>
            </tr>
            <tr>
                <td align="center">GM</td>
                <td align="center">KTU</td>
                <td align="center">Kasie Gudang</td>
                <td align="center">Krani</td>
            </tr>
        </tbody>
    </table>
</body>

</html>