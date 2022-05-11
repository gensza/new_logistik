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
        <h3><u>REGISTER LAPORAN PENERIMAAN BARANG (LPB)</u></h3>
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
    <table class="singleborder" width="100%" border="1">
        <thead style="text-align: center;">
            <tr>
                <td style="font-weight: bold;">No</td>
                <td style="font-weight: bold;">Tanggal</td>
                <td style="font-weight: bold;">No BA</td>
                <td style="font-weight: bold; width: 25%;">Supplier</td>
                <td style="font-weight: bold;">Kode Barang</td>
                <td style="font-weight: bold;">Nama Barang</td>
                <td style="font-weight: bold;">Sat</td>
                <td style="font-weight: bold;">Qty</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total = 0;
            foreach ($r_retur as $list_rr) {
                $total += $list_rr->qty;
            ?>
                <tr>
                    <td style="text-align: center;"><?= $no++; ?></td>
                    <td style="text-align: center;"><?= date_format(date_create($list_rr->tgl), "d/m/Y") ?></td>
                    <td style="width: 15%;"><?= $list_rr->no_ba; ?></td>
                    <td style="width: 15%;"><?= $list_rr->devisi; ?></td>
                    <td style="text-align: center;"><?= $list_rr->kodebar; ?></td>
                    <td><?= $list_rr->nabar; ?></td>
                    <td style="text-align: center;"><?= $list_rr->satuan; ?></td>
                    <td style="text-align: center;"><?= $list_rr->qty; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="5"></td>
                <td colspan="2" style="text-align: center;"><b>Total </b> </td>
                <td style="text-align: center;"><?= $total; ?></td>
            </tr>

        </tbody>
    </table>
    <br>
    <div style="text-align: right; ">
        AirLangga Estate, <?= date("d M Y"); ?>
    </div>
    <br><br>
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: center;">Diketahui, <br><br><br><br><br>(___________________) <br><br>G.Manager</td>
                <td style="text-align: center;">Disetujui Oleh, <br><br><br><br><br>(___________________) <br><br>KTU</td>
                <td style="text-align: center;">Diperiksa, <br><br><br><br><br>(___________________) <br><br>Kasie Gudang</td>
                <td style="text-align: center;">Dicatat, <br><br><br><br><br>(___________________) <br> <br>Krani Gudang</td>
            </tr>
        </thead>
    </table>
</body>

</html>