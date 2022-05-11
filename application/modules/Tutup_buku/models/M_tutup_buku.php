<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_tutup_buku extends CI_Model
{

      function get_stockawal($txtperiode, $kode_dev)
      {
            $this->db_logistik_pt->select('kodebar, kodebartxt, nabar, satuan, grp, nilai_masuk, nilai_keluar, QTY_MASUK, QTY_KELUAR, txtperiode, saldoakhir_qty, saldoakhir_nilai, txtperiode');
            $this->db_logistik_pt->from('stockawal');
            $this->db_logistik_pt->where('txtperiode', $txtperiode);
            $this->db_logistik_pt->where('KODE', $kode_dev);
            return $this->db_logistik_pt->get()->result_array();
      }

      function insert_stockawal()
      {
            $txtperiode = $this->session->userdata('ym_periode');
            $kode_dev = $this->session->userdata('kode_dev');

            $maks = "SELECT max(txtperiode) as maks_periode FROM stockawal";
            $maks_periode = $this->db_logistik_pt->query($maks)->row_array();

            // jika periode select max lebih besar dari periode sesiion maka sudah pernah tutup buku pada periode itu 
            if ($maks_periode['maks_periode'] > $txtperiode) {
                  //delete stok awal
                  $this->db_logistik_pt->delete('stockawal', array('txtperiode' => $maks_periode['maks_periode'], 'KODE' => $kode_dev));
            }

            // get data stockawal
            $data_stockawal = $this->get_stockawal($txtperiode, $kode_dev);

            $thn_bln = date("Y-m", strtotime($this->session->userdata('Ymd_periode')));

            foreach ($data_stockawal as $d) {

                  //stock awal 
                  $data_input_stock_awal["pt"] = $this->session->userdata('devisi');
                  $data_input_stock_awal["KODE"] = $this->session->userdata('kode_dev');
                  $data_input_stock_awal["afd"] = "-";
                  $data_input_stock_awal["kodebar"] = $d['kodebar'];
                  $data_input_stock_awal["kodebartxt"] = $d['kodebartxt'];
                  $data_input_stock_awal["nabar"] = $d['nabar'];
                  $data_input_stock_awal["satuan"] = $d['satuan'];
                  $data_input_stock_awal["grp"] = $d['grp'];
                  $data_input_stock_awal["saldoawal_qty"] = $d['saldoakhir_qty'];
                  $data_input_stock_awal["saldoawal_nilai"] = $d['saldoakhir_nilai'];
                  $data_input_stock_awal["tglinput"] = date("Y-m-d H:i:s");
                  $data_input_stock_awal["thn"] = date("Y");
                  $data_input_stock_awal["saldoakhir_qty"] = 0;
                  $data_input_stock_awal["saldoakhir_nilai"] = 0;
                  $data_input_stock_awal["nilai_masuk"] = 0;
                  $data_input_stock_awal["nilai_keluar"] = 0;
                  $data_input_stock_awal["QTY_MASUK"] = 0;
                  $data_input_stock_awal["QTY_KELUAR"] = 0;
                  $data_input_stock_awal["HARGARAT"] = 0;
                  $data_input_stock_awal["periode"] = $thn_bln . '-' . '26';
                  $data_input_stock_awal["txtperiode"] = $d['txtperiode'] + 1;
                  $data_input_stock_awal["account"] = "-";
                  $data_input_stock_awal["ket_account"] = "-";

                  $this->db_logistik_pt->insert('stockawal', $data_input_stock_awal);
            }
      }

      function get_stockawal_bulanan($txtperiode, $kode_dev)
      {
            $this->db_logistik_pt->select('kodebar, kodebartxt, nabar, satuan, grp, nilai_masuk, nilai_keluar, QTY_MASUK, QTY_KELUAR, txtperiode, saldoakhir_qty, saldoakhir_nilai, txtperiode');
            $this->db_logistik_pt->from('stockawal_bulanan_devisi');
            $this->db_logistik_pt->where('txtperiode', $txtperiode);
            $this->db_logistik_pt->where('KODE', $kode_dev);
            return $this->db_logistik_pt->get()->result_array();
      }

      function insert_stockawal_bulanan()
      {
            $txtperiode = $this->session->userdata('ym_periode');
            $kode_dev = $this->session->userdata('kode_dev');

            $maks = "SELECT max(txtperiode) as maks_periode FROM stockawal_bulanan_devisi";
            $maks_periode = $this->db_logistik_pt->query($maks)->row_array();

            // jika periode select max lebih besar dari periode sesiion maka sudah pernah tutup buku pada periode itu 
            if ($maks_periode['maks_periode'] > $txtperiode) {
                  //delete stok awal
                  $this->db_logistik_pt->delete('stockawal_bulanan_devisi', array('txtperiode' => $maks_periode['maks_periode'], 'KODE' => $kode_dev));
            }

            // get data stockawal
            $data_stockawal_bulanan = $this->get_stockawal_bulanan($txtperiode, $kode_dev);

            $thn_bln = date("Y-m", strtotime($this->session->userdata('Ymd_periode')));

            foreach ($data_stockawal_bulanan as $d) {

                  //stock awal bulanan devisi
                  $data_insert_stok_bulanan = [
                        'pt' => $this->session->userdata('devisi'),
                        'KODE' => $this->session->userdata('kode_dev'),
                        'devisi' => $this->session->userdata('devisi'),
                        'kode_dev' => $this->session->userdata('kode_dev'),
                        'afd' => '-',
                        'kodebar' => $d['kodebar'],
                        'kodebartxt' => $d['kodebar'],
                        'nabar' => $d['nabar'],
                        'satuan' => $d['sat'],
                        'grp' => $d['grp'],
                        'saldoawal_qty' => $d['saldoakhir_qty'],
                        'saldoawal_nilai' => 0,
                        'saldoakhir_qty' => 0,
                        'tglinput' => date("Y-m-d H:i:s"),
                        'thn' => date("Y"),
                        'QTY_MASUK' => 0,
                        'periode' => $thn_bln . '-' . '26',
                        'txtperiode' => $d['txtperiode'] + 1,
                        'ket' => '-',
                        'account' => '-',
                        'ket_account' => '-',
                        'tgl_transaksi' => date("Y-m-d H:i:s")
                  ];

                  $this->db_logistik_pt->insert('stockawal_bulanan_devisi', $data_insert_stok_bulanan);
            }
      }
}

/* End of file M_tutup_buku.php */
