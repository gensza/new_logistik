<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set('Asia/Jakarta');
?>

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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/daterangepicker.css" />



</head>

<body class="loading" data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <!-- <div class="container"> -->
    <!-- Mobile menu toggle (Horizontal Layout)-->
    <!-- <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a> -->
    <!-- End mobile menu toggle-->
    <!-- </div> -->

    <!-- Begin page -->
    <div id="wrapper">


        <!-- Topbar Start -->
        <div class="navbar-custom navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="<?= base_url() ?>assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle mr-2">
                            <font face="Verdana" color="white" size="2.5">Hai, <?= $this->session->userdata('user'); ?></font><i class="ml-1 mdi mdi-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0"><?= $this->session->userdata('pt'); ?></h6>
                            </div>

                            <!-- item-->
                            <a onclick="return modalUbahPeriode();" class="dropdown-item notify-item" href="#">
                                <i class="fe-calendar"></i>
                                Periode : <?= $this->session->userdata('ym_periode'); ?>
                            </a>
                            <a class="dropdown-item notify-item" href="<?= base_url('Login/logout') ?>">
                                <i class="mdi mdi-logout mr-1"></i>
                                Logout

                            </a>
                        </div>
                    </li>

                    <!-- <li class="dropdown notification-list">
                        <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="fe-settings noti-icon"></i>
                        </a>
                    </li> -->

                </ul>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <!-- Mobile menu toggle (Horizontal Layout)-->
                        <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>


                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->

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
                                                <font face="Verdana" size="2.5">Input SPP Baru</font>
                                            </a>
                                            <!-- <a href="<?= base_url('Spp/sppNoCoa') ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Input SPP Tanpa COA</font>
                                            </a> -->
                                            <?php
                                            if ($this->session->userdata('level') == 'KTU' || $this->session->userdata('level') == 'Mill Manager' || $this->session->userdata('level') == 'Manager') {
                                            ?>
                                                <a href="<?= base_url('Spp/sppApproval') ?>" class="dropdown-item">
                                                    <font face="Verdana" size="2.5">SPP
                                                        Approval</font>
                                                </a>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($this->session->userdata('level') == 'Staff HO') { ?>
                                                <a href="<?= base_url('Spp/sppApproval_noCoa') ?>" class="dropdown-item">
                                                    <font face="Verdana" size="2.5">Approval SPP Tanpa Coa</font>
                                                </a>
                                            <?php } ?>


                                            <a href="<?= base_url('Spp'); ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Data
                                                    SPP</font>
                                            </a>
                                            <a href="<?= base_url('Spp/dataNoCoa'); ?>" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Data
                                                    SPP Tanpa Coa</font>
                                            </a>

                                        </div>
                                    </div>
                                    <?php if ($this->session->userdata('nama_dept') == 'PURCHASING' or $this->session->userdata('nama_dept') == 'FINANCE & ACCOUNTING') { ?>
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
                                    <?php } ?>

                                    <?php if ($this->session->userdata('nama_dept') == 'PURCHASING' or $this->session->userdata('nama_dept') == 'FINANCE & ACCOUNTING' or $this->session->userdata('nama_dept') == 'MIS' or $this->session->userdata('nama_dept') == 'HRD & UMUM') { ?>
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
                                                <?php if ($this->session->userdata('status_lokasi') != 'HO') { ?>
                                                    <a href="<?= base_url('Lpb/lpb_mutasi'); ?>" class="dropdown-item">
                                                        <font face="Verdana" size="2.5">Input LPB Mutasi</font>
                                                    </a>
                                                <?php } ?>
                                                <!-- <a href="<?= base_url('Lpb/lpb_retur'); ?>" class="dropdown-item">
                                                        <font face="Verdana" size="2.5">Input LPB Retur</font>
                                                    </a> -->
                                                <a href="<?= base_url('Lpb'); ?>" class="dropdown-item">
                                                    <font face="Verdana" size="2.5">Data LPB</font>
                                                </a>
                                            </div>
                                        </div>
                                    <?php } ?>

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

                                    <?php if ($this->session->userdata('nama_dept') == 'PURCHASING' or $this->session->userdata('nama_dept') == 'FINANCE & ACCOUNTING') { ?>
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
                                        <?php if ($this->session->userdata('status_lokasi') != 'HO') { ?>

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
                                                    <a href="<?= base_url('Retur') ?>" class="dropdown-item">
                                                        <font face="Verdana" size="2.5">Data Retur</font>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>


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

                                    <a href="#" onclick="lap_pp();" class="dropdown-item"><i class="mdi mdi-file-download-outline mr-1"></i>
                                        <font face="Verdana" size="2.5">Permohonan Pembayaran (PP)</font>
                                    </a>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fe-bar-chart-2 mr-1"></i>
                                            <font face="Verdana" size="2.5">Analisa</font>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-form">
                                            <a href="#" onclick="lap_spp_po();" class="dropdown-item">
                                                <font face="Verdana" size="2.5">SPP vs PO</font>
                                            </a>
                                            <a href="#" onclick="lap_lpb_po()" class="dropdown-item">
                                                <font face="Verdana" size="2.5">LPB vs PO</font>
                                            </a>
                                            <a href="#" onclick="lap_durasi()" class="dropdown-item">
                                                <font face="Verdana" size="2.5">Durasi Transaksi</font>
                                            </a>
                                        </div>
                                    </div>
                                    <a href="#" onclick="lap_lpb();" class="dropdown-item"><i class="fe-file-plus  mr-1"></i>
                                        <font face="Verdana" size="2.5">Laporan Penerimaan Barang (LPB)</font>
                                    </a>
                                    <a href="#" onclick="lap_bkb();" class="dropdown-item"><i class="fe-file-minus mr-1"></i>
                                        <font face="Verdana" size="2.5">Bukti Keluar Barang (BKB)</font>
                                    </a>
                                    <a href="#" onclick="lap_rsh();" class="dropdown-item"><i class="fe-clipboard mr-1"></i>
                                        <font face="Verdana" size="2.5">Laporan Register Stok Harian</font>
                                    </a>
                                    <a href="#" onclick="lap_rs();" class="dropdown-item"><i class="fe-check-square mr-1"></i>
                                        <font face="Verdana" size="2.5">Laporan Posisi Stok</font>
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
                                    <a href="javascript:hitungulang();" class="dropdown-item"><i class="fe-repeat mr-1"></i>
                                        <font face="Verdana" size="2.5">Hitung Ulang Stok</font>
                                    </a>
                                    <a href="javascript:tflpbbkbtogl();" class="dropdown-item"><i class="fe-send mr-1"></i>
                                        <font face="Verdana" size="2.5">Transfer Transaksi LPB & BKB ke GL</font>
                                    </a>
                                    <a href="javascript:tutupbuku();" class="dropdown-item"><i class="fe-book mr-1"></i>
                                        <font face="Verdana" size="2.5">Tutup Buku</font>
                                    </a>
                                    <a href="javascript:get_nilai_item();" class="dropdown-item"><i class="fe-book mr-1"></i>
                                        <font face="Verdana" size="2.5">get nilai item bkb</font>
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
                                    <a href="<?= base_url('Setup/supplier') ?>" class="dropdown-item"><i class="fe-codepen mr-1"></i>
                                        <font face="Verdana" size="2.5">Supplier</font>
                                    </a>
                                    <a href="<?= base_url('User/tambah') ?>" class="dropdown-item"><i class="fe-codepen mr-1"></i>
                                        <font face="Verdana" size="2.5">Tambah User</font>
                                    </a>
                                    <a href="<?= base_url('Stok') ?>" class="dropdown-item"><i class="fe-edit mr-1"></i>
                                        <font face="Verdana" size="2.5">Stok Awal</font>
                                    </a>
                                    <a href="<?= base_url('Stok/stok_harian') ?>" class="dropdown-item"><i class="fe-edit mr-1"></i>
                                        <font face="Verdana" size="2.5">Stok Awal Harian</font>
                                    </a>
                                    <a href="<?= base_url('Stok/stok_bulanan_devisi') ?>" class="dropdown-item"><i class="fe-edit mr-1"></i>
                                        <font face="Verdana" size="2.5">Stok Awal Bulanan Divisi</font>
                                    </a>
                                    <a href="widgets.html" class="dropdown-item"><i class="fe-check-square mr-1"></i>
                                        <font face="Verdana" size="2.5">Laporan Rinci Stok</font>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item">

                            </li>

                        </ul> <!-- end navbar-->
                    </div> <!-- end .collapsed-->
                    <ul class="navbar-nav">
                        <li class="dropdown notification-list topbar-dropdown arrow-none">
                            <a class="collapse navbar-collapse nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" style="color: dodgerblue;" aria-haspopup="false" aria-expanded="false">
                                <img src="<?= base_url() ?>assets/images/users/user-1.jpg" alt="user-image" class="rounded-circle mr-2">
                                <font face="Verdana" color="" size="2.5">Hai, <?= $this->session->userdata('user'); ?></font><i class="ml-1 mdi mdi-chevron-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0"><?= $this->session->userdata('pt'); ?></h6>
                                </div>

                                <!-- item-->
                                <a onclick="return modalUbahPeriode();" class="dropdown-item notify-item" href="#">
                                    <i class="fe-calendar"></i>
                                    Periode : <?= $this->session->userdata('ym_periode'); ?>
                                </a>
                                <a class="dropdown-item notify-item" href="<?= base_url('Login/logout') ?>">
                                    <i class="mdi mdi-logout mr-1"></i>
                                    <span>Logout</span>
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
                    <div class="modal-header" style="margin-bottom: -5%;">
                        <h4 class="modal-title ml-1" id="myModalLabel">Laporan PO</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Company *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control form-control-sm" id="cmb_company" name="cmb_company" required="">
                                    <option value="" selected>-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Periode *</font>
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm" id="txt_periode2" name="txt_periode2">
                                <input type="hidden" class="form-control form-control-sm" id="tanggalawalPO" name="tanggalawalPO">
                                <input type="hidden" class="form-control form-control-sm" id="tanggalakhirPO" name="tanggalakhirPO">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">

                                    <div class="form-check">
                                        <input type="radio" id="rbt_register" value="register" name="rbt_pilihan1" class="form-check-input" checked>
                                        <label class="form-check-label" for="rbt_register">Register PO</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input type="radio" id="rbt_cetakan" value="cetakan" name="rbt_pilihan1" class="form-check-input">
                                        <label class="form-check-label" for="rbt_cetakan">Cetakan</label>
                                    </div>
                                </div>
                                <?php if ($this->session->userdata('status_lokasi') != 'HO') { ?>

                                    <div class="col-4">
                                        <div class="form-check">
                                            <input type="radio" id="rbt_po_lokal_r" value="po_lokal_r" name="rbt_pilihan1" class="form-check-input">
                                            <label class="form-check-label" for="rbt_po_lokal_r">PO Lokal (Register)</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input type="radio" id="rbt_po_lokal_t" value="po_lokal_t" name="rbt_pilihan1" class="form-check-input">
                                            <label class="form-check-label" for="rbt_po_lokal_t">PO Lokal (Total PO)</label>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input type="radio" id="rbt_cash" value="cash" name="rbt_pilihan1" class="form-check-input">
                                            <label class="form-check-label" for="rbt_cash">PO ( Cash )</label>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input type="radio" id="rbt_po_hb" value="po_hb" name="rbt_pilihan1" class="form-check-input">
                                        <label class="form-check-label" for="rbt_po_hb">Harga Barang </label>
                                    </div>
                                </div>
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
                    <div class="modal-header" style="margin-bottom: -5%;">
                        <h4 class="modal-title ml-1" id="myModalLabel">Laporan SPP</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">PT *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control form-control-sm" id="cmb_devisi" name="cmb_devisi" required="">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">BAGIAN *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control form-control-sm" id="lap_cmb_bagian" name="lap_cmb_bagian" required="">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Periode *</font>
                            </label>
                            <div class="row">&nbsp;&nbsp;&nbsp;
                                <div class="col-5">
                                    <input type="text" class="form-control form-control-sm" id="tglAwalSPP" name="tglAwalSPP">

                                </div>
                                <div class="col-1">
                                    <label class="control-label">s/d</label>
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control form-control-sm" id="tglAkhirSPP" name="tglAkhirSPP">

                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">

                                    <div class="form-check">
                                        <input type="radio" id="rbt_semua" value="semua" name="rbt_pilihan" class="form-check-input" checked>
                                        <label class="form-check-label" for="rbt_semua">Semua SPP</label>
                                    </div>
                                </div>
                                <div class="col-4">

                                    <div class="form-check">
                                        <input type="radio" id="rbt_slip" value="slip" name="rbt_pilihan" class="form-check-input">
                                        <label class="form-check-label" for="rbt_slip">Slip SPP</label>
                                    </div>
                                </div>
                                <div class="col-4">

                                    <div class="form-check">
                                        <input type="radio" id="rbt_proses" value="proses" name="rbt_pilihan" class="form-check-input">
                                        <label class="form-check-label" for="rbt_proses">Dalam Proses</label>
                                    </div>
                                </div>
                                <div class="col-4">

                                    <div class="form-check">
                                        <input type="radio" id="rbt_setujui" value="setujui" name="rbt_pilihan" class="form-check-input">
                                        <label class="form-check-label" for="rbt_setujui">Disetujui</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input type="radio" id="rbt_sppi" value="sppi" name="rbt_pilihan" class="form-check-input">
                                        <label class="form-check-label" for="rbt_sppi">SPPI</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input type="radio" id="rbt_sppa" value="sppa" name="rbt_pilihan" class="form-check-input">
                                        <label class="form-check-label" for="rbt_sppa">SPPA</label>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="tampilkanspp()">Tampilkan</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" class="close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal lap SPP -->

        <!-- data spp -->
        <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalListLapSPP">
            <div class="modal-dialog modal-full-width modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header" style="margin-bottom: -2%;">
                        <h4 class="modal-title ml-2" id="myModalLabel">Pilih SPP</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <div class="col-12">
                            <div class="table-responsive">
                                <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                                <table id="tableListLapSPP" class="table table-striped table-bordered table-in" width="100%">
                                    <thead>
                                        <tr>

                                            <th style="width: 5% !important;font-size: 12px; padding:10px">No</th>
                                            <th style="width: 10% !important;font-size: 12px; padding:10px">Tgl</th>
                                            <th style="width: 10% !important;font-size: 12px; padding:10px">Dept</th>
                                            <th style="width: 30% !important;font-size: 12px; padding:10px">Noref</th>
                                            <th style="width: 8% !important;font-size: 12px; padding:10px">Status SPP</th>
                                            <th style="width: 10% !important;font-size: 12px; padding:10px">User Input</th>
                                            <th style="width: 3% !important;font-size: 12px; padding:10px">Opsi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>

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
        <!-- end data spp -->



        <!-- data listPo -->
        <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalListLapPO">
            <div class="modal-dialog modal-full-width modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">List PO</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive" style="margin-top: -1%;">
                            <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                            <table id="tableListLapPOCetakan" class="table table-striped table-bordered table-in" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 5% !important; font-size: 12px; padding:10px">No</th>
                                        <th style="width: 5% !important; font-size: 12px; padding:10px">Tanggal</th>
                                        <th style="width: 25% !important; font-size: 12px; padding:10px">Noref PO</th>
                                        <th style="width: 25% !important; font-size: 12px; padding:10px">Noref SPP</th>
                                        <th style="width: 25% !important; font-size: 12px; padding:10px">Supplier</th>
                                        <th style="width: 3% !important; font-size: 12px; padding:10px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end data po -->

        <!-- modal PP -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="modalPP">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header" style="margin-bottom: -5%;">
                        <h4 class="modal-title ml-1" id="myModalLabel">Laporan PP</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Devisi *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control form-control-sm" id="devisi1" name="devisi1" required="">
                                    <!-- <option value="" selected>-- Pilih --</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Periode *</font>
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm" id="periode_pp" name="periode_pp">
                                <input type="hidden" class="form-control form-control-sm" id="tanggalawalPP" name="tanggalawalPP">
                                <input type="hidden" class="form-control form-control-sm" id="tanggalakhirPP" name="tanggalakhirPP">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">

                                <div class="col-4">

                                    <div class="form-check">
                                        <input type="radio" id="rbt_register1" value="register1" name="rbt_pilihan2" class="form-check-input" checked>
                                        <label class="form-check-label" for="rbt_register1">Register PP</label>
                                    </div>
                                </div>
                                <div class="col-4">

                                    <div class="form-check">
                                        <input type="radio" id="rbt_cetakan1" value="cetakan1" name="rbt_pilihan2" class="form-check-input">
                                        <label class="form-check-label" for="rbt_cetakan1">Cetakan</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="tampilkanpp()">Tampilkan</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" class="close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal PP -->

        <!-- modal LPB -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="modalLPB">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header" style="margin-bottom: -5%;">
                        <h4 class="modal-title ml-2" id="myModalLabel">Laporan Penerimaan Barang</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Devisi *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control form-control-sm" id="cmb_devisi3" name="cmb_devisi3" required="">
                                    <!-- <option value="" selected>-- Pilih --</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Periode *</font>
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm" id="periode_lpb" name="periode_lpb">
                                <input type="hidden" class="form-control form-control-sm" id="tanggalawalPB" name="tanggalawalPB">
                                <input type="hidden" class="form-control form-control-sm" id="tanggalakhirLPB" name="tanggalakhirLPB">
                            </div>
                        </div>

                        <div class="form-group">&nbsp;&nbsp;&nbsp;
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="register_lpb" id="rbt_register_lpb" name="rbt_pilihan6" checked>
                                <label for="rbt_register_lpb">Register LPB</label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="slip_lpb" id="rbt_slip_lpb" name="rbt_pilihan6">
                                <label for="rbt_slip_lpb">Slip LPB</label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="per_brg_lpb" id="rbt_per_brg_lpb" name="rbt_pilihan6">
                                <label for="rbt_per_brg_lpb">Per Barang</label>
                            </div>

                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="per_tgl_lpb" id="rbt_per_tgl_lpb" name="rbt_pilihan6">
                                <label for="rbt_per_tgl_lpb">Per Tanggal</label>
                            </div>
                        </div>
                        <div class="form-group">&nbsp;&nbsp;&nbsp;
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="po" id="rbt_po" name="rbt_pilihan6">
                                <label for="rbt_po">PO</label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="po_lokal_lpb" id="rbt_po_lokal_lpb" name="rbt_pilihan6">
                                <label for="rbt_po_lokal_lpb">PO Lokal </label>
                            </div>

                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="lpb_asset" id="rbt_lpb_asset" name="rbt_pilihan6">
                                <label for="rbt_lpb_asset">LPB Assets</label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="lpb_mutasi" id="rbt_lpb_mutasi" name="rbt_pilihan6">
                                <label for="rbt_lpb_mutasi">LPB Mutasi</label>
                            </div>
                        </div>
                        <div class="form-group">&nbsp;&nbsp;&nbsp;
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="slip_retur" id="rbt_slip_retur" name="rbt_pilihan6">
                                <label for="rbt_slip_retur">Slip Retur </label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="regis_retur" id="rbt_regis_retur" name="rbt_pilihan6">
                                <label for="rbt_regis_retur">Register Retur </label>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="tampilkanLPB()">Tampilkan</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" class="close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal LPB -->

        <!-- data listPP -->
        <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalListLapPP">
            <div class="modal-dialog modal-full-width modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title ml-2" id="myModalLabel">List PP</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <div class="col-12">
                            <div class="table-responsive" style="margin-top: -1%;">
                                <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                                <table id="tableListLapPP" class="table table-striped table-bordered table-in" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 5% !important;font-size: 12px; padding:10px">No</th>
                                            <th style="width: 10% !important;font-size: 12px; padding:10px">Tanggal</th>
                                            <th style="width: 25% !important;font-size: 12px; padding:10px">Noref PP</th>
                                            <th style="width: 25% !important;font-size: 12px; padding:10px">Noref PO</th>
                                            <th style="width: 25% !important;font-size: 12px; padding:10px">Supplier</th>
                                            <th style="width: 10% !important;font-size: 12px; padding:10px">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>

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
        <!-- end data pp -->

        <!-- data registerLPB -->
        <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalListLapLPBSlip">
            <div class="modal-dialog modal-full-width modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title ml-2" id="myModalLabel">List LPB Slip</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="table-responsive" style="margin-top: -1%;">
                                <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                                <table id="tableListLapLPBSlip" class="table table-striped table-bordered table-in" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 5% !important; font-size: 12px; padding:10px">No</th>
                                            <th style="width: 10% !important; font-size: 12px; padding:10px">Tgl</th>
                                            <th style="width: 25% !important; font-size: 12px; padding:10px">No PO</th>
                                            <th style="width: 25% !important; font-size: 12px; padding:10px">No LPB</th>
                                            <th style="width: 25% !important; font-size: 12px; padding:10px">Departement</th>
                                            <th style="width: 10% !important; font-size: 12px; padding:10px">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_listbarang">
                                    </tbody>

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
        <!-- end data LPB -->

        <!-- data listLPB PO -->
        <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalListLapLPBPO">
            <div class="modal-dialog modal-full-width modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title ml-2" id="myModalLabel">List LPB Per PO</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="table-responsive" style="margin-top: -1%;">
                                <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                                <table id="tableListLapLPBPO" class="table table-striped table-bordered table-in" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 5% !important;font-size: 12px; padding:10px">No</th>
                                            <th style="width: 25% !important;font-size: 12px; padding:10px">Tanggal</th>
                                            <th style="width: 25% !important;font-size: 12px; padding:10px">No Ref PO</th>
                                            <th style="width: 25% !important;font-size: 12px; padding:10px">No Ref LPB</th>
                                            <th style="width: 25% !important;font-size: 12px; padding:10px">Supplier</th>
                                            <th style="width: 10% !important;font-size: 12px; padding:10px">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_listbarang">
                                    </tbody>

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
        <!-- end data LPB PO -->

        <!-- data listLPB PO -->
        <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalListLapLPBSlipR">
            <div class="modal-dialog modal-full-width modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title ml-2" id="myModalLabel">List LPB Slip Retur</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="table-responsive" style="margin-top: -1%;">
                                <table id="tableListLapLPBSlipR" class="table table-striped table-bordered table-in" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 5% !important;font-size: 12px; padding:10px">No</th>
                                            <th style="width: 15% !important;font-size: 12px; padding:10px">Tgl Retur</th>
                                            <th style="width: 35% !important;font-size: 12px; padding:10px">No Retur</th>
                                            <th style="width: 35% !important;font-size: 12px; padding:10px">Bagian</th>
                                            <th style="width: 35% !important;font-size: 12px; padding:10px">Keterangan</th>
                                            <th style="width: 10% !important;font-size: 12px; padding:10px">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_listbarang"></tbody>

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
        <!-- end data LPB PO -->

        <!-- modal SPP vs PO -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="modalLapSPPPO">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Laporan Monitoring SPP vs PO</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">


                        <div class="form-group">
                            <label class="col-4 col-form-label">
                                <font face="Verdana" size="2">Tanggal SPP*</font>
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="txt_periode6" name="txt_periode6">
                                <input type="hidden" class="form-control" id="tglawal" name="tglawal">
                                <input type="hidden" class="form-control" id="tglakhir" name="tglakhir">
                            </div>
                        </div>

                        <div class="form-group">&nbsp;&nbsp;&nbsp;
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="semua_data" id="rbt_semua_data" name="rbt_pilihan3" checked>
                                <label for="rbt_semua_data"> Semua Data</label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="spp_sdh_po" id="rbt_spp_sdh_po" name="rbt_pilihan3">
                                <label for="rbt_spp_sdh_po">SPP sudah PO</label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="spp_blm_po" id="rbt_spp_blm_po" name="rbt_pilihan3">
                                <label for="rbt_spp_blm_po">Belum PO</label>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="tampilkanspp_po()">Tampilkan</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" class="close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal SPP vs PO -->

        <!-- modal BKB -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="modalBKB">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header" style="margin-bottom: -5%;">
                        <h4 class="modal-title ml-1" id="myModalLabel">Bukti Keluar Barang</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Devisi *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control form-control-sm" id="devisi_bkb" name="devisi_bkb" required="">
                                    <!-- <option value="" selected>-- Pilih --</option> -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">BAGIAN *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control form-control-sm" id="bagian_bkb" name="bagian_bkb" required="">
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Tanggal *</font>
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control form-control-sm" id="tgl_bkb" name="tgl_bkb">
                                <input type="hidden" class="form-control form-control-sm" id="tglawal_bkb" name="tglawal_bkb">
                                <input type="hidden" class="form-control form-control-sm" id="tglakhir_bkb" name="tglakhir_bkb">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="register_bkb" id="rbt_register_bkb" name="rbt_pilihan7" checked>
                                        <label for="rbt_register_bkb"> Register BKB</label>
                                    </div> -->
                                    <div class="form-check">
                                        <input type="radio" id="rbt_register_bkb" value="register_bkb" name="rbt_pilihan7" class="form-check-input" checked>
                                        <label class="form-check-label" for="rbt_register_bkb">Register BKB</label>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input type="radio" id="rbt_slip_bkb" value="slip_bkb" name="rbt_pilihan7" class="form-check-input">
                                        <label class="form-check-label" for="rbt_slip_bkb">Slip BKB</label>
                                    </div>
                                    <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="slip_bkb" id="rbt_slip_bkb" name="rbt_pilihan7">
                                        <label for="rbt_slip_bkb">Slip BKB</label>
                                    </div> -->
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input type="radio" id="rbt_per_brg_bkb" value="per_brg_bkb" name="rbt_pilihan7" class="form-check-input">
                                        <label class="form-check-label" for="rbt_per_brg_bkb">Per Barang</label>
                                    </div>
                                    <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="per_brg_bkb" id="rbt_per_brg_bkb" name="rbt_pilihan7">
                                        <label for="rbt_per_brg_bkb">Per Barang</label>
                                    </div> -->
                                </div>



                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input type="radio" id="rbt_per_tgl_bkb" value="per_tgl_bkb" name="rbt_pilihan7" class="form-check-input">
                                        <label class="form-check-label" for="rbt_per_tgl_bkb">Per Tanggal</label>
                                    </div>
                                    <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="per_bgn_rinci_tgl" id="rbt_per_bgn_rinci_tgl" name="rbt_pilihan7">
                                        <label for="rbt_per_bgn_rinci_tgl">Per Bagian Rinci Tgl</label>
                                    </div> -->
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <input type="radio" id="rbt_mutasi_pt" value="mutasi_pt" name="rbt_pilihan7" class="form-check-input">
                                        <label class="form-check-label" for="rbt_mutasi_pt">Mutasi Antar PT</label>
                                    </div>
                                    <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="mutasi_pt" id="rbt_mutasi_pt" name="rbt_pilihan7">
                                        <label for="rbt_mutasi_pt">Mutasi Antar PT</label>
                                    </div> -->
                                </div>
                                <?php if ($this->session->userdata('status_lokasi') != 'PKS') { ?>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" id="rbt_per_bgn_grp_brg" value="per_bgn_grp_brg" name="rbt_pilihan7" class="form-check-input">
                                            <label class="form-check-label" for="rbt_per_bgn_grp_brg">Per Bagian Group</label>
                                        </div>
                                        <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="per_bgn_grp_brg" id="rbt_per_bgn_grp_brg" name="rbt_pilihan7">
                                        <label for="rbt_per_bgn_grp_brg">Per Bagian Group</label>
                                    </div> -->
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <input type="radio" id="rbt_per_bgn_rinci_tgl" value="per_bgn_rinci_tgl" name="rbt_pilihan7" class="form-check-input">
                                            <label class="form-check-label" for="rbt_per_bgn_rinci_tgl">Per Bagian Rinci Tgl</label>
                                        </div>

                                        <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="per_tgl_bkb" id="rbt_per_tgl_bkb" name="rbt_pilihan7">
                                        <label for="rbt_per_tgl_bkb">Per Tanggal</label>
                                    </div> -->
                                    </div>
                                <?php } ?>

                            </div>
                            <?php if ($this->session->userdata('status_lokasi') != 'PKS') { ?>
                                <div class="row" id="tanaman">
                                    <div class="col-md-6">
                                        <label class="col-6 col-form-label">Nominal RP</label>
                                    </div>
                                    <div class="col-md-6" style="margin-bottom: -3%;">
                                        <hr>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" id="rbt_per_kerja" value="per_kerja" name="rbt_pilihan7" class="form-check-input">
                                            <label class="form-check-label" for="rbt_per_kerja">Per Pekerjaan (Tanaman)</label>
                                        </div>
                                        <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="per_kerja" id="rbt_per_kerja" name="rbt_pilihan7">
                                        <label for="rbt_per_kerja">Per Pekerjaan (Tanaman)</label>
                                    </div> -->
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" id="rbt_per_bgn_grp_brg_n" value="per_bgn_grp_brg_n" name="rbt_pilihan7" class="form-check-input">
                                            <label class="form-check-label" for="rbt_per_bgn_grp_brg_n">Per Bagian Group Barang</label>
                                        </div>
                                        <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="per_bgn_grp_brg_n" id="rbt_per_bgn_grp_brg_n" name="rbt_pilihan7">
                                        <label for="rbt_per_bgn_grp_brg_n">Per Bagian Group Barang</label>
                                    </div> -->
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" id="rbt_per_kerja1" value="per_kerja1" name="rbt_pilihan7" class="form-check-input">
                                            <label class="form-check-label" for="rbt_per_kerja1">Per Pekerjaan</label>
                                        </div>
                                        <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="per_kerja1" id="rbt_per_kerja1" name="rbt_pilihan7">
                                        <label for="rbt_per_kerja1">Per Pekerjaan</label>
                                    </div> -->
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" id="rbt_summary_rsh" value="summary_rsh" name="rbt_pilihan7" class="form-check-input">
                                            <label class="form-check-label" for="rbt_summary_rsh">Summary</label>
                                        </div>
                                        <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="summary_rsh" id="rbt_summary_rsh" name="rbt_pilihan7">
                                        <label for="rbt_summary_rsh">Summary</label>
                                    </div> -->
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" id="rbt_sum_blok_ub" value="sum_blok_ub" name="rbt_pilihan7" class="form-check-input">
                                            <label class="form-check-label" for="rbt_sum_blok_ub">Sum Blok Unit Barang</label>
                                        </div>
                                        <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="sum_blok_ub" id="rbt_sum_blok_ub" name="rbt_pilihan7">
                                        <label for="rbt_sum_blok_ub">Sum Blok Unit Barang</label>
                                    </div> -->
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input type="radio" id="rbt_sum_blok_pk" value="sum_blok_pk" name="rbt_pilihan7" class="form-check-input">
                                            <label class="form-check-label" for="rbt_sum_blok_pk">Sum Blok Pekerjaan</label>
                                        </div>
                                        <!-- <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="sum_blok_pk" id="rbt_sum_blok_pk" name="rbt_pilihan7">
                                        <label for="rbt_sum_blok_pk">Sum Blok Pekerjaan</label>
                                    </div> -->
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="tampilkan_bkb()">Tampilkan</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" class="close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal BKB -->

        <!-- data slip BKB  -->
        <div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalListLapSlipBKB">
            <div class="modal-dialog modal-full-width modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title ml-2" id="myModalLabel">List BKB</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="table-responsive" style="margin-top: -1%;">
                                <table id="tableListLapSlipBKB" class="table table-striped table-bordered table-in" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 5% !important;font-size: 12px; padding:10px">No</th>
                                            <th style="width: 20% !important;font-size: 12px; padding:10px">Tgl</th>
                                            <th style="width: 20% !important;font-size: 12px; padding:10px">No BKB</th>
                                            <th style="width: 25% !important;font-size: 12px; padding:10px">No Ref BKB</th>
                                            <th style="width: 20% !important;font-size: 12px; padding:10px">Departement</th>
                                            <th style="width: 10% !important;font-size: 12px; padding:10px">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody_listbarang"></tbody>

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
        <!-- end SLIP BKB -->

        <!-- lpb vs po -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="modalLapLPBPO">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Laporan Monitoring LPB vs PO</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Devisi *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control" id="devisi_lpbpo" name="devisi_lpbpo" required="">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">No Ref PO *</font>
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="noref_po" name="noref_po">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Tanggal*</font>
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="txt_periode7" name="txt_periode7">
                                <input type="hidden" class="form-control" id="tglawalLPBPO" name="tglawalLPBPO">
                                <input type="hidden" class="form-control" id="tglakhirLPBPO" name="tglakhirLPBPO">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="radio radio-info form-check">
                                <input type="radio" value="semua_tr" id="rbt_semua_tr" name="lpbpo" checked>
                                <label for="rbt_semua_tr"> Semua Transaksi</label>
                            </div>
                            <div class="radio radio-info form-check">
                                <input type="radio" value="by_barang" id="rbt_by_barang" name="lpbpo">
                                <label for="rbt_by_barang">By Barang </label>
                            </div>
                            <div class="radio radio-info form-check">
                                <input type="radio" value="by_supplier" id="rbt_by_supplier" name="lpbpo">
                                <label for="rbt_by_supplier">By Supplier</label>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="radio radio-info form-check">
                                <input type="radio" value="po_blm_lpb_po" id="rbt_po_blm_lpb_po" name="lpbpo">
                                <label for="rbt_po_blm_lpb_po"> PO Belum LPB (Urut PO) </label>
                            </div>
                            <div class="radio radio-info form-check">
                                <input type="radio" value="po_cash_sh" id="rbt_po_cash_sh" name="lpbpo">
                                <label for="rbt_po_cash_sh">PO Cash/0 Hari (Semua Data) </label>
                            </div>
                            <div class="radio radio-info form-check">
                                <input type="radio" value="po_lokal" id="rbt_po_lokal" name="lpbpo">
                                <label for="rbt_po_lokal">PO Lokal Belum LPB</label>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="radio radio-info form-check">
                                <input type="radio" value="semua_tr" id="rbt_po_blm_lpb_brg" name="lpbpo">
                                <label for="rbt_po_blm_lpb_brg"> PO Belum LPB (Urut Barang) </label>
                            </div>
                            <div class="radio radio-info form-check">
                                <input type="radio" value="po_cash_blm_lpb" id="rbt_po_cash_blm" name="lpbpo">
                                <label for="rbt_po_cash_blm">PO Cash/0 Hari (Belum LPB) </label>
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="tampilkanlpb_po()">Tampilkan</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" class="close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- end lpb po -->

        <!-- laporan durasi transaksi -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="modaldurasi">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modaldurasi">Histori Transaksi (SPP-PO-PP-LPB)</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-4 col-form-label">
                                <font face="Verdana" size="2">Tanggal PP *</font>
                            </label>
                            <div class="col-12">
                                <div class="col-12">
                                    <input type="text" class="form-control" id="tgl_durasi" name="tgl_durasi">
                                    <input type="hidden" class="form-control" id="tglawaldurasi" name="tglawaldurasi">
                                    <input type="hidden" class="form-control" id="tglakhirdurasi" name="tglakhirdurasi">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-4">

                                    <div class="radio radio-info form-check-inline">
                                        <input type="radio" value="semua_data_trans" id="rbt_semua_data_trans" name="rbt_pilihan5" checked>
                                        <label for="rbt_semua_data_trans">Semua Data </label>
                                    </div>
                                </div>
                                <div class="col-4">

                                    <div class="radio radio-info form-check">
                                        <input type="radio" value="graphic_trans" id="rbt_graphic_trans" name="rbt_pilihan5">
                                        <label for="rbt_graphic_trans">Graphic </label>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="tampilkan_durasi()">Tampilkan</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" class="close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- end durasi transaksi -->

        <!-- laporan register stok harian -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="modalLapRSH">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalLapRSH">Register Stok Harian</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Devisi *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control" id="devisi_rsh" name="devisi_rsh" required="">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Kode Stok *</font>
                            </label>
                            <div class="col-12">
                                <input type="text" class="form-control" id="kode_stok" name="kode_stok" onclick="cari_kodebar()" placeholder="cari kode stok">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-4 col-form-label">
                                <font face="Verdana" size="2">Grub Barang *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control" id="cmb_group_brg" name="cmb_group_brg" required="">
                                </select>
                            </div>
                        </div>

                        <div class="form-group ml-3">
                            <div class="row col-12">
                                <div class="radio radio-info form-check-inline col-3">
                                    <input type="radio" value="rinci_rsh" id="rbt_rinci_rsh" name="rbt_pilihan9" checked>
                                    <label for="rbt_rinci_rsh">Rinci </label>
                                </div>
                                <div class="radio radio-info form-check-inline col-3">
                                    <input type="radio" value="summary_rsh" id="summary_rsh" name="rbt_pilihan9">
                                    <label for="summary_rsh">Summary </label>
                                </div>
                                <div class="radio radio-info form-check-inline col-3">
                                    <input type="radio" value="non_saldo" id="rbt_non_saldo" name="rbt_pilihan9">
                                    <label for="rbt_non_saldo">Non Saldo </label>
                                </div>
                            </div>
                            <div class="row col-12 mt-1">
                                <div class="radio radio-info form-check-inline col-5">
                                    <input type="radio" value="nilai_rupiah" id="rbt_nilai_rupiah_rsh" name="rbt_pilihan9">
                                    <label for="rbt_nilai_rupiah_rsh">Nilai Rupiah (Rinci) </label>
                                </div>
                                <div class="radio radio-info form-check-inline col-6">
                                    <input type="radio" value="nilai_rupiah_sum" id="rbt_nilai_rupiah_sum_rsh" name="rbt_pilihan9">
                                    <label for="rbt_nilai_rupiah_sum_rsh">Nilai Rupiah (Summary)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="tampilkan_rsh()">Tampilkan</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" class="close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- end lap rsh -->

        <!-- laporan register stok  -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="modalLapRS">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalLapRS">Laporan Posisi Stok</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">PT *</font>
                            </label>
                            <div class="col-12">
                                <select class="form-control" id="cmb_pt" name="cmb_pt" required="">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-3 col-form-label">
                                <font face="Verdana" size="2">Kode Stok *</font>
                            </label>
                            <div class="row">&nbsp;&nbsp;&nbsp;
                                <div class="col-5">
                                    <select class="js-data-example-ajax form-control select2" id="kd_stock_1" name="kd_stock_1" required="">
                                        <option selected value="Semua">Semua</option>
                                    </select>
                                    <input type="hidden" class="form-control" value="Semua" id="cmb_kd_stock_1" name="cmb_kd_stock_1">
                                </div>
                                <div class="col-1">
                                    <label class="control-label"></label>
                                </div>
                                <div class="col-5">
                                    <select class="js-data-example-ajax form-control select2" id="kd_stock_2" name="kd_stock_2" required="">
                                        <option selected value="Semua">Semua</option>
                                    </select>
                                    <input type="hidden" class="form-control" value="Semua" id="cmb_kd_stock_2" name="cmb_kd_stock_2">

                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-4 col-form-label">
                                <font face="Verdana" size="2">Periode *</font>
                            </label>
                            <div class="col-12">
                                <input type="date" class="form-control" id="periode_rs" name="periode_rs" value="<?= $this->session->userdata('Ymd_periode') ?>">
                            </div>
                        </div>

                        <div class="form-group">&nbsp;&nbsp;&nbsp;
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="Rinci" id="rbt_rinci" name="rbt_pilihan10" checked>
                                <label for="rbt_rinci"> Rinci </label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="Summary" id="rbt_summary" name="rbt_pilihan10">
                                <label for="rbt_summary">Summary </label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="Nilai Rupiah" id="rbt_nilai_rupiah" name="rbt_pilihan10">
                                <label for="rbt_nilai_rupiah">Nilai Rupiah </label>
                            </div>
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="Rupiah Minus" id="rbt_rupiah_minus" name="rbt_pilihan10">
                                <label for="rbt_rupiah_minus"> Rupiah Minus </label>
                            </div>
                        </div>
                        <!-- <div class="form-group">&nbsp;&nbsp;&nbsp;
                            <div class="radio radio-info form-check-inline">
                                <input type="radio" value="Rupiah Rata - Rata Harian" id="rbt_rupiah_rata_rata_harian" name="rbt_pilihan10">
                                <label for="rbt_rupiah_rata_rata_harian">Rupiah Rata - Rata Harian </label>
                            </div>
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn_pilih_po" onclick="printStock()">Tampilkan</button>
                        <button type="button" class="btn btn-default" id="btn_cancel" class="close" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal kodebar -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true" id="modalListBarang_lap_rsh">
            <div class="modal-dialog modal-full-width modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">List Barang</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" style="margin-top: -20px;">
                        <div class="table-responsive">
                            <input type="hidden" id="hidden_no_row" name="hidden_no_row">
                            <table id="dabar_lap_rsh" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th class="hastag_th">#</th>
                                        <th class="no_th">No</th>
                                        <th class="kodebar_th">Kode Barang</th>
                                        <th class="nabar_th">Nama Barang</th>
                                        <th class="grup_th">Grup</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- end lap rsh -->

        <!-- modal transfer to GL -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modalKonfirmasiTfToGl">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-warning h1 text-warning"></i>
                            <h4 class="mt-2">Konfirmasi Transfer</h4>
                            <!-- <input type="hidden" id="hidden_no_delete" name="hidden_no_delete"> -->
                            <p class="mt-3">Apakah Anda yakin akan transfer transaksi LPB & BKB ke GL ?</p>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-success my-2" data-dismiss="modal" id="btn_delete" onclick="transferToGl()">Transfer ke GL</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal transfer to GL -->

        <!-- modal ubah periode -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="ubahPeriode">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-information h1 text-info"></i>
                            <h4 class="mt-2">Ubah Periode</h4>

                            <div class="mb-2">
                                <div class="input-group input-group-merge">
                                    <input type="text" id="u_periode" class="form-control" placeholder="Ubah Periode">
                                    <div class="input-group-text">
                                        <i class="fe-calendar"></i>
                                    </div>
                                </div>

                            </div>


                            <div class="mb-0 text-center">
                                <button type="button" class="btn btn-outline-info rounded-pill waves-effect waves-light" onclick="UbahPeriode()">Ubah</button>
                                <button type="button" class="btn btn-outline-secondary rounded-pill waves-effect" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal ubah periode -->

        <!-- modal Progress -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" id="modal_progres">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-information h1 text-info"></i>
                            <h4 class="mt-1">Silahkan Tunggu</h4>

                            <div class="mb-2">
                                <div class="progress mb-0">
                                    <div id="proses-posting" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal ubah periode -->

        <style>
            .hastag_th {
                width: 5% !important;
            }

            .no_th {
                width: 4% !important;
            }

            .kodebar_th {
                width: 12% !important;
            }

            .nabar_th {
                width: 39% !important;
            }

            .grup_th {
                width: 40% !important;
            }

            table#dabar_lap_rsh td {
                padding: 3px;
                padding-left: 10px;
                font-size: 12px;
            }

            table#dabar_lap_rsh th {
                padding: 10px;
                font-size: 12px;
            }

            table#tableListLapSPP td {
                padding: 3px;
                padding-left: 10px;
                font-size: 12px;
            }

            table#tableListLapPOCetakan td {
                padding: 3px;
                padding-left: 10px;
                font-size: 12px;
            }

            table#tableListLapPP td {
                padding: 3px;
                padding-left: 10px;
                font-size: 12px;
            }

            table#tableListLapLPBSlip td {
                padding: 3px;
                padding-left: 10px;
                font-size: 12px;
            }

            table#tableListLapLPBPO td {
                padding: 3px;
                padding-left: 10px;
                font-size: 12px;
            }

            table#tableListLapLPBSlipR td {
                padding: 3px;
                padding-left: 10px;
                font-size: 12px;
            }

            table#tableListLapSlipBKB td {
                padding: 3px;
                padding-left: 10px;
                font-size: 12px;
            }
        </style>

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

        <script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>

        <script src="<?php echo base_url() ?>assets/dist/js/qrcode-reader.min.js?v=20190604"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/daterangepicker.min.js"></script>

        <script src="<?php echo base_url() ?>assets/js/instascan.min.js"></script>

        <!-- Terbilang JS -->
        <script src="<?php echo base_url(); ?>assets/terbilang/terbilang.js"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/terbilang.js"></script>
        <script src="<?php echo base_url(); ?>assets/terbilang.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/libs/moment_js/moment.js"></script>
        <script src="<?php echo base_url(); ?>assets/libs/moment_js/moment.min.js"></script>

        <!-- JQuery Number -->
        <script src="<?php echo base_url(); ?>assets/jquerynumber/jquery.number.js"></script>

        <div class="content-page mt-1">
            <div class="content">

                <!-- Start Content-->

                <!-- memanggil library unt  uk memanggil content -->

                <?php echo $contents ?>




            </div>

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

    <!-- /Right-bar -->

    <!-- Right bar overlay-->


    <!-- Vendor js -->
    <script src="<?php echo base_url() ?>assets/libs/tippy.js/tippy.all.min.js"></script>
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
        //menu posting
        function hitungulang() {
            Swal.fire({
                title: 'Masukkan Password',
                input: 'password',
                inputLabel: 'Password',
                inputPlaceholder: 'Masukkan Password',
                inputAttributes: {
                    maxlength: 10,
                    autocapitalize: 'off',
                    autocorrect: 'off'
                }
            }).then((value) => {
                var pw = value.value;
                if (pw != null && $.trim(pw) != "") {
                    // console.log(pw);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Posting/auth_hitungstok'); ?>",
                        dataType: "JSON",
                        beforeSend: function() {},
                        data: {
                            pw: pw
                        },
                        success: function(data) {
                            // console.log(data);
                            if (data === true) {
                                doHitulStok();
                            } else {
                                window.Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Password Salah!'
                                })
                            }
                        },
                        error: function(request) {

                            console.log(request.responseText);
                        }
                    });
                }
            });
        }

        function tutupbuku() {
            Swal.fire({
                title: 'Masukkan Password',
                input: 'password',
                inputLabel: 'Password',
                inputPlaceholder: 'Masukkan Password',
                inputAttributes: {
                    maxlength: 10,
                    autocapitalize: 'off',
                    autocorrect: 'off'
                }
            }).then((value) => {
                var pw = value.value;
                if (pw != null && $.trim(pw) != "") {
                    // console.log(pw);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Posting/auth_hitungstok'); ?>",
                        dataType: "JSON",
                        beforeSend: function() {},
                        data: {
                            pw: pw
                        },
                        success: function(data) {
                            // console.log(data);
                            if (data === true) {
                                tutupbuku_act();
                            } else {
                                window.Swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: 'Password Salah!'
                                })
                            }
                        },
                        error: function(request) {

                            console.log(request.responseText);
                        }
                    });
                }
            });
        }

        function doHitulStok() {
            // $('#modal_progres').modal('show');
            $.ajax({

                url: "<?php echo site_url('Posting/hitung_stok'); ?>",
                type: "POST",
                data: {
                    'do': 'do'
                },

                beforeSend: function() {
                    Swal.fire({
                        imageUrl: '<?php echo base_url(); ?>assets/img/loading3.gif',
                        imageHeight: 90,
                        imageAlt: 'A tall image',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    })
                    // $("#proses-posting").width('0%');
                },
                success: function(data) {
                    console.log(data);
                    // $('#modal_progres').modal('hide');
                    //$("#loader").hide(); // hides loading sccreen in success call back

                    HuBkb();

                    // window.Swal.fire({
                    //     type: 'success',
                    //     title: 'Berhasil Posting',
                    //     showConfirmButton: true,
                    // })
                },
                error: function(request) {
                    console.log(request.responseText);

                }
            });
        }
        //end

        function HuBkb() {
            $.ajax({

                url: "<?php echo site_url('Posting/hitung_stok_bkb'); ?>",
                type: "POST",
                data: {
                    'do': 'do'
                },

                beforeSend: function() {
                    now = moment().format('DD/MM/YYYY HH:mm:ss');
                    Swal.fire({
                        imageUrl: '<?php echo base_url(); ?>assets/img/loading3.gif',
                        imageHeight: 90,
                        imageAlt: 'A tall image',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    })
                    // $("#proses-posting").width('0%');
                },
                success: function(response) {
                    console.log(response);
                    // $('#modal_progres').modal('hide');
                    //$("#loader").hide(); // hides loading sccreen in success call back

                    console.log(response);
                    then = moment().format('DD/MM/YYYY HH:mm:ss');

                    var ms = moment(then, "DD/MM/YYYY HH:mm:ss").diff(moment(now, "DD/MM/YYYY HH:mm:ss"));
                    var d = moment.duration(ms);

                    var formats = d.hours() + ' Jam : ' + d.minutes() + ' Menit : ' + d.seconds() + ' Detik';

                    swal({
                        title: "Selesai",
                        text: "Terima Kasih, Data berhasil di Posting dan tersimpan, Waktu Proses Posting " + formats + "",
                        type: "success"

                    })
                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });
        }

        function modalUbahPeriode() {
            $('#ubahPeriode').modal('show');

            var date = '<?php echo $this->session->userdata("Ymd_periode"); ?>';
            // console.log(date);
            var convert_date = '<?php echo date("m/d/Y", strtotime($this->session->userdata("Ymd_periode"))) ?>';
            console.log(convert_date);
            $('#u_periode').daterangepicker({
                singleDatePicker: !0,
                singleClasses: "picker_1",
                "startDate": convert_date, // "03/20/2019" "mm/dd/yyyy"
            }, function(start, end, label) {
                // start.format('YYYY-MM-DD')
            });
        }

        function UbahPeriode() {
            var txt_ubah_periode = $('#u_periode').val();

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Home/ubah_session_ymd'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                // cache   : false,
                // contentType : false,
                // processData : false,

                data: {
                    'periode_ubah': txt_ubah_periode
                },
                success: function(data) {
                    location.reload();
                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });
        }

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
            pilihTanggalSpp();
            pilihBagian();
        }

        function lap_pp() {
            $('#modalPP').modal('show');
            // $('#cmb_devisi1').empty();
            pilihDevisi1();
            tanggalPP();
            // pilihTanggal2();
        }

        function lap_lpb() {
            $('#modalLPB').modal('show');
            // $('#cmb_devisi1').empty();
            pilihDevisi2();
            tanggalLPB();
            pilihBagianLPB();
            // tanggalPP();
            // pilihTanggal2();
        }

        function lap_bkb() {
            $('#modalBKB').modal('show');
            $('#tanaman').find('#rbt_per_kerja,#rbt_per_bgn_grp_brg_n,#rbt_per_kerja1,#rbt_summary_rsh, #rbt_sum_blok_ub,#rbt_sum_blok_pk').attr('disabled', '');
            $('#bagian_bkb').change(function() {
                // console.log(this.value);
                var bagian = this.value;
                if (bagian === 'TANAMAN' || bagian === 'TANAMAN UMUM') {
                    $('#tanaman').find('#rbt_per_kerja,#rbt_per_bgn_grp_brg_n,#rbt_per_kerja1,#rbt_summary_rsh, #rbt_sum_blok_ub,#rbt_sum_blok_pk').removeAttr('disabled');
                } else {
                    $('#tanaman').find('#rbt_per_kerja,#rbt_per_bgn_grp_brg_n,#rbt_per_kerja1,#rbt_summary_rsh, #rbt_sum_blok_ub,#rbt_sum_blok_pk').attr('disabled', '');
                }
            });

            // $('#cmb_devisi1').empty();
            devisi_bkb();
            bagianBKB();
            tanggal_bkb();
            // tanggalPP();
            // pilihTanggal2();
        }

        function lap_spp_po() {
            $('#modalLapSPPPO').modal('show');
            pilihTanggal3();
            // pilihDevisi3();
        }

        function lap_lpb_po() {
            $('#modalLapLPBPO').modal('show');
            pilihTanggal4();
            pilihDevisi4();
        }

        function lap_rsh() {
            $('#modalLapRSH').modal('show');
            pilihDevisi5();
            pilihGroupBrg();
        }

        function lap_durasi() {
            $('#modaldurasi').modal('show');
            tanggal_durasi();

        }

        function tampilkan_durasi() {
            var txt_periode10 = $('#tglawaldurasi').val();
            var txt_periode11 = $('#tglakhirdurasi').val();
            var rbt_pilihan5 = $("input[name='rbt_pilihan5']:checked").val();

            if (rbt_pilihan5 == 'semua_data_trans') {
                window.open('<?= site_url("Lap/print_lap_data_tr_semua"); ?>/' + txt_periode10 + '/' + txt_periode11);
            } else if (rbt_pilihan5 == 'graphic_trans') {
                window.open('<?= site_url("laporan/print_lap_data_tr_graphic"); ?>');
            }

            console.log(txt_periode10, txt_periode11, rbt_pilihan5);
        }

        function lap_rs() {
            $('#modalLapRS').modal('show');
            getPT();
            getKodebar();
            // $('#periode_rs').daterangepicker({
            //     singleDatePicker: !0,
            //     singleClasses: "picker_1"
            //     // singleDatePicker: true,
            //     // showDropdowns: true,
            //     // minYear: 1901,
            //     // maxYear: parseInt(moment().format('YYYY'),10)
            // }, function(start, end, label) {
            //     // start.format('YYYY-MM-DD')
            // });
        }

        function printStock() {
            var pt = $('#cmb_pt').val();
            var kd_stock_1 = $('#cmb_kd_stock_1').val();
            var kd_stock_2 = $('#cmb_kd_stock_2').val();
            var periode = $('#periode_rs').val();
            var replace_periode = periode.replace(/\//g, "_"); // YYYY/MM/DD menjadi YYYY_MM_DD
            var pilihan = $("input[name='rbt_pilihan10']:checked").val();
            var replace_pilihan = pilihan.replace(/ /g, "_"); // replace spasi menjadi _ (underscore)
            // var namapt = $('#cmb_pt :selected').text();
            // var encode_namapt = encodeURI(namapt);
            // var encode_namapt = encodeURIComponent(namapt);
            // var encode_namapt = escape(namapt);
            // PT.MULIA%20SAWIT%20AGRO%20LESTARI%20%28SITE%29
            // var encode_namapt = namapt.replace(/ /g,"_"); // replace spasi menjadi _ (underscore)
            // encode_namapt = encode_namapt.replace(/ ( /g,"%28");
            // console.log(encode_namapt);

            window.open('<?php echo site_url("Lap/print_stock") ?>/' + pt + '/' + kd_stock_1 + '/' + kd_stock_2 + '/' + replace_periode + '/' + replace_pilihan);

        }

        function getKodebar() {
            $("#kd_stock_1").select2({
                ajax: {
                    url: "<?php echo site_url('Lap/get_kodebar') ?>",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            kodebartxt: params.term, // search term
                        };
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.kodebartxt,
                                text: item.kodebartxt
                            });
                        });
                        return {
                            results: results
                        };
                    }
                }

            }).on('select2:select', function(evt) {

                var kode = $("#kd_stock_1 option:selected").text();
                var data = $("#kd_stock_1 option:selected").val();
                $('#cmb_kd_stock_1').val(kode);
                // $('#cmb_kd_stock_2').val(kode);

            });
            $("#kd_stock_2").select2({
                ajax: {
                    url: "<?php echo site_url('Lap/get_kodebar') ?>",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            kodebartxt: params.term, // search term
                        };
                    },
                    processResults: function(data) {
                        var results = [];
                        $.each(data, function(index, item) {
                            results.push({
                                id: item.kodebartxt,
                                text: item.kodebartxt
                            });
                        });
                        return {
                            results: results
                        };
                    }
                }

            }).on('select2:select', function(evt) {

                var kode = $("#kd_stock_2 option:selected").text();
                var data = $("#kd_stock_2 option:selected").val();
                // $('#cmb_kd_stock_1').val(kode);
                $('#cmb_kd_stock_2').val(kode);

            });
        }

        function getPT() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Lap/get_pt'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                // contentType : false,
                // processData : false,

                data: '',
                success: function(data) {
                    $('#cmb_pt').empty();

                    var stl = '<?= $this->session->userdata('status_lokasi'); ?>';
                    // if (stl == 'HO') {
                    // }
                    var opsi_pt = '<option value="Semua">Gabungan</option>';
                    $('#cmb_pt').append(opsi_pt);
                    $.each(data, function(index) {
                        var opsi_pt = '<option value="' + data[index].kodetxt + '">' + data[index].PT + '</option>';
                        $('#cmb_pt').append(opsi_pt);
                    });
                },
                error: function(request) {
                    alert(request.responseText);
                }
            });
        }

        function pilihDevisi5() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Laporan/cari_devisi'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: '',
                success: function(data) {
                    $('#devisi_rsh').empty();
                    var stl = '<?= $this->session->userdata('status_lokasi'); ?>';
                    // if (stl == 'HO') {
                    // }

                    var opsi_cmb_all = '<option value="Semua">Gabungan</option>';
                    $('#devisi_rsh').append(opsi_cmb_all);
                    $.each(data, function(index) {
                        var opsi_cmb_devisi = '<option value="' + data[index].kodetxt + '">' + data[index].PT + '</option>';
                        $('#devisi_rsh').append(opsi_cmb_devisi);
                    });
                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });
        }

        function tampilkan_rsh() {
            var cmb_devisi5 = $('#devisi_rsh').val();
            var kode_stok = $('#kode_stok').val();
            var cmb_group_brg = $('#cmb_group_brg').val();
            var rbt_pilihan9 = $("input[name='rbt_pilihan9']:checked").val();

            if (rbt_pilihan9 == 'rinci_rsh') {
                window.open('<?= site_url("Laporan/print_lap_rsh_rinci"); ?>/' + cmb_devisi5 + '/' + cmb_group_brg + '/' + kode_stok);
            } else if (rbt_pilihan9 == 'summary_rsh') {
                window.open('<?= site_url("Laporan/print_lap_rsh_summary"); ?>/' + cmb_devisi5 + '/' + cmb_group_brg + '/' + kode_stok);
            } else if (rbt_pilihan9 == 'non_saldo') {
                window.open('<?= site_url("Laporan/print_lap_rsh_non_saldo"); ?>/' + cmb_devisi5 + '/' + cmb_group_brg + '/' + kode_stok);
            } else if (rbt_pilihan9 == 'nilai_rupiah') {
                window.open('<?= site_url("Laporan/print_lap_rsh_nilai_rupiah"); ?>/' + cmb_devisi5 + '/' + cmb_group_brg + '/' + kode_stok);
            } else if (rbt_pilihan9 == 'nilai_rupiah_sum') {
                window.open('<?= site_url("Laporan/print_lap_rsh_nilai_rupiah_sum"); ?>/' + cmb_devisi5 + '/' + cmb_group_brg + '/' + kode_stok);
            }
            console.log(cmb_devisi5, kode_stok, cmb_group_brg, rbt_pilihan9);
        }

        function cari_kodebar() {
            $('#modalListBarang_lap_rsh').modal('show');
        }

        var table;
        $(document).ready(function() {

            //datatables
            $('#dabar_lap_rsh').DataTable().destroy();
            table = $('#dabar_lap_rsh').DataTable({

                "processing": true,
                "serverSide": true,
                "order": [],

                "ajax": {
                    "url": "<?php echo site_url('Laporan/get_data_barang_lap_rsh') ?>",
                    "type": "POST"
                },

                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],

            });

        });
        // End Data Table Server Side

        $(document).on('click', '#data_barang_lap_rsh', function() {

            var kodebar = $(this).data('kodebar');

            // Set data
            $('#kode_stok').val(kodebar);
            $("#modalListBarang_lap_rsh").modal('hide');

        });

        function pilihGroupBrg() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Laporan/list_group_brg'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: '',
                success: function(data) {
                    $('#cmb_group_brg').empty();

                    var opsi_cmb_all = '<option value="Semua" selected>SEMUA</option>';
                    $('#cmb_group_brg').append(opsi_cmb_all);
                    $.each(data, function(index) {
                        var opsi_cmb_group_brg = '<option value="' + data[index].grp + '">' + data[index].grp + '</option>';
                        $('#cmb_group_brg').append(opsi_cmb_group_brg);
                    });
                },
                error: function(request) {
                    alert(request.responseText);
                }
            });
        }

        function tampilkanlpb_po() {
            var cmb_devisi2 = $('#devisi_lpbpo').val();
            var noref_po = $('#noref_po').val();
            var txt_periode8 = $('#tglawalLPBPO').val();
            var txt_periode9 = $('#tglakhirLPBPO').val();
            var rbt_pilihan4 = $("input[name='lpbpo']:checked").val();
            var dValid = true;
            $('#devisi_lpbpo', '#noref_po', '#tglawalLPBPO', '#tglakhirLPBPO').each(function(e) {
                if ($.trim($(this).val()) == '') {
                    dValid = false;
                }
            });

            if (rbt_pilihan4 == 'semua_tr') {
                window.open('<?= site_url("Laporan/print_lap_po_lpb_semua"); ?>/' + cmb_devisi2 + '/' + txt_periode8 + '/' + txt_periode9);
            } else if (rbt_pilihan4 == 'by_barang') {
                if (noref_po !== '') {
                    window.open('<?= site_url("Laporan/print_lap_po_lpb_bybrg"); ?>/' + cmb_devisi2 + '/' + noref_po + '/' + txt_periode8 + '/' + txt_periode9);
                } else {
                    swal('Jangan ada field yang kosong!~');
                }
            } else if (rbt_pilihan4 == 'by_supplier') {
                if (noref_po !== '') {
                    window.open('<?= site_url("Laporan/print_lap_po_lpb_bysup"); ?>/' + cmb_devisi2 + '/' + noref_po + '/' + txt_periode8 + '/' + txt_periode9);
                } else {
                    swal('Jangan ada field yang kosong!~');
                }
            } else if (rbt_pilihan4 == 'po_blm_lpb_po') {
                window.open('<?= site_url("Laporan/print_lap_po_lpb_blm_lpb_po"); ?>/' + cmb_devisi2 + '/' + txt_periode8 + '/' + txt_periode9);

            } else if (rbt_pilihan4 == 'po_cash_sh') {
                if (noref_po !== '') {
                    window.open('<?= site_url("Laporan/print_lap_po_lpb_po_cash_sh"); ?>');
                } else {
                    swal('Jangan ada field yang kosong!~');
                }
            } else if (rbt_pilihan4 == 'po_cash_blm_lpb') {
                if (noref_po !== '') {
                    window.open('<?= site_url("Laporan/print_lap_po_lpb_po_cash_blm_lpb"); ?>');
                } else {
                    swal('Jangan ada field yang kosong!~');
                }
            } else if (rbt_pilihan4 == 'po_lokal' || rbt_pilihan4 == 'po_blm_lpb_brg') {
                if (noref_po !== '') {
                    window.open('<?= site_url("Laporan/print_lap_po_lpb_po_gab"); ?>');
                } else {
                    swal('Jangan ada field yang kosong!~');
                }
            }



            console.log(cmb_devisi2, noref_po, txt_periode8, txt_periode9, rbt_pilihan4);
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
                    $('#cmb_devisi').empty();
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
                    console.log(request.responseText);
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

        function pilihTanggalSpp() {

            var d = new Date();
            var today = (26) + '/' + d.getMonth() + '/' + d.getFullYear();
            var today1 = (25) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
            $('#tglAwalSPP').val(today);
            $('#tglAkhirSPP').val(today1);

            $('#tglAwalSPP').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
                singleDatePicker: !0,
                singleClasses: "picker_1"
            });
            $('#tglAkhirSPP').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
                singleDatePicker: !0,
                singleClasses: "picker_1"
            });
        }

        function tanggalPP() {
            var d = new Date();
            var today = (26) + '/' + d.getMonth() + '/' + d.getFullYear();
            var today1 = (25) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
            $('#tanggalawalPP').val(today);
            $('#tanggalakhirPP').val(today1);
            $('#periode_pp').val(today + ' - ' +
                today1);

            $('#periode_pp').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
            }, function(start, end, label) {
                $('#tanggalawalPP').val(start.format('DD/MM/YYYY'));
                $('#tanggalakhirPP').val(end.format('DD/MM/YYYY'));

                // console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
            });
        }

        function tanggalLPB() {
            var d = new Date();
            var today = (26) + '/' + d.getMonth() + '/' + d.getFullYear();
            var today1 = (25) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
            $('#tanggalawalPB').val(today);
            $('#tanggalakhirLPB').val(today1);
            $('#periode_lpb').val(today + ' - ' +
                today1);

            $('#periode_lpb').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
            }, function(start, end, label) {
                $('#tanggalawalPB').val(start.format('DD/MM/YYYY'));
                $('#tanggalakhirLPB').val(end.format('DD/MM/YYYY'));

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
            var txt_periode2 = $('#tanggalawalPO').val();
            var txt_periode3 = $('#tanggalakhirPO').val();
            var rbt_pilihan1 = $("input[name='rbt_pilihan1']:checked").val();
            console.log(cmb_company, txt_periode2, txt_periode3, rbt_pilihan1);

            if (rbt_pilihan1 == 'register') {
                window.open('<?= site_url("Laporan/print_lap_po_register"); ?>/' + cmb_company + '/' + txt_periode2 + '/' + txt_periode3);
            } else if (rbt_pilihan1 == 'po_lokal_r') {
                window.open('<?= site_url("Laporan/print_lap_po_lokal_r"); ?>/' + cmb_company + '/' + txt_periode2 + '/' + txt_periode3);
            } else if (rbt_pilihan1 == 'cash') {
                window.open('<?= site_url("Laporan/print_lap_po_cash"); ?>/' + cmb_company + '/' + txt_periode2 + '/' + txt_periode3);
            } else if (rbt_pilihan1 == 'po_lokal_t') {
                window.open('<?= site_url("Laporan/print_lap_po_lokal_t"); ?>/' + cmb_company + '/' + txt_periode2 + '/' + txt_periode3);
            } else if (rbt_pilihan1 == 'po_hb') {
                window.open('<?= site_url("Laporan/print_lap_po_hb"); ?>/' + cmb_company + '/' + txt_periode2 + '/' + txt_periode3);
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


        function tampilkanspp() {
            var cmb_devisi = $('#cmb_devisi').val();
            var lap_cmb_bagian = $('#lap_cmb_bagian').val();
            var tglAwalSPP = $('#tglAwalSPP').val();
            var tglAkhirSPP = $('#tglAkhirSPP').val();
            var rbt_pilihan = $("input[name='rbt_pilihan']:checked").val();

            if (rbt_pilihan == 'semua') {
                window.open('<?= site_url("Laporan/print_lap_spp_register"); ?>/' + cmb_devisi + '/' + lap_cmb_bagian + '/' + tglAwalSPP + '/' +
                    tglAkhirSPP);
            } else if (rbt_pilihan == 'slip') {

                // window.open('<?= site_url("Laporan/tampilkan_spp"); ?>/' + cmb_devisi + '/' + lap_cmb_bagian + '/' + tglAwalSPP + '/' + tglAkhirSPP);
                $('#modalListLapSPP').modal('show');
                $('#tableListLapSPP').DataTable().destroy();
                $('#tableListLapSPP').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],

                    "ajax": {
                        "url": "<?php echo site_url('Laporan/tampilkan_spp') ?>",
                        "type": "POST",
                        "data": {
                            cmb_devisi: cmb_devisi,
                            lap_cmb_bagian: lap_cmb_bagian,
                            tglAwalSPP: tglAwalSPP,
                            tglAkhirSPP: tglAkhirSPP,
                        },

                        "error": function(request) {
                            console.log(request.responseText);
                        }
                    },

                    "initComplete": function(settings, json) {
                        $("div.dataTables_filter input").focus();
                    },
                    "columnDefs ": [{
                        "targets": [0],
                        "orderable": false,

                    }, ],
                    "language": {
                        "infoFiltered": ""
                    }
                });
                var rel = setInterval(function() {
                    $('#tableListLapSPP').DataTable().ajax.reload();
                    clearInterval(rel);
                }, 100);
            } else if (rbt_pilihan == 'proses') {
                $('#modalListLapSPP').modal('show');
                $('#tableListLapSPP').DataTable().destroy();
                $('#tableListLapSPP').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],

                    "ajax": {
                        "url": "<?php echo site_url('Laporan/tampilkan_spp_prosess') ?>",
                        "type": "POST",
                        "data": {
                            cmb_devisi: cmb_devisi,
                            lap_cmb_bagian: lap_cmb_bagian,
                            tglAwalSPP: tglAwalSPP,
                            tglAkhirSPP: tglAkhirSPP,
                        },

                        "error": function(request) {
                            console.log(request.responseText);
                        }
                    },
                    "columnDefs ": [{
                        "targets": [0],
                        "orderable": false,

                    }, ],
                    "language": {
                        "infoFiltered": ""
                    }
                });
                var rel = setInterval(function() {
                    $('#tableListLapSPP').DataTable().ajax.reload();
                    clearInterval(rel);
                }, 100);
            } else if (rbt_pilihan == 'setujui') {
                $('#modalListLapSPP').modal('show');
                $('#tableListLapSPP').DataTable().destroy();
                $('#tableListLapSPP').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],

                    "ajax": {
                        "url": "<?php echo site_url('Laporan/tampilkan_spp_disetujui') ?>",
                        "type": "POST",
                        "data": {
                            cmb_devisi: cmb_devisi,
                            lap_cmb_bagian: lap_cmb_bagian,
                            tglAwalSPP: tglAwalSPP,
                            tglAkhirSPP: tglAkhirSPP,
                        },

                        "error": function(request) {
                            console.log(request.responseText);
                        }
                    },
                    "columnDefs ": [{
                        "targets": [0],
                        "orderable": false,

                    }, ],
                    "language": {
                        "infoFiltered": ""
                    }
                });
                var rel = setInterval(function() {
                    $('#tableListLapSPP').DataTable().ajax.reload();
                    clearInterval(rel);
                }, 100);

            } else if (rbt_pilihan == 'sppi') {
                $('#modalListLapSPP').modal('show');
                $('#tableListLapSPP').DataTable().destroy();
                $('#tableListLapSPP').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],

                    "ajax": {
                        "url": "<?php echo site_url('Laporan/tampilkan_spp_sppi') ?>",
                        "type": "POST",
                        "data": {
                            cmb_devisi: cmb_devisi,
                            lap_cmb_bagian: lap_cmb_bagian,
                            tglAwalSPP: tglAwalSPP,
                            tglAkhirSPP: tglAkhirSPP,
                        },

                        "error": function(request) {
                            console.log(request.responseText);
                        }
                    },
                    "columnDefs ": [{
                        "targets": [0],
                        "orderable": false,

                    }, ],
                    "language": {
                        "infoFiltered": ""
                    }
                });
                var rel = setInterval(function() {
                    $('#tableListLapSPP').DataTable().ajax.reload();
                    clearInterval(rel);
                }, 100);

            } else if (rbt_pilihan == 'sppa') {
                $('#modalListLapSPP').modal('show');
                $('#tableListLapSPP').DataTable().destroy();
                $('#tableListLapSPP').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],

                    "ajax": {
                        "url": "<?php echo site_url('Laporan/tampilkan_spp_sppa') ?>",
                        "type": "POST",
                        "data": {
                            cmb_devisi: cmb_devisi,
                            lap_cmb_bagian: lap_cmb_bagian,
                            tglAwalSPP: tglAwalSPP,
                            tglAkhirSPP: tglAkhirSPP,
                        },

                        "error": function(request) {
                            console.log(request.responseText);
                        }
                    },
                    "columnDefs ": [{
                        "targets": [0],
                        "orderable": false,

                    }, ],
                    "language": {
                        "infoFiltered": ""
                    }
                });
                var rel = setInterval(function() {
                    $('#tableListLapSPP').DataTable().ajax.reload();
                    clearInterval(rel);
                }, 100);

            }


        }

        // function tampilkan_bkb() {
        //     var cmb_devisi4 = $('#cmb_devisi4').val();
        //     var no_bkb = $('#no_bkb').val();
        //     var cmb_bagian1 = $('#cmb_bagian1').val();
        //     var cmb_bagian1 = cmb_bagian1.replaceAll(" ", ".");
        //     var cmb_bagian1 = cmb_bagian1.replaceAll("&", "-");
        //     var txt_periode14 = $('#txt_periode14').val();
        //     var txt_periode15 = $('#txt_periode15').val();
        //     var rbt_pilihan7 = $("input[name='rbt_pilihan7']:checked").val();

        //     if (rbt_pilihan7 == 'register_bkb') {
        //         window.open('<?= site_url("Laporan/print_lap_bkb_register_bkb"); ?>/' + cmb_devisi4 + '/' + txt_periode14 + '/' + txt_periode15 + '/' + cmb_bagian1);
        //     } else if (rbt_pilihan7 == 'slip_bkb') {
        //         $('#modalListLapSlipBKB').modal('show');
        //         $('#tableListLapSlipBKB').DataTable().destroy();
        //         $('#tableListLapSlipBKB').DataTable({
        //             "paging": true,
        //             "scrollY": false,
        //             "scrollX": false,
        //             "searching": true,
        //             "select": false,
        //             "bLengthChange": true,
        //             "scrollCollapse": true,
        //             "bPaginate": true,
        //             "bInfo": true,
        //             "bSort": false,
        //             "processing": true,
        //             "serverSide": true,
        //             "stateSave": true,
        //             "order": [],
        //             "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //                 console.log(aData);
        //             },
        //             "ajax": {
        //                 "url": "<?php echo site_url('Laporan/listLapSlipBKB'); ?>",
        //                 "type": "POST",
        //                 "data": {
        //                     "cmb_devisi4": cmb_devisi4,
        //                     "cmb_bagian1": cmb_bagian1,
        //                     "no_bkb": no_bkb,
        //                     "txt_periode14": txt_periode14,
        //                     "txt_periode15": txt_periode15
        //                 },
        //                 "error": function(request) {
        //                     console.log(request.responseText);
        //                 }
        //             },
        //             "columns": [{
        //                     "width": "5%"
        //                 },
        //                 {
        //                     "width": "20%"
        //                 },
        //                 {
        //                     "width": "20%"
        //                 },
        //                 {
        //                     "width": "25%"
        //                 },
        //                 {
        //                     "width": "20%"

        //                 },
        //                 {
        //                     "width": "10%"
        //                 },
        //             ],
        //             "columnDefs": [{
        //                 "targets": [],
        //                 "orderable": false,
        //             }, ],
        //         });
        //         var rel = setInterval(function() {
        //             $('#tableListLapSlipBKB').DataTable().ajax.reload();
        //             clearInterval(rel);
        //         }, 100);
        //     } else if (rbt_pilihan7 == 'per_brg_bkb') {
        //         window.open('<?= site_url("Laporan/print_lap_bkb_per_brg"); ?>/' + cmb_devisi4 + '/' + txt_periode14 + '/' + txt_periode15 + '/' + cmb_bagian1);
        //     } else if (rbt_pilihan7 == 'per_tgl_bkb') {
        //         var tgl1 = txt_periode14.replaceAll('/', '.');
        //         var tgl2 = txt_periode15.replaceAll('/', '.');
        //         window.open('<?= site_url("Laporan/print_lap_bkb_per_tgl"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1);
        //     } else if (rbt_pilihan7 == 'per_bgn_rinci_tgl') {
        //         var dev = $('#cmb_devisi4 option:selected').text();
        //         dev = dev.replaceAll(' ', '-', dev);
        //         dev = dev.replaceAll('(', '._', dev);
        //         dev = dev.replaceAll(')', '_.', dev);
        //         if (cmb_bagian1 == 'Semua') {
        //             swal('Pilih salah satu bagian');
        //         } else {
        //             var tgl1 = txt_periode14.replaceAll('/', '.');
        //             var tgl2 = txt_periode15.replaceAll('/', '.');
        //             window.open('<?= site_url("Laporan/print_lap_bkb_per_bgn_rinci_tgl"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
        //         }
        //     } else if (rbt_pilihan7 == 'per_bgn_grp_brg') {
        //         var dev = $('#cmb_devisi4 option:selected').text();
        //         dev = dev.replaceAll(' ', '-', dev);
        //         dev = dev.replaceAll('(', '._', dev);
        //         dev = dev.replaceAll(')', '_.', dev);
        //         if (cmb_bagian1 == 'Semua') {
        //             swal('Pilih salah satu bagian');
        //         } else {
        //             var tgl1 = txt_periode14.replaceAll('/', '.');
        //             var tgl2 = txt_periode15.replaceAll('/', '.');
        //             window.open('<?= site_url("Laporan/print_lap_bkb_per_bgn_grp_brg"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
        //         }
        //     } else if (rbt_pilihan7 == 'per_kerja') {
        //         var dev = $('#cmb_devisi4 option:selected').text();
        //         dev = dev.replaceAll(' ', '-', dev);
        //         dev = dev.replaceAll('(', '._', dev);
        //         dev = dev.replaceAll(')', '_.', dev);
        //         if (cmb_bagian1 == 'Semua') {
        //             swal('Pilih salah satu bagian');
        //         } else {
        //             var tgl1 = txt_periode14.replaceAll('/', '.');
        //             var tgl2 = txt_periode15.replaceAll('/', '.');
        //             window.open('<?= site_url("laporan/print_lap_bkb_per_kerja"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
        //         }
        //     } else if (rbt_pilihan7 == 'mutasi_pt') {
        //         var tgl1 = txt_periode14.replaceAll('/', '.')
        //         var tgl2 = txt_periode15.replaceAll('/', '.')
        //         window.open('<?= site_url("laporan/print_lap_bkb_mutasi"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1);
        //     } else if (rbt_pilihan7 == 'per_bgn_grp_brg_n') {
        //         var dev = $('#cmb_devisi4 option:selected').text();
        //         dev = dev.replaceAll(' ', '-', dev);
        //         dev = dev.replaceAll('(', '._', dev);
        //         dev = dev.replaceAll(')', '_.', dev);
        //         if (cmb_bagian1 == 'Semua') {
        //             swal('Pilih salah satu bagian');
        //         } else {
        //             var tgl1 = txt_periode14.replaceAll('/', '.');
        //             var tgl2 = txt_periode15.replaceAll('/', '.');
        //             window.open('<?= site_url("laporan/print_lap_bkb_per_bgn_grp_brg_n"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
        //         }
        //     } else if (rbt_pilihan7 == 'per_kerja1') {
        //         var dev = $('#cmb_devisi4 option:selected').text();
        //         dev = dev.replaceAll(' ', '-', dev);
        //         dev = dev.replaceAll('(', '._', dev);
        //         dev = dev.replaceAll(')', '_.', dev);
        //         if (cmb_bagian1 == 'Semua') {
        //             swal('Pilih salah satu bagian');
        //         } else {
        //             var tgl1 = txt_periode14.replaceAll('/', '.');
        //             var tgl2 = txt_periode15.replaceAll('/', '.');
        //             window.open('<?= site_url("laporan/print_lap_bkb_per_kerja1"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
        //         }
        //     } else if (rbt_pilihan7 == 'summary_rsh') {
        //         var dev = $('#cmb_devisi4 option:selected').text();
        //         dev = dev.replaceAll(' ', '-', dev);
        //         dev = dev.replaceAll('(', '._', dev);
        //         dev = dev.replaceAll(')', '_.', dev);
        //         if (cmb_bagian1 == 'Semua') {
        //             swal('Pilih salah satu bagian');
        //         } else {
        //             var tgl1 = txt_periode14.replaceAll('/', '.');
        //             var tgl2 = txt_periode15.replaceAll('/', '.');
        //             window.open('<?= site_url("laporan/print_lap_bkb_summary_rsh"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
        //         }
        //     } else if (rbt_pilihan7 == 'sum_blok_ub') {
        //         var dev = $('#cmb_devisi4 option:selected').text();
        //         dev = dev.replaceAll(' ', '-', dev);
        //         dev = dev.replaceAll('(', '._', dev);
        //         dev = dev.replaceAll(')', '_.', dev);
        //         if (cmb_bagian1 == 'Semua') {
        //             swal('Pilih salah satu bagian');
        //         } else {
        //             var tgl1 = txt_periode14.replaceAll('/', '.');
        //             var tgl2 = txt_periode15.replaceAll('/', '.');
        //             window.open('<?= site_url("laporan/print_lap_bkb_sum_blok_ub"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
        //         }
        //     } else if (rbt_pilihan7 == 'sum_blok_pk') {
        //         var dev = $('#cmb_devisi4 option:selected').text();
        //         dev = dev.replaceAll(' ', '-', dev);
        //         dev = dev.replaceAll('(', '._', dev);
        //         dev = dev.replaceAll(')', '_.', dev);
        //         if (cmb_bagian1 == 'Semua') {
        //             swal('Pilih salah satu bagian');
        //         } else {
        //             var tgl1 = txt_periode14.replaceAll('/', '.');
        //             var tgl2 = txt_periode15.replaceAll('/', '.');
        //             window.open('<?= site_url("laporan/print_lap_bkb_sum_blok_pk"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
        //         }
        //     }

        //     console.log(cmb_devisi4, no_bkb, cmb_bagian1, txt_periode14, txt_periode15, rbt_pilihan7);
        // }


        function pilihBagian() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Laporan/cari_bagian'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: '',
                success: function(data) {
                    var opsi_cmb_all = '<option value="Semua">SEMUA</option>';
                    $('#lap_cmb_bagian').append(opsi_cmb_all);
                    $.each(data, function(index) {
                        var opsi_lap_cmb_bagian = '<option value="' + data[index].kode + '">' + data[index].nama + '</option>';
                        $('#lap_cmb_bagian').append(opsi_lap_cmb_bagian);
                    });
                },
                error: function(request) {
                    alert(request.responseText);
                }
            });
        }

        function pilihBagianLPB() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Laporan/cari_bagian'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: '',
                success: function(data) {
                    var opsi_cmb_all = '<option value="Semua">SEMUA</option>';
                    $('#bagian_lpb').append(opsi_cmb_all);
                    $.each(data, function(index) {
                        var opsi_lap_cmb_bagian = '<option value="' + data[index].kode + '">' + data[index].nama + '</option>';
                        $('#bagian_lpb').append(opsi_lap_cmb_bagian);
                    });
                },
                error: function(request) {
                    alert(request.responseText);
                }
            });
        }

        function printClick(noreftxt) {
            window.open('<?= site_url("Laporan/print_lap_spp"); ?>/' + noreftxt);
        }

        function printLapPOCetClick(noreftxt, no_refppo, kode_supply) {
            window.open('<?= site_url("Laporan/print_lap_po_cetakan"); ?>/' + noreftxt + '/' + no_refppo + '/' + kode_supply);
        }

        function pilihDevisi1() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Laporan/cari_devisi'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: '',
                success: function(data) {
                    // console.log(data);
                    $('#devisi1').empty();
                    var stl = '<?= $this->session->userdata('status_lokasi'); ?>';

                    $.each(data, function(index) {
                        var opsi_cmb_devisi = '<option value="' + data[index].kodetxt + '">' + data[index].PT + '</option>';
                        $('#devisi1').append(opsi_cmb_devisi);
                    });
                },
                error: function(request) {
                    alert(request.responseText);
                }
            });
        }

        function pilihDevisi2() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Laporan/cari_devisi'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: '',
                success: function(data) {
                    // console.log(data);
                    $('#cmb_devisi3').empty();
                    var stl = '<?= $this->session->userdata('status_lokasi'); ?>';

                    $.each(data, function(index) {
                        var opsi_cmb_devisi = '<option value="' + data[index].kodetxt + '">' + data[index].PT + '</option>';
                        $('#cmb_devisi3').append(opsi_cmb_devisi);
                    });
                },
                error: function(request) {
                    alert(request.responseText);
                }
            });
        }

        function pilihDevisi3() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Laporan/cari_devisi'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: '',
                success: function(data) {
                    // console.log(data);
                    $('#cmb_devisi4').empty();
                    var stl = '<?= $this->session->userdata('status_lokasi'); ?>';

                    $.each(data, function(index) {
                        var opsi_cmb_devisi = '<option value="' + data[index].kodetxt + '">' + data[index].PT + '</option>';
                        $('#cmb_devisi4').append(opsi_cmb_devisi);
                    });
                },
                error: function(request) {
                    alert(request.responseText);
                }
            });
        }

        function pilihDevisi4() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Laporan/cari_devisi'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: '',
                success: function(data) {
                    // console.log(data);
                    $('#devisi_lpbpo').empty();
                    var stl = '<?= $this->session->userdata('status_lokasi'); ?>';

                    $.each(data, function(index) {
                        var opsi_cmb_devisi = '<option value="' + data[index].kodetxt + '">' + data[index].PT + '</option>';
                        $('#devisi_lpbpo').append(opsi_cmb_devisi);
                    });
                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });
        }

        function devisi_bkb() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Laporan/cari_devisi'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: '',
                success: function(data) {
                    // console.log(data);
                    $('#devisi_bkb').empty();
                    var stl = '<?= $this->session->userdata('status_lokasi'); ?>';

                    $.each(data, function(index) {
                        var opsi_cmb_devisi = '<option value="' + data[index].kodetxt + '">' + data[index].PT + '</option>';
                        $('#devisi_bkb').append(opsi_cmb_devisi);
                    });
                },
                error: function(request) {
                    alert(request.responseText);
                }
            });
        }

        function bagianBKB() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Laporan/cari_bagian'); ?>",
                dataType: "JSON",
                beforeSend: function() {},
                cache: false,
                data: '',
                success: function(data) {
                    var opsi_cmb_all = '<option value="Semua">SEMUA</option>';
                    $('#bagian_bkb').append(opsi_cmb_all);
                    $.each(data, function(index) {
                        var opsi_lap_cmb_bagian = '<option value="' + data[index].nama + '">' + data[index].nama + '</option>';
                        $('#bagian_bkb').append(opsi_lap_cmb_bagian);
                    });
                },
                error: function(request) {
                    alert(request.responseText);
                }
            });
        }

        function tanggal_bkb() {
            var d = new Date();
            var today = (26) + '/' + d.getMonth() + '/' + d.getFullYear();
            var today1 = (25) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
            $('#tglawal_bkb').val(today);
            $('#tglakhir_bkb').val(today1);
            $('#tgl_bkb').val(today + ' - ' +
                today1);

            $('#tgl_bkb').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
            }, function(start, end, label) {
                $('#tglawal_bkb').val(start.format('DD/MM/YYYY'));
                $('#tglakhir_bkb').val(end.format('DD/MM/YYYY'));

                // console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
            });
        }

        function printPPClick() {}

        function tampilkanpp() {
            var cmb_devisi1 = $('#devisi1').val();
            var txt_periode4 = $('#tanggalawalPP').val();
            var txt_periode5 = $('#tanggalakhirPP').val();
            var rbt_pilihan2 = $("input[name='rbt_pilihan2']:checked").val();

            if (rbt_pilihan2 == 'register1') {
                window.open('<?= site_url("Laporan/print_lap_pp_register"); ?>/' + cmb_devisi1 + '/' + txt_periode4 + '/' + txt_periode5);
            } else {
                $('#modalListLapPP').modal('show');
                $('#tableListLapPP').DataTable().destroy();
                $('#tableListLapPP').DataTable({
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
                        "url": "<?php echo site_url('Laporan/listPPCetakan'); ?>",
                        "type": "POST",
                        "data": {
                            "cmb_devisi1": cmb_devisi1,
                            "txt_periode4": txt_periode4,
                            "txt_periode5": txt_periode5
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
                    $('#tableListLapPP').DataTable().ajax.reload();
                    clearInterval(rel);
                }, 100);
            }

            console.log(cmb_devisi1, txt_periode4, txt_periode5, rbt_pilihan2);
        }

        function tampilkanLPB() {
            var cmb_devisi3 = $('#cmb_devisi3').val();
            // var no_lpb = $('#no_lpb').val();
            var txt_periode12 = $('#tanggalawalPB').val();
            var txt_periode13 = $('#tanggalakhirLPB').val();
            var rbt_pilihan6 = $("input[name='rbt_pilihan6']:checked").val();


            if (rbt_pilihan6 == 'register_lpb') {
                window.open('<?= site_url("Laporan/print_lap_lpb_register"); ?>/' + cmb_devisi3 + '/' + txt_periode12 + '/' + txt_periode13);
            } else if (rbt_pilihan6 == 'slip_lpb') {
                $('#modalListLapLPBSlip').modal('show');
                $('#tableListLapLPBSlip').DataTable().destroy();
                $('#tableListLapLPBSlip').DataTable({
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
                        "url": "<?php echo site_url('Laporan/listLapLPBSlip'); ?>",
                        "type": "POST",
                        "data": {
                            "cmb_devisi3": cmb_devisi3,
                            // "no_lpb": no_lpb,
                            "txt_periode12": txt_periode12,
                            "txt_periode13": txt_periode13
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
                    $('#tableListLapLPBSlip').DataTable().ajax.reload();
                    clearInterval(rel);
                }, 100);
            } else if (rbt_pilihan6 == 'per_brg_lpb') {
                window.open('<?= site_url("Laporan/print_lap_lpb_per_brg_lpb"); ?>/' + cmb_devisi3 + '/' + txt_periode12 + '/' + txt_periode13);
            } else if (rbt_pilihan6 == 'per_tgl_lpb') {
                window.open('<?= site_url("Laporan/print_lap_lpb_per_tgl_lpb"); ?>/' + cmb_devisi3 + '/' + txt_periode12 + '/' + txt_periode13);
            } else if (rbt_pilihan6 == 'po') {
                $('#modalListLapLPBPO').modal('show');
                $('#tableListLapLPBPO').DataTable().destroy();
                $('#tableListLapLPBPO').DataTable({
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
                        "url": "<?php echo site_url('Laporan/listLapLPBPO'); ?>",
                        "type": "POST",
                        "data": {
                            "cmb_devisi3": cmb_devisi3,
                            // "no_lpb": no_lpb,
                            "txt_periode12": txt_periode12,
                            "txt_periode13": txt_periode13
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
                            "width": "20%"

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
                    $('#tableListLapLPBPO').DataTable().ajax.reload();
                    clearInterval(rel);
                }, 100);
            } else if (rbt_pilihan6 == 'po_lokal_lpb') {
                window.open('<?= site_url("Laporan/print_lap_lpb_po_lokal_lpb"); ?>/' + cmb_devisi3 + '/' + txt_periode12 + '/' + txt_periode13);
            } else if (rbt_pilihan6 == 'lpb_asset') {
                window.open('<?= site_url("Laporan/print_lap_lpb_po_asset"); ?>/' + cmb_devisi3 + '/' + txt_periode12 + '/' + txt_periode13);
            } else if (rbt_pilihan6 == 'lpb_mutasi') {
                window.open('<?= site_url("Laporan/print_lap_lpb_mutasi"); ?>/' + cmb_devisi3 + '/' + txt_periode12 + '/' + txt_periode13);
            } else if (rbt_pilihan6 == 'slip_retur') {
                $('#modalListLapLPBSlipR').modal('show');
                $('#tableListLapLPBSlipR').DataTable().destroy();
                $('#tableListLapLPBSlipR').DataTable({
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
                        "url": "<?php echo site_url('Laporan/listLapLPBSlipR'); ?>",
                        "type": "POST",
                        "data": {
                            "cmb_devisi3": cmb_devisi3,
                            // "no_lpb": no_lpb,
                            "txt_periode12": txt_periode12,
                            "txt_periode13": txt_periode13
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
                            "width": "20%"

                        },
                        {
                            "width": "10%"
                        },
                    ],
                    "columnDefs": [{
                        "targets": [],
                        "orderable": false,
                    }, ],
                    "language": {
                        "infoFiltered": ""
                    }
                });
                var rel = setInterval(function() {
                    $('#tableListLapLPBSlipR').DataTable().ajax.reload();
                    clearInterval(rel);
                }, 100);
            } else if (rbt_pilihan6 == 'regis_retur') {
                window.open('<?= site_url("Laporan/print_lap_lpb_regis_retur"); ?>/' + cmb_devisi3 + '/' + txt_periode12 + '/' + txt_periode13);
            }
            console.log(cmb_devisi3, txt_periode12, txt_periode13, rbt_pilihan6);
        }

        function tampilkan_bkb() {
            var cmb_devisi4 = $('#devisi_bkb').val();
            var no_bkb = $('#no_bkb').val();
            var cmb_bagian1 = $('#bagian_bkb').val();
            var cmb_bagian1 = cmb_bagian1.replaceAll(" ", ".");
            var cmb_bagian1 = cmb_bagian1.replaceAll("&", "-");
            var txt_periode14 = $('#tglawal_bkb').val();
            var txt_periode15 = $('#tglakhir_bkb').val();
            var rbt_pilihan7 = $("input[name='rbt_pilihan7']:checked").val();

            if (rbt_pilihan7 == 'register_bkb') {
                window.open('<?= site_url("Laporan/print_lap_bkb_register_bkb"); ?>/' + cmb_devisi4 + '/' + txt_periode14 + '/' + txt_periode15 + '/' + cmb_bagian1);
            } else if (rbt_pilihan7 == 'slip_bkb') {
                $('#modalListLapSlipBKB').modal('show');
                $('#tableListLapSlipBKB').DataTable().destroy();
                $('#tableListLapSlipBKB').DataTable({
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
                        // console.log(aData);
                    },
                    "ajax": {
                        "url": "<?php echo site_url('Laporan/listLapSlipBKB'); ?>",
                        "type": "POST",
                        "data": {
                            "cmb_devisi4": cmb_devisi4,
                            "cmb_bagian1": cmb_bagian1,
                            "no_bkb": no_bkb,
                            "txt_periode14": txt_periode14,
                            "txt_periode15": txt_periode15
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
                            "width": "25%"
                        },
                        {
                            "width": "20%"

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
                    $('#tableListLapSlipBKB').DataTable().ajax.reload();
                    clearInterval(rel);
                }, 100);
            } else if (rbt_pilihan7 == 'per_brg_bkb') {
                window.open('<?= site_url("Laporan/print_lap_bkb_per_brg"); ?>/' + cmb_devisi4 + '/' + txt_periode14 + '/' + txt_periode15 + '/' + cmb_bagian1);
            } else if (rbt_pilihan7 == 'per_tgl_bkb') {
                var tgl1 = txt_periode14.replaceAll('/', '.');
                var tgl2 = txt_periode15.replaceAll('/', '.');
                window.open('<?= site_url("Laporan/print_lap_bkb_per_tgl"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1);
            } else if (rbt_pilihan7 == 'per_bgn_rinci_tgl') {
                var dev = $('#cmb_devisi4 option:selected').text();
                dev = dev.replaceAll(' ', '-', dev);
                dev = dev.replaceAll('(', '._', dev);
                dev = dev.replaceAll(')', '_.', dev);
                if (cmb_bagian1 == 'Semua') {
                    swal('Pilih salah satu bagian');
                } else {
                    var tgl1 = txt_periode14.replaceAll('/', '.');
                    var tgl2 = txt_periode15.replaceAll('/', '.');
                    window.open('<?= site_url("Laporan/print_lap_bkb_per_bgn_rinci_tgl"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
                }
            } else if (rbt_pilihan7 == 'per_bgn_grp_brg') {
                var dev = $('#cmb_devisi4 option:selected').text();
                dev = dev.replaceAll(' ', '-', dev);
                dev = dev.replaceAll('(', '._', dev);
                dev = dev.replaceAll(')', '_.', dev);
                if (cmb_bagian1 == 'Semua') {
                    swal('Pilih salah satu bagian');
                } else {
                    var tgl1 = txt_periode14.replaceAll('/', '.');
                    var tgl2 = txt_periode15.replaceAll('/', '.');
                    window.open('<?= site_url("Laporan/print_lap_bkb_per_bgn_grp_brg"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
                }
            } else if (rbt_pilihan7 == 'per_kerja') {
                var dev = $('#cmb_devisi4 option:selected').text();
                dev = dev.replaceAll(' ', '-', dev);
                dev = dev.replaceAll('(', '._', dev);
                dev = dev.replaceAll(')', '_.', dev);
                if (cmb_bagian1 == 'Semua') {
                    swal('Pilih salah satu bagian');
                } else {
                    var tgl1 = txt_periode14.replaceAll('/', '.');
                    var tgl2 = txt_periode15.replaceAll('/', '.');
                    window.open('<?= site_url("Laporan/print_lap_bkb_per_kerja"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
                }
            } else if (rbt_pilihan7 == 'mutasi_pt') {
                var tgl1 = txt_periode14.replaceAll('/', '.')
                var tgl2 = txt_periode15.replaceAll('/', '.')
                window.open('<?= site_url("Laporan/print_lap_bkb_mutasi"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1);
            } else if (rbt_pilihan7 == 'per_bgn_grp_brg_n') {
                var dev = $('#cmb_devisi4 option:selected').text();
                dev = dev.replaceAll(' ', '-', dev);
                dev = dev.replaceAll('(', '._', dev);
                dev = dev.replaceAll(')', '_.', dev);
                if (cmb_bagian1 == 'Semua') {
                    swal('Pilih salah satu bagian');
                } else {
                    var tgl1 = txt_periode14.replaceAll('/', '.');
                    var tgl2 = txt_periode15.replaceAll('/', '.');
                    window.open('<?= site_url("Laporan/print_lap_bkb_per_bgn_grp_brg_n"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
                }
            } else if (rbt_pilihan7 == 'per_kerja1') {
                var dev = $('#cmb_devisi4 option:selected').text();
                dev = dev.replaceAll(' ', '-', dev);
                dev = dev.replaceAll('(', '._', dev);
                dev = dev.replaceAll(')', '_.', dev);
                if (cmb_bagian1 == 'Semua') {
                    swal('Pilih salah satu bagian');
                } else {
                    var tgl1 = txt_periode14.replaceAll('/', '.');
                    var tgl2 = txt_periode15.replaceAll('/', '.');
                    window.open('<?= site_url("Laporan/print_lap_bkb_per_kerja1"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
                }
            } else if (rbt_pilihan7 == 'summary_rsh') {
                var dev = $('#cmb_devisi4 option:selected').text();
                dev = dev.replaceAll(' ', '-', dev);
                dev = dev.replaceAll('(', '._', dev);
                dev = dev.replaceAll(')', '_.', dev);
                if (cmb_bagian1 == 'Semua') {
                    swal('Pilih salah satu bagian');
                } else {
                    var tgl1 = txt_periode14.replaceAll('/', '.');
                    var tgl2 = txt_periode15.replaceAll('/', '.');
                    window.open('<?= site_url("Laporan/print_lap_bkb_summary_rsh"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
                }
            } else if (rbt_pilihan7 == 'sum_blok_ub') {
                var dev = $('#cmb_devisi4 option:selected').text();
                dev = dev.replaceAll(' ', '-', dev);
                dev = dev.replaceAll('(', '._', dev);
                dev = dev.replaceAll(')', '_.', dev);
                if (cmb_bagian1 == 'Semua') {
                    swal('Pilih salah satu bagian');
                } else {
                    var tgl1 = txt_periode14.replaceAll('/', '.');
                    var tgl2 = txt_periode15.replaceAll('/', '.');
                    window.open('<?= site_url("Laporan/print_lap_bkb_sum_blok_ub"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
                }
            } else if (rbt_pilihan7 == 'sum_blok_pk') {
                var dev = $('#cmb_devisi4 option:selected').text();
                dev = dev.replaceAll(' ', '-', dev);
                dev = dev.replaceAll('(', '._', dev);
                dev = dev.replaceAll(')', '_.', dev);
                if (cmb_bagian1 == 'Semua') {
                    swal('Pilih salah satu bagian');
                } else {
                    var tgl1 = txt_periode14.replaceAll('/', '.');
                    var tgl2 = txt_periode15.replaceAll('/', '.');
                    window.open('<?= site_url("Laporan/print_lap_bkb_sum_blok_pk"); ?>/' + cmb_devisi4 + '/' + tgl1 + '/' + tgl2 + '/' + cmb_bagian1 + '/' + dev);
                }
            }

            console.log(cmb_devisi4, no_bkb, cmb_bagian1, txt_periode14, txt_periode15, rbt_pilihan7);
        }

        function printBKBSlipClick(NO_REF, skb, bag, tgl1, tgl2, id) {
            if (bag == "HRD & UMUM") bag = "UMUM & HRD";
            bag = bag.replaceAll(" ", ".");
            bag = bag.replaceAll("&", "-");
            window.open('<?= site_url("Laporan/print_lap_bkb_slip_bkb"); ?>/' + NO_REF + '/' + skb + '/' + bag + '/' + tgl1 + '/' + tgl2 + '/' + id);
        }

        function printLPBSlipClick(noref, refpo) {
            $.ajax({
                url: "<?= site_url('Laporan/cekcetak'); ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    'noref': noref,
                    'refpo': refpo
                },
                success: function(result) {
                    // console.log(result);
                    if (result.status == 'true') {
                        window.open('<?= site_url("Laporan/print_lap_lpb_slip_lpb"); ?>/' + noref + '/' + refpo);
                    } else {
                        swal('Slip telah dicetak 2 kali');
                    }
                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });

        }

        function printLPBPOClick(noref, refpo, periode1, periode2) {
            window.open('<?= site_url("Laporan/print_lap_lpb_per_po_lpb"); ?>/' + noref + '/' + refpo + '/' + periode1 + '/' + periode2);
        }

        function printLPBSlipRClick(cmb_devisi3, noref, refpo) {
            window.open('<?= site_url("Laporan/print_lap_lpb_slip_retur"); ?>/' + cmb_devisi3 + '/' + noref + '/' + refpo);
        }


        function pilihTanggal3() {
            var d = new Date();
            var today = (26) + '/' + d.getMonth() + '/' + d.getFullYear();
            var today1 = (25) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
            $('#tglawal').val(today);
            $('#tglakhir').val(today1);
            $('#txt_periode6').val(today + ' - ' +
                today1);

            $('#txt_periode6').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
            }, function(start, end, label) {
                $('#tglawal').val(start.format('DD/MM/YYYY'));
                $('#tglakhir').val(end.format('DD/MM/YYYY'));

                // console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
            });
        }

        function pilihTanggal4() {
            var d = new Date();
            var today = (26) + '/' + d.getMonth() + '/' + d.getFullYear();
            var today1 = (25) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
            $('#tglawalLPBPO').val(today);
            $('#tglakhirLPBPO').val(today1);
            $('#txt_periode7').val(today + ' - ' +
                today1);

            $('#txt_periode7').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
            }, function(start, end, label) {
                $('#tglawalLPBPO').val(start.format('DD/MM/YYYY'));
                $('#tglakhirLPBPO').val(end.format('DD/MM/YYYY'));

                // console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
            });
        }

        function tanggal_durasi() {
            var d = new Date();
            var today = (26) + '/' + d.getMonth() + '/' + d.getFullYear();
            var today1 = (25) + '/' + (d.getMonth() + 1) + '/' + d.getFullYear();
            $('#tglawaldurasi').val(today);
            $('#tglakhirdurasi').val(today1);
            $('#tgl_durasi').val(today + ' - ' +
                today1);

            $('#tgl_durasi').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
            }, function(start, end, label) {
                $('#tglawaldurasi').val(start.format('DD/MM/YYYY'));
                $('#tglakhirdurasi').val(end.format('DD/MM/YYYY'));

                // console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
            });
        }

        function tampilkanspp_po() {

            var tglawal = $('#tglawal').val();
            var tglakhir = $('#tglakhir').val();
            var rbt_pilihan3 = $("input[name='rbt_pilihan3']:checked").val();

            if (rbt_pilihan3 == 'semua_data') {
                window.open('<?= site_url("Laporan/print_lap_spp_po_semua"); ?>/' + tglawal + '/' + tglakhir);
            } else if (rbt_pilihan3 == 'spp_sdh_po') {
                window.open('<?= site_url("Laporan/print_lap_spp_po_sdhpo"); ?>/' + tglawal + '/' + tglakhir);
            } else if (rbt_pilihan3 == 'spp_blm_po') {
                window.open('<?= site_url("Laporan/print_lap_spp_po_blmpo"); ?>/' + tglawal + '/' + tglakhir);
            }
            console.log(tglawal, tglakhir, rbt_pilihan3);
        }


        function tampilkanpo_lpb() {
            var cmb_devisi2 = $('#cmb_devisi2').val();
            var noref_po = $('#noref_po').val();
            var txt_periode8 = $('#txt_periode8').val();
            var txt_periode9 = $('#txt_periode9').val();
            var rbt_pilihan4 = $("input[name='rbt_pilihan4']:checked").val();
            var dValid = true;
            $('#cmb_devisi2', '#noref_po', '#txt_periode8', '#txt_periode9').each(function(e) {
                if ($.trim($(this).val()) == '') {
                    dValid = false;
                }
            });

            if (noref_po !== '') {
                if (rbt_pilihan4 == 'semua_tr') {
                    window.open('<?= site_url("Laporan/print_lap_po_lpb_semua"); ?>');
                } else if (rbt_pilihan4 == 'by_barang') {
                    window.open('<?= site_url("Laporan/print_lap_po_lpb_bybrg"); ?>');
                } else if (rbt_pilihan4 == 'by_supplier') {
                    window.open('<?= site_url("Laporan/print_lap_po_lpb_bysup"); ?>');
                } else if (rbt_pilihan4 == 'po_blm_lpb_po') {
                    window.open('<?= site_url("Laporan/print_lap_po_lpb_blm_lpb_po"); ?>');
                } else if (rbt_pilihan4 == 'po_cash_sh') {
                    window.open('<?= site_url("Laporan/print_lap_po_lpb_po_cash_sh"); ?>');
                } else if (rbt_pilihan4 == 'po_cash_blm_lpb') {
                    window.open('<?= site_url("Laporan/print_lap_po_lpb_po_cash_blm_lpb"); ?>');
                } else if (rbt_pilihan4 == 'po_lokal' || rbt_pilihan4 == 'po_blm_lpb_brg') {
                    window.open('<?= site_url("Laporan/print_lap_po_lpb_po_gab"); ?>');
                }
            } else {
                swal('Jangan ada field yang kosong!~');
            }
            console.log(cmb_devisi2, noref_po, txt_periode8, txt_periode9, rbt_pilihan4);
        }

        function tflpbbkbtogl() {
            // $('#modalKonfirmasiTfToGl').modal('show');
            swal({
                title: "Transfer ke GL ?",
                text: "Jika ingin diposting, silahkan klik tombol simpan",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
                confirmButtonText: "Ya Posting",
                //confirmButtonColor: "#E73D4A"
                confirmButtonColor: "#286090"
            }).then((value) => {
                if (value.value == true) {
                    cekPeriodeGL();
                }
            });
        }

        function cekPeriodeGL() {
            $.ajax({
                url: "<?= site_url('Posting/cekPeriodeGL'); ?>",
                type: "POST",
                dataType: "JSON",
                beforeSend: function() {
                    Swal.fire({
                        title: 'Please Wait !',
                        html: 'data uploading', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                },
                success: function(response) {
                    // console.log(response)
                    var periode = '<?= $this->session->userdata('ym_periode') ?>';
                    if (response.txtperiode == periode) {
                        transferToGl();
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Maaf, Modul GL sudah tutup buku, silahkan Hub. Accounting',
                        })
                    }
                    // console.log(periode)
                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });
        }

        function transferToGl() {
            $.ajax({
                url: "<?= site_url('Posting/transfer_to_gl'); ?>",
                type: "POST",
                dataType: "JSON",
                beforeSend: function() {
                    now = moment().format('DD/MM/YYYY HH:mm:ss');

                },
                success: function(response) {
                    console.log(response);

                },
                complete: function(response) {
                    then = moment().format('DD/MM/YYYY HH:mm:ss');

                    var ms = moment(then, "DD/MM/YYYY HH:mm:ss").diff(moment(now, "DD/MM/YYYY HH:mm:ss"));
                    var d = moment.duration(ms);

                    var formats = d.hours() + ' Jam : ' + d.minutes() + ' Menit : ' + d.seconds() + ' Detik';

                    swal({
                        title: "Selesai",
                        text: "Terima Kasih, Data berhasil di Posting dan tersimpan, Waktu Proses Posting " + formats + "",
                        type: "success"

                    })
                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });
        }

        function tutupbuku_act() {
            $.ajax({
                url: "<?= site_url('Tutup_buku/tutup_buku_act'); ?>",
                type: "POST",
                dataType: "JSON",
                beforeSend: function() {
                    now = moment().format('DD/MM/YYYY HH:mm:ss');

                },
                success: function(response) {
                    console.log(response);

                },
                complete: function(response) {
                    console.log(response);
                    then = moment().format('DD/MM/YYYY HH:mm:ss');

                    var ms = moment(then, "DD/MM/YYYY HH:mm:ss").diff(moment(now, "DD/MM/YYYY HH:mm:ss"));
                    var d = moment.duration(ms);

                    var formats = d.hours() + ' Jam : ' + d.minutes() + ' Menit : ' + d.seconds() + ' Detik';

                    swal({
                        title: "Selesai",
                        text: "Terima Kasih, Data berhasil di Posting dan tersimpan, Waktu Proses Posting " + formats + "",
                        type: "success"

                    })
                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });
        }

        function get_nilai_item() {
            $.ajax({
                url: "<?= site_url('Posting/get_nilai_item'); ?>",
                type: "POST",
                dataType: "JSON",
                beforeSend: function() {
                    Swal.fire({
                        imageUrl: '<?php echo base_url(); ?>assets/img/loading3.gif',
                        imageHeight: 90,
                        imageAlt: 'A tall image',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    })
                    now = moment().format('DD/MM/YYYY HH:mm:ss');

                },
                success: function(response) {
                    console.log(response);

                },
                complete: function(response) {
                    console.log(response);
                    then = moment().format('DD/MM/YYYY HH:mm:ss');

                    var ms = moment(then, "DD/MM/YYYY HH:mm:ss").diff(moment(now, "DD/MM/YYYY HH:mm:ss"));
                    var d = moment.duration(ms);

                    var formats = d.hours() + ' Jam : ' + d.minutes() + ' Menit : ' + d.seconds() + ' Detik';

                    swal({
                        title: "Selesai",
                        text: "Terima Kasih, Nilai Item berhasil di Posting dan tersimpan, Waktu Proses Posting " + formats + "",
                        type: "success"

                    })
                },
                error: function(request) {
                    console.log(request.responseText);
                }
            });
        }
    </script>

</body>

</html>