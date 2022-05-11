<div class="container-fluid">
    <!-- start row-->
    <div class="row justify-content-center mt-0">
        <div class="col-md">
            <div class="widget-rounded-circle card-box mt-2">
                <h4 class="header-title">
                    <font face="Verdana"> LPB <i>(Edit)</i> </font>
                </h4>
                <p class="sub-header" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">
                    Input Laporan Penerimaan Barang
                </p>

                <!-- <div class="row div_form_1">
                    <div class="col-md-3">
                        <div class="form-group row mb-1">
                            <label class="col-lg-4 col-12 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">No.&nbsp;PO<span class="required">*</span>
                            </label>
                            <div class="col-lg-8 col-11 row"> -->
                <!-- <select class="js-data-example-ajax form-control select2" id="select2">
                                </select> -->
                <!-- <input id="multiple" class="form-control bg-light" type="text" class="col-2" onkeyup="cariPoqr()" readonly>
                                <input type="hidden" id="txt_no_po"> -->
                <!-- <input id="txt_no_po" name="txt_no_po" class="form-control" type="text" onfocus="cariPo()" placeholder="No. PO" autocomplete="off"> -->
                <!-- </div> -->
                <!-- <button class="qrcode-reader mdi mdi-camera btn btn-xs btn-primary ml-1" type="button" id="openreader-multi" data-qrr-multiple="true" data-qrr-repeat-timeout="0" data-qrr-target="#multiple" data-qrr-line-color="#00FF00"></button> -->
                <!-- </div>
                        <div class="form-group row mb-1">
                            <label class="col-4 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">No.Ref&nbsp;PO<span class="required">*</span>
                            </label>
                            <div class="col-md-8 row">
                                <input id="txt_ref_po" name="txt_ref_po" class="form-control bg-light" type="text" placeholder="No.Ref PO" autocomplete="off" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row mb-1">
                            <label class="col-4 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Tgl.&nbsp;PO<span class="required">*</span>
                            </label>
                            <div class="col-md-8 row">
                                <input id="txt_tgl_po" name="txt_tgl_po" class="form-control bg-light" required="required" type="text" placeholder="Tgl. PO" readonly autocomplite="off">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-4 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Supplier<span class="required">*</span>
                            </label>
                            <div class="col-md-8 row">
                                <input id="txt_kd_name_supplier" name="txt_kd_name_supplier" class="form-control bg-light" required="required" type="text" placeholder="Kode/Nama Supplier" readonly>
                                <input type="hidden" id="txt_kd_supplier">
                                <input type="hidden" id="txt_supplier">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"> -->
                <!-- <div class="form-group row mb-1">
                            <label class="col-4 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Devisi<span class="required">*</span>
                            </label>
                            <div class="col-md-8">
                                <select class="form-control" id="devisi">
                                    <option value="" selected disabled>Pilih</option>
                                    <?php
                                    foreach ($devisi as $d) : { ?>
                                            <option value="<?= $d['kodetxt'] ?>"><?= $d['PT'] ?></option>
                                    <?php }
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div> -->
                <!-- <div class="form-group row mb-1">
                            <label class="col-5 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Tgl&nbsp;Terima<span class="required">*</span>
                            </label>
                            <div class="col-md-7">
                                <input id="txt_tgl_terima" name="txt_tgl_terima" class="form-control" type="date" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div> -->
                <!-- <div class="form-group row">
                            <label class="col-5 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Lokasi&nbsp;Gudang<span class="required">*</span>
                            </label>
                            <div class="col-md-7">
                                <input id="txt_lokasi_gudang" name="txt_lokasi_gudang" class="form-control" required="required" type="text" placeholder="Lokasi Gudang" autocomplite="off">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group row mb-1">
                            <label class="col-5 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">No.&nbsp;Pengantar<span class="required">*</span>
                            </label>
                            <div class="col-md-7">
                                <input id="txt_no_pengantar" name="txt_no_pengantar" class="form-control" required="required" type="text" placeholder="No. Pengantar" autocomplite="off">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-5 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Ket</label>
                            <div class="col-md-7">
                                <textarea class="resizable_textarea form-control" id="txt_ket_pengiriman" name="txt_ket_pengiriman" placeholder="Keterangan" rows="1" autocomplite="off"></textarea>
                            </div>
                        </div>
                    </div>
                </div> -->
                <input type="hidden" id="txt_no_po" name="txt_no_po" class="form-control" type="text" onfocus="cariPo()" placeholder="No. PO" autocomplete="off">
                <input type="hidden" id="txt_ref_po" name="txt_ref_po" class="form-control bg-light" type="text" placeholder="No.Ref PO" autocomplete="off" readonly>
                <hr style="margin-top: -15px;">
                <div class="row mx-0 div_form_2" style="margin-top: -25px;">
                    <div class="sub-header" style="margin-top: -15px; margin-bottom: -25px;">
                        <!-- <h6 id="lbl_lpb_status" name="lbl_lpb_status">
                            <font face="Verdana" size="2.5">No. LPB : ... &nbsp; No. Ref LPB : ...</font>
                        </h6> -->
                        <input type="hidden" id="hidden_no_lpb">
                        <input type="hidden" id="hidden_no_ref_lpb">
                    </div>
                    <div class="row" style="margin-left:4px;">
                        <h6><span id="no_lpb"></span></h6>&emsp;&emsp;
                        <h6><span id="no_ref_lpb"></span></h6>
                        <label id="lbl_status_simpan" class="align-right"></label>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tableRinciLPB" width="100%">
                            <thead>
                                <tr>
                                    <!-- <th width="3%">#</th> -->
                                    <th width="21%" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Kode Barang</th>
                                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Nama Barang / Satuan / Grup</th>
                                    <th width="9%" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Saldo Qty</th>
                                    <th width="6%" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Qty</th>
                                    <th width="20%" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Ket</th>
                                    <th width="3%" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_rincian" name="tbody_rincian">
                                <!-- <tr id="tr_1">
                                    <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                        <input type="hidden" id="hidden_proses_status_1" name="hidden_proses_status_1" value="insert">
                                        <button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" id="btn_tambah_row" name="btn_tambah_row" onclick="tambah_row('1')"></button><br /> -->
                                <!-- <button class="btn btn-xs btn-danger fa fa-minus btn_hapus_row" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row_1" name="btn_hapus_row_1" onclick="hapus_row('1')"></button> -->
                                <!-- </td>
                                    <form id="form_rinci_1" name="form_rinci_1" method="POST" action="javascript:;">
                                        <td style="padding-right: 0.2em; padding-top: 2px; padding-bottom: 0.1em;">
                                            <div class="row">
                                                <input type="text" class="form-control col-8" id="txt_kode_barang_1" name="txt_kode_barang_1" placeholder="Kode Barang" onfocus="cari_barang('1')" readonly>
                                                <label class="ml-1 mt-1">
                                                    <input type="checkbox" id="chk_asset_1" name="chk_asset_1" value="">
                                                    <span class="text-muted" face="Verdana" size="1.8"> Asset ?</span>
                                                </label>
                                            </div>
                                        </td>
                                        <td style="padding-right: 0.2em; padding-top: 2px; padding-bottom: 0.1em;">
                                            <div class="row">
                                                <span face="Verdana" class="ml-2" id="txt_nama_brg_1" size="1.8">Nama Barang</span>
                                                &emsp;/
                                                <span face="Verdana" class="ml-2" id="txt_satuan_1" size="1.8">Satuan</span>
                                                &emsp;/
                                                <span face="Verdana" class="ml-2" id="hidden_grup_1" size="1.8">Grup</span>
                                            </div>
                                        </td>
                                        <td style="padding-right: 0.4em; padding-left: 0.4em; padding-top: 1px; padding-bottom: 0em;">
                                            <span class="small text-muted" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">qty&nbsp;po&emsp;:&nbsp;</span><span id="qty_po_1" class="small" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small"></span><br>
                                            <span class="small text-muted" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">sisa&nbsp;qty :&nbsp;</span><span id="sisa_qty_1" class="small" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small"></span>
                                        </td>
                                        <td style="padding-right: 0.2em; padding-left: 0.2em; padding-top: 2px; padding-bottom: 0.1em;">
                                            <input type="text" class="form-control currencyduadigit" id="txt_qty_1" name="txt_qty_1" placeholder="Qty" autocomplite="off">
                                        </td>
                                        <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                            <textarea class="resizable_textarea form-control" id="txt_ket_rinci_1" name="txt_ket_rinci_1" placeholder="Keterangan" rows="1"></textarea>
                                            <label id="lbl_status_simpan_1"></label>
                                        </td>
                                        <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                            <button class="btn btn-xs btn-success fa fa-save" id="btn_simpan_1" name="btn_simpan_1" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="saveRinciClick('1')"></button>
                                            <button style="display:none;" class="btn btn-xs btn-warning fa fa-edit" id="btn_ubah_1" name="btn_ubah_1" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" onclick="ubahRinci('1')"></button>
                                            <button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_1" name="btn_update_1" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="updateRinci('1')"></button>
                                            <button style="display:none;" class="btn btn-xs btn-primary fa fa-close" id="btn_cancel_update_1" name="btn_cancel_update_1" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update" onclick="cancelUpdate('1')"></button>
                                            <button style="display:none;" class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_1" name="btn_hapus_1" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci('1')"></button>
                                        </td>
                                    </form>
                                </tr> -->
                            </tbody>
                        </table>
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
                    <input id="multiple" type="text" class="col-4" onkeyup="cariPoqr()">
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
<input type="hidden" id="hidden_no_lpb_edit" value="<?= $no_lpb ?>">
<input type="hidden" id="hidden_nopo_edit" value="<?= $nopo ?>">

<script>
    $(document).ready(function() {
        var no_lpb_edit = $('#hidden_no_lpb_edit').val();
        var no_nopo_edit = $('#hidden_nopo_edit').val();
        cari_lpb_edit(no_lpb_edit, no_nopo_edit);
    });

    function cari_lpb_edit(no_lpb, nopo) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Lpb/cari_lpb_edit'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                'no_lpb': no_lpb,
                'nopo': nopo
            },
            success: function(data) {

                var data_lpb = data.data_lpb;
                var data_item_lpb = data.data_item_lpb;

                console.log(data_lpb);


                $('#multiple').val(data_lpb.nopo);
                $('#txt_no_po').val(data_lpb.nopo);
                $('#txt_ref_po').val(data_lpb.refpo);
                $('#txt_tgl_po').val();
                var namesup = data_lpb.kode_supply + ' / ' + data_lpb.nama_supply;
                $('#txt_kd_name_supplier').val(namesup);
                $('#txt_kd_supplier').val(data_lpb.kode_supply);
                $('#txt_supplier').val(data_lpb.nama_supply);
                $('#txt_lokasi_gudang').val(data_lpb.lokasi_gudang);
                $('#txt_no_pengantar').val(data_lpb.no_pengtr);
                $('#txt_ket_pengiriman').val(data_lpb.ket);
                $('#txt_tgl_po').val(data_lpb.tglpo);
                $('#no_lpb').text('No. LPB : ' + no_lpb);
                $('#no_ref_lpb').text('No. Ref LPB : ' + data_lpb.noref);


                // $("#modalListPo").modal('hide');

                for (i = 0; i < data_item_lpb.length; i++) {
                    // var no = i + 1;

                    tambah_row(i);
                    cari_qty_po(nopo, data_item_lpb[i].kodebar, i);
                    sumqty_edit(data_item_lpb[i].kodebar, nopo, i);

                    var kodebar = data_item_lpb[i].kodebar;
                    var nabar = data_item_lpb[i].nabar;
                    var qty = data_item_lpb[i].qty;
                    var sat = data_item_lpb[i].satuan;
                    var ket = data_item_lpb[i].ket;
                    var grp = data_item_lpb[i].grp;
                    var id_lpb = data_item_lpb[i].id;
                    // var sumsisa = $(this).data('sumsisa');

                    // Set data
                    if (data_item_lpb[i].ASSET == 1) {
                        $('#chk_asset_' + i).prop('checked', true);
                    } else {
                        $('#chk_asset_' + i).prop('checked', false);
                    }

                    $('#txt_kode_barang_' + i).val(kodebar);
                    $('#txt_nama_brg_' + i).text(nabar);
                    $('#txt_satuan_' + i).text(sat);
                    $('#txt_ket_rinci_' + i).text(ket);
                    $('#txt_qty_' + i).val(qty);
                    $('#hidden_txt_qty_' + i).val(qty);
                    $('#hidden_grup_' + i).text(grp);
                    $('#hidden_id_item_lpb_' + i).val(id_lpb);
                    // $('#sisa_qty_' + no).text(sumsisa);
                    // getGrupBarang(kodebar, i);

                    $('.div_form_2').find('#txt_kode_barang_' + i + ', #chk_asset_' + i + ', #txt_qty_' + i + ',#txt_ket_rinci_' + i).addClass('bg-light');
                    $('.div_form_2').find('#txt_kode_barang_' + i + ', #chk_asset_' + i + ', #txt_qty_' + i + ',#txt_ket_rinci_' + i).attr('disabled', '');
                }
            },
            error: function(response) {
                console.log(response.responseText);
            }
        });
    }

    function cari_qty_po(nopo, kodebar, i) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Lpb/cariQtyPo'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                'nopo': nopo,
                'kodebar': kodebar
            },
            success: function(data) {
                $('#qty_po_' + i).text(data.qty);
            }
        });
    }

    function sumqty_edit(kodebar, nopotxt, i) {
        var nopo = nopotxt;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Lpb/sum_qty_edit'); ?>",
            dataType: "JSON",

            data: {
                'kodebar': kodebar,
                'nopo': nopo
            },
            success: function(data) {
                $('#sisa_qty_' + i).text(data);
            }
        });
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
            }
        });
    }

    function sumqty(kodebar, nopotxt, qty, i) {
        var nopo = nopotxt;
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Lpb/sum_qty'); ?>",
            dataType: "JSON",

            data: {
                'kodebar': kodebar,
                'nopo': nopo,
                'qty': qty
            },
            success: function(data) {
                // console.log(data + 'sum');
                $('#sisa_qty_' + i).text(data);
            }
        });
    }

    var n = 0;

    function tambah_row(row) {
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
            '<input type="text" class="form-control col-8" id="txt_kode_barang_' + row + '" name="txt_kode_barang_' + row + '" placeholder="Kode Barang" onfocus="cari_barang(' + row + ')" readonly>' +
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
            '<span face="Verdana" class="ml-2" id="hidden_grup_' + row + '" size="1.8">Grup</span>' +
            '</div>' +
            '</td>';
        var td_col_4 = '<td style="padding-right: 0.4em; padding-left: 0.4em; padding-top: 1px; padding-bottom: 0em;">' +
            '<span class="small text-muted" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">qty&nbsp;po&emsp;:&nbsp;</span><span id="qty_po_' + row + '" class="small" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small"></span><br>' +
            '<span class="small text-muted" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">sisa&nbsp;qty :&nbsp;</span><span id="sisa_qty_' + row + '" class="small" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small"></span>' +
            '</td>';
        var td_col_5 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control currencyduadigit" id="txt_qty_' + row + '" name="txt_qty_' + row + '" placeholder="Qty" autocomplite="off" onkeyup="cek_qty(' + row + ')">' +
            '<input type="hidden" id="hidden_txt_qty_' + row + '">' +
            '</td>';
        var td_col_6 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea class="resizable_textarea form-control" id="txt_ket_rinci_' + row + '" name="txt_ket_rinci_' + row + '" placeholder="Keterangan" rows="1"></textarea>' +
            '<input type="hidden" id="hidden_id_item_lpb_' + row + '" name="hidden_id_item_lpb_' + row + '">' +
            '</td>';
        var td_col_7 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            // '<button class="btn btn-xs btn-success fa fa-save" id="btn_simpan_' + row + '" name="btn_simpan_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="saveRinciClick(' + row + ')"></button>' +
            '<button class="btn btn-xs btn-warning fa fa-edit" id="btn_ubah_' + row + '" name="btn_ubah_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" onclick="ubahRinci(' + row + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_' + row + '" name="btn_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="updateRinci(' + row + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-primary  mdi mdi-close-thick" id="btn_cancel_update_' + row + '" name="btn_cancel_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update" onclick="cancelUpdate(' + row + ')"></button>' +
            // '<button style="display:none;" class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_' + row + '" name="btn_hapus_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + row + ')"></button>' +
            '<label id="lbl_status_simpan_' + row + '"></label>' +
            '</td>';
        var form_tutup = '</form>';
        var tr_tutup = '</tr>';

        $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7 + form_tutup + tr_tutup);

        // $('#txt_qty_' + row).number(true, 2);

        // $('html, body').animate({
        //     scrollTop: $("#tr_" + row).offset().top
        // }, 2000);

        // row++;
        // $('#hidden_no_table').val(row);
    }

    function sisaQtyPO(no_ref_po, no_po, kodebar, n) {
        console.log('sisa qty no ' + n);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Lpb/sum_sisa_qty_po'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                'no_ref_po': no_ref_po,
                'no_po': no_po,
                'kodebar': kodebar
            },
            success: function(data) {
                $('#sisa_qty_' + n).text(data);
            }
        });
    }

    // //scan qr code
    // $(function() {

    //     // overriding path of JS script and audio 
    //     $.qrCodeReader.jsQRpath = "<?php echo base_url() ?>assets/dist/js/jsQR/jsQR.min.js";
    //     $.qrCodeReader.beepPath = "<?php echo base_url() ?>assets/dist/audio/beep.mp3";

    //     // bind all elements of a given class
    //     $(".qrcode-reader").qrCodeReader();

    //     // bind elements by ID with specific options
    //     $("#openreader-multi2").qrCodeReader({
    //         multiple: true,
    //         target: "#multiple2",
    //         skipDuplicates: false
    //     });
    //     $("#openreader-multi3").qrCodeReader({
    //         multiple: true,
    //         target: "#multiple3"
    //     });

    //     // read or follow qrcode depending on the content of the target input
    //     $("#openreader-single2").qrCodeReader({
    //         callback: function(code) {
    //             if (code) {
    //                 window.location.href = code;
    //             }
    //         }
    //     }).off("click.qrCodeReader").on("click", function() {
    //         var qrcode = $("#single2").val().trim();
    //         if (qrcode) {
    //             window.location.href = qrcode;
    //         } else {
    //             $.qrCodeReader.instance.open.call(this);
    //         }
    //     });
    // });

    // function cariPoqr() {

    //     var nopo = $('#multiple').val();
    //     // console.log(n + 'yeyelala');

    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo site_url('Lpb/get_data_po_qr'); ?>",
    //         dataType: "JSON",
    //         beforeSend: function() {
    //             $('#tbody_rincian').empty();
    //         },

    //         data: {
    //             'nopotxt': nopo
    //         },
    //         success: function(data) {

    //             var data_po = data.data_po;
    //             var data_item_po = data.data_item_po;

    //             console.log(data_po);

    //             $('#txt_no_po').val(data_po.nopotxt);
    //             $('#txt_ref_po').val(data_po.noreftxt);
    //             $('#txt_tgl_po').val(data_po.tglpo);
    //             var namesup = data_po.kode_supply + ' / ' + data_po.nama_supply;
    //             $('#txt_kd_name_supplier').val(namesup);
    //             $('#txt_kd_supplier').val(data_po.kode_supply);
    //             $('#txt_supplier').val(data_po.nama_supply);

    //             $("#modalListPo").modal('hide');

    //             for (i = 0; i < data_item_po.length; i++) {
    //                 // var no = i + 1;

    //                 tambah_row(i);
    //                 sumqty(data_item_po[i].kodebar, data_po.nopotxt, data_item_po[i].qty, i);

    //                 var kodebar = data_item_po[i].kodebar;
    //                 var nabar = data_item_po[i].nabar;
    //                 var qty = data_item_po[i].qty;
    //                 var sat = data_item_po[i].sat;
    //                 var ket = data_item_po[i].ket;
    //                 // var sumsisa = $(this).data('sumsisa');

    //                 // Set data
    //                 $('#txt_kode_barang_' + i).val(kodebar);
    //                 $('#txt_nama_brg_' + i).text(nabar);
    //                 $('#txt_satuan_' + i).text(sat);
    //                 $('#txt_ket_rinci_' + i).text(ket);
    //                 $('#qty_po_' + i).text(qty);
    //                 // $('#sisa_qty_' + no).text(sumsisa);
    //                 getGrupBarang(kodebar, i);
    //             }
    //         },
    //         error: function(response) {
    //             console.log(response.responseText);
    //         }
    //     });
    // }

    // $("#select2").select2({
    //     ajax: {
    //         url: "<?php echo site_url('Lpb/select2_get_po') ?>",
    //         dataType: 'json',
    //         delay: 250,
    //         data: function(params) {
    //             return {
    //                 nopo: params.term, // search term
    //             };
    //         },
    //         processResults: function(data) {
    //             var results = [];
    //             $.each(data, function(index, item) {
    //                 results.push({
    //                     id: item.nopo,
    //                     text: item.nopo
    //                 });
    //             });
    //             return {
    //                 results: results
    //             };
    //         }
    //     }
    // }).on('select2:select', function(evt) {
    //     // var selected = evt.params.data;
    //     // var a = "0475";
    //     // var b = "TOKO ( KAS )";
    //     // var kode = $(".select2 option:selected").text(a);
    //     // var data = $(".select2 option:selected").val(b);
    //     // $('#kd_supplier').val(kode);
    //     var data = $(".select2 option:selected").text();
    //     $('#txt_no_po').val(data);
    //     $('#multiple').val(data);
    //     // $('#hidden_no_ref_spp_').val(data);
    //     // console.log(data);
    //     cariPoqr();

    // });

    // $(document).ready(function() {
    //     $(document).on('click', '#openreader-multi', function() {

    //         $('#multiple').css('display', 'block');
    //         $('#select2').next(".select2-container").hide();

    //     });
    // });

    // function saveRinciClick(n) {

    //     var no_ref_po = $('#txt_ref_po').val();
    //     var no_po = $('#txt_no_po').val();
    //     var kodebar = $('#txt_kode_barang_' + n).val();

    //     if ($('#chk_asset_' + n).is(':checked')) {
    //         var chk_asset = 'yes';
    //     }

    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo base_url('Lpb/saveLpb') ?>",
    //         dataType: "JSON",

    //         beforeSend: function() {
    //             $('#btn_simpan_' + n).css('display', 'none');

    //             $('#lbl_status_simpan_' + n).empty();
    //             $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>');

    //             if ($.trim($('#hidden_no_lpb').val()) == '') {
    //                 $('#lbl_lpb_status').empty();
    //                 $('#lbl_lpb_status').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Generate PO Number</label>');
    //             }
    //         },

    //         data: {
    //             txt_no_po: $('#txt_no_po').val(),
    //             txt_ref_po: $('#txt_ref_po').val(),
    //             // hidden_no_ref_bkb: $('#hidden_no_ref_bkb').val(),
    //             txt_kode_barang: $('#txt_kode_barang_' + n).val(),
    //             txt_nama_brg: $('#txt_nama_brg_' + n).text(),
    //             txt_tgl_terima: $('#txt_tgl_terima').val(),
    //             hidden_no_lpb: $('#hidden_no_lpb').val(),
    //             hidden_no_ref_lpb: $('#hidden_no_ref_lpb').val(),
    //             chk_asset: chk_asset,
    //             txt_kd_supplier: $('#txt_kd_supplier').val(),
    //             txt_supplier: $('#txt_supplier').val(),
    //             txt_no_pengantar: $('#txt_no_pengantar').val(),
    //             txt_lokasi_gudang: $('#txt_lokasi_gudang').val(),
    //             txt_ket_pengiriman: $('#txt_ket_pengiriman').val(),
    //             txt_satuan: $('#txt_satuan_' + n).text(),
    //             hidden_grup: $('#hidden_grup_' + n).text(),
    //             txt_qty: $('#txt_qty_' + n).val(),
    //             txt_ket_rinci: $('#txt_ket_rinci_' + n).val()
    //         },

    //         success: function(data) {
    //             console.log(n);

    //             $('#lbl_status_simpan_' + n).empty();
    //             $('#lbl_lpb_status').empty();

    //             $.toast({
    //                 position: 'top-right',
    //                 heading: 'Success',
    //                 text: 'Berhasil Disimpan!',
    //                 icon: 'success',
    //                 loader: false
    //             });

    //             // hitung sisa qty po guys
    //             sisaQtyPO(no_ref_po, no_po, kodebar, n);

    //             $('#no_lpb').html('No. SPP : ' + data.nolpb);
    //             $('#no_ref_lpb').html('No. Ref. SPP : ' + data.noreflpb);

    //             $('.div_form_1').find('#select2, #openreader-multi, #multiple, #devisi, #txt_tgl_terima, #txt_no_pengantar, #txt_lokasi_gudang, #txt_no_po, #txt_ket_pengiriman').addClass('bg-light');
    //             $('.div_form_1').find('#select2, #openreader-multi, #multiple, #devisi, #txt_tgl_terima, #txt_no_pengantar, #txt_lokasi_gudang, #txt_no_po, #txt_ket_pengiriman').attr('disabled', '');

    //             $('.div_form_2').find('#txt_kode_barang_' + n + ', #chk_asset_' + n + ', #txt_qty_' + n + ',#txt_ket_rinci_' + n).addClass('bg-light');
    //             $('.div_form_2').find('#txt_kode_barang_' + n + ', #chk_asset_' + n + ', #txt_qty_' + n + ',#txt_ket_rinci_' + n).attr('disabled', '');
    //             // $('.headspp').find('#cancelSpp').removeAttr('disabled');

    //             $('#btn_hapus_row_' + n).css('display', 'none');
    //             $('#btn_ubah_' + n).css('display', 'block');
    //             $('#btn_hapus_' + n).css('display', 'block');

    //             $('#hidden_no_lpb').val(data.nolpb);
    //             $('#hidden_no_ref_lpb').val(data.noreflpb);
    //             $('#hidden_id_item_lpb_' + n).val(data.id_item_lpb);
    //             // $('#hidden_id_item_ppo_' + n).val(data.id_item_ppo);
    //         }
    //     });
    // }

    function ubahRinci(n) {

        // var n = $('#hidden_no_row').val();

        // $('.div_form_1').find('#devisi, #cmb_jenis_permohonan, #cmb_alokasi, #txt_tgl_terima, #cmb_departemen, #txt_keterangan').removeClass('bg-light');
        // $('.div_form_1').find('#devisi, #cmb_jenis_permohonan, #cmb_alokasi, #txt_tgl_terima, #cmb_departemen, #txt_keterangan').removeAttr('disabled');

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

        if (!qty) {
            toast('Qty');
        } else {
            updateRinciClick(n);
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

    //Update Data
    function updateRinciClick(n) {

        if ($('#chk_asset_' + n).is(':checked')) {
            var chk_asset = 'yes';
        }

        var no_ref_po = $('#txt_ref_po').val();
        var no_po = $('#txt_no_po').val();
        var kodebar = $('#txt_kode_barang_' + n).val();

        console.log(no_ref_po + ' ' + no_po + '' + kodebar);

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
                hidden_id_item_lpb: $('#hidden_id_item_lpb_' + n).val()
            },

            success: function(data) {
                console.log(data + "sukses update");

                $('#lbl_status_simpan_' + n).empty();

                sisaQtyPO(no_ref_po, no_po, kodebar, n);

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

                $('.div_form_1').find('#select2, #openreader-multi, #multiple, #devisi, #txt_tgl_terima, #txt_no_pengantar, #txt_lokasi_gudang, #txt_no_po, #txt_ket_pengiriman').addClass('bg-light');
                $('.div_form_1').find('#select2, #openreader-multi, #multiple, #devisi, #txt_tgl_terima, #txt_no_pengantar, #txt_lokasi_gudang, #txt_no_po, #txt_ket_pengiriman').attr('disabled', '');

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
            var qty_awal = $('#hidden_txt_qty_' + n).val();
            var hidden_qty = $('#sisa_qty_' + n).text();
            var a = Number(qty);
            var b = Number(hidden_qty);
            if (a > b) {
                swal("Qty melebihi sisa Qty LPB");
                $('#txt_qty_' + n).val(qty_awal);
            }
        });
    }
</script>