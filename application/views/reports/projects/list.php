 <!-- Create by: Patiphan Pansanga, Jiradat Pomyai 19-09-2565 -->
 <style>
   i.circle {
     border-radius: 10%;
     width: 80px;
     height: 80px;
     padding: 0.5em 0.6em;
   }

   .colum-flex {
     justify-content: center;
     display: flex;
     flex-flow: column;
     align-items: center;
     margin-bottom: 10px;
   }
 </style>
 <div class="row">
   <div class="col-lg-7 col-md-7 col-sm-12 pb-5">
     <div class="card" style="height: 100%;">
       <div class="card-body">
         <h2 class='card-title'><?= lang('rp_project-g') ?></h2>
         <span style="color:#6C757D;"><?= lang('pc-s') ?></span>
         <table>
           <tr>
             <td><?= lang('start_project') ?> </td>
             <td>
               <select class="form-select" name="begindate" id="begindate" onchange="changeYear()">
                 <?php if ($begindate == 0) {
                    echo '<option selected value="0">' . lang('all') . '</option>';
                  } else {
                    echo '<option value="0">ทั้งหมด</option>';
                  }
                  for ($i = 0; $i < 5; $i++) {
                    if (date("Y") - $i == $begindate) {
                      echo '<option selected value="' . (date("Y") - $i) . '">' . (date("Y") - $i) . '</option>';
                    } else {
                      echo '<option value="' . (date("Y") - $i) . '">' . (date("Y") - $i) . '</option>';
                    }
                  }
                  ?>
               </select>
             </td>
             <td class="ps-3"><?= lang('end_project') ?> </td>
             <td>
               <select class="form-select" name="enddate" id="enddate" onchange="changeYear()">
                 <?php if ($enddate == 0) {
                    echo '<option selected value="0">' . lang('all') . '</option>';
                  } else {
                    echo '<option value="0">ทั้งหมด</option>';
                  }
                  for ($i = 0; $i < 5; $i++) {
                    if (date("Y") - $i == $enddate) {
                      echo '<option selected value="' . (date("Y") - $i) . '">' . (date("Y") - $i) . '</option>';
                    } else {
                      echo '<option value="' . (date("Y") - $i) . '">' . (date("Y") - $i) . '</option>';
                    }
                  }
                  ?>
               </select>
             </td>
           </tr>
         </table>
       </div>
       <div id="projectChart" style="width:100%; height: 100%;" class="mt-4 mb-3"></div>
     </div>
   </div>
   <div class="col-lg-5 col-md-5 col-sm-12">
     <?php $icons = array("fas fa-file-alt", "far fa-edit ", "fa fa-file-powerpoint ", " far fa-file-excel ") ?>
     <?php $btn = array("btn-outline-warning", "btn-outline-info ", "btn-outline-success ", "btn-outline-danger") ?>
     <?php $colors = array("#FEC107", "#03A9F3", "#57BF95", "#E46A76") ?>
     <?php for ($i = 0; $i < 4; $i++) { ?>
       <div class="card mb-4" style="border-left: 15px solid; border-color:<?= $colors[$i] ?>;">
         <div class="card-body pb-0 mb-0">
           <div class="d-flex align-items-center">
             <div class="col-9">
               <div style="font-size:24px;border:none; "><?= lang('num-project') ?><?= $projectStatus[$i + 1] ?>
                 <br>
                 <span style="font-size: 90px; margin-right: 20px; padding-bottom:0px"><?= $projectCount[$i] ?></span>
                 <span style="font-size:20px;padding:0px"><?= lang('project') ?></span>
               </div>
             </div>
             <div class="col-3 colum-flex">
               <i class=" <?= $icons[$i] ?> circle" style="font-size: 40px; background-color: <?= $colors[$i] ?>;; color:white; "></i>
               <br>
               <button class="mb-1 btn waves-effect waves-light <?= $btn[$i] ?>" onclick="viewProject(<?= $i + 1 ?>,0)"><?= lang('b_viewmore') ?></button>
             </div>
           </div>
         </div>
       </div>
     <?php } ?>
   </div>
   <div class="col-12">
     <div class="card px-3">
       <div class="table-responsive my-3">
         <h3 class="card-title"><?= lang('all_project') ?></h3>
         <table class="display table dt-responsive nowrap" id="table_reportproject">
           <thead>
             <tr>
               <th><?= lang('st-project') ?></th>
               <th><?= lang('et-project') ?></th>
               <th><?= lang('tl_project_pj-name') ?></th>
               <th><?= lang('tl_project_pj-status') ?></th>
             </tr>
           </thead>
           <tbody>
             <?php if (is_array($projectData)) : $count = 1 ?>
               <?php foreach ($projectData as $key => $value) : ?>
                 <?php if ($value->p_status < 1) : continue;
                  endif; ?>
                 <tr id="<?= "project" . $value->p_id ?>">
                   <td><?= ($_SESSION['lang'] == "th") ? (date("Y", strtotime($value->p_createdate)) + 543) : date("Y", strtotime($value->p_createdate)); ?><?= date("-m-d", strtotime($value->p_createdate)) ?></td>
                   <?php if ($value->p_enddate != null) { ?>
                     <td><?= ($_SESSION['lang'] == "th") ? (date("Y", strtotime($value->p_enddate)) + 543) : date("Y", strtotime($value->p_enddate)); ?><?= date("-m-d", strtotime($value->p_enddate)) ?></td>
                   <?php } else { ?>
                     <td>-</td>
                   <?php } ?>
                   <td><?= $value->p_name ?></td>
                   <td>
                     <?php $statusColor = array(1 => "badge rounded-pill bg-warning", 2 => "badge rounded-pill bg-info", 3 => "badge rounded-pill bg-success", 4 => "badge rounded-pill bg-danger");
                      $statusName = array(1 => lang('sp_home_pendproject'), 2 => lang('sp_home_inprogress'), 3 => lang('sp_home_finish'), 4 => lang('sp_home_cancel'));
                      if ($value->p_status > 0) {
                        echo "<span  class = ' " . $statusColor[$value->p_status] . "'>" . $statusName[$value->p_status] . "</span>";
                      } else {
                        echo "<span  class = 'badge rounded-pill bg-dark'>ถูกลบ</span>";
                      }
                      ?>
                   </td>

                 </tr>
               <?php endforeach; ?>
             <?php endif; ?>
           </tbody>
         </table>
         <a type="button" class="btn waves-effect waves-light btn-dark" href="<?= base_url() ?>"><i class="mdi mdi-arrow-left"></i> <?= lang('b_project_back') ?></a>

       </div>

     </div>
   </div>
 </div>
 <script>
   pdfMake.fonts = {
     THSarabun: {
       normal: 'THSarabun.ttf',
       bold: 'THSarabun-Bold.ttf',
       italics: 'THSarabun-Italic.ttf',
       bolditalics: 'THSarabun-BoldItalic.ttf'
     }
   }
   $('#table_reportproject').DataTable({
     dom: 'Bftlp',
     buttons: [{
         extend: 'excel',
         filename: "รายงานโครงการ",
         title: "รายงานโครงการ",
         exportOptions: {
           columns: [0, 1, 2, 3, 4]
         },
         customize: function(xlsx) {
           var sheet = xlsx.xl['styles.xml'];
           var fontSize = sheet.getElementsByTagName('sz');
           var fontName = sheet.getElementsByTagName('name');
           for (i = 0; i < fontSize.length; i++) {
             fontSize[i].setAttribute("val", "16")
             fontName[i].setAttribute("val", "TH Sarabun New")
           }
         }
       },
       { // กำหนดพิเศษเฉพาะปุ่ม pdf
         extend: 'pdf', // ปุ่มสร้าง pdf ไฟล์
         text: 'PDF', // ข้อความที่แสดง
         filename: "รายงานโครงการ",
         title: "รายงานโครงการ",
         pageSize: 'A4', // ขนาดหน้ากระดาษเป็น A4
         exportOptions: {
           columns: [0, 1, 2, 3, 4]
         },
         customize: function(pdf) { // ส่วนกำหนดเพิ่มเติม ส่วนนี้จะใช้จัดการกับ pdfmake
           // กำหนด style หลัก
           pdf.content[1].layout = {
             hLineWidth: function(i, node) {
               return 1;
             },
             vLineWidth: function(i, node) {
               return 1;
             },
             hLineColor: function(i, node) {
               return 'black';
             },
             vLineColor: function(i, node) {
               return 'black';
             }
           };
           pdf.styles = {
             tableHeader: {
               alignment: 'center',
               fillColor: 'white',
               bold: 1,
             }
           };
           pdf.defaultStyle = {
             font: 'THSarabun',
             fontSize: 16
           };
           pdf.styles.title = {
             alignment: 'center',
             fontSize: '20',
             bold: !0,
           };
           // กำหนดความกว้างของ header แต่ละคอลัมน์หัวข้อ
           pdf.content[1].table.widths = [40, 150, 90, 100, 100];
           pdf.styles.tableHeader.fontSize = 16; // กำหนดขนาด font ของ header
           var rowCount = pdf.content[1].table.body.length; // หาจำนวนแถวทั้งหมดในตาราง
           // วนลูปเพื่อกำหนดค่าแต่ละคอลัมน์ เช่นการจัดตำแหน่ง
           for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
             pdf.content[1].table.body[i][0].alignment = 'center'; // คอลัมน์แรกเริ่มที่ 0
           };
         }
       }, // สิ้นสุดกำหนดพิเศษปุ่ม pdf
     ],
     "language": {
       "oPaginate": {
         "sPrevious": "<?= lang('b_project_previous') ?>",
         "sNext": "<?= lang('b_project_next') ?>"
       },
       "sInfo": "<?= lang('tl_project_pj-numbershow') ?> _START_ ถึง _END_ จาก _TOTAL_ <?= lang('tl_project_pj-list') ?>",
       "sInfoEmpty": "<?= lang('tl_project_pj-numbershow') ?> 0 ถึง 0 จาก 0 <?= lang('tl_project_pj-list') ?>",
       "sLengthMenu": "<?= lang('tl_project_pj-numbershow') ?> _MENU_ <?= lang('tl_project_pj-list') ?>",
       "sSearch": "<?= lang('in_project_search') ?> ",
       "sInfoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
       "sZeroRecords": "<?= lang('in_project_zerorecords') ?>"
     }
   });
   $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn waves-effect waves-light btn-info mx-1');
   $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').removeClass("dt-button");
   $('.buttons-excel').html('<i class="mdi mdi-file-excel-box"></i> Excel');
   $('.buttons-pdf').html('<i class="mdi mdi-file-pdf-box"></i> PDF');

   $('[data-toggle="tooltip"]').tooltip();

   if (typeof orientPosition !== 'undefined') {
     let orientPosition = "";
     let xPosition;
     let yPosition;
   }

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
       orient: 'horizontal',
       //  orient: orientPosition,
       x: 'center',
       y: 'bottom',
       //  x: xPosition,
       //  y: yPosition,
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
     color: ["#FEC107", "#03A9F3", "#57BF95", "#FF6666"],
     // calculable : true,
     series: [{
       type: 'pie',
       radius: ['40%', '80%'],
       labelLine: {
         length: 20
       },
       data: [{
           value: <?= $projectCount[0] ?>,
           name: '<?= lang('sp_home_pendproject') ?>'
         },
         {
           value: <?= $projectCount[1] ?>,
           name: '<?= lang('sp_home_inprogress') ?>'
         },
         {
           value: <?= $projectCount[2] ?>,
           name: '<?= lang('sp_home_finish') ?>'
         },
         {
           value: <?= $projectCount[3] ?>,
           name: '<?= lang('sp_home_cancel') ?>'
         },
       ],
       label: {
         show: true,
         formatter: '{b} \n ({d}%) ',
         //  formatter: '{c} <?= lang('h_project') ?>\n ({d}%) ',
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
 </script>