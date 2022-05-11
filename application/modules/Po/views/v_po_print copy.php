<!DOCTYPE html>
<html>
<?php
$alamat_supplier = (!empty($supplier->alamat)) ? $supplier->alamat : "-";
$tlp_supplier = (!empty($supplier->tlp)) ? $supplier->tlp : "-";
$fax_supplier = (!empty($supplier->fax)) ? $supplier->fax : "-";
$pot_ppn_format = ($po->ppn == "Y") ? number_format($po->totalbayar * 0.1, 2, ",", ".") : "0";
$pot_ppn = ($po->ppn == "Y") ? ($po->totalbayar * 0.1) : "0";
//   var_dump($po->totalbayar);exit();
$total_bayar_format = number_format($po->totalbayar, 2, ",", ".");
// $total_bayar = $po->totalbayar;
function kekata($x)
{
  $x = abs($x);
  $angka = array(
    "", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
  );
  $temp = "";
  if ($x < 12) {
    $temp = " " . $angka[$x];
  } else if ($x < 20) {
    $temp = kekata($x - 10) . " belas";
  } else if ($x < 100) {
    $temp = kekata($x / 10) . " puluh" . kekata($x % 10);
  } else if ($x < 200) {
    $temp = " seratus" . kekata($x - 100);
  } else if ($x < 1000) {
    $temp = kekata($x / 100) . " ratus" . kekata($x % 100);
  } else if ($x < 2000) {
    $temp = " seribu" . kekata($x - 1000);
  } else if ($x < 1000000) {
    $temp = kekata($x / 1000) . " ribu" . kekata($x % 1000);
  } else if ($x < 1000000000) {
    $temp = kekata($x / 1000000) . " juta" . kekata($x % 1000000);
  } else if ($x < 1000000000000) {
    $temp = kekata($x / 1000000000) . " milyar" . kekata(fmod($x, 1000000000));
  } else if ($x < 1000000000000000) {
    $temp = kekata($x / 1000000000000) . " trilyun" . kekata(fmod($x, 1000000000000));
  }
  return $temp;
}

function terbilang($x, $style = 4)
{
  if ($x < 0) {
    $hasil = "minus " . trim(kekata($x));
  } else {
    $hasil = trim(kekata($x));
  }
  switch ($style) {
    case 1:
      $hasil = strtoupper($hasil);
      break;
    case 2:
      $hasil = strtolower($hasil);
      break;
    case 3:
      $hasil = ucwords($hasil);
      break;
    default:
      $hasil = ucfirst($hasil);
      break;
  }
  return $hasil;
}
?>

<head>
  <style type="text/css">
    #tabel_po tr td {
      /*font-size: 12px;*/
      border: 1px solid black;
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

    #tr_content td.noborder2 {
      border-top: 0px solid #FFF;
      border-right: 0px solid #FFF;
      border-bottom: 0px solid #FFF;
      border-left: 0px solid #FFF;
    }
  </style>
  <title>Pesanan Pembelian</title>
</head>

<body>
  <table>
    <tr>
      <td>Nama</td>
      <td>:</td>
      <td>PT MULIA SAWIT AGRO LESTARI</td>
    </tr>
    <tr>
      <td>No. NPWP</td>
      <td>:</td>
      <td><?= $pt->npwp; ?></td>
    </tr>
    <tr>
      <td valign="top">Alamat NPWP</td>
      <td valign="top">:</td>
      <td align="justify"><?= $pt->alamatnpwp; ?></td>
    </tr>
  </table>
  <hr>
  <p align="right" style="margin-bottom: 0px;margin-top: 0px;"><small>Jakarta, <?= date('d-m-Y') ?></small></p>
  <h2 align="center" style="margin: 0px;">PESANAN PEMBELIAN</h2>
  <!-- <p align="center" style="margin-top: 0px;font-size: 12px;">
    No. PP : <?= $po->noreftxt; ?> <br />
    No. SPP : <?= $po->no_refppo; ?>
  </p> -->
  <h4 align="center" style="font-weight: normal;margin: 0px;">
    No. PO : <?= $po->noreftxt; ?>
  </h4>
  <table border="1" class="singleborder" width="100%" id="tabel_po">
    <tr>
      <td style="padding:5px;" colspan="5">
        Kepada YTH,<br />
        <?= $supplier->supplier; ?><br />
        <?= $alamat_supplier; ?><br />
        Tlp. <?= $tlp_supplier; ?><br />
        Fax. <?= $fax_supplier; ?><br />
      </td>
      <td style="padding: 5px;" colspan="6">
        <br />
        Syarat Pembayaran : <br />
        Jadwal Pengiriman : <?= $po->ket_kirim; ?> <br />
        Alamat Penyerahan : <?= $po->lokasikirim; ?> <br />
      </td>
    </tr>
    <tr>
      <td align="center">No</td>
      <td align="center">SPP</td>
      <td align="center" width="30px">Kode Barang</td>
      <td align="center" width="50px">Nama Barang</td>
      <td align="center">Merk</td>
      <td align="center">No. Part</td>
      <td align="center">Qty</td>
      <td align="center">SAT</td>
      <td align="center">Harga Satuan</td>
      <td align="center">Disc %</td>
      <td align="center">Total Harga</td>
    </tr>
    <?php
    $no = 1;
    $jumlah_biaya_lain = 0;
    $nama_bebanbpo = array();
    foreach ($item_po as $list_item) {
    ?>
      <tr id="tr_content">
        <td class="noborder" rowspan="2" align="center"><?= $no; ?></td>
        <td class="noborder2" align="center"><?= $list_item->noppotxt; ?></td>
        <td class="noborder2" align="center"><?= $list_item->kodebartxt; ?></td>
        <td class="noborder2" align="center"><?= $list_item->nabar; ?></td>
        <td class="noborder2" align="center"><?= $list_item->merek; ?></td>
        <td class="noborder" rowspan="2" align="center">-</td>
        <td class="noborder" rowspan="2" align="center"><?= $list_item->qty; ?></td>
        <td class="noborder" rowspan="2" align="center"><?= $list_item->sat; ?></td>
        <td class="noborder" rowspan="2" align="right">Rp. <?= number_format($list_item->harga, 2, ",", "."); ?></td>
        <td class="noborder" rowspan="2" align="center"><?= $list_item->disc; ?></td>
        <td class="noborder" rowspan="2" align="right">Rp. <?= number_format($list_item->jumharga, 2, ",", "."); ?></td>
      </tr>
      <tr>
        <td style="border: none;" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*<?= $list_item->ket; ?></td>
      </tr>
    <?php
      array_push($nama_bebanbpo, $list_item->nama_bebanbpo);
      $jumlah_biaya_lain += $list_item->JUMLAHBPO;
      $no++;
    }
    ?>
    <tr>
      <td colspan="7" rowspan="6" valign="top">
        <b>Keterangan : </b><br />
        <?= $po->ket; ?>
        <!-- Nama Pemilik : <br />
        No. Rekening : <br />
        Uang Muka    : <br /> -->
      </td>
      <td colspan="2">SUB TOTAL</td>
      <td colspan="2" align="right">Rp <?= $total_bayar_format; ?></td>
    </tr>
    <tr>
      <td colspan="2">PPN 10%</td>
      <td colspan="2" align="right">Rp <?= $pot_ppn_format; ?></td>
    </tr>
    <tr>
      <td colspan="2">PPH</td>
      <td colspan="2" align="right">Rp <?= number_format($po->no_acc, 2, ",", "."); ?></td>
    </tr>
    <tr>
      <td colspan="2">Biaya Lainnya</td>
      <td colspan="2" align="right">Rp <?= number_format($jumlah_biaya_lain, 2, ",", "."); ?></td>
    </tr>
    <tr>
      <td colspan="2"><?= join(", ", $nama_bebanbpo); ?></td>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2">TOTAL</td>
      <td colspan="2" align="right">
        <?php
        // var_dump($po->totalbayar);
        // var_dump($pot_ppn);
        // var_dump($jumlah_biaya_lain);
        // exit();
        ?>
        <br />
        Rp <?= number_format($po->totalbayar + $pot_ppn + $po->no_acc + $jumlah_biaya_lain, 2, ",", "."); ?>
      </td>
    </tr>
    <tr>
      <?php
      $total = $po->totalbayar + $pot_ppn + $jumlah_biaya_lain;
      // var_dump("iyayayay".$total);exit();
      ?>
      <td colspan="11"><b>Terbilang : <?= terbilang($total, $style = 3); ?> Rupiah</b></td>
    </tr>
    <tr>
      <td align="center" colspan="4" height="50">
        Menyetujui,<br />
        <br />
        <br />
        <br />
        <br />
        (Supplier)
      </td>
      <td align="center" colspan="3" height="50">
        Dibuat oleh,<br />
        <br />
        <br />
        <br />
        <br />
        <?php
        $total = $po->totalbayar + $pot_ppn + $jumlah_biaya_lain;
        if ($total > 5000000) { ?>
          (Direktur Purchasing)
        <?php } else { ?>
          (Purchasing)
        <?php } ?>
      </td>
      <td align="center" colspan="4" height="50">
        Menyetujui,<br />
        <br />
        <br />
        <br />
        <br />
        (Direktur Pembelian)
      </td>
    </tr>
  </table>
  <p style="padding: 0px;margin: 0px;"><small><b>Catatan : Mohon dicek kembali pesanan pembelian ini, apabila setuju tolong diteken dan dicap perusahaan/toko lalu difax kembali ke 021-7231819</b></small></p>
  <p style="padding: 0px;margin: 0px;"><small><i>Tgl Cetak <?= date("d/m/Y H:i:s"); ?> - Client <?= $this->input->ip_address(); ?> <?= $this->platform->agent(); ?></i></small><br />
  <p style="padding: 0px;margin: 0px;"><small><i>Cetakan Ke : <?= $po->jml_cetak ?></i></small><br />
    <small>Print generated by MIPS</small>
  </p>
</body>

</html>