<!-- Create by: Kitiwat Arunwong 24-09-2565 -->
<style>
    .cardProject:hover {
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }
</style>
<div class="">
    <div class="row g-0">
        <div class="col-lg-4 col-md-4">
            <div class="card border cardProject">
                <a href="<?= base_url() ?>home/viewProjects/all">
                    <div class="card-body">
                        <h3><i class="mdi mdi-view-headline" style="color: #fb9678;"></i></h3>
                        <h2 class="counter text-primary text-end" id="all"></h2>
                        <p class="text-muted">โครงการทั้งหมด</p>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="card border cardProject">
                <a href="<?= base_url() ?>home/viewProjects/pending">
                    <div class="card-body">
                        <h3><i class="mdi mdi-library-books" style="color: #FEC107;"></i></h3>
                        <h2 class="counter text-end" style="color: #FEC107;" id="p_pending"></h2>
                        <p class="text-muted">รอดำเนินการ</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%; height: 6px; background-color: #FEC107;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="card border cardProject">
                <a href="<?= base_url() ?>home/viewProjects/progress">
                    <div class="card-body">
                        <h3><i class="ti-pencil-alt" style="color: #03A9F3;"></i></h3>
                        <h2 class="counter text-end" style="color: #03A9F3;" id="p_progress"></h2>
                        <p class="text-muted">กำลังดำเนินการ</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%; height: 6px; background-color: #03A9F3;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card p-2">
                <div class="card-body">
                    <div id="projectChart" style="width:100%; height:343px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card cardProject" style="background-color:#57BF95;">
                        <a href="<?= base_url() ?>home/viewProjects/success">
                            <div class="card-body">
                                <div>
                                    <div class="mdi mdi-bookmark-check" style="font-size: 40px; color:white;" align="right"></div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="row" style="color:white;">
                                    <div class="col">
                                        <div style="font-size: 30px;" id="p_success"></div>
                                        <div style="font-size: 20px;">เสร็จสิ้น</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card cardProject" style="background-color:#E46A76;">
                        <a href="<?= base_url() ?>home/viewProjects/fail">
                            <div class="card-body">
                                <div class="mdi mdi-emoticon-sad" style="font-size: 40px; color: white;" align="right"></div>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 0%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="row" style="color:white;">
                                    <div class="col">
                                        <div class="my-2" style="font-size: 30px;" id="p_fail"></div>
                                        <div style="font-size: 20px;">ยกเลิก</div>
                                    </div>
                                    <div class="col">
                                    </div>
                                </div>
                            </div>
                        </a>
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

            var pieChart = echarts.init(document.getElementById("projectChart"));
            // specify chart configuration item and data
            option = {

                tooltip: {
                    trigger: 'item',
                    formatter: " {b}<br/> {c} โครงการ ({d}%)"
                },
                legend: {
                    orient: 'vertical',
                    x: 'right',
                    y: 'center',
                    data: ['เสร็จสิ้น', 'ยกเลิก', 'รอดำเนินการ', 'กำลังดำเนินการ']
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
                            name: 'เสร็จสิ้น'
                        },
                        {
                            value: returnData.projectFail,
                            name: 'ยกเลิก'
                        },
                        {
                            value: returnData.projectPending,
                            name: 'รอดำเนินการ'
                        },
                        {
                            value: returnData.projectProgress,
                            name: 'กำลังดำเนินการ'
                        },
                    ],
                    label: {
                        formatter: '{c} โครงการ\n ({d}%) ',
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
    var realTimeData = setInterval(getProjectSummary, 1800000);
    var realTimeRank = setInterval(loadList, 1800000);
    //End Get Project Summary
</script>