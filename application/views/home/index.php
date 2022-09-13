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
                <div id="pie-project" style="width:100%; height:400px;"></div>

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
                    <div class="flot-chart-content" id="flot-pie-chart" style="width:100%; height:400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Flot Charts JavaScript -->
<script src="<?=base_url()?>assets/node_modules/flot/excanvas.js"></script>
<script src="<?=base_url()?>assets/node_modules/flot/jquery.flot.js"></script>
<script src="<?=base_url()?>assets/node_modules/flot/jquery.flot.pie.js"></script>
<script src="<?=base_url()?>assets/node_modules/flot/jquery.flot.time.js"></script>
<script src="<?=base_url()?>assets/node_modules/flot/jquery.flot.stack.js"></script>
<script src="<?=base_url()?>assets/node_modules/flot/jquery.flot.crosshair.js"></script>
<script src="<?=base_url()?>assets/node_modules/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="<?=base_url()?>assets/dist/js/pages/flot-data.js"></script>
<script>
    var pieChart = echarts.init(document.getElementById("pie-project"));

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
            data: ['รอดำเนินการ', 'กำลังดำเนินการ', 'เสร็จสิ้น', 'ยกเลิก']
        },
        toolbox: {
            show: true,
            feature: {
                dataView: {
                    show: true,
                    readOnly: true
                },
                magicType: {
                    type: 'pie'
                },
                // restore: {
                //     show: true
                // },
                saveAsImage: {
                    show: true
                }
            }
        },
        color: ["#fec107", "#03a9f3", "#00c292", "#e46a76"],
        // calculable : true,
        series: [{
            name: 'กราฟแสดงจำนวนโครงการตามสถานะ',
            type: 'pie',
            labelLine: {
                length: 20
            },
            label: {
                formatter: '{c} โครงการ\n ({d}%) ',

            },
            data: [{
                    value: 10,
                    name: 'รอดำเนินการ'
                },
                {
                    value: 5,
                    name: 'กำลังดำเนินการ'
                },
                {
                    value: 80,
                    name: 'เสร็จสิ้น'
                },
                {
                    value: 5,
                    name: 'ยกเลิก'
                },
            ]
        }]
    };
    pieChart.setOption(option, true), $(function() {
        function resize() {
            setTimeout(function() {
                pieChart.resize()
            }, 100)
        }
        $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
    });
    pieChart.setOption(option, true), $(function() {
        function resize() {
            setTimeout(function() {
                pieChart.resize()
            }, 100)
        }
        $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
    });
</script>

<script>
    //Flot Pie Chart
    $(function() {
        var data = [{
            label: "Series 0",
            data: 10,
            color: "#4f5467",
        }, {
            label: "Series 1",
            data: 1,
            color: "#26c6da",
        }, {
            label: "Series 2",
            data: 3,
            color: "#009efb",
        }, {
            label: "Series 3",
            data: 1,
            color: "#7460ee",
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
        if(s % 5 == 0) {
            var data = parseInt(document.getElementById('all').innerHTML);
            document.getElementById('all').innerHTML =  data + 5;
        } 
        
        setTimeout(startTime, 1000);
    }

    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
</script>