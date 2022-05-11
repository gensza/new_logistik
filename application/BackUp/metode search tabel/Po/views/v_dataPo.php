<!-- PAGE TITLE -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h2 class="page-title"><?= $title ?></h2>
        </div>
    </div>
</div>
<!-- end page title -->

<!-- start row-->
<div class="row justify-content-center">
    <div class="col-md">
        <div class="widget-rounded-circle card-box">
            <h4 class="header-title mb-3">Data PO</h4>
            <hr>
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <!-- <div data-parsley-validate class="form-horizontal form-label-left" id="div_filter">
						<div class="form-group">
							<div class="col-md-2 col-sm-6 col-xs-12"></div>
							<div class="col-md-2 col-sm-6 col-xs-12">
								<div class="radio">
									<label>
										<input type="radio" value="Semua" id="rbt_filter_semua" name="rbt_filter" checked> Semua PO
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="HO" id="rbt_filter_ho" name="rbt_filter"> HO
									</label>
								</div>
							</div>
							<div class="col-md-2 col-sm-6 col-xs-12">
								<div class="radio">
									<label>
										<input type="radio" value="PKS" id="rbt_filter_pks" name="rbt_filter"> PKS
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="SITE" id="rbt_filter_site" name="rbt_filter"> SITE
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="RO" id="rbt_filter_ro" name="rbt_filter"> RO
									</label>
								</div>
							</div>
							<div class="col-md-2 col-sm-6 col-xs-12">
								<div class="radio">
									<label>
										<input type="radio" value="1" id="rbt_filter_kebun1" name="rbt_filter"> Kebun 1
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="2" id="rbt_filter_kebun2" name="rbt_filter"> Kebun 2
									</label>
								</div>
							</div>
							<div class="col-md-2 col-sm-6 col-xs-12">
								<div class="radio">
									<label>
										<input type="radio" value="3" id="rbt_filter_kebun3" name="rbt_filter"> Kebun 3
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="4" id="rbt_filter_kebun4" name="rbt_filter"> Kebun 4
									</label>
								</div>
							</div>
							<div class="col-md-2 col-sm-6 col-xs-12"></div>
						</div>
					</div> -->
                            <table id="tableListPO" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No.</th>
                                        <th>No. Ref</th>
                                        <th>No. PO</th>
                                        <th>Tgl. PO</th>

                                        <th>Supplier</th>
                                        <th>Item Barang</th>
                                        <th>Ket</th>
                                        <th>Terbayar</th>
                                    </tr>
                                </thead>

                                <tbody id="tbody_list_po">
                                    <tr>
                                        <td></td>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>x</td>

                                        <td>x</td>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>x</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            <br />
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tableListPO').DataTable();
    });
</script>