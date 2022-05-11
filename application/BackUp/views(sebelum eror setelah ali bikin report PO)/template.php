<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Aplikasi Logistik 2021</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/images/favicon.ico">

    <!-- third party css -->
    <link href="<?php echo base_url() ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="<?php echo base_url() ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url() ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />


    <!-- Tour css -->
    <link href="<?php echo base_url() ?>assets/libs/hopscotch/css/hopscotch.min.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="<?php echo base_url() ?>assets/css/bootstrap-creative.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/app-creative.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="<?php echo base_url() ?>assets/css/bootstrap-creative-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="<?php echo base_url() ?>assets/css/app-creative-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> -->
    <!-- icons -->
    <link href="<?php echo base_url() ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/libs/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/qrcode-reader.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


</head>

<body class="loading" data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <div class="container">
        <!-- Mobile menu toggle (Horizontal Layout)-->
        <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a>
        <!-- End mobile menu toggle-->
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        <div class="topnav shadow-lg mt-0">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">

                        <ul class="navbar-nav">


                            <li class="nav-item ">
                                <a class="nav-link dropdown-toggle arrow-none" href="<?= base_url('Home') ?>">
                                    <i class="fe-airplay mr-1"></i>
                                    <font face="Verdana" size="2.5">Dashboards</font>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fe-grid mr-1"></i>
                                    <font face="Verdana" size="2.5">Menu Transaksi</font>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-apps">

                                    <!-- <a href="apps-calendar.html" class="dropdown-item"><i class="fe-calendar mr-1"></i> Calendar</a>
                                        <a href="apps-chat.html" class="dropdown-item"><i class="fe-message-square mr-1"></i> Chat</a> -->
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-clipboard-multiple-outline mr-1"></i>
                                            <font face="Verdana" size="2.5">SPP</font>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                            <a href="<?= base_url('Spp/sppBaru') ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">SPP Baru</font>
                                            </a>
                                            <a href="<?= base_url('Spp/sppApproval') ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">SPP
                                                    Approval</font>
                                            </a>
                                            <a href="<?= base_url('Spp'); ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Semua Data
                                                    SPP</font>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-clipboard-arrow-up-outline mr-1"></i>
                                            <font face="Verdana" size="2.5">PO</font>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-email">
                                            <a href="<?= base_url('Po/input') ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Input PO</font>
                                            </a>
                                            <a href="<?= base_url('Po') ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Data PO</font>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-crm" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-clipboard-arrow-down-outline mr-1"></i>
                                            <font face="Verdana" size="2.5">LPB</font>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-crm">
                                            <a href="<?= base_url('Lpb/input'); ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Input LPB</font>
                                            </a>
                                            <a href="<?= base_url('Lpb'); ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Data LPB</font>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-crm" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-vote-outline mr-1"></i>
                                            <font face="Verdana" size="2.5"> BPB</font>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-crm">
                                            <a href="<?= base_url('Bpb/input'); ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Input BPB</font>
                                            </a>
                                            <a href="<?= base_url('Bpb'); ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Data BPB</font>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-crm" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-clipboard-arrow-right-outline mr-1"></i>
                                            <font face="Verdana" size="2.5"> BKB</font>
                                            <div class="arrow-down">
                                            </div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-crm">
                                            <a href="<?= base_url('Bkb/input'); ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Input BKB</font>
                                            </a>
                                            <a href="<?= base_url('Bkb'); ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Data BKB</font>
                                            </a>
                                            <a href="<?= base_url('Bkb/approval_rev_qty'); ?>" class="dropdown-item">Approval Rev Qty</font></a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-crm" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-cash-multiple mr-1"></i>
                                            <font face="Verdana" size="2.5"> PP</font>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-crm">
                                            <a href="<?= base_url('Pp/input'); ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Input PP</font>
                                            </a>
                                            <a href="<?= base_url('Pp'); ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Data PP</font>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-crm" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-backburger mr-1"></i>
                                            <font face="Verdana" size="2.5">Retur</font>
                                            <div class="arrow-down">
                                            </div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-crm">
                                            <a href="<?= base_url('Retur/input') ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Retur BKB</font>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-file-multiple-outline mr-1"></i>
                                    <font face="Verdana" size="2.5">Laporan </font>
                                    <div class="arrow-down">
                                    </div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-components">
                                    <a href="<?= base_url('Laporan/lapBarang') ?>" class="dropdown-item"><i class="mdi mdi-file-table-outline mr-1"></i>
                                        <font face="Verdana" size="2.5">Laporan Barang</font>
                                    </a>
                                    <a href="#" onclick="lap_spp();" class="dropdown-item"><i class="mdi mdi-file-outline mr-1"></i>
                                        <font face="Verdana" size="2.5">Surat Permintaan Pembelian (SPP)</font>
                                    </a>
                                    <a href="#" onclick="lap_po();" class="dropdown-item"><i class="mdi mdi-file-upload-outline mr-1"></i>
                                        <font face="Verdana" size="2.5">Purchase Order (PO)</font>
                                    </a>

                                    <a href="widgets.html" class="dropdown-item"><i class="mdi mdi-file-download-outline mr-1"></i>
                                        <font face="Verdana" size="2.5">Permohonan Pembayaran (PP)</font>
                                    </a>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fe-bar-chart-2 mr-1"></i>
                                            <font face="Verdana" size="2.5">Analisa</font>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-form">
                                            <a href="forms-elements.html" class="dropdown-item">
                                                <font face="Verdana" size="2.5">SPP vs PO</font>
                                            </a>
                                            <a href="forms-advanced.html" class="dropdown-item">
                                                <font face="Verdana" size="2.5">LPB vs PO</font>
                                            </a>
                                            <a href="forms-validation.html" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Durasi Transaksi</font>
                                            </a>
                                        </div>
                                    </div>
                                    <a href="widgets.html" class="dropdown-item"><i class="fe-file-plus  mr-1"></i>
                                        <font face="Verdana" size="2.5">Laporan Penerimaan Barang (LPB)</font>
                                    </a>
                                    <a href="widgets.html" class="dropdown-item"><i class="fe-file-minus mr-1"></i>
                                        <font face="Verdana" size="2.5">Bukti Keluar Barang (BKB)</font>
                                    </a>
                                    <a href="widgets.html" class="dropdown-item"><i class="fe-clipboard mr-1"></i>
                                        <font face="Verdana" size="2.5">Laporan Register Stok Harian</font>
                                    </a>
                                    <a href="widgets.html" class="dropdown-item"><i class="fe-check-square mr-1"></i>
                                        <font face="Verdana" size="2.5">Laporan Rincian Stok</font>
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fe-layers mr-1"></i>
                                    <font face="Verdana" size="2.5">Posting</font>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-components">
                                    <a href="widgets.html" class="dropdown-item"><i class="fe-repeat mr-1"></i>
                                        <font face="Verdana" size="2.5">Hitung Ulang Stok</font>
                                    </a>
                                    <a href="widgets.html" class="dropdown-item"><i class="fe-send mr-1"></i>
                                        <font face="Verdana" size="2.5">Transfer Transaksi ke GL</font>
                                    </a>
                                    <a href="widgets.html" class="dropdown-item"><i class="fe-book mr-1"></i>
                                        <font face="Verdana" size="2.5">Tutup Buku</font>
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fe-settings mr-1"></i>
                                    <font face="Verdana" size="2.5">Master</font>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <a href="<?= base_url('Barang') ?>" class="dropdown-item"><i class="fe-codepen mr-1"></i>
                                        <font face="Verdana" size="2.5">Kode Barang</font>
                                    </a>
                                    <a href="<?= base_url('Stok') ?>" class="dropdown-item"><i class="fe-edit mr-1"></i>
                                        <font face="Verdana" size="2.5">Stok Awal</font>
                                    </a>
                                    <a href="<?= base_url('Stok/stok_harian') ?>" class="dropdown-item"><i class="fe-edit mr-1"></i>
                                        <font face="Verdana" size="2.5">Stok Awal Harian</font>
                                    </a>
                                    <a href="widgets.html" class="dropdown-item"><i class="fe-check-square mr-1"></i>
                                        <font face="Verdana" size="2.5">Laporan Rinci Stok</font>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle arrow-none" href="<?= base_url('Login/logout') ?>">
                                    <i class="mdi mdi-logout mr-1"></i>
                                    <font face="Verdana" size="2.5">Logout</font>
                                </a>
                            </li>

                        </ul> <!-- end navbar-->
                    </div> <!-- end .collapsed-->
                    <ul class="navbar-nav">
                        <li class="dropdown notification-list topbar-dropdown arrow-none">
                            <a class="collapse navbar-collapse nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" style="color: dodgerblue;" aria-haspopup="false" aria-expanded="false">
                                <img src="http://ubold-laravel.coderthemes.com/assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle mr-2">
                                <font face="Verdana" color="" size="2.5">Hai, <?= $this->session->userdata('user'); ?></font><i class="ml-1 mdi mdi-chevron-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-calendar"></i>
                                    <span>Periode : <?= $this->session->userdata('ym_periode'); ?></span>
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>

            </div> <!-- end container-fluid -->
        </div> <!-- end topnav-->


        <!-- modal lap PO -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="modalLapPO">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Laporan PO</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Company *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control" id="cmb_company" name="cmb_company" required="">
                                    <option value="" selected>-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Periode *</font>
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="txt_periode2" name="txt_periode2">
                                <input type="hidden" class="form-control" id="tanggalawalPO" name="tanggalawalPO">
                                <input type="hidden" class="form-control" id="tanggalakhirPO" name="tanggalakhirPO">
                            </div>
                        </div>

                        <div class="form-group">&nbsp;&nbsp;&nbsp;
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" id="rbt_register" value="register" name="rbt_pilihan1" checked="">
                                <label for="rbt_register">Register PO</label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" id="rbt_cetakan" value="cetakan" name="rbt_pilihan1">
                                <label for="rbt_cetakan">Cetakan</label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" id="rbt_cash" value="cash" name="rbt_pilihan1">
                                <label for="rbt_cash">PO ( Cash )</label>
                            </div>
                        </div>
                        <div class="form-group">&nbsp;&nbsp;&nbsp;
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" id="rbt_po_lokal_r" value="po_lokal_r" name="rbt_pilihan1" checked="">
                                <label for="rbt_po_lokal_r"> PO Lokal (Register)</label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" id="rbt_po_lokal_t" value="po_lokal_t" name="rbt_pilihan1">
                                <label for="rbt_po_lokal_t">PO Lokal (Total PO)</label>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="tampilkanpo()">Tampilkan</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" class="close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal lap PO -->

        <!-- modal lap SPP -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="modalLapSpp">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Laporan SPP</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">PT *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control" id="cmb_devisi" name="cmb_devisi" required="">
                                    <option value="" selected>-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">BAGIAN *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control" id="cmb_dept" name="cmb_dept" required="">
                                    <option value="" selected>-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Periode *</font>
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="txt_periode" name="txt_periode">
                                <input type="hidden" class="form-control" id="tanggalawal" name="tanggalawalPO">
                                <input type="hidden" class="form-control" id="tanggalakhir" name="tanggalakhirPO">
                            </div>
                        </div>

                        <div class="form-group">&nbsp;&nbsp;&nbsp;
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="semua" id="rbt_semua" name="rbt_pilihan" checked>
                                <label for="rbt_semua">Semua SPP</label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="proses" id="rbt_proses" name="rbt_pilihan">
                                <label for="rbt_proses">Dalam Proses</label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="setujui" id="rbt_setujui" name="rbt_pilihan">
                                <label for="rbt_setujui">Disetujui</label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="tampilkanpo()">Tampilkan</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" class="close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal lap PO -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <!-- JQuery -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
        <script src="<?php echo base_url() ?>assets/js/vendor.min.js"></script>
        <script src="<?php echo base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>


        <!-- Sweet alert init js-->
        <script src="<?php echo base_url() ?>assets/js/pages/sweet-alerts.init.js"></script>

        <!-- Tost-->
        <script src="<?php echo base_url() ?>assets/libs/jquery-toast-plugin/jquery.toast.min.js"></script>

        <!-- toastr init js-->
        <script src="<?php echo base_url() ?>assets/js/pages/toastr.init.js"></script>

        <script src="<?php echo base_url() ?>assets/libs/select2/js/select2.min.js"></script>

        <!-- Tour page js -->
        <script src="<?php echo base_url() ?>assets/libs/hopscotch/js/hopscotch.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

        <script src="<?php echo base_url() ?>assets/dist/js/qrcode-reader.min.js?v=20190604"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script src="<?php echo base_url() ?>assets/js/instascan.min.js"></script>

        <!-- Terbilang JS -->
        <script src="<?php echo base_url(); ?>assets/terbilang/terbilang.js"></script>

        <!-- JQuery Number -->
        <script src="<?php echo base_url(); ?>assets/jquerynumber/jquery.number.js"></script>

        <div class="content-page mt-1">
            <div class="content">

                <!-- Start Content-->

                <!-- memanggil library unt  uk memanggil content -->

                <?php echo $contents ?>


            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <font face="Verdana" size="2.5">MIS</font>
                            @
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://msalgroup.com">
                                <font face="Verdana" size="2.5">MSAL GROUP</font>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link py-2" data-toggle="tab" href="#chat-tab" role="tab">
                        <i class="mdi mdi-message-text d-block font-22 my-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-2" data-toggle="tab" href="#tasks-tab" role="tab">
                        <i class="mdi mdi-format-list-checkbox d-block font-22 my-1"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link py-2 active" data-toggle="tab" href="#settings-tab" role="tab">
                        <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content pt-0">
                <div class="tab-pane" id="chat-tab" role="tabpanel">

                    <form class="search-bar p-3">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </form>

                    <h6 class="font-weight-medium px-3 mt-2 text-uppercase">Group Chats</h6>

                    <div class="p-2">
                        <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                            <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-success"></i>
                            <span class="mb-0 mt-1">App Development</span>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                            <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-warning"></i>
                            <span class="mb-0 mt-1">Office Work</span>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item pl-3 mb-2 d-block">
                            <i class="mdi mdi-checkbox-blank-circle-outline mr-1 text-danger"></i>
                            <span class="mb-0 mt-1">Personal Group</span>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item pl-3 d-block">
                            <i class="mdi mdi-checkbox-blank-circle-outline mr-1"></i>
                            <span class="mb-0 mt-1">Freelance</span>
                        </a>
                    </div>

                    <h6 class="font-weight-medium px-3 mt-3 text-uppercase">Favourites <a href="javascript: void(0);" class="font-18 text-danger"><i class="float-right mdi mdi-plus-circle"></i></a></h6>

                    <div class="p-2">
                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?php echo base_url() ?>assets/images/users/user-10.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status online"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Andrew Mackie</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?php echo base_url() ?>assets/images/users/user-1.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status away"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Rory Dalyell</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">To an English person, it will seem like simplified
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?php echo base_url() ?>assets/images/users/user-9.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status busy"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Jaxon Dunhill</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">To achieve this, it would be necessary.</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <h6 class="font-weight-medium px-3 mt-3 text-uppercase">Other Chats <a href="javascript: void(0);" class="font-18 text-danger"><i class="float-right mdi mdi-plus-circle"></i></a></h6>

                    <div class="p-2 pb-4">
                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?php echo base_url() ?>assets/images/users/user-2.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status online"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Jackson Therry</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">Everyone realizes why a new common language.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?php echo base_url() ?>assets/images/users/user-4.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status away"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Charles Deakin</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">The languages only differ in their grammar.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?php echo base_url() ?>assets/images/users/user-5.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status online"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Ryan Salting</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">If several languages coalesce the grammar of the
                                            resulting.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?php echo base_url() ?>assets/images/users/user-6.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status online"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Sean Howse</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?php echo base_url() ?>assets/images/users/user-7.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status busy"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Dean Coward</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">The new common language will be more simple.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset notification-item">
                            <div class="media">
                                <div class="position-relative mr-2">
                                    <img src="<?php echo base_url() ?>assets/images/users/user-8.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    <i class="mdi mdi-circle user-status away"></i>
                                </div>
                                <div class="media-body overflow-hidden">
                                    <h6 class="mt-0 mb-1 font-14">Hayley East</h6>
                                    <div class="font-13 text-muted">
                                        <p class="mb-0 text-truncate">One could refuse to pay expensive translators.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="text-center mt-3">
                            <a href="javascript:void(0);" class="btn btn-sm btn-white">
                                <i class="mdi mdi-spin mdi-loading mr-2"></i>
                                Load more
                            </a>
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="tasks-tab" role="tabpanel">
                    <h6 class="font-weight-medium p-3 m-0 text-uppercase">Working Tasks</h6>
                    <div class="px-2">
                        <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                            <p class="text-muted mb-0">App Development<span class="float-right">75%</span></p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                            <p class="text-muted mb-0">Database Repair<span class="float-right">37%</span></p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                            <p class="text-muted mb-0">Backup Create<span class="float-right">52%</span></p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 52%" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a>
                    </div>

                    <h6 class="font-weight-medium px-3 mb-0 mt-4 text-uppercase">Upcoming Tasks</h6>

                    <div class="p-2">
                        <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                            <p class="text-muted mb-0">Sales Reporting<span class="float-right">12%</span></p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                            <p class="text-muted mb-0">Redesign Website<span class="float-right">67%</span></p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a>

                        <a href="javascript: void(0);" class="text-reset item-hovered d-block p-2">
                            <p class="text-muted mb-0">New Admin Design<span class="float-right">84%</span></p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 84%" aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a>
                    </div>

                    <div class="p-3 mt-2">
                        <a href="javascript: void(0);" class="btn btn-success btn-block waves-effect waves-light">Create
                            Task</a>
                    </div>

                </div>
                <div class="tab-pane active" id="settings-tab" role="tabpanel">
                    <h6 class="font-weight-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                        <span class="d-block py-1">Theme Settings</span>
                    </h6>

                    <div class="p-3">
                        <div class="alert alert-warning" role="alert">
                            <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                        </div>

                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light" id="light-mode-check" checked />
                            <label class="custom-control-label" for="light-mode-check">Light Mode</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark" id="dark-mode-check" />
                            <label class="custom-control-label" for="dark-mode-check">Dark Mode</label>
                        </div>

                        <!-- Width -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Width</h6>
                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check" checked />
                            <label class="custom-control-label" for="fluid-check">Fluid</label>
                        </div>
                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="width" value="boxed" id="boxed-check" />
                            <label class="custom-control-label" for="boxed-check">Boxed</label>
                        </div>

                        <!-- Menu positions -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Layout Positon</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="menus-position" value="fixed" id="fixed-check" checked />
                            <label class="custom-control-label" for="fixed-check">Fixed</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="menus-position" value="scrollable" id="scrollable-check" />
                            <label class="custom-control-label" for="scrollable-check">Scrollable</label>
                        </div>

                        <!-- Topbar -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="topbar-color" value="dark" id="darktopbar-check" checked />
                            <label class="custom-control-label" for="darktopbar-check">Dark</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="topbar-color" value="light" id="lighttopbar-check" />
                            <label class="custom-control-label" for="lighttopbar-check">Light</label>
                        </div>


                        <button class="btn btn-primary btn-block mt-4" id="resetBtn">Reset to Default</button>

                        <a href="https://1.envato.market/uboldadmin" class="btn btn-danger btn-block mt-3" target="_blank"><i class="mdi mdi-basket mr-1"></i> Purchase Now</a>

                    </div>

                </div>
            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->

    <!-- third party js -->
    <script src="<?php echo base_url() ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
    </script>
    <script src="<?php echo base_url() ?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/pdfmake/build/vfs_fonts.js"></script>

    <!-- plugin autonumeric -->
    <!-- Plugins js -->
    <script src="<?php echo base_url() ?>assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/autonumeric/autoNumeric-min.js"></script>

    <!-- Init js-->
    <script src="<?php echo base_url() ?>assets/js/pages/form-masks.init.js"></script>

    <!-- Datatables init -->
    <script src="<?php echo base_url() ?>assets/js/pages/datatables.init.js"></script>

    <!-- App js -->
    <script src="<?php echo base_url() ?>assets/js/app.min.js"></script>

    <script type="text/javascript">
        function lap_po() {
            $('#modalLapPO').modal('show');
            $('#cmb_company').empty();
            pilihCompany();
            pilihTanggal1();
        }

        function lap_spp() {
            $('#modalLapSpp').modal('show');
            $('#cmb_company').empty();
            pilihDevisi();
            pilihTanggal();
        }

        function pilihCompany() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Laporan/cari_devisi'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: '',
                success: function(data) {
                    var stl = '<?= $this->session->userdata('status_lokasi'); ?>';
                    if (stl == 'HO') {
                        var opsi_cmb_company = '<option value="Semua">SEMUA</option>';
                        $('#cmb_company').append(opsi_cmb_company);
                    }
                    $.each(data, function(index) {
                        var opsi_cmb_company = '<option value="' + data[index].kodetxt + '">' + data[index].PT + '</option>';
                        $('#cmb_company').append(opsi_cmb_company);
                    });
                },
                error: function(request) {
                    alert(request.responseText);
                }
            });
        }

        function pilihDevisi() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Laporan/cari_devisi'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: '',
                success: function(data) {
                    console.log(data);
                    var stl = '<?= $this->session->userdata('status_lokasi'); ?>';
                    if (stl == 'HO') {
                        var opsi_cmb_all = '<option value="Semua">SEMUA</option>';
                        $('#cmb_devisi').append(opsi_cmb_all);
                    }
                    $.each(data, function(index) {
                        var opsi_cmb_devisi = '<option value="' + data[index].kodetxt + '">' + data[index].PT + '</option>';
                        $('#cmb_devisi').append(opsi_cmb_devisi);
                    });
                },
                error: function(request) {
                    alert(request.responseText);
                }
            });
        }

        function pilihTanggal1() {
            var d = new Date();
            var today = (26) + '/' + d.getMonth() + '/' + d.getFullYear();
            var today1 = (25) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
            $('#tanggalawalPO').val(today);
            $('#tanggalakhirPO').val(today1);
            $('#txt_periode2').val(today + ' - ' +
                today1);

            $('#txt_periode2').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
            }, function(start, end, label) {
                $('#tanggalawalPO').val(start.format('DD/MM/YYYY'));
                $('#tanggalakhirPO').val(end.format('DD/MM/YYYY'));

                // console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
            });
        }

        function pilihTanggal() {
            var d = new Date();
            var today = (26) + '/' + d.getMonth() + '/' + d.getFullYear();
            var today1 = (25) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
            $('#tanggalawalPO').val(today);
            $('#tanggalakhirPO').val(today1);
            $('#txt_periode').val(today + ' - ' +
                today1);

            $('#txt_periode').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
            }, function(start, end, label) {
                $('#tanggalawal').val(start.format('DD/MM/YYYY'));
                $('#tanggalakhir').val(end.format('DD/MM/YYYY'));

                // console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
            });
        }

        function tampilkanpo() {
            var cmb_company = $('#cmb_company').val();
            var starDate = $('#tanggalawalPO').val();
            var endDate = $('#tanggalakhirPO').val();
            var rbt_pilihan1 = $("input[name='rbt_pilihan1']:checked").val();
            console.log(cmb_company, starDate, endDate, rbt_pilihan1);

            if (rbt_pilihan1 == 'register') {
                window.open('<?= site_url("Laporan/print_lap_po_register"); ?>/' + cmb_company + '/' + starDate + '/' + endDate);
            } else if (rbt_pilihan1 == 'po_lokal_r') {
                window.open('<?= site_url("laporan/print_lap_po_lokal_r"); ?>/' + cmb_company + '/' + txt_periode2 + '/' + txt_periode3);
            } else if (rbt_pilihan1 == 'cash') {
                window.open('<?= site_url("laporan/print_lap_po_cash"); ?>/' + cmb_company + '/' + txt_periode2 + '/' + txt_periode3);
            } else if (rbt_pilihan1 == 'po_lokal_t') {
                window.open('<?= site_url("laporan/print_lap_po_lokal_t"); ?>/' + cmb_company + '/' + txt_periode2 + '/' + txt_periode3);
            } else if (rbt_pilihan1 == 'cetakan') {
                $('#modalListLapPO').modal('show');
                $('#tableListLapPOCetakan').DataTable().destroy();
                $('#tableListLapPOCetakan').DataTable({
                    "paging": true,
                    "scrollY": false,
                    "scrollX": false,
                    "searching": true,
                    "select": false,
                    "bLengthChange": true,
                    "scrollCollapse": true,
                    "bPaginate": true,
                    "bInfo": true,
                    "bSort": false,
                    "processing": true,
                    "serverSide": true,
                    "stateSave": true,
                    "order": [],
                    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        console.log(aData);
                    },
                    "ajax": {
                        "url": "<?php echo site_url('Laporan/listPOCetakan'); ?>",
                        "type": "POST",
                        "data": {
                            "cmb_company": cmb_company,
                            "txt_periode2": txt_periode2,
                            "txt_periode3": txt_periode3
                        },
                        "error": function(request) {
                            console.log(request.responseText);
                        }
                    },
                    "columns": [{
                            "width": "5%"
                        },
                        {
                            "width": "20%"
                        },
                        {
                            "width": "20%"
                        },
                        {
                            "width": "20%"
                        },
                        {
                            "width": "25%"
                        },
                        {
                            "width": "10%"
                        },
                    ],
                    "columnDefs": [{
                        "targets": [],
                        "orderable": false,
                    }, ],
                });
                var rel = setInterval(function() {
                    $('#tableListLapPOCetakan').DataTable().ajax.reload();
                    clearInterval(rel);
                }, 100);
            }
        }
    </script>
</body>

</html>