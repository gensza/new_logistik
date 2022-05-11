<div class="container-fluid">
    <div class="row justify-content-center">
        <div class=" col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2 justify-content-between">
                        <h4 class="header-title mb-0 ml-2"><?= $title; ?></h4>
                        <div class="button-list mr-2">

                            <button class="btn btn-xs btn-primary" id="cetak" onclick="modalcetak()">Cetak</button>
                        </div>
                        <!-- <a class="btn btn-info btn-rounded waves-effect waves-light mr-2" href="<?= base_url('Laporan/barang') ?>" target="_blank"><span class="fa fa-print"></span>&nbsp;&nbsp;Print</a> -->
                    </div>
                    <div class="table-responsive">
                        <table id="tabelBarang" class="table w-100 dataTable no-footer table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%" style="font-size: 12px; padding:10px">No.</th>
                                    <th style="font-size: 12px; padding:10px">Kode Barang</th>
                                    <th style="font-size: 12px; padding:10px">Part Number</th>
                                    <th style="font-size: 12px; padding:10px">Nama Barang/Material</th>
                                    <th width="8%" style="font-size: 12px; padding:10px">Satuan</th>

                                </tr>
                            </thead>

                            <tbody id="tbody_tabelBarang">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="modal_lap_brg">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Laporan Barang</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-3 col-form-label">Divisi *
                        </label>
                        <div class="col-12">
                            <select class="form-control form-control-sm" id="pilih_divisi" name="pilih_divisi" required="">
                                <option value="" selected>-- Pilih --</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="cetak()">Tampilkan</button>
                    <button type="button" class="btn btn-default" id="btn_cancel" class="close" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    table#tabelBarang td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }
</style>
<script>
    $(document).ready(function() {
        listLapBarang();
    });

    function cetak() {
        var kodedev = $('#pilih_divisi').val();
        window.open('barang/' + kodedev, '_blank');
    }

    function caridivisi() {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Laporan/cari_devisi'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: '',
            success: function(data) {
                var stl = '<?= $this->session->userdata('status_lokasi'); ?>';

                $.each(data, function(index) {
                    var opsi_cmb_company = '<option value="' + data[index].kodetxt + '">' + data[index].PT + '</option>';
                    $('#pilih_divisi').append(opsi_cmb_company);
                });
            },
            error: function(request) {
                alert("KONEKSI TERPUTUS! Tidak dapat mendapatkan divisi");
            }
        });
    }

    function modalcetak() {
        $('#modal_lap_brg').modal('show');
        $('#pilih_divisi').empty();
        caridivisi();
    }

    function listLapBarang() {
        $('#tabelBarang').DataTable().destroy();
        var dt = $('#tabelBarang').DataTable({
            "paging": true,
            "scrollY": true,
            "scrollX": true,
            "searching": true,
            "select": false,
            "bLengthChange": true,
            "scrollCollapse": true,
            "bPaginate": true,
            "bInfo": true,
            "bSort": false,
            "processing": true,
            "serverSide": true,
            "order": [],
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {},
            "ajax": {
                "url": "<?php echo site_url('Laporan/list_lapbarang'); ?>",
                "type": "POST",

                "error": function(request) {
                    alert("KONEKSI TERPUTUS! Tidak dapat mendapatkan data barang");
                }
            },
            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],
            "language": {
                "infoFiltered": ""
            }
        });

        var detailRows = [];

        $('#tabelBarang tbody').on('click', 'tr td.details-control', function() {
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
</script>