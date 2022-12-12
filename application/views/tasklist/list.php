<!-- Create by: Natakorn Phongsarikit 15-09-2565 -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h2 class='card-title'><?= lang('tp_user_tl-name') ?></h2>
        <button type="button" class="btn btn-success" id="addBtn" data-bs-toggle="modal"><i class="mdi mdi-plus-circle-outline"></i> <?= lang('b_user_addtasklist') ?></button>
        <div class="table-responsive my-2">
          <table class="display table dt-responsive nowrap">
            <thead>
              <tr>
                <th class="text-center"><?= lang('tl_no.') ?></th>
                <th><?= lang('tb_topic_dt-name') ?></th>
                <th><?= lang('gd_dateadded') ?></th>
                <th><?= lang('tl_project_at-operator') ?></th>
                <th class="text-center"><?= lang('tl_project_actionbutton') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php if (is_array($getData)) : $count = 1;?>
                <?php foreach ($getData as $key => $value) :?>
                <?php if($value->tl_status == 0) : continue; endif; ?>
                  <tr>
                    <td class="text-center"><?= $count++ ?></td> 
                    <td><?= $value->tl_name ?></td>
                    <td><?= thaiDateTime($value->tl_createdate)." น."?></td>
                    <td><?= $value->u_firstname ?> <?= $value->u_lastname ?></td>
                    <td class="text-center">
                      <button type="button" class="btn btn-warning btn-sm" name="edit" id="edit" onclick="edit(<?= $value->tl_id ?>)" title="<?= lang('tt_tl_etl') ?>"><i class="mdi mdi-pencil"></i></button>
                      <?php if ($taskCheck[$key] == null) { ?>
                        <button type="button" class="btn btn-danger btn-sm" name="del" id="del" title="<?= lang('tt_tl_dtl') ?>" onclick="changeStatus(<?= $value->tl_id ?>,<?= $value->tl_status ?>)"><i class="mdi mdi-delete"></i></button>
                      <?php } else { ?>
                        <button type="button" style="cursor:no-drop; background-color: #C5C5C5; color:#808080;" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="left" title="<?= lang('tt_tl_cn-dtl') ?>"><i class="mdi mdi-delete"></i></button>
                      <?php } ?>
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
    "dom": 'Bftlp',
    "buttons": [{
        "extend": "excel",
        exportOptions: {
          columns: [0, 1, 2]
        },
      },
      {
        "extend": 'pdf',
        "exportOptions": {
          columns: [0, 1, 2]
        },
        "text": 'PDF',
        "pageSize": 'A4',
        "customize": function(doc) {
          doc.defaultStyle = {
            font: 'THSarabun',
            fontSize: 16
          };
          // console.log(doc);
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

  $('#addBtn').click(function(e) {
    e.preventDefault();
    $.ajax({
      method: "post",
      url: 'tasklist/getAddForm'
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  });
</script>