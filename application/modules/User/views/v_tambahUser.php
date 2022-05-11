<div class="account-pages">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-xl-12 col-12">
        <div class="card bg-pattern">

          <div class="card-body">
            <!-- title-->
            <h4 class="header-title">Sign Up</h4>
            <div class="text-center mb-2" style="margin-top: -30px;">
              <div class="auth-logo">
                <a href="index.html" class="logo logo-dark text-center">
                  <span class="logo-lg">
                    <img src="<?php echo base_url() ?>assets/images/logo_msal_transparat.gif" alt="" height="75">
                  </span>
                </a>

                <a href="index.html" class="logo logo-light text-center">
                  <span class="logo-lg">
                    <img src="<?php echo base_url() ?>assets/images/logo_msal_transparat.gif" alt="" height="75">
                  </span>
                </a>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12 col-xl-12 col-12">
                <div class="row">
                  <div class="form-group col-lg-6 col-xl-6 col-12">
                    <label style="font-size: 12px;">Nama</label>
                    <input class="form-control form-control-sm" type="text" id="nama" placeholder="Masukan nama" required>
                  </div>
                  <div class="form-group col-lg-6 col-xl-6 col-12">
                    <label style="font-size: 12px;">Username</label>
                    <input class="form-control form-control-sm" type="text" id="username" placeholder="Masukan Username" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-lg-6 col-xl-6 col-12">
                    <label style="font-size: 12px;">Password</label>
                    <input class="form-control form-control-sm" type="password" id="password" placeholder="Masukan Password" required>
                  </div>
                  <div class="form-group col-lg-6 col-xl-6 col-12">
                    <label for="emailaddress2" style="font-size: 12px;">Status Lokasi</label>
                    <select class="form-control form-control-sm" id="lokasi" style="font-size: 12px;">
                      <option value="" selected disabled>Pilih</option>
                      <option value="HO">HO</option>
                      <option value="RO">RO</option>
                      <option value="SITE">KEBUN</option>
                      <option value="PKS">PKS</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-lg-6 col-xl-6 col-12">
                    <label style="font-size: 12px;">Level</label>
                    <select class="form-control form-control-sm" id="level" style="font-size: 12px;">
                      <option value="" selected disabled>Pilih</option>
                      <?php
                      foreach ($level as $l) : { ?>
                          <option value="<?= $l['kode_level'] ?>"><?= $l['kode_level'] . ' - ' . $l['level'] ?></option>
                      <?php }
                      endforeach;
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-xl-6 col-12">
                    <label style="font-size: 12px;">Divisi</label>
                    <select class="form-control form-control-sm" id="devisi" style="font-size: 12px;">
                      <option value="" selected disabled>Pilih</option>
                      <?php
                      foreach ($devisi as $d) : { ?>
                          <option value="<?= $d['kodetxt'] ?>"><?= $d['kodetxt'] . ' - ' . $d['PT'] ?></option>
                      <?php }
                      endforeach;
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-xl-6 col-12">
                    <label style="font-size: 12px;">Departemen</label>
                    <select class="form-control form-control-sm" id="cmb_departemen" style="font-size: 12px;">
                      <option value="" selected disabled>Pilih</option>
                      <?php
                      foreach ($dept as $d) : {
                      ?>
                          <option value="<?= $d['kode']; ?>"><?= $d['kode'] . ' - ' . $d['nama']; ?></option>
                      <?php
                        }
                      endforeach;
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group mb-0 mt-0">
                  <label id="lbl_status_simpan"></label>
                  <button class="btn btn-success btn-sm float-right" id="btn_simpan" type="submit" onclick="saveDataClick()"> Sign Up </button>
                </div>
              </div> <!-- end col -->
            </div>
            <!-- end row-->

          </div> <!-- end card-body -->
        </div>
        <!-- end card -->

      </div> <!-- end col -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</div>
<!-- end page -->

<script>
  function saveDataClick() {

    var nama = $('#nama').val();
    var username = $('#username').val();
    var password = $('#password').val();
    var lokasi = $('#lokasi').val();
    var level = $('#level').val();
    var cmb_departemen = $('#cmb_departemen').val();

    if (!nama) {
      toast('Nama');
    } else if (!username) {
      toast('Username');
    } else if (!password) {
      toast('Password');
    } else if (!lokasi) {
      toast('Lokasi');
    } else if (!level) {
      toast('Level');
    } else if (!cmb_departemen) {
      toast('Departemen');
    } else {
      saveData();
    }
    return false;
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

  function saveData() {

    $.ajax({
      type: "POST",
      url: "<?php echo base_url('User/tambahUser') ?>",
      dataType: "JSON",

      beforeSend: function() {
        $('#lbl_status_simpan').empty();
        $('#lbl_status_simpan').append('<i class="fa fa-spinner fa-spin mt-1" style="font-size:24px;color:#f0ad4e;"></i>');

        $('#btn_simpan').css('display', 'none');
      },

      data: {
        nama: $('#nama').val(),
        username: $('#username').val(),
        password: $('#password').val(),
        lokasi: $('#lokasi').val(),
        level: $('#level').val(),
        devisi: $('#devisi').val(),
        kodedept: $('#cmb_departemen').val(),
      },

      success: function(data) {

        if (data == 'username_exist') {
          swal('Username Sudah Ada!');
          $('#lbl_status_simpan').empty();
          $('#btn_simpan').css('display', 'block');
        } else {
          $.toast({
            position: 'top-right',
            heading: 'Success',
            text: 'Berhasil Disimpan!',
            icon: 'success',
            loader: false
          });
          setTimeout(function() {
            location.reload();
          }, 3000);
        }
      },
      error: function(response) {
        alert('KONEKSI TERPUTUS! gagal Save Data!');
      }
    });
  }
</script>