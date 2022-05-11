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
                <td style="text-align: left;"><small><i><br> Filter Semua PO dan LPB</i></small></td>
                <td style="text-align: right;"><small><i>Date : <?= date('d/m/Y'); ?> <br> By System MIPS &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Time : <?= date('H:i:s'); ?></i></small></td>
            </tr>
        </thead>
    </table>
    <hr>
    <hr>
    <table width="100%" rules="rows">
        <thead>
            <tr>
                <td></td>
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
                <td>35</td>
                <td>EST-POA/SWJ/JKT/07/20/6100092</td>
                <td>22/07/2020</td>
                <td>CAHAYA MAS, TOKO</td>
                <td>1025990000047 SPRING BED DOUBLE (UNIT)</td>
                <td>BIGLAND 160X200 (TANPA SANDARAN)</td>
                <td>1</td>
                <td>01/08/2020</td>
                <td>6210321</td>
                <td>1</td>
                <td>0</td>
            </tr>
            <tr>
                <td colspan="11">
                    <hr>
                </td>
            </tr>
            <tr>
                <td>36</td>
                <td>EST-POA/SWJ/JKT/07/20/6100092</td>
                <td>22/07/2020</td>
                <td>CAHAYA MAS, TOKO</td>
                <td>1025990000096 LEMARI MAKAN(UNIT)</td>
                <td>AKTIF</td>
                <td>1</td>
                <td>01/08/2020</td>
                <td>6210321</td>
                <td>1</td>
                <td>0</td>
            </tr>
            <tr>
                <td colspan="11">
                    <hr>
                </td>
            </tr>
            <tr>
                <td>37</td>
                <td>EST-POA/SWJ/JKT/07/20/6100092</td>
                <td>22/07/2020</td>
                <td>CAHAYA MAS, TOKO</td>
                <td>1025990000099 MEJA TELEVISI (UNIT)</td>
                <td>NEXA 600AKTIF</td>
                <td>2</td>
                <td>01/08/2020</td>
                <td>6210321</td>
                <td>2</td>
                <td>0</td>
            </tr>
            <tr>
                <td colspan="11">
                    <hr>
                </td>
            </tr>
            <tr>
                <td>38</td>
                <td>EST/SWJ/JKT/07/20/6100095</td>
                <td>23/07/2020</td>
                <td>KARYA HIDUP SENTOSA, CV</td>
                <td>1025100000355 BRAKE SHOE 1 SUBASSY AGC 1BBE001AY-0 (PCS)</td>
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
            <tr>
                <td>39</td>
                <td>EST/SWJ/JKT/07/20/6100095</td>
                <td>23/07/2020</td>
                <td>KARYA HIDUP SENTOSA, CV</td>
                <td>1025100000356 BRAKE SHOE 2R SUBASSY AGC 1BBE001AY-0 (PCS)</td>
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
            <tr>
                <td>40</td>
                <td>EST/SWJ/JKT/07/20/6100095</td>
                <td>23/07/2020</td>
                <td>KARYA HIDUP SENTOSA, CV</td>
                <td>1025100000371 SPEED CHANGE FORK (2-3) AGC 1BA0321BY-1 (PCS)</td>
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
</body>

</html>