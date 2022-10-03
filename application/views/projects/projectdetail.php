 <!-- Create by: Patiphan Pansanga, Jiradat Pomyai 19-09-2565 -->
   <div class="col-12">
     <div class="card">
       <div class="card-body">
        <h3 class='card-title' style="cursor: pointer;"><u class="name"><?= $projectData->p_name ?></u></h3>
         <h4 class='card-title'>ตารางแสดงกิจกรรมโครงการ</h4>
         <?php if ($_SESSION['u_role'] <= 2) { ?>
           <button type="button" class="btn btn-success" id="addBtn" data-bs-toggle="modal"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มกิจกรรม</button>
         <?php } ?>
         <div class="table-responsive my-2">
           <table class="display table table-striped table-bordered dt-responsive nowrap">
             <thead>
               <tr>
                 <th class="text-center">ลำดับ</th>
                 <th>ชื่อโครงการ</th>
                 <th>ผู้รับผิดชอบหลัก</th>
                 <th>ผู้เพิ่มกิจกรรม</th>
                   <th class="text-center">ปุ่มดำเนินการ</th>             
               </tr>
             </thead>
             <tbody>
               <?php if (is_array($getData)) : $count = 1 ?>
                 <?php foreach ($getData as $key => $value) : ?>
                   <tr>
                     <td class="text-center"><?= $count++ ?></td> 
                     <td style="cursor:pointer;"><?= $value->tl_name ?></td>
                     <td><?= $value->t_createdate ?></td>
                     <td><?= $value->u_firstname.' '.$value->u_lastname ?></td>  
                     <?php if ($_SESSION['u_id'] == $value->t_u_id || $_SESSION['u_role'] <= 2) : ?>
                       <td class="text-center">
                       <button type="button" class="btn btn-warning" name="edit" id="edit" onclick="edit(<?= $value->tl_id ?>)" title="แก้ไขรายการกิจกรรม"><i class="mdi mdi-pencil"></i></button>
                       <button type="button" class="btn btn-danger" name="del" id="del" title="ลบโครงการ" onclick=""><i class="mdi mdi-delete"></i></button>
                       </td>
                     <?php endif; ?>
                   </tr>
                 <?php endforeach; ?>
               <?php endif; ?>
             </tbody>
           </table>
         </div>
         <a type="button" class="btn waves-effect waves-light btn-dark" href="<?= base_url() ?>projects"><i class="mdi mdi-arrow-left"></i> ย้อนกลับ</a>
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