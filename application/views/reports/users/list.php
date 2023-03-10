<!-- Create by: Patiphan Pansanga 21-12-2565-->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h2 class='card-title'><?= lang('rp_user') ?></h2>
        <div class="table-responsive my-2">
          <table class="display table dt-responsive nowrap">
            <thead>
              <tr>
              <th><?= lang('gd_project_em-fullname') ?></th>
              <th class="text-center"><?= lang('tl_home_amountworkpiece') ?></th>
                <th class="text-center"><?= lang('tl_project_actionbutton') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php if (is_array($users)) : $count = 1; ?>
                <?php foreach ($users as $key => $value) : ?>
                  <?php if ($value->u_role < 1) {
                    continue;
                  } ?>
                  <tr>
                  <td class="align-middle"><?= $value->u_firstname . " " . $value->u_lastname ?></td>
                  <td class="align-middle text-center"><?= $projectCount[$key] ?></td>
                    <td class="align-middle text-center">
                      <?php if ($projectCount[$key] > 0) { ?>
                        <button class="btn btn-sm btn-info" title="<?= lang('v-emp') ?>" onclick="viewProjects(<?= $value->u_id ?>)">
                          <i class="mdi mdi-file-document"></i>
                        </button>
                      <?php } else { ?>
                        <button type="button" style="cursor:no-drop" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="left" title="<?= lang('v-emp-c') ?>"><i class="mdi mdi-file-document" style="color: grey;"></i></button>
                      <?php } ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <a type="button" class="btn waves-effect waves-light btn-dark" href="<?= base_url() ?>"><i class="mdi mdi-arrow-left"></i> <?= lang('b_project_back') ?> </a>
      </div>
    </div>
  </div>
</div>

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
        filename: 'จำนวนโครงการปัจจุบันของพนักงาน',
        title: 'จำนวนโครงการปัจจุบันของพนักงาน',
        exportOptions: {
          columns: [0, 1, 2]
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
        filename: 'จำนวนโครงการปัจจุบันของพนักงาน',
        title: 'จำนวนโครงการปัจจุบันของพนักงาน',
        pageSize: 'A4', // ขนาดหน้ากระดาษเป็น A4
        exportOptions: {
          columns: [0, 1, 2]
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
          pdf.content[1].table.widths = [40, 300, 150];
          pdf.styles.tableHeader.fontSize = 16; // กำหนดขนาด font ของ header
          var rowCount = pdf.content[1].table.body.length; // หาจำนวนแถวทั้งหมดในตาราง
          // วนลูปเพื่อกำหนดค่าแต่ละคอลัมน์ เช่นการจัดตำแหน่ง
          for (i = 1; i < rowCount; i++) { // i เริ่มที่ 1 เพราะ i แรกเป็นแถวของหัวข้อ
            pdf.content[1].table.body[i][0].alignment = 'center'; // คอลัมน์แรกเริ่มที่ 0
            pdf.content[1].table.body[i][2].alignment = 'center';
          };
        }
      }, // สิ้นสุดกำหนดพิเศษปุ่ม pdf
    ],
    columnDefs: [{
      orderable: false,
      targets: -1
    }],
    order: [
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
</script>