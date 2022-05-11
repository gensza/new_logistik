<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Verdana;
            font-size: 8px;
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
    <h3 style="margin-bottom: 0;">PT. MULIA SAWIT AGRO LESTARI</h3>
    <h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>
    <div style="text-align: center;">
        <h1>MONITORING PO VS LPB</h1>
        <h3>TAHUN : <?= date('Y') ?></h3>
    </div>
    <div>
        <i> BY System MIPS - Group By Kode Barang</i>
    </div>
    <br>
    <hr>
    <h3><?= $devisi; ?></h3>


    <table width="100%">

        <tbody>
            <?php if (empty($po)) { ?>
                <tr>
                    <td colspan="7">
                        <table class="singleborder" width="100%">
                            <thead>

                                <tr style="background-color: #d6d6c2;">
                                    <th style="width: 30%;">Kode Barang: Tidak ada data</th>
                                    <th colspan="4"> Nama Barang: Tidak ada data</th>
                                    <th colspan="2">Sat: Tidak ada data</th>
                                </tr>
                            </thead>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th style="text-align: center;">No. PO</th>
                    <th style="text-align: center;">Tanggal PO</th>
                    <th style="text-align: center;">QTY PO</th>
                    <th style="text-align: center;">No LPB</th>
                    <th style="text-align: center;">Tgl LPB</th>
                    <th style="text-align: center;">QTY LPB</th>
                    <th style="text-align: center;">Saldo</th>
                </tr>

                <tr>
                    <td style="text-align: center;">Tidak ada data</td>
                    <td style="text-align: center;">Tidak ada data</td>
                    <td style="text-align: center;">Tidak ada data</td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                    <td style="text-align: center;"></td>
                </tr>
                <tr>
                    <td style="text-align: center;" colspan="7">
                    </td>
                </tr>
                <tr>
                    <td colspan="7">

                        <table class="singleborder" border="1" width="100%">
                            <thead>

                                <tr>
                                    <th style="text-align: center;" colspan="7">SALDO</th>
                                </tr>
                            </thead>
                        </table>
                    </td>
                </tr>
                <?php } else {

                if (isset($po)) {
                    foreach ($po as $data) {
                ?>
                        <tr>
                            <td colspan="7">
                                <table class="singleborder" width="100%">
                                    <thead>

                                        <tr style="background-color: #d6d6c2;">
                                            <th style="width: 30%;">Kode Barang: <?= $data->kodebar ?></th>
                                            <th colspan="4">Nama Barang: <?= $data->nabar ?></th>
                                            <th colspan="2">Sat: <?= $data->sat ?></th>
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align: center;">No. PO</th>
                            <th style="text-align: center;">Tanggal PO</th>
                            <th style="text-align: center;">QTY PO</th>
                            <th style="text-align: center;">No LPB</th>
                            <th style="text-align: center;">Tgl LPB</th>
                            <th style="text-align: center;">QTY LPB</th>
                            <th style="text-align: center;">Saldo</th>
                        </tr>
                        <?php
                        $noref = $data->noref;
                        $query = "SELECT refpo, tglpo, noref FROM stokmasuk WHERE refpo='$noref' ORDER BY id DESC";
                        $isi = $this->db_logistik_pt->query($query)->result();

                        if (isset($isi)) {
                            foreach ($isi as $d) {
                                $noreflpb = $d->noref;
                                $refpo = $d->refpo;
                                $kodebar = $data->kodebar;
                                $lpb = "SELECT qtypo, noref, tgl, qty FROM masukitem WHERE noref='$noreflpb' AND refpo='$refpo' AND kodebar='$kodebar' ORDER BY id DESC";
                                $isilpb = $this->db_logistik_pt->query($lpb)->result();
                                foreach ($isilpb as $dt) {
                                    $saldo = $dt->qtypo - $dt->qty;
                        ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $d->refpo ?></td>
                                        <td style="text-align: center;"><?= date_format(date_create($d->tglpo), "d/m/Y"); ?></td>


                                        <td style="text-align: center;"><?= $dt->qtypo ?></td>
                                        <td style="text-align: center;"><?= $dt->noref ?></td>
                                        <td style="text-align: center;"><?= date_format(date_create($dt->tgl), "d/m/Y"); ?></td>
                                        <td style="text-align: center;"><?= $dt->qty ?></td>
                                        <td style="text-align: center;"><?= $saldo; ?></td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: center;" colspan="7">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">

                                            <table class="singleborder" border="1" width="100%">
                                                <thead>

                                                    <tr>
                                                        <th style="text-align: center;" colspan="7">SALDO</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </td>
                                    </tr>
                        <?php }
                            }
                        } ?>
            <?php }
                }
            } ?>
        </tbody>

    </table>



</body>

</html>