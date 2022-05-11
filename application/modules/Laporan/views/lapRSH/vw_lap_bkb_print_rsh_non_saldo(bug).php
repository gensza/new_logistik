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
    <?php
    if ($kode_dev == 'Semua') {
        echo '<h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $this->session->userdata('pt') . '</h2>';
    } else {
        if (empty($kode_stock[0]->devisi)) {
            echo '<h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;">Tidak ada stok barang di divisi tersebut!</h2>';
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
        <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; ">Register Harian Stock Material Gudang (Non Saldo)</h3>
    </div>
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: left;"><b> PERIODE : <?= $periode; ?> </b></td>
                <td style="text-align: right;"><i>By System MIPS</i></td>
            </tr>
        </thead>
    </table>
    <table class="singleborder" border="1" width="100%">
        <thead style="text-align: center;">
            <tr>
                <td width="3%">No</td>
                <td width="10%">Tgl</td>
                <td width="17%">Kode Barang</td>
                <td width="50%">Nama Barang</td>
                <td>Qty Masuk</td>
                <td>Qty Keluar</td>
            </tr>
        </thead>
        <tbody>
            <?php
            //distinct tnggal
            $sql = "SELECT DISTINCT tgl FROM masukitem WHERE tgl BETWEEN '$p1' AND '$p2' UNION SELECT DISTINCT tgl from keluarbrgitem WHERE tgl BETWEEN '$p1' AND '$p2'";
            $result_sql = $this->db_logistik_pt->query($sql)->result();
            if (empty($result_sql)) { ?>
                <tr>
                    <td style="text-align: center;">1.</td>
                    <td colspan="5" style="text-align: center;"><b>Tidak ada data</b></td>
                </tr>
                <tr style="background-color: lightgray;">
                    <td style="text-align: center;" colspan="4"><b>JUMLAH</b></td>
                    <td style="text-align: right;"><b><?= number_format(0, 2); ?></b></td>
                    <td style="text-align: right;"><b><?= number_format(0, 2); ?></b></td>
                </tr>
                <?php  } else {
                foreach ($result_sql as $rs) {
                    $kode_dev2 = (int)$kode_dev;

                    if ($kode_dev == 'Semua') {
                        //for where kodebar
                        if ($kodebar != '') {
                            $where_kodebar = "AND kodebar = '$kodebar'";
                        } else {
                            $where_kodebar = "";
                        }
                        //for where grup
                        if ($grup != 'Semua') {
                            $where_grup = "AND grup LIKE '%$grup%'";
                        } else {
                            $where_grup = "";
                        }
                        $tgl_where = date_format(date_create($rs->tgl), "Ymd");
                        $where_nya = "WHERE tgltxt = $tgl_where $where_kodebar $where_grup";

                        $q_sum = "SELECT tgl, kodebar, namabar, status, SUM(masuk_qty) AS masuk_qty, SUM(keluar_qty) AS keluar_qty FROM register_stok $where_nya GROUP BY kodebar";
                    } else {
                        //for where kodebar
                        if ($kodebar != '') {
                            $where_kodebar = "AND kodebar = '$kodebar'";
                        } else {
                            $where_kodebar = "";
                        }
                        //for where grup
                        if ($grup != 'Semua') {
                            $where_grup = "AND grup LIKE '%$grup%'";
                        } else {
                            $where_grup = "";
                        }
                        $tgl_where = date_format(date_create($rs->tgl), "Ymd");
                        $where_nya = "WHERE tgltxt = $tgl_where AND kode_dev IN('$kode_dev','$kode_dev2') $where_kodebar $where_grup";

                        $q_sum = "SELECT tgl, kodebar, namabar, status, SUM(masuk_qty) AS masuk_qty, SUM(keluar_qty) AS keluar_qty FROM register_stok $where_nya GROUP BY kodebar";
                    }
                    $jum_lpb = 0;
                    $jum_bkb = 0;
                    $no = 1;
                    $q_sum = $this->db_logistik_pt->query($q_sum)->result();
                    // var_dump($q_sum);
                    // die;
                    foreach ($q_sum as $qs) {
                        $jum_lpb += $qs->masuk_qty;
                        $jum_bkb += $qs->keluar_qty;

                ?>
                        <tr>
                            <td style="text-align: center;"><?= $no++; ?></td>
                            <td><?= date_format(date_create($rs->tgl), 'd/m/Y'); ?></td>
                            <td><?= $qs->kodebar ?></td>
                            <td><?= $qs->namabar ?></td>
                            <td style="text-align: right;"><?= number_format($qs->masuk_qty, 2); ?></td>
                            <td style="text-align: right;"><?= number_format($qs->keluar_qty, 2); ?></td>
                        </tr>

                    <?php }
                    if ($no == 1) {
                    } else {
                    ?>
                        <tr style="background-color: lightgray;">
                            <td style="text-align: center;" colspan="4"><b>JUMLAH</b></td>
                            <td style="text-align: right;"><b><?= number_format($jum_lpb, 2); ?></b></td>
                            <td style="text-align: right;"><b><?= number_format($jum_bkb, 2); ?></b></td>
                        </tr>
                    <?php } ?>
            <?php }
            } ?>
        </tbody>
    </table>
    <i>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>
</body>

</html>