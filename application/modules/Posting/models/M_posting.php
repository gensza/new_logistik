<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_posting extends CI_Model
{

      public function __construct()
      {
            parent::__construct();
      }

      function posting_ke_gl()
      {
            /* LPB */
            $itemLpb = $this->db_logistik_pt->query("SELECT id, ttgtxt, txtperiode, kode_dev, noref, kodebar, refpo, norefppo, qty, nabar, refpo, lokasi FROM masukitem WHERE posting=0")->result();
            foreach ($itemLpb as $d) {
                  # code...
                  $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';
                  $header_entry["date"] = date("Y-m-d");
                  $header_entry["periode"] = $periodes;
                  $header_entry["ref"] = 'LPB-' . $d->ttgtxt;
                  $header_entry["totaldr"] = 0;
                  $header_entry["totalcr"] = 0;
                  $header_entry["periodetxt"] = $d->txtperiode;
                  $header_entry["modul"] = 'LOGISTIK';
                  $header_entry["lokasi"] = $d->lokasi;
                  $header_entry["SBU"] = $d->kode_dev;
                  $header_entry["USER"] = $this->session->userdata('user');
                  $header_entry["noref"] = $d->noref;
                  $this->db_mips_gl->insert('header_entry', $header_entry);


                  //var untuk save ke entry
                  $header_lpb = $this->db_logistik_pt->query("SELECT jenis_lpb FROM stokmasuk WHERE noref='$d->noref'")->row();
                  if ($header_lpb->jenis_lpb == '1') {
                        $tb_mutasi = $this->db_logistik_center->query("SELECT NO_REF FROM tb_mutasi WHERE no_mutasi='$d->refpo'")->row_array();
                        $tb_item_mutasi = $this->db_logistik_center->query("SELECT qty2, nilai_item FROM tb_mutasi_item WHERE kodebar='$d->kodebar' AND NO_REF='$tb_mutasi[NO_REF]'")->row_array();
                        $harga_item_po = $tb_item_mutasi['nilai_item'] / $tb_item_mutasi['qty2'];
                  } else {
                        // $result_harga_item_po = $this->M_lpb->cari_harga_po($no_ref_po, $kodebar, $noref_ppo);
                        $result_harga_item_po = $this->db_logistik_pt->query("SELECT harga FROM item_po WHERE kodebar='$d->kodebar' AND noref='$d->refpo' AND refppo='$d->norefppo' ")->row_array();
                        $harga_item_po = $result_harga_item_po['harga'];
                  }

                  $totharga = $harga_item_po * $d->qty;
                  $noac = $this->db_mips_gl->query("SELECT * FROM noac WHERE `noac` LIKE $d->kodebar ")->row_array();

                  //dr
                  $entry["date"] = date("Y-m-d");
                  $entry["sbu"] = $d->kode_dev;
                  $entry["noac"] = $noac['noac'];
                  $entry["desc"] = '';
                  $entry["group"] = $noac['group'];
                  $entry["type"] = $noac['type'];
                  $entry["level"] = $noac['level'];
                  $entry["general"] = $noac['general'];
                  $entry["dc"] = 'D';
                  $entry["dr"] = $totharga;
                  $entry["cr"] = 0;
                  $entry["periode"] = $periodes;
                  $entry["converse"] = 0;
                  $entry["ref"] = 'LPB-' . $d->ttgtxt;
                  $entry["noref"] = $d->noref;
                  $entry["descac"] = $d->nabar;
                  $entry["ket"] = 'Persediaan No.PO:' . $d->refpo;
                  $entry["begindr"] = 0;
                  $entry["begincr"] = 0;
                  $entry["kurs"] = '';
                  $entry["kursrate"] = '';
                  $entry["tglkurs"] = '';
                  $entry["periodetxt"] = $d->txtperiode;
                  $entry["module"] = 'LOGISTIK';
                  $entry["lokasi"] = $d->lokasi;
                  $entry["POST"] = 0;
                  $entry["tglinput"] = date("Y-m-d H:i:s");
                  $entry["USER"] = $this->session->userdata('user');
                  $entry["kodebar"] = $d->kodebar;
                  $this->db_mips_gl->insert('entry', $entry);

                  //CR
                  $entry2["date"] = date("Y-m-d");
                  $entry2["sbu"] = $d->kode_dev;
                  $entry2["noac"] = $noac['noac'];
                  $entry2["desc"] = '';
                  $entry2["group"] = $noac['group'];
                  $entry2["type"] = $noac['type'];
                  $entry2["level"] = $noac['level'];
                  $entry2["general"] = $noac['general'];
                  $entry2["dc"] = 'C';
                  $entry2["dr"] = 0;
                  $entry2["cr"] = $totharga;
                  $entry2["periode"] = $periodes;
                  $entry2["converse"] = 0;
                  $entry2["ref"] = 'LPB-' . $d->ttgtxt;
                  $entry2["noref"] = $d->noref;
                  $entry2["descac"] = $d->nabar;
                  $entry2["ket"] = 'Persediaan No.PO:' . $d->refpo;
                  $entry2["begindr"] = 0;
                  $entry2["begincr"] = 0;
                  $entry2["kurs"] = '';
                  $entry2["kursrate"] = '';
                  $entry2["tglkurs"] = '';
                  $entry2["periodetxt"] = $d->txtperiode;
                  $entry2["module"] = 'LOGISTIK';
                  $entry2["lokasi"] = $d->lokasi;
                  $entry2["POST"] = 0;
                  $entry2["tglinput"] = date("Y-m-d H:i:s");
                  $entry2["USER"] = $this->session->userdata('user');
                  $entry2["kodebar"] = $d->kodebar;
                  $this->db_mips_gl->insert('entry', $entry2);

                  $data_item_lpb = array(
                        'posting' => 1
                  );
                  $this->db_logistik_pt->where('id', $d->id);
                  $this->db_logistik_pt->update('masukitem', $data_item_lpb);
            }

            return TRUE;


            /* END */
      }

      public function get_data_lpb()
      {
            $txtperiode = $this->session->userdata('ym_periode');

            $this->db_logistik_pt->select();
            $this->db_logistik_pt->where(['txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockmasuk');
            return $this->db_logistik_pt->get()->result_array();
      }

      public function get_stok_periode($txtperiode)
      {
            $this->db_logistik_pt->select('kodebar');
            $this->db_logistik_pt->where(['txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal');
            return $this->db_logistik_pt->get()->num_rows();
      }

      public function getLpb()
      {
            $periode = $this->session->userdata('ym_periode');
            $data = $this->db_logistik_pt->query("SELECT * FROM stokmasuk WHERE txtperiode1='$periode'")->result();
            return $data;
      }

      public function getItemLpb()
      {
            $periode = $this->session->userdata('ym_periode');
            $data = $this->db_logistik_pt->query("SELECT i.kodebar, i.nabar, i.satuan, i.grp, i.refpo, i.qty, i.ttgtxt, i.ket, i.norefppo, i.kode_dev, i.noref, i.id_user, i.devisi, i.txttgl, i.kdpt, i.pt, i.lokasi, i.USER, s.jenis_lpb FROM masukitem i LEFT JOIN stokmasuk s ON i.noref=s.noref WHERE i.txtperiode='$periode'")->result();
            return $data;
      }

      public function getdataBkb()
      {
            $periode = $this->session->userdata('ym_periode');
            $data = $this->db_logistik_pt->query("SELECT kodebar, nabar, satuan, grp, qty2, tgl, txttgl, skb, ket, NO_REF, txtperiode, qty2, kode_dev, devisi, kodept, pt, id_user, USER, periode FROM keluarbrgitem WHERE txtperiode='$periode'")->result();
            return $data;
      }

      public function delete_stokawal()
      {
            $periode = $this->session->userdata('ym_periode');
            return $this->db_logistik_pt->delete('stockawal', array('txtperiode' => $periode));
      }

      public function cari_harga_mutasi($no_ref_po, $kodebar)
      {
            //mencari NOREF karna di tb_mutasi item tidak ada no_mutasi
            $this->db_logistik_center->select('NO_REF');
            $this->db_logistik_center->where(['no_mutasi' => $no_ref_po]);
            $this->db_logistik_center->from('tb_mutasi');
            $data_tb_mutasi = $this->db_logistik_center->get()->row_array();

            $this->db_logistik_center->select('qty2, nilai_item');
            $this->db_logistik_center->where(['kodebar' => $kodebar, 'NO_REF' => $data_tb_mutasi['NO_REF']]);
            $this->db_logistik_center->from('tb_mutasi_item');
            $data = $this->db_logistik_center->get()->row_array();

            $harga = $data['nilai_item'] / $data['qty2'];
            return $harga;
      }

      public function cari_harga_po($no_ref_po, $kodebar, $norefppo)
      {
            $this->db_logistik_pt->select('harga');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'noref' => $no_ref_po, 'refppo' => $norefppo]);
            $this->db_logistik_pt->from('item_po');
            return $this->db_logistik_pt->get()->row_array();
      }

      public function saveRegisterStok($data_register_stok)
      {
            return $this->db_logistik_pt->insert('register_stok', $data_register_stok);
      }

      public function saveStokAwalHarian($data)
      {
            return $this->db_logistik_pt->insert('stockawal_harian', $data);
      }

      public function updateStokAwal($data_update, $kodebar, $txtperiode)
      {
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            return $this->db_logistik_pt->update('stockawal', $data_update);
      }

      public function saveStokAwalBulananDevisi($data)
      {
            return $this->db_logistik_pt->insert('stockawal_bulanan_devisi', $data);
      }

      public function sum_harga_kodebar_harian($kodebar, $txtperiode)
      {
            $this->db_logistik_pt->select_sum('nilai_masuk', 'nilai_masuk');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal_harian');
            $return_saldo_awal_harian = $this->db_logistik_pt->get()->row();

            $this->db_logistik_pt->select_sum('nilai_keluar', 'nilai_keluar');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal_harian');
            $return_nilaikeluar_stockawal =  $this->db_logistik_pt->get()->row();

            $sum_saldo_nilai_stockawal = $return_saldo_awal_harian->nilai_masuk - $return_nilaikeluar_stockawal->nilai_keluar;

            return $sum_saldo_nilai_stockawal;
      }

      public function sum_saldo_qty_kodebar_harian($kodebar, $txtperiode)
      {
            $this->db_logistik_pt->select_sum('QTY_MASUK', 'qty_masuk');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal_harian');
            $return_saldo_qty_harian =  $this->db_logistik_pt->get()->row();

            $this->db_logistik_pt->select_sum('QTY_KELUAR', 'qty_keluar');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal_harian');
            $return_saldo_qty_stockawal =  $this->db_logistik_pt->get()->row();

            $sum_saldo_qty_stockawal = $return_saldo_qty_harian->qty_masuk - $return_saldo_qty_stockawal->qty_keluar;

            return $sum_saldo_qty_stockawal;
      }

      public function sum_nilai_masuk_harian($kodebar, $txtperiode)
      {
            $this->db_logistik_pt->select_sum('nilai_masuk', 'nilai_masuk_harian');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal_harian');
            return $this->db_logistik_pt->get()->row();
      }

      public function sum_qty_kodebar_harian($kodebar, $txtperiode)
      {
            $this->db_logistik_pt->select_sum('QTY_MASUK', 'qty_harian');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal_harian');
            return $this->db_logistik_pt->get()->row();
      }

      public function cek_stokawal_harian($kodebar, $periode, $kode_dev)
      {
            $this->db_logistik_pt->select('kodebar');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_harian');
            return $this->db_logistik_pt->get()->num_rows();
      }

      public function updateStokAwalHarian($kodebar, $periode, $txtperiode, $qty, $harga, $kode_dev)
      {
            //stok awal harian
            $this->db_logistik_pt->select_sum('QTY_MASUK', 'qtymasuk');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_harian');
            $sum_harian_qty = $this->db_logistik_pt->get()->row();

            $this->db_logistik_pt->select_sum('saldoakhir_qty', 'saldoqty');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_harian');
            $sum_harian_saldo_qty = $this->db_logistik_pt->get()->row();

            $this->db_logistik_pt->select_sum('saldoakhir_nilai', 'nilai_saldo_awal');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_harian');
            $sum_harian_nilai = $this->db_logistik_pt->get()->row();

            $this->db_logistik_pt->select_sum('nilai_masuk', 'nilaimasuk');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_harian');
            $sum_nilai_masuk = $this->db_logistik_pt->get()->row();

            $harga_stok_awal = $harga * $qty;

            //saldoakhir_nilai
            $saldo_awal_harian = $sum_harian_nilai->nilai_saldo_awal + $harga_stok_awal;

            //saldoakhir_qty
            $saldo_total_harian = $sum_harian_saldo_qty->saldoqty + $qty;

            //nilai_masuk
            $saldo_nilai_masuk = $sum_nilai_masuk->nilaimasuk + $harga_stok_awal;

            //QTY_MASUK
            $total_harian = $sum_harian_qty->qtymasuk + $qty;

            $this->db_logistik_pt->set('saldoakhir_nilai', $saldo_awal_harian);
            $this->db_logistik_pt->set('saldoakhir_qty', $saldo_total_harian);
            $this->db_logistik_pt->set('nilai_masuk', $saldo_nilai_masuk);
            $this->db_logistik_pt->set('QTY_MASUK', $total_harian);
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
            return $this->db_logistik_pt->update('stockawal_harian');
      }

      public function cek_stok_awal_bulanan_devisi($kodebar, $txtperiode, $kode_dev)
      {
            $this->db_logistik_pt->select('kodebar');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_bulanan_devisi');
            return $this->db_logistik_pt->get()->num_rows();
      }

      public function updateStokAwalBulananDevisi($kodebar, $txtperiode, $qty, $kode_dev)
      {
            $this->db_logistik_pt->select('QTY_MASUK, saldoakhir_qty');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_bulanan_devisi');
            $stok_awal = $this->db_logistik_pt->get()->row();

            $total_qty = $stok_awal->QTY_MASUK + $qty;
            $total_saldo_qty = $stok_awal->saldoakhir_qty + $qty;

            $this->db_logistik_pt->set('QTY_MASUK', $total_qty);
            $this->db_logistik_pt->set('saldoakhir_qty', $total_saldo_qty);
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
            return $this->db_logistik_pt->update('stockawal_bulanan_devisi');
      }

      public function cari_kodebar($kodebar, $txtperiode)
      {
            $this->db_logistik_pt->select('kodebar');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal');
            return $this->db_logistik_pt->get()->num_rows();
      }

      public function nilai_keluarbrgitem_untuk_register($kodebar, $NO_REF, $txtperiode)
      {
            $this->db_logistik_pt->select('nilai_item, qty2');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'NO_REF' => $NO_REF, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('keluarbrgitem');
            $item = $this->db_logistik_pt->get()->row_array();

            $rata2 = $item['nilai_item'] / $item['qty2'];

            return $rata2;
      }

      public function cek_stockawal_bkb($kodebar, $txtperiode, $kode_dev)
      {
            $this->db_logistik_pt->select('saldoakhir_qty, saldoakhir_nilai');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_bulanan_devisi');
            $stock_awal_num_rows = $this->db_logistik_pt->get()->num_rows();

            $this->db_logistik_pt->select('saldoakhir_qty, saldoakhir_nilai');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal');
            $stock_awal = $this->db_logistik_pt->get()->row_array();

            if ($stock_awal_num_rows >= 1) {
                  if ($stock_awal['saldoakhir_nilai'] == 0 or $stock_awal['saldoakhir_qty'] == 0) {
                        $result = 0;
                        return $result;
                  } else {
                        $result = 1;
                        return $result;
                  }
            } else {
                  $result = 0;
                  return $result;
            }
      }

      public function get_rata2_nilai_bkb($kodebar, $qty2, $txtperiode)
      {
            // $this->db_logistik_pt->select('saldoakhir_qty, saldoakhir_nilai');
            // $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode <=' => $txtperiode]);
            // $this->db_logistik_pt->from('stockawal');
            // $stock_awal = $this->db_logistik_pt->get()->row_array();

            $sql_rata2 = "SELECT SUM(saldoakhir_nilai) AS saldoakhir_nilai, SUM(saldoakhir_qty) AS saldoakhir_qty FROM stockawal WHERE txtperiode <= '$txtperiode' AND kodebar = '$kodebar'";
            $stock_awal = $this->db_logistik_pt->query($sql_rata2)->row_array();

            $rata2 = $stock_awal['saldoakhir_nilai'] / $stock_awal['saldoakhir_qty'];

            $jumlah_nilai =  $qty2 * $rata2;

            return $jumlah_nilai;
      }

      public function update_stockawal_bulanan_devisi($kodebar, $qty2, $txtperiode, $kode_dev)
      {
            $this->db_logistik_pt->select('QTY_KELUAR, saldoakhir_qty');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_bulanan_devisi');
            $stock_awal = $this->db_logistik_pt->get()->row_array();

            $jumlah = $stock_awal['QTY_KELUAR'] + $qty2;

            $saldoakhir_qty = $stock_awal['saldoakhir_qty'] - $qty2;

            $this->db_logistik_pt->set('QTY_KELUAR', $jumlah);
            $this->db_logistik_pt->set('saldoakhir_qty', $saldoakhir_qty);
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode, 'kode_dev' => $kode_dev]);
            return $this->db_logistik_pt->update('stockawal_bulanan_devisi');
      }

      public function update_stockawal_harian($kodebar, $qty2, $kode_dev, $periode, $txtperiode)
      {
            //mencari harga rata2
            $harga_stok_awal = $this->get_rata2_nilai_bkb($kodebar, $qty2, $txtperiode);

            $this->db_logistik_pt->select_sum('saldoakhir_nilai', 'nilai_saldo_awal');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_harian');
            $sum_harian_nilai = $this->db_logistik_pt->get()->row();

            $this->db_logistik_pt->select_sum('saldoakhir_qty', 'saldoqty');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_harian');
            $sum_harian_saldo_qty = $this->db_logistik_pt->get()->row();

            $this->db_logistik_pt->select_sum('nilai_keluar', 'nilaikeluar');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_harian');
            $sum_nilai_keluar = $this->db_logistik_pt->get()->row();

            $this->db_logistik_pt->select_sum('QTY_KELUAR', 'qtykeluar');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
            $this->db_logistik_pt->from('stockawal_harian');
            $sum_qty_keluar = $this->db_logistik_pt->get()->row();

            //saldoakhir_nilai
            $saldo_total_harian_nilai = $sum_harian_nilai->nilai_saldo_awal - $harga_stok_awal;

            //saldoakhir_qty
            $saldo_total_harian_qty = $sum_harian_saldo_qty->saldoqty - $qty2;

            //nilai_keluar
            $saldo_nilai_masuk = $sum_nilai_keluar->nilaikeluar + $harga_stok_awal;

            //QTY_Keluar
            $saldo_qty_keluar = $sum_qty_keluar->qtykeluar + $qty2;

            $this->db_logistik_pt->set('saldoakhir_nilai', $saldo_total_harian_nilai);
            $this->db_logistik_pt->set('saldoakhir_qty', $saldo_total_harian_qty);
            $this->db_logistik_pt->set('nilai_keluar', $saldo_nilai_masuk);
            $this->db_logistik_pt->set('QTY_KELUAR', $saldo_qty_keluar);
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'periode' => $periode, 'kode_dev' => $kode_dev]);
            return $this->db_logistik_pt->update('stockawal_harian');
      }

      public function sum_harga_kodebar_harian_bkb($kodebar, $txtperiode)
      {
            $this->db_logistik_pt->select_sum('nilai_masuk', 'nilaimasuk');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal_harian');
            $return_nilai_masuk = $this->db_logistik_pt->get()->row();

            $this->db_logistik_pt->select_sum('nilai_keluar', 'nilaikeluar');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal_harian');
            $return_nilai_keluar =  $this->db_logistik_pt->get()->row();

            $sum_saldo_nilai_stockawal = $return_nilai_masuk->nilaimasuk - $return_nilai_keluar->nilaikeluar;
            return $sum_saldo_nilai_stockawal;
      }

      public function sum_saldo_qty_kodebar_harian_bkb($kodebar, $txtperiode)
      {
            $this->db_logistik_pt->select_sum('QTY_MASUK', 'qty_masuk');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal_harian');
            $return_qty_masuk = $this->db_logistik_pt->get()->row();

            $this->db_logistik_pt->select_sum('QTY_KELUAR', 'qty_keluar');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal_harian');
            $return_qty_keluar =  $this->db_logistik_pt->get()->row();

            $sum_saldo_qty_stockawal = $return_qty_masuk->qty_masuk - $return_qty_keluar->qty_keluar;
            return $sum_saldo_qty_stockawal;
      }

      public function sum_nilai_keluar_harian_bkb($kodebar, $txtperiode)
      {
            $this->db_logistik_pt->select_sum('nilai_keluar', 'nilai_keluar_harian');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal_harian');
            return $this->db_logistik_pt->get()->row();
      }

      public function sum_qty_kodebar_harian_bkb($kodebar, $txtperiode)
      {
            $this->db_logistik_pt->select_sum('QTY_KELUAR', 'qty_keluar');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'txtperiode' => $txtperiode]);
            $this->db_logistik_pt->from('stockawal_harian');
            return $this->db_logistik_pt->get()->row();
      }

      function get_data_masukitem()
      {
            $txtperiode = $this->session->userdata('ym_periode');
            $status_lokasi = $this->session->userdata('status_lokasi');

            $query = "SELECT masukitem.ttg, masukitem.noref, masukitem.nabar, masukitem.kode_dev, masukitem.refpo, masukitem.noref, masukitem.norefppo, masukitem.kodebar, .masukitem.qty, stokmasuk.kode_supply, stokmasuk.nama_supply, stokmasuk.jenis_lpb FROM masukitem LEFT JOIN stokmasuk ON masukitem.noref = stokmasuk.noref WHERE txtperiode = '$txtperiode' AND stokmasuk.lokasi = '$status_lokasi'";
            $result = $this->db_logistik_pt->query($query)->result_array();
            return $result;
      }

      function delete_header_entry()
      {
            $txtperiode = $this->session->userdata('ym_periode');

            $tahun  = substr($txtperiode, 0, 4);
            $bln  = substr($txtperiode, 4, 6);

            $periode_nya = $tahun . '-' . $bln . '-' . '01';
            $query = "DELETE FROM header_entry WHERE periode = '$periode_nya'";
            $result = $this->db_mips_gl->query($query);
            return $result;
      }

      function delete_entry()
      {
            $txtperiode = $this->session->userdata('ym_periode');

            $tahun  = substr($txtperiode, 0, 4);
            $bln  = substr($txtperiode, 4, 6);

            $periode_nya = $tahun . '-' . $bln . '-' . '01';
            $query = "DELETE FROM `entry` WHERE periode = '$periode_nya'";
            $result = $this->db_mips_gl->query($query);
            return $result;
      }

      function cek_header_entry($noref)
      {
            $noref = $noref['noref'];
            $query = "SELECT noref FROM header_entry WHERE noref = '$noref'";
            $result = $this->db_mips_gl->query($query)->num_rows();
            return $result;
      }

      public function insert_lpb_to_header_entry_gl($data)
      {
            return $this->db_mips_gl->insert('header_entry', $data);
      }

      public function get_data_noac_gl($kodebar)
      {
            $this->db_logistik_center->select('noac, nama, group, type, level, general');
            $this->db_logistik_center->where(['noac' => $kodebar]);
            $this->db_logistik_center->from('noac');
            return $this->db_logistik_center->get()->row_array();
      }

      public function insert_lpb_to_entry_gl_dr($data_entry, $ref)
      {
            $sql = $this->db_mips_gl->insert('entry', $data_entry);

            // setelah disave, sum entry untuk mendapatkan total dr nya yang diupdate ke header_entry
            if ($sql) {
                  $this->db_mips_gl->select_sum('dr', 'dr');
                  $this->db_mips_gl->where(['ref' => $ref]);
                  $this->db_mips_gl->from('entry');
                  $sum_dr = $this->db_mips_gl->get()->row();

                  $this->db_mips_gl->set('totaldr', $sum_dr->dr);
                  $this->db_mips_gl->where(['ref' => $ref]);
                  return $this->db_mips_gl->update('header_entry');
            } else {
                  return 0;
            }
      }

      public function get_data_noac_supplier($kode_supply)
      {
            //cari coa di supp
            $this->db_logistik_center->select('account');
            $this->db_logistik_center->where(['kode' => $kode_supply]);
            $this->db_logistik_center->from('supplier');
            $data_supply = $this->db_logistik_center->get()->row_array();

            $this->db_logistik_center->select('noac, nama, group, type, level, general');
            $this->db_logistik_center->where(['noac' => $data_supply['account']]);
            $this->db_logistik_center->from('noac');
            return $this->db_logistik_center->get()->row_array();
      }

      public function insert_lpb_to_entry_gl_cr($data_entry, $ref)
      {
            $sql = $this->db_mips_gl->insert('entry', $data_entry);

            // setelah disave, sum entry untuk mendapatkan total cr nya yang diupdate ke header_entry
            if ($sql) {
                  $this->db_mips_gl->select_sum('cr', 'cr');
                  $this->db_mips_gl->where(['ref' => $ref]);
                  $this->db_mips_gl->from('entry');
                  $sum_cr = $this->db_mips_gl->get()->row();

                  $this->db_mips_gl->set('totalcr', $sum_cr->cr);
                  $this->db_mips_gl->where(['ref' => $ref]);
                  return $this->db_mips_gl->update('header_entry');
            } else {
                  return 0;
            }
      }

      function get_data_keluarbrgitem()
      {
            $txtperiode = $this->session->userdata('ym_periode');
            $status_lokasi = $this->session->userdata('status_lokasi');
            if ($status_lokasi == 'HO') {
                  $lok = 'PST';
            } elseif ($status_lokasi == 'RO') {
                  $lok = 'ROM';
            } elseif ($status_lokasi == 'PKS') {
                  $lok = 'FAC';
            } else {
                  $lok = 'EST';
            }

            $query = "SELECT skb, kode_dev, NO_REF, kodebar, nabar, txtperiode, qty2, nobpb, ket, kodesub, ketsub FROM keluarbrgitem WHERE txtperiode = '$txtperiode' AND SUBSTR(NO_REF,1,3) = '$lok'";
            $result = $this->db_logistik_pt->query($query)->result_array();
            return $result;
      }

      public function get_rata2_nilai_untuk_register($kodebar, $txtperiode)
      {

            $sql_rata2 = "SELECT SUM(saldoakhir_nilai) AS saldoakhir_nilai, SUM(saldoakhir_qty) AS saldoakhir_qty FROM stockawal_harian WHERE txtperiode <= '$txtperiode' AND kodebar = '$kodebar'";
            $stock_awal = $this->db_logistik_pt->query($sql_rata2)->row_array();

            $rata2 = $stock_awal['saldoakhir_nilai'] / $stock_awal['saldoakhir_qty'];

            return $rata2;
      }

      public function insert_bkb_to_header_entry_gl($data)
      {
            return $this->db_mips_gl->insert('header_entry', $data);
      }

      public function insert_bkb_to_entry_gl_cr($data_entry, $noref)
      {
            $sql = $this->db_mips_gl->insert('entry', $data_entry);

            // setelah disave, sum entry untuk mendapatkan total cr nya yang diupdate ke header_entry
            if ($sql) {
                  $this->db_mips_gl->select_sum('cr', 'cr');
                  $this->db_mips_gl->where(['noref' => $noref]);
                  $this->db_mips_gl->from('entry');
                  $sum_cr = $this->db_mips_gl->get()->row();

                  $this->db_mips_gl->set('totalcr', $sum_cr->cr);
                  $this->db_mips_gl->where(['noref' => $noref]);
                  return $this->db_mips_gl->update('header_entry');
            } else {
                  return 0;
            }
      }

      public function get_data_noac_beban($kodesub)
      {
            // kalo di bkb sudah dapat noac nya
            $this->db_logistik_center->select('noac, group, type, level, general');
            $this->db_logistik_center->where(['noac' => $kodesub]);
            $this->db_logistik_center->from('noac');
            return $this->db_logistik_center->get()->row_array();
      }

      public function insert_bkb_to_entry_gl_dr($data_entry, $noref)
      {
            $sql = $this->db_mips_gl->insert('entry', $data_entry);

            // setelah disave, sum entry untuk mendapatkan total dr nya yang diupdate ke header_entry
            if ($sql) {
                  $this->db_mips_gl->select_sum('dr', 'dr');
                  $this->db_mips_gl->where(['noref' => $noref]);
                  $this->db_mips_gl->from('entry');
                  $sum_dr = $this->db_mips_gl->get()->row();

                  $this->db_mips_gl->set('totaldr', $sum_dr->dr);
                  $this->db_mips_gl->where(['noref' => $noref]);
                  return $this->db_mips_gl->update('header_entry');
            } else {
                  return 0;
            }
      }

      function get_data_retskbitem()
      {
            $txtperiode = $this->session->userdata('ym_periode');
            $status_lokasi = $this->session->userdata('status_lokasi');
            if ($status_lokasi == 'HO') {
                  $lok = 'PST';
            } elseif ($status_lokasi == 'RO') {
                  $lok = 'ROM';
            } elseif ($status_lokasi == 'PKS') {
                  $lok = 'FAC';
            } else {
                  $lok = 'EST';
            }

            $query = "SELECT ret_skbitem.noretur, ret_skbitem.norefretur, ret_skbitem.norefbkb, ret_skbitem.kodebar, ret_skbitem.nabar, ret_skbitem.qty, ret_skbitem.kodesub, ret_skbitem.ketsub, retskb.kode_dev FROM ret_skbitem LEFT JOIN retskb ON ret_skbitem.norefretur = retskb.norefretur WHERE txtperiode = '$txtperiode' AND SUBSTR(ret_skbitem.norefretur,1,3) = '$lok'";
            $result = $this->db_logistik_pt->query($query)->result_array();
            return $result;
      }

      public function cari_harga_bkb($no_ref_bkb, $kodebar)
      {
            $this->db_logistik_pt->select('qty2, nilai_item');
            $this->db_logistik_pt->where(['kodebar' => $kodebar, 'NO_REF' => $no_ref_bkb]);
            $this->db_logistik_pt->from('keluarbrgitem');
            $data = $this->db_logistik_pt->get()->row_array();

            $harga = $data['nilai_item'] / $data['qty2'];
            return $harga;
      }
}

/* End of file M_posting.php */
