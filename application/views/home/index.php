<!-- Create by: Kitiwat Arunwong 24-09-2565 -->
<style>
    .cardProject:hover {
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
</style>
<div class="">
    <div class="row g-0">
        <div class="col-lg-4 col-md-4">
            <div class="card border ">

                <div class="card-body">
                    <h3><i class="fas fa-list" style="color: #fb9678;"></i></h3>
                    <h2 class="counter text-primary text-end" id="all"></h2>
                    <span class="text-muted fs-5"><?= lang('sp_home_allproject') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/all"><button class="btn  waves-effect waves-light btn-outline-primary"><?= lang('b_viewmore') ?></button></a></span>
                    <div class="progress mt-3">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="card border">
                <div class="card-body">
                    <h3><i class="mdi mdi-library-books" style="color: #FEC107;"></i></h3>
                    <h2 class="counter text-end" style="color: #FEC107;" id="p_pending"></h2>
                    <span class="text-muted fs-5"><?= lang('sp_home_pendproject') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/pending"><button class="btn  waves-effect waves-light btn-outline-warning"><?= lang('b_viewmore') ?></button></a></span>
                    <div class="progress mt-3">
                        <div class="progress-bar" role="progressbar" style="width: 100%; height: 6px; background-color: #FEC107;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="card border">
                <div class="card-body">
                    <h3><i class="far fa-edit" style="color: #03A9F3;"></i></h3>
                    <h2 class="counter text-end" style="color: #03A9F3;" id="p_progress"></h2>
                    <span class="text-muted fs-5"><?= lang('sp_home_inprogress') ?></span><span class="float-end text-muted" style="font-size: 12px;"><a href="<?= base_url() ?>home/viewProjects/progress"><button class="btn waves-effect waves-light btn-outline-info"><?= lang('b_viewmore') ?></button></a></span>
                    <div class="progress mt-3">
                        <div class="progress-bar" role="progressbar" style="width: 100%; height: 6px; background-color: #03A9F3;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card p-2">
                <div class="card-body">
                    <div id="projectChart" style="width:100%; height:380px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card" style="background-color:#57BF95;">
                        <div class="card-body">
                            <div class="row mt-2" style="color:white;">
                                <div class="col-12">
                                    <div class="text-end fs-2"><?= lang('sp_home_finish') ?></div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6"><i class="mdi mdi-bookmark-check" style="font-size: 60px; color:white;"></i></div>
                                        <div class="col-6 pt-3">
                                            <div style="font-size: 40px;" class="text-end p-0" id="p_success"></div>
                                            <div class="text-end"><a href="<?= base_url() ?>home/viewProjects/success"><button class="btn waves-effect waves-light btn-outline-light"><?= lang('b_viewmore') ?></button></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card" style="background-color:#E46A76;">
                        <div class="card-body">
                            <div class="row mt-2" style="color:white;">
                                <div class="col-12">
                                    <div class="text-end fs-2"><?= lang('sp_home_cancel') ?></div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6"><i class="mdi mdi-emoticon-sad" style="font-size: 60px; color:white;"></i></div>
                                        <div class="col-6 pt-3">
                                            <div style="font-size: 40px;" class="text-end p-0" id="p_fail"></div>
                                            <div class="text-end"><a href="<?= base_url() ?>home/viewProjects/fail"><button class="btn waves-effect waves-light btn-outline-light"><?= lang('b_viewmore') ?></button></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div id="listDiv"></div>
    </div>
</div>
</div>
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
            $('#all').html(returnData.projectSum)
            $('#p_pending').html(returnData.projectPending)
            $('#p_progress').html(returnData.projectProgress)
            $('#p_success').html(returnData.projectSuccess)
            $('#p_fail').html(returnData.projectFail)
            let orientPosition = "";
            let xPosition;
            let yPosition;
            var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
            if (width < 1170) {
                orientPosition = "horizontal"
                xPosition = "center"
                yPosition = "top"
            } else {
                orientPosition = "vertical"
                xPosition = "right"
                yPosition = "center"
            }
            var pieChart = echarts.init(document.getElementById("projectChart"));
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
                color: ["#57BF95", "#FF6666", "#FEC107", "#03A9F3"],
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
            pieChart.setOption(option, true), $(function() {
                function resize() {
                    setTimeout(function() {
                        pieChart.resize()
                    }, 100)
                }
                $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
            });

        })
    }
    // Function LoadList for Rank
    $(window).ready(getProjectSummary);
    $(window).on("resize", getProjectSummary);

    loadList();

    function loadList() {
        $.ajax({
            url: 'Home/getRank',
            method: 'post'
        }).done(function(returnData) {
            // console.log(returnData)
            $('#listDiv').html(returnData.html)
        })
    }
    // End Function LoadList for Rank

    getProjectSummary();
    var realTimeData = setInterval(getProjectSummary, 10000);
    var realTimeRank = setInterval(loadList, 10000);
    //End Get Project Summary
</script>