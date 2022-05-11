<?php
$lokasi_sesi = $this->session->userdata('status_lokasi');
?>
<div class="container-fluid">
    <!-- start page title -->
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">PO</h4>
                    <p class="sub-header">
                        Purchase Order
                    </p>

                    <div class="row div_form_1">
                        <div class="col-lg-4">
                            <div class="form-group row mb-1">
                                <!-- <a href="<?php echo site_url('po/input'); ?>" class="btn btn-sm btn-info" id="a_po_baru"><span class="fa fa-plus"></span> PO Baru</a> -->
                                <label class="col-4 col-form-label">Jenis PO *</label>
                                <div class="col-7">
                                    <input type="hidden" id="hidden_jenis_spp" name="hidden_jenis_spp">
                                    <select class="form-control" id="cmb_pilih_jenis_po">
                                        <option selected="selected">-Pilih-</option>
                                        <?php
                                        switch ($lokasi_sesi) {
                                            case 'PKS':
                                        ?>
                                                <option value="PO-Lokal">PO-Lokal</option>
                                            <?php
                                                break;
                                            case 'SITE':
                                            ?>
                                                <option value="PO-Lokal">PO-Lokal</option>
                                            <?php
                                                break;
                                            case 'RO':
                                            ?>
                                                <option value="PO-Lokal">PO-Lokal</option>
                                            <?php
                                                break;
                                            case 'HO':
                                            ?>
                                                <option value="PO">PO</option>
                                                <option value="POA">POA - PO Asset</option>
                                                <option value="PO-Khusus">POK - PO Khusus</option>
                                        <?php
                                                break;
                                            default:
                                                break;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-4 col-form-label">Tgl. PO *</label>
                                <div class="col-5">
                                    <input type="date" class="form-control bg-light" id="tgl_po" name="tgl_po" value="<?= date('Y-m-d') ?>" placeholder="tgl PO" autocomplite="off" required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-4 col-form-label">Supplier *</label>
                                <div class="col-7">
                                    <select class="js-data-example-ajax form-control select2" id="select2">
                                        <option selected="selected">Nama Supplier</option>
                                    </select>
                                    <input type="hidden" name="kd_supplier" id="kd_supplier">
                                    <input type="hidden" name="txtsupplier" id="txtsupplier">
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-4 col-form-label">Status Bayar*</label>
                                <div class="col-3">
                                    <select class="form-control" id="cmb_status_bayar" name="cmb_status_bayar">
                                        <option value="1">Cash</option>
                                        <option value="2">Kredit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-4 col-form-label">Tempo Pembayaran*</label>
                                <div class="col-2">
                                    <input type="text" id="tmpo_pembayaran" name="tmpo_pembayaran" class="form-control" placeholder="0" autocomplite="off"><span>Hari</span>
                                </div>
                                <label class="col-3 col-form-label">Tempo Pengiriman*</label>
                                <div class="col-2">
                                    <input type="text" id="tmpo_pengiriman" name="tmpo_pengiriman" class="form-control" placeholder="0" autocomplite="off" required><span>Hari</span>
                                </div>
                            </div>
                            <div class="form-group row mb-1">

                                <?php
                                switch ($sesi_sl) {
                                    case 'HO':
                                ?>

                                    <?php
                                        break;
                                    case 'RO':
                                    case 'SITE':
                                    case 'PKS':
                                    ?>
                                        <label class="col-4 col-form-label">Spp *</label>
                                        <div class="col-8">
                                            <!-- <select class="js-data-example-ajax form-control select4" id="sppSITE"> -->
                                            <select class="js-data-example-ajax form-control select4" id="sppSITE">
                                                <option selected="selected">Cari Spp</option>
                                            </select>
                                        </div>
                                <?php
                                        break;
                                    default:
                                        break;
                                }
                                ?>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group row mb-1">
                                <label class="col-5 col-form-label">Lokasi Pengiriman*</label>
                                <div class="col-5">
                                    <input class="form-control" type="text" id="lks_pengiriman" name="lks_pengiriman" placeholder="Lokasi Pengiriman" autocomplite="off" required>
                                    <!-- <span class="pesan pesan-nama" style="color: red;">Harus di isi !</span><br /> -->
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-5 col-form-label">Lokasi Pembelian *</label>
                                <div class="col-3">
                                    <select class="form-control" id="lks_pembelian" name="lks_pembelian" required>
                                        <option value="1">-- Pilih --</option>
                                        <option value="2">RO</option>
                                        <option value="3">SITE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-5 col-form-label">No. Penawaran *</label>
                                <div class="col-7">
                                    <input type="text" class="form-control" id="no_penawaran" name="no_penawaran" placeholder="No Penawaran" autocomplite="off" required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-5 col-form-label">Pemesan *</label>
                                <div class="col-7">
                                    <input type="text" class="form-control bg-light" id="txt_pemesan" name="txt_pemesan" value="<?php echo $this->session->userdata('user'); ?>" readonly>
                                    <input type="hidden" name="txt_kode_pemesan" id="txt_kode_pemesan" value="<?php echo $this->session->userdata('id_user'); ?>">
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-5 col-form-label">Keterangan Pengiriman</label>
                                <div class="col-7">
                                    <textarea class="form-control" id="ket_pengiriman" name="ket_pengiriman" placeholder="Keterangan Pengiriman" autocomplite="off"></textarea>
                                    <input type="hidden" id="txt_uang_muka" name="txt_uang_muka" value="0.00">
                                    <input type="hidden" id="txt_no_voucher" name="txt_no_voucher" value="0">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group row mb-1">
                                <div class="col-1"></div>
                                <label class="col-3 col-form-label mx-0">PPH *</label>
                                <div class="col-6">
                                    <input type="text" class="form-control" id="pph" name="pph" placeholder="PPH" autocomplite="off" value="0" required>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <div class="col-1"></div>
                                <label class="col-3 col-form-label" required>PPN *</label>
                                <div class="col-3">
                                    <select class="form-control" id="ppn" name="ppn" required>
                                        <option value="1">N</option>
                                        <option value="2">Y</option>
                                        <option value="3">X</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <div class="col-1"></div>
                                <label class="col-3 col-form-label">Keterangan</label>
                                <div class="col-7">
                                    <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" autocomplite="off"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <div class="col-1"></div>
                                <label class="col-3 col-form-label">Dikirim ke Kebun*</label>
                                <div class="col-3">
                                    <select class="form-control" id="dikirim_kebun" name="dikirim_kebun" required>
                                        <option value="Y" selected="">Y</option>
                                        <option value="N">N</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <div class="col-1"></div>
                                <label class="col-3 col-form-label">Total Pembayaran</label>
                                <div class="col-7">
                                    <input type="text" class="form-control bg-light" id="ttl_pembayaran" name="ttl_pembayaran" placeholder="Total Pembayaran" autocomplite="off" readonly required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row-->

                    <hr>
                    <div class="x_content div_form_2">


                        <label id="lbl_spp_status" name="lbl_spp_status">No. PO : ... <br /> No. Ref PO : ...</label>
                        <h6 id="h4_no_po" name="h4_no_po"></h6>
                        <h6 id="h4_no_ref_po" name="h4_no_ref_po"></h6>
                        <input type="hidden" id="hidden_no_po" name="hidden_no_po">
                        <input type="hidden" id="hidden_id_po" name="hidden_id_po">
                        <input type="hidden" id="hidden_no_ref_po" name="hidden_no_ref_po">
                        <input type="hidden" value="<?= $sesi_sl; ?>" id="lokasi" name="lokasi">
                        <div class="table-responsive">
                            <table id="tableRinciPO" class="table table-striped table-bordered">
                                <thead>
                                    <tr>

                                        <?php
                                        switch ($sesi_sl) {
                                            case 'HO':
                                        ?>
                                                <th>#</th>
                                                <th width="250px">SPP</th>
                                            <?php
                                                break;
                                            case 'RO':
                                            case 'SITE':
                                            case 'PKS':
                                            ?>
                                        <?php
                                                break;
                                            default:
                                                break;
                                        }
                                        ?>

                                        <th>Jenis Budget</th>
                                        <th width="500px">Nama & Kode Barang</th>
                                        <th>Merk</th>
                                        <th>Qty</th>

                                        <th>Harga</th>
                                        <th>Kurs</th>
                                        <th>Disc <span>%</span></th>
                                        <th>Biaya Lainnya</th>
                                        <th>Ket.&nbsp;Biaya</th>

                                        <th>Keterangan</th>
                                        <th>Jumlah Rp</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_rincian" name="tbody_rincian">

                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th colspan="13"><button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" onclick="tambah_row()"></button></th>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalKonfirmasiHapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-center">
                        <i class="dripicons-warning h1 text-warning"></i>
                        <h4 class="mt-2">Konfirmasi Hapus</h4>
                        <input type="hidden" id="hidden_no_delete" name="hidden_no_delete">
                        <p class="mt-3">Apakah Anda yakin ingin menghapus data ini ???</p>
                        <button type="button" class="btn btn-warning my-2" data-dismiss="modal" id="btn_delete" onclick="deleteData()">Hapus</button>
                        <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modal-spp">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Pilih SPP</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="col-4 float-right">
                            <select class="form-control" id="cmb_filter_alokasi" name="cmb_filter_alokasi">
                                <option value="SEMUA" selected>TAMPILKAN SEMUA</option>
                                <?php
                                switch ($this->session->userdata('status_lokasi')) {
                                    case 'PKS':
                                    case 'SITE':
                                ?>
                                        <option value="PKS">PKS</option>
                                        <option value="SITE">SITE</option>
                                    <?php
                                        break;
                                    case 'RO':
                                    ?>
                                        <option value="PKS">PKS</option>
                                        <option value="SITE">SITE</option>
                                        <option value="RO">RO</option>
                                    <?php
                                        break;
                                    case 'HO':
                                    ?>
                                        <option value="PKS">PKS</option>
                                        <option value="SITE">SITE</option>
                                        <option value="RO">RO</option>
                                        <option value="HO">HO</option>
                                <?php
                                        break;
                                    default:
                                        break;
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="table-responsive">
                            <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                            <table id="spp" class="table table-bordered" width="60px">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tgl. SPP</th>
                                        <th>Ref. SPP</th>
                                        <th>Departemen</th>
                                        <th>Kode Barang</th>
                                        <th>Item Barang</th>
                                        <th>Ket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: center;" colspan="7"><button class="btn btn-sm btn-info" data-toggle="tooltip" id="btn_setuju_all" onclick="pilihItem()" data-placement="left">Pilih Item</button></th>
                                    </tr>
                                </tfoot>
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





</div>

<script>
    // $(document).ready(function() {
    //     setInterval(function() {
    //         check_form_2();
    //     }, 1000);

    // });


    var row = 0;
    var simpanBaru = true;
    var updateBaru = true;
    var cancleUpdatePO = true;
    var validasiItem = true;
    var hapus = true;

    $(function() {
        tambah_row();
    });

    $("#sppSITE").select2({
        ajax: {
            url: "<?php echo site_url('Po/getSpp') ?>",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    noref: params.term, // search term
                };
            },
            processResults: function(data) {
                var results = [];

                $.each(data, function(index, item) {
                    results.push({
                        id: item.id,
                        text: item.noreftxt
                    });

                });
                return {
                    results: results
                };
            }
        }

    }).on('select4:select', function(evt) {
        // console.log(evt)
        // data = JSON.parse(evt);
        // $.each(data, function(index, value) {
        //     var opodsi = value.nama_petugas;
        //     $('#petugas').val(opsi);
        // });
        var data = $(".select4 option:selected").text();
        $('#hidden_no_ref_spp_1').val(data);

    });

    $('#sppSITE').change(function() {
        // var dd = this.value;
        // console.log(dd);

        $.ajax({
            type: 'post',
            url: '<?= site_url('Po/getid'); ?>',
            data: {
                id: this.value
            },
            success: function(response) {

                data = JSON.parse(response);
                console.log(data);
                $.each(data, function(index, value) {
                    // if (n != 1) {
                    // 	tambah_row(n);
                    // }

                    var opsi = value.noreftxt;
                    var tglref = value.tglref;
                    var kodedept = value.kodedept;
                    var namadept = value.namadept;
                    var tglppo = value.tglppo;
                    var kodept = value.kodept;
                    var pt = value.pt;
                    var noppo = value.noppo;
                    var kodebar = value.kodebar;
                    var nabar = value.nabar;
                    var sat = value.sat;
                    var qty = value.qty;
                    $('#hidden_no_ref_spp_1').val(opsi);
                    $('#hidden_tgl_ref_1').val(tglref);
                    $('#hidden_kd_departemen_1').val(kodedept);
                    $('#hidden_departemen_1').val(namadept);
                    $('#hidden_tgl_spp_1').val(tglppo);
                    $('#hidden_kd_pt_1').val(kodept);
                    $('#hidden_nama_pt_1').val(pt);
                    $('#noppo').val(noppo);
                    $('#hidden_kode_brg_1').val(kodebar);
                    $('#hidden_nama_brg_1').val(nabar);
                    $('#hidden_satuan_brg_1').val(sat);
                    $('#txt_qty_1').val(qty);
                });

            },
            error: function(request) {
                console.log(request.responseText);
            }
        });
    });

    function pilihItem() {
        var rowcollection = $('#spp').DataTable().rows({
            selected: true
        }).data().toArray();
        // console.log(rowcollection);
        $.each(rowcollection, function(index, elem) {
            // var no_spp = rowcollection[index][3];
            var no_ref_spp = rowcollection[index][2];
            var departemen = rowcollection[index][3];
            var kodebar = rowcollection[index][4];
            console.log(no_ref_spp, departemen, kodebar);
            // data_spp_dipilih(no_spp, no_ref_spp, kodebar);
        })
    }

    function data_spp_dipilih(no_ref_spp, departemen, kodebar) {
        var dataClick = $('#spp').DataTable().row(this).data();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/get_detail_spp'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                'no_spp': no_spp,
                'no_ref_spp': no_ref_spp,
                'kodebar': kodebar
            },
            success: function(data) {
                console.log(data);
                var tglref = new Date(data[0].tglref);
                var tglppo = new Date(data[0].tglppo);

                $.each(data[1], function(index) {
                    // if(index != 0){
                    if (n != 1) {
                        tambah_row(n);
                    }

                    $('#lbl_no_ref_spp_' + n).empty();
                    $('#lbl_tgl_ref_' + n).empty();
                    $('#lbl_departemen_' + n).empty();
                    $('#lbl_tgl_spp_' + n).empty();

                    $('#lbl_no_ref_spp_' + n).append('Ref SPP : ' + data[0].noreftxt);
                    $('#lbl_tgl_ref_' + n).append('Tgl. Ref : ' + dateToMDY(tglref));
                    $('#lbl_departemen_' + n).append('Departemen : ' + data[0].kodedept + ' | ' + data[0].namadept);
                    $('#lbl_tgl_spp_' + n).append('Tgl SPP : ' + dateToMDY(tglppo));

                    $('#hidden_no_ref_spp_' + n).val(data[0].noreftxt);
                    $('#hidden_tgl_ref_' + n).val(dateToMDY(tglref));
                    $('#hidden_kd_departemen_' + n).val(data[0].kodedept);
                    $('#hidden_departemen_' + n).val(data[0].namadept);
                    $('#hidden_tgl_spp_' + n).val(dateToMDY(tglppo));
                    $('#hidden_kd_pt_' + n).val(data[0].kodept);
                    $('#hidden_nama_pt_' + n).val(data[0].pt);

                    $('#txt_no_spp_' + n).val(data[0].noppotxt);

                    $('#lbl_kode_brg_' + n).empty();
                    $('#lbl_nama_brg_' + n).empty()
                    $('#lbl_satuan_brg_' + n).empty();

                    $('#hidden_kode_brg_' + n).empty();
                    $('#hidden_nama_brg_' + n).empty();
                    $('#hidden_satuan_brg_' + n).empty();

                    $('#lbl_kode_brg_' + n).append('Kode : ' + data[1][index].kodebartxt);
                    $('#lbl_nama_brg_' + n).append('Nama Barang : ' + data[1][index].nabar);
                    $('#lbl_satuan_brg_' + n).append('Satuan : ' + data[1][index].sat);

                    $('#hidden_kode_brg_' + n).val(data[1][index].kodebartxt);
                    $('#hidden_nama_brg_' + n).val(data[1][index].nabar);
                    $('#hidden_satuan_brg_' + n).val(data[1][index].sat);
                    $('html, body').animate({
                        scrollTop: $("#tr_" + n).offset().top
                    }, 2000);

                    $('#txt_qty_' + n).val(data[1][index].qty);
                    n++;
                    $('#hidden_no_table').val(n);
                })
                $('#modalDataSPP').modal('hide');
                $('#txt_qty_' + n).focus();

            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }

    function tambah_row(row) {
        row++;
        // console.log("bariske", row);

        var tr_buka = '<tr id="tr_' + row + '">';

        var form_buka = '<form id="form_rinci_' + row + '" name="form_rinci_' + row + '" method="POST" action="javascript:;">';

        // var td_col_2 = '<td width="30%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
        //     '<select class="js-data-example-ajax form-control select3" id="pilihSpp' + row + '" name="pilihSpp' + row + '" required>' +
        //     '<option selected="selected">Cari SPP</option>' +
        //     '</select>' +
        //     '<input type="hidden" id="hidden_no_ref_spp_' + row + '" name="hidden_no_ref_spp_' + row + '">' +
        //     '<input type="hidden" id="hidden_tgl_ref_' + row + '" name="hidden_tgl_ref_' + row + '">' +
        //     '<input type="hidden" id="hidden_kd_departemen_1' + row + '" name="hidden_kd_departemen_1' + row + '">' +
        //     '<input type="hidden" id="hidden_departemen_1' + row + '" name="hidden_departemen_1' + row + '">' +
        //     '<input type="hidden" id="hidden_tgl_spp_1' + row + '" name="hidden_tgl_spp_1' + row + '">' +
        //     '<input type="hidden" id="hidden_kd_pt_1' + row + '" name="hidden_kd_pt_1' + row + '">' +
        //     '<input type="hidden" id="hidden_nama_pt_1' + row + '" name="hidden_nama_pt_1' + row + '">' +
        //     '<input type="hidden" id="noppo' + row + '" name="noppo' + row + '">' +

        '</td>';
        var td_col_3 = '<td width="30%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<select class="form-control" id="cmb_jenis_budget_1' + row + '" name="cmb_jenis_budget_1' + row + '" required>' +
            '<option value="">-- Pilih --</option>' +
            '<option value="TEKNIK">TEKNIK</option>' +
            '<option value="BIBITAN">BIBITAN</option>' +
            '<option value="LC & TANAM">LC & TANAM</option>' +
            '<option value="RAWAT">RAWAT</option>' +
            '<option value="PANEN">PANEN</option>' +
            '<option value="TEKNIK">TEKNIK</option>' +
            '<option value="PABRIK">PABRIK</option>' +
            '<option value="KANTOR">KANTOR</option>' +
            '<option value="Kendaraan">Kendaraan</option>' +
            '<option value="TBM">TBM</option>' +
            '</select>'; +
        '</td>';
        var td_col_ = '<td width="30%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            // '<input type="text" class="form-control" id="brg' + row + '" name="brg' + row + '">' +
            '<span id="nama_brg_' + row + '"></span><span> | </span><span id="kode_brg_' + row + '" ></span>' +

            // '<input type="text" class="form-control" id="hidden_kode_brg_1' + row + '" name="hidden_kode_brg_1' + row + '"   />' +
            // '<input type="text" class="form-control" id="hidden_nama_brg_1' + row + '" name="hidden_nama_brg_1' + row + '"   />' +
            '<input type="hidden" class="form-control" id="hidden_satuan_brg_1' + row + '" name="hidden_satuan_brg_1' + row + '"   />' +

            '</td>';
        var td_col_4 = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control" id="txt_merk_1' + row + '" name="txt_merk_1' + row + '" placeholder="Merk"  required />' +

            '</td>';
        var td_col_5 = '<td width="7%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control" id="txt_qty_1' + row + '" name="txt_qty_1' + row + '" placeholder="Qty" size="8" onkeyup="jumlah(' + row + ')" />' +

            '</td>';
        var td_col_6 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control" id="txt_harga_1' + row + '" name="txt_harga_1' + row + '" value="0" onkeyup="jumlah(' + row + ')" placeholder="Harga dalam Rupiah" size="15" required /><br />' +

            '</td>';
        var td_col_7 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<select class="form-control" id="cmb_kurs_1' + row + '" name="cmb_kurs_1' + row + '" required="">' +
            '<option value="Rp">Rp IDR</option>' +
            '<option value="USD">&dollar; USD</option>' +
            '<option value="SGD">S&dollar; SGD</option>' +
            '<option value="Euro">&euro; Euro</option>' +
            '<option value="GBP">&pound; GBP</option>' +
            '<option value="Yen">&yen; Yen</option>' +
            '<option value="MYR">RM MYR</option>' +
            '</select><br />' +
            '</td>';
        var td_col_8 = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control" id="txt_disc_1' + row + '" name="txt_disc_1' + row + '" size="10" value="0" onkeyup="jumlah(' + row + ')" placeholder="Disc"/>' +

            '</td>';
        var td_col_9 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control" id="txt_biaya_lain_1' + row + '" name="txt_biaya_lain_1' + row + '" size="15" value="0" onkeyup="jumlah(' + row + ')" placeholder="Biaya Lain"/>' +

            '</td>';
        var td_col_10 = '<td width="12%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea class="resizable_textarea form-control" id="txt_keterangan_biaya_lain_1' + row + '" name="txt_keterangan_biaya_lain_1' + row + '" size="26" placeholder="Keterangan Biaya" onkeypress="saveRinciEnter(event,' + row + ')"></textarea><br />' +


            '</td>'
        var td_col_11 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea class="resizable_textarea form-control" id="txt_keterangan_rinci_1' + row + '" name="txt_keterangan_rinci_1' + row + '" size="26" placeholder="Keterangan" onkeypress="saveRinciEnter(event,' + row + ')"></textarea><br />' +

            '</td>';
        var td_col_12 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control" id="txt_jumlah_1' + row + '" name="txt_jumlah_1" size="15" placeholder="Jumlah"  readonly />' +
            '<label id="lbl_status_simpan_1' + row + '"></label>' +
            '<input type="hidden" id="hidden_id_po_item_' + row + '" name="hidden_id_po_item_' + row + '">' +
            '</td>';
        var td_col_13 = '<td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<button class="btn btn-xs btn-success fa fa-save" id="btn_simpan_' + row + '" name="btn_simpan_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="validasi(' + row + ')" ></button>' +
            '<button style="display:none;" class="btn btn-xs btn-warning fa fa-edit mb-1" onclick="ubah(' + row + ')" id="btn_ubah_' + row + '" name="btn_ubah_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" ></button>' +
            '<button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_' + row + '" name="btn_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="update(' + row + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick mt-1" id="btn_cancel_update_' + row + '" name="btn_cancel_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update"  onclick="cancleUpdate(' + row + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_' + row + '" name="btn_hapus_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + row + ')"></button>' +

            '</td>';
        var form_tutup = '</form>';
        var tr_tutup = '</tr>';
        var lokasi = $('#lokasi').val();
        switch (lokasi) {
            case 'HO':
                var td_col_1 = '<td width="3%">' +
                    '<input type="hidden" id="hidden_proses_status_' + row + '" name="hidden_proses_status_' + row + '" value="insert">' +
                    '' +
                    '<button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" name="btn_tambah_row" id="tambah_row' + row + '" onclick="tambah_row(' + row + ')"></button>' +
                    '<button class="btn btn-xs btn-danger fa fa-minus btn_hapus_row_' + row + '" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row_' + row + '" name="btn_hapus_row" onclick="hapus_row(' + row + ')"></button>' +
                    '</td>';
                var td_col_2 = '<td width="30%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                    '<input type="text" class="form-control"  id="spp' + row + '" name="spp' + row + '">' +

                    '</td>';
                break;
            case 'RO':
            case 'SITE':
            case 'PKS':
                // var td_col_2 = '<td width="30%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                //     '<select class="js-data-example-ajax form-control select3" id="pilihSpp' + row + '" name="pilihSpp' + row + '" required>' +
                //     '<option selected="selected">Cari SPP</option>' +
                //     '</select>' +
                //     '<input type="hidden" id="hidden_no_ref_spp_' + row + '" name="hidden_no_ref_spp_' + row + '">' +
                //     '<input type="hidden" id="hidden_tgl_ref_' + row + '" name="hidden_tgl_ref_' + row + '">' +
                //     '<input type="hidden" id="hidden_kd_departemen_1' + row + '" name="hidden_kd_departemen_1' + row + '">' +
                //     '<input type="hidden" id="hidden_departemen_1' + row + '" name="hidden_departemen_1' + row + '">' +
                //     '<input type="hidden" id="hidden_tgl_spp_1' + row + '" name="hidden_tgl_spp_1' + row + '">' +
                //     '<input type="hidden" id="hidden_kd_pt_1' + row + '" name="hidden_kd_pt_1' + row + '">' +
                //     '<input type="hidden" id="hidden_nama_pt_1' + row + '" name="hidden_nama_pt_1' + row + '">' +
                //     '<input type="hidden" id="noppo' + row + '" name="noppo' + row + '">' +

                //     '</td>';
                break;
            default:
                break;
        }


        $('#tbody_rincian').append(tr_buka + td_col_1 + form_buka + td_col_2 + td_col_3 + td_col_ + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_9 + td_col_10 + td_col_11 + td_col_12 + td_col_13 + form_tutup + tr_tutup);
        $('#txt_qty_1' + row).number(true, 2);
        if (row == 1) {
            $('#btn_hapus_row_1').hide();
        } else {
            $('#btn_hapus_row_1' + row).show();
        }
        initPilihSpp(row);
        jumlah(row);
    }


    function hapus_row(id) {
        var rowCount = $("#tableRinciPO td").closest("tr").length;
        if (rowCount != 1) {
            $('#tr_' + id).remove();
            totalBayar();
        } else {
            swal('Tidak Bisa dihapus, item PO tinggal 1');
        }
    }

    function totalBayar() {
        // var no_po = $('#hidden_no_po').val();
        // var no_ref_po = $('#hidden_no_ref_po').val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/total_bayar'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                no_po: $('#hidden_no_po').val(),
                no_ref_po: $('#hidden_no_ref_po').val()
            },
            success: function(data) {
                // console.log(data);
                $('#ttl_pembayaran').val(data.totalbayar);
            },
            error: function(request) {
                alert(request.responseText);
            }
        });
    }

    function number(row) {
        $('#txt_qty_1' + row).number(true, 2);
        $('#txt_harga_1' + row + ',#txt_disc_1' + row + ',#txt_biaya_lain_1' + row + ',#txt_jumlah_1' + row).number(true, 2);
        row++;
    }

    function saveRinciEnter(e, no) {
        if (e.keyCode == 13 && !e.shiftKey) {
            if ($('#hidden_proses_status_' + no).val() == 'insert') {
                saveRinci(no);
            } else if ($('#hidden_proses_status_' + no).val() == 'update') {
                updateRinci(no);
            }
        }
    }


    function check_form_2() {
        // var data = sessionStorage.setItem('status_lokasi', 'loggedIn');
        // console.log(data);
        if ($.trim($('#cmb_pilih_jenis_po').val()) != '' && $.trim($('#tgl_po').val()) != '' && $.trim($('#select2').val()) != '' && $.trim($('#cmb_status_bayar').val()) != '' && $.trim($('#tmpo_pembayaran').val()) != '' && $.trim($('#tmpo_pengiriman').val()) != '' && $.trim($('#lks_pengiriman').val()) != '' && $.trim($('#lks_pembelian').val()) != '' && $.trim($('#no_penawaran').val()) != '' && $.trim($('#txt_pemesan').val()) != '' && $.trim($('#ket_pengiriman').val()) != '' && $.trim($('#pph').val()) != '' && $.trim($('#ppn').val()) != '' && $.trim($('#keterangan').val()) != '' && $.trim($('#dikirim_kebun').val()) != '') {
            $('#btn_simpan_1').removeAttr('disabled', '');
            $('#tambah_row1').removeAttr('disabled', '');
            $('#tableRinciPO').find('input,textarea,select').removeAttr('disabled');
            $('#tableRinciPO').find('input,textarea,select').removeClass('bg-light');
        } else {
            $('#btn_simpan_1').attr('disabled', '');
            $('#tambah_row1').attr('disabled', '');
            $('#tableRinciPO').find('input,textarea,select').attr('disabled', '');
            $('#tableRinciPO').find('input,textarea,select').addClass('class', 'bg-light');
            // $("#tableRinciPO").click(function() {
            //     Swal("Anda Harus mingisi data diatas!");
            // });
        }
    }

    function initPilihSpp(id) {

        $(`#pilihSpp${id}`).select2({
            ajax: {
                url: "<?php echo site_url('Po/getSpp') ?>",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        tgl: params.term, // search term
                    };
                },
                processResults: function(data) {
                    var results = [];

                    $.each(data, function(index, item) {
                        results.push({
                            id: item.id,
                            text: item.noreftxt + ' - ' + item.tglppotxt + ' - ' + item.namadept
                            // text: item.noreftxt
                        });

                    });
                    return {
                        results: results
                    };
                }
            }

        }).on('select3:select', function(evt) {
            var data = $(".select3 option:selected").text();
            $('#hidden_no_ref_spp_').val(data);

        });

        $(`#pilihSpp${id}`).change(function() {
            // var dd = this.value;


            $.ajax({
                type: 'post',
                url: '<?= site_url('Po/getid'); ?>',
                data: {
                    id: this.value
                },
                success: function(response) {

                    data = JSON.parse(response);
                    // console.table(data);
                    $.each(data, function(index, value) {
                        var opsi = value.noreftxt;
                        var tglref = value.tglref;
                        var kodedept = value.kodedept;
                        var namadept = value.namadept;
                        var tglppo = value.tglppo;
                        var kodept = value.kodept;
                        var pt = value.pt;
                        var noppo = value.noppo;
                        var kodebar = value.kodebar;
                        var nabar = value.nabar;
                        var sat = value.sat;
                        var qty = value.qty;
                        $(`#hidden_tgl_ref_${id}`).val(tglref);
                        $(`#hidden_no_ref_spp_${id}`).val(opsi);
                        $(`#hidden_kd_departemen_1${id}`).val(kodedept);
                        $(`#hidden_departemen_1${id}`).val(namadept);
                        $(`#hidden_tgl_spp_1${id}`).val(tglppo);
                        $(`#hidden_kd_pt_1${id}`).val(kodept);
                        $(`#hidden_nama_pt_1${id}`).val(pt);
                        $(`#noppo${id}`).val(noppo);
                        $(`#hidden_kode_brg_1${id}`).val(kodebar);
                        $(`#kode_brg_${id}`).text(kodebar);
                        $(`#hidden_nama_brg_1${id}`).val(nabar);
                        $(`#nama_brg_${id}`).text(nabar);
                        $(`#hidden_satuan_brg_1${id}`).val(sat);
                        $(`#txt_qty_1${id}`).val(qty);
                        console.log(kodebar);
                        console.log(nabar);
                    });

                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });
        });

        $(`#spp${id}`).click(function() {
            $("#modal-spp").modal();
        });

    }

    function jumlah(id) {
        // console.log('jumlahke', no_row)
        var qty = $('#txt_qty_1' + id).val();
        var harga = $('#txt_harga_1' + id).val();
        var disc = $('#txt_disc_1' + id).val();
        var biaya_lain = $('#txt_biaya_lain_1' + id).val();

        var hargaDisc = (parseInt(harga) * parseInt(disc)) / 100;
        var hargaSetelahDisc = parseInt(harga) - parseInt(hargaDisc);

        var nilai = (parseFloat(qty) * parseFloat(hargaSetelahDisc)) + parseFloat(biaya_lain);

        $('#txt_jumlah_1' + id).val(nilai);
    }

    //Simpan Data
    function simpan(id) {
        if (simpanBaru) {

            // console.log('simpan', id);
            console.table({
                hidden_kode_departemen: $('#hidden_kd_departemen_1' + id).val(),
                hidden_departemen: $('#hidden_departemen_1' + id).val(),
                cmb_jenis_budget: $('#cmb_jenis_budget_1' + id).val(),
                txt_kode_supplier: $('#kd_supplier').val(),
                txt_supplier: $('#txtsupplier').val(),
                txt_kode_pemesan: $('#txt_kode_pemesan').val(),
                txt_pemesan: $('#txt_pemesan').val(),
                hidden_no_ref_po: $('#hidden_no_ref_po').val(),
                cmb_status_bayar: $('#cmb_status_bayar').val(),
                txt_tempo_pembayaran: $('#tmpo_pembayaran').val(),
                txt_lokasi_pengiriman: $('#lks_pengiriman').val(),
                txt_tempo_pengiriman: $('#tmpo_pengiriman').val(),
                cmb_lokasi_pembelian: $('#lks_pembelian').val(),
                txt_keterangan: $('#keterangan').val(),
                txt_no_penawaran: $('#no_penawaran').val(),
                cmb_ppn: $('#ppn').val(),
                txt_total_pembayaran: $('#ttl_pembayaran').val(),
                txt_ket_pengiriman: $('#ket_pengiriman').val(),
                txt_uang_muka: $('#txt_uang_muka').val(),
                txt_no_voucher: $('#txt_no_voucher').val(),
                txt_no_spp: $('#noppo' + id).val(),
                hidden_no_ref: $('#hidden_no_ref_spp_').val(),
                hidden_kode_brg: $('#hidden_kode_brg_1' + id).val(),
                hidden_nama_brg: $('#hidden_nama_brg_1' + id).val(),
                hidden_satuan_brg: $('#hidden_satuan_brg_1' + id).val(),
                txt_qty: $('#txt_qty_1' + id).val(),
                txt_harga: $('#txt_harga_1' + id).val(),
                hidden_kodept: $('#hidden_kd_pt_1' + id).val(),
                hidden_namapt: $('#hidden_nama_pt_1' + id).val(),
                txt_merk: $('#txt_merk_1' + id).val(),
                txt_keterangan_rinci: $('#txt_keterangan_rinci_1' + id).val(),
                txt_disc: $('#txt_disc_1' + id).val(),
                cmb_kurs: $('#cmb_kurs_1' + id).val(),
                txt_biaya_lain: $('#txt_biaya_lain_1' + id).val(),
                txt_keterangan_biaya_lain: $('#txt_biaya_lain_1' + id).val(),
                hidden_tanggal: $('#hidden_tgl_spp_1' + id).val(),
            })
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Po/save') ?>",
                dataType: "JSON",
                beforeSend: function() {
                    // $('#lbl_status_simpan_1' + id).empty();
                    // $('#lbl_status_simpan_1' + id).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Simpan</label>');
                    if ($.trim($('#hidden_no_po').val()) == '') {
                        $('#lbl_spp_status').empty();
                        $('#lbl_spp_status').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Generate PO Number</label>');
                    }
                },

                data: {
                    hidden_kode_departemen: $('#hidden_kd_departemen_1' + id).val(),
                    hidden_departemen: $('#hidden_departemen_1' + id).val(),
                    cmb_jenis_budget: $('#cmb_jenis_budget_1' + id).val(),
                    txt_kode_supplier: $('#kd_supplier').val(),
                    txt_supplier: $('#txtsupplier').val(),
                    txt_kode_pemesan: $('#txt_kode_pemesan').val(),
                    txt_pemesan: $('#txt_pemesan').val(),
                    hidden_no_ref_po: $('#hidden_no_ref_po').val(),
                    cmb_status_bayar: $('#cmb_status_bayar').val(),
                    txt_tempo_pembayaran: $('#tmpo_pembayaran').val(),
                    txt_lokasi_pengiriman: $('#lks_pengiriman').val(),
                    txt_tempo_pengiriman: $('#tmpo_pengiriman').val(),
                    cmb_lokasi_pembelian: $('#lks_pembelian').val(),
                    txt_keterangan: $('#keterangan').val(),
                    txt_no_penawaran: $('#no_penawaran').val(),
                    cmb_ppn: $('#ppn').val(),
                    txt_total_pembayaran: $('#ttl_pembayaran').val(),
                    txt_ket_pengiriman: $('#ket_pengiriman').val(),
                    txt_uang_muka: $('#txt_uang_muka').val(),
                    txt_no_voucher: $('#txt_no_voucher').val(),
                    txt_no_spp: $('#noppo' + id).val(),
                    hidden_no_ref: $('#hidden_no_ref_spp_' + id).val(),
                    hidden_kode_brg: $('#hidden_kode_brg_1' + id).val(),
                    hidden_nama_brg: $('#hidden_nama_brg_1' + id).val(),
                    hidden_satuan_brg: $('#hidden_satuan_brg_1' + id).val(),
                    txt_qty: $('#txt_qty_1' + id).val(),
                    txt_harga: $('#txt_harga_1' + id).val(),
                    hidden_kodept: $('#hidden_kd_pt_1' + id).val(),
                    hidden_namapt: $('#hidden_nama_pt_1' + id).val(),
                    txt_merk: $('#txt_merk_1' + id).val(),
                    txt_keterangan_rinci: $('#txt_keterangan_rinci_1' + id).val(),
                    txt_disc: $('#txt_disc_1' + id).val(),
                    cmb_kurs: $('#cmb_kurs_1' + id).val(),
                    txt_biaya_lain: $('#txt_biaya_lain_1' + id).val(),
                    txt_keterangan_biaya_lain: $('#txt_biaya_lain_1' + id).val(),
                    hidden_tanggal: $('#hidden_tgl_spp_1' + id).val()
                },
                success: function(data) {
                    if (true) {
                        console.table(data);
                        // $('#lbl_status_simpan_1' + id).empty();
                        // $('#lbl_status_simpan_1' + id).append('<label style="color:#6fc1ad;"><i class="fa fa-check" style="color:#6fc1ad;"></i> Berhasil disimpan</label>');
                        $.toast({
                            heading: 'Success',
                            text: 'Berhasil disimpan',
                            position: 'top-right',
                            icon: 'success',
                            showHideTransition: 'plain'
                            // reload: false
                        });


                        $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                        $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');

                        // $('.div_form_2').find('#pilihSpp' + id + ',#cmb_jenis_budget_1' + id + ',#txt_merk_1' + id + ',#txt_qty_1' + id + ',#txt_harga_1' + id + ',#cmb_kurs_1' + id + ',#txt_disc_1' + id + ',#txt_biaya_lain_1' + id + ',#txt_keterangan_biaya_lain_1' + id + ',#txt_keterangan_rinci_1' + id).attr('disabled', '');
                        // $('.div_form_2').find('#pilihSpp' + id + ',#cmb_jenis_budget_1' + id + ',#txt_merk_1' + id + ',#txt_qty_1' + id + ',#txt_harga_1' + id + ',#cmb_kurs_1' + id + ',#txt_disc_1' + id + ',#txt_biaya_lain_1' + id + ',#txt_keterangan_biaya_lain_1' + id + ',#txt_keterangan_rinci_1' + id).addClass('class', 'bg-light');

                        $('#tr_' + id).find('input,textarea,select').attr('disabled', '');
                        $('#tr_' + id).find('input,textarea,select').addClass('form-control bg-light');

                        // $('#tableRinciPO').find('input,textarea,select').attr('disabled', '');
                        // $('#tableRinciPO').find('input,textarea,select').addClass('class', 'bg-light');
                        $('#btn_simpan_' + id).hide();
                        $('#btn_hapus_row_' + id).hide();
                        $('#btn_ubah_' + id).show();
                        $('#btn_hapus_' + id).show();
                        $('#h4_no_po').html('No. PO : ' + data.nopo);
                        $('#hidden_no_po').val(data.nopo);
                        $('#lbl_spp_status').empty();
                        $('#h4_no_ref_po').html('No. Ref PO : ' + data.noref);
                        $('#hidden_no_ref_po').val(data.noref);
                        $('#hidden_id_po').val(data.id_po);
                        var idItem = data.id_item;
                        // console.log(idItem);
                        // console.log(id);
                        $('#hidden_id_po_item_' + id).val(idItem);

                        simpanBaru = false;
                    } else {
                        $('#lbl_status_simpan_' + id).empty();
                        $('#lbl_status_simpan_' + id).append('<label style="color:#ff0000;"><i class="fa fa-close" style="color:#ff0000;"></i> Gagal Tersimpan !</label>');
                    }
                }
            });
        }
        // simpan keduakalinya
        else {
            // console.log('simpan setelah dengan keadaan po dibuat')

            console.table({
                hidden_kode_departemen: $('#hidden_kd_departemen_1' + id).val(),
                hidden_departemen: $('#hidden_departemen_1' + id).val(),
                cmb_jenis_budget: $('#cmb_jenis_budget_1' + id).val(),
                txt_kode_supplier: $('#kd_supplier').val(),
                txt_supplier: $('#txtsupplier').val(),
                txt_kode_pemesan: $('#txt_kode_pemesan').val(),
                txt_pemesan: $('#txt_pemesan').val(),
                hidden_no_ref_po: $('#hidden_no_ref_po').val(),
                cmb_status_bayar: $('#cmb_status_bayar').val(),
                txt_tempo_pembayaran: $('#tmpo_pembayaran').val(),
                txt_lokasi_pengiriman: $('#lks_pengiriman').val(),
                txt_tempo_pengiriman: $('#tmpo_pengiriman').val(),
                cmb_lokasi_pembelian: $('#lks_pembelian').val(),
                txt_keterangan: $('#keterangan').val(),
                txt_no_penawaran: $('#no_penawaran').val(),
                cmb_ppn: $('#ppn').val(),
                txt_total_pembayaran: $('#ttl_pembayaran').val(),
                txt_ket_pengiriman: $('#ket_pengiriman').val(),
                txt_uang_muka: $('#txt_uang_muka').val(),
                txt_no_voucher: $('#txt_no_voucher').val(),
                txt_no_spp: $('#noppo' + id).val(),
                hidden_no_ref: $('#hidden_no_ref_spp_' + id).val(),
                hidden_kode_brg: $('#hidden_kode_brg_1' + id).val(),
                hidden_nama_brg: $('#hidden_nama_brg_1' + id).val(),
                hidden_satuan_brg: $('#hidden_satuan_brg_1' + id).val(),
                txt_qty: $('#txt_qty_1' + id).val(),
                txt_harga: $('#txt_harga_1' + id).val(),
                hidden_kodept: $('#hidden_kd_pt_1' + id).val(),
                hidden_namapt: $('#hidden_nama_pt_1' + id).val(),
                txt_merk: $('#txt_merk_1' + id).val(),
                txt_keterangan_rinci: $('#txt_keterangan_rinci_1' + id).val(),
                txt_disc: $('#txt_disc_1' + id).val(),
                cmb_kurs: $('#cmb_kurs_1' + id).val(),
                txt_biaya_lain: $('#txt_biaya_lain_1' + id).val(),
                txt_keterangan_biaya_lain: $('#txt_biaya_lain_1' + id).val(),
                hidden_tanggal: $('#hidden_tgl_spp_1' + id).val(),
            })

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Po/saveItem') ?>",
                dataType: "JSON",
                beforeSend: function() {
                    // $('#lbl_status_simpan_1' + id).empty();
                    // $('#lbl_status_simpan_1' + id).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Simpan</label>');
                    if ($.trim($('#hidden_no_po').val()) == '') {
                        $('#lbl_spp_status').empty();
                        $('#lbl_spp_status').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Generate PO Number</label>');
                    }
                },

                data: {
                    hidden_kode_departemen: $('#hidden_kd_departemen_1' + id).val(),
                    hidden_departemen: $('#hidden_departemen_1' + id).val(),
                    cmb_jenis_budget: $('#cmb_jenis_budget_1' + id).val(),
                    txt_kode_supplier: $('#kd_supplier').val(),
                    txt_supplier: $('#txtsupplier').val(),
                    txt_kode_pemesan: $('#txt_kode_pemesan').val(),
                    txt_pemesan: $('#txt_pemesan').val(),
                    hidden_no_ref_po: $('#hidden_no_ref_po').val(),
                    cmb_status_bayar: $('#cmb_status_bayar').val(),
                    txt_tempo_pembayaran: $('#tmpo_pembayaran').val(),
                    txt_lokasi_pengiriman: $('#lks_pengiriman').val(),
                    txt_tempo_pengiriman: $('#tmpo_pengiriman').val(),
                    cmb_lokasi_pembelian: $('#lks_pembelian').val(),
                    txt_keterangan: $('#keterangan').val(),
                    txt_no_penawaran: $('#no_penawaran').val(),
                    cmb_ppn: $('#ppn').val(),
                    txt_total_pembayaran: $('#ttl_pembayaran').val(),
                    txt_ket_pengiriman: $('#ket_pengiriman').val(),
                    txt_uang_muka: $('#txt_uang_muka').val(),
                    txt_no_voucher: $('#txt_no_voucher').val(),
                    txt_no_spp: $('#noppo' + id).val(),
                    hidden_no_ref: $('#hidden_no_ref_spp_' + id).val(),
                    hidden_kode_brg: $('#hidden_kode_brg_1' + id).val(),
                    hidden_nama_brg: $('#hidden_nama_brg_1' + id).val(),
                    hidden_satuan_brg: $('#hidden_satuan_brg_1' + id).val(),
                    txt_qty: $('#txt_qty_1' + id).val(),
                    txt_harga: $('#txt_harga_1' + id).val(),
                    hidden_kodept: $('#hidden_kd_pt_1' + id).val(),
                    hidden_namapt: $('#hidden_nama_pt_1' + id).val(),
                    txt_merk: $('#txt_merk_1' + id).val(),
                    txt_keterangan_rinci: $('#txt_keterangan_rinci_1' + id).val(),
                    txt_disc: $('#txt_disc_1' + id).val(),
                    cmb_kurs: $('#cmb_kurs_1' + id).val(),
                    txt_biaya_lain: $('#txt_biaya_lain_1' + id).val(),
                    txt_keterangan_biaya_lain: $('#txt_biaya_lain_1' + id).val(),
                    hidden_tanggal: $('#hidden_tgl_spp_1' + id).val(),

                },

                success: function(data) {
                    if (true) {

                        // $('#lbl_status_simpan_1' + id).empty();
                        // $('#lbl_status_simpan_1' + id).append('<label style="color:#6fc1ad;"><i class="fa fa-check" style="color:#6fc1ad;"></i> Berhasil disimpan</label>');

                        $.toast({
                            heading: 'Success',
                            text: 'Berhasil disimpan',
                            position: 'top-right',
                            icon: 'success',
                            showHideTransition: 'plain'
                            // reload: false
                        });


                        $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                        $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');

                        // $('.div_form_2').find('#pilihSpp' + id + ',#cmb_jenis_budget_1' + id + ',#txt_merk_1' + id + ',#txt_qty_1' + id + ',#txt_harga_1' + id + ',#cmb_kurs_1' + id + ',#txt_disc_1' + id + ',#txt_biaya_lain_1' + id + ',#txt_keterangan_biaya_lain_1' + id + ',#txt_keterangan_rinci_1' + id).attr('disabled', '');
                        // $('.div_form_2').find('#pilihSpp' + id + ',#cmb_jenis_budget_1' + id + ',#txt_merk_1' + id + ',#txt_qty_1' + id + ',#txt_harga_1' + id + ',#cmb_kurs_1' + id + ',#txt_disc_1' + id + ',#txt_biaya_lain_1' + id + ',#txt_keterangan_biaya_lain_1' + id + ',#txt_keterangan_rinci_1' + id).addClass('class', 'bg-light');

                        // $('#tableRinciPO').find('input,textarea,select').attr('disabled', '');
                        // $('#tableRinciPO').find('input,textarea,select').addClass('class', 'bg-light');
                        $('#tr_' + id).find('input,textarea,select').attr('disabled', '');
                        $('#tr_' + id).find('input,textarea,select').addClass('form-control bg-light');

                        $('#btn_simpan_' + id).hide();
                        $('#btn_hapus_row_' + id).show();
                        $('#btn_ubah_' + id).show();
                        $('#btn_hapus_' + id).show();
                        // console.log(response);

                        $('#h4_no_po').html('No. PO : ' + data.nopo);
                        $('#hidden_no_po').val(data.nopo);
                        $('#lbl_spp_status').empty();
                        $('#h4_no_ref_po').html('No. Ref PO : ' + data.noref);
                        $('#hidden_no_ref_po').val(data.noref);
                        // $('#hidden_id_po').val(data.id_po);
                        $('#hidden_id_po_item_' + id).val(data.id_item);

                        // simpanBaru = false;
                    } else {
                        $('#lbl_status_simpan_').empty();
                        $('#lbl_status_simpan_').append('<label style="color:#ff0000;"><i class="fa fa-close" style="color:#ff0000;"></i> Gagal Tersimpan !</label>');
                    }


                }
            });

        }

    }

    function update(id) {
        if (updateBaru) {
            console.log('update', id);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Po/update') ?>",
                dataType: "JSON",
                beforeSend: function() {
                    // $('#lbl_status_simpan_1' + id).empty();
                    // $('#lbl_status_simpan_1' + id).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Update</label>');
                },

                data: {
                    hidden_id_po: $('#hidden_id_po').val(),
                    hidden_no_po: $('#hidden_no_po').val(),
                    hidden_id_po_item: $('#hidden_id_po_item_' + id).val(),
                    hidden_kode_departemen: $('#hidden_kd_departemen_1' + id).val(),
                    hidden_departemen: $('#hidden_departemen_1' + id).val(),
                    cmb_jenis_budget: $('#cmb_jenis_budget_1' + id).val(),
                    txt_kode_supplier: $('#kd_supplier').val(),
                    txt_supplier: $('#txtsupplier').val(),
                    txt_kode_pemesan: $('#txt_kode_pemesan').val(),
                    txt_pemesan: $('#txt_pemesan').val(),
                    hidden_no_ref_po: $('#hidden_no_ref_po').val(),
                    cmb_status_bayar: $('#cmb_status_bayar').val(),
                    txt_tempo_pembayaran: $('#tmpo_pembayaran').val(),
                    txt_lokasi_pengiriman: $('#lks_pengiriman').val(),
                    txt_tempo_pengiriman: $('#tmpo_pengiriman').val(),
                    cmb_lokasi_pembelian: $('#lks_pembelian').val(),
                    txt_keterangan: $('#keterangan').val(),
                    txt_no_penawaran: $('#no_penawaran').val(),
                    cmb_ppn: $('#ppn').val(),
                    txt_total_pembayaran: $('#ttl_pembayaran').val(),
                    txt_ket_pengiriman: $('#ket_pengiriman').val(),
                    txt_uang_muka: $('#txt_uang_muka').val(),
                    txt_no_voucher: $('#txt_no_voucher').val(),
                    txt_no_spp: $('#noppo' + id).val(),
                    hidden_no_ref: $('#hidden_no_ref_spp_' + id).val(),
                    hidden_kode_brg: $('#hidden_kode_brg_1' + id).val(),
                    hidden_nama_brg: $('#hidden_nama_brg_1' + id).val(),
                    hidden_satuan_brg: $('#hidden_satuan_brg_1' + id).val(),
                    txt_qty: $('#txt_qty_1' + id).val(),
                    txt_harga: $('#txt_harga_1' + id).val(),
                    hidden_kodept: $('#hidden_kd_pt_1' + id).val(),
                    hidden_namapt: $('#hidden_nama_pt_1' + id).val(),
                    txt_merk: $('#txt_merk_1' + id).val(),
                    txt_keterangan_rinci: $('#txt_keterangan_rinci_1' + id).val(),
                    txt_disc: $('#txt_disc_1' + id).val(),
                    cmb_kurs: $('#cmb_kurs_1' + id).val(),
                    txt_biaya_lain: $('#txt_biaya_lain_1' + id).val(),
                    txt_keterangan_biaya_lain: $('#txt_biaya_lain_1' + id).val(),
                    hidden_tanggal: $('#hidden_tgl_spp_1' + id).val(),

                },

                success: function(data) {
                    if (true) {

                        // $('#lbl_status_simpan_1' + id).empty();
                        // $('#lbl_status_simpan_1' + id).append('<label style="color:#6fc1ad;"><i class="fa fa-check" style="color:#6fc1ad;"></i> Berhasil diupdate</label>');
                        $.toast({
                            heading: 'Success',
                            text: 'Berhasil diupdate',
                            position: 'top-right',
                            stack: true,
                            icon: 'success'
                        });


                        $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                        $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');


                        $('#tr_' + id).find('input,textarea,select').attr('disabled', '');
                        $('#tr_' + id).find('input,textarea,select').addClass('form-control bg-light');


                        // $('#tableRinciPO tbody #tr_' + ' td').find('#btn_simpan_' + ',#txt_no_spp_').attr('disabled', '');
                        $('#btn_simpan_' + id).hide();
                        $('#btn_hapus_row' + id).hide();
                        $('#btn_update_' + id).hide();
                        $('#btn_cancel_update_' + id).hide();

                        $('#btn_ubah_' + id).show();
                        $('#btn_hapus_' + id).show();
                        updateBaru = false;
                    } else {
                        $('#lbl_status_simpan_').empty();
                        $('#lbl_status_simpan_').append('<label style="color:#ff0000;"><i class="fa fa-close" style="color:#ff0000;"></i> Gagal Tersimpan !</label>');
                    }
                }
            });
        } else {
            console.log('update setelah dengan keadaan po dibuat');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Po/updateItem') ?>",
                dataType: "JSON",
                beforeSend: function() {
                    // $('#lbl_status_simpan_1' + id).empty();
                    // $('#lbl_status_simpan_1' + id).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Update</label>');
                },

                data: {
                    hidden_id_po_item: $('#hidden_id_po_item_' + id).val(),
                    hidden_kode_departemen: $('#hidden_kd_departemen_1' + id).val(),
                    hidden_departemen: $('#hidden_departemen_1' + id).val(),
                    cmb_jenis_budget: $('#cmb_jenis_budget_1' + id).val(),
                    txt_kode_supplier: $('#kd_supplier').val(),
                    txt_supplier: $('#txtsupplier').val(),
                    txt_kode_pemesan: $('#txt_kode_pemesan').val(),
                    txt_pemesan: $('#txt_pemesan').val(),
                    hidden_no_ref_po: $('#hidden_no_ref_po').val(),
                    cmb_status_bayar: $('#cmb_status_bayar').val(),
                    txt_tempo_pembayaran: $('#tmpo_pembayaran').val(),
                    txt_lokasi_pengiriman: $('#lks_pengiriman').val(),
                    txt_tempo_pengiriman: $('#tmpo_pengiriman').val(),
                    cmb_lokasi_pembelian: $('#lks_pembelian').val(),
                    txt_keterangan: $('#keterangan').val(),
                    txt_no_penawaran: $('#no_penawaran').val(),
                    cmb_ppn: $('#ppn').val(),
                    txt_total_pembayaran: $('#ttl_pembayaran').val(),
                    txt_ket_pengiriman: $('#ket_pengiriman').val(),
                    txt_uang_muka: $('#txt_uang_muka').val(),
                    txt_no_voucher: $('#txt_no_voucher').val(),
                    txt_no_spp: $('#noppo' + id).val(),
                    hidden_no_ref: $('#hidden_no_ref_spp_' + id).val(),
                    hidden_kode_brg: $('#hidden_kode_brg_1' + id).val(),
                    hidden_nama_brg: $('#hidden_nama_brg_1' + id).val(),
                    hidden_satuan_brg: $('#hidden_satuan_brg_1' + id).val(),
                    txt_qty: $('#txt_qty_1' + id).val(),
                    txt_harga: $('#txt_harga_1' + id).val(),
                    hidden_kodept: $('#hidden_kd_pt_1' + id).val(),
                    hidden_namapt: $('#hidden_nama_pt_1' + id).val(),
                    txt_merk: $('#txt_merk_1' + id).val(),
                    txt_keterangan_rinci: $('#txt_keterangan_rinci_1' + id).val(),
                    txt_disc: $('#txt_disc_1' + id).val(),
                    cmb_kurs: $('#cmb_kurs_1' + id).val(),
                    txt_biaya_lain: $('#txt_biaya_lain_1' + id).val(),
                    txt_keterangan_biaya_lain: $('#txt_biaya_lain_1' + id).val(),
                    hidden_tanggal: $('#hidden_tgl_spp_1' + id).val(),

                },

                success: function(data) {
                    if (true) {

                        // $('#lbl_status_simpan_1' + id).empty();
                        // $('#lbl_status_simpan_1' + id).append('<label style="color:#6fc1ad;"><i class="fa fa-check" style="color:#6fc1ad;"></i> Berhasil diupdate</label>');

                        $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                        $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');
                        $.toast({
                            heading: 'Success',
                            text: 'Berhasil diupdate',
                            position: 'top-right',
                            stack: true,
                            icon: 'success'
                        });

                        // $('#tableRinciPO').find('input,textarea,select').attr('disabled', '');
                        // $('#tableRinciPO').find('input,textarea,select').addClass('form-control bg-light');
                        $('#tr_' + id).find('input,textarea,select').attr('disabled', '');
                        $('#tr_' + id).find('input,textarea,select').addClass('form-control bg-light');

                        // $('#tableRinciPO tbody #tr_' + ' td').find('#btn_simpan_' + ',#txt_no_spp_').attr('disabled', '');
                        $('#btn_simpan_' + id).hide();
                        $('#btn_hapus_row' + id).hide();
                        $('#btn_update_' + id).hide();
                        $('#btn_cancel_update_' + id).hide();
                        $('#btn_ubah_' + id).show();
                        $('#btn_hapus_' + id).show();

                    } else {
                        $('#lbl_status_simpan_' + id).empty();
                        $('#lbl_status_simpan_' + id).append('<label style="color:#ff0000;"><i class="fa fa-close" style="color:#ff0000;"></i> Gagal Tersimpan !</label>');
                    }
                }
            });
        }

    }

    function ubah(id) {
        $('.div_form_1').find('input,textarea,select').removeAttr('disabled');
        $('.div_form_1').find('input,textarea,select').removeClass('bg-light');
        $('#tableRinciPO').find('input,textarea').removeAttr('disabled');
        $('#tableRinciPO').find('input,textarea').removeClass('bg-light');
        $('#tableRinciPO').find('select').removeAttr('disabled');
        $('#tableRinciPO').find('select').removeClass('bg-light');
        $('#btn_ubah_' + id).hide();
        $('#btn_hapus_' + id).hide();
        $('#btn_update_' + id).show();
        $('#btn_cancel_update_' + id).show();
    }

    function cancleUpdate(id) {
        // console.log('cancelke' + id);
        if (cancleUpdatePO) {

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Po/cancel_ubah_rinci') ?>",
                dataType: "JSON",
                beforeSend: function() {
                    $('#lbl_status_simpan_1' + id).empty();
                    $('#lbl_status_simpan_1' + id).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Cancel Update</label>');
                },
                data: {
                    id_po: $('#hidden_id_po').val(),
                    id_po_item: $('#hidden_id_po_item_' + id).val(),
                },
                success: function(data) {
                    // console.log(data);
                    var po = data.data_po;
                    var item = data.data_item_po;

                    //untuk PO
                    $('#tgl_po').append(po.tglpo);
                    $('#tmpo_pembayaran').val(po.tempo_bayar);
                    $('#tmpo_pengiriman').val(po.tempo_kirim);
                    $('#lks_pengiriman').val(po.lokasikirim);
                    $('#no_penawaran').val(po.ket_acc);
                    $('#ket_pengiriman').val(po.ket_kirim);
                    $('#pph').val(po.no_acc);
                    $('#ket_pengiriman').val(po.ket);
                    $('#ttl_pembayaran').val(po.totalbayar);

                    //untuk item PO

                    $('#txt_merk_1' + id).val(item.merek);
                    $('#txt_qty_1' + id).val(item.qty);
                    $('#txt_harga_1' + id).val(item.harga);
                    $('#txt_disc_1' + id).val(item.disc);
                    $('#txt_biaya_lain_1' + id).val(item.JUMLAHBPO);
                    $('#txt_biaya_lain_1' + id).val(item.nama_bebanbpo);
                    $('#txt_biaya_lain_1' + id).val(item.ket);

                    $('#btn_ubah_' + id).show();
                    $('#btn_hapus_' + id).show();
                    $('#btn_update_' + id).hide();
                    $('#btn_cancel_update_' + id).hide();
                    $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                    $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');

                    // $('#tableRinciPO').find('input,textarea,select').attr('disabled', '');
                    // $('#tableRinciPO').find('input,textarea,select').addClass('form-control bg-light');
                    $('#tr_' + id).find('input,textarea,select').attr('disabled', '');
                    $('#tr_' + id).find('input,textarea,select').addClass('form-control bg-light');

                    $('#lbl_status_simpan_1' + id).empty();
                    $('#lbl_status_simpan_1' + id).append('<label style="color:#6fc1ad;"><i class="fa fa-undo" style="color:#6fc1ad;"></i> Edit dibatalkan</label>');
                    cancleUpdatePO = false;
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Po/cancel_ubah_rinci') ?>",
                dataType: "JSON",
                beforeSend: function() {
                    $('#lbl_status_simpan_1' + id).empty();
                    $('#lbl_status_simpan_1' + id).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Cancel Update</label>');
                },
                data: {
                    id_po: $('#hidden_id_po').val(),
                    id_po_item: $('#hidden_id_po_item_' + id).val(),
                },
                success: function(data) {
                    // console.log(data);
                    var po = data.data_po;
                    var item = data.data_item_po;

                    //untuk PO
                    $('#tgl_po').append(po.tglpo);
                    $('#tmpo_pembayaran').val(po.tempo_bayar);
                    $('#tmpo_pengiriman').val(po.tempo_kirim);
                    $('#lks_pengiriman').val(po.lokasikirim);
                    $('#no_penawaran').val(po.ket_acc);
                    $('#ket_pengiriman').val(po.ket_kirim);
                    $('#pph').val(po.no_acc);
                    $('#ket_pengiriman').val(po.ket);
                    $('#ttl_pembayaran').val(po.totalbayar);

                    //untuk item PO

                    $('#txt_merk_1' + id).val(item.merek);
                    $('#txt_qty_1' + id).val(item.qty);
                    $('#txt_harga_1' + id).val(item.harga);
                    $('#txt_disc_1' + id).val(item.disc);
                    $('#txt_biaya_lain_1' + id).val(item.JUMLAHBPO);
                    $('#txt_biaya_lain_1' + id).val(item.nama_bebanbpo);
                    $('#txt_biaya_lain_1' + id).val(item.ket);

                    $('#btn_ubah_' + id).show();
                    $('#btn_hapus_' + id).show();
                    $('#btn_update_' + id).hide();
                    $('#btn_cancel_update_' + id).hide();

                    $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                    $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');
                    // $('#tableRinciPO').find('input,textarea,select').attr('disabled', '');
                    // $('#tableRinciPO').find('input,textarea,select').addClass('form-control bg-light');

                    $('#tr_' + id).find('input,textarea,select').attr('disabled', '');
                    $('#tr_' + id).find('input,textarea,select').addClass('form-control bg-light');

                    $('#lbl_status_simpan_1' + id).empty();
                    $('#lbl_status_simpan_1' + id).append('<label style="color:#6fc1ad;"><i class="fa fa-undo" style="color:#6fc1ad;"></i> Edit dibatalkan</label>');
                    cancleUpdatePO = false;
                }
            });
        }

    }

    function hapusRinci(id) {
        $('#hidden_no_delete').val(id);
        if (id == 1) {
            deleteData();
        } else {

            $('#modalKonfirmasiHapus').modal('show');
        }
    }

    function deletePO(no) {
        var nopo = $('#hidden_no_po').val();

        // console.log(nopo);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Po/deletePO') ?>",
            dataType: "JSON",

            beforeSend: function() {
                $('#lbl_status_simpan_' + no).empty();
                $('#lbl_status_simpan_' + no).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Hapus PO</label>');
            },

            data: {
                nopo: nopo
            },

            success: function(data) {
                // console.log(data);

                location.reload();
            }
        });
    }

    function deleteData() {
        // console.log("Okeee");
        var no = $('#hidden_no_delete').val();
        var id_item = $('#hidden_id_po_item_' + no).val();
        var id_po = $('#hidden_id_po').val();
        // var no_po = $('#hidden_no_po').val();

        // console.log(id_item);
        // console.log(id_po);
        $('#modalKonfirmasiHapus').modal('hide');

        var rowCount = $("#tableRinciPO td").closest("tr").length;

        if (rowCount != 1) {

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Po/hapus_rinci'); ?>",
                dataType: "JSON",
                beforeSend: function() {
                    $('#lbl_status_simpan_' + no).empty();
                    $('#lbl_status_simpan_' + no).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Hapus Item</label>');
                },

                data: {
                    hidden_id_po_item: $('#hidden_id_po_item_' + no).val()
                    // hidden_no_ref_spp: $('#hidden_no_ref_spp_' + no).val(),
                    // hidden_kode_brg: $('#hidden_kode_brg_1' + no).val()
                },
                success: function(data) {
                    $('#tr_' + no).remove();
                    swal('Data Berhasil dihapus');
                    totalBayar();
                    // $('#btn_konfirmasi_terima_' + index).removeAttr('disabled');
                    // $('.modal-success').modal('show');
                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });
        } else {
            // swal('Tidak Bisa dihapus, item PO tinggal 1');
            Swal.fire({
                title: 'Item PO Tinggal 1',
                text: "Yakin akan menghapus PO ini?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya Hapus!'
            }).then((result) => {
                if (result.value) {
                    // var no_po = $('#hidden_no_po').val();
                    deletePO(no);
                }
            });

        }
    }

    function validasi(id) {
        var merk = $('#txt_merk_1' + id).val();
        var qty = $('#txt_qty_1' + id).val();
        var ketBiaya = $('#txt_keterangan_biaya_lain_1' + id).val();
        var ketRinci = $('#txt_keterangan_rinci_1' + id).val();
        // var jml = $('#txt_jumlah_1' + id).val();
        if (merk == "" && ketBiaya == "" && ketRinci == "" && qty == "") {
            // alert("Data Harus Diisi");
            $('#txt_merk_1' + id).css({
                "background": "#FFCECE"
            });
            $('#txt_merk_1' + id).after('<br id="br_' + id + '" /><small id="pesan_error_' + id + '" style="margin-top:0px;color:red;">Harus diisi !</small>');

            $('#txt_qty_1' + id).css({
                "background": "#FFCECE"
            });
            $('#txt_qty_1' + id).after('<br id="br_' + id + '" /><small id="pesan_error_' + id + '" style="margin-top:0px;color:red;">Harus diisi !</small>');

            $('#txt_keterangan_biaya_lain_1' + id).css({
                "background": "#FFCECE"
            });
            $('#txt_keterangan_biaya_lain_1' + id).after('<br id="br_' + id + '" /><small id="pesan_error_' + id + '" style="margin-top:0px;color:red;">Harus diisi !</small>');

            $('#txt_keterangan_rinci_1' + id).css({
                "background": "#FFCECE"
            });
            $('#txt_keterangan_rinci_1' + id).after('<br id="br_' + id + '" /><small id="pesan_error_' + id + '" style="margin-top:0px;color:red;">Harus diisi !</small>');

            $('#txt_jumlah_1' + id).css({
                "background": "#FFCECE"
            });
            $('#txt_jumlah_1' + id).after('<br id="br_' + id + '" /><small id="pesan_error_' + id + '" style="margin-top:0px;color:red;">Harus diisi !</small>');
        } else {
            // $('#tableRinciPO').find('input,textarea,select').attr('disabled', '');
            // $('#tableRinciPO').find('input,textarea,select').addClass('class', 'bg-light');


            simpan(id);
        }
        return false;


    }





    //CANCLE

    $('#cmb_pilih_jenis_po').change(function() {
        var jenis_po = $('#cmb_pilih_jenis_po').val();

        if (jenis_po == "PO") {
            $('#hidden_jenis_spp').val('SPP');
        } else if (jenis_po == "POA") {
            $('#hidden_jenis_spp').val('SPPA');
        } else if (jenis_po == "PO-Lokal") {
            $('#hidden_jenis_spp').val('SPPI');
        } else if (jenis_po == "PO-Khusus") {
            $('#hidden_jenis_spp').val('SPPK');
        }
    });




    $("#select2").select2({
        ajax: {
            url: "<?php echo site_url('Po/getPoo') ?>",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    toko: params.term, // search term
                };
            },
            processResults: function(data) {
                var results = [];
                $.each(data, function(index, item) {
                    results.push({
                        id: item.kode,
                        text: item.supplier
                    });
                });
                return {
                    results: results
                };
            }
        }

    }).on('select2:select', function(evt) {
        var kode = $(".select2 option:selected").text();
        var data = $(".select2 option:selected").val();
        $('#kd_supplier').val(kode);
        $('#txtsupplier').val(data);

    });



    $(document).ready(function() {
        // $('#supllier').DataTable({
        //     "processing": true,
        //     "serverSide": true,
        //     "order": [],
        //     "ajax": {
        //         "url": "<?php echo site_url('Po/get_ajax') ?>",
        //         "type": "POST"
        //     },
        //     "columnDefs ": [{
        //         "targets": [0],
        //         "orderable": false,
        //     }, ],
        // });

        $('#spp').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "select": true,
            "ajax": {
                "url": "<?php echo site_url('Po/get_ajax') ?>",
                "type": "POST"
            },
            "columnDefs ": [{
                "targets": [0],
                "orderable": false,
            }, ],
            "dom": 'Bfrtip',
            "buttons": [{
                    "text": "Select All",
                    "action": function() {
                        $('#spp').DataTable().rows().select();
                    }
                },
                {
                    "text": "Unselect All",
                    "action": function() {
                        $('#spp').DataTable().rows().deselect();
                    }
                }
            ],
        });

        $(document).on('click', '#pilih', function() {
            var id = $(this).data('id');
            // console.log(id);
            var kode = $(this).data('kode');
            var supplier = $(this).data('supplier');
            $('#id-supplier').val(id);
            $('#kd_supplier').val(kode);
            $('#supplier').val(supplier);
            $("#modal-supllier").modal('hide');
        });
    })
</script>