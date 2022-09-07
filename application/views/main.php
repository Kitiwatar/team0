<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url()?>assets/images/favicon.png">
    <title>Project Monitoring System By IV soft</title>
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="<?=base_url()?>assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="<?=base_url()?>assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=base_url()?>assets/dist/css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="<?=base_url()?>assets/dist/css/pages/dashboard1.css" rel="stylesheet">
    <!-- Data Table  -->
    <link href="<?=base_url()?>assets/node_modules/datatables/media/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?=base_url()?>assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="<?=base_url()?>assets/node_modules/popper/popper.min.js"></script>
    <script src="<?=base_url()?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?=base_url()?>assets/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="<?=base_url()?>assets/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?=base_url()?>assets/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?=base_url()?>assets/dist/js/custom.js"></script>
    <!-- This is data table -->
     <script src="<?=base_url()?>assets/node_modules/datatables/datatables.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="<?=base_url()?>assets/node_modules/raphael/raphael-min.js"></script>
    <script src="<?=base_url()?>assets/node_modules/morrisjs/morris.min.js"></script>
    <script src="<?=base_url()?>assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Popup message jquery -->
    <script src="<?=base_url()?>assets/node_modules/toast-master/js/jquery.toast.js"></script>
    <!-- Chart JS -->
    <!-- <script src="<?=base_url()?>assets/dist/js/dashboard1.js"></script> -->
    <script src="<?=base_url()?>assets/node_modules/toast-master/js/jquery.toast.js"></script>
    <!-- Sweet-Alert  -->
    <script src="<?=base_url()?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
    <!-- <script src="<?=base_url()?>assets/node_modules/sweetalert2/sweet-alert.init.js"></script> -->
  </head>

<body class="skin-blue fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Loading</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= base_url() ?>">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?= base_url() ?>assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="<?= base_url() ?>assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                            <!-- dark Logo text -->
                            <img src="<?= base_url() ?>assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="<?= base_url() ?>assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav me-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item">
                            <form class="app-search d-none d-md-block d-lg-block">
                                <input type="text" class="form-control" placeholder="Search & enter">
                            </form>
                        </li> -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">

                        <!-- ============================================================== -->
                        <!-- User Profile -->
                        <!-- ============================================================== -->
                        <li class=" nav-item dropdown u-pro">
                        <?php if(isset($_SESSION['u_fullname'])) { ?>
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" data-bs-display="static" aria-expanded="false"><span class="hidden-md-down">
                            <?php echo $_SESSION['u_fullname'];?>
                            <img src="<?=base_url()?>assets/images/users/1.jpg" alt="user" class=""></span> </a>
                            <div class="dropdown-menu animated flipInY" style="right: 0;">
                                <a href="javascript:void(0)" class="dropdown-item"><i class="mdi mdi-account"></i> ข้อมูลส่วนตัว</a>
                                <div class="dropdown-divider"></div>
                                <a href="<?=base_url()?>login/logout" class="dropdown-item"><i class="mdi mdi-logout"></i> ออกจากระบบ</a>
                            </div>
                            <?php } else { ?>
                                <a class="nav-link waves-effect waves-dark profile-pic" href="<?=base_url()?>login">
                                    <span class="hidden-md-down">เข้าสู่ระบบ&nbsp;</span> </a>
                            <?php } ?>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End User Profile -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> 
                            <a class="waves-effect waves-dark" href="<?= base_url() ?>" aria-expanded="false">
                                <i class="mdi mdi-chart-bar"></i><span class="hide-menu">หน้าหลัก</span>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['u_id'])) : ?>
                            <?php if ($_SESSION['u_role'] == 1) : ?>
                                <li>
                                    <a class="waves-effect waves-dark" href="<?= base_url() ?>Users" aria-expanded="false">
                                        <i class="mdi mdi-account-card-details"></i><span class="hide-menu">พนักงานในระบบ</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor"><?= $pageTitle ?></h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=base_url()?>">หน้าหลัก</a></li>
                                <?php if (isset($subBreadcrumb)) : ?>
                                    <?= $subBreadcrumb ?>
                                <?php endif; ?>
                                <?php if (isset($breadcrumb)) : ?>
                                    <li class="breadcrumb-item active"><?= $breadcrumb ?></li>
                                <?php endif; ?>
                            </ol>

                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <?= isset($pageContent) ? $pageContent : 'ไม่พบข้อมูล กรุณาติดต่อผู้ดูแลระบบ' ?>
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2022 Project Monitoring System by Team Zero & IV Soft Co., Ltd.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    
    <!-- Main Modal -->
    <!-- if you want hide backdrop please add data-backdrop="static" -->
    <style>body.modal-open {overflow: hidden;}</style>
    <div class="modal fade" data-backdrop="static" id="mainModal" tabindex="-1" aria-labelledby="modalCenterTitle" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document" id='modalSize'>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mainModalTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body" id="mainModalBody">
                    ...
                </div>
                <div class="modal-footer" id="mainModalFooter">
                    <i id="fMsgIcon"></i><span id="fMsg"></span>
                    <button type="button" class="btn btn-sm btn-primary">Save changes</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade"  id="detailModal" tabindex="-1" aria-labelledby="modalCenterTitle" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document" id='modalSize'>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body" id="detailModalBody">
                    ...
                </div>
                <div class="modal-footer" id="detailModalFooter">
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->

</body>

</html>