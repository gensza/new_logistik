<div class="container-fluid">

      <!-- start row-->
      <div class="row mt-0">
            <div class="col-12">
                  <div class="card">
                        <div class="card-body">
                              <div class="row justify-content-between" style="margin-top: -10px;">
                                    <h4 class="header-title ml-2 mb-3">Data BKB Retur</h4>
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

                              <table id="tableListRetur" class="table table-sm table-striped table-bordered" width="100%">
                                    <thead>
                                          <tr>
                                                <th width="11%" style="font-size: 12px; padding:10px">#</th>
                                                <th width="3%" style="font-size: 12px; padding:10px">No.</th>
                                                <th width="8%" style="font-size: 12px; padding:10px">Tgl Retur</th>
                                                <th width="18%" style="font-size: 12px; padding:10px">No. Ref Retur</th>
                                                <th width="17%" style="font-size: 12px; padding:10px">No. Ref BKB</th>
                                                <th width="8%" style="font-size: 12px; padding:10px">Bagian</th>
                                                <th width="15%" style="font-size: 12px; padding:10px">No. BA</th>
                                                <th width="13%" style="font-size: 12px; padding:10px">Keterangan</th>
                                                <th width="8%" style="font-size: 12px; padding:10px">Petugas</th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modal-approval-retur">
      <div class="modal-dialog modal-full-width modal-dialog-scrollable">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Detail BKB</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                  </div>
                  <div class="sub-header mb-2" style="margin-top: -20px; margin-left:17px;">
                        <span id="detail_noref_retur" style="font-size: 12px;"></span>
                  </div>
                  <div class="modal-body">
                        <div class="table-responsive" style="margin-top: -15px;">
                              <input type="hidden" id="hidden_id_retskb" name="hidden_id_retskb">
                              <table id="retur_approval" class="table table-striped table-bordered" style="width: 100%; border-collapse: separate; padding: 0 50px 0 50px;">
                                    <thead>
                                          <tr>
                                                <th class="no_th">No</th>
                                                <th>ID</th>
                                                <th class="kodebar_th">Kode&nbsp;Barang</th>
                                                <th class="nabar_th">Nama&nbsp;Barang</th>
                                                <th class="satuan_th">Satuan</th>
                                                <th class="qty_th">Qty Retur</th>
                                                <th class="ket_th">Keterangan</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot1>
                                          <!-- <tr>
                                                      <th style="text-align: center;" colspan="10"><button class="btn btn-sm btn-info" data-toggle="tooltip" id="btn_setuju_all" onclick="approve_barang()" data-placement="left">Approve</button></th>
                                                </tr> -->
                                    </tfoot1>
                              </table>
                        </div>
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  </div>
            </div>
      </div>
</div>

<style>
      .no_th {
            width: 3% !important;
      }

      .kodebar_th {
            width: 13% !important;
      }

      .nabar_th {
            width: 34% !important;
      }

      .satuan_th {
            width: 7% !important;
      }

      .qty_th {
            width: 7% !important;
      }

      .ket_th {
            width: 36% !important;
      }

      table#retur_approval th {
            padding: 10px;
            font-size: 12px;
      }

      table#retur_approval td {
            padding: 3px;
            padding-left: 10px;
            font-size: 12px;
      }

      table#tableListRetur td {
            padding: 3px;
            padding-left: 10px;
            font-size: 12px;
      }
</style>

<script>
      var table;
      $(document).ready(function() {

            //datatables
            table = $('#tableListRetur').DataTable({

                  // "scrollY": 400,
                  "scrollX": true,

                  "processing": true,
                  "serverSide": true,
                  "order": [],

                  "ajax": {
                        "url": "<?php echo site_url('Retur/get_data_retur') ?>",
                        "type": "POST"
                  },

                  "columnDefs": [{
                        "targets": [0],
                        "orderable": false,
                  }, ],

            });
      });

      $(document).ready(function() {
            $(document).on('click', '#approval_retur', function() {

                  var noref_bkb = $(this).data('norefretur');
                  var id_retskb = $(this).data('id_retskb');
                  var batal = $(this).data('batal');
                  // console.log(nabar);

                  $("#modalListItemBkb").modal('show');
                  if (batal != 1) {

                        $('#detail_noref_retur').html('<b>No. Ref. Retur : </b>' + noref_bkb);
                  } else {
                        $('#detail_noref_retur').html('<b>No. Ref. Retur : </b>' + noref_bkb + ' <span class="badge badge-danger">Dibatalkan</span>');

                  }
                  approval_retur(id_retskb);
            });
      });

      function approval_retur(id_retskb) {

            console.log(id_retskb);
            $("#modal-approval-retur").modal('show');

            $('#hidden_id_retskb').val(id_retskb);

            $(document).ready(function() {

                  $('#retur_approval').DataTable().destroy();
                  $('#retur_approval').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "select": true,

                        "ajax": {
                              "url": "<?php echo site_url('Retur/get_detail_approval') ?>",
                              "type": "POST",
                              "data": {
                                    id_retskb: id_retskb
                              }
                        },
                        "columnDefs ": [{
                              "targets": [0],
                              "orderable": false,

                        }, ],
                        // "dom": 'Bfrtip',
                        // "buttons": [{
                        //             "text": "Select All",
                        //             "action": function() {
                        //                   $('#retur_approval').DataTable().rows().select();
                        //             }
                        //       },
                        //       {
                        //             "text": "Unselect All",
                        //             "action": function() {
                        //                   $('#retur_approval').DataTable().rows().deselect();
                        //             }
                        //       }
                        // ],
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
            });
      }

      function setujui_barang(n) {

            $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('Retur/approval_retur') ?>",
                  dataType: "JSON",
                  data: {
                        id_ret_skbitem: n
                  },

                  success: function(data) {
                        console.log(data);
                        if (data == 0) {
                              swal('Item sudah di approve!');
                        }
                  },
                  error: function(response) {
                        alert('ERROR! ' + response.responseText);
                  }
            });
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

      function pilihItem() {
            var rowcollection = $('#retur_approval').DataTable().rows({
                  selected: true,
            }).data().toArray();

            var id_retskb = $('#hidden_id_retskb').val();

            $.each(rowcollection, function(index, elem) {
                  var id = rowcollection[index][1];

                  setujui_barang(id);
                  // console.log(id + 'ye');

            });
            $('#tableListRetur').DataTable().ajax.reload();
            approval_retur(id_retskb);
      }

      $(document).ready(function() {
            $(document).on('click', '#edit_retur', function() {

                  var id_retskb = $(this).data('id_retskb');
                  // console.log(id_retskb);

                  window.location.href = "Retur/edit_retur/" + id_retskb;

                  // $("#modalListItemLpb").modal('show');
                  // tampil_detail_lpb(no_lpb);
            });
      });
</script>