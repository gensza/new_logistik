<?php
date_default_timezone_set('Asia/Jakarta');
?>
<div class="container-fluid">
      <!-- start row-->
      <div class="row mt-0">
            <div class="col-12">
                  <div class="card">
                        <div class="card-body">
                              <div class="row justify-content-between">
                                    <h4 class="header-title ml-2">LPB <b>MUTASI</b></h4>
                                    <div class="button-list mr-2">
                                          <button class="qrcode-reader mdi mdi-camera btn btn-xs btn-primary ml-1" id="camera" type="button" onclick="showCamera()"></button>
                                          <button class="btn btn-xs btn-success" id="new_lpb" onclick="new_lpb()" disabled>LPB Baru</button>
                                          <button class="btn btn-xs btn-danger" id="cancelLpb" onclick="cancelLpb()" disabled>Batal LPB</button>
                                          <button class="btn btn-xs btn-primary" id="a_print_lpb" onclick="cetak_lpb()" disabled>Cetak</button>
                                          <button onclick="goBack()" class="btn btn-xs btn-secondary" id="kembali">Kembali</button>
                                    </div>
                              </div>
                              <p class="sub-header">
                                    Input Laporan Penerimaan Barang <b>Mutasi</b>
                              </p>

                              <div class="row">
                                    <div class="row div_form_1 col-lg-3">
                                          <div class="col-lg-12">
                                                <div class="form-group row mb-1">
                                                      <label class="col-lg-4 col-12 col-form-label" style="font-size:12px;">Tgl&nbsp;Terima<span class="required">*</span>
                                                      </label>
                                                      <div class="col-lg-8">
                                                            <input id="txt_tgl_terima" name="txt_tgl_terima" class="form-control form-control-sm" type="date" value="<?= date('Y-m-d') ?>">
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="col-12">
                                                <div class="form-group row mb-1">
                                                      <label class="col-lg-4 col-12 col-form-label" style="font-size:12px;">No.Ref&nbsp;BKB<span class="required">*</span>
                                                      </label>
                                                      <div class="col-lg-8">
                                                            <select class="js-data-example-ajax form-control select2_mutasi" id="select2_mutasi">
                                                            </select>
                                                            <input style="display:none;" id="multiple" class="form-control form-control-sm bg-light" type="text" readonly>
                                                            <!-- <input id="txt_no_po" name="txt_no_po" class="form-control bg-light" type="" placeholder="No.Ref PO" autocomplete="off" readonly> -->
                                                            <input type="hidden" id="txt_ref_po">
                                                            <input type="hidden" id="txt_no_po">
                                                      </div>
                                                </div>

                                          </div>
                                    </div>

                                    <div class="row div_form_1 col-9">
                                          <div class="row col-lg-12">
                                                <div class="col-lg-3">
                                                      <!-- assignee -->
                                                      <p class="text-muted mb-0" style="font-size:12px;">Tanggal BKB</p>
                                                      <div class="media">
                                                            <div class="media-body">
                                                                  <p class="mt-0">
                                                                        <span id="tgl_bkb_txt" style="font-size: 12px; font-weight: bold;"></span>
                                                                  </p>
                                                            </div>
                                                      </div>
                                                      <!-- end assignee -->
                                                </div> <!-- end col -->

                                                <div class="col-lg-3">
                                                      <!-- start due date -->
                                                      <p class="text-muted mb-0" style="font-size:12px;">Bagian</p>
                                                      <div class="media">
                                                            <div class="media-body">
                                                                  <p class="mt-0" style="font-size: 12px; font-weight: bold;">
                                                                        <span id="bagian_txt"></span>
                                                                  </p>
                                                            </div>
                                                      </div>
                                                      <!-- end due date -->
                                                </div>

                                                <div class="col-lg-3">
                                                      <!-- start due date -->
                                                      <p class="text-muted mb-0" style="font-size:12px;">Kepada</p>
                                                      <div class="media">
                                                            <div class="media-body">
                                                                  <p class="mt-0" style="font-size: 12px; font-weight: bold;">
                                                                        <span id="kepada_txt"></span>
                                                                  </p>
                                                            </div>
                                                      </div>
                                                      <!-- end due date -->
                                                </div> <!-- end col -->
                                                <div class="col-lg-3">
                                                      <!-- start due date -->
                                                      <p class="text-muted mb-0" style="font-size:12px;">Keperluan</p>
                                                      <div class="media">
                                                            <div class="media-body">
                                                                  <p class="mt-0" style="font-size: 12px; font-weight: bold;">
                                                                        <span id="keperluan_txt"></span>
                                                                  </p>
                                                            </div>
                                                      </div>
                                                      <!-- end due date -->
                                                </div> <!-- end col -->
                                          </div> <!-- end row -->

                                          <div class="row col-12">
                                                <div class="col-lg-3">
                                                      <!-- assignee -->
                                                      <p class="text-muted mb-0" style="font-size:12px;">Asal PT</p>
                                                      <div class="media">
                                                            <div class="media-body">
                                                                  <p class="mt-0" style="font-size: 12px; font-weight: bold;">
                                                                        <span id="asal_pt_txt"></span>
                                                                  </p>
                                                            </div>
                                                      </div>
                                                      <!-- end assignee -->
                                                </div> <!-- end col -->

                                                <div class="col-lg-3">
                                                      <!-- start due date -->
                                                      <p class="text-muted mb-0" style="font-size:12px;">Asal Devisi</p>
                                                      <div class="media">
                                                            <div class="media-body">
                                                                  <p class="mt-0" style="font-size: 12px; font-weight: bold;">
                                                                        <span id="asal_devisi_txt"></span>
                                                                  </p>
                                                            </div>
                                                      </div>
                                                      <!-- end due date -->
                                                </div>

                                                <div class="col-lg-3">
                                                      <!-- start due date -->
                                                      <p class="text-muted mb-0" style="font-size:12px;">PT Tujuan</p>
                                                      <div class="media">
                                                            <div class="media-body">
                                                                  <p class="mt-0" style="font-size: 12px; font-weight: bold;">
                                                                        <span id="pt_tujuan_txt"></span>
                                                                  </p>
                                                            </div>
                                                      </div>
                                                      <!-- end due date -->
                                                </div> <!-- end col -->
                                                <div class="col-lg-3">
                                                      <!-- start due date -->
                                                      <p class="text-muted mb-0" style="font-size:12px;">Devisi Tujuan</p>
                                                      <div class="media">
                                                            <div class="media-body">
                                                                  <p class="mt-0" style="font-size: 12px; font-weight: bold;">
                                                                        <span id="devisi_tujuan_txt"></span>
                                                                        <input type="hidden" id="devisi">
                                                                  </p>
                                                            </div>
                                                      </div>
                                                      <!-- end due date -->
                                                </div> <!-- end col -->
                                          </div> <!-- end row -->
                                    </div>
                              </div>
                              <hr class="mt-1 mb-2">
                              <div class="row div_form_2">
                                    <div class="col-12">
                                          <div class="sub-header" style="margin-top: -10px; margin-bottom: -22px;">
                                                <input type="hidden" id="hidden_id_lpb">
                                                <input type="hidden" id="hidden_no_lpb">
                                                <input type="hidden" id="hidden_no_ref_lpb">
                                          </div>
                                          <div class="row mt-2 ml-0" style="margin-bottom: 4px;">
                                                <h6><span id="noref_span"></span></h6>
                                                <h6 id="lbl_lpb_status" name="lbl_lpb_status">
                                                      No. LPB : ... &nbsp; No. Ref LPB : ...
                                                </h6>
                                                <h6><span id="no_lpb"></span></h6>&emsp;&emsp;
                                                <h6><span id="no_ref_lpb"></span></h6>
                                                <label id="lbl_status_simpan" class="align-right"></label>
                                          </div>

                                          <div class="table-responsive">
                                                <table class="table table-striped table-bordered" id="tableRinciLPB" width="100%">
                                                      <thead>
                                                            <tr>
                                                                  <!-- <th width="3%">#</th> -->
                                                                  <th width="21%" style="font-size:12px;">Kode Barang</th>
                                                                  <th style="font-size:12px;">Nama Barang / Satuan / Grup</th>
                                                                  <th width="9%" style="font-size:12px;">Saldo Qty</th>
                                                                  <th width="6%" style="font-size:12px;">Qty</th>
                                                                  <th width="20%" style="font-size:12px;">Ket</th>
                                                                  <th width="3%" style="font-size:12px;">Aksi</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody id="tbody_rincian" name="tbody_rincian">
                                                      </tbody>
                                                </table>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>

</div> <!-- container -->

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalListPo">
      <div class="modal-dialog modal-lg">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">List PO</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                  </div>
                  <div class="modal-body">
                        <div class="row mb-2 mt-0">
                              <button class="qrcode-reader mr-2 ml-2 mdi mdi-camera btn btn-xs btn-primary" type="button" id="openreader-multi" data-qrr-multiple="true" data-qrr-repeat-timeout="0" data-qrr-target="#multiple" data-qrr-line-color="#00FF00"> QRCode</button>
                              <input id="multiple" type="text" class="col-4" onkeyup="cariBkbItemqr()">
                        </div>
                        <div class="form-horizontal">
                              <div class="table-responsive">
                                    <table id="tableDetailPo" class="table table-bordered" width="100%">
                                          <thead>
                                                <tr>
                                                      <th>#</th>
                                                      <th>No.</th>
                                                      <th>Tgl</th>
                                                      <th>No.PO</th>
                                                      <th>Ref.PO</th>
                                                      <th>Supplier</th>
                                                      <th>Lokasi&nbsp;Beli</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                    </table>
                              </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  </div>
            </div>
      </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" id="modalListItemPo">
      <div class="modal-dialog modal-lg">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">List Barang</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-horizontal">
                              <div class="form-group">
                                    <div class="table-responsive">
                                          <input type="" id="hidden_no_row" name="hidden_no_row">
                                          <table id="tableDetailItemPo" class="table table-bordered" style="width: 100%;">
                                                <thead>
                                                      <tr>
                                                            <th>#</th>
                                                            <th>No</th>
                                                            <th>Kode Barang</th>
                                                            <th>Nama Barang</th>
                                                            <th>Qty PO</th>
                                                            <th>Qty LPB</th>
                                                            <th>Sisa Blm Terima</th>
                                                            <th>Sat</th>
                                                            <th>Keterangan</th>
                                                      </tr>
                                                </thead>
                                                <tbody id="tbody_listbarang">
                                                </tbody>
                                          </table>
                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  </div>
            </div>
      </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" id="showCamera">
      <div class="modal-dialog modal-md">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Scan QRcode</h4>
                        <button type="button" id="modalCameraClose" onclick="modalCameraClose()" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                  </div>
                  <div class="modal-body">
                        <video id="preview" width="100%"></video>
                  </div>
            </div>
      </div>
</div>
<style>
      .select2-container {
            white-space: nowrap;
            font-size: 9px;
      }
</style>
<script>
      function getGrupBarang(kodebar, n) {
            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Lpb/get_grup_barang'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {},

                  data: {
                        'kodebar': kodebar
                  },
                  success: function(data) {
                        $('#hidden_grup_' + n).text(data.grp);
                  }
            });
      }

      function sumqty(kodebar, noref, qty, i) {

            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Lpb/sum_qty_mutasi'); ?>",
                  dataType: "JSON",

                  data: {
                        'kodebar': kodebar,
                        'noref': noref,
                        'qty': qty
                  },
                  success: function(data) {
                        // console.log(data + 'sum');
                        $('#sisa_qty_' + i).text(data);
                  }
            });
      }

      var n = 0;

      function tambah_row(row, ) {
            var status_item_lpb = '0';
            // var row = ++num_last;
            console.log(row);
            // var row = $('#hidden_no_table').val();
            var tr_buka = '<tr id="tr_' + row + '">';
            // var td_col_1 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            //     '<input type="hidden" id="hidden_proses_status_' + row + '" name="hidden_proses_status_' + row + '" value="insert">' +
            //     // +'<button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" id="btn_tambah_row" name="btn_tambah_row" onclick="pilihModalBarang('+row+')"></button><br />'+
            //     '<button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" id="btn_tambah_row" name="btn_tambah_row" onclick="tambah_row(' + row + ')"></button><br />' +
            //     '<button class="btn btn-xs btn-danger fa fa-minus btn_hapus_row" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row_' + row + '" name="btn_hapus_row_' + row + '" onclick="hapus_row(' + row + ')"></button>' +
            //     '</td>';
            var form_buka = '<form id="form_rinci_' + row + '" name="form_rinci_' + row + '" method="POST" action="javascript:;">'
            var td_col_2 = '<td style="padding-right: 0.2em; padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<div class="row">' +
                  '<input type="text" class="form-control col-8" id="txt_kode_barang_' + row + '" name="txt_kode_barang_' + row + '" placeholder="Kode Barang" readonly>' +
                  '<label class="ml-1 mt-1">' +
                  '<input type="checkbox" id="chk_asset_' + row + '" name="chk_asset_' + row + '" value="">' +
                  '<span class="text-muted" face="Verdana" size="1.8"> Asset ?</span>' +
                  '</label>' +
                  '</div>' +
                  '</td>';
            var td_col_3 = '<td style="padding-right: 0.2em; padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<div class="row">' +
                  '<span face="Verdana" class="ml-2" id="txt_nama_brg_' + row + '" size="1.8">Nama Barang</span>&emsp;/' +
                  '<span face="Verdana" class="ml-2" id="txt_satuan_' + row + '" size="1.8">Satuan</span>&emsp;/' +
                  '<span face="Verdana" class="ml-2" id="txt_grup_' + row + '" size="1.8">Grup</span>' +
                  '</div>' +
                  '</td>';
            var td_col_4 = '<td style="padding-right: 0.4em; padding-left: 0.4em; padding-top: 1px; padding-bottom: 0em;">' +
                  '<span class="small text-muted" style="font-size:12px;">qty&nbsp;BKB&emsp;:&nbsp;</span><span id="qty_po_' + row + '" class="small" style="font-size:12px;"></span><br>' +
                  '<span class="small text-muted" style="font-size:12px;">sisa&nbsp;qty :&nbsp;</span><span id="sisa_qty_' + row + '" class="small" style="font-size:12px;"></span>' +
                  '</td>';
            var td_col_5 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<input type="text" class="form-control currencyduadigit" id="txt_qty_' + row + '" name="txt_qty_' + row + '" placeholder="Qty" autocomplite="off" onkeyup="cek_qty(' + row + ')">' +
                  '</td>';
            var td_col_6 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<textarea class="resizable_textarea form-control" id="txt_ket_rinci_' + row + '" name="txt_ket_rinci_' + row + '" placeholder="Keterangan" rows="1"></textarea>' +
                  '<input type="hidden" id="hidden_id_item_lpb_' + row + '" name="hidden_id_item_lpb_' + row + '">' +
                  '<input type="hidden" id="hidden_txtperiode_' + row + '" name="hidden_txtperiode_' + row + '">' +
                  '</td>';
            var td_col_7 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<button class="btn btn-xs btn-success fa fa-save" id="btn_simpan_' + row + '" name="btn_simpan_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="saveRinciClick(' + row + ')"></button>' +
                  '<button style="display:none;" class="btn btn-xs btn-warning fa fa-edit" id="btn_ubah_' + row + '" name="btn_ubah_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" onclick="ubahRinci(' + row + ')"></button>' +
                  '<button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_' + row + '" name="btn_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="updateRinci(' + row + ')"></button>' +
                  '<button style="display:none;" class="btn btn-xs btn-primary  mdi mdi-close-thick" id="btn_cancel_update_' + row + '" name="btn_cancel_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update" onclick="cancelUpdate(' + row + ')"></button>' +
                  // '<button style="display:none;" class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_' + row + '" name="btn_hapus_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + row + ')"></button>' +
                  '<label id="lbl_status_simpan_' + row + '"></label>' +
                  '</td>';
            var td_col_7b = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<span class="small text-muted" style="font-size:12px;"><i>Habis!</i></span>' +
                  '</td>';
            var form_tutup = '</form>';
            var tr_tutup = '</tr>';

            if (status_item_lpb == 1) {
                  $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7b + form_tutup + tr_tutup);
            } else {
                  $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7 + form_tutup + tr_tutup);
            }

            $('#txt_qty_' + row).number(true);

            // $('html, body').animate({
            //     scrollTop: $("#tr_" + row).offset().top
            // }, 2000);

            // row++;
            // $('#hidden_no_table').val(row);
      }

      function sisaQtyPO(no_ref_po, kodebar, n) {
            console.log('sisa qty no ' + n);
            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Lpb/sum_sisa_qty_mutasi'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {},

                  data: {
                        'no_ref_po': no_ref_po,
                        'kodebar': kodebar
                  },
                  success: function(data) {
                        $('#sisa_qty_' + n).text(data);
                  }
            });
      }

      // qrcode
      function modalCameraClose() {
            scanner.stop();
            $('#multiple').css('display', 'none');
            $('#select2_mutasi').next(".select2-container").show();
      }

      $(document).ready(function() {
            // $('#a_print_lpb').hide();
            $('#showCamera').modal('show');
            $('#preview').show();
            $('#multiple').css('display', 'block');
            $('#select2_mutasi').next(".select2-container").hide();
      });

      function showCamera() {
            $('#showCamera').modal('show');
            $('#preview').show();
            $('#multiple').css('display', 'block');
            $('#select2_mutasi').next(".select2-container").hide();
            scanner.start();
      }

      let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
      });
      scanner.addListener('scan', function(content) {
            console.log(content);
            $('#preview').hide();
            cariBkbItemqr(content);
            $('#showCamera').modal('hide');
            $('#multiple').val(content);
            scanner.stop();
      });
      Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                  scanner.start(cameras[0]);
            } else {
                  console.error('No cameras found.');
            }
      }).catch(function(e) {
            console.error(e);
      });
      // end qrcode

      function cariBkbItemqr(noref) {

            // var nopo = $('#multiple').val();
            // console.log(n + 'yeyelala');

            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Lpb/get_data_mutasi_item'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {
                        $('#tbody_rincian').empty();
                  },

                  data: {
                        'noref': noref
                  },
                  success: function(data) {

                        var data_mutasi = data.data_mutasi;
                        var data_item_mutasi = data.data_item_mutasi;

                        console.log(data);

                        $('#noref_span').html(data_mutasi.NO_REF + '&emsp;&emsp;&emsp;&emsp;');
                        $('#txt_no_po').val(data_mutasi.skb);
                        $('#tgl_bkb_txt').text(data_mutasi.tgl);
                        $('#bagian_txt').text(data_mutasi.bag);
                        $('#kepada_txt').text(data_mutasi.kpd);
                        $('#keperluan_txt').text(data_mutasi.keperluan);
                        $('#asal_pt_txt').text(data_mutasi.pt);
                        $('#asal_devisi_txt').text(data_mutasi.devisi);
                        $('#pt_tujuan_txt').text(data_mutasi.pt_mutasi);
                        $('#devisi_tujuan_txt').text(data_mutasi.devisi_mutasi);
                        $('#devisi').val(data_mutasi.kode_devisi_mutasi);


                        // $("#modalListPo").modal('hide');

                        for (i = 0; i < data_item_mutasi.length; i++) {
                              // var no = i + 1;

                              tambah_row(i);
                              sumqty(data_item_mutasi[i].kodebar, data_mutasi.NO_REF, data_item_mutasi[i].qty2, i);

                              var kodebar = data_item_mutasi[i].kodebar;
                              var nabar = data_item_mutasi[i].nabar;
                              var qty = data_item_mutasi[i].qty2;
                              var sat = data_item_mutasi[i].satuan;
                              var grp = data_item_mutasi[i].grp;
                              var ket = data_item_mutasi[i].ket;

                              // Set data
                              $('#txt_kode_barang_' + i).val(kodebar);
                              $('#txt_nama_brg_' + i).text(nabar);
                              $('#qty_po_' + i).text(qty);
                              $('#txt_satuan_' + i).text(sat);
                              $('#txt_grup_' + i).text(grp);
                              $('#txt_ket_rinci_' + i).text(ket);

                        }
                  },
                  error: function(response) {
                        console.log(response.responseText);
                  }
            });
      }

      $("#select2_mutasi").select2({
            ajax: {
                  url: "<?php echo site_url('Lpb/select2_get_bkb_mutasi') ?>",
                  dataType: 'json',
                  delay: 250,
                  data: function(params) {
                        return {
                              noref: params.term, // search term
                        };
                  },
                  processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                              results.push({
                                    id: item.NO_REF,
                                    text: item.NO_REF
                              });
                        });
                        return {
                              results: results
                        };
                  }
            }
      }).on('select2:select', function(evt) {
            // var selected = evt.params.data;
            // var a = "0475";
            // var b = "TOKO ( KAS )";
            // var kode = $(".select2 option:selected").text(a);
            // var data = $(".select2 option:selected").val(b);
            // $('#kd_supplier').val(kode);
            var data = $(".select2_mutasi option:selected").text();
            // console.log(data);
            $('#txt_ref_po').val(data);
            // $('#multiple').val(data);
            // $('#hidden_no_ref_spp_').val(data);
            // console.log(data);

            cariBkbItemqr(data);

      });

      function saveRinciClick(n) {

            var qty = $('#txt_qty_' + n).val();

            if (!qty) {
                  toast('Qty');
            } else {
                  saveRinci(n);
            }
            return false;
      };

      function toast(v_text) {
            $.toast({
                  position: 'top-right',
                  heading: 'Failed!',
                  text: v_text + ' is required!',
                  icon: 'error',
                  loader: true,
                  loaderBg: 'red'
            });
      }

      function saveRinci(n) {

            var no_ref_po = $('#txt_ref_po').val();
            var no_po = $('#txt_no_po').val();
            var kodebar = $('#txt_kode_barang_' + n).val();

            if ($('#chk_asset_' + n).is(':checked')) {
                  var chk_asset = 'yes';
            }

            $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('Lpb/saveLpb') ?>",
                  dataType: "JSON",

                  beforeSend: function() {
                        $('#btn_simpan_' + n).css('display', 'none');

                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>');

                        if ($.trim($('#hidden_no_lpb').val()) == '') {
                              $('#lbl_lpb_status').empty();
                              $('#lbl_lpb_status').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Generate PO Number</label>');
                        }
                  },

                  data: {
                        txt_no_po: $('#txt_no_po').val(),
                        txt_ref_po: $('#txt_ref_po').val(),
                        // hidden_no_ref_bkb: $('#hidden_no_ref_bkb').val(),
                        txt_kode_barang: $('#txt_kode_barang_' + n).val(),
                        txt_nama_brg: $('#txt_nama_brg_' + n).text(),
                        txt_tgl_terima: $('#txt_tgl_terima').val(),
                        hidden_no_lpb: $('#hidden_no_lpb').val(),
                        hidden_no_ref_lpb: $('#hidden_no_ref_lpb').val(),
                        chk_asset: chk_asset,
                        // txt_kd_supplier: $('#txt_kd_supplier').val(),
                        txt_kd_supplier: 'NULL',
                        // txt_supplier: $('#txt_supplier').val(),
                        txt_supplier: 'NULL',
                        // txt_no_pengantar: $('#txt_no_pengantar').val(),
                        txt_no_pengantar: 'NULL',
                        // txt_lokasi_gudang: $('#txt_lokasi_gudang').val(),
                        txt_lokasi_gudang: 'NULL',
                        // txt_ket_pengiriman: $('#txt_ket_pengiriman').val(),
                        txt_ket_pengiriman: 'NULL',
                        devisi: $('#devisi').val(),
                        txt_satuan: $('#txt_satuan_' + n).text(),
                        hidden_grup: $('#txt_grup_' + n).text(),
                        txt_qty: $('#txt_qty_' + n).val(),
                        txt_ket_rinci: $('#txt_ket_rinci_' + n).val(),
                        mutasi: '1'
                  },

                  success: function(data) {

                        console.log(data);

                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_lpb_status').empty();

                        $.toast({
                              position: 'top-right',
                              heading: 'Success',
                              text: 'Berhasil Disimpan!',
                              icon: 'success',
                              loader: false
                        });

                        // hitung sisa qty po guys
                        sisaQtyPO(no_ref_po, kodebar, n);

                        $('#no_lpb').html('No. SPP : ' + data.nolpb);
                        $('#no_ref_lpb').html('No. Ref. SPP : ' + data.noreflpb);

                        $('.div_form_1').find('#select2_mutasi, #camera, #multiple, #devisi, #txt_tgl_terima, #txt_no_pengantar, #txt_lokasi_gudang, #txt_no_po, #txt_ket_pengiriman').addClass('bg-light');
                        $('.div_form_1').find('#select2_mutasi, #camera, #multiple, #devisi, #txt_tgl_terima, #txt_no_pengantar, #txt_lokasi_gudang, #txt_no_po, #txt_ket_pengiriman').attr('disabled', '');

                        $('.div_form_2').find('#txt_kode_barang_' + n + ', #chk_asset_' + n + ', #txt_qty_' + n + ',#txt_ket_rinci_' + n).addClass('bg-light');
                        $('.div_form_2').find('#txt_kode_barang_' + n + ', #chk_asset_' + n + ', #txt_qty_' + n + ',#txt_ket_rinci_' + n).attr('disabled', '');
                        // $('.headspp').find('#cancelSpp').removeAttr('disabled');

                        $('#btn_hapus_row_' + n).css('display', 'none');
                        $('#btn_ubah_' + n).css('display', 'block');
                        $('#btn_hapus_' + n).css('display', 'block');

                        $('#hidden_no_lpb').val(data.nolpb);
                        $('#hidden_no_ref_lpb').val(data.noreflpb);
                        $('#hidden_id_lpb').val(data.id_lpb);
                        $('#hidden_id_item_lpb_' + n).val(data.id_item_lpb);

                        $('#hidden_txtperiode_' + n).val(data.txtperiode);

                        $('#a_print_lpb').show();

                  },
                  error: function(response) {
                        console.log(response.responseText);
                  }
            });
      }

      function ubahRinci(n) {

            $('.div_form_2').find('#txt_kode_barang_' + n + ', #chk_asset_' + n + ', #txt_qty_' + n + ',#txt_ket_rinci_' + n + '').removeClass('bg-light');
            $('.div_form_2').find('#txt_kode_barang_' + n + ', #chk_asset_' + n + ', #txt_qty_' + n + ',#txt_ket_rinci_' + n + '').removeAttr('disabled');

            $('#btn_simpan_' + n).css('display', 'none');
            $('#btn_hapus_' + n).css('display', 'none');
            $('#btn_ubah_' + n).css('display', 'none');
            $('#btn_update_' + n).css('display', 'block');
            $('#btn_cancel_update_' + n).css('display', 'block');

            $("#status_sukses").remove();
      };

      //Update Data
      function updateRinci(n) {
            if ($('#chk_asset_' + n).is(':checked')) {
                  var chk_asset = 'yes';
            }

            var no_ref_po = $('#txt_ref_po').val();
            var no_po = $('#txt_no_po').val();
            var kodebar = $('#txt_kode_barang_' + n).val();

            $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('Lpb/updateLpb') ?>",
                  dataType: "JSON",

                  beforeSend: function() {

                        $('#btn_update_' + n).css('display', 'none');

                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i>');
                  },

                  data: {
                        // hidden_no_ref_bkb: $('#hidden_no_ref_bkb').val(),
                        chk_asset: chk_asset,
                        txt_qty: $('#txt_qty_' + n).val(),
                        txt_ket_rinci: $('#txt_ket_rinci_' + n).val(),
                        hidden_no_lpb: $('#hidden_no_lpb').val(),
                        hidden_no_ref_lpb: $('#hidden_no_ref_lpb').val(),
                        hidden_id_item_lpb: $('#hidden_id_item_lpb_' + n).val(),
                        hidden_txtperiode: $('#hidden_txtperiode_' + n).val(),
                        kode_dev: $('#devisi').val(),
                        nopo: no_po,
                        norefpo: no_ref_po,
                        kodebar: kodebar,
                        mutasi: '1'
                  },

                  success: function(data) {
                        console.log(data + "sukses update");

                        $('#lbl_status_simpan_' + n).empty();

                        sisaQtyPO(no_ref_po, kodebar, n);

                        $.toast({
                              position: 'top-right',
                              heading: 'Success',
                              text: 'Berhasil Diupdate!',
                              icon: 'success',
                              loader: false
                        });

                        $('.div_form_2').find('#txt_kode_barang_' + n + ', #chk_asset_' + n + ', #txt_qty_' + n + ',#txt_ket_rinci_' + n).addClass('bg-light');
                        $('.div_form_2').find('#txt_kode_barang_' + n + ', #chk_asset_' + n + ', #txt_qty_' + n + ',#txt_ket_rinci_' + n).attr('disabled', '');

                        $('#btn_ubah_' + n).css('display', 'block');
                        $('#btn_hapus_' + n).css('display', 'block');
                        $('#btn_cancel_update_' + n).css('display', 'none');
                  }
            });
      };

      function cancelUpdate(n) {
            $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('Lpb/cancelUpdateItemLpb') ?>",
                  dataType: "JSON",

                  beforeSend: function() {

                        $('#btn_cancel_update_' + n).css('display', 'none');

                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>');
                  },

                  data: {
                        hidden_id_item_lpb: $('#hidden_id_item_lpb_' + n).val()
                  },

                  success: function(data) {
                        console.log(data);

                        // $('#chk_asset' + n).val(data.ASSET);
                        if (data.ASSET == 1) {
                              $('#chk_asset_' + n).prop('checked', true);
                        } else {
                              $('#chk_asset_' + n).prop('checked', false);
                        }

                        $('#lbl_status_simpan_' + n).empty();

                        $('#txt_qty_' + n).val(data.qty);
                        $('#txt_ket_rinci_' + n).val(data.ket);

                        $.toast({
                              position: 'top-right',
                              text: 'Edit Dibatalkan!',
                              icon: 'success',
                              loader: false
                        });

                        $('.div_form_1').find('#select2_mutasi, #openreader-multi, #multiple, #devisi, #txt_tgl_terima, #txt_no_pengantar, #txt_lokasi_gudang, #txt_no_po, #txt_ket_pengiriman').addClass('bg-light');
                        $('.div_form_1').find('#select2_mutasi, #openreader-multi, #multiple, #devisi, #txt_tgl_terima, #txt_no_pengantar, #txt_lokasi_gudang, #txt_no_po, #txt_ket_pengiriman').attr('disabled', '');

                        $('.div_form_2').find('#txt_kode_barang_' + n + ', #chk_asset_' + n + ', #txt_qty_' + n + ',#txt_ket_rinci_' + n).addClass('bg-light');
                        $('.div_form_2').find('#txt_kode_barang_' + n + ', #chk_asset_' + n + ', #txt_qty_' + n + ',#txt_ket_rinci_' + n).attr('disabled', '');
                        // $('.headspp').find('#cancelSpp').removeAttr('disabled');

                        $('#btn_hapus_row_' + n).css('display', 'none');
                        $('#btn_update_' + n).css('display', 'none');
                        $('#btn_ubah_' + n).css('display', 'block');
                        $('#btn_hapus_' + n).css('display', 'block');

                  }
            });
      }

      function cek_qty(n) {
            $('#txt_qty_' + n).keyup(function() {
                  var qty = $('#txt_qty_' + n).val();
                  var hidden_qty = $('#sisa_qty_' + n).text();
                  var a = Number(qty);
                  var b = Number(hidden_qty);
                  if (a > b) {
                        swal("Qty melebihi sisa Qty LPB");
                        $('#txt_qty_' + n).val('');
                  }
            });
      }

      function cetak_lpb() {

            var no_lpb = $('#hidden_no_lpb').val();
            var id = $('#hidden_id_lpb').val();
            console.log(no_lpb);
            console.log(id);

            window.open("<?= base_url('Lpb/cetak/') ?>" + no_lpb + '/' + id, '_blank');

            $('.div_form_2').css('pointer-events', 'none');
      }
</script>