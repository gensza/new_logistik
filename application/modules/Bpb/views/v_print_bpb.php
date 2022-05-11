<?php
// var_dump($bpb);exit();
$alamat_ho = $this->session->userdata('alamat_ho');
$alamat_site = $this->session->userdata('alamat_site');
$logo_pt = $this->session->userdata('logo_pt');
$lokasi = $this->session->userdata('status_lokasi');
$nama_pt = $this->session->userdata('nama_pt');
$statusmutasi = $bpb->status_mutasi;
if ($statusmutasi == 1) {
    $mutasi = "Mutasi";
} else if ($statusmutasi == 2) {
    $mutasi = "Mutasi Lokal";
    # code...
} else {
    $mutasi = "";
    # code...
}

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
    <title>Bon Permintaan Barang</title>
</head>

<body>
    <table width="100%" border="0" align="center">
        <tr>
            <td align="center">
                <h3 style="font-size:14px;font-weight:bold;"> <?= $bpb->devisi   ?> </h3>
            </td>
        </tr>

    </table>
    <hr style="width:100%;margin:0px;">
    <table border="0" width="90%">
        <tr>
            <td rowspan="2" width="12%"><img width="7%" height="7%" src="./assets/qrcode/bpb/<?php echo $id . "_" . $no_bpb; ?>.png"></td>
            <td align="center" valign="bottom">
                <h2 align="center" style="margin: 0px;padding: 0px; font-size: 12px;">Bon Permintaan Barang <?= $mutasi; ?></h2>
            </td>
        </tr>
        <tr>
            <td align="center" valign="top">
                <h3 align="center" style="font-weight: normal;margin-top: -8px; margin-bottom:0px; font-size: 10px;">No. Ref BPB : <?= $bpb->norefbpb; ?></h3>
            </td>
        </tr>
    </table>
    <table width="100%" style="margin-top: 5px;">
        <tr>
            <td>Depart/Divisi : <?= $bpb->bag; ?></td>
            <td align="right">Tanggal : <?= date("d-m-Y", strtotime($bpb->tglbpb)); ?></td>
        </tr>
    </table>
    <table class="singleborder" border="1" width="100%">
        <tr>
            <td align="center" class="pddg" width="5%">No</td>
            <td align="center" class="pddg" width="15%">Kode Barang</td>
            <td align="center" class="pddg" width="22%">Nama / Spesifikasi Barang</td>
            <td align="center" class="pddg" width="5%">Sat</td>
            <td align="center" class="pddg">Jumlah Diminta</td>
            <td align="center" class="pddg">Kode Beban</td>
            <td align="center" class="pddg">Blok</td>
            <td align="center" class="pddg" width="12%">Keterangan</td>
        </tr>
        <?php
        $no = 1;
        foreach ($bpbitem as $listbpbitem) {
            // var_dump($keluarbrgitem);exit();
        ?>
            <tr>
                <td class="cntr"><?= $no++ ?></td>
                <td class="pddg"><?= $listbpbitem->kodebar; ?></td>
                <td class="pddg"><?= $listbpbitem->nabar; ?></td>
                <td class="pddg"><?= $listbpbitem->satuan; ?></td>
                <td class="cntr"><?= $listbpbitem->qty; ?></td>
                <td class="pddg"><?= $listbpbitem->kodesubtxt; ?></td>
                <td class="pddg"><?= $listbpbitem->blok; ?></td>
                <td class="pddg"><?= $listbpbitem->ket; ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="2">
                Distribusi :<br />
                -Ke 1 - Kantor Kebun/PKS<br />
                -Ke 2 - Gudang
            </td>
            <td colspan="6">
                <table border="0" width="100%">
                    <tr>
                        <!-- <td align="center">Diminta Oleh,</td> -->
                        <!-- <td align="center">Dibukukan,</td> -->
                        <td align="center">Diajukan oleh,</td>
                        <td align="center">Diperiksa,</td>
                        <td align="center">Diterima oleh,</td>
                    </tr>
                    <tr>
                        <td colspan="4" height="50"></td>
                    </tr>
                    <tr>
                        <!-- <td align="center">(___________________)</td> -->
                        <td align="center">(___________________)</td>
                        <?php if ($bpb->approval != 1) { ?>
                            <td align="center">(___________________)</td>
                        <?php } else { ?>
                            <td align="center"><img src="././assets/img/approved2.png" width="15%"><br></td>
                        <?php } ?>
                        <td align="center">(___________________)</td>
                    </tr>
                    <tr>
                        <?php $tgl = "";
                        foreach ($bpb_approval as $app) : ?>
                            <?php $tgl = $app->tgl_ktu; ?>
                        <?php endforeach; ?>
                        <td align="center" valign="top"><?= $bpb->user; ?></td>
                        <td align="center">KTU<br><?= $tgl; ?></td>

                        <!-- <td align="center">Kasie Gudang</td> -->
                        <td align="center"><br><br></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table border="0" width="100%">
        <tr>
            <td colspan="2"><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?>,&nbsp;<?= $this->platform->agent(); ?></i></td>
            <td style="text-align: right;"><i>User Sistem : <?= $this->session->userdata('user'); ?></i></td>
        </tr>
        <tr>
            <td colspan="2"><i>Cetakan Ke : <?= $bpb->jml_cetak ?></i></td>
        </tr>
        <tr>
            <td colspan="2"><i>Print generated by MIPS</i></td>
        </tr>
        <?php if ($bpb->batal != 0) { ?>
            <tr>
                <td style="color: crimson;" colspan="2">Alasan batal : <?= $bpb->alasan_batal; ?></td>
            </tr>
        <?php } ?>
    </table>
    <!-- <small><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?> <?= $this->platform->agent(); ?></i></small><br />
    <p style="padding: 0px;margin: 0px;"><small><i>Cetakan Ke : <?= $bpb->jml_cetak ?></i></small><br />
        <small>Print generated by MIPS</small>
    </p> -->
</body>