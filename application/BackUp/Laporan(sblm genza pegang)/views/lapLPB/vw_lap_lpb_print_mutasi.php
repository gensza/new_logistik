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
    <h2 style="margin-bottom: 0;">PT. MULIA SAWIT AGRO LESTARI</h2>
    <h5 style="margin-top: 5px;"> JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, Kebayoran Baru, Jakarta Selatan, DKI Jakarta Raya - 12140</h5>
    <div style="text-align: center;">
        <h3><u>REGISTER LAPORAN PENERIMAAN BARANG MUTASI (LPB)</u></h3>
    </div>
    <br>
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: left;">PERIODE : <?= date_format(date_create($tgl1), "d/m/Y") . ' - ' . date_format(date_create($tgl2), "d/m/Y"); ?></td>
                <td style="text-align: right;"><i>By System MIPS</i></td>
            </tr>
        </thead>
    </table>
    <br>
    <table class="singleborder" border="1" width="100%">
        <thead style="text-align: center;">
            <tr>
                <td style="font-weight: bold;">Tanggal</td>
                <td style="font-weight: bold;">No LPB</td>
                <td style="font-weight: bold;">No PO</td>
                <td style="font-weight: bold;">Kode Barang</td>
                <td style="font-weight: bold;">Nama Barang</td>
                <td style="font-weight: bold;">Sat</td>
                <td style="font-weight: bold;">Qty</td>
                <td style="font-weight: bold;">Supplier</td>
                <td style="font-weight: bold;">Keterangan</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            foreach ($mutasi as $list_mutasi) {
                // $query1 = "SELECT harga FROM item_po WHERE kodebar = '" . $list_per_pol->kodebar . "' AND noref = '" . $list_per_pol->refpo . "'";
                // $grp1 = $this->db_logistik_pt->query($query1)->row();
                $total += $list_mutasi->qty;
            ?>
                <tr>
                    <td><?= date_format(date_create($list_mutasi->tgl), 'd/m/Y'); ?></td>
                    <td><?= $list_mutasi->noref; ?></td>
                    <td><?= $list_mutasi->refpo; ?></td>
                    <td><?= $list_mutasi->kodebar; ?></td>
                    <td><?= $list_mutasi->nabar; ?></td>
                    <td><?= $list_mutasi->satuan; ?></td>
                    <td style="text-align: center;"><?= number_format($list_mutasi->qty, 2); ?></td>
                    <td><?= $list_mutasi->nama_supply; ?></td>
                    <td><?= $list_mutasi->ket; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td style="text-align: center;" colspan="9"><b>Total : <?= number_format($total, 2) ?></b></td>
            </tr>
        </tbody>
    </table>
    <br>
    <div style="text-align: right;">
        Sriwijaya Estate, <?= date("d M Y"); ?>
    </div>
    <br><br>
    <table border="0" width="100%" style="text-align: center;">
        <tr>
            <td>Disetujui,<br><br><br><br><br>___________________ <br><br>G. Manager</td>
            <td>Diketahui,<br><br><br><br><br>___________________ <br><br>KTU</td>
            <td>Diperiksa,<br><br><br><br><br>___________________ <br><br>Ka. Gudang</td>
            <td>Dicatat,<br><br><br><br><br>___________________ <br><br>Krani Gudang</td>
        </tr>
    </table>
</body>

</html>