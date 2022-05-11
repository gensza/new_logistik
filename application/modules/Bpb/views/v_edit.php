<div class="container-fluid">

    <div class="row mt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="row justify-content-between">
                        <h4 class="header-title">
                            BPB <i>(Edit)</i>
                        </h4>
                        <div class="button-list mr-2">

                            <button onclick="new_bpb()" class="btn btn-xs btn-success" id="a_po_baru">BPB Baru</button>
                            <button onclick="alasanbatal()" class="btn btn-xs btn-danger" id="batalBPB">Batal BPB</button>
                            <button class="btn btn-xs btn-primary" id="cetak" onclick="cetak()">Cetak</button>
                            <button onclick="goBack()" class="btn btn-xs btn-secondary" id="kembali">Kembali</button>
                        </div>
                    </div>
                    <div class="row">

                        <p class="sub-header" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
                            Edit Bon Permintaan Barang
                        </p>
                    </div>


                    <!-- <div class="row div_form_1">
                                <div class="col-md-4">
                                    <div class="form-group row mb-1">
        
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Tgl&nbsp;BPB
                                        </label>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
                                            <input id="txt_tgl_bpb" name="txt_tgl_bpb" class="form-control" style="font-family: Verdana, Geneva, Tahoma, sans-serif;" required="required" type="date" value="<?= date('Y-m-d') ?>" autocomplite="off">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Untuk keperluan
                                        </label>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
                                            <textarea class="resizable_textarea form-control" rows="1" id="txt_untuk_keperluan" name="txt_untuk_keperluan" placeholder="Untuk keperluan" required="" autocomplite="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row mb-1">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Bagian
                                        </label>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
                                            <select class="form-control" id="cmb_bagian" name="cmb_bagian" required="" onchange="cek_tm_tbm(1)">
                                                <option disabled selected style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">--Pilih --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Bahan Bakar
                                        </label>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
                                            <select class="form-control bg-light" id="bhnbakar" name="bhnbakar" disabled>
                                                <option disabled selected style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">--Pilih --</option>
                                                <option value="BBM">BBM</option>
                                                <option value="NONBBM">NON BBM</option>
                                            </select>
                                        </div>
                                    </div>
        
                                    <div class="form-group row mb-1">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Alokasi Estate
                                        </label>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
                                            <select class="form-control bg-light" id="cmb_alokasi_est" name="cmb_alokasi_est" disabled>
                                                <option disabled selected style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">-- Pilih --</option>
                                                <option value="03">03</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                            </select>
                                            <div id="txt_estate"></div>
                                        </div>
                                    </div>
                                </div>
                                &nbsp;
                                <div class="col-md-3" id="databbm">
                                    <div class="form-group row mb-1">
        
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Jenis&nbsp;Alat/Kend
                                        </label>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
                                            <input id="txt_jns_alat" name="txt_jns_alat" class="form-control form-control-sm bg-light" style="font-family: Verdana, Geneva, Tahoma, sans-serif;" required="required" value="" placeholder="" autocomplite="off" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
        
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Kode/Nomor
                                        </label>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
                                            <input id="txt_kd_nmr" name="txt_kd_nmr" class="form-control form-control-sm bg-light" style="font-family: Verdana, Geneva, Tahoma, sans-serif;" required="required" value="" placeholder="" autocomplite="off" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
        
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">HM/KM
                                        </label>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
                                            <input id="txt_hm_km" name="txt_hm_km" class="form-control form-control-sm bg-light" style="font-family: Verdana, Geneva, Tahoma, sans-serif;" required="required" value="" placeholder="" autocomplite="off" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-1">
        
                                        <label class="control-label col-md-4 col-sm-3 col-xs-12" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Lokasi&nbsp;Kerja
                                        </label>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-7">
                                            <input id="txt_lokasi_kerja" name="txt_lokasi_kerja" class="form-control form-control-sm bg-light" style="font-family: Verdana, Geneva, Tahoma, sans-serif;" required="required" value="" placeholder="" autocomplite="off" disabled>
                                        </div>
                                    </div>
                                </div>
        
        
                            </div> -->

                    <hr style="margin-top: -15px;">
                    <div class="row div_form_2" style="margin-top: -25px;">
                        <div class="sub-header" style="margin-top: -15px; margin-bottom: -25px;">
                            <input type="hidden" id="hidden_bagian">
                            <input type="hidden" id="hidden_mutasi_pt">
                            <input type="hidden" id="hidden_mutasi_lokal">
                            <input type="hidden" id="hidden_no_bpb" name="hidden_no_bpb">
                            <input type="hidden" id="hidden_no_ref_bpb" name="hidden_no_ref_bpb">
                            <input type="hidden" id="hidden_id_bpb" name="hidden_id_bpb">
                            <input type="hidden" id="hidden_kode_dev" name="hidden_kode_dev">
                        </div>
                        <div class="row" style="margin-left:4px;">
                            <label id="lbl_bpb_status" name="lbl_bpb_status">No. Ref. BPB : ...</label>
                            <!-- <h6 id="h4_no_bpb" name="h4_no_bpb"></h6>&nbsp;&nbsp; -->
                            <h6 id="h4_no_ref_bpb" name="h4_no_ref_bpb"></h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-in" id="tableRinciBPB">
                                <thead>
                                    <tr>
                                        <!-- <th width="3%"></th> -->
                                        <th width="10%">TM/TBM</th>
                                        <th width="10%">Afd/Unit</th>
                                        <th width="8%">Blok/Sub</th>
                                        <th width="10%">Thn Tanam</th>
                                        <th width="20%">Bahan</th>
                                        <th width="15%">Account Beban</th>
                                        <th width="15%">Barang/Satuan</th>
                                        <th width="20%">Stok/Booking</th>
                                        <th width="25%">Qty&nbsp;Diminta</th>
                                        <!-- <th width="8%">Qty Disetujui</th> -->
                                        <th width="25%">Keterangan</th>
                                        <th width="3%"></th>
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
    </div> <!-- end row-->

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalAccBeban">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Account Beban</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="table-responsive">
                            <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                            <table id="tableAccBeban" class="table table-striped table-bordered table-in" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            No.
                                        </th>
                                        <th>
                                            No.&nbsp;COA
                                        </th>
                                        <th>
                                            Nama&nbsp;Account
                                        </th>
                                        <th>
                                            Type
                                        </th>
                                        <th>
                                            Grup
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalListBarang">
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
                                <input type="hidden" id="hidden_no_row_barang" name="hidden_no_row_barang">
                                <table id="tableListBarang" class="table table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Grup</th>
                                            <th>Satuan</th>
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

    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="modalPilihEstate">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Kebun</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Pilih Kebun</label>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="cmb_pilih_est"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="pilihEST()">Pilih</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalKonfirmasiHapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-warning h1 text-warning"></i>
                        <h4 class="mt-2">Konfirmasi Hapus</h4>
                        <input type="" id="hidden_no_delete" name="hidden_no_delete">
                        <p class="mt-3">Apakah Anda yakin ingin menghapus data ini ???</p>
                        <button type="button" class="btn btn-warning my-2" data-dismiss="modal" id="btn_delete" onclick="deleteData()">Hapus</button>
                        <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Batal</button>
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

</div>

<style>
    table#tableRinciBPB th {
        padding: 10px;
        font-size: 12px;
        padding-left: 17px;
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
<input type="hidden" id="hidden_no_table" name="hidden_no_table">
<script>
    function new_bpb() {
        location.href = "<?php echo base_url('Bpb/input') ?>";
    }

    function alasanbatal() {

        $('#alasanbatal').modal('show');
    }

    function cetak() {
        var no_bpb = $('#hidden_no_bpb').val();
        var id_bpb = $('#hidden_id_bpb').val();


        window.open('<?= base_url() ?>Bpb/cetak/' + no_bpb + '/' + id_bpb, '_blank');
        // window.open('cetak/' + no_bpb + '/' + id_bpb, '_blank');
    }

    function goBack() {
        window.history.back();
    }
    $(document).ready(function() {
        var id = <?php echo $this->uri->segment(4) ?>;
        var no_bpb = <?php echo $this->uri->segment(3) ?>;
        $('.div_form_1').find('#txt_tgl_bpb, #txt_untuk_keperluan,#cmb_bagian,#bbm,#nonbbm,#cmb_alokasi_est').attr('disabled', '');
        $('.div_form_1').find('#txt_tgl_bpb, #txt_untuk_keperluan,#cmb_bagian,#cmb_alokasi_est').addClass('form-control bg-light');

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/get_edit_bpb'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            // contentType : false,
            // processData : false,

            data: {
                'id': id,
                'no_bpb': no_bpb
            },
            success: function(data) {

                $('#hidden_kode_dev').val(data.data_bpb.kode_dev);

                $('#lbl_bpb_status').empty();
                $('#h4_no_bpb').html('No. BPB : ' + data.data_bpb.nobpb);
                $('#h4_no_ref_bpb').html('No. Ref BPB : ' + data.data_bpb.norefbpb);
                $('#hidden_no_ref_bpb').val(data.data_bpb.norefbpb);
                $('#hidden_id_bpb').val(data.data_bpb.id);
                $('#hidden_no_bpb').val(data.data_bpb.nobpb);
                $('#hidden_no_table').val(1);
                var mutasi = data.data_bpb.status_mutasi;

                if (mutasi == 1) {
                    $('#hidden_mutasi_pt').val('mutasi_pt');
                } else if (mutasi == 2) {
                    $('#hidden_mutasi_lokal').val('mutasi_lokal');

                }

                $('#hidden_bagian').val(data.data_bpb.bag);

                var i = 0;

                $.each(data.data_bpbitem, function(index) {
                    console.log(data);
                    // var n = 1+index;
                    var n = $('#hidden_no_table').val();

                    var tr_buka = '<tr id="tr_' + n + '">';
                    var td_col_1 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0;">' +
                        '<input type="hidden" id="hidden_proses_status_' + n + '" name="hidden_proses_status_' + n + '" value="insert">' +
                        '<button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" id="btn_tambah_row" name="btn_tambah_row" onclick="tambah_row(' + n + ')"></button><br />' +
                        '<button class="btn btn-xs btn-danger fa fa-minus btn_hapus_row" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row_' + n + '" name="btn_hapus_row" onclick="hapus_row(' + n + ')"></button>' +
                        '</td>';
                    var form_buka = '<form id="form_rinci_' + n + '" name="form_rinci_' + n + '" method="POST" action="javascript:;">';
                    var td_col_2 = '<td style="padding-right: 0.2em; padding-left: 0.2em; padding-top: 2px; padding-bottom: 0.1em;">' +
                        '<!-- TM/TBM -->' +
                        '<select class="form-control form-control-sm set_strip_cmb cmb_tm_tbm" id="cmb_tm_tbm_' + n + '" name="cmb_tm_tbm_' + n + '" onchange="cmb_afd_unit_ganti(' + n + ')" disabled>' +
                        '</select>' +
                        '</td>';
                    var td_col_3 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                        '<!-- AFD/UNIT -->' +
                        '<select class="form-control form-control-sm set_strip_cmb" id="cmb_afd_unit_' + n + '" name="cmb_afd_unit_' + n + '" onchange="cmb_blok_sub_ganti(' + n + ')">' +
                        '<option value="-">-</option>' +
                        '</select>' +
                        '</td>';
                    var td_col_4 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                        '<!-- BLOK/SUB -->' +
                        '<select class="form-control form-control-sm set_strip_cmb" id="cmb_blok_sub_' + n + '" name="cmb_blok_sub_' + n + '" onchange="cmb_tahun_tanam_ganti(' + n + ')">' +
                        '</select>' +
                        '</td>';
                    var td_col_5 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                        '<!-- Tahun Tanam -->' +
                        '<select class="form-control form-control-sm set_strip_cmb" id="cmb_tahun_tanam_' + n + '" name="cmb_tahun_tanam_' + n + '">' +
                        '<option value="-">-</option>' +
                        '</select>' +
                        '</td>';
                    var td_col_6 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                        '<!-- Bahan -->' +
                        '<select class="form-control form-control-sm set_strip_cmb" id="cmb_bahan_' + n + '" name="cmb_bahan_' + n + '">' +
                        '<option value="-">-</option>' +
                        '</select>' +
                        '</td>';
                    var td_col_7 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                        '<!-- Account Beban -->' +
                        '<input type="text" class="form-control form-control-sm" id="txt_account_beban_' + n + '" value="-" name="txt_account_beban_' + n + '" placeholder="Account Beban" onfocus="pilihModalAccBeban(' + n + ')" >' +
                        '<input type="hidden" id="hidden_no_acc_' + n + '" name="hidden_no_acc_' + n + '" value="0">' +
                        '<input type="hidden" id="hidden_nama_acc_' + n + '" name="hidden_nama_acc_' + n + '" value="0">' +
                        '</td>';
                    var td_col_8 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0;">' +
                        '<!-- Barang -->' +
                        '<input type="text" class="form-control form-control-sm" id="txt_barang_' + n + '" name="txt_barang_' + n + '" onfocus="cari_barang(' + n + ')" placeholder="Barang">' +
                        '<input type="hidden" id="hidden_kode_barang_' + n + '" name="hidden_kode_barang_' + n + '" value="0">' +
                        '<input type="hidden" id="hidden_nama_barang_' + n + '" name="hidden_nama_barang_' + n + '" value="0">' +
                        '<input type="hidden" id="hidden_grup_barang_' + n + '" name="hidden_grup_barang_' + n + '" value="0">' +
                        '<input type="hidden" id="hidden_txtperiode_' + n + '" name="hidden_txtperiode_' + n + '">' +
                        '</td>';
                    var td_col_10 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0;">' +

                        '<span class="small text-muted" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Stok :<b id="b_stok_tgl_ini_' + n + '" name="b_stok_tgl_ini_' + n + '"></b></span><br>' +
                        '<span class="small text-muted" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Booking :<b id="b_stok_booking_' + n + '"  name="b_stok_booking_' + n + '"></b></span>' +
                        '<input type="hidden" id="hidden_stok_tgl_ini_' + n + '" name="hidden_stok_tgl_ini_' + n + '">' +
                        '<input type="hidden" id="hidden_stok_booking_' + n + '" name="hidden_stok_booking_' + n + '">' +
                        '<input type="hidden" id="hidden_satuan_' + n + '" name="hidden_satuan_' + n + '">' +
                        '</td>';
                    var td_col_9 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0;">' +
                        '<!-- Qty Diminta & Stok di Tgl ini & Satuan -->' +
                        '<input type="number" class="form-control form-control-sm" id="txt_qty_diminta_' + n + '" name="txt_qty_diminta_' + n + '" placeholder="Qty Diminta" onkeyup="validasi_qty_diminta(' + n + ')">' +
                        '</td>';

                    var td_col_11 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0;">' +
                        '<!-- Keterangan -->' +
                        '<textarea class="resizable_textarea form-control" rows="1" id="txt_ket_rinci_' + n + '" name="txt_ket_rinci_' + n + '" placeholder="Keterangan" onkeypress="saveRinciEnter(event,' + n + ')"></textarea>' +
                        '<label id="lbl_status_simpan_' + n + '"></label>' +
                        '<input type="hidden" id="hidden_id_bpbitem_' + n + '" name="hidden_id_bpbitem_' + n + '">' +
                        '</td>';
                    var td_col_12 = '<td width="5%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0;">' +
                        '<button style="display:none;" class="btn btn-xs btn-success fa fa-save" id="btn_simpan_' + n + '" name="btn_simpan_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="saveRinciClick(' + n + ')"></button>' +
                        '<button class="btn btn-xs btn-warning fa fa-edit" id="btn_ubah_' + n + '" name="btn_ubah_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" onclick="ubahRinci(' + n + ')"></button>' +
                        '<button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_' + n + '" name="btn_update_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="updateRinci(' + n + ')"></button>' +
                        '<button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick mt-1" id="btn_cancel_update_' + n + '" name="btn_cancel_update_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update" onclick="cancelUpdate(' + n + ')"></button>' +
                        '<button class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_' + n + '" name="btn_hapus_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + n + ')"></button>' +
                        '</td>';
                    var form_tutup = '</form>';
                    var tr_tutup = '</tr>';

                    $('#tbody_rincian').append(tr_buka + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_10 + td_col_9 + td_col_11 + td_col_12 + form_tutup + tr_tutup);

                    if (data.data_bpb.bag == 'TANAMAN') {
                        get_tmtbm(data.data_bpbitem[index].tmtbm, n);
                        cmb_afd_unit(data.data_bpbitem[index].tmtbm, data.data_bpbitem[index].afd, n);
                        cmb_blok_sub(data.data_bpbitem[index].tmtbm, data.data_bpbitem[index].afd, data.data_bpbitem[index].blok, n);
                        cmb_tahun_tanam(data.data_bpbitem[index].tmtbm, data.data_bpbitem[index].afd, data.data_bpbitem[index].blok, data.data_bpbitem[index].thntanam, n)
                        cmb_bahan(data.data_bpbitem[index].kodebebantxt, n);
                    }

                    cek_bagian(data.data_bpb.bag, n);

                    $('#txt_account_beban_' + n).val(data.data_bpbitem[index].ketsub);
                    $('#hidden_no_acc_' + n).val(data.data_bpbitem[index].kodesubtxt);
                    $('#hidden_nama_acc_' + n).val(data.data_bpbitem[index].ketsub);

                    $('#hidden_satuan_' + n).val(data.data_bpbitem[index].satuan);
                    $('#hidden_kode_barang_' + n).val(data.data_bpbitem[index].kodebar);
                    $('#hidden_nama_barang_' + n).val(data.data_bpbitem[index].nabar);
                    $('#hidden_grup_barang_' + n).val(data.data_bpbitem[index].grp);
                    $('#txt_barang_' + n).val(data.data_bpbitem[index].nabar);
                    $('#hidden_txtperiode_' + n).val(data.data_bpbitem[index].periode);

                    $('#txt_qty_diminta_' + n).val(data.data_bpbitem[index].qty);
                    $('#txt_ket_rinci_' + n).val(data.data_bpbitem[index].ket);

                    $('#hidden_id_bpbitem_' + n).val(data.data_bpbitem[index].id);

                    $('#tr_' + n).find('input,textarea,select').attr('disabled', '');
                    $('#tr_' + n).find('input,textarea,select').addClass('form-control bg-light');

                    $('#txt_qty_diminta_' + n).addClass('currencyduadigit');
                    $('.currencyduadigit').number(true, 0);

                    sum_stok(data.data_bpbitem[index].kodebar, n, data.data_bpbitem[index].kode_dev);

                    sum_stok_booking(data.data_bpbitem[index].kodebar, n, data.data_bpbitem[index].kode_dev);
                    n++;
                    i++;
                    $('#hidden_no_table').val(n);

                    $('#txt_qty_diminta_' + n).on("keypress keyup blur", function(event) {
                        //this.value = this.value.replace(/[^0-9\.]/g,'');
                        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
                        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                            event.preventDefault();
                        }
                    });
                })
            },
            error: function(request) {
                alert(request.responseText);
            }
        });

    });

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
            batal();
        }
    }

    function batal() {
        $('#batalBPB').attr('disabled', '');
        var idbpb = $('#hidden_id_bpb').val();
        var iditem = $('#hidden_id_bpb').val();
        var noref = $('#hidden_no_ref_bpb').val();
        var mutasi_pt = $('#hidden_mutasi_pt').val();

        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data bpb ini akan dihapus",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Bpb/batalBPB'); ?>",
                    dataType: "JSON",
                    beforeSend: function() {
                        $('#batalBPB').append('&nbsp;<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>');
                    },
                    cache: false,

                    data: {
                        idbpb: idbpb,
                        iditem: iditem,
                        noref: noref,
                        mutasi_pt: mutasi_pt,
                    },
                    success: function(data) {

                        console.log(data);
                        // $('#tr_' + no).remove();
                        // alert('Data Berhasil dihapus');
                        $.toast({
                            position: 'top-right',
                            heading: 'Success',
                            text: 'Berhasil Dihapus!',
                            icon: 'success',
                            loader: false
                        });

                        setTimeout(function() {
                            window.location.href = "<?php echo site_url('Bpb'); ?>";
                        }, 1000);
                        // $('#btn_konfirmasi_terima_'+index).removeAttr('disabled');
                        // $('.modal-success').modal('show');
                    },
                    error: function(request) {
                        alert("KONEKSI TERPUTUS!");
                    }
                });
            }
        });
    }

    // function get_all_cmb(bahan, id, n) {
    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo site_url('Bpb/get_all_cmb'); ?>",
    //         dataType: "JSON",
    //         beforeSend: function() {},
    //         cache: false,
    //         // contentType : false,
    //         // processData : false,

    //         data: {
    //             'bahan': bahan,
    //             'id': id,
    //         },
    //         success: function(data) {
    //             console.log("ini datanya", data);

    //             if (data.tmtbm == '' || data.thntanam == '' || data.kodebebantxt == '') {
    //                 // console.log('oke jaaa');
    //                 var opsi_tm_tbm_ = '<option value="' + '-' + '">' + '-' + '</option>';
    //                 $('#cmb_tm_tbm_' + n).append(opsi_tm_tbm_);

    //                 var opsi_afd_unit = '<option value="' + '-' + '">' + '-' + '</option>';
    //                 $('#cmb_afd_unit_' + n).append(opsi_afd_unit);

    //                 var opsi_blok_sub = '<option value="' + '-' + '">' + '-' + '</option>';
    //                 $('#cmb_blok_sub_' + n).append(opsi_blok_sub);

    //                 var opsi_cmb_thn_tanam = '<option value="' + '-' + '">' + '-' + '</option>';
    //                 $('#cmb_tahun_tanam_' + n).append(opsi_cmb_thn_tanam);

    //                 var opsi_cmb_bahan = '<option value="' + '-' + '">' + '-' + '</option>';
    //                 $('#cmb_bahan_' + n).append(opsi_cmb_bahan);
    //             } else {

    //                 var opsi_tm_tbm_ = '<option value="' + data.tmtbm + '">' + data.tmtbm + '</option>';
    //                 $('#cmb_tm_tbm_' + n).val(opsi_tm_tbm_);
    //                 // $('#cmb_tahun_tanam_' + n).val(data.thn_tanam);

    //                 var opsi_cmb_thn_tanam = '<option value="' + data.thntanam + '">' + data.thntanam + '</option>';
    //                 $('#cmb_tahun_tanam_' + n).empty();
    //                 $('#cmb_tahun_tanam_' + n).append(opsi_cmb_thn_tanam);
    //                 var opsi_cmb_bahan = '<option value="' + data.kodebebantxt + '">' + data.kodebebantxt + '</option>';
    //                 $('#cmb_bahan_' + n).empty();
    //                 $('#cmb_bahan_' + n).append(opsi_cmb_bahan);

    //                 var opsi_cmb_bahan = '<option value="' + data.kodebebantxt + '">' + data.ketbeban + ' - ' + data.kodebebantxt + '</option>';
    //                 $('#cmb_bahan_' + n).empty();
    //                 $('#cmb_bahan_' + n).append(opsi_cmb_bahan);
    //             }

    //         },
    //         error: function(request) {
    //             alert(request.responseText);
    //         }
    //     });
    // }

    function cancelUpdate(no) {
        $('#tr_' + no).find('input,textarea,select').attr('disabled', '');
        $('#tr_' + no).find('input,textarea,select').addClass('form-control bg-light');

        // $('#txt_qty_diminta_1').addClass('form-control bg-light');
        $('#btn_cancelUpdate_ubah_' + no).css('display', 'block');
        $('#btn_update_' + no).css('display', 'none');
        $('#btn_cancel_update_' + no).css('display', 'none');
        $('#btn_hapus_' + no).removeAttr('disabled');

        $('#hidden_proses_status_' + no).empty();
        $('#hidden_proses_status_' + no).val('');
        getPreviousData(no);
    }

    function getPreviousData(no) {
        var form_data = new FormData();

        var kode_dev = $('#hidden_kode_dev').val();
        var bag = $('#hidden_bagian').val();

        form_data.append('hidden_id_bpbitem', $('#hidden_id_bpbitem_' + no).val());

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/cancel_ubah_rinci'); ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#lbl_status_simpan_' + no).empty();
                $('#lbl_status_simpan_' + no).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Cancel Update</label>');
            },
            cache: false,
            contentType: false,
            processData: false,

            data: form_data,
            success: function(data) {

                sum_stok(data.data_bpbitem.kodebar, no, kode_dev);

                sum_stok_booking(data.data_bpbitem.kodebar, no, kode_dev);

                if (bag == 'TANAMAN') {
                    get_tmtbm(data.data_bpbitem.tmtbm, no);
                    cmb_afd_unit(data.data_bpbitem.tmtbm, data.data_bpbitem.afd, no);
                    cmb_blok_sub(data.data_bpbitem.tmtbm, data.data_bpbitem.afd, data.data_bpbitem.blok, no);
                    cmb_tahun_tanam(data.data_bpbitem.tmtbm, data.data_bpbitem.afd, data.data_bpbitem.blok, data.data_bpbitem.thntanam, no)
                    cmb_bahan(data.data_bpbitem.kodebebantxt, no);
                }

                $('#txt_account_beban_' + no).val(data.data_bpbitem.ketsub);
                $('#hidden_no_acc_' + no).val(data.data_bpbitem.kodesubtxt);
                $('#hidden_nama_acc_' + no).val(data.data_bpbitem.ketsub);

                $('#hidden_satuan_' + no).val(data.data_bpbitem.satuan);
                $('#hidden_kode_barang_' + no).val(data.data_bpbitem.kodebar);
                $('#hidden_nama_barang_' + no).val(data.data_bpbitem.nabar);
                $('#hidden_grup_barang_' + no).val(data.data_bpbitem.grp);
                $('#txt_barang_' + no).val(data.data_bpbitem.nabar);
                $('#hidden_txtperiode_' + no).val(data.data_bpbitem.periode);

                $('#txt_qty_diminta_' + no).val(data.data_bpbitem.qty);
                $('#txt_ket_rinci_' + no).val(data.data_bpbitem.ket);

                $('#lbl_status_simpan_' + no).empty();
                $.toast({
                    position: 'top-right',
                    text: 'Edit Dibatalkan!',
                    icon: 'success',
                    loader: false
                });
                $('#btn_ubah_' + no).css('display', 'block');
                $('#btn_update_' + no).css('display', 'none');
                $('#btn_cancel_update_' + no).css('display', 'none');
                $('#btn_hapus_' + no).css('display', 'block');

                $('#hidden_proses_status_' + no).empty();
                $('#hidden_proses_status_' + no).val('');
            },
            error: function(request) {
                alert('Error Get Data : ' + request.responseText);
            }
        });
    }

    function updateRinci(no) {
        var isValid = true;
        var sudah_booking = parseInt($('#hidden_stok_booking_' + no).val());
        var qty_diminta = parseInt($('#txt_qty_diminta_' + no).val());
        var stok_tgl_ini = parseInt($('#hidden_stok_tgl_ini_' + no).val());

        var v_qty = validasi_qty(sudah_booking, qty_diminta, stok_tgl_ini, no);
        if (v_qty === true) {
            $('#cmb_tm_tbm_' + no +
                ',#cmb_afd_unit_' + no +
                ',#cmb_blok_sub_' + no +
                ',#cmb_tahun_tanam_' + no +
                ',#cmb_bahan_' + no +
                ',#txt_account_beban_' + no +
                ',#hidden_no_acc_' + no +
                ',#hidden_nama_acc_' + no +
                ',#txt_barang_' + no +
                ',#hidden_kode_barang_' + no +
                ',#hidden_nama_barang_' + no +
                ',#txt_qty_diminta_' + no +
                ',#hidden_stok_tgl_ini_' + no +
                ',#hidden_satuan_' + no
                // +',#txt_qty_disetujui_'+no
                +
                ',#txt_ket_rinci_' + no).each(function(e) {
                if ($.trim($(this).val()) == '') {
                    isValid = false;
                    validasi($(this).attr("id"), no);
                } else if ($('#txt_qty_diminta_' + no).val() == '0.00' || $('#txt_qty_diminta_' + no).val() == '0') {
                    isValid = false;
                    swal('Qty tidak boleh nol (0)');
                    $('#txt_qty_diminta_' + no).css({
                        "background": "#FFCECE"
                    });
                } else {
                    if ($(this).attr('id') == 'hidden_no_acc_' + no) {
                        $('#lbl_no_acc_' + no).css({
                            "background": ""
                        });
                        if ($('#lbl_no_acc_' + no).next().is('br#br_' + no)) {
                            $('#lbl_no_acc_' + no).next().remove();
                            $('#lbl_no_acc_' + no).next().remove();
                        }
                    } else if ($(this).attr('id') == 'hidden_nama_acc_' + no) {
                        $('#lbl_nama_acc_' + no).css({
                            "background": ""
                        });
                        if ($('#lbl_nama_acc_' + no).next().is('br#br_' + no)) {
                            $('#lbl_nama_acc_' + no).next().remove();
                            $('#lbl_nama_acc_' + no).next().remove();
                        }
                    } else if ($(this).attr('id') == 'hidden_kode_barang_' + no) {
                        $('#lbl_kode_barang_' + no).css({
                            "background": ""
                        });
                        if ($('#lbl_kode_barang_' + no).next().is('br#br_' + no)) {
                            $('#lbl_kode_barang_' + no).next().remove();
                            $('#lbl_kode_barang_' + no).next().remove();
                        }
                    } else if ($(this).attr('id') == 'hidden_nama_barang_' + no) {
                        $('#lbl_nama_barang_' + no).css({
                            "background": ""
                        });
                        if ($('#lbl_nama_barang_' + no).next().is('br#br_' + no)) {
                            $('#lbl_nama_barang_' + no).next().remove();
                            $('#lbl_nama_barang_' + no).next().remove();
                        }
                    } else if ($(this).attr('id') == 'hidden_satuan_' + no) {
                        $('#b_satuan_' + no).css({
                            "background": ""
                        });
                        if ($('#b_satuan_' + no).next().is('br#br_' + no)) {
                            $('#b_satuan_' + no).next().remove();
                            $('#b_satuan_' + no).next().remove();
                        }
                    } else {
                        $(this).css({
                            "background": ""
                        });
                        if ($(this).next().is('br#br_' + no)) {
                            $(this).next().remove();
                            $(this).next().remove();
                        }
                    }
                }
            });
            if (isValid === true) {
                updateData(no);
            }
        }
    }

    function updateData(no) {
        var form_data = new FormData();

        var kode_dev = $('#hidden_kode_dev').val();
        var kodebar = $('#hidden_kode_barang_' + no).val();

        form_data.append('cmb_tm_tbm', $('#cmb_tm_tbm_' + no).val());
        form_data.append('cmb_afd_unit', $('#cmb_afd_unit_' + no).val());
        form_data.append('cmb_blok_sub', $('#cmb_blok_sub_' + no).val());
        form_data.append('cmb_tahun_tanam', $('#cmb_tahun_tanam_' + no).val());
        form_data.append('cmb_bahan', $('#cmb_bahan_' + no).val());
        form_data.append('hidden_nama_bahan', $('#cmb_bahan_' + no + ' option:selected').text());
        // form_data.append('cmb_kode_bahan', $('#cmb_bahan_' + no).val());

        form_data.append('hidden_no_acc', $('#hidden_no_acc_' + no).val());
        form_data.append('hidden_nama_acc', $('#hidden_nama_acc_' + no).val());
        form_data.append('hidden_kode_barang', $('#hidden_kode_barang_' + no).val());
        form_data.append('hidden_nama_barang', $('#hidden_nama_barang_' + no).val());
        form_data.append('hidden_grup_barang', $('#hidden_grup_barang_' + no).val());
        form_data.append('hidden_satuan', $('#hidden_satuan_' + no).val());
        form_data.append('txt_qty_diminta', $('#txt_qty_diminta_' + no).val());
        form_data.append('txt_ket_rinci', $('#txt_ket_rinci_' + no).val());

        form_data.append('hidden_id_bpbitem', $('#hidden_id_bpbitem_' + no).val());
        form_data.append('hidden_no_ref_bpb', $('#hidden_no_ref_bpb').val());

        form_data.append('hidden_mutasi_pt', $('#hidden_mutasi_pt').val());
        form_data.append('hidden_mutasi_lokal', $('#hidden_mutasi_lokal').val());
        // form_data.append('edit', 0);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/ubah_rinci_bpb'); ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#lbl_status_simpan_' + no).empty();
                $('#lbl_status_simpan_' + no).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Update</label>');
            },
            cache: false,
            contentType: false,
            processData: false,

            data: form_data,
            success: function(data) {

                console.log(data);

                if (data == "kodebar_exist") {
                    swal('Tidak bisa ditambahkan. Barang sudah ada pada BPB yang sama !');
                    $('#lbl_status_simpan_' + no).empty();
                    $('#btn_ubah_' + no).css('display', 'none');
                    $('#btn_hapus_' + no).css('display', 'none');
                } else {
                    sum_stok_booking(kodebar, no, kode_dev);

                    $('.div_form_1').find('input,textarea').attr('readonly', '');
                    $('.div_form_1').find('select').attr('disabled', '');

                    $('#tr_' + no).find('input,textarea,select').attr('disabled', '');
                    $('#tr_' + no).find('input,textarea,select').addClass('form-control bg-light');

                    $('#lbl_status_simpan_' + no).empty();
                    $.toast({
                        position: 'top-right',
                        heading: 'Success',
                        text: 'Berhasil Diubah!',
                        icon: 'success',
                        loader: false
                    });

                    $('#btn_ubah_' + no).css('display', 'block');
                    $('#btn_update_' + no).css('display', 'none');
                    $('#btn_cancel_update_' + no).css('display', 'none');
                    $('#btn_hapus_' + no).css('display', 'block');

                    $('#hidden_proses_status_' + no).empty();
                    $('#hidden_proses_status_' + no).val('');
                }
            },
            error: function(request) {
                alert('Error Update Data : ' + request.responseText);

                $('#lbl_status_simpan_' + no).empty();
                $('#lbl_status_simpan_' + no).append('<label style="color:#ff0000;"><i class="fa fa-close" style="color:#ff0000;"></i> Gagal Tersimpan !</label>');
            }
        });
    }

    function ubahRinci(no) {
        var data = $('#hidden_bagian').val();

        if (data == "TANAMAN" || data == "TANAMAN UMUM") {
            // console.log('oke masuk');

            $('#tr_' + no).find('#cmb_tm_tbm_' + no + ',#cmb_afd_unit_' + no + ',#cmb_blok_sub_' + no + ',#cmb_blok_sub_' + no + ',#cmb_tahun_tanam_' + no + ',#cmb_bahan_' + no + ',#txt_account_beban_' + no + ',#txt_barang_' + no + ',#txt_qty_diminta_' + no + ',#txt_ket_rinci_' + no).removeAttr('disabled', '');
            $('#tr_' + no).find('#cmb_tm_tbm_' + no + ',#cmb_afd_unit_' + no + ',#cmb_blok_sub_' + no + ',#cmb_blok_sub_' + no + ',#cmb_tahun_tanam_' + no + ',#cmb_bahan_' + no + ',#txt_account_beban_' + no + ',#txt_barang_' + no + ',#txt_qty_diminta_' + no + ',#txt_ket_rinci_' + no).removeClass('bg-light');
        } else {

            $('#tr_' + no).find('#txt_account_beban_' + no + ',#txt_barang_' + no + ',#txt_qty_diminta_' + no + ',#txt_ket_rinci_' + no).removeAttr('disabled', '');
            $('#tr_' + no).find('#txt_account_beban_' + no + ',#txt_barang_' + no + ',#txt_qty_diminta_' + no + ',#txt_ket_rinci_' + no).removeClass('bg-light');

        }

        $('#lbl_status_simpan_' + no).empty();
        $('#btn_ubah_' + no).css('display', 'none');
        $('#btn_update_' + no).css('display', 'block');
        $('#btn_cancel_update_' + no).css('display', 'block');
        // $('#btn_hapus_' + no).attr('disabled', '');
        $('#btn_hapus_' + no).hide();

        $('#hidden_proses_status_' + no).empty();
        $('#hidden_proses_status_' + no).val('update');
    }

    function validasi(arr_id, no) {
        if (Array.isArray(arr_id)) {
            $.each(arr_id, function(index, value) {
                // $(arr_id[index]).css({
                // "background": "#FFCECE"
                // })
                // $(arr_id[index]).after('<div class="pesan_error"><br /><small style="margin-top:0px;color:red;">Harus diisi</small></div>');
            });
        } else {
            // console.log(arr_id);
            if ($('#' + arr_id).is('input') || $('#' + arr_id).is('textarea') || $('#' + arr_id).is('select')) {
                if (arr_id == 'hidden_no_acc_' + no) {
                    $('#lbl_no_acc_' + no).css({
                        "background": "#FFCECE"
                    })
                    if (!$('#lbl_no_acc_' + no).next().is('br#br_' + no)) {
                        $('#lbl_no_acc_' + no).after('<br id="br_' + no + '" /><small id="pesan_error_' + no + '" style="margin-top:0px;color:red;">Harus diisi</small>');
                    }
                } else if (arr_id == 'hidden_nama_acc_' + no) {
                    $('#lbl_nama_acc_' + no).css({
                        "background": "#FFCECE"
                    })
                    if (!$('#lbl_nama_acc_' + no).next().is('br#br_' + no)) {
                        $('#lbl_nama_acc_' + no).after('<br id="br_' + no + '" /><small id="pesan_error_' + no + '" style="margin-top:0px;color:red;">Harus diisi</small>');
                    }
                } else if (arr_id == 'hidden_kode_barang_' + no) {
                    $('#lbl_kode_barang_' + no).css({
                        "background": "#FFCECE"
                    })
                    if (!$('#lbl_kode_barang_' + no).next().is('br#br_' + no)) {
                        $('#lbl_kode_barang_' + no).after('<br id="br_' + no + '" /><small id="pesan_error_' + no + '" style="margin-top:0px;color:red;">Harus diisi</small>');
                    }
                } else if (arr_id == 'hidden_nama_barang_' + no) {
                    $('#lbl_nama_barang_' + no).css({
                        "background": "#FFCECE"
                    })
                    if (!$('#lbl_nama_barang_' + no).next().is('br#br_' + no)) {
                        $('#lbl_nama_barang_' + no).after('<br id="br_' + no + '" /><small id="pesan_error_' + no + '" style="margin-top:0px;color:red;">Harus diisi</small>');
                    }
                } else if (arr_id == 'hidden_stok_tgl_ini_' + no) {
                    $('#b_stok_tgl_ini_' + no).css({
                        "background": "#FFCECE"
                    })
                    if (!$('#b_stok_tgl_ini_' + no).next().is('br#br_' + no)) {
                        $('#b_stok_tgl_ini_' + no).after('<br id="br_' + no + '" /><small id="pesan_error_' + no + '" style="margin-top:0px;color:red;">Harus diisi</small>');
                    }
                } else if (arr_id == 'hidden_satuan_' + no) {
                    $('#b_satuan_' + no).css({
                        "background": "#FFCECE"
                    })
                    if (!$('#b_satuan_' + no).next().is('br#br_' + no)) {
                        $('#b_satuan_' + no).after('<br id="br_' + no + '" /><small id="pesan_error_' + no + '" style="margin-top:0px;color:red;">Harus diisi</small>');
                    }
                } else if (arr_id == 'cmb_tm_tbm_' + no) {
                    $('#cmb_tm_tbm_' + no).css({
                        "background": "#FFCECE"
                    })
                    if (!$('#cmb_tm_tbm_' + no).next().is('br#br_' + no)) {
                        $('#cmb_tm_tbm_' + no).after('<br id="br_' + no + '" /><small id="pesan_error_' + no + '" style="margin-top:0px;color:red;">Harus diisi</small>');
                    }
                } else if (arr_id == 'cmb_afd_unit_' + no) {
                    $('#cmb_afd_unit_' + no).css({
                        "background": "#FFCECE"
                    })
                    if (!$('#cmb_afd_unit_' + no).next().is('br#br_' + no)) {
                        $('#cmb_afd_unit_' + no).after('<br id="br_' + no + '" /><small id="pesan_error_' + no + '" style="margin-top:0px;color:red;">Harus diisi</small>');
                    }
                } else if (arr_id == 'cmb_tahun_tanam_' + no) {
                    $('#cmb_tahun_tanam_' + no).css({
                        "background": "#FFCECE"
                    })
                    if (!$('#cmb_tahun_tanam_' + no).next().is('br#br_' + no)) {
                        $('#cmb_tahun_tanam_' + no).after('<br id="br_' + no + '" /><small id="pesan_error_' + no + '" style="margin-top:0px;color:red;">Harus diisi</small>');
                    }
                } else if (arr_id == 'cmb_bahan_' + no) {
                    $('#cmb_bahan_' + no).css({
                        "background": "#FFCECE"
                    })
                    if (!$('#cmb_bahan_' + no).next().is('br#br_' + no)) {
                        $('#cmb_bahan_' + no).after('<br id="br_' + no + '" /><small id="pesan_error_' + no + '" style="margin-top:0px;color:red;">Harus diisi</small>');
                    }
                } else {
                    $('#' + arr_id).css({
                        "background": "#FFCECE"
                    })
                    if (!$('#' + arr_id).next().is('br#br_' + no)) {
                        $('#' + arr_id).after('<br id="br_' + no + '" /><small id="pesan_error_' + no + '" style="margin-top:0px;color:red;">Harus diisi</small>');
                    }
                }
            }
        }
    }

    function validasi_qty(sudah_booking, qty_diminta, stok_tgl_ini, no) {
        /*** jika jumlah booking+diminta melebihi jumlah stok maka isValid = false dan munculkan alert booking melebihi stok ***/
        if (!isNaN(stok_tgl_ini >= 0)) {
            if (stok_tgl_ini == 0) {
                $('#txt_qty_diminta_' + no).css({
                    "background": ""
                })
                isValid = true;
            } else {
                if ((sudah_booking + qty_diminta) > stok_tgl_ini) {
                    $('#txt_qty_diminta_' + no).css({
                        "background": "#FFCECE"
                    })
                    isValid = false;
                    alert('Qty Stok :' + stok_tgl_ini + '. Sudah Booking :' + sudah_booking + ' dan Permintaan BPB :' + qty_diminta + ', melebihi dari jumlah stok yang tersedia');
                } else {
                    $('#txt_qty_diminta_' + no).css({
                        "background": ""
                    })
                    isValid = true;
                }
            }
        } else {
            isValid = false;
        }

        return isValid;
    }

    function cek_bagian(bag, row) {
        // console.log($('#cmb_bagian :selected').text());
        if (bag != "TANAMAN") {
            var strip_cmb = '<option value="-">-</option>';

            $('.set_strip_cmb').html(strip_cmb);
        }
    }

    // function cek_tm_tbm(row) {
    //     if ($('#cmb_bagian :selected').text() != "TANAMAN") {
    //         var strip_cmb = '<option value="-">-</option>';
    //         // $('.set_strip_cmb').empty();
    //         // $('.set_strip_cmb').append(strip_cmb);
    //         $('.set_strip_cmb').html(strip_cmb);
    //         // $('#cmb_tm_tbm_'+row).html(strip_cmb);
    //     } else {
    //         var cmb_tm_tbm = '<option value=""></option>';
    //         cmb_tm_tbm += '<option value="TM">TM</option>';
    //         cmb_tm_tbm += '<option value="TBM">TBM</option>';
    //         cmb_tm_tbm += '<option value="LANDCLEARING">LANDCLEARING</option>';
    //         cmb_tm_tbm += '<option value="PEMBIBITAN">PEMBIBITAN</option>';

    //         $('.cmb_tm_tbm').html(cmb_tm_tbm);
    //         // var strip_cmb = '<option value="-">-</option>';
    //         // $('.set_strip_cmb').empty();
    //         // $('.set_strip_cmb').append(strip_cmb);
    //         // $('.set_strip_cmb').html(strip_cmb);
    //         // $('#cmb_tm_tbm_'+row).html(strip_cmb);

    //         // $('.cmb_tm_tbm').empty();
    //         // $('.cmb_tm_tbm').append(cmb_tm_tbm);			
    //         // $('#cmb_tm_tbm_'+row).html(cmb_tm_tbm);

    //         // $('#txt_account_beban_'+row).attr('disabled','');
    //     }
    // }

    //kalo tmtbm diganti
    function cmb_afd_unit_ganti(n) {

        var tm_tbm = $('#cmb_tm_tbm_' + n).val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/pilih_afd'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            // contentType : false,
            // processData : false,

            data: {
                'tm_tbm': tm_tbm
            },
            success: function(data) {
                $('#cmb_afd_unit_' + n).empty();

                var opsi_afd_unit = '<option value="-">-</option>';
                $('#cmb_afd_unit_' + n).append(opsi_afd_unit);

                $.each(data, function(index) {
                    var opsi_afd_unit = '<option value="' + data[index].afd + '">' + data[index].afd + '</option>';
                    $('#cmb_afd_unit_' + n).append(opsi_afd_unit);
                });
            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }

    function cmb_blok_sub_ganti(n) {
        var tm_tbm = $('#cmb_tm_tbm_' + n).val();
        var afd_unit = $('#cmb_afd_unit_' + n).val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/pilih_blok_sub'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            // contentType : false,
            // processData : false,

            data: {
                'tm_tbm': tm_tbm,
                'afd_unit': afd_unit
            },
            success: function(data) {
                $('#cmb_blok_sub_' + n).empty();

                var opsi_master_blok = '<option value="-">-</option>';
                $('#cmb_blok_sub_' + n).append(opsi_master_blok);

                $.each(data, function(index) {
                    var opsi_master_blok = '<option value="' + data[index].blok + '">' + data[index].blok + '</option>';
                    $('#cmb_blok_sub_' + n).append(opsi_master_blok);
                });
            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }

    function cmb_tahun_tanam_ganti(n) {
        var tm_tbm = $('#cmb_tm_tbm_' + n).val();
        var afd_unit = $('#cmb_afd_unit_' + n).val();
        var blok_sub = $('#cmb_blok_sub_' + n).val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/pilih_tahun_tanam'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            // contentType : false,
            // processData : false,

            data: {
                'tm_tbm': tm_tbm,
                'afd_unit': afd_unit,
                'blok_sub': blok_sub
            },
            success: function(data) {
                $('#cmb_tahun_tanam_' + n).empty();

                var opsi_tahun_tanam = '<option value="-">-</option>';
                $('#cmb_tahun_tanam_' + n).append(opsi_tahun_tanam);

                $.each(data, function(index) {
                    var opsi_tahun_tanam = '<option value="' + data[index].tahuntanam + '">' + data[index].tahuntanam + '</option>';
                    $('#cmb_tahun_tanam_' + n).append(opsi_tahun_tanam);
                });
            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }

    function get_tmtbm(tmtbm, n) {
        // array 3 dimensi
        var data_tmtbm = [
            ['', '<option value="">-</option>', '<option value="" selected>-</option>'],
            ['TM', '<option value="TM">TM</option>', '<option value="TM" selected>TM</option>'],
            ['TBM', '<option value="TBM">TBM</option>', '<option value="TBM" selected>TBM</option>'],
            ['LANDCLEARING', '<option value="LANDCLEARING">LANDCLEARING</option>', '<option value="LANDCLEARING" selected>LANDCLEARING</option>'],
            ['PEMBIBITAN', '<option value="PEMBIBITAN">PEMBIBITAN</option>', '<option value="PEMBIBITAN" selected>PEMBIBITAN</option>'],
        ];

        for (var i = 0; i < data_tmtbm.length; i++) {
            // console.log(data_tmtbm[i][0]);
            // console.log(tmtbm);
            var cmb_tm_tbm;
            if (tmtbm == data_tmtbm[i][0]) {
                cmb_tm_tbm += data_tmtbm[i][2];
                $('#cmb_tm_tbm_' + n).html(cmb_tm_tbm);
            } else {
                cmb_tm_tbm += data_tmtbm[i][1];
                $('#cmb_tm_tbm_' + n).html(cmb_tm_tbm);
            }

        }
    }

    function cmb_afd_unit(tm_tbm, afd, row) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/pilih_afd'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            // contentType : false,
            // processData : false,

            data: {
                'tm_tbm': tm_tbm
            },
            success: function(data) {
                $('#cmb_afd_unit_' + row).empty();

                $.each(data, function(index) {
                    if (data[index].afd == afd) {
                        var opsi_afd_unit = '<option value="' + data[index].afd + '" selected>' + data[index].afd + '</option>';
                        $('#cmb_afd_unit_' + row).append(opsi_afd_unit);
                    } else {
                        var opsi_afd_unit = '<option value="' + data[index].afd + '">' + data[index].afd + '</option>';
                        $('#cmb_afd_unit_' + row).append(opsi_afd_unit);
                    }
                });
            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }

    function cmb_blok_sub(tm_tbm, afd_unit, blok_unit, row) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/pilih_blok_sub'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            // contentType : false,
            // processData : false,

            data: {
                'tm_tbm': tm_tbm,
                'afd_unit': afd_unit
            },
            success: function(data) {
                $('#cmb_blok_sub_' + row).empty();

                $.each(data, function(index) {
                    if (data[index].blok == blok_unit) {
                        var opsi_master_blok = '<option value="' + data[index].blok + '" selected>' + data[index].blok + '</option>';
                        $('#cmb_blok_sub_' + row).append(opsi_master_blok);
                    } else {
                        var opsi_master_blok = '<option value="' + data[index].blok + '">' + data[index].blok + '</option>';
                        $('#cmb_blok_sub_' + row).append(opsi_master_blok);
                    }
                });
            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }

    function cmb_tahun_tanam(tm_tbm, afd_unit, blok_sub, thn_tanam, row) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/pilih_tahun_tanam'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            // contentType : false,
            // processData : false,

            data: {
                'tm_tbm': tm_tbm,
                'afd_unit': afd_unit,
                'blok_sub': blok_sub
            },
            success: function(data) {
                $('#cmb_tahun_tanam_' + row).empty();

                $.each(data, function(index) {
                    if (data[index].tahuntanam == thn_tanam) {
                        var opsi_tahun_tanam = '<option value="' + data[index].tahuntanam + '" selected>' + data[index].tahuntanam + '</option>';
                        $('#cmb_tahun_tanam_' + row).append(opsi_tahun_tanam);
                    } else {
                        var opsi_tahun_tanam = '<option value="' + data[index].tahuntanam + '">' + data[index].tahuntanam + '</option>';
                        $('#cmb_tahun_tanam_' + row).append(opsi_tahun_tanam);
                    }
                });
            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }

    function cmb_bahan(kodebeban, n) {
        var data_bahan = [
            ['', '<option value="">-</option>', '<option value="" selected>-</option>'],
            ['021', '<option value="021">UPKEEP BAHAN</option>', '<option value="021" selected>UPKEEP BAHAN</option>'],
            ['051', '<option value="051">PEMUPUKAN BAHAN</option>', '<option value="051" selected>PEMUPUKAN BAHAN</option>'],
            ['081', '<option value="081">PANEN BAHAN</option>', '<option value="081" selected>PANEN BAHAN</option>'],
        ];

        var digit_last_beban = kodebeban.substr(10, 3);

        for (var i = 0; i < data_bahan.length; i++) {
            var cmb_bahannya;
            if (digit_last_beban == data_bahan[i][0]) {
                cmb_bahannya += data_bahan[i][2];
                $('#cmb_bahan_' + n).html(cmb_bahannya);
            } else {
                cmb_bahannya += data_bahan[i][1];
                $('#cmb_bahan_' + n).html(cmb_bahannya);
            }

        }
    }

    function pilihModalAccBeban(row) {
        $('#modalAccBeban').modal('show');
        $('#hidden_no_row').val(row);
        $('#tableAccBeban').DataTable().destroy();
        tableAccBeban(row);
    }

    // Start Data Table Server Side
    var table;

    function tableAccBeban(row) {
        $(document).ready(function() {
            var kode_dev = $('#devisi').val();
            // jika pabrik
            if (kode_dev == 03) {
                var sub_kategori = $('#cmb_sub_kategori :selected').val();
            } else {
                var sub_kategori = 0;
            }

            var mutasi_pt = $('#hidden_mutasi_pt').val();
            var mutasi_lokal = $('#hidden_mutasi_lokal').val();
            var pt = $('#cmb_pt_mutasi').val();
            var devisi = $('#devisi').val();

            var tm_tbm = $('#cmb_tm_tbm_' + row).val();
            if (tm_tbm == 'TM') {
                tm_tbm1 = '7005';
            } else if (tm_tbm == 'TBM') {
                tm_tbm1 = '2024';
            } else if (tm_tbm == 'LANDCLEARING') {
                tm_tbm1 = '2090';
            } else {
                tm_tbm1 = '2095';
            }
            var afd = $('#cmb_afd_unit_' + row).val();
            var thn_tanam = $('#cmb_tahun_tanam_' + row).val();
            var cmb_bahan = $('#cmb_bahan_' + row).val();

            var dt = tm_tbm1 + afd + thn_tanam + cmb_bahan;
            console.log(dt);
            table = $('#tableAccBeban').DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                "select": true,
                "ajax": {
                    "url": "<?php echo site_url('Bpb/list_acc_beban') ?>",
                    "type": "POST",
                    "data": {
                        dt: dt,
                        pt: pt,
                        devisi: devisi,
                        cmb_bahan: cmb_bahan,
                        mutasi_pt: mutasi_pt,
                        mutasi_lokal: mutasi_lokal,
                        sub_kategori: sub_kategori
                    }
                },


                "lengthMenu": [
                    [5, 10, 15, -1],
                    [10, 15, 20, 25]
                ],

                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],

            });

        });
    }
    // End Data Table Server Side

    //jika account beban di klik
    $('#tableAccBeban tbody').on('click', 'tr', function() {
        var dataClick = $('#tableAccBeban').DataTable().row(this).data();
        // console.log(dataClick);
        var no_coa = dataClick[1];
        var nama_account = dataClick[2];
        var row = $('#hidden_no_row').val();

        // $('#lbl_no_acc_' + row).html(no_coa);
        // $('#lbl_nama_acc_' + row).html(nama_account);
        $('#txt_account_beban_' + row).val(nama_account);

        $('#hidden_no_acc_' + row).val(no_coa);
        $('#hidden_nama_acc_' + row).val(nama_account);

        $('#modalAccBeban').modal('hide');
    });

    function cari_barang(no_row) {
        $('#hidden_no_row_barang').val(no_row);
        $('#modalListBarang').modal('show');
        $('#tableListBarang').DataTable().destroy();
        listBarang(no_row);
    }

    function listBarang(no_row) {
        var table;
        $(document).ready(function() {
            table = $('#tableListBarang').DataTable({
                "paging": true,
                "scrollY": false,
                "scrollX": false,
                "searching": true,
                "select": true,
                "bLengthChange": true,
                "scrollCollapse": true,
                "bPaginate": true,
                "bInfo": true,
                "bSort": false,
                "processing": true,
                "serverSide": true,
                "stateSave": true,
                "order": [],
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {},
                "ajax": {
                    "url": "<?php echo site_url('Bpb/list_barang') ?>",
                    "type": "POST"
                },
                "columnDefs ": [{
                    "targets": [0],
                    "orderable": false,
                }, ],
                "lengthMenu": [
                    [5, 10, 15, -1],
                    [10, 15, 20, 25]
                ],

                "columns": [{
                        "width": "3%"
                    },
                    {
                        "width": "5%"
                    },
                    {
                        "width": "10%"
                    },
                    {
                        "width": "20%"
                    },
                    {
                        "width": "20%"
                    },
                    {
                        "width": "5%"
                    }
                ],
                "drawCallback": function(settings) {
                    $('#tableListBarang tr').each(function() {
                        var Cell = $(this).find('td');

                        Cell.parent().on('mouseover', Cell, function() {
                            Cell.parent().css('background-color', '#26b99a');
                            Cell.parent().css('color', '#ffffff');

                            Cell.parent().bind("mouseout", function() {
                                Cell.parent().css('background-color', '');
                                Cell.parent().css('color', '#73879c');
                            });
                        });
                    });
                },
            });
        });
    }

    $('#tableListBarang tbody').on('click', 'tr', function() {
        var dataClick = $('#tableListBarang').DataTable().row(this).data();
        var kode_barang = dataClick[2];
        var nama_barang = dataClick[3];
        var grup_barang = dataClick[4];
        var satuan = dataClick[5];
        var txtperiode = dataClick[6];
        var row = $('#hidden_no_row_barang').val();

        var kode_dev = $('#hidden_kode_dev').val();

        $('#lbl_kode_barang_' + row).html(kode_barang);
        $('#lbl_nama_barang_' + row).html(nama_barang);
        $('#txt_barang_' + row).val(nama_barang);

        $('#hidden_kode_barang_' + row).val(kode_barang);
        $('#hidden_nama_barang_' + row).val(nama_barang);
        $('#hidden_grup_barang_' + row).val(grup_barang);
        $('#hidden_txtperiode_' + row).val(txtperiode);

        $('#b_satuan_' + row).html(satuan);
        $('#hidden_satuan_' + row).val(satuan);

        // $('#modalListBarang').modal('hide');

        sum_stok(kode_barang, row, kode_dev);
        sum_stok_booking(kode_barang, row, kode_dev);
    });

    function sum_stok(kodbar, row, kode_dev) {

        var hidden_txtperiode = $('#hidden_txtperiode_' + row).val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/sum_stok'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            // contentType : false,
            // processData : false,

            data: {
                'kodbar': kodbar,
                'hidden_txtperiode': hidden_txtperiode,
                'kode_dev': kode_dev
            },
            success: function(data) {

                // console.log(data);
                if (data === false) {
                    var sess_user_gudang = '<?php echo $this->session->userdata('kode_level') ?>';
                    // 36 User Gudang
                    // 18 Kasie Gudang
                    if (sess_user_gudang != 36 && sess_user_gudang != 18) {
                        swal('Stock Awal Belum Ada / Tidak Ada Stock di Gudang, Silahkan Hubungi Petugas Gudang');
                    } else {

                        Swal.fire({
                            title: 'Stock Awal belum ada!',
                            text: "silahkan input dahulu",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya!'
                        }).then(function() {
                            // window.location = "redirectURL";
                            window.open('<?php echo site_url('stok'); ?>', '_blank');
                        });
                    }
                } else {
                    if (data == '0' || data == '0.00') {
                        swal('Tidak ada stok di gudang, silahkan lakukan pengajuan SPP');
                        $('#txt_barang_' + row).val('');
                        $('#modalListBarang').modal('hide');
                    } else {
                        $('#b_stok_tgl_ini_' + row).html(data);
                        $('#hidden_stok_tgl_ini_' + row).val(data);

                        $('#tr_' + row).css('background-color', '#f9f9f9');
                        $('#txt_ket_rinci_' + row).removeAttr('readonly');
                        $('#btn_simpan_' + row).removeAttr('disabled');

                        $('#modalListBarang').modal('hide');
                    }
                }
            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }

    function sum_stok_booking(kodbar, row, kode_dev) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/sum_stok_booking'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                'kodbar': kodbar,
                'kode_dev': kode_dev
            },
            success: function(data) {
                console.log(data);
                $('#b_stok_booking_' + row).html(data);
                $('#hidden_stok_booking_' + row).val(data);
            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }

    function validasi_qty_diminta(n) {
        var a = $('#hidden_stok_tgl_ini_' + n + '').val();
        var b = $('#txt_qty_diminta_' + n + '').val();

        var hidden_stok_tgl_ini = Number(a);
        var txt_qty_diminta = Number(b);

        if (txt_qty_diminta > hidden_stok_tgl_ini) {
            swal('Stok digudang hanya ada ' + hidden_stok_tgl_ini);
            $('#txt_qty_diminta_' + n + '').val('');
        } else if (txt_qty_diminta == 0) {
            swal('Tidak boleh 0!');
            $('#txt_qty_diminta_' + n + '').val('');
        }
    }

    function hapusRinci(id) {
        $('#hidden_no_delete').val(id);

        var rowCount = $("#tableRinciBPB td").closest("tr").length;
        if (rowCount != 1) {
            $('#modalKonfirmasiHapus').modal('show');
        } else {
            deleteData();
        }
    }

    function deleteData() {
        var no = $('#hidden_no_delete').val();
        $('#modalKonfirmasiHapus').modal('hide');

        var rowCount = $("#tableRinciBPB td").closest("tr").length;

        if (rowCount != 1) {
            var form_data = new FormData();

            form_data.append('hidden_id_bpbitem', $('#hidden_id_bpbitem_' + no).val());

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Bpb/hapus_rinci'); ?>",
                dataType: "JSON",
                beforeSend: function() {
                    $('#lbl_status_simpan_' + no).empty();
                    $('#lbl_status_simpan_' + no).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i></label>');
                },
                cache: false,
                contentType: false,
                processData: false,

                data: form_data,
                success: function(data) {
                    $('#tr_' + no).remove();
                    // alert('Data Berhasil dihapus');
                    $.toast({
                        position: 'top-right',
                        heading: 'Success',
                        text: 'Berhasil Dihapus!',
                        icon: 'success',
                        loader: false
                    });
                    $('#lbl_status_simpan_' + no).empty();
                    // $('#btn_konfirmasi_terima_'+index).removeAttr('disabled');
                    // $('.modal-success').modal('show');
                },
                error: function(request) {
                    alert(request.responseText);
                }
            });
        } else {
            Swal.fire({
                title: 'Item BPB Tinggal 1',
                text: "Yakin akan menghapus BPB ini?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya Hapus!'
            }).then((result) => {
                if (result.value) {
                    // var no_po = $('#hidden_no_po').val();
                    deleteBPB(no);
                }
            });
        }
    }

    function deleteBPB(no) {
        var form_data = new FormData();

        // form_data.append('hidden_id_po',$('#hidden_id_po_'+no).val());
        form_data.append('hidden_id_bpb', $('#hidden_id_bpb').val());
        form_data.append('hidden_id_bpbitem', $('#hidden_id_bpbitem_' + no).val());

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/hapus_all'); ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#lbl_status_simpan_' + no).empty();
                $('#lbl_status_simpan_' + no).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i></label>');
            },
            cache: false,
            contentType: false,
            processData: false,

            data: form_data,
            success: function(data) {
                $('#tr_' + no).remove();
                // alert('Data Berhasil dihapus');
                $.toast({
                    position: 'top-right',
                    heading: 'Success',
                    text: 'Berhasil Dihapus!',
                    icon: 'success',
                    loader: false
                });

                window.location = "<?= base_url('Bpb') ?>";
                // $('#btn_konfirmasi_terima_'+index).removeAttr('disabled');
                // $('.modal-success').modal('show');
            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }
</script>