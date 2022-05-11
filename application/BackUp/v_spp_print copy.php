<head>
    <style type="text/css">
        /*body{
      padding-top:1000px;
      margin-top:1000px;
    }*/
        /*h4 {
      font-size: 14px;
    }*/
        #tabel_spp tr td {
            /*font-size: 12px;*/
            border: 1px solid #dddddd;
            padding: 5px;

        }

        body {
            font-family: Verdana;
            font-size: 8px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 20px;
        }

        .singleborder {
            border-collapse: collapse;
            border: 1px solid black;
        }

        #tr_content td.noborder {
            /*border: none;*/
            border-bottom: 0px solid #FFF;
            border-top: 0px solid #FFF;


        }

        .warna_sebagian {
            background-color: gray;
        }

        div.b {

            white-space: pre-wrap;
            /* CSS3 */
            white-space: -moz-pre-wrap;
            /* Firefox */
            white-space: -pre-wrap;
            /* Opera <7 */
            white-space: -o-pre-wrap;
            /* Opera 7 */
            word-wrap: break-word;
            /* IE */

        }
    </style>
    <title>SPP - Surat Permintaan Pembelian</title>
</head>

<body>
    <table class="singleborder" border="1" width="10%" align="right">
        <tr>
            <td align="center" style="font-size: 15px"><?= $ppo->lokasi; ?></td>
        </tr>
    </table>
    <h3 align="left" style="margin-top: 0px;margin-bottom: 0px;">SURAT PERMINTAAN PEMBELIAN (SPP)</h3>
    <p align="right" style="margin-top: 0px;margin-bottom: 0px;"><small>By MIPS</small></p>
    <table class="singleborder" border="1" width="100%" id="tabel_spp">

        <tr>
            <td class="noborder">Nomor SPP Divisi &nbsp;&nbsp;: SPP - <?= $ppo->noppotxt; ?></td>
            <td class="noborder">Nomor Referensi &nbsp;: <?= $ppo->noreftxt; ?></td>
        </tr>
        <tr>
            <td class="noborder">Tanggal SPP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= date("d-m-Y", strtotime($ppo->tglppo)); ?></td>
            <td class="noborder">Tgl. Referensi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= date("d-m-Y", strtotime($ppo->tglref)); ?></td>
        </tr>
        <tr>
            <td class="noborder">Tanggal Terima &nbsp;&nbsp;&nbsp;&nbsp;: <?= date("d-m-Y", strtotime($ppo->tgltrm)); ?></td>
            <td class="noborder" width="50%" style="word-break:break-all;">Keterangan :<br><?= $ppo->ket; ?> </td>
        </tr>
        <tr>
            <td class="noborder">Kode Departemen : <?= $ppo->kodedept . "-" . $ppo->namadept; ?></td>
            <td class="noborder">Status : <b><?= $ppo->status; ?></td>
        </tr>

    </table>
    <table width="100%" border="1" class="singleborder" border="1" id="tabel_spp">

        <tr>
            <td align="center" colspan="7">Sesuai dengan nomor SPP diatas, terlampir perincian sebagai berikut : </td>
        </tr>
    </table>
    <table class="singleborder" border="1" width="100%" id="tabel_spp">
        <thead>
            <tr>
                <td align="center">NO.</td>
                <td align="center">KODE BARANG</td>
                <td align="center">NAMA BARANG</td>
                <td align="center">KUANTITAS</td>
                <td align="center">SISA STOK</td>
                <td align="center">SAT</td>
                <td align="center">KETERANGAN</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($item_ppo as $list_item) {
                $d = $list_item->ket;
                $journalName = str_replace(' ', '%20', $d);
            ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $list_item->kodebartxt; ?></td>
                    <td><?= $list_item->nabar; ?></td>
                    <td><?= $list_item->qty; ?></td>
                    <td><?= $list_item->STOK ?></td>
                    <td><?= $list_item->sat; ?></td>
                    <td>
                        <div class="b"> <?= $journalName; ?></div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


    <table class="singleborder" border="1" width="100%" id="tabel_spp">

        <thead>


            <tr>
                <td align="center">NO.</td>
                <td align="center">KODE BARANG</td>
                <td align="center" width="15%">NAMA BARANG</td>
                <td align="center">KUANTITAS</td>
                <td align="center">SISA STOK</td>
                <td align="center">SAT</td>
                <td align="center" width="30%">KETERANGAN</td>
            </tr>
        </thead>
        <tbody>

            <?php
            $no = 1;
            foreach ($item_ppo as $list_item) {
                if ($ppo->status2 == 2) {
                    if ($list_item->status2 == 0) {
            ?>
                        <tr id="tr_content">
                            <td class="noborder" align="center"><?= $no; ?></td>
                            <td class="noborder warna_sebagian"><?= $list_item->kodebartxt; ?></td>
                            <td class="noborder"><?= $list_item->nabar; ?></td>
                            <td class="noborder" align="center"><?= $list_item->qty; ?></td>
                            <td class="noborder" align="center"><?= $list_item->STOK ?></td>
                            <td class="noborder" align="center"><?= $list_item->sat; ?></td>
                            <td class="noborder"> <span><?= $list_item->ket; ?></span> </td>
                        </tr>
                    <?php
                    } else {
                    ?>
                        <tr id="tr_content">
                            <td class="noborder" align="center"><?= $no; ?></td>
                            <td class="noborder"><?= $list_item->kodebartxt; ?></td>
                            <td class="noborder"><?= $list_item->nabar; ?></td>
                            <td class="noborder" align="center"><?= $list_item->qty; ?></td>
                            <td class="noborder" align="center"><?= $list_item->STOK ?></td>
                            <td class="noborder" align="center"><?= $list_item->sat; ?></td>
                            <td class="noborder"> <span><?= $list_item->ket; ?></span> </td>
                        </tr>
                    <?php
                    }
                } elseif ($ppo->status2 == 0) {
                    ?>
                    <tr id="tr_content">
                        <td class="noborder" align="center"><?= $no; ?></td>
                        <td class="noborder"><?= $list_item->kodebartxt; ?></td>
                        <td class="noborder"><?= $list_item->nabar; ?></td>
                        <td class="noborder" align="center"><?= $list_item->qty; ?></td>
                        <td class="noborder" align="center"><?= $list_item->STOK ?></td>
                        <td class="noborder" align="center"><?= $list_item->sat; ?></td>
                        <td class="noborder"> <span><?= $list_item->ket; ?></span> </td>
                    </tr>
                <?php
                } else {
                ?>
                    <tr id="tr_content">
                        <td class="noborder" align="center"><?= $no; ?></td>
                        <td class="noborder"><?= $list_item->kodebartxt; ?></td>
                        <td class="noborder"><?= $list_item->nabar; ?></td>
                        <td class="noborder" align="center"><?= $list_item->qty; ?></td>
                        <td class="noborder" align="center"><?= $list_item->STOK ?></td>
                        <td class="noborder" align="center"><?= $list_item->sat; ?></td>
                        <td class="noborder"> <span><?= $list_item->ket; ?></span> </td>
                    </tr>
            <?php
                }
                $no++;
            }
            ?>
        </tbody>

        <tr>
            <td colspan="2" align="center">Diminta,</td>
            <td colspan="1" align="center">Diperiksa,</td>
            <td colspan="1" align="center">Diketahui,</td>
            <td colspan="2" align="center">Disetujui,</td>
            <td colspan="1" align="center">Dibuat Oleh,</td>
        </tr>
        <tr>
            <td colspan="2" align="center" height="70" valign="bottom">(<?= $ppo->user ?>)</td>
            <td colspan="1" align="center" height="70" valign="bottom">
                <?php if ($ppo->status2 == 1) {
                ?>
                    <img src="././assets/img/approved2.png" width="15%">
                <?php
                } else {
                }
                ?>
                <br><?= 'KTU'; ?><br>
            </td>
            <td colspan="1" align="center" height="70" valign="bottom">
                <?php if ($ppo->status2 == 1) {
                ?>
                    <img src="././assets/img/approved2.png" width="15%"><br>
                <?php
                } else {
                }
                ?>
                <?= 'GM'; ?><br>
            </td>
            <td colspan="2" align="center" height="70" valign="bottom">
                <?php if ($ppo->status2 == 1) {
                ?>
                    <img src="././assets/img/approved2.png" width="15%"><br>
                <?php
                } else {
                }
                ?>
                <?= 'Dept Head'; ?><br>
            </td>
            <td colspan="1" align="center" height="70" valign="bottom">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
        </tr>
    </table>
    <small><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?> <?= $this->platform->agent(); ?></i></small> -
    <small><i>Cetakan ke - <?= $urut['main_acct'] ?></i></small><br>
    <small>Abu-abu : Dalam proses</small>
</body>