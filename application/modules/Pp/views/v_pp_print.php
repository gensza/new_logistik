<!DOCTYPE html>
<html>
<?php
// var_dump($data_pp);exit();
$alamat_ho = $this->session->userdata('alamat_ho');
$alamat_site = $this->session->userdata('alamat_site');
$logo_pt = $this->session->userdata('logo_pt');
$lokasi = $this->session->userdata('status_lokasi');
$nama_pt = $this->session->userdata('nama_pt');
if ($po->lokasi == 'HO') {
    $alamat_lok = $this->session->userdata('alamat_ho');
} else {
    $alamat_lok = $this->session->userdata('alamat_site');
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

        .notopborder {
            border-collapse: collapse;
            border: 1px solid black;
            border-top: 0px solid black;
        }

        .nobottomborder {
            border-collapse: collapse;
            border: 1px solid black;
            border-bottom: 0px solid black;
        }

        body {
            font-size: 10px;
        }
    </style>
    <title>Permohonan Pembayaran</title>
</head>

<body>
    <!-- <watermarkimage src="././assets/img/batal.png" alpha="0.4" size="200,250" /> -->
    <table width="100%" border="0" align="left" valign>
        <tr>
            <td align="left" style="font-size:14px;font-weight:bold;" valign="top"><?= $nama_pt  . '&nbsp;(' . $po->lokasi . ')' ?></td>
            <td rowspan="2" width="12%" align="right"><img width="5%" height="5%" src="./assets/qrcode/pp/<?= $qrcode; ?>"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <h3 style="text-align: center;text-decoration: underline;">PERMOHONAN PEMBAYARAN</h3>
            </td>
        </tr>
    </table>
    <!-- <table width="100%" border="0">
        <tr>
            <td rowspan="3" width="10%" height="10px" align="right"><img width="10%" height="60px" style="padding-left:8px" src="././assets/logo/<?= $logo_pt ?>"></td>
        <tr>
            <td align="left" style="font-size:8.5px;">
                <h3 style="font-size:14px;font-weight:bold;"> <?= $nama_pt   ?> </h3>
                <?= $alamat_lok ?>
            </td>
        </tr>
    </table> -->

    <!-- <hr style="text-align: center;"> -->
    <table class="singleborder" border="0" width="100%">
        <tr>
            <td width="13%">Nomor PP</td>
            <td width="2%">:</td>
            <td align="left"><?= $data_pp->nopp; ?></td>
            <td width="25%" style="text-align: right;">Tanggal : <?= date('d-m-Y', strtotime($data_pp->tglpp)); ?></td>
        </tr>
        <tr class="notopborder">
            <td>Nomor Order</td>
            <td>:</td>
            <td><?= $data_pp->ref_po; ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Supplier</td>
            <td>:</td>
            <td colspan="2"><?= $data_pp->kode_supplytxt . " / " . $data_pp->nama_supply; ?></td>
        </tr>
        <tr>
            <td>Kepada</td>
            <td>:</td>
            <td colspan="2"><?= $data_pp->nama_supply; ?></td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td>:</td>
            <td colspan="2">Rp <?= number_format($data_pp->jumlah, 2); ?></td>
        </tr>
        <tr>
            <td>Terbilang</td>
            <td>:</td>
            <td><?= $data_pp->terbilang; ?></td>
            <td class="nobottomborder" valign="top" rowspan="2">
                Bank &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) <br />
                Cash &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) <br />
                Cheque/Giro : (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
            </td>
        </tr>
        <tr>
            <td valign="top">Keterangan</td>
            <td valign="top">:</td>
            <td valign="top"><?= htmlspecialchars($data_pp->ket); ?></td>
        </tr>
    </table>
    <table class="notopborder" border="0" width="100%">
        <tr>
            <td align="center" valign="top" height="90">Disetujui Oleh</td>
            <td align="center" valign="top" height="90">Pemohon</td>
            <td align="center" valign="top" height="90">Dibayar Oleh</td>
            <td align="center" valign="top" height="90">Diterima Oleh</td>
        </tr>
        <tr>
            <td align="center">(___________________)</td>
            <td align="center">(___________________)</td>
            <td align="center">(___________________)</td>
            <td align="center">(___________________)</td>
        </tr>
    </table>
    <table border="0" width="100%">
        <tr>
            <td><i># Lembar 1. Accounting</i></td>
            <td><i># Lembar 2. Acc. Oficer</i></td>
            <td style="text-align: right;"><i>User Sistem : <?= $this->session->userdata('user'); ?></i></td>
        </tr>
        <tr>
            <td colspan="2"><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?>,&nbsp;<?= $this->platform->agent(); ?>,&nbsp;Cetakan Ke : <?= $data_pp->jml_cetak ?></i></td>
        </tr>
        <tr>
            <td colspan="2"><i>Print generated by MIPS</i></td>
        </tr>
        <?php if ($data_pp->batal != 0) { ?>
            <tr>
                <td style="color: crimson;" colspan="2">Alasan batal : <?= $data_pp->alasan_batal; ?></td>
            </tr>
        <?php } ?>
    </table>
    <!-- <small><i>User Sistem : <?= $this->session->userdata('user'); ?></i></small> <br />
    <small><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?> <?= $this->platform->agent(); ?></i></small><br />
    <small>Print generated by MIPS</small> -->
</body>

</html>