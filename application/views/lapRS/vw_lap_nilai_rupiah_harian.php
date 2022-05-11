<!DOCTYPE html>
<html>
<head>
	<title>Register Pemakaian Stock Material Gudang</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/printjs/print.min.css">
	<style type="text/css">
		table {
	      /*font-size: 12px;*/
	      /*border: 1px solid #dddddd;*/
	      border-collapse: collapse;
	    }

	    body { 
	      font-family: Verdana; 
	      font-size: 10px; 
	      font-style: normal; 
	      font-variant: normal; 
	      font-weight: 400; 
	      line-height: 20px; 
	    }
	</style>
</head>
<body>
	<button type="button" onclick="printJS('printJS-form', 'html')">
	    <span class="fa fa-print"> Print</span>
	</button>
	<table width="80%" align="center" border="0" id="printJS-form">
		<tr>
			<td><h2>PT MULIA SAWIT AGRO LESTARI</h2></td>
		</tr>
		<tr>
			<td colspan="2"><?= $alamatpt; ?></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><h3>Rincian Pemakaian Stock Material Gudang</h3></td>
		</tr>
		<tr>
			<td colspan="2"><?= $namapt; ?></td>
		</tr>
		<tr>
			<?php
				// $Ymd_periode = $this->session->userdata('Ymd_periode');
				$Ymd_periode = $periode_str;
				$periode = date("F Y", strtotime($Ymd_periode));

				// $ym_periode_skrg = $this->session->userdata('ym_periode');
			?>
			<td width="50%" align="left"><b>Periode : <?= $periode; ?> </b></td>
			<td width="50%" align="right">By MIPS</small></td>
		</tr>
		<tr>
			<td colspan="2">
				<?php
					if(count($grp_stockawal_harian) == "0"){
				?>
						<table border="1" class="tablerinci" width="100%" align="center">
							<thead>
								<tr>
									<th>No</th>
									<th>Tgl</th>
									<th>Nomor</th>
									<th>Keterangan</th>
									<th>QTY MASUK</th>
									<th>QTY KELUAR</th>
									<th>SALDO</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="7">No Data Available</td>
								</tr>
							</tbody>
						</table>
				<?php
					}
					else {
				?>
						<table border="1" class="tablerinci" width="100%" align="center">
							<thead>
								<tr>
									<th rowspan="2">No</th>
									<th rowspan="2">Account</th>
									<th rowspan="2">Nama Barang</th>
									<th rowspan="2">SAT</th>
									<th rowspan="2">Harga PO Rata-Rata</th>
									<th colspan="2">Saldo Awal</th>
									<th colspan="3">Qty Masuk (LPB)</th>
									<th colspan="3">Qty Keluar (BKB)</th>
									<th colspan="2">Saldo Akhir</th>
									<th rowspan="2">Tgl Transaksi</th>
								</tr>
								<tr>
									<th>Total Qty</th>
									<th>Total Rupiah</th>
									<th>Qty</th>
									<th>Total Qty</th>
									<th>Total Rupiah</th>
									<th>Qty</th>
									<th>Total Qty</th>
									<th>Total Rupiah</th>
									<th>Total Qty</th>
									<th>Total Rupiah</th>
									<!-- <th>Ref PO</th> -->
								</tr>
							</thead>
							<tbody>
				<?php
						$grandtotal_saw_qty = "0";
						$grandtotal_saw_rp = "0";
						$grandtotal_lpb_qty = "0";
						$grandtotal_lpb_rp = "0";
						$grandtotal_bkb_qty = "0";
						$grandtotal_bkb_rp = "0";
						$grandtotal_sak_qty = "0";
						$grandtotal_sak_rp = "0";

						$no = 1;
						foreach ($grp_stockawal_harian as $list_grp) {
							$grp = $list_grp->grp;
				?>
							<tr>
								<td colspan="16"><?= $grp;  ?></td>
							</tr>
				<?php
							
							$h_porat = "0";
							$saw_totalqty = "0";
							$saw_totalrp = "0";
							$lpb_qtytgl = "0";
							$lpb_totalqty = "0";
							$lpb_totalrp = "0";
							$bkb_qtytgl = "0";
							$bkb_totalqty = "0";
							$bkb_totalrp = "0";
							$sak_totalqty = "0";
							$sak_totalrp = "0";

							if($kd_stock_1 == "Semua"){
								$query_stockawal_harian = "SELECT kodebartxt, nabar, saldoawal_qty, saldoawal_nilai, KODE, txtperiode, satuan, HARGAPORAT, nilai_masuk, QTY_MASUK, QTY_KELUAR, saldoakhir_qty, saldoakhir_nilai, tgl_transaksi, qty_masuk_per_tgl, qty_keluar_per_tgl FROM stockawal_harian WHERE KODE = '$pt' AND txtperiode = '$ym_periode' AND grp = '$grp' ORDER BY tgl_transaksi ASC, kodebartxt ASC";
							}
							else{
								$query_stockawal_harian = "SELECT kodebartxt, nabar, saldoawal_qty, saldoawal_nilai, KODE, txtperiode, satuan, HARGAPORAT, nilai_masuk, QTY_MASUK, QTY_KELUAR, saldoakhir_qty, saldoakhir_nilai, tgl_transaksi, qty_masuk_per_tgl, qty_keluar_per_tgl FROM stockawal_harian WHERE (kodebartxt BETWEEN '$kd_stock_1' AND '$kd_stock_2') AND KODE = '$pt' AND grp = '$grp' AND txtperiode = '$ym_periode' ORDER BY tgl_transaksi ASC, kodebartxt ASC";
							}
							$stockawal_harian = $this->db_logistik_pt->query($query_stockawal_harian)->result();
							foreach ($stockawal_harian as $list_stockawal_harian) {
								$kodebartxt = $list_stockawal_harian->kodebartxt;
								$txtperiode = $list_stockawal_harian->txtperiode;
								$KODE = $list_stockawal_harian->KODE;
								$tgl_transaksi = $list_stockawal_harian->tgl_transaksi;

								$nilai_keluar = $list_stockawal_harian->QTY_KELUAR * $list_stockawal_harian->HARGAPORAT;

								$KODEBAR = $list_stockawal_harian->kodebartxt;
								$kdpt = $this->session->userdata('kode_pt');
								$ym_periode_skrg = $this->session->userdata('ym_periode');

								$tgl_dr_stockawal = $list_stockawal_harian->tgl_transaksi;
				?>
								<tr>
									<td align="center"><?= $no; ?></td>
									<td align="center"><?= $list_stockawal_harian->kodebartxt; ?></td>
									<td align="left"><?= $list_stockawal_harian->nabar; ?></td>
									<td align="center"><?= $list_stockawal_harian->satuan; ?></td>
									<td align="right"><?= number_format($list_stockawal_harian->HARGAPORAT); ?></td>
									<td align="right"><?= number_format($list_stockawal_harian->saldoawal_qty, 2); ?></td>
									<td align="right"><?= number_format($list_stockawal_harian->saldoawal_nilai); ?></td>
									<!-- <td align="right"><?php // echo number_format($qty_masuk_per_tgl, 2); ?></td> -->
									<td align="right"><?php echo number_format($list_stockawal_harian->qty_masuk_per_tgl, 2); ?></td>
									<td align="right"><?= number_format($list_stockawal_harian->QTY_MASUK, 2); ?></td>
									<td align="right"><?= number_format($list_stockawal_harian->nilai_masuk); ?></td>
									<!-- <td align="right"><?php // echo number_format($qty_keluar_per_tgl, 2); ?></td> -->
									<td align="right"><?php echo number_format($list_stockawal_harian->qty_keluar_per_tgl, 2); ?></td>
									<td align="right"><?= number_format($list_stockawal_harian->QTY_KELUAR, 2); ?></td>
									<td align="right"><?= number_format($nilai_keluar); ?></td>
									<td align="right"><?= number_format($list_stockawal_harian->saldoakhir_qty, 2); ?></td>
									<td align="right"><?= number_format($list_stockawal_harian->saldoakhir_nilai); ?></td>
									<td><?= date("Y-m-d",strtotime($list_stockawal_harian->tgl_transaksi)); ?></td>
									<!-- <td><?php // print_r($list); ?></td> -->
								</tr>
				<?php
								// $h_porat = $h_porat + $list_stockawal->HARGAPORAT;
								$saw_totalqty = $saw_totalqty + $list_stockawal_harian->saldoawal_qty;
								$saw_totalrp = $saw_totalrp + $list_stockawal_harian->saldoawal_nilai;
								$lpb_qtytgl = $lpb_qtytgl + $list_stockawal_harian->qty_masuk_per_tgl;
								$lpb_totalqty = $lpb_totalqty + $list_stockawal_harian->QTY_MASUK;
								$lpb_totalrp = $lpb_totalrp + $list_stockawal_harian->nilai_masuk;
								$bkb_qtytgl = $bkb_qtytgl + $list_stockawal_harian->qty_keluar_per_tgl;
								$bkb_totalqty = $bkb_totalqty + $list_stockawal_harian->QTY_KELUAR;
								$bkb_totalrp = $bkb_totalrp + $nilai_keluar;
								$sak_totalqty = $sak_totalqty + $list_stockawal_harian->saldoakhir_qty;
								$sak_totalrp = $sak_totalrp + $list_stockawal_harian->saldoakhir_nilai;

							$no++;
							}
				?>
								<tr>
									<td height="10px" colspan="5"><h5 align="right" height="10">SUB TOTAL</h5></td>
									<!-- <td height="10px"></td> -->
									<!-- <td height="10px"></td> -->
									<td height="10px" align="right"><?= number_format($saw_totalqty, 2) ?></td>
									<td height="10px" align="right"><?= number_format($saw_totalrp) ?></td>
									<td height="10px" align="right"><?= number_format($lpb_qtytgl, 2) ?></td>
									<td height="10px" align="right"><?= number_format($lpb_totalqty, 2) ?></td>
									<td height="10px" align="right"><?= number_format($lpb_totalrp) ?></td>
									<td height="10px" align="right"><?= number_format($bkb_qtytgl, 2) ?></td>
									<td height="10px" align="right"><?= number_format($bkb_totalqty, 2) ?></td>
									<td height="10px" align="right"><?= number_format($bkb_totalrp) ?></td>
									<td height="10px" align="right"><?= number_format($sak_totalqty, 2) ?></td>
									<td height="10px" align="right"><?= number_format($sak_totalrp) ?></td>
									<td></td>
								</tr>
				<?php
							$grandtotal_saw_qty = round($grandtotal_saw_qty,2) + round($saw_totalqty,2);
							$grandtotal_saw_rp = round($grandtotal_saw_rp,2) + round($saw_totalrp,2);
							$grandtotal_lpb_qty = round($grandtotal_lpb_qty,2) + round($lpb_totalqty,2);
							$grandtotal_lpb_rp = round($grandtotal_lpb_rp,2) + round($lpb_totalrp,2);
							$grandtotal_bkb_qty = round($grandtotal_bkb_qty,2) + round($bkb_totalqty,2);
							$grandtotal_bkb_rp = round($grandtotal_bkb_rp,2) + round($bkb_totalrp,2);
							$grandtotal_sak_qty = round($grandtotal_sak_qty,2) + round($sak_totalqty,2);
							$grandtotal_sak_rp = round($grandtotal_sak_rp,2) + round($sak_totalrp,2);
						}
				?>
								<tr>
									<td height="30px" colspan="5"><h5 align="right">GRAND TOTAL</h5></td>
									<td height="10px" align="right"><?= number_format($grandtotal_saw_qty,2); ?></td>
									<td height="10px" align="right"><?= number_format($grandtotal_saw_rp,2); ?></td>
									<td height="10px" align="right">-</td>
									<td height="10px" align="right"><?= number_format($grandtotal_lpb_qty,2); ?></td>
									<td height="10px" align="right"><?= number_format($grandtotal_lpb_rp,2); ?></td>
									<td height="10px" align="right">-</td>
									<td height="10px" align="right"><?= number_format($grandtotal_bkb_qty,2); ?></td>
									<td height="10px" align="right"><?= number_format($grandtotal_bkb_rp,2); ?></td>
									<td height="10px" align="right"><?= number_format($grandtotal_sak_qty,2); ?></td>
									<td height="10px" align="right"><?= number_format($grandtotal_sak_rp,2); ?></td>
									<td height="10px" align="right"></td>
								</tr>
							</tbody>
						</table>
				<?php
					}
				?>
				<br>
				<table width="70%" align="left" border="0">
					<thead>
						<tr>
							<td align="center">Disetujui Oleh,</td>
							<td align="center" colspan="2">Diperiksa Oleh,</td>
							<td align="center">Dibuat Oleh,</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td height="100px" valign="bottom" align="center">(________________________)</td>
							<td height="100px" valign="bottom" align="center">(________________________)</td>
							<td height="100px" valign="bottom" align="center">(________________________)</td>
							<td height="100px" valign="bottom" align="center">(________________________)</td>
						</tr>
						<tr>
							<td align="center">GM</td>
							<td align="center">KTU</td>
							<td align="center">Kasie Gudang</td>
							<td align="center">Krani</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
<script src="<?php echo base_url(); ?>assets/printjs/print.min.js"></script>