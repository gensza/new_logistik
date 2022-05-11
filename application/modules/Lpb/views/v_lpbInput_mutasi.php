<?php
date_default_timezone_set('Asia/Jakarta');
?>
<div class="container-fluid">
      <!-- start row-->
      <div class="row mt-0">
            <div class="col-12">
                  <div class="card">
                        <div class="card-body">
                              <div class="row justify-content-between" style="margin-top: -10px;">
                                    <h4 class="header-title ml-2">LPB <b>MUTASI</b></h4>
                                    <div class="button-list mr-2">
                                          <!--<button class="qrcode-reader mdi mdi-camera btn btn-xs btn-primary ml-1" id="camera" type="button" onclick="showCamera()"></button>-->
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
                                    <div class="row div_form_1 col-lg-12">
                                          <div class="col-lg-2">
                                                <p class="text-muted mb-0" style="font-size:12px;">Tgl Terima</p>
                                                <div class="media mb-2">
                                                      <div class="media-body">
                                                            <input id="txt_tgl_terima" name="txt_tgl_terima" class="form-control form-control-sm" type="date" value="<?= date('Y-m-d') ?>">
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="col-lg-3">
                                                <p class="text-muted mb-0" style="font-size:12px;">No.Ref Mutasi*</p>
                                                <div class="media mb-2">
                                                      <div class="media-body">
                                                            <select class="js-data-example-ajax form-control select2_mutasi" id="select2_mutasi">
                                                            </select>
                                                            <input style="display:none;" id="multiple" class="form-control form-control-sm bg-light" type="text" readonly>
                                                            <!-- <input id="txt_no_po" name="txt_no_po" class="form-control bg-light" type="" placeholder="No.Ref PO" autocomplete="off" readonly> -->
                                                            <input type="hidden" id="txt_ref_po">
                                                            <input type="hidden" id="txt_no_po">
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="col-lg-3">
                                                <p class="text-muted mb-0" style="font-size:12px;">Asal PT</p>
                                                <div class="media">
                                                      <div class="media-body">
                                                            <p class="mt-0" style="font-size: 12px; font-weight: bold;">
                                                                  <span id="asal_devisi_txt"></span>
                                                            </p>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="col-lg-4">
                                                <p class="text-muted mb-0" style="font-size:12px;">PT Tujuan</p>
                                                <div class="media">
                                                      <div class="media-body">
                                                            <p class="mt-0" style="font-size: 12px; font-weight: bold;">
                                                                  <span id="devisi_tujuan_txt"></span>
                                                                  <input type="hidden" id="devisi">
                                                            </p>
                                                      </div>
                                                </div>
                                          </div> <!-- end col -->

                                    </div>

                                    <div class="row div_form_1 col-lg-12">
                                          <div class="col-lg-2">
                                                <p class="text-muted mb-0" style="font-size:12px;">Tanggal BKB</p>
                                                <div class="media">
                                                      <div class="media-body">
                                                            <p class="mt-0">
                                                                  <span id="tgl_bkb_txt" style="font-size: 12px; font-weight: bold;"></span>
                                                            </p>
                                                      </div>
                                                </div>
                                          </div> <!-- end col -->
                                          <div class="col-lg-3">
                                                <p class="text-muted mb-0" style="font-size:12px;">Dari Departemen</p>
                                                <div class="media">
                                                      <div class="media-body">
                                                            <p class="mt-0" style="font-size: 12px; font-weight: bold;">
                                                                  <span id="bagian_txt"></span>
                                                            </p>
                                                      </div>
                                                </div>
                                          </div>
                                          <div class="col-lg-3">
                                                <p class="text-muted mb-0" style="font-size:12px;">Kepada</p>
                                                <div class="media">
                                                      <div class="media-body">
                                                            <p class="mt-0" style="font-size: 12px; font-weight: bold;">
                                                                  <span id="kepada_txt"></span>
                                                            </p>
                                                      </div>
                                                </div>
                                          </div> <!-- end col -->
                                          <div class="col-lg-4">
                                                <p class="text-muted mb-0" style="font-size:12px;">Keperluan</p>
                                                <div class="media">
                                                      <div class="media-body">
                                                            <p class="mt-0" style="font-size: 12px; font-weight: bold;">
                                                                  <span id="keperluan_txt"></span>
                                                            </p>
                                                      </div>
                                                </div>
                                          </div> <!-- end col -->
                                    </div>
                              </div>
                              <hr class="mt-0 mb-2">
                              <div class="row div_form_2">
                                    <div class="col-12">
                                          <div class="sub-header" style="margin-top: -10px; margin-bottom: -22px;">
                                                <input type="hidden" id="hidden_id_lpb">
                                                <input type="hidden" id="hidden_no_lpb">
                                                <input type="hidden" id="hidden_no_ref_lpb">
                                                <input type="hidden" id="hidden_kd_dept">
                                                <input type="hidden" id="hidden_ket_dept">
                                                <input type="hidden" id="hidden_asal_devisi_txt">
                                                <input type="hidden" id="hidden_noref_mutasi" value="<?= $noref_mutasi ?>">
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
                                                                  <th width="18%" style="font-size: 12px; padding: 10px; padding-left: 17px;">Kode Barang</th>
                                                                  <th width="27%" style="font-size: 12px; padding: 10px; padding-left: 15px;">Nama Barang / Satuan / Grup</th>
                                                                  <th width="9%" style="font-size: 12px; padding: 10px; padding-left: 15px;">Saldo Qty</th>
                                                                  <th width="9%" style="font-size: 12px; padding: 10px; padding-left: 17px;">Qty</th>
                                                                  <th width="20%" style="font-size: 12px; padding: 10px; padding-left: 17px;">Ket</th>
                                                                  <th width="6%" style="font-size: 12px; padding: 10px; padding-left: 17px;">#</th>
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

<!-- <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalListPo">
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
</div> -->

<!-- <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" id="modalListItemPo">
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
</div> -->

<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" id="showCamera">
      <div class="modal-dialog modal-md">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Scan QRcode</h4>
                        <label class="btn btn-info active btn-xs ml-1">
                              <input type="radio" name="putar_camera" value="1" autocomplete="off" checked> Front Camera
                        </label>
                        <label class="btn btn-secondary btn-xs">
                              <input type="radio" name="putar_camera" value="2" autocomplete="off"> Back Camera
                        </label>
                        <button type="button" id="modalCameraClose" onclick="modalCameraClose()" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                  </div>
                  <div class="modal-body">
                        <video id="preview" width="100%"></video>
                  </div>
            </div>
      </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalKonfirmasiHapusLpb">
      <div class="modal-dialog">
            <div class="modal-content">
                  <div class="modal-body p-4">
                        <div class="text-center">
                              <i class="dripicons-warning h1 text-warning"></i>
                              <h4 class="mt-2">Konfirmasi Hapus</h4>
                              <!-- <input type="hidden" id="hidden_no_delete" name="hidden_no_delete"> -->
                              <p class="mt-3">Apakah Anda yakin ingin menghapus LPB ini ???</p>
                              <button type="button" class="btn btn-warning my-2" data-dismiss="modal" id="btn_delete" onclick="cekLpb()">Hapus</button>
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

<style>
      .select2-container {
            white-space: nowrap;
            font-size: 12px;
            height: 50%;
      }
</style>
<script>
      function cekLpb() {

            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Lpb/cekDataLpb'); ?>",
                  dataType: "JSON",
                  beforeSend: function() {},

                  data: {
                        noreflpb: $('#hidden_no_ref_lpb').val(),
                  },
                  success: function(data) {

                        for (var i = 0; i < data; i++) {
                              //delete item 1 per satu
                              console.log(i);
                              updateRinciToZero(i);
                        }
                  },
                  error: function(response) {
                        alert('KONEKSI TERPUTUS! Gagal Menghapus LPB');
                  }
            });
      }

      function cancelLpb(n) {

            // $('#modalKonfirmasiHapusLpb').modal('show');
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
                  cekLpb();
            }
      }


      function goBack() {
            window.history.back();
      }

      function new_lpb() {
            location.href = "<?php echo base_url('Lpb/lpb_mutasi') ?>";
      }

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
                  },
                  error: function(response) {
                        alert('KONEKSI TERPUTUS! Silahkan Refresh Halaman!');
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
                        $('#hidden_sisa_qty_' + i).val(data);
                  },
                  error: function(response) {
                        alert('KONEKSI TERPUTUS! Silahkan Refresh Halaman!');
                  }
            });
      }

      var n = 0;

      function tambah_row(row, status_item_lpb) {
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
                  '<input type="text" class="form-control form-control-sm col-8" id="txt_kode_barang_' + row + '" name="txt_kode_barang_' + row + '" placeholder="Kode Barang" readonly>' +
                  '<label class="ml-1 mt-1">' +
                  '<input type="checkbox" id="chk_asset_' + row + '" name="chk_asset_' + row + '" value="">' +
                  '<span class="text-muted" style="font-size: 12px;"> Asset ?</span>' +
                  '</label>' +
                  '</div>' +
                  '</td>';
            var td_col_3 = '<td style="padding-right: 0.2em; padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<div class="row">' +
                  '<span style="font-size: 12px;" face="Verdana" class="ml-2" id="txt_nama_brg_' + row + '">Nama Barang</span>&emsp;/' +
                  '<span style="font-size: 12px;" face="Verdana" class="ml-2" id="txt_satuan_' + row + '">Satuan</span>&emsp;/' +
                  '<span style="font-size: 12px;" face="Verdana" class="ml-2" id="txt_grup_' + row + '">Grup</span>' +
                  '</div>' +
                  '</td>';
            var td_col_4 = '<td style="padding-right: 0.4em; padding-top: 1px; padding-bottom: 0em;">' +
                  '<span class="small text-muted" style="font-size:12px;">Qty&nbsp;MTS :&nbsp;</span><span id="qty_po_' + row + '" class="small" style="font-size:12px;"></span><br>' +
                  '<span class="small text-muted" style="font-size:12px;">Sisa&nbsp;Qty :&nbsp;</span><span id="sisa_qty_' + row + '" class="small" style="font-size:12px;"></span>' +
                  '</td>';
            var td_col_5 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<input type="text" style="font-size: 12px;" class="form-control form-control-sm currencyduadigit" id="txt_qty_' + row + '" name="txt_qty_' + row + '" placeholder="Qty" autocomplite="off" onkeyup="cek_qty(' + row + ')">' +
                  '<input type="hidden" id="hidden_qtypo_' + row + '" name="hidden_qtypo_' + row + '">' +
                  '</td>';
            var td_col_6 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<textarea class="resizable_textarea form-control form-control-sm" id="txt_ket_rinci_' + row + '" name="txt_ket_rinci_' + row + '" placeholder="Keterangan" rows="2" style="font-size: 12px;"></textarea>' +
                  '<input type="hidden" id="hidden_id_item_lpb_' + row + '" name="hidden_id_item_lpb_' + row + '">' +
                  '<input type="hidden" id="hidden_txtperiode_' + row + '" name="hidden_txtperiode_' + row + '">' +
                  '<input type="hidden" id="hidden_sisa_qty_' + row + '" name="hidden_sisa_qty_' + row + '">' +
                  '<input type="hidden" id="hidden_kodesub_' + row + '" name="hidden_kodesub_' + row + '">' +
                  '</td>';
            var td_col_7 = '<td style="padding-top: 2px;">' +
                  '<div class="row">' +
                  '<button class="btn btn-xs btn-success fa fa-save ml-1" id="btn_simpan_' + row + '" name="btn_simpan_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="saveRinciClick(' + row + ')"></button>' +
                  '<button style="display:none;" class="btn btn-xs btn-warning fa fa-edit ml-1" id="btn_ubah_' + row + '" name="btn_ubah_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" onclick="ubahRinci(' + row + ')"></button>' +
                  '<button style="display:none;" class="btn btn-xs btn-info fa fa-check ml-1" id="btn_update_' + row + '" name="btn_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="updateRinci(' + row + ')"></button>' +
                  '<button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick ml-1" id="btn_cancel_update_' + row + '" name="btn_cancel_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update" onclick="cancelUpdate(' + row + ')"></button>' +
                  '<button style="display:none;" class="btn btn-xs btn-danger fa fa-trash ml-1" id="btn_hapus_' + row + '" name="btn_hapus_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + row + ')"></button>' +
                  '<label id="lbl_status_simpan_' + row + '"></label>' +
                  '</div>' +
                  '</td>';
            var td_col_7b = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                  '<span class="small text-muted" style="font-size:12px;"><i>Habis!</i></span>' +
                  '</td>';
            var form_tutup = '</form>';
            var tr_tutup = '</tr>';

            if (status_item_lpb == 1) {
                  // $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7b + form_tutup + tr_tutup);
            } else {
                  $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7 + form_tutup + tr_tutup);
            }

            // $('#txt_qty_' + row).number(true);
            input_number(row);

            // $('html, body').animate({
            //     scrollTop: $("#tr_" + row).offset().top
            // }, 2000);

            // row++;
            // $('#hidden_no_table').val(row);
      }

      function input_number(n) {
            $("#txt_qty_" + n).on("keypress keyup blur", function(event) {
                  //this.value = this.value.replace(/[^0-9\.]/g,'');
                  $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                  if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                        event.preventDefault();
                  }
            });
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
                  },
                  error: function(response) {
                        alert('KONEKSI TERPUTUS! Silahkan Refresh Halaman!');
                  }
            });
      }

      // qrcode
      function modalCameraClose() {
            if (!$('#hidden_noref_mutasi').val()) {
                  scanner.stop();
                  $('#multiple').css('display', 'none');
                  $('#select2_mutasi').next(".select2-container").show();
            } else {
                  scanner.stop();
                  $('#multiple').css('display', 'block');
                  $('#select2_mutasi').next(".select2-container").hide();
            }
      }

      $(document).ready(function() {
            // $('#a_print_lpb').hide();
            if (!$('#hidden_noref_mutasi').val()) {
                  console.log('kosong');
                  $('#showCamera').modal('show');
                  $('#select2_mutasi').next(".select2-container").show();
                  $('#preview').show();
                  $('#multiple').css('display', 'none');
            } else {
                  $('#select2_mutasi').next(".select2-container").hide();
                  $('#multiple').css('display', 'block');
                  var hidden_noref_mutasi = $('#hidden_noref_mutasi').val();
                  $('#multiple').val(hidden_noref_mutasi);
                  cariBkbItemqr(hidden_noref_mutasi);
                  $('#txt_ref_po').val(hidden_noref_mutasi);
            }
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
            $('#select2_mutasi').next(".select2-container").hide();
            $('#preview').hide();
            cariBkbItemqr(content);
            $('#showCamera').modal('hide');
            $('#multiple').css('display', 'block');
            $('#multiple').val(content);
            $('#txt_ref_po').val(content);
            scanner.stop();
      });
      Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                  scanner.start(cameras[0]);
                  $('[name="putar_camera"]').on('change', function() {
                        if ($(this).val() == 1) {
                              if (cameras[0] != "") {
                                    scanner.start(cameras[0]);
                              } else {
                                    alert('No Front camera found!');
                              }
                        } else if ($(this).val() == 2) {
                              if (cameras[1] != "") {
                                    scanner.start(cameras[1]);
                              } else {
                                    alert('No Back camera found!');
                              }
                        }
                  });
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

                        $('#noref_span').html('No. Mutasi : ' + data_mutasi.no_mutasi + '&emsp;&emsp;&emsp;&emsp;');
                        $('#txt_no_po').val(data_mutasi.skb);
                        $('#tgl_bkb_txt').text(formatDate(data_mutasi.tgl));
                        $('#bagian_txt').text(data_mutasi.bag);
                        $('#kepada_txt').text(data_mutasi.kpd);
                        $('#keperluan_txt').text(data_mutasi.keperluan);
                        $('#asal_pt_txt').text(data_mutasi.pt);
                        $('#asal_devisi_txt').text(data_mutasi.devisi);
                        $('#hidden_asal_devisi_txt').val(data_mutasi.devisi);
                        $('#pt_tujuan_txt').text(data_mutasi.pt_mutasi);
                        $('#devisi_tujuan_txt').text(data_mutasi.devisi_mutasi);
                        $('#devisi').val(data_mutasi.kode_devisi_mutasi);


                        // $("#modalListPo").modal('hide');

                        for (i = 0; i < data_item_mutasi.length; i++) {
                              // var no = i + 1;

                              tambah_row(i, data_item_mutasi[i].status_item_lpb);
                              sumqty(data_item_mutasi[i].kodebar, data_mutasi.no_mutasi, data_item_mutasi[i].qty2, i);

                              var kodebar = data_item_mutasi[i].kodebar;
                              var nabar = data_item_mutasi[i].nabar;
                              var qty = data_item_mutasi[i].qty2;
                              var sat = data_item_mutasi[i].satuan;
                              var grp = data_item_mutasi[i].grp;
                              var ket = data_item_mutasi[i].ket;
                              var kodesub = data_item_mutasi[i].kodesub;

                              // Set data
                              $('#txt_kode_barang_' + i).val(kodebar);
                              $('#txt_nama_brg_' + i).text(nabar);
                              $('#qty_po_' + i).text(qty);
                              $('#hidden_qtypo_' + i).val(qty);
                              $('#txt_satuan_' + i).text(sat);
                              $('#txt_grup_' + i).text(grp);
                              $('#txt_ket_rinci_' + i).text(ket);
                              $('#hidden_kodesub_' + i).val(kodesub);

                        }
                  },
                  error: function(response) {
                        alert('KONEKSI TERPUTUS! Silahkan Refresh Halaman!');
                  }
            });
      }

      function formatDate(date) {
            var d = new Date(date),
                  month = '' + (d.getMonth() + 1),
                  day = '' + d.getDate(),
                  year = d.getFullYear();

            if (month.length < 2)
                  month = '0' + month;
            if (day.length < 2)
                  day = '0' + day;

            return [year, month, day].join('-');
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
                                    id: item.no_mutasi,
                                    text: item.no_mutasi
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
            console.log(no_ref_po);
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
                              $('#lbl_lpb_status').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Generate LPB Number</label>');
                        }
                  },

                  data: {
                        txt_no_po: $('#txt_no_po').val(),
                        txt_ref_po: $('#txt_ref_po').val(),
                        hidden_kd_dept: '',
                        hidden_ket_dept: $('#bagian_txt').text(),
                        // hidden_no_ref_bkb: $('#hidden_no_ref_bkb').val(),
                        txt_tgl_terima: $('#txt_tgl_terima').val(),
                        hidden_no_lpb: $('#hidden_no_lpb').val(),
                        hidden_no_ref_lpb: $('#hidden_no_ref_lpb').val(),
                        chk_asset: chk_asset,
                        // txt_supplier: $('#txt_supplier').val(),
                        txt_supplier: $('#hidden_asal_devisi_txt').val(),
                        // txt_no_pengantar: $('#txt_no_pengantar').val(),
                        txt_no_pengantar: '',
                        // txt_lokasi_gudang: $('#txt_lokasi_gudang').val(),
                        txt_lokasi_gudang: '',
                        // txt_ket_pengiriman: $('#txt_ket_pengiriman').val(),
                        txt_ket_pengiriman: $('#keperluan_txt').text(),
                        devisi: $('#devisi').val(),
                        txt_kode_barang: $('#txt_kode_barang_' + n).val(),
                        txt_nama_brg: $('#txt_nama_brg_' + n).text(),
                        txt_satuan: $('#txt_satuan_' + n).text(),
                        hidden_grup: $('#txt_grup_' + n).text(),
                        txt_qty: $('#txt_qty_' + n).val(),
                        hidden_qtypo: $('#hidden_qtypo_' + n).val(),
                        txt_ket_rinci: $('#txt_ket_rinci_' + n).val(),
                        txt_kd_supplier: $('#hidden_kodesub_' + n).val(),
                        mutasi: '1'
                  },

                  success: function(data) {

                        console.log(data);

                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_lpb_status').empty();
                        $('#new_lpb').removeAttr('disabled');
                        $('#camera').attr('disabled', '');

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
                        $('#cancelLpb').removeAttr('disabled');

                        $('#btn_hapus_row_' + n).css('display', 'none');
                        $('#btn_ubah_' + n).css('display', 'block');
                        $('#btn_hapus_' + n).css('display', 'block');

                        $('#hidden_no_lpb').val(data.nolpb);
                        $('#hidden_no_ref_lpb').val(data.noreflpb);
                        $('#hidden_id_lpb').val(data.id_lpb);
                        $('#hidden_id_item_lpb_' + n).val(data.id_item_lpb);

                        $('#hidden_txtperiode_' + n).val(data.txtperiode);

                        $('#a_print_lpb').removeAttr('disabled');

                        // notif2 jika ada function gagal
                        notiferor(data);

                  },
                  error: function(response) {
                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_lpb_status').empty();
                        $('#btn_simpan_' + n).css('display', 'block');
                        alert('KONEKSI TERPUTUS! Gagal Save Data!');
                  }
            });
      }

      function notiferor(data) {
            if (data.insert_stok_awal_bulanan == 0) {
                  alert('insert_stok_awal_bulanan GAGAL!');
            }

            if (data.insert_stok_harian == 0) {
                  alert('insert_stok_harian GAGAL!');
            }

            if (data.update_stok == 0) {
                  alert('update_stok GAGAL!');
            }

            if (data.insert_lpb_to_entry_gl_dr == 0) {
                  alert('insert_lpb_to_entry_gl_dr GAGAL!');
            }

            if (data.insert_lpb_to_entry_gl_cr == 0) {
                  alert('insert_lpb_to_entry_gl_cr GAGAL!');
            }

            if (data.insert_to_gl_header == 0) {
                  alert('insert_to_gl_header GAGAL!');
            }

            if (data.insert_register_stok == 0) {
                  alert('insert_register_stok GAGAL!');
            }
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

      function updateRinci(n) {

            var qty = $('#txt_qty_' + n).val();

            if (!qty || qty == 0) {
                  toast('Qty');
            } else {
                  updateRinciClick(n);
            }
            return false;
      };

      //Update Data
      function updateRinciClick(n) {
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

                        notiferrorupdate(data);
                  },
                  error: function(response) {
                        $('#btn_update_' + n).css('display', 'block');
                        $('#lbl_status_simpan_' + n).empty();
                        alert('KONEKSI TERPUTUS! Gagal Update Data!');
                  }
            });
      };

      function notiferrorupdate(data) {
            if (data.data_editStokAwalHarian == 0) {
                  alert('data_editStokAwalHarian GAGAL!');
            }
            if (data.data_editStokAwalBulananDevisi == 0) {
                  alert('data_editStokAwalBulananDevisi GAGAL!');
            }
            if (data.update_stok_awal == 0) {
                  alert('update_stok_awal GAGAL!');
            }
            if (data.data_update_lpb == 0) {
                  alert('data_update_lpb GAGAL!');
            }
            if (data.data_update_register_stok == 0) {
                  alert('data_update_register_stok GAGAL!');
            }
            if (data.data_edit_gl == 0) {
                  alert('data_edit_gl GAGAL!');
            }
      }

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

                  },
                  error: function(response) {
                        $('#btn_cancel_update_' + n).css('display', 'block');
                        $('#lbl_status_simpan_' + n).empty();
                        alert('KONEKSI TERPUTUS! Gagal Membatalkan Update!');
                  }
            });
      }

      function cek_qty(n) {
            $('#txt_qty_' + n).keyup(function() {
                  var qty = $('#txt_qty_' + n).val();
                  var hidden_qty = $('#hidden_sisa_qty_' + n).val();
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
                        updateRinciToZero(n);
                  }
            })
      }

      function updateRinciToZero(n) {
            if ($('#chk_asset_' + n).is(':checked')) {
                  var chk_asset = 'yes';
            }

            var no_ref_po = $('#txt_ref_po').val();
            var no_po = $('#txt_no_po').val();
            var kodebar = $('#txt_kode_barang_' + n).val();
            // var hidden_refppo = $('#hidden_refppo_' + n).val();

            $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('Lpb/updateLpb') ?>",
                  dataType: "JSON",

                  beforeSend: function() {

                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i>');
                  },

                  data: {
                        // hidden_no_ref_bkb: $('#hidden_no_ref_bkb').val(),
                        chk_asset: chk_asset,
                        txt_qty: 0,
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
                        // refppo: hidden_refppo,
                  },

                  success: function(data) {

                        sisaQtyPO(no_ref_po, kodebar, n);

                        // deleteData(n);

                        var status = $('#status_batal').val();
                        if (status != 1) {
                              deleteData(n);

                        } else {
                              batalData(n);

                        }

                  },
                  error: function(response) {
                        $('#lbl_status_simpan_' + n).empty();
                        alert('KONEKSI TERPUTUS! Gagal Update Data!');
                  }
            });
      };

      function batalData(n) {

            $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('Lpb/batalItemLpb') ?>",
                  dataType: "JSON",

                  beforeSend: function() {
                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i>');
                  },

                  data: {
                        hidden_id_item_lpb: $('#hidden_id_item_lpb_' + n).val(),
                        hidden_id_register_stok: $('#hidden_id_register_stok_' + n).val(),
                        norefpo: $('#txt_ref_po').val(),
                        delete_stok_register: '0',
                        alasan: $('#alasan').val(),
                        hidden_no_ref_lpb: $('#hidden_no_ref_lpb').val(),
                        kodebar: $('#txt_kode_barang_' + n).val(),
                  },

                  success: function(data) {

                        $('#chk_asset_' + n).prop('checked', false);
                        $('#txt_qty_' + n).val('');
                        $('#txt_ket_rinci_' + n).val('');

                        //cek di masukitem jika data == 0 hapus stokmasuk
                        cek_data_masukitem(n);
                        // if (n == 1) {
                        //     hapusLpb();
                        // }
                  },
                  error: function(response) {
                        $('#lbl_status_simpan_' + n).empty();
                        alert('KONEKSI TERPUTUS! Gagal Delete Data!');
                  }
            });
      };

      function deleteData(n) {

            $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('Lpb/deleteItemLpb') ?>",
                  dataType: "JSON",

                  beforeSend: function() {
                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i>');
                  },

                  data: {
                        hidden_id_item_lpb: $('#hidden_id_item_lpb_' + n).val(),
                        norefpo: $('#txt_ref_po').val(),
                        hidden_no_ref_lpb: $('#hidden_no_ref_lpb').val(),
                        kodebar: $('#txt_kode_barang_' + n).val(),
                  },

                  success: function(data) {
                        console.log(data);

                        $.toast({
                              position: 'top-right',
                              heading: 'Success',
                              text: 'Berhasil DiHapus!',
                              icon: 'success',
                              loader: false
                        });

                        $('#chk_asset_' + n).prop('checked', false);
                        $('#txt_qty_' + n).val('');
                        $('#txt_ket_rinci_' + n).val('');

                        //cek di masukitem jika data == 0 hapus stokmasuk
                        cek_data_masukitem(n);
                        // if (n == 1) {
                        //     hapusLpb();
                        // }

                        notiferrordeleteitem(data);
                  },
                  error: function(response) {
                        $('#lbl_status_simpan_' + n).empty();
                        alert('KONEKSI TERPUTUS! Gagal Delete Data!');
                  }
            });
      };

      function notiferrordeleteitem(data) {
            if (data.delete_masukitem == 0) {
                  alert('delete_masukitem GAGAL!');
            }
            if (data.delete_regis == 0) {
                  alert('delete_regis GAGAL!');
            }
            if (data.update_lpb_po == 0) {
                  alert('update_lpb_po GAGAL!');
            }
            if (data.delete_gl == 0) {
                  alert('delete_gl GAGAL!');
            }
      }

      function cek_data_masukitem(n) {
            var noreflpb = $('#hidden_no_ref_lpb').val();

            $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('Lpb/cek_data_masukitem') ?>",
                  dataType: "JSON",

                  beforeSend: function() {
                        $('#lbl_bkb_status').empty();
                        $('#lbl_bkb_status').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i>Cek data LPB</label>');
                  },

                  data: {
                        noreflpb: noreflpb
                  },

                  success: function(data) {
                        // jika data masukitem == 0 maka hapus stokmasuk
                        if (data == 0) {
                              var status = $('#status_batal').val();
                              if (status != 1) {
                                    hapusLpb();
                              } else {
                                    batalLpb();
                              }
                        } else {
                              $('#lbl_status_simpan_' + n).empty();

                              $('#btn_simpan_' + n).css('display', 'block');
                              $('#btn_ubah_' + n).css('display', 'none');
                              $('#btn_hapus_' + n).css('display', 'none');

                              $('.div_form_2').find('#chk_asset_' + n + ', #txt_qty_' + n + ',#txt_ket_rinci_' + n + '').removeClass('bg-light');
                              $('.div_form_2').find('#chk_asset_' + n + ', #txt_qty_' + n + ',#txt_ket_rinci_' + n + '').removeAttr('disabled');
                        }
                  },
                  error: function(response) {
                        $('#lbl_bkb_status').empty();
                        alert('KONEKSI TERPUTUS! Gagal Cek Data Masuk Item!');
                  }
            });
      }

      function batalLpb() {

            var noreflpb = $('#hidden_no_ref_lpb').val();
            var no_ref_po = $('#txt_ref_po').val();

            $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('Lpb/batalLpb') ?>",
                  dataType: "JSON",

                  beforeSend: function() {
                        $('#lbl_bkb_status').empty();
                        $('#lbl_bkb_status').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i>Proses Hapus LPB</label>');
                  },

                  data: {
                        noreflpb: noreflpb,
                        norefpo: no_ref_po,
                        alasan: $('#alasan').val()
                  },

                  success: function(data) {
                        // console.log(data);
                        $('#alasanbatal').modal('hide');
                        $.toast({
                              position: 'top-right',
                              heading: 'Dihapus',
                              text: 'Berhasil Dibatalkan!',
                              icon: 'success',
                              loader: false
                        });
                        setTimeout(function() {
                              location.reload();
                        }, 1000);
                  },
                  error: function(response) {
                        $('#lbl_bkb_status').empty();
                        alert('KONEKSI TERPUTUS! Gagal Hapus LPB!');
                  }
            });
      }

      //kalo lpb item lpb nya tinggal satu hapus LPB stokmasuknya
      function hapusLpb() {

            var noreflpb = $('#hidden_no_ref_lpb').val();
            var no_ref_po = $('#txt_ref_po').val();

            $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('Lpb/deleteLpb') ?>",
                  dataType: "JSON",

                  beforeSend: function() {
                        $('#lbl_bkb_status').empty();
                        $('#lbl_bkb_status').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i>Proses Hapus LPB</label>');
                  },

                  data: {
                        noreflpb: noreflpb,
                        norefpo: no_ref_po,
                  },

                  success: function(data) {
                        console.log(data);

                        notiferrordeletelpb(data);

                        location.reload();
                  },
                  error: function(response) {
                        $('#lbl_bkb_status').empty();
                        alert('KONEKSI TERPUTUS! Gagal Hapus LPB!');
                  }
            });
      }

      function notiferrordeletelpb(data) {
            if (data.delete_stokmasuk == 0) {
                  alert('delete_stokmasuk GAGAL!');
            }
            if (data.delete_header_entry == 0) {
                  alert('delete_header_entry GAGAL!');
            }
      }
</script>