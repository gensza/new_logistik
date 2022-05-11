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
    if (empty($bt[0]->devisi)) {
        echo '<h2>Data tidak ditemukan pada Divisi tersebut!</h2>';
    } else {
        echo '<h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $bt[0]->devisi . '</h2>';
    }
    if ($alamat != '01') {
        echo '';
    } else {
        echo '<h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
    }
    ?>
    <div style="text-align: center;">
        <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; "><u>REGISTER KELUAR BARANG (BKB)</u></h3>
    </div>


    <?php
    foreach ($bt as $b) { ?>
        <table border="0" width="100%">
            <thead>
                <tr>
                    <td style="text-align: left;"><b> PERIODE : <?= $periode; ?> </b><br>
                        <b>Devisi : <?= $devisi; ?></b><br>
                        <?php if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') { ?>
                            <b>AFD : <?= $b->afd; ?></b>
                        <?php } else { ?>
                            <b>Bagian : <?= $bagian; ?></b>
                        <?php } ?>
                    </td>
                    <td style="text-align: right;"><br><br><i>By System MIPS</i></td>
                </tr>
            </thead>
        </table>
        <table width="100%" class="singleborder" border="1">
            <thead>
                <tr>
                    <?php if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') { ?>
                        <td style="font-weight: bold; text-align:center; width: 5%">Blok</td>
                    <?php } else { ?>
                        <td style="font-weight: bold; text-align:center; width: 5%">No</td>
                    <?php } ?>
                    <td style="font-weight: bold; text-align:center; width: 8%">Tgl</td>
                    <td style="font-weight: bold; text-align:center; width: 5%">No BKB</td>
                    <td style="font-weight: bold; text-align:center; width: 12%">Kode Barang</td>
                    <td style="font-weight: bold; text-align:center; width: 15%">Nama Barang</td>
                    <td style="font-weight: bold; text-align:center; width: 5%">Sat</td>
                    <td style="font-weight: bold; text-align:center; width: 7%">Qty</td>
                    <td style="font-weight: bold; text-align:center; width: 12%">Kode Beban</td>
                    <td style="font-weight: bold; text-align:center; width: 15%">Nama Beban</td>
                    <td style="font-weight: bold; text-align:center; width: 15%">Keterangan</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') {
                    $query = "SELECT a.*, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian' AND a.afd ='$b->afd'";
                } else {
                    $query = "SELECT a.*, b.bag FROM keluarbrgitem a, stockkeluar b WHERE a.NO_REF = b.NO_REF AND a.kode_dev = '$lokasi' AND a.periode BETWEEN '$p1' AND '$p2' AND a.batal = '0' AND b.bag = '$bagian'";
                }
                $btn = $this->db_logistik_pt->query($query)->result();
                if (empty($btn)) { ?>
                    <tr>
                        <td style="text-align: center;" colspan="10">Tidak ada data</td>
                    </tr>

                    <?php } else {
                    $no = 1;
                    foreach ($btn as $bn) { ?>
                        <tr>
                            <?php if ($bagian == 'TANAMAN' || $bagian == 'TANAMAN UMUM') { ?>
                                <td style="text-align: center;"><?= $bn->blok; ?></td>
                            <?php } else { ?>
                                <td style="font-weight: bold; text-align:center; width: 5%"><?= $no++; ?></td>
                            <?php } ?>
                            <td style="text-align: center;"><?= date_format(date_create($bn->tgl), 'd/m/Y'); ?></td>
                            <td style="text-align: center;"><?= $bn->skb; ?></td>
                            <td style="text-align: center;"><?= $bn->kodebar; ?></td>
                            <td><?= $bn->nabar; ?></td>
                            <td style="text-align: center;"><?= $bn->satuan; ?></td>
                            <td style="text-align: center;"><?= number_format($bn->qty2, 2); ?></td>
                            <td style="text-align: center;"><?= $bn->kodesubtxt; ?></td>
                            <td><?= $bn->ketsub; ?></td>
                            <td><?= $bn->ket; ?></td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
        <br>
    <?php }
    ?>
</body>

</html>