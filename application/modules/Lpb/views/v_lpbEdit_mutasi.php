<div class="container-fluid">
    <!-- start row-->
    <div class="row justify-content-center mt-0">
        <div class="col-12">
            <div class="widget-rounded-circle card-box">
                <div class="row justify-content-between">
                    <h4 class="header-title ml-2">LPB MUTASI<i>(Edit)</i></h4>
                    <div class="button-list mr-2">
                        <button class="btn btn-xs btn-success" id="new_lpb" onclick="new_lpb()">LPB Baru</button>
                        <button class="btn btn-xs btn-danger" id="cancelLpb" onclick="cancelLpb()">Batal LPB</button>
                        <button class="btn btn-primary btn-xs" id="a_print_lpb" onclick="cetak_lpb()">Cetak</button>
                        <button onclick="goBack()" class="btn btn-xs btn-secondary" id="kembali">Kembali</button>
                    </div>
                </div>
                <p class="sub-header" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">
                    Edit Laporan Penerimaan Barang
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

                <hr style="margin-top: -15px;">
                <div class="mx-0 div_form_2" style="margin-top: -25px;">
                    <div class="sub-header" style="margin-top: -15px; margin-bottom: -25px;">
                        <!-- <h6 id="lbl_lpb_status" name="lbl_lpb_status">
                            <font face="Verdana" size="2.5">No. LPB : ... &nbsp; No. Ref LPB : ...</font>
                        </h6> -->
                        <input type="hidden" id="hidden_no_lpb">
                        <input type="hidden" id="hidden_no_ref_lpb">
                        <input type="hidden" id="kode_dev">
                        <input type="hidden" id="txt_no_po" name="txt_no_po">
                        <input type="hidden" id="txt_ref_po" name="txt_ref_po">
                        <input type="hidden" id="hidden_id_lpb">
                    </div>
                    <div class="row mr-2 ml-0" style="margin-left:4px;">
                        <h6>
                            <span id="no_ref_po"></span>&emsp;&emsp;&emsp;&emsp;
                            <span id="no_lpb"></span>&emsp;&emsp;
                            <span id="no_ref_lpb"></span>
                        </h6>
                    </div>
                    <div class="table-responsive">
                        <table id="tableRinciLPB" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="21%">Kode Barang</th>
                                    <th width="24%" style="padding-left: 14px;">Nama Barang / Satuan / Grup</th>
                                    <th width="9%" style="padding-left: 14px;">Saldo Qty</th>
                                    <th width="9%">Qty</th>
                                    <th width="20%">Ket</th>
                                    <th width="6%">#</th>
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
<input type="hidden" id="id_stokmasuk" value="<?= $id_stokmasuk ?>">
<style>
    table#tableRinciLPB th {
        padding: 10px;
        font-size: 12px;
        padding-left: 17px;
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
        location.href = "<?php echo base_url('Lpb/input') ?>";
    }

    function cetak_lpb() {

        var no_lpb = $('#hidden_no_lpb').val();
        var id = $('#hidden_id_lpb').val();

        window.open("<?= base_url('Lpb/cetak/') ?>" + no_lpb + '/' + id, '_blank');

        // $('.div_form_2').css('pointer-events', 'none');
    }

    $(document).ready(function() {
        var id_stokmasuk = $('#id_stokmasuk').val();
        cari_lpb_edit(id_stokmasuk);
    });

    function cari_lpb_edit(id_stokmasuk) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Lpb/cari_lpb_edit'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                'id_stokmasuk': id_stokmasuk
            },
            success: function(data) {

                var data_lpb = data.data_lpb;
                var data_item_lpb = data.data_item_lpb;

                console.log(data_lpb);


                $('#multiple').val(data_lpb.nopo);
                $('#txt_no_po').val(data_lpb.nopo);
                $('#txt_ref_po').val(data_lpb.refpo);
                $('#no_ref_po').html('No. Ref. BKB : ' + data_lpb.refpo);
                var namesup = data_lpb.kode_supply + ' / ' + data_lpb.nama_supply;
                $('#txt_kd_name_supplier').val(namesup);
                $('#txt_kd_supplier').val(data_lpb.kode_supply);
                $('#txt_supplier').val(data_lpb.nama_supply);
                $('#txt_lokasi_gudang').val(data_lpb.lokasi_gudang);
                $('#txt_no_pengantar').val(data_lpb.no_pengtr);
                $('#txt_ket_pengiriman').val(data_lpb.ket);
                $('#txt_tgl_po').val(data_lpb.tglpo);
                $('#no_lpb').text('No. LPB : ' + data_lpb.ttgtxt);
                $('#no_ref_lpb').text('No. Ref LPB : ' + data_lpb.noref);
                $('#hidden_no_ref_lpb').val(data_lpb.noref);
                $('#hidden_no_lpb').val(data_lpb.ttgtxt);
                $('#hidden_id_lpb').val(data_lpb.id);

                $('#kode_dev').val(data_lpb.kode_dev);

                // $("#modalListPo").modal('hide');

                for (i = 0; i < data_item_lpb.length; i++) {
                    // var no = i + 1;

                    tambah_row(i);
                    // cari_qty_po(data_lpb.refpo, data_item_lpb[i].kodebar, i);
                    sumqty_edit(data_item_lpb[i].kodebar, data_lpb.refpo, i);

                    var kodebar = data_item_lpb[i].kodebar;
                    var nabar = data_item_lpb[i].nabar;
                    var qtypo = data_item_lpb[i].qtypo;
                    var qty = data_item_lpb[i].qty;
                    var sat = data_item_lpb[i].satuan;
                    var ket = data_item_lpb[i].ket;
                    var grp = data_item_lpb[i].grp;
                    var id_lpb = data_item_lpb[i].id;
                    var txtperiode = data_item_lpb[i].txtperiode;
                    var norefppo = data_item_lpb[i].norefppo;
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
                    $('#qty_po_' + i).text(qtypo);
                    $('#hidden_txt_qty_' + i).val(qty);
                    $('#hidden_grup_' + i).text(grp);
                    $('#hidden_id_item_lpb_' + i).val(id_lpb);
                    $('#hidden_txtperiode_' + i).val(txtperiode);
                    $('#hidden_refppo_' + i).val(norefppo);

                    // $('#sisa_qty_' + no).text(sumsisa);
                    // getGrupBarang(kodebar, i);

                    $('.div_form_2').find('#txt_kode_barang_' + i + ', #chk_asset_' + i + ', #txt_qty_' + i + ',#txt_ket_rinci_' + i).addClass('bg-light');
                    $('.div_form_2').find('#txt_kode_barang_' + i + ', #chk_asset_' + i + ', #txt_qty_' + i + ',#txt_ket_rinci_' + i).attr('disabled', '');
                }
            },
            error: function(response) {
                alert('KONEKSI TERPUTUS! Silahkan Refresh Halaman!');
            }
        });
    }

    // function cari_qty_po(refpo, kodebar, i) {
    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo site_url('Lpb/cariQtyPo'); ?>",
    //         dataType: "JSON",
    //         beforeSend: function() {},

    //         data: {
    //             'refpo': refpo,
    //             'kodebar': kodebar
    //         },
    //         success: function(data) {
    //             $('#qty_po_' + i).text(data.qty);
    //         }
    //     });
    // }

    function sumqty_edit(kodebar, refpo, i) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Lpb/sum_qty_edit_mutasi'); ?>",
            dataType: "JSON",

            data: {
                'kodebar': kodebar,
                'refpo': refpo
            },
            success: function(data) {
                $('#sisa_qty_' + i).text(data);
            },
            error: function(response) {
                alert('KONEKSI TERPUTUS! Silahkan Refresh Halaman!');
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
            },
            error: function(response) {
                alert('KONEKSI TERPUTUS! Silahkan Refresh Halaman!');
            }
        });
    }

    // function sumqty(kodebar, nopotxt, qty, i) {
    //     var nopo = nopotxt;
    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo site_url('Lpb/sum_qty'); ?>",
    //         dataType: "JSON",

    //         data: {
    //             'kodebar': kodebar,
    //             'nopo': nopo,
    //             'qty': qty
    //         },
    //         success: function(data) {
    //             // console.log(data + 'sum');
    //             $('#sisa_qty_' + i).text(data);
    //         }
    //     });
    // }

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
            '<input type="text" class="form-control form-control-sm col-8" id="txt_kode_barang_' + row + '" name="txt_kode_barang_' + row + '" placeholder="Kode Barang" style="font-size: 12px;" readonly>' +
            '<label class="ml-1 mt-1">' +
            '<input type="checkbox" id="chk_asset_' + row + '" name="chk_asset_' + row + '" value="">' +
            '<span style="font-size: 12px;" class="text-muted"> Asset ?</span>' +
            '</label>' +
            '</div>' +
            '</td>';
        var td_col_3 = '<td style="padding-right: 0.2em; padding-top: 2px; padding-bottom: 0.1em;">' +
            '<div class="row">' +
            '<span style="font-size: 12px;" class="ml-2" id="txt_nama_brg_' + row + '">Nama Barang</span>&emsp;/' +
            '<span style="font-size: 12px;" class="ml-2" id="txt_satuan_' + row + '">Satuan</span>&emsp;/' +
            '<span style="font-size: 12px;" class="ml-2" id="hidden_grup_' + row + '">Grup</span>' +
            '</div>' +
            '</td>';
        var td_col_4 = '<td style="padding-right: 0.4em; padding-top: 1px; padding-bottom: 0em;">' +
            '<span class="small text-muted" style="font-size: 12px;">Qty&nbsp;PO&nbsp;:&nbsp;</span><span id="qty_po_' + row + '" class="small" style="font-size: 12px;"></span><br>' +
            '<span class="small text-muted" style="font-size: 12px;">Sisa&nbsp;Qty&nbsp;:&nbsp;</span><span id="sisa_qty_' + row + '" class="small" style="font-size: 12px;"></span>' +
            '</td>';
        var td_col_5 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm currencyduadigit" id="txt_qty_' + row + '" name="txt_qty_' + row + '" placeholder="Qty" autocomplite="off" onkeyup="cek_qty(' + row + ')" style="font-size: 12px;">' +
            '<input type="hidden" id="hidden_txt_qty_' + row + '">' +
            '</td>';
        var td_col_6 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea class="resizable_textarea form-control form-control-sm" id="txt_ket_rinci_' + row + '" name="txt_ket_rinci_' + row + '" placeholder="Keterangan" rows="2" style="font-size: 12px;"></textarea>' +
            '<input type="hidden" id="hidden_id_item_lpb_' + row + '" name="hidden_id_item_lpb_' + row + '">' +
            '<input type="hidden" id="hidden_txtperiode_' + row + '" name="hidden_txtperiode_' + row + '">' +
            '<input type="hidden" id="hidden_refppo_' + row + '" name="hidden_refppo_' + row + '">' +
            '</td>';
        var td_col_7 = '<td style="padding-top: 2px;">' +
            // '<button class="btn btn-xs btn-success fa fa-save" id="btn_simpan_' + row + '" name="btn_simpan_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="saveRinciClick(' + row + ')"></button>' +
            '<div class="row">' +
            '<button class="btn btn-xs btn-warning fa fa-edit ml-1" id="btn_ubah_' + row + '" name="btn_ubah_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" onclick="ubahRinci(' + row + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-info fa fa-check ml-1" id="btn_update_' + row + '" name="btn_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="updateRinci(' + row + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-primary ml-1 mdi mdi-close-thick" id="btn_cancel_update_' + row + '" name="btn_cancel_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update" onclick="cancelUpdate(' + row + ')"></button>' +
            '<button class="btn btn-xs btn-danger fa fa-trash ml-1" id="btn_hapus_' + row + '" name="btn_hapus_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + row + ')"></button>' +
            '<label id="lbl_status_simpan_' + row + '"></label>' +
            '</div>' +
            '</td>';
        var form_tutup = '</form>';
        var tr_tutup = '</tr>';

        $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7 + form_tutup + tr_tutup);

        // $('#txt_qty_' + row).number(true, 0);
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

        if (!qty || qty == 0) {
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
        var hidden_refppo = $('#hidden_refppo_' + n).val();

        // console.log(no_ref_po + ' ' + no_po + '' + kodebar);

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
                kode_dev: $('#kode_dev').val(),
                nopo: no_po,
                norefpo: no_ref_po,
                kodebar: kodebar,
                refppo: hidden_refppo,
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

                $('.div_form_1').find('#select2, #openreader-multi, #multiple, #devisi, #txt_tgl_terima, #txt_no_pengantar, #txt_lokasi_gudang, #txt_no_po, #txt_ket_pengiriman').addClass('bg-light');
                $('.div_form_1').find('#select2, #openreader-multi, #multiple, #devisi, #txt_tgl_terima, #txt_no_pengantar, #txt_lokasi_gudang, #txt_no_po, #txt_ket_pengiriman').attr('disabled', '');

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
        var hidden_refppo = $('#hidden_refppo_' + n).val();

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
                txt_qty: 0,
                txt_ket_rinci: $('#txt_ket_rinci_' + n).val(),
                hidden_no_lpb: $('#hidden_no_lpb').val(),
                hidden_no_ref_lpb: $('#hidden_no_ref_lpb').val(),
                hidden_id_item_lpb: $('#hidden_id_item_lpb_' + n).val(),
                hidden_txtperiode: $('#hidden_txtperiode_' + n).val(),
                kode_dev: $('#kode_dev').val(),
                nopo: no_po,
                norefpo: no_ref_po,
                kodebar: kodebar,
                refppo: hidden_refppo,
                mutasi: '1'
            },

            success: function(data) {

                sisaQtyPO(no_ref_po, kodebar, n);
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

                $('#tr_' + n).remove();
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

                location.href = "<?php echo base_url('Lpb') ?>";
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
                    window.location.href = "<?php echo site_url('Lpb'); ?>";
                }, 1000);
            },
            error: function(response) {
                $('#lbl_bkb_status').empty();
                alert('KONEKSI TERPUTUS! Gagal Hapus LPB!');
            }
        });
    }
</script>