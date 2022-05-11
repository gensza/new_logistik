<head>
    <style type="text/css">
        #tabel_spp tr td {
            border: 1px solid #dddddd;
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
            border-bottom: 0px solid #FFF;
            border-top: 0px solid #FFF;
        }
    </style>
    <title>SPP - Surat Permintaan Pembelian</title>
</head>

<body>
    <?php
    if ($this->session->userdata('app_pt') == "MSAL") {
        $headTitle = "PT. MULIA SAWIT AGRO LESTARI";
        // if($ppo->kodept == 'SITE'){
        //   $k = 'ESTATE1';
        //   $k1 = "<h6 style='margin-top: 0px;'>SRIWIJAYA ESTATE</h6>";
        // }else{
        //   $k = $ppo->kodept;
        //   $k1 = "";
        //   $k1 = "<h6 style='margin-top: 0px;'>SRIWIJAYA ESTATE</h6>";
        // }
        switch ($ppo->kodept) {
            case '01':
                $lokasi = 'HO';
                $lokasi1 = 'HO';
                $nama_kebun = '';
                break;
            case '02':
                $lokasi = 'RO';
                $lokasi1 = 'RO';
                $nama_kebun = '';
                break;
            case '03':
                $lokasi = 'PKS';
                $lokasi1 = 'PKS';
                $nama_kebun = '';
                break;
            default:
                $lokasi = 'ESTATE';
                $lokasi1 = 'SITE';
                $nama_kebun = "<h6 style='margin-top: 0px;'>SRIWIJAYA ESTATE</h6>";
                break;
        }
    }
    ?>
    <h3 style="margin-bottom: 0px;"><?= $headTitle; ?> (<?= $lokasi ?>)</h3>
    <?= $nama_kebun; ?>
    <table class="singleborder" border="1" width="10%" align="right">
        <tr>
            <td align="center" style="font-size: 15px"><?= $lokasi1; ?></td>
        </tr>
    </table>
    <?php
    if ($ppo->jenis == "SPP") {
        $judul = "SURAT PERMINTAAN PEMBELIAN (SPP)";
    } else if ($ppo->jenis == "SPPI") {
        $judul = "SURAT PERMINTAAN PEMBELIAN INTERNAL (SPPI)";
    } else if ($ppo->jenis == "SPPA") {
        $judul = "SURAT PERMINTAAN PEMBELIAN ASET (SPPA)";
    }
    ?>

    <h3 align="left" style="margin-top: 0px;margin-bottom: 0px;"><?= $judul; ?></h3>
    <p align="right" style="margin-top: 0px;margin-bottom: 0px;"><small>By MIPS</small></p>
    <table class="singleborder" border="1" width="100%" id="tabel_spp">
        <tr>
            <td colspan="3">Nomor SPP Devisi : SPP - <?= $ppo->noppotxt; ?><br />
                Tanggal SPP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= date("d-m-Y", strtotime($ppo->tglppo)); ?><br />
                Tanggal Terima &nbsp;&nbsp;&nbsp;&nbsp;: <?= $ppo->tgltrm; ?><br />
                Kode Departemen : <?= $ppo->kodedept . "-" . $ppo->namadept; ?><br />
            </td>
            <td colspan="4">Nomor Referensi &nbsp;: <?= $ppo->noreftxt; ?><br />
                Tgl. Referensi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $ppo->tglref; ?><br />
                Keterangan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $ppo->ket; ?><br />
                Status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b><?= $ppo->status; ?></b><br />
            </td>
        </tr>
        <tr>
            <td align="center" colspan="7">Sesuai dengan nomor SPP diatas, terlampir perincian sebagai berikut : </td>
        </tr>
        <tr>
            <td align="center">NO.</td>
            <td align="center">KODE</td>
            <td align="center">NAMA BARANG</td>
            <td align="center">KUANTITAS</td>
            <td align="center" width="10%">SISA STOK</td>
            <td align="center">SAT</td>
            <td align="center">KETERANGAN</td>
        </tr>

        <?php
        $no = 1;
        foreach ($item_ppo as $list_item) {
        ?>
            <tr id="tr_content">
                <td class="noborder" align="center"><?= $no; ?></td>
                <td class="noborder"><?= $list_item->kodebartxt; ?></td>
                <td class="noborder"><?= $list_item->nabar; ?></td>
                <td class="noborder" align="right"><?= $list_item->qty; ?></td>
                <td class="noborder" align="right"><?= $list_item->STOK ?></td>
                <td class="noborder" align="center"><?= $list_item->sat; ?></td>
                <td class="noborder"><?= $list_item->ket; ?></td>
            </tr>
        <?php
            $no++;
        }
        ?>
        <tr>
            <td colspan="2" align="center">Diminta,</td>
            <td colspan="1" align="center">Diperiksa,</td>
            <td colspan="3" align="center">Disetujui,</td>
            <td colspan="1" align="center">Dibuat Oleh,</td>
        </tr>
        <tr>
            <td colspan="2" align="center" height="50" valign="bottom">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
            <td colspan="1" align="center" height="50" valign="bottom">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
            <td colspan="3" align="center" height="50" valign="bottom">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
            <td colspan="1" align="center" height="50" valign="bottom">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
        </tr>
    </table>
    <small><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?> <?= $this->platform->agent(); ?></i></small>
</body>