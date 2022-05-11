<div class="container-fluid">

    <!-- start row-->
    <div class="row mt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between" style="margin-top: -10px;">
                        <h4 class="header-title ml-2 mb-3">Approval Revisi QTY</h4>
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

                    <table id="tableApprovalRevQty" class="table table-sm table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th style="font-size: 12px; padding:10px">Approval</th>
                                <th style="font-size: 12px; padding:10px">No.</th>
                                <th style="font-size: 12px; padding:10px">No. Ref BPB</th>
                                <th style="font-size: 12px; padding:10px">Kode Barang</th>
                                <th style="font-size: 12px; padding:10px">Nama Barang</th>
                                <th style="font-size: 12px; padding:10px">Qty</th>
                                <th style="font-size: 12px; padding:10px">Revisi Qty</th>
                                <th style="font-size: 12px; padding:10px">Request Oleh</th>
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

<style>
    table#tableApprovalRevQty td {
        padding: 3px;
        padding-left: 10px;
        font-size: 12px;
    }
</style>
<script>
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#tableApprovalRevQty').DataTable({

            // "scrollY": 400,
            "scrollX": true,

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('Bkb/get_data_rev_qty') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
            "language": {
                "infoFiltered": ""
            },
        });
    });

    // pilih item dari data table server side
    $(document).ready(function() {
        $(document).on('click', '#approve_rev_qty', function() {

            var id_approval_bpb = $(this).data('id_approval_bpb');
            var norefbpb = $(this).data('norefbpb');
            var kodebar = $(this).data('kodebar');
            var qty_rev = $(this).data('qty_rev');

            Swal.fire({
                text: "Approve Revisi QTY?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya Approve!'
            }).then((result) => {
                if (result.value) {
                    approve_rev_qty(id_approval_bpb, norefbpb, kodebar, qty_rev);
                }
            });
        });
    });

    function approve_rev_qty(id_approval_bpb, norefbpb, kodebar, qty_rev) {

        // console.log(id_approval_bpb);
        // console.log(norefbpb);
        // console.log(kodebar);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Bkb/ktu_approve_rev_qty') ?>",
            dataType: "JSON",
            data: {
                id_approval_bpb: id_approval_bpb,
                norefbpb: norefbpb,
                kodebar: kodebar,
                qty_rev: qty_rev
            },
            success: function(data) {
                //refresh table
                $.toast({
                    position: 'top-right',
                    heading: 'Success',
                    text: 'Approve revisi QTY Berhasil!',
                    icon: 'success',
                    loader: false
                });

                location.reload();
            }
        });
    }
</script>