<div class="row">
    <div class="col-lg-4 col-md-4">
        <div class="card border">
            <div class="card-body">
                <a href="<?= base_url() ?>home/all">
                    <div class="row">
                        <div class="col-md-12">
                            <h3><i class="icon-screen-desktop"></i></h3>
                            <h2 class="counter text-primary text-end" id="all">23</h2>
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
                            <h3><i class="icon-screen-desktop"></i></h3>
                            <h2 class="counter text-primary text-end">23</h2>
                            <p class="text-muted">โครงการทั้งหมด</p>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                            <h3><i class="icon-screen-desktop"></i></h3>
                            <h2 class="counter text-primary text-end">23</h2>
                            <p class="text-muted">โครงการทั้งหมด</p>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pie Chart</h4>
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-pie-chart" style="width:100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
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
            label: "รอการดำเนินงาน",
            data: 10,
            color: "#56BDC6",
        }, {
            label: "ยกเลิก",
            data: 1,
            color: "#E46A76",
        }, {
            label: "รอดำเนินการ",
            data: 3,
            color: "#4BA6ED",
        }, {
            label: "กำลังดำเนินการ",
            data: 1,
            color: "#A68DDE",
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
        if (s % 5 == 0) {
            var data = parseInt(document.getElementById('all').innerHTML);
            document.getElementById('all').innerHTML = data + 5;
        }

        setTimeout(startTime, 1000);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }; // add zero in front of numbers < 10
        return i;
    }
</script>