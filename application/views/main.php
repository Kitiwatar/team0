<!-- Create by: Patiphan Pansanga, Jiradat Pomyai, Natakorn Phongsarikit, Kitiwat Arunwong 07-09-2565 -->
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
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/images/pms-logo.png">

    <title><?= $pageTitle ?></title>
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="<?= base_url() ?>assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="<?= base_url() ?>assets/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>assets/dist/css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="<?= base_url() ?>assets/dist/css/pages/dashboard1.css" rel="stylesheet">
    <!-- Data Table  -->
    <link href="<?= base_url() ?>assets/node_modules/datatables/media/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/dist/css/pages/icon-page.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="<?= base_url() ?>assets/node_modules/popper/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url() ?>assets/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url() ?>assets/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url() ?>assets/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url() ?>assets/dist/js/custom.js"></script>
    <!-- This is data table -->
    <script src="<?= base_url() ?>assets/node_modules/datatables/datatables.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="<?= base_url() ?>assets/node_modules/raphael/raphael-min.js"></script>
    <script src="<?= base_url() ?>assets/node_modules/morrisjs/morris.min.js"></script>
    <script src="<?= base_url() ?>assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Popup message jquery -->
    <script src="<?= base_url() ?>assets/node_modules/toast-master/js/jquery.toast.js"></script>
    <!-- Chart JS -->
    <!-- <script src="<?= base_url() ?>assets/dist/js/dashboard1.js"></script> -->
    <script src="<?= base_url() ?>assets/node_modules/toast-master/js/jquery.toast.js"></script>
    <!-- Sweet-Alert  -->
    <script src="<?= base_url() ?>assets/node_modules/sweetalert/sweetalert.min.js"></script>
    <!-- <script src="<?= base_url() ?>assets/node_modules/sweetalert2/sweet-alert.init.js"></script> -->
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://www.ninenik.com/js/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
    <!-- end - This is for export functionality only -->

    <!-- Flot Charts JavaScript -->
    <script src="<?= base_url() ?>assets/node_modules/Chart.js/Chart.min.js"></script>
    <script src="<?= base_url() ?>assets/node_modules/peity/jquery.peity.min.js"></script>
    <script src="<?= base_url() ?>assets/node_modules/peity/jquery.peity.init.js"></script>
    <script src="<?= base_url() ?>assets/node_modules/echarts/echarts-all.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5.3.1/dist/echarts.min.js"></script>
    <!-- end Flot Charts JavaScript -->

    <link href="<?= base_url() ?>assets/node_modules/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <style>
        .name {
            color: #03a9f3;
        }

        .name:hover {
            color: #01d0f8;
        }
    </style>
</head>
<script>
    var hostname = location.protocol + '//' + window.location.hostname + ":" + location.port + "/team0/";
</script>

<body class="skin-blue fixed-layout" <?= isset($_SESSION['u_id']) ? 'onload="countDown()" ' . 'onclick="updateTimeout()"' : '' ?>>
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
                            <img src="<?= base_url() ?>assets/images/pms-logo.png" width="40" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                            <!-- dark Logo text -->
                            <img src="<?= base_url() ?>assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="<?= base_url() ?>assets/images/pms-logo-text.png" width="140" height="31" class="light-logo" alt="homepage" />
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
                        <li class="nav-item" onclick="setSidebar()"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item">
                            <form class="app-search d-none d-md-block d-lg-block">
                                <input type="text" class="form-control" placeholder="Search & enter">
                            </form>
                        </li> -->
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-link px-2">
                            <?php if ($_SESSION['lang'] == "th") { ?>
                                <div style="cursor:pointer;" class="fw-bold fs-5" onclick="changeLang('en')">EN</div>
                            <?php } else { ?>
                                <div style="cursor:pointer;" class="fw-bold fs-5" onclick="changeLang('th')">TH</div>
                            <?php } ?>
                        </li>
                        <li class="nav-link pe-0">
                            <div class="fw-bold fs-5">|</div>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- User Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            <?php if (isset($_SESSION['u_fullname'])) { ?>
                                <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic fs-5" href="" data-toggle="dropdown" data-bs-display="static" aria-haspopup="true" aria-expanded="false">
                                    <table>
                                        <tr>
                                            <td class="hidden-md-down px-2 py-0" style="line-height: 20%;">
                                                <h5><?php echo $_SESSION['u_fullname']; ?></h5>
                                                <span class="float-end" style="font-size: 13px;">
                                                    <?php if ($_SESSION['u_role'] == 3) {
                                                        echo lang('u_role-em1');
                                                    } else if ($_SESSION['u_role'] == 2) {
                                                        echo lang('u_role-em2');
                                                    } else {
                                                        echo lang('u_role-am');
                                                    } ?>
                                                </span>
                                            </td>
                                            <td class="p-0"><img src="<?= base_url() ?>assets/images/iconuser.png" alt="user" class=""></td>
                                        </tr>
                                    </table>
                                </a>
                                <div class="dropdown-menu animated flipInY" style="right: 0; width:100px">
                                    <a onclick="viewPersonDetail()" class="dropdown-item" style="cursor: pointer;"><i class="mdi mdi-account"></i> <?= lang('profile') ?></a>
                                    <div class="dropdown-divider"></div>
                                    <a onclick="changePersonPassword()" class="dropdown-item" style="cursor: pointer;"><i class="mdi mdi-key-variant"></i> <?= lang('password') ?></a>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?= base_url() ?>login/logout" class="dropdown-item"><i class="mdi mdi-logout"></i> <?= lang('logout') ?></a>
                                </div>
                            <?php } else { ?>
                                <div class="nav-link waves-effect waves-dark profile-pic fs-5" onclick="getLoginForm()"><?= lang('login') ?></div>
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
                        <?php if (!isset($_SESSION['u_id'])) { ?>
                            <li>
                                <a class=" waves-effect waves-dark" href="<?= base_url() ?>" aria-expanded="false">
                                    <i class="ti-bar-chart-alt" style="font-size: 18px;"></i><span class="hide-menu"><?= lang('dashboard') ?></span></a>
                            </li>
                        <?php } else if($_SESSION['u_role'] <= 1) { ?>
                            <li>
                                <a class="has-arrow waves-effect waves-dark" href="<?= base_url() ?>" aria-expanded="false">
                                    <i class="ti-bar-chart-alt" style="font-size: 18px;"></i><span class="hide-menu"><?= lang('dashboard') ?></span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li>
                                            <a class="waves-effect waves-dark" href="<?= base_url() ?>Home/dashboard" aria-expanded="false"><i class="icon-control-play" style="font-size: 12px;"></i> <?= lang('pp') ?></a>
                                        </li>
                                        <li>
                                            <a class="waves-effect waves-dark" href="<?= base_url() ?>Home/dashboard_admin" aria-expanded="false"><i class="icon-control-play" style="font-size: 12px;"></i> <?= lang('admin') ?></a>
                                        </li>
                                    </ul>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a class=" waves-effect waves-dark" href="<?= base_url() ?>" aria-expanded="false">
                                    <i class="ti-bar-chart-alt" style="font-size: 18px;"></i><span class="hide-menu"><?= lang('dashboard') ?></span></a>
                            </li>
                        <?php } ?>

                        <?php if (isset($_SESSION['u_id'])) : ?>
                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-doc" style="font-size: 20px;"></i><span class="hide-menu"> <?= lang('project') ?></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <?php if ($_SESSION['u_role'] <= 2) : ?>
                                        <li>
                                            <a class="waves-effect waves-dark" href="<?= base_url() ?>projects/addProject" aria-expanded="false"><i class="icon-control-play" style="font-size: 12px;"></i> <?= lang('m_project_addproject') ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if ($_SESSION['u_role'] <= 1) : ?>
                                        <li>
                                            <a class="waves-effect waves-dark" href="<?= base_url() ?>projects/all" aria-expanded="false"><i class="icon-control-play" style="font-size: 12px;"></i> <?= lang('all_project') ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <li>
                                        <a class="waves-effect waves-dark" href="<?= base_url() ?>projects" aria-expanded="false"><i class="icon-control-play" style="font-size: 12px;"></i> <?= lang('my_project') ?></a>
                                    </li>
                                </ul>
                            </li>
                            <?php if ($_SESSION['u_role'] <= 1) : ?>
                                <li>
                                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-screen-tablet" style="font-size: 18px;"></i><span class="hide-menu"><?= lang('report') ?></span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li>
                                            <a class="waves-effect waves-dark" href="<?= base_url() ?>reports/projects" aria-expanded="false"><i class="icon-control-play" style="font-size: 12px;"></i> <?= lang('project') ?></a>
                                        </li>
                                        <li>
                                            <a class="waves-effect waves-dark" href="<?= base_url() ?>reports/users" aria-expanded="false"><i class="icon-control-play" style="font-size: 12px;"></i> <?= lang('employee') ?></a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-settings" style="font-size: 20px;"></i><span class="hide-menu"><?= lang('setting') ?></span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li>
                                            <a class="waves-effect waves-dark" href="<?= base_url() ?>users" aria-expanded="false"><i class="icon-control-play" style="font-size: 12px;"></i> <?= lang('user') ?></a>
                                        </li>
                                        <li>
                                            <a class="waves-effect waves-dark" href="<?= base_url() ?>tasklist" aria-expanded="false"><i class="icon-control-play" style="font-size: 12px;"></i> <?= lang('taskList') ?></a>
                                        </li>
                                        <li>
                                            <a class="waves-effect waves-dark" href="<?= base_url() ?>cancellist" aria-expanded="false"><i class="icon-control-play" style="font-size: 12px;"></i> <?= lang('m-cancel_list') ?></a>
                                        </li>
                                        <li>
                                            <a class="waves-effect waves-dark" href="<?= base_url() ?>announ" aria-expanded="false"><i class="icon-control-play" style="font-size: 12px;"></i> <?= lang('m-announcement') ?></a>
                                        </li>
                                    </ul>
                                </li>

                            <?php endif; ?>
                            <?php if ($_SESSION['u_role'] < 1) : ?>
                                <li>
                                    <a class="waves-effect waves-dark" href="<?= base_url() ?>logs" aria-expanded="false">
                                        <i class="ti-server" style="font-size: 18px;"></i><span class="hide-menu"> <?= lang('log') ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li style="bottom: 0; position: fixed;">
                                <a class="waves-effect waves-dark my-0" href="<?= base_url() ?>login/logout" aria-expanded="false">
                                    <i class="fas fa-sign-out-alt" style="font-size: 20px;"></i><span class="hide-menu"> <?= lang('logout') ?></span>
                                </a>
                            </li>
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
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>"><?= lang('Home') ?></a></li>
                                <?php if (isset($subBreadcrumb)) : ?>
                                    <li class="breadcrumb-item"><a id="subBreadcrumb" href="<?= base_url() ?><?= $subBreadcrumbPath ?>"><?= $subBreadcrumb ?></a></li>
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
            © 2022 Project Monitoring System by Team Zero & <a href="http://www.ivsoft.co.th/" class="link-info">IV Soft Co., Ltd.</a>
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
    <style>
        body.modal-open {
            overflow: hidden;
        }
    </style>
    <div class="modal fade" data-backdrop="static" id="mainModal" tabindex="-1" aria-labelledby="modalCenterTitle" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog modal-xl  modal-dialog-scrollable" role="document" id='modalSize'>
            <div class="modal-content p-2">
                <div class="modal-header">
                    <h5 class="modal-title" id="mainModalTitle">Modal title</h5>
                    <!-- <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true"></button> -->
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

    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="modalCenterTitle" aria-hidden="true" data-keyboard="false">
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

    <div class="modal fade" id="mdModal" data-backdrop="static" tabindex="-1" aria-labelledby="modalCenterTitle" aria-hidden="true" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document" id='modalSize'>
            <div class="modal-content">



                <div class="modal-body" id="mdModalBody">

                </div>

            </div>
        </div>
    </div>
    <!-- end modal -->
</body>

</html>
<script>
    // console.log(hostname)
    function getLoginForm() {
        $.ajax({
            method: "post",
            url: hostname + 'login/getLoginForm',
            data: {
                person: 'yes'
            }
        }).done(function(returnData) {
            $('#mdModalTitle').html(returnData.title);
            $('#mdModalBody').html(returnData.body);
            $('#mdModalFooter').html(returnData.footer);
            $('#mdModal').modal();
        });
    }

    function viewPersonDetail() {
        $.ajax({
            method: "post",
            url: hostname + 'users/getDetailForm',
            data: {
                person: 'yes'
            }
        }).done(function(returnData) {
            $('#detailModalTitle').html(returnData.title);
            $('#detailModalBody').html(returnData.body);
            $('#detailModalFooter').html(returnData.footer);
            $('#detailModal').modal();
        });
    }

    function changePersonPassword() {
        $.ajax({
            method: "post",
            url: hostname + 'users/getPasswordForm',
            data: {
                person: 'yes'
            }
        }).done(function(returnData) {
            $('#mainModalTitle').html(returnData.title);
            $('#mainModalBody').html(returnData.body);
            $('#mainModalFooter').html(returnData.footer);
            $('#mainModal').modal();
        });
    }

    function closeModal(action) {
        $('#mainModalTitle').html("");
        $('#mainModalBody').html("");
        $('#mainModalFooter').html("");
        $('#mainModal').modal('hide');
    }

    function changeLang(lang) {
        $.ajax({
            url: hostname + 'home/changeLang',
            method: 'post',
            data: {
                lang: lang
            },
        }).done(function(returnData) {
            if (returnData.status == 1) {
                location.reload();
            }
        })
    }

    function clearSession() {
        $.ajax({
            url: hostname + 'login/logout',
            method: 'post'
        }).done(function(returnData) {
            swal({
                title: "เซสชันหมดอายุ",
                text: "เซสชันหมดอายุกรุณาเข้าสู่ระบบใหม่อีกครั้ง",
                type: "warning",
                showCancelButton: false,
                showConfirmButton: false,
                timer: 3000,
            }).then(function() {
                location.replace("home");
            })
        })
    }


    function countDown() {
        var downloadTimer = setInterval(function() {
            $.ajax({
                url: hostname + 'login/checkTimeout',
                method: 'post'
            }).done(function(returnData) {
                if (returnData.status == 1) {
                    swal({
                        title: "ต้องการอยู่ในระบบต่อหรือไม่",
                        html: "ออกจากระบบอัตโนมัติใน <strong></strong> วินาที",
                        type: "warning",
                        showCancelButton: true,
                        showConfirmButton: true,
                        confirmButtonText: "ยืนยัน",
                        cancelButtonText: "ยกเลิก",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        timer: 15000,
                        onBeforeOpen: () => {
                            timerInterval = setInterval(() => {
                                Swal.getContent().querySelector('strong').textContent = (Swal.getTimerLeft() / 1000).toFixed(0)
                            }, 100)
                        },
                        onClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then(function(isConfirm) {
                        if (isConfirm.value) {
                            updateTimeout();
                            countDown();
                        } else {
                            clearSession();
                        }
                    })
                }
            })
            clearInterval(downloadTimer);
        }, 5000);
    }

    function updateTimeout() {
        $.ajax({
            url: hostname + 'login/updateTimeout',
            method: 'post'
        }).done(function(returnData) {
            // console.log(returnData.time)
        })
    }

    function setSidebar() {
        let sidebar = localStorage.getItem('sidebar')
        if (sidebar == 1) {
            localStorage.setItem('sidebar', 0)
        } else {
            localStorage.setItem('sidebar', 1)
        }

    }
</script>