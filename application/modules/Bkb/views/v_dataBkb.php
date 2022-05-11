<div class="container-fluid">
    <!-- start row-->
    <div class="row mt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between" style="margin-top: -10px;">
                        <h4 class="header-title ml-2 mb-3">Data BKB</h4>
                        <?php if ($this->session->userdata('status_lokasi') == 'HO') { ?>
                            <div class="row form-group mr-0">
                                <div class="col-2">
                                    <label for="" style="margin-top: 3px;">Filter</label>
                                </div>
                                <div class="col-10">
                                    <select class="form-control form-control-sm" id="filter" name="filter">
                                        <option value="SEMUA">TAMPILKAN SEMUA</option>
                                        <option value="PKS">PKS</option>
                                        <option value="SITE">SITE</option>
                                        <option value="RO">RO</option>
                                        <option value="HO" selected>HO</option>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <table id="tableListBKB" class="table table-sm table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th width="14%" style="font-size: 12px; padding:10px">#</th>
                                <th width="3%" style="font-size: 12px; padding:10px">No.</th>
                                <th width="9%" style="font-size: 12px; padding:10px">Tgl BKB</th>
                                <th width="17%" style="font-size: 12px; padding:10px">No. Ref BKB</th>
                                <th width="17%" style="font-size: 12px; padding:10px">No. Ref BPB</th>
                                <th width="10%" style="font-size: 12px; padding:10px">No Mutasi</th>
                                <th width="8%" style="font-size: 12px; padding:10px">Bagian</th>
                                <th width="15%" style="font-size: 12px; padding:10px">Keperluan</th>
                                <th width="12%" style="font-size: 12px; padding:10px">Petugas</th>
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

<!-- <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalListItemLpb">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Detail LPB</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="table-responsive">
                            <table id="tableDetailItemLpb" class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:11px; padding: 0.6em;">No</th>
                                        <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:11px; padding: 0.6em;">Kode Barang</th>
                                        <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:11px; padding: 0.6em;">Nama&nbsp;Barang</th>
                                        <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:11px; padding: 0.6em;">Satuan</th>
                                        <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:11px; padding: 0.6em;">Grup</th>
                                        <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:11px; padding: 0.6em;">Qty&nbsp;PO</th>
                                        <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:11px; padding: 0.6em;">Qty&nbsp;LPB</th>
                                        <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:11px; padding: 0.6em;">Sisa&nbsp;LPB</th>
                                        <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:11px; padding: 0.6em;">Ket</th>
                                    </tr>
                                </thead>
                                <tbody id="data_detail_item_lpb">
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modal-detail-bkb">
    <div class="modal-dialog modal-full-width modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Detail BKB</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="sub-header mb-2" style="margin-top: -20px; margin-left:17px;">
                <span id="detail_noref_bkb" style="font-size: 12px;"></span>
            </div>
            <div class="modal-body">
                <div class="table-responsive" style="margin-top: -15px;">
                    <input type="hidden" id="hidden_id_stockkeluar" name="hidden_no_row">
                    <table id="bkb_approval" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="no_th" style="font-size: 12px; padding:10px">No</th>
                                <th>ID</th>
                                <th class="kobar_th" style="font-size: 12px; padding:10px">Kode&nbsp;Barang</th>
                                <th class="nabar_th" style="font-size: 12px; padding:10px">Nama&nbsp;Barang</th>
                                <th class="sat_th" style="font-size: 12px; padding:10px">Sat</th>
                                <th class="qty_th" style="font-size: 12px; padding:10px">Qty Diminta</th>
                                <th class="qtydi_th" style="font-size: 12px; padding:10px">Qty Disetujui</th>
                                <th class="stat_th" style="font-size: 12px; padding:10px">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot1>
                            <!-- <tr>
                                <th style="text-align: center;" colspan="10"><button class="btn btn-sm btn-info" data-toggle="tooltip" id="btn_setuju_all" onclick="approve_barang()" data-placement="left">Approve</button></th>
                            </tr> -->
                        </tfoot1>
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

    .kobar_th {
        width: 13% !important;
    }

    .nabar_th {
        width: 40% !important;
    }

    .sat_th {
        width: 7% !important;
    }

    .qty_th {
        width: 10% !important;
    }

    .qtydi_th {
        width: 10% !important;
    }

    .stat_th {
        width: 17% !important;
    }

    table#bkb_approval th {
        padding: 10px;
        font-size: 12px;
    }

    table#bkb_approval td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#tableListBKB td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }
</style>
<script>
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#tableListBKB').DataTable({

            // "scrollY": 400,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Bkb/get_data_bkb') ?>",
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
    });

    // $(document).ready(function() {
    //     $(document).on('click', '#detail_bkb', function() {

    //         var noref_bkb = $(this).data('noref');
    //         // console.log(nabar);

    //         $("#modalListItemBkb").modal('show');
    //         tampil_detail_bkb(noref_bkb);
    //     });
    // });

    $(document).ready(function() {
        $(document).on('click', '#edit_bkb', function() {

            var id_stockkeluar = $(this).data('id');
            // console.log(nabar);

            window.location.href = "Bkb/edit_bkb/" + id_stockkeluar;

        });
    });

    $(document).ready(function() {
        $(document).on('click', '#detail_bkb', function() {

            var noref = $(this).data('noref');
            var id = $(this).data('id');
            var batal = $(this).data('batal');
            // console.log(noref + 'ninoref');

            $("#modal-detail-bkb").modal('show');
            if (batal != 1) {

                $('#detail_noref_bkb').html('<b>No. Ref. BKB : </b>' + noref);
            } else {
                $('#detail_noref_bkb').html('<b>No. Ref. BKB : </b>' + noref + ' <span class="badge badge-danger">Dibatalkan</span>');

            }
            detail_bkb(id);
        });
    });

    function detail_bkb(id_stockkeluar) {

        $('#hidden_id_stockkeluar').val(id_stockkeluar);

        $(document).ready(function() {

            $('#bkb_approval').DataTable().destroy();
            $('#bkb_approval').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "select": true,

                "ajax": {
                    "url": "<?php echo site_url('Bkb/get_detail_approval') ?>",
                    "type": "POST",
                    "data": {
                        id_stockkeluar: id_stockkeluar
                    }
                },
                "columnDefs ": [{
                    "targets": [0],
                    "orderable": false,

                }, ],
                "language": {
                    "infoFiltered": ""
                },
                // "dom": 'Bfrtip',
                // "buttons": [{
                //         "text": "Select All",
                //         "action": function() {
                //             $('#bkb_approval').DataTable().rows().select();
                //         }
                //     },
                //     {
                //         "text": "Unselect All",
                //         "action": function() {
                //             $('#bkb_approval').DataTable().rows().deselect();
                //         }
                //     }
                // ],
                // "lengthMenu": [
                //     [5, 10, 15, -1],
                //     [10, 15, 20, 25]
                // ],
                "aoColumnDefs": [{
                    "bSearchable": false,
                    "bVisible": false,
                    "aTargets": [1]
                }, ]
            });
        });
    }

    function setujui_barang(n) {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Bkb/approval_bkb') ?>",
            dataType: "JSON",
            data: {
                id_item_bkb: n
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
        })
    }

    function pilihItem() {
        var rowcollection = $('#bkb_approval').DataTable().rows({
            selected: true,
        }).data().toArray();

        var id_stockkeluar = $('#hidden_id_stockkeluar').val();

        $.each(rowcollection, function(index, elem) {
            var id = rowcollection[index][1];

            setujui_barang(id);

        });
        $('#tableListBKB').DataTable().ajax.reload();
        detail_bkb(id_stockkeluar);
    }
</script>