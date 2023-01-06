<!-- Create by: Kitiwat Arunwong 24-09-2565 -->
<style>
    .cardProject:hover {
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }

    .purple-outline {
        color: #A68DDE;
        background-color: #FAF7FF;
        border-color: #A68DDE;
    }

    .purple-outline:hover {
        color: white;
        background-color: #A68DDE;
    }

    .purple-outline:focus,
    .purple-outline:active,
    .purple-outline.active {
        color: #A68DDE;
        background-color: #A68DDE;
        border-color: #A68DDE;
    }

    .brown-outline {
        color: #ED9B7E;
        background-color: #FAF7FF;
        border-color: #ED9B7E;
    }

    .brown-outline:hover {
        color: white;
        background-color: #ED9B7E;
    }

    .brown-outline:focus,
    .brown-outline:active,
    .brown-outline.active {
        color: #ED9B7E;
        background-color: #ED9B7E;
        border-color: #ED9B7E;
    }

    .icon-shape {
        border-radius: 50%;
        color: #fff;
        width: 120px;
        height: 110px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 25px;
        box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15) !important;
    }
</style>

<!------------------------------------------------------------------ Dashbaord For User ------------------------------------------------------------------>
<?php if (isset($_SESSION['u_id'])) : ?>
    <?php if ($_SESSION['u_role'] == 3) : ?>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="card">
                    <div class=" card-body p-5">
                        <div class="row">
                            <?php date_default_timezone_set("Asia/Bangkok"); ?>
                            <div class="col-lg-12 col-md-12 Date" style="font-size: 45px; font-weight:bold;">วันที่ <?= $date = date('d'); ?> </div>
                            <div class="pb-4 col-lg-12 col-md-12" style="font-size: 45px; font-weight:bold;"><?= thaiMonthFull(date('m')) . ' ' . $year = date('Y') + 543 ?> </div>
                            <div class="col-lg-12 col-md-12" style="font-size: 30px; ">เวลาปัจจุบัน </div>
                            <?php if ($_SESSION['lang'] == "th") :  ?>
                                <div class="col-lg-12 col-md-12" style="font-size: 70px; font-weight:bold; color:#03A9F3;"><?= $date = date('G:i'); ?> น.</div>
                            <?php else : ?>
                                <div class="col-lg-12 col-md-12" style="font-size: 70px; font-weight:bold; color:#03A9F3;"><?= $date = date('h:i A'); ?></div>
                            <?php endif; ?>
                            <div class="col-lg-12 col-md-12">
                                <div class="card ">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3" style="width:100px;">
                                                <i class="far fa-envelope" style="font-size: 80px;"></i>
                                            </div>
                                            <div class="col-lg-9 col-md-9">
                                                <div style="font-size: 28px; ">ข้อความจากระบบ </div>
                                                <div style="font-size: 28px; font-weight:bold;">"สวัสดีคุณ <?= $_SESSION['u_firstname'] ?> " </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-8">
                <div class="card" style="height: 548px;">
                    <div class="card-body p-4">
                       <div id="todolist"><!-- งานของฉันวันนี้ --></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="card p-2" style="background-color: #03A9F3;">
                    <div style="color:white;">ภาพรวมโครงการทั้งหมด พ.ศ 2565 </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="AllprojectChart" style="width:100%; height:510px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="card">
                            <div class="card-body border-left-yellow">
                                <div class="row">
                                    <div class="col-6">
                                        <span class=" fs-3"><?= lang('sp_home_allproject') ?></span>
                                        <h2 class="counter all" style="font-size: 119px; color: #A68DDE;"></h2>
                                        <a href="<?= base_url() ?>home/viewProjects/all"><button class="btn  waves-effect waves-light purple-outline"><?= lang('b_viewmore') ?></button></a></span>
                                    </div>
                                    <div class=" col-6 d-flex align-items-center justify-content-end">
                                        <div class="icon-shape " style="background-color: #A68DDE;">
                                            <i class="fas fa-list" style="color: white; font-size: 50px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card border ">
                            <div class="card-body">
                                <h3><i class="fas fa-list text-success"></i></h3>
                                <h2 class="counter text-success p_success" style="font-size: 100px;"></h2>
                                <span class=" fs-5 text-success"><?= lang('h_project') ?><br></span><span class=" fs-5 text-success" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_finish') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/success"><button class="btn  waves-effect waves-light btn-outline-success"><?= lang('b_viewmore') ?></button></a></span>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card border">

                            <div class="card-body">
                                <h3><i class="fas fa-list text-info"></i></h3>
                                <h2 class="counter text-info p_pending" style="font-size: 100px;"></h2>
                                <span class=" fs-5 text-info"><?= lang('h_project') ?><br></span><span class=" fs-5 text-info" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_pendproject') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/pending"><button class="btn  waves-effect waves-light btn-outline-info"><?= lang('b_viewmore') ?></button></a></span>

                            </div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card border">
                            <div class="card-body">
                                <h3><i class="fas fa-list text-warning"></i></h3>
                                <h2 class="counter text-warning p_progress" style="font-size: 100px;"></h2>
                                <span class=" fs-5 text-warning"><?= lang('h_project') ?><br></span><span class=" fs-5 text-warning" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_inprogress') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/progress"><button class="btn  waves-effect waves-light btn-outline-warning"><?= lang('b_viewmore') ?></button></a></span>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card border">
                            <div class="card-body">
                                <h3><i class="fas fa-list text-danger"></i></h3>
                                <h2 class="counter text-danger p_fail" style="font-size: 100px;"></h2>
                                <span class=" fs-5 text-danger"><?= lang('h_project') ?><br></span><span class=" fs-5 text-danger" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_cancel') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/fail"><button class="btn  waves-effect waves-light btn-outline-danger"><?= lang('b_viewmore') ?></button></a></span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($_SESSION['u_role'] < 3) : ?>
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card" ">
                    <div class=" card-body p-5">
                    <div class="row">
                        <?php date_default_timezone_set("Asia/Bangkok"); ?>
                        <div class="col-lg-12 col-md-12 Date" style="font-size: 45px; font-weight:bold;">วันที่ <?= $date = date('d'); ?> </div>
                        <div class="pb-4 col-lg-12 col-md-12" style="font-size: 45px; font-weight:bold;"><?= thaiMonthFull(date('m')) . ' ' . $year = date('Y') + 543 ?> </div>
                        <div class="col-lg-12 col-md-12" style="font-size: 30px; ">เวลาปัจจุบัน </div>
                        <?php if ($_SESSION['lang'] == "th") :  ?>
                            <div class="col-lg-12 col-md-12" style="font-size: 70px; font-weight:bold; color:#03A9F3;"><?= $date = date('G:i'); ?> น.</div>
                        <?php else : ?>
                            <div class="col-lg-12 col-md-12" style="font-size: 70px; font-weight:bold; color:#03A9F3;"><?= $date = date('h:i A'); ?></div>
                        <?php endif; ?>
                        <div class="col-lg-12 col-md-12">
                            <div class="card ">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3" style="width:100px;">
                                            <i class="far fa-envelope" style="font-size: 80px;"></i>
                                        </div>
                                        <div class="col-lg-9 col-md-9">
                                            <div style="font-size: 28px; ">ข้อความจากระบบ </div>
                                            <div style="font-size: 28px; font-weight:bold;">"สวัสดีคุณ <?= $_SESSION['u_firstname'] ?> " </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="card" style="height: 548px;" id="todolist">

                
            </div>
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="card p-2" style="background-color: #03A9F3;">
                <div style="color:white;">ภาพรวมที่มีส่วนเกี่ยวข้อง พ.ศ 2565 </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="ResprojectChart" style="width:100%; height:510px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="card">
                        <div class="card-body border-left-yellow">
                            <div class="row">
                                <div class="col-6">
                                    <span class=" fs-3"><?= lang('sp_home_responproject') ?></span>
                                    <h2 class="counter respon" style="font-size: 119px; color: #ED9B7E;"></h2>
                                    <a href="<?= base_url() ?>home/viewProjects/all"><button class="btn  waves-effect waves-light brown-outline"><?= lang('b_viewmore') ?></button></a></span>
                                </div>
                                <div class=" col-6 d-flex align-items-center justify-content-end">
                                    <div class="icon-shape " style="background-color: #ED9B7E;">
                                        <i class="fas fa-list" style="color: white; font-size: 50px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card border ">
                        <div class="card-body">
                            <h3><i class="fas fa-list text-success"></i></h3>
                            <h2 class="counter text-success rp_success" style="font-size: 100px;"></h2>
                            <span class=" fs-5 text-success"><?= lang('h_project') ?><br></span><span class=" fs-5 text-success" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_finish') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/success"><button class="btn  waves-effect waves-light btn-outline-success"><?= lang('b_viewmore') ?></button></a></span>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card border">

                        <div class="card-body">
                            <h3><i class="fas fa-list text-info"></i></h3>
                            <h2 class="counter text-info rp_pending" style="font-size: 100px;"></h2>
                            <span class=" fs-5 text-info"><?= lang('h_project') ?><br></span><span class=" fs-5 text-info" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_pendproject') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/pending"><button class="btn  waves-effect waves-light btn-outline-info"><?= lang('b_viewmore') ?></button></a></span>

                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card border">
                        <div class="card-body">
                            <h3><i class="fas fa-list text-warning"></i></h3>
                            <h2 class="counter text-warning rp_progress" style="font-size: 100px;"></h2>
                            <span class=" fs-5 text-warning"><?= lang('h_project') ?><br></span><span class=" fs-5 text-warning" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_inprogress') ?></span>
                            <span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/progress"><button class="btn  waves-effect waves-light btn-outline-warning"><?= lang('b_viewmore') ?></button></a></span>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card border">
                        <div class="card-body">
                            <h3><i class="fas fa-list text-danger"></i></h3>
                            <h2 class="counter text-danger rp_fail" style="font-size: 100px;"></h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                <span class="fs-5 text-danger"><?= lang('h_project') ?><br></span><span class=" fs-5 text-danger" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_cancel') ?></span>

                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                <span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/fail" class="btn  waves-effect waves-light btn-outline-danger"><?= lang('b_viewmore') ?></a></span>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="card p-2" style="background-color: #03A9F3;">
                <div style="color:white;">ภาพรวมโครงการทั้งหมด พ.ศ 2565 </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="AllprojectChart" style="width:100%; height:510px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="card">
                        <div class="card-body border-left-yellow">
                            <div class="row">
                                <div class="col-6">
                                    <span class=" fs-3"><?= lang('sp_home_allproject') ?></span>
                                    <h2 class="counter all" style="font-size: 119px; color: #A68DDE;"></h2>
                                    <a href="<?= base_url() ?>home/viewProjects/all"><button class="btn  waves-effect waves-light purple-outline"><?= lang('b_viewmore') ?></button></a></span>
                                </div>
                                <div class=" col-6 d-flex align-items-center justify-content-end">
                                    <div class="icon-shape " style="background-color: #A68DDE;">
                                        <i class="fas fa-list" style="color: white; font-size: 50px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card border ">
                        <div class="card-body">
                            <h3><i class="fas fa-list text-success"></i></h3>
                            <h2 class="counter text-success p_success" style="font-size: 100px;"></h2>
                            <span class=" fs-5 text-success"><?= lang('h_project') ?><br></span><span class=" fs-5 text-success" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_finish') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/success"><button class="btn  waves-effect waves-light btn-outline-success"><?= lang('b_viewmore') ?></button></a></span>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card border">

                        <div class="card-body">
                            <h3><i class="fas fa-list text-info"></i></h3>
                            <h2 class="counter text-info p_pending" style="font-size: 100px;"></h2>
                            <span class=" fs-5 text-info"><?= lang('h_project') ?><br></span><span class=" fs-5 text-info" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_pendproject') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/pending"><button class="btn  waves-effect waves-light btn-outline-info"><?= lang('b_viewmore') ?></button></a></span>

                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card border">
                        <div class="card-body">
                            <h3><i class="fas fa-list text-warning"></i></h3>
                            <h2 class="counter text-warning p_progress" style="font-size: 100px;"></h2>
                            <span class=" fs-5 text-warning"><?= lang('h_project') ?><br></span><span class=" fs-5 text-warning" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_inprogress') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/progress"><button class="btn  waves-effect waves-light btn-outline-warning"><?= lang('b_viewmore') ?></button></a></span>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="card border">
                        <div class="card-body">
                            <h3><i class="fas fa-list text-danger"></i></h3>
                            <h2 class="counter text-danger p_fail" style="font-size: 100px;"></h2>
                            <span class=" fs-5 text-danger"><?= lang('h_project') ?><br></span><span class=" fs-5 text-danger" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_cancel') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/fail"><button class="btn  waves-effect waves-light btn-outline-danger"><?= lang('b_viewmore') ?></button></a></span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card" style="height: 470px;">
                <div class="col-lg-12 col-md-12">
                    <div class="card p-2" style="background-color: #03A9F3;">
                        <div style="color:white;">ภาพรวมโครงการทั้งหมด พ.ศ 2565 </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div id="listDiv2"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card" style="height: 470px;">
                <div class="col-lg-12 col-md-12">
                    <div class="card p-2" style="background-color: #03A9F3;">
                        <div style="color:white;"><?= lang('tl_home_listofrank') ?> </div>
                    </div>
                </div>
                <div class="card-body p-2">
                    <div id="listDiv"></div>
                </div>
            </div>
        </div>
        </div>
    <?php endif; ?>
    <!------------------------------------------------------------------ Dashbaord For Aonnymous ------------------------------------------------------------------>

<?php else : ?>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card p-2" style="background-color: #03A9F3;">
                <div style="color:white;">ภาพรวมโครงการทั้งหมด พ.ศ 2565 </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="AllprojectChart" style="width:100%; height:603px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body border-left-yellow">
                            <div class="row">
                                <div class="col-6">
                                    <span class=" fs-3"><?= lang('sp_home_allproject') ?></span>
                                    <h2 class="counter all" style="font-size: 100px; color: #A68DDE;"></h2>
                                    <a href="<?= base_url() ?>home/viewProjects/all"><button class="btn  waves-effect waves-light purple-outline"><?= lang('b_viewmore') ?></button></a></span>
                                </div>
                                <div class=" col-6 d-flex align-items-center justify-content-end">
                                    <div class="icon-shape " style="background-color: #A68DDE;">
                                        <i class="fas fa-list" style="color: white; font-size: 50px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card border ">
                        <div class="card-body">
                            <h3><i class="fas fa-list text-success"></i></h3>
                            <h2 class="counter text-success p_success"></h2>
                            <span class=" fs-5 text-success"><?= lang('h_project') ?><br></span><span class=" fs-5 text-success" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_finish') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/success"><button class="btn  waves-effect waves-light btn-outline-success"><?= lang('b_viewmore') ?></button></a></span>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card border">

                        <div class="card-body">
                            <h3><i class="fas fa-list text-info"></i></h3>
                            <h2 class="counter text-info p_pending"></h2>
                            <span class=" fs-5 text-info"><?= lang('h_project') ?><br></span><span class=" fs-5 text-info" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_pendproject') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/pending"><button class="btn  waves-effect waves-light btn-outline-info"><?= lang('b_viewmore') ?></button></a></span>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <h3><i class="fas fa-list text-warning"></i></h3>
                            <h2 class="counter text-warning p_progress"></h2>
                            <span class=" fs-5 text-warning"><?= lang('h_project') ?><br></span><span class=" fs-5 text-warning" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_inprogress') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/progress"><button class="btn  waves-effect waves-light btn-outline-warning"><?= lang('b_viewmore') ?></button></a></span>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card border">
                        <div class="card-body">
                            <h3><i class="fas fa-list text-danger"></i></h3>
                            <h2 class="counter text-danger p_fail"></h2>
                            <span class=" fs-5 text-danger"><?= lang('h_project') ?><br></span><span class=" fs-5 text-danger" style=" font-weight:bold;"><?= lang('h_status') ?><?= lang('sp_home_cancel') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/fail"><button class="btn  waves-effect waves-light btn-outline-danger"><?= lang('b_viewmore') ?></button></a></span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Flot Charts JavaScript -->
<script src="<?= base_url() ?>assets/node_modules/flot/excanvas.js"></script>
<script src="<?= base_url() ?>assets/node_modules/flot/jquery.flot.js"></script>
<script src="<?= base_url() ?>assets/node_modules/flot/jquery.flot.pie.js"></script>
<script src="<?= base_url() ?>assets/node_modules/flot/jquery.flot.time.js"></script>
<script src="<?= base_url() ?>assets/node_modules/flot/jquery.flot.stack.js"></script>
<script src="<?= base_url() ?>assets/node_modules/flot/jquery.flot.crosshair.js"></script>
<script src="<?= base_url() ?>assets/node_modules/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url() ?>assets/dist/js/pages/flot-data.js"></script>
<script src="<?= base_url() ?>assets/node_modules/Chart.js/Chart.min.js"></script>
<script src="<?= base_url() ?>assets/node_modules/echarts/echarts-all.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts@5.3.1/dist/echarts.min.js"></script>
<script>
    function getProjectSummary() {
        //Start Get Project Summary
        $.ajax({
            url: 'Home/getProjectSummary',
            method: 'post'
        }).done(function(returnData) {
            $('.all').html(returnData.projectSum)
            $('.respon').html(returnData.projectRespon)
            $('.p_pending').html(returnData.projectPending)
            $('.p_progress').html(returnData.projectProgress)
            $('.p_success').html(returnData.projectSuccess)
            $('.p_fail').html(returnData.projectFail)
            $('.rp_pending').html(returnData.resprojectPending)
            $('.rp_progress').html(returnData.resprojectProgress)
            $('.rp_success').html(returnData.resprojectSuccess)
            $('.rp_fail').html(returnData.resprojectFail)
            let session = returnData.session;
            let orientPosition = "";
            let xPosition;
            let yPosition;
            var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
            const weekday = ["red", "#DFA800", "pink", "#57BF95", "#ff9900", "#00BFFF", "#993399"];
            const d = new Date();
            let color = weekday[d.getDay()];
            $('.Date').css("color", color);
            if (width < 1170) {
                orientPosition = "horizontal"
                xPosition = "center"
                yPosition = "top"
            } else {
                orientPosition = "vertical"
                xPosition = "right"
                yPosition = "bottom"
            }

            ////////////////  PieChart is a summary of Responsibility Project in System ////////////////////////////   
            if (session > 0) {
                var pieChart = echarts.init(document.getElementById("ResprojectChart"));
                // specify chart configuration item and data
                option = {

                    tooltip: {
                        trigger: 'item',
                        formatter: " {b}<br/> {c} <?= lang('h_project') ?> ({d}%)"
                    },
                    legend: {
                        // orient: 'vertical',
                        orient: orientPosition,
                        // x: 'right',
                        // y: 'center',
                        x: xPosition,
                        y: yPosition,
                        data: ['<?= lang('sp_home_finish') ?>', '<?= lang('sp_home_cancel') ?>', '<?= lang('sp_home_pendproject') ?>', '<?= lang('sp_home_inprogress') ?>']
                    },
                    toolbox: {
                        show: true,
                        feature: {
                            dataView: {
                                show: false,
                                readOnly: true
                            },
                            magicType: {
                                type: 'pie'
                            },
                            // restore: {
                            //     show: true
                            // },
                            saveAsImage: {
                                show: false
                            }
                        }
                    },
                    color: ["#00c292 ", "#FF6666", "#03a9f3", "#FEC107"],
                    // calculable : true,
                    series: [{
                        type: 'pie',
                        radius: ['40%', '80%'],
                        labelLine: {
                            length: 20
                        },
                        data: [{
                                value: returnData.resprojectSuccess,
                                name: '<?= lang('sp_home_finish') ?>'
                            },
                            {
                                value: returnData.resprojectFail,
                                name: '<?= lang('sp_home_cancel') ?>'
                            },
                            {
                                value: returnData.resprojectPending,
                                name: '<?= lang('sp_home_pendproject') ?>'
                            },
                            {
                                value: returnData.resprojectProgress,
                                name: '<?= lang('sp_home_inprogress') ?>'
                            },
                        ],
                        label: {
                            formatter: '{c} <?= lang('h_project') ?>\n ({d}%) ',
                        }
                    }]
                };

                // use configuration item and data specified to show chart
                pieChart.setOption(option, true), $(function() {
                    function resize() {
                        setTimeout(function() {
                            pieChart.resize()
                        }, 100)
                    }
                    $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
                });
            }
            ////////////////  Pie2Chart is a summary of All Project in System ////////////////////////////   
            var pie2Chart = echarts.init(document.getElementById("AllprojectChart"));
            // specify chart configuration item and data
            option = {

                tooltip: {
                    trigger: 'item',
                    formatter: " {b}<br/> {c} <?= lang('h_project') ?> ({d}%)"
                },
                legend: {
                    // orient: 'vertical',
                    orient: orientPosition,
                    // x: 'right',
                    // y: 'center',
                    x: xPosition,
                    y: yPosition,
                    data: ['<?= lang('sp_home_finish') ?>', '<?= lang('sp_home_cancel') ?>', '<?= lang('sp_home_pendproject') ?>', '<?= lang('sp_home_inprogress') ?>']
                },
                toolbox: {
                    show: true,
                    feature: {
                        dataView: {
                            show: false,
                            readOnly: true
                        },
                        magicType: {
                            type: 'pie'
                        },
                        // restore: {
                        //     show: true
                        // },
                        saveAsImage: {
                            show: false
                        }
                    }
                },
                color: ["#00c292 ", "#FF6666", "#03a9f3", "#FEC107"],
                // calculable : true,
                series: [{
                    type: 'pie',
                    radius: ['40%', '80%'],
                    labelLine: {
                        length: 20
                    },
                    data: [{
                            value: returnData.projectSuccess,
                            name: '<?= lang('sp_home_finish') ?>'
                        },
                        {
                            value: returnData.projectFail,
                            name: '<?= lang('sp_home_cancel') ?>'
                        },
                        {
                            value: returnData.projectPending,
                            name: '<?= lang('sp_home_pendproject') ?>'
                        },
                        {
                            value: returnData.projectProgress,
                            name: '<?= lang('sp_home_inprogress') ?>'
                        },
                    ],
                    label: {
                        formatter: '{c} <?= lang('h_project') ?>\n ({d}%) ',
                    }
                }]
            };

            // use configuration item and data specified to show chart
            pie2Chart.setOption(option, true), $(function() {
                function resize() {
                    setTimeout(function() {
                        pie2Chart.resize()
                    }, 100)
                }
                $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
            });

        })
    }
    // Function LoadList for Rank
    $(window).ready(getProjectSummary);
    $(window).on("resize", getProjectSummary);
    loadRankList();
    loadCauseList();
    loadToDoList();

    function loadCauseList() {
        $.ajax({
            url: 'Home/getCause',
            method: 'post'
        }).done(function(returnData) {
            // console.log(returnData)
            $('#listDiv2').html(returnData.html)
        })
    }

    function loadRankList() {
        $.ajax({
            url: 'Home/getRank',
            method: 'post'
        }).done(function(returnData) {
            // console.log(returnData)
            $('#listDiv').html(returnData.html)
        })
    }

    function loadToDoList() {
        $.ajax({
            url: 'Home/getToDoList',
            method: 'post'
        }).done(function(returnData) {
            //  console.log(returnData)
            $('#todolist').html(returnData.html)
        })
    }

    // End Function LoadList for Rank

    getProjectSummary();
    var realTimeData = setInterval(getProjectSummary, 10000);
    var realTimeRank = setInterval(loadList, 10000);
    //End Get Project Summary
</script>