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
    width: 100px;
    height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 25px;
    box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15) !important;
  }
</style>

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
      url: '<?= base_url() ?>Home/getProjectSummary',
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
          color: ["#00c292 ", "#FF6666", "#FEC107", "#03a9f3"],
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
        color: ["#00c292 ", "#FF6666", "#FEC107", "#03a9f3"],
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

  function loadCauseList() {
    $.ajax({
      url: '<?= base_url() ?>Home/getCause',
      method: 'post'
    }).done(function(returnData) {
      // console.log(returnData)
      $('#listDiv2').html(returnData.html)
    })
  }

  function loadRankList() {
    $.ajax({
      url: '<?= base_url() ?>Home/getRank',
      method: 'post'
    }).done(function(returnData) {
      // console.log(returnData)
      $('#listDiv').html(returnData.html)
    })
  }

  function loadToDoList() {
    $.ajax({
      url: '<?= base_url() ?>Home/getToDoList',
      method: 'post'
    }).done(function(returnData) {
      //  console.log(returnData)
      $('#todolist').html(returnData.html)
    })
  }

  function loadCancelList() {
    $.ajax({
      url: '<?= base_url() ?>Home/getCancelRank',
      method: 'post'
    }).done(function(returnData) {
      // console.log(returnData)
      $('#listDiv2').html(returnData.html)
    })
  }

  function loadToDoList() {
    $.ajax({
      url: '<?= base_url() ?>Home/getToDoList',
      method: 'post'
    }).done(function(returnData) {
      //  console.log(returnData)
      $('#todolist').html(returnData.html)
    })
  }


  // End Function LoadList for Rank

  getProjectSummary();
  loadRankList();
  // loadCauseList();
  loadToDoList();

  refreshData();
  loadCancelList();

  function refreshData() {
    var downloadTimer = setInterval(function() {
      getProjectSummary();
      loadRankList();
      // loadCauseList();
      loadToDoList();
      loadCancelList();
    }, 1000 * 60 * 30);
  }

  function viewProject(p_status, u_id) {
    $.ajax({
      method: "post",
      url: '<?= base_url() ?>home/getProjects',
      data: {
        p_status: p_status,
        u_id: u_id
      }
    }).done(function(returnData) {
      $('#detailModalTitle').html(returnData.title);
      $('#detailModalBody').html(returnData.body);
      $('#detailModalFooter').html("");
      $('#detailModal').modal();
    });
  }

  function checkLessThanTen(i) {
    if (i < 10) {
      i = "0" + i;
    }
    return i;
  }


  function refreshTime() {
    var monthNamesThai = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤษจิกายน", "ธันวาคม"];
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    h = checkLessThanTen(h);
    m = checkLessThanTen(m);
    document.getElementById('timeNow').innerHTML = h + ":" + m;
    document.getElementById('dayNow').innerHTML = today.getDate();
    document.getElementById('monthNow').innerHTML = monthNamesThai[today.getMonth()];
    document.getElementById('yearNow').innerHTML = today.getFullYear() + 543;
    var downloadTimer = setInterval(function() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      h = checkLessThanTen(h);
      m = checkLessThanTen(m);
      document.getElementById('timeNow').innerHTML = h + ":" + m;
      document.getElementById('dayNow').innerHTML = today.getDate();
      document.getElementById('monthNow').innerHTML = monthNamesThai[today.getMonth()];
      document.getElementById('yearNow').innerHTML = today.getFullYear() + 543;
    }, 1000);
  }
  refreshTime();
  //End Get Project Summary
</script>
<!------------------------------------------------------------------ Dashbaord For User ------------------------------------------------------------------>
<?php if (isset($_SESSION['u_id'])) : ?>
  <div class="row">
    <div class="col-lg-4 col-md-12 col-sm-12">
      <div class="card" style="height: 95%;">
        <div class="card-body">
          <div class="row">
            <?php date_default_timezone_set("Asia/Bangkok"); ?>
            <div class="col-lg-12 col-md-12 Date" style="font-size: 45px; font-weight:bold;">วันที่ <span id="dayNow"></span></div>
            <div class="pb-4 col-lg-12 col-md-12" style="font-size: 45px; font-weight:bold;"><span id="monthNow"></span> <span id="yearNow"></span></div>
            <div class="col-lg-12 col-md-12" style="font-size: 20px;">เวลาปัจจุบัน </div>
            <?php if ($_SESSION['lang'] == "th") :  ?>
              <div class="col-lg-12 col-md-12" style="font-size: 70px; font-weight:bold; color:#03A9F3;"><span id="timeNow"></span> น.</div>
            <?php else : ?>
              <div class="col-lg-12 col-md-12" style="font-size: 70px; font-weight:bold; color:#03A9F3;"><span id="timeNow"></span></div>
            <?php endif; ?>
            <div class="col-lg-3 col-md-3">
              <i class="far fa-envelope" style="font-size: 70px;"></i>
            </div>
            <div class="col-lg-9 col-md-9">
              <div style="font-size: 18px;">ข้อความจากระบบ </div>
              <div style="font-size: 23px; font-weight:bold;">"สวัสดีคุณ <?= $_SESSION['u_firstname'] ?>"</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-md-12 col-sm-12">
      <div class="card" style="height: 95%;" id="todolist">
      </div>
    </div>
    <div class="col-lg-12 col-md-12 mt-3">
      <div class="card p-2" style="background-color: #03A9F3;">
        <div style="color:white;" class="fs-4 px-2">ภาพรวมโครงการที่มีส่วนเกี่ยวข้อง พ.ศ <?= $date = date('Y') + 543; ?></div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="fs-3">กราฟแสดงจำนวนโครงการที่มีส่วนเกี่ยวข้องตามสถานะ</div>
            <div id="ResprojectChart" class="py-5 pe-3" style="width:100%; height:520px;"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="fs-3"><?= lang('sp_home_responproject') ?></div>
              <div class="row">
                <div class="col-6">
                  <h2 class="counter respon" style="font-size: 140px; color: #ED9B7E;"></h2>
                </div>
                <div class="col-6 text-end">
                  <i class="fas fa-list rounded-circle p-5" style="color: green; font-size: 40px; color: white; background-color: #ED9B7E;"></i>
                </div>
                <div class="col-12">
                  <button class="btn waves-effect waves-light brown-outline" onclick="viewProject(0,<?= $_SESSION['u_id'] ?>)"><?= lang('b_viewmore') ?></button>
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
              <div class="row">
                <div class="col-lg-12 col-md-12 fs-5 text-success">
                  <div><?= lang('h_project') ?></div>
                  <div class="fw-bold"><?= lang('h_status') ?><?= lang('sp_home_finish') ?></div>
                </div>
                <div class="col-lg-12 col-md-12 text-end">
                  <button class="btn waves-effect waves-light btn-outline-success" onclick="viewProject(3,<?= $_SESSION['u_id'] ?>)"><?= lang('b_viewmore') ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="card border">
            <div class="card-body">
              <h3><i class="fas fa-list text-warning"></i></h3>
              <h2 class="counter text-warning rp_pending" style="font-size: 100px;"></h2>
              <div class="row">
                <div class="col-lg-12 col-md-12 fs-5 text-warning ">
                  <div><?= lang('h_project') ?></div>
                  <div class="fw-bold"><?= lang('h_status') ?><?= lang('sp_home_pendproject') ?></div>
                </div>
                <div class="col-lg-12 col-md-12 text-end">
                  <button class="btn waves-effect waves-light btn-outline-warning" onclick="viewProject(1,<?= $_SESSION['u_id'] ?>)"><?= lang('b_viewmore') ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="card border">
            <div class="card-body">
              <h3><i class="fas fa-list text-info"></i></h3>
              <h2 class="counter text-info rp_progress" style="font-size: 100px;"></h2>
              <div class="row">
                <div class="col-lg-12 col-md-12 fs-5 text-info">
                  <div><?= lang('h_project') ?></div>
                  <div class="fw-bold"><?= lang('h_status') ?><?= lang('sp_home_inprogress') ?></div>
                </div>
                <div class="col-lg-12 col-md-12 text-end">
                  <button class="btn waves-effect waves-light btn-outline-info" onclick="viewProject(2,<?= $_SESSION['u_id'] ?>)"><?= lang('b_viewmore') ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="card border">
            <div class="card-body">
              <h3><i class="fas fa-list text-danger"></i></h3>
              <h2 class="counter text-danger rp_fail" style="font-size: 100px;"></h2>
              <div class="row">
                <div class="col-lg-12 col-md-12 fs-5 text-danger">
                  <div><?= lang('h_project') ?></div>
                  <div class="fw-bold"><?= lang('h_status') ?><?= lang('sp_home_cancel') ?></div>
                </div>
                <div class="col-lg-12 col-md-12 text-end">
                  <button class="btn waves-effect waves-light btn-outline-danger" onclick="viewProject(4,<?= $_SESSION['u_id'] ?>)"><?= lang('b_viewmore') ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <script>
  refreshTime();
</script>