<div class="container-fluid">

    <div class="row mt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between" style="margin-top: -10px;">
                        <h4 class="header-title ml-2">BKB</h4>
                        <div class="button-list mr-2">
                            <button class="qrcode-reader mdi mdi-camera btn btn-xs btn-primary ml-1" id="camera" type="button" onclick="showCamera()"></button>
                            <button class="btn btn-xs btn-info" id="data_bkb" onclick="data_bkb()">Data BKB</button>
                            <button class="btn btn-xs btn-success" id="new_bkb" onclick="new_bkb()" disabled>BKB Baru</button>
                            <button class="btn btn-xs btn-danger" id="cancelBkb" onclick="cancelBkb()" disabled>Batal BKB</button>
                            <button class="btn btn-xs btn-primary" id="a_print_bkb" onclick="cetak_bkb()" disabled>Cetak</button>
                            <button onclick="goBack()" class="btn btn-xs btn-secondary" id="kembali">Kembali</button>
                        </div>
                    </div>
                    <p class="sub-header">
                        Bukti Keluar Barang
                    </p>
                    <div class="row div_form_1" style="margin-top: -10px;">
                        <div class="col-lg-2 col-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="example-select" style="font-size: 12px;">Tgl BKB*</label>
                                    <input id="tgl_bkb_txt" name="tgl_bkb_txt" type="date" value="<?= date('Y-m-d') ?>" autocomplite="off" class="form-control form-control-sm" required="required" style="font-size: 12px; margin-top: -5px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="form-group">
                                <label for="example-select" style="font-size: 12px;">No BPB*</label>
                                <!-- <select class="js-data-example-ajax form-control select2 col-9 ml-2" id="select2">
                                    </select> -->
                                <input id="cari_bpb" name="cari_bpb" class="form-control form-control-sm" type="text" onfocus="cari_bpb()" placeholder="pilih no BPB" style="font-size: 12px; margin-top: -5px;">
                                <input style="display:none;" id="multiple" class="form-control bg-light form-control-sm" type="text" readonly>
                                <input type="hidden" id="txt_no_bpb">
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="form-group">
                                <label for="example-select" style="font-size: 12px;">Bagian*</label>
                                <input id="bagian" name="bagian" class="form-control bg-light form-control-sm" required="required" type="text" disabled style="font-size: 12px; margin-top: -5px;">
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="form-group">
                                <label for="example-select" style="font-size: 12px;">Divisi*</label>
                                <input id="devisi_text" name="devisi_text" class="form-control bg-light form-control-sm" required="required" type="text" readonly style="font-size: 12px; margin-top: -5px;">
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="form-group">
                                <label for="example-select" style="font-size: 12px;">Diberikan Kepada*</label>
                                <input id="diberikan_kpd" name="diberikan_kpd" class="form-control form-control-sm" required="required" type="text" style="font-size: 12px; margin-top: -5px;">
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="form-group">
                                <label for="example-select" style="font-size: 12px;">Untuk Keperluan</label>
                                <textarea class="form-control form-control-sm" rows="1" id="utk_keperluan" style="font-size: 12px; margin-top: -5px;"></textarea>
                            </div>
                        </div>
                    </div>

                    <fieldset style="display: none; height:65px" class="border mb-2 pl-1 pr-1" id="fieldset_bbm">
                        <div class="row div_form_bbm mt-0">
                            <div class="col-lg-2 col-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="example-select" style="font-size: 12px;">Bahan Bakar</label>
                                        <input id="bhnbakar" name="bhnbakar" type="text" class="form-control form-control-sm bg-light" placeholder="" disabled style="font-size: 12px; margin-top: -5px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-12">
                                <div class="form-group">
                                    <label for="example-select" style="font-size: 12px;">Jenis Alat/Kend</label>
                                    <input id="txt_jns_alat" name="txt_jns_alat" type="text" class="form-control form-control-sm bg-light" value="" placeholder="" autocomplite="off" disabled style="font-size: 12px; margin-top: -5px;">
                                </div>
                            </div>
                            <div class="col-lg-3 col-12">
                                <div class="form-group">
                                    <label for="example-select" style="font-size: 12px;">kode/Nomer</label>
                                    <input id="txt_kd_nmr" name="txt_kd_nmr" type="text" class="form-control form-control-sm bg-light" value="" placeholder="" autocomplite="off" disabled style="font-size: 12px; margin-top: -5px;">
                                </div>
                            </div>
                            <div class="col-lg-2 col-12">
                                <div class="form-group">
                                    <label for="example-select" style="font-size: 12px;">HM/KM</label>
                                    <input id="txt_hm_km" name="txt_hm_km" type="text" class="form-control form-control-sm bg-light" value="" placeholder="" autocomplite="off" disabled style="font-size: 12px; margin-top: -5px;">
                                </div>
                            </div>
                            <div class="col-lg-2 col-12">
                                <div class="form-group">
                                    <label for="example-select" style="font-size: 12px;">Lokasi Kerja</label>
                                    <input id="txt_lokasi_kerja" name="txt_lokasi_kerja" type="text" class="form-control form-control-sm bg-light" value="" placeholder="" autocomplite="off" disabled style="font-size: 12px; margin-top: -5px;">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="x_content div_form_2 mb-0">
                        <fieldset class="border mb-1 p-1">
                            <div class="row">
                                <div class="custom-control custom-checkbox ml-3 mt-0 col-3 col-lg-1 col-xl-1">
                                    <input type="checkbox" name="cexbox_mutasi" class="custom-control-input" id="cexbox_mutasi" onclick="cekbox_mutasi()" disabled>
                                    <label class="custom-control-label" for="cexbox_mutasi" style="font-size: 12px;">Mutasi?</label>
                                    <input type="hidden" id="hidden_cekbox_mutasi" value="">
                                </div>
                                <div class="custom-control custom-checkbox mt-0 col-6 col-lg-1 col-xl-1">
                                    <input type="checkbox" name="cexbox_mutasi_local" class="custom-control-input" id="cexbox_mutasi_local" onclick="cekbox_mutasi()" disabled>
                                    <label class="custom-control-label" for="cexbox_mutasi_local" style="font-size: 12px;">Mutasi&nbsp;Lokal?</label>
                                    <input type="hidden" id="hidden_cekbox_mutasi" value="">
                                </div>
                                <div class="col-6 col-lg-4 col-xl-4">
                                    <select class="form-control form-control-sm" id="pt_mutasi" onchange="pt_mutasi()" disabled style="font-size: 12px;">
                                    </select>
                                </div>
                                <div class="col-6 col-lg-4 col-xl-4">
                                    <select class="form-control form-control-sm" id="devisi_mutasi" disabled style="font-size: 12px;">
                                    </select>
                                </div>
                                <!-- <h4 class="header-title mr-2" style="font-family: Verdana, Geneva, Tahoma, sans-serif;"><span id="devisi_span"></span></h4> -->
                            </div>
                        </fieldset>
                        <hr class="mt-0 mb-0">
                        <div class="row justify-content-between">
                            <div class="row ml-2">
                                <h6><span id="txt_norefbpb"></span></h6>
                                <h6 id="lbl_bkb_status" name="lbl_bkb_status">No. BKB : ... &nbsp; No. Ref. BKB : ...</h6>
                                <input type="hidden" id="hidden_id_bkb">
                                <input type="hidden" id="hidden_id_ppo">
                                <input type="hidden" id="hidden_no_bkb">
                                <input type="hidden" id="hidden_no_ref_bkb">
                                <input type="hidden" id="hidden_kode_dev">
                                <input type="hidden" id="hidden_devisi">
                                <input type="hidden" id="alokasi_est">
                                <input type="hidden" id="hidden_norefbpb">
                                <input type="hidden" id="hidden_id_mutasi">
                                <input type="hidden" id="kalo_dia_qrcode">
                                <input type="hidden" id="hidden_noref_bpb" value="<?= $noref_bpb ?>">
                                <input type="hidden" id="hidden_kode_pt_login" value="<?= $this->session->userdata('kode_pt_login'); ?>">
                                <div class="row" style="margin-left:4px;">
                                    <h6><span id="h4_no_bkb"></span></h6>&emsp;&emsp;
                                    <h6><span id="h4_no_ref_bkb"></span></h6>
                                </div>
                            </div>
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
                                        <th width="13%">Keterangan</th>
                                        <th width="8%">#</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalRevQty">
    <div class="modal-dialog modal-sm modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Request revisi QTY ke KTU?</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body mt-0">
                <input type="hidden" id="no_table">
                <label for="">Masukan QTY</label>
                <input type="number" class="form-control" id="req_rev_qty" name="req_rev_qty" onkeyup="validasi_qty()">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" onclick="revQty()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalListBpb">
    <div class="modal-dialog modal-full-width modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">List Data BPB</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="margin-top: -20px;">
                <div class="table-responsive">
                    <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                    <table id="databpb" class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="hastag_th">#</th>
                                <th class="no_th">No</th>
                                <th class="tgl_th">Tgl Input</th>
                                <th class="noref_th">No. Ref. Bpb</th>
                                <th class="div_th">Divisi</th>
                                <th class="dept_th">Departemen</th>
                                <th class="kep_th">Keperluan</th>
                                <th class="oleh_th">Diminta Oleh</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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

<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0;
        /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance: textfield;
        /* Firefox */
    }

    .hastag_th {
        width: 5% !important;
    }

    .no_th {
        width: 3% !important;
    }

    .tgl_th {
        width: 8% !important;
    }

    .noref_th {
        width: 18% !important;
    }

    .div_th {
        width: 23% !important;
    }

    .dept_th {
        width: 13% !important;
    }

    .kep_th {
        width: 20% !important;
    }

    .oleh_th {
        width: 10% !important;
    }

    #multiple {
        font-size: 12px;
        margin-top: -5px;
    }

    table#databpb td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#databpb th {
        padding: 10px;
        font-size: 12px;
    }

    table#tableRinciBKB th {
        padding: 10px;
        font-size: 12px;
        padding-left: 17px;
    }

    .tooltip-inner {
        white-space: pre-wrap;
        color: black;
        font-weight: bold;
        background-color: #ADD8E6;
        font-size: 11px;
    }
</style>
<script>
    function data_bkb() {
        location.href = "<?php echo base_url('Bkb') ?>";
    }

    $(function() {
        $('#devisi_text').tooltip({
            title: tittle,
            html: true
        });
    });

    function tittle() {
        var devisi_text = $('#devisi_text').val();

        return devisi_text;
    }

    $(function() {
        $('#cari_bpb').tooltip({
            title: tittle2,
            html: true
        });
    });

    function tittle2() {
        var cari_bpb = $('#cari_bpb').val();

        return cari_bpb;
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
    // qrcode
    function modalCameraClose() {
        if (!$('#hidden_noref_bpb').val()) {
            scanner.stop();
            $('#multiple').css('display', 'none');
            // $('#select2_mutasi').next(".select2-container").show();
        } else {
            scanner.stop();
            $('#multiple').css('display', 'block');
            // $('#select2_mutasi').next(".select2-container").hide();
        }
    }

    $(document).ready(function() {
        // $('#a_print_lpb').hide();
        if (!$('#hidden_noref_bpb').val()) {
            $('#showCamera').modal('show');
            // $('#select2_mutasi').next(".select2-container").show();
            $('#preview').show();
            $('#multiple').css('display', 'none');
        } else {
            // $('#select2_mutasi').next(".select2-container").hide();
            $('#multiple').css('display', 'block');
            $('#camera').css('display', 'none');
            var hidden_noref_bpb = $('#hidden_noref_bpb').val();
            $('#multiple').val(hidden_noref_bpb);
            $('#txt_no_bpb').val(hidden_noref_bpb);
            $('#cari_bpb').val(hidden_noref_bpb);
            cariBpbqr(hidden_noref_bpb);
            $('#showCamera').modal('hide');
            $('#txt_norefbpb').html('No. Ref. BPB : ' + hidden_noref_bpb + '&emsp;&emsp;&emsp;&emsp;');
        }
    });
    $(document).ready(function() {
        // $('#showCamera').modal('show');
        $('#preview').show();
        $('#multiple').css('display', 'block');
        $('#cari_bpb').css('display', 'none');
        // $('#select2').next(".select2-container").hide();
        $('.div_form_2').hide();
        tittle();
        tittle2();
        cari_pt_mutasi('0');

        setInterval(function() {
            if (!$('#kalo_dia_qrcode').val()) {
                check_form_2();
            }
        }, 1000);
    });

    function check_form_2() {
        if (!$('#kalo_dia_qrcode').val()) {
            if ($.trim($('#diberikan_kpd').val()) != '' && $.trim($('#utk_keperluan').val()) != '') {
                $('.div_form_2').show();
            } else {
                $('.div_form_2').hide();
            }
        } else {
            $('.div_form_2').show();
        }
    }

    function modalCameraClose() {
        scanner.stop();
        $('#multiple').css('display', 'none');
        $('#cari_bpb').css('display', 'block');
        // $('#select2').next(".select2-container").show();
    }

    function showCamera() {
        $('#showCamera').modal('show');
        $('#preview').show();
        $('#multiple').css('display', 'block');
        $('#cari_bpb').css('display', 'none');
        // $('#select2').next(".select2-container").hide();
        scanner.start();
    }

    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });
    scanner.addListener('scan', function(content) {
        console.log(content);
        $('#preview').hide();
        cariBpbqr(content);
        $('#txt_no_bpb').val(content);
        $('#showCamera').modal('hide');
        $('#multiple').val(content);
        $('#kalo_dia_qrcode').val(content);
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

    function cari_bpb() {
        $("#modalListBpb").modal('show');
    }

    // Start Data Table Server Side
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#databpb').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Bkb/get_data_bpb') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],

        });

    });
    // End Data Table Server Side

    $(document).ready(function() {
        $(document).on('click', '#data_bpb', function() {

            var norefbpb = $(this).data('norefbpb');

            // Set data
            $('#cari_bpb').val(norefbpb);
            $('#txt_no_bpb').val(norefbpb);
            $('#txt_norefbpb').html('No. Ref. BPB : ' + norefbpb + '&emsp;&emsp;&emsp;&emsp;');

            $("#modalListBpb").modal('hide');
            cariBpbqr(norefbpb);
        });
    });

    // $("#select2").select2({
    //     ajax: {
    //         url: "<?php echo site_url('Bkb/select2_get_bpb') ?>",
    //         dataType: 'json',
    //         delay: 250,
    //         data: function(params) {
    //             return {
    //                 noref: params.term, // search term
    //             };
    //         },
    //         processResults: function(data) {
    //             var results = [];
    //             $.each(data, function(index, item) {
    //                 results.push({
    //                     id: item.norefbpb,
    //                     text: item.norefbpb
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
    //     $('#txt_no_bpb').val(data);
    //     // $('#multiple').val(data);
    //     // $('#hidden_no_ref_spp_').val(data);
    //     // console.log(data);
    //     cariBpbqr(data);
    // });

    function cariBpbqr(noref) {

        // var nopo = $('#multiple').val();
        // console.log(n + 'yeyelala');

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bkb/get_data_bpb_qr'); ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#tbody_rincian').empty();
            },

            data: {
                'noref': noref
            },
            success: function(data) {

                var data_bpb = data.data_bpb;
                var data_item_bpb = data.data_item_bpb;

                console.log(data);

                if (!data_bpb || !data_item_bpb) {
                    swal('data tidak ditemukan!');
                } else {
                    $('#bagian').val(data_bpb.bag);
                    $('#alokasi_est').val(data_bpb.alokasi);
                    $('#utk_keperluan').val(data_bpb.keperluan);

                    //jika dia dari bpp mutasi maka devisi diambil dari session user login
                    if (!$('#hidden_noref_bpb').val()) {
                        $('#hidden_kode_dev').val(data_bpb.kode_dev);
                        $('#hidden_devisi').val(data_bpb.devisi);
                        $('#devisi_text').val(data_bpb.devisi);
                    } else {
                        $('#hidden_kode_dev').val(data.kode_dev);
                        $('#hidden_devisi').val(data.devisi);
                        $('#devisi_text').val(data.devisi);
                    }

                    $('#hidden_norefbpb').val(data_bpb.norefbpb);

                    if (data_bpb.bag == 'TEKNIK' && data_bpb.bhn_bakar == 'BBM') {
                        $('#fieldset_bbm').css('display', 'block');
                        $('#bhnbakar').val(data_bpb.bhn_bakar);
                        $('#txt_jns_alat').val(data_bpb.jn_alat);
                        $('#txt_kd_nmr').val(data_bpb.no_kode);
                        $('#txt_hm_km').val(data_bpb.hm_km);
                        $('#txt_lokasi_kerja').val(data_bpb.lok_kerja);
                    } else {
                        $('#fieldset_bbm').css('display', 'none');
                    }

                    for (i = 0; i < data_item_bpb.length; i++) {

                        tambah_row(i, data_item_bpb[i].status_item_bkb, data_item_bpb[i].approval_item, data_item_bpb[i].req_rev_qty_item);
                        // tahun_tanam(i, data_item_bpb[i].kodebebantxt);

                        //sum stok all periode / qtymasuk - qtykeluar. jika dia mutasi devisi diambil dari session
                        if (!$('#hidden_noref_bpb').val()) {
                            get_stok(i, data_item_bpb[i].kodebar, data_item_bpb[i].periode, data_bpb.kode_dev);
                        } else {
                            get_stok(i, data_item_bpb[i].kodebar, data_item_bpb[i].periode, data.kode_dev);
                        }

                        var tmtbm = data_item_bpb[i].tmtbm;
                        var afd = data_item_bpb[i].afd;
                        var blok = data_item_bpb[i].blok;
                        var thntanam = data_item_bpb[i].thntanam;
                        var kodebebantxt = data_item_bpb[i].kodebebantxt;
                        var kodesubtxt = data_item_bpb[i].kodesubtxt;
                        var ketbeban = data_item_bpb[i].ketbeban;
                        var nabar = data_item_bpb[i].nabar;
                        var kodebar = data_item_bpb[i].kodebar;
                        var grp = data_item_bpb[i].grp;
                        var satuan = data_item_bpb[i].satuan;
                        var qty = data_item_bpb[i].qty;
                        var qty_disetujui = data_item_bpb[i].qty_disetujui;
                        var ketsub = data_item_bpb[i].ketsub;
                        var ket = data_item_bpb[i].ket;

                        // Set data
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
                        //jika revisi qty maka tampilkan qty disetujui, jika tidak tampilkan qty
                        if (data_item_bpb[i].req_rev_qty_item == '2') {
                            $('#txt_qty_disetujui_' + i).val(qty_disetujui);
                        } else {
                            $('#txt_qty_disetujui_' + i).val(qty);
                        }
                        $('#txt_ket_rinci_' + i).val(ket);

                        //merubah beban kepada PT yang meminta BPB\
                        if (!$('#hidden_noref_bpb').val()) {
                            console.log('ini bukan mutasi PT');
                        } else {
                            // jika dia mutasi rev qty belum fungsi
                            $('#rev_qty_' + i).css('display', 'none');
                            $('#txt_qty_disetujui_' + i).removeClass('bg-light');
                            $('#txt_qty_disetujui_' + i).removeAttr('disabled', '');

                            if (data_bpb.status_mutasi == 1) {
                                ubah_beban_bkb_mutasi(i, data_bpb.kode_pt_req_mutasi);
                            }
                        }
                    }
                    $('.div_form_2').show();

                    //cek mutasi
                    if (!$('#hidden_noref_bpb').val()) {
                        console.log('ini bukan mutasi');
                    } else {
                        cek_mutasi(ketsub, data_bpb.kode_dev, data_bpb.status_mutasi, data_bpb.kode_pt_req_mutasi);
                    }
                }

            },
            error: function(response) {
                alert('ERROR! ' + response.responseText);
            }
        });
    }

    function cek_mutasi(ketsub, kode_dev, status_mutasi, kode_pt) {

        $('#cexbox_mutasi').removeAttr('checked', '');
        $('#cexbox_mutasi_local').removeAttr('checked', '');
        $('#cexbox_mutasi').attr('disabled', '');
        $('#cexbox_mutasi_local').attr('disabled', '');
        $('#devisi_mutasi').val('');
        $('#pt_mutasi').val('');

        var kode_pt_login = $('#hidden_kode_pt_login').val();

        // 1 mutasi PT, 2 mutasi local
        if (status_mutasi == 1) {

            $('#cexbox_mutasi').attr('checked', '');
            $('#cexbox_mutasi').attr('disabled', '');
            cari_pt_mutasi(kode_pt, kode_dev);

        } else if (status_mutasi == 2) {
            $('#cexbox_mutasi_local').attr('checked', '');
            $('#cexbox_mutasi_local').attr('disabled', '');

            // var str = ketsub.substring(23);
            cari_pt_mutasi(kode_pt_login, kode_dev);
        }
    }

    function ubah_beban_bkb_mutasi(i, kode_pt) {

        // kode PT 01 == MSAL, 02 == PSAM
        if (kode_pt == '01') {
            var nama_noac = 'MSAL, PT';
        } else if (kode_pt == '02') {
            var nama_noac = 'PSAM, PT';
        } else if (kode_pt == '03') {
            var nama_noac = 'PEAK, PT';
        } else if (kode_pt == '04') {
            var nama_noac = 'MAPA, PT';
        } else if (kode_pt == '05') {
            var nama_noac = 'KPP, PT';
        } else {
            swal('coa mutasi tidak ditemukan!');
            $('.div_form_2').css('pointer-events', 'none');
        }

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bkb/get_noac_gl'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                'nama_noac': nama_noac
            },
            success: function(data) {

                $('#txt_account_beban_' + i).val('');
                $('#hidden_no_acc_' + i).val('');

                $('#txt_account_beban_' + i).val(data.nama);
                $('#hidden_no_acc_' + i).val(data.noac);

            },
            error: function(response) {
                alert('ERROR! ' + response.responseText);
            }
        });

    }

    function tambah_row(row, status_item_bkb, approval_item, req_rev_qty_item) {
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
            '<span class="small text-muted" style="font-size:12px;">Sat&nbsp;:&nbsp;</span><span id="sat_bpb_' + row + '" class="small" style="font-size:12px;"></span><br>' +
            '<span class="small text-muted" style="font-size:12px;">Stok&nbsp;:&nbsp;</span><span id="stok_' + row + '" class="small" style="font-size:12px;"></span>' +
            '</td>';
        var td_col_10 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<!-- Qty Diminta & Stok di Tgl ini & Satuan -->' +
            '<input type="number" class="form-control form-control-sm bg-light" style="font-size:12px;" id="txt_qty_diminta_' + row + '" name="txt_qty_diminta_' + row + '" placeholder="Qty Diminta" disabled>' +
            '</td>';
        var td_col_11 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<!-- Qty Diminta & Stok di Tgl ini & Satuan -->' +
            '<input type="number" class="form-control form-control-sm bg-light" style="font-size:12px;" id="txt_qty_disetujui_' + row + '" name="txt_qty_disetujui_' + row + '" placeholder="Qty Diminta" disabled onkeyup="validasi_qty_disetujui(' + row + ')">' +
            '</td>';
        var td_col_12 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<!-- Keterangan -->' +
            '<textarea class="resizable_textarea form-control form-control-sm bg-light" style="font-size:12px;" id="txt_ket_rinci_' + row + '" name="txt_ket_rinci_' + row + '" rows="2" placeholder="Keterangan" disabled></textarea>' +
            '<input type="hidden" id="id_keluarbrgitem_' + row + '" name="id_keluarbrgitem_' + row + '">' +
            '<input type="hidden" id="hidden_id_mutasi_item_' + row + '" name="hidden_id_mutasi_item_' + row + '">' +
            '<input type="hidden" id="hidden_id_register_stok_' + row + '" name="hidden_id_register_stok_' + row + '">' +
            '</td>';
        var td_col_13 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<button class="btn btn-xs btn-success fa fa-save" id="btn_simpan_' + row + '" name="btn_simpan_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="saveRinciClick(' + row + ')"></button>' +
            '<button class="badge bagde-warning btn-warning" style="margin-left: 3px;" id="rev_qty_' + row + '" name="rev_qty_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Req Rev Qty" onclick="btnRevQty(' + row + ')"><b>Rev</b></button>' +
            '<button style="display:none;" class="btn btn-xs btn-warning fa fa-edit" id="btn_ubah_' + row + '" name="btn_ubah_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" onclick="ubahRinci(' + row + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_' + row + '" name="btn_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="updateRinci(' + row + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick mt-1" id="btn_cancel_update_' + row + '" name="btn_cancel_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update" onclick="cancelUpdate(' + row + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_' + row + '" name="btn_hapus_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + row + ')"></button>' +
            '<label id="lbl_status_simpan_' + row + '"></label>' +
            '</td>';
        var td_col_14 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<i><small>waiting approval</small></i>' +
            '</td>';
        var form_tutup = '</form>';
        var tr_tutup = '</tr>';

        // req_rev_qty_item == 1 yaitu telah di approve
        if (req_rev_qty_item == '1') {
            $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_9 + td_col_10 + td_col_11 + td_col_12 + td_col_14 + form_tutup + tr_tutup);
        } else if (req_rev_qty_item == '2' && !status_item_bkb) {
            $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_9 + td_col_10 + td_col_11 + td_col_12 + td_col_13 + form_tutup + tr_tutup);
        } else if (!status_item_bkb && approval_item == '1') {
            $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_9 + td_col_10 + td_col_11 + td_col_12 + td_col_13 + form_tutup + tr_tutup);
        }
        // else {
        //     $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_9 + td_col_10 + td_col_11 + td_col_12 + form_tutup + tr_tutup);
        // }

        // cek_bagian(row);

        $('#txt_qty_diminta_' + row).addClass('currencyduadigit');
        $('#txt_qty_disetujui_' + row).addClass('currencyduadigit');
        $('.currencyduadigit').number(true, 0);
        // $('#txt_account_beban_'+row).attr('disabled','');

        // $('html, body').animate({
        //     scrollTop: $("#tr_" + row).offset().top
        // }, 2000);
    }

    // function tahun_tanam(i, coa_material) {
    //     console.log(coa_material);
    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo site_url('Bkb/get_tahun_tanam'); ?>",
    //         dataType: "JSON",
    //         beforeSend: function() {},

    //         data: {
    //             'coa_material': coa_material
    //         },
    //         success: function(data) {

    //             if (data) {
    //                 $('#cmb_tm_tbm_' + i).val(data.kategori);
    //                 $('#cmb_tahun_tanam_' + i).val(data.thntanam);
    //             }

    //         },
    //         error: function(response) {
    //             alert('ERROR! ' + response.responseText);
    //         }
    //     });
    // }

    function get_stok(i, kodebar, txtperiode, kode_dev) {
        console.log(kodebar);
        console.log(txtperiode);
        console.log(kode_dev);
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

    //validasi qty
    function saveRinciClick(n) {
        var stok = $('#stok_' + n).text();
        var qty_disetujui = $('#txt_qty_disetujui_' + n).val();

        var a = Number(stok);
        var b = Number(qty_disetujui);

        if (a < b) {
            swal('QTY BKB melebihi stok yang ada!');
        } else {
            saveRinciClick_simpan(n);
        }

    }

    // saat hitung stock awal harian gunakan where devisi!
    function saveRinciClick_simpan(n) {

        var hidden_kode_barang = $('#hidden_kode_barang_' + n).val();
        var kode_dev = $('#hidden_kode_dev').val();
        var noref_bpb = $('#txt_no_bpb').val();

        var pt_mutasi = $('#pt_mutasi').val();
        var devisi_mutasi = $('#devisi_mutasi').val();

        if ($('#cexbox_mutasi').is(':checked')) {
            var cexbox_mutasi = '1';
            var cexbox_mutasi_pt = '1';
        }

        if ($('#cexbox_mutasi_local').is(':checked')) {
            var cexbox_mutasi = '1';
            var cexbox_mutasi_local = '1';
        }

        if (cexbox_mutasi == '1' && !devisi_mutasi) {
            $.toast({
                position: 'top-right',
                heading: 'Failed!',
                text: 'BKB MUTASI!, Harap pilih PT dan Divisi Tujuan Mutasi!',
                icon: 'error',
                loader: false
            });
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bkb/saveBkb') ?>",
                dataType: "JSON",

                beforeSend: function() {
                    $('#btn_simpan_' + n).css('display', 'none');

                    $('#lbl_status_simpan_' + n).empty();
                    $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>');

                    if ($.trim($('#h4_no_ref_bkb').text()) == '') {
                        $('#lbl_bkb_status').empty();
                        $('#lbl_bkb_status').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Generate BKB Number</label>');
                    }
                },

                data: {
                    txt_tgl_bkb: $('#tgl_bkb_txt').val(),
                    txt_no_bpb: $('#txt_no_bpb').val(),
                    hidden_no_ref_bkb: $('#hidden_no_ref_bkb').val(),
                    hidden_no_bkb: $('#hidden_no_bkb').val(),
                    cmb_alokasi_est: $('#alokasi_est').val(),
                    txt_diberikan_kpd: $('#diberikan_kpd').val(),
                    txt_untuk_keperluan: $('#utk_keperluan').val(),
                    cmb_bagian: $('#bagian').val(),
                    kode_dev: kode_dev,
                    devisi: $('#hidden_devisi').val(),
                    mutasi: cexbox_mutasi,
                    kode_pt_mutasi: $('#pt_mutasi').val(),
                    kode_devisi_mutasi: $('#devisi_mutasi').val(),

                    hidden_kode_barang: $('#hidden_kode_barang_' + n).val(),
                    hidden_nama_barang: $('#txt_barang_' + n).val(),
                    hidden_satuan: $('#sat_bpb_' + n).text(),
                    hidden_grup_barang: $('#hidden_grup_barang_' + n).val(),
                    cmb_tm_tbm: $('#cmb_tm_tbm_' + n).val(),
                    cmb_afd_unit: $('#cmb_afd_unit_' + n).val(),
                    cmb_blok_sub: $('#cmb_blok_sub_' + n).val(),
                    cmb_tahun_tanam: $('#cmb_tahun_tanam_' + n).val(),
                    txt_qty_diminta: $('#txt_qty_diminta_' + n).val(),
                    txt_qty_disetujui: $('#txt_qty_disetujui_' + n).val(),
                    txt_ket_rinci: $('#txt_ket_rinci_' + n).val(),
                    cmb_bahan: $('#cmb_bahan_' + n).val(),
                    hidden_no_acc: $('#hidden_no_acc_' + n).val(),
                    hidden_nama_acc: $('#txt_account_beban_' + n).val(),
                    hidden_kodebebantxt: $('#hidden_kodebebantxt' + n).val(),

                    //BBM
                    bhnbakar: $('#bhnbakar').val(),
                    txt_jns_alat: $('#txt_jns_alat').val(),
                    txt_kd_nmr: $('#txt_kd_nmr').val(),
                    txt_hm_km: $('#txt_hm_km').val(),
                    txt_lokasi_kerja: $('#txt_lokasi_kerja').val(),
                },

                success: function(data) {
                    console.log(data);
                    if (data.nilai_keluarbrgitem == '0') {
                        swal('barang tidak ada stok di divisi tersebut! silahkan input!');
                        $('#lbl_status_simpan_' + n).empty();
                        $('#lbl_bkb_status').empty();
                        $('#btn_simpan_' + n).css('display', 'block');

                    } else {
                        $('#new_bkb').removeAttr('disabled');
                        $('#camera').attr('disabled', '');
                        $('#cancelBkb').removeAttr('disabled');
                        $('#a_print_bkb').removeAttr('disabled');

                        $('#lbl_status_simpan_' + n).empty();

                        $('#lbl_bkb_status').empty();
                        $('#h4_no_bkb').html('No. BKB : ' + data.no_bkb);
                        $('#hidden_no_bkb').val(data.no_bkb);
                        $('#id_keluarbrgitem_' + n).val(data.id_keluarbrgitem);

                        $('#h4_no_ref_bkb').html('No. Ref. BKB : ' + data.noref_bkb);
                        $('#hidden_no_ref_bkb').val(data.noref_bkb);

                        $('#hidden_id_mutasi').val(data.id_mutasi);
                        $('#hidden_id_mutasi_item_' + n).val(data.id_mutasi_item);
                        $('#hidden_id_register_stok_' + n).val(data.id_register_stok);

                        $('.div_form_2').find('#rev_qty_' + n + '').attr('disabled', '');

                        $.toast({
                            position: 'top-right',
                            heading: 'Success',
                            text: 'Berhasil Disimpan!',
                            icon: 'success',
                            loader: false
                        });

                        //hitung ulang stok?
                        get_stok(n, hidden_kode_barang, data.txtperiode, kode_dev);

                        $('#hidden_id_bkb').val(data.id_stockkeluar);

                        $('#pt_mutasi').prop('disabled', true);
                        $('#devisi_mutasi').prop('disabled', true);
                        $('#cexbox_mutasi').attr('disabled', true);
                        $('#tgl_bkb_txt').attr('disabled', true);
                        $('#cari_bpb').attr('disabled', true);
                        $('#diberikan_kpd').attr('disabled', true);
                        $('#utk_keperluan').attr('disabled', true);
                        $('#camera').attr('disabled', true);

                        $('#btn_hapus_' + n).css('display', 'block');
                        $('#btn_simpan_' + n).css('display', 'none');
                        $('#rev_qty_' + n).css('display', 'none');

                        //jika dia mutasi ubah status bpb mutasi
                        if (cexbox_mutasi_pt == '1' || cexbox_mutasi_local == '1') {
                            ubah_status_bpb_mutasi(hidden_kode_barang, noref_bpb);
                            $('#txt_qty_disetujui_' + n).addClass('bg-light');
                            $('#txt_qty_disetujui_' + n).attr('disabled', '');
                        }


                        notiferor(data);
                    }
                },
                error: function(response) {
                    alert('ERROR! ' + response.responseText);
                }
            });
        }
    }

    function notiferor(data) {
        if (data.result_insert_stok_awal_bulanan == 0) {
            alert('result_insert_stok_awal_bulanan GAGAL!');
        }

        if (data.datastockkeluar == 0) {
            alert('datastockkeluar GAGAL!');
        }

        if (data.datakeluarbrgitem == 0) {
            alert('datakeluarbrgitem GAGAL!');
        }

        if (data.result_update_qtykeluar == 0) {
            alert('result_update_qtykeluar GAGAL!');
        }

        if (data.savedatastockkeluar_mutasi == 0) {
            alert('savedatastockkeluar_mutasi GAGAL!');
        }

        if (data.savedatakeluarbrgitem_mutasi == 0) {
            alert('savedatakeluarbrgitem_mutasi GAGAL!');
        }

        if (data.result_insert_stok_awal_harian == 0) {
            alert('result_insert_stok_awal_harian GAGAL!');
        }

        if (data.saveregisterstok == 0) {
            alert('saveregisterstok GAGAL!');
        }

        if (data.insert_to_gl_header == 0) {
            alert('insert_to_gl_header GAGAL!');
        }

        if (data.insert_bkb_to_entry_gl_cr == 0) {
            alert('insert_bkb_to_entry_gl_cr GAGAL!');
        }

        if (data.insert_bkb_to_entry_gl_dr == 0) {
            alert('insert_bkb_to_entry_gl_dr GAGAL!');
        }
    }

    function ubah_status_bpb_mutasi(hidden_kode_barang, noref_bpb) {

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bkb/ubah_status_bpb_mutasi'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                'no_ref_bpb': noref_bpb,
                'kodebar': hidden_kode_barang
            },
            success: function(data) {
                console.log(data);
            },
            error: function(response) {
                alert('ERROR! ' + response.responseText);
            }
        });
    }

    function cetak_bkb() {
        var no_bkb = $('#hidden_no_bkb').val();
        var id = $('#hidden_id_bkb').val();

        window.open("<?= base_url('Bkb/cetak/') ?>" + no_bkb + '/' + id, '_blank');

        // $('.div_form_2').css('pointer-events', 'none');
    }

    function btnRevQty(n) {

        $("#modalRevQty").modal('show');
        $('#req_rev_qty').val('');
        $('#no_table').val(n);

        // Swal.fire({
        //     text: "Request revisi QTY ke KTU?",
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Ya Request!'
        // }).then((result) => {
        //     if (result.value) {
        //         revQty(n);
        //     }
        // });
    }

    function revQty() {
        var n = $('#no_table').val();
        var no_ref_bpb = $('#txt_no_bpb').val();
        var kodebar = $('#hidden_kode_barang_' + n + '').val();
        var req_rev_qty = $('#req_rev_qty').val();

        if (req_rev_qty == '') {
            swal('Masukan angka!');
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Bkb/rev_qty'); ?>",
                dataType: "JSON",
                beforeSend: function() {},

                data: {
                    'no_ref_bpb': no_ref_bpb,
                    'kodebar': kodebar,
                    'req_rev_qty': req_rev_qty
                },
                success: function(data) {

                    console.log(data);
                    // tombol simpan disabled
                    $('.div_form_2').find('#btn_simpan_' + n + '').attr('disabled', '');
                    $('.div_form_2').find('#rev_qty_' + n + '').attr('disabled', '');

                    $.toast({
                        position: 'top-right',
                        heading: 'Success',
                        text: 'Request QTY Berhasil!',
                        icon: 'success',
                        loader: false
                    });
                },
                error: function(response) {
                    alert('ERROR! ' + response.responseText);
                }
            });
        }
    }

    function validasi_qty() {
        var n = $('#no_table').val();
        var a = $('#txt_qty_diminta_' + n + '').val();
        var b = $('#req_rev_qty').val();

        var txt_qty_diminta = Number(a);
        var req_rev_qty = Number(b);

        if (req_rev_qty > txt_qty_diminta) {
            swal('Melibihi QTY diminta!');
            $('#req_rev_qty').val('');
        } else if (req_rev_qty == 0) {
            swal('Tidak boleh 0!');
            $('#req_rev_qty').val('');
        }
    }

    function validasi_qty_disetujui(n) {

        var a = $('#txt_qty_diminta_' + n).val();
        var b = $('#txt_qty_disetujui_' + n).val();

        var txt_qty_diminta = Number(a);
        var txt_qty_disetujui = Number(b);

        if (txt_qty_disetujui > txt_qty_diminta) {
            swal('Melibihi QTY diminta!');
            $('#txt_qty_disetujui_' + n).val(a);
        } else if (txt_qty_disetujui == 0) {
            swal('Tidak boleh 0!');
            $('#txt_qty_disetujui_' + n).val(a);
        }
    }

    function cari_pt_mutasi(kode_pt, kode_devisi_mutasi) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bkb/cari_pt_mutasi'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            data: {},
            success: function(data) {

                // console.log(data);
                var html = '';
                var i;
                html += '<option disabled selected>Pilih Divisi</option>';
                for (i = 0; i < data.length; i++) {
                    if (data[i].kode_pt == kode_pt) {
                        html += '<option value=' + data[i].kode_pt + ' selected>' + data[i].kode_pt + ' - ' + data[i].nama_pt + '</option>';
                    }
                }
                $('#pt_mutasi').html(html);

                //menjalankan jquery get divisi mutasi
                pt_mutasi(kode_pt, kode_devisi_mutasi);
            },
            error: function(response) {
                alert('ERROR! ' + response.responseText);
            }
        });
    }

    function pt_mutasi(kode_pt, kode_devisi_mutasi) {
        // var kode_pt = $('#pt_mutasi').val();

        console.log(kode_devisi_mutasi + ' ni kodedev mut');
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bkb/get_devisi_mutasi'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                'kode_pt': kode_pt
            },
            success: function(data) {

                var html = '';
                var i;
                html += '<option disabled selected>Pilih Divisi</option>';
                for (i = 0; i < data.length; i++) {
                    if (data[i].kodetxt == kode_devisi_mutasi) {
                        html += '<option value=' + data[i].kodetxt + ' selected>' + data[i].kodetxt + ' - ' + data[i].PT + '</option>';
                    }
                }

                $('#devisi_mutasi').html(html);
            },
            error: function(response) {
                alert('ERROR! ' + response.responseText);
            }
        });
    }

    // function cekbox_mutasi() {

    //     var mutasi = $('#hidden_cekbox_mutasi').val();

    //     if (mutasi == 0) {

    //         $('#hidden_cekbox_mutasi').val('1');

    //         $('#pt_mutasi').removeAttr('disabled');
    //         $('#devisi_mutasi').removeAttr('disabled');

    //     } else if (mutasi == 1) {

    //         $('#pt_mutasi').prop('disabled', true);
    //         $('#devisi_mutasi').prop('disabled', true);

    //         $('#hidden_cekbox_mutasi').val('');
    //         $('#pt_mutasi').val('');
    //         $('#devisi_mutasi').val('');
    //     }
    // }

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
            url: "<?php echo site_url('Bkb/hapusItemBkb'); ?>",
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
                'noref_bkb': $('#hidden_no_ref_bkb').val(),
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
                $('#lbl_status_simpan_' + n).append('<label style="font-size:12px;"><i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>cek bkb item..</label>');
            },

            data: {
                'noref_bkb': $('#hidden_no_ref_bkb').val()
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
                    location.reload();
                }, 1000);

            },
            error: function(response) {
                alert('ERROR! ' + response.responseText);
            }
        });
    }

    function hapusBkb(n) {

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
            url: "<?php echo site_url('Bkb/hapusBkb'); ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#lbl_status_simpan_' + n).empty();
                $('#lbl_status_simpan_' + n).append('<label style="font-size:12px;"><i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>Hapus data BKB</label>');
            },

            data: {
                'noref_bkb': $('#hidden_no_ref_bkb').val(),
                'id_mutasi': $('#hidden_id_mutasi').val(),
                'mutasi': cexbox_mutasi
            },
            success: function(data) {

                notiferrordeletebkb(data);

                location.href = "<?php echo base_url('Bkb/input') ?>";

            },
            error: function(response) {
                alert('ERROR! ' + response.responseText);
            }
        });

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
    }
</script>