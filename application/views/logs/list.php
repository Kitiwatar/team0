<!-- 
  Author: Patiphan Pansanga 
  Create: 2022-09-14
 -->
 <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class='card-title'>ตารางประวัติฐานข้อมูลในระบบ</h4>
        <div class="table-responsive">
          <table class="display table table-striped table-bordered dt-responsive nowrap">
            <thead>
              <tr>
                <th>ลำดับ</th>
                <th>การกระทำ</th>
                <th>ชื่อตาราง</th>
                <th>ข้อมูล</th>
                <th>คำสั่ง</th>
                <th>วันที่เรียกใช้</th>
                <th>ผู้กระทำ</th>
                <th class="text-center">ปุ่มดำเนินการ</th>
              </tr>
            </thead>
            <tbody>
              <?php if (is_array($getData)) : $count = 1;?>
                <?php foreach ($getData as $key => $value) : ?>
                    <tr>
                      <td class="text-center"><?= $count++ ?></td>
                      <td><?= $value->l_action ?></td>
                      <td><?= $value->l_table ?></td>
                      <td><?php if(strlen($value->l_data) <= 30){
                          echo $value->l_data;
                        } else {
                          $dataCut = mb_strimwidth($value->l_data, 0, 30, "...");
                          print($dataCut);
                        } ?>
                      </td>
                      <td><?php if(strlen($value->l_command) <= 30){
                          echo $value->l_command;
                        } else {
                          $commandCut = mb_strimwidth($value->l_command, 0, 30, "...");
                          print($commandCut);
                        } ?>
                      </td>
                      <td><?= $value->l_createdate ?></td>
                      <td><?= $value->u_firstname . " " . $value->u_lastname ?></td>
                      <td class="text-center">
                        <button type="button" class="btn btn-info" name="view" id="view" onclick="view(<?= $value->l_id ?>)" title="ดูรายละเอียด"><i class="mdi mdi-file-find"></i></button>
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
      "sZeroRecords": "ไม่พบข้อมูล"
    },
  });

</script>