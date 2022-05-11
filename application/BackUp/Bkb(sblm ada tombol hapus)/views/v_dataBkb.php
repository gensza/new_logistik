<div class="container-fluid">

    <!-- start row-->
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="widget-rounded-circle card-box">
                <div class="row justify-content-between">
                    <h4 class="header-title" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Data BKB</h4>
                    <div class="form-group">
                        <select class="form-control" id="filter" name="filter">
                            <option value="">Semua</option>
                        </select>
                    </div>
                </div>

                <table id="tableListBKB" class="table table-sm table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th style="width: 75px;">#</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">No.</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">No. Ref BKB</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">No. Ref BPB</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">No Mutasi</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">Bagian</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">Keperluan</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">Tgl BKB</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Detail BKB</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-12">
                    <div class="table-responsive">
                        <input type="hidden" id="hidden_id_stockkeluar" name="hidden_no_row">
                        <table id="bkb_approval" class="table table-striped table-bordered" style="width: 100%; border-collapse: separate; padding: 0 50px 0 50px;">
                            <thead>
                                <tr>
                                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; padding: 0.6em;">
                                        No
                                    </th>
                                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; padding: 0.6em;">
                                        ID
                                    </th>
                                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; padding: 0.6em;;">
                                        Kode&nbsp;Barang
                                    </th>
                                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; padding: 0.6em;">
                                        Nama&nbsp;Barang
                                    </th>
                                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; padding: 0.6em;">
                                        Sat
                                    </th>
                                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; padding: 0.6em;">
                                        Qty Diminta
                                    </th>
                                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; padding: 0.6em;">
                                        Qty Disetujui
                                    </th>
                                    <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; padding: 0.6em;">
                                        Status BKB
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot1>
                                <tr>
                                    <th style="text-align: center;" colspan="10"><button class="btn btn-sm btn-info" data-toggle="tooltip" id="btn_setuju_all" onclick="approve_barang()" data-placement="left">Approve</button></th>
                                </tr>
                            </tfoot1>
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

<script>
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#tableListBKB').DataTable({

            "scrollY": 400,
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

    function detail_bkb(id_stockkeluar) {

        $("#modal-detail-bkb").modal('show');

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
                "dom": 'Bfrtip',
                "buttons": [{
                        "text": "Select All",
                        "action": function() {
                            $('#bkb_approval').DataTable().rows().select();
                        }
                    },
                    {
                        "text": "Unselect All",
                        "action": function() {
                            $('#bkb_approval').DataTable().rows().deselect();
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
        detail_bkb(id_stockkeluar);
    }
</script>