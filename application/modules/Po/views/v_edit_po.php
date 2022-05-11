<div class="container-fluid">
    <div class="row mt-0">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <h4 class="header-title ml-2">PO <i>(Edit)</i></h4>
                        <div class="button-list mr-2">
                            <button class="btn btn-xs btn-info" id="data_po" onclick="data_po()">Data PO</button>
                            <button onclick="new_po()" class="btn btn-xs btn-success" id="a_po_baru">PO Baru</button>
                            <button data-toggle="modal" data-target="#alasanbatal" class="btn btn-xs btn-danger" id="batal_po">Batal PO</button>
                            <button class="btn btn-xs btn-primary" id="cetak" onclick="cetak()">Cetak</button>
                            <button onclick="goBack()" class="btn btn-xs btn-secondary" id="kembali">Kembali</button>
                        </div>
                    </div>
                    <h6 id="lbl_status_delete_po"></h6>
                    <div class="row">
                        <p class="sub-header ml-2" style="margin-top: -12px;">
                            <font face="Verdana" size="2.5">Purchase Order</font>
                        </p>
                    </div>
                    <div class="row div_form_1" style="margin-top: -15px;">
                        <div class="col-lg-4 col-xl-4 col-12">
                            <div class="form-group row" style="margin-bottom: 2px;">
                                <label for="cmb_pilih_jenis_po" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Jenis&nbsp;PO&nbsp;*
                                    <!-- <font face="Verdana" size="1.5">Jenis&nbsp;PO&nbsp;*</font> -->
                                </label>
                                <div class="col-9 col-xl-12 ">
                                    <input type="hidden" id="hidden_jenis_spp" name="hidden_jenis_spp">
                                    <input type="hidden" id="status_lokasi" value="<?= $lokasi_sesi = $this->session->userdata('status_lokasi'); ?>">
                                    <input type="hidden" name="id_po" id="id_po">
                                    <select class="form-control form-control-sm bg-light" id="cmb_pilih_jenis_po" disabled onchange="jenisPO()">
                                        <option disabled>
                                            <font face="Verdana" size="1.5">-Pilih-</font>
                                        </option>
                                        <?php
                                        switch ($lokasi_sesi) {
                                            case 'PKS':
                                        ?>
                                                <option value="PO">
                                                    <font face="Verdana" size="1.5">PO</font>
                                                </option>
                                                <option selected="selected" value="PO-Lokal">
                                                    <font face="Verdana" size="1.5">PO-Lokal</font>
                                                </option>
                                                <option value="POA">
                                                    <font face="Verdana" size="1.5">POA - PO Asset</font>
                                                </option>
                                                <option value="PO-Khusus">
                                                    <font face="Verdana" size="1.5">POK - PO Khusus</font>
                                                </option>
                                            <?php
                                                break;
                                            case 'SITE':
                                            ?>
                                                <option value="PO">
                                                    <font face="Verdana" size="1.5">PO</font>
                                                </option>
                                                <option value="PO-Lokal">
                                                    <font face="Verdana" size="1.5">PO-Lokal</font>
                                                </option>
                                                <option value="POA">
                                                    <font face="Verdana" size="1.5">POA - PO Asset</font>
                                                </option>
                                                <option value="PO-Khusus">
                                                    <font face="Verdana" size="1.5">POK - PO Khusus</font>
                                                </option>
                                            <?php
                                                break;
                                            case 'RO':
                                            ?>
                                                <option value="PO">
                                                    <font face="Verdana" size="1.5">PO</font>
                                                </option>
                                                <option selected="selected" value="PO-Lokal">
                                                    <font face="Verdana" size="1.5">PO-Lokal</font>
                                                </option>
                                                <option value="POA">
                                                    <font face="Verdana" size="1.5">POA - PO Asset</font>
                                                </option>
                                                <option value="PO-Khusus">
                                                    <font face="Verdana" size="1.5">POK - PO Khusus</font>
                                                </option>
                                            <?php
                                                break;
                                            case 'HO':
                                            ?>
                                                <option value="PO">
                                                    <font face="Verdana" size="1.5">PO</font>
                                                </option>
                                                <option value="POA">
                                                    <font face="Verdana" size="1.5">POA - PO Asset</font>
                                                </option>
                                                <option value="PO-Khusus">
                                                    <font face="Verdana" size="1.5">POK - PO Khusus</font>
                                                </option>
                                        <?php
                                                break;
                                            default:
                                                break;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 1px;">
                                <label for="tgl_po" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    <!-- <font face="Verdana" size="1.5">Tgl.&nbsp;PO&nbsp;*</font> -->
                                    Tgl.&nbsp;PO&nbsp;*
                                </label>
                                <div class="col-9 col-xl-12">
                                    <input type="date" class="form-control form-control-sm" id="tgl_po" name="tgl_po" autocomplite="off" required>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 1px;">
                                <label for="select2" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    <!-- <font face="Verdana" size="1.5">Supplier&nbsp;*</font> -->
                                    Supplier&nbsp;*
                                </label>
                                <div class="col-9 col-xl-12">
                                    <select class="form-control form-control-sm supply" id="select2">

                                        <?php if ($this->session->userdata('status_lokasi') == 'HO') { ?>
                                            <option selected disabled>Nama Supplier</option>
                                        <?php } else { ?>
                                            <option disabled>Nama Supplier</option>
                                            <option selected value="0475">TOKO ( KAS )</option>
                                        <?php } ?>
                                    </select>

                                    <input type="hidden" name="kd_supplier" value="TOKO ( KAS )" id="kd_supplier">
                                    <input type="hidden" name="txtsupplier" value="0475" id="txtsupplier">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 1px;">
                                <label for="cmb_status_bayar" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Status&nbsp;Bayar*
                                    <!-- <font face="Verdana" size="1.5">Status&nbsp;Bayar*</font> -->
                                </label>
                                <div class="col-9 col-xl-12">
                                    <select class="form-control form-control-sm" id="cmb_status_bayar" name="cmb_status_bayar">
                                        <option <?= $select->bayar == "Cash" ? "selected" : "" ?> value="Cash">
                                            Cash
                                        </option>
                                        <option <?= $select->bayar == "Kredit" ? "selected" : "" ?> value="Kredit">
                                            Kredit
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="tmpo_pembayaran" class="col-lg-3 col-xl-3 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Tempo&nbsp;Bayar
                                    <!-- <font face="Verdana" size="1.5">Tempo bayar*</font> -->
                                </label>
                                <div class="col-3">
                                    <input type="number" id="tmpo_pembayaran" name="tmpo_pembayaran" class="form-control form-control-sm" placeholder="0" value="0" autocomplite="off"><span>
                                        <font face="Verdana" size="1.5">Hari</font>
                                    </span>
                                </div>
                                <label for="tmpo_pengiriman" class="col-lg-3 col-xl-3 col-form-label" style="margin-top: -3px; font-size: 11px;">
                                    Tempo&nbsp;Pengirim
                                    <!-- <font face="Verdana" size="1.5">Tempo<br>Pengirim*</font> -->
                                </label>
                                <div class="col-3">
                                    <input type="number" id="tmpo_pengiriman" name="tmpo_pengiriman" class="form-control form-control-sm" placeholder="0" value="0" autocomplite="off"><span>
                                        <font face="Verdana" size="1.5">Hari</font>
                                    </span>
                                </div>

                            </div>


                        </div>
                        <div class="col-lg-4 col-xl-4 col-12">

                            <div class="form-group row" style="margin-bottom: 1px;">
                                <label for="lks_pengiriman" class="col-lg-4 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Lokasi&nbsp;Pengiriman*
                                </label>
                                <div class="col-8 col-xl-12">
                                    <input class="form-control form-control-sm" type="text" id="lks_pengiriman" name="lks_pengiriman" placeholder="Lokasi Pengiriman" autocomplite="off" required>


                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 1px;">
                                <label for="lks_pembelian" class="col-lg-4 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Lokasi&nbsp;Pembelian*
                                    <!-- <font face="Verdana" size="1.5">Lokasi&nbsp;Pembelian*</font> -->
                                </label>

                                <div class="col-8 col-xl-12">
                                    <select class="form-control form-control-sm" id="lks_pembelian" name="lks_pembelian" required>
                                        <option disabled>-Pilih-
                                        </option>
                                        <?php if ($this->session->userdata('status_lokasi') == 'HO') { ?>
                                            <option <?= $select->lokasi_beli == "HO" ? "selected" : "" ?> value="HO">HO
                                            </option>
                                            <option <?= $select->lokasi_beli == "RO" ? "selected" : "" ?> value="RO">RO
                                            </option>
                                            <option <?= $select->lokasi_beli == "PKS" ? "selected" : "" ?> value="PKS">PKS
                                            </option>
                                            <option <?= $select->lokasi_beli == "SITE" ? "selected" : "" ?> value="SITE">KEBUN
                                            </option>
                                        <?php } else if ($this->session->userdata('status_lokasi') == 'RO') { ?>
                                            <option selected="selected" value="RO">RO
                                            </option>
                                        <?php } else if ($this->session->userdata('status_lokasi') == 'PKS') { ?>
                                            <option selected="selected" value="PKS">PKS
                                            </option>
                                        <?php } else { ?>
                                            <option selected="selected" value="SITE">KEBUN
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" style="margin-bottom: 1px;">
                                <label for="no_penawaran" class="col-lg-4 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    No.&nbsp;Penawaran*
                                    <!-- <font face="Verdana" size="1.5">No.&nbsp;Penawaran*</font> -->
                                </label>
                                <div class="col-8 col-xl-12">
                                    <input type="number" class="form-control form-control-sm" id="no_penawaran" name="no_penawaran" placeholder="No Penawaran" autocomplite="off" value="0" required>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 1px;">
                                <label for="txt_pemesan" class="col-lg-4 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Pemesan*
                                </label>
                                <div class="col-8 col-xl-12">
                                    <input type="hidden" name="txt_pemesan" id="txt_pemesan" value="<?= $this->session->userdata('id_user'); ?>">
                                    <input type="text" class="form-control form-control-sm bg-light" id="nama_pemesan" name="nama_pemesan" value="<?= $this->session->userdata('user'); ?>" readonly required>
                                </div>
                            </div>
                            <?php
                            switch ($lokasi_sesi) {
                                case 'HO':
                            ?>
                                    <div class="form-group row" style="margin-bottom: 1px;">
                                        <label for="devisi" class="col-lg-4 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                            Divisi*
                                            <!-- <font face="Verdana" size="1.5">Devisi*</font> -->
                                        </label>
                                        <div class="col-8 col-xl-12">
                                            <!-- <input type="text" class="form-control form-control-sm bg-light" id="devisi" name="devisi" readonly required> -->
                                            <input type="hidden" name="" id="hidden_devisi">
                                            <input type="hidden" name="" id="hidden_kode_devisi">

                                            <select class="form-control form-control-sm" id="devisi" style="font-size: 12px;">
                                                <option selected disabled>Pilih</option>
                                                <?php
                                                foreach ($devisi as $d) : { ?>
                                                        <option <?= $d['kodetxt'] == $select->kode_dev ? "selected" : "" ?> value="<?= $d['kodetxt'] ?>"><?= $d['PT'] ?></option>
                                                <?php }
                                                endforeach;
                                                ?>
                                            </select>
                                        </div>


                                    </div>
                                <?php
                                    break;
                                case 'RO':
                                case 'SITE':
                                case 'PKS':
                                ?>
                                    <div class="form-group row" style="margin-bottom: 1px;">
                                        <label for="devisi" class="col-lg-4 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                            Divisi*
                                            <!-- <font face="Verdana" size="1.5">Devisi*</font> -->
                                        </label>
                                        <div class="col-8 col-xl-12">
                                            <input type="text" class="form-control form-control-sm bg-light" id="devisi" name="devisi" readonly required>
                                            <input type="hidden" name="" id="hidden_devisi">
                                            <input type="hidden" name="" id="hidden_kode_devisi">
                                        </div>
                                    </div>
                            <?php
                                    break;
                                default:
                                    break;
                            }
                            ?>

                            <div class="form-group row" style="margin-bottom: 1px;">
                                <label for="ket_pengiriman" class="col-lg-4 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    Ket.&nbsp;Pengirim
                                    <!-- <font face="Verdana" size="1.5">Ket.&nbsp;Pengirim</font> -->
                                </label>
                                <div class="col-8 col-xl-12">
                                    <textarea maxlength="250" class="form-control form-control-sm" id="ket_pengiriman" name="ket_pengiriman" placeholder="Keterangan Pengiriman" autocomplite="off">-</textarea>
                                    <input type="hidden" id="txt_uang_muka" name="txt_uang_muka" value="0.00">
                                    <input type="hidden" id="txt_no_voucher" name="txt_no_voucher" value="0">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-xl-4 col-12">



                            <div class="form-group row" style="margin-bottom: 1px;">
                                <label for="pph" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    PPH
                                    <!-- <font face="Verdana" size="1.5">PPH*</font> -->
                                </label>
                                <div class="col-4 col-xl-12">
                                    <input type="number" class="form-control form-control-sm" id="pph" name="pph" placeholder="PPH" onkeyup="jumlah('1')" autocomplite="off" value="0" required>
                                </div>
                                <label for="tmpo_pengiriman" class="col-lg-3 col-xl-3 col-form-label" style="margin-left: -11px;margin-top: -3px; font-size: 14px;">
                                    <b>%</b>
                                </label>


                            </div>
                            <div class="form-group row" style="margin-bottom: 1px;">
                                <label for="ppn" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                    PPN*
                                    <!-- <font face="Verdana" size="1.5">PPN*</font> -->
                                </label>
                                <div class="col-9 col-xl-12">
                                    <select class="form-control form-control-sm" id="ppn" name="ppn" required>
                                        <option <?= $select->ppn == '0' ? "selected" : "" ?> value="0">N</option>
                                        <option <?= $select->ppn == '10' ? "selected" : "" ?> value="10">Y</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-bottom: 1px;">
                                <label for="keterangan" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px;font-size: 12px;">
                                    Ket*
                                    <!-- <font face="Verdana" size="1.5">Ket*</font> -->
                                </label>
                                <div class="col-9 col-xl-12">
                                    <textarea maxlength="250" class="form-control form-control-sm" id="keterangan" name="keterangan" placeholder="Keterangan" autocomplite="off">-</textarea>
                                </div>
                            </div>
                            <?php
                            switch ($lokasi_sesi) {
                                case 'HO':
                            ?>
                                    <div class="form-group row" style="margin-bottom: 1px;">
                                        <label for="cmb_dikirim_ke_kebun" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px; font-size: 12px;">
                                            Kirim&nbsp;Kebun?
                                            <!-- <font face="Verdana" size="1.5">Kirim&nbsp;Kebun?</font> -->
                                        </label>
                                        <div class="col-9 col-xl-12">
                                            <select class="form-control form-control-sm" id="cmb_dikirim_ke_kebun" name="cmb_dikirim_ke_kebun" required>
                                                <option <?= $select->kirim == '1' ? "selected" : "" ?> value="Y">Y</option>
                                                <option <?= $select->kirim == '0' ? "selected" : "" ?> value="N">N</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php
                                    break;
                                case 'RO':
                                case 'SITE':
                                case 'PKS':
                                ?>
                                    <input type="hidden" name="cmb_dikirim_ke_kebun" id="cmb_dikirim_ke_kebun" value="Y">
                            <?php
                                    break;
                                default:
                                    break;
                            }
                            ?>

                            <div class="form-group row" style="margin-bottom: 1px;">
                                <label for="ttl_pembayaran" class="col-lg-3 col-xl-3 col-12 col-form-label" style="margin-top: -5px;font-size: 12px;">
                                    Total&nbsp;Bayar
                                </label>
                                <div class="col-9 col-xl-12">
                                    <input type="text" class="form-control form-control-sm" id="total_pembayaran" name="total_pembayaran" placeholder="Total Pembayaran" readonly required>

                                    <input type="hidden" class="form-control bg-light" id="ttl_pembayaran" name="ttl_pembayaran" placeholder="Total Pembayaran" readonly required>
                                    <!-- <p id="infoppn" style="display:none;">*Sudah termasuk PPN 10%</p> -->
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr class="mt-1 mb-1">
                    <input type="hidden" id="hidden_nopo">
                    <input type="hidden" id="status_lokasi" value="<?= $this->session->userdata('status_lokasi') ?>">
                    <input type="hidden" id="ttl_pembayaran" name="ttl_pembayaran">
                    <?php
                    switch ($sesi_sl) {
                        case 'HO':
                    ?>
                            <div class="x_content mb-0 div_form_2">



                                <table border="0" width="50%">


                                    <td>
                                        <h6 id="tgl_po_lbl" name="tgl_po_lbl"></h6>
                                    </td>

                                    <td>
                                        <h6 id="h4_no_ref_po" name="h4_no_ref_po"></h6>
                                    </td>

                                </table>
                                <input type="hidden" id="hidden_no_po" name="hidden_no_po" value="<?= $no_po ?>">
                                <input type="hidden" id="hidden_id_po" name="hidden_id_po">
                                <input type="hidden" id="refspp" name="refspp">
                                <input type="hidden" id="hidden_no_ref_po" name="hidden_no_ref_po">
                                <input type="hidden" value="<?= $sesi_sl; ?>" id="lokasi" name="lokasi">
                                <div class="table-responsive mt-0">
                                    <table id="tableRinciPO" class="table table-striped table-bordered table-in">
                                        <thead>
                                            <tr>
                                                <th>
                                                    #
                                                </th>

                                                <th>
                                                    SPP
                                                </th>

                                                <!-- <th>
                                                    Jenis Budget
                                                </th> -->

                                                <th>
                                                    Nama&nbsp;&<br>Kode&nbsp;Barang
                                                </th>
                                                <th>
                                                    Merk
                                                </th>
                                                <th>
                                                    Qty
                                                </th>

                                                <th>
                                                    Harga
                                                </th>
                                                <th>
                                                    Kurs
                                                </th>
                                                <th>
                                                    Disc <span>%</span>
                                                </th>
                                                <th>
                                                    <span id="biayalain">Biaya&nbsp;Lainnya</span>
                                                    <span id="ongkir" style="display: none;">Ongkir</span>
                                                </th>
                                                <th id="ketbiaya">
                                                    Ket.&nbsp;Biaya
                                                </th>

                                                <th>
                                                    Keterangan
                                                </th>
                                                <!-- <th>
                                                    Jumlah&nbsp;Rp
                                                </th> -->
                                                <th>
                                                    #
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_rincian" name="tbody_rincian">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php
                            break;
                        case 'RO':
                        case 'SITE':
                        case 'PKS':
                        ?>
                            <div class="x_content mb-0 div_form_3">
                                <table border="0" width="55%">
                                    <!-- <td width="7%">
                                        <font face="Verdana" size="1.5">
                                            <h6 id="tgl_spp" name="tgl_spp"></h6>
                                        </font>
                                    </td> -->
                                    <td width="15%">

                                        <h6 id="h4_no_ref_spp" name="h4_no_ref_spp"></h6>

                                    </td>
                                    <!-- <td width="7%">
                                        
                                            <h6 id="tgl_po" name="tgl_po">
                                            </h6>
                                        
                                    </td> -->
                                    <td width="15%">

                                        <h6 id="h4_no_ref_po" name="h4_no_ref_po"></h6>


                                    </td>

                                </table>
                                <!-- <div class="row" style="margin-left:4px;">
                                    <h6 id="h4_no_po" name="h4_no_po"></h6>&emsp;&emsp;
                                    <h6 id="h4_no_ref_po" name="h4_no_ref_po"></h6>
                                </div> -->
                                <input type="hidden" id="hidden_no_po" name="hidden_no_po" value="<?= $no_po ?>">
                                <input type="hidden" id="hidden_id_po" name="hidden_id_po">
                                <input type="hidden" id="refspp" name="refspp">
                                <input type="hidden" id="hidden_no_ref_po" name="hidden_no_ref_po">
                                <input type="hidden" value="<?= $sesi_sl; ?>" id="lokasi" name="lokasi">
                                <div class="table-responsive mt-0">
                                    <table id="tableItemPO" class="table table-striped table-bordered table-in">
                                        <thead>
                                            <tr>


                                                <!-- <th>
                                                    Jenis Budget
                                                </th> -->
                                                <th>
                                                    #
                                                </th>
                                                <th>
                                                    Nama&nbsp;&&nbsp;Kode&nbsp;Barang
                                                </th>
                                                <th>
                                                    Merk
                                                </th>
                                                <th>
                                                    Qty
                                                </th>
                                                <th>
                                                    Harga
                                                </th>
                                                <th>
                                                    Kurs
                                                </th>
                                                <th>
                                                    Disc<span>%</span>
                                                </th>
                                                <th>
                                                    Biaya&nbsp;Lainnya
                                                </th>
                                                <th>
                                                    Ket.&nbsp;Biaya
                                                </th>

                                                <th>
                                                    Keterangan
                                                </th>
                                                <th>
                                                    Jumlah&nbsp;Rp
                                                </th>
                                                <th>
                                                    #
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_item" name="tbody_item">
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                    <?php
                            break;
                        default:
                            break;
                    }
                    ?>

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
                        <input type="text" id="hidden_no_delete" name="hidden_no_delete">
                        <p class="mt-3">Apakah Anda yakin ingin menghapus data ini ???</p>
                        <button type="button" class="btn btn-warning my-2" data-dismiss="modal" id="btn_delete" onclick="deleteData()">Hapus</button>
                        <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalcarispp">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header ml-2">
                <h4 class="modal-title" id="modalcarispp">Pilih Item SPP</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <input type="hidden" id="no_row" name="no_row">
                    <input type="hidden" id="no_ref_spp_edit" name="no_ref_spp_edit">
                    <div class="table-responsive">
                        <table id="dataspp" class="table table-striped table-bordered" style="width: 100%; border-collapse: separate; padding: 0 50px 0 50px;">
                            <thead>
                                <tr>

                                    <th style="font-size: 12px; padding:10px">No.</th>
                                    <th style="font-size: 12px; padding:10px">ID</th>
                                    <th style="font-size: 12px; padding:10px">No.&nbsp;SPP</th>
                                    <th style="font-size: 12px; padding:10px">Tgl.&nbsp;SPP</th>
                                    <th style="font-size: 12px; padding:10px">No&nbsp;Ref.&nbsp;SPP</th>
                                    <th style="font-size: 12px; padding:10px">Departemen</th>
                                    <th style="font-size: 12px; padding:10px">Kode&nbsp;Barang</th>
                                    <th style="font-size: 12px; padding:10px">Item&nbsp;Barang</th>
                                    <th style="font-size: 12px; padding:10px">Keterangan</th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: center;" colspan="9"><button class="btn btn-sm btn-info" data-toggle="tooltip" id="btn_setuju_all" onclick="pilihItem2()" data-placement="left">Pilih Item</button></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modal-spp">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header ml-2">
                <h4 class="modal-title" id="modal-spp">Pilih Item SPP</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <div class="form-group">
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
                </div> -->

                <div class="col-12">
                    <div class="table-responsive">
                        <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                        <table id="spp" class="table table-striped table-bordered" style="width: 100%; border-collapse: separate; padding: 0 50px 0 50px;">
                            <thead>
                                <tr>
                                    <th style="font-size: 12px; padding:10px">No.</th>
                                    <th style="font-size: 12px; padding:10px">ID</th>
                                    <th style="font-size: 12px; padding:10px">No.&nbsp;SPP</th>
                                    <th style="font-size: 12px; padding:10px">Tgl.&nbsp;SPP</th>
                                    <th style="font-size: 12px; padding:10px">No&nbsp;Ref.&nbsp;SPP</th>
                                    <th style="font-size: 12px; padding:10px">Departemen</th>
                                    <th style="font-size: 12px; padding:10px">Kode&nbsp;Barang</th>
                                    <th style="font-size: 12px; padding:10px">Item&nbsp;Barang</th>
                                    <th style="font-size: 12px; padding:10px">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: center;" colspan="9"><button class="btn btn-sm btn-info" data-toggle="tooltip" id="btn_setuju_all" onclick="pilihItem()" data-placement="left">Pilih Item</button></th>
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

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalKonfirmasibatalPO">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-warning h1 text-warning"></i>
                    <h4 class="mt-2">Konfirmasi Batal</h4>
                    <!-- <input type="hidden" id="hidden_no_delete" name="hidden_no_delete"> -->
                    <p class="mt-3">Apakah Anda yakin ingin membatalkan PO ini ???</p>
                    <button type="button" class="btn btn-warning my-2" data-dismiss="modal" id="btn_delete" onclick="cekbatal()">Batalkan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" id="alasanbatal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-2 mb-1">
                    <i class="dripicons-warning h1 text-warning"></i>
                </div>

                <form class="parsley-examples" action="#" novalidate>
                    <div class="mb-1">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="pw" class="form-control" placeholder="Masukkan password">
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                        <ul class="parsley-errors-list filled" id="pw_validasi" style="display: none;">
                            <li class="parsley-required" id="text-pw">Password tidak boleh kosong!</li>
                        </ul>
                    </div>

                    <div class="mb-2">
                        <label for="alasan" class="form-label">Alasan</label>
                        <input type="hidden" name="stat_batal" id="stat_batal" value="0">
                        <textarea class="form-control" id="alasan" rows="2" placeholder="Alasan batal..." required></textarea>
                        <ul class="parsley-errors-list filled" id="alasan_validasi" style="display: none;">
                            <li class="parsley-required">Alasan tidak boleh kosong!</li>
                        </ul>
                    </div>
                    <div class="mb-0 text-center">
                        <button type="button" class="btn btn-warning my-2" id="btn_batal" onclick="validasibatal()">Batalkan</button>
                        <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" id="alasanedit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-2 mb-1">
                    <i class="dripicons-warning h1 text-warning"></i>
                </div>



                <form class="parsley-examples" action="#" novalidate>
                    <div class="mb-1">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="pass" class="form-control" placeholder="Masukkan password">
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                        <ul class="parsley-errors-list filled" id="pwvalidasi" style="display: none;">
                            <li class="parsley-required" id="textpw"></li>
                        </ul>
                    </div>

                    <div class="mb-2">
                        <input type="hidden" name="no_baris" id="no_baris">
                        <label for="alasan_edit" class="form-label">Alasan</label>
                        <textarea class="form-control" id="alasan_edit" rows="2" placeholder="Alasan edit..." required></textarea>
                        <ul class="parsley-errors-list filled" id="alasan_valid" style="display: none;">
                            <li class="parsley-required">Alasan tidak boleh kosong!</li>
                        </ul>
                    </div>
                    <div class="mb-0 text-center">
                        <button type="button" class="btn btn-warning my-2" id="bt_update" onclick="validasiedit()">Update</button>
                        <button type="button" class="btn btn-default btn_close" data-dismiss="modal">Cancel</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<input type="hidden" name="password" id="password" value="<?= $this->session->userdata('pw') ?>">

<input type="hidden" id="hidden_nopo_edit" value="<?= $nopo ?>">
<input type="hidden" id="hidden_noref_tambah">
<input type="hidden" id="isi_edit">
<input type="hidden" id="id_po">
<input type="hidden" id="pph" onkeyup="jumlah()" value="<?= $pph ?>">
<input type="hidden" id="ppn" onkeyup="jumlah()" value="<?= $ppn ?>">
<input type="hidden" id="status_lokasi" value="<?= $this->session->userdata('status_lokasi') ?>">

<style>
    table#spp td {
        padding: 10px;
        font-size: 12px;
    }

    table#dataspp td {
        padding: 10px;
        font-size: 12px;
    }

    table#tableItemPO th {
        padding: 10px;
        font-size: 12px;
        padding-left: 17px;
    }

    table#tableRinciPO th {
        padding: 10px;
        font-size: 12px;
        padding-left: 17px;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0;
        /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance: textfield;
        /* Firefox */
    }
</style>

<script>
    var cancleUpdatePO = true;
    var updateBaru = true;

    function selected(selectedNoppo) {
        var noppos = $('[id*=id_item_]');
        // console.log(noppos);

        var isSelected = false;
        var a = noppos.each(function() {
            var noppo = $(this).val();
            if (noppo == selectedNoppo) {
                console.log("isSelected sama", noppo, selectedNoppo)
                isSelected = true;
                return false;
            }
        });
        return isSelected;
    }


    function jenisPO() {
        var jenis_po = $('#cmb_pilih_jenis_po').val();

        // console.log(jenis_po);

        if (jenis_po == "PO") {
            $('#hidden_jenis_spp').val('SPP');
        } else if (jenis_po == "POA") {
            $('#hidden_jenis_spp').val('SPPA');
        } else if (jenis_po == "PO-Lokal") {
            $('#hidden_jenis_spp').val('SPPI');
        } else if (jenis_po == "PO-Khusus") {
            $('#hidden_jenis_spp').val('SPPK');
        }
    }

    function cekJenis(jenis) {
        // console.log('ini jenisnya', jenis);
        $('#hidden_jenis_spp').val(jenis);
        if (jenis == "SPP") {
            var po = "PO";
        } else if (jenis == "SPPI") {
            var po = "PO-Lokal";
        } else if (jenis == "SPPA") {
            var po = "POA - PO Asset";
        } else if (jenis == "SPPK") {
            var po = "POK - PO Khusus";
        }

        var options = document.getElementById("cmb_pilih_jenis_po").options;
        // console.log(options);
        for (var i = 0; i < options.length; i++) {
            if (options[i].text == po) {
                options[i].selected = true;
                break;
            }
        }
    }

    function gantiTabel() {
        // if (kodebar != '102505700000002') {
        //     data_spp_dipilih(id, no_spp, no_ref_spp, kodebar);
        // } else {
        // }
        $('#biayalain').hide();
        $('#txt_biaya_lain_0').hide();
        $('#txt_keterangan_biaya_lain_0').hide();
        $('#ketbiaya').hide();
        $('#txt_ketbiaya_0').hide();

        $('#ongkir').css('display', 'block');
        $('#txt_ongkir_0').css('display', 'block');
        if ($('#status_lokasi').val() != 'HO') {
            console.log("BUKAN HO");
        } else {
            $('#btn_tambah_row_0').attr('disabled', '');
            $('#getspp1').attr('disabled', '');
        }


        $("div.ppn select").val("10").change();
    }

    $(document).ready(function() {
        $('#alasanbatal').on('shown.bs.modal', function() {
            $('#pw').focus();
        })


        var no_nopo_edit = $('#hidden_nopo_edit').val();
        cari_po_edit(no_nopo_edit);
        isi_edit();
        cekspp();
        supply()

        // $('#cmb_filter_alokasi').change(function() {
        //     var data = this.value;
        //     sppHO(data);

        // })

        // var opsi_pt = '<option value="0475">TOKO ( KAS )</option>';
        // $('#select2').append(opsi_pt)
        $('#devisi').change(function() {

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Po/cek_devisi'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: {
                    kodedev: this.value
                },
                success: function(data) {
                    // console.log('Ini devisinya', data);
                    var pt = data.PT;
                    var kode = data.kodetxt;
                    $('#hidden_devisi').val(pt);
                    $('#hidden_kode_devisi').val(kode);

                },
                error: function(request) {
                    alert("KONEKSI TERPUTUS!");
                }
            });
        })
    });

    function selectedsdhbayar(nama) {
        // console.log(id);
        $("#cmb_status_bayar").empty().append('<option value="' + nama + '">' + nama + '</option>').val(nama).trigger('change');
    }

    function selecteddevisi(id, nama) {
        // console.log(id);
        $("#devisi").empty().append('<option value="' + id + '">' + nama + '</option>').val(id).trigger('change');
    }

    function selectedppn(id, nama) {

        if (id == 0) {
            var namappn = "N";
        } else {
            var namappn = "Y";

        }
        $("#ppn").empty().append('<option value="' + id + '">' + namappn + '</option>').val(id).trigger('change');
    }

    function selectedkirim(id, nama) {

        if (id == 0) {
            var namappn = "N";
        } else {
            var namappn = "Y";

        }
        $("#cmb_dikirim_ke_kebun").empty().append('<option value="' + id + '">' + namappn + '</option>').val(id).trigger('change');
    }

    function selectedsupply(id, nama) {
        // console.log(id);
        $("#select2").empty().append('<option value="' + id + '">' + nama + '</option>').val(id).trigger('change');
    }

    function selectedlokbeli(nama) {
        // console.log(id);
        $("#lks_pembelian").empty().append('<option value="' + nama + '">' + nama + '</option>').val(nama).trigger('change');
    }

    function supply() {
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
            var kode = $(".supply option:selected").text();
            var data = $(".supply option:selected").val();
            $('#kd_supplier').val(kode);
            $('#txtsupplier').val(data);
            // console.table({
            //     kode: kode,
            //     supplier: data,
            // })

        });
    }

    function sppHO(noref) {
        $('#spp').DataTable().destroy();
        $('#spp').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "select": true,

            "ajax": {
                "url": "<?php echo site_url('Po/get_ajax2') ?>",
                "type": "POST",
                "data": {
                    norefspp: noref
                }
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
            "lengthMenu": [
                [5, 10, 15, -1],
                [10, 15, 20, 25]
            ],
            "aoColumnDefs": [{
                "bSearchable": false,
                "bVisible": false,
                "aTargets": [1, 2]
            }, ],

            "columns": [{
                    "width": "3%"
                },
                {
                    "width": "2%"
                },
                {
                    "width": "2%"
                },
                {
                    "width": "10%"
                },
                {
                    "width": "30%"
                },
                {
                    "width": "18%"
                },
                {
                    "width": "8%"
                },
                {
                    "width": "5%"
                },
                {
                    "width": "20%"
                },
            ],
            "language": {
                "infoFiltered": ""
            }
        });
    }

    function sppSite(noref) {
        // dataspp site
        $('#dataspp').DataTable().destroy();
        $('#dataspp').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],
            "select": true,

            "ajax": {
                "url": "<?php echo site_url('Po/get_ajax2') ?>",
                "type": "POST",
                "data": {
                    norefspp: noref
                }
            },
            "columnDefs ": [{
                "targets": [0],
                "orderable": false,

            }, ],
            "dom": 'Bfrtip',
            "buttons": [{
                    "text": "Select All",
                    "action": function() {
                        $('#dataspp').DataTable().rows().select();
                    }
                },
                {
                    "text": "Unselect All",
                    "action": function() {
                        $('#dataspp').DataTable().rows().deselect();
                    }
                }
            ],
            "lengthMenu": [
                [5, 10, 15, -1],
                [10, 15, 20, 25]
            ],
            "aoColumnDefs": [{
                "bSearchable": false,
                "bVisible": false,
                "aTargets": [1, 2]
            }, ],

            "columns": [{
                    "width": "3%"
                },
                {
                    "width": "2%"
                },
                {
                    "width": "2%"
                },
                {
                    "width": "10%"
                },
                {
                    "width": "20%"
                },
                {
                    "width": "10%"
                },
                {
                    "width": "10%"
                },
                {
                    "width": "20%"
                },
                {
                    "width": "20%"
                },
            ],
            "language": {
                "infoFiltered": ""
            }
        });

        // end dataspp site
    }

    function cekPO() {
        var refspp = $('#refspp').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/cekDataPo'); ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#lbl_status_delete_po').empty();
                $('#lbl_status_delete_po').append('<label><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses batalkan PO..</label');
            },

            data: {
                refspp: refspp,
            },
            success: function(data) {

                for (var i = 0; i <= data; i++) {

                    batalkanPO(i);
                }


            },
            error: function(response) {
                alert('KONEKSI TERPUTUS! Gagal Menghapus PO');
            }
        });
    }

    function batalkanPO(no) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/hapus_rinci'); ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#lbl_status_simpan_' + no).empty();
                $('#lbl_status_simpan_' + no).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Hapus Item</label>');
            },

            data: {
                hidden_id_po_item: $('#hidden_id_po_item_' + no).val(),
                id_item: $('#id_item_' + no).val(),
                hidden_no_ref_spp: $('#hidden_no_ref_spp_' + no).val(),
                qty: $('#txt_qty_' + no).val(),
            },
            success: function(data) {
                $('#tr_' + no).remove();
                totalBayar();
                cekdatapo(no);
            },
            error: function(request) {
                $('#lbl_status_simpan_' + no).empty();
                // alert("KONEKSI TERPUTUS! GAGAL DELETE DATA PO");
            }
        });
    }



    function goBack() {
        window.history.back();
    }

    function new_po() {
        location.href = "<?php echo base_url('Po/input') ?>";
    }

    function data_po() {
        location.href = "<?php echo base_url('Po') ?>";
    }



    function cetak() {
        var id_po = $('#hidden_id_po').val();
        var nopo = $('#hidden_no_po').val();
        var noref = $('#hidden_nopo_edit').val();

        var noref_rpc = noref.replaceAll('/', '.');

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Po/cek_cetak') ?>",
            dataType: "JSON",
            beforeSend: function() {},
            data: {
                id_po: id_po
            },
            success: function(data) {
                var jumlah = data.jml_cetak;
                if (jumlah >= 3) {
                    $.toast({
                        position: 'top-right',
                        heading: 'Failed!',
                        text: 'Sudah melebihi 3 kali cetakan',
                        icon: 'error',
                        loader: false
                    });
                } else {
                    window.open('<?= base_url() ?>Po/cetak/' + noref_rpc + '/' + id_po, '_blank');
                }
            },
            error: function(response) {
                alert('KONEKSI TERPUTUS!');
            }
        });

    }


    function batal() {
        $('#modalKonfirmasibatalPO').modal('show');
    }


    function validasibatal() {
        var password = $('#pw').val();
        var pw_session = $('#password').val();
        var pw = $('#pw').val().length;
        var alasan = $('#alasan').val().length;
        if (pw == 0) {
            $('#pw').addClass('parsley-error');
            $('#pw_validasi').css('display', 'block');
            $('#text-pw').html('Password tidak boleh kosong!');
        } else if (alasan == 0) {
            $('#alasan').addClass('parsley-error');
            $('#alasan_validasi').css('display', 'block');
        } else {
            $('#pw').removeClass('parsley-error');
            $('#pw_validasi').css('display', 'none');

            $('#alasan').removeClass('parsley-error');
            $('#alasan_validasi').css('display', 'none');

            if (password == pw_session) {
                // cekbatal();
                var no = $('#stat_batal').val();
                if (no == 0) {
                    cekbatal();
                } else {
                    konfirbatal(no)
                }
            } else {
                $('#pw').addClass('parsley-error');
                $('#pw_validasi').css('display', 'block');
                $('#text-pw').html('Password Salah!');
            }
        }
    }

    function cekbatal() {
        // var refspp = $('#refspp').val();
        var refpo = $('#hidden_no_ref_po').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/cekDataPo'); ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#btn_batal').append('&nbsp;<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>');
            },

            data: {
                // refspp: refspp
                refpo: refpo,
            },
            success: function(data) {

                console.log(data + 'ni data length');
                for (var i = 0; i < data; i++) {

                    konfirbatal(i);
                }
            },
            error: function(response) {
                alert('KONEKSI TERPUTUS! Gagal Menghapus PO');
            }
        });
    }

    function konfirbatal(no) {
        // console.log('ini nomernya', no);
        var noref_po = $('#hidden_no_ref_po').val();
        var hidden_id_po_item = $('#hidden_id_po_item_' + no).val();
        var iditemspp = $('#id_item_' + no).val();
        var ref_spp = $('#hidden_no_ref_spp_' + no).val();
        var qty = $('#txt_qty_' + no).val();
        var alasan = $('#alasan').val();

        // console.table({
        //     'ref_po': noref_po,
        //     'id_item_po': hidden_id_po_item,
        //     'id_item_spp': iditemspp,
        //     'ref_spp': ref_spp,
        //     'qty': qty,
        //     'alasan': alasan
        // });

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/konfirbatal'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                hidden_id_po_item: hidden_id_po_item,
                id_item: iditemspp,
                hidden_no_ref_spp: ref_spp,
                qty: qty,
                noref_po: noref_po,
                alasan: alasan
            },
            success: function(data) {
                $('.spinner-border').css('display', 'none');
                $('#alasanbatal').modal('hide');
                $.toast({
                    position: 'top-right',
                    heading: 'Dibatalkan',
                    text: 'Berhasil Dibatalkan!',
                    icon: 'success',
                    loader: false
                });
                setTimeout(function() {
                    window.location.href = "<?php echo site_url('Po'); ?>";
                }, 1000);

            },
            error: function(response) {
                alert('KONEKSI TERPUTUS! Gagal batal PO');
            }
        });
    }

    function batal_aksi() {
        var noref_po = $('#hidden_no_ref_po').val();
        var refspp = $('#refspp').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Po/batalPO') ?>",
            dataType: "JSON",

            beforeSend: function() {
                $('#lbl_status_delete_po').empty();
                $('#lbl_status_delete_po').append('<label><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses batalkan PO..</label');
            },

            data: {
                noref_po: noref_po,
                refspp: refspp,
            },

            success: function(data) {
                console.log(data);

                window.location = "<?= base_url('Po') ?>";
            },
            error: function(request) {
                $('#lbl_status_delete_po').empty();
                alert("KONEKSI TERPUTUS! BATAL PO");
            }
        });
    }



    function isSelected(selectedNoppo) {
        var noppos = $('[id*=id_item_]');
        // console.log(noppos);
        var isSelected = false;
        var a = noppos.each(function() {
            var noppo = $(this).val();
            console.log(noppo)
            if (noppo == selectedNoppo) {
                console.log("isSelected sama", noppo, selectedNoppo)
                isSelected = true;
                return false;
            }
        });
        return isSelected;
    }

    function pilihItem() {
        var rowcollection = $('#spp').DataTable().rows({
            selected: true,

        }).data().toArray();
        // console.log(rowcollection);
        $.each(rowcollection, function(index, elem) {
            var id = rowcollection[index][1];
            var no_spp = rowcollection[index][2];
            var no_ref_spp = rowcollection[index][4];
            var kodebar = rowcollection[index][6];
            // isSelected(id);
            if (isSelected(id)) {
                alert('data sudah di pilih');
                return false;
            }
            // console.log(id, no_spp, no_ref_spp, kodebar);
            data_spp_dipilih(id, no_spp, no_ref_spp, kodebar);
        });

    }


    // $('#tableDetailSPP tbody').on('click', 'tr', function () {
    function data_spp_dipilih(id, no_spp, no_ref_spp, kodebar) {
        // var dataClick = $('#spp').DataTable().row(this).data();
        // var no_spp = dataClick[1];
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/get_detail_spp'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                'id': id,
                'no_spp': no_spp,
                'no_ref_spp': no_ref_spp,
                'kodebar': kodebar
            },
            success: function(data) {
                // console.log(data);
                var n = $('#tbody_rincian tr').length;
                console.log("ini dia", n)
                $('#devisi').val(data[0].devisi);
                $('#hidden_devisi').val(data[0].devisi);
                // var n = 0;
                $.each(data[1], function(index) {
                    // if(index != 0){
                    // if (n != 1) {
                    // }
                    tambah_row_baru(n);
                    console.log(data);


                    $('#id_ppo' + n).val(data[0].id);
                    $('#id_item_' + n).val(data[1][0].id);
                    $('#getspp' + n).val(data[1][0].noreftxt);
                    $('#hidden_kode_brg_' + n).val(data[1][0].kodebartxt);
                    $('#kode_brg_' + n).text(data[1][0].kodebartxt);
                    $('#hidden_nama_brg_' + n).val(data[1][0].nabar);
                    $('#nama_brg_' + n).text(data[1][0].nabar);
                    $('#txt_keterangan_rinci_' + n).val(data[1][0].ket);
                    $('#hidden_satuan_brg_' + n).val(data[1][0].sat);
                    var qty = data[1][0].qty;
                    var qty2 = data[1][0].qty2;

                    // $('#txt_qty_' + n).val(data[1][0].qty);


                    if (qty2 != null) {
                        var hasil = qty - qty2;
                        $('#txt_qty_' + n).val(hasil);
                    } else {
                        $('#txt_qty_' + n).val(qty);
                        // $('.div_form_2').find('#nakobar_' + n + ', #txt_qty_' + n + ', #txt_keterangan_rinci_' + n).attr('disabled', '');
                    }

                    if (qty2 != null) {
                        var hasil = qty - qty2;
                        $('#txt_qty_' + n).val(hasil);
                        console.log(hasil);
                        if (hasil == 0) {

                            $('.div_form_2').find('#cmb_jenis_budget_' + n + ',#txt_merk_' + n + ', #txt_qty_' + n + ' ,#cmb_kurs_' + n + ',#txt_disc_' + n + ', #txt_harga_' + n + ',#txt_biaya_lain_' + n + ',txt_keterangan_biaya_lain_' + n + ',#txt_keterangan_biaya_lain_' + n + ',#txt_keterangan_rinci_' + n).attr('disabled', '');
                            $('#btn_simpan_' + n).hide();
                            $('#habis_' + n).show();
                        }
                    } else {
                        $('#txt_qty_' + n).val(qty);
                    }
                    $('#qty_' + n).val(data[1][0].qty);
                    $('#qty2_' + n).val(data[1][0].qty2);

                    $('#hidden_no_ref_spp_' + n).val(data[1][0].noreftxt);
                    $('#hidden_tgl_ref_' + n).val(data[0].tglref);
                    $('#hidden_kd_departemen_' + n).val(data[1][0].kodedept);
                    $('#hidden_departemen_' + n).val(data[1][0].namadept);
                    $('#hidden_tgl_spp_' + n).val(data[1][0].tglppo);
                    // $('#hidden_tgl_spp_' + n).val(dateToMDY(tglppo));
                    $('#hidden_kd_pt_' + n).val(data[1][0].kodept);
                    $('#hidden_nama_pt_' + n).val(data[1][0].namapt);

                    $('#noppo' + n).val(data[1][0].noppotxt);

                    // $('html, body').animate({
                    //     scrollTop: $("#tr_" + n).offset()
                    // }, 2000);

                    // $('#txt_qty_' + n).val(data[1][0].qty);
                    n++;
                    // $('#hidden_no_table').val(n);
                });
                $('#modal-spp').modal('hide');
                $('#txt_qty_' + n).focus();

            },
            error: function(request) {
                alert("KONEKSI TERPUTUS!");
            }
        });
    }

    function pilihItem2() {
        var rowcollection = $('#dataspp').DataTable().rows({
            selected: true,

        }).data().toArray();
        // console.log(rowcollection);
        $.each(rowcollection, function(index, elem) {
            var id = rowcollection[index][1];
            var no_spp = rowcollection[index][2];
            var no_ref_spp = rowcollection[index][4];
            var kodebar = rowcollection[index][6];
            // isSelected(id);
            if (isSelected(id)) {
                alert('data sudah di pilih');
                return false;
            }
            // console.log(id, no_spp, no_ref_spp, kodebar);
            data_spp_dipilih2(id, no_spp, no_ref_spp, kodebar);
        });

    }


    // $('#tableDetailSPP tbody').on('click', 'tr', function () {
    function data_spp_dipilih2(id, no_spp, no_ref_spp, kodebar) {
        // var dataClick = $('#spp').DataTable().row(this).data();
        // var no_spp = dataClick[1];
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/get_detail_spp'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                'id': id,
                'no_spp': no_spp,
                'no_ref_spp': no_ref_spp,
                'kodebar': kodebar
            },
            success: function(data) {
                // console.log(data);
                var n = $('#tbody_item tr').length;
                // console.log("ini dia", n);
                $('#devisi').val(data[0].devisi);
                $('#hidden_devisi').val(data[0].devisi);
                // var n = 0;
                $.each(data[1], function(index) {
                    // if(index != 0){
                    // if (n != 1) {
                    // }
                    var status = data[1][0].status2;
                    tambah_item_baru(n, status);
                    // console.log(status);


                    $('#id_ppo' + n).val(data[0].id);
                    $('#id_item_' + n).val(data[1][0].id);
                    $('#getspp' + n).val(data[1][0].noreftxt);
                    $('#hidden_kode_brg_' + n).val(data[1][0].kodebartxt);
                    $('#kode_brg_' + n).text(data[1][0].kodebartxt);
                    $('#txt_keterangan_rinci_' + n).val(data[1][0].ket);
                    $('#hidden_nama_brg_' + n).val(data[1][0].nabar);
                    $('#nama_brg_' + n).text(data[1][0].nabar);
                    $('#hidden_satuan_brg_' + n).val(data[1][0].sat);
                    var qty = data[1][0].qty;
                    var qty2 = data[1][0].qty2;

                    // $('#txt_qty_' + n).val(data[1][0].qty);


                    if (qty2 != null) {
                        var hasil = qty - qty2;
                        $('#txt_qty_' + n).val(hasil);
                    } else {
                        $('#txt_qty_' + n).val(qty);
                        // $('.div_form_2').find('#nakobar_' + n + ', #txt_qty_' + n + ', #txt_keterangan_rinci_' + n).attr('disabled', '');
                    }

                    if (qty2 != null) {
                        var hasil = qty - qty2;
                        $('#txt_qty_' + n).val(hasil);
                        // console.log(hasil);
                        if (hasil == 0) {

                            $('.div_form_2').find('#cmb_jenis_budget_' + n + ',#txt_merk_' + n + ', #txt_qty_' + n + ' ,#cmb_kurs_' + n + ',#txt_disc_' + n + ', #txt_harga_' + n + ',#txt_biaya_lain_' + n + ',txt_keterangan_biaya_lain_' + n + ',#txt_keterangan_biaya_lain_' + n + ',#txt_keterangan_rinci_' + n).attr('disabled', '');
                            $('#btn_simpan_' + n).hide();
                            $('#habis_' + n).show();
                        }
                    } else {
                        $('#txt_qty_' + n).val(qty);
                    }
                    $('#qty_' + n).val(data[1][0].qty);
                    $('#qty2_' + n).val(data[1][0].qty2);

                    $('#hidden_no_ref_spp_' + n).val(data[1][0].noreftxt);
                    $('#hidden_tgl_ref_' + n).val(data[0].tglref);
                    $('#hidden_kd_departemen_' + n).val(data[1][0].kodedept);
                    $('#hidden_departemen_' + n).val(data[1][0].namadept);
                    $('#hidden_tgl_spp_' + n).val(data[1][0].tglppo);
                    // $('#hidden_tgl_spp_' + n).val(dateToMDY(tglppo));
                    $('#hidden_kd_pt_' + n).val(data[1][0].kodept);
                    $('#hidden_nama_pt_' + n).val(data[1][0].namapt);

                    $('#noppo' + n).val(data[1][0].noppotxt);

                    // $('html, body').animate({
                    //     scrollTop: $("#tr_" + n).offset()
                    // }, 2000);

                    // $('#txt_qty_' + n).val(data[1][0].qty);
                    n++;
                    // $('#hidden_no_table').val(n);
                });
                $('#modalcarispp').modal('hide');
                $('#txt_qty_' + n).focus();

            },
            error: function(request) {
                alert("KONEKSI TERPUTUS!");
            }
        });
    }

    function isi_edit() {
        var noref = $('#hidden_nopo_edit').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/cek_isi'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                noref: noref
            },
            success: function(data) {
                // console.log(data);

                var status = data.status;
                // console.log(status);
                if (status = true) {

                    $('#tambahSpp').removeAttr('disabled');
                } else {
                    console.log('sudah lpb')
                }

            },
            error: function(request) {
                alert("KONEKSI TERPUTUS!");
            }
        });

    }

    function hapus_row(id) {
        // var totalRowCount = $("#tableRinciBarang tr").length;
        var rowCount = $("#tableRinciPO td").closest("tr").length;

        if (rowCount != 1) {
            $('#tr_' + id).remove();
        } else {
            swal('Tidak Bisa dihapus, item SPP tinggal 1');
        }
        // if(id != 2){
        // n = parseInt(n)- parseInt(1);
        // $('#tr_'+n).remove();
        // }
    }





    $(document).on('click', '#data_spp', function() {
        var id = $(this).data('id');
        var noreftxt = $(this).data('noreftxt');
        var refspp = $('#refspp').val(noreftxt);
        // console.log(noreftxt);
        $.ajax({
            type: 'post',
            url: '<?= site_url('Po/getid'); ?>',
            data: {
                id: id,
                noreftxt: noreftxt,
            },
            success: function(response) {
                $('.div_form_4').show();
                // $('.div_form_1').find('#sppSITE').attr('disabled', '');
                // console.log(response);
                data = JSON.parse(response);
                $('#hidden_noref_tambah').val(data[0].noreftxt);


                var n = $('#tbody_item tr').length;

                $.each(data, function(index, value) {


                    // console.log('nomer row nya', n);

                    if (value.statusaprove == '0') {
                        $('#tr_' + n).find('input,textarea,select').attr('disabled', '');
                        $('#tr_' + n).find('input,textarea,select').addClass('form-control bg-light');
                    }

                    var idppo = value.id;
                    var opsi = value.noreftxt;
                    // console.log(opsi);
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
                    // var tglref = value.tglref;
                    var qty = value.qty;
                    var qty2 = value.qty2;

                    var id = value.id;
                    if (isSelected(id)) {
                        alert('data sudah di pilih');
                        return false;
                    } else {
                        tambah_item_baru(n, value.statusaprove);
                        $('#id_ppo' + n).val(idppo);
                        $('#id_item_' + n).val(idppo);
                        $('#hidden_no_ref_spp_' + n).val(opsi);
                        // $('#refspp').val(opsi);
                        // $('#hidden_tgl_hidden' + n).val(tglref);
                        $('#hidden_kd_departemen_' + n).val(kodedept);
                        $('#hidden_departemen_' + n).val(namadept);
                        $('#hidden_tgl_spp_' + n).val(tglppo);
                        $('#hidden_kd_pt_' + n).val(kodept);
                        $('#hidden_nama_pt_' + n).val(pt);
                        $('#noppo' + n).val(noppo);
                        $('#hidden_kode_brg_' + n).val(kodebar);
                        $('#kode_brg_' + n).text(kodebar);
                        $('#hidden_nama_brg_' + n).val(nabar);
                        $('#nama_brg_' + n).text(nabar);
                        $('#hidden_satuan_brg_' + n).val(sat);
                        $('#txt_qty_' + n).val(qty);
                        $('#getspp' + n).val(opsi);

                        $('#qty_' + n).val(qty);
                        $('#qty2_' + n).val(qty2);
                        $('#hidden_tgl_ref_' + n).val(tglref);

                        n++;
                    }



                });
                $('#modalcarispp').modal('hide');
            },
            error: function(request) {
                alert("KONEKSI TERPUTUS!");
            }
        });
    });



    function tambah_item_baru(no, statusaprove) {
        // no++;
        // console.log("status", statusaprove);
        console.log("bariske", no);
        // console.log('ini jumlah row', rowCount);

        var tr_buka = '<tr id="tr_' + no + '">';

        var form_buka = '<form id="form_rinci_' + no + '" name="form_rinci_' + no + '" method="POST" action="javascript:;">';
        var td_col_1 = '<td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="hidden" id="hidden_no_table_' + no + '" name="hidden_no_table_' + no + '">' +
            '<button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" id="btn_tambah_row_' + no + '" name="btn_tambah_row_' + no + '" onclick="tambahSpp(' + no + ')"></button>' +
            '<button class="btn btn-xs btn-danger fa fa-minus" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row_' + no + '" name="btn_hapus_row_' + no + '" onclick="hapus_row(' + no + ')"></button>' +
            '</td>';

        var td_col_3 = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<select class="form-control form-control-sm" id="cmb_jenis_budget_' + no + '" name="cmb_jenis_budget_' + no + '" required>' +
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
        var td_col_ = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="hidden" class="form-control form-control-sm"  id="getspp' + no + '" rowame="spp' + no + '" >' +
            '<font face="Verdana" size="1.5"><span id="nama_brg_' + no + '"></font><font face="Verdana" size="1.5"></span><br><span id="kode_brg_' + no + '" ></span></font>' +
            '<input type="hidden" id="ppo' + no + '" name="ppo' + no + '">' +
            '<input type="hidden" id="id_ppo' + no + '" name="id_ppo' + no + '">' +
            '<input type="hidden" id="id_item_' + no + '" name="id_item_' + no + '">' +
            '<input type="hidden" id="hidden_no_ref_spp_' + no + '" name="hidden_no_ref_spp_' + no + '">' +
            '<input type="hidden" id="hidden_tgl_ref_' + no + '" name="hidden_tgl_ref_' + no + '">' +
            '<input type="hidden" id="hidden_kd_departemen_' + no + '" name="hidden_kd_departemen_' + no + '">' +
            '<input type="hidden" id="hidden_departemen_' + no + '" name="hidden_departemen_' + no + '">' +
            '<input type="hidden" id="hidden_tgl_spp_' + no + '" name="hidden_tgl_spp_' + no + '">' +
            '<input type="hidden" id="hidden_kd_pt_' + no + '" name="hidden_kd_pt_' + no + '">' +
            '<input type="hidden" id="hidden_nama_pt_' + no + '" name="hidden_nama_pt_' + no + '">' +
            '<input type="hidden" id="noppo' + no + '" name="noppo' + no + '">' +
            '<input type="hidden" class="form-control form-control-sm" id="hidden_kode_brg_' + no + '" name="hidden_kode_brg_' + no + '"   />' +
            '<input type="hidden" class="form-control form-control-sm" id="hidden_nama_brg_' + no + '" name="hidden_nama_brg_' + no + '"   />' +
            '<input type="hidden" class="form-control form-control-sm" id="hidden_satuan_brg_' + no + '" name="hidden_satuan_brg_' + no + '"   />' +
            '<input type="hidden" id="hidden_no_ref_po_' + no + '" name="hidden_no_ref_po_' + no + '">' +
            '<input type="hidden" class="form-control form-control-sm" id="id_item_po' + no + '" name="id_item_po' + no + '" >' +

            '</td>';
        var td_col_4 = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            // '<input type="text" class="form-control form-control-sm" id="txt_merk_' + row + '" name="txt_merk_' + row + '" placeholder="Merk"  required />' +
            '<textarea class="form-control form-control-sm" id="txt_merk_' + no + '" name="txt_merk_' + no + '" size="26" placeholder="Merk" rows="3"></textarea><br />' +
            '</td>';
        var td_col_5 = '<td width="7%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_qty_' + no + '" name="txt_qty' + no + '" placeholder="Qty" autocomplite="off" size="8" onkeyup="jumlah(' + no + ')" >' +
            '<input type="hidden" class="form-control form-control-sm" id="qty_' + no + '" name="qty' + no + '" placeholder="Qty" size="8" >' +
            '<input type="hidden" class="form-control form-control-sm" id="qty2_' + no + '" name="qty2' + no + '" placeholder="Qty" size="8"/>' +
            '<span class="small text-muted" style="font-size: 11px;">Qty&nbsp;PO&nbsp;:&nbsp;</span><span id="qty_po_' + no + '" class="small" style="font-size: 11px;"></span><br>' +
            '<span class="small text-muted" style="font-size: 11px;">SIsa&nbsp;Qty&nbsp;:&nbsp;</span><span id="sisa_qty_' + no + '" class="small" style="font-size: 11px;"></span>' +

            '</td>';
        var td_col_6 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_harga_' + no + '" name="txt_harga_' + no + '" onkeyup="jumlah(' + no + ')" placeholder="Harga dalam Rupiah" size="15" autocomplite="off" /><br />' +

            '</td>';
        var td_col_7 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<select class="form-control form-control-sm" id="cmb_kurs_' + no + '" name="cmb_kurs_' + no + '" required="">' +
            '<option value="Rp">Rp IDR</option>' +
            '<option value="USD">&dollar; USD</option>' +
            '<option value="SGD">S&dollar; SGD</option>' +
            '<option value="Euro">&euro; Euro</option>' +
            '<option value="GBP">&pound; GBP</option>' +
            '<option value="Yen">&yen; Yen</option>' +
            '<option value="MYR">RM MYR</option>' +
            '</select><br />' +
            '</td>';
        var td_col_8 = '<td width="5%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_disc_' + no + '" name="txt_disc_' + no + '" size="8" value="0" onkeyup="jumlah(' + no + ')" placeholder="Disc"/>' +

            '</td>';
        var td_col_9 = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_biaya_lain_' + no + '" name="txt_biaya_lain_' + no + '" size="15" value="0" onkeyup="jumlah(' + no + ')" placeholder="Biaya Lain"/>' +

            '</td>';
        var td_col_10 = '<td width="12%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea maxlength="250" class="form-control form-control-sm" id="txt_keterangan_biaya_lain_' + no + '" name="txt_keterangan_biaya_lain_' + no + '" size="26" placeholder="Keterangan Biaya" rows="3"></textarea><br />' +


            '</td>'
        var td_col_11 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea maxlength="250" class="form-control form-control-sm" id="txt_keterangan_rinci_' + no + '" name="txt_keterangan_rinci_' + no + '" size="20" placeholder="Keterangan" rows="3"></textarea>' +
            // '<h6>Jumlah : <span id="hasil_jumlah_' + no + '"></span></h6>' +
            // '<input type="hidden" class="form-control form-control-sm" id="txt_jumlah_' + no + '" size="20" name="txt_jumlah_' + no + '"  placeholder="Jumlah"  readonly />' +

            // '<input type="hidden" id="hidden_id_po_item_' + no + '" name="hidden_id_po_item_' + no + '">' +
            '</td>';
        var td_col_12 = '<td width="25%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            // '<h6>Jumlah : <span id="hasil_jumlah_' + row + '"></span></h6>' +
            '<input type="text" class="form-control form-control-sm" id="jumlah_' + no + '" name="jumlah_" size="15" placeholder="Jumlah"  readonly />' +
            '<input type="hidden" class="form-control form-control-sm" id="txt_jumlah_' + no + '" name="txt_jumlah_" size="15" placeholder="Jumlah"  readonly />' +

            '<input type="hidden" id="hidden_id_po_item_' + no + '" name="hidden_id_po_item_' + no + '">' +
            '</td>';

        if (statusaprove == '0') {
            var td_col_13 = '<td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                '<span  id="habis_' + no + '" class="badge badge-danger">Belum diapprove</span>' +
                '</td>';

        } else {
            var td_col_13 = '<td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
                '<span style="display:none;" id="habis_' + no + '" class="badge badge-danger">Belum approve</span>' +
                '<button class="btn btn-xs btn-success fa fa-save" id="btn_simpan_' + no + '" name="btn_simpan_' + no + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="validasi(' + no + ')" ></button>' +
                '<button style="display:none;" class="btn btn-xs btn-warning fa fa-edit mb-1" onclick="ubah(' + no + ')" id="btn_ubah_' + no + '" name="btn_ubah_' + no + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" ></button>' +
                '<button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_' + no + '" name="btn_update_' + no + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="validasiUpdate(' + no + ')"></button>' +
                '<button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick mt-1" id="btn_cancel_update_' + no + '" name="btn_cancel_update_' + no + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update"  onclick="cancleUpdate(' + no + ')"></button>' +
                '<button style="display:none;" class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_' + no + '" name="btn_hapus_' + no + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + no + ')"></button>' +
                '<label id="lbl_status_simpan_' + no + '"></label>' +
                '</td>';
        }
        var form_tutup = '</form>';
        var tr_tutup = '</tr>';
        var lokasi = $('#lokasi').val();



        $('#tbody_item').append(tr_buka + form_buka + td_col_1 + td_col_ + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_9 + td_col_10 + td_col_11 + td_col_12 + td_col_13 + form_tutup + tr_tutup);

        // $('#txt_qty_' + no + ',#txt_harga_' + no + ',#txt_disc_' + no + ',#txt_biaya_lain_' + no + '').number(true, 0);
        $('#txt_qty_' + no + ',#qty_' + no + ',#qty2_' + no + ',#txt_harga_' + no + ',#txt_biaya_lain_' + no + ',#txt_disc_' + no + '').on("keypress keyup blur", function(event) {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        // if (no == 1) {
        //     $('#btn_hapus_row_' + no).hide();
        // } else {
        //     $('#btn_hapus_row_' + no).show();
        // }
        hitungqty(no);
        // jumlah(row);
    }

    function tambahSpp(row) {
        var dt = $('#no_row').val(row);
        var norefspp = $('#hidden_no_ref_spp_' + row).val();
        // console.log('ini no refspp', norefspp);
        $('#no_ref_spp_edit').val(norefspp);
        sppSite(norefspp);
        $('#modalcarispp').modal('show');
    }

    function tambahSppHO(row) {
        var dt = $('#hidden_no_row').val(row);
        // console.log('ini no rownya', dt);
        var norefspp = $('#hidden_no_ref_spp_' + row).val();
        $('#modal-spp').modal('show');
        sppHO(norefspp);
    }

    function cekspp() {
        var ref = location.pathname.split('/')[4];
        var noref = ref.replaceAll('.', '/');
        // console.log(noref);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/cek_lpb'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                noref: noref
            },
            success: function(data) {
                // console.log(data);

                var status = data.status;
                // console.log(status);
                if (status = true) {

                    $('#tambahSpp').removeAttr('disabled');
                } else {
                    console.log('sudah lpb')
                }

            },
            error: function(request) {
                alert("KONEKSI TERPUTUS!");
            }
        });
    }


    function validasiUpdate(id) {
        var lokasi = $('#status_lokasi').val();
        var biayalain = $('#txt_biaya_lain_' + id).val();
        var merk = $('#txt_merk_' + id).val();
        var qty = $('#txt_qty_' + id).val();
        var hrg = $('#txt_harga_' + id).val();
        var ketBiaya = $('#txt_keterangan_biaya_lain_' + id).val();
        var ketRinci = $('#txt_keterangan_rinci_' + id).val();
        var jml = $('#txt_jumlah_' + id).val();


        if (!merk) {
            toast('Merk is required!');
            $('#txt_merk_' + id).css({
                "background": "#FFCECE"
            });
        } else if (!hrg) {
            toast('Harga is required!');
            $('#txt_harga_' + id).css({
                "background": "#FFCECE"
            });
        } else if (!qty) {
            toast('QTY is required!');
            $('#txt_qty_' + id).css({
                "background": "#FFCECE"
            });
        } else if (!ketRinci) {
            toast('Keterangan Rinci is required!');
            $('#txt_keterangan_rinci_' + id).css({
                "background": "#FFCECE"
            });
        }
        if (jml > 1500000 && lokasi != "HO") {
            toast('Tidak boleh PO lebih dari Rp. 1.500.000!');
            $('#txt_jumlah_' + id).css({
                "background": "#FFCECE"
            });
        } else if (biayalain > 0 && !ketBiaya) {


            toast('Keterangan Biaya is required!');
            $('#txt_keterangan_biaya_lain_' + id).css({
                "background": "#FFCECE"
            });

        } else {
            update(id);
        }

        return false;

    }

    function toast(v_text) {
        $.toast({
            position: 'top-right',
            heading: 'Failed!',
            text: v_text + ' ',
            icon: 'error',
            loader: false
        });
    }

    function update(id) {

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Po/updateItem') ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#lbl_status_simpan_' + id).empty();
                $('#lbl_status_simpan_' + id).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i></label>');
            },
            data: {

                idpo: $('#hidden_id_po').val(),
                hidden_departemen: $('#hidden_departemen_' + id).val(),
                hidden_devisi: $('#hidden_devisi').val(),
                hidden_kode_devisi: $('#hidden_kode_devisi').val(),
                tgl_po: $('#tgl_po').val(),
                txt_kode_supplier: $('#kd_supplier').val(),
                txt_supplier: $('#txtsupplier').val(),
                cmb_status_bayar: $('#cmb_status_bayar').val(),
                tmpo_pembayaran: $('#tmpo_pembayaran').val(),
                txt_lokasi_pengiriman: $('#lks_pengiriman').val(),
                cmb_lokasi_pembelian: $('#lks_pembelian').val(),
                txt_no_penawaran: $('#no_penawaran').val(),
                txt_pemesan: $('#nama_pemesan').val(),
                txt_kode_pemesan: $('#txt_pemesan').val(),
                devisi: $('#devisi').val(),
                cmb_pph: $('#pph').val(),
                cmb_ppn: $('#ppn').val(),
                cmb_dikirim_ke_kebun: $('#cmb_dikirim_ke_kebun').val(),
                txt_tempo_pembayaran: $('#tmpo_pembayaran').val(),
                cmb_lokasi_pembelian: $('#lks_pembelian').val(),
                txt_keterangan: $('#keterangan').val(),
                txt_total_pembayaran: $('#ttl_pembayaran').val(),
                txt_ket_pengiriman: $('#ket_pengiriman').val(),
                txt_uang_muka: $('#txt_uang_muka').val(),
                txt_tempo_pengiriman: $('#tmpo_pengiriman').val(),



                id_item_spp: $('#id_item_' + id).val(),
                hidden_kode_brg: $('#hidden_kode_brg_' + id).val(),
                hidden_no_ref_po: $('#hidden_no_ref_po').val(),
                hidden_no_ref_spp: $('#hidden_no_ref_spp_' + id).val(),
                txt_qty: $('#txt_qty_' + id).val(),
                txt_harga: $('#txt_harga_' + id).val(),
                txt_merk: $('#txt_merk_' + id).val(),
                txt_keterangan_rinci: $('#txt_keterangan_rinci_' + id).val(),
                txt_disc: $('#txt_disc_' + id).val(),
                cmb_kurs: $('#cmb_kurs_' + id).val(),
                txt_biaya_lain: $('#txt_biaya_lain_' + id).val(),
                txt_keterangan_biaya_lain: $('#txt_keterangan_biaya_lain_' + id).val(),
                id_item: $('#hidden_id_po_item_' + id).val(),
                txt_jumlah: $('#txt_jumlah_' + id).val(),
            },
            success: function(data) {
                var refspp = $('#hidden_no_ref_spp_' + id).val();
                var kodebar = $('#hidden_kode_brg_' + id).val();
                sum_qty(refspp, kodebar);
                if (data == 'site') {
                    swal('User SITE tidak boleh PO lebih dari Rp. 1.500.000!');
                    $('#lbl_status_simpan_' + id).empty();
                } else {
                    $('#lbl_status_simpan_' + id).empty();
                    $.toast({
                        position: 'top-right',
                        heading: 'Success',
                        text: 'Berhasil diupdate',
                        icon: 'success',
                        loader: false
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
                    totalBayar();
                }
            },
            error: function(request) {
                $('#lbl_status_simpan_' + id).empty();
                $('#btn_simpan_' + id).hide();
                $('#btn_hapus_row' + id).hide();
                $('#btn_update_' + id).hide();
                $('#btn_cancel_update_' + id).hide();

                $('#btn_ubah_' + id).show();
                $('#btn_hapus_' + id).show();
                alert("KONEKSI TERPUTUS!");
            }
        });
    }

    function sum_qty(refspp, kodebar) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/sum_ppo'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                refspp: refspp,
                kodebar: kodebar,
            },
            success: function(data) {
                console.log(data);
            }
        });
    }

    function sisaQtyPO(no_ref_spp, id_item_spp, n) {
        console.log('sisa qty no ' + n);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/sum_sisa_qty_spp'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                'no_ref_spp': no_ref_spp,
                'id_item_spp': id_item_spp,
            },
            success: function(data) {
                console.log('apa ini', data);
                var qty = data.qty;
                var qty2 = data.qty2;
                // $('#sisa_qty_' + n).text(data);

                if (qty2 != null) {
                    var hasil = qty - qty2;
                    $('#qty_po_' + n).text(qty2);
                    $('#sisa_qty_' + n).text(hasil);
                } else {
                    $('#qty_po_' + n).text("0");
                    $('#sisa_qty_' + n).text(qty);
                }
            },
            error: function(response) {
                alert('KONEKSI TERPUTUS! Silahkan Refresh Halaman!');
            }
        });
    }

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    }

    function cari_po_edit(nopo) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/cari_po_edit'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                'nopo': nopo,
                'refspp': $('#refspp').val(),
            },
            success: function(data) {
                // console.log("Hello", data.po.jenis_spp);



                var po = data.po;
                // var item_ppo = data.item_ppo;
                // console.log('qty nya', item_ppo);
                var item_po = data.item_po;
                console.log(item_po.length);
                $('#isi_edit').val(item_po.length);
                var currentDate = new Date(po.tglppo);
                var tglspp = currentDate;
                var convert = currentDate.tglspp;

                var date = new Date(po.tgl_po);
                yr = date.getFullYear();
                month = date.getMonth();
                day = date.getDate();

                $('#tgl_spp').html('Tanggal SPP : ' + po.tglspp);
                $('#h4_no_ref_spp').html('No. Ref SPP : ' + po.no_refppo);
                $('#refspp').val(po.no_refppo);


                $('#tgl_po_lbl').html('Tanggal PO : ' + day + '-' + month + '-' + yr);
                $('#h4_no_ref_po').html('No. Ref PO : ' + po.noreftxt);
                $('#id_po').val(po.id);
                $('#hidden_id_po').val(po.id);
                $('#hidden_no_ref_po').val(po.noreftxt);

                //header

                cekJenis(data.po.jenis_spp);
                selectedsupply(data.po.kode_supply, data.po.nama_supply);
                // selectedsdhbayar(data.po.bayar);
                $('#tmpo_pembayaran').val(data.po.tempo_bayar);
                $('#tmpo_pengiriman').val(data.po.tempo_kirim);
                $('#lks_pengiriman').val(data.po.lokasikirim);
                // selectedlokbeli(data.po.lokasi_beli);
                $('#no_penawaran').val(data.po.ket_acc);
                $('#txt_pemesan').val(data.po.user);
                $('#hidden_devisi').val(data.po.devisi);
                $('#hidden_kode_devisi').val(data.po.kode_dev);
                // selecteddevisi(data.po.kode_dev, data.po.devisi);
                $('#ket_pengiriman').val(data.po.ket_kirim);
                $('#pph').val(data.po.pph);
                // selectedppn(data.po.ppn);
                $('#keterangan').val(data.po.ket);
                // selectedkirim(data.po.kirim);
                $('#ttl_pembayaran').val(data.po.totalbayar);
                $('#total_pembayaran').val(data.po.totalbayar);
                $('#total_pembayaran').number(true, 2);


                $('#tgl_po').val(formatDate(data.po.tglpo));

                for (i = 0; i < item_po.length; i++) {
                    // var no = i + 1;

                    var lokasi = $('#lokasi').val();
                    switch (lokasi) {
                        case 'HO':
                            tambah_row(i);
                            break;
                        case 'RO':
                        case 'SITE':
                        case 'PKS':
                            tambah_item(i)
                            break;
                        default:
                            break;
                    }

                    var refppo = item_po[i].refppo;
                    var grup = item_po[i].grup;
                    var kodebar = item_po[i].kodebar;
                    var nabar = item_po[i].nabar;
                    var qty = item_po[i].qty;
                    var qty2 = item_po[i].qty2;
                    var kurs = item_po[i].kurs;
                    var disc = item_po[i].disc;

                    var nama_bebanbpo = item_po[i].nama_bebanbpo;
                    var jml_bpo = item_po[i].JUMLAHBPO;
                    var ket = item_po[i].ket;
                    var id = item_po[i].id;
                    var merk = item_po[i].merek;
                    var harga = item_po[i].harga;
                    var jumharga = item_po[i].jumharga;
                    var iditem = item_po[i].id;
                    var iditemspp = item_po[i].id_item_spp;
                    var kd_dept = item_po[i].kodept;
                    var tglspp = item_po[i].tglppo;
                    var kodept = item_po[i].kodept;
                    var noppo = item_po[i].noppo;
                    var namapt = item_po[i].namapt;
                    var sat = item_po[i].sat;
                    var norefppo = item_po[i].refppo;

                    if (kodebar == '102505700000002' && data.po.lokasi == 'HO') {
                        gantiTabel();
                        console.log("solar");
                        $('#txt_ongkir_' + i).val(jml_bpo);
                    } else {
                        $('#txt_biaya_lain_' + i).val(jml_bpo);
                        console.log("bukan solar");
                    }

                    // Set data

                    $('#getspp' + i).val(refppo);
                    $('#cmb_jenis_budget_' + i).val(grup);
                    $('#hidden_nopo').val(item_po[0].nopo);
                    $('#hidden_kode_brg_' + i).val(kodebar);
                    $('#kode_brg_' + i).text(kodebar);
                    $('#hidden_nama_brg_' + i).val(nabar);
                    $('#hidden_satuan_brg_' + i).val(sat);
                    $('#nama_brg_' + i).text(nabar);
                    $('#txt_keterangan_rinci_' + i).val(ket);
                    $('#txt_qty_' + i).val(qty);
                    $('#qty_' + i).val(qty);
                    $('#qty2_' + i).val(qty2);
                    $('#txt_merk_' + i).val(merk);
                    $('#cmb_kurs_' + i).val(kurs);
                    $('#txt_disc_' + i).val(disc);
                    $('#txt_keterangan_biaya_lain_' + i).val(nama_bebanbpo);
                    $('#txt_harga_' + i).val(harga);
                    $('#txt_jumlah_' + i).val(jumharga);

                    var no_ref_spp = norefppo;
                    var id_item_spp = iditemspp;
                    sisaQtyPO(no_ref_spp, id_item_spp, i);

                    var bilangan = jumharga;
                    var number_string = bilangan.toString(),
                        sisa = number_string.length % 3,
                        rupiah = number_string.substr(0, sisa),
                        ribuan = number_string.substr(sisa).match(/\d{3}/g);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }
                    $('#jumlah_' + i).val(jumharga);
                    $('#hasil_jumlah_' + i).html(jumharga);
                    $('#hasil_jumlah_' + i).number(true, 2);
                    $('#jumlah_' + i).number(true, 2);

                    $('#id_item_po' + i).val(iditem);
                    $('#id_item_' + i).val(iditemspp);
                    $('#hidden_id_po_item_' + i).val(iditem);
                    $('#hidden_kd_departemen_' + i).val(kd_dept);
                    $('#hidden_tgl_spp_' + i).val(tglspp);
                    $('#hidden_kd_pt_' + i).val(kodept);
                    $('#hidden_nama_pt_' + i).val(namapt);
                    $('#noppo' + i).val(noppo);
                    $('#hidden_no_ref_spp_' + i).val(norefppo);
                    $('#hidden_no_ref_po_' + i).val(po.noreftxt);

                    $('.div_form_1').find('input,textarea,select').attr('disabled', '');
                    $('.div_form_1').find('input,textarea,select').addClass('form-control bg-light');


                    $('.div_form_2').find('#getspp' + i + ',#cmb_jenis_budget_' + i + ',#txt_merk_' + i + ' ,#txt_harga_' + i + ', #cmb_kurs_' + i + ', #txt_disc_' + i + ',  #txt_keterangan_biaya_lain_' + i + ', #txt_qty_' + i + ', #txt_biaya_lain_' + i + ',#txt_ongkir_' + i + ', #jumlah_' + i + ',#txt_jumlah_' + i + ', #txt_keterangan_rinci_' + i).addClass('bg-light');
                    $('.div_form_3').find('#getspp' + i + ',#cmb_jenis_budget_' + i + ',#txt_merk_' + i + ' ,#txt_harga_' + i + ', #cmb_kurs_' + i + ', #txt_disc_' + i + ',  #txt_keterangan_biaya_lain_' + i + ', #txt_qty_' + i + ', #txt_biaya_lain_' + i + ',#txt_ongkir_' + i + ', #jumlah_' + i + ', #txt_jumlah_' + i + ',  #txt_keterangan_rinci_' + i).addClass('bg-light');
                    $('.div_form_3').find('#getspp' + i + ',#cmb_jenis_budget_' + i + ',#txt_merk_' + i + ' ,#txt_harga_' + i + ', #cmb_kurs_' + i + ', #txt_disc_' + i + ', #txt_keterangan_biaya_lain_' + i + ', #txt_qty_' + i + ', #txt_biaya_lain_' + i + ', #txt_ongkir_' + i + ', #txt_jumlah_' + i + ', #txt_keterangan_rinci_' + i).attr('disabled', '');
                    $('.div_form_2').find('#getspp' + i + ',#cmb_jenis_budget_' + i + ',#txt_merk_' + i + ' ,#txt_harga_' + i + ', #cmb_kurs_' + i + ', #txt_disc_' + i + ', #txt_keterangan_biaya_lain_' + i + ', #txt_qty_' + i + ', #txt_biaya_lain_' + i + ', #txt_ongkir_' + i + ', #txt_jumlah_' + i + ', #txt_keterangan_rinci_' + i).attr('disabled', '');
                }
                totalBayar();
            },
            error: function(request) {
                alert("KONEKSI TERPUTUS!");
            }
        });
    }

    function cancleUpdate(id) {
        // console.log('cancelke' + id);
        if (cancleUpdatePO) {

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Po/cancel_ubah_rinci') ?>",
                dataType: "JSON",
                beforeSend: function() {
                    $('#lbl_status_simpan_' + id).empty();
                    $('#lbl_status_simpan_' + id).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Cancel Update</label>');
                },
                data: {
                    id_po: $('#hidden_no_ref_po_' + id).val(),
                    id_po_item: $('#hidden_id_po_item_' + id).val(),
                },
                success: function(data) {
                    // console.log(data);
                    var po = data.data_po;
                    //header
                    // var tgl = new Date(po.tglpo);
                    // console.log(tgl);
                    $('#tgl_po').val(po.tglpo);
                    //end header

                    var item = data.data_item_po;

                    $('#cmb_jenis_budget_' + id).val(item.grup);
                    $('#txt_merk_' + id).val(item.merek);
                    $('#txt_harga_' + id).val(item.harga);
                    $('#txt_qty_' + id).val(item.qty);
                    $('#txt_disc_' + id).val(item.disc);
                    $('#txt_biaya_lain_' + id).val(item.JUMLAHBPO);
                    $('#txt_ongkir_' + id).val(item.JUMLAHBPO);
                    $('#txt_keterangan_biaya_lain_' + id).val(item.nama_bebanbpo);
                    $('#txt_keterangan_rinci_' + id).val(item.ket);

                    $('#btn_ubah_' + id).show();
                    $('#btn_update_' + id).hide();
                    $('#btn_cancel_update_' + id).hide();
                    $('#lbl_status_simpan_' + id).empty();
                    $('#btn_hapus_' + id).show();


                    $('.div_form_1').find('#tgl_po,#select2 ,#cmb_status_bayar, #tmpo_pembayaran, #tmpo_pengiriman, #lks_pengiriman, #lks_pembelian, #no_penawaran, #txt_pemesan, #devisi,#ket_pengiriman,#pph,#ppn,#keterangan,#cmb_dikirim_ke_kebun').addClass('form-control bg-light');
                    $('.div_form_1').find('#tgl_po,#select2 ,#cmb_status_bayar, #tmpo_pembayaran, #tmpo_pengiriman, #lks_pengiriman, #lks_pembelian, #no_penawaran, #txt_pemesan, #devisi,#ket_pengiriman,#pph,#ppn,#keterangan,#cmb_dikirim_ke_kebun').attr('disabled', '');


                    $('#tr_' + id).find('input,textarea,select').attr('disabled', '');
                    $('#tr_' + id).find('input,textarea,select').addClass('form-control bg-light');


                    $.toast({
                        position: 'top-right',
                        heading: 'Success',
                        text: 'Edit Dibatalkan!',
                        icon: 'success',
                        loader: false
                    });
                    jumlah(id);
                    totalBayar();
                    cancleUpdatePO = false;
                },
                error: function(request) {
                    $('#lbl_status_simpan_' + id).empty();
                    $('#btn_ubah_' + id).show();
                    $('#btn_update_' + id).hide();
                    $('#btn_cancel_update_' + id).hide();
                    $('#lbl_status_simpan_' + id).empty();
                    $('#btn_hapus_' + id).show();
                    alert("KONEKSI TERPUTUS! GAGAL CANCEL UPDATE");
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Po/cancel_ubah_rinci') ?>",
                dataType: "JSON",
                beforeSend: function() {
                    $('#lbl_status_simpan_' + id).empty();
                    $('#lbl_status_simpan_' + id).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Cancel Update</label>');
                },
                data: {
                    id_po: $('#hidden_no_ref_po_' + id).val(),
                    id_po_item: $('#hidden_id_po_item_' + id).val(),
                },
                success: function(data) {
                    console.log(data);
                    // var po = data.data_po;
                    var item = data.data_item_po;

                    $('#cmb_jenis_budget_' + id).val(item.grup);
                    $('#txt_merk_' + id).val(item.merek);
                    $('#txt_harga_' + id).val(item.harga);
                    $('#txt_qty_' + id).val(item.qty);
                    $('#txt_disc_' + id).val(item.disc);
                    $('#txt_biaya_lain_' + id).val(item.JUMLAHBPO);
                    $('#txt_ongkir_' + id).val(item.JUMLAHBPO);
                    $('#txt_keterangan_biaya_lain_' + id).val(item.nama_bebanbpo);
                    $('#txt_keterangan_rinci_' + id).val(item.ket);

                    $('#btn_ubah_' + id).show();
                    $('#btn_update_' + id).hide();
                    $('#btn_cancel_update_' + id).hide();
                    $('#lbl_status_simpan_' + id).empty();
                    $('#btn_hapus_' + id).show();


                    $('.div_form_1').find('#tgl_po,#select2 ,#cmb_status_bayar, #tmpo_pembayaran, #tmpo_pengiriman, #lks_pengiriman, #lks_pembelian, #no_penawaran, #txt_pemesan, #devisi,#ket_pengiriman,#pph,#ppn,#keterangan,#cmb_dikirim_ke_kebun').addClass('form-control bg-light');
                    $('.div_form_1').find('#tgl_po,#select2 ,#cmb_status_bayar, #tmpo_pembayaran, #tmpo_pengiriman, #lks_pengiriman, #lks_pembelian, #no_penawaran, #txt_pemesan, #devisi,#ket_pengiriman,#pph,#ppn,#keterangan,#cmb_dikirim_ke_kebun').attr('disabled', '');


                    $('#tr_' + id).find('input,textarea,select').attr('disabled', '');
                    $('#tr_' + id).find('input,textarea,select').addClass('form-control bg-light');


                    $.toast({
                        position: 'top-right',
                        heading: 'Success',
                        text: 'Edit Dibatalkan!',
                        icon: 'success',
                        loader: false
                    });
                    jumlah(id);
                    totalBayar();
                    cancleUpdatePO = false;
                },
                error: function(request) {
                    $('#lbl_status_simpan_' + id).empty();
                    $('#btn_ubah_' + id).show();
                    $('#btn_update_' + id).hide();
                    $('#btn_cancel_update_' + id).hide();
                    $('#lbl_status_simpan_' + id).empty();
                    $('#btn_hapus_' + id).show();
                    alert("KONEKSI TERPUTUS! GAGAL CANCEL UPDATE");
                }
            });
        }
    }

    function totalBayar() {
        var no_po = $('#hidden_no_po').val();
        var no_ref_po = $('#hidden_no_ref_po').val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/total_bayar'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                no_po: $('#hidden_no_po').val(),
                no_ref_po: $('#hidden_no_ref_po').val(),
                ppn: $('#ppn').val(),
                pph: $('#pph').val(),
            },
            success: function(data) {
                console.log(data);
                $('#ttl_pembayaran').val(data.totbay);
            },
            error: function(request) {
                alert("KONEKSI TERPUTUS!");
            }
        });
    }

    function tambah_item(row) {

        // row++;
        console.log("bariske", row);

        var tr_buka = '<tr id="tr_' + row + '">';
        var form_buka = '<form id="form_rinci_' + row + '" name="form_rinci_' + row + '" method="POST" action="javascript:;">';
        var td_col_1 = '<td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="hidden" id="hidden_no_table_' + row + '" name="hidden_no_table_' + row + '">' +
            '<button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" id="btn_tambah_row_' + row + '" name="btn_tambah_row_' + row + '" onclick="tambahSpp(' + row + ')"></button>' +
            '</td>';
        var td_col_3 = '<td width="8" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<select class="form-control form-control-sm" id="cmb_jenis_budget_' + row + '" name="cmb_jenis_budget_' + row + '" required>' +
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
        var td_col_ = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<font face="Verdana" size="1.5"><span id="nama_brg_' + row + '"></font><font face="Verdana" size="1.5"></span><br><span id="kode_brg_' + row + '" ></span></font>' +
            '<input type="hidden" id="ppo' + row + '" name="ppo' + row + '">' +
            '<input type="hidden" id="id_ppo' + row + '" name="id_ppo' + row + '">' +
            '<input type="hidden" id="id_item_' + row + '" name="id_item_' + row + '">' +
            '<input type="hidden" id="hidden_no_ref_spp_' + row + '" name="hidden_no_ref_spp_' + row + '">' +
            '<input type="hidden" id="hidden_tgl_ref_' + row + '" name="hidden_tgl_ref_' + row + '">' +
            '<input type="hidden" id="hidden_kd_departemen_' + row + '" name="hidden_kd_departemen_' + row + '">' +
            '<input type="hidden" id="hidden_departemen_' + row + '" name="hidden_departemen_' + row + '">' +
            '<input type="hidden" id="hidden_tgl_spp_' + row + '" name="hidden_tgl_spp_' + row + '">' +
            '<input type="hidden" id="hidden_kd_pt_' + row + '" name="hidden_kd_pt_' + row + '">' +
            '<input type="hidden" id="hidden_nama_pt_' + row + '" name="hidden_nama_pt_' + row + '">' +
            '<input type="hidden" id="noppo' + row + '" name="noppo' + row + '">' +
            '<input type="hidden" class="form-control form-control-sm" id="hidden_kode_brg_' + row + '" name="hidden_kode_brg_' + row + '"   />' +
            '<input type="hidden" class="form-control form-control-sm" id="hidden_nama_brg_' + row + '" name="hidden_nama_brg_' + row + '"   />' +
            '<input type="hidden" class="form-control form-control-sm" id="hidden_satuan_brg_' + row + '" name="hidden_satuan_brg_' + row + '"   />' +
            '<input type="hidden" class="form-control form-control-sm" id="id_item_po' + row + '" name="id_item_po' + row + '" >' +
            '<input type="hidden" id="hidden_no_ref_po_' + row + '" name="hidden_no_ref_po_' + row + '">' +
            '</td>';
        var td_col_4 = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea class="form-control form-control-sm" id="txt_merk_' + row + '" name="txt_merk_' + row + '" size="26" placeholder="Merk" rows="3"></textarea><br />' +
            '</td>';
        var td_col_5 = '<td width="7%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_qty_' + row + '" name="txt_qty' + row + '" placeholder="Qty" autocomplite="off" size="8" onkeyup="jumlah(' + row + ')">' +
            '<input type="hidden" class="form-control form-control-sm" id="qty_' + row + '" name="qty' + row + '" placeholder="Qty" size="8" />' +
            '<input type="hidden" class="form-control form-control-sm" id="qty2_' + row + '" name="qty2' + row + '" placeholder="Qty" size="8"/>' +
            '<span class="small text-muted" style="font-size: 11px;">Qty&nbsp;PO&nbsp;:&nbsp;</span><span id="qty_po_' + row + '" class="small" style="font-size: 11px;"></span><br>' +
            '<span class="small text-muted" style="font-size: 11px;">SIsa&nbsp;Qty&nbsp;:&nbsp;</span><span id="sisa_qty_' + row + '" class="small" style="font-size: 11px;"></span>' +
            '</td>';
        var td_col_6 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_harga_' + row + '" name="txt_harga_' + row + '" onkeyup="jumlah(' + row + ')" placeholder="Harga dalam Rupiah" size="15" autocomplite="off" /><br />' +
            '</td>';
        var td_col_7 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<select class="form-control form-control-sm" id="cmb_kurs_' + row + '" name="cmb_kurs_' + row + '" required="">' +
            '<option value="Rp">Rp IDR</option>' +
            '<option value="USD">&dollar; USD</option>' +
            '<option value="SGD">S&dollar; SGD</option>' +
            '<option value="Euro">&euro; Euro</option>' +
            '<option value="GBP">&pound; GBP</option>' +
            '<option value="Yen">&yen; Yen</option>' +
            '<option value="MYR">RM MYR</option>' +
            '</select><br />' +
            '</td>';
        var td_col_8 = '<td width="5%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_disc_' + row + '" name="txt_disc_' + row + '" size="10" value="0" onkeyup="jumlah(' + row + ')" placeholder="Disc"/>' +
            '</td>';
        var td_col_9 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_biaya_lain_' + row + '" name="txt_biaya_lain_' + row + '" size="15" value="0" onkeyup="jumlah(' + row + ')" placeholder="Biaya Lain"/>' +
            '</td>';
        var td_col_10 = '<td id="txt_ketbiaya_' + row + '" width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea class="form-control form-control-sm" id="txt_keterangan_biaya_lain_' + row + '" name="txt_keterangan_biaya_lain_' + row + '" size="26" placeholder="Keterangan Biaya" onkeypress="saveRinciEnter(event,' + row + ')" rows="3"></textarea><br />' +
            '</td>'
        var td_col_11 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea maxlength="250" rows="3" class="form-control form-control-sm" id="txt_keterangan_rinci_' + row + '" name="txt_keterangan_rinci_' + row + '" size="26" placeholder="Keterangan" onkeypress="saveRinciEnter(event,' + row + ')"></textarea><br />' +

            '</td>';
        var td_col_12 = '<td width="25%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            // '<h6>Jumlah : <span id="hasil_jumlah_' + row + '"></span></h6>' +
            '<input type="text" class="form-control form-control-sm" id="jumlah_' + row + '" name="jumlah_" size="15" placeholder="Jumlah"  readonly />' +
            '<input type="hidden" class="form-control form-control-sm" id="txt_jumlah_' + row + '" name="txt_jumlah_" size="15" placeholder="Jumlah"  readonly />' +

            '<input type="hidden" id="hidden_id_po_item_' + row + '" name="hidden_id_po_item_' + row + '">' +
            '</td>';
        var td_col_13 = '<td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.2em;">' +
            '<span style="display:none;" id="habis_' + row + '" class="badge badge-danger">Habis</span>' +
            '<button style="display:none;" class="btn btn-xs btn-success fa fa-save" id="btn_simpan_' + row + '" name="btn_simpan_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="validasi(' + row + ')" ></button>' +
            '<button class="btn btn-xs btn-warning fa fa-edit" onclick="ubah(' + row + ')" id="btn_ubah_' + row + '" name="btn_ubah_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" ></button>' +
            '<button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_' + row + '" name="btn_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="validasiUpdate(' + row + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick mt-1" id="btn_cancel_update_' + row + '" name="btn_cancel_update_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update"  onclick="cancleUpdate(' + row + ')"></button>' +
            '<button class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_' + row + '" name="btn_hapus_' + row + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + row + ')"></button>' +
            '<label id="lbl_status_simpan_' + row + '"></label>' +
            '</td>';
        var form_tutup = '</form>';
        var tr_tutup = '</tr>';
        var lokasi = $('#lokasi').val();

        $('#tbody_item').append(tr_buka + form_buka + td_col_1 + td_col_ + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_9 + td_col_10 + td_col_11 + td_col_12 + td_col_13 + form_tutup + tr_tutup);
        // $('#txt_qty_' + row + ',#txt_harga_' + row + ',#txt_disc_' + row + ',#txt_biaya_lain_' + row + '').number(true, 0);
        $('#txt_qty_' + row + ',#qty_' + row + ',#qty2_' + row + ',#txt_harga_' + row + ',#txt_biaya_lain_' + row + ',#txt_disc_' + row + '').on("keypress keyup blur", function(event) {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });


        if (row == 1) {
            $('#btn_hapus_row_1').hide();
        } else {
            $('#btn_hapus_row_1' + row).show();
        }
        initPilihSpp(row);
        hitungqty(row);
        jumlah(row);
    }

    function initPilihSpp(id) {

        $(`#pilihSpp${id}`).select2({
            ajax: {
                url: "<?php echo site_url('Po/getSpp') ?>",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        noref: params.term // search term
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
            console.log(data);
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
                    // console.log(response);
                    data = JSON.parse(response);
                    $.each(data, function(index, value) {
                        // console.log(value);
                        // var idppo = value.id;
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
                        var qty2 = value.qty2;
                        $(`#hidden_tgl_ref_${id}`).val(tglref);
                        $(`#hidden_no_ref_spp_${id}`).val(opsi);
                        $(`#hidden_kd_departemen_${id}`).val(kodedept);
                        $(`#hidden_departemen_${id}`).val(namadept);
                        $(`#hidden_tgl_spp_${id}`).val(tglppo);
                        $(`#hidden_kd_pt_${id}`).val(kodept);
                        $(`#hidden_nama_pt_${id}`).val(pt);
                        $(`#noppo${id}`).val(noppo);
                        $(`#hidden_kode_brg_${id}`).val(kodebar);
                        $(`#kode_brg_${id}`).text(kodebar);
                        $(`#hidden_nama_brg_${id}`).val(nabar);
                        $(`#nama_brg_${id}`).text(nabar);
                        $(`#hidden_satuan_brg_${id}`).val(sat);
                        $(`#txt_qty_${id}`).val(qty);
                        $(`#qty_${id}`).val(qty);
                        // $(`#qty2_${id}`).val(qty2);
                        // console.log("ini adalah id", idppo);
                        // console.log(nabar);
                    });

                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });
        });

    }

    // var n = 1;

    function tambah_row(n) {
        // n++;
        console.log("bariske", n);

        var tr_buka = '<tr id="tr_' + n + '">';
        var td_col_1 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="hidden" id="hidden_proses_status_' + n + '" name="hidden_proses_status_' + n + '" value="insert">' +
            '<button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" name="btn_tambah_row" id="btn_tambah_row_' + n + '"  onclick="tambahSppHO(' + n + ')"></button>' +
            // '<button class="btn btn-xs btn-danger fa fa-minus btn_hapus_row_' + n + '" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row_' + n + '" name="btn_hapus_row" onclick="hapus_row(' + n + ')"></button>' +
            '</td>';

        var form_buka = '<form id="form_rinci_' + n + '" name="form_rinci_' + n + '" method="POST" action="javascript:;">';
        var td_col_2 = '<td width="19%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control form-control-sm" style="font-size: 12px;" id="getspp' + n + '" name="spp' + n + '" >' +
            '<input type="hidden" class="form-control form-control-sm" id="id_item_po' + n + '" name="id_item_po' + n + '" >' +
            '<input type="hidden" id="id_item_' + n + '" name="id_item_' + n + '">' +
            '<input type="hidden" id="ppo' + n + '" name="ppo' + n + '">' +
            '<input type="hidden" id="hidden_no_ref_spp_' + n + '" name="hidden_no_ref_spp_' + n + '">' +
            '<input type="hidden" id="hidden_tgl_ref_' + n + '" name="hidden_tgl_ref_' + n + '">' +
            '<input type="hidden" id="hidden_kd_departemen_' + n + '" name="hidden_kd_departemen_' + n + '">' +
            '<input type="hidden" id="hidden_departemen_' + n + '" name="hidden_departemen_' + n + '">' +
            '<input type="hidden" id="hidden_tgl_spp_' + n + '" name="hidden_tgl_spp_' + n + '">' +
            '<input type="hidden" id="hidden_kd_pt_' + n + '" name="hidden_kd_pt_' + n + '">' +
            '<input type="hidden" id="hidden_nama_pt_' + n + '" name="hidden_nama_pt_' + n + '">' +
            '<input type="hidden" id="noppo' + n + '" name="noppo' + n + '">' +
            '</td>';
        // var td_col_3 = '<td width="20%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
        //     '<select class="form-control form-control-sm" id="cmb_jenis_budget_' + n + '" name="cmb_jenis_budget_' + n + '" required>' +
        //     '<option value="">-- Pilih --</option>' +
        //     '<option value="TEKNIK">TEKNIK</option>' +
        //     '<option value="BIBITAN">BIBITAN</option>' +
        //     '<option value="LC & TANAM">LC & TANAM</option>' +
        //     '<option value="RAWAT">RAWAT</option>' +
        //     '<option value="PANEN">PANEN</option>' +
        //     '<option value="TEKNIK">TEKNIK</option>' +
        //     '<option value="PABRIK">PABRIK</option>' +
        //     '<option value="KANTOR">KANTOR</option>' +
        //     '<option value="Kendaraan">Kendaraan</option>' +
        //     '<option value="TBM">TBM</option>' +
        //     '</select>'; +
        // '</td>';
        var td_col_ = '<td width="5%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<font face="Verdana" size="1.5"><span id="nama_brg_' + n + '"></font><font face="Verdana" size="1.5"></span><br><span id="kode_brg_' + n + '" ></span></font>' +

            '<input type="hidden" class="form-control form-control-sm" id="hidden_kode_brg_' + n + '" name="hidden_kode_brg_' + n + '"   />' +
            '<input type="hidden" class="form-control form-control-sm" id="hidden_nama_brg_' + n + '" name="hidden_nama_brg_' + n + '"   />' +
            '<input type="hidden" class="form-control form-control-sm" id="hidden_satuan_brg_' + n + '" name="hidden_satuan_brg_' + n + '"   />' +
            '<input type="hidden" id="hidden_no_ref_po_' + n + '" name="hidden_no_ref_po_' + n + '">' +

            '</td>';
        var td_col_4 = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea class="form-control form-control-sm" id="txt_merk_' + n + '" name="txt_merk_' + n + '" size="26" placeholder="Merk" rows="3"></textarea>' +

            '</td>';
        var td_col_5 = '<td width="7%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_qty_' + n + '" name="txt_qty_' + n + '" placeholder="Qty" size="8" onkeyup="jumlah(' + n + ')" />' +
            '<input type="hidden" class="form-control form-control-sm" id="qty_' + n + '" name="qty_' + n + '" placeholder="Qty" size="8" />' +
            '<input type="hidden" class="form-control form-control-sm" id="qty2_' + n + '" name="qty2_' + n + '" placeholder="Qty" size="8" />' +
            '<span class="small text-muted" style="font-size: 11px;">Qty&nbsp;PO&nbsp;:&nbsp;</span><span id="qty_po_' + n + '" class="small" style="font-size: 11px;"></span><br>' +
            '<span class="small text-muted" style="font-size: 11px;">SIsa&nbsp;Qty&nbsp;:&nbsp;</span><span id="sisa_qty_' + n + '" class="small" style="font-size: 11px;"></span>' +

            '</td>';
        var td_col_6 = '<td width="12%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_harga_' + n + '" name="txt_harga_' + n + '" value="0" onkeyup="jumlah(' + n + ')" placeholder="Harga dalam Rupiah" size="15" required /><br />' +

            '</td>';
        var td_col_7 = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<select class="form-control form-control-sm" id="cmb_kurs_' + n + '" name="cmb_kurs_' + n + '" required="">' +
            '<option value="Rp">Rp IDR</option>' +
            '<option value="USD">&dollar; USD</option>' +
            '<option value="SGD">S&dollar; SGD</option>' +
            '<option value="Euro">&euro; Euro</option>' +
            '<option value="GBP">&pound; GBP</option>' +
            '<option value="Yen">&yen; Yen</option>' +
            '<option value="MYR">RM MYR</option>' +
            '</select><br />' +
            '</td>';
        var td_col_8 = '<td width="5%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_disc_' + n + '" name="txt_disc_' + n + '" size="10" value="0" onkeyup="jumlah(' + n + ')" placeholder="Disc"/>' +

            '</td>';
        var td_col_9 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_biaya_lain_' + n + '" name="txt_biaya_lain_' + n + '" size="15" value="0" onkeyup="jumlah(' + n + ')" placeholder="Biaya Lain"/>' +
            '<input type="number" class="form-control form-control-sm" style="display: none;" id="txt_ongkir_' + n + '" name="txt_ongkir_' + n + '" value="0" onkeyup="jumlah(' + n + ')" placeholder="Ongkir" />' +
            '</td>';
        var td_col_10 = '<td id="txt_ketbiaya_' + n + '" width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea rows="3" class="resizable_textarea form-control form-control-sm" id="txt_keterangan_biaya_lain_' + n + '" name="txt_keterangan_biaya_lain_' + n + '" size="26" placeholder="Keterangan Biaya" onkeypress="saveRinciEnter(event,' + n + ')"></textarea><br />' +

            '</td>'
        var td_col_11 = '<td width="40%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea rows="2" class="resizable_textarea form-control form-control-sm" id="txt_keterangan_rinci_' + n + '" name="txt_keterangan_rinci_' + n + '" size="26" placeholder="Keterangan" onkeypress="saveRinciEnter(event,' + n + ')"></textarea>' +
            '<h6>Jumlah : <span id="hasil_jumlah_' + n + '"></span></h6>' +
            '<input type="hidden" class="form-control form-control-sm" id="txt_jumlah_' + n + '" name="txt_jumlah_" size="15" placeholder="Jumlah"  readonly />' +
            // '<label id="lbl_status_simpan_' + n + '"></label>' +
            '<input type="hidden" id="hidden_id_po_item_' + n + '" name="hidden_id_po_item_' + n + '">' +

            '</td>';
        // var td_col_12 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +

        //     '</td>';
        var td_col_13 = '<td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<span style="display:none;" id="habis_' + n + '" class="badge badge-danger">Habis</span>' +
            '<button style="display:none;" class="btn btn-xs btn-success fa fa-save" id="btn_simpan_' + n + '" name="btn_simpan_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="validasi(' + n + ')" ></button>' +
            '<button class="btn btn-xs btn-warning fa fa-edit" onclick="ubah(' + n + ')" id="btn_ubah_' + n + '" name="btn_ubah_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" ></button>' +
            '<button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_' + n + '" name="btn_update_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="validasiUpdate(' + n + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick mt-1" id="btn_cancel_update_' + n + '" name="btn_cancel_update_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update"  onclick="cancleUpdate(' + n + ')"></button>' +
            '<button class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_' + n + '" name="btn_hapus_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + n + ')"></button>' +
            '<label id="lbl_status_simpan_' + n + '"></label>' +
            '</td>';
        var form_tutup = '</form>';
        var tr_tutup = '</tr>';
        var lokasi = $('#lokasi').val();

        $('#tbody_rincian').append(tr_buka + form_buka + td_col_1 + td_col_2 + td_col_ + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_9 + td_col_10 + td_col_11 + td_col_13 + form_tutup + tr_tutup);
        // $('#txt_qty_' + n + ',#txt_harga_' + n + ',#txt_disc_' + n + ',#txt_biaya_lain_' + n + '').number(true, 0);
        $('#txt_qty_' + n + ',#qty_' + n + ',#qty2_' + n + ',#txt_harga_' + n + ',#txt_biaya_lain_' + n + ',#txt_disc_' + n + '').on("keypress keyup blur", function(event) {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        hitungqty(n);
        jumlah(n);
        return true;
    }



    function tambah_row_baru(n) {
        // n++;
        console.log("bariske", n);

        var tr_buka = '<tr id="tr_' + n + '">';
        var td_col_1 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="hidden" id="hidden_proses_status_' + n + '" name="hidden_proses_status_' + n + '" value="insert">' +
            '<button class="btn btn-xs btn-info fa fa-plus" data-toggle="tooltip" data-placement="left" title="Tambah" name="btn_tambah_row" id="btn_tambah_row_' + n + '"  onclick="tambahSppHO(' + n + ')"></button>' +
            '<button class="btn btn-xs btn-danger fa fa-minus btn_hapus_row_' + n + '" type="button" data-toggle="tooltip" data-placement="left" title="Hapus" id="btn_hapus_row_' + n + '" name="btn_hapus_row" onclick="hapus_row(' + n + ')"></button>' +
            '</td>';

        var form_buka = '<form id="form_rinci_' + n + '" name="form_rinci_' + n + '" method="POST" action="javascript:;">';
        var td_col_2 = '<td width="19%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="text" class="form-control form-control-sm bg-light" style="font-size: 12px;" id="getspp' + n + '" name="spp' + n + '" readonly>' +
            '<input type="hidden" class="form-control form-control-sm" id="id_item_po' + n + '" name="id_item_po' + n + '" >' +
            '<input type="hidden" id="id_item_' + n + '" name="id_item_' + n + '">' +
            '<input type="hidden" id="ppo' + n + '" name="ppo' + n + '">' +
            '<input type="hidden" id="hidden_no_ref_spp_' + n + '" name="hidden_no_ref_spp_' + n + '">' +
            '<input type="hidden" id="hidden_tgl_ref_' + n + '" name="hidden_tgl_ref_' + n + '">' +
            '<input type="hidden" id="hidden_kd_departemen_' + n + '" name="hidden_kd_departemen_' + n + '">' +
            '<input type="hidden" id="hidden_departemen_' + n + '" name="hidden_departemen_' + n + '">' +
            '<input type="hidden" id="hidden_tgl_spp_' + n + '" name="hidden_tgl_spp_' + n + '">' +
            '<input type="hidden" id="hidden_kd_pt_' + n + '" name="hidden_kd_pt_' + n + '">' +
            '<input type="hidden" id="hidden_nama_pt_' + n + '" name="hidden_nama_pt_' + n + '">' +
            '<input type="hidden" id="noppo' + n + '" name="noppo' + n + '">' +
            '</td>';
        // var td_col_3 = '<td width="20%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
        //     '<select class="form-control form-control-sm" id="cmb_jenis_budget_' + n + '" name="cmb_jenis_budget_' + n + '" required>' +
        //     '<option value="">-- Pilih --</option>' +
        //     '<option value="TEKNIK">TEKNIK</option>' +
        //     '<option value="BIBITAN">BIBITAN</option>' +
        //     '<option value="LC & TANAM">LC & TANAM</option>' +
        //     '<option value="RAWAT">RAWAT</option>' +
        //     '<option value="PANEN">PANEN</option>' +
        //     '<option value="TEKNIK">TEKNIK</option>' +
        //     '<option value="PABRIK">PABRIK</option>' +
        //     '<option value="KANTOR">KANTOR</option>' +
        //     '<option value="Kendaraan">Kendaraan</option>' +
        //     '<option value="TBM">TBM</option>' +
        //     '</select>'; +
        // '</td>';
        var td_col_ = '<td width="5%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<font face="Verdana" size="1.5"><span id="nama_brg_' + n + '"></font><font face="Verdana" size="1.5"></span><br><span id="kode_brg_' + n + '" ></span></font>' +

            '<input type="hidden" class="form-control form-control-sm" id="hidden_kode_brg_' + n + '" name="hidden_kode_brg_' + n + '"   />' +
            '<input type="hidden" class="form-control form-control-sm" id="hidden_nama_brg_' + n + '" name="hidden_nama_brg_' + n + '"   />' +
            '<input type="hidden" class="form-control form-control-sm" id="hidden_satuan_brg_' + n + '" name="hidden_satuan_brg_' + n + '"   />' +
            '<input type="hidden" id="hidden_no_ref_po_' + n + '" name="hidden_no_ref_po_' + n + '">' +

            '</td>';
        var td_col_4 = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea class="form-control form-control-sm" id="txt_merk_' + n + '" name="txt_merk_' + n + '" size="26" placeholder="Merk" rows="3"></textarea>' +

            '</td>';
        var td_col_5 = '<td width="7%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_qty_' + n + '" name="txt_qty_' + n + '" placeholder="Qty" size="8" onkeyup="jumlah(' + n + ')" />' +
            '<input type="hidden" class="form-control form-control-sm" id="qty_' + n + '" name="qty_' + n + '" placeholder="Qty" size="8" />' +
            '<input type="hidden" class="form-control form-control-sm" id="qty2_' + n + '" name="qty2_' + n + '" placeholder="Qty" size="8" />' +
            '<span class="small text-muted" style="font-size: 11px;">Qty&nbsp;PO&nbsp;:&nbsp;</span><span id="qty_po_' + n + '" class="small" style="font-size: 11px;"></span><br>' +
            '<span class="small text-muted" style="font-size: 11px;">SIsa&nbsp;Qty&nbsp;:&nbsp;</span><span id="sisa_qty_' + n + '" class="small" style="font-size: 11px;"></span>' +

            '</td>';
        var td_col_6 = '<td width="12%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_harga_' + n + '" name="txt_harga_' + n + '" value="0" onkeyup="jumlah(' + n + ')" placeholder="Harga dalam Rupiah" size="15" required /><br />' +

            '</td>';
        var td_col_7 = '<td width="8%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<select class="form-control form-control-sm" id="cmb_kurs_' + n + '" name="cmb_kurs_' + n + '" required="">' +
            '<option value="Rp">Rp IDR</option>' +
            '<option value="USD">&dollar; USD</option>' +
            '<option value="SGD">S&dollar; SGD</option>' +
            '<option value="Euro">&euro; Euro</option>' +
            '<option value="GBP">&pound; GBP</option>' +
            '<option value="Yen">&yen; Yen</option>' +
            '<option value="MYR">RM MYR</option>' +
            '</select><br />' +
            '</td>';
        var td_col_8 = '<td width="5%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_disc_' + n + '" name="txt_disc_' + n + '" size="10" value="0" onkeyup="jumlah(' + n + ')" placeholder="Disc"/>' +

            '</td>';
        var td_col_9 = '<td width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<input type="number" class="form-control form-control-sm" id="txt_biaya_lain_' + n + '" name="txt_biaya_lain_' + n + '" size="15" value="0" onkeyup="jumlah(' + n + ')" placeholder="Biaya Lain"/>' +

            '</td>';
        var td_col_10 = '<td id="txt_ketbiaya_' + n + '" width="10%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea rows="3" class="resizable_textarea form-control form-control-sm" id="txt_keterangan_biaya_lain_' + n + '" name="txt_keterangan_biaya_lain_' + n + '" size="26" placeholder="Keterangan Biaya" onkeypress="saveRinciEnter(event,' + n + ')"></textarea><br />' +

            '</td>'
        var td_col_11 = '<td width="40%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<textarea rows="2" class="resizable_textarea form-control form-control-sm" id="txt_keterangan_rinci_' + n + '" name="txt_keterangan_rinci_' + n + '" size="26" placeholder="Keterangan" onkeypress="saveRinciEnter(event,' + n + ')"></textarea>' +
            '<h6>Jumlah : <span id="hasil_jumlah_' + n + '"></span></h6>' +
            '<input type="hidden" class="form-control form-control-sm" id="txt_jumlah_' + n + '" name="txt_jumlah_" size="15" placeholder="Jumlah"  readonly />' +
            // '<label id="lbl_status_simpan_' + n + '"></label>' +
            '<input type="hidden" id="hidden_id_po_item_' + n + '" name="hidden_id_po_item_' + n + '">' +

            '</td>';
        // var td_col_12 = '<td style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +

        //     '</td>';
        var td_col_13 = '<td width="3%" style="padding-right: 0.2em; padding-left: 0.2em;  padding-top: 2px; padding-bottom: 0.1em;">' +
            '<span style="display:none;" id="habis_' + n + '" class="badge badge-danger">Habis</span>' +
            '<button class="btn btn-xs btn-success fa fa-save" id="btn_simpan_' + n + '" name="btn_simpan_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Simpan" onclick="validasi(' + n + ')" ></button>' +
            '<button style="display:none;" class="btn btn-xs btn-warning fa fa-edit" onclick="ubah(' + n + ')" id="btn_ubah_' + n + '" name="btn_ubah_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Ubah" ></button>' +
            '<button style="display:none;" class="btn btn-xs btn-info fa fa-check" id="btn_update_' + n + '" name="btn_update_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Update" onclick="validasiUpdate(' + n + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-primary mdi mdi-close-thick mt-1" id="btn_cancel_update_' + n + '" name="btn_cancel_update_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Cancel Update"  onclick="cancleUpdate(' + n + ')"></button>' +
            '<button style="display:none;" class="btn btn-xs btn-danger fa fa-trash" id="btn_hapus_' + n + '" name="btn_hapus_' + n + '" type="button" data-toggle="tooltip" data-placement="right" title="Hapus" onclick="hapusRinci(' + n + ')"></button>' +
            '<label id="lbl_status_simpan_' + n + '"></label>' +
            '</td>';
        var form_tutup = '</form>';
        var tr_tutup = '</tr>';
        var lokasi = $('#lokasi').val();

        $('#tbody_rincian').append(tr_buka + form_buka + td_col_1 + td_col_2 + td_col_ + td_col_4 + td_col_5 + td_col_6 + td_col_7 + td_col_8 + td_col_9 + td_col_10 + td_col_11 + td_col_13 + form_tutup + tr_tutup);
        // $('#txt_qty_' + n + ',#txt_harga_' + n + ',#txt_disc_' + n + ',#txt_biaya_lain_' + n + '').number(true, 0);
        $('#txt_qty_' + n + ',#qty_' + n + ',#qty2_' + n + ',#txt_harga_' + n + ',#txt_biaya_lain_' + n + ',#txt_disc_' + n + '').on("keypress keyup blur", function(event) {
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
        hitungqty(n);
        jumlah(n);
        // tittle(n);
        // tool(n);
        return true;
    }


    function tool(n) {


        $('#getspp' + n).tooltip({
            title: tittle,
            html: true
        });
    }

    function tittle(n) {
        var refspp = $('#hidden_no_ref_spp_' + n).val();

        return refspp;
    }

    function hitungqty(id) {
        $('#txt_qty_' + id).keyup(function() {
            var a = $('#txt_qty_' + id).val();
            var b = $('#qty_' + id).val();
            var c = $('#qty2_' + id).val();
            var id_item_spp = $('#id_item_' + id).val();
            var qtyInputan = Number(a);
            var qtyInputan2 = Number(b);
            var qty2n = Number(c);
            // if (qty2n > 0) {
            //     var tmbh = qtyInputan2 - qty2n;
            //     if (qtyInputan > tmbh) {
            //         swal('Melebihi, inputan sebelumnya');
            //         $('#txt_qty_' + id).val(tmbh);
            //     }
            // } else {
            //     if (qtyInputan > qtyInputan2) {
            //         // console.log('benar');
            //         swal("Melebihi QTY SPP!");
            //         $('#txt_qty_' + id).val(qtyInputan2);
            //     } else {
            //         console.log("sip dah");
            //     }
            // }

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Po/cek_qty'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                data: {
                    id_item_spp: id_item_spp
                },
                success: function(data) {
                    console.log(qtyInputan);
                    var qty = data.qty;
                    var qty2 = data.qty2;
                    if (qty == qty2) {
                        if (qtyInputan > qtyInputan2) {
                            swal('Melebihi, inputan sebelumnya');
                            $('#txt_qty_' + id).val(qtyInputan2);
                        } else {
                            console.log('oke deh');
                        }
                    } else {
                        // console.log('oke')
                        var hitung = qty - qty2;
                        var hasil = hitung + qtyInputan2;
                        // console.log('ini hasilnya', hitung);
                        if (qtyInputan > hasil) {
                            swal("Melebihi QTY SPP!");
                            $('#txt_qty_' + id).val(qtyInputan2);

                        } else {
                            console.log('oke deh');
                        }
                    }
                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });


        });
    }


    function jumlah(id) {
        // console.log('jumlahke', no_row)
        $('#txt_qty_' + id + ',#txt_harga_' + id + ',#txt_disc_' + id + ',#txt_biaya_lain_' + id).on("keypress keyup blur", function(event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        // console.log('jumlahke', no_row)
        var pph = $('#pph').val();
        var ppn = $('#ppn').val();
        var qty = $('#txt_qty_' + id).val();
        // console.log(qty)
        var harga = $('#txt_harga_' + id).val();
        var diskon = $('#txt_disc_' + id).val();

        var kodebar = $('#hidden_kode_brg_' + id).val();
        var lokasi = $('#status_lokasi').val();
        if (kodebar == '102505700000002' && lokasi == 'HO') {
            hitungsolar(id);
        } else {
            if (diskon == '') {
                var disc = 0;
            } else {
                var disc = $('#txt_disc_' + id).val();
            }
            var biayalain = $('#txt_biaya_lain_' + id).val();
            if (biayalain == '') {
                var biaya_lain = 0;
            } else {
                var biaya_lain = $('#txt_biaya_lain_' + id).val();
            }

            // mengitung pph dan ppn if true condition
            // var hargaDisc = (parseFloat(harga) * parseInt(disc)) / 100;
            // var hargaSetelahDisc = parseFloat(harga) - parseInt(hargaDisc);

            var hargaDisc = (parseFloat(harga) * parseFloat(disc)) / 100;
            var hargaSetelahDisc = parseFloat(harga) - parseFloat(hargaDisc);

            var qty_harga = qty * hargaSetelahDisc;
            if (pph != 0) {
                // var jml_pph = pph / 100;
                // var total_pph = qty_harga * jml_pph;
                var total_pph = 0;
            } else {
                var total_pph = 0;
            }

            if (ppn == 10) {
                // var jml_ppn = ppn / 100;
                // var total_ppn = qty_harga * jml_ppn;
                var total_ppn = 0;
            } else {
                var total_ppn = 0;
            }

            var nilai = (parseFloat(qty) * parseFloat(hargaSetelahDisc)) + parseFloat(biaya_lain);

            var tot_nilai = nilai + total_pph + total_ppn;

            var jum = tot_nilai.toFixed(2);

            console.log('ini jumlahnya', jum);
            $('#txt_jumlah_' + id).val(jum);
            var bilangan = tot_nilai.toFixed(2);
            var number_string = bilangan.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            $('#jumlah_' + id).val(jum);
            $('#hasil_jumlah_' + id).html(jum);
            $('#hasil_jumlah_' + id).number(true, 2);
            $('#jumlah_' + id).number(true, 2);
        }

    }

    function hitungsolar(id) {

        $('#txt_qty_' + id + ',#txt_harga_' + id + ',#txt_disc_' + id + ',#txt_biaya_lain_' + id).on("keypress keyup blur", function(event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        // console.log('jumlahke', no_row)
        var pph = $('#pph').val();
        var ppn = $('#ppn').val();
        var qty = $('#txt_qty_' + id).val();
        // console.log('nah ini', qty);
        var harga = $('#txt_harga_' + id).val();
        var diskon = $('#txt_disc_' + id).val();
        var ongkir = $('#txt_ongkir_' + id).val();

        var hargaDisc = (parseFloat(harga) * parseFloat(diskon)) / 100;
        var hargaSetelahDisc = parseFloat(harga) - parseFloat(hargaDisc);

        var hargaPlusOngkir = hargaSetelahDisc + parseFloat(ongkir);

        var nilai = parseFloat(hargaPlusOngkir) * parseFloat(qty);
        var jum = nilai.toFixed(2);

        $('#txt_jumlah_' + id).val(jum);

        $('#jumlah_' + id).val(jum);
        $('#hasil_jumlah_' + id).html(jum);
        $('#hasil_jumlah_' + id).number(true, 2);
        $('#jumlah_' + id).number(true, 2);

        // var hargaPpn = parseFloat(harga) * parseFloat(jml_ppn);
        // var hargaDasarPlusPPN = parseFloat(harga) + parseFloat(hargaPpn);

        // //ongkir pluss ppn 10%
        // var ongkirPpn = parseFloat(ongkir) * parseFloat(jml_ppn);
        // var ongkirPlusPPN = parseFloat(ongkir) + parseFloat(ongkirPpn);

        // //untuk pph diambi dari harga dasar 
        // if (pph != 0) {
        //     // var jml_pph = pph / 100;
        //     // var total_pph = qty_harga * jml_pph;
        //     var total_pph = pph;
        // } else {
        //     var total_pph = 0;
        // }

        // var pph_tot = total_pph / 100;
        // var hargadasarpph = parseFloat(harga) * parseFloat(pph_tot);

        // //menjumlahkan harga+ppn ongkir+ppn harga+pph
        // var totalsolar = hargaDasarPlusPPN + ongkirPlusPPN + hargadasarpph;
        // //total solar yg sudah dijumlah x qty
        // var totsolarXqty = parseFloat(totalsolar) * parseFloat(qty);
        // //dikurangi diskon
        // if (diskon == '') {
        //     var disc = 0;
        // } else {
        //     var disc = $('#txt_disc_' + id).val();
        // }

        // var hargaDisc = (parseFloat(totsolarXqty) * parseFloat(disc)) / 100;
        // var hargaSetelahDisc = parseFloat(totsolarXqty) - parseFloat(hargaDisc);

        // var jum = hargaSetelahDisc.toFixed(2);
        // $('#txt_jumlah_' + id).val(jum);
        // $('#jumlah_' + id).val(jum);
        // $('#hasil_jumlah_' + id).html(jum);
        // $('#hasil_jumlah_' + id).number(true, 2);
        // $('#jumlah_' + id).number(true, 2);
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

    function validasiedit() {

        var password = $('#pass').val();
        var pw_session = $('#password').val();
        var pw = $('#pass').val().length;
        var alasan = $('#alasan_edit').val().length;
        if (pw == 0) {
            $('#pass').addClass('parsley-error');
            $('#pwvalidasi').css('display', 'block');
            $('#textpw').html('Password tidak boleh kosong!');
        } else if (alasan == 0) {
            $('#alasan_edit').addClass('parsley-error');
            $('#alasan_valid').css('display', 'block');
        } else {
            $('#pass').removeClass('parsley-error');
            $('#pwvalidasi').css('display', 'none');

            $('#alasan_edit').removeClass('parsley-error');
            $('#alasan_valid').css('display', 'none');

            if (password == pw_session) {
                var i = $('#no_baris').val();
                update_alasan(i);
            } else {
                $('#pass').addClass('parsley-error');
                $('#pwvalidasi').css('display', 'block');
                $('#textpw').html('Password Salah!');
            }
        }
    }

    function update_alasan(i) {
        var noref_ppo = $('#hidden_no_ref_po').val();
        var alasan_edit = $('#alasan_edit').val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('Po/update_alasan') ?>",
            dataType: "JSON",
            beforeSend: function() {},
            data: {
                noref_ppo: noref_ppo,
                alasan: alasan_edit
            },
            success: function(data) {
                $('#alasanedit').modal('hide');
                $('.div_form_1').find('#tgl_po,#select2 ,#cmb_status_bayar, #tmpo_pembayaran, #tmpo_pengiriman, #lks_pengiriman, #lks_pembelian, #no_penawaran, #txt_pemesan, #devisi,#ket_pengiriman,#pph,#ppn,#keterangan,#cmb_dikirim_ke_kebun').removeClass('bg-light');
                $('.div_form_1').find('#tgl_po,#select2 ,#cmb_status_bayar, #tmpo_pembayaran, #tmpo_pengiriman, #lks_pengiriman, #lks_pembelian, #no_penawaran, #txt_pemesan, #devisi,#ket_pengiriman,#pph,#ppn,#keterangan,#cmb_dikirim_ke_kebun').removeAttr('disabled', '');


                $('.div_form_2').find('#cmb_jenis_budget_' + i + ',#txt_merk_' + i + ',#txt_qty_' + i + ', #cmb_kurs_' + i + ', #txt_disc_' + i + ',  #txt_keterangan_biaya_lain_' + i + ',#txt_harga_' + i + ', #txt_biaya_lain_' + i + ',#txt_ongkir_' + i + ', #txt_jumlah_' + i + ', #txt_keterangan_rinci_' + i).removeClass('bg-light');
                $('.div_form_2').find('#cmb_jenis_budget_' + i + ',#txt_merk_' + i + ',#txt_qty_' + i + ', #cmb_kurs_' + i + ', #txt_disc_' + i + ', #txt_keterangan_biaya_lain_' + i + ',#txt_harga_' + i + ', #txt_biaya_lain_' + i + ',#txt_ongkir_' + i + ', #txt_jumlah_' + i + ', #txt_keterangan_rinci_' + i).removeAttr('disabled', '');
                $('.div_form_3').find('#cmb_jenis_budget_' + i + ',#txt_merk_' + i + ',#txt_qty_' + i + ', #cmb_kurs_' + i + ', #txt_disc_' + i + ',  #txt_keterangan_biaya_lain_' + i + ',#txt_harga_' + i + ', #txt_biaya_lain_' + i + ',#txt_ongkir_' + i + ', #txt_jumlah_' + i + ', #txt_keterangan_rinci_' + i).removeClass('bg-light');
                $('.div_form_3').find('#cmb_jenis_budget_' + i + ',#txt_merk_' + i + ',#txt_qty_' + i + ', #cmb_kurs_' + i + ', #txt_disc_' + i + ', #txt_keterangan_biaya_lain_' + i + ',#txt_harga_' + i + ', #txt_biaya_lain_' + i + ',#txt_ongkir_' + i + ', #txt_jumlah_' + i + ', #txt_keterangan_rinci_' + i).removeAttr('disabled', '');

                $('#btn_ubah_' + i).hide();
                $('#btn_hapus_' + i).hide();
                $('#btn_update_' + i).show();
                $('#btn_cancel_update_' + i).show();
                $('#btn_cancel_update_' + i).show();
            },
            error: function(response) {
                alert('KONEKSI TERPUTUS!');
            }
        });
    }

    function ubah(i) {

        $('#alasanedit').modal('show');
        $('#no_baris').val(i);
        $('#pass').val('');
        $('#alasan_edit').val('');



    }

    function hapusRinci(no) {
        // $('#hidden_no_delete').val(no);
        // Swal.fire({
        //     text: "Yakin akan menghapus Data ini?",
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Ya Hapus!'
        // }).then((result) => {
        //     if (result.value) {
        //         deleteData(no);
        //     }
        // });
        var ref_po = $('#hidden_no_ref_po').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/hitungIsiItem'); ?>",
            dataType: "JSON",
            beforeSend: function() {},

            data: {
                ref_po: ref_po
            },
            success: function(data) {
                hapusRinciNew(no, data);
                console.log(data);
            },
            error: function(response) {
                alert('KONEKSI TERPUTUS! ');
            }
        });
    }

    function hapusRinciNew(n, data) {
        if (data != 1) {

            $('#hidden_no_delete').val(n);
            Swal.fire({
                text: "Yakin akan menghapus Data ini?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya Hapus!'
            }).then((result) => {
                if (result.value) {
                    deleteData(n);
                }
            })
        } else {

            Swal.fire({
                text: "Item tinggal 1 apakah akan dibatalkan?",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya Batalkan!'
            }).then((result) => {
                if (result.value) {
                    // deleteData(n);
                    $('#alasanbatal').modal('show');
                    $('#stat_batal').val(n);
                }
            })

        }
    }

    function cekdatapo(no) {
        var noref_po = $('#hidden_no_ref_po').val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/cek_po'); ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#lbl_status_simpan_' + no).empty();
                $('#lbl_status_simpan_' + no).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Hapus Item</label>');
            },

            data: {
                noref_po: noref_po
            },
            success: function(data) {
                // console.log(data)
                if (data == 0) {
                    deletePO(no);
                } else {
                    $('#lbl_status_delete_po').empty();
                    $('#lbl_status_simpan_' + no).empty();
                }
            },
            error: function(request) {
                $('#lbl_status_simpan_' + no).empty();
                alert("KONEKSI TERPUTUS! GAGAL DELETE DATA PO");
                // alert(request.text);
            }
        });
    }

    function deleteData(no) {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/hapus_rinci'); ?>",
            dataType: "JSON",
            beforeSend: function() {
                $('#lbl_status_simpan_' + no).empty();
                $('#lbl_status_simpan_' + no).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Hapus Item</label>');
            },

            data: {
                hidden_id_po_item: $('#hidden_id_po_item_' + no).val(),
                id_item: $('#id_item_' + no).val(),
                hidden_no_ref_spp: $('#hidden_no_ref_spp_' + no).val(),
                qty: $('#txt_qty_' + no).val(),
            },
            success: function(data) {
                $('#tr_' + no).remove();
                swal('Data Berhasil dihapus');
                totalBayar();
                cekdatapo(no);
            },
            error: function(request) {
                $('#lbl_status_simpan_' + no).empty();
                alert(request.responseText);
            }
        });
    }

    function deletePO(no) {
        var nopo = $('#hidden_no_po').val();

        var id_po = $('#hidden_id_po').val();
        var id_ppo = $('#id_item_' + no).val();
        var hidden_no_ref_spp = $('#hidden_no_ref_spp_' + no).val();
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
                nopo: $('#hidden_no_po').val(),
                norefpo: $('#hidden_no_ref_po').val(),
                hidden_id_po_item: $('#hidden_id_po_item_' + no).val(),
                id_item: $('#id_item_' + no).val(),
                hidden_no_ref_spp: $('#hidden_no_ref_spp_' + no).val(),
            },
            success: function(data) {
                // console.log(data);
                location.href = "<?php echo base_url('Po') ?>";
            },
            error: function(request) {
                $('#lbl_status_simpan_' + no).empty();
                alert(request.responseText);
            }
        });
    }

    function validasi(id) {

        var biayalain = $('#txt_biaya_lain_' + id).val();
        var jnbudget = $('#cmb_jenis_budget_' + id).val();
        var merk = $('#txt_merk_' + id).val();
        var hrg = $('#txt_harga_' + id).val();
        var ketBiaya = $('#txt_keterangan_biaya_lain_' + id).val();
        var ketRinci = $('#txt_keterangan_rinci_' + id).val();
        var jml = $('#txt_jumlah_' + id).val();
        var getspp = $('#getspp' + id).val();
        var lokasi = $('#status_lokasi').val();

        if (!getspp) {
            toast('SPP is required!');
            $('#getspp' + id).css({
                "background": "#FFCECE"
            });
        } else if (!merk) {
            toast('Merk is required!');
            $('#txt_merk_' + id).css({
                "background": "#FFCECE"
            });
        } else if (!hrg) {
            toast('Harga is required!');
            $('#txt_harga_' + id).css({
                "background": "#FFCECE"
            });
        } else if (!ketRinci) {
            toast('Keterangan Rinci is required!');
            $('#txt_keterangan_rinci_' + id).css({
                "background": "#FFCECE"
            });
        } else if (jml > 1500000 && lokasi != "HO") {
            toast('User SITE tidak boleh PO lebih dari Rp. 1.500.000!');
            $('#txt_jumlah_' + id).css({
                "background": "#FFCECE"
            });
        } else if (biayalain > 0 && !ketBiaya) {
            toast('Keterangan Biaya is required!');
            $('#txt_keterangan_biaya_lain_' + id).css({
                "background": "#FFCECE"
            });

        } else {
            simpan(id);
        }

        return false;

    }

    function toast(v_text) {
        $.toast({
            position: 'top-right',
            heading: 'Failed!',
            text: v_text + ' ',
            icon: 'error',
            loader: false
        });
    }

    var simpanBaru = true;
    //Simpan Data
    function simpan(id) {
        if (simpanBaru) {

            console.log('simpan pertama', id);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Po/po_edit') ?>",
                dataType: "JSON",
                beforeSend: function() {
                    $('#lbl_status_simpan_' + id).empty();
                    $('#lbl_status_simpan_' + id).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Simpan</label>');
                    if ($.trim($('#hidden_no_po').val()) == '') {
                        $('#lbl_spp_status').empty();
                        $('#lbl_spp_status').append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Generate PO Number</label>');
                    }
                },

                data: {
                    id_ppo: $('#id_ppo' + id).val(),
                    hidden_no_ref_po: $('#hidden_no_ref_po').val(),
                    hidden_no_po: $('#hidden_no_po').val(),
                    hidden_kode_departemen: $('#hidden_kd_departemen_' + id).val(),
                    hidden_departemen: $('#hidden_departemen_' + id).val(),
                    cmb_jenis_budget: $('#cmb_jenis_budget_' + id).val(),
                    txt_no_spp: $('#noppo' + id).val(),
                    hidden_no_ref: $('#hidden_no_ref_spp_' + id).val(),
                    hidden_kode_brg: $('#hidden_kode_brg_' + id).val(),
                    hidden_nama_brg: $('#hidden_nama_brg_' + id).val(),
                    hidden_satuan_brg: $('#hidden_satuan_brg_' + id).val(),
                    txt_qty: $('#txt_qty_' + id).val(),
                    txt_harga: $('#txt_harga_' + id).val(),
                    hidden_kodept: $('#hidden_kd_pt_' + id).val(),
                    hidden_namapt: $('#hidden_nama_pt_' + id).val(),
                    txt_merk: $('#txt_merk_' + id).val(),
                    txt_keterangan_rinci: $('#txt_keterangan_rinci_' + id).val(),
                    txt_disc: $('#txt_disc_' + id).val(),
                    cmb_kurs: $('#cmb_kurs_' + id).val(),
                    txt_biaya_lain: $('#txt_biaya_lain_' + id).val(),
                    txt_keterangan_biaya_lain: $('#txt_keterangan_biaya_lain_' + id).val(),
                    hidden_tanggal: $('#hidden_tgl_spp_' + id).val(),
                    hidden_tglref: $('#hidden_tgl_ref_' + id).val(),
                    id_item: $('#id_item_' + id).val(),
                    txt_jumlah: $('#txt_jumlah_' + id).val(),
                },
                success: function(data) {
                    // console.log(data, 'nah ini');

                    if (data.site_lebih_dari15 == 1) {
                        swal('User SITE tidak boleh PO lebih dari Rp. 1.500.000!');
                        $('#lbl_status_simpan_' + id).empty();
                        $('#lbl_spp_status').empty();
                    } else {
                        $('#lbl_status_simpan_' + id).empty();
                        var no_ref_spp = $('#hidden_no_ref_spp_' + id).val();
                        var id_item_spp = $('#id_item_' + id).val();
                        sisaQtyPO(no_ref_spp, id_item_spp, id);

                        $.toast({
                            position: 'top-right',
                            heading: 'Success',
                            text: 'Berhasil Disimpan!',
                            icon: 'success',
                            loader: false
                        });
                        var refspp = data.refspp;
                        cekdataspp();
                        // sum_qty(noppo, id);

                        $('.div_form_2').find('#getspp' + id + ',#cmb_jenis_budget_' + id + ',#txt_merk_' + id + ' ,#txt_harga_' + id + ', #cmb_kurs_' + id + ', #txt_disc_' + id + ',  #txt_keterangan_biaya_lain_' + id + ',#txt_qty_' + id + ', #txt_biaya_lain_' + id + ',#txt_ongkir_' + id + ', #txt_jumlah_' + id + ', #txt_keterangan_rinci_' + id).addClass('bg-light');
                        $('.div_form_3').find('#getspp' + id + ',#cmb_jenis_budget_' + id + ',#txt_merk_' + id + ' ,#txt_harga_' + id + ', #cmb_kurs_' + id + ', #txt_disc_' + id + ',  #txt_keterangan_biaya_lain_' + id + ',#txt_qty_' + id + ', #txt_biaya_lain_' + id + ',#txt_ongkir_' + id + ', #txt_jumlah_' + id + ', #txt_keterangan_rinci_' + id).addClass('bg-light');
                        $('.div_form_3').find('#getspp' + id + ',#cmb_jenis_budget_' + id + ',#txt_merk_' + id + ' ,#txt_harga_' + id + ', #cmb_kurs_' + id + ', #txt_disc_' + id + ', #txt_keterangan_biaya_lain_' + id + ', #txt_qty_' + id + ', #txt_biaya_lain_' + id + ',#txt_ongkir_' + id + ', #txt_jumlah_' + id + ', #txt_keterangan_rinci_' + id).attr('disabled', '');
                        $('.div_form_2').find('#getspp' + id + ',#cmb_jenis_budget_' + id + ',#txt_merk_' + id + ' ,#txt_harga_' + id + ', #cmb_kurs_' + id + ', #txt_disc_' + id + ', #txt_keterangan_biaya_lain_' + id + ', #txt_qty_' + id + ', #txt_biaya_lain_' + id + ',#txt_ongkir_' + id + ', #txt_jumlah_' + id + ', #txt_keterangan_rinci_' + id).attr('disabled', '');

                        $('#tr_' + id).find('input,textarea,select').attr('disabled', '');
                        $('#tr_' + id).find('input,textarea,select').addClass('form-control bg-light');

                        $('#btn_simpan_' + id).hide();
                        $('#btn_hapus_row_' + id).hide();
                        $('#btn_ubah_' + id).show();
                        $('#btn_hapus_' + id).show();
                        $('#hidden_no_ref_po_' + id).val(data.noref);

                        $('#lbl_spp_status').empty();

                        var idItem = data.id_item;
                        // console.log(idItem);
                        // console.log(id);
                        $('#hidden_id_po_item_' + id).val(idItem);
                        totalBayar();

                        simpanBaru = false;
                    }
                },
                error: function(request) {
                    $('#lbl_status_simpan_' + id).empty();
                    $('#btn_simpan_' + id).hide();
                    $('#btn_hapus_row_' + id).hide();
                    $('#btn_ubah_' + id).show();
                    $('#btn_hapus_' + id).show();
                    alert("KONEKSI TERPUTUS! GAGAL UPDATE PO");
                }
            });
        }
        // simpan keduakalinya
        else {
            console.log('simpan setelah dengan keadaan po dibuat');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Po/po_edit') ?>",
                dataType: "JSON",
                beforeSend: function() {
                    $('#lbl_status_simpan_' + id).empty();
                    $('#lbl_status_simpan_' + id).append('<label style="color:#f0ad4e;"><i class="fa fa-spinner fa-spin" style="font-size:24px;color:#f0ad4e;"></i> Proses Simpan</label>');

                },

                data: {
                    id_ppo: $('#id_ppo' + id).val(),
                    hidden_no_ref_po: $('#hidden_no_ref_po').val(),
                    hidden_no_po: $('#hidden_no_po').val(),
                    hidden_kode_departemen: $('#hidden_kd_departemen_' + id).val(),
                    hidden_departemen: $('#hidden_departemen_' + id).val(),
                    cmb_jenis_budget: $('#cmb_jenis_budget_' + id).val(),
                    txt_no_spp: $('#noppo' + id).val(),
                    hidden_no_ref: $('#hidden_no_ref_spp_' + id).val(),
                    hidden_kode_brg: $('#hidden_kode_brg_' + id).val(),
                    hidden_nama_brg: $('#hidden_nama_brg_' + id).val(),
                    hidden_satuan_brg: $('#hidden_satuan_brg_' + id).val(),
                    txt_qty: $('#txt_qty_' + id).val(),
                    txt_harga: $('#txt_harga_' + id).val(),
                    hidden_kodept: $('#hidden_kd_pt_' + id).val(),
                    hidden_namapt: $('#hidden_nama_pt_' + id).val(),
                    txt_merk: $('#txt_merk_' + id).val(),
                    txt_keterangan_rinci: $('#txt_keterangan_rinci_' + id).val(),
                    txt_disc: $('#txt_disc_' + id).val(),
                    cmb_kurs: $('#cmb_kurs_' + id).val(),
                    txt_biaya_lain: $('#txt_biaya_lain_' + id).val(),
                    txt_keterangan_biaya_lain: $('#txt_keterangan_biaya_lain_' + id).val(),
                    hidden_tanggal: $('#hidden_tgl_spp_' + id).val(),
                    hidden_tglref: $('#hidden_tgl_ref_' + id).val(),
                    id_item: $('#id_item_' + id).val(),
                    txt_jumlah: $('#txt_jumlah_' + id).val(),
                },
                success: function(data) {

                    if ((data.site_lebih_dari15 == 1)) {
                        swal('User SITE tidak boleh PO lebih dari Rp. 1.500.000!');
                        $('#lbl_status_simpan_' + id).empty();
                        $('#lbl_spp_status').empty();
                    } else {
                        $('#lbl_status_simpan_' + id).empty();
                        var no_ref_spp = $('#hidden_no_ref_spp_' + id).val();
                        var id_item_spp = $('#id_item_' + id).val();
                        sisaQtyPO(no_ref_spp, id_item_spp, id);

                        $.toast({
                            position: 'top-right',
                            heading: 'Success',
                            text: 'Berhasil Disimpan!',
                            icon: 'success',
                            loader: false
                        });
                        var refspp = data.refspp;
                        cekdataspp(id);
                        // sum_qty(noppo, id);

                        $('.div_form_2').find('#getspp' + id + ',#cmb_jenis_budget_' + id + ',#txt_merk_' + id + ' ,#txt_harga_' + id + ', #cmb_kurs_' + id + ', #txt_disc_' + id + ',  #txt_keterangan_biaya_lain_' + id + ',#txt_qty_' + id + ', #txt_biaya_lain_' + id + ', #txt_jumlah_' + id + ', #txt_keterangan_rinci_' + id).addClass('bg-light');
                        $('.div_form_3').find('#getspp' + id + ',#cmb_jenis_budget_' + id + ',#txt_merk_' + id + ' ,#txt_harga_' + id + ', #cmb_kurs_' + id + ', #txt_disc_' + id + ',  #txt_keterangan_biaya_lain_' + id + ',#txt_qty_' + id + ', #txt_biaya_lain_' + id + ', #txt_jumlah_' + id + ', #txt_keterangan_rinci_' + id).addClass('bg-light');
                        $('.div_form_3').find('#getspp' + id + ',#cmb_jenis_budget_' + id + ',#txt_merk_' + id + ' ,#txt_harga_' + id + ', #cmb_kurs_' + id + ', #txt_disc_' + id + ', #txt_keterangan_biaya_lain_' + id + ', #txt_qty_' + id + ', #txt_biaya_lain_' + id + ', #txt_jumlah_' + id + ', #txt_keterangan_rinci_' + id).attr('disabled', '');
                        $('.div_form_2').find('#getspp' + id + ',#cmb_jenis_budget_' + id + ',#txt_merk_' + id + ' ,#txt_harga_' + id + ', #cmb_kurs_' + id + ', #txt_disc_' + id + ', #txt_keterangan_biaya_lain_' + id + ', #txt_qty_' + id + ', #txt_biaya_lain_' + id + ', #txt_jumlah_' + id + ', #txt_keterangan_rinci_' + id).attr('disabled', '');

                        $('#tr_' + id).find('input,textarea,select').prop('disabled', true);
                        $('#tr_' + id).find('input,textarea,select').addClass('form-control bg-light');

                        $('#btn_simpan_' + id).hide();
                        $('#btn_hapus_row_' + id).hide();
                        $('#btn_ubah_' + id).show();
                        $('#btn_hapus_' + id).show();
                        $('#hidden_no_ref_po_' + id).val(data.noref);
                        // console.log(response);

                        $('#lbl_spp_status').empty();

                        // $('#hidden_id_po').val(data.id_po);
                        $('#hidden_id_po_item_' + id).val(data.id_item);
                        totalBayar();

                        // simpanBaru = false;
                    }
                },
                error: function(request) {
                    $('#lbl_status_simpan_' + id).empty();
                    $('#btn_simpan_' + id).hide();
                    $('#btn_hapus_row_' + id).hide();
                    $('#btn_ubah_' + id).show();
                    $('#btn_hapus_' + id).show();
                    alert("KONEKSI TERPUTUS! GAGAL UPDATE PO");
                }
            });

        }

    }

    function cekdataspp(id) {
        var refspp = $('#hidden_no_ref_spp_' + id).val();
        console.log(refspp);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/cekdataspp'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                refspp: refspp
            },
            success: function(data) {
                var a = data.data1;
                var b = data.data2;

                // // console.log(item);
                // console.log(a.jmlhSPP1, b.jmlhSPP2);
                if (a.jmlhSPP1 == 0) {
                    updatePPO(id);
                    // console.log('oke update ppo');
                } else {
                    console.log('field po belum 0 semua');
                }

            },
            error: function(request) {
                alert("KONEKSI TERPUTUS!");
            }
        });
    }

    function updatePPO(id) {
        var refspp = $('#hidden_no_ref_spp_' + id).val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Po/updatePPO'); ?>",
            dataType: "JSON",
            beforeSend: function() {},
            cache: false,
            data: {
                refspp: refspp
            },
            success: function(data) {
                console.log('oke field ppo berhasil diupdate', data);
            },
            error: function(request) {
                alert("KONEKSI TERPUTUS!");
            }
        });
    }
</script>