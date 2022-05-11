<label id="lbl_spp_status" name="lbl_spp_status">
    <font face="Verdana" size="2.5">No. PO : ... No. Ref PO : ...</font>
</label>
<h6 id="h4_no_po" name="h4_no_po"></h6>
<h6 id="h4_no_ref_po" name="h4_no_ref_po"></h6>
<input type="hidden" id="hidden_no_po" name="hidden_no_po">
<input type="hidden" id="hidden_id_po" name="hidden_id_po">
<input type="hidden" id="hidden_no_ref_po" name="hidden_no_ref_po">
<input type="hidden" value="<?= $sesi_sl; ?>" id="lokasi" name="lokasi">
<div class="table-responsive mt-0">
    <table id="tableRinciPO" class="table table-striped table-bordered">
        <thead>
            <tr>
                <?php
                switch ($sesi_sl) {
                    case 'HO':
                ?>
                        <th>#</th>
                        <th width="250px">
                            <font face="Verdana" size="2.5">SPP</font>
                        </th>
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

                <th>
                    <font face="Verdana" size="2.5">Jenis Budget</font>
                </th>
                <th width="500px">
                    <font face="Verdana" size="2.5">Nama & Kode Barang</font>
                </th>
                <th>
                    <font face="Verdana" size="2.5">Merk</font>
                </th>
                <th>
                    <font face="Verdana" size="2.5">Qty</font>
                </th>

                <th>
                    <font face="Verdana" size="2.5">Harga</font>
                </th>
                <th>
                    <font face="Verdana" size="2.5">Kurs</font>
                </th>
                <th>
                    <font face="Verdana" size="2.5">Disc <span>%</span></font>
                </th>
                <th>
                    <font face="Verdana" size="2.5">Biaya Lainnya</font>
                </th>
                <th>
                    <font face="Verdana" size="2.5">Ket.&nbsp;Biaya</font>
                </th>

                <th>
                    <font face="Verdana" size="2.5">Keterangan</font>
                </th>
                <th>
                    <font face="Verdana" size="2.5">Jumlah Rp</font>
                </th>
                <th>
                    <font face="Verdana" size="2.5">Aksi</font>
                </th>
            </tr>
        </thead>
        <tbody id="tbody_rincian" name="tbody_rincian">

        </tbody>

    </table>
</div>