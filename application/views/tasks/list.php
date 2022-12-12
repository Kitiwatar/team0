 <!-- Create by: Patiphan Pansanga 14-10-2565 -->
 <div class="row">
 <div class="col-12">
     <div class="card">
       <div class="card-body">
        <a class='fs-1 mt-0' style="cursor: pointer; color:black; line-height: 80%;" onclick="viewProject(<?= $projectData->p_id ?>)"><u><?= isset($projectData) ? $projectData->p_name : '' ?></u></a>
        <table class="mt-3">
          <tr>
            <td>
            <?= lang('tl_project_pj-mainperson') ?> : <?= $permission[count($permission)-1]->u_firstname . " " . $permission[count($permission)-1]->u_lastname ?>
            </td>
            <td class="px-3">
            <?= lang('tl_project_pj-status') ?> : 
            <?php $statusColor = array(1 => "badge rounded-pill bg-info", 2 => "badge rounded-pill bg-info", 3 => "badge rounded-pill bg-success", 4 => "badge rounded-pill bg-danger");
            $statusName = array(1=>lang('sp_home_pendproject'), 2=>lang('sp_home_inprogress'), 3=>lang('sp_home_finish'), 4=>lang('sp_home_cancel'));
              if ($projectData->p_status > 0) {
                echo "<span  class = ' " . $statusColor[$projectData->p_status] . "'>" . $statusName[$projectData->p_status] . "</span>";
              } else {
                echo "<span  class = 'badge rounded-pill bg-dark'>ถูกลบ</span>";
              }
            ?>
            </td>
          </tr>
          <tr>
            <td><?= lang('gd_project_pj-startdate') ?>  : <?= thaiDate_Full($projectData->p_createdate) ?></td>
            <td class="px-3"> <?= lang('gd_project_pj-enddate') ?> : <?= ($projectData->p_enddate == NULL) ? '-' : thaiDate_Full($projectData->p_enddate) ?></td>
          </tr>
        </table>
        <h2 class='card-title'><?= lang('th_project_pj-task') ?></h2>
         <?php if($isPermission == 1) { ?>
         <?php if ($projectData->p_status < 3) { ?>
          <button type="button" class="btn btn-success me-2" id="addBtn" onclick="showAddForm('<?= $projectData->p_id ?>')" data-bs-toggle="modal"><i class="mdi mdi-plus-circle-outline"></i> <?= lang('m_project_addtask') ?></button> 
          <?php } ?>
          <?php if($_SESSION['u_role'] <= 2 && $projectData->p_status < 3) {?>
           <button type="button" class="btn btn-info me-2" onclick="endProject(<?= $projectData->p_id ?>,3)" data-bs-toggle="modal"><i class="mdi mdi-check-circle-outline"></i> <?= lang('m_project_finishproject') ?></button>
           <button type="button" class="btn btn-danger" onclick="endProject(<?= $projectData->p_id ?>,4)" data-bs-toggle="modal"><i class="mdi mdi-close-circle-outline"></i> <?= lang('m_project_cancelproject') ?></button>
         <?php } else if($_SESSION['u_role'] <= 2 && $projectData->p_status >= 3) { ?>
          <button type="button" class="btn btn-success" onclick="restoreProject('<?= $projectData->p_id ?>')" data-bs-toggle="modal"><i class="mdi mdi-rotate-left"></i> <?= lang('m_project_reinstateproject') ?></button>
          <?php } ?>
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
               <?php if (is_array($getData)) : $count = 1 ?>
                 <?php foreach ($getData as $key => $value) : ?>
                   <tr>
                     <td class="text-center"><?= $count++ ?></td> 
                     <td style="cursor:pointer;" class="name" onclick="view(<?= $value->t_id ?>)"><u><?= $value->tl_name ?></u></td>
                     <td><?= thaiDate($value->t_createdate) ?></td>
                     <td><?= $value->u_firstname.' '.$value->u_lastname ?></td>
                     <td class="text-center">
                     <button type="button" class="btn btn-info btn-sm" name="view" id="view" onclick="view(<?= $value->t_id ?>)" title="<?= lang('tt_pt_vtask') ?>"><i class="fas fa-search"></i></button>
                     <?php if($isPermission == 1 && $projectData->p_status < 3) { ?>
                     <?php if (($_SESSION['u_id'] == $value->t_u_id || $_SESSION['u_role'] <= 2)) { ?>
                       <button type="button" class="btn btn-sm btn-warning" name="edit" id="edit" onclick="edit(<?= $value->t_id ?>)" title="<?= lang('tt_pt_etask') ?>"><i class="mdi mdi-pencil"></i></button>
                       <button type="button" class="btn btn-sm btn-danger" name="del" id="del" onclick="changeStatus(<?= $value->t_id ?>, <?= $value->t_status ?>, <?= $projectData->p_id ?>)" title="<?= lang('tt_pt_dtask') ?>" onclick=""><i class="mdi mdi-delete"></i></button>
                     <?php } else { ?>
                      <button type="button" style="cursor:no-drop; background-color: #C5C5C5; color:#808080;" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="left" title="<?= lang('tt_pt_cn-etask') ?>"><i class="mdi mdi-pencil"></i></button>
                        <button type="button" style="cursor:no-drop; background-color: #C5C5C5; color:#808080;" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="left" title="<?= lang('tt_pt_cn-dtask') ?>"><i class="mdi mdi-delete"></i></button>
                     <?php } } ?>
                     </td>
                   </tr>
                 <?php endforeach; ?>
               <?php endif; ?>
             </tbody>
           </table>
         </div>
         <hr>
         <h2 class='card-title'><?= lang('th_project_em-associated') ?></h2>
         <?php if($isPermission == 1) { ?>
         <?php if($_SESSION['u_role'] <= 2 && $projectData->p_status < 3) { ?>
        <button type="button" class="btn btn-success" onclick="showPermissionForm(<?= $projectData->p_id ?>)"><i class="mdi mdi-plus-circle-outline"></i><?= lang('m_project_addaemployee') ?></button>
        <?php } ?>
        <?php } ?>
        <div class="table-responsive my-2">
          <table class="display table dt-responsive nowrap" id="tablePermission">
            <thead>
              <tr>
                <th class="text-center"><?= lang('tl_project_pj-no') ?></th>
                <th><?= lang('gd_project_em-fullname') ?></th>
                <th><?= lang('gd_project_em-email') ?></th>
                <th><?= lang('gd_project_em-phone') ?></th>
                <th><?= lang('gd_project_em-permission') ?></th>
                <?php if($isPermission == 1) { ?>
                <?php if($_SESSION['u_role'] <= 2 && $projectData->p_status < 3) { ?>
                <th class="text-center"><?= lang('tl_project_actionbutton') ?></th>
                <?php } ?>
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
                          echo lang('u_role-em1');
                        } else if($value->u_role == 2) {
                          echo lang('u_role-em2');
                        } else {
                          echo lang('u_role-am');
                        }?>
                      </td>
                      <?php if($isPermission == 1) { ?>
                      <?php if($_SESSION['u_role'] <= 2 && $projectData->p_status < 3) { ?>
                      <td class="text-center">
                        <?php if($value->per_role == 2) { ?>
                          <button type="button" class="btn btn-danger btn-sm" name="del" id="del" title="<?= lang('tt_ep_demp') ?>ร" onclick="updatePermission(<?= $value->u_id ?>,<?= $projectData->p_id ?>)"><i class="mdi mdi-delete"></i></button>
                        <?php } else { ?>
                          <button type="button" style="cursor:no-drop; background-color: #C5C5C5; color:#808080;" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="left" title="<?= lang('tt_ep_cn-demp') ?>"><i class="mdi mdi-delete"></i></button>
                        <?php } ?>
                        </td>
                      <?php } ?>
                      <?php } ?>
                    </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <a type="button" class="btn waves-effect waves-light btn-dark" href="<?= base_url() ?>projects"><i class="mdi mdi-arrow-left"></i> <?= lang('b_project_back') ?></a>
        </div>
     </div>
   </div>
 </div>

 <script>
  $('[data-toggle="tooltip"]').tooltip();

   function endProject(p_id, p_status) {
    var action = ""
    if(p_status == 3) {
      action = "<?= lang('md_fp_main-msg') ?>"
    } else {
      action = "<?= lang('md_cp_main-msg') ?>"
    }
     swal({
      title: "<?= lang('md_c_main-msg') ?>" + action,
      text: "<?= lang('md_c_detail-msg') ?>" + action +"<?= lang('md_q_detail-msg') ?>",
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
          url: '<?= base_url() ?>projects/endProject',
          data: {p_id: p_id, p_status: p_status}
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
          url: '<?= base_url() ?>projects/restoreProject',
          data: {p_id: p_id}
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

   function showPermissionForm(p_id) {
    $.ajax({
       method: "post",
       url: '<?= base_url() ?>permissions/getAddForm',
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