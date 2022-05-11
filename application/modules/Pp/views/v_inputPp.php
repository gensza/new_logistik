<div class="container-fluid">
    <!-- start row-->
    <div class="row mt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- <form action="javascript:;" id="form_input_pp" name="form_input_pp" method="POST"> -->
                    <div class="row mb-2 justify-content-between">
                        <h4 class="header-title ml-2"><?= $title; ?></h4>
                        <h6 id="lbl_status_pp"></h6>
                        <div class="button-list mr-2">
                            <button class="btn btn-xs btn-info" id="data_pp" onclick="data_pp()">Data PP</button>
                            <button type="button" onclick="new_pp()" class="btn btn-xs btn-success" id="">PP Baru</button>
                            <button type="button" onclick="alasanbatal()" class="btn btn-xs btn-danger" id="batalpp" disabled>Batal PP</button>
                            <button type="button" class="btn btn-xs btn-primary" id="cetak" onclick="cetak()" disabled>Cetak</button>
                            <button type="button" onclick="goBack()" class="btn btn-xs btn-secondary" id="kembali">Kembali</button>
                        </div>
                    </div>
                    <div class="row div_form_1">
                        <div class="col-lg-4 col-xl-4 col-12">

                            <!-- <input type="text" name="status_update" id="status_update"> -->
                            <input type="hidden" name="id_pp" id="id_pp">
                            <input type="hidden" id="hidden_no_pp" name="hidden_no_pp">
                            <input type="hidden" id="hidden_refpp" name="hidden_refpp">
                            <input type="hidden" id="hidden_id_po" name="hidden_id_po">
                            <!-- </div> -->

                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_no_ref_po" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Ref&nbsp;PO&nbsp;
                                </label>

                                <div class="col-9 col-xl-12">
                                    <input id="txt_no_ref_po" name="txt_no_ref_po" class="form-control form-control-sm" required="required" type="text" placeholder="No. Ref. PO" onfocus="tampilModalklik()">
                                    <input type="hidden" id="hidden_no_po" name="hidden_no_po">
                                    <input type="hidden" id="hidden_grup" name="hidden_grup">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_pembayaran" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Pembayaran
                                </label>
                                <div class="col-9 col-xl-12">
                                    <input id="txt_pembayaran" name="txt_pembayaran" class="form-control form-control-sm" required="required" type="text" placeholder="Pembayaran">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="kd_supplier" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Supplier
                                </label>
                                <div class="col-3" style="padding-right: 0.01em;">
                                    <input type="text" class="form-control form-control-sm bg-light" id="kd_supplier" name="kd_supplier" placeholder="Kode Supplier" autocomplite="off" readonly>
                                </div>
                                <div class="col-6 col-xl-12">
                                    <input type="text" class="form-control form-control-sm bg-light" id="txt_supplier" name="txt_supplier" placeholder="Supplier" autocomplite="off" readonly>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_nilai_po" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Nilai&nbsp;PO
                                </label>
                                <div class="col-9 col-xl-12">
                                    <input id="txt_nilai_po" name="txt_nilai_po" class="form-control form-control-sm bg-light" required="required" type="text" placeholder="Nilai PO" readonly="" onkeyup="hitungTotalPO()">
                                    <input type="hidden" name="hidden_nilai_po" id="hidden_nilai_po">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="lbl_kurs" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Kurs
                                </label>
                                <label class="control-label col-md-2 col-sm-3" id="lbl_kurs" name="lbl_kurs"></label>
                                <div class="col-3">
                                    <input type="hidden" id="hidden_kurs" name="hidden_kurs" required="" value="Rp" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_pajak" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Pajak
                                </label>
                                <div class="col-9 col-xl-12">
                                    <input type="text" placeholder="" class="form-control form-control-sm" value="0" id="txt_pajak" name="txt_pajak" onkeyup="hitung()" required="required">
                                    <input type="hidden" name="hidden_pajak" id="hidden_pajak">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_nilai_bpo1" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Nilai&nbsp;BPO
                                </label>
                                <div class="col-4" style="padding-right: 0.01em;">
                                    <input type="text" placeholder="" class="form-control form-control-sm" value="0" id="txt_nilai_bpo1" name="txt_nilai_bpo1" onkeyup="hitung()" required="required">
                                    <input type="hidden" name="hidden_bpo1" id="hidden_bpo1">
                                </div>
                                <div class="col-5 col-xl-12">
                                    <input type="text" placeholder="" class="form-control form-control-sm" value="0" id="txt_nilai_bpo2" name="txt_nilai_bpo2" onkeyup="hitung()" required="required">
                                    <input type="hidden" name="hidden_bpo2" id="hidden_bpo2">
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4 col-xl-4 col-12">
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_total_po" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Total&nbsp;PO
                                </label>
                                <div class="col-9 col-xl-12">
                                    <input id="txt_total_po" name="txt_total_po" class="form-control form-control-sm bg-light" required="required" type="text" placeholder="Total PO" readonly="">
                                    <input type="hidden" name="tot_po" id="tot_po">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_sudah_dibayar" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Sudah&nbsp;Bayar
                                </label>
                                <div class="col-9 col-xl-12">
                                    <input id="txt_sudah_dibayar" name="txt_sudah_dibayar" class="form-control form-control-sm bg-light" required="required" type="text" placeholder="Sudah dibayar" readonly="">
                                    <input type="hidden" name="hidden_sdh_bayar" id="hidden_sdh_bayar">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_tgl_pp" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Tgl.&nbsp;PP
                                </label>
                                <div class="col-9 col-xl-12">
                                    <input id="txt_tgl_pp" name="txt_tgl_pp" class="form-control form-control-sm" required="required" type="text" placeholder="Tgl. PP">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_tgl_po" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Tgl.&nbsp;PO
                                </label>
                                <div class="col-9 col-xl-12">
                                    <input id="txt_tgl_po" name="txt_tgl_po" class="form-control form-control-sm bg-light" type="text" readonly>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_dibayar_ke" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Dibayar&nbsp;ke
                                </label>

                                <div class="col-9 col-xl-12">
                                    <input id="txt_dibayar_ke" name="txt_dibayar_ke" class="form-control form-control-sm" required="required" type="text" placeholder="Dibayar ke">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_jumlah" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Jumlah
                                </label>

                                <div class="col-9 col-xl-12">
                                    <input id="txt_jumlah" name="txt_jumlah" class="form-control form-control-sm" required="required" type="text" placeholder="Jumlah" onkeyup="getTerbilang()">
                                    <input type="hidden" name="hidden_jumlah" id="hidden_jumlah">
                                    <input type="hidden" name="jumlah" id="jumlah">
                                    <input type="hidden" name="jumlahplus" id="jumlahplus">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_terbilang" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Terbilang
                                </label>
                                <div class="col-9 col-xl-12">
                                    <textarea class="form-control form-control-sm bg-light" id="txt_terbilang" name="txt_terbilang" placeholder="Terbilang" rows="3" required="required" readonly=""></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4 col-xl-4 col-12">
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_keterangan" class="col-lg-4 col-xl-4 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Keterangan
                                </label>
                                <div class="col-8 col-xl-12">
                                    <textarea class="form-control form-control-sm" id="txt_keterangan" name="txt_keterangan" placeholder="Keterangan" rows="2"></textarea>
                                    <!-- <input id="txt_keterangan" name="txt_keterangan" rows="3" class="form-control form-control-sm" required="required" type="text" placeholder="Keterangan" autocomplete="off"> -->
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="lbl_kode_budget" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Kode Budget&nbsp;
                                </label>
                                <label class="control-label col-md-2 col-sm-3" id="lbl_kode_budget"></label>
                                <input type="hidden" id="hidden_kode_budget" name="hidden_kode_budget">
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="lbl_jenis_budget" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Jenis&nbsp;Budget&nbsp;
                                </label>
                                <label class="control-label col-md-2 col-sm-3" id="lbl_jenis_budget"></label>
                                <input type="hidden" id="hidden_jenis_budget" name="hidden_jenis_budget">
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="lbl_main_account_budget" class="col-lg-5 col-xl-5 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Main&nbsp;Account&nbsp;Budget&nbsp;
                                </label>
                                <label class="control-label col-md-2 col-sm-3" id="lbl_main_account_budget"></label>
                                <input type="hidden" id="hidden_main_account" name="hidden_main_account">
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="lbl_nama_account" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Nama&nbsp;Account&nbsp;
                                </label>
                                <label class="control-label col-md-2 col-sm-3" id="lbl_nama_account"></label>
                                <input type="hidden" id="hidden_nama_account" name="hidden_nama_account">
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="lbl_nama_account" class="col-lg-4 col-xl-4 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    User&nbsp;
                                </label>
                                <label class="control-label col-6 col-xl-12"><?php echo $this->session->userdata('user'); ?></label>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_no_voucher" class="col-lg-4 col-xl-4 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    No.&nbsp;Voucher
                                </label>
                                <div class="col-8 col-xl-12">
                                    <input type="number" class="form-control form-control-sm" id="txt_no_voucher" name="txt_no_voucher" placeholder="No Voucher" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_tgl_voucher" class="col-lg-4 col-xl-4 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Tanggal
                                </label>
                                <div class="col-8 col-xl-12">
                                    <input type="text" class="form-control form-control-sm bg-light" id="txt_tgl_voucher" name="txt_tgl_voucher" readonly placeholder="Tanggal">
                                </div>
                            </div>

                            <div class="button-list" style="float: right; margin-top: 15px;">
                                <button type="button" onclick="validasi()" class="btn btn-xs btn-primary" id="simpan_pp">Simpan</button>
                                <button type="button" onclick="updateData()" class="btn btn-xs btn-warning" style="display: none;" id="update_pp">Update</button>
                                <button type="button" onclick="cancelUpdate()" class="btn btn-xs btn-primary" style="display: none;" id="cancelUpdate">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>



    </div>

    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="fullWidthModalLabel" aria-hidden="true" id="modalcariPO">
        <div class="modal-dialog modal-md input-pp">
            <div class="modal-content">
                <div class="modal-header">
                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#scanqr" at="qr" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                Scan QRcode
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#home" at="po" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                List PO
                            </a>
                        </li>


                    </ul>
                    <label class="btn btn-secondary btn-xs ml-4" id="kamera2" style="display: block;">
                        <input type="radio" name="putar_camera" value="1" autocomplete="off" checked> Front Camera
                    </label>
                    <label class="btn btn-info active btn-xs " id="kamera1" style="display: block;">
                        <input type="radio" name="putar_camera" value="2" autocomplete="off"> Back Camera

                    </label>

                </div>
                <div class="modal-body">


                    <div id="camera" style="display: block;">
                        <video id="preview" width="100%"></video>
                    </div>
                    <div id="listpo" style="display: none;">
                        <div class="table-responsive">
                            <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                            <table id="tableDataPO" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th style="font-size: 12px; padding:10px">#</th>
                                        <th style="font-size: 12px; padding:10px">Tanggal</th>
                                        <th style="font-size: 12px; padding:10px">No. Ref. PO</th>
                                        <th style="font-size: 12px; padding:10px">No PO</th>
                                        <th style="font-size: 12px; padding:10px">Supplier</th>
                                        <th style="font-size: 12px; padding:10px">Bayar</th>
                                        <th style="font-size: 12px; padding:10px">Harga PO+PPN</th>
                                        <th style="font-size: 12px; padding:10px">BPO</th>
                                        <th style="font-size: 12px; padding:10px">Terbayar</th>
                                        <th style="font-size: 12px; padding:10px">Saldo</th>
                                        <th style="font-size: 12px; padding:10px">Kurs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" id="tutup_modal" onclick="tutup_modal()">Tutup</button>
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
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    table#tableDataPO td {
        padding: 3px;
        padding-left: 10px;
        font-size: 11px;
        cursor: pointer;
    }

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
</style>
<script>
    function data_pp() {
        location.href = "<?php echo base_url('Pp') ?>";
    }

    function new_pp() {
        location.href = "<?php echo base_url('Pp/input') ?>";
    }

    // function data_pp() {
    //     location.href = "<?php echo base_url('Pp') ?>";
    // }

    function goBack() {
        window.history.back();
    }

    function toast(v_text) {
        $.toast({
            position: 'top-right',
            heading: 'Failed!',
            text: v_text + ' ',
            icon: 'error',
            loader: false
        });
    }

    function validasi() {
        var refpo = $('#txt_no_ref_po').val();
        var pembayaran = $('#txt_pembayaran').val();
        var pajak = $('#txt_pajak').val();
        var nilai_bpo1 = $('#txt_nilai_bpo1').val();
        var nilai_bpo2 = $('#txt_nilai_bpo2').val();
        var bayar_ke = $('#txt_dibayar_ke').val();
        var jumlah = $('#txt_jumlah').val();

        if (!refpo) {
            toast('NOREF PO is required!');
            $('#txt_no_ref_po').css({
                "background": "#FFCECE"
            });
        } else if (!pembayaran) {
            toast('Pembayaran is required!');
            $('#txt_pembayaran').css({
                "background": "#FFCECE"
            });

        } else if (!pajak) {
            toast('Pajak is required!');
            $('#txt_pajak').css({
                "background": "#FFCECE"
            });

        } else if (!nilai_bpo1) {
            toast('BPO is required!');
            $('#txt_nilai_bpo1').css({
                "background": "#FFCECE"
            });

        } else if (!nilai_bpo2) {
            toast('BPO is required!');
            $('#txt_nilai_bpo2').css({
                "background": "#FFCECE"
            });

        } else if (!bayar_ke) {
            toast('Bayar is required!');
            $('#txt_dibayar_ke').css({
                "background": "#FFCECE"
            });

        } else if (!jumlah) {
            toast('Bayar is required!');
            $('#txt_jumlah').css({
                "background": "#FFCECE"
            });

        } else {
            saveData();
        }
    }
    $(document).ready(function() {
        // setTimeout(function() {
        //     check_form()
        // }, 1000);
        // $('#preview').show();
        // console.log('ini dia',$(this).attr('at'));
        $('#txt_pajak,#txt_nilai_bpo1,#txt_nilai_bpo2').number(true, 2);
        $('#txt_nilai_po,#txt_total_po,#txt_sudah_dibayar,#txt_jumlah').number(true, 2);

        $(".nav-link").click(function() {
            $(".nav-link").removeClass("active");
            $(this).addClass("active");
            var jenis = $(this).attr('at');
            if (jenis != 'po') {
                $(".input-pp").removeClass("modal-full-width");
                $(".input-pp").addClass("modal-md");
                $("#judulpo").css('display', 'none');
                $("#judulqr").css('display', 'block');
                $("#listpo").css('display', 'none');
                $("#camera").css('display', 'block');
                $("#kamera1").css('display', 'block');
                $("#kamera2").css('display', 'block');
            } else {
                $(".input-pp").removeClass("modal-md");
                $(".input-pp").addClass("modal-full-width");
                $("#judulpo").css('display', 'block');
                $("#judulqr").css('display', 'none');
                $("#camera").css('display', 'none');
                $("#listpo").css('display', 'block');
                $("#kamera1").css('display', 'none');
                $("#kamera2").css('display', 'none');
            }
        });


        $("#txt_jumlah").on("keypress keyup blur", function(event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        $('#a_pp_baru').hide();

        $('#txt_tgl_pp,#txt_tgl_po,#txt_tgl_voucher').daterangepicker({
            singleDatePicker: !0,
            singleClasses: "picker_1"

        }, function(start, end, label) {
            // start.format('YYYY-MM-DD')
        });


        tampilModal();

        $('#txt_tgl_voucher').val('');
    });

    //untuk scan
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview')
    });

    scanner.addListener('scan', function(content) {
        // console.log(content);
        $('#preview').hide();
        cariPoqr(content);
        $('#modalcariPO').modal('hide');
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
    //end
    function tampilModal() {
        $('#modalcariPO').modal('show');
        $('#preview').show();
        dataPO();
        // scanner.start();
    }

    function tampilModalklik() {
        scanner.start();
        tampilModal();
    }



    function cariPoqr(noref) {
        // alert(noref);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Pp/caripo'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                refpo: noref,
            },
            success: function(data) {
                console.log(data.po.terbayar);
                if (data.po.terbayar == 1) {
                    Swal.fire({
                        text: "Saldo sudah 0!",
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            tampilModal();
                            scanner.start();
                        }
                    });
                } else {
                    // console.log(data);
                    var jumlah = data.saldo;
                    var id_po = data.po.id;
                    var tgl_po = data.tglpo;
                    var no_ref_po = data.po.noreftxt;
                    var no_po = data.po.nopo;
                    var pembayaran = data.po.bayar;
                    var kd_supply = data.po.kode_supply;
                    var nama_supply = data.po.nama_supply;
                    var kurs = data.kurs;
                    var bayar = data.bayar;
                    var saldo = data.saldo;
                    var nilaipo = data.nilaipo;
                    var pajak = data.pajak;
                    var totalpo = data.totalpo;
                    var tot = data.totalpo;
                    var bpo = data.bpo;


                    $('#hidden_id_po').val(id_po);
                    $('#txt_tgl_po').val(tgl_po);

                    $('#txt_no_ref_po').val(no_ref_po);
                    $('#hidden_no_po').val(no_po);
                    $('#txt_pembayaran').val(pembayaran);
                    $('#kd_supplier').val(kd_supply);
                    $('#txt_supplier').val(nama_supply);
                    $('#txt_dibayar_ke').val(nama_supply);

                    $('#txt_nilai_po').val(nilaipo);
                    $('#hidden_nilai_po').val(nilaipo);
                    $('#txt_pajak').val(pajak);
                    $('#hidden_pajak').val(pajak);
                    $('#txt_total_po').val(totalpo);
                    $('#tot_po').val(tot);
                    // var bpo = nilai_bpo.replace(/,/g, "");
                    $('#txt_nilai_bpo2').val(bpo);
                    $('#hidden_bpo2').val(bpo)
                    $('#lbl_kurs').html(kurs);
                    $('#hidden_kurs').val(kurs);

                    $('#txt_sudah_dibayar').val(bayar);
                    $('#hidden_sdh_bayar').val(bayar);
                    $('#modalcariPO').modal('hide');
                    sum_pp_bayar(no_ref_po)
                    hitungTotalPO();

                }


            },
            error: function(request) {
                console.log(request.responseText);
            }
        });
    }

    $("#form_input_pp").validate({
        ignore: [],
        submitHandler: function(form) {
            saveData();
        }
    });

    function alasanbatal() {

        $('#alasanbatal').modal('show');
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
            hapusPP();
        }
    }

    function batal() {
        // alert("Dalam proses perbaikan")

        var id = $('#id_pp').val();
        var alasan = $('#alasan').val();
        var nopp = $('#hidden_no_pp').val();
        var jumlah = $('#txt_jumlah').val();
        var nopo = $('#hidden_no_po').val();
        console.log(jumlah);

        $('#idpp').val(id);
        $('#nopp').val(nopp);
        // $('#ref_po').val(ref_po);
        $('#jumlahbatal').val(jumlah);
        $('#nopo').val(nopo);
        $('#modalKonfirmasiHapus').modal('show');
    }

    function hapusPP() {
        // listPP();
        $('#alasanbatal').modal('hide');
        var alasan = $('#alasan').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Pp/deletePP') ?>",
            dataType: "JSON",
            beforeSend: function() {},
            data: {
                id_pp: $('#id_pp').val(),
                nopp: $('#nopp').val(),
                refpp: $('#hidden_refpp').val(),
                jumlah: $('#jumlah').val(),
                nopo: $('#hidden_no_po').val(),
                alasan: $('#alasan').val(),
            },
            success: function(data) {
                // console.log(data)
                $.toast({
                    position: 'top-right',
                    heading: 'Dibatalkan',
                    text: 'Berhasil Dibatalkan!',
                    icon: 'success',
                    loader: false
                });

                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        });
    }

    function cetak() {
        var id_pp = $('#id_pp').val();
        var noref = $('#hidden_refpp').val();

        var noref_rpc = noref.replaceAll('/', '.');

        window.open('cetak/' + noref_rpc + '/' + id_pp, '_blank');
    }

    function saveRinciEnter(e) {
        saveData();
    }

    function saveData() {
        $('#simpan_pp').attr('disabled', '');
        var id_pp = $('#id_pp').val();
        if (!id_pp) {
            var form_data = new FormData();

            form_data.append('hidden_id_po', $('#hidden_id_po').val());
            form_data.append('hidden_no_pp', $('#hidden_no_pp').val());
            form_data.append('txt_no_ref_po', $('#txt_no_ref_po').val());
            form_data.append('hidden_no_po', $('#hidden_no_po').val());
            form_data.append('hidden_grup', $('#hidden_grup').val());
            form_data.append('txt_tgl_pp', $('#txt_tgl_pp').val());
            form_data.append('txt_tgl_po', $('#txt_tgl_po').val());
            form_data.append('txt_pembayaran', $('#txt_pembayaran').val());
            form_data.append('kd_supplier', $('#kd_supplier').val());
            form_data.append('txt_supplier', $('#txt_supplier').val());
            var total_po = $('#txt_nilai_po').val();
            // var hasil = total_po.replace(/,/g, "");
            form_data.append('txt_nilai_po', total_po);
            form_data.append('hidden_kurs', $('#hidden_kurs').val());
            form_data.append('txt_pajak', $('#txt_pajak').val());
            form_data.append('txt_nilai_bpo1', $('#txt_nilai_bpo1').val());
            form_data.append('txt_nilai_bpo2', $('#txt_nilai_bpo2').val());
            form_data.append('txt_total_po', $('#txt_total_po').val());
            form_data.append('txt_dibayar_ke', $('#txt_dibayar_ke').val());
            form_data.append('txt_jumlah', $('#txt_jumlah').val());
            form_data.append('jumlah', $('#jumlah').val());
            form_data.append('jumlahplus', $('#jumlahplus').val());
            form_data.append('txt_terbilang', $('#txt_terbilang').val());
            form_data.append('txt_keterangan', $('#txt_keterangan').val());
            form_data.append('hidden_main_account', $('#hidden_main_account').val());
            form_data.append('hidden_nama_account', $('#hidden_nama_account').val());
            form_data.append('txt_no_voucher', $('#txt_no_voucher').val());
            form_data.append('txt_tgl_voucher', $('#txt_tgl_voucher').val());

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Pp/simpan_pp'); ?>",
                dataType: "JSON",
                beforeSend: function() {
                    $('#simpan_pp').append('&nbsp;<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>');
                },
                cache: false,
                contentType: false,
                processData: false,

                data: form_data,
                success: function(data) {
                    // console.log(data);
                    if (data.status == true) {
                        $('#a_pp_baru').show();
                        $.toast({
                            position: 'top-right',
                            heading: 'Success',
                            text: 'Berhasil Disimpan!',
                            icon: 'success',
                            loader: false
                        });
                        $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                        $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');
                        $('.spinner-border').css('display', 'none');
                        $('#simpan_pp').hide();
                        $('#simpan_pp').hide();
                        $('#update_pp').show();
                        $('#id_pp').val(data.idpp);
                        $('#hidden_refpp').val(data.norefpp);
                        $('#hidden_no_pp').val(data.nopp);
                        $('#txt_sudah_dibayar').val(data.sdh_bayar);
                        $('#hidden_sdh_bayar').val(data.sdh_bayar);
                        $('#batalpp').removeAttr('disabled');
                        $('#cetak').removeAttr('disabled');
                        var norefpo = data.norefpo;
                        sum_pp_bayar(norefpo)
                        // setTimeout(function() {
                        //     window.location.href = "<?php echo site_url('Pp'); ?>";
                        // }, 1000);
                    }

                },
                error: function(request) {
                    console.log('Error Save Data : ' + request.responseText);


                }
            });
        } else {

            console.log('id ada');
            var form_data = new FormData();

            form_data.append('id_pp', $('#id_pp').val());
            form_data.append('txt_no_ref_po', $('#txt_no_ref_po').val());
            form_data.append('hidden_refpp', $('#hidden_refpp').val());
            form_data.append('hidden_no_po', $('#hidden_no_po').val());
            form_data.append('hidden_grup', $('#hidden_grup').val());
            form_data.append('txt_tgl_pp', $('#txt_tgl_pp').val());
            form_data.append('txt_tgl_po', $('#txt_tgl_po').val());
            form_data.append('txt_pembayaran', $('#txt_pembayaran').val());
            form_data.append('kd_supplier', $('#kd_supplier').val());
            form_data.append('txt_supplier', $('#txt_supplier').val());
            form_data.append('txt_nilai_po', $('#txt_nilai_po').val());
            form_data.append('hidden_kurs', $('#hidden_kurs').val());
            form_data.append('txt_pajak', $('#txt_pajak').val());
            form_data.append('txt_nilai_bpo1', $('#txt_nilai_bpo1').val());
            form_data.append('txt_nilai_bpo2', $('#txt_nilai_bpo2').val());
            form_data.append('txt_total_po', $('#txt_total_po').val());
            form_data.append('txt_dibayar_ke', $('#txt_dibayar_ke').val());
            form_data.append('txt_jumlah', $('#txt_jumlah').val());
            form_data.append('jumlah', $('#jumlah').val());
            form_data.append('jumlahplus', $('#jumlahplus').val());
            form_data.append('txt_terbilang', $('#txt_terbilang').val());
            form_data.append('txt_keterangan', $('#txt_keterangan').val());
            form_data.append('txt_no_voucher', $('#txt_no_voucher').val());
            form_data.append('txt_tgl_voucher', $('#txt_tgl_voucher').val());
            form_data.append('txt_sudah_dibayar', $('#txt_sudah_dibayar').val());

            // console.log(form_data);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Pp/update_pp'); ?>",
                dataType: "JSON",
                beforeSend: function() {
                    $('#simpan_pp').append('&nbsp;<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>');
                },
                cache: false,
                contentType: false,
                processData: false,

                data: form_data,
                success: function(data) {
                    // console.log('status', data);
                    if (data.status == true) {
                        $('#a_pp_baru').show();
                        $.toast({
                            position: 'top-right',
                            heading: 'Success',
                            text: 'Berhasil Disimpan!',
                            icon: 'success',
                            loader: false
                        });

                        $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                        $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');
                        $('.spinner-border').css('display', 'none');
                        $('#simpan_pp').hide();
                        $('#cancelUpdate').hide();
                        $('#update_pp').show();
                        $('#id_pp').val(data.idpp);
                        $('#txt_sudah_dibayar').val(data.sdh_bayar);
                        $('#hidden_sdh_bayar').val(data.sdh_bayar);
                        $('#batalpp').removeAttr('disabled');
                        $('#cetak').removeAttr('disabled');
                        var norefpo = data.norefpo;
                        sum_pp_bayar(norefpo);
                        cancelUpdate();
                    } else {
                        $.toast({
                            position: 'top-right',
                            heading: 'Failed!',
                            text: 'Gagal Disimpan!',
                            icon: 'error',
                            loader: false
                        });
                        $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                        $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');
                        $('.spinner-border').css('display', 'none');
                        $('#simpan_pp').hide();
                        $('#cancelUpdate').hide();
                        $('#update_pp').show();
                        $('#id_pp').val(data.idpp);
                        $('#txt_sudah_dibayar').val(data.sdh_bayar);
                        $('#hidden_sdh_bayar').val(data.sdh_bayar);
                        $('#batalpp').removeAttr('disabled');
                        $('#cetak').removeAttr('disabled');
                        var norefpo = data.norefpo;
                        sum_pp_bayar(norefpo);
                        cancelUpdate();
                    }
                },
                error: function(request) {
                    console.log('Error Save Data : ' + request.responseText);
                }
            });
        }


    }


    function updateData() {
        $('.div_form_1').find('#txt_pembayaran, #txt_pajak, #txt_nilai_bpo1, #txt_nilai_bpo2, #txt_tgl_pp, #txt_jumlah, #txt_keterangan, #txt_no_voucher').removeClass('bg-light');
        $('.div_form_1').find('#txt_pembayaran, #txt_pajak, #txt_nilai_bpo1, #txt_nilai_bpo2, #txt_tgl_pp, #txt_jumlah, #txt_keterangan, #txt_no_voucher').removeAttr('disabled', '');
        $('#cancelUpdate').show();
        $('#simpan_pp').show();
        $('#simpan_pp').removeAttr('disabled');
        $('#update_pp').hide();
    }

    function tutup_modal() {
        $('#modalcariPO').modal('hide');
        scanner.stop();
    }

    function cancelUpdate() {

        var form_data = new FormData();
        form_data.append('id_pp', $('#id_pp').val());

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Pp/cancel_update_pp'); ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#cancelUpdate').append('&nbsp;<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>');
            },
            cache: false,
            contentType: false,
            processData: false,

            data: form_data,
            success: function(data) {
                // console.log(data[0]);
                $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');
                $('.spinner-border').css('display', 'none');
                $('#simpan_pp').hide();
                $('#cancelUpdate').hide();
                $('#update_pp').show();
                $('#id_pp').val(data[0].id);
                $('#txt_pembayaran').val(data[0].bayar);
                $('#txt_pajak').val(data[0].pajak);
                $('#txt_nilai_bpo2').val(data[0].jumlah_bpo);
                $('#txt_sudah_dibayar').val(data[0].kasir_bayar);
                $('#hidden_sdh_bayar').val(data[0].kasir_bayar);
                $('#txt_jumlah').val(data[0].jumlah);
                $('#txt_keterangan').val(data[0].ket);
                $('#hidden_refpp').val(data[0].ref_pp);
                $('#hidden_no_pp').val(data[0].nopp);
                var norefpo = data[0].ref_po;
                sum_pp_bayar(norefpo);

            },
            error: function(request) {
                console.log('Error Save Data : ' + request.responseText);
            }
        });
    }

    function dataPO() {
        $('#tableDataPO').DataTable().destroy();
        $('#tableDataPO').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('Pp/list_po') ?>",
                "type": "POST",
                "data": {}
            },
            "columnDefs ": [{
                "targets": [0],
                "orderable": false,

            }, ],
            "columns": [{
                    "width": "5%"
                },
                {
                    "width": "15%"
                },
                {
                    "width": "15%"
                },
                {
                    "width": "8%"
                },
                {
                    "width": "10%"
                },
                {
                    "width": "5%"
                },
                {
                    "width": "12%"
                },
                {
                    "width": "8%"
                },
                {
                    "width": "12%"
                },
                {
                    "width": "10%"
                },
                {
                    "width": "5%"
                },
            ],

            "lengthMenu": [
                [5, 10, 15, -1],
                [10, 15, 20, 25]
            ],
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
            "language": {
                "infoFiltered": ""
            }

        });


    }

    function pilih_pp(id_po, no_ref_po, no_po, jumlah) {
        // console.table({
        //     id_po: id_po,
        //     no_ref_po: no_ref_po,
        //     no_po: no_po,
        //     jumlah: jumlah
        // });

        if (jumlah == 0) {
            Swal.fire({
                text: "Saldo sudah 0!",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    tampilModal();
                    //
                }
            });
        } else {
            ambilPO(id_po, no_ref_po, no_po);

        }
    }

    function ambilPO(id_po, no_ref_po, nopo) {

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Pp/ambilpo'); ?>",
            dataType: "JSON",
            beforeSend: function() {

            },
            cache: false,
            data: {
                id: id_po,
                refpo: no_ref_po,
                nopo: nopo,
            },
            success: function(data) {
                // console.log(data.totalpo);
                var id_po = data.po.id;
                var tgl_po = data.tglpo;
                var no_ref_po = data.po.noreftxt;
                var no_po = data.po.nopo;
                var pembayaran = data.po.bayar;
                var kd_supply = data.po.kode_supply;
                var nama_supply = data.po.nama_supply;
                var kurs = data.kurs;
                var bayar = data.bayar;
                var saldo = data.saldo;
                var nilaipo = data.nilaipo;
                var pajak = data.pajak;
                var totalpo = data.totalpo;
                var tot = data.totalpo;
                var bpo = data.bpo;


                $('#hidden_id_po').val(id_po);
                $('#txt_tgl_po').val(tgl_po);

                $('#txt_no_ref_po').val(no_ref_po);
                $('#hidden_no_po').val(no_po);
                $('#txt_pembayaran').val(pembayaran);
                $('#kd_supplier').val(kd_supply);
                $('#txt_supplier').val(nama_supply);
                $('#txt_dibayar_ke').val(nama_supply);

                $('#txt_nilai_po').val(nilaipo);
                $('#hidden_nilai_po').val(nilaipo);
                $('#txt_pajak').val(pajak);
                $('#hidden_pajak').val(pajak);
                $('#txt_total_po').val(totalpo);
                $('#tot_po').val(tot);
                // var bpo = nilai_bpo.replace(/,/g, "");
                $('#txt_nilai_bpo2').val(bpo);
                $('#hidden_bpo2').val(bpo);
                $('#lbl_kurs').html(kurs);
                $('#hidden_kurs').val(kurs);

                $('#txt_sudah_dibayar').val(bayar);
                $('#hidden_sdh_bayar').val(bayar);
                $('#modalcariPO').modal('hide');

                sum_pp_bayar(no_ref_po)

                hitungTotalPO();
                setTimeout(function() {
                    scanner.stop();
                }, 1000);

            },
            error: function(request) {
                console.log(request.responseText);
            }
        });
    }


    function hitungTotalPO() {
        var nilai_po = $('#hidden_nilai_po').val();
        var pajak = $('#txt_pajak').val();
        var nilai_bpo1 = $('#txt_nilai_bpo1').val();
        var nilai_bpo2 = $('#txt_nilai_bpo2').val();
        var sudah_dibayar = $('#txt_sudah_dibayar').val();


        var total_po = parseFloat(nilai_po) + parseFloat(pajak) + parseFloat(nilai_bpo1) + parseFloat(nilai_bpo2);
        var sisabayar = (parseFloat(nilai_po) + parseFloat(pajak) + parseFloat(nilai_bpo1) + parseFloat(nilai_bpo2)) - parseFloat(sudah_dibayar);
        var tot_po = parseFloat(nilai_po) + parseFloat(pajak) + parseFloat(nilai_bpo1) + parseFloat(nilai_bpo2);
        var data = parseFloat(nilai_po) + parseFloat(nilai_bpo1) + parseFloat(nilai_bpo2);
        var data2 = parseFloat(data) * 2 / 100;
        // console.log('Dua persen dari nilai po + biayalain', data2);
        var hargaplus = parseFloat(tot_po) + parseFloat(data2);
        var jum = $('#jumlah').val();

        var jml = $('#txt_jumlah').val();
        $('#jumlahplus').val(hargaplus);

        $('#txt_total_po').val(total_po);
        $('#tot_po').val(total_po);
        $('#total_po').val(total_po);
        // console.log('total keseluruhan', pajak);
        $('#txt_jumlah').val(sisabayar);
        $('#hidden_jumlah').val(sisabayar);
        $('#jumlahplus').val(hargaplus);

        var kurs = $('#hidden_kurs').val();

        if (kurs == 'Rp') {
            var kur = ' Rupiah';
        } else if (kurs == 'USD') {
            var kur = ' Dolar';
        } else if (kurs == 'USD') {
            var kur = ' Singapore Dolar';
        } else if (kurs == 'Euro') {
            var kur = ' Euro';
        } else if (kurs == 'GBP') {
            var kur = ' Pound Sterling';
        } else if (kurs == 'Yen') {
            var kur = ' Yen';
        } else if (kurs == 'MYR') {
            var kur = ' Ringgit';
        }

        // $('#txt_terbilang').val(terbilang(hargaplus) + kur);
        $('#txt_terbilang').val(terbilang(sisabayar) + kur);

    }

    function hitung() {
        // var pajak = $('#txt_pajak').val();
        var hidden_pajak = $('#hidden_pajak').val();
        // var nilai_bpo1 = $('#txt_nilai_bpo1').val();
        var hidden_bpo1 = $('#hidden_bpo1').val();
        // var nilai_bpo2 = $('#txt_nilai_bpo2').val();
        var hidden_bpo2 = $('#hidden_bpo2').val();
        var jumlah = $('#hidden_jumlah').val();
        var jumlahplus = $('#jumlahplus').val();


        var nilai_po = $('#txt_nilai_po').val();
        var pajak = $('#txt_pajak').val();
        var nilai_bpo1 = $('#txt_nilai_bpo1').val();
        var nilai_bpo2 = $('#txt_nilai_bpo2').val();
        var sudah_dibayar = $('#txt_sudah_dibayar').val();

        var tot = parseFloat(nilai_po) + parseFloat(pajak) + parseFloat(nilai_bpo1) + parseFloat(nilai_bpo2);
        var hasil = parseFloat(tot) - parseFloat(sudah_dibayar);


        if (parseFloat(tot) > parseFloat(jumlahplus)) {
            $('#txt_pajak').val(hidden_pajak);
            $('#txt_nilai_bpo1').val(hidden_bpo1);
            $('#txt_nilai_bpo2').val(hidden_bpo2);
            $('#txt_jumlah').val(jumlah);
        } else {
            $('#txt_jumlah').val(hasil);
        }
    }

    function getTerbilang() {
        var nilai_po = $('#txt_nilai_po').val();
        var pajak = $('#txt_pajak').val();
        var nilai_bpo1 = $('#txt_nilai_bpo1').val();
        var nilai_bpo2 = $('#txt_nilai_bpo2').val();
        var sudah_dibayar = $('#txt_sudah_dibayar').val();
        var txt_total_po = $('#txt_total_po').val();

        var total_po = parseFloat(nilai_po) + parseFloat(pajak) + parseFloat(nilai_bpo1) + parseFloat(nilai_bpo2);
        // var total_po = addCommas(nStr);
        var sisabayar = (parseFloat(nilai_po) + parseFloat(pajak) + parseFloat(nilai_bpo1) + parseFloat(nilai_bpo2)) - parseFloat(sudah_dibayar);
        var tot_po = parseFloat(nilai_po) + parseFloat(pajak) + parseFloat(nilai_bpo1) + parseFloat(nilai_bpo2);
        var data = parseFloat(nilai_po) + parseFloat(nilai_bpo1) + parseFloat(nilai_bpo2);
        var data2 = parseFloat(data) * 2 / 100;
        var nilaitot = parseFloat(txt_total_po) + parseFloat(data2);
        // console.log('Dua persen dari nilai po + biayalain', data2);
        var hargaplus = parseFloat(tot_po) + parseFloat(data2);
        var jum = $('#jumlah').val();
        // var sisa = addCommas(sisabayar);

        var jml = $('#txt_jumlah').val();
        $('#jumlahplus').val(hargaplus);
        // var d = jml.split('.').join("");
        // // console.log("jumlah ", d);
        if (jml < 0) {
            $('#txt_jumlah').val(sisabayar);
            // console.log(hargaplus);
            // $('#jumlah').val(hargaplus); 
            // $('#txt_terbilang').val('');
        }

        var id_pp = $('#id_pp').val();
        if (!id_pp) {
            if (jml > hargaplus) {
                $('#txt_jumlah').val(sisabayar);
                // console.log(hargaplus);  
                // $('#jumlah').val();
                // $('#txt_terbilang').val('');
            }
        } else {


            if (jml > nilaitot) {

                $('#txt_jumlah').val(sisabayar);
            } else {
                console.log("OKE SIP");
            }
            // console.log(hargaplus);  

            // $('#txt_terbilang').val('');


        }

        var kurs = $('#hidden_kurs').val();

        if (kurs == 'Rp') {
            var kur = ' Rupiah';
        } else if (kurs == 'USD') {
            var kur = ' Dolar';
        } else if (kurs == 'USD') {
            var kur = ' Singapore Dolar';
        } else if (kurs == 'Euro') {
            var kur = ' Euro';
        } else if (kurs == 'GBP') {
            var kur = ' Pound Sterling';
        } else if (kurs == 'Yen') {
            var kur = ' Yen';
        } else if (kurs == 'MYR') {
            var kur = ' Ringgit';
        }

        $('#txt_terbilang').val(terbilang($('#txt_jumlah').val()) + kur);
    }

    function sum_pp_bayar(noref) {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Pp/sum_total_bayar') ?>",
            dataType: "JSON",

            beforeSend: function() {},

            data: {
                noref: noref
            },

            success: function(data) {
                // console.log(data);
                var tot = data.totalbayar;
                $('#jumlah').val(tot);
                validasipo(tot);
            },
            error: function(request) {
                alert("KONEKSI TERPUTUS!");
            }
        });
    }

    function validasipo(tot) {
        var id_po = $('#hidden_id_po').val();
        var no_pp = $('#hidden_no_pp').val();
        var nilaipo = $('#tot_po').val();
        var jumlahbayar = $('#txt_jumlah').val();
        var jumlahplus = $('#jumlahplus').val();
        var jumlah = tot;

        if (parseFloat(jumlah) == parseFloat(nilaipo)) {
            // console.log('1. update terbayar PO jadi 1');
            var terbayar = 1;

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Pp/update_terbayar_po') ?>",
                dataType: "JSON",

                beforeSend: function() {},

                data: {
                    id_po: id_po,
                    terbayar: terbayar,
                    no_pp: no_pp,
                },

                success: function(data) {
                    console.log(data);

                },
                error: function(request) {
                    alert("KONEKSI TERPUTUS!");
                }
            });
        } else if (parseFloat(jumlah) > parseFloat(nilaipo)) {
            console.log('2. update terbayar PO jadi 1');
            var terbayar = 1;

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Pp/update_terbayar_po') ?>",
                dataType: "JSON",

                beforeSend: function() {},

                data: {
                    id_po: id_po,
                    terbayar: terbayar,
                    no_pp: no_pp,
                },

                success: function(data) {
                    console.log(data);

                },
                error: function(request) {
                    alert("KONEKSI TERPUTUS!");
                }
            });
        } else if (jumlah == jumlahplus) {
            console.log('3. update terbayar PO jadi 1');
            var terbayar = 1;

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Pp/update_terbayar_po') ?>",
                dataType: "JSON",

                beforeSend: function() {},

                data: {
                    id_po: id_po,
                    terbayar: terbayar,
                    no_pp: no_pp,
                },

                success: function(data) {
                    console.log(data);

                },
                error: function(request) {
                    alert("KONEKSI TERPUTUS!");
                }
            });
        } else {
            console.log('4. update terbayar PO jadi 0');
            var terbayar = 0;

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Pp/update_terbayar_po') ?>",
                dataType: "JSON",

                beforeSend: function() {},

                data: {
                    id_po: id_po,
                    terbayar: terbayar,
                    no_pp: no_pp,
                },

                success: function(data) {
                    console.log(data);

                },
                error: function(request) {
                    alert("KONEKSI TERPUTUS!");
                }
            });
        }
    }

    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    function dateToMDY(date) {
        var d = date.getDate();
        var m = date.getMonth() + 1;
        var y = date.getFullYear();
        // return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
        return (m <= 9 ? '0' + m : m) + '/' + (d <= 9 ? '0' + d : d) + '/' + y;
    }
</script>