<!-- Create by: Natakorn Phongsarikit 01-02-2566 -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h2 class='card-title'><?=lang('ms-announcement')?></h2>
        <button type="button" class="btn btn-success" id="addBtn" data-bs-toggle="modal"><i class="mdi mdi-plus-circle-outline"></i> <?= lang('ad-announcement') ?></button>
        <div class="table-responsive my-2">
          <table class="display table dt-responsive nowrap">
            <thead>
              <tr>
                <th><?= lang('announcement') ?></th>
                <th><?= lang('start-date') ?></th>
                <th><?= lang('end-date') ?></th>
                <th><?= lang('tl_project_at-operator') ?></th>
                <th class="text-center"><?= lang("an-status")?></th>
                <th class="text-center"><?= lang('tl_project_actionbutton') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php if (is_array($getData)) : $count = 1;?>
                <?php foreach ($getData as $key => $value) :?>
                <?php if($value->an_status == 0) : continue; endif; ?>
                  <tr>
                    <td><?= $value->an_text ?></td>
                    <td><?= $value->an_begindate?></td>
                    <td><?= $value->an_enddate?></td>
                    <td><?= $value->u_firstname?> <?= $value->u_lastname?> 
                    <td class="align-middle"><div class="form-check form-switch d-flex justify-content-center"><input type="checkbox" style="cursor: pointer;" class="form-check-input" title="<?= lang('tt_es_muser') ?>" onchange="changeStatus2(<?= $value->an_id ?>,<?= $value->an_status ?>)" id="status<?= $value->an_id ?>"<?= ($value->an_status == 1) ? ' checked>' : ">" ?></div></td>
                    <td class="text-center">
                      <button type="button" class="btn btn-warning btn-sm" name="edit" id="edit" onclick="edit(<?= $value->an_id ?>)" title="<?= lang('eda_button') ?>"><i class="mdi mdi-pencil"></i></button>
                      <button type="button" class="btn btn-danger btn-sm" name="del" id="del" title="<?= lang('dea_button') ?>" onclick="deleteAnnoun(<?= $value->an_id ?>,<?= $value->an_status ?>)"><i class="mdi mdi-delete"></i></button>
                    </td>
                  </tr>
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

<style>
  .name {
    color: #0d6efd;
  }

  .name:hover {
    color: #03a9f3;
  }
</style>

<script>
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
         filename: 'รายชื่อประกาศ',
         title: 'รายชื่อประกาศ',
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
         filename: 'รายชื่อประกาศ',
         title: 'รายชื่อประกาศ',
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
           pdf.content[1].table.widths = [150, 100, 100, 120];
           pdf.styles.tableHeader.fontSize = 16; // กำหนดขนาด font ของ header
           var rowCount = pdf.content[1].table.body.length; // หาจำนวนแถวทั้งหมดในตาราง
           // วนลูปเพื่อกำหนดค่าแต่ละคอลัมน์ เช่นการจัดตำแหน่ง
           for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
             pdf.content[1].table.body[i][1].alignment = 'center'; // คอลัมน์แรกเริ่มที่ 0
             pdf.content[1].table.body[i][2 ].alignment = 'center';
           };
         }
       }, // สิ้นสุดกำหนดพิเศษปุ่ม pdf
    ],
    columnDefs: [{
      orderable: false,
      targets: -1
    }],
    "order": [
			[1, "desc"]
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
      url: 'announ/getAddForm'
     
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  });
</script>