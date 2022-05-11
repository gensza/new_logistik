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
    <h2 style="margin-bottom: 0;">PT. MULIA SAWIT AGRO LESTARI (<?= $st_msk->lokasi; ?>)</h2>
    <h5 style="margin-top: 5px;"> JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, Kebayoran Baru, Jakarta Selatan, DKI Jakarta Raya - 12140</h5>
    <div style="text-align: center;">
        <h3><u>REGISTER MASUK BARANG (LPB)</u></h3>
    </div>
    <div style="text-align: left; padding-left: 3px; font-size: 10px;">
        PERIODE : <?= str_replace('-', '/', $tgl1) . ' - ' . str_replace('-', '/', $tgl2) ?>
    </div>
    <br>
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: left;">PO NO : <?= $st_msk->refpo; ?></td>
                <td style="text-align: right;"><i>By System MIPS</i></td>
            </tr>
        </thead>
    </table>
    <br>
    <table class="singleborder" border="1" width="100%">
        <thead style="text-align: center; ">
            <tr>
                <td style="width: 8%; font-weight: bold;">No. LPB</td>
                <td style="width: 8%; font-weight: bold;">No. PO</td>
                <td style="width: 15%; font-weight: bold;">Kode Barang</td>
                <td style="width: 15%; font-weight: bold;">Nama Barang</td>
                <td style="width: 5%; font-weight: bold;">SAT</td>
                <td style="width: 10%; font-weight: bold;">QTY</td>
                <td style="width: 20%; font-weight: bold;">Group</td>
                <td style="font-weight: bold;">KETERANGAN</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            $tgl1 = date_format(date_create($tgl1), "Y/m/d");
            $tgl2 = date_format(date_create($tgl2), "Y/m/d");
            $query = "SELECT * FROM masukitem WHERE tgl BETWEEN '$tgl1' AND '$tgl2' AND kdpt = '$st_msk->kode' AND batal = '0' AND noref = '$st_msk->noref' AND refpo = '$st_msk->refpo'";
            $per_po = $this->db_logistik_pt->query($query)->result();
            foreach ($per_po as $list_per_po) {
                $total += $list_per_po->qty;
                $query1 = "SELECT namagrp10 FROM kodebar WHERE kodebar = '" . $list_per_po->kodebar . "'";
                $grp1 = $this->db_logistik->query($query1)->row();
            ?>
                <tr>
                    <td style="text-align: center;"><?= $list_per_po->ttg; ?></td>
                    <td style="text-align: center;"><?= $list_per_po->nopo; ?></td>
                    <td style="text-align: center;"><?= $list_per_po->kodebar; ?></td>
                    <td style="text-align: center;"><?= $list_per_po->nabar; ?></td>
                    <td style="text-align: center;"><?= $list_per_po->satuan; ?></td>
                    <td style="text-align: center;"><?= $list_per_po->qty; ?></td>
                    <td style="text-align: center;">
                        <?php
                        if ($grp1 == NULL) {
                            echo "-";
                        } else {
                            echo $grp1->namagrp10;
                        } ?>
                    </td>
                    <td><?= $list_per_po->ket; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <div style="text-align: center;">
        <b>Total : <?= number_format($total, 2) ?></b>
    </div>
</body>

</html>