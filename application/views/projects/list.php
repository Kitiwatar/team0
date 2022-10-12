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
                  <th class="text-center">ปุ่มดำเนินการ</th>
               </tr>
             </thead>
             <tbody>
               <?php if (is_array($getData)) : $count = 1 ?>
                 <?php foreach ($getData as $key => $value) : ?>
                  <?php if($value->p_status < 1) { continue; } ?>
                   <tr>
                     <td class="text-center"><?= $count++ ?></td> 
                     <td class="name" style="cursor:pointer;" onclick="view('<?= $value->p_id ?>')"><u><?= $value->p_name ?></u></td>
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
                       $statusColor = array(1=>"badge rounded-pill bg-info", 2=>"badge rounded-pill bg-info", 3=>"badge rounded-pill bg-success", 4=>"badge rounded-pill bg-danger");
                        foreach ($arrayStatus as $index => $status) {
                          if ($value->p_status == $index) {
                            echo "<span  class = ' ". $statusColor[$index] ."'>" . $status . "</span>";
                          }
                        }
                        ?>
                     </td>
                     <td class="text-center">
                     <button type="button" class="btn btn-info" name="view" id="view" onclick="view(<?= $value->p_id ?>)" title="ดูข้อมูลโครงการ"><i class="mdi mdi-file-find"></i></button>
                     <a type="button" href="<?= base_url() ?>projects/viewProjectTasks/<?= $value->p_id ?>" title="จัดการกิจกรรมของโครงการ" class="btn btn-tertiary"><i class="mdi mdi-book-variant"></i></a>
                     <?php if ($_SESSION['u_role'] <= 2) : ?> 
                        <button type="button" class="btn btn-warning" name="edit" id="edit" onclick="edit(<?= $value->p_id ?>)" title="แก้ไขข้อมูลโครงการ"><i class="mdi mdi-pencil"></i></button>
                        <?php if ($value->p_status == 1) : ?> 
                         <button type="button" class="btn btn-danger" name="del" id="del" title="ลบโครงการ" onclick="changeStatus(<?= $value->p_id ?>,<?= $value->p_status*-1 ?>)"><i class="mdi mdi-delete"></i></button>
                        <?php else: ?> 
                          <button type="button" style="cursor:no-drop; background-color: rgb(228, 228, 228);" class="btn btn-secondary" title="ไม่สามรถใช้งานได้"><i class="mdi mdi-delete"></i></button>
                        <?php endif; ?>
                      <?php endif; ?>
                     </td>
                   </tr>
                 <?php endforeach; ?>
               <?php endif; ?>
             </tbody>
           </table>
         </div>
         <a type="button" class="btn waves-effect waves-light btn-dark" href="<?= base_url() ?>"><i class="mdi mdi-arrow-left"></i> ย้อนกลับ</a>
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