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
                                    <th style="padding: 0.4em; width: 130px;">
                                        <font face="Verdana" size="2.5">#</font>
                                    </th>
                                    <th style="padding: 0.4em;">
                                        <font face="Verdana" size="2.5">No. Ref. SPP</font>
                                    </th>
                                    <th style="padding: 0.4em;">
                                        <font face="Verdana" size="2.5">Tgl. Ref</font>
                                    </th>
                                    <th style="padding: 0.4em;">
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

<script type="text/javascript">
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#dataspp').DataTable({

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

            var noppo = $(this).data('noppo');
            // console.log(nabar);

            window.location.href = "Spp/edit_spp/" + noppo;

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
</script>