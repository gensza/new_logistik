<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Pembayaran (PP)</title>
    <style>
        body {
            font-family: Verdana;
            font-size: 8px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 20px;
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
    <h3 style="margin-bottom: 0;"><?= $pp->pt; ?></h3>
    <div style="text-align: center;">
        <h1>PERMOHONAN PEMBAYARAN (PP)</h1>
        <p align="right" style="margin-top: 0px;margin-bottom: 0px;"><small>By MIPS</small></p>
        <table class="" border="1" width="100%">
            <tr>
                <td colspan="4">
                    <table border="0" width="100%">
                        <tr>
                            <td style="width: 10%;">Nomor PP</td>
                            <td style="width: 3%;">:</td>
                            <td style="width: 70%;"><?= $pp->nopp; ?></td>
                            <td style="text-align: right; width: 17%;">Tanggal : <?= date_format((date_create($pp->tglpp)), "d-m-Y"); ?></td>
                        </tr>
                        <tr>
                            <td>Nomor Order</td>
                            <td>:</td>
                            <td><?= $pp->ref_po; ?></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table border="0" width="100%">
                        <tr>
                            <td style="width: 14%;">Kode Suplier PP</td>
                            <td style="width: 3%;">:</td>
                            <td style="width: 83%;" colspan="2"><?= $pp->kode_supply; ?> / <?= $pp->nama_supply; ?></td>
                        </tr>
                        <tr>
                            <td>Kepada</td>
                            <td>:</td>
                            <td colspan="2"><?= $pp->kepada; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>:</td>
                            <td colspan="2">Rp <?= number_format($pp->jumlah, 2); ?></td>
                        </tr>
                        <tr>
                            <td>Terbilang</td>
                            <td>:</td>
                            <td colspan="2"># <?= $pp->terbilang; ?> RUPIAH#</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td style="width: 55%;">Isi oksigen u/ workshop 1 dan 2 (SPPI)</td>
                            <td>
                                <table border="0" width="100%" rules="cols">
                                    <tr>
                                        <td>Bank</td>
                                        <td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
                                    </tr>
                                    <tr>
                                        <td>Cash</td>
                                        <td>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
                                    </tr>
                                    <tr>
                                        <td>Cheque/Giro</td>
                                        <td>:</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <hr>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">Disetujui <br><br><br><br><br><br><br><br><br></td>
                <td style="text-align: center;">Pemohon</td>
                <td style="text-align: center;">Dibayar Oleh</td>
                <td style="text-align: center;">Diterima Oleh</td>
            </tr>


        </table>
    </div>
</body>
</body>

</html>