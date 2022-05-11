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
    if (empty($brg[0]->devisi)) {
        echo '<h2>Data tidak ditemukan pada Divisi tersebut!</h2>';
    } else {
        echo '<h3 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $brg[0]->devisi . '</h3>';
    }
    if ($alamat != '01') {
        echo '';
    } else {
        echo '<h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    }
    ?>

    <div style="text-align: center;">
        <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; "><u>REGISTER MASUK BARANG (LPB)</u></h3>
    </div>
    <div style="text-align: center; padding-left: 3px; font-size: 10px; margin-top:-1%">
        <h3 style="font-size:10px;font-weight:normal;margin-bottom: 0%; ">PERIODE : <?= date_format(date_create($tanggal1), "d/m/Y") . " - " . date_format(date_create($tanggal2), "d/m/Y"); ?></h3>

    </div>
    <p align="right" style="margin-bottom: -3%;"><small>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></small></p>
    <?php
    foreach ($brg as $b) { ?>
        <table border="0" width="100%">
            <thead>
                <tr>
                    <td style="text-align: left;"><b><?= $b->kodebar; ?> - <?= $b->nabar; ?> (<?= $b->satuan; ?>)</b></td>
                    <!-- <td style="text-align: right;"></td> -->
                </tr>
            </thead>
        </table>
        <table border="1" class="singleborder" width="100%">
            <thead>
                <tr>
                    <td style="text-align: center; width: 10%">Tgl</td>
                    <td style="text-align: center; width: 10%">No. LPB</td>
                    <td style="text-align: center; width: 10%">No. PO</td>
                    <td style="text-align: center; width: 10%">QTY</td>
                    <td style="text-align: center; width: 30%;">Group Barang</td>
                    <td style="text-align: center;">KETERANGAN</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                $kodebar = "'" . $b->kodebar . "'";
                $query = "SELECT * FROM masukitem WHERE kodebar = $kodebar AND tgl BETWEEN '$tanggal1' AND '$tanggal2' AND kode_dev = '$lokasi1' AND batal = '0'";
                $per_brg = $this->db_logistik_pt->query($query)->result();
                foreach ($per_brg as $list_per_brg) {
                    $query1 = "SELECT grp FROM kodebar WHERE kodebar = '" . $list_per_brg->kodebar . "'";
                    $grp1 = $this->db_logistik->query($query1)->row();
                    $total += $list_per_brg->qty;
                ?>
                    <tr>
                        <td style="text-align: center;"><?= date_format(date_create($list_per_brg->tgl), 'd/m/Y'); ?></td>
                        <td style="text-align: center;"><?= $list_per_brg->ttg; ?></td>
                        <td style="text-align: center;"><?= $list_per_brg->nopo; ?></td>
                        <td style="text-align: center;"><?= $list_per_brg->qty; ?></td>
                        <td style="text-align: center;">
                            <?php
                            if ($grp1 == NULL) {
                                echo "-";
                            } else {
                                echo $grp1->grp;
                            } ?>
                        </td>
                        <td style="text-align: center;"><?= $list_per_brg->ket; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: center; background-color: grey;">Total</td>
                    <td style="text-align: center; background-color: grey;"><?= number_format($total, 2) ?></td>
                </tr>
            </tbody>
        </table>
    <?php } ?>

</body>

</html>