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
                  <tr>
                    <td onclick="view(<?= $value->u_id ?>)" style="cursor:pointer;"><?= $value->u_firstname ?> <?= $value->u_lastname ?></td>
                    <td><?= $value->u_email ?></td>
                    <td><?= $value->u_tel ?></td>
                    <td><?php
                      if($value->u_role == 1) { 
                        echo "ผู้ดูแลระบบ";
                      } else if($value->u_role == 2) { 
                        echo "หัวหน้าโครงการ"; 
                      } else if($value->u_role == 3) { 
                        echo "พนักงาน"; 
                      }?>
                    </td>
                    <td><?= ($value->u_status == 1) ? "กำลังทำงาน" : "ระงับการทำงาน" ?></td>
                    <td class="text-center">
                      <button type="button" class="btn btn-info" name="view" id="view"  onclick="view(<?= $value->u_id ?>)" title="ดูข้อมูลพนักงาน"><i class="mdi mdi-file-find"></i></button>
                      <button type="button" class="btn btn-primary" name="view" id="view"  onclick="view(<?= $value->u_id ?>)" title="เปลี่ยนรหัสผ่าน"><i class="mdi mdi-key-variant"></i></button>
                      <button type="button" class="btn btn-warning" name="edit" id="edit"  onclick="edit(<?= $value->u_id ?>)" title="แก้ไขข้อมูลพนักงาน"><i class="mdi mdi-pencil"></i></button>
                      <?php if ($value->u_status == 1) : ?>
                        <button type="button" class="btn btn-danger" name="del" id="del" title="ลบข้อมูล" onclick="changeStatus(<?= $value->u_id ?>,<?= $value->u_status ?>)"><i class="mdi mdi-delete"></i></button>
                      <?php else : ?>
                        <button type="button" class="btn btn-dark" name="del" id="del" title="กู้คืนข้อมูล" onclick="changeStatus(<?= $value->u_id ?>,<?= $value->u_status ?>)"><i class="mdi mdi-backup-restore"></i></button>
                      <?php endif; ?>
                    </td>
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

<script>
  $('.table').DataTable({
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
    }
  });

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