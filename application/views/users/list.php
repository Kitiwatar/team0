<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class='card-title'>ตารางรายชื่อพนักงานในระบบ</h4>
        <button type="button" class="btn btn-success" id="addBtn" data-bs-toggle="modal"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มพนักงานในระบบ</button>
        <div class="table-responsive">
          <table class="display table table-striped table-bordered dt-responsive nowrap">
            <thead>
              <tr>
                <th>ชื่อ-นามสกุล</th>
                <th>อีเมล</th>
                <th>เบอร์โทรศัพท์</th>
                <th>สิทธิ์ในการใช้งานระบบ</th>
                <th>สถานะ</th>
                <th class="text-center">ปุ่มดำเนินการ</th>
              </tr>
            </thead>
            <tbody>
              <?php if (is_array($getData)) : ?>
                <?php foreach ($getData as $key => $value) : ?>
                  <?php if ($value->u_role > 0) : ?>
                    <tr>
                      <td onclick="view(<?= $value->u_id ?>)" style="cursor:pointer;"><?= $value->u_firstname ?> <?= $value->u_lastname ?></td>
                      <td><?= $value->u_email ?></td>
                      <td><?= $value->u_tel ?></td>
                      <td><select class="form-control form-select" id="roleInput<?= $value->u_id ?>" onfocus="showRole(<?= $value->u_id ?>,<?= $value->u_role ?>)" onchange="changeRole(<?= $value->u_id ?>)">
                          <?php
                          foreach ($arrayRole as $key => $role) {
                            if ($value->u_role == $key) {
                              echo '<option value="' . $key . '" selected>' . $role . '</option>';
                            } else {
                              // echo '<option value="'.$key.'">'.$role.'</option>';
                            }
                          }
                          ?>
                        </select>
                      </td>
                      <td><?= ($value->u_status == 1) ? "กำลังทำงาน" : "ระงับการทำงาน" ?></td>
                      <td class="text-center">
                        <button type="button" class="btn btn-info" name="view" id="view" onclick="view(<?= $value->u_id ?>)" title="ดูข้อมูลพนักงาน"><i class="mdi mdi-file-find"></i></button>
                        <button type="button" class="btn btn-primary" name="view" id="view" onclick="changePassword(<?= $value->u_id ?>)" title="เปลี่ยนรหัสผ่าน"><i class="mdi mdi-key-variant"></i></button>
                        <button type="button" class="btn btn-warning" name="edit" id="edit" onclick="edit(<?= $value->u_id ?>)" title="แก้ไขข้อมูลพนักงาน"><i class="mdi mdi-pencil"></i></button>
                        <?php if ($value->u_status == 1) : ?>
                          <button type="button" class="btn btn-danger" name="del" id="del" title="ลบข้อมูล" onclick="changeStatus(<?= $value->u_id ?>,<?= $value->u_status ?>)"><i class="mdi mdi-delete"></i></button>
                        <?php else : ?>
                          <button type="button" class="btn btn-dark" name="del" id="del" title="กู้คืนข้อมูล" onclick="changeStatus(<?= $value->u_id ?>,<?= $value->u_status ?>)"><i class="mdi mdi-backup-restore"></i></button>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endif; ?>
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
  function showRole(id, role) {
    $.ajax({
      method: "post",
      url: 'users/getAllRole/json'
    }).done(function(returnData) {    
      var select = document.getElementById('roleInput' + id);
      var arrayRole = returnData.arrayRole;
      console.log(select.options[0])
      if(select.options.length < arrayRole.length) {
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
  $('.table').DataTable({
    "dom": 'Bftlp',
    "buttons": [
      {
        "extend": "excel",
        exportOptions: {
          columns: [0, 1, 2, 3, 4]
        },
      },
      { 
      "extend" : 'pdf', 
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
          console.log(doc);
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
  // $('.buttons-excel').text("ดาวน์โหลดไฟล์ Excel");
  // $('.buttons-pdf').text("ดาวน์โหลดไฟล์ PDF");

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