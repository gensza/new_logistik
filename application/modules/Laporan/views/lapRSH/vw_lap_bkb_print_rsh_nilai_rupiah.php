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
                  vertical-align: middle;
            }

            .singleborder {
                  border-collapse: collapse;
                  border: 0.2px solid black;
            }
      </style>
</head>

<body>
      <?php

      if ($kode_dev == 'Semua') {
            echo '<h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $this->session->userdata('nama_pt') . '</h2>';
      } else {
            if (empty($kode_stock[0]->devisi)) {
                  echo '<h2 style="margin-bottom: 0;">Tidak ada stok barang di divisi tersebut!</h2>';
            } else {
                  echo '<h2 style="font-size:14px;font-weight:bold;margin-bottom: 0;">' . $kode_stock[0]->devisi . '</h2>';
            }
      }

      if ($alamat != '01') {
            echo '';
      } else {
            echo '<h6 style="z-index: 0; margin-top: 5px;">JL. Radio Dalam Raya, No. 87 A, RT 005/RW 014 Gandaria Utara, KebayoranBaru, Jakarta Selatan, DKI Jakarta Raya - 12140</h6>';
      }
      ?>
      <div style="text-align: center;">
            <h3 style="font-size:11px;font-weight:bold;margin-bottom: 0%; ">Register Rincian (Nilai Rupiah) Stock Harian Material Gudang</h3>
      </div>
      <br>
      <?php if (empty($kode_stock)) { ?>
            <table border="0" width="100%">
                  <thead>
                        <tr>
                              <td style="text-align: left;"><b> PERIODE : <?= $periode; ?> </b></td>
                              <td style="text-align: right;"><i>By System MIPS</i></td>
                        </tr>
                        <tr>
                              <td style="text-align: left;"><b>Tidak ada data</b></td>
                              <td style="text-align: right;">
                                    <b>
                                          Saldo Sebelum Periode : 0.00
                                    </b>
                              </td>
                        </tr>
                  </thead>
            </table>

            <?php } else {
            foreach ($kode_stock as $ks) {
                  $kode_dev2 = (int)$kode_dev;
                  // $txtperiodeminus = $txtperiode - 1;
                  $q_saldo = "SELECT SUM(saldoakhir_nilai) AS saldoakhir_nilai, SUM(saldoakhir_qty) AS saldoakhir_qty, satuan FROM stockawal WHERE kodebar = '$ks->kodebar' AND txtperiode < '$txtperiode'";
                  $saldo_r = $this->db_logistik_pt->query($q_saldo)->num_rows();
                  if ($saldo_r >= 1) {
                        $saldo = $this->db_logistik_pt->query($q_saldo)->row_array();
                  } else {
                        $saldo = [
                              'saldoakhir_qty' => '0',
                              'saldoakhir_nilai' => '0'
                        ];
                  }

            ?>
                  <table border="0" width="100%">
                        <thead>
                              <tr>
                                    <td style="text-align: left;"><b> PERIODE : <?= $periode; ?> </b></td>
                                    <td style="text-align: right;"><i>By System MIPS</i></td>
                              </tr>
                              <tr>
                                    <td style="text-align: left;"><b> <?= $ks->kodebar; ?> &nbsp; <?= $ks->nabar; ?></b></td>
                                    <td style="text-align: right;">
                                          <b>
                                                Saldo Sebelum Periode (QTY) : <?= number_format($saldo['saldoakhir_qty'], 2) . ' ' . $ks->satuan; ?>
                                          </b>
                                          <b>
                                                | (Rp) : <?= number_format($saldo['saldoakhir_nilai'], 2); ?>
                                          </b>
                                    </td>
                              </tr>
                        </thead>
                  </table>
                  <table width="100%" class="singleborder" border="1">
                        <thead style="text-align: center;">
                              <tr>
                                    <td rowspan="2" style="text-align: center; width: 2%;">No</td>
                                    <td rowspan="2" style="text-align: center; width: 5%;">Tgl</td>
                                    <td rowspan="2" style="text-align: center; width: 6%;">Nomor</td>
                                    <td rowspan="2" style="text-align: center; width: 12%;">Keterangan</td>
                                    <td colspan="3" style="text-align: center; width: 25%;">LPB</td>
                                    <td colspan="2" style="text-align: center; width: 20%;">BKB</td>
                                    <td rowspan="2" style="text-align: center; width: 8%;">Harga Rata-rata</td>
                                    <td colspan="2" style="text-align: center; width: 22%;">Saldo</td>
                              </tr>
                              <tr>
                                    <th style="width: 7.5%;">Qty</th>
                                    <th style="width: 7.5%;">Harga</th>
                                    <th style="width: 7.5%;">Total Harga</th>
                                    <th style="width: 7.5%;">Qty</th>
                                    <th style="width: 7.5%;">Total Harga</th>
                                    <th style="width: 7.5%;">Qty</th>
                                    <th style="width: 7.5%;">Rupiah</th>
                              </tr>

                        </thead>
                        <tbody>
                              <?php
                              $no = 1;
                              $s_a =  $saldo['saldoakhir_nilai'];
                              $s_a_qty =  $saldo['saldoakhir_qty'];
                              $p1_frmt = date_format(date_create($p1), "Ymd");
                              $p2_frmt = date_format(date_create($p2), "Ymd");

                              $q_stok = "SELECT * FROM register_stok WHERE tgltxt BETWEEN '$p1_frmt' AND '$p2_frmt' AND kodebar = '$ks->kodebar' ORDER BY tgltxt ASC, status DESC, ttgtxt ASC";

                              $q_stok = $this->db_logistik_pt->query($q_stok)->result();

                              $sub_tgl = '';
                              $sub_tgl1 = '';
                              $sub_tot_lpb_qty_akumulasi = 0;
                              $sub_tot_lpb_qty = 0;
                              $sub_tot_lpb_akumulasi = 0;
                              $sub_tot_lpb = 0;
                              $sub_tot_bkb_qty_akumulasi = 0;
                              $sub_tot_bkb_qty = 0;
                              $sub_tot_bkb_akumulasi = 0;
                              $sub_tot_bkb = 0;
                              $grand_lpb_qty = 0;
                              $grand_lpb = 0;
                              $grand_bkb_qty = 0;
                              $grand_bkb = 0;
                              $hasil_rata2 = 0;
                              foreach ($q_stok as $qs) { ?>
                                    <?php

                                    $sub_tgl1 = $sub_tgl;
                                    $sub_tgl = date_format(date_create($qs->tgl), "Y-m-d");

                                    if ($no == 1) {
                                    } else if ($sub_tgl1 !== date_format(date_create($qs->tgl), "Y-m-d")) {

                                    ?>
                                          <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="background-color: lightgray;"><b>SUB TOTAL</b></td>
                                                <td style="background-color: lightgray; text-align: right"><b><?= number_format($sub_tot_lpb_qty, 2); ?></b></td>
                                                <td></td>
                                                <td style="background-color: lightgray; text-align: right"><b><?= number_format($sub_tot_lpb, 2); ?></b></td>
                                                <td style="background-color: lightgray; text-align: right"><b><?= number_format($sub_tot_bkb_qty, 2); ?></b></td>
                                                <td style="background-color: lightgray; text-align: right"><b><?= number_format($sub_tot_bkb, 2); ?></b></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                          </tr>
                                    <?php
                                          $sub_tot_lpb_qty = 0;
                                          $sub_tot_lpb = 0;
                                          $sub_tot_bkb_qty = 0;
                                          $sub_tot_bkb = 0;
                                    }

                                    ?>
                                    <tr>
                                          <td style="text-align: center;"><?= $no++; ?></td>
                                          <td style="text-align: center;"><?= date_format(date_create($qs->tgl), 'd/m/Y'); ?></td>
                                          <td style="text-align: center;"><?= $qs->status . ' ' . $qs->ttgtxt; ?></td>
                                          <td style="text-align: left;"><?= $qs->ket; ?></td>
                                          <?php

                                          $sub_tot_bkb_qty_akumulasi += $qs->keluar_qty;
                                          $sub_tot_bkb_akumulasi += $qs->keluar_qty * $qs->harga;
                                          if ($qs->status == 'LPB') {

                                                $sub_tot_lpb_qty_akumulasi += $qs->masuk_qty;
                                                $sub_tot_lpb_akumulasi += $qs->masuk_qty * $qs->harga;


                                                $akumulasi_nilai = ($saldo['saldoakhir_nilai'] + $sub_tot_lpb_akumulasi) - $sub_tot_bkb_akumulasi;
                                                $akumulasi_qty = ($saldo['saldoakhir_qty'] + $sub_tot_lpb_qty_akumulasi) - $sub_tot_bkb_qty_akumulasi;

                                                $hasil_rata2 = $akumulasi_nilai / $akumulasi_qty;

                                                $sub_tot_lpb_qty += $qs->masuk_qty;
                                                $sub_tot_lpb += $qs->masuk_qty * $qs->harga;
                                                $grand_lpb_qty += $qs->masuk_qty;
                                                $grand_lpb += $qs->masuk_qty * $qs->harga;

                                          ?>
                                                <td style="text-align: right;"><?= number_format($qs->masuk_qty, 2); ?></td>
                                                <td style="text-align: right;"><?= number_format($qs->harga, 2); ?></td>
                                                <td style="text-align: right;"><?= number_format($qs->masuk_qty * $qs->harga, 2); ?></td>
                                                <td style="text-align: right;"><?= number_format(0, 2); ?></td>
                                                <td style="text-align: right;"><?= number_format(0, 2); ?></td>
                                                <td style="text-align: right;"><?= number_format($hasil_rata2, 2); ?></td>
                                                <td style="text-align: right;"><?= number_format(($s_a_qty = $s_a_qty +  $qs->masuk_qty), 2); ?></td>
                                                <td style="text-align: right;"><?= number_format(($s_a = $s_a + $qs->masuk_qty * $qs->harga), 2); ?></td>
                                          <?php } else if ($qs->status == 'BKB') {

                                                $tgl_frmt = date_format(date_create($qs->tgl), "Ymd");

                                                $sql_sum_reg = "SELECT SUM(masuk_qty) AS masuk_qty FROM register_stok WHERE tgltxt <= '$tgl_frmt' AND txtperiode = '$txtperiode' AND kodebar = '$ks->kodebar' AND status = 'LPB'";

                                                $r_sum_reg = $this->db_logistik_pt->query($sql_sum_reg)->row_array();

                                                $akumulasi_qty_bkb = ($saldo['saldoakhir_qty'] + $r_sum_reg['masuk_qty']) - $grand_bkb_qty;
                                                $akumulasi_nilai_bkb = ($grand_lpb + $saldo['saldoakhir_nilai']) - $grand_bkb;

                                                // jika tanggal nya sama 
                                                if ($sub_tgl1 !== date_format(date_create($qs->tgl), "Y-m-d")) {
                                                      $hasil_rata2_bkb = $akumulasi_nilai_bkb / $akumulasi_qty_bkb;
                                                } else {
                                                      if ($hasil_rata2 == 0) {
                                                            $hasil_rata2_bkb = $akumulasi_nilai_bkb / $akumulasi_qty_bkb;
                                                      } else {
                                                            $hasil_rata2_bkb = $hasil_rata2;
                                                      }
                                                }

                                                $sub_tot_bkb_qty += $qs->keluar_qty;
                                                $sub_tot_bkb += $qs->keluar_qty * $qs->harga;
                                                $grand_bkb_qty += $qs->keluar_qty;
                                                $grand_bkb += $qs->keluar_qty * $qs->harga;
                                          ?>
                                                <td style="text-align: right;"><?= number_format(0, 2); ?></td>
                                                <td style="text-align: right;"><?= number_format(0, 2); ?></td>
                                                <td style="text-align: right;"><?= number_format(0, 2); ?></td>
                                                <td style="text-align: right;"><?= number_format($qs->keluar_qty, 2); ?></td>
                                                <td style="text-align: right;"><?= number_format($qs->keluar_qty * $hasil_rata2_bkb, 2); ?></td>
                                                <td style="text-align: right;"><?= number_format($hasil_rata2_bkb, 2); ?></td>
                                                <td style="text-align: right;"><?= number_format(($s_a_qty = $s_a_qty -  $qs->keluar_qty), 2); ?></td>
                                                <td style="text-align: right;"><?= number_format(($s_a = $s_a - ($qs->keluar_qty * $hasil_rata2_bkb)), 2); ?></td>
                                          <?php } ?>
                                    </tr>

                              <?php } ?>
                              <tr>
                                    <td colspan="3"></td>
                                    <td style="background-color: lightgray;"><b>SUB TOTAL</b></td>
                                    <td style="background-color: lightgray; text-align: right"><b><?= number_format($sub_tot_lpb_qty, 2); ?></b></td>
                                    <td></td>
                                    <td style="background-color: lightgray; text-align: right"><b><?= number_format($sub_tot_lpb, 2); ?></b></td>
                                    <td style="background-color: lightgray; text-align: right"><b><?= number_format($sub_tot_bkb_qty, 2); ?></b></td>
                                    <td style="background-color: lightgray; text-align: right"><b><?= number_format($sub_tot_bkb, 2); ?></b></td>
                                    <td colspan="3"></td>

                              </tr>
                              <tr>
                                    <td colspan="3"></td>
                                    <td style="text-align: center;"><b>GRAND TOTAL</b></td>
                                    <td style="text-align: right;"><b><?= number_format($grand_lpb_qty, 2); ?></b></td>
                                    <td></td>
                                    <td style="text-align: right;"><b><?= number_format($grand_lpb, 2); ?></b></td>
                                    <td style="text-align: right;"><b><?= number_format($grand_bkb_qty, 2); ?></b></td>
                                    <td style="text-align: right;"><b><?= number_format($grand_bkb, 2); ?></b></td>
                                    <td colspan="3"></td>
                              </tr>
                              <tr>
                                    <td colspan="4" style="text-align: right; padding-right:5px;">
                                          <b>SALDO AKHIR</b>
                                    </td>
                                    <td colspan="5" style="padding-left:5px;">
                                          &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                          <b>QTY &nbsp;:&nbsp;<?= number_format($s_a_qty, 2); ?></b>
                                          &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                          <b>Nilai(Rp) &nbsp;:&nbsp;<?= number_format($s_a, 2); ?></b>
                                    </td>
                                    <td colspan="3" style="padding-left:5px;">
                                    </td>
                              </tr>
                        </tbody>
                  </table>
      <?php }
      } ?>
      <br>
      <i>printed by MIPS System <?= date('d-m-Y H:i:s'); ?></i>
</body>

</html>