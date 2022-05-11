<div class="container-fluid">

    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <h4 class="header-title">Approval SPP</h4>
                        <div class="form-group">
                            <select class="form-control" id="filter" name="filter">
                                <option value="">Semua</option>
                            </select>
                        </div>
                    </div>

                    <table id="datasppapproval" class="table w-100 dataTable no-footer  table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="padding: 0.4em;">
                                    <font face="Verdana" size="2.5">No</font>
                                </th>
                                <th style="padding: 0.4em;">
                                    <font face="Verdana" size="2.5">Approval</font>
                                </th>
                                <th width="20%" style="padding: 0.4em;">
                                    <font face="Verdana" size="2.5">No. Ref. SPP</font>
                                </th>
                                <th width="9%" style="padding: 0.4em;">
                                    <font face="Verdana" size="2.5">Tgl. Ref</font>
                                </th>
                                <th width="9%" style="padding: 0.4em;">
                                    <font face="Verdana" size="2.5">Tgl. Terima</font>
                                </th>
                                <th style="padding: 0.4em;">
                                    <font face="Verdana" size="2.5">Departemen</font>
                                </th>
                                <th style="padding: 0.4em;">
                                    <font face="Verdana" size="2.5">Lokasi</font>
                                </th>
                                <th style="padding: 0.4em;">
                                    <font face="Verdana" size="2.5">Keterangan</font>
                                </th>
                                <th style="padding: 0.4em;">
                                    <font face="Verdana" size="2.5">Status</font>
                                </th>
                                <th style="padding: 0.4em;">
                                    <font face="Verdana" size="2.5">Input Oleh</font>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Pilih SPP</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-12">
                    <div class="table-responsive">
                        <input type="hidden" id="hidden_id_ppo" name="hidden_no_row">
                        <table id="spp_approval" class="table table-striped table-bordered" style="width: 100%; border-collapse: separate; padding: 0 50px 0 50px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Kode&nbsp;Barang</th>
                                    <th>Nama&nbsp;Barang</th>
                                    <th>Sat</th>
                                    <th>Qty</th>
                                    <th>Stok</th>
                                    <th>Ket</th>
                                    <th>Revisi&nbsp;Qty</th>
                                    <th>Status&nbsp;SPP</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: center;" colspan="10"><button class="btn btn-sm btn-info" data-toggle="tooltip" id="btn_setuju_all" onclick="approve_barang()" data-placement="left">Approve</button></th>
                                </tr>
                            </tfoot>
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
        table = $('#datasppapproval').DataTable({

            "scrollY": 400,
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

        });

    });

    // $(document).ready(function() {
    //     $(document).on('click', '#detail_spp_approval', function() {

    //         var noppotxt = $(this).data('noppotxt');
    //         // console.log(noppotxt);

    //         data_spp_approval(noppotxt);

    //         $("#modal-spp-approval").modal('show');

    //     });
    // });

    // function data_spp_approval(noppotxt) {
    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo base_url('Spp/getDetailSppApproval') ?>",
    //         dataType: "JSON",

    //         beforeSend: function() {
    //             $('#data_detail_spp').empty();
    //         },

    //         data: {
    //             hidden_noppotxt: noppotxt
    //         },

    //         success: function(data) {

    //             console.log(data);
    //             $('#h4_no_ref_spp').html('No. Ref. SPP : ' + data[0].noreftxt);

    //             var html = '';
    //             var i;
    //             for (i = 0; i < data.length; i++) {
    //                 var no = i + 1;

    //                 var tr_buka = '<tr id="tr">';
    //                 var td_1 = '<td>' + no +
    //                     '</td>';
    //                 var td_2 = '<td>' +
    //                     '<font face="Verdana" size="2">' + data[i].kodebar + '</font>' +
    //                     '</td>';
    //                 var td_3 = '<td>' +
    //                     '<font face="Verdana" size="2">' + data[i].nabar + '</font>' +
    //                     '</td>';
    //                 var td_4 = '<td>' +
    //                     '<font face="Verdana" size="2">' + data[i].sat + '</font>' +
    //                     '</td>';
    //                 var td_5 = '<td>' +
    //                     '<font face="Verdana" size="2">' + data[i].qty + '</font>' +
    //                     '</td>';
    //                 var td_6 = '<td>' +
    //                     '<font face="Verdana" size="2">' + data[i].STOK + '</font>' +
    //                     '</td>';
    //                 var td_7 = '<td>' +
    //                     '<font face="Verdana" size="2">' + data[i].ket + '</font>' +
    //                     '</td>';
    //                 var td_8 = (data[i].status2 == "1") ? '<td>DISETUJUI</td>' : '<td>DALAM PROSES</td>';
    //                 var td_9 = '<td>' +
    //                     '<button class="btn btn-xs btn-primary" type="button" disabled>Qty</button>' +
    //                     '</td>';
    //                 var td_10 = (data[i].status2 == "1") ? '<td><span style="color: green"><b>DISETUJUI<br>' + data[i].TGL_APPROVE + '</b></span></td>' : '<td><button class="btn btn-success btn-xs fa fa-check" type="button" onclick="approve_barang(' + data[i].id + ',' + data[i].noppotxt + ')"></button><button class="btn btn-danger ml-1 btn-xs fa fa-times" type="button"></button></td>';
    //                 var tr_tutup = '</tr>';
    //                 $('#data_detail_spp').append(tr_buka + td_1 + td_2 + td_3 + td_4 + td_5 + td_6 + td_7 + td_8 + td_9 + td_10 + tr_tutup);

    //             }

    //         }
    //     });
    // }

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

    function detail_approval(id_ppo) {

        $("#modal-spp-approval").modal('show');

        $('#hidden_id_ppo').val(id_ppo);

        $(document).ready(function() {

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
        detail_approval(id_ppo);
    }
</script>