<!-- start row-->
<div class="row justify-content-center">
    <div class="col-md">
        <div class="widget-rounded-circle card-box">
            <div class="row justify-content-between">
                <h4 class="header-title" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Stock Logistik Harian PT. <?= $this->session->userdata('app_pt'); ?></h4>
                <!-- <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light" onclick="modalInputStockAwal()">Input Stock Awal</button> -->
            </div>
            <hr>
            <div class="row">
                <!-- <div class="ribbon ribbon-danger float-right" id="pesan_"><i class="mdi mdi-access-point mr-1"></i>Habis!</div> -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table id="tableStockAwal_harian" class="table w-100 dataTable no-footer table-sm table-striped">

                        <thead class="thead-light">
                            <tr role="row">
                                <!-- <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th> -->
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">No.</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Periode</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 10%" aria-sort="ascending" aria-label="Name: activate to sort column descending">Tanggal</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Devisi</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Kode Barang</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nama Barang</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Satuan</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Group</th>
                                <th colspan="6" rowspan="1" style="text-align: center;">Saldo</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Ket</th>
                                <th rowspan="2" class="align-middle sorting_asc" tabindex="0" aria-controls="complex-header-datatable" colspan="1" style="width: 239.4px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Min. Stock</th>
                            </tr>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 353.4px;" aria-label="Position: activate to sort column ascending">Awal (Qty)</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 152.4px;" aria-label="Salary: activate to sort column ascending">Awal (Nilai)</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 106.4px;" aria-label="Extn.: activate to sort column ascending">Nilai Masuk</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 177.4px;" aria-label="Office: activate to sort column ascending">QTY Masuk</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 177.4px;" aria-label="Office: activate to sort column ascending">Nilai Keluar</th>
                                <th class="sorting" tabindex="0" aria-controls="complex-header-datatable" rowspan="1" colspan="1" style="width: 177.4px;" aria-label="Office: activate to sort column ascending">QTY Keluar</th>
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
<script>
    var table;
    $(document).ready(function() {

        listStockAwal();
    });

    function listStockAwal() {

        $('#tableStockAwal_harian').DataTable().destroy();
        var table = $('#tableStockAwal_harian').DataTable({

            "scrollY": 400,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Stok/get_ajax_harian') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],

        });
    }
</script>