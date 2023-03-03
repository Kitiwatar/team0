 <!-- Create by: Patiphan Pansanga 14-10-2565 -->
 <div class="card">
   <div class="card-body">
     <div class="row">
       <div class="col">
         <h1 class='fs-1 mt-0' style="cursor: pointer; color:black; line-height: 80%;" onclick="viewProject(<?= $projectData->p_id ?>)"><?= isset($projectData) ? $projectData->p_name : '' ?></้>
       </div>
     </div>
     <table class="mt-2">
       <tr>
         <td>
           <?= lang('tl_project_pj-mainperson') ?> : <?= $user[0]->u_firstname . " " . $user[0]->u_lastname ?>
         </td>
         <td class="px-3">
           <?= lang('tl_project_pj-status') ?> :
           <?php $statusColor = array(1 => "badge rounded-pill bg-warning", 2 => "badge rounded-pill bg-info", 3 => "badge rounded-pill bg-success", 4 => "badge rounded-pill bg-danger");
            $statusName = array(1 => lang('sp_home_pendproject'), 2 => lang('sp_home_inprogress'), 3 => lang('sp_home_finish'), 4 => lang('sp_home_cancel'));
            if ($projectData->p_status > 0) {
              echo "<span  class = ' " . $statusColor[$projectData->p_status] . "'>" . $statusName[$projectData->p_status] . "</span>";
            } else {
              echo "<span  class = 'badge rounded-pill bg-dark'>ถูกลบ</span>";
            }
            ?>
         </td>
       </tr>
       <tr>
         <td><?= lang('gd_project_pj-startdate') ?> : <?= thaiDate_Full($projectData->p_createdate) ?></td>
         <td class="px-3"> <?= lang('gd_project_pj-enddate') ?> : <?= ($projectData->p_enddate == NULL) ? '-' : thaiDate_Full($projectData->p_enddate) ?></td>
       </tr>
     </table>
     <h2 class='card-title mt-4'><?= lang('th_project_pj-task') ?></h2>
     <?php if ($projectData->p_status < 3) { ?>
       <button type="button" class="btn btn-success me-2" id="addBtn" onclick="showAddForm('<?= $projectData->p_id ?>')" data-bs-toggle="modal"><i class="mdi mdi-plus-circle-outline"></i> <?= lang('m_project_addtask') ?></button>
     <?php } ?>
     <?php if (($_SESSION['u_id'] == $user[0]->u_id || $_SESSION['u_role'] < 2) && $projectData->p_status < 3) { ?>
       <button type="button" class="btn btn-info me-2" onMouseOver="this.style.backgroundColor='#56BFF9'" onMouseOut="this.style.backgroundColor='#56BDC6'" style="background-color: #56BDC6; border-color:#56BDC6;" onclick="endProject(<?= $projectData->p_id ?>,3)"><i class="mdi mdi-check-circle-outline"></i> <?= lang('m_project_finishproject') ?></button>
       <button type="button" class="btn btn-danger" onclick="showCancelForm('<?= $projectData->p_id ?>')"><i class="mdi mdi-close-circle-outline"></i> <?= lang('m_project_cancelproject') ?></button>
     <?php } else if (($_SESSION['u_id'] == $user[0]->u_id || $_SESSION['u_role'] < 2) && $projectData->p_status >= 3) { ?>
       <button type="button" class="btn btn-success" onclick="restoreProject('<?= $projectData->p_id ?>')"><i class="mdi mdi-rotate-left"></i> <?= lang('m_project_reinstateproject') ?></button>
     <?php } ?>
     <div class="table-responsive my-2">
       <table class="display table dt-responsive nowrap" id="table">
         <thead>
           <tr>
             <th class="text-center"><?= lang('tl_project_pj-no') ?></th>
             <th><?= lang("tl_project_at-nametask") ?></th>
             <th><?= lang('tl_project_at-implementationdate') ?></th>
             <th><?= lang('tl_project_at-operator') ?></th>
             <th class="text-center"><?= lang('tl_project_actionbutton') ?></th>
           </tr>
         </thead>
         <tbody>
           <?php if (is_array($getData)) : $count = 1;
           date_default_timezone_set("Asia/Bangkok");
           $now = date("Y-m-d H:i:s");
            ?>
             <?php foreach ($getData as $key => $value) : ?>
               <tr>
                 <td class="text-center"><?= $count++ ?></td>
                 <td style="cursor:pointer; font-weight: 900;" class="name" onclick="view(<?= $value->t_id ?>)"><?= $value->tl_name ?></td>
                 <?php if($value->t_createdate > $now) { ?>
                 <td onclick="showTab('calendarData')" class="name" style="cursor: pointer;"><?= thaiDate($value->t_createdate) ?></td>
                 <?php } else { ?>
                  <td><?= thaiDate($value->t_createdate) ?></td>
                  <?php } ?>
                 <td><?= $value->u_firstname . ' ' . $value->u_lastname ?></td>
                 <td class="text-center">
                   <button type="button" class="btn btn-info btn-sm" name="view" id="view" onclick="view(<?= $value->t_id ?>)" title="<?= lang('tt_pt_vtask') ?>"><i class="fas fa-search"></i></button>
                   <?php if (($_SESSION['u_id'] == $value->t_u_id || $_SESSION['u_role'] < 2 || $_SESSION['u_id'] == $user[0]->u_id) && $projectData->p_status <= 2) { ?>
                     <button type="button" class="btn btn-sm btn-warning" name="edit" id="edit" onclick="edit(<?= $value->t_id ?>)" title="<?= lang('tt_pt_etask') ?>"><i class="mdi mdi-pencil"></i></button>
                     <button type="button" class="btn btn-sm btn-danger" name="del" id="del" onclick="changeStatus(<?= $value->t_id ?>, <?= $value->t_status ?>, <?= $projectData->p_id ?>)" title="<?= lang('tt_pt_dtask') ?>" onclick=""><i class="mdi mdi-delete"></i></button>
                   <?php } else { ?>
                     <button type="button" style="cursor:no-drop;" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="left" title="<?= lang('tt_pt_cn-etask') ?>"><i class="mdi mdi-pencil" style="color: grey;"></i></button>
                     <button type="button" style="cursor:no-drop;" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="left" title="<?= lang('tt_pt_cn-dtask') ?>"><i class="mdi mdi-delete" style="color: grey;"></i></button>
                   <?php } ?>
                 </td>
               </tr>
             <?php endforeach; ?>
           <?php endif; ?>
         </tbody>
       </table>
     </div>
   </div>
 </div>
 <script>
   $('[data-toggle="tooltip"]').tooltip();

   function endProject(p_id, p_status) {
     var action = ""
     if (p_status == 3) {
       action = "<?= lang('md_fp_main-msg') ?>"
     } else {
       action = "<?= lang('md_cp_main-msg') ?>"
     }
     swal({
       title: "<?= lang('md_c_main-msg') ?>" + action,
       text: "<?= lang('md_c_detail-msg') ?>" + action + "<?= lang('md_q_detail-msg') ?>",
       type: "warning",
       showCancelButton: true,
       showConfirmButton: true,
       confirmButtonText: "<?= lang('bt_confirm') ?>",
       cancelButtonText: "<?= lang('bt_cancel') ?>",
     }).then(function(isConfirm) {
       // $('#usersForm')[0].reset();
       if (isConfirm.value) {
         $.ajax({
           method: "post",
           url: hostname + 'projects/endProject',
           data: {
             p_id: p_id,
             p_status: p_status
           }
         }).done(function(returnData) {
           loadList();
           if (returnData.status == 1) {
             swal({
               title: "<?= lang('md_vm-suc') ?>",
               text: returnData.msg,
               type: "success",
               showCancelButton: false,
               showConfirmButton: false,
               timer: 1000,
             });
           } else {
             swal({
               title: "<?= lang('md_vm-fail') ?>",
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
       title: "<?= lang('md_rtp_main-msg') ?>",
       text: "<?= lang('md_rtp_detail-msg') ?>",
       type: "warning",
       showCancelButton: true,
       showConfirmButton: true,
       confirmButtonText: "<?= lang('bt_confirm') ?>",
       cancelButtonText: "<?= lang('bt_cancel') ?>",
     }).then(function(isConfirm) {
       // $('#usersForm')[0].reset();
       if (isConfirm.value) {
         $.ajax({
           method: "post",
           url: hostname + 'projects/restoreProject',
           data: {
             p_id: p_id
           }
         }).done(function(returnData) {
           loadList();
           if (returnData.status == 1) {
             swal({
               title: "<?= lang('md_vm-suc') ?>",
               text: returnData.msg,
               type: "success",
               showCancelButton: false,
               showConfirmButton: false,
               timer: 1000,
             });
           } else {
             swal({
               title: "<?= lang('md_vm-fail') ?>",
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

   function showAddForm(p_id) {
     $.ajax({
       method: "post",
       url: 'tasks/getAddForm',
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

   function showCancelForm(p_id) {
     $.ajax({
       method: "post",
       url: hostname + 'cancel/getAddForm',
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
   
   function saveFormCancel(p_id) {
    var formData = {};
    formData['c_cl_id'] = $('#c_cl_id').val()
    formData['c_detail'] = $('#c_detail').val()
    formData['c_p_id'] = p_id
    var count = 0;
    if (!formData.c_detail) {
      $('#detailMsg').text(' กรุณากรอกรายละเอียด');
      $('#c_detail').focus();
      $('#c_detail').addClass("is-invalid"); 
      count++
    } else {
      $('#detailMsg').text(' ');
      $('#c_detail').removeClass("is-invalid");
      $('#c_detail').addClass("is-valid");

    }
    if (!formData.c_cl_id) {
      $('#nameMsg').text(' กรุณาเลือกสาเหตุยุติโครงการ');
      $('#c_cl_id').focus();
      $('#c_cl_id').addClass("is-invalid"); 
      count++
    } else {
      $('#nameMsg').text(' ');
      $('#c_cl_id').removeClass("is-invalid");
      $('#c_cl_id').addClass("is-valid");
    }
    if (count > 0) {
      return false;
    }

    swal({
      title: 'ยืนยันการยุติโครงการ',
      text: 'ยุติโครงการใช่หรือไม่',
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: '<?= lang('bt_confirm')?>',
      cancelButtonText: '<?= lang('bt_cancel')?>',
    }).then(function(isConfirm) {
      if (isConfirm.value) {
        $.ajax({
          method: "post",
          url: hostname + 'cancel/add',
          data: {
            formData: formData,
          }
        }).done(function(returnData) {
          loadList();
          if (returnData.status == 1) {
            swal({
              title: '<?= lang('md_vm-suc')?>',
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
            $('#mainModalTitle').html("");
            $('#mainModalBody').html("");
            $('#mainModalFooter').html("");
            $('#mainModal').modal('hide');
          } else {
            swal({
              title: '<?= lang('md_vm-fail')?>',
              text: returnData.msg,
              type: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
            $('#mainModalTitle').html("");
            $('#mainModalBody').html("");
            $('#mainModalFooter').html("");
            $('#mainModal').modal('hide');
          }
        });
      }
    });
  }
   function showPermissionForm(p_id) {
     $.ajax({
       method: "post",
       url: hostname + 'permissions/getAddForm',
       data: {
         p_id: p_id
       }
     }).done(function(returnData) {
       $('#detailModalTitle').html(returnData.title);
       $('#detailModalBody').html(returnData.body);
       $('#detailModalFooter').html(returnData.footer);
       $('#detailModal').modal();
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
     dom: 'Bftlp',
     buttons: [{
         extend: 'excel',
         filename: 'กิจกรรมโครงการ' + document.title,
         title: 'กิจกรรมโครงการ' + document.title,
         exportOptions: {
           columns: [0, 1, 2, 3]
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
         filename: 'กิจกรรมโครงการ' + document.title,
         title: 'กิจกรรมโครงการ' + document.title,
         pageSize: 'A4', // ขนาดหน้ากระดาษเป็น A4
         exportOptions: {
           columns: [0, 1, 2, 3]
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
           pdf.content[1].table.widths = [40, 150, 150, 150];
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