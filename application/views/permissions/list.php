        <!-- ตารางพนักงานในโครงการ -->
         <h2 class='card-title'><?= lang('th_project_em-associated') ?></h2>
         <?php if ($_SESSION['u_id'] == $user[0]->u_id || $_SESSION['u_role'] < 2 && $projectData->p_status < 3) { ?>
            <!-- ปุ่มเพิ่มพนักงานในโครงการ -->
           <button type="button" class="btn btn-success" onclick="showPermissionForm(<?= $projectData->p_id ?>)"><i class="mdi mdi-plus-circle-outline"></i> <?= lang('m_project_addaemployee') ?></button>
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
                 <?php if ($_SESSION['u_id'] == $user[0]->u_id || $_SESSION['u_role'] < 2 && $projectData->p_status < 3) { ?>
                   <th class="text-center"><?= lang('tl_project_actionbutton') ?></th>
                 <?php } ?>
               </tr>
             </thead>
             <?php if (is_array($user)) : $count = 1; ?>
               <?php foreach ($user as $key => $value) : ?>
                 <tr>
                   <td class="text-center"><?= $count++ ?></td>
                   <td><?= $value->u_firstname ?> <?= $value->u_lastname ?></td>
                   <td><?= $value->u_email ?></td>
                   <td><?= $value->u_tel ?></td>
                   <td><?php if($value->per_role == 1) { echo "หัวหน้าโครงการ"; } else {echo "พนักงาน"; } ?></td>
                     <?php if ($_SESSION['u_id'] == $user[0]->u_id || $_SESSION['u_role'] < 2 && $projectData->p_status < 3) { ?>
                      <td class="text-center">
                      <?php if($value->per_role == 2) { ?>
                       <button type="button" class="btn btn-danger btn-sm" name="del" id="del" title="<?= lang('tt_ep_demp') ?>" onclick="updatePermission(<?= $value->u_id ?>,<?= $projectData->p_id ?>)"><i class="mdi mdi-delete"></i></button>
                   <?php } else { ?> 
                      <button type="button" style="cursor:no-drop;" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="left" title="<?= lang('tt_ep_cdemp') ?>"><i class="mdi mdi-delete" style="color: grey;"></i></button>
                    <?php }?>
                    </td>
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
     $('#tablePermission').DataTable({
     dom: 'Bftlp',
     buttons: [{
         extend: 'excel',
         filename: 'พนักงานโครงการ' + document.title,
         title: 'พนักงานโครงการ' + document.title,
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
         filename: 'พนักงานโครงการ' + document.title,
         title: 'พนักงานโครงการ' + document.title,
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
</script>