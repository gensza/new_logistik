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
        <h3>MONITORING PO VS LPB (cash)</h3>
        TAHUN : 2020
    </div>
    <br>
    <table border="0" width="100%">
        <thead>
            <tr>
                <td style="text-align: left;"><small><i><br> Filter PO belum LPB / Sebagian</i></small></td>
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
                <td>EST/SWJ/JKT/07/20/6100061</td>
                <td>09/07/2020</td>
                <td>TAUFIK, TOKO</td>
                <td>102505930000010 PANCI (PCS)</td>
                <td>24 JAWA</td>
                <td style="color: red;">80</td>
                <td>10/07/2020</td>
                <td>6210194</td>
                <td>56.00</td>
                <td style="color: red;">24.00</td>
            </tr>
            <tr>
                <td colspan="11">
                    <hr>
                </td>
            </tr>
            <tr>
                <td>EST-POA/SWJ/JKT/07/20/6100087</td>
                <td>20/07/2020</td>
                <td>INOAC, TOKO</td>
                <td>102505990000040 KASUR (BH)</td>
                <td>INOAC UK, 120X200T, 15 CM</td>
                <td>20</td>
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
                <td>EST-POA/SWJ/JKT/07/20/6100090</td>
                <td>22/07/2020</td>
                <td>NOORHASAN, TOKO</td>
                <td>102505990000023 DISPENSER (UNIT)</td>
                <td>MIYAKO - GALON</td>
                <td>2</td>
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
                <td>EST-POA/SWJ/JKT/07/20/6100090</td>
                <td>22/07/2020</td>
                <td>NOORHASAN, TOKO</td>
                <td>102505990000037 KIPAS ANGIN (BH)</td>
                <td>MIYAKO - WALL</td>
                <td>4</td>
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
                <td>EST-POA/SWJ/JKT/07/20/6100090</td>
                <td>22/07/2020</td>
                <td>NOORHASAN, TOKO</td>
                <td>102505990000265 JEMURAN PAKAIAN (BH)</td>
                <td>LOKAL UK, 2 MTR</td>
                <td>2</td>
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
                <td>EST-POA/SWJ/JKT/07/20/6100091</td>
                <td>22/07/2020</td>
                <td>MAULANA MEUBLE, TOKO</td>
                <td>102505990000016 GULING (BH)</td>
                <td>DACRON</td>
                <td>20</td>
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
                <td>EST-POA/SWJ/JKT/07/20/6100091</td>
                <td>22/07/2020</td>
                <td>MAULANA MEUBLE, TOKO</td>
                <td>102505990000070 SPREI SPRING BED SINGLE (BH)</td>
                <td>CALIFORNIA 120X200</td>
                <td>20</td>
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
                <td>102505100000355 BRAKE SHOE 1 SUBASSY AGC 1B BEE001AY-0 (PCS)</td>
                <td>G</td>
                <td>4</td>
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