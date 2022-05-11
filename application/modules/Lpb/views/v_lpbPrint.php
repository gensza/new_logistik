<?php
if ($this->session->userdata('app_pt') == 'MSAL') {
    $dev = substr($stokmasuk->devisi, 28); // MSAL
} elseif ($this->session->userdata('app_pt') == 'PSAM') {
    $dev = substr($stokmasuk->devisi, 33); // PSAM
} elseif ($this->session->userdata('app_pt') == 'PEAK') {
    $dev = substr($stokmasuk->devisi, 28); // PEAK
} elseif ($this->session->userdata('app_pt') == 'MAPA') {
    $dev = substr($stokmasuk->devisi, 29); // MAPA
} elseif ($this->session->userdata('app_pt') == 'KPP') {
    $dev = substr($stokmasuk->devisi, 25); // KPP
}

if ($stokmasuk->lokasi == 'HO') {
    $alamat_lok = $this->session->userdata('alamat_ho');
} else {
    $alamat_lok = $this->session->userdata('alamat_site');;
}


$logo_pt = $this->session->userdata('logo_pt');
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

        .pddg {
            padding: 3px;
        }

        .pddg2 {
            padding: 5px;
        }

        .cntr {
            text-align: center;
        }
    </style>
    <title>Laporan Penerimaan Barang </title>
</head>

<body>
    <table width="100%" border="0" align="center" style="margin-bottom: 5px;">
        <tr>
            <td rowspan="5" width="11%" height="10px"><img width="10%" height="60px" style="padding-left: 0px" src="././assets/logo/<?= $logo_pt ?>"></td>
            <td rowspan="5" align="left" style="vertical-align: text-top; padding-top:10px; font-size:8.5px;">
                <b style="font-size:14px"><?= $stokmasuk->pt  ?></b> <br>
                <?= $alamat_lok ?>
            </td>
            <td>Putih</td>
            <td>:</td>
            <td>Finance HO</td>
        </tr>
        <!--tr>
            <td align="center" rowspan="5">Jl. Radio Dalam Raya No.87A, RT.005/RW.014, Gandaria Utara, Kebayoran Baru,  JakartaSelatan, DKI Jakarta Raya-12140 <br /> Telp : 021-7231999, 7202418 (Hunting) <br /> Fax : 021-7231819
            </td>
        </tr-->
        <tr>
            <td style="padding-top: -5px;">Merah</td>
            <td style="padding-top: -5px;">:</td>
            <td style="padding-top: -5px;">Accounting HO</td>
        </tr>
        <tr>
            <td style="padding-top: -5px;">Kuning</td>
            <td style="padding-top: -5px;">:</td>
            <td style="padding-top: -5px;">Gudang Est</td>
        </tr>
        <tr>
            <td style="padding-top: -5px;">Hijau</td>
            <td style="padding-top: -5px;">:</td>
            <td style="padding-top: -5px;">Accounting Est</td>
        </tr>
        <tr>
            <td style="padding-top: -5px;">Biru</td>
            <td style="padding-top: -5px;">:</td>
            <td style="padding-top: -5px;">Purchasing HO</td>
        </tr>
    </table>

    <hr style="width:100%;margin:0px; margin-bottom: 0%;">
    <table border="0 " width="100%">
        <tr>
            <td rowspan="2" width="12%"><img width="5%" height="5%" src="./assets/qrcode/lpb/<?php echo $id . "_" . $no_lpb; ?>.png"></td>
            <td align="center" valign="bottom">
                <h2 align="center" style="margin: 0px;padding: 0px;"><b><u>Laporan Penerimaan Barang</u></b></h2>
            </td>
            <td></td>
        </tr>
        <tr>
            <td align="center" valign="baseline">
                <h3 align="center" style="margin: 0px;padding: 0px 0px 10px 0px;"><b>No. LPB : <?= $stokmasuk->noref; ?></b></h3>
            </td>
            <td width="8%"></td>
        </tr>
    </table>
    <table border="0" width="100%">
        <tr>
            <td width="18%">Nama Supplier</td>
            <td width="2%">:</td>
            <td width="25%"><?= $stokmasuk->nama_supply; ?></td>
            <td width="20%">No. Pesanan Pembelian</td>
            <td width="2%">:</td>
            <td><?= $stokmasuk->refpo; ?></td>
        </tr>
        <tr>
            <td>Surat Pengantar No.</td>
            <td>:</td>
            <td><?= htmlspecialchars($stokmasuk->no_pengtr); ?></td>
            <td>Tanggal Penerimaan</td>
            <td>:</td>
            <td><?= date("d-m-Y", strtotime($stokmasuk->tgl)); ?></td>
        </tr>
        <tr>
            <td>Lokasi Gudang</td>
            <td>:</td>
            <td><?= htmlspecialchars($stokmasuk->lokasi_gudang); ?></td>
            <td>Tgl. Pembuatan LPB</td>
            <td>:</td>
            <td><?= date("d-m-Y", strtotime($stokmasuk->tglinput)); ?></td>
        </tr>
        <tr>
            <td>Alokasi</td>
            <td>:</td>
            <td><?= $lokasilpb . ' ' . $dev ?></td>
            <td>No. Perkiraan</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Departemen</td>
            <td>:</td>
            <td><?= $stokmasuk->ket_dept; ?></td>
            <td>Keterangan</td>
            <td>:</td>
            <td><?= htmlspecialchars($stokmasuk->ket); ?></td>
        </tr>
    </table>

    <table border="1" width="100%" class="singleborder">
        <thead>
            <tr>
                <th width="5%" class="pddg2">No</th>
                <th width="15%" class="pddg2">Kode Barang</th>
                <th width="34%" class="pddg2">Nama Barang</th>
                <th width="8%" class="pddg2">Qty</th>
                <th width="8%" class="pddg2">Satuan</th>
                <th width="30%" class="pddg2">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($masukitem as $list_masukitem) {
            ?>
                <tr>
                    <td class="pddg cntr"><?= $no; ?></td>
                    <td class="pddg"><?= $list_masukitem->kodebartxt; ?></td>
                    <td class="pddg"><?= $list_masukitem->nabar; ?></td>
                    <td class="pddg cntr"><?= $list_masukitem->qty; ?></td>
                    <td class="pddg cntr"><?= $list_masukitem->satuan; ?></td>
                    <td class="pddg"><?= htmlspecialchars($list_masukitem->ket); ?></td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <br />
    <table width="100%">
        <tr>
            <td align="center">Diperiksa,</td>
            <td align="center">Menyetujui,</td>
            <td align="center">Penerima,</td>
            <td align="center">Pengirim,</td>
        </tr>
        <tr>
            <td colspan="4" height="50"></td>
        </tr>
        <tr>
            <td align="center">(___________________)</td>
            <td align="center">(___________________)</td>
            <td align="center">(___________________)</td>
            <td align="center">(___________________)</td>
        </tr>
    </table>

    <small>*NB : harap dikembalikan ke pemilik barang dan dibawa pada waktu penagihan</small><br />
    <small>*Coret yang tidak perlu</small><br />

    <small><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?> <?= $this->platform->agent(); ?></i></small><br />
    <small><i>Cetakan ke - <?= $urut['cetak'] ?></i></small><br>
    <small>By MIPS LOGISTIK</small><br>
    <?php if ($stokmasuk->BATAL == 1) { ?>
        <small style="color: crimson;">Alasan batal : <?= $stokmasuk->alasan_batal; ?></small>
    <?php } else { ?>
        <small style="color: crimson;">Revisi : <?= $stokmasuk->alasan_batal; ?></small>
    <?php } ?>
</body>