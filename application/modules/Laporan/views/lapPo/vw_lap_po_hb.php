<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Purchase Order (PO)</title>
      <style>
            body {
                  font-family: Verdana;
                  font-size: 8px;
                  font-style: normal;
                  font-variant: normal;
                  font-weight: 400;
                  line-height: 20px;
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
      </style>
</head>

<body>
      <h3 style="font-size:14px;font-weight:bold;margin-bottom: 0%;"><?= $devisi; ?> </h3>
      <?php if ($alamat != '01') {
            echo '';
      } else {
            echo '<h6 style="z-index: 0; margin-top: -1%;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
      }

      ?>
      <div style="text-align: center; ">

            <table border="0" class="center" style="margin-top: 0%;">
                  <tr>
                        <td style="text-align: center;" colspan="3">
                              <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%;">Laporan Harga Barang PO <i>(last)</i></h3>
                        </td>
                  </tr>
                  <!-- <tr>
                        <td>PERIODE</td>
                        <td>:</td>
                        <td><?= date_format(date_create($tgl1), "d/m/Y") . ' - ' . date_format(date_create($tgl2), "d/m/Y");  ?></td>
                  </tr> -->
                  <tr>
                        <td>TANGGAL CETAK</td>
                        <td>:</td>
                        <td><?= date("d/m/Y"); ?></td>
                  </tr>
            </table>
            <p align="right" style="margin-top: -2%;margin-bottom: 0px;"><small>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></small></p>
            <hr>
            <hr>
            <table border="0" class="center" width="100%">
                  <thead>
                        <tr>
                              <th>No</th>
                              <th>Kode Barang</th>
                              <th>Nama Barang</th>
                              <th>Satuan</th>
                              <th>Grup</th>
                              <th style="text-align: right;">Harga</i></th>
                              <th>Tanggal PO</th>
                              <th>Nomor PO</th>
                        </tr>
                  </thead>
                  <tbody>
                        <?php
                        $no = 1;
                        $total = 0;
                        foreach ($item_po as $list_item_po) {
                              $get_grup_sql = "SELECT grp FROM kodebar WHERE kodebar = $list_item_po->kodebar";
                              $get_grup = $this->db_logistik->query($get_grup_sql)->row_array();
                        ?>
                              <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $list_item_po->kodebar; ?></td>
                                    <td><?= $list_item_po->nabar; ?></td>
                                    <td><?= $list_item_po->sat; ?></td>
                                    <td><?= $get_grup['grp']; ?></td>
                                    <td style="text-align: right;">Rp <?= number_format($list_item_po->harga, 2); ?></td>
                                    <td><?= date_format((date_create($list_item_po->tglpo)), "d/m/Y"); ?></td>
                                    <td><?= $list_item_po->noref; ?></td>
                              </tr>
                        <?php } ?>

                  </tbody>
            </table>
            <hr>
      </div>
      <!-- <h4>Total Seluruh : Rp <?= number_format($total, 2); ?></h4> -->
</body>

</html>