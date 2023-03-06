<!-- Create by: Natakorn Phongsarikit 16-09-2565 -->
<?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="formaannouce" autocomplete="off">
        <div class="card-body">
          <div class="form-group">
            <label for="an_text" class="form-label"><?=lang('announcement') ?></label>
            <input type="text" class="form-control" name="inputValue[]"  value="<?= isset($getData) ? $getData->an_text : '' ?>" id="an_text" maxlength="30" placeholder="<?= lang('ph-ad_an') ?>">
            <font id="an_eMsg" class="small text-danger"></font>
          </div>
        </div>
    </div>
  </div>
</div>