<div class="container-fluid">

    <div class="row mt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <h4 class="header-title" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Data SPP</h4>
                        <div class="form-group">
                            <select class="form-control" id="filter" name="filter">
                                <option value="">Semua</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="dataspp" class="table w-100 dataTable no-footer table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="padding: 0.4em;">
                                        <font face="Verdana" size="2.5">No</font>
                                    </th>
                                    <th style="padding: 0.4em; width: 90px;">
                                        <font face="Verdana" size="2.5">#</font>
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
                                        <font face="Verdana" size="2.5">Status SPP</font>
                                    </th>
                                    <th style="padding: 0.4em;">
                                        <font face="Verdana" size="2.5">Status PO</font>
                                    </th>
                                    <th style="padding: 0.4em;">
                                        <font face="Verdana" size="2.5">Input Oleh</font>
                                    </th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modal-data-spp">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Detail SPP</h4>
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
                                    <th>Nama&nbsp;Barang </th>
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
                                    <!-- <th style="text-align: center;" colspan="10"><button class="btn btn-sm btn-info" data-toggle="tooltip" id="btn_setuju_all" onclick="approve_barang()" data-placement="left">Approve</button></th> -->
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

<script type="text/javascript">
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#dataspp').DataTable({

            "fixedColumns": true,
            "fixedHeader": true,
            "scrollY": 400,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Spp/get_data_spp') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],

        });

    });

    $(document).ready(function() {
        $(document).on('click', '#edit_spp', function() {

            var id_ppo = $(this).data('id_ppo');
            // console.log(nabar);

            window.location.href = "Spp/edit_spp/" + id_ppo;

            // $("#modalListItemLpb").modal('show');
            // tampil_detail_lpb(no_lpb);
        });
    });

    // $(document).ready(function() {
    //     $(document).on('click', '#detail_spp', function() {

    //         var noppotxt = $(this).data('noppotxt');
    //         // console.log(noppotxt);

    //         $.ajax({
    //             type: "POST",
    //             url: "<?php echo base_url('Spp/getDetailSpp') ?>",
    //             dataType: "JSON",

    //             data: {
    //                 hidden_noppotxt: noppotxt
    //             },

    //             success: function(data) {

    //                 console.log(data);
    //                 var html = '';
    //                 var i;
    //                 for (i = 0; i < data.length; i++) {
    //                     var no = i + 1;
    //                     html += '<tr>' +
    //                         '<td>' + no + '</td>' +
    //                         '<td> <font face="Verdana" size="2"> ' + data[i].noppotxt + '</font></td>' +
    //                         '<td> <font face="Verdana" size="2">' + data[i].noreftxt + '</font></td>' +
    //                         '<td> <font face="Verdana" size="2">' + data[i].kodebar + '</font></td>' +
    //                         '<td> <font face="Verdana" size="2">' + data[i].nabar + '</font></td>' +
    //                         '<td> <font face="Verdana" size="2">' + data[i].sat + '</font></td>' +
    //                         '<td> <font face="Verdana" size="2">' + data[i].qty + '</font></td>' +
    //                         '<td> <font face="Verdana" size="2">' + data[i].STOK + '</font></td>' +
    //                         '<td> <font face="Verdana" size="2">' + data[i].ket + '</font></td>' +
    //                         '<td>' + '' + '</td>' +
    //                         '</tr>';
    //                 }
    //                 $('#data_detail_spp').html(html);

    //             }
    //         });

    //         $("#modalDetailSpp").modal('show');

    //     });
    // });

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

    function detail_data_spp(id_ppo) {

        $("#modal-data-spp").modal('show');

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
                "aoColumnDefs": [{
                    "bSearchable": false,
                    "bVisible": false,
                    "aTargets": [1]
                }, ]
                // "dom": 'Bfrtip',
                // "buttons": [{
                //         "text": "Select All",
                //         "action": function() {
                //             $('#spp_approval').DataTable().rows().select();
                //         }
                //     },
                //     {
                //         "text": "Unselect All",
                //         "action": function() {
                //             $('#spp_approval').DataTable().rows().deselect();
                //         }
                //     }
                // ],
                // "lengthMenu": [
                //     [5, 10, 15, -1],
                //     [10, 15, 20, 25]
                // ],
                // "aoColumnDefs": [{
                //     "bSearchable": false,
                //     "bVisible": false,
                //     "aTargets": [1]
                // }, ]
            });
        });
    }

    // function approve_barang() {
    //     Swal.fire({
    //         text: "Apakah anda yakin?",
    //         showCancelButton: true,
    //         position: 'top',
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Ya, Setujui'
    //     }).then((result) => {
    //         if (result.value) {
    //             pilihItem();
    //         }
    //     })
    // }

    // function pilihItem() {
    //     var rowcollection = $('#spp_approval').DataTable().rows({
    //         selected: true,
    //     }).data().toArray();

    //     var id_ppo = $('#hidden_id_ppo').val();

    //     $.each(rowcollection, function(index, elem) {
    //         var id = rowcollection[index][1];
    //         // var noreftxt = rowcollection[index][2];
    //         // var kodebar = rowcollection[index][3];

    //         // // isSelected(id);
    //         // if (isSelected(id)) {
    //         //     swal('Item sudah di pilih');
    //         //     return false;
    //         // }
    //         // console.log(id, noreftxt, kodebar);
    //         setujui_barang(id);
    //         // data_spp_dipilih(id, no_spp, no_ref_spp, kodebar);
    //     });
    //     detail_data_spp(id_ppo);
    // }
</script>