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
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group row mb-1">
                                <label class="col-5 col-form-label">Lokasi Pengiriman*</label>
                                <div class="col-5">
                                    <input class="form-control" type="text" id="lks_pengiriman" name="lks_pengiriman" placeholder="Lokasi Pengiriman" autocomplite="off" required>
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
                        <div class="table-responsive">
                            <table id="tableRinciPO" class="table table-striped table-bordered" width="150%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>SPP</th>
                                        <th>Jenis Budget</th>
                                        <th>Item Barang</th>
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
                                    <tr id="tr_1">
                                        <td width="3%">
                                            <input type="hidden" id="hidden_proses_status_1" name="hidden_proses_status_1" value="insert">
                                            <button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" id="btn_tambah_row" name="btn_tambah_row" onclick="tambah_row('1')"></button>
                                            <button style="display:none;" class="btn btn-xs btn-danger fa fa-minus btn_hapus_row" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row" name="btn_hapus_row" onclick="hapus_row('1')"></button>
                                        </td>
                                        <form id="form_rinci_1" name="form_rinci_1" method="POST" action="javascript:;">
                                            <td width="30%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <!-- <input type="text" class="form-control" id="pilihSpp" name="txt_no_spp_1" placeholder="Cari SPP" readonly required=""> -->
                                                <select class="js-data-example-ajax form-control select3" id="pilihSpp">
                                                    <option selected="selected">Cari SPP</option>
                                                </select>
                                                <!-- <h6 style="margin-top: 0px;" id="lbl_nama_brg_1">Nama Barang : ...</h6><br /> -->
                                                <input type="hidden" id="hidden_no_ref_spp_1" name="hidden_no_ref_spp_1">
                                                <input type="hidden" id="hidden_tgl_ref_1" name="hidden_tgl_ref_1">
                                                <input type="hidden" id="hidden_kd_departemen_1" name="hidden_kd_departemen_1">
                                                <input type="hidden" id="hidden_departemen_1" name="hidden_departemen_1">
                                                <input type="hidden" id="hidden_tgl_spp_1" name="hidden_tgl_spp_1">
                                                <input type="hidden" id="hidden_kd_pt_1" name="hidden_kd_pt_1">
                                                <input type="hidden" id="hidden_nama_pt_1" name="hidden_nama_pt_1">
                                                <input type="hidden" id="noppo" name="noppo">


                                            </td>
                                            <td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <select class="form-control" id="cmb_jenis_budget_1" name="cmb_jenis_budget_1" required>
                                                    <option value="">-- Pilih --</option>
                                                    <option value="TEKNIK">TEKNIK</option>
                                                    <option value="BIBITAN">BIBITAN</option>
                                                    <option value="LC & TANAM">LC & TANAM</option>
                                                    <option value="RAWAT">RAWAT</option>
                                                    <option value="PANEN">PANEN</option>
                                                    <option value="TEKNIK">TEKNIK</option>
                                                    <option value="PABRIK">PABRIK</option>
                                                    <option value="KANTOR">KANTOR</option>
                                                    <option value="Kendaraan">Kendaraan</option>
                                                    <option value="TBM">TBM</option>
                                                </select>
                                            </td>
                                            <td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <input type="text" class="form-control" id="txt_merk_1" name="txt_merk_1" placeholder="Merk" required>

                                                <input type="hidden" id="hidden_kode_brg_1" name="hidden_kode_brg_1">
                                                <input type="hidden" id="hidden_nama_brg_1" name="hidden_nama_brg_1">
                                                <input type="hidden" id="hidden_satuan_brg_1" name="hidden_satuan_brg_1">
                                            </td>
                                            <td width="7%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <input type="text" class="form-control" id="txt_qty_1" name="txt_qty_1" placeholder="Qty" size="8" onkeyup="jumlah('1')" required /><br />
                                            </td>
                                            <td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <input type="text" class="form-control" id="txt_harga_1" name="txt_harga_1" size="15" value="0" onkeyup="jumlah('1')" placeholder="Harga dalam Rupiah" required /><br />
                                            </td>
                                            <td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <select class="form-control" id="cmb_kurs_1" name="cmb_kurs_1" required="">
                                                    <option value="Rp">Rp IDR</option>
                                                    <option value="USD">&dollar; USD</option>
                                                    <option value="SGD">S&dollar; SGD</option>
                                                    <option value="Euro">&euro; Euro</option>
                                                    <option value="GBP">&pound; GBP</option>
                                                    <option value="Yen">&yen; Yen</option>
                                                    <option value="MYR">RM MYR</option>
                                                </select><br />
                                            </td>
                                            <td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <input type="text" class="form-control" id="txt_disc_1" name="txt_disc_1" size="10" value="0" onkeyup="jumlah('1')" placeholder="Disc" />
                                            </td>
                                            <td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <input type="text" class="form-control" id="txt_biaya_lain_1" name="txt_biaya_lain_1" value="0" onkeyup="jumlah('1')" placeholder="Biaya Lain" size="15" required /><br />
                                            </td>
                                            <td width="12%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <textarea class="resizable_textarea form-control" size="10" id="txt_keterangan_biaya_lain_1" name="txt_keterangan_biaya_lain_1" placeholder="Keterangan Biaya"></textarea>
                                            </td>
                                            <td width="12%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <textarea class="resizable_textarea form-control" id="txt_keterangan_rinci_1" name="txt_keterangan_rinci_1" size="26" placeholder="Keterangan" onkeypress="saveRinciEnter(event,1)"></textarea><br />
                                                <label id="lbl_status_simpan_1"></label>
                                                <input type="hidden" id="hidden_id_po_item_1" name="hidden_id_po_item_1">
                                            </td>
                                            <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <input type="text" class="form-control" id="txt_jumlah_1" name="txt_jumlah_1" size="15" placeholder="Jumlah" readonly required />
                                            </td>
                                            <td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                                <button class="btn btn-xs btn-success fa fa-save" id="btn_simpan_1" name="btn_simpan_1" type="button" data-toggle="tooltip" data-placement="right" title="Simpan"></button>
                                                <button style="display:none;" class="btn btn-xs btn-warning fa fa-edit mb-1" id="btn_ubah_1" name="btn_ubah_1" type="button" data-toggle="tooltip" data-placement="right" title="Ubah"></button>
                                                <button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_1" name="btn_update_1" type="button" data-toggle="tooltip" data-placement="right" title="Update"></button>
                                                <button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick mt-1" id="btn_cancel_update_1" name="btn_cancel_update_1" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update"></button>
                                                <button style="display:none;" class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_1" name="btn_hapus_1" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci('1')"></button>
                                            </td>
                                        </form>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div><!-- end col -->
    </div>

</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="modal fade show" id="modal-supllier" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scrollableModalTitle">Pilih Supplier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="supllier" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Kode</th>
                                            <th style="text-align: center;">Nama Supplier</th>
                                            <th style="text-align: center;">Jenis Usaha</th>
                                            <th style="text-align: center;">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">

            <div class="modal fade show" id="modal-spp" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scrollableModalTitle">Pilih SPP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-md-5 col-sm-3 col-xs-12">Alokasi
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
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

                            <div class="table-responsive">
                                <table id="spp" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No. SPP</th>
                                            <th>Tgl. SPP</th>
                                            <th>Ref. SPP</th>
                                            <th>Departemen</th>
                                            <th>Kode Barang</th>
                                            <th>Item Barang</th>
                                            <th>Ket</th>
                                            <th>Lokasi</th>
                                            <th>Status</th>
                                            <th>PO</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="modal fade show" id="modal-supllier" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scrollableModalTitle">Pilih Supplier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="supllier" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Kode</th>
                                            <th style="text-align: center;">Nama Supplier</th>
                                            <th style="text-align: center;">Jenis Usaha</th>
                                            <th style="text-align: center;">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">

            <div class="modal fade show" id="modal-spp" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-dialog-scrollable modal-full-width" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scrollableModalTitle">Pilih SPP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-md-5 col-sm-3 col-xs-12">Alokasi
                                </label>
                                <div class="col-md-3 col-sm-6 col-xs-12">
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

                            <div class="table-responsive">
                                <table id="spp" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No. SPP</th>
                                            <th>Tgl. SPP</th>
                                            <th>Ref. SPP</th>
                                            <th>Departemen</th>
                                            <th>Kode Barang</th>
                                            <th>Item Barang</th>
                                            <th>Ket</th>
                                            <th>Lokasi</th>
                                            <th>Status</th>
                                            <th>PO</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>

                                </table>

                            </div>

                        </div>
                        <div class="modal-footer">
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        </div>
    </div>
</div>
<script>
    function tambah_row(row) {
        // row++;
        console.log(row);
        var tr_buka = '<tr id="tr_' + row + '">';
        var td_col_1 = '<td width="3%">' +
            '<input type="hidden" id="hidden_proses_status_' + row + '" name="hidden_proses_status_' + row + '" value="insert">' +
            '<button class="btn btn-xs btn-info fa fa-plus"  data-toggle="tooltip" data-placement="left" title="Tambah" id="btn_tambah_row' + row + '" name="btn_tambah_row"></button>' +
            '<button class="btn btn-xs btn-danger fa fa-minus btn_hapus_row_' + row + '" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row_' + row + '" name="btn_hapus_row" onclick="hapus_row(' + row + ')"></button>' +
            '</td>';
        var form_buka = '<form id="form_rinci_' + row + '" name="form_rinci_' + row + '" method="POST" action="javascript:;">';
        var td_col_2 = '<td width="30%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<select class="js-data-example-ajax form-control select3" id="pilihSpp" name="pilihSpp' + row + '" required>' +
            '<option selected="selected">Cari SPP</option>' +

            '</select>' +
            '<input type="hidden" id="hidden_no_ref_spp_1' + row + '" name="hidden_no_ref_spp_1' + row + '">' +
            '<input type="hidden" id="hidden_tgl_ref_1' + row + '" name="hidden_tgl_ref_1' + row + '">' +
            '<input type="hidden" id="hidden_kd_departemen_1' + row + '" name="hidden_kd_departemen_1' + row + '">' +
            '<input type="hidden" id="hidden_departemen_1' + row + '" name="hidden_departemen_1' + row + '">' +
            '<input type="hidden" id="hidden_tgl_spp_1' + row + '" name="hidden_tgl_spp_1' + row + '">' +
            '<input type="hidden" id="hidden_kd_pt_1' + row + '" name="hidden_kd_pt_1' + row + '">' +
            '<input type="hidden" id="hidden_nama_pt_1' + row + '" name="hidden_nama_pt_1' + row + '">' +
            '<input type="hidden" id="noppo' + row + '" name="noppo' + row + '">' +

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
        var td_col_4 = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control" id="txt_merk_1' + row + '" name="txt_merk_1' + row + '" placeholder="Merk"  required />' +
            '<input type="hidden" class="form-control" id="hidden_kode_brg_1' + row + '" name="hidden_kode_brg_1' + row + '"   />' +
            '<input type="hidden" class="form-control" id="hidden_nama_brg_1' + row + '" name="hidden_nama_brg_1' + row + '"   />' +
            '<input type="hidden" class="form-control" id="hidden_satuan_brg_1' + row + '" name="hidden_satuan_brg_1' + row + '"   />' +

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


            '</td>';
        var td_col_11 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea class="resizable_textarea form-control" id="txt_keterangan_rinci_1' + row + '" name="txt_keterangan_rinci_1' + row + '" size="26" placeholder="Keterangan" onkeypress="saveRinciEnter(event,' + row + ')"></textarea><br />' +

            '</td>';
        var td_col_12 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control" id="txt_jumlah_1 ' + row + '" name="txt_jumlah_1" size="15" placeholder="Jumlah" readonly required />' +
            '<label id="lbl_status_simpan_1"></label>' +
            '<input type="hidden" id="hidden_id_po_item_1 ' + row + '" name="hidden_id_po_item_1">' +
            '</td>';
        var td_col_13 = '<td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<button class="btn btn-xs btn-success fa fa-save" id="btn_simpan_' + row + '" name="btn_simpan_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" ></button>' +
            '<button style="display:none;" class="btn btn-xs btn-warning fa fa-edit mb-1" id="btn_ubah_' + row + '" name="btn_ubah_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" ></button>' +
            '<button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_' + row + '" name="btn_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" ></button>' +
            '<button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick mt-1" id="btn_cancel_update_' + row + '" name="btn_cancel_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_' + row + '" name="btn_hapus_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" ></button>' +

            '</td>';
        var form_tutup = '</form>';
        var tr_tutup = '</tr>';
        $('#tbody_rincian').append(tr_buka + td_col_1 + form_buka + td_col_2 + td_col_3 + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_9 + td_col_10 + td_col_11 + td_col_12 + td_col_13 + form_tutup + tr_tutup);
        $('#txt_qty_1' + row).number(true, 2);
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
        if ($.trim($('#tgl_po').val()) != '' && $.trim($('#txt_kode_supplier').val()) != '' && $.trim($('#txt_supplier').val()) != '' && $.trim($('#cmb_status_bayar').val()) != '' && $.trim($('#tmpo_pembayaran').val()) != '' && $.trim($('#tmpo_pengiriman').val()) != '' && $.trim($('#ket_pengiriman').val()) != '' && $.trim($('#lks_pengiriman').val()) != '' && $.trim($('#lks_pembelian').val()) != '' && $.trim($('#no_penawaran').val()) != '' && $.trim($('#txt_pemesan').val()) != '' && $.trim($('#txt_kode_pemesan').val()) != '' && $.trim($('#txt_uang_muka').val()) != '' && $.trim($('#txt_no_voucher').val()) != '' && $.trim($('#ppn').val()) != '' && $.trim($('#txt_keterangan').val()) != '' && $.trim($('#dikirim_kebun').val()) != '') {
            $('.div_form_2').show();
        } else {
            $('.div_form_2').hide();
        }
    }

    function jumlah(no_row) {
        var qty = $('#txt_qty_' + no_row).val();
        var harga = $('#txt_harga_' + no_row).val();
        var disc = $('#txt_disc_' + no_row).val();
        var biaya_lain = $('#txt_biaya_lain_' + no_row).val();

        var hargaDisc = (parseInt(harga) * parseInt(disc)) / 100;
        var hargaSetelahDisc = parseInt(harga) - parseInt(hargaDisc);

        var nilai = (parseFloat(qty) * parseFloat(hargaSetelahDisc)) + parseFloat(biaya_lain);

        $('#txt_jumlah_' + no_row).val(nilai);
    }
    //Simpan Data
    $('#btn_simpan_1').on('click', function() {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Po/save') ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#lbl_status_simpan_1').empty();
                $('#lbl_status_simpan_1').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Simpan</label>');
                if ($.trim($('#hidden_no_po').val()) == '') {
                    $('#lbl_spp_status').empty();
                    $('#lbl_spp_status').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Generate PO Number</label>');
                }
            },

            data: {
                hidden_kode_departemen: $('#hidden_kd_departemen_1').val(),
                hidden_departemen: $('#hidden_departemen_1').val(),
                cmb_jenis_budget: $('#cmb_jenis_budget_1').val(),
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
                txt_no_spp: $('#noppo').val(),
                hidden_no_ref: $('#hidden_no_ref_spp_1').val(),
                hidden_kode_brg: $('#hidden_kode_brg_1').val(),
                hidden_nama_brg: $('#hidden_nama_brg_1').val(),
                hidden_satuan_brg: $('#hidden_satuan_brg_1').val(),
                txt_qty: $('#txt_qty_1').val(),
                txt_harga: $('#txt_harga_1').val(),
                hidden_kodept: $('#hidden_kd_pt_1').val(),
                hidden_namapt: $('#hidden_nama_pt_1').val(),
                txt_merk: $('#txt_merk_1').val(),
                txt_keterangan_rinci: $('#txt_keterangan_rinci_1').val(),
                txt_disc: $('#txt_disc_1').val(),
                cmb_kurs: $('#cmb_kurs_1').val(),
                txt_biaya_lain: $('#txt_biaya_lain_1').val(),
                txt_keterangan_biaya_lain: $('#txt_biaya_lain_1').val(),
                hidden_tanggal: $('#hidden_tgl_spp_1').val(),
            },

            success: function(data) {
                if (true) {

                    $('#lbl_status_simpan_1').empty();
                    $('#lbl_status_simpan_1').append('<label style="color:#6fc1ad;"><i class="fa fa-check" style="color:#6fc1ad;"></i> Berhasil disimpan</label>');

                    $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                    $('.div_form_1').find('input,textarea,select').addClass('class', 'form-control bg-light');

                    $('#tableRinciPO').find('input,textarea,select').attr('disabled', '');
                    $('#tableRinciPO').find('input,textarea,select').addClass('class', 'form-control bg-light');

                    // $('#tableRinciPO tbody #tr_' + ' td').find('#btn_simpan_' + ',#txt_no_spp_').attr('disabled', '');
                    $('#btn_simpan_1').hide();
                    $('#btn_hapus_row').hide();
                    $('#btn_ubah_1').show();
                    $('#btn_hapus_1').show();
                    // console.log(response);

                    $('#h4_no_po').html('No. PO : ' + data.nopo);
                    $('#hidden_no_po').val(data.nopo);
                    $('#lbl_spp_status').empty();
                    $('#h4_no_ref_po').html('No. Ref PO : ' + data.noref);
                    $('#hidden_no_ref_po').val(data.noref);
                    $('#hidden_id_po').val(data.id_po);
                    $('#hidden_id_po_item_1').val(data.id_item);

                } else {
                    $('#lbl_status_simpan_').empty();
                    $('#lbl_status_simpan_').append('<label style="color:#ff0000;"><i class="fa fa-close" style="color:#ff0000;"></i> Gagal Tersimpan !</label>');
                }


            }
        });
        return false;
    });
    //cancle Data
    $('#btn_cancel_update_1').on('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Po/cancel_ubah_rinci') ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#lbl_status_simpan_1').empty();
                $('#lbl_status_simpan_1').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Cancel Update</label>');
            },
            data: {
                id_po: $('#hidden_id_po').val(),
                id_po_item: $('#hidden_id_po_item_1').val(),
            },
            success: function(data) {
                console.log(data);
                var po = data.data_po;
                var item = data.data_item_po;
                $('#tgl_po').append(po.tglpo);
                $("#cmb_status_bayar").change(function() {
                    $(this).children("option:selected").val(po.bayar);
                });
                $('#tmpo_pembayaran').val(po.tempo_bayar);
                $('#tmpo_pengiriman').val(po.tempo_kirim);
                $('#lks_pengiriman').val(po.lokasikirim);
                $("#lks_pembelian").change(function() {
                    $(this).children("option:selected").val(po.lokasi_beli);
                });


                $('#lbl_status_simpan_1').empty();
                $('#lbl_status_simpan_1').append('<label style="color:#6fc1ad;"><i class="fa fa-undo" style="color:#6fc1ad;"></i> Edit dibatalkan</label>');


            }
        });
        return false;
    });

    //GET UPDATE
    $('#btn_ubah_1').on('click', function() {

        $('.div_form_1').find('input,textarea,select').removeAttr('disabled');
        $('.div_form_1').find('input,textarea,select').removeClass('bg-light');

        $('#tableRinciPO').find('input,textarea').removeAttr('disabled');
        $('#tableRinciPO').find('input,textarea').removeClass('bg-light');
        $('#tableRinciPO').find('select').removeAttr('disabled');
        $('#tableRinciPO').find('select').removeClass('bg-light');


        $('#btn_ubah_1').hide();
        $('#btn_hapus_1').hide();
        $('#btn_update_1').show();
        $('#btn_cancel_update_1').show();

    });




    //CANCLE
    $('#btn_update_1').on('click', function() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Po/update') ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#lbl_status_simpan_1').empty();
                $('#lbl_status_simpan_1').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Update</label>');
            },

            data: {
                hidden_id_po: $('#hidden_id_po').val(),
                hidden_no_po: $('#hidden_no_po').val(),
                hidden_id_po_item: $('#hidden_id_po_item_1').val(),
                hidden_kode_departemen: $('#hidden_kd_departemen_1').val(),
                hidden_departemen: $('#hidden_departemen_1').val(),
                cmb_jenis_budget: $('#cmb_jenis_budget_1').val(),
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
                txt_no_spp: $('#noppo').val(),
                hidden_no_ref: $('#hidden_no_ref_spp_1').val(),
                hidden_kode_brg: $('#hidden_kode_brg_1').val(),
                hidden_nama_brg: $('#hidden_nama_brg_1').val(),
                hidden_satuan_brg: $('#hidden_satuan_brg_1').val(),
                txt_qty: $('#txt_qty_1').val(),
                txt_harga: $('#txt_harga_1').val(),
                hidden_kodept: $('#hidden_kd_pt_1').val(),
                hidden_namapt: $('#hidden_nama_pt_1').val(),
                txt_merk: $('#txt_merk_1').val(),
                txt_keterangan_rinci: $('#txt_keterangan_rinci_1').val(),
                txt_disc: $('#txt_disc_1').val(),
                cmb_kurs: $('#cmb_kurs_1').val(),
                txt_biaya_lain: $('#txt_biaya_lain_1').val(),
                txt_keterangan_biaya_lain: $('#txt_biaya_lain_1').val(),
                hidden_tanggal: $('#hidden_tgl_spp_1').val(),
            },

            success: function(data) {
                if (true) {

                    $('#lbl_status_simpan_1').empty();
                    $('#lbl_status_simpan_1').append('<label style="color:#6fc1ad;"><i class="fa fa-check" style="color:#6fc1ad;"></i> Berhasil disimpan</label>');

                    $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                    $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');

                    $('#tableRinciPO').find('input,textarea,select').attr('disabled', '');
                    $('#tableRinciPO').find('input,textarea,select').addClass('form-control bg-light');

                    // $('#tableRinciPO tbody #tr_' + ' td').find('#btn_simpan_' + ',#txt_no_spp_').attr('disabled', '');
                    $('#btn_simpan_1').hide();
                    $('#btn_hapus_row').hide();
                    $('#btn_update_1').hide();
                    $('#btn_cancel_update_1').hide();
                    $('#btn_ubah_1').show();
                    $('#btn_hapus_1').show();

                } else {
                    $('#lbl_status_simpan_').empty();
                    $('#lbl_status_simpan_').append('<label style="color:#ff0000;"><i class="fa fa-close" style="color:#ff0000;"></i> Gagal Tersimpan !</label>');
                }
            }
        });
        return false;


    });



    // $('#kd_supplier').click(function() {
    //     $("#modal-supllier").modal();
    // });
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

    $('#pilihSpp').click(function() {
        $("#modal-spp").modal();
    });

    $(".js-data-example-ajax").select2({
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

    $("#pilihSpp").select2({
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

    }).on('select3:select', function(evt) {
        // console.log(evt)
        // data = JSON.parse(evt);
        // $.each(data, function(index, value) {
        //     var opodsi = value.nama_petugas;
        //     $('#petugas').val(opsi);
        // });
        var data = $(".select3 option:selected").text();
        $('#hidden_no_ref_spp_1').val(data);

    });

    $('.select3').change(function() {
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
                // console.log(data);
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




    $(document).ready(function() {
        $('#supllier').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo site_url('Po/get_ajax') ?>",
                "type": "POST"
            },
            "columnDefs ": [{
                "targets": [0],
                "orderable": false,
            }, ],
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