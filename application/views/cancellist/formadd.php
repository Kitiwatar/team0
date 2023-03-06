<!-- Create by: Natakorn Phongsarikit 15-09-2565 -->
<?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="formcancellist" autocomplete="off">
        <div class="card-body">
          <div class="form-group">
            <label for="cl_name" class="form-label"><?= lang('name_cancel')?></label>
            <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->cl_name : '' ?>" id="cl_name" placeholder="<?=lang('ph-ad_cancel') ?>">
            <font id="clnameMsg" class="small text-danger"></font>
          </div>
        </div>
    </div>
  </div>
</div>