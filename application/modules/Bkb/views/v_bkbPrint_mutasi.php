<?php
// var_dump($stockkeluar);exit();
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

            .cntr {
                  text-align: center;
            }
      </style>
      <title>Bukti Keluar Barang</title>
</head>

<body>
      <table width="100%" border="0" align="center">
            <tr>
                  <td align="left" style="font-size:14px;font-weight:bold;"><?= $stockkeluar->devisi; ?></td>
                  <td width="6%"><img width="7%" height="7%" src="./assets/qrcode/bkb/<?php echo $id . "_" . $no_bkb; ?>.png"></td>
            </tr>
      </table>
      <?php
      if ($stockkeluar->bhn_bakar == 'BBM') {
      ?>
            <!-- // jika bbm -->
            <table border="0" width="100%" style="margin-top: -15px;">
                  <tr>
                        <td rowspan="2" align="center" valign="bottom">
                              <h2 align="center" style="margin: 0px;padding: 0px;"><u>BUKTI KELUAR BARANG (BKB) MUTASI</u></h2>
                        </td>
                        <td width="13%">jenis alat/kend</td>
                        <td width="2%">:</td>
                        <td width="15%"><?= $stockkeluar->jn_alat; ?></td>
                  </tr>
                  <tr>
                        <td>Kode/Nomer</td>
                        <td>:</td>
                        <td><?= $stockkeluar->no_kode; ?> </td>
                  </tr>
                  <tr>
                        <td rowspan="2" align="center" valign="baseline">
                              <h3 align="center" style="margin: 0px;padding: 0px 0px 10px 0px;"><b><?= $stockkeluar->no_mutasi; ?></b></h3>
                        </td>
                        <td>HM/KM</td>
                        <td>:</td>
                        <td><?= $stockkeluar->hm_km; ?></td>
                  </tr>
                  <tr>
                        <td>Lokasi Kerja</td>
                        <td>:</td>
                        <td><?= $stockkeluar->lok_kerja; ?></td>
                  </tr>
            </table>
      <?php
      } else {
      ?>
            <table border="0" width="100%">
                  <tr>
                        <td align="center" valign="bottom">
                              <h2 align="center" style="margin: 0px;padding: 0px;"><u>BUKTI KELUAR BARANG (BKB) MUTASI</u></h2>
                        </td>
                  </tr>
                  <tr>
                        <td align="center" valign="baseline">
                              <h3 align="center" style="margin: 0px;padding: 0px 0px 10px 0px;"><b><?= $stockkeluar->no_mutasi; ?></b></h3>
                        </td>
                  </tr>
            </table>
      <?php
      }
      ?>

      <table width="100%" style="margin-top: 5px;">
            <tr>
                  <td>Depart/Divisi : <?= $stockkeluar->bag; ?></td>
                  <td align="right">No BPB : <?= $stockkeluar->nobpb; ?></td>
            </tr>
      </table>
      <table class="singleborder" border="1" width="100%">
            <tr>
                  <td align="center" rowspan="2" class="pddg" width="5%">No</td>
                  <td align="center" rowspan="2" class="pddg" width="15%">Kode Barang</td>
                  <td align="center" rowspan="2" class="pddg" width="22%">Nama / Spesifikasi Barang</td>
                  <td align="center" rowspan="2" class="pddg" width="5%">Sat</td>
                  <td align="center" colspan="2" class="pddg">Jumlah</td>
                  <td align="center" rowspan="2" class="pddg">Kode Beban</td>
                  <td align="center" rowspan="2" class="pddg">Blok</td>
                  <td align="center" rowspan="2" class="pddg" width="12%">Keterangan</td>
            </tr>
            <tr>
                  <td class="pddg" width="10%">Diminta</td>
                  <td class="pddg" width="10%">Dikeluarkan</td>
            </tr>
            <?php
            $no = 1;
            foreach ($keluarbrgitem as $listkeluarbrgitem) {
                  // var_dump($keluarbrgitem);exit();
            ?>
                  <tr>
                        <td class="cntr"><?= $no ?></td>
                        <td class="pddg"><?= $listkeluarbrgitem->kodebartxt; ?></td>
                        <td class="pddg"><?= $listkeluarbrgitem->nabar; ?></td>
                        <td class="pddg"><?= $listkeluarbrgitem->satuan; ?></td>
                        <td class="cntr"><?= $listkeluarbrgitem->qty; ?></td>
                        <td class="cntr"><?= $listkeluarbrgitem->qty2; ?></td>
                        <td class="pddg"><?= $listkeluarbrgitem->kodesubtxt; ?></td>
                        <td class="pddg"><?= $listkeluarbrgitem->blok; ?></td>
                        <td class="pddg"><?= $listkeluarbrgitem->ket; ?></td>
                  </tr>
            <?php } ?>
            <tr>
                  <td colspan="2">
                        Distribusi :<br />
                        -Ke 1 - Kantor Kebun/PKS<br />
                        -Ke 2 - Gudang
                  </td>
                  <td colspan="7">
                        <table border="0" width="100%">
                              <tr>
                                    <td align="center">Dibukukan,</td>
                                    <td align="center">Diperiksa,</td>
                                    <td align="center">Dibuat oleh,</td>
                                    <td align="center">DIterima oleh,</td>
                                    <td align="center">Tanggal</td>
                              </tr>
                              <tr>
                                    <td colspan="4" height="50"></td>
                                    <td align="center" valign="top" rowspan="3"> <?= date("d-m-Y", strtotime($stockkeluar->tgl)); ?></td>
                              </tr>
                              <tr>
                                    <td align="center">(___________________)</td>
                                    <td align="center">(___________________)</td>
                                    <td align="center">(___________________)</td>
                                    <td align="center">(___________________)</td>
                              </tr>
                              <tr>
                                    <td align="center">Kasie Pembukuan</td>
                                    <td align="center">KTU</td>
                                    <td align="center">Kasie Gudang</td>
                                    <td align="center"></td>
                              </tr>
                        </table>
                  </td>
            </tr>
      </table>
      <small><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?> <?= $this->platform->agent(); ?></i></small><br />
      <small><i>Cetakan ke - <?= $urut['cetak'] ?></i></small><br>
      <small>By MIPS LOGISTIk</small>
</body>