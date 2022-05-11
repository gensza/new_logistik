<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-0 ml-0 justify-content-between">
                        <h4 class="header-title mb-3"><?= $title; ?></h4>
                        <?php if ($this->session->userdata('status_lokasi') == 'HO') { ?>
                            <div class="row form-group mr-0">
                                <div class="col-2">
                                    <label for="" style="margin-top: 3px;">Filter</label>
                                </div>
                                <div class="col-10">
                                    <select class="form-control form-control-sm" id="filter" name="filter">
                                        <option value="SEMUA">TAMPILKAN SEMUA</option>
                                        <option value="HO" selected>HO</option>
                                        <option value="PKS">PKS</option>
                                        <option value="SITE">SITE</option>
                                        <option value="RO">RO</option>
                                    </select>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="table-responsive" style="margin-top: -15px;">
                        <table id="tableListBPB" class="table w-100 dataTable no-footer table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px; padding:10px; width: 12%;">#</th>
                                    <th style="font-size: 12px; padding:10px; width: 4%">No</th>
                                    <th style="font-size: 12px; padding:10px">No.&nbsp;Ref.&nbsp;BPB</th>
                                    <th style="font-size: 12px; padding:10px">Item&nbsp;Barang</th>
                                    <th style="font-size: 12px; padding:10px">Keperluan</th>
                                    <th style="font-size: 12px; padding:10px">Tgl&nbsp;Input</th>
                                    <th style="font-size: 12px; padding:10px">Diminta&nbsp;Oleh</th>
                                    <th style="font-size: 12px; padding:10px; width: 4%">Status&nbsp;BPB</th>
                                    <?php
                                    if ($this->session->userdata('level') == 'KTU' or $this->session->userdata('level') == 'Mill Manager') {
                                    ?>
                                        <th style="font-size: 12px; padding:10px">Approval</th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody id="tbody_list_po">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="pp" data-backdrop="static">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">List Item BPB</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="pp" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px; padding:10px">No.</th>
                                    <th style="font-size: 12px; padding:10px">No. BPB</th>
                                    <th style="font-size: 12px; padding:10px">No. REF BPB</th>
                                    <th style="font-size: 12px; padding:10px">Kode Barang</th>
                                    <th style="font-size: 12px; padding:10px">Nama Barang</th>
                                    <th style="font-size: 12px; padding:10px">Qty Diminta</th>
                                    <th style="font-size: 12px; padding:10px">Qty Disetujui</th>
                                    <th style="font-size: 12px; padding:10px">Satuan</th>
                                    <th style="font-size: 12px; padding:10px">Asisten Afd</th>
                                    <th style="font-size: 12px; padding:10px">Kepala Kebun</th>
                                    <th style="font-size: 12px; padding:10px">Kasie Agronomi</th>
                                    <th style="font-size: 12px; padding:10px">KTU</th>
                                    <!-- <th style="font-size: 12px; padding:10px">Manager</th> -->
                                    <th style="font-size: 12px; padding:10px">GM</th>
                                    <th style="font-size: 12px; padding:10px">Kasie Gudang</th>
                                    <th style="font-size: 12px; padding:10px">Kasie Pembukuan</th>
                                </tr>
                            </thead>

                            <tbody id="tbody_list_po">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <?php
                            if ($status2 == "1") {
                            ?>
					<button type="button" class="btn btn-success" id="btn_setuju" onclick="setuju()" >Setuju</button>
					<?php
                            } elseif ($status2 == "4") {
                    ?>
					<button type="button" class="btn btn-warning" id="btn_mengetahui" onclick="setuju()" >Mengetahui</button>
					<?php
                            }
                    ?> -->
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <!-- aprrove untuk sementara -->


    <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalListApproval">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header mb-1" style="margin-bottom: -10px;">
                    <h4 class="modal-title" id="myModalLabel">List Item BPB</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive" style="margin-top: -20px;">
                        <table id="tableListBPBItem" class="table table-striped table-bordered" style="width: 100%; border-collapse: separate; padding: 0 50px 0 50px;">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px; padding:10px">No.</th>
                                    <th style="font-size: 12px; padding:10px">No. BPB</th>
                                    <th style="font-size: 12px; padding:10px">No. REF BPB</th>
                                    <th style="font-size: 12px; padding:10px">Kode Barang</th>
                                    <th style="font-size: 12px; padding:10px">Nama Barang</th>
                                    <th style="font-size: 12px; padding:10px">Qty Diminta</th>
                                    <th style="font-size: 12px; padding:10px">Qty Disetujui</th>
                                    <th style="font-size: 12px; padding:10px">Status BPB</th>
                                </tr>
                            </thead>

                            <tbody id="tbody_list_po">
                            </tbody>
                            <tfoot id="tfoot">
                                <tr>
                                    <th style="text-align: center; padding:15px;" colspan="8">
                                        <button class="btn btn-sm btn-info" data-toggle="tooltip" id="btn_setuju_all" onclick="approve_barang()" data-placement="left">Approve</button>
                                        <!-- <br>
                                        <button class="btn btn-sm btn-danger" data-toggle="tooltip" id="no_approve" onclick="no_approve()" data-placement="left" style="margin-top: 1px;">No Approve</button> -->
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalbatal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-warning h1 text-warning"></i>
                        <h4 class="mt-2">Alasan Batal</h4>
                        <input type="hidden" id="nobpb" name="nobpb">
                        <input type="hidden" id="norefbpb" name="norefbpb">
                        <input type="hidden" id="kodebar" name="kodebar">
                        <input type="hidden" id="approval" name="approval">
                        <textarea class="form-control" id="alasan" rows="4" required></textarea>
                        <button type="button" class="btn btn-warning my-2" id="btn_delete" onclick="validasi()">Simpan</button>
                        <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="detailBPB">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header ml-2">
                <h4 style="font-size: 15px;" class="modal-title" id="detailBPB">Detail BPB</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="sub-header mb-2" style="margin-top: -20px; margin-left:28px;">
                <span id="detail_noref_bpb" style="font-size: 12px;"></span>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="table-responsive" style="margin-top: -15px;">
                        <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                        <table id="datadetailBPB" class="table table-striped table-bordered" style="width: 100%; border-collapse: separate; padding: 0 50px 0 50px;">
                            <thead>
                                <tr>
                                    <th width="3%" style="font-size: 12px; padding:10px">No</th>
                                    <th width="20%" style="font-size: 12px; padding:10px">Nama&nbsp;Barang</th>
                                    <th width="20%" style="font-size: 12px; padding:10px">Kode&nbsp;Barang</th>
                                    <th width="20%" style="font-size: 12px; padding:10px">QTY</th>
                                    <th width="20%" style="font-size: 12px; padding:10px">Divisi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

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


<style>
    table#tableListBPB td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#datadetailBPB td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#tableListBPBItem td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }
</style>


<script>
    $(document).ready(function() {
        // $('#tableListBPB').DataTable();
        // $('#div_filter').hide();
        var filter = "Semua";
        listBPB(filter);
    });
    $(document).on('click', '#detail', function() {
        var id = $(this).data('id');
        var batal = $(this).data('batal');
        detail(id, batal);
    });

    function detail(id, batal) {
        $('#detailBPB').modal('show');
        if (batal != 0) {

            $('#detail_noref_bpb').html('<b>No. Ref. BPB : </b>' + id + ' <span class="badge badge-danger">Dibatalkan</span>');
        } else {

            $('#detail_noref_bpb').html('<b>No. Ref. BPB : </b>' + id);
        }
        $('#datadetailBPB').DataTable({
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Bpb/detail') ?>",
                "type": "POST",
                "data": {
                    id: id
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

    }

    function validasi() {
        var alasan = $('#alasan').val();
        var nobpb = $('#nobpb').val();
        var norefbpb = $('#norefbpb').val();
        var kodebar = $('#kodebar').val();
        var approval = $('#approval').val();

        if (!alasan) {
            $.toast({
                position: 'top-right',
                text: 'Silahkan Isi Alasan!',
                icon: 'error',
                loader: false
            });
            $('#alasan').css({
                "background": "#FFCECE"
            });
        } else {
            // console.log("Oke");
            data_bpb_dipilih(nobpb, norefbpb, kodebar, approval, alasan);
            var filter = "Semua";
            listBPB(filter);
            $('#modalbatal').modal('hide');
        }
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

    function no_approve() {
        Swal.fire({
            text: "Apakah anda yakin?",
            showCancelButton: true,
            position: 'top',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.value) {
                batalItem();
            }
        })
    }

    function pilihItem() {
        // console.log("Oke deh sippp");
        var rowcollection = $('#tableListBPBItem').DataTable().rows({
            selected: true,

        }).data().toArray();
        // console.log(rowcollection);
        $.each(rowcollection, function(index, elem) {
            var nobpb = rowcollection[index][1];
            var norefbpb = rowcollection[index][2];
            var kodebar = rowcollection[index][3];
            var approval = '1';
            // console.log(id, no_spp, no_ref_spp, kodebar);
            // console.log(nobpb, norefbpb, kodebar, approval);
            cek_approve(nobpb, norefbpb, kodebar, approval);
        });
    }

    function batalItem() {
        // console.log("Oke deh sippp");
        var rowcollection = $('#tableListBPBItem').DataTable().rows({
            selected: true,

        }).data().toArray();
        // console.log(rowcollection);
        $.each(rowcollection, function(index, elem) {
            var nobpb = rowcollection[index][1];
            var norefbpb = rowcollection[index][2];
            var kodebar = rowcollection[index][3];
            var approval = '0';
            // console.log(id, no_spp, no_ref_spp, kodebar);
            batal_approve(nobpb, norefbpb, kodebar, approval);
        });
    }

    function modalBatal(nobpb, norefbpb, kodebar, approval) {
        $('#modalListApproval').modal('hide');
        var a = $('#nobpb').val(nobpb);
        var b = $('#norefbpb').val(norefbpb);
        var d = $('#kodebar').val(kodebar);
        var e = $('#approval').val(approval);
        $('#modalbatal').modal('show');
    }

    function data_bpb_dipilih(nobpb, norefbpb, kodebar, approval, alasan) {
        // console.log(nobpb, norefbpb, kodebar, approval);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/approve'); ?>",
            dataType: "JSON",
            beforeSend: function() {

            },
            cache: false,
            // contentType : false,
            // processData : false,

            data: {
                'nobpb': nobpb,
                'norefbpb': norefbpb,
                'kodebar': kodebar,
                'approval': approval,
                'alasan': alasan,
            },
            success: function(data) {
                listBPBItem(nobpb, norefbpb);
            },
            error: function(request) {
                alert(request.responseText);
                // alert('error');
            }
        });
    }


    function cek_approve(nobpb, norefbpb, kodebar, approval) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Bpb/cek_approve') ?>",
            dataType: "JSON",
            data: {
                'nobpb': nobpb,
                'norefbpb': norefbpb,
                'kodebar': kodebar,
                'approval': approval
            },

            success: function(data) {
                var x = data.status;
                // var mutasi = data.mutasi;
                // console.log(x);

                if (x == true) {
                    konfirmasi(nobpb, norefbpb, kodebar, approval);

                    // console.log("oke");
                } else {
                    swal('Item sudah di approve!');

                }

            }
        });

    }

    function batal_approve(nobpb, norefbpb, kodebar, approval) {
        // console.log(nobpb, norefbpb, kodebar, approval);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Bpb/cek_approve') ?>",
            dataType: "JSON",
            data: {
                'nobpb': nobpb,
                'norefbpb': norefbpb,
                'kodebar': kodebar,
                'approval': approval
            },

            success: function(data) {
                var x = data.status;
                // console.log(x);

                if (x == true) {
                    // data_bpb_dipilih(nobpb, norefbpb, kodebar, approval);
                    modalBatal(nobpb, norefbpb, kodebar, approval);
                    // console.log("oke");
                } else {
                    swal('Item sudah di Batalkan!');
                }

            }
        });

    }

    function konfirmasi(nobpb, norefbpb, kodebar, approval) {
        // var conf = confirm("Apakah Anda Yakin ?");

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Bpb/approve'); ?>",
            dataType: "JSON",
            data: {
                'nobpb': nobpb,
                'norefbpb': norefbpb,
                'kodebar': kodebar,
                // 'jabatan': jabatan,
                'approval': approval
            },
            success: function(data) {
                // console.log(data);
                listBPBItem(nobpb, norefbpb);
                var filter = "Semua";
                listBPB(filter);
                $('#modalListApproval').modal('hide');
            },
            error: function(request) {
                alert(request.responseText);
                // alert('error');
            }
        });

    }

    function listBPB(filter) {
        $('#tableListBPB').DataTable().destroy();
        var dt = $('#tableListBPB').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Bpb/data') ?>",
                "type": "POST"
            },
            "language": {
                "infoFiltered": ""
            },

            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],
            // "columns": [{
            //         "width": "12%"
            //     },
            //     {
            //         "width": "5%"
            //     },
            //     {
            //         "width": "15%"
            //     },
            //     {
            //         "width": "20%"
            //     },
            //     {
            //         "width": "15%"
            //     },
            //     {
            //         "width": "8%"
            //     },
            //     {
            //         "width": "10%"
            //     },
            //     {
            //         "width": "8%"
            //     },

            //     {
            //         "width": "8%"
            //     }
            // ],
        });

        var rel = setInterval(function() {
            $('#tableListBPB').DataTable().ajax.reload();
            clearInterval(rel);
        }, 100);

        var detailRows = [];

        $('#tableListBPB tbody').on('click', 'tr td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = dt.row(tr);
            var idx = $.inArray(tr.attr('id'), detailRows);

            if (row.child.isShown()) {
                tr.removeClass('details');
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice(idx, 1);
            } else {
                tr.addClass('details');
                row.child(format(row.data()[1])).show();

                // Add to the 'open' array
                if (idx === -1) {
                    detailRows.push(tr.attr('id'));
                }
            }
        });

        dt.on('draw', function() {
            $.each(detailRows, function(i, id) {
                $('#' + id + ' td.details-control').trigger('click');
            });
        });


    }

    function modalListApproval(nobpb, norefbpb, prove) {
        // console.log(nobpb);
        // console.log(prove);
        $('#modalListApproval').modal('show');
        if (prove == 0) {
            $('#btn_setuju_all').show();
            $('#no_approve').show();
        } else if (prove == 2) {
            $('#btn_setuju_all').show();
            $('#no_approve').show();

        } else {
            $('#btn_setuju_all').hide();
            $('#no_approve').hide();

        }
        listBPBItem(nobpb, norefbpb);
    }

    function listBPBItem(nobpb, norefbpb) {
        $('#tableListBPBItem').DataTable().destroy();
        var dt = $('#tableListBPBItem').DataTable({
            "processing": true,
            "serverSide": true,
            "select": true,
            "order": [],
            // "select": true,
            "ajax": {
                "url": "<?php echo site_url('Bpb/detail_itembpb'); ?>",
                "type": "POST",
                "data": {
                    'nobpb': nobpb,
                    'norefbpb': norefbpb
                },
                "error": function(request) {
                    alert(request.responseText);
                }
            },
            "dom": 'Bfrtip',
            "buttons": [{
                    "text": "Select All",
                    "action": function() {
                        $('#tableListBPBItem').DataTable().rows().select();
                    }
                },
                {
                    "text": "Unselect All",
                    "action": function() {
                        $('#tableListBPBItem').DataTable().rows().deselect();
                    }
                }
            ],
            "columnDefs": [{
                    "targets": [1],
                    "visible": false,
                    "searchable": false
                },
                // {
                //     "targets": [3],
                //     "visible": false
                // }
            ],
            "language": {
                "infoFiltered": ""
            },


        });
        var rel = setInterval(function() {
            $('#tableListBPBItem').DataTable().ajax.reload();
            clearInterval(rel);
        }, 100);
    }
</script>