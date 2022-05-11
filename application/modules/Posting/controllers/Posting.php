<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Posting
 *
 * @author ali&genza <alii180698@gmail.com> 2021/11
 */

class Posting extends CI_Controller
{

      public function __construct()
      {
            parent::__construct();
            $this->load->model('M_posting');


            $db_pt = check_db_pt();
            // $this->db_logistik = $this->load->database('db_logistik', TRUE);
            // $this->db_mips_gl = $this->load->database('db_mips_gl_' . $db_pt, TRUE);

            if ($this->session->userdata('kode_dev') == '01') {
                  $this->db_mips_gl = $this->load->database('db_mips_gl_' . $db_pt, TRUE); //HO
            } elseif ($this->session->userdata('kode_dev') == '02') {
                  $this->db_mips_gl = $this->load->database('mips_gl_' . $db_pt . '_ro', TRUE); //RO
            } elseif ($this->session->userdata('kode_dev') == '03') {
                  $this->db_mips_gl = $this->load->database('mips_gl_' . $db_pt . '_pks', TRUE); //PKS
            } else {
                  $this->db_mips_gl = $this->load->database('mips_gl_' . $db_pt . '_site', TRUE); //SITE
            }

            $this->db_logistik_center = $this->load->database('db_logistik_center', TRUE);
            $this->db_logistik_pt = $this->load->database('db_logistik_' . $db_pt, TRUE);
            $this->db_personalia = $this->load->database('db_personalia_' . $db_pt, TRUE);
            $this->db_conf_caba = $this->load->database('db_conf_caba', TRUE);
            if (!$this->session->userdata('id_user')) {
                  $pemberitahuan = "<div class='alert alert-warning'>Anda harus login dulu </div>";
                  $this->session->set_flashdata('pesan', $pemberitahuan);
                  redirect('Login');
            }
            date_default_timezone_set('Asia/Jakarta');
            $this->load->library('form_validation');
      }


      function auth_hitungstok()
      {
            $value = $this->input->post('pw');
            if ($value == "1") {
                  $data = TRUE;
            } else {
                  $data = FALSE;
            }
            echo json_encode($data);
      }

      function hitung_stok()
      {
            $data = "Oke siap";
            $periode = $this->session->userdata('Ymd_periode');
            $txtperiode = $this->session->userdata('ym_periode');
            $this->db_logistik_pt->delete('stockawal', array('txtperiode' => $txtperiode));
            $this->db_logistik_pt->delete('stockawal_harian', array('txtperiode' => $txtperiode));
            $this->db_logistik_pt->delete('stockawal_bulanan_devisi', array('txtperiode' => $txtperiode));
            $this->db_logistik_pt->delete('register_stok', array('txtperiode' => $txtperiode));

            /* ambil data lpn lalu di looping */
            $lpb = $this->M_posting->getItemLpb();
            foreach ($lpb as $d) {
                  $lpb_item['kodebar'] = $d->kodebar;
                  $lpb_item['nabar'] = $d->nabar;
                  $lpb_item['satuan'] = $d->satuan;
                  $lpb_item['grp'] = $d->grp;
                  $lpb_item['refpo'] = $d->refpo;
                  $lpb_item['qty'] = $d->qty;
                  $lpb_item['ttgtxt'] = $d->ttgtxt;
                  $lpb_item['ket'] = $d->ket;
                  $lpb_item['norefppo'] = $d->norefppo;
                  $lpb_item['kode_dev'] = $d->kode_dev;
                  $lpb_item['devisi'] = $d->devisi;
                  $lpb_item['noref'] = $d->noref;
                  $lpb_item['id_user'] = $d->id_user;
                  $jenis_lpb['jenis_lpb'] = $d->jenis_lpb;

                  /* mencari harga PO untuk di input */
                  if ($jenis_lpb['jenis_lpb'] == '1') {
                        $harga_item_po = $this->M_posting->cari_harga_mutasi($d->refpo, $d->kodebar);
                  } else {
                        $result_harga_item_po = $this->M_posting->cari_harga_po($d->refpo, $d->kodebar, $d->norefppo);
                        $harga_item_po = $result_harga_item_po['harga'];
                  }
                  /* end mencari harga PO untuk di input */

                  /* untuk insert ke register_stok */

                  $data_register_stok = [
                        'kodebar' => $d->kodebar,
                        'kodebartxt' => $d->kodebar,
                        'namabar' => $d->nabar,
                        'grup' => $d->grp,
                        'tgl' => $periode,
                        'tgltxt' => $d->txttgl,
                        'potxt' => '-',
                        'ttgtxt' => $d->ttgtxt,
                        'skbtxt' => '-',
                        'adjttgtxt' => '-',
                        'adjskbtxt' => '-',
                        'retttgtxt' => '-',
                        'retskbtxt' => '-',
                        'no_slrh' => $d->ttgtxt,
                        'ket' => $d->ket,
                        'harga' => $harga_item_po,
                        'qty' => $d->qty,
                        'masuk_qty' => $d->qty,
                        'masuk_qty' => $d->qty,
                        'keluar_qty' => '0',
                        'status' => 'LPB',
                        'kodept' => $d->kdpt,
                        'namapt' => $d->pt,
                        'devisi' => $d->devisi,
                        'kode_dev' => $d->kode_dev,
                        'txtperiode' => $txtperiode,
                        'lokasi' => $d->lokasi,
                        'refpo' => '-',
                        'noref' => $d->noref,
                        'id_user' => $d->id_user,
                        'USER' => $d->USER
                  ];
                  $register_stok = $this->M_posting->saveRegisterStok($data_register_stok);
                  /* end insert ke register_stok */

                  /* insert stockawal */
                  $insert_stokawal = $this->insert_stokawal($lpb_item['kodebar'], $lpb_item['nabar'], $lpb_item['satuan'], $lpb_item['grp'], $lpb_item['refpo'], $lpb_item['qty'], $jenis_lpb['jenis_lpb'], $lpb_item['norefppo'], $d->kdpt, $d->pt);
                  /* end insert stokawal */

                  /* insert stokawal harian */
                  $result_insert_stok_awal_harian = $this->insert_stok_awal_harian($lpb_item['kodebar'], $lpb_item['nabar'], $lpb_item['satuan'], $lpb_item['grp'], $lpb_item['refpo'], $lpb_item['qty'], $lpb_item['devisi'], $lpb_item['kode_dev'], $jenis_lpb['jenis_lpb'], $lpb_item['norefppo'], $d->kdpt, $d->pt);
                  /* end insert stokawal harian */

                  /* insert stokawal bulanan devisi */
                  $result_insert_stok_awal_bulanan = $this->insert_stok_awal_bulanan_devisi($lpb_item['kodebar'], $lpb_item['nabar'], $lpb_item['satuan'], $lpb_item['grp'], $lpb_item['qty'], $lpb_item['devisi'], $lpb_item['kode_dev'], $d->kdpt, $d->pt);
                  /* end insert stokawal bulanan devisi */

                  /* update stokawal */
                  $result_update_stok_awal = $this->update_stok_awal($lpb_item['kodebar'], $txtperiode);
                  /* end update stokawal */
            }

            /*  end lpb */

            $dt = [
                  'register_stok' => $register_stok,
                  'in_stokawal' => $insert_stokawal,
                  'in_stokawal_hari' => $result_insert_stok_awal_harian,
                  'in_stokawal_bln' => $result_insert_stok_awal_bulanan,
                  'updt_stokawal' => $result_update_stok_awal,
            ];

            echo json_encode($dt);
      }

      /* insert stockawal */
      function insert_stokawal($kodebar, $nabar, $satuan, $grp, $no_ref_po, $qty, $mutasi, $norefppo, $kdpt, $pt)
      {
            if ($mutasi == '1') {
                  $harga_item_po = $this->M_posting->cari_harga_mutasi($no_ref_po, $kodebar);
                  $saldoakhir_nilai = $harga_item_po * $qty;
            } else {
                  $harga_item_po = $this->M_posting->cari_harga_po($no_ref_po, $kodebar, $norefppo);
                  $saldoakhir_nilai = $harga_item_po['harga'] * $qty;
            }

            $periode = $this->session->userdata('Ymd_periode');
            $txtperiode = $this->session->userdata('ym_periode');

            // $pt = $this->session->userdata('pt');
            // $KODE = $this->session->userdata('kode_pt');
            $kodebar = $kodebar;

            $data_input_stock_awal["pt"] = $pt;
            $data_input_stock_awal["KODE"] = $kdpt;
            $data_input_stock_awal["afd"] = "-";
            $data_input_stock_awal["kodebar"] = $kodebar;
            $data_input_stock_awal["kodebartxt"] = $kodebar;
            $data_input_stock_awal["nabar"] = $nabar;
            $data_input_stock_awal["satuan"] = $satuan;
            $data_input_stock_awal["grp"] = $grp;
            $data_input_stock_awal["saldoawal_qty"] = 0;
            $data_input_stock_awal["saldoawal_nilai"] = 0;
            $data_input_stock_awal["tglinput"] = date("Y-m-d H:i:s");
            $data_input_stock_awal["thn"] = date("Y");
            $data_input_stock_awal["saldoakhir_qty"] = $qty;
            $data_input_stock_awal["saldoakhir_nilai"] = $saldoakhir_nilai;
            $data_input_stock_awal["nilai_masuk"] = 0;
            $data_input_stock_awal["nilai_keluar"] = 0;
            $data_input_stock_awal["QTY_MASUK"] = $qty;
            $data_input_stock_awal["QTY_KELUAR"] = "0";
            $data_input_stock_awal["HARGARAT"] = "0";
            $data_input_stock_awal["periode"] = $periode;
            $data_input_stock_awal["txtperiode"] = $txtperiode;
            $data_input_stock_awal["account"] = "-";
            $data_input_stock_awal["ket_account"] = "-";

            // stok awal nya di cek dulu!
            $cari_kodebar_stock_awal = $this->M_posting->cari_kodebar($kodebar, $txtperiode);

            if ($cari_kodebar_stock_awal == 0) {
                  return $this->db_logistik_pt->insert('stockawal', $data_input_stock_awal);
            }
      }
      /* end insert stock awal */

      /* insert stockawal_harian */
      function insert_stok_awal_harian($kodebar, $nabar, $sat, $grp, $no_ref_po, $qty, $devisi, $kode_dev, $mutasi, $norefppo, $kdpt, $pt)
      {

            if ($mutasi == '1') {
                  $harga_item_po = $this->M_posting->cari_harga_mutasi($no_ref_po, $kodebar);
                  $saldoakhir_nilai = $harga_item_po * $qty;
            } else {
                  $result_harga_item_po = $this->M_posting->cari_harga_po($no_ref_po, $kodebar, $norefppo);
                  $harga_item_po = $result_harga_item_po['harga'];
                  $saldoakhir_nilai = $harga_item_po * $qty;
            }

            $data_insert_stok_harian = [
                  'pt' => $pt,
                  'KODE' => $kdpt,
                  'devisi' => $devisi,
                  'kode_dev' => $kode_dev,
                  'afd' => '-',
                  'kodebar' => $kodebar,
                  'kodebartxt' => $kodebar,
                  'nabar' => $nabar,
                  'satuan' => $sat,
                  'grp' => $grp,
                  'saldoawal_qty' => 0,
                  'saldoawal_nilai' => 0,
                  'tglinput' => date("Y-m-d H:i:s"),
                  'thn' => date("Y"),
                  'saldoakhir_qty' => $qty,
                  'saldoakhir_nilai' => $saldoakhir_nilai,
                  'nilai_masuk' => $saldoakhir_nilai,
                  'QTY_MASUK' => $qty,
                  'periode' => $this->session->userdata('Ymd_periode'),
                  'txtperiode' => $this->session->userdata('ym_periode'),
                  'ket' => '-',
                  'account' => '-',
                  'ket_account' => '-',
                  'tgl_transaksi' => date("Y-m-d H:i:s")
            ];

            $cek_stokawal_harian = $this->M_posting->cek_stokawal_harian($kodebar, $data_insert_stok_harian['periode'], $kode_dev);

            if ($cek_stokawal_harian >= 1) {
                  //update stok awal harian
                  return $this->M_posting->updateStokAwalHarian($kodebar, $data_insert_stok_harian['periode'], $data_insert_stok_harian['txtperiode'], $qty, $harga_item_po, $kode_dev);
            } else {
                  //insert stok awal harian
                  return $this->M_posting->saveStokAwalHarian($data_insert_stok_harian);
            }
      }
      /* end insert stockawal_harian */

      /* insert stokawal bulanan devisi */
      function insert_stok_awal_bulanan_devisi($kodebar, $nabar, $sat, $grp, $qty, $devisi, $kode_dev, $kdpt, $pt)
      {
            $data_insert_stok_bulanan = [
                  'pt' => $pt,
                  'KODE' => $kdpt,
                  'devisi' => $devisi,
                  'kode_dev' => $kode_dev,
                  'afd' => '-',
                  'kodebar' => $kodebar,
                  'kodebartxt' => $kodebar,
                  'nabar' => $nabar,
                  'satuan' => $sat,
                  'grp' => $grp,
                  'saldoawal_qty' => 0,
                  'saldoawal_nilai' => 0,
                  'saldoakhir_qty' => $qty,
                  'tglinput' => date("Y-m-d H:i:s"),
                  'thn' => date("Y"),
                  'QTY_MASUK' => $qty,
                  'periode' => $this->session->userdata('Ymd_periode'),
                  'txtperiode' => $this->session->userdata('ym_periode'),
                  'ket' => '-',
                  'account' => '-',
                  'ket_account' => '-',
                  'tgl_transaksi' => date("Y-m-d H:i:s")
            ];

            $cek_stokawal_bulanan_devisi = $this->M_posting->cek_stok_awal_bulanan_devisi($kodebar, $data_insert_stok_bulanan['txtperiode'], $kode_dev);

            if ($cek_stokawal_bulanan_devisi >= 1) {
                  //update stok awal bulanan devisi
                  return $this->M_posting->updateStokAwalBulananDevisi($kodebar, $data_insert_stok_bulanan['txtperiode'], $qty, $kode_dev);
            } else {
                  //insert stok awal bulanan devisi
                  return $this->M_posting->saveStokAwalBulananDevisi($data_insert_stok_bulanan);
            }
      }
      /* end insert stokawal bulanan devisi */

      /* update stokawal */
      function update_stok_awal($kodebar, $txtperiode)
      {
            //saldoakhir_nilai
            $sum_harga_kodebar = $this->M_posting->sum_harga_kodebar_harian($kodebar, $txtperiode);

            //saldo akhir qty
            $sum_saldo_qty_kodebar = $this->M_posting->sum_saldo_qty_kodebar_harian($kodebar, $txtperiode);

            //nilai_masuk
            $sum_nilai_masuk = $this->M_posting->sum_nilai_masuk_harian($kodebar, $txtperiode);

            //qty masuk
            $sum_qty_kodebar = $this->M_posting->sum_qty_kodebar_harian($kodebar, $txtperiode);

            $data_update = [
                  'saldoakhir_nilai' => $sum_harga_kodebar,

                  'saldoakhir_qty' => $sum_saldo_qty_kodebar,

                  'nilai_masuk' => $sum_nilai_masuk->nilai_masuk_harian,

                  'QTY_MASUK' => $sum_qty_kodebar->qty_harian
            ];

            return $this->M_posting->updateStokAwal($data_update, $kodebar, $txtperiode);
      }
      /* end update stokawal */

      public function hitung_stok_bkb()
      {
            $bkb = $this->M_posting->getdataBkb();

            foreach ($bkb as $d) {

                  $bkb_item['kodebar'] = $d->kodebar;
                  $bkb_item['nabar'] = $d->nabar;
                  $bkb_item['grp'] = $d->grp;
                  $bkb_item['satuan'] = $d->satuan;
                  $bkb_item['tgl'] = $d->tgl;
                  $bkb_item['periode'] = $d->periode;
                  $bkb_item['txttgl'] = $d->txttgl;
                  $bkb_item['skb'] = $d->skb;
                  $bkb_item['ket'] = $d->ket;
                  $bkb_item['NO_REF'] = $d->NO_REF;
                  $bkb_item['txtperiode'] = $d->txtperiode;
                  $bkb_item['qty2'] = $d->qty2;
                  $bkb_item['kode_dev'] = $d->kode_dev;
                  $bkb_item['devisi'] = $d->devisi;
                  $bkb_item['kodept'] = $d->kodept;
                  $bkb_item['pt'] = $d->pt;
                  $bkb_item['id_user'] = $d->id_user;
                  $bkb_item['USER'] = $d->USER;

                  // cari harga bkb
                  $nilai_keluarbrgitem_untuk_register = $this->M_posting->nilai_keluarbrgitem_untuk_register($d->kodebar, $d->NO_REF, $d->txtperiode);

                  $data_register_stok = [
                        'kodebar' => $d->kodebar,
                        'kodebartxt' => $d->kodebar,
                        'namabar' => $d->nabar,
                        'grup' => $d->grp,
                        'tgl' => $d->tgl,
                        'tgltxt' => $d->txttgl,
                        'potxt' => '-',
                        'ttgtxt' => $d->skb,
                        'skbtxt' => '-',
                        'adjttgtxt' => '-',
                        'adjskbtxt' => '-',
                        'retttgtxt' => '-',
                        'retskbtxt' => '-',
                        'no_slrh' => $d->skb,
                        'ket' => $d->ket,
                        'harga' => $nilai_keluarbrgitem_untuk_register,
                        'qty' => $d->qty2,
                        'masuk_qty' => '0',
                        'keluar_qty' => $d->qty2,
                        'status' => 'BKB',
                        'kodept' => $d->kodept,
                        'namapt' => $d->pt,
                        'kode_dev' => $d->kode_dev,
                        'devisi' => $d->devisi,
                        'txtperiode' => $d->txtperiode,
                        'lokasi' => $this->session->userdata('status_lokasi'),
                        'refpo' => '-',
                        'noref' => $d->NO_REF,
                        'id_user' => $d->id_user,
                        'USER' => $d->USER
                  ];

                  $saveregisterstok = $this->M_posting->saveRegisterStok($data_register_stok);

                  //cek apakah sudah ada barang nya atau belum di stockawal
                  $cek_stockawal = $this->M_posting->cek_stockawal_bkb($bkb_item['kodebar'], $bkb_item['txtperiode'], $bkb_item['kode_dev']);
                  if ($cek_stockawal == 1) {
                        // mendapatkan nilai rata2
                        $nilai_keluarbrgitem = $this->M_posting->get_rata2_nilai_bkb($bkb_item['kodebar'], $bkb_item['qty2'], $bkb_item['txtperiode']);
                  } else {
                        //insert stokc awal dan dapatkan rata2 nya
                        $nilai_keluarbrgitem = $this->insert_stokawal_bkb($bkb_item['kodebar'], $bkb_item['nabar'], $bkb_item['satuan'], $bkb_item['grp'], $bkb_item['qty2'], $bkb_item['txtperiode']);
                  }

                  // insert/update stockawal_bulanan_devisi
                  $result_insert_stok_awal_bulanan = $this->insert_stok_awal_bulanan_devisi_bkb($bkb_item['kodebar'], $bkb_item['nabar'], $bkb_item['satuan'], $bkb_item['grp'], $bkb_item['qty2'], $bkb_item['devisi'], $bkb_item['kode_dev']);

                  // insert/update stockawal_harian
                  $result_insert_stok_awal_harian = $this->insert_stok_awal_harian_bkb($bkb_item['kodebar'], $bkb_item['nabar'], $bkb_item['satuan'], $bkb_item['grp'], $bkb_item['qty2'], $bkb_item['devisi'], $bkb_item['kode_dev'], $bkb_item['periode'], $bkb_item['txtperiode']);

                  //update stokawal
                  $result_update_stok_awal = $this->update_stok_awal_bkb($bkb_item['kodebar'], $bkb_item['txtperiode']);
            }


            $dt = [
                  'register_stok' => $saveregisterstok,
                  'in_stokawal' => $nilai_keluarbrgitem,
                  'in_stokawal_hari' => $result_insert_stok_awal_harian,
                  'in_stokawal_bln' => $result_insert_stok_awal_bulanan,
                  'updt_stokawal' => $result_update_stok_awal,
            ];

            echo json_encode($dt);
      }

      function update_stok_awal_bkb($kodebar, $txtperiode)
      {

            //saldoakhir_nilai
            $sum_harga_kodebar = $this->M_posting->sum_harga_kodebar_harian_bkb($kodebar, $txtperiode);

            //saldo akhir qty
            $sum_saldo_qty_kodebar = $this->M_posting->sum_saldo_qty_kodebar_harian_bkb($kodebar, $txtperiode);

            //nilai_masuk
            $sum_nilai_keluar = $this->M_posting->sum_nilai_keluar_harian_bkb($kodebar, $txtperiode);

            //qty masuk
            $sum_qty_kodebar = $this->M_posting->sum_qty_kodebar_harian_bkb($kodebar, $txtperiode);

            $data_update = [
                  'saldoakhir_nilai' => $sum_harga_kodebar,

                  'saldoakhir_qty' => $sum_saldo_qty_kodebar,

                  'nilai_keluar' => $sum_nilai_keluar->nilai_keluar_harian,

                  'QTY_KELUAR' => $sum_qty_kodebar->qty_keluar
            ];

            return $this->M_posting->updateStokAwal($data_update, $kodebar, $txtperiode);
      }

      function insert_stok_awal_harian_bkb($kodebar, $nabar, $satuan, $grup_brg, $qty2, $devisi, $kode_dev, $tgl, $txtperiode)
      {

            $nilai_keluarbrgitem = $this->M_posting->get_rata2_nilai_bkb($kodebar, $qty2, $txtperiode);

            $data_insert_stok_harian = [
                  'pt' => $this->session->userdata('pt'),
                  'KODE' => $this->session->userdata('kode_pt'),
                  'devisi' => $devisi,
                  'kode_dev' => $kode_dev,
                  'afd' => '-',
                  'kodebar' => $kodebar,
                  'kodebartxt' => $kodebar,
                  'nabar' => $nabar,
                  'satuan' => $satuan,
                  'grp' => $grup_brg,
                  'saldoawal_qty' => 0,
                  'saldoawal_nilai' => 0,
                  'tglinput' => date("Y-m-d H:i:s"),
                  'thn' => date("Y"),
                  'saldoakhir_qty' => -$qty2, // sengaja dikasih mines
                  'saldoakhir_nilai' => -$nilai_keluarbrgitem, // sengaja dikasih mines
                  'nilai_keluar' => $nilai_keluarbrgitem,
                  'QTY_KELUAR' => $qty2,
                  'periode' => $tgl,
                  'txtperiode' => $txtperiode,
                  'ket' => '-',
                  'account' => '-',
                  'ket_account' => '-',
                  'tgl_transaksi' => date("Y-m-d H:i:s")
            ];

            $cek_stokawal_harian = $this->M_posting->cek_stokawal_harian($kodebar, $tgl, $kode_dev);

            if ($cek_stokawal_harian >= 1) {
                  //update stok awal harian
                  return $this->M_posting->update_stockawal_harian($kodebar, $qty2, $kode_dev, $tgl, $txtperiode);
            } else {
                  //insert stok awal harian
                  return $this->M_posting->saveStokAwalHarian($data_insert_stok_harian);
            }
      }

      function insert_stok_awal_bulanan_devisi_bkb($kodebar, $nabar, $sat, $grp, $qty2, $devisi, $kode_dev)
      {
            $data_insert_stok_bulanan = [
                  'pt' => $this->session->userdata('pt'),
                  'KODE' => $this->session->userdata('kode_pt'),
                  'devisi' => $devisi,
                  'kode_dev' => $kode_dev,
                  'afd' => '-',
                  'kodebar' => $kodebar,
                  'kodebartxt' => $kodebar,
                  'nabar' => $nabar,
                  'satuan' => $sat,
                  'grp' => $grp,
                  'saldoawal_qty' => 0,
                  'saldoawal_nilai' => 0,
                  'saldoakhir_qty' => -$qty2, // sengaja dikasih mines 
                  'tglinput' => date("Y-m-d H:i:s"),
                  'thn' => date("Y"),
                  'QTY_KELUAR' => $qty2,
                  'periode' => $this->session->userdata('Ymd_periode'),
                  'txtperiode' => $this->session->userdata('ym_periode'),
                  'ket' => '-',
                  'account' => '-',
                  'ket_account' => '-',
                  'tgl_transaksi' => date("Y-m-d H:i:s")
            ];

            $cek_stokawal_bulanan_devisi = $this->M_posting->cek_stok_awal_bulanan_devisi($kodebar, $data_insert_stok_bulanan['txtperiode'], $kode_dev);

            if ($cek_stokawal_bulanan_devisi >= 1) {
                  //update stok awal bulanan devisi
                  return $this->M_posting->update_stockawal_bulanan_devisi($kodebar, $qty2, $data_insert_stok_bulanan['txtperiode'], $kode_dev);
            } else {
                  //insert stok awal bulanan devisi
                  return $this->M_posting->saveStokAwalBulananDevisi($data_insert_stok_bulanan);
            }
      }

      function insert_stokawal_bkb($kodebar, $nabar, $satuan, $grp, $qty2, $txtperiode)
      {

            $nilai_keluarbrgitem = $this->M_posting->get_rata2_nilai_bkb($kodebar, $qty2, $txtperiode);

            $periode = $this->session->userdata('Ymd_periode');
            $txtperiode = $this->session->userdata('ym_periode');

            $pt = $this->session->userdata('pt');
            $KODE = $this->session->userdata('kode_pt');

            $data_input_stock_awal["pt"] = $pt;
            $data_input_stock_awal["KODE"] = $KODE;
            $data_input_stock_awal["afd"] = "-";
            $data_input_stock_awal["kodebar"] = $kodebar;
            $data_input_stock_awal["kodebartxt"] = $kodebar;
            $data_input_stock_awal["nabar"] = $nabar;
            $data_input_stock_awal["satuan"] = $satuan;
            $data_input_stock_awal["grp"] = $grp;
            $data_input_stock_awal["saldoawal_qty"] = 0;
            $data_input_stock_awal["saldoawal_nilai"] = 0;
            $data_input_stock_awal["tglinput"] = date("Y-m-d H:i:s");
            $data_input_stock_awal["thn"] = date("Y");
            $data_input_stock_awal["saldoakhir_qty"] = -$qty2; // sengaja dikasih mines
            $data_input_stock_awal["saldoakhir_nilai"] = -$nilai_keluarbrgitem; // sengaja dikasih mines
            $data_input_stock_awal["nilai_masuk"] = 0;
            $data_input_stock_awal["nilai_keluar"] = $nilai_keluarbrgitem;
            $data_input_stock_awal["QTY_MASUK"] = 0;
            $data_input_stock_awal["QTY_KELUAR"] = $qty2;
            $data_input_stock_awal["HARGARAT"] = 0;
            $data_input_stock_awal["periode"] = $periode;
            $data_input_stock_awal["txtperiode"] = $txtperiode;
            $data_input_stock_awal["account"] = "-";
            $data_input_stock_awal["ket_account"] = "-";

            $this->db_logistik_pt->insert('stockawal', $data_input_stock_awal);

            // mengembalikan nilai harga rata2 * qty
            return $nilai_keluarbrgitem;
      }

      public function transfer_to_gl()
      {
            //var untuk save ke header entry
            // $data = $this->M_posting->posting_ke_gl();

            // delete header entry
            $this->M_posting->delete_header_entry();

            // delete detail entry
            $this->M_posting->delete_entry();

            // LPB TO GL
            //get data masukitem
            $data_masukitem = $this->M_posting->get_data_masukitem();

            foreach ($data_masukitem as $d) {

                  // $mutasi_ga = substr($d['noref'], 8, 3);
                  $mutasi = $d['jenis_lpb'];

                  if ($mutasi == '1') {
                        $harga_item_po = $this->M_posting->cari_harga_mutasi($d['refpo'], $d['kodebar']);
                  } else {
                        $result_harga_item_po = $this->M_posting->cari_harga_po($d['refpo'], $d['kodebar'], $d['norefppo']);
                        $harga_item_po = $result_harga_item_po['harga'];
                  }

                  $result_insert_to_gl_header = $this->insert_lpb_to_header_entry_gl($d['ttg'], $d['kode_dev'], $d['noref']);
                  $result_insert_lpb_to_entry_gl_dr = $this->insert_lpb_to_entry_gl_dr($d['ttg'], $harga_item_po, $d['qty'], $d['kode_dev'], $d['kodebar'], $d['noref'], $d['nabar'], $d['refpo']);
                  $result_insert_lpb_to_entry_gl_cr = $this->insert_lpb_to_entry_gl_cr($d['ttg'], $harga_item_po, $d['qty'], $d['kode_dev'], $d['kodebar'], $d['noref'], $d['nabar'], $d['refpo'], $d['kode_supply'], $d['nama_supply'], $mutasi);
            }

            // BKB TO GL
            // get data keluarbrgitem
            $data_keluarbrgitem = $this->M_posting->get_data_keluarbrgitem();

            foreach ($data_keluarbrgitem as $d2) {

                  $nilai_keluarbrgitem_untuk_register = $this->M_posting->get_rata2_nilai_untuk_register($d['kodebar'], $d2['txtperiode']);

                  $result_insert_to_gl_header = $this->insert_bkb_to_header_entry_gl($d2['skb'], $d2['kode_dev'], $d2['NO_REF']);
                  $result_insert_bkb_to_entry_gl_cr = $this->insert_bkb_to_entry_gl_cr($d2['skb'], $nilai_keluarbrgitem_untuk_register, $d2['qty2'], $d2['kode_dev'], $d2['kodebar'], $d2['NO_REF'], $d2['nabar'], $d2['nobpb'], $d2['ket']);
                  $result_insert_bkb_to_entry_gl_dr = $this->insert_bkb_to_entry_gl_dr($d2['skb'], $nilai_keluarbrgitem_untuk_register, $d2['qty2'], $d2['kode_dev'], $d2['kodebar'], $d2['NO_REF'], $d2['nabar'], $d2['nobpb'], $d2['kodesub'], $d2['ketsub'], $d2['ket']);
            }

            // RETUR TO GL
            // get data retskbitem
            $data_retskbitem = $this->M_posting->get_data_retskbitem();

            foreach ($data_retskbitem as $d3) {
                  $harga_item_bkb = $this->M_posting->cari_harga_bkb($d3['norefbkb'], $d3['kodebar']);

                  $result_insert_to_gl_header = $this->insert_lpb_to_header_entry_gl($d3['noretur'], $d3['kode_dev'], $d3['norefretur']);
                  $result_insert_lpb_to_entry_gl_dr = $this->insert_lpb_to_entry_gl_dr($d3['noretur'], $harga_item_bkb, $d3['qty'], $d3['kode_dev'], $d3['kodebar'], $d3['norefretur'], $d3['nabar'], $d3['norefbkb']);
                  $result_insert_lpb_to_entry_gl_cr = $this->insert_lpb_retur_to_entry_gl_cr($d3['noretur'], $harga_item_bkb, $d3['qty'], $d3['kode_dev'], $d3['kodebar'], $d3['norefretur'], $d3['nabar'], $d3['norefbkb'], $d3['kodesub'], $d3['ketsub']);
            }

            $true_aja_deh = true;
            echo json_encode($true_aja_deh);
      }

      function insert_lpb_to_header_entry_gl($no_lpb, $kode_dev, $no_ref_lpb)
      {
            $periode = $this->session->userdata('Ymd_periode');
            $txtperiode = $this->session->userdata('ym_periode');
            $status_lokasi = $this->session->userdata('status_lokasi');
            $user = $this->session->userdata('user');

            $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';

            //var untuk save ke header entry
            $header_entry["date"] = date("Y-m-d");
            $header_entry["periode"] = $periodes;
            $header_entry["ref"] = 'LPB-' . $no_lpb;
            $header_entry["totaldr"] = 0;
            $header_entry["totalcr"] = 0;
            $header_entry["periodetxt"] = $txtperiode;
            $header_entry["modul"] = 'LOGISTIK';
            $header_entry["lokasi"] = $status_lokasi;
            $header_entry["SBU"] = $kode_dev;
            $header_entry["USER"] = $user;
            $header_entry["noref"] = $no_ref_lpb;

            //cek apakah sudah ada di header entry
            $cek_header_entry = $this->M_posting->cek_header_entry($header_entry);

            if ($cek_header_entry == 0) {
                  return $this->M_posting->insert_lpb_to_header_entry_gl($header_entry);
            } else {
                  return false;
            }
      }

      function insert_lpb_to_entry_gl_dr($no_lpb, $harga_item_po, $quantiti, $kode_dev, $kodebar, $no_ref_lpb, $nabar, $no_ref_po)
      {
            $periode = $this->session->userdata('Ymd_periode');
            $txtperiode = $this->session->userdata('ym_periode');
            $status_lokasi = $this->session->userdata('status_lokasi');
            $user = $this->session->userdata('user');

            $totharga = $harga_item_po * $quantiti;

            $data_noac_gl = $this->M_posting->get_data_noac_gl($kodebar);

            $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';

            //var untuk save ke entry
            $entry["date"] = date("Y-m-d");
            $entry["sbu"] = $kode_dev;
            $entry["noac"] = $data_noac_gl['noac'];
            $entry["desc"] = '';
            $entry["group"] = $data_noac_gl['group'];
            $entry["type"] = $data_noac_gl['type'];
            $entry["level"] = $data_noac_gl['level'];
            $entry["general"] = $data_noac_gl['general'];
            $entry["dc"] = 'D';
            $entry["dr"] = $totharga;
            $entry["cr"] = 0;
            $entry["periode"] = $periodes;
            $entry["converse"] = 0;
            $entry["ref"] = 'LPB-' . $no_lpb;
            $entry["noref"] = $no_ref_lpb;
            $entry["descac"] = $nabar;
            $entry["ket"] = 'Persediaan No.PO:' . $no_ref_po;
            $entry["begindr"] = 0;
            $entry["begincr"] = 0;
            $entry["kurs"] = '';
            $entry["kursrate"] = '';
            $entry["tglkurs"] = '';
            $entry["periodetxt"] = $txtperiode;
            $entry["module"] = 'LOGISTIK';
            $entry["lokasi"] = $status_lokasi;
            $entry["POST"] = 0;
            $entry["tglinput"] = date("Y-m-d H:i:s");
            $entry["USER"] = $user;
            $entry["kodebar"] = $kodebar;

            if ($data_noac_gl != NULL) {
                  return $this->M_posting->insert_lpb_to_entry_gl_dr($entry, $entry["ref"]);
            } else {
                  return 0;
            }
      }

      function insert_lpb_to_entry_gl_cr($no_lpb, $harga_item_po, $quantiti, $kode_dev, $kodebar, $no_ref_lpb, $nabar, $no_ref_po, $kode_supply, $nama_supply, $mutasi)
      {
            $periode = $this->session->userdata('Ymd_periode');
            $txtperiode = $this->session->userdata('ym_periode');
            $status_lokasi = $this->session->userdata('status_lokasi');
            $user = $this->session->userdata('user');

            $totharga = $harga_item_po * $quantiti;

            if ($mutasi == '1') {
                  $data_noac_gl = $this->M_posting->get_data_noac_gl($kode_supply);
            } else {
                  $data_noac_gl = $this->M_posting->get_data_noac_supplier($kode_supply);
            }

            $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';

            //var untuk save ke entry
            $entry["date"] = date("Y-m-d");
            $entry["sbu"] = $kode_dev;
            $entry["noac"] = $data_noac_gl['noac'];
            $entry["desc"] = '';
            $entry["group"] = $data_noac_gl['group'];
            $entry["type"] = $data_noac_gl['type'];
            $entry["level"] = $data_noac_gl['level'];
            $entry["general"] = $data_noac_gl['general'];
            $entry["dc"] = 'C';
            $entry["dr"] = 0;
            $entry["cr"] = $totharga;
            $entry["periode"] = $periodes;
            $entry["converse"] = 0;
            $entry["ref"] = 'LPB-' . $no_lpb;
            $entry["noref"] = $no_ref_lpb;
            $entry["descac"] = $data_noac_gl['nama'];
            $entry["ket"] = 'Hutang Supplier No.PO:' . $no_ref_po . '/' . $nabar;
            $entry["begindr"] = 0;
            $entry["begincr"] = 0;
            $entry["kurs"] = '';
            $entry["kursrate"] = '';
            $entry["tglkurs"] = '';
            $entry["periodetxt"] = $txtperiode;
            $entry["module"] = 'LOGISTIK';
            $entry["lokasi"] = $status_lokasi;
            $entry["POST"] = 0;
            $entry["tglinput"] = date("Y-m-d H:i:s");
            $entry["USER"] = $user;
            $entry["kodebar"] = $kodebar;

            if ($data_noac_gl != NULL) {
                  return $this->M_posting->insert_lpb_to_entry_gl_cr($entry, $entry["ref"]);
            } else {
                  return 0;
            }
      }

      function insert_bkb_to_header_entry_gl($no_bkb, $kode_dev, $no_ref_bkb)
      {
            $periode = $this->session->userdata('Ymd_periode');
            $txtperiode = $this->session->userdata('ym_periode');
            $status_lokasi = $this->session->userdata('status_lokasi');
            $user = $this->session->userdata('user');

            $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';

            //var untuk save ke header entry
            $header_entry["date"] = date("Y-m-d");
            $header_entry["periode"] = $periodes;
            $header_entry["ref"] = 'BKB-' . $no_bkb;
            $header_entry["totaldr"] = 0;
            $header_entry["totalcr"] = 0;
            $header_entry["periodetxt"] = $txtperiode;
            $header_entry["modul"] = 'LOGISTIK';
            $header_entry["lokasi"] = $status_lokasi;
            $header_entry["SBU"] = $kode_dev;
            $header_entry["USER"] = $user;
            $header_entry["noref"] = $no_ref_bkb;

            //cek apakah sudah ada di header entry
            $cek_header_entry = $this->M_posting->cek_header_entry($header_entry);

            if ($cek_header_entry == 0) {
                  return $this->M_posting->insert_bkb_to_header_entry_gl($header_entry);
            } else {
                  return false;
            }
      }

      function insert_bkb_to_entry_gl_cr($no_bkb, $harga_item_po, $quantiti, $kode_dev, $kodebar, $no_ref_bkb, $nabar, $no_ref_po, $ket)
      {
            $periode = $this->session->userdata('Ymd_periode');
            $txtperiode = $this->session->userdata('ym_periode');
            $status_lokasi = $this->session->userdata('status_lokasi');
            $user = $this->session->userdata('user');

            $totharga = $harga_item_po * $quantiti;

            $data_noac_gl = $this->M_posting->get_data_noac_gl($kodebar);

            $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';

            //var untuk save ke entry
            $entry["date"] = date("Y-m-d");
            $entry["sbu"] = $kode_dev;
            $entry["noac"] = $kodebar;
            $entry["desc"] = '';
            $entry["group"] = $data_noac_gl['group'];
            $entry["type"] = $data_noac_gl['type'];
            $entry["level"] = $data_noac_gl['level'];
            $entry["general"] = $data_noac_gl['general'];
            $entry["dc"] = 'C';
            $entry["dr"] = 0;
            $entry["cr"] = $totharga;
            $entry["periode"] = $periodes;
            $entry["converse"] = 0;
            $entry["ref"] = 'BKB-' . $no_bkb;
            $entry["noref"] = $no_ref_bkb;
            $entry["descac"] = $nabar;
            $entry["ket"] = 'BKB:' . $nabar . '(' . $quantiti . '/' . $totharga . ')/' . $ket;
            $entry["begindr"] = 0;
            $entry["begincr"] = 0;
            $entry["kurs"] = '';
            $entry["kursrate"] = '';
            $entry["tglkurs"] = '';
            $entry["periodetxt"] = $txtperiode;
            $entry["module"] = 'LOGISTIK';
            $entry["lokasi"] = $status_lokasi;
            $entry["POST"] = 0;
            $entry["tglinput"] = date("Y-m-d H:i:s");
            $entry["USER"] = $user;
            $entry["kodebar"] = $kodebar;

            if ($data_noac_gl != NULL) {
                  return $this->M_posting->insert_bkb_to_entry_gl_cr($entry, $entry["noref"]);
            } else {
                  return 0;
            }
      }

      function insert_bkb_to_entry_gl_dr($no_bkb, $harga_item_po, $quantiti, $kode_dev, $kodebar, $no_ref_bkb, $nabar, $no_ref_po, $kodesub, $ketsub, $ket)
      {
            $periode = $this->session->userdata('Ymd_periode');
            $txtperiode = $this->session->userdata('ym_periode');
            $status_lokasi = $this->session->userdata('status_lokasi');
            $user = $this->session->userdata('user');

            $totharga = $harga_item_po * $quantiti;

            $data_noac_gl = $this->M_posting->get_data_noac_beban($kodesub);

            $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';

            //var untuk save ke entry
            $entry["date"] = date("Y-m-d");
            $entry["sbu"] = $kode_dev;
            $entry["noac"] = $data_noac_gl['noac'];
            $entry["desc"] = '';
            $entry["group"] = $data_noac_gl['group'];
            $entry["type"] = $data_noac_gl['type'];
            $entry["level"] = $data_noac_gl['level'];
            $entry["general"] = $data_noac_gl['general'];
            $entry["dc"] = 'D';
            $entry["dr"] = $totharga;
            $entry["cr"] = 0;
            $entry["periode"] = $periodes;
            $entry["converse"] = 0;
            $entry["ref"] = 'BKB-' . $no_bkb;
            $entry["noref"] = $no_ref_bkb;
            $entry["descac"] = $ketsub;
            $entry["ket"] = 'BKB:' . $nabar . '(' . $quantiti . '/' . $totharga . ')/' . $ket;
            $entry["begindr"] = 0;
            $entry["begincr"] = 0;
            $entry["kurs"] = '';
            $entry["kursrate"] = '';
            $entry["tglkurs"] = '';
            $entry["periodetxt"] = $txtperiode;
            $entry["module"] = 'LOGISTIK';
            $entry["lokasi"] = $status_lokasi;
            $entry["POST"] = 0;
            $entry["tglinput"] = date("Y-m-d H:i:s");
            $entry["USER"] = $user;
            $entry["kodebar"] = $kodebar;

            if ($data_noac_gl != NULL) {
                  return $this->M_posting->insert_bkb_to_entry_gl_dr($entry, $entry["noref"]);
            } else {
                  return 0;
            }
      }

      function insert_lpb_retur_to_entry_gl_cr($no_lpb, $harga_item_po, $quantiti, $kode_dev, $kodebar, $no_ref_lpb, $nabar, $no_ref_po, $kodesub, $ketsub)
      {
            $periode = $this->session->userdata('Ymd_periode');
            $txtperiode = $this->session->userdata('ym_periode');
            $status_lokasi = $this->session->userdata('status_lokasi');
            $user = $this->session->userdata('user');

            $totharga = $harga_item_po * $quantiti;

            $data_noac_gl = $this->M_posting->get_data_noac_beban($kodesub);

            $periodes = substr($this->session->userdata('ym_periode'), 0, 4) . '-' . substr($this->session->userdata('ym_periode'), 4, 6) . '-01';

            //var untuk save ke entry
            $entry["date"] = date("Y-m-d");
            $entry["sbu"] = $kode_dev;
            $entry["noac"] = $data_noac_gl['noac'];
            $entry["desc"] = '';
            $entry["group"] = $data_noac_gl['group'];
            $entry["type"] = $data_noac_gl['type'];
            $entry["level"] = $data_noac_gl['level'];
            $entry["general"] = $data_noac_gl['general'];
            $entry["dc"] = 'C';
            $entry["dr"] = 0;
            $entry["cr"] = $totharga;
            $entry["periode"] = $periodes;
            $entry["converse"] = 0;
            $entry["ref"] = 'LPB-' . $no_lpb;
            $entry["noref"] = $no_ref_lpb;
            $entry["descac"] = $ketsub;
            $entry["ket"] = 'Hutang Supplier No.PO:' . $no_ref_po . '/' . $nabar;
            $entry["begindr"] = 0;
            $entry["begincr"] = 0;
            $entry["kurs"] = '';
            $entry["kursrate"] = '';
            $entry["tglkurs"] = '';
            $entry["periodetxt"] = $txtperiode;
            $entry["module"] = 'LOGISTIK';
            $entry["lokasi"] = $status_lokasi;
            $entry["POST"] = 0;
            $entry["tglinput"] = date("Y-m-d H:i:s");
            $entry["USER"] = $user;
            $entry["kodebar"] = $kodebar;

            if ($data_noac_gl != NULL) {
                  return $this->M_posting->insert_lpb_to_entry_gl_cr($entry, $entry["noref"]);
            } else {
                  return 0;
            }
      }

      function cekPeriodeGL()
      {
            $pt = substr($this->session->userdata('kode_pt_login'), 1);
            $lokasi = $this->session->userdata('kode_dev');

            $data = $this->db_conf_caba->query("SELECT txtperiode FROM tb_setup WHERE id_modul='2' AND id_pt='$pt' AND lokasi='$lokasi'")->row();
            echo json_encode($data);
      }
}

/* End of file Posting.php */
