<?php
// var_dump($stokmasuk);
// var_dump($masukitem);
// var_dump($po);
// exit();
?>

<head>
    <style type="text/css">
        /*body{
      padding-top:1000px;
      margin-top:1000px;
    }*/
        h4 {
            font-size: 14px;
        }

        table tr td {
            font-size: 10px;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            /*width: 50%;*/
        }

        .singleborder {
            border-collapse: collapse;
            border: 1px solid black;
        }

        body {
            font-size: 10px;
        }
    </style>
    <title>Retur BKB</title>
</head>

<body>
    <table border="0" width="100%">
        <tr>
            <td rowspan="2" width="12%"><img width="10%" height="10%" src="./assets/qrcode/retur_bkb/<?php echo $retskb->id . "_" . $retskb->noretur; ?>.png"></td>
            <td align="center" valign="bottom">
                <h4 align="center" style="margin: 0px;padding: 0px;"><b><u>RETUR BUKTI KELUAR BARANG (BKB)</u></b></h4>
            </td>
        </tr>
        <tr>
            <td align="center" valign="baseline">
                <h5 align="center" style="margin: 0px;padding: 0px 0px 10px 0px;"><b>No. Retur : <?= $retskb->norefretur; ?></b></h5>
            </td>
        </tr>
    </table>
    <table border="0" width="100%">
        <tr>
            <td>Dari</td>
            <td>:</td>
            <td><?= $retskb->bag; ?></td>
            <td>Tanggal</td>
            <td>:</td>
            <td><?= date("d-m-Y", strtotime($retskb->tgl)); ?></td>
        </tr>
        <tr>
            <td>No. BA</td>
            <td>:</td>
            <td><?= $retskb->no_ba; ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><?= $retskb->keterangan; ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

    </table>

    <table border="1" width="100%" class="singleborder" style="margin-top:7px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Qty</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($ret_skbitem as $item) {
            ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $item->kodebar; ?></td>
                    <td><?= $item->nabar; ?></td>
                    <td><?= $item->satuan; ?></td>
                    <td><?= $item->qty; ?></td>
                    <td><?= $item->ket; ?></td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <br />
    <table width="100%" style="margin-top: 7px;">
        <tr>
            <td></td>
            <td align="center">Disetujui Oleh,</td>
            <td align="center">Diketahui Oleh,</td>
            <td align="center">Diterima Oleh,</td>
        </tr>
        <tr>
            <td>
                <small>*Note</small><br />
                <small>Putih&emsp;-&emsp;pusat</small><br />
                <small>Kuning&emsp;-&emsp;Actg. Gudang</small><br />
                <small>Merah&emsp;-&emsp;Flle</small><br />
            </td>
            <td colspan="4" height="50"></td>
        </tr>
        <tr>
            <td></td>
            <td align="center">(___________________)</td>
            <td align="center">(___________________)</td>
            <td align="center">(___________________)</td>
        </tr>
    </table>

    <div style="margin-top: 7px;">
        <small><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?> <?= $this->platform->agent(); ?></i></small><br />
        <small><i>Cetakan ke - <?= $urut['cetak'] ?></i></small><br>
        <small>Print generated by MMOP Website</small>
    </div>
</body>