 <!-- Create by : Kitiwat Arunwong 24/09/2565 -->
 <div class="row">
   <div class="col-12">
     <div class="card">
       <div class="card-body">
         <div class="table-responsive my-2">
           <table class="display table dt-responsive nowrap" id="tableproject">
             <thead>
               <tr>
                 <th><?= lang('tl_project_pj-no') ?></th>
                 <th><?= lang('tl_project_pj-name') ?></th>
                 <th><?= lang('tl_project_pj-mainperson') ?></th>
                 <th><?= lang('tl_project_pj-task') ?></th>
                 <th><?= lang('tl_project_pj-status') ?></th>
               </tr>
             </thead>
             <tbody>
               <?php if (is_array($getData)) : $count = 1; date_default_timezone_set("Asia/Bangkok"); ?>
                 <?php foreach ($getData as $key => $value) : ?>
                  <?php if ($value->p_status < 1) : continue; endif; ?>
                  <?php if ($value->p_enddate != null){
                    if (substr($value->p_enddate,0,4) < date("Y")) : continue; endif;
                  } ?>
                   <tr>
                     <td class="text-center"><?= $count++ ?></td>
                     <td><?= $value->p_name ?> </td>
                     <td><?= $leader[$key]->u_firstname . ' ' . $leader[$key]->u_lastname  ?></td>
                     <td>
                       <?php if (isset($lastTask[$key]->tl_name)) : ?>
                         <?= $lastTask[$key]->tl_name ?>
                       <?php else : ?>
                         <?= '-' ?>
                       <?php endif; ?>
                     </td>
                     <td>
                     <?php
                       $statusColor = array(1=>"badge rounded-pill bg-warning", 2=>"badge rounded-pill bg-info", 3=>"badge rounded-pill bg-success", 4=>"badge rounded-pill bg-danger");
                        foreach ($arrayStatus as $key => $status) {
                          if ($value->p_status == $key) {
                            echo "<span  class = ' ". $statusColor[$key] ."'>" . $status . "</span>";
                          }
                        }
                        ?>
                     </td>

                   </tr>

                 <?php endforeach; ?>
               <?php endif; ?>
             </tbody>
           </table>
         </div>
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
    var elm
    <?php if(is_array($getData)) { ?>
      elm = 'Bftlp'
    <?php } else { ?>
      elm = 'ftlp'
    <?php } ?>

   $('#tableproject').DataTable({
    
    dom: elm,
     buttons: [{
         extend: 'excel',
         filename: "รายชื่อโครงการ",
         title: "รายชื่อโครงการ",
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
         filename: "รายชื่อโครงการ",
         title: "รายชื่อโครงการ",
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
 </script>


