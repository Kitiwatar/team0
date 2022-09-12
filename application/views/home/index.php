<div class="row g-0">
    <div class="col-lg-3 col-md-6">
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
<div class="row g-0">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <div id="pie-project" style="width:100%; height:250px;"></div>

            </div>
        </div>
    </div>
</div>
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
            data: [, 'รอดำเนินการ', 'กำลังดำเนินการ', 'เสร็จสิ้น', 'ยกเลิก']
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
        color: ["#FF3366", "#7460ee", "#ffbc34", "#D3D3D3"],
        // calculable : true,
        series: [{
            name: 'กราฟแสดงจำนวนบุคลากรตามระดับการศึกษา',
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