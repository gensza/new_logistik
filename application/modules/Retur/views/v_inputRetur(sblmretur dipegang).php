<div class="container-fluid">
    <!-- start row-->
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="widget-rounded-circle card-box mt-2">
                <h4 class="header-title"><?= $title ?></h4>
                <p class="sub-header" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">
                    Retur Bukti Keluar Barang
                </p>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row mb-1">
                            <label class="col-4 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">No&nbsp;Retur&nbsp;<span class="required">*</span>
                            </label>
                            <label class="col-md-4 col-sm-6 col-xs-12" id="lbl_no_ret">-</label>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Tgl&nbsp;Retur<span class="required">*</span>
                            </label>
                            <div class="col-md-7">
                                <input id="txt_tgl_retur" name="txt_tgl_retur" class="form-control bg-light" value="<?= date('Y-m-d'); ?>" required="required" type="date">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row mb-1">
                            <label class="col-3 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">No&nbsp;BKB&nbsp;<span class="required">*</span>
                            </label>
                            <div class="col-md-6">
                                <input id="txt_no_bkb" name="txt_no_bkb" class="form-control" required="required" type="text" onfocus="getListBKB()" onkeypress="getEventBKB(event,this.value)" placeholder="No BKB">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">No&nbsp;BA<span class="required">*</span>
                            </label>
                            <div class="col-md-8">
                                <input id="txt_no_ba" name="txt_no_ba" class="form-control" required="required" type="text" placeholder="No BA">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group row mb-1">
                            <label class="col-4 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">No&nbsp;Ref&nbsp;BKB&nbsp;<span class="required">*</span>
                            </label>
                            <div class="col-md-7">
                                <input id="txt_no_ref_bkb" name="txt_no_ref_bkb" class="form-control" required="required" type="text" readonly="" placeholder="No Ref BKB">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Keterangan&nbsp;<span class="required">*</span>
                            </label>
                            <div class="col-md col-sm col-xs-12">
                                <textarea class="resizable_textarea form-control" id="txt_keterangan" rows="1" name="txt_keterangan" placeholder="Keterangan"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="tableRinciReturBKB" width="150%">
                        <thead>
                            <tr>
                                <th width="3%"></th>
                                <th width="25%" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Barang</th>
                                <th width="10%" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Afd/Unit</th>
                                <th width="8%" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small"> Blok/Sub</th>
                                <th width="20%" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Kode Beban</th>
                                <th width="25%" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Sub Beban</th>
                                <th width="8%" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Qty Retur</th>
                                <!-- <th width="8%">Qty Dikeluarkan</th> -->
                                <th width="25%" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small">Keterangan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody_rincian" name="tbody_rincian">
                            <tr id="tr_1">
                                <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                    <input type="hidden" id="hidden_proses_status_1" name="hidden_proses_status_1" value="insert">
                                    <button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" id="btn_tambah_row" name="btn_tambah_row" onclick="tambah_row(1)"></button><br />
                                    <button class="btn btn-xs btn-danger fa fa-minus btn_hapus_row" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row" name="btn_hapus_row" onclick="hapus_row(1)"></button>
                                </td>
                                <form id="form_rinci_1" name="form_rinci_1" method="POST" action="javascript:;">
                                    <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                        <!-- Barang -->
                                        <input type="text" class="form-control" id="txt_barang_1" name="txt_barang_1" onfocus="cari_barang(1)" placeholder="Barang">
                                        <label id="lbl_kode_barang_1"></label>
                                        <label id="lbl_nama_barang_1"></label>
                                        <input type="hidden" id="hidden_kode_barang_1" name="hidden_kode_barang_1">
                                        <input type="hidden" id="hidden_nama_barang_1" name="hidden_nama_barang_1">
                                        <input type="hidden" id="hidden_grup_barang_1" name="hidden_grup_barang_1">
                                    </td>
                                    <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                        <!-- AFD/UNIT -->
                                        <select class="form-control set_strip_cmb" id="cmb_afd_unit_1" name="cmb_afd_unit_1" onchange="cmb_blok_sub(1)">
                                            <option value=""></option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="99">99</option>
                                        </select>
                                    </td>
                                    <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                        <!-- BLOK/SUB -->
                                        <select class="form-control set_strip_cmb" id="cmb_blok_sub_1" name="cmb_blok_sub_1">
                                            <option value=""></option>
                                        </select>
                                    </td>
                                    <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                        <!-- Kode Beban -->
                                        <input type="text" class="form-control" id="txt_kode_beban_1" name="txt_kode_beban_1" placeholder="Kode Beban" readonly="">
                                        <label class="control-label" id="lbl_ket_beban_1"></label>
                                        <input type="hidden" id="hidden_ket_beban_1" name="hidden_ket_beban_1">
                                    </td>
                                    <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                        <!-- Account Beban -->
                                        <input type="text" class="form-control" id="txt_account_beban_1" name="txt_account_beban_1" placeholder="Sub Beban" readonly="">
                                        <label class="control-label" id="lbl_no_acc_1"></label>
                                        <label class="control-label" id="lbl_nama_acc_1"></label>
                                        <input type="hidden" id="hidden_no_acc_1" name="hidden_no_acc_1">
                                        <input type="hidden" id="hidden_nama_acc_1" name="hidden_nama_acc_1">
                                    </td>
                                    <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                        <!-- Qty Retur & Stok di Tgl ini & Satuan -->
                                        <input type="text" class="form-control currencyduadigit" id="txt_qty_retur_1" name="txt_qty_retur_1" onkeyup="validasiQty(this.value,1)" placeholder="Qty Retur">
                                        <input type="hidden" id="hidden_qty_bkb_1" name="hidden_qty_bkb_1">
                                        <input type="hidden" id="hidden_qty_sdh_pernah_ret_1" name="hidden_qty_sdh_pernah_ret_1">
                                        <input type="hidden" id="hidden_stok_tgl_ini_1" name="hidden_stok_tgl_ini_1">
                                        <input type="hidden" id="hidden_satuan_1" name="hidden_satuan_1">
                                    </td>
                                    <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                        <!-- Keterangan -->
                                        <textarea style="width: 112px; height: 69px;" class="resizable_textarea form-control" id="txt_ket_rinci_1" name="txt_ket_rinci_1" placeholder="Keterangan" onkeypress="saveRinciEnter(event,1)"></textarea>
                                        <label id="lbl_status_simpan_1"></label>
                                        <input type="hidden" id="hidden_id_retskbitem_1" name="hidden_id_retskbitem_1">
                                    </td>
                                    <td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">
                                        <button class="btn btn-xs btn-success fa fa-save" id="btn_simpan_1" name="btn_simpan_1" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="saveRinciClick(1)"></button>
                                        <button style="display:none;" class="btn btn-xs btn-warning fa fa-edit" id="btn_ubah_1" name="btn_ubah_1" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" onclick="ubahRinci(1)"></button>
                                        <button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_1" name="btn_update_1" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="updateRinci(1)"></button>
                                        <!-- <button style="display:none;" class="btn btn-xs btn-primary fa fa-close" id="btn_cancel_update_1" name="btn_cancel_update_1" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update" onclick="cancelUpdate(1)"></button> -->
                                        <button style="display:none;" class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_1" name="btn_hapus_1" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(1)"></button>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row-->


</div> <!-- container -->