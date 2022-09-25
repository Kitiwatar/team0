 <!-- Create by: Patiphan Pansanga, Jiradat Pomyai 19-09-2565 -->
 <div class="row">
   <div class="col-12">
     <div class="card">
       <div class="card-body">
         <h4 class='card-title'>ตารางรายชื่อโครงการที่รับผิดชอบ</h4>
         <?php if ($_SESSION['u_role'] <= 2) { ?>
           <button type="button" class="btn btn-success" id="addBtn" data-bs-toggle="modal"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มโครงการ</button>
         <?php } ?>
         <div class="table-responsive my-2">
           <table class="display table table-striped table-bordered dt-responsive nowrap">
             <thead>
               <tr>
                 <th class="text-center">ลำดับ</th>
                 <th>ชื่อโครงการ</th>
                 <th>ผู้รับผิดชอบหลัก</th>
                 <th>กิจกรรม</th>
                 <th>สถานะ</th>
                 <?php if ($_SESSION['u_role'] <= 2) : ?>
                   <th class="text-center">ปุ่มดำเนินการ</th>
                 <?php endif; ?>
               </tr>
             </thead>
             <tbody>
               <?php if (is_array($getData)) : $count = 1 ?>
                 <?php foreach ($getData as $key => $value) : ?>
                   <tr>
                     <td class="text-center"><?= $count++ ?></td>
                     <td onclick="view(<?= $value->u_id ?>)" style="cursor:pointer;"><?= $value->p_name ?> </td>
                     <td><?= $leader[$key]->u_firstname . ' ' . $leader[$key]->u_lastname ?></td>
                     <td>
                       <?php if (isset($lastTask[$key]->tl_name)) : ?>
                         <?= $lastTask[$key]->tl_name ?>
                       <?php else : ?>
                         <?= '-' ?>
                       <?php endif; ?>
                     </td>
                     <td>
                       <?php
                        foreach ($arrayStatus as $key => $status) {
                          if ($value->p_status == $key) {
                            echo "<font class = 'status" . $key . " rounded'>" . $status . "</font>";
                          }
                        }
                        ?>
                     </td>
                     <?php if ($_SESSION['u_role'] <= 2) : ?>
                       <td class="text-center">
                         <button type="button" class="btn btn-danger" name="del" id="del" title="ลบโครงการ" onclick=""><i class="mdi mdi-delete"></i></button>
                       </td>
                     <?php endif; ?>
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

 <style>
   .status1 {
     background-color: #FEC107;
     color: white;
     padding: 7px;
   }

   .status2 {
     background-color: #03A9F3;
     color: white;
     padding: 7px;
   }

   .status3 {
     background-color: #57BF95;
     color: white;
     padding: 7px;
   }

   .status4 {
     background-color: #E46A76;
     color: white;
     padding: 7px;
   }
 </style>

 <script>
   $('#addBtn').click(function(e) {
     e.preventDefault();
     $.ajax({
       method: "post",
       url: 'projects/getAddForm'
     }).done(function(returnData) {
       $('#mainModalTitle').html(returnData.title);
       $('#mainModalBody').html(returnData.body);
       $('#mainModalFooter').html(returnData.footer);
       $('#mainModal').modal();
     });
   });

   pdfMake.fonts = {
     THSarabun: {
       normal: 'THSarabun.ttf',
       bold: 'THSarabun-Bold.ttf',
       italics: 'THSarabun-Italic.ttf',
       bolditalics: 'THSarabun-BoldItalic.ttf'
     }
   }
   $('.table').DataTable({
     "dom": 'Bftlp',
     "buttons": [{
         "extend": "excel",
         exportOptions: {
           columns: [0, 1, 2, 3, 4]
         },
       },
       {
         "extend": 'pdf',
         "exportOptions": {
           columns: [0, 1, 2, 3, 4]
         },
         "text": 'PDF',
         "pageSize": 'A4',
         "customize": function(doc) {
           doc.defaultStyle = {
             font: 'THSarabun',
             fontSize: 16
           };
           //  console.log(doc);
         }
       },
     ],
     "language": {
       "oPaginate": {
         "sPrevious": "ถอยกลับ",
         "sNext": "ถัดไป"
       },
       "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
       "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 รายการ",
       "sLengthMenu": "แสดง _MENU_ รายการ",
       "sSearch": "ค้นหา ",
       "sInfoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
       "sZeroRecords": "ไม่พบข้อมูล"
     }
   });
   $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn waves-effect waves-light btn-info mx-1');
   $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').removeClass("dt-button");
   $('.buttons-excel').html('<i class="mdi mdi-file-excel-box"></i> Excel');
   $('.buttons-pdf').html('<i class="mdi mdi-file-pdf-box"></i> PDF');
 </script>