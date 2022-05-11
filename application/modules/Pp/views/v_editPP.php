<div class="container-fluid">
    <!-- start row-->
    <div class="row mt-0">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2 justify-content-between">
                        <h4 class="header-title ml-2"><?= $title; ?></h4>
                        <div class="button-list mr-2">
                            <button class="btn btn-xs btn-info" id="data_pp" onclick="data_pp()">Data PP</button>
                            <!-- <button type="button" onclick="saveData()" class="btn btn-xs btn-primary" id="update">Update</button> -->
                            <button type="button" onclick="new_pp()" class="btn btn-xs btn-success" id="pp_baru">PP Baru</button>
                            <button type="button" onclick="batal()" class="btn btn-xs btn-danger" id="batalpp">Batal PP</button>
                            <button type="button" class="btn btn-xs btn-primary" id="cetak" onclick="cetak()">Cetak</button>
                            <button type="button" onclick="goBack()" class="btn btn-xs btn-secondary" id="kembali">Kembali</button>
                        </div>
                    </div>
                    <!-- <form action="javascript:;" class="form-horizontal" id="form_input_pp" name="form_input_pp" method="POST"> -->
                    <div class="row div_form_1">
                        <div class="col-lg-4 col-xl-4 col-12">
                            <input type="hidden" name="id_pp" id="id_pp">
                            <input type="hidden" id="hidden_no_pp" name="hidden_no_pp">
                            <input type="hidden" id="hidden_refpp" name="hidden_refpp">
                            <input type="hidden" id="hidden_id_po" name="hidden_id_po">
                            <!-- <input type="hidden" id="hidden_no_po" name="hidden_no_po"> -->
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="txt_no_ref_po" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Ref&nbsp;PO&nbsp;
                                </label>
                                <div class="col-9 col-xl-12">
                                    <input id="txt_no_ref_po" name="txt_no_ref_po" class="form-control form-control-sm bg-light" required="required" type="text" placeholder="No. Ref. PO" readonly>
                                    <!-- <input id="txt_no_ref_po" name="txt_no_ref_po" class="form-control form-control-sm" required="required" type="text" placeholder="No. Ref. PO" onfocus="tampilModal()"> -->
                                    <input type="hidden" id="hidden_no_po" name="hidden_no_po">
                                    <input type="hidden" id="hidden_grup" name="hidden_grup">
                                    <input type="hidden" id="hidden_no_ref_po" name="hidden_no_ref_po">

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
                                    <input id="txt_nilai_po" name="txt_nilai_po" class="form-control form-control-sm bg-light" required="required" type="text" placeholder="Nilai PO" onkeyup="hitungTotalPO()" value="0" readonly="">
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
                                    <input id="txt_sudah_dibayar" name="txt_sudah_dibayar" class="form-control form-control-sm autonumber bg-light" required="required" type="text" placeholder="Sudah dibayar" readonly="">
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
                                <label for="txt_tgl_pp" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
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
                                    <textarea class="form-control form-control-sm" id="txt_keterangan" name="txt_keterangan" placeholder="Keterangan" rows="2" required="required"></textarea>
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
                                <button type="button" onclick="saveData()" class="btn btn-xs btn-primary" style="display: none;" id="simpan_pp">Simpan</button>
                                <button type="button" onclick="updateData()" class="btn btn-xs btn-warning" id="update_pp">Update</button>
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
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#home" at="po" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                PO
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#scanqr" at="qr" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                Scan QRcode
                            </a>
                        </li>

                    </ul>
                    <label class="btn btn-info active btn-xs ml-4" id="kamera1" style="display: none;">
                        <input type="radio" name="putar_camera" value="1" autocomplete="off" checked> Front Camera
                    </label>
                    <label class="btn btn-secondary btn-xs" id="kamera2" style="display: none;">
                        <input type="radio" name="putar_camera" value="2" autocomplete="off"> Back Camera
                    </label>
                </div>
                <div class="modal-body">

                    <div id="listpo" style="display: block;">
                        <div class="table-responsive">
                            <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                            <table id="tableDataPO" class="table table-striped table-bordered" style="width: 100%; border-collapse: separate; padding: 0 50px 0 50px;">
                                <thead>
                                    <tr>
                                        <th style="font-size: 12px; padding:10px">Tgl</th>
                                        <th style="font-size: 12px; padding:10px">No. Ref. PO</th>
                                        <th style="font-size: 12px; padding:10px">No PO</th>
                                        <th style="font-size: 12px; padding:10px">Kd Supplier</th>
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
                    <div id="camera" style="display: none;">
                        <video id="preview" width="100%"></video>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" id="modalKonfirmasiHapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-warning h1 text-warning"></i>
                        <h4 class="mt-2">Konfirmasi Batal</h4>
                        <input type="hidden" id="idpp" name="idpp">
                        <input type="hidden" id="nopp" name="nopp">
                        <input type="hidden" id="ref_po" name="ref_po">
                        <input type="hidden" id="jumlahbatal" name="jumlahbatal">
                        <input type="hidden" id="nopo" name="nopo">
                        <p class="mt-3">Apakah anda yakin ingin membatalkan data ini ???</p>
                        <button type="button" class="btn btn-warning my-2" data-dismiss="modal" id="btn_delete" onclick="hapusPP()">Batalkan</button>
                        <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="alasanbatal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-warning h1 text-warning"></i>
                        <h4 class="mt-2">Alasan Batal</h4>
                        <input type="hidden" id="idpp" name="idpp">
                        <input type="hidden" id="nopp" name="nopp">
                        <input type="hidden" id="ref_po" name="ref_po">
                        <input type="hidden" id="jumlahbatal" name="jumlahbatal">
                        <input type="hidden" id="nopo" name="nopo">
                        <textarea class="form-control" id="alasan" rows="4" required></textarea>
                        <button type="button" class="btn btn-warning my-2" id="btn_delete" onclick="validasibatal()">Batalkan</button>
                        <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
<style>
    table#tableDataPO td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
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

    function goBack() {
        window.history.back();
    }

    function cetak() {
        var id_po = '<?php echo $this->uri->segment('3'); ?>';
        var noref = '<?php echo $this->uri->segment('4'); ?>';
        // var noref = $('#hidden_no_ref_po').val();
        // var ref = noref.replace('/', '.');

        window.open('<?= base_url() ?>Pp/cetak/' + noref + '/' + id_po, '_blank');
    }

    function batal() {
        // alert("Dalam proses perbaikan")

        var id = $('#id_pp').val();
        var nopp = $('#hidden_no_pp').val();
        var jumlah = $('#txt_jumlah').val();
        var nopo = $('#hidden_no_po').val();
        console.log(jumlah);

        $('#idpp').val(id);
        $('#nopp').val(nopp);
        // $('#ref_po').val(ref_po);
        $('#jumlahbatal').val(jumlah);
        $('#nopo').val(nopo);
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


    function hapusPP() {
        // listPP();

        $('#alasanbatal').modal('hide');
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
                nopo: $('#nopo').val(),
                alasan: $('#alasan').val(),
            },
            success: function(data) {
                console.log(data)
                $.toast({
                    position: 'top-right',
                    heading: 'Dibatalkan',
                    text: 'Berhasil Dibatalkan!',
                    icon: 'success',
                    loader: false
                });

                setTimeout(function() {
                    window.location.href = "<?php echo site_url('Pp'); ?>";
                }, 1000);
            },
            error: function(request) {
                console.log('Error Save Data : ' + request.responseText);
            }
        });
    }


    function updateData() {
        $('.div_form_1').find('#txt_pembayaran, #txt_pajak, #txt_nilai_bpo1, #txt_nilai_bpo2, #txt_tgl_pp, #txt_jumlah, #txt_keterangan, #txt_no_voucher').removeClass('bg-light');
        $('.div_form_1').find('#txt_pembayaran, #txt_pajak, #txt_nilai_bpo1, #txt_nilai_bpo2, #txt_tgl_pp, #txt_jumlah, #txt_keterangan, #txt_no_voucher').removeAttr('disabled', '');
        $('#cancelUpdate').show();
        $('#simpan_pp').show();
        $('#simpan_pp').removeAttr('disabled');
        $('#update_pp').hide();
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

    $(document).ready(function() {
        $('.div_form_1').find('input,textarea,select').attr('disabled', '');
        $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');
        $('#txt_pajak,#txt_nilai_bpo1,#txt_nilai_bpo2').number(true, 2);
        $('#txt_nilai_po,#txt_total_po,#txt_sudah_dibayar,#txt_jumlah').number(true, 2);


        $(".nav-link").click(function() {
            $(".nav-link").removeClass("active");
            $(this).addClass("active");
            var jenis = $(this).attr('at');
            if (jenis != 'po') {
                // scanner.start();
                $('#preview').show();
                $(".modal-dialog").removeClass("modal-full-width");
                $(".modal-dialog").addClass("modal-md");
                $("#judulpo").css('display', 'none');
                $("#judulqr").css('display', 'block');
                $("#listpo").css('display', 'none');
                $("#camera").css('display', 'block');
                $("#kamera1").css('display', 'block');
                $("#kamera2").css('display', 'block');
            } else {
                $('#preview').hide();
                // scanner.stop();
                $(".modal-dialog").removeClass("modal-md");
                $(".modal-dialog").addClass("modal-full-width");
                $("#judulpo").css('display', 'block');
                $("#judulqr").css('display', 'none');
                $("#camera").css('display', 'none');
                $("#listpo").css('display', 'block');
                $("#kamera1").css('display', 'none');
                $("#kamera2").css('display', 'none');
            }
        });
        var id = '<?php echo $this->uri->segment('3'); ?>';

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Pp/get_data_pp'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            // contentType : false,
            // processData : false,

            data: {
                'id': id
            },
            success: function(data) {
                // console.log(data);
                if (data.tglpp === null) {
                    var tgl_pp = "";
                } else {
                    var tgl_pp = dateToMDY(new Date(data.data_pp.tglpp));
                }

                if (data.data_pp.tglpo === null) {
                    var tglpo = "";
                } else {
                    var tgl_po = dateToMDY(new Date(data.data_pp.tglpo));
                }

                if (data.data_pp.tgl_vou === null) {
                    var tgl_voucher = "";
                } else {
                    var tgl_voucher = dateToMDY(new Date(data.data_pp.tgl_vou));
                }

                var refpo = data.data_pp.ref_po;

                $('#lbl_no_pp').html(data.data_pp.nopptxt);
                $('#lbl_kurs').html(data.data_pp.KURS);

                $('#hidden_no_pp').val(data.data_pp.nopptxt);
                $('#id_pp').val(data.data_pp.id);
                $('#hidden_refpp').val(data.data_pp.ref_pp);
                $('#hidden_id_po').val(data.data_po.noreftxt);
                $('#txt_no_ref_po').val(data.data_pp.ref_po);
                $('#hidden_no_ref_po').val(data.data_pp.ref_po);
                $('#hidden_no_po').val(data.data_pp.nopotxt);
                $('#hidden_grup').val(data.data_pp.grup);
                $('#txt_tgl_pp').val(tgl_pp);
                $('#txt_tgl_po').val(tgl_po);
                $('#txt_pembayaran').val(data.data_pp.bayar);
                $('#kd_supplier').val(data.data_pp.kode_supplytxt);
                $('#txt_supplier').val(data.data_pp.nama_supply);
                $('#txt_nilai_po').val(data.data_pp.jumlahpo);
                $('#hidden_nilai_po').val(data.data_pp.jumlahpo);
                $('#hidden_kurs').val(data.data_pp.KURS);
                $('#txt_pajak').val(data.data_pp.pajak);
                $('#hidden_pajak').val(data.data_pp.pajak);
                $('#txt_nilai_bpo1').val(data.data_pp.KODE_BPO);
                $('#hidden_bpo1').val(data.data_pp.KODE_BPO);
                $('#txt_nilai_bpo2').val(data.data_pp.jumlah_bpo);
                $('#hidden_bpo2').val(data.data_pp.jumlah_bpo);
                $('#txt_total_po').val(data.data_pp.total_po);
                $('#tot_po').val(data.data_pp.total_po);
                $('#txt_sudah_dibayar').val(data.sudah_bayar);
                $('#hidden_sdh_bayar').val(data.sudah_bayar);
                $('#txt_dibayar_ke').val(data.data_pp.kepada);
                $('#txt_jumlah').val(data.data_pp.jumlah);
                $('#hidden_jumlah').val(data.data_pp.jumlah);
                $('#txt_terbilang').val(data.data_pp.terbilang);
                $('#txt_keterangan').val(data.data_pp.ket);
                $('#hidden_main_account').val(data.data_pp.main_account);
                $('#hidden_nama_account').val(data.data_pp.hidden_main_account);
                $('#txt_no_voucher').val(data.data_pp.no_voutxt);
                $('#txt_tgl_voucher').val(tgl_voucher);

                var tot_po = parseFloat(data.data_pp.jumlahpo) + parseFloat(data.data_pp.pajak) + parseFloat(data.data_pp.KODE_BPO) + parseFloat(data.data_pp.jumlah_bpo);
                var data = parseFloat(data.data_pp.jumlahpo) + parseFloat(data.data_pp.KODE_BPO) + parseFloat(data.data_pp.jumlah_bpo);
                var data2 = parseFloat(data) * 2 / 100;
                // console.log('Dua persen dari nilai po + biayalain', data2);
                var hargaplus = parseFloat(tot_po) + parseFloat(data2);
                $('#jumlahplus').val(hargaplus);

                sum_pp_bayar(refpo);
                // hitungTotalPO();
            },
            error: function(request) {
                alert('Error Save Data : ' + request.responseText);

                // $('#lbl_status_simpan_'+no).empty();
                // $('#lbl_status_simpan_'+no).append('<label style="color:#ff0000;"><i class="fa fa-close" style="color:#ff0000;"></i> Gagal Tersimpan !</label>');

                // if($.trim($('#hidden_no_bkb').val()) == ''){
                //   $('#lbl_spp_status').empty();
                //   $('#lbl_spp_status').append('<label style="color:#ff0000;"><i class="fa fa-close" style="color:#ff0000;"></i> Gagal Generate !</label>');
                // }
            }
        });

        $('#txt_tgl_pp,#txt_tgl_po,#txt_tgl_voucher').daterangepicker({
            singleDatePicker: !0,
            singleClasses: "picker_1"
        }, function(start, end, label) {
            // start.format('YYYY-MM-DD')
        });


    });


    function tampilModal() {
        $('#modalcariPO').modal('show');
        dataPO();
    }

    function dataPO() {
        $('#tableDataPO').DataTable().destroy();
        $('#tableDataPO').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "select": true,
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {},
            "ajax": {
                "url": "<?php echo site_url('Pp/list_po') ?>",
                "type": "POST",
                "data": {}
            },
            "columnDefs ": [{
                "targets": [0],
                "orderable": false,

            }, ],

            "lengthMenu": [
                [5, 10, 15, -1],
                [10, 15, 20, 25]
            ],
            "aoColumnDefs": [{
                "bSearchable": false,
                "bVisible": false,
                "aTargets": [2, 3]
            }, ],

        });

        $('#tableDataPO tbody').on('click', 'tr', function() {
            var dataClick = $('#tableDataPO').DataTable().row(this).data();
            var tgl_po = new Date(dataClick[0]);
            var no_ref_po = dataClick[1];
            var no_po = dataClick[2];
            var kd_supplier = dataClick[3];
            var nama_supplier = dataClick[4];
            var bayar = dataClick[5];
            var nilai_po = dataClick[6];
            var nilai_bpo = dataClick[7];
            var sudah_dibayar = dataClick[8];
            var kurs = dataClick[10];

            // $('#txt_tgl_po').val(tgl_po);
            var tgl = dateToMDY(tgl_po);
            // console.log(d);
            $('#txt_tgl_po').val(tgl);

            $('#txt_no_ref_po').val(no_ref_po);
            $('#hidden_no_po').val(no_po);
            $('#txt_pembayaran').val(bayar);
            $('#kd_supplier').val(kd_supplier);
            $('#txt_supplier').val(nama_supplier);
            $('#txt_dibayar_ke').val(nama_supplier);

            $('#txt_nilai_po').val(nilai_po);
            var bpo = nilai_bpo.replace(/,/g, "");
            $('#txt_nilai_bpo2').val(bpo);
            $('#lbl_kurs').html(kurs);
            $('#hidden_kurs').val(kurs);

            $('#txt_sudah_dibayar').val(sudah_dibayar);

            $('#modalcariPO').modal('hide');
            sum_pp_bayar(no_ref_po)
            hitungTotalPO();
        });
    }


    function dateToMDY(date) {
        var d = date.getDate();
        var m = date.getMonth() + 1;
        var y = date.getFullYear();
        return (m <= 9 ? '0' + m : m) + '/' + (d <= 9 ? '0' + d : d) + '/' + y;
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
        var nilaipo = $('#tot_po').val();
        var jumlahbayar = $('#txt_jumlah').val();
        var jumlahplus = $('#jumlahplus').val();
        var jumlah = tot;

        if (parseFloat(jumlah) == parseFloat(nilaipo)) {
            console.log('1. update terbayar PO jadi 1');
            var terbayar = 1;

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Pp/update_terbayar_po') ?>",
                dataType: "JSON",

                beforeSend: function() {},

                data: {
                    id_po: id_po,
                    terbayar: terbayar
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
                    terbayar: terbayar
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
                    terbayar: terbayar
                },

                success: function(data) {
                    console.log(data);

                },
                error: function(request) {
                    alert("KONEKSI TERPUTUS!");
                }
            });
        } else {
            // console.log('4. update terbayar PO jadi 0');
            var terbayar = 0;

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Pp/update_terbayar_po') ?>",
                dataType: "JSON",

                beforeSend: function() {},

                data: {
                    id_po: id_po,
                    terbayar: terbayar
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
        var old_jml = $('#hidden_jumlah').val();
        $('#jumlahplus').val(hargaplus);
        // var d = jml.split('.').join("");
        // // console.log("jumlah ", d);
        if (jml < 0) {
            $('#txt_jumlah').val(sisabayar);
            // console.log(hargaplus);
            // $('#jumlah').val(hargaplus); 
            // $('#txt_terbilang').val('');
        }

        console.log("nilai tot", nilaitot);

        if (jml > nilaitot) {

            $('#txt_jumlah').val(old_jml);
        } else {
            console.log("OKE SIP");
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


    $("#form_input_pp").validate({
        ignore: [],
        submitHandler: function(form) {
            saveData();
        }
    });

    function saveData() {
        $('#update').attr('disabled', '');
        var form_data = new FormData();

        var id = '<?php echo $this->uri->segment('3'); ?>';

        form_data.append('id_pp', id);
        form_data.append('hidden_refpp', $('#hidden_refpp').val());
        form_data.append('txt_no_ref_po', $('#txt_no_ref_po').val());
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
                $('#update').append('&nbsp;<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>');
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

                    // setTimeout(function() {
                    //     window.location.href = "<?php echo site_url('Pp'); ?>";
                    // }, 1000);
                    $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                    $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');
                    $('.spinner-border').css('display', 'none');
                    $('#simpan_pp').hide();
                    $('#cancelUpdate').hide();
                    $('#update_pp').show();
                    $('#id_pp').val(data.idpp);
                    $('#txt_sudah_dibayar').val(data.sdh_bayar);
                    $('#hidden_sdh_bayar').val(data.sdh_bayar);
                    // $('#batalpp').removeAttr('disabled');
                    // $('#cetak').removeAttr('disabled');
                    var norefpo = data.norefpo;
                    sum_pp_bayar(norefpo);
                    cancelUpdate();
                }
            },
            error: function(request) {
                alert('Error Save Data : ' + request.responseText);

            }
        });
    }
</script>