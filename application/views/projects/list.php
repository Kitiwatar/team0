 <!-- Create by: Patiphan Pansanga, Jiradat Pomyai 19-09-2565 -->
 <div class="row">
   <div class="col-12">
     <div class="card">
       <div class="card-body">
         <h2 class='card-title'><?= lang('th_project_pj-responsible') ?></h2>
         <?php if ($_SESSION['u_role'] <= 2) { ?>
           <button type="button" class="btn btn-success" id="addBtn" data-bs-toggle="modal"><i class="mdi mdi-plus-circle-outline"></i> <?= lang('m_project_addproject') ?></button>
         <?php } ?>
         <div class="table-responsive my-2">
           <table class="display table dt-responsive nowrap" id="table">
             <thead>
               <tr>
                 <th class="text-center"><?= lang('tl_no.') ?></th>
                 <th><?= lang('tl_project_pj-name') ?></th>
                 <th><?= lang('tl_project_pj-mainperson') ?></th>
                 <th><?= lang('tl_project_pj-task') ?></th>
                 <th><?= lang('tl_project_pj-status') ?></th>
                 <th class="text-center"><?= lang('tl_project_actionbutton') ?></th>
               </tr>
             </thead>
             <tbody>
               <?php if (is_array($getData)) : $count = 1 ?>
                 <?php foreach ($getData as $key => $value) : ?>
                   <?php if ($value->p_status < 1 && ($_SESSION['u_id'] == $leader[$key]->u_id || $_SESSION['u_role'] < 2)) {
                     
                      date_default_timezone_set("Asia/Bangkok");
                      $now = date("Y-m-d H:i:s");
                      $start_date = new DateTime($value->p_countdown);
                      $since_start = $start_date->diff(new DateTime($now));

                      if ($now > $value->p_countdown) {
                        continue;
                      }
                      if ($since_start->h + 1 < 11) {
                        $hours = "0" . strval($since_start->h);
                      } else {
                        $hours = $since_start->h;
                      }
                      if ($since_start->i + 1 < 11) {
                        $min = "0" . strval($since_start->i);
                      } else {
                        $min = $since_start->i;
                      }
                      if ($since_start->s + 1 < 11) {
                        $sec = "0" . strval($since_start->s);
                      } else {
                        $sec = $since_start->s;
                      }
                    } else if($value->p_status < 1) {
                      continue;
                    } ?>
                   <tr id="<?= "project".$value->p_id ?>">
                     <td class="text-center"><?= $count++ ?></td>
                     <td class="name" style="cursor:pointer;" onclick="linkPage('<?= base_url().'tasks?p_id='.$value->p_id ?>')"><u><?= $value->p_name ?></u></td>
                     <td><?= $leader[$key]->u_firstname . ' ' . $leader[$key]->u_lastname ?></td>
                     <td>
                       <?php if (isset($lastTask[$key]->tl_name)) : ?>
                         <?= $lastTask[$key]->tl_name ?>
                       <?php else : ?>
                         <?= '-' ?>
                       <?php endif; ?>
                     </td>
                     <td>
                      <?php $statusColor = array(1 => "badge rounded-pill bg-info", 2 => "badge rounded-pill bg-info", 3 => "badge rounded-pill bg-success", 4 => "badge rounded-pill bg-danger");
                        $statusName = array(1=>lang('sp_home_pendproject'), 2=>lang('sp_home_inprogress'), 3=>lang('sp_home_finish'), 4=>lang('sp_home_cancel'));
                        if ($value->p_status > 0) {
                          echo "<span  class = ' " . $statusColor[$value->p_status] . "'>" . $statusName[$value->p_status] . "</span>";
                        } else {
                          echo "<span  class = 'badge rounded-pill bg-dark'>ถูกลบ</span>";
                        }
                      ?>
                     </td>
                     <td class="text-center">
                       <?php if ($value->p_status < 1) : ?>
                         <button type="button" class="btn btn-dark btn-sm" name="restore" id="<?= $value->p_id ."_". $hours . ':' . $min . ':' . $sec ?>" onclick="changeStatus(<?= $value->p_id ?>,<?= $value->p_status * -1 ?>)" title="<?= lang('tt_pj_rproject') ?>"><?= lang('md_rp') ?> <span style='font-size:16px;'><?= $hours . ':' . $min?></span> <?= lang('md_rp-hour') ?></button>
                        <?php continue; ?>
                       <?php endif; ?>
                       <a type="button" href="<?= base_url() ?>tasks?p_id=<?= $value->p_id ?>" title= "<?= lang('tt_pj_mproject') ?>" class="btn btn-tertiary btn-sm"><i class="fas fa-cogs"></i></a>
                       <button type="button" class="btn btn-info btn-sm" name="view" id="view" onclick="view(<?= $value->p_id ?>)" title="<?= lang('tt_pj_vproject') ?>"><i class="fas fa-search"></i></button>
                       <?php if ($_SESSION['u_id'] == $leader[$key]->u_id || $_SESSION['u_role'] < 2) : ?>
                         <button type="button" class="btn btn-warning btn-sm" name="edit" id="edit" onclick="editProject(<?= $value->p_id ?>)" title="<?= lang('tt_pj_eproject') ?>"><i class="mdi mdi-pencil"></i></button>
                         <?php if (!isset($lastTask[$key]->tl_name) && $value->p_status < 3) : ?>
                           <button type="button" class="btn btn-danger btn-sm" name="del" id="del" title="<?= lang('tt_pj_dproject') ?>" onclick="changeStatus(<?= $value->p_id ?>,<?= $value->p_status * -1 ?>)"><i class="mdi mdi-delete"></i></button>
                         <?php else : ?>
                           <button type="button" style="cursor:no-drop; background-color: #C5C5C5; color:#808080;" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="left" title="<?= lang('tt_pj_cn-dproject') ?>"><i class="mdi mdi-delete"></i></button>
                         <?php endif; ?>
                       <?php endif; ?>
                     </td>
                   </tr>
                 <?php endforeach; ?>
               <?php endif; ?>
             </tbody>
           </table>
         </div>
         <a type="button" class="btn waves-effect waves-light btn-dark" href="<?= base_url() ?>"><i class="mdi mdi-arrow-left"></i> <?= lang('b_project_back') ?></a>
       </div>
     </div>
   </div>
 </div>

 <script>
  function linkPage(url) {
    location.replace(url)
  }

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
   var table = $('#table').DataTable({
    dom: 'Bftlp',
     buttons: [{
         extend: 'excel',
         filename: "รายชื่อโครงการที่เกี่ยวข้อง",
         title: "รายชื่อโครงการที่เกี่ยวข้อง",
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
         filename: "รายชื่อโครงการที่เกี่ยวข้อง",
         title: "รายชื่อโครงการที่เกี่ยวข้อง",
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

   $('[data-toggle="tooltip"]').tooltip();
 </script>