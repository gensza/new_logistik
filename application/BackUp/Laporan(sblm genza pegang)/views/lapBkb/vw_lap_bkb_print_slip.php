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
    <h2 style="margin-bottom: 0;"><?= $slip_bkb->pt; ?></h2>
    <h5 style="margin-top: 5px;">
        <?php
        if ($slip_bkb->kode == '01' || $slip_bkb->kode == '02' || $slip_bkb->kode == '03') echo '';
        else echo 'SRIWIJAYA ESTATE';
        ?>
    </h5>
    <div style="text-align: center;">
        <h3><u>BUKTI KELUAR BARANG (BKB)</u></h3>
        No : <?= $slip_bkb->skb . '/BKB/' . date_format(date_create($slip_bkb->tgl), "m/Y"); ?>
    </div>
    <br>
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: left;"><i>Depart/Devisi : <?= $slip_bkb->bag; ?> /
                        <?php
                        if ($slip_bkb->kode == '01' || $slip_bkb->kode == '02' || $slip_bkb->kode == '03') echo $slip_bkb->alokasi;
                        else echo 'Est : ' . $slip_bkb->alokasi;
                        ?>
                    </i></td>
                <td style="text-align: right;">PERIODE : <?= date_format(date_create($tgl1), "d/m/Y") . " - " . date_format(date_create($tgl2), "d/m/Y"); ?></td>
            </tr>
        </thead>
    </table>
    <br>
    <table width="100%" border="1" class="singleborder">
        <thead style="text-align: center;">
            <tr>
                <td rowspan="2">No</td>
                <td rowspan="2">No. Kode Barang</td>
                <td rowspan="2">Nama/Spesifikasi Barang</td>
                <td rowspan="2">Sat</td>
                <td colspan="2">Jumlah</td>
                <td rowspan="2">Kode Beban</td>
                <td rowspan="2">Blok</td>
                <td rowspan="2">Keterangan</td>
            </tr>
            <tr>
                <td>Diminta</td>
                <td>Dikeluarkan</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = "SELECT * FROM keluarbrgitem WHERE NO_REF = '$slip_bkb->NO_REF' AND skb ='$slip_bkb->skb' AND tgl BETWEEN '$tgl1' AND '$tgl2'";
            $slip = $this->db_logistik_pt->query($query)->result();
            foreach ($slip as $l_slip) { ?>
                <tr>
                    <td style="text-align: center;"><?= $no++; ?></td>
                    <td style="text-align: center;"><?= $l_slip->kodebar; ?></td>
                    <td><?= $l_slip->nabar; ?></td>
                    <td style="text-align: center;"><?= $l_slip->satuan; ?></td>
                    <td style="text-align: right;"><?= number_format($l_slip->qty, 2); ?></td>
                    <td style="text-align: right;"><?= number_format($l_slip->qty2, 2); ?></td>
                    <td style="text-align: center;"><?= $l_slip->kodebeban; ?></td>
                    <td style="text-align: center;"><?= $l_slip->blok; ?></td>
                    <td><?= $l_slip->ket; ?></td>
                </tr>
            <?php } ?>

            <tr>
                <td colspan="2"> Distribusi: <br> - Ke 1 - Kantor Kebun/PKS <br>- Ke 2 - Gudang</td>
                <td colspan="7">
                    <table border="0" width="100%">
                        <thead>
                            <tr>
                                <td style="text-align: center;">Dibukukan Oleh, <br><br><br><br><br>(___________________) <br><br>Kasie Pembukuan</td>
                                <td style="text-align: center;">Diperiksa, <br><br><br><br><br>(___________________) <br><br>KTU</td>
                                <td style="text-align: center;">Dibuat Oleh, <br><br><br><br><br>(___________________) <br> <br>Kasie Gudang</td>
                                <td style="text-align: center;">Diterima Oleh, <br><br><br><br><br>(___________________)</td>
                                <td style="text-align: center;">Nomor BPB, <br><br><br><?= $slip_bkb->nobpb; ?></td>
                            </tr>
                        </thead>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <i>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>
</body>

</html>