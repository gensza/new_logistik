<?php // var_dump('iya '.$data_barang);exit(); 
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
  <title>Master Kode Barang</title>
</head>

<body>
  <table class="singleborder" border="1" id="tableMasterKodeBarang" width="100%">
    <thead>
      <tr>
        <th width="5%" align="center">No</th>
        <th width="17%" align="center">Kode Barang</th>
        <th width="15%" align="center">Part Number</th>
        <th align="center">Nama Barang</th>
        <th width="8%" align="center">Satuan</th>
      </tr>
    </thead>
    <tbody id="tbodyMasterKodeBarang">
      <?php
      $no = 1;

      foreach ($data_barang as $value) {
      ?>
        <tr>
          <td><?= $no; ?></td>
          <td><?= $value->kodebartxt; ?></td>
          <td><?= $value->nopart; ?></td>
          <td><?= $value->nabar; ?></td>
          <td><?= $value->satuan; ?></td>
        </tr>
      <?php
        $no++;
      }
      ?>
    </tbody>
  </table>
</body>