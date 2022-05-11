<div class="container-fluid">

    <div class="row col-lg-12 col-xl-12 col-12 mt-2">
        <div class="col-lg-5 col-xl-5 col-12">
            <div class="card-box">
                <div style="margin-top: -20px;">
                    <h4><span class="badge bg-blue p-2 text-white">SPP</span></h4>
                </div>
                <div class="row" style="margin-bottom: -10px;">
                    <div class="col-2">
                    </div>
                    <div class="col-3" style="margin-top: -50px;">
                        <a href="<?= base_url('Spp'); ?>" class="btn btn-white p-1 btn-rounded waves-effect">
                            <h3 class="text-dark"><span><?= $count['count_spp_approved'] ?></span></h3>
                            <p class="text-muted" style="font-size:small">Approved</p>
                        </a>
                    </div>
                    <!-- <div class="col-1"></div> -->
                    <div class="col-3" style="margin-top: -50px;">
                        <a href="<?= base_url('Spp/sppApproval'); ?>" class="btn btn-white p-1 btn-rounded waves-effect">
                            <h3 class="text-dark"><span><?= $count['count_spp'] ?></span></h3>
                            <p class="text-muted" style="font-size:small">Menunggu</p>
                        </a>
                    </div>
                    <!-- <div class="col-1"></div> -->
                    <div class="col-3" style="margin-top: -50px;">
                        <a href="<?= base_url('Spp/dataNoCoa'); ?>" class="btn btn-white p-1 btn-rounded waves-effect">
                            <h3 class="text-dark"><span><?= $count['count_spp_no_coa'] ?></span></h3>
                            <p class="text-muted" style="font-size:small">No COA</p>
                        </a>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->



        <div class="col-lg-3 col-xl-3 col-12">
            <div class="card-box">
                <div style="margin-top: -20px;">
                    <h4><span class="badge bg-success p-2 text-white">PO</span></h4>
                </div>
                <div class="row" style="margin-bottom: -10px;">
                    <div class="col-3">
                        <!-- <div class="avatar-sm bg-success rounded">
                                <i class="fe-clipboard avatar-title font-22 text-white"></i>
                            </div> -->
                    </div>
                    <div class="col-4"></div>
                    <div class="col-3 ml-4" style="margin-top: -50px;">
                        <a href="<?= base_url('Po'); ?>" class="btn btn-white p-1 btn-rounded waves-effect">
                            <h3 class="text-dark"><span><?= $count['count_po'] ?></span></h3>
                            <p class="text-muted" style="font-size:small">Total</p>
                        </a>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->
        <div class="col-lg-4 col-xl-4 col-12">
            <div class="card-box">
                <div style="margin-top: -20px;">
                    <h4><span class="badge bg-warning p-2 text-white">PP</span></h4>
                </div>
                <div class="row" style="margin-bottom: -10px;">
                    <div class="col-3">
                        <!-- <div class="avatar-sm bg-warning rounded">
                                <i class="fe-credit-card  avatar-title font-22 text-white"></i>
                            </div> -->
                    </div>
                    <div class="col-4"></div>
                    <div class="col-3 ml-4" style="margin-top: -50px;">
                        <a href="<?= base_url('Pp'); ?>" class="btn btn-white p-1 btn-rounded waves-effect">
                            <h3 class="text-dark"><span><?= $count['count_pp'] ?></span></h3>
                            <p class="text-muted" style="font-size:small">Total</p>
                        </a>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->
        <div class="col-lg-4 col-xl-4 col-12">
            <div class="card-box">
                <div style="margin-top: -20px;">
                    <h4><span class="badge bg-info p-2 text-white">LPB</span></h4>
                </div>
                <div class="row" style="margin-bottom: -10px;">
                    <div class="col-3">
                        <!-- <div class="avatar-sm bg-info rounded">
                                <i class="fe-plus-square avatar-title font-22 text-white"></i>
                            </div> -->
                    </div>
                    <div class="col-4"></div>
                    <div class="col-3 ml-4" style="margin-top: -50px;">
                        <a href="<?= base_url('Lpb'); ?>" class="btn btn-white p-1 btn-rounded waves-effect">
                            <h3 class="text-dark"><span><?= $count['count_lpb'] ?></span></h3>
                            <p class="text-muted" style="font-size:small">Total</p>
                        </a>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->
        <div class="col-lg-4 col-xl-4 col-12">
            <div class="card-box">
                <div style="margin-top: -20px;">
                    <h4><span class="badge bg-secondary p-2 text-white">BPB</span></h4>
                </div>
                <div class="row" style="margin-bottom: -10px;">
                    <div class="col-3">
                        <!-- <div class="avatar-sm bg-secondary rounded">
                                <i class="fe-file-text avatar-title font-22 text-white"></i>
                            </div> -->
                    </div>
                    <div class="col-3" style="margin-top: -50px;">
                        <a href="<?= base_url('Bpb'); ?>" class="btn btn-white p-1 btn-rounded waves-effect">
                            <h3 class="text-dark"><span><?= $count['count_bpb_approved'] ?></span></h3>
                            <p class="text-muted" style="font-size:small">Approved</p>
                        </a>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-3" style="margin-top: -50px;">
                        <a href="<?= base_url('Bpb'); ?>" class="btn btn-white p-1 btn-rounded waves-effect">
                            <h3 class="text-dark"><span><?= $count['count_bpb'] ?></span></h3>
                            <p class="text-muted" style="font-size:small">Menunggu</p>
                        </a>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->
        <div class="col-lg-4 col-xl-4 col-12">
            <div class="card-box">
                <div style="margin-top: -20px;">
                    <h4><span class="badge bg-danger p-2 text-white">BKB</span></h4>
                </div>
                <div class="row" style="margin-bottom: -10px;">
                    <div class="col-3">
                        <!-- <div class="avatar-sm bg-danger rounded">
                                <i class="fe-truck avatar-title font-22 text-white"></i>
                            </div> -->
                    </div>
                    <div class="col-3 ml-2" style="margin-top: -50px;">
                        <a href="<?= base_url('Bkb'); ?>" class="btn btn-white p-1 btn-rounded waves-effect">
                            <h3 class="text-dark"><span><?= $count['count_bkb'] ?></span></h3>
                            <p class="text-muted" style="font-size:small">Total</p>
                        </a>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-3" style="margin-top: -50px;">
                        <a href="<?= base_url('Bkb/approval_rev_qty'); ?>" class="btn btn-white p-1 btn-rounded waves-effect">
                            <h3 class="text-dark"><span><?= $count['count_bkb_rev_qty'] ?></span></h3>
                            <p class="text-muted" style="font-size:small">Rev&nbsp;QTY</p>
                        </a>
                    </div>
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col -->
    </div>
    <div class="ml-2 mr-4" style="margin-top: -10px;">
        <?php
        if ($pt_login == 'MSAL') {
            echo "<div class='external-event bg-primary text-right p-0 mt-0' data-class=bg-info'>";
            echo "<marquee>";
            echo "<h3 class='text-white'>PT. MULIA SAWIT AGRO LESTARI</h3>";
            echo "</marquee>";
            echo "</div>";
        } elseif ($pt_login == 'MAPA') {
            echo "<div class='external-event bg-success text-right p-0 mt-0' data-class=bg-info'>";
            echo "<marquee>";
            echo "<h3 class='text-white'>PT. MITRA AGRO PERSADA ABADI</h3>";
            echo "</marquee>";
            echo "</div>";
        } elseif ($pt_login == 'PEAK') {
            echo "<div class='external-event bg-warning text-right p-0 mt-0' data-class=bg-info'>";
            echo "<marquee>";
            echo "<h3 class='text-white'>PT. PERSADA ERA AGRO KENCANA</h3>";
            echo "</marquee>";
            echo "</div>";
        } elseif ($pt_login == 'PSAM') {
            echo "<div class='external-event bg-info text-right p-0 mt-0' data-class=bg-info'>";
            echo "<marquee>";
            echo "<h3 class='text-white'>PT. PERSADA SEJAHTERA AGRO MAKMUR</h3>";
            echo "</marquee>";
            echo "</div>";
        } elseif ($pt_login == 'KPP') {
            echo "<div class='external-event bg-danger text-right p-0 mt-0' data-class=bg-info'>";
            echo "<marquee>";
            echo "<h3 class='text-white'>PT. KERENG PANGI PERDANA</h3>";
            echo "</marquee>";
            echo "</div>";
        }
        ?>
    </div>
    <?php if ($this->session->userdata('nama_dept') == 'PURCHASING' && $this->session->userdata('status_lokasi') != 'HO') { ?>
        <div class="row col-12">
            <div class="col-lg-6 col-xl-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between ml-0 mr-0 mb-2">
                            <h4 class="header-title mb-0"><b>BPB (Permintaan Antar PT & Kebun)</b></h4>
                            <!-- <a href="<?= base_url('Lpb/lpb_mutasi') ?>" class="btn btn-sm btn-info">Terima Mutasi</a> -->
                        </div>

                        <div class="table-responsive">

                            <table class="table table-sm table-hover table-bordered w-100" id="tabel_bpb_mutasi">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="3%" style="font-size: 12px; padding:10px; text-align: center;">No</th>
                                        <th width="15%" style="font-size: 12px; padding:10px; text-align: center;">Tgl&nbsp;BPB</th>
                                        <th width="20%" style="font-size: 12px; padding:10px; text-align: center;">Ref.&nbsp;BPB</th>
                                        <th width="10%" style="font-size: 12px; padding:10px; text-align: center;">Bagian</th>
                                        <th width="20%" style="font-size: 12px; padding:10px; text-align: center;">Keperluan</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div>

            <div class="col-lg-6 col-xl-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <small class="float-right mt-0"><?= 'Periode: ' . $pt_periode ?></small><br> -->
                        <div class="row justify-content-between ml-0 mr-0 mb-2">
                            <h4 class="header-title mb-0"><b>Mutasi Masuk</b></h4>
                            <!-- <a href="<?= base_url('Lpb/lpb_mutasi') ?>" class="btn btn-sm btn-info">Terima Mutasi</a> -->
                        </div>

                        <div class="table-responsive">

                            <table class="table table-sm table-hover table-bordered w-100" id="tabel_mutasi">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="3%" style="font-size: 12px; padding:10px; text-align: center;">No</th>
                                        <th width="15%" style="font-size: 12px; padding:10px; text-align: center;">Tgl&nbsp;BKB</th>
                                        <th width="20%" style="font-size: 12px; padding:10px; text-align: center;">Ref.&nbsp;Mutasi</th>
                                        <th width="10%" style="font-size: 12px; padding:10px; text-align: center;">Asal&nbsp;PT</th>
                                        <th width="20%" style="font-size: 12px; padding:10px; text-align: center;">PT&nbsp;Tujuan</th>
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
    <?php } ?>
    <?php if ($this->session->userdata('status_lokasi') == 'HO') { ?>
        <div class="row col-12">
            <div class="col-lg-12 col-xl-12 col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row justify-content-between" style="margin-top: -10px;">
                            <h4 class="header-title ml-2 mb-3">Approval Spp Tanpa Coa</h4>
                            <div class="row form-group mr-0">
                                <div class="col-2">
                                    <label for="" style="margin-top: 3px;">Filter</label>
                                </div>
                                <div class="col-10">
                                    <select class="form-control form-control-sm" id="filter_spp" name="filter_spp">
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
                        </div>

                        <div class="table-responsive" style="margin-top: -10px;">
                            <table id="tb_approval" class="table w-100 dataTable no-footer table-bordered table-striped">
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
    <?php } ?>

</div>

<!-- modal approval spp no coa -->
<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="sppNoCoa">
    <div class="modal-dialog modal-full-width modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Pilih SPP</h4>
                <button type="button" class="close" onclick="close_modal()"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="sub-header mb-2" style="margin-top: -20px; margin-left:17px;">
                <span id="detail_noref_spp" style="font-size: 12px; "><b style="color: crimson;">Pastikan Nama Barang dan Grup sudah benar!</b></span>
            </div>
            <div class="modal-body">
                <div class="table-responsive" style="margin-top: -15px;">
                    <input type="hidden" id="hidden_id_ppo" name="hidden_no_row">
                    <input type="hidden" id="hidden_noref_spp">
                    <table id="spp_approval_no_coa" class="table table-striped table-bordered" style="width: 100%; border-collapse: separate; padding: 0 50px 0 50px;">
                        <thead>
                            <tr>
                                <th width="5%" style="font-size: 12px; padding:10px">No</th>
                                <th width="45%" style="font-size: 12px; padding:10px">Nama&nbsp;Barang </th>
                                <th width="40%" style="font-size: 12px; padding:10px">Grup</th>
                                <th width="10%" style="font-size: 12px; padding:10px">Approval</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="close_modal()">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- ends -->

<style>
    table#tb_approval td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#tb_approval th {
        padding: 10px;
        font-size: 12px;
    }

    table#tabel_mutasi td {
        padding: 10px;
        font-size: 12px;
        cursor: pointer;
    }

    table#tabel_bpb_mutasi td {
        padding: 10px;
        font-size: 12px;
        cursor: pointer;
    }

    table#spp_approval_no_coa td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#spp_approval_no_coa th {
        padding: 10px;
        font-size: 12px;
    }
</style>

<script>
    // $(document).ready(function() {
    //     $('#tabel_mutasi').DataTable({
    //         "dom": 'lfrtip',
    //         "select": false,
    //         "bLengthChange": false,
    //         "scrollCollapse": false,
    //     });
    //     // $('.dataTables_filter').addClass('pull-left');
    // });

    function close_modal() {
        $('#sppNoCoa').modal('hide');
        // spp_aproval();

        var data = "SEMUA";
        spp_aproval(data);
    }

    function grub_coa(id) {

        $('.grpCoa').select2({
            ajax: {
                url: "<?php echo site_url('Home/get_grp_coa') ?>",
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
                            id: item.nama,
                            text: item.nama
                        });
                    });
                    return {
                        results: results
                    };
                }
            }

        });

    }

    function spp_approval_no_coa(id, pt, alias) {
        $('#spp_approval_no_coa').DataTable().destroy();
        $('#spp_approval_no_coa').DataTable({

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
            $('#spp_approval_no_coa').DataTable().ajax.reload();
            clearInterval(rel);
        }, 100);
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

    function edit_ppo_tmp(id, noref, kodebar, alias, pt) {
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
                alias: alias,
                pt: pt,
            },
            success: function(data) {
                var kode = $('#hidden_id_ppo').val();
                spp_approval_no_coa(kode, pt, alias)
            },
            error: function(request) {
                console.log(request.responseText);
            }
        });
    }

    function modalSppApprove(id, noref, pt, alias) {
        $("#sppNoCoa").modal('show');

        var id_ppo = id;
        var noref_spp = noref;
        $('#hidden_id_ppo').val(id_ppo);
        $('#hidden_noref_spp').val(noref_spp);
        // console.log(alias);
        spp_approval_no_coa(id, pt, alias)
    }

    function spp_aproval(data) {
        $('#tb_approval').DataTable().destroy();
        $('#tb_approval').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],
            // "select": true,
            "ajax": {
                "url": "<?php echo site_url('Home/get_no_coa') ?>",
                "type": "POST",
                "data": {
                    data: data
                }
            },

            "language": {
                "infoFiltered": ""
            },


        });
        var rel = setInterval(function() {
            $('#tb_approval').DataTable().ajax.reload();
            clearInterval(rel);
        }, 100);
    }

    var table;
    $(document).ready(function() {

        $('#filter_spp').change(function() {
            var data = this.value;
            console.log(data);
            // dataSppFilter(data);
            spp_aproval(data)
        });
        var data = "SEMUA";
        spp_aproval(data);


        //datatables mutasi
        table = $('#tabel_mutasi').DataTable({

            // "scrollY": 221,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Home/get_data_mutasi') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
            "language": {
                "infoFiltered": ""
            },
            "drawCallback": function(settings) {
                $('#tabel_mutasi tr').each(function() {
                    var Cell = $(this).find('td');

                    Cell.parent().on('mouseover', Cell, function() {
                        Cell.parent().css('background-color', '#26b99a');
                        Cell.parent().css('color', '#ffffff');

                        Cell.parent().bind("mouseout", function() {
                            Cell.parent().css('background-color', '');
                            Cell.parent().css('color', '#73879c');
                        });
                    });
                });
            },

        });

        //datatables BPB antar PT
        table = $('#tabel_bpb_mutasi').DataTable({

            // "scrollY": 221,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Home/get_data_bpb_mutasi') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
            "language": {
                "infoFiltered": ""
            },
            "drawCallback": function(settings) {
                $('#tabel_bpb_mutasi tr').each(function() {
                    var Cell = $(this).find('td');

                    Cell.parent().on('mouseover', Cell, function() {
                        Cell.parent().css('background-color', '#26b99a');
                        Cell.parent().css('color', '#ffffff');

                        Cell.parent().bind("mouseout", function() {
                            Cell.parent().css('background-color', '');
                            Cell.parent().css('color', '#73879c');
                        });
                    });
                });
            },

        });

    });

    $('#tabel_mutasi tbody').on('click', 'tr', function() {
        var dataClick = $('#tabel_mutasi').DataTable().row(this).data();
        var no_ref_mutasi = dataClick[2];
        var noref_rpc = no_ref_mutasi.replaceAll('/', '.');

        window.open('Lpb/lpb_mutasi/' + noref_rpc + '/', '_blank');
    });

    $('#tabel_bpb_mutasi tbody').on('click', 'tr', function() {
        var dataClick = $('#tabel_bpb_mutasi').DataTable().row(this).data();
        var no_ref_bpb = dataClick[2];
        var noref_rpc = no_ref_bpb.replaceAll('/', '.');

        window.open('Bkb/input/' + noref_rpc + '/', '_blank');
    });
</script>