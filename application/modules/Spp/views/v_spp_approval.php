<div class="container-fluid">

    <div class="row mt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between" style="margin-top: -10px;">
                        <h4 class="header-title ml-2 mb-3">Approval SPP</h4>
                        <!-- <div class="form-group mr-2">
                            <select class="form-control" id="filter" name="filter">
                                <option value="">Semua</option>
                            </select>
                        </div> -->
                    </div>

                    <div class="table-responsive">
                        <table id="datasppapproval" class="table w-100 dataTable no-footer table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%" style="font-size: 12px; padding:10px">Approval</th>
                                    <th width="4%" style="font-size: 12px; padding:10px">No</th>
                                    <th width="18%" style="font-size: 12px; padding:10px">No. Ref. SPP</th>
                                    <th width="8%" style="font-size: 12px; padding:10px">Tgl Ref</th>
                                    <th width="8%" style="font-size: 12px; padding:10px">Tgl Terima</th>
                                    <th width="9%" style="font-size: 12px; padding:10px">Departemen</th>
                                    <th width="7%" style="font-size: 12px; padding:10px">Lokasi</th>
                                    <th width="24%" style="font-size: 12px; padding:10px">Keterangan</th>
                                    <th width="8%" style="font-size: 12px; padding:10px">Status SPP</th>
                                    <th width="9%" style="font-size: 12px; padding:10px">Input Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <br />
                    <br />

                    <!-- end row -->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->

</div> <!-- container -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modal-spp-approval">
    <div class="modal-dialog modal-full-width modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Pilih SPP</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="sub-header mb-2" style="margin-top: -20px; margin-left:17px;">
                <span id="detail_noref_spp" style="font-size: 12px;"></span>
            </div>
            <div class="modal-body">
                <div class="table-responsive" style="margin-top: -15px;">
                    <input type="hidden" id="hidden_id_ppo" name="hidden_no_row">
                    <input type="hidden" id="hidden_noref_spp">
                    <table id="spp_approval" class="table table-striped table-bordered" style="width: 100%; border-collapse: separate; padding: 0 50px 0 50px;">
                        <thead>
                            <tr>
                                <th class="no_th">No</th>
                                <th>ID</th>
                                <th class="kodebar_th">Kode&nbsp;Barang</th>
                                <th class="nabar_th">Nama&nbsp;Barang </th>
                                <th class="sat_th">Sat</th>
                                <th class="qty_th">Qty</th>
                                <th class="stok_th">Stok</th>
                                <th class="ket_th">Ket</th>
                                <!-- <th>Revisi&nbsp;Qty</th> -->
                                <th class="status_th">Status&nbsp;SPP</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="text-align: center;" colspan="9"><button class="btn btn-sm btn-info" data-toggle="tooltip" id="btn_setuju_all" onclick="approve_barang()" data-placement="left">Approve</button></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<style>
    .no_th {
        width: 3% !important;
    }

    .kodebar_th {
        width: 12% !important;
    }

    .nabar_th {
        width: 27% !important;
    }

    .ket_th {
        width: 25% !important;
    }

    .status_th {
        width: 18% !important;
    }

    .sat_th,
    .qty_th,
    .stok_th {
        width: 5% !important;
    }

    table#datasppapproval td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#spp_approval td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#spp_approval th {
        padding: 10px;
        font-size: 12px;
    }
</style>
<script>
    $(document).ready(function() {
        $(document).on('click', '#detail_spp_approval', function() {

            $("#modal-spp-approval").modal('show');

            var id_ppo = $(this).data('id_ppo');
            var noref_spp = $(this).data('noref_spp');

            $('#hidden_id_ppo').val(id_ppo);
            $('#hidden_noref_spp').val(noref_spp);
            $('#detail_noref_spp').html('<b>No. Ref. SPP : </b>' + noref_spp);

            $('#spp_approval').DataTable().destroy();
            $('#spp_approval').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "select": true,

                "ajax": {
                    "url": "<?php echo site_url('Spp/get_detail_approval') ?>",
                    "type": "POST",
                    "data": {
                        id_ppo: id_ppo
                    }
                },
                "columnDefs ": [{
                    "targets": [0],
                    "orderable": false,

                }, ],
                "dom": 'Bfrtip',
                "buttons": [{
                        "text": "Select All",
                        "action": function() {
                            $('#spp_approval').DataTable().rows().select();
                        }
                    },
                    {
                        "text": "Unselect All",
                        "action": function() {
                            $('#spp_approval').DataTable().rows().deselect();
                        }
                    }
                ],
                "lengthMenu": [
                    [5, 10, 15, -1],
                    [10, 15, 20, 25]
                ],
                "aoColumnDefs": [{
                    "bSearchable": false,
                    "bVisible": false,
                    "aTargets": [1]
                }, ],
                "language": {
                    "infoFiltered": ""
                },
                "pageLength": 10,
            });
        });

        listApproval();
    });


    function listApproval() {
        $('#datasppapproval').DataTable().destroy();
        $('#datasppapproval').DataTable({

            "fixedColumns": true,
            "fixedHeader": true,
            // "scrollY": 400,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Spp/get_data_spp_approval') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
            "language": {
                "infoFiltered": ""
            },
        });

        var rel = setInterval(function() {
            $('#datasppapproval').DataTable().ajax.reload();
            clearInterval(rel);
        }, 100);
    }

    function setujui_barang(n) {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Spp/approval_spp1') ?>",
            dataType: "JSON",
            data: {
                id_item_spp: n
            },

            success: function(data) {
                console.log(data);
                if (data == 0) {
                    swal('Item sudah di approve!');
                }
            }
        });
    }



    function approve_barang() {
        var rowcollection = $('#spp_approval').DataTable().rows({
            selected: true,
        }).data().toArray();

        if (rowcollection == false) {
            swal('Silahkan pilih item SPP!');
        } else {
            Swal.fire({
                text: "Apakah anda yakin?",
                showCancelButton: true,
                position: 'top',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui'
            }).then((result) => {
                if (result.value) {
                    pilihItem();
                }
            });
        }
    }

    function pilihItem() {
        var rowcollection = $('#spp_approval').DataTable().rows({
            selected: true,
        }).data().toArray();

        var id_ppo = $('#hidden_id_ppo').val();
        var noref_spp = $('#hidden_noref_spp').val();

        $.each(rowcollection, function(index, elem) {
            var id = rowcollection[index][1];
            // var noreftxt = rowcollection[index][2];
            // var kodebar = rowcollection[index][3];

            // // isSelected(id);
            // if (isSelected(id)) {
            //     swal('Item sudah di pilih');
            //     return false;
            // }
            // console.log(id, noreftxt, kodebar);
            setujui_barang(id);
            // data_spp_dipilih(id, no_spp, no_ref_spp, kodebar);
        });
        //refresh datatable
        $('#datasppapproval').DataTable().ajax.reload();
        callBack_detail_approval(id_ppo);
        cek_semua_approval(noref_spp);
    }

    function callBack_detail_approval(id_ppo) {
        $('#spp_approval').DataTable().destroy();
        $('#spp_approval').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "select": true,

            "ajax": {
                "url": "<?php echo site_url('Spp/get_detail_approval') ?>",
                "type": "POST",
                "data": {
                    id_ppo: id_ppo
                }
            },
            "columnDefs ": [{
                "targets": [0],
                "orderable": false,

            }, ],
            "dom": 'Bfrtip',
            "buttons": [{
                    "text": "Select All",
                    "action": function() {
                        $('#spp_approval').DataTable().rows().select();
                    }
                },
                {
                    "text": "Unselect All",
                    "action": function() {
                        $('#spp_approval').DataTable().rows().deselect();
                    }
                }
            ],
            "lengthMenu": [
                [5, 10, 15, -1],
                [10, 15, 20, 25]
            ],
            "aoColumnDefs": [{
                "bSearchable": false,
                "bVisible": false,
                "aTargets": [1]
            }, ]
        });
    }

    function cek_semua_approval(noref_spp) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Spp/cek_semua_approval') ?>",
            dataType: "JSON",
            data: {
                noref_spp: noref_spp
            },

            success: function(data) {
                if (data == 0) {
                    $("#modal-spp-approval").modal('hide');
                }
            }
        });
    }
</script>