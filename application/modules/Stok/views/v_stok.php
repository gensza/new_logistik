<!-- start row-->
<div class="row justify-content-center">
    <div class="col-md">
        <div class="widget-rounded-circle card-box">
            <div class="row justify-content-between">
                <h4 class="header-title" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Stock Logistik PT. <?= $this->session->userdata('app_pt'); ?></h4>
                <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light" onclick="modalInputStockAwal()">Input Stock Awal</button>
            </div>
            <hr>
            <div class="row">
                <!-- <div class="ribbon ribbon-danger float-right" id="pesan_"><i class="mdi mdi-access-point mr-1"></i>Habis!</div> -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table id="tableStockAwal" class="table w-100 dataTable no-footer table-sm table-striped">

                        <thead class="thead-light">
                            <tr role="row">
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">No.</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Periode</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Kode Barang</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nama Barang</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Satuan</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Group</th>
                                <th colspan="9" rowspan="1" style="text-align: center;">Saldo</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Ket</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Min. Stock</th>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 353.4px;" aria-label="Position: activate to sort column ascending">Awal (Qty)</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 152.4px;" aria-label="Salary: activate to sort column ascending">Awal (Nilai)</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 152.4px;" aria-label="Salary: activate to sort column ascending">QTY Masuk</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 152.4px;" aria-label="Salary: activate to sort column ascending">QTY Keluar</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 106.4px;" aria-label="Extn.: activate to sort column ascending">Nilai Masuk</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 106.4px;" aria-label="Extn.: activate to sort column ascending">Nilai Keluar</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 177.4px;" aria-label="Office: activate to sort column ascending">Akhir (Qty)</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 106.4px;" aria-label="Extn.: activate to sort column ascending">Akhir (Nilai)</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 80.4px;" aria-label="Extn.: activate to sort column ascending">Rata2 (Nilai)</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade form-modal" tabindex="-1" role="dialog" aria-hidden="true" id="modalInputStockAwal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Stock Awal</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="javascript:;" class="form-horizontal" id="form_input_stock_awal" name="form_input_stock_awal" method="POST">
                        <input type="hidden" id="hidden_id" name="hidden_id">

                        <div class="form-group row">
                            <label for="txt_kode_barang" class="col-3 col-form-label">Kode Barang</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="txt_kode_barang" placeholder="Nomor Part" onfocus="modalListBarang()" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txt_nm_barang" class="col-3 col-form-label">Nama Barang</label>
                            <div class="col-9">
                                <input type="text" class="form-control bg-light" id="txt_nama_barang" name="txt_nm_barang" placeholder="Nama Barang" required="" autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_satuan" class="col-3 col-form-label">Satuan</label>
                            <div class="col-3">
                                <input type="text" class="form-control bg-light" id="txt_satuan" name="txt_satuan" placeholder="Satuan" readonly="" required="">
                            </div>
                            <label class="control-label col-md-2">Group</label>
                            <div class="col-md-3">
                                <!-- <input type="text" class="form-control" id="txt_grup" name="txt_grup" placeholder="Grup" readonly="" required=""> -->
                                <textarea class="resizable_textarea form-control bg-light" id="txt_grup" name="txt_grup" placeholder="Grup" readonly="" required=""></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_min_stock_qty" class="col-3 col-form-label">Min. Stock (Qty)</label>
                            <div class="col-3">
                                <input type="text" class="form-control bg-light" id="txt_min_stock_qty" name="txt_min_stock_qty" placeholder="Min. Stock (Qty)" readonly value="0.00">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_saldo_awal_qty" class="col-3 col-form-label">Saldo Awal (Qty)</label>
                            <div class="col-3">
                                <input type="text" class="form-control bg-light" id="txt_saldo_awal_qty" name="txt_saldo_awal_qty" placeholder="Min. Stock (Qty)" readonly value="0.00">
                            </div>

                            <label class="control-label col-md-2">Saldo Awal (Nilai)</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control bg-light" id="txt_saldo_awal_nilai" name="txt_saldo_awal_nilai" placeholder="Saldo Awal (Nilai)" readonly value="0.00">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txt_saldo_akhir_qty" class="col-3 col-form-label">Saldo Akhir (Qty)</label>
                            <div class="col-3">
                                <input type="text" class="form-control" id="txt_saldo_akhir_qty" name="txt_saldo_akhir_qty" placeholder="Min. Stock (Qty)" value="0.00">
                            </div>

                            <label class="control-label col-md-2">Saldo Akhir (Nilai)</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="txt_saldo_akhir_nilai" name="txt_saldo_akhir_nilai" placeholder="Saldo Awal (Nilai)" value="0.00">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txt_keterangan_stock_awal" class="col-3 col-form-label">Keterangan</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="txt_keterangan_stock_awal" placeholder="Keterangan" autocomplete="off">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-success col-md-2 col-md-offset-5" data-toggle="tooltip" data-placement="top" title="Simpan" id="btn_simpan" name="btn_simpan">Simpan</button>
                                <button class="btn btn-sm btn-warning col-md-2 col-md-offset-5" data-toggle="tooltip" data-placement="top" title="Ubah" id="btn_ubah" name="btn_ubah">Ubah</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_simpan">Simpan</button>
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Tutup</button>
                </div> -->
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalListBarang">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Cari Kode Barang</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-responsive" id="tableListBarang" width="100%">
                        <thead>
                            <tr>
                                <th class="thtable">No</th>
                                <th class="thtable">Kode Brg</th>
                                <th class="thtable">Nama Brg</th>
                                <th class="thtable">Group</th>
                                <th class="thtable">Satuan</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_list_coa"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    var table;
    $(document).ready(function() {

        listStockAwal();
    });

    $("#form_input_stock_awal").validate({
        ignore: [],
        submitHandler: function(form) {
            simpan_stock_awal();
        }
    });

    function simpan_stock_awal() {
        var form_data = new FormData();

        form_data.append('hidden_id', $('#hidden_id').val());
        form_data.append('txt_kode_barang', $('#txt_kode_barang').val());
        form_data.append('txt_nama_barang', $('#txt_nama_barang').val());
        form_data.append('txt_satuan', $('#txt_satuan').val());
        form_data.append('txt_grup', $('#txt_grup').val());
        form_data.append('txt_min_stock_qty', $('#txt_min_stock_qty').val());
        form_data.append('txt_saldo_awal_nilai', $('#txt_saldo_awal_nilai').val());
        form_data.append('txt_saldo_awal_qty', $('#txt_saldo_awal_qty').val());
        form_data.append('txt_saldo_akhir_qty', $('#txt_saldo_akhir_qty').val());
        form_data.append('txt_saldo_akhir_nilai', $('#txt_saldo_akhir_nilai').val());
        form_data.append('txt_keterangan_stock_awal', $('#txt_keterangan_stock_awal').val());

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Stok/simpan_stock'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            contentType: false,
            processData: false,

            data: form_data,
            success: function(data) {
                if (data == 'barang_sudah_ada_di_stok_awal') {
                    swal('Barang sudah ada di stok awal pada periode ini')
                } else {
                    $('#modalInputStockAwal').modal('hide');
                    listStockAwal();

                    $.toast({
                        heading: 'Success',
                        text: 'Berhasil disimpan',
                        position: 'top-right',
                        icon: 'success',
                        showHideTransition: 'plain'
                        // reload: false
                    });
                }
            },
            error: function(request) {
                alert(request.responseText);

            }
        });
    }

    function modalInputStockAwal() {
        $('#modalInputStockAwal').modal('show');
        $('#form_input_stock_awal')[0].reset();
        $('#btn_simpan').show();
        $('#btn_ubah').hide();
        $('.modal').find('#txt_kode_barang').removeAttr('disabled');
        $('.modal').find('#txt_kode_barang').removeClass('bg-light');

    }


    function listStockAwal() {

        $('#tableStockAwal').DataTable().destroy();
        var table = $('#tableStockAwal').DataTable({

            "scrollY": 400,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Stok/get_ajax') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],

        });
    }

    function detail_barang(kodebar, id) {
        // console.table({
        //     kodebar,
        //     id
        // });
        $('#modalInputStockAwal').modal('show');
        $('#btn_simpan').hide();
        $('#btn_ubah').show();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Stok/detail_stock'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                'id': id,
                'kodebar': kodebar
            },
            success: function(data) {
                $('#hidden_id').val(data.id);
                $('#txt_kode_barang').val(data.kodebartxt);
                $('#txt_nama_barang').val(data.nabar);
                $('#txt_satuan').val(data.satuan);
                $('#txt_min_stock_qty').val(data.minstok);
                $('#txt_saldo_awal_qty').val(data.QTY_MASUK);
                $('#txt_saldo_awal_nilai').val(data.saldoawal_nilai);
                $('#txt_saldo_akhir_qty').val(data.saldoakhir_qty);
                $('#txt_saldo_akhir_nilai').val(data.saldoakhir_nilai);
                $('#txt_keterangan_stock_awal').val(data.ket);
                // $('#hidden_grup').val(data.grp);
                $('#txt_grup').val(data.grp);

                $('.form-modal').find('#txt_keterangan_stock_awal, #txt_satuan, #txt_nama_barang, #txt_kode_barang, #txt_grup').addClass('bg-light');
                $('.form-modal').find('#txt_keterangan_stock_awal, #txt_satuan, #txt_nama_barang, #txt_kode_barang, #txt_grup').attr('disabled', '');

            },
            error: function(request) {
                alert(request.responseText);

            }
        });
    }

    function modalListBarang() {
        $('#modalListBarang').modal('show');
        tableListBarang();
    }

    function tableListBarang() {
        $('#tableListBarang').DataTable().destroy();
        $('#tableListBarang').DataTable({
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
            "responsive": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('Stok/list_barang') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],

            "columns": [{
                    "width": "5%"
                },
                {
                    "width": "10%"
                },
                {
                    "width": "30%"
                },
                {
                    "width": "30%"
                },
                {
                    "width": "5%"
                },
            ],
            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],
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
    }

    $('#tableListBarang tbody').on('click', 'tr', function() {
        var dataClick = $('#tableListBarang').DataTable().row(this).data();
        var kode_brg = dataClick[1].trim();
        var nama_brg = dataClick[2].trim();
        var satuan = dataClick[4].trim();
        var group_brg = dataClick[3].trim();
        var row = $('#hidden_no_row').val();

        $('#txt_kode_barang').val(kode_brg);
        $('#txt_nama_barang').val(nama_brg);
        $('#txt_satuan').val(satuan);
        // $('#hidden_grup').val(group_brg);
        $('#txt_grup').val(group_brg);

        $('#modalListBarang').modal('hide');
    });
</script>