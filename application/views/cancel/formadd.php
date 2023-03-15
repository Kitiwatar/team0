<!-- Create by: Patiphan Pansanga 31-01-2566 -->
<?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="formcancel" autocomplete="off">
        <div class="card-body">
        <div class="form-group">
            <label for="c_cl_id" class="form-label"><?= lang('p-cancel-cause') ?><?= isset($detail) ? '' : $required ?></label>
            <select class="form-select" name="inputValue[]" id="c_cl_id">
              <option selected disabled value=""><?= lang('ch-cause-detail') ?></option>
              <?php foreach ($getData as $key => $value) { ?>
                    <option value="<?= $value->cl_id ?>"><?= $value->cl_name ?></option>
              <?php } ?>
            </select>
            <font id="nameMsg" class="small text-danger"></font>
          </div>
          <div class="form-group">
            <label for="c_detail" class="form-label"><?= lang('p-cause-detail') ?><?= isset($detail) ? '' : $required ?></label>
            <textarea class="form-control" name="inputValue[]" rows="3" id="c_detail"></textarea>
            <font id="detailMsg" class="small text-danger"></font>
          </div>
        </div>
    </div>
  </div>
</div>
<script>
  $('#c_cl_id').on('change', function() {
    $('#nameMsg').text('');
    $('#c_cl_id').removeClass("is-invalid").removeClass("is-valid");
  });
  $('#c_detail').on('input', function() {
    $('#detailMsg').text('');
    $('#c_detail').removeClass("is-invalid").removeClass("is-valid");
  });
</script>