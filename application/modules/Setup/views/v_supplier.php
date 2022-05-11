<div class="account-pages">
      <div class="row">
            <div class="col-12">
                  <div class="card bg-pattern">

                        <div class="card-body">
                              <!-- title-->
                              <div class="row justify-content-between">
                                    <h4 class="header-title"><?= $tittle; ?></h4>
                                    <button class="btn btn-xs btn-success" onclick="tambahSupplier()">Tambah Supplier</button>
                              </div>

                              <div class="table-responsive mt-2">
                                    <table id="dataSupplier" class="table w-100 dataTable no-footer table-bordered table-striped">
                                          <thead>
                                                <tr>
                                                      <th style="font-size: 12px; padding:10px">#</th>
                                                      <th style="font-size: 12px; padding:10px">No</th>
                                                      <th style="font-size: 12px; padding:10px">Kode</th>
                                                      <th style="font-size: 12px; padding:10px">Account</th>
                                                      <th style="font-size: 12px; padding:10px">Supplier</th>
                                                      <th style="font-size: 12px; padding:10px">Alamat</th>
                                                      <th style="font-size: 12px; padding:10px">Tlp</th>
                                                      <th style="font-size: 12px; padding:10px">Sales</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                    </table>
                              </div>

                        </div> <!-- end card-body -->
                  </div>
                  <!-- end card -->

            </div> <!-- end col -->
      </div>
      <!-- end row -->
</div>
<!-- end page -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalEditSupplier">
      <div class="modal-dialog modal-full-width modal-dialog-scrollable">
            <div class="modal-content">
                  <div class="modal-header">
                        <h4 class="modal-title" id="tittle_modal_sup"></h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                  </div>
                  <div class="modal-body data_form">
                        <form class="row form-horizontal" id="form_input_supplier" action="javascript:void(0)">
                              <div class="col-lg-4 col-12">
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">Nama Supplier</label>
                                          <div class="col-lg-9 col-xl-9 col-12">
                                                <input type="text" class="form-control form-control-sm" id="nama_sup" name="nama_sup" placeholder="Masukan nama" style="margin-top:-5px">
                                                <input type="hidden" name="hidden_id_sup" id="hidden_id_sup">
                                                <input type="hidden" name="hidden_account" id="hidden_account">
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">Account</label>
                                          <div class="col-lg-9 col-xl-9 col-12">
                                                <input type="number" class="form-control form-control-sm" id="account" name="account" placeholder="Masukan account" style="margin-top:-5px">
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">ALamat</label>
                                          <div class="col-lg-9 col-xl-9 col-12">
                                                <input type="text" class="form-control form-control-sm" id="alamat" name="alamat" placeholder="Masukan alamat" style="margin-top:-5px">
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">Telp</label>
                                          <div class="col-lg-9 col-xl-9 col-12">
                                                <input type="number" class="form-control form-control-sm" id="telp" name="telp" placeholder="Masukan no telepon" style="margin-top:-5px">
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">Fax</label>
                                          <div class="col-lg-9 col-xl-9 col-12">
                                                <input type="number" class="form-control form-control-sm" id="fax" name="fax" placeholder="Masukan fax" style="margin-top:-5px">
                                          </div>
                                    </div>
                              </div>
                              <div class="col-lg-4 col-12">
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">Jenis Usaha</label>
                                          <div class="col-lg-9 col-xl-9 col-12">
                                                <input type="text" class="form-control form-control-sm" id="jenis_usaha" name="jenis_usaha" placeholder="Masukan jenis usaha" style="margin-top:-5px">
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">Salesman</label>
                                          <div class="col-lg-9 col-xl-9 col-12">
                                                <input type="text" class="form-control form-control-sm" id="sales" name="sales" placeholder="Masukan Sales" style="margin-top:-5px">
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-lg-4 col-xl-4 col-12" style="font-size: 12px;">Lama Pembayaran</label>
                                          <div class="row col-lg-8 col-xl-8 col-12">
                                                <input type="number" class="form-control form-control-sm col-4" id="lama_pembayaran" name="lama_pembayaran" placeholder="0" style="margin-top:-5px; margin-left:-24px">
                                                <select name="lama_pembayaran_txt" id="lama_pembayaran_txt" class="form-control form-control-sm col-4 ml-2" style="margin-top:-5px">
                                                      <option value="hari">Hari</option>
                                                      <option value="bulan">Bulan</option>
                                                      <option value="tahun">Tahun</option>
                                                </select>
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">NPWP</label>
                                          <div class="col-lg-9 col-xl-9 col-12">
                                                <input type="text" class="form-control form-control-sm" name="npwp" id="npwp" placeholder="Masukan npwp" style="margin-top:-5px">
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">PKP</label>
                                          <div class="col-lg-9 col-xl-9 col-12">
                                                <input type="text" class="form-control form-control-sm" id="pkp" name="pkp" placeholder="Masukan pkp" style="margin-top:-5px">
                                          </div>
                                    </div>
                              </div>
                              <div class="col-lg-4 col-12">
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">PPH</label>
                                          <div class="col-lg-6 col-xl-6 col-12">
                                                <select name="pph" id="pph" class="form-control form-control-sm col-5" style="margin-top:-5px">
                                                      <option value="N">N</option>
                                                      <option value="Y">Y</option>
                                                </select>
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">No. Rekening</label>
                                          <div class="col-lg-9 col-xl-9 col-12">
                                                <input type="number" class="form-control form-control-sm" id="norek" name="norek" placeholder="Masukan no. rekening" style="margin-top:-5px">
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">Nama Bank</label>
                                          <div class="col-lg-9 col-xl-9 col-12">
                                                <input type="text" class="form-control form-control-sm" id="nama_bank" name="nama_bank" placeholder="Masukan nama bank" style="margin-top:-5px">
                                          </div>
                                    </div>
                                    <div class="form-group row">
                                          <label class="col-lg-3 col-xl-3 col-12" style="font-size: 12px;">Atas Nama</label>
                                          <div class="col-lg-9 col-xl-9 col-12">
                                                <input type="text" class="form-control form-control-sm" id="atas_nama" name="atas_nama" placeholder="Masukan atas nama bank" style="margin-top:-5px">
                                          </div>
                                    </div>
                                    <div class="mb-0 mt-0">
                                          <label id="lbl_status_simpan"></label>
                                          <button style="display: none;" class="btn btn-success btn-sm float-right" id="btn_simpan" type="submit"> Simpan </button>
                                          <button style="display: none;" class="btn btn-warning btn-sm float-right" id="btn_update" type="submit"> Update </button>
                                    </div>
                              </div>
                        </form>
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  </div>
            </div>
      </div>
</div>
<style>
      table#dataSupplier td {
            padding: 3px;
            padding-left: 10px;
            font-size: 12px;
      }

      table#dataSupplier th {
            padding: 10px;
            font-size: 12px;
      }
</style>
<script>
      // Start Data Table Server Side

      function tambahSupplier() {
            $('#modalEditSupplier').modal('show');
            $('#btn_simpan').css('display', 'block');
            $('#btn_update').css('display', 'none');
            $("#form_input_supplier")[0].reset();
            $('#tittle_modal_sup').html('Tambah Supplier');

      }

      var table;
      $(document).ready(function() {

            //datatables
            table = $('#dataSupplier').DataTable({

                  "processing": true,
                  "serverSide": true,
                  "order": [],

                  "ajax": {
                        "url": "<?php echo site_url('Setup/get_data_supplier') ?>",
                        "type": "POST"
                  },

                  "columnDefs": [{
                        "targets": [0],
                        "orderable": false,
                  }, ],

            });

      });
      // End Data Table Server Side

      function editSupplier(id) {
            $('#modalEditSupplier').modal('show');
            $('#btn_simpan').css('display', 'none');
            $('#btn_update').css('display', 'block');
            $('#tittle_modal_sup').html('Edit Supplier');

            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Setup/cari_data_edit'); ?>",
                  data: {
                        id: id
                  },
                  dataType: "JSON",
                  success: function(data) {
                        $('#hidden_id_sup').val(data.id);
                        $('#nama_sup').val(data.supplier);
                        $('#alamat').val(data.alamat);
                        $('#telp').val(data.tlp);
                        $('#fax').val(data.fax);
                        $('#jenis_usaha').val(data.usaha);
                        $('#sales').val(data.sales);
                        $('#lama_pembayaran').val(data.lama);
                        $('#lama_pembayaran_txt').val(data.lamatxt);
                        $('#npwp').val(data.npwp);
                        $('#pkp').val(data.pkp);
                        $('#norek').val(data.norek);
                        $('#nama_bank').val(data.namabank);
                        $('#atas_nama').val(data.atasnama);
                        $('#account').val(data.account);
                        $('#hidden_account').val(data.account);
                        $('#pph').val(data.pph);

                  },
                  error: function() {
                        alert("Error posting feed.");
                  }
            });
      }

      function saveDataClick(validasi) {

            var nama = $('#nama_sup').val();
            var account = $('#account').val();

            if (!nama) {
                  toast('Nama');
                  return false;
            } else if (!account) {
                  toast('Account');
                  return false;
            } else {
                  // saveData();
                  return true;
            }
      };

      function toast(v_text) {
            $.toast({
                  position: 'top-right',
                  heading: 'Failed!',
                  text: v_text + ' is required!',
                  icon: 'error',
                  loader: true,
                  loaderBg: 'red'
            });
      }

      $('#form_input_supplier').on('submit', function(e) {

            e.preventDefault();
            var formData = new FormData(this);

            var validasi = false;
            var res = saveDataClick(validasi);

            if (res) {

                  $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Setup/simpan_data'); ?>",
                        cache: false,
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "JSON",
                        beforeSend: function() {
                              $('#lbl_status_simpan').empty();
                              $('#lbl_status_simpan').append('<i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>');

                              $('#btn_simpan').css('display', 'none');
                        },
                        success: function(data) {
                              console.log(data);
                              if (data == 'account_exist') {
                                    swal('Account Sudah Ada!');
                                    $('#lbl_status_simpan').empty();
                                    if (!$('#hidden_id_sup').val()) {
                                          $('#btn_simpan').css('display', 'block');
                                    } else {
                                          $('#btn_update').css('display', 'block');
                                    }
                              } else {
                                    $.toast({
                                          position: 'top-right',
                                          heading: 'Success',
                                          text: 'Berhasil Disimpan!',
                                          icon: 'success',
                                          loader: false
                                    });
                                    $('#modalEditSupplier').modal('hide');
                                    $('#lbl_status_simpan').empty();
                                    $('#dataSupplier').DataTable().ajax.reload();
                                    $("#form_input_supplier")[0].reset();

                              }
                        },
                        error: function() {
                              alert("Error posting feed.");
                        }
                  });
            }
      });

      function hapusSupplier(id) {
            Swal.fire({
                  text: "Apakah anda yakin?",
                  showCancelButton: true,
                  position: 'top',
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, Setujui'
            }).then((result) => {
                  if (result.value) {
                        hapusSupplier_now(id);
                  }
            })
      }

      function hapusSupplier_now(id) {
            $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('Setup/hapusSupplier'); ?>",
                  data: {
                        id: id
                  },
                  dataType: "JSON",
                  success: function(data) {
                        $('#modalEditSupplier').modal('hide');
                        $('#lbl_status_simpan').empty();
                        $('#dataSupplier').DataTable().ajax.reload();
                  },
                  error: function() {
                        alert("Error posting feed.");
                  }
            });
      }
</script>