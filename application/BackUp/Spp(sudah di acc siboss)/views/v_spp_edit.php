<div class="container-fluid">

    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <h4 class="header-title ml-2" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">SPP <i>(Edit)</i></h4>
                        <h6 id="lbl_status_delete_spp"></h6>
                    </div>
                    <div class="row justify-content-between headspp">
                        <p class="sub-header ml-2">
                            <font face="Verdana" size="2.5">Surat Permintaan Pembelian</font>
                        </p>
                        <button class="btn btn-xs btn-danger h-50 mr-2" id="cancelSpp" onclick="hapusSpp()">Batalkan SPP</button>
                    </div>

                    <!-- <div class="row div_form_1">
                        <div class="col-lg-1 col-12">
                            <div class="form-group">
                                <label for="example-select">
                                    <font face="Verdana" size="2.5">Devisi*</font>
                                </label>
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
                        </div>
                        <div class="col-lg-1 col-12">
                            <div class="form-group">
                                <label for="example-select">
                                    <font face="Verdana" size="2.5">Jenis&nbsp;SPP*</font>
                                </label>
                                <select class="form-control" id="cmb_jenis_permohonan">
                                    <option value="" selected disabled>Pilih</option>
                                    <?php
                                    switch ($sesi_sl) {
                                        case 'HO':
                                    ?>
                                            <option value="SPP">SPP - Surat Permohonan Pembelian</option> -->
                    <!-- <option value="SPPI">SPPI - Surat Permohonan Pembelian Internal</option> -->
                    <!-- <option value="SPPA">SPPA - Surat Permohonan Pembelian Asset</option> -->
                    <!-- <option value="SPPK">SPPK - Surat Permohonan Pembelian Khusus</option> -->
                <?php
                                            break;
                                        case 'RO':
                                        case 'SITE':
                                        case 'PKS':
                ?>
                    <!-- <option value="SPP">SPP - Surat Permohonan Pembelian</option> -->
                    <!-- <option value="SPPI">SPPI - Surat Permohonan Pembelian Internal</option> -->
                    <!-- <option value="SPPA">SPPA - Surat Permohonan Pembelian Asset</option> -->
            <?php
                                            break;
                                        default:
                                            break;
                                    }
            ?>
            <!-- </select>
                            </div> -->
            <!--</div>  end col -->
            <!-- <div class="col-lg-1 col-12">
                            <div class="form-group">
                                <label for="example-select">
                                    <font face="Verdana" size="2.5">Alokasi*</font>
                                </label>
                                <select class="form-control" id="cmb_alokasi">
                                    <option value="" selected disabled>Pilih</option>
                                    <?php
                                    switch ($sesi_sl) {
                                        case 'HO':
                                    ?>
                                            <option value="HO">HO</option>
                                            <option value="RO">RO</option>
                                            <option value="SITE">SITE</option>
                                            <option value="SITE">PKS</option>
                                        <?php
                                            break;
                                        case 'RO':
                                        case 'SITE':
                                        case 'PKS':
                                        ?>
                                            <option value="SITE">SITE</option>
                                    <?php
                                            break;
                                        default:
                                            break;
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="form-group">
                                <label for="example-select">
                                    <font face="Verdana" size="2.5">Tgl Referensi*</font>
                                </label>
                                <input type="text" id="txt_tgl_ref" class="form-control bg-light" value="<?= date('d/m/Y'); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="form-group">
                                <label for="example-select">
                                    <font face="Verdana" size="2.5">Tgl terima*</font>
                                </label>
                                <input type="date" class="form-control" id="txt_tgl_terima">
                            </div>
                        </div>
                        <input id="txt_tanggal" name="txt_tanggal" class="form-control" required="required" value="<?= date('d/m/Y'); ?>" type="hidden" placeholder="Tanggal" readonly>
                        <div class="col-lg-2 col-12">
                            <div class="form-group">
                                <label for="example-select">
                                    <font face="Verdana" size="2.5">Department*</font>
                                </label>
                                <select class="form-control" id="cmb_departemen">
                                    <option value="" selected disabled>Pilih</option>
                                    <?php
                                    foreach ($dept as $d) : {
                                    ?>
                                            <option value="<?= $d['kode']; ?>"><?= $d['nama']; ?></option>
                                    <?php
                                        }
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-1 col-12">
                            <div class="form-group">
                                <label for="example-select">
                                    <font face="Verdana" size="2.5">Kode</font>
                                </label>
                                <input type="text" id="txt_kode_departemen" class="form-control bg-light" readonly>
                            </div>
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="form-group">
                                <label for="example-select">
                                    <font face="Verdana" size="2.5">Keterangan</font>
                                </label>
                                <textarea class="form-control" rows="1" id="txt_keterangan"></textarea>
                            </div>
                        </div>
                    </div> -->
            <!-- end row-->
            <hr style="margin-top: -15px;">
            <div class="row div_form_2">
                <div class="col-sm-12">
                    <div class="sub-header" style="margin-top: -15px; margin-bottom: -25px;">
                        <div class="row ml-1 mr-1 justify-content-between" style="margin-top: -25px;">
                            <h6 id="lbl_spp_status" name="lbl_spp_status">
                                <!-- <font face="Verdana" size="2.5">No. SPP : ... &nbsp; No. Ref SPP : ...</font> -->
                            </h6>
                            <h6>
                                <button class="btn btn-danger btn-xs fa fa-print" id="a_print_spp" onclick="cetak_spp()"></button>
                            </h6>
                        </div>
                    </div>
                    <input type="hidden" id="hidden_id_ppo">
                    <input type="hidden" id="hidden_no_spp" name="hidden_no_spp">
                    <input type="hidden" id="hidden_kode_dev" name="hidden_kode_dev">
                    <input type="hidden" id="hidden_no_ref_ppo" name="hidden_no_ref_ppo">
                    <input type="hidden" id="hidden_kodedept" name="hidden_kodedept">
                    <input type="hidden" id="hidden_namadept" name="hidden_namadept">
                    <input type="hidden" id="hidden_periode" name="hidden_periode">
                    <input type="hidden" id="hidden_tglppo" name="hidden_tglppo">

                    <div class="row" style="margin-left:4px;">
                        <h6 id="no_spp" name="no_spp"></h6>&emsp;&emsp;
                        <h6 id="no_ref_spp" name="no_ref_spp"></h6>
                    </div>

                    <div class="table-responsive">
                        <table id="tableRinciBarang" class="table table-striped table-bordered table-in">
                            <thead>
                                <tr>
                                    <th>
                                        <font face="Verdana" size="2.5">#</font>
                                    </th>
                                    <th>
                                        <font face="Verdana" size="2.5">Nama & Kode Barang</font>
                                    </th>
                                    <th>
                                        <font face="Verdana" size="2.5">Qty</font>
                                    </th>
                                    <th>
                                        <font face="Verdana" size="2.5">Stok/Sat</font>
                                    </th>
                                    <th>
                                        <font face="Verdana" size="2.5">Merk/Type/Jenis</font>
                                    </th>
                                    <th>
                                        <font face="Verdana" size="2.5">Aksi</font>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbody_rincian" name="tbody_rincian">
                                <!-- <tr id="tr_1">
                                            <td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <input type="hidden" id="hidden_no_table_1" name="hidden_no_table_1">
                                                <button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" id="btn_tambah_row_1" name="btn_tambah_row" onclick="tambah_row()"></button> -->
                                <!-- <button style="display:none;" class="btn btn-xs btn-danger fa fa-minus" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row_1" name="btn_hapus_row" onclick="hapus_row('1')"></button> -->
                                <!-- </td>
                                            <form id="form_rinci_1" name="form_rinci_1" method="POST" action="javascript:;">
                                                <td width="35%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                    <input type="text" class="form-control" id="nakobar_1" name="txt_cari_kode_brg_1" placeholder="Cari Kode/Nama Barang" onfocus="cari_barang('1')"><br />
                                                    <input type="hidden" id="hidden_kode_brg_1" name="hidden_kode_brg_1">
                                                    <input type="hidden" id="hidden_nama_brg_1" name="hidden_nama_brg_1">
                                                </td>
                                                <td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                    <input type="number" class="form-control" id="txt_qty_1" name="txt_qty_1" placeholder="Qty" size="26" required /><br />
                                                </td>
                                                <td width="8%">
                                                    <span id="stok_1"></span>
                                                    <span> </span>
                                                    <span id="satuan_1"></span>
                                                    <input type="hidden" id="hidden_stok_1" name="hidden_stok_1">
                                                    <input type="hidden" id="hidden_satuan_brg_1" name="hidden_satuan_brg_1">
                                                </td>
                                                <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                    <textarea id="txt_keterangan_rinci_1" name="txt_keterangan_rinci_1" class="form-control" rows="1" placeholder="Merk/Type/Jenis, jika ada"></textarea>
                                                    <input type="hidden" id="hidden_id_item_ppo_1">
                                                </td>
                                                <td width="7%" style="padding-top: 2px;">
                                                    <div class="row">
                                                        <button class="btn btn-xs btn-success fa fa-save ml-1" id="btn_simpan_1" name="btn_simpan_1" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="saveRinciClick('1')"></button>
                                                        <button style="display:none;" class="btn btn-xs btn-warning fa fa-edit ml-1" id="btn_ubah_1" name="btn_ubah_1" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" onclick="ubahRinci('1')"></button>
                                                        <button style="display:none;" class="btn btn-xs btn-info fa fa-check ml-1" id="btn_update_1" name="btn_update_1" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="updateRinci('1')"></button>
                                                        <button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick ml-1" id="btn_cancel_update_1" name="btn_cancel_update_1" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update" onclick="cancelUpdate('1')"></button> -->
                                <!-- <button style="display:none;" class="btn btn-xs btn-danger fa fa-trash ml-1" id="btn_hapus_1" name="btn_hapus_1" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci('1')"></button> -->
                                <!-- <label id="lbl_status_simpan_1"></label>
                                                    </div>
                                                </td>
                                            </form>
                                        </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end col -->
            </div>

            <!-- end row -->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->

</div> <!-- container -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalListBarang">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">List Barang</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                    <table id="dabar" class="table table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 3% !important;">#</th>
                                <th style="width: 5% !important;">No</th>
                                <th style="width: 10% !important;">Kode Barang</th>
                                <th style="width: 20% !important;">Nama Barang</th>
                                <th style="width: 20% !important;">Grup</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalKonfirmasiHapusSpp">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <h4 class="mt-2">Konfirmasi Hapus</h4>
                    <!-- <input type="hidden" id="hidden_no_delete" name="hidden_no_delete"> -->
                    <p class="mt-3">Apakah Anda yakin ingin menghapus SPP ini ???</p>
                    <button type="button" class="btn btn-warning my-2" data-dismiss="modal" id="btn_delete" onclick="deleteSpp()">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="id_ppo_edit" value="<?= $id_ppo_edit ?>">


<script>
    $(document).ready(function() {
        var id_ppo_edit = $('#id_ppo_edit').val();
        cari_spp_edit(id_ppo_edit);
    });

    function cari_spp_edit(id_ppo) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Spp/cari_spp_edit'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                'id_ppo': id_ppo
            },
            success: function(data) {

                var ppo = data.ppo;
                var item_ppo = data.item_ppo;
                console.log(data);

                $('#no_spp').text('No. SPP : ' + ppo.noref);
                $('#no_ref_spp').text('No. Ref SPP : ' + ppo.noreftxt);
                $('#hidden_no_spp').val(ppo.noref);
                $('#hidden_no_ref_ppo').val(ppo.noreftxt);
                $('#hidden_id_ppo').val(ppo.id);
                $('#hidden_kodedept').val(ppo.kodedept);
                $('#hidden_namadept').val(ppo.namadept);
                $('#hidden_periode').val(ppo.periode);
                $('#hidden_tglppo').val(ppo.tglppo);
                $('#hidden_kode_dev').val(ppo.kode_dev);

                aksi_hidden_status2(ppo.status2);

                for (i = 0; i < item_ppo.length; i++) {
                    // var no = i + 1;

                    tambah_row(i, item_ppo[i].status2);

                    var kodebar = item_ppo[i].kodebar;
                    var nabar = item_ppo[i].nabar;
                    var qty = item_ppo[i].qty;
                    var stok = item_ppo[i].STOK;
                    var sat = item_ppo[i].sat;
                    var ket = item_ppo[i].ket;
                    var id = item_ppo[i].id;

                    var nakobar = nabar + '-' + kodebar;

                    // Set data

                    $('#hidden_kode_brg_' + i).val(kodebar);
                    $('#hidden_nama_brg_' + i).val(nabar);
                    $('#hidden_satuan_brg_' + i).val(sat);
                    $('#txt_keterangan_rinci_' + i).val(ket);
                    $('#txt_qty_' + i).val(qty);
                    $('#hidden_stok_' + i).val(stok);
                    $('#satuan_' + i).text(sat);
                    $('#stok_' + i).text(stok);
                    $('#hidden_id_item_ppo_' + i).val(id);

                    $('#nakobar_' + i).val(nakobar);

                    $('.div_form_2').find('#nakobar_' + i + ', #txt_qty_' + i + ', #txt_keterangan_rinci_' + i).addClass('bg-light');
                    $('.div_form_2').find('#nakobar_' + i + ', #txt_qty_' + i + ', #txt_keterangan_rinci_' + i).attr('disabled', '');

                    // $('#sisa_qty_' + no).text(sumsisa);
                    // getGrupBarang(kodebar, i);
                }
            },
            error: function(response) {
                console.log(response.responseText);
            }
        });
    }

    function aksi_hidden_status2(status2) {

        if (status2 != 0) {
            $('#cancelSpp').css('display', 'none');
        }
    }

    $(document).ready(function() {
        $('#cmb_departemen').on('change', function() {
            var data = this.value;
            // alert(this.value);
            // console.log(data);
            $('#txt_kode_departemen').val(data);
        });
    });

    function cari_barang(no_row) {
        // $('#hidden_no_row').empty();
        $('#hidden_no_row').val(no_row);
        $('#modalListBarang').modal('show');
        // $('#tableListBarang').DataTable().destroy();
        // listBarang(no_row);
    }

    // Start Data Table Server Side
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#dabar').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Spp/get_data_barang') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],

        });

    });
    // End Data Table Server Side

    // pilih item dari data table server side

    $(document).ready(function() {
        $(document).on('click', '#data_barang', function() {

            var n = $('#hidden_no_row').val();

            var nabar_hide = $(this).data('nabar');
            var kodebar_hide = $(this).data('kodebar');
            var nakobar = $(this).data('nabar') + " - " + $(this).data('kodebar');
            var satuan = $(this).data('satuan');
            // console.log(nabar);

            // Set data
            $('#hidden_nama_brg_' + n).val(nabar_hide);
            $('#hidden_kode_brg_' + n).val(kodebar_hide);
            $('#nakobar_' + n).val(nakobar);
            $('#satuan_' + n).text(satuan);
            $('#hidden_satuan_brg_' + n).val(satuan);
            $("#modalListBarang").modal('hide');

        });
    });

    // pilih item dari data table server side
    $(document).ready(function() {
        $(document).on('click', '#data_barang', function() {

            var n = $('#hidden_no_row').val();

            var kode_dev = $('#hidden_kode_dev').val();

            var kd_bar = $(this).data('kodebar');

            // var id = $(this).attr('data');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Spp/getStok') ?>",
                dataType: "JSON",
                data: {
                    kd_bar: kd_bar,
                    kode_dev: kode_dev
                },
                success: function(data) {
                    $('#stok_' + n).text(data);
                    $('#hidden_stok_' + n).val(data);
                }
            });
            return false;
        });
    });

    function saveRinciClick(n) {

        // console.log(n);
        // var dev = $('#devisi').val();
        // var jp = $('#cmb_jenis_permohonan').val();
        // var alok = $('#cmb_alokasi').val();
        // var tgl_trm = $('#txt_tgl_terima').val();
        // var dept = $('#cmb_departemen').val();
        var nakobar = $('#nakobar_' + n).val();
        var qty = $('#txt_qty_' + n).val();

        // if (!dev) {
        //     toast('Devisi');
        // } else if (!jp) {
        //     toast('Jenis SPP');
        // } else if (!alok) {
        //     toast('Alokasi');
        // } else if (!tgl_trm) {
        //     toast('Tgl Terima');
        // } else if (!dept) {
        //     toast('Department');
        // } else 
        if (!nakobar) {
            toast('Nama & Kode Barang');
        } else if (!qty || qty == 0) {
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

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Spp/saveSppEdit') ?>",
            dataType: "JSON",

            beforeSend: function() {
                $('#lbl_status_simpan_' + n).empty();
                $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>');

                $('#btn_simpan_' + n).css('display', 'none');

                if ($.trim($('#hidden_no_spp').val()) == '') {
                    $('#lbl_spp_status').empty();
                    $('#lbl_spp_status').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Generate SPP Number</label>');
                }
            },

            data: {
                // txt_tgl_spp: $('#txt_tgl_spp').val(),
                // cmb_alokasi: $('#cmb_alokasi').val(),
                // txt_tanggal: $('#txt_tanggal').val(),
                // txt_tgl_terima: $('#txt_tgl_terima').val(),
                // txt_tgl_ref: $('#txt_tgl_ref').val(),
                // txt_keterangan: $('#txt_keterangan').val(),
                // cmb_jenis_permohonan: $('#cmb_jenis_permohonan').val(),
                // txt_kode_departemen: $('#txt_kode_departemen').val(),
                // cmb_departemen: $('#cmb_departemen').val(),
                // kode_dev: $('#devisi').val(),

                hidden_tglppo: $('#hidden_tglppo').val(),
                hidden_periode: $('#hidden_periode').val(),
                hidden_kodedept: $('#hidden_kodedept').val(),
                hidden_namadept: $('#hidden_namadept').val(),
                hidden_noref_spp: $('#hidden_no_ref_ppo').val(),
                hidden_no_spp: $('#hidden_no_spp').val(),
                hidden_kode_brg: $('#hidden_kode_brg_' + n).val(),
                hidden_nama_brg: $('#hidden_nama_brg_' + n).val(),
                hidden_satuan_brg: $('#hidden_satuan_brg_' + n).val(),
                hidden_stok: $('#hidden_stok_' + n).val(),
                txt_qty: $('#txt_qty_' + n).val(),
                txt_keterangan_rinci: $('#txt_keterangan_rinci_' + n).val()
            },

            success: function(data) {
                console.log(data);

                if (data.item_exist == "1") {
                    swal('Sudah ada item yang sama pada SPP ini!');
                    $('#lbl_status_simpan_' + n).empty();
                    $('#lbl_spp_status').empty();
                    $('#btn_simpan_' + n).css('display', 'block');
                } else {
                    $('#lbl_status_simpan_' + n).empty();
                    $.toast({
                        position: 'top-right',
                        heading: 'Success',
                        text: 'Berhasil Disimpan!',
                        icon: 'success',
                        loader: false
                    });

                    $('#lbl_spp_status').empty();
                    $('#h4_no_spp').html('No. SPP : ' + data.nospp);
                    $('#hidden_no_spp').val(data.nospp);

                    $('#h4_no_ref_spp').html('No. Ref. SPP : ' + data.noref);
                    $('#hidden_no_ref_ppo').val(data.noref);

                    // $('.div_form_1').find('#txt_tgl_spp, #cmb_jenis_permohonan, #cmb_alokasi, #txt_tgl_terima, #cmb_departemen, #txt_keterangan, #devisi').addClass('bg-light');
                    // $('.div_form_1').find('#txt_tgl_spp, #cmb_jenis_permohonan, #cmb_alokasi, #txt_tgl_terima, #cmb_departemen, #txt_keterangan, #devisi').attr('disabled', '');

                    $('.div_form_2').find('#nakobar_' + n + ', #txt_qty_' + n + ', #txt_keterangan_rinci_' + n).addClass('bg-light');
                    $('.div_form_2').find('#nakobar_' + n + ', #txt_qty_' + n + ', #txt_keterangan_rinci_' + n).attr('disabled', '');
                    $('.headspp').find('#cancelSpp').removeAttr('disabled');

                    $('#btn_hapus_row_' + n).css('display', 'none');
                    $('#btn_ubah_' + n).css('display', 'block');
                    $('#btn_hapus_' + n).css('display', 'block');

                    $('#hidden_id_ppo').val(data.id_ppo);
                    $('#hidden_id_item_ppo_' + n).val(data.id_item_ppo);

                    $('#a_print_spp').show();

                }
            }
        });
    }


    function ubahRinci(n) {

        // var n = $('#hidden_no_row').val();

        // $('.div_form_1').find('#devisi, #cmb_jenis_permohonan, #cmb_alokasi, #txt_tgl_terima, #cmb_departemen, #txt_keterangan').removeClass('bg-light');
        // $('.div_form_1').find('#devisi, #cmb_jenis_permohonan, #cmb_alokasi, #txt_tgl_terima, #cmb_departemen, #txt_keterangan').removeAttr('disabled');

        $('.div_form_2').find('#nakobar_' + n + ', #txt_qty_' + n + ', #txt_keterangan_rinci_' + n + '').removeClass('bg-light');
        $('.div_form_2').find('#nakobar_' + n + ', #txt_qty_' + n + ', #txt_keterangan_rinci_' + n + '').removeAttr('disabled');

        $('#btn_simpan_' + n).css('display', 'none');
        $('#btn_hapus_' + n).css('display', 'none');
        $('#btn_ubah_' + n).css('display', 'none');
        $('#btn_update_' + n).css('display', 'block');
        $('#btn_cancel_update_' + n).css('display', 'block');

        $("#status_sukses").remove();
    };

    // cancel update
    function cancelUpdate(n) {
        // var data = this.value;
        // console.log(data);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Spp/cancelUpdateItemSpp') ?>",
            dataType: "JSON",

            beforeSend: function() {

                $('#btn_cancel_update_' + n).css('display', 'none');

                $('#lbl_status_simpan_' + n).empty();
                $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>');
            },

            data: {
                hidden_id_item_ppo: $('#hidden_id_item_ppo_' + n).val(),
                hidden_id_ppo: $('#hidden_id_ppo').val()
            },

            success: function(data) {
                console.log(data);

                var ppo = data.data_ppo;
                var item_ppo = data.data_item_ppo;
                // console.log(ppo);

                var nakobar = item_ppo.nabar + " - " + item_ppo.kodebar;

                $('#nakobar_' + n).val(nakobar);
                $('#stok_' + n).text(item_ppo.STOK);
                $('#satuan_' + n).text(item_ppo.sat);

                $('#txt_qty_' + n).val(item_ppo.qty);
                $('#hidden_satuan_brg_' + n).val(item_ppo.sat);
                $('#txt_keterangan_rinci_' + n).val(item_ppo.ket);
                $('#hidden_kode_brg_' + n).val(item_ppo.kodebar);
                $('#hidden_nama_brg_' + n).val(item_ppo.nabar);
                $('#hidden_satuan_brg_' + n).val(item_ppo.sat);
                $('#hidden_stok_' + n).val(item_ppo.STOK);

                $('#lbl_status_simpan_' + n).empty();
                $.toast({
                    position: 'top-right',
                    text: 'Edit Dibatalkan!',
                    icon: 'success',
                    loader: false
                });

                $('.div_form_1').find('#devisi, #cmb_jenis_permohonan, #cmb_alokasi, #txt_tgl_terima, #cmb_departemen, #txt_keterangan').addClass('bg-light');
                $('.div_form_1').find('#devisi, #cmb_jenis_permohonan, #cmb_alokasi, #txt_tgl_terima, #cmb_departemen, #txt_keterangan').attr('disabled', '');

                $('.div_form_2').find('#nakobar_' + n + ', #txt_qty_' + n + ', #txt_keterangan_rinci_' + n).addClass('bg-light');
                $('.div_form_2').find('#nakobar_' + n + ', #txt_qty_' + n + ', #txt_keterangan_rinci_' + n).attr('disabled', '');

                $('#btn_update_' + n).css('display', 'none');
                $('#btn_ubah_' + n).css('display', 'block');
                $('#btn_hapus_' + n).css('display', 'block');

            }
        });
    };

    function updateRinci(n) {

        var qty = $('#txt_qty_' + n).val();

        if (qty == 0) {
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

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Spp/updateSpp') ?>",
            dataType: "JSON",

            beforeSend: function() {

                $('#btn_update_' + n).css('display', 'none');

                $('#lbl_status_simpan_' + n).empty();
                $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i>');
            },

            data: {
                // cmb_alokasi: $('#cmb_alokasi').val(),
                // txt_tanggal: $('#txt_tanggal').val(),
                // txt_tgl_terima: $('#txt_tgl_terima').val(),
                // txt_tgl_ref: $('#txt_tgl_ref').val(),
                // txt_keterangan: $('#txt_keterangan').val(),
                // cmb_jenis_permohonan: $('#cmb_jenis_permohonan').val(),
                // txt_kode_departemen: $('#txt_kode_departemen').val(),
                // cmb_departemen: $('#cmb_departemen').val(),

                noref: $('#hidden_no_ref_ppo').val(),
                hidden_kode_brg: $('#hidden_kode_brg_' + n).val(),
                hidden_nama_brg: $('#hidden_nama_brg_' + n).val(),
                hidden_satuan_brg: $('#hidden_satuan_brg_' + n).val(),
                txt_qty: $('#txt_qty_' + n).val(),
                hidden_stok: $('#hidden_stok_' + n).val(),
                txt_keterangan_rinci: $('#txt_keterangan_rinci_' + n).val(),
                hidden_id_ppo: $('#hidden_id_ppo').val(),
                hidden_id_item_ppo: $('#hidden_id_item_ppo_' + n).val()
            },

            success: function(data) {

                if (data.item_exist == "1") {
                    swal('Sudah ada item yang sama pada SPP ini!');
                    $('#lbl_status_simpan_' + n).empty();
                    $('#lbl_spp_status').empty();
                    $('#btn_cancel_update_' + n).css('display', 'none');
                    $('#btn_update_' + n).css('display', 'block');
                    $('#btn_cancel_update_' + n).css('display', 'block');
                } else {
                    $('#lbl_status_simpan_' + n).empty();
                    $.toast({
                        position: 'top-right',
                        heading: 'Success',
                        text: 'Berhasil Diupdate!',
                        icon: 'success',
                        loader: false
                    });

                    $('.div_form_1').find('#devisi, #cmb_jenis_permohonan, #cmb_alokasi, #txt_tgl_terima, #cmb_departemen, #txt_keterangan').addClass('bg-light');
                    $('.div_form_1').find('#devisi, #cmb_jenis_permohonan, #cmb_alokasi, #txt_tgl_terima, #cmb_departemen, #txt_keterangan').attr('disabled', '');

                    $('.div_form_2').find('#nakobar_' + n + ', #txt_qty_' + n + ', #txt_keterangan_rinci_' + n + '').addClass('bg-light');
                    $('.div_form_2').find('#nakobar_' + n + ', #txt_qty_' + n + ', #txt_keterangan_rinci_' + n + '').attr('disabled', '');

                    $('#btn_ubah_' + n).css('display', 'block');
                    $('#btn_hapus_' + n).css('display', 'block');
                    $('#btn_cancel_update_' + n).css('display', 'none');
                }
            }
        });
        return false;
    };

    function hapusRinci(n) {
        $('#hidden_no_delete').val(n);
        Swal.fire({
            text: "Yakin akan menghapus Data ini?",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya Hapus!'
        }).then((result) => {
            if (result.value) {
                deleteData(n);
            }
        })
    }

    function deleteSpp() {

        var n = $('#hidden_no_delete').val();
        var noref_ppo = $('#hidden_no_ref_ppo').val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Spp/deleteSpp') ?>",
            dataType: "JSON",

            beforeSend: function() {
                $('#lbl_status_delete_spp').empty();
                $('#lbl_status_delete_spp').append('<label><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses batalkan SPP ..</label');
            },

            data: {
                noref_ppo: noref_ppo
            },

            success: function(data) {
                // console.log(data);

                location.href = "<?php echo base_url('Spp') ?>";

            }
        });
    }

    function deleteData(n) {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Spp/deleteItemSpp') ?>",
            dataType: "JSON",

            beforeSend: function() {
                $('#lbl_status_simpan_' + n).empty();
                $('#lbl_status_simpan_' + n).append('<i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i>');
            },

            data: {
                hidden_id_item_ppo: $('#hidden_id_item_ppo_' + n).val(),
                hidden_id_ppo: $('#hidden_id_ppo').val()
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

                $('#tr_' + n).css('display', 'none');
                $('#nakobar_' + n).empty();
                $('#nakobar_' + n).val('');
                $('#txt_qty_' + n).empty();
                $('#txt_qty_' + n).val('');
                $('#txt_keterangan_rinci_' + n).empty();
                $('#txt_keterangan_rinci_' + n).val('');

                $('#hidden_kode_brg_' + n).empty();
                $('#hidden_kode_brg_' + n).val('');
                $('#hidden_nama_brg_' + n).empty();
                $('#hidden_nama_brg_' + n).val('');
                $('#hidden_stok_' + n).empty();
                $('#hidden_stok_' + n).val('');
                $('#hidden_satuan_brg_' + n).empty();
                $('#hidden_satuan_brg_' + n).val('');

                $('#modalKonfirmasiHapus').modal('hide');

                //cek di item ppo, kalo noref yg dicari tidak ada maka hapus noref trsbut dari ppo
                cari_noref_itemppo(n);
            }
        });
    };

    function cari_noref_itemppo(n) {
        var noref_spp = $('#hidden_no_ref_ppo').val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Spp/cari_noref_itemppo') ?>",
            dataType: "JSON",

            beforeSend: function() {
                $('#lbl_status_delete_spp').empty();
                $('#lbl_status_delete_spp').append('<label><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Mencari noref SPP ..</label');
            },

            data: {
                noref_spp: noref_spp
            },

            success: function(data) {

                //jika data sudah tidak ada di item ppo, hapus data di ppo
                if (data == 0) {
                    deleteSpp();
                } else {
                    $('#lbl_status_delete_spp').empty();
                    $('#lbl_status_simpan_' + n).empty();
                }

            }
        });
    }

    // var n = 2;

    function tambah_row(n, status2) {

        var tr_buka = '<tr id="tr_' + n + '">';
        var td_col_1 = '<td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="hidden" id="hidden_no_table_' + n + '" name="hidden_no_table_' + n + '">' +
            '<button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" id="btn_tambah_row_' + n + '" name="btn_tambah_row_' + n + '" onclick="tambah_row_edit(' + n + ')"></button>' +
            // '<button class="btn btn-xs btn-danger fa fa-minus" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row_' + n + '" name="btn_hapus_row_' + n + '" onclick="hapus_row(' + n + ')"></button>' +
            '</td>';
        var form_buka = '<form id="form_rinci_' + n + '" name="form_rinci_' + n + '" method="POST" action="javascript:;">';
        var td_col_2 = '<td width="35%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control" id="nakobar_' + n + '" name="txt_cari_kode_brg_' + n + '" placeholder="Cari Kode/Nama Barang" onfocus="cari_barang(' + n + ')"><br />' +
            '<input type="hidden" id="hidden_kode_brg_' + n + '" name="hidden_kode_brg_' + n + '">' +
            '<input type="hidden" id="hidden_nama_brg_' + n + '" name="hidden_nama_brg_' + n + '">' +
            '</td>';
        var td_col_3 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control" id="txt_qty_' + n + '" name="txt_qty_' + n + '" placeholder="Qty" size="26" required><br />' +
            '</td>';
        var td_col_4 = '<td width="8%">' +
            '<span id="stok_' + n + '"></span><span> </span><span id="satuan_' + n + '"> </span>' +
            '<input type="hidden" id="hidden_satuan_brg_' + n + '" name="hidden_satuan_brg_' + n + '">' +
            '<input type="hidden" id="hidden_stok_' + n + '" name="hidden_stok_' + n + '">' +
            '</td>';
        var td_col_5 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea id="txt_keterangan_rinci_' + n + '" name="txt_keterangan_rinci_' + n + '" class="resizable_textarea form-control" rows="1" placeholder="Merk/Type/Jenis, jika ada"></textarea>' +
            '<input type="hidden" id="hidden_id_item_ppo_' + n + '" name="hidden_id_item_ppo_' + n + '">' +
            '</td>';
        var td_col_6 = '<td width="7%" style="padding-top: 2px;">' +
            '<div class="row">' +
            '<button style="display:none;" class="btn btn-xs btn-success fa fa-save ml-1" id="btn_simpan_' + n + '" name="btn_simpan_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="saveRinciClick(' + n + ')"></button>' +
            '<button class="btn btn-xs btn-warning fa fa-edit ml-1" id="btn_ubah_' + n + '" name="btn_ubah_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" onclick="ubahRinci(' + n + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-info fa fa-check ml-1" id="btn_update_' + n + '" name="btn_update_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="updateRinci(' + n + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick ml-1" id="btn_cancel_update_' + n + '" name="btn_cancel_update_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update" onclick="cancelUpdate(' + n + ')"></button>' +
            '<button class="btn btn-xs btn-danger fa fa-trash ml-1" id="btn_hapus_' + n + '" name="btn_hapus_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + n + ')"></button>' +
            '<label id="lbl_status_simpan_' + n + '"></label>' +
            '</div>' +
            '</td>';
        var td_col_6_1 = '<td width="7%" style="padding-top: 2px;">' +
            '<div class="row">' +
            '<h5 style="margin-top:0px;"><span class="badge badge-success">Approved</span></h5>' +
            '</div>' +
            '</td>';
        var form_tutup = '</form>';
        var tr_tutup = '</tr>';

        if (status2 == 1) {
            $('#tbody_rincian').append(tr_buka + form_buka + td_col_1 + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6_1 + form_tutup + tr_tutup);
        } else {
            $('#tbody_rincian').append(tr_buka + form_buka + td_col_1 + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + form_tutup + tr_tutup);
        }

        $('#txt_qty_' + n).number(true, 0);
        $('#hidden_no_table_' + n).val(n);
        input_number(n);
        /*$('html, body').animate({
            scrollTop: $("#tr_" + n).offset().top
        }, 2000);*/
        // n = parseInt(n) + parseInt(1);
        // var u = n - 1;
        // $('.div_form_2').find('#btn_tambah_row_' + u).attr('disabled', '');
        console.log(n);
        // n++;
    }

    function tambah_row_edit(n) {

        var n = $('#tbody_rincian tr').length;
        console.log(n);

        var tr_buka = '<tr id="tr_' + n + '">';
        var td_col_1 = '<td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="hidden" id="hidden_no_table_' + n + '" name="hidden_no_table_' + n + '">' +
            '<button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" id="btn_tambah_row_' + n + '" name="btn_tambah_row_' + n + '" onclick="tambah_row_edit(' + n + ')"></button>' +
            '<button class="btn btn-xs btn-danger fa fa-minus" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row_' + n + '" name="btn_hapus_row_' + n + '" onclick="hapus_row(' + n + ')"></button>' +
            '</td>';
        var form_buka = '<form id="form_rinci_' + n + '" name="form_rinci_' + n + '" method="POST" action="javascript:;">';
        var td_col_2 = '<td width="35%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control" id="nakobar_' + n + '" name="txt_cari_kode_brg_' + n + '" placeholder="Cari Kode/Nama Barang" onfocus="cari_barang(' + n + ')"><br />' +
            '<input type="hidden" id="hidden_kode_brg_' + n + '" name="hidden_kode_brg_' + n + '">' +
            '<input type="hidden" id="hidden_nama_brg_' + n + '" name="hidden_nama_brg_' + n + '">' +
            '</td>';
        var td_col_3 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control" id="txt_qty_' + n + '" name="txt_qty_' + n + '" placeholder="Qty" size="26" required><br />' +
            '</td>';
        var td_col_4 = '<td width="8%">' +
            '<span id="stok_' + n + '"></span><span> </span><span id="satuan_' + n + '"> </span>' +
            '<input type="hidden" id="hidden_satuan_brg_' + n + '" name="hidden_satuan_brg_' + n + '">' +
            '<input type="hidden" id="hidden_stok_' + n + '" name="hidden_stok_' + n + '">' +
            '</td>';
        var td_col_5 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea id="txt_keterangan_rinci_' + n + '" name="txt_keterangan_rinci_' + n + '" class="resizable_textarea form-control" rows="1" placeholder="Merk/Type/Jenis, jika ada"></textarea>' +
            '<input type="hidden" id="hidden_id_item_ppo_' + n + '" name="hidden_id_item_ppo_' + n + '">' +
            '</td>';

        var td_col_6 = '<td width="7%" style="padding-top: 2px;">' +
            '<div class="row">' +
            '<button class="btn btn-xs btn-success fa fa-save ml-1" id="btn_simpan_' + n + '" name="btn_simpan_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="saveRinciClick(' + n + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-warning fa fa-edit ml-1" id="btn_ubah_' + n + '" name="btn_ubah_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" onclick="ubahRinci(' + n + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-info fa fa-check ml-1" id="btn_update_' + n + '" name="btn_update_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="updateRinci(' + n + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick ml-1" id="btn_cancel_update_' + n + '" name="btn_cancel_update_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update" onclick="cancelUpdate(' + n + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-danger fa fa-trash ml-1" id="btn_hapus_' + n + '" name="btn_hapus_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + n + ')"></button>' +
            '<label id="lbl_status_simpan_' + n + '"></label>' +
            '</div>' +
            '</td>';
        var form_tutup = '</form>';
        var tr_tutup = '</tr>';

        $('#tbody_rincian').append(tr_buka + form_buka + td_col_1 + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + form_tutup + tr_tutup);
        $('#txt_qty_' + n).number(true, 0);
        $('#hidden_no_table_' + n).val(n);
        input_number(n);
        /*$('html, body').animate({
            scrollTop: $("#tr_" + n).offset().top
        }, 2000);*/
        // n = parseInt(n) + parseInt(1);
        // var u = n - 1;
        // $('.div_form_2').find('#btn_tambah_row_' + u).attr('disabled', '');
        // console.log(n);
        // n++;
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

    function hapus_row(id) {
        // var totalRowCount = $("#tableRinciBarang tr").length;
        var rowCount = $("#tableRinciBarang td").closest("tr").length;

        if (rowCount != 1) {
            $('#tr_' + id).remove();
        } else {
            swal('Tidak Bisa dihapus, item SPP tinggal 1');
        }
        // if(id != 2){
        // n = parseInt(n)- parseInt(1);
        // $('#tr_'+n).remove();
        // }
    }

    function hapusSpp(n) {

        $('#modalKonfirmasiHapusSpp').modal('show');
    }

    function cetak_spp() {

        var id = $('#hidden_id_ppo').val();
        var noppo = $('#hidden_no_spp').val();

        window.open("<?= base_url('Spp/cetak/') ?>" + noppo + '/' + id, '_blank');

        // // Spp/cetak/nopo/id
        // window.open("cetak/" + nopo + "/" + id, '_blank');

        $('#cancelSpp').hide();

        $('.div_form_2').css('pointer-events', 'none');
    }
</script>