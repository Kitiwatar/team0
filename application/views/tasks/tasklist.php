<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class='card-title'>เพิ่มรายการกิจกรรมใหม่</h4>
        <button type="button" class="btn btn-success" id="addBtn" data-bs-toggle="modal"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มรายการกิจกรรมในระบบ</button>
        <div class="table-responsive my-2">
          <table class="display table table-striped table-bordered dt-responsive nowrap">
            <thead>
              <tr>
                <th>รายการกิจกรรม</th>
                <th>วันที่เพิ่มรายการกิจกรรม</th>
                <th>ผู้ดำเนินการ</th>
                <th class="text-center">ปุ่มดำเนินการ</th>
              </tr>
            </thead>
            <tbody>
            <?php if (is_array($getData)) : ?>
                <?php foreach ($getData as $key => $value) : ?>
                    <tr>
                      <td><?= $value->tl_name ?></td>
                      <td><?= $value->tl_createdate?></td>
                      <td><?= $value->u_firstname ?> <?= $value->u_lastname ?></td>
                    <td class="text-center">
                    <button type="button" class="btn btn-warning" name="edit" id="edit" onclick="edit(<?= $value->tl_id ?>)" title="แก้ไขข้อมูลพนักงาน"><i class="mdi mdi-pencil"></i></button>
                    <button type="button" class="btn btn-danger" name="del" id="del" title="ลบข้อมูล" onclick="changeStatus(<?= $value->tl_id ?>,<?= $value->tl_status ?>)"><i class="mdi mdi-delete"></i></button>
                    </php>     
                  </td>
                     </tr>
                    <?php endforeach;?>
               <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
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
      url: 'tasks/getAddForm'
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  });
</script>