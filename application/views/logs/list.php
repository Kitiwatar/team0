<!-- Create by: Patiphan Pansanga 14-09-2022-->
 <div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h2 class='card-title'><?= lang('tp_logs_us-history')  ?></h2>
        <div class="table-responsive">
          <table class="display table dt-responsive nowrap">
            <thead>
              <tr>
                <th class="text-center"><?= lang('tl_project_pj-no') ?></th>
                <th><?= lang('tb_topic_dt-action') ?></th>
                <th><?= lang('tb_topic_dt-db') ?></th>
                <th><?= lang('tb_topic_dt-change') ?></th>
                <th><?= lang('tb_topic_dt-command') ?></th>
                <th><?= lang('tb_topic_dt-called') ?></th>
                <th><?= lang('tb_topic_dt-operator') ?></th>
                <th class="text-center"><?= lang('tl_project_actionbutton') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php if (is_array($getData)) : $count = 1;?>
                <?php foreach ($getData as $key => $value) : ?>
                    <tr>
                      <td class="text-center"><?= $count++ ?></td>
                      <td><?= $value->l_action ?></td>
                      <td><?= $value->l_table ?></td>
                      <td><?php 
                          $dataCut = mb_strimwidth($value->l_data, 0, 10, "...");
                          print($dataCut);
                        ?>
                      </td>
                      <td><?php 
                          $commandCut = mb_strimwidth($value->l_command, 0, 10, "...");
                          print($commandCut);
                        ?>
                      </td>
                      <td><?=thaiDateTime($value->l_createdate)." น."?></td>
                      <td><?= $value->u_firstname . " " . $value->u_lastname ?></td>
                      <td class="text-center">
                        <button type="button" class="btn btn-info btn-sm" name="view" id="view" onclick="view(<?= $value->l_id ?>)" title="<?= lang('tt_log_vinfo') ?>"><i class="fas fa-search"></i></button>
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
    "dom": 'ftlp',
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

</script>