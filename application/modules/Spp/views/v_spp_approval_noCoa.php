<div class="container-fluid">

    <div class="row mt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between" style="margin-top: -10px;">
                        <h4 class="header-title ml-2 mb-3">Approval SPP Tanpa COA</h4>
                        <div class="form-group mr-2">
                            <select class="form-control form-control-sm" id="filter_spp_no_coa" name="filter_spp_no_coa">
                                <option value="SEMUA" selected>TAMPILKAN SEMUA</option>
                                <?php
                                foreach ($pt as $d) : {
                                ?>
                                        <option value="<?= $d['alias']; ?>"><?= $d['nama_pt']; ?></option>
                                <?php
                                    }
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datasppapproval_NoCOA" class="table w-100 dataTable no-footer table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%" style="font-size: 12px; padding:10px">Approval</th>
                                    <th width="4%" style="font-size: 12px; padding:10px">No</th>
                                    <th width="16%" style="font-size: 12px; padding:10px">No. Ref. SPP</th>
                                    <th width="18%" style="font-size: 12px; padding:10px">PT</th>
                                    <th width="9%" style="font-size: 12px; padding:10px">Departement</th>
                                    <th width="5%" style="font-size: 12px; padding:10px">Lokasi</th>
                                    <th width="6%" style="font-size: 12px; padding:10px">Status SPP</th>
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

<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="spp-approval">
    <div class="modal-dialog modal-full-width modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Pilih SPP</h4>
                <button type="button" class="close" onclick="tutup_modal()"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="sub-header mb-2" style="margin-top: -20px; margin-left:17px;">
                <span id="detail_noref_spp" style="font-size: 12px; "><b style="color: crimson;">Pastikan Nama Barang dan Grup sudah benar!</b></span>
            </div>
            <div class="modal-body">
                <div class="table-responsive" style="margin-top: -15px;">
                    <input type="hidden" id="hidden_id_ppo" name="hidden_no_row">
                    <input type="hidden" id="hidden_noref_spp">
                    <table id="spp_approval_noCoa" class="table table-striped table-bordered" style="width: 100%; border-collapse: separate; padding: 0 50px 0 50px;">
                        <thead>
                            <tr>
                                <th class="no_th">No</th>
                                <th class="nabar_th">Nama&nbsp;Barang </th>
                                <th class="ket_th">Grup</th>
                                <!-- <th class="status_th">Status&nbsp;SPP</th> -->
                                <th class="btn_th">Approval</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="tutup_modal()">Tutup</button>
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
        width: 35% !important;
    }

    .ket_th {
        width: 30% !important;
    }

    .btn_th {
        width: 8% !important;
    }

    .sat_th,
    .qty_th,
    .stok_th {
        width: 5% !important;
    }

    table#datasppapproval_NoCOA td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#spp_approval_noCoa td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#spp_approval_noCoa th {
        padding: 10px;
        font-size: 12px;
    }
</style>
<script>
    $(document).ready(function() {
        var data = "SEMUA";
        listApproval(data);


        $('#filter_spp_no_coa').change(function() {
            var data = this.value;
            console.log(data);
            // dataSppFilter(data);
            listApproval(data)
        });

    });

    function tutup_modal() {
        $('#spp-approval').modal('hide');
        listApproval();
    }

    function get_grub(id) {
        $('.grp_coa').select2({
            ajax: {
                url: "<?php echo site_url('Spp/get_grp_coa') ?>",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        grp: params.term, // search term
                    };
                },
                processResults: function(data) {
                    var results = [];
                    $.each(data, function(index, item) {
                        results.push({
                            id: item.grp,
                            text: item.grp
                        });
                    });
                    return {
                        results: results
                    };
                }
            }

        });

    }

    function validasi_acc(id, pt, alias) {
        var id = $('#id_nocoa_' + id).val();
        var noref = $('#noref_' + id).val();
        var kodebar = $('#kodebar_' + id).val();
        var nama = $('#nama_' + id).val();
        var grp = $('#grp_coa_' + id).val();
        var status = 12;


        if (nama == '') {
            $.toast({
                position: 'top-right',
                heading: 'Failed!',
                text: 'Nama barang harus diisi!',
                icon: 'error',
                loader: true,
                loaderBg: 'red'
            });
            $('#nama_' + id).css({
                "background": "#FFCECE"
            });
        } else if (grp == 0) {
            $.toast({
                position: 'top-right',
                heading: 'Failed!',
                text: 'Grup barang harus diisi!',
                icon: 'error',
                loader: true,
                loaderBg: 'red'
            });
            $('#grp_coa_' + id).css({
                "background": "#FFCECE"
            });

        } else {
            $('#nama_' + id).css({
                "background": "#FFFFFF"
            });
            $('#grp_coa_' + id).css({
                "background": "#FFFFFF"
            });

            // console.log(pt);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Spp/approve_noCOA'); ?>",
                dataType: "JSON",
                beforeSend: function() {
                    $('#simpan_approve_' + id).css('display', 'none');
                    $('#no_approve_' + id).css('display', 'none');
                    $('#status_approve_' + id).empty();
                    $('#status_approve_' + id).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i></label>');
                },
                cache: false,
                data: {
                    id: id,
                    noref: noref,
                    nama: nama,
                    kodebar: kodebar,
                    grp: grp,
                    status: status,
                    pt: pt,
                    alias: alias,
                },
                success: function(data) {
                    var kode = $('#hidden_id_ppo').val();
                    edit_ppo_tmp(kode, noref, kodebar, alias, pt)
                    // console.log('oke field ppo berhasil diupdate', data);
                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });
        }

    }

    function update_ppo_tmp(id, noref, kodebar) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Spp/update_ppo_tmp'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                id: id,
                noref: noref,
                kodebar: kodebar,
            },
            success: function(data) {
                var kode = $('#hidden_id_ppo').val();
                spp_approval_noCoa(kode)
            },
            error: function(request) {
                console.log(request.responseText);
            }
        });
    }

    // function modalSppApproval(id, noref) {
    //     $("#spp-approval").modal('show');

    //     var id_ppo = id;
    //     var noref_spp = noref;
    //     $('#hidden_id_ppo').val(id_ppo);
    //     $('#hidden_noref_spp').val(noref_spp);
    //     spp_approval_noCoa(id)
    // }

    function modalSppApproval(id, noref, pt, alias) {
        $("#spp-approval").modal('show');

        var id_ppo = id;
        var noref_spp = noref;
        $('#hidden_id_ppo').val(id_ppo);
        $('#hidden_noref_spp').val(noref_spp);
        // console.log(alias);
        spp_approval_noCoa(id, pt, alias)
    }

    function spp_approval_noCoa(id, pt, alias) {
        $('#spp_approval_noCoa').DataTable().destroy();
        $('#spp_approval_noCoa').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],
            // "select": true,
            "ajax": {
                "url": "<?php echo site_url('Home/detail_approval_noCOA') ?>",
                "type": "POST",
                "data": {
                    id_ppo: id,
                    pt: pt,
                    alias: alias,
                }
            },

            "language": {
                "infoFiltered": ""
            },


        });
        var rel = setInterval(function() {
            $('#spp_approval_noCoa').DataTable().ajax.reload();
            clearInterval(rel);
        }, 100);
    }


    function inputtest(id) {
        // $(this).val($(this).val().toUpperCase());
        $('#nama_' + id).keyup(function() {
            $(this).val($(this).val().toUpperCase());
            // console.log('oke');
        });
    }

    function listApproval(data) {
        $('#datasppapproval_NoCOA').DataTable().destroy();
        $('#datasppapproval_NoCOA').DataTable({

            "fixedColumns": true,
            "fixedHeader": true,
            // "scrollY": 400,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Home/get_no_coa') ?>",
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

        var rel = setInterval(function() {
            $('#datasppapproval_NoCOA').DataTable().ajax.reload();
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
                "url": "<?php echo site_url('Spp/get_detail_noCoa') ?>",
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