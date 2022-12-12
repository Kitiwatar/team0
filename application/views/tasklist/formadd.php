<!-- Create by: Natakorn Phongsarikit 15-09-2565 -->
<?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="formtasklist" autocomplete="off">
        <div class="card-body">
          <div class="form-group">
            <label for="tl_name" class="form-label"><?= lang('md_at_tl') ?></label>
            <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->tl_name : '' ?>" id="tl_name" placeholder="<?= lang('md_at_ph-tl') ?>">
            <font id="tlnameMsg" class="small text-danger"></font>
          </div>
        </div>
    </div>
  </div>
</div>