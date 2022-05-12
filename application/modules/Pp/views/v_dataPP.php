<div class="container-fluid">
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
                                    <select class="form-control form-control-sm" id="filter_pp" name="filter_pp">
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
                        <table id="tableListPP" class="table w-100 dataTable no-footer table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px; padding:10px">#</th>
                                    <th style="font-size: 12px; padding:10px">No.</th>
                                    <th style="font-size: 12px; padding:10px">Ref. PP</th>
                                    <th style="font-size: 12px; padding:10px">Tgl. PP</th>
                                    <th style="font-size: 12px; padding:10px">Nama Supplier</th>
                                    <th style="font-size: 12px; padding:10px">User Input</th>
                                    <th style="font-size: 12px; padding:10px">Ket</th>
                                    <th style="font-size: 12px; padding:10px">Status</th>
                                </tr>
                            </thead>

                            <tbody id="tbody_list_pp">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true" id="modalKonfirmasiHapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <h4 class="mt-2">Konfirmasi Batal</h4>
                    
                    <p class="mt-3">Apakah anda yakin ingin membatalkan pp ini ???</p>
                    <button type="button" class="btn btn-warning my-2" data-dismiss="modal" id="btn_delete" onclick="hapusPP()">Batalkan</button>
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="detailpp">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header ml-2">
                <h4 style="font-size: 15px;" class="modal-title" id="detailpp">Detail PP</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="sub-header mb-2" style="margin-top: -20px; margin-left:28px;">
                <span id="no_vocer" style="font-size: 12px;"></span>
                <span id="detail_noref_pp" style="font-size: 12px;"></span>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="table-responsive" style="margin-top: -15px;">
                        <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                        <table id="datapp" class="table table-striped table-bordered" style="width: 100%; border-collapse: separate; padding: 0 50px 0 50px;">
                            <thead>
                                <tr>
                                    <th width="3%" style="font-size: 12px; padding:10px">No</th>
                                    <th width="15%" style="font-size: 12px; padding:10px">Ref.&nbsp;PO</th>
                                    <th width="15%" style="font-size: 12px; padding:10px">Tgl.&nbsp;PO</th>
                                    <th width="10%" style="font-size: 12px; padding:10px">Pembayaran</th>
                                    <th width="15%" style="font-size: 12px; padding:10px">Total&nbsp;PO</th>
                                    <th width="5%" style="font-size: 12px; padding:10px">Jumlah</th>
                                    <th width="20%" style="font-size: 12px; padding:10px">Sudah&nbsp;Bayar</th>
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
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="alasanbatal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <h4 class="mt-2">Alasan Batal</h4>
                    <input type="hidden" id="id_pp" name="id_pp">
                    <input type="hidden" id="nopp" name="nopp">
                    <input type="hidden" id="ref_po" name="ref_po">
                    <input type="hidden" id="jumlah" name="jumlah">
                    <input type="hidden" id="nopo" name="nopo">
                    <textarea class="form-control" id="alasan" rows="4" required></textarea>
                    <button type="button" class="btn btn-warning my-2" id="btn_delete" onclick="validasibatal()">Batalkan</button>
                    <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    table#tableListPP td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }

    table#datapp td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }
</style>

<script>
    $(document).ready(function() {
        $('#filter').change(function() {
            var data = this.value;
            console.log(data, "BY ALI DEV");
            listPP(data);

        });

        //datatables
        var data = "SEMUA";
        listPP(data);

    });

    function listPP(data) {
        $('#tableListPP').DataTable().destroy();
        var dt = $('#tableListPP').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('Pp/list_pp'); ?>",
                "type": "POST",
                "data": {
                    data: data,
                    // kodedev: kodedev,
                },
                "error": function(request) {
                    console.log(request.responseText);
                }
            },
            "columns": [{
                    "width": "10%"
                },
                {
                    "width": "3%"
                },
                {
                    "width": "18%"
                },

                {
                    "width": "8%"
                },
                {
                    "width": "20%"
                },
                {
                    "width": "8%"
                },
                {
                    "width": null
                },
                {
                    "width": "5%"
                },


            ],
            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],
            "language": {
                "infoFiltered": ""
            }

        });
        var rel = setInterval(function() {
            $('#tableListPP').DataTable().ajax.reload();
            clearInterval(rel);
        }, 100);
    }

    function detail(id, batal) {
        $('#detailpp').modal('show');
        ambilnorefpp(id, batal);

        $('#datapp').DataTable().destroy();
        $('#datapp').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('Pp/detail_pp'); ?>",
                "type": "POST",
                "data": {
                    id: id,
                    // kodedev: kodedev,
                },
                "error": function(request) {
                    console.log(request.responseText);
                }
            },

            "columns": [{
                    "width": "5%"
                },
                {
                    "width": "15%"
                },
                {
                    "width": "5%"
                },
                {
                    "width": "10%"
                },
                {
                    "width": "15%"
                },
                {
                    "width": "15%"
                },
                {
                    "width": "15%"
                },

            ],
            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],
            "language": {
                "infoFiltered": ""
            }

        });
        var rel = setInterval(function() {
            $('#datapp').DataTable().ajax.reload();
            clearInterval(rel);
        }, 100);
    }

    function ambilnorefpp(id, batal) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Pp/ambilnorefPP') ?>",
            dataType: "JSON",
            beforeSend: function() {},
            data: {
                id: id,
            },
            success: function(data) {
                if (batal != 0) {
                    $('#detail_noref_pp').html('<b>No. Ref. PP : </b>' + data.ref_pp + ' <span class="badge badge-danger">Dibatalkan</span>');
                } else {
                    $('#detail_noref_pp').html('<b>No. Ref. PP : </b>' + data.ref_pp);
                    if (data.status_vou == 1) {
                        $('#no_vocer').html('<b>No. Voucher : </b>' + data.no_voutxt + ' | ');
                    } else {
                        $('#no_vocer').html('');
                    }
                }
            }
        });
    }


    function deletePP(id, nopp, jumlah, nopo) {
        // console.log(id, nopp);
        $('#id_pp').val(id);
        $('#nopp').val(nopp);
        // $('#ref_po').val(ref_po);
        $('#jumlah').val(jumlah);
        $('#nopo').val(nopo);
        // $('#modalKonfirmasiHapus').modal('show');
        $('#alasanbatal').modal('show');
    }

    function alasanbatal() {

    }

    function validasibatal() {
        var alasan = $('#alasan').val();
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
            hapusPP();
        }
    }

    function hapusPP() {
        // listPP();

        $('#alasanbatal').modal('hide');
        // $('#modalKonfirmasiHapus').modal('hide');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Pp/deletePP') ?>",
            dataType: "JSON",
            beforeSend: function() {},
            data: {
                id_pp: $('#id_pp').val(),
                nopp: $('#nopp').val(),
                // ref_po: $('#ref_po').val(),
                jumlah: $('#jumlah').val(),
                nopo: $('#nopo').val(),
                alasan: $('#alasan').val(),
            },
            success: function(data) {
                console.log(data)
                $.toast({
                    position: 'top-right',
                    heading: 'Dihapus',
                    text: 'Berhasil Dibatalkan!',
                    icon: 'success',
                    loader: false
                });

                listPP();
            }
        });
    }
</script>