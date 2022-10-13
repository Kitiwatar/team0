 <!-- Create by: Patiphan Pansanga, Jiradat Pomyai 19-09-2565 -->
 <div class="row">
 <div class="col-12">
     <div class="card">
       <div class="card-body">
        <h3 class='card-title' style="cursor: pointer;"><u class="name"><?= isset($projectData) ? $projectData->p_name : '' ?></u></h3>
         <h4 class='card-title'>ตารางแสดงกิจกรรมโครงการ</h4>
         <?php if ($projectData->p_status < 3) { ?>
          <button type="button" class="btn btn-success me-2" id="addBtn" onclick="showAddForm('<?= base_url()?>','<?= $projectData->p_id ?>')" data-bs-toggle="modal"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มกิจกรรมโครงการ</button> 
          <?php } ?>
          <?php if($_SESSION['u_role'] <= 2 && $projectData->p_status < 3) {?>
           <button type="button" class="btn btn-info me-2" onclick="endProject(<?= $projectData->p_id ?>,3)" data-bs-toggle="modal"><i class="mdi mdi-check-circle-outline"></i> สิ้นสุดโครงการ</button>
           <button type="button" class="btn btn-danger" onclick="endProject(<?= $projectData->p_id ?>,4)" data-bs-toggle="modal"><i class="mdi mdi-close-circle-outline"></i> ยกเลิกโครงการ</button>
         <?php } else if($_SESSION['u_role'] <= 2 && $projectData->p_status >= 3) { ?>
          <button type="button" class="btn btn-success" onclick="restoreProject('<?= $projectData->p_id ?>')" data-bs-toggle="modal"><i class="mdi mdi-rotate-left"></i> กู้คืนสถานะโครงการ</button>
          <?php } ?>
          
         <div class="table-responsive my-2">
           <table class="display table table-striped table-bordered dt-responsive nowrap" id="table">
             <thead>
               <tr>
                  <th class="text-center">ลำดับ</th>
                  <th>ชื่อกิจกรรม</th>
                  <th>วันที่ดำเนินการ</th>
                  <th>ผู้ดำเนินการ</th>
                  <th class="text-center">ปุ่มดำเนินการ</th>
               </tr>
             </thead>
             <tbody>
               <?php if (is_array($getData)) : $count = 1 ?>
                 <?php foreach ($getData as $key => $value) : ?>
                   <tr>
                     <td class="text-center"><?= $count++ ?></td> 
                     <td style="cursor:pointer;" class="name" onclick="view(<?= $value->t_id ?>)"><u><?= $value->tl_name ?></u></td>
                     <td><?= thaiDate($value->t_createdate) ?></td>
                     <td><?= $value->u_firstname.' '.$value->u_lastname ?></td>
                     <td class="text-center">
                     <button type="button" class="btn btn-info btn-sm" name="view" id="view" onclick="view(<?= $value->t_id ?>)" title="ดูข้อมูลกิจกรรม"><i class="fas fa-search"></i></button>
                     <?php if (($_SESSION['u_id'] == $value->t_u_id || $_SESSION['u_role'] <= 2) && $projectData->p_status < 3) : ?>
                       <button type="button" class="btn btn-sm btn-warning" name="edit" id="edit" onclick="edit(<?= $value->t_id ?>)" title="แก้ไขกิจกรรม"><i class="mdi mdi-pencil"></i></button>
                       <button type="button" class="btn btn-sm btn-danger" name="del" id="del" onclick="changeStatus(<?= $value->t_id ?>, <?= $value->t_status ?>)" title="ลบกิจกรรม" onclick=""><i class="mdi mdi-delete"></i></button>
                     <?php endif; ?>
                     </td>
                   </tr>
                 <?php endforeach; ?>
               <?php endif; ?>
             </tbody>
           </table>
         </div>
         <h4 class='card-title'>ตารางรายชื่อพนักงานในโครงการ</h4>
         <?php if($_SESSION['u_role'] <= 2) { ?>
        <button type="button" class="btn btn-success" ><i class="mdi mdi-plus-circle-outline"></i> เพิ่มพนักงานในโครงการ</button>
        <?php } ?>
        <div class="table-responsive my-2">
          <table class="display table table-striped table-bordered dt-responsive nowrap" id="tablePermission">
            <thead>
              <tr>
                <th>ลำดับ</th>
                <th>ชื่อ-นามสกุล</th>
                <th>อีเมล</th>
                <th>เบอร์โทรศัพท์</th>
                <th>สิทธิ์ในการใช้งานระบบ</th>
                <?php if($_SESSION['u_role'] <= 2) { ?>
                <th class="text-center">ปุ่มดำเนินการ</th>
                <?php } ?>
              </tr>
            </thead>
            <tbody>
              <?php if (is_array($permission)) : $count = 1; ?>
                <?php foreach ($permission as $key => $value) : ?>
                    <tr>
                      <td class="text-center"><?= $count++ ?></td>
                      <td><?= $value->u_firstname ?> <?= $value->u_lastname ?></td>
                      <td><?= $value->u_email ?></td>
                      <td><?= $value->u_tel ?></td>
                      <td><?php if($value->u_role == 3) {
                          echo "พนักงาน";
                        } else if($value->u_role == 2) {
                          echo "หัวหน้าโครงการ";
                        } else {
                          echo "ผู้ดูแลระบบ";
                        }?>
                      </td>
                      <?php if($_SESSION['u_role'] <= 2) { ?>
                      <td class="text-center">
                          <button type="button" class="btn btn-danger btn-sm" name="del" id="del" title="ลบพนักงานออกจากโครงการ" onclick="changeStatus(<?= $value->u_id ?>,<?= $value->u_status ?>)"><i class="mdi mdi-delete"></i></button>
                      </td>
                      <?php } ?>
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

 <script>
   function endProject(p_id, p_status) {
    var action = ""
    if(p_status == 3) {
      action = "สิ้นสุดโครงการ"
    } else {
      action = "ยกเลิกโครงการ"
    }
     swal({
      title: "ยืนยันการ" + action,
      text: "คุณต้องการ" + action +"ใช่หรือไม่",
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ยกเลิก",
    }).then(function(isConfirm) {
      // $('#usersForm')[0].reset();
      if (isConfirm.value) {
        $.ajax({
          method: "post",
          url: '<?= base_url() ?>projects/endProject',
          data: {p_id: p_id, p_status: p_status}
        }).done(function(returnData) {
          loadList();
          if (returnData.status == 1) {
            swal({
              title: "สำเร็จ",
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
          } else {
            swal({
              title: "ล้มเหลว",
              text: returnData.msg,
              type: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
          }
        });
      }
    })
   }

   function restoreProject(p_id) { 
     swal({
      title: "ยืนยันการกู้คืนสถานะโครงการ",
      text: "คุณต้องการกู้คืนสถานะของโครงการใช่หรือไม่",
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ยกเลิก",
    }).then(function(isConfirm) {
      // $('#usersForm')[0].reset();
      if (isConfirm.value) {
        $.ajax({
          method: "post",
          url: '<?= base_url() ?>projects/restoreProject',
          data: {p_id: p_id}
        }).done(function(returnData) {
          loadList();
          if (returnData.status == 1) {
            swal({
              title: "สำเร็จ",
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
          } else {
            swal({
              title: "ล้มเหลว",
              text: returnData.msg,
              type: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
          }
        });
      }
    })
   }

   function showAddForm(url, p_id) {
    $.ajax({
       method: "post",
       url: url + 'tasks/getAddForm',
       data: {
        p_id: p_id
       }
     }).done(function(returnData) {
       $('#mainModalTitle').html(returnData.title);
       $('#mainModalBody').html(returnData.body);
       $('#mainModalFooter').html(returnData.footer);
       $('#mainModal').modal();
     });
   }

   pdfMake.fonts = {
     THSarabun: {
       normal: 'THSarabun.ttf',
       bold: 'THSarabun-Bold.ttf',
       italics: 'THSarabun-Italic.ttf',
       bolditalics: 'THSarabun-BoldItalic.ttf'
     }
   }
   $('#table').DataTable({
     "dom": 'Bftlp',
     "buttons": [{
         "extend": "excel",
         exportOptions: {
           columns: [0, 1, 2, 3]
         },
       },
       {
         "extend": 'pdf',
         "exportOptions": {
           columns: [0, 1, 2, 3]
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
   $('#tablePermission').DataTable({
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