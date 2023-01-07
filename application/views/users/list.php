<!-- Create by: Patiphan Pansanga 07-09-2565-->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h2 class='card-title'><?= lang('tp_user_em-name') ?></h2>
        <button type="button" class="btn btn-success" id="addBtn" data-bs-toggle="modal"><i class="mdi mdi-plus-circle-outline"></i> <?= lang('b_user_addem') ?></button>
        <div class="table-responsive my-2">
          <table class="display table dt-responsive nowrap">
            <thead>
              <tr>
                <th class="text-center"><?= lang('tl_project_pj-no') ?></th>
                <th><?= lang('gd_project_em-fullname') ?></th>
                <!-- <th><?= lang('gd_project_em-email') ?></th> -->
                <!-- <th><?= lang('gd_project_em-phone') ?></th> -->
                <th><?= lang('md_aes_upm') ?></th>
                <th><?= lang('gd_dateadded') ?></th>
                <th class="text-center"><?= lang('tp_user-status') ?></th>
                <th class="text-center"><?= lang('tl_project_actionbutton') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php if (is_array($getData)) : $count = 1; ?>
                <?php foreach ($getData as $key => $value) : ?>
                  <?php if ($value->u_role > 0) : ?>
                    <tr>
                      <td class="align-middle text-center"><?= $count++ ?></td>
                      <td class="align-middle name" onclick="view(<?= $value->u_id ?>)" style="cursor:pointer; font-weight: 900;"><?= $value->u_firstname ?> <?= $value->u_lastname ?></td>
                      <!-- <td class="align-middle"><?= $value->u_email ?></td> -->
                      <!-- <td class="align-middle"><?= $value->u_tel ?></td> -->
                      <td><select class="form-control form-select" <?= ($value->u_status == 0) ? 'disabled' : '' ?> id="roleInput<?= $value->u_id ?>" onfocus="showRole(<?= $value->u_id ?>,<?= $value->u_role ?>)" onchange="changeRole(<?= $value->u_id ?>)">
                          <?php
                          foreach ($arrayRole as $key => $role) {
                            if ($value->u_role == $key) {
                              echo '<option value="' . $key . '" selected>' . $role . '</option>';
                            } 
                          }
                          ?>
                        </select>
                      </td>
                      <td class="align-middle"><?= thaiDateTime($value->u_createdate) . " น." ?></td>
                      <td class="align-middle"><div class="form-check form-switch d-flex justify-content-center"><input type="checkbox" style="cursor: pointer;" class="form-check-input" title="<?= lang('tt_es_muser') ?>" onchange="changeStatus(<?= $value->u_id ?>,<?= $value->u_status ?>)" id="status<?= $value->u_id ?>"<?= ($value->u_status == 1) ? ' checked>' : ">" ?></div></td>
                      <td class="text-center align-middle">
                      <button type="button" class="btn btn-info btn-sm" name="view" id="view" onclick="view(<?= $value->u_id ?>)" title="<?= lang('tt_es_vuser') ?>"><i class=" fas fa-search"></i></button>
                        <?php if ($value->u_status == 1) : ?>
                          <button type="button" class="btn btn-primary btn-sm" name="view" id="view" onclick="changePassword(<?= $value->u_id ?>)" title="<?= lang('tt_es_cpuser') ?>"><i class="mdi mdi-key-variant"></i></button>
                          <button type="button" class="btn btn-warning btn-sm" name="edit" id="edit" onclick="edit(<?= $value->u_id ?>)" title="<?= lang('tt_es_vuser') ?>"><i class="mdi mdi-pencil"></i></button>
                        <?php else : ?>
                          <button type="button" style="cursor:no-drop; background-color: #C5C5C5; color:#808080;" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="left" title="<?= lang('tt_es_cn-cpuser') ?>"><i class=" mdi mdi-key-variant"></i></button>
                          <button type="button" style="cursor:no-drop; background-color: #C5C5C5; color:#808080;" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="left" title="<?= lang('tt_es_cn-euser') ?>"><i class="mdi mdi-pencil"></i></button>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <a type="button" class="btn waves-effect waves-light btn-dark" href="<?= base_url() ?>"><i class="mdi mdi-arrow-left"></i>  <?= lang('b_project_back') ?> </a>
      </div>
    </div>
  </div>
</div>

<script>
  function showRole(id, role) {
      var select = document.getElementById('roleInput' + id);
      var arrayRole = ['<?= lang('u_role-am') ?>', '<?= lang('u_role-em2') ?>', '<?= lang('u_role-em1') ?>'];
      if (select.options.length < arrayRole.length) {
        for (var i = 0; i < arrayRole.length; i++) {
          if (i + 1 == role) {
            continue;
          }
          var opt = document.createElement('option');
          opt.value = i + 1;
          opt.innerHTML = arrayRole[i];
          select.appendChild(opt);
        }
      }
  }

  $('[data-toggle="tooltip"]').tooltip();

  pdfMake.fonts = {
    THSarabun: {
      normal: 'THSarabun.ttf',
      bold: 'THSarabun-Bold.ttf',
      italics: 'THSarabun-Italic.ttf',
      bolditalics: 'THSarabun-BoldItalic.ttf'
    }
  }
  $('.table').DataTable({
    dom: 'Bftlp',
     buttons: [{
         extend: 'excel',
         filename: 'รายชื่อพนักงาน',
         title: 'รายชื่อพนักงาน',
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
         filename: 'รายชื่อพนักงาน',
         title: 'รายชื่อพนักงาน',
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
           pdf.content[1].table.widths = [40, 170, 120, 150];
           pdf.styles.tableHeader.fontSize = 16; // กำหนดขนาด font ของ header
           var rowCount = pdf.content[1].table.body.length; // หาจำนวนแถวทั้งหมดในตาราง
           // วนลูปเพื่อกำหนดค่าแต่ละคอลัมน์ เช่นการจัดตำแหน่ง
           for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
             pdf.content[1].table.body[i][0].alignment = 'center'; // คอลัมน์แรกเริ่มที่ 0
             pdf.content[1].table.body[i][2].alignment = 'center';
             pdf.content[1].table.body[i][3].alignment = 'center';
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

  $('#addBtn').click(function(e) {
    e.preventDefault();
    $.ajax({
      method: "post",
      url: 'users/getAddForm'
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  });
</script>