<div class="container-fluid">

    <!-- start row-->
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="widget-rounded-circle card-box">
                <div class="row justify-content-between">
                    <h4 class="header-title" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Approval Revisi QTY</h4>
                    <div class="form-group">
                        <select class="form-control" id="filter" name="filter">
                            <option value="">Semua</option>
                        </select>
                    </div>
                </div>

                <table id="tableApprovalRevQty" class="table table-sm table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">Approval</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">No.</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">No. Ref BPB</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">Kode Barang</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">Nama Barang</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">Qty</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">Revisi Qty</th>
                            <th style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; padding: 0.4em;">Request Oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#tableApprovalRevQty').DataTable({

            "scrollY": 400,
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