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