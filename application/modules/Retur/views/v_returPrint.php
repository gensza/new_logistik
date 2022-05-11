<?php
// var_dump($stokmasuk);
// var_dump($masukitem);
// var_dump($po);
// exit();
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
                  padding: 5px;
            }

            .pddg2 {
                  padding: 3px;
            }

            .cntr {
                  text-align: center;
            }
      </style>
      <title>Retur BKB</title>
</head>

<body>
      <table width="100%" border="0" align="center">
            <tr>
                  <td align="left" style="font-size:14px;font-weight:bold;"><?= $retskb->devisi; ?></td>
                  <td width="6%"><img width="5%" height="5%" src="./assets/qrcode/retur_bkb/<?php echo $retskb->id . "_" . $retskb->noretur; ?>.png"></td>
            </tr>
      </table>
      <table border="0" width="100%">
            <tr>
                  <td align="center" valign="bottom">
                        <h2 align="center" style="margin: 0px;padding: 0px;"><b><u>RETUR BUKTI KELUAR BARANG (BKB)</u></b></h2>
                  </td>
            </tr>
            <tr>
                  <td align="center" valign="baseline">
                        <h3 align="center" style="margin: 0px;padding: 0px 0px 10px 0px;"><b>No. Retur : <?= $retskb->norefretur; ?></b></h3>
                  </td>
            </tr>
      </table>
      <table border="0" width="100%">
            <tr>
                  <td width="5%">Dari</td>
                  <td width="1%">:</td>
                  <td width="25%"><?= $retskb->bag; ?></td>
                  <td width="5%">Tanggal</td>
                  <td width="1%">:</td>
                  <td width="25%"><?= date("d-m-Y", strtotime($retskb->tgl)); ?></td>
            </tr>
            <tr>
                  <td>No. BA</td>
                  <td>:</td>
                  <td><?= $retskb->no_ba; ?></td>
                  <td>No. BKB</td>
                  <td>:</td>
                  <td><?= $retskb->norefbkb; ?></td>
            </tr>
            <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td><?= $retskb->keterangan; ?></td>
                  <td></td>
                  <td></td>
                  <td></td>
            </tr>

      </table>

      <table border="1" width="100%" class="singleborder" style="margin-top:7px;">
            <thead>
                  <tr>
                        <th width="5%" class="pddg">No</th>
                        <th width="15%" class="pddg">Kode Barang</th>
                        <th width="38%" class="pddg">Nama Barang</th>
                        <th width="7%" class="pddg">Satuan</th>
                        <th width="10%" class="pddg">Qty</th>
                        <th width="25%" class="pddg">Keterangan</th>
                  </tr>
            </thead>
            <tbody>
                  <?php
                  $no = 1;
                  foreach ($ret_skbitem as $item) {
                  ?>
                        <tr>
                              <td class="pddg2 cntr"><?= $no; ?></td>
                              <td class="pddg2"><?= $item->kodebar; ?></td>
                              <td class="pddg2"><?= $item->nabar; ?></td>
                              <td class="pddg2"><?= $item->satuan; ?></td>
                              <td class="pddg2 cntr"><?= $item->qty; ?></td>
                              <td class="pddg2"><?= $item->ket; ?></td>
                        </tr>
                  <?php
                        $no++;
                  }
                  ?>
            </tbody>
      </table>
      <br />
      <table width="100%" style="margin-top: -5px;">
            <tr>
                  <td></td>
                  <td align="center">Disetujui Oleh,</td>
                  <td align="center">Diketahui Oleh,</td>
                  <td align="center">Diterima Oleh,</td>
            </tr>
            <tr>
                  <td>
                        <small>*Note</small><br />
                        <small>Putih&emsp;-&emsp;pusat</small><br />
                        <small>Kuning&emsp;-&emsp;Actg. Gudang</small><br />
                        <small>Merah&emsp;-&emsp;Flle</small><br />
                  </td>
                  <td colspan="4" height="50"></td>
            </tr>
            <tr>
                  <td></td>
                  <td align="center">(___________________)</td>
                  <td align="center">(___________________)</td>
                  <td align="center">(___________________)</td>
            </tr>
      </table>

      <div style="margin-top: 7px;">
            <small><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?> <?= $this->platform->agent(); ?></i></small><br />
            <small><i>Cetakan ke - <?= $urut['cetak'] ?></i></small><br>
            <small>By MIPS LOGISTIK</small><br>
            <?php if ($retskb->batal == 1) { ?>
                  <small style="color: crimson;">Alasan batal : <?= $retskb->alasan_batal; ?></small>
            <?php } ?>
      </div>
</body>