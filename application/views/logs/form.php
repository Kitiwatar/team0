<!-- Create by: Patiphan Pansanga 14-09-2022-->
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="logForm" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
              <label for="action" class="form-label"><?= lang('md_log_action') ?></label>
              <input type="text" class="form-control" id="action" value="<?= isset($getData) ? $getData->l_action : '' ?>" <?php if(isset($detail)){echo "disabled";}?> >
            </div>
            <div class="form-group">
              <label for="table" class="form-label"><?= lang('md_log_table') ?></label>
              <input type="text" class="form-control" id="table" value="<?= isset($getData) ? $getData->l_table : '' ?>" <?php if(isset($detail)){echo "disabled";}?> >
            </div>
            <div class="form-group">
              <label for="data" class="form-label"><?= lang('md_log_data') ?></label>
              <textarea class="form-control" id="command" rows="4" <?php if(isset($detail)){echo "disabled";}?>><?= isset($getData) ? $getData->l_data : '' ?></textarea>
            </div>
            <div class="form-group">
              <label for="command" class="form-label"><?= lang('md_log_command') ?></label>
              <textarea class="form-control" id="command" rows="4" <?php if(isset($detail)){echo "disabled";}?>><?= isset($getData) ? $getData->l_command : '' ?></textarea>
            </div>
            <div class="form-group">
              <label for="createdate" class="form-label"><?= lang('md_log_calldate') ?></label>
              <input type="text" class="form-control" id="createdate" value="<?= isset($getData) ? $getData->l_createdate : '' ?>" <?php if(isset($detail)){echo "disabled";}?> >
            </div>
            <div class="form-group">
              <label for="user" class="form-label"><?= lang('md_log_operator') ?></label>
              <input type="text" class="form-control" id="user" value="<?php if(isset($getData)) { echo $getData->u_firstname . " " . $getData->u_lastname; } ?>" <?php if(isset($detail)){echo "disabled";}?> >
            </div>
        </div>
      </form>
    </div>
  </div>
</div>