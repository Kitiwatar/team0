<!-- Create by: Natakorn Phongsarikit 15-09-2565 -->
<?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="formcancel" autocomplete="off">
        <div class="card-body">
          <div class="form-group">
            <label for="cl_name" class="form-label">ชื่อสาเหตุการยุติโครงการ</label>
            <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->cl_name : '' ?>" id="cl_name" placeholder="<?= lang('md_at_ph-tl') ?>">
            <font id="clnameMsg" class="small text-danger"></font>
          </div>
        </div>
    </div>
  </div>
</div>