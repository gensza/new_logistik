<!-- start row-->
<div class="container-fluid">
    <div class="row mt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2 justify-content-between">
                        <h4 class="header-title ml-2">Data Barang</h4>
                        <h6 id="lbl_status_pp"></h6>
                        <div class="button-list mr-2">
                            <button class="btn btn-xs btn-info" id="data_pp" onclick="modalInputBarang()">Tambah Barang</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">

                            <table id="tableBarang" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="7%" style="font-size: 12px; padding:10px">
                                            #
                                        </th>
                                        <th width="8%" style="font-size: 12px; padding:10px">
                                            No.
                                        </th>
                                        <th width="25%" style="font-size: 12px; padding:10px">
                                            Kode Barang
                                        </th>
                                        <th width="30%" style="font-size: 12px; padding:10px">
                                            Nama Barang
                                        </th>
                                        <th width="30%" style="font-size: 12px; padding:10px">
                                            Group
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="inputBarang" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Detail Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="javascript:;" class="form-horizontal" id="form_input_master_barang" name="form_input_master_barang" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="hidden_id" name="hidden_id">
                        <div class="form-group row">
                            <label for="txt_nmr_part" class="col-3 col-form-label">Nomor Part</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="txt_nmr_part" placeholder="Nomor Part" required="" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_kd_barang" class="col-3 col-form-label">Kode Barang</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="txt_kd_barang" placeholder="Kode Barang" onfocus="modalListCOA()" required="" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_nm_barang" class="col-3 col-form-label">Nama Barang</label>
                            <div class="col-9">
                                <input type="text" class="form-control bg-light" id="txt_nm_barang" name="txt_nm_barang" placeholder="Nama Barang" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cmb_grup_barang" class="col-3 col-form-label">Group</label>
                            <div class="col-9">
                                <input type="text" class="form-control bg-light" id="cmb_grup_barang" name="cmb_grup_barang" placeholder="Nama Barang" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_satuan" class="col-3 col-form-label">Satuan Barang</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="txt_satuan" name="txt_satuan" placeholder="Satuan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_spesifikasi" class="col-3 col-form-label">Spesifikasi</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="txt_spesifikasi" placeholder="Spesifikasi" autocomplete="off" value="-">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_keterangan" class="col-3 col-form-label">Keterangan</label>
                            <div class="col-9">
                                <textarea class="form-control" id="txt_keterangan" name="txt_keterangan" placeholder="Keterangan">-</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" id="btn_ubah">Ubah</button>
                        <button class="btn btn-primary" id="btn_simpan">Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalListCOA">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Akun COA</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="table-responsive">
                                <input type="hidden" id="hidden_no_row_barang" name="hidden_no_row_barang">
                                <table id="tableListCOA" class="table table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="5%" style="font-size: 12px; padding:10px">No</th>
                                            <th width="30%" style="font-size: 12px; padding:10px">No. COA</th>
                                            <th width="40%" style="font-size: 12px; padding:10px">Nama Account</th>
                                            <th width="5%" style="font-size: 12px; padding:10px">Type</th>
                                            <th width="20%" style="font-size: 12px; padding:10px">Grup</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_list_coa">
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
</div>

<style>
    .capital {
        text-transform: capitalize;
    }

    table#tableBarang td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#tableListCOA td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }
</style>

<script>
    $("#form_input_master_barang").validate({
        ignore: [],
        submitHandler: function(form) {
            simpan_barang();
        }
    });


    $(document).ready(function() {
        listBarang();
        satuan();


        $("input[type=text]").keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });


        $('#tableListCOA tbody').on('click', 'tr', function() {
            var dataClick = $('#tableListCOA').DataTable().row(this).data();
            // console.log(dataClick);

            var no_coa = dataClick[1].trim();
            var nama_account = dataClick[2].trim();
            var grp = dataClick[4].trim();
            var row = $('#hidden_no_row').val();
            $('#txt_kd_barang').val(no_coa);
            $('#txt_nm_barang').val(nama_account);
            $('#cmb_grup_barang').val(grp);

            $('#hidden_no_acc_' + row).val(no_coa);
            $('#hidden_nama_acc_' + row).val(nama_account);

            $('#modalListCOA').modal('hide');
            group_barang(no_coa);
        });

    });

    function simpan_barang() {
        // console.log("Hello WORLD!");

        var form_data = new FormData();

        form_data.append('hidden_id', $('#hidden_id').val());
        form_data.append('txt_nmr_part', $('#txt_nmr_part').val());
        form_data.append('txt_kd_barang', $('#txt_kd_barang').val());
        form_data.append('txt_nm_barang', $('#txt_nm_barang').val());
        form_data.append('cmb_grup_barang', $('#cmb_grup_barang').val());
        form_data.append('cmb_satuan', $('#txt_satuan').val());
        form_data.append('txt_spesifikasi', $('#txt_spesifikasi').val());
        form_data.append('txt_keterangan', $('#txt_keterangan').val());
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Barang/simpan_barang'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            contentType: false,
            processData: false,

            data: form_data,
            success: function(data) {
                $('#inputBarang').modal('hide');
                listBarang();
                $.toast({
                    heading: 'Success',
                    text: 'Data Berhasil Disimpan',
                    position: 'top-right',
                    stack: true,
                    icon: 'success'
                });
            },
            error: function(request) {
                alert(request.responseText);

            }
        });
    }

    function detail_barang(kodebar, id) {
        $('#inputBarang').modal('show');
        $('#btn_simpan').hide();
        $('#btn_ubah').show();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Barang/detail_barang'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            // cache   : false,
            // contentType : false,
            // processData : false,

            data: {
                'id': id,
                'kodebar': kodebar
            },
            success: function(data) {
                group_barang(data.kodebartxt);

                $('#cmb_grup_barang').attr('disabled', '');
                $('#txt_nmr_part').attr('disabled', '');
                $('#txt_kd_barang').attr('disabled', '');
                $('#txt_nm_barang').attr('disabled', '');

                $('#hidden_id').val(data.id);
                $('#txt_nmr_part').val(data.nopart);
                $('#txt_kd_barang').val(data.kodebartxt);
                $('#txt_nm_barang').val(data.nabar);
                $('#cmb_satuan').val(data.satuan);
                $('#txt_spesifikasi').val(data.spek);
                $('#txt_keterangan').val(data.ket);
            },
            error: function(request) {
                alert(request.responseText);

            }
        });
    }

    function modalInputBarang() {
        $('#inputBarang').modal('show');
        $('#form_input_master_barang')[0].reset();
        $('#btn_simpan').show();
        $('#btn_ubah').hide();

        $('#cmb_grup_barang').removeAttr('disabled');
        $('#txt_nmr_part').removeAttr('disabled');
        $('#txt_kd_barang').removeAttr('disabled');
        $('#txt_nm_barang').removeAttr('disabled');

        var opsi_grup_barang = '<option value="">Pilih</option>';
        $('#cmb_grup_barang').empty();
        $('#cmb_grup_barang').append(opsi_grup_barang);
    }

    function group_barang(no_coa) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Barang/get_group_barang'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            // contentType : false,
            // processData : false,
            data: {
                'no_coa': no_coa
            },
            success: function(data) {
                var opsi_grup_barang = '<option value="' + data.nama + '">' + data.nama + '</option>';
                $('#cmb_grup_barang').empty();
                $('#cmb_grup_barang').append(opsi_grup_barang);
            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }

    function satuan() {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Barang/get_satuan'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            // contentType : false,
            // processData : false,

            data: '',
            success: function(data) {
                $('#cmb_satuan').empty();
                var no_opsi = '<option value="-">-</option>';
                $('#cmb_satuan').append(no_opsi);

                $.each(data, function(index) {
                    var opsi_cmb_satuan = '<option value="' + data[index].satuan + '">' + data[index].satuan + '</option>';
                    $('#cmb_satuan').append(opsi_cmb_satuan);
                });
            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }

    function listBarang() {
        $('#tableBarang').DataTable().destroy();
        var table = $('#tableBarang').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('Barang/get_ajax') ?>",
                "type": "POST"
            },
            "columnDefs ": [{
                "targets": [0],
                "orderable": false,
            }, ],
        });
    }



    function modalListCOA() {
        $('#modalListCOA').modal('show');
        tableListCOA();
    }

    function tableListCOA() {
        $('#tableListCOA').DataTable().destroy();
        $('#tableListCOA').DataTable({
            "processing": true,
            "serverSide": true,
            "select": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('Barang/get_coa') ?>",
                "type": "POST"
            },
            "columnDefs ": [{
                "targets": [0],
                "orderable": false,
            }, ],

            "language": {
                "infoFiltered": ""
            }
        });
    }
</script>