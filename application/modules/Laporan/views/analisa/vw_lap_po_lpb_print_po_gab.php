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
        <h3>MONITORING PO VS LPB</h3>
        TAHUN : 2020
    </div>
    <br>
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: left;"><small><i><br> Filter PO belum LPB / Kurang</i></small></td>
                <td style="text-align: right;"><small><i>Date : <?= date('d/m/Y'); ?> <br> By System MIPS &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Time : <?= date('H:i:s'); ?></i></small></td>
            </tr>
        </thead>
    </table>
    <hr>
    <hr>
    <table width="100%" rules="rows">
        <thead>
            <tr>
                <td>Nomor PO</td>
                <td>Tanggal PO</td>
                <td>Nama Supplier</td>
                <td>Nama Barang</td>
                <td>Merk / Jenis</td>
                <td>Pembayaran</td>
                <td>Qty PO</td>
                <td>Tgl LPB</td>
                <td>No. LPB</td>
                <td>Qty LPB</td>
                <td>Selisih</td>
            </tr>
            <tr>
                <td colspan="11">
                    <hr>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>EST/SWJ/JKT/07/20/6100102</td>
                <td>24/07/2020</td>
                <td>SERBA AGUNG TEKNIK</td>
                <td>102505790000401 AMPLAS NO. 250 (LBR)</td>
                <td>-</td>
                <td>Credit 30 Hari</td>
                <td>25.00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="11">
                    <hr>
                </td>
            </tr>
            <tr>
                <td>EST/SWJ/JKT/07/20/6100102</td>
                <td>24/07/2020</td>
                <td>SERBA AGUNG TEKNIK</td>
                <td>102505790000722 AMPLAS NO. 360 (LBR)</td>
                <td>-</td>
                <td>Credit 30 Hari</td>
                <td>25.00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="11">
                    <hr>
                </td>
            </tr>
            <tr>
                <td>EST/SWJ/JKT/07/20/6100102</td>
                <td>24/07/2020</td>
                <td>SERBA AGUNG TEKNIK</td>
                <td>102505790000016 AVO METER KYORITSHU (PCS)</td>
                <td>SANWA CD800A</td>
                <td>Credit 30 Hari</td>
                <td>2.00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="11">
                    <hr>
                </td>
            </tr>
            <tr>
                <td>EST/SWJ/JKT/07/20/6100096</td>
                <td>23/07/2020</td>
                <td>KARYA HIDUP SENTOSA, CV</td>
                <td>102505790000492 BEARING SPACER AGC1AA0021AY-1 (PCS)</td>
                <td>G</td>
                <td>Cash 0 Hari</td>
                <td>2.00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="11">
                    <hr>
                </td>
            </tr>
            <tr>
                <td>EST/SWJ/JKT/07/20/6100095</td>
                <td>23/07/2020</td>
                <td>KARYA HIDUP SENTOSA, CV</td>
                <td>102505790000355 BRAKE SHOE 1 SUBASSY AGC1BBE001AY-0 (PCS)</td>
                <td>G</td>
                <td>Cash 0 Hari</td>
                <td>4.00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="11">
                    <hr>
                </td>
            </tr>
            <tr>
                <td>EST/SWJ/JKT/07/20/6100095</td>
                <td>23/07/2020</td>
                <td>KARYA HIDUP SENTOSA, CV</td>
                <td>102505790000355 BRAKE SHOE 2R SUBASSY AGC1BBE001AY-0 (PCS)</td>
                <td>G</td>
                <td>Cash 0 Hari</td>
                <td>4.00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="11">
                    <hr>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <i>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>
</body>

</html>