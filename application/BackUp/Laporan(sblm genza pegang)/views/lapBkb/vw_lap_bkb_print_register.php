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
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h2 style="margin-bottom: 0;">PT. MULIA SAWIT AGRO LESTARI</h2>
    <h5 style="margin-top: 5px;"> JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, Kebayoran Baru, Jakarta Selatan, DKI Jakarta Raya - 12140</h5>
    <div style="text-align: center;">
        <h3><u>REGISTER KELUAR BARANG (BKB)</u></h3>
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
                <td style="font-weight: bold;">No. BPB</td>
                <td style="font-weight: bold;">Tgl</td>
                <td style="font-weight: bold;">Bagian</td>
                <td style="font-weight: bold;">Nama Barang</td>
                <td style="font-weight: bold;">Sat</td>
                <td style="font-weight: bold;">Qty</td>
                <td style="font-weight: bold;">Kode Barang</td>
                <td style="font-weight: bold;">Kode Sub. Beban</td>
                <td style="font-weight: bold;">AFD/DEPT/UNIT</td>
                <td style="font-weight: bold;">Blok</td>
                <td style="font-weight: bold;">Keterangan</td>
                <td style="font-weight: bold;">User</td>
                <td style="font-weight: bold;">Alokasi</td>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($bkb)) { ?>
                <tr>
                    <td colspan="13" style="text-align: center;">Tidak ada data</td>

                </tr>
                <?php
                foreach ($bkb as $list_bkb) { ?>
                    <tr>
                        <td style="text-align: center;"><?= $list_bkb->skb; ?></td>
                        <td style="text-align: center;"><?= date_format(date_create($list_bkb->tgl), 'd/m/Y'); ?></td>
                        <td style="text-align: left;"><?= $list_bkb->bag; ?></td>
                        <td style="text-align: left;"><?= $list_bkb->nabar; ?></td>
                        <td style="text-align: center;"><?= $list_bkb->satuan; ?></td>
                        <td style="text-align: center;"><?= $list_bkb->qty; ?></td>
                        <td style="text-align: center;"><?= $list_bkb->kodebar; ?></td>
                        <td style="text-align: center;"><?= $list_bkb->kodesub; ?></td>
                        <td style="text-align: center;"><?= $list_bkb->afd; ?></td>
                        <td style="text-align: center;"><?= $list_bkb->blok; ?></td>
                        <td style="text-align: center;"><?= $list_bkb->ket; ?></td>
                        <td style="text-align: center;"><?= $list_bkb->USER; ?></td>
                        <td style="text-align: center;"><?= $list_bkb->devisi; ?></td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
    <br>
    <i>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>
    <div style="text-align: right; ">
        <?php
        switch ($lokasi) {
            case '01':
                $posisi = 'HO';
                break;
            case '02':
                $posisi = 'RO';
                break;
            case '03':
                $posisi = 'PKS';
                break;
            default:
                $posisi = 'Sriwijaya Estate';
                break;
        }
        ?>
        <small><?= $posisi; ?>, <?= date("d M Y"); ?></small>
    </div>
    <br><br>
    <table border="0" width="100%">
        <thead>
            <?php if ($posisi !== 'Sriwijaya Estate') { ?>
                <tr>
                    <td style="text-align: center;">Disetujui Oleh, <br><br><br><br><br>(___________________) <br><br></td>
                    <td style="text-align: center;">Diperiksa, <br><br><br><br><br>(___________________) <br><br></td>
                    <td style="text-align: center;">Dicatat, <br><br><br><br><br>(___________________) <br> <br></td>
                </tr>
            <?php } else { ?>
                <tr>
                    <td style="text-align: center;">Disetujui Oleh, <br><br><br><br><br>(___________________) <br><br>G.Manager</td>
                    <td style="text-align: center;">Diperiksa, <br><br><br><br><br>(___________________) <br><br>KTU</td>
                    <td style="text-align: center;">Dicatat, <br><br><br><br><br>(___________________) <br> <br>Kasie Gudang</td>
                </tr>
            <?php } ?>
        </thead>
    </table>
</body>

</html>