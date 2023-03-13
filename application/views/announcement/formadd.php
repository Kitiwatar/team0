<!-- Create by: Natakorn Phongsarikit 16-09-2565 -->
<?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="formaannouce" autocomplete="off">
        <div class="card-body">
          <div class="card-body p-0">
            <div class="row">
              <div class="form-group">
                <label for="an_text" class="form-label"><?= lang('announcement') ?><?= isset($detail) ? '' : $required ?></label>
                <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->an_text : '' ?>" id="an_text" maxlength="30" placeholder="<?= lang('ph-ad_an') ?>">
                <font id="clnameMsg" class="small text-danger"></font>
              </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                  <label for="an_begindate" class="form-label"><?= "วันที่แสดง" ?><?= isset($detail) ? '' : $required ?></label>
                  <div class="input-group date" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                    <?php if (isset($getData)) : $newDate = date("d-m-Y", strtotime($getData->an_begindate));
                    endif; ?>
                    <input type="text" class="form-control"  name="inputValue[]" value="<?= isset($getData) ? $newDate : '' ?>" id="an_begindate" <?= isset($detail) ? "disabled" : '' ?> placeholder="<?= lang('md_ap_ph-ps') ?> (<?= date("d-m-Y") ?>)" maxlength="10" minlength="10" autocomplete="off" required>
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                    <span class="input-group-text fs-5" onclick="pickDate1()" style="cursor: pointer;"><i class="mdi mdi-calendar-range"></i></span>
                  </div>
                  <font id="begindateMsg" class="small text-danger"></font>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                  <label for="an_enddate" class="form-label"><?= "วันที่สิ้นสุด" ?><?= isset($detail) ? '' : $required ?></label>
                  <div class="input-group date" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                    <?php if (isset($getData)) : $newDate = date("d-m-Y", strtotime($getData->an_enddate));
                    endif; ?>
                    <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $newDate : '' ?>"  id="an_enddate" <?= isset($detail) ? "disabled" : '' ?> placeholder="<?= lang('md_ap_ph-ps') ?> (<?= date("d-m-Y") ?>)" maxlength="10" minlength="10" autocomplete="off" required>
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                    <span class="input-group-text fs-5" onclick="pickDate2()" style="cursor: pointer;"><i class="mdi mdi-calendar-range"></i></span>
                  </div>
                  <font id="enddateMsg" class="small text-danger"></font>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script>
  function pickDate1() {
    let date = document.getElementById("an_begindate")
    date.focus()
  }
  function pickDate2() {
    let date = document.getElementById("an_enddate")
    date.focus()
  }
  $('#an_begindate').on('change', function() {
    $('.datepicker').hide();
  });
  $('#an_enddate').on('change', function() {
    $('.datepicker').hide();
  });

  $('#an_begindate').on('input', function() {
    if (this.value.match(/[^0-9-]/)) {
      $('#createdateMsg').text(' <?= lang('md_rqf_sd-f')  ?>');
    } else {
      $('#createdateMsg').text(' ');
    }
    this.value = this.value.toLowerCase();
    this.value = this.value.replace(/[^0-9-]/g, '');
  });
  $('#an_enddate').on('input', function() {
    if (this.value.match(/[^0-9-]/)) {
      $('#CreatedateMsg').text(' <?= lang('md_rqf_sd-f')  ?>');
    } else {
      $('#CreatedateMsg').text(' ');
    }
    this.value = this.value.toLowerCase();
    this.value = this.value.replace(/[^0-9-]/g, '');
  });
</script>