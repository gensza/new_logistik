<div class="container-fluid">

      <div class="row mt-0">
            <div class="col-12">
                  <div class="card">
                        <div class="card-body">
                              <div class="row justify-content-between" style="margin-top: -10px;">
                                    <h4 class="header-title ml-2">BKB <i>(Edit)</i></h4>
                                    <div class="button-list mr-2">
                                          <button class="btn btn-xs btn-info" id="data_bkb" onclick="data_bkb()">Data BKB</button>
                                          <button class="btn btn-xs btn-success" id="new_bkb" onclick="new_bkb()">BKB Baru</button>
                                          <button class="btn btn-xs btn-danger" id="cancelBkb" onclick="cancelBkb()">Batal BKB</button>
                                          <button class="btn btn-xs btn-primary" id="a_print_bkb" onclick="cetak_bkb()">Cetak</button>
                                          <button onclick="goBack()" class="btn btn-xs btn-secondary" id="kembali">Kembali</button>
                                    </div>
                              </div>
                              <p class="sub-header">
                                    Bukti Keluar Barang <i>(Edit)</i>
                              </p>
                              <!-- <div class="row div_form_1 mt-0">
                              <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                          <div class="form-group">
                                                <label for="example-select">
                                                      <font face="Verdana" size="2.5">Tgl BKB*</font>
                                                </label>
                                                <input id="tgl_bkb_txt" name="tgl_bkb_txt" type="date" value="<?= date('Y-m-d') ?>" autocomplite="off" class="form-control" required="required">
                                          </div>
                                    </div>
                              </div>
                              <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                          <label for="example-select">
                                                <font face="Verdana" size="2.5">No BPB*</font>
                                          </label>
                                          <div class="row">
                                                <div class="row col-lg-10 col-md-10 col-11 ml-0"> -->
                              <!-- <select class="js-data-example-ajax form-control select2 col-9 ml-2" id="select2">
                                    </select> -->
                              <!-- <input id="cari_bpb" name="cari_bpb" class="form-control" type="text" onfocus="cari_bpb()" placeholder="pilih no BPB">
                                                      <input style="display:none;" id="multiple" class="form-control bg-light" type="text" readonly>
                                                      <input type="hidden" id="txt_no_bpb">
                                                </div>
                                                <button class="qrcode-reader mdi mdi-camera btn btn-xs btn-primary ml-1" id="camera" type="button" onclick="showCamera()"></button>
                                          </div>
                                    </div>
                              </div> -->
                              <!-- <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                          <label for="example-select">
                                                <font face="Verdana" size="2.5">Bagian*</font>
                                          </label>
                                          <input id="bagian" name="bagian" class="form-control bg-light" required="required" type="text" disabled>
                                    </div>
                              </div>
                              <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                          <label for="example-select">
                                                <font face="Verdana" size="2.5">Alokasi Estate*</font>
                                          </label>
                                          <input id="alokasi_est" name="alokasi_est" class="form-control bg-light" required="required" type="text" disabled>
                                    </div>
                              </div>
                              <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                          <label for="example-select">
                                                <font face="Verdana" size="2.5">Diberikan Kepada*</font>
                                          </label>
                                          <input id="diberikan_kpd" name="diberikan_kpd" class="form-control" required="required" type="text">
                                    </div>
                              </div>
                              <div class="col-lg-2 col-12">
                                    <div class="form-group">
                                          <label for="example-select">
                                                <font face="Verdana" size="2.5">Untuk Keperluan</font>
                                          </label>
                                          <textarea class="form-control" rows="1" id="utk_keperluan"></textarea>
                                    </div>
                              </div>
                              <input type="hidden" id="hidden_id_ppo">
                        </div> -->

                              <!-- <fieldset style="display: none;" class="border mb-1 p-1" id="fieldset_bbm">
                              <div class="row div_form_bbm mt-0">
                                    <div class="col-lg-2 col-12">
                                          <div class="form-group">
                                                <div class="form-group">
                                                      <label for="example-select">
                                                            <font face="Verdana" size="2.5">Bahan Bakar</font>
                                                      </label>
                                                      <input id="bhnbakar" name="bhnbakar" type="text" class="form-control form-control-sm bg-light" placeholder="" disabled>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                          <div class="form-group">
                                                <label for="example-select">
                                                      <font face="Verdana" size="2.5">Jenis Alat/Kend</font>
                                                </label>
                                                <input id="txt_jns_alat" name="txt_jns_alat" type="text" class="form-control form-control-sm bg-light" style="font-family: Verdana, Geneva, Tahoma, sans-serif;" value="" placeholder="" autocomplite="off" disabled>
                                          </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                          <div class="form-group">
                                                <label for="example-select">
                                                      <font face="Verdana" size="2.5">kode/Nomer</font>
                                                </label>
                                                <input id="txt_kd_nmr" name="txt_kd_nmr" type="text" class="form-control form-control-sm bg-light" style="font-family: Verdana, Geneva, Tahoma, sans-serif;" value="" placeholder="" autocomplite="off" disabled>
                                          </div>
                                    </div>
                                    <div class="col-lg-2 col-12">
                                          <div class="form-group">
                                                <label for="example-select">
                                                      <font face="Verdana" size="2.5">HM/KM</font>
                                                </label>
                                                <input id="txt_hm_km" name="txt_hm_km" type="text" class="form-control form-control-sm bg-light" style="font-family: Verdana, Geneva, Tahoma, sans-serif;" value="" placeholder="" autocomplite="off" disabled>
                                          </div>
                                    </div>
                                    <div class="col-lg-2 col-12">
                                          <div class="form-group">
                                                <label for="example-select">
                                                      <font face="Verdana" size="2.5">Lokasi Kerja</font>
                                                </label>
                                                <input id="txt_lokasi_kerja" name="txt_lokasi_kerja" type="text" class="form-control form-control-sm bg-light" style="font-family: Verdana, Geneva, Tahoma, sans-serif;" value="" placeholder="" autocomplite="off" disabled>
                                          </div>
                                    </div>
                              </div>
                        </fieldset> -->
                              <!-- <fieldset class="border mb-1 p-1">
                              <div class="row">
                                    <div class="custom-control custom-checkbox ml-3 mt-0 col-1">
                                          <input type="checkbox" name="cexbox_mutasi" class="custom-control-input" id="cexbox_mutasi" onclick="cekbox_mutasi()">
                                          <label class="custom-control-label" for="cexbox_mutasi">Mutasi?</label>
                                          <input type="hidden" id="hidden_cekbox_mutasi" value="">
                                    </div>
                                    <div class="col-3">
                                          <select class="form-control form-control-sm" id="pt_mutasi" onchange="pt_mutasi()" disabled>
                                                <option value="" selected disabled>Pilih PT Tujuan</option>
                                                <?php
                                                foreach ($pt_mutasi as $d) : {
                                                ?>
                                                            <option value="<?= $d['kode_pt']; ?>"><?= $d['kode_pt'] . ' - ' . $d['nama_pt']; ?></option>
                                                <?php
                                                      }
                                                endforeach;
                                                ?>
                                          </select>
                                    </div>
                                    <div class="col-3">
                                          <select class="form-control form-control-sm" id="devisi_mutasi" disabled>
                                          </select>
                                    </div>
                              </div>
                        </fieldset> -->

                              <hr class="mb-0" style="margin-top: -15px;">
                              <div class="x_content div_form_2 mb-0">
                                    <div class="row justify-content-between">
                                          <div class="row ml-2">
                                                <h6 id="lbl_bkb_status" name="lbl_bkb_status">
                                                      <!-- <font face="Verdana" size="2.5">No. BKB : ... &nbsp; No. Ref. BKB : ...</font> -->
                                                </h6>
                                                <input type="hidden" id="hidden_id_bkb">
                                                <input type="hidden" id="hidden_no_bkb">
                                                <input type="hidden" id="hidden_no_ref_bkb">
                                                <input type="hidden" id="hidden_kode_dev">
                                                <input type="hidden" id="hidden_devisi">
                                                <input type="hidden" id="hidden_norefbpb">
                                                <input type="hidden" id="hidden_mutasi">
                                                <div class="row" style="margin-left:0px;">
                                                      <h6>
                                                            <span id="norefbpb_text"></span>&emsp;&emsp;&emsp;&emsp;
                                                            <span id="h4_no_bkb"></span>&emsp;&emsp;
                                                            <span id="h4_no_ref_bkb"></span>
                                                      </h6>
                                                </div>
                                          </div>
                                          <h6 class="mr-2">
                                                <button class="btn btn-danger btn-xs fa fa-print" id="a_print_bkb" style="display:none" onclick="cetak_bkb()"></button>
                                          </h6>
                                    </div>
                                    <div class="table-responsive">
                                          <table class="table table-striped table-bordered" id="tableRinciBKB" width="100%">
                                                <thead>
                                                      <tr>
                                                            <th>TM/TBM</th>
                                                            <th>Afd/Unit</th>
                                                            <th>Blok/Sub</th>
                                                            <th>Thn&nbsp;Tanam</th>
                                                            <th width="13%">Bahan</th>
                                                            <th width="16%">Account Beban</th>
                                                            <th width="20%">Barang</th>
                                                            <th width="10%" style="font-size: 12px; padding: 10px; padding-left: 14px;">Sat/Stok</th>
                                                            <th width="10%">Qty Diminta</th>
                                                            <th width="10%">Qty Disetujui</th>
                                                            <th width="17%">Keterangan</th>
                                                            <th width="4%">#</th>
                                                      </tr>
                                                </thead>
                                                <tbody id="tbody_rincian" name="tbody_rincian">
                                                </tbody>
                                          </table>
                                    </div>
                              </div>
                        </div>
                  </div> <!-- end widget-rounded-circle-->
            </div>
      </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalKonfirmasiHapusBkb">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-body p-4">
                        <div class="text-center">
                              <i class="dripicons-warning h1 text-warning"></i>
                              <h4 class="mt-2">Konfirmasi Hapus</h4>
                              <!-- <input type="hidden" id="hidden_no_delete" name="hidden_no_delete"> -->
                              <p class="mt-3">Apakah Anda yakin ingin menghapus BKB ini ???</p>
                              <button type="button" class="btn btn-warning my-2" data-dismiss="modal" id="btn_delete" onclick="cekBkb()">Hapus</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                  </div>
            </div>
      </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="alasanbatal">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-body p-4">
                        <div class="text-center">
                              <i class="dripicons-warning h1 text-warning"></i>
                              <h4 class="mt-2">Alasan Batal</h4>
                              <textarea class="form-control" id="alasan" rows="4" required></textarea>
                              <button type="button" class="btn btn-warning my-2" id="btn_delete" onclick="validasibatal()">Batalkan</button>
                              <button type="button" class="btn btn-default btn_close" onclick="closemodal()">Cancel</button>
                        </div>
                  </div>
            </div>
      </div>
</div>
<input type="hidden" name="status_batal" id="status_batal">
<input type="hidden" id="noref_bkb_edit" value="<?= $noref_bkb_edit ?>">
<style>
      table#tableRinciBKB th {
            padding: 10px;
            font-size: 12px;
            padding-left: 17px;
      }
</style>

<script>
      function data_bkb() {
            location.href = "<?php echo base_url('Bkb') ?>";
      }

      function goBack() {
            window.history.back();
      }

      function new_bkb() {
            location.href = "<?php echo base_url('Bkb/input') ?>";
      }

      function cancelBkb(n) {

            // $('#modalKonfirmasiHapusBkb').modal('show');
            $('#alasanbatal').modal('show');
            var batal = $('#status_batal').val("1");
      }

      function closemodal() {

            // $('#modalKonfirmasiHapusLpb').modal('show');
            $('#alasanbatal').modal('hide');
            var batal = $('#status_batal').val("0");
      }

      function validasibatal() {
            var alasan = $('#alasan').val();

            if (!alasan) {
                  $.toast({
                        position: 'top-right',
                        text: 'Silahkan Isi Alasan!',
                        icon: 'error',
                        loader: false
                  });
                  $('#alasan').css({
                        "background": "#FFCECE"
                  });
            } else {
                  cekBkb();
            }
      }

      function cekBkb() {

            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Bkb/cekDataBkb'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {},

                  data: {
                        'noref_bkb': $('#hidden_no_ref_bkb').val()
                  },
                  success: function(data) {

                        for (var i = 0; i < data; i++) {
                              //delete item 1 per satu
                              KembalikanNilaiStock(i);
                        }
                  },
                  error: function(response) {
                        alert('KONEKSI TERPUTUS! Gagal Menghapus BKB');
                  }
            });
      }

      $(document).ready(function() {
            var noref_bkb = $('#noref_bkb_edit').val();
            cariBkbEdit(noref_bkb);
      });

      function cariBkbEdit(noref_bkb) {

            // var nopo = $('#multiple').val();
            // console.log(n + 'yeyelala');

            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Bkb/get_data_bkb_edit'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {
                        $('#tbody_rincian').empty();
                  },

                  data: {
                        'noref_bkb': noref_bkb
                  },
                  success: function(data) {

                        console.log(data);

                        stockkeluar = data.stockkeluar;
                        bkb_item = data.keluarbrgitem;

                        $('#h4_no_bkb').text('No. BKB : ' + stockkeluar.skb);
                        $('#hidden_no_bkb').val(stockkeluar.skb);
                        $('#h4_no_ref_bkb').text('No. Ref BKB : ' + stockkeluar.NO_REF);
                        $('#hidden_no_ref_bkb').val(stockkeluar.NO_REF);
                        $('#hidden_norefbpb').val(stockkeluar.nobpb);
                        $('#norefbpb_text').text('No. Ref BPB : ' + stockkeluar.nobpb);
                        $('#hidden_id_bkb').val(stockkeluar.id);
                        $('#hidden_mutasi').val(stockkeluar.mutasi);


                        for (i = 0; i < bkb_item.length; i++) {

                              tambah_row(i, bkb_item[i].approval);
                              // tahun_tanam(i, bkb_item[i].kodebebantxt);

                              //sum stok all periode / qtymasuk - qtykeluar
                              get_stok(i, bkb_item[i].kodebar, bkb_item[i].txtperiode, bkb_item[i].kode_dev);

                              var id_keluarbrgitem = bkb_item[i].id;
                              var tmtbm = bkb_item[i].tmtbm;
                              var afd = bkb_item[i].afd;
                              var blok = bkb_item[i].blok;
                              var thntanam = bkb_item[i].thntanam;
                              var kodebebantxt = bkb_item[i].kodebebantxt;
                              var kodesubtxt = bkb_item[i].kodesubtxt;
                              var ketbeban = bkb_item[i].ketbeban;
                              var nabar = bkb_item[i].nabar;
                              var kodebar = bkb_item[i].kodebar;
                              var grp = bkb_item[i].grp;
                              var satuan = bkb_item[i].satuan;
                              var qty = bkb_item[i].qty;
                              var qty2 = bkb_item[i].qty2;
                              var ketsub = bkb_item[i].ketsub;
                              var ket = bkb_item[i].ket;

                              // Set data
                              $('#id_keluarbrgitem_' + i).val(id_keluarbrgitem);
                              $('#cmb_tm_tbm_' + i).val(tmtbm);
                              $('#cmb_afd_unit_' + i).val(afd);
                              $('#cmb_blok_sub_' + i).val(blok);
                              $('#cmb_tahun_tanam_' + i).val(thntanam);
                              $('#cmb_bahan_' + i).val(ketbeban);
                              $('#hidden_kodebebantxt' + i).val(kodebebantxt);
                              $('#txt_account_beban_' + i).val(ketsub);
                              $('#hidden_no_acc_' + i).val(kodesubtxt);
                              $('#txt_barang_' + i).val(nabar);
                              $('#hidden_kode_barang_' + i).val(kodebar);
                              $('#hidden_grup_barang_' + i).val(grp);
                              $('#sat_bpb_' + i).text(satuan);
                              $('#txt_qty_diminta_' + i).val(qty);
                              $('#txt_qty_disetujui_' + i).val(qty2);
                              $('#txt_ket_rinci_' + i).val(ket);

                        }
                  },
                  error: function(response) {
                        alert('ERROR! ' + response.responseText);
                  }
            });
      }

      function tambah_row(row, approval) {
            var tr_buka = '<tr id="tr_' + row + '">';
            var form_buka = '<form id="form_rinci_' + row + '" name="form_rinci_' + row + '" method="POST" action="javascript:;">';
            var td_col_2 = '<td style="padding-right: 0.2em; padding-left: 0.2em; padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<!-- TM/TBM -->' +
                  '<input type="text" class="form-control form-control-sm bg-light" style="font-size:12px;" id="cmb_tm_tbm_' + row + '" name="cmb_tm_tbm_' + row + '" disabled>' +
                  '</td>';
            var td_col_3 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<!-- AFD/UNIT -->' +
                  '<input type="text" class="form-control form-control-sm bg-light" style="font-size:12px;" id="cmb_afd_unit_' + row + '" name="cmb_afd_unit_' + row + '" disabled>' +
                  '</td>';
            var td_col_4 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<!-- BLOK/SUB -->' +
                  '<input type="text" class="form-control form-control-sm bg-light" style="font-size:12px;" id="cmb_blok_sub_' + row + '" name="cmb_blok_sub_' + row + '" disabled>' +
                  '</td>';
            var td_col_5 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<!-- Tahun Tanam -->' +
                  '<input type="text" class="form-control form-control-sm bg-light" style="font-size:12px;" id="cmb_tahun_tanam_' + row + '" name="cmb_tahun_tanam_' + row + '" disabled>' +
                  '</td>';
            var td_col_6 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<!-- Bahan -->' +
                  '<input type="text" class="form-control form-control-sm bg-light" style="font-size:12px;" id="cmb_bahan_' + row + '" name="cmb_bahan_' + row + '" disabled>' +
                  '</td>';
            var td_col_7 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<!-- Account Beban -->' +
                  '<input type="text" class="form-control form-control-sm bg-light" style="font-size:12px;" id="txt_account_beban_' + row + '" value="-" name="txt_account_beban_' + row + '" disabled>' +
                  // '<label class="control-label" id="lbl_no_acc_' + row + '"></label>' +
                  // '<label class="control-label" id="lbl_nama_acc_' + row + '"></label>' +
                  '<input type="hidden" id="hidden_no_acc_' + row + '" name="hidden_no_acc_' + row + '" value="0">' +
                  '<input type="hidden" id="hidden_kodebebantxt' + row + '" name="hidden_kodebebantxt' + row + '" value="0">' +
                  '</td>';
            var td_col_8 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<!-- Barang -->' +
                  '<input type="text" class="form-control form-control-sm bg-light" style="font-size:12px;" id="txt_barang_' + row + '" name="txt_barang_' + row + '" placeholder="Barang" disabled>' +
                  // '<label id="lbl_kode_barang_' + row + '"></label>' +
                  // '<label id="lbl_nama_barang_' + row + '"></label>' +
                  '<input type="hidden" id="hidden_kode_barang_' + row + '" name="hidden_kode_barang_' + row + '" value="0">' +
                  // '<input type="hidden" id="hidden_nama_barang_' + row + '" name="hidden_nama_barang_' + row + '" value="0">' +
                  '<input type="hidden" id="hidden_grup_barang_' + row + '" name="hidden_grup_barang_' + row + '" value="0">' +
                  '</td>';
            var td_col_9 = '<td style="padding-right: 0.4em; padding-top: 1px; padding-bottom: 0em;">' +
                  '<span class="small text-muted">Sat&nbsp;:&nbsp;</span><span id="sat_bpb_' + row + '" class="small"></span><br>' +
                  '<span class="small text-muted">Stok&nbsp;:&nbsp;</span><span id="stok_' + row + '" class="small"></span>' +
                  '</td>';
            var td_col_10 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<!-- Qty Diminta & Stok di Tgl ini & Satuan -->' +
                  '<input type="number" class="form-control form-control-sm bg-light" style="font-size:12px;" id="txt_qty_diminta_' + row + '" name="txt_qty_diminta_' + row + '" placeholder="Qty Diminta" disabled>' +
                  '</td>';
            var td_col_11 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<!-- Qty Diminta & Stok di Tgl ini & Satuan -->' +
                  '<input type="number" class="form-control form-control-sm bg-light" style="font-size:12px;" id="txt_qty_disetujui_' + row + '" name="txt_qty_disetujui_' + row + '" placeholder="Qty Diminta" disabled>' +
                  '</td>';
            var td_col_12 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<!-- Keterangan -->' +
                  '<textarea class="resizable_textarea form-control form-control-sm bg-light" style="font-size:12px;" id="txt_ket_rinci_' + row + '" name="txt_ket_rinci_' + row + '" rows="1" placeholder="Keterangan" disabled></textarea>' +
                  '<input type="hidden" id="id_keluarbrgitem_' + row + '" name="id_keluarbrgitem_' + row + '">' +
                  '</td>';
            var td_col_13 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<button style="display:none;" class="btn btn-xs btn-success fa fa-save" id="btn_simpan_' + row + '" name="btn_simpan_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="saveRinciClick(' + row + ')"></button>' +
                  '<button style="display:none;" class="badge bagde-warning btn-warning" id="rev_qty_' + row + '" name="rev_qty_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Req Rev Qty" onclick="btnRevQty(' + row + ')"><b>Rev</b></button>' +
                  '<button style="display:none;" class="btn btn-xs btn-warning fa fa-edit" id="btn_ubah_' + row + '" name="btn_ubah_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" onclick="ubahRinci(' + row + ')"></button>' +
                  '<button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_' + row + '" name="btn_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="updateRinci(' + row + ')"></button>' +
                  '<button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick mt-1" id="btn_cancel_update_' + row + '" name="btn_cancel_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update" onclick="cancelUpdate(' + row + ')"></button>' +
                  '<button class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_' + row + '" name="btn_hapus_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + row + ')"></button>' +
                  '<label id="lbl_status_simpan_' + row + '"></label>' +
                  '</td>';
            var td_col_14 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<i><small>Approved</small></i>' +
                  '</td>';
            var form_tutup = '</form>';
            var tr_tutup = '</tr>';

            if (approval == 1) {
                  $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_9 + td_col_10 + td_col_11 + td_col_12 + td_col_14 + form_tutup + tr_tutup);
            } else {
                  $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_9 + td_col_10 + td_col_11 + td_col_12 + td_col_13 + form_tutup + tr_tutup);
            }

            // cek_bagian(row);

            // $('#txt_qty_diminta_' + row).addClass('currencyduadigit');
            // $('#txt_qty_disetujui_' + row).addClass('currencyduadigit');
            // $('.currencyduadigit').number(true, 0);
            // $('#txt_account_beban_'+row).attr('disabled','');

            // $('html, body').animate({
            //     scrollTop: $("#tr_" + row).offset().top
            // }, 2000);
      }

      // function tahun_tanam(i, coa_material) {
      //       $.ajax({
      //             type: "POST",
      //             url: "<?php echo site_url('Bkb/get_tahun_tanam'); ?>",
      //             dataType: "JSON",
      //             beforeSend: function() {},

      //             data: {
      //                   'coa_material': coa_material
      //             },
      //             success: function(data) {

      //                   if (data) {
      //                         $('#cmb_tm_tbm_' + i).val(data.tmtbm);
      //                         $('#cmb_tahun_tanam_' + i).val(data.thn_tanam);
      //                   }

      //             },
      //             error: function(response) {
      //                   alert('ERROR! ' + response.responseText);
      //             }
      //       });
      // }

      function get_stok(i, kodebar, txtperiode, kode_dev) {
            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Bkb/get_stok'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {},

                  data: {
                        'kodebar': kodebar,
                        'txtperiode': txtperiode,
                        'kode_dev': kode_dev
                  },
                  success: function(data) {

                        $('#stok_' + i).text(data);

                  },
                  error: function(response) {
                        alert('ERROR! ' + response.responseText);
                  }
            });
      }

      function hapusRinci(n) {
            // $('#hidden_no_delete').val(n);
            Swal.fire({
                  text: "Yakin akan menghapus Data ini?",
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya Hapus!'
            }).then((result) => {
                  if (result.value) {
                        KembalikanNilaiStock(n);
                  }
            })
      }

      function KembalikanNilaiStock(n) {
            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Bkb/KembalikanNilaiStock'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {
                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>');
                  },

                  data: {
                        'id_keluarbrgitem': $('#id_keluarbrgitem_' + n).val()
                  },
                  success: function(data) {

                        var status = $('#status_batal').val();
                        if (status != 1) {
                              hapusItemBkb(n);

                        } else {
                              batalitem(n);

                        }

                  },
                  error: function(response) {
                        alert('ERROR! ' + response.responseText);
                  }
            });
      }

      function batalitem(n) {

            if ($('#cexbox_mutasi').is(':checked')) {
                  var cexbox_mutasi = '1';
                  var cexbox_mutasi_pt = '1';
            } else {
                  var cexbox_mutasi = '0';
            }

            if ($('#cexbox_mutasi_local').is(':checked')) {
                  var cexbox_mutasi = '1';
            } else {
                  var cexbox_mutasi = '0';
            }

            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Bkb/batalItemBkb'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {
                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>');
                  },

                  data: {
                        'id_keluarbrgitem': $('#id_keluarbrgitem_' + n).val(),
                        'id_mutasi_item': $('#hidden_id_mutasi_item_' + n).val(),
                        'id_register_stok': $('#hidden_id_register_stok_' + n).val(),
                        'kodebar': $('#hidden_kode_barang_' + n).val(),
                        'norefbpb': $('#hidden_norefbpb').val(),
                        'mutasi': cexbox_mutasi,
                        'mutasi_pt': cexbox_mutasi_pt,
                        'edit': '0',
                        'alasan': $('#alasan').val()
                  },
                  success: function(data) {

                        cekDataBkbItem(n);

                  },
                  error: function(response) {
                        alert('ERROR! ' + response.responseText);
                  }
            });
      }

      function hapusItemBkb(n) {
            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Bkb/hapusItemBkb'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {
                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>');
                  },

                  data: {
                        'id_keluarbrgitem': $('#id_keluarbrgitem_' + n).val(),
                        'kodebar': $('#hidden_kode_barang_' + n).val(),
                        'norefbpb': $('#hidden_norefbpb').val(),
                        'cmb_blok_sub': $('#cmb_blok_sub_' + n).val(),
                        'noref_bkb': $('#noref_bkb_edit').val(),
                        'mutasi': $('#hidden_mutasi').val(),
                        'edit': '1',
                  },
                  success: function(data) {

                        cekDataBkbItem(n);

                        notiferrordeleteitem(data);

                  },
                  error: function(response) {
                        alert('ERROR! ' + response.responseText);
                  }
            });
      }

      function notiferrordeleteitem(data) {
            if (data.delete_register == 0) {
                  alert('delete_register GAGAL!');
            }
            if (data.update_bpb == 0) {
                  alert('update_bpb GAGAL!');
            }
            if (data.update_bpb_item == 0) {
                  alert('update_bpb_item GAGAL!');
            }
            if (data.update_bpb_item_mutasi == 0) {
                  alert('update_bpb_item_mutasi GAGAL!');
            }
            if (data.update_bpb_mutasi == 0) {
                  alert('update_bpb_mutasi GAGAL!');
            }
            if (data.deletebkb == 0) {
                  alert('deletebkb GAGAL!');
            }
            if (data.delete_gl == 0) {
                  alert('delete_gl GAGAL!');
            }
      }

      function cekDataBkbItem(n) {
            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Bkb/cekDataBkbItem'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {
                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_status_simpan_' + n).append('<label><i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>cek bkb item..</label>');
                  },

                  data: {
                        'noref_bkb': $('#noref_bkb_edit').val()
                  },
                  success: function(data) {

                        if (data == 0) {
                              var status = $('#status_batal').val();
                              if (status != 1) {
                                    hapusBkb(n);
                              } else {
                                    batalBkb(n);
                              }
                        } else {
                              $('#tr_' + n).remove();
                              $('#lbl_status_simpan_' + n).empty();
                        }
                  },
                  error: function(response) {
                        alert('ERROR! ' + response.responseText);
                  }
            });
      }

      function batalBkb(n) {

            if ($('#cexbox_mutasi').is(':checked')) {
                  var cexbox_mutasi = '1';
            } else {
                  var cexbox_mutasi = '0';
            }

            if ($('#cexbox_mutasi_local').is(':checked')) {
                  var cexbox_mutasi = '1';
            } else {
                  var cexbox_mutasi = '0';
            }

            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Bkb/batalBkb'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {
                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_status_simpan_' + n).append('<label style="font-size:12px;"><i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>Hapus data BKB</label>');
                  },

                  data: {
                        'noref_bkb': $('#hidden_no_ref_bkb').val(),
                        'id_mutasi': $('#hidden_id_mutasi').val(),
                        'mutasi': cexbox_mutasi,
                        'alasan': $('#alasan').val()
                  },
                  success: function(data) {

                        $('#alasanbatal').modal('hide');
                        $.toast({
                              position: 'top-right',
                              heading: 'Dihapus',
                              text: 'Berhasil Dibatalkan!',
                              icon: 'success',
                              loader: false
                        });
                        setTimeout(function() {
                              location.href = "<?php echo base_url('Bkb') ?>";
                        }, 1000);

                  },
                  error: function(response) {
                        alert('ERROR! ' + response.responseText);
                  }
            });
      }

      function hapusBkb(n) {
            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Bkb/hapusBkb'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {
                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_status_simpan_' + n).append('<label><i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>Hapus data BKB</label>');
                  },

                  data: {
                        'noref_bkb': $('#noref_bkb_edit').val(),
                        'mutasi': $('#hidden_mutasi').val(),
                        'edit': '1'
                  },
                  success: function(data) {

                        notiferrordeletebkb(data);

                        location.href = "<?php echo base_url('Bkb') ?>";

                  },
                  error: function(response) {
                        alert('ERROR! ' + response.responseText);
                  }
            });
      }

      function notiferrordeletebkb(data) {
            if (data.delete_stockkeluar == 0) {
                  alert('delete_stockkeluar GAGAL!');
            }
            if (data.delete_header_entry == 0) {
                  alert('delete_header_entry GAGAL!');
            }
            if (data.delete_mutasi == 0) {
                  alert('delete_mutasi GAGAL!');
            }
      }

      function cetak_bkb() {
            var no_bkb = $('#hidden_no_bkb').val();
            var id = $('#hidden_id_bkb').val();

            window.open("<?= base_url('Bkb/cetak/') ?>" + no_bkb + '/' + id, '_blank');

            // $('.div_form_2').css('pointer-events', 'none');
      }
</script>