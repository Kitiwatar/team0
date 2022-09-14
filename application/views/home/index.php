<!-- 
    Author: Kitiwat Arunwong
    Update: 2022-09-15 Kitiwat Arunwong
-->

<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="card border">
            <div class="card-body">
                <a href="<?= base_url() ?>home/all">
                    <div class="row">
                        <div class="col-md-12">
                            <h3><i class="mdi mdi-view-headline"></i></h3>
                            <h2 class="counter text-primary text-end" id="all"></h2>
                            <p class="text-muted">โครงการทั้งหมด</p>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="card border">
            <div class="card-body">
                <a href="<?= base_url() ?>home/all">
                    <div class="row">
                        <div class="col-md-12">
                            <h3><i class="mdi mdi-library-books" style="color: #FEC107;"></i></h3>
                            <h2 class="counter text-end" style="color: #FEC107;">23</h2>
                            <p class="text-muted">รอดำเนินการ</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 85%; height: 6px; background-color: #FEC107;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="card border">
            <div class="card-body">
                <a href="<?= base_url() ?>home/all">
                    <div class="row">
                        <div class="col-md-12">
                            <h3><i class="ti-pencil-alt" style="color: #03A9F3;"></i></h3>
                            <h2 class="counter text-end" style="color: #03A9F3;">23</h2>
                            <p class="text-muted">กำลังดำเนินการ</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 85%; height: 6px; background-color: #03A9F3;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-pie-chart" style="width:100%; height: 454px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="row">
            <div class="card" style="background-color:#56BDC6;">
                <div class="card-body">
                    <div>
                        <h2 align="right" style="color:white;">เสร็จสิ้น</h2>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="row" style="color:white;">
                        <div class="col">
                            <div class="mdi mdi-bookmark-check" style="font-size: 80px;"></div>
                        </div>
                        <div class="col">
                            <div align="right" class="my-2" style="font-size: 100px;">18</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card" style="background-color:#E46A76;">
                <div class="card-body">
                    <div>
                        <h2 align="right" style="color:white;">ยกเลิก</h2>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 0%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row" style="color:white;">
                            <div class="col">
                                <div class="mdi mdi-emoticon-sad" style="font-size: 100px;"></div>
                            </div>
                            <div class="col">
                                <div align="right" class="my-2" style="font-size: 100px;">18</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
<script>
    //Flot Pie Chart
    $(function() {
        var data = [{
            label: "เสร็จสิ้น",
            data: 10,
            color: "#57BF95",
        }, {
            label: "ยกเลิก",
            data: 1,
            color: "#FF6666",
        }, {
            label: "รอดำเนินการ",
            data: 3,
            color: "#FEC107",
        }, {
            label: "กำลังดำเนินการ",
            data: 1,
            color: "#03A9F3",
        }];
        var plotObj = $.plot($("#flot-pie-chart"), data, {
            series: {
                pie: {
                    innerRadius: 0.5,
                    show: true
                }
            },
            grid: {
                hoverable: true
            },
            color: null,
            tooltip: true,
            tooltipOpts: {
                content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            }
        });
    });
    plotObj.setOption(option, true), $(function() {
        function resize() {
            setTimeout(function() {
                plotObj.resize()
            }, 100)
        }
        $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
    });
</script>

<script>
    startTime();

    function startTime() {
        const today = new Date();
        let h = today.getHours();
        let m = today.getMinutes();
        let s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        if (s % 10 == 0) {
            getCountProject();
        }

        setTimeout(startTime, 1000);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }; // add zero in front of numbers < 10
        return i;
    }
    //Start Get Project SUM
    function getCountProject() {
        $.ajax({
            url: 'Home/getProjectSum',
            method: 'post'
        }).done(function(returnData) {
            $('#all').html(returnData.projectSum)
        })
    }
    getCountProject();
    //End Get Project SUM
</script>