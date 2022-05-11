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
    <table border="0">
        <tr>
            <td><img height="55px" src="<?= base_url(); ?>assets/img/msal.png" alt="" srcset=""></td>
            <td>
                <h2>PT. MULIA SAWIT AGRO LESTARI</h2>
                Jl. Radio Dalam Raya No. 87 A. RT. 005/RW.014 Gandaria Utara
                <br>Kebayoran Baru, Jakarta Selatan, DKI Jakarta Raya-12140
            </td>
            <td style="padding-left: 25%;">
                Putih&nbsp;&nbsp;&nbsp;&nbsp;: Finance HO <br>
                Merah &nbsp;: Accounting HO <br>
                Kuning : Gudang EST <br>
                Hijau &nbsp;&nbsp;&nbsp;: Accounting EST <br>
                Biru &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Purchasing HO
            </td>
        </tr>
    </table>
    <hr style="height: 3px; color: black;">
    <div style="text-align: center;">
        <h2>Laporan Penerimaan Barang (LPB)</h2>No. LPB : <?= $lpb->noref; ?>
    </div>
    <br>
    <table border="0">
        <tr>
            <td style="width: 15%">Nama Supplier</td>
            <td style="width: 3%;">:</td>
            <td style="width: 39%"><?= $lpb->nama_supply; ?></td>
            <td style="width: 20%;">No. Pesanan Pembelian</td>
            <td style="width: 3%;">:</td>
            <td style="width: 20%;"><?= $lpb->refpo; ?></td>
        </tr>
        <tr>
            <td>Surat Pengantar No</td>
            <td>:</td>
            <td>-</td>
            <td>Tanggal Penerimaan</td>
            <td>:</td>
            <td><?= date_format(date_create($lpb->tgl), "d/m/Y"); ?></td>
        </tr>
        <tr>
            <td>Lokasi Gudang</td>
            <td>:</td>
            <td><?= $lpb->lokasi_gudang; ?></td>
            <td>Tanggal Pembukaan LPB</td>
            <td>:</td>
            <td><?= date_format(date_create($lpb->tglinput), "d/m/Y"); ?></td>
        </tr>
        <tr>
            <td>Alokasi</td>
            <td>:</td>
            <td><?= $lpb->lokasi; ?></td>
            <td>No Perkiraan</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Departemen / Devisi</td>
            <td>:</td>
            <td><?= $lpb->ket_dept; ?></td>
            <td>Cetakan ke</td>
            <td>:</td>
            <td><?= $lpb->cetak; ?></td>
        </tr>
    </table>
    <br><br>
    <table class="singleborder" border="1" width="100%">
        <thead>
            <tr>
                <td style="text-align: center; width: 10%;">No</td>
                <td style="text-align: center; width: 10%;">KODE BRG</td>
                <td style="text-align: center; width: 10%;">Nama Barang</td>
                <td style="text-align: center; width: 10%;">QTY</td>
                <td style="text-align: center; width: 10%;">Satuan </td>
                <td style="text-align: center; width: 10%;">Keterangan</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($lpb_item as $list_lpb_item) { ?>
                <tr>
                    <td style="text-align: center;"><?= $no++; ?></td>
                    <td><?= $list_lpb_item->kodebar; ?></td>
                    <td><?= $list_lpb_item->nabar; ?></td>
                    <td style="text-align: center;"><?= $list_lpb_item->qty; ?></td>
                    <td style="text-align: center;"><?= $list_lpb_item->satuan; ?></td>
                    <td><?= $list_lpb_item->ket; ?></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
    <br>
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: center;">Diperiksa, <br><br><br><br><br>(___________________)</td>
                <td style="text-align: center;">Menyetujui, <br><br><br><br><br>(___________________)</td>
                <td style="text-align: center;">Penerima, <br><br><br><br><br>(___________________)</td>
                <td style="text-align: center;">Pengirim, <br><br><br><br><br>(___________________)</td>
            </tr>
        </thead>
    </table>
    <br>
    *NB : harap dikembalikan ke pemilik barang dan dibawa pada waktu penagihan <br>
    *Coret yang tidak perlu
    <br>
    <br>
    <small> <i> dicetak : <?= date('d/m/Y H:i:s'); ?></i></small>
</body>

</html>