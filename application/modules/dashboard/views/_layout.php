<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- <title>AdminLTE 3 | Dashboard 2</title> -->
        <title><?php echo SITE_NAME . ' | ' . ucfirst($_caption) . ucfirst(isset($button) ? ' - ' . $button : ''); ?></title>

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <style>
            .pagination {
                display: inline-block;
                padding-left: 0;
                margin: 20px 0;
                border-radius: 4px;
            }
            .pagination > li {
                display: inline;
            }
            .pagination > li > a,
            .pagination > li > span {
                position: relative;
                float: left;
                padding: 6px 12px;
                margin-left: -1px;
                line-height: 1.42857143;
                color: #428bca;
                text-decoration: none;
                background-color: #fff;
                border: 1px solid #ddd;
            }
            .pagination > li:first-child > a,
            .pagination > li:first-child > span {
                margin-left: 0;
                border-top-left-radius: 4px;
                border-bottom-left-radius: 4px;
            }
            .pagination > li:last-child > a,
            .pagination > li:last-child > span {
                border-top-right-radius: 4px;
                border-bottom-right-radius: 4px;
            }
            .pagination > li > a:hover,
            .pagination > li > span:hover,
            .pagination > li > a:focus,
            .pagination > li > span:focus {
                color: #2a6496;
                background-color: #eee;
                border-color: #ddd;
            }
            .pagination > .active > a,
            .pagination > .active > span,
            .pagination > .active > a:hover,
            .pagination > .active > span:hover,
            .pagination > .active > a:focus,
            .pagination > .active > span:focus {
                z-index: 2;
                color: #fff;
                cursor: default;
                background-color: #428bca;
                border-color: #428bca;
            }
            .pagination > .disabled > span,
            .pagination > .disabled > span:hover,
            .pagination > .disabled > span:focus,
            .pagination > .disabled > a,
            .pagination > .disabled > a:hover,
            .pagination > .disabled > a:focus {
                color: #999;
                cursor: not-allowed;
                background-color: #fff;
                border-color: #ddd;
            }
            .pagination-lg > li > a,
            .pagination-lg > li > span {
                padding: 10px 16px;
                font-size: 18px;
            }
            .pagination-lg > li:first-child > a,
            .pagination-lg > li:first-child > span {
                border-top-left-radius: 6px;
                border-bottom-left-radius: 6px;
            }
            .pagination-lg > li:last-child > a,
            .pagination-lg > li:last-child > span {
                border-top-right-radius: 6px;
                border-bottom-right-radius: 6px;
            }
            .pagination-sm > li > a,
            .pagination-sm > li > span {
                padding: 5px 10px;
                font-size: 12px;
            }
            .pagination-sm > li:first-child > a,
            .pagination-sm > li:first-child > span {
                border-top-left-radius: 3px;
                border-bottom-left-radius: 3px;
            }
            .pagination-sm > li:last-child > a,
            .pagination-sm > li:last-child > span {
                border-top-right-radius: 3px;
                border-bottom-right-radius: 3px;
            }
        </style>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="<?php echo site_url(); ?>" class="brand-link">
                    <img src="<?php echo base_url(); ?>assets/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text "><?php echo "<b>" . SITE_NAME . "</b>" . ' ' . SITE_VERSION; ?></span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <!-- <img src="<?php echo base_url(); ?>assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
                        </div>
                        <div class="info">
                            <!-- <a href="#" class="d-block">Alexander Pierce</a> -->
                            <?php if ($this->session->userdata('fullName')) { ?>
                            <a href="#" class="d-block" ><?php echo $this->session->userdata('fullName') . ' - ' . $this->session->userdata('groupName'); ?></a>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact" data-widget="treeview" role="menu" data-accordion="false">

                            <!-- dashboard -->
                            <li class="nav-item">
                                <a href="<?php echo site_url(); ?>" class="nav-link <?php echo($this->uri->segment(1) == '' ? 'active' : ($this->uri->segment(1) == 'dashboard' ? 'active' : '')); ?>"> <!-- active -->
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>DASHBOARD</p>
                                </a>
                            </li>
                            <!-- /dashboard -->

                            <!-- setup -->
                            <li class="nav-item has-treeview
                                <?php
                                switch ($this->uri->segment(1)) {
                                    case 'company':
                                    case 'user-management':
                                    case 'akun':
                                    case 'akun2':
                                    case 'input-tanggal-saldo-awal':
                                    case 'tanggal-saldo-awal':
                                    case 'saldo-awal':
                                    case 'package':
                                        echo 'menu-open';
                                        break;
                                    default:
                                        echo '';
                                }
                                ?>
                            ">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-coins nav-icon"></i>
                                    <p>SETUP<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <!-- perusahaan -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('company'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 'company' ? 'active' : ''; ?>">
                                            <i class="fas fa-door-open nav-icon"></i>
                                            <p>Company</p>
                                        </a>
                                    </li>
                                    <!-- user management -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('user-management'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 'user-management' ? 'active' : ''; ?>">
                                            <i class="fas fa-user-friends nav-icon"></i>
                                            <p>User Management</p>
                                        </a>
                                    </li>
                                    <div class="dropdown-divider"></div>
                                    <!-- customer -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('akun'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'akun') ? 'active' : ''; ?>">
                                            <i class="fab fa-adn nav-icon"></i>
                                            <p>Customer</p>
                                        </a>
                                    </li>
                                    <!-- shipper -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('akun'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'akun') ? 'active' : ''; ?>">
                                            <i class="fab fa-adn nav-icon"></i>
                                            <p>Shipper</p>
                                        </a>
                                    </li>
                                    <!-- vendor -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('akun'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'akun') ? 'active' : ''; ?>">
                                            <i class="fab fa-adn nav-icon"></i>
                                            <p>Vendor</p>
                                        </a>
                                    </li>
                                    <div class="dropdown-divider"></div>
                                    <!-- armada -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('akun'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'akun') ? 'active' : ''; ?>">
                                            <i class="fab fa-adn nav-icon"></i>
                                            <p>Armada</p>
                                        </a>
                                    </li>
                                    <!-- stock spare part -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('akun'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'akun') ? 'active' : ''; ?>">
                                            <i class="fab fa-adn nav-icon"></i>
                                            <p>Spare Part</p>
                                        </a>
                                    </li>
                                    <div class="dropdown-divider"></div>
                                    <!-- klasifikasi akun -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('akun'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'akun') ? 'active' : ''; ?>">
                                            <i class="fab fa-adn nav-icon"></i>
                                            <p>Chart of Account</p>
                                        </a>
                                    </li>
                                    <!-- saldo awal -->
                                    <li class="nav-item">
                                        <!-- <a href="<?php //echo site_url('saldo-awal'); ?>" class="nav-link <?php //echo ($this->uri->segment(1) == 'saldo-awal') ? 'active' : ''; ?>"> -->
                                        <a href="<?php echo site_url('input-tanggal-saldo-awal'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'input-tanggal-saldo-awal' or $this->uri->segment(1) == 'saldo-awal') ? 'active' : ''; ?>">
                                            <i class="fas fa-code-branch nav-icon"></i>
                                            <p>Saldo Awal</p>
                                        </a>
                                    </li>
                                    <!-- tgl. input saldo awal -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('tanggal-saldo-awal'); ?>" class="nav-link <?php echo ($this->uri->segment(1) == 'tanggal-saldo-awal') ? 'active' : ''; ?>">
                                            <i class="fas fa-calendar-check nav-icon"></i>
                                            <p>Tgl. Input Saldo Awal</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- /setup -->

                            <!-- transaksi -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-exchange-alt nav-icon"></i>
                                    <p>TRANSAKSI<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <!-- Cost Sheet -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('s01_thaj'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 's01_thaj' ? 'active' : ''; ?>">
                                            <i class="far fa-building nav-icon"></i>
                                            <p>Cost Sheet</p>
                                        </a>
                                    </li>
                                    <!-- pembelian -->
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-exchange-alt nav-icon"></i>
                                            <p>Pembelian<i class="right fas fa-angle-left"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <!-- aktiva tetap -->
                                            <li class="nav-item">
                                                <a href="<?php echo site_url('s01_thaj'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 's01_thaj' ? 'active' : ''; ?>">
                                                    <i class="far fa-building nav-icon"></i>
                                                    <p>Permintaan Pembelian (PR)</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- aktiva tetap -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('s01_thaj'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 's01_thaj' ? 'active' : ''; ?>">
                                            <i class="far fa-building nav-icon"></i>
                                            <p>Aktiva Tetap</p>
                                        </a>
                                    </li>
                                    <!-- Penjualan -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('s01_thaj'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 's01_thaj' ? 'active' : ''; ?>">
                                            <i class="fas fa-cash-register nav-icon"></i>
                                            <p>Penjualan</p>
                                        </a>
                                    </li>
                                    <!-- harga pokok -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('s01_thaj'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 's01_thaj' ? 'active' : ''; ?>">
                                            <i class="fas fa-funnel-dollar nav-icon"></i>
                                            <p>Harga Pokok</p>
                                        </a>
                                    </li>
                                    <!-- stok -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('s01_thaj'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 's01_thaj' ? 'active' : ''; ?>">
                                            <i class="fab fa-nutritionix nav-icon"></i>
                                            <p>Stok</p>
                                        </a>
                                    </li>
                                    <!-- kas / bank -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('s01_thaj'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 's01_thaj' ? 'active' : ''; ?>">
                                            <i class="fas fa-money-check-alt nav-icon"></i>
                                            <p>Kas / Bank</p>
                                        </a>
                                    </li>
                                    <!-- jurnal umum -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('s01_thaj'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 's01_thaj' ? 'active' : ''; ?>">
                                            <i class="far fa-newspaper nav-icon"></i>
                                            <p>Jurnal Umum</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- /transaksi -->

                            <!-- laporan -->
                            <li class="nav-item has-treeview
                                <?php
                                switch ($this->uri->segment(1)) {
                                    case 'buku-besar':
                                        echo 'menu-open';
                                        break;
                                    default:
                                        echo '';
                                }
                                ?>
                            ">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-scroll nav-icon"></i>
                                    <p>LAPORAN<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <!-- buku besar -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('buku-besar'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 'buku-besar' ? 'active' : ''; ?>">
                                            <i class="fab fa-accusoft nav-icon"></i>
                                            <p>Buku Besar</p>
                                        </a>
                                    </li>
                                    <!-- neraca -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('s01_thaj'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 's01_thaj' ? 'active' : ''; ?>">
                                            <i class="fas fa-balance-scale nav-icon"></i>
                                            <p>Neraca</p>
                                        </a>
                                    </li>
                                    <!-- laba / rugi -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('s01_thaj'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 's01_thaj' ? 'active' : ''; ?>">
                                            <i class="fas fa-file-invoice-dollar nav-icon"></i>
                                            <p>Laba / Rugi</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- /laporan -->

                            <!-- utility -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-tools nav-icon"></i>
                                    <p>UTILITY<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <!-- backup -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('s01_thaj'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 's01_thaj' ? 'active' : ''; ?>">
                                            <i class="fas fa-download nav-icon"></i>
                                            <p>Backup</p>
                                        </a>
                                    </li>
                                    <!-- restore -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('s01_thaj'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 's01_thaj' ? 'active' : ''; ?>">
                                            <i class="fas fa-upload nav-icon"></i>
                                            <p>Restore</p>
                                        </a>
                                    </li>
                                    <!-- change password -->
                                    <li class="nav-item">
                                        <a href="<?php echo site_url('change-password'); ?>" class="nav-link <?php echo $this->uri->segment(1) == 'change-password' ? 'active' : ''; ?>">
                                            <i class="fas fa-key nav-icon"></i>
                                            <p>Change Password</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- /utility -->

                            <!-- Login or logout -->
                            <li class="nav-item">
                                <?php if ($this->session->userdata('user_id') != "") { ?>
                                    <a href="<?php echo site_url('auth/logout'); ?>" class="nav-link">
                                        <i class="fas fa-sign-out-alt nav-icon"></i>
                                        <p>LOGOUT</p>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo site_url('auth/login'); ?>" class="nav-link">
                                        <i class="fas fa-sign-in-alt nav-icon"></i>
                                        <p>LOGIN</p>
                                    </a>
                                <?php }?>
                            </li>

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
                      <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard v2</h1>
                      </div><!-- /.col -->
                      <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Dashboard v2</li>
                        </ol>
                      </div><!-- /.col -->
                    </div><!-- /.row -->
                  </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                  <div class="container-fluid">

                      <?php $this->load->view($_view); ?>

                  </div><!--/. container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.0.5
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url(); ?>assets/adminlte/dist/js/adminlte.js"></script>

        <!-- OPTIONAL SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/adminlte/dist/js/demo.js"></script>

        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/raphael/raphael.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jquery-mapael/jquery.mapael.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jquery-mapael/maps/usa_states.min.js"></script>
        <!-- ChartJS -->
        <script src="<?php echo base_url(); ?>assets/adminlte/plugins/chart.js/Chart.min.js"></script>

        <!-- PAGE SCRIPTS -->
        <script src="<?php echo base_url(); ?>assets/adminlte/dist/js/pages/dashboard2.js"></script>
    </body>
</html>
