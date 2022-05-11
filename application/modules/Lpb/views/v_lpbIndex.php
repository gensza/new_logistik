<div class="container-fluid">
    <!-- start row-->
    <div class="row mt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between" style="margin-top: -10px;">
                        <h4 class="header-title ml-2 mb-3">Data LPB</h4>
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
                    <div class="table-responsive" style="margin-top: -10px;">
                        <table id="tableListLPB" class="table dataTable no-footer table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th width="11%" style="font-size: 12px; padding:10px">#</th>
                                    <th width="3%" style="font-size: 12px; padding:10px">No</th>
                                    <th width="8%" style="font-size: 12px; padding:10px">Tgl Terima</th>
                                    <th width="8%" style="font-size: 12px; padding:10px">Tgl Input</th>
                                    <th width="17%" style="font-size: 12px; padding:10px">No. Ref LPB</th>
                                    <th width="20%" style="font-size: 12px; padding:10px">No. Ref PO</th>
                                    <th width="9%" style="font-size: 12px; padding:10px">Supplier</th>
                                    <th width="17%" style="font-size: 12px; padding:10px">Keterangan</th>
                                    <th width="7%" style="font-size: 12px; padding:10px">Input Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div><!-- end row -->
</div> <!-- container -->

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalListItemLpb">
    <div class="modal-dialog modal-xl_lpb">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Detail LPB</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="sub-header mb-2" style="margin-top: -20px; margin-left:17px;">
                <span id="detail_noref_lpb" style="font-size: 12px;"></span>
            </div>
            <div class="modal-body">
                <div class="form-horizontal" style="margin-top: -15px;">
                    <div class="form-group">
                        <div class="table-responsive">
                            <table id="tableDetailItemLpb" class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="kode_th">Kode Barang</th>
                                        <th class="nabar_style">Nama&nbsp;Barang</th>
                                        <th class="sapll">Satuan</th>
                                        <th class="grup_th">Grup</th>
                                        <th class="sapll">Qty&nbsp;PO</th>
                                        <th class="sapll">Qty&nbsp;LPB</th>
                                        <th class="sapll">Sisa&nbsp;LPB</th>
                                        <th class="ket_style">Ket</th>
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
</div>
<style>
    .nabar_style {
        width: 23% !important;
    }

    .sapll {
        width: 7% !important;
    }

    .kode_th {
        width: 12% !important;
    }

    .grup_th {
        width: 16% !important;
    }

    .ket_style {
        width: 20% !important;
    }

    @media (min-width: 768px) {
        .modal-xl_lpb {
            width: 90%;
            max-width: 1200px;
        }
    }

    table#tableDetailItemLpb th {
        padding: 10px;
        font-size: 12px;
    }

    table#tableDetailItemLpb td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#tableListLPB td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }
</style>
<script>
    $(document).ready(function() {
        $('#filter').change(function() {
            var data = this.value;
            // console.log(data);
            dataLpb(data);

        });

        //datatables
        var data = "HO";
        dataLpb(data);
    });

    var table;

    function dataLpb(data) {
        $('#tableListLPB').DataTable().destroy();

        table = $('#tableListLPB').DataTable({
            // "scrollY": 400,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Lpb/get_data_lpb') ?>",
                "type": "POST",
                "data": {
                    data: data
                }
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
            "language": {
                "infoFiltered": ""
            },
        });
    };

    $(document).ready(function() {
        $(document).on('click', '#detail_lpb', function() {

            var noref = $(this).data('noref');
            var mutasi = $(this).data('mutasi');
            var batal = $(this).data('batal');
            // console.log(noref + 'ninoref');

            $("#modalListItemLpb").modal('show');
            if (batal != 1) {

                $('#detail_noref_lpb').html('<b>No. Ref. LPB : </b>' + noref);
            } else {

                $('#detail_noref_lpb').html('<b>No. Ref. LPB : </b>' + noref + ' <span class="badge badge-danger">Dibatalkan</span>');
            }
            tampil_detail_lpb(noref, mutasi);
        });
    });

    function tampil_detail_lpb(noref, mutasi) {

        $(document).ready(function() {

            $('#tableDetailItemLpb').DataTable().destroy();
            $('#tableDetailItemLpb').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "select": true,

                "ajax": {
                    "url": "<?php echo site_url('Lpb/get_detail_item_lpb') ?>",
                    "type": "POST",
                    "data": {
                        noref: noref,
                        mutasi: mutasi
                    }
                },
                "columnDefs ": [{
                    "targets": [0],
                    "orderable": false,
                }, ],
                "language": {
                    "infoFiltered": ""
                },
            });
        });

        // $.ajax({
        //     type: "POST",
        //     url: "<?php echo site_url('Lpb/get_detail_item_lpb'); ?>",
        //     dataType: "JSON",
        //     beforeSend: function() {
        //         $('#data_detail_item_lpb').empty();
        //     },

        //     data: {
        //         'no_lpb': no_lpb
        //     },
        //     success: function(data) {

        //         var i;
        //         for (i = 0; i < data.length; i++) {

        //             var qty_po = get_qty_po(data[i].kodebar, data[i].nopo);

        //             var sisa_lpb = get_sisa_lpb(qty_po, data[i].kodebar, no_lpb);

        //             var no = i + 1;

        //             var tr_buka = '<tr id="tr">';
        //             var td_1 = '<td>' + no +
        //                 '</td>';
        //             var td_2 = '<td>' +
        //                 '<font face="Verdana" size="2">' + data[i].kodebar + '</font>' +
        //                 '</td>';
        //             var td_3 = '<td>' +
        //                 '<font face="Verdana" size="2">' + data[i].nabar + '</font>' +
        //                 '</td>';
        //             var td_4 = '<td>' +
        //                 '<font face="Verdana" size="2">' + data[i].satuan + '</font>' +
        //                 '</td>';
        //             var td_5 = '<td>' +
        //                 '<font face="Verdana" size="2">' + data[i].grp + '</font>' +
        //                 '</td>';
        //             var td_6 = '<td>' +
        //                 '<font face="Verdana" size="2">' + qty_po + '</font>' +
        //                 '</td>';
        //             var td_7 = '<td>' +
        //                 '<font face="Verdana" size="2">' + data[i].qty + '</font>' +
        //                 '</td>';
        //             var td_8 = '<td>' +
        //                 '<font face="Verdana" size="2">' + sisa_lpb + '</font>' +
        //                 '</td>';
        //             var td_9 = '<td>' +
        //                 '<font face="Verdana" size="2">' + data[i].ket + '</font>' +
        //                 '</td>';
        //             var tr_tutup = '</tr>';
        //             $('#data_detail_item_lpb').append(tr_buka + td_1 + td_2 + td_3 + td_4 + td_5 + td_6 + td_7 + td_8 + td_9 + tr_tutup);
        //         }
        //     }
        // });
    }

    $(document).ready(function() {
        $(document).on('click', '#edit_lpb', function() {

            var id_stokmasuk = $(this).data('id');
            var mutasi = $(this).data('mutasi');
            // console.log(nabar);

            window.location.href = "Lpb/edit_lpb/" + id_stokmasuk + "/" + mutasi;

        });
    });

    // function get_qty_po(kodebar, nopo) {
    //     var succeed = false;
    //     $.ajax({
    //         async: false,
    //         type: "POST",
    //         url: "<?php echo site_url('Lpb/getQtyPo'); ?>",
    //         dataType: "JSON",
    //         beforeSend: function() {},

    //         data: {
    //             'kodebar': kodebar,
    //             'nopo': nopo
    //         },
    //         success: function(data) {
    //             // console.log(data.qty);
    //             succeed = data.qty;
    //         }
    //     });
    //     return succeed;
    // }

    // function get_sisa_lpb(qty_po, kodebar, no_lpb) {
    //     var succeed = false;
    //     $.ajax({
    //         async: false,
    //         type: "POST",
    //         url: "<?php echo site_url('Lpb/getSisaLpb'); ?>",
    //         dataType: "JSON",
    //         beforeSend: function() {},

    //         data: {
    //             'qty_po': qty_po,
    //             'kodebar': kodebar,
    //             'no_lpb': no_lpb
    //         },
    //         success: function(data) {
    //             // console.log(data);
    //             succeed = data;
    //         }
    //     });
    //     return succeed;
    // }
</script>