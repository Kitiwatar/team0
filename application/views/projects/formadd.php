<!-- Create by: Jiradat Pomyai, Patiphan Pansanga 24-09-2565 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" rel="stylesheet">
<style>
  .datepicker {
    position: fixed !important;
  }
</style>
<?php $required = '<span class="text-danger">*</span>'; 
date_default_timezone_set("Asia/Bangkok"); ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="projectsForm" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
              <label for="p_name" class="form-label"><?= lang('md_ap-pn') ?><?php   if(!isset($detail)) { echo $required; } ?></label>
              <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_name : '' ?>" id="p_name" placeholder="<?= lang('md_ap_ph-pn') ?>" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="nameMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="p_detail" class="form-label"><?= lang('md_ap-dt') ?><?php if(!isset($detail)) { echo $required; } ?></label>
              <textarea class="form-control" name="inputValue[]" rows="3" id="p_detail" placeholder="<?= lang('md_ap_ph-dt') ?>" <?php if(isset($detail)){echo "disabled";}?>><?= isset($getData) ? $getData->p_detail : '' ?></textarea>
              <font id="detailMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="p_customer" class="form-label"><?= lang('md_ap-ctn') ?><?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_customer : '' ?>" id="p_customer" placeholder="<?= lang('md_ap_ph-ctn') ?>" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="customerMsg" class="small text-danger"></font>
            </div>
              <div class="form-group">
              <label for="p_createdate" class="form-label"><?= lang('md_ap-ps') ?><?php if(!isset($detail)) { echo $required; } ?></label>
              <div class="input-group date" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                <?php if(isset($getData)) : $newDate = date("d-m-Y", strtotime($getData->p_createdate)); endif; ?>
                <input type="text" class="form-control" id="p_createdate" name="inputValue[]" value="<?= isset($getData) ? $newDate : '' ?>" <?php if(isset($detail)){echo "disabled";}?> placeholder="<?= lang('md_ap_ph-ps') ?> (<?=date("d-m-Y") ?>)" maxlength="10" minlength="10" autocomplete="off" required>
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </div>
                <span class="input-group-text fs-5" onclick="pickDate()" style="cursor: pointer;"><i class="mdi mdi-calendar-range"></i></span> 
              </div>
              <font id="createdateMsg" class="small text-danger"></font>
            </div>
            <label class="form-label"><?= lang('md_ap-ctn') ?></label>
            <table width="100%">
              <tr>
                <td width="160px" class="ps-3"><label for="p_telcontact" class="form-label"><?= lang('md_ap-tln') ?>:</label></td>
                <td>
                  <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_telcontact : '' ?>" maxlength="10" id="p_telcontact" placeholder="<?= lang('md_ap_ph-tln') ?>" <?php if(isset($detail)){echo "disabled";}?> >
                </td>
              </tr>
              <tr><td class="py-2"></td><td><font id="telMsg" class="small text-danger"></font></td></tr>
              <tr>
                <td class="ps-3"><label for="p_linecontact" class="form-label"><?= lang('md_ap-line') ?>:</label></td>
                <td>
                  <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_linecontact : '' ?>" id="p_linecontact" placeholder="<?= lang('md_ap_ph-line') ?>" <?php if(isset($detail)){echo "disabled";}?> >                 
                </td>
              </tr>
              <tr><td class="py-2"></td><td><font id="lineMsg" class="small text-danger"></font></td></tr>
              <tr>
                <td class="ps-3"><label for="p_emailcontact" class="form-label"><?= lang('md_ap-email') ?>:</label></td>
                <td>
                  <input type="email" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_emailcontact : '' ?>" id="p_emailcontact" placeholder="<?= lang('md_ap_ph-email') ?>" <?php if(isset($detail)){echo "disabled";}?> >
                </td>
              </tr>
              <tr><td class="py-2"></td><td><font id="emailMsg" class="small text-danger"></font></td></tr>
              <tr>
                <td class="align-top ps-3"><label for="p_othercontact" class="form-label"><?= lang('md_ap-other') ?>:</label></td>
                <td><textarea class="form-control" name="inputValue[]" rows="3" id="p_othercontact" placeholder="<?= lang('md_ap_ph-other') ?>" <?php if(isset($detail)){echo "disabled";}?>><?= isset($getData) ? $getData->p_othercontact : '' ?></textarea></td>
              </tr>
            </table>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script>
  function pickDate() {
    let date = document.getElementById("p_createdate")
    date.focus()
  }
  $('#p_createdate').on('input', function() {
    if(this.value.match(/[^0-9-]/)) {
      $('#createdateMsg').text(' <?= lang('md_rqf_sd-f')  ?>');
    } else {
      $('#createdateMsg').text(' ');
    }
    this.value = this.value.toLowerCase();
    this.value = this.value.replace(/[^0-9-]/g, '');
  });

  $('#p_telcontact').on('input', function() {
    let count = 0;
    if(this.value.match(/[^0-9]/)) {
      count++;
      $('#telMsg').text('  <?= lang('md_rqf_pn-f')  ?>');
      $('#p_telcontact').addClass("is-invalid");
    } else if(this.value.length < 10 || this.value[0] != "0") {
      $('#p_telcontact').addClass("is-invalid");
    } else {
      $('#telMsg').text(' ');
      $('#p_telcontact').removeClass("is-invalid").addClass("is-valid");
    }
    if(this.value.length == 0 && count == 0) {
      $('#p_telcontact').removeClass("is-invalid").removeClass("is-valid");
    }
    this.value = this.value.replace(/[^0-9]/g, '');
  });

  $('#p_linecontact').on('input', function() {
    let count = 0;
    if(this.value.match(/[^a-zA-Z0-9._-]/)) {
      count++;
      $('#lineMsg').text('  <?= lang('md_rqf_ln-f')  ?>');
      $('#p_linecontact').addClass("is-invalid");
    } else {
      $('#lineMsg').text(' ');
      $('#p_linecontact').removeClass("is-invalid").addClass("is-valid");
    }
    if(this.value.length == 0 && count == 0) {
      $('#p_linecontact').removeClass("is-invalid").removeClass("is-valid");
    }
    this.value = this.value.toLowerCase();
    this.value = this.value.replace(/[^a-zA-Z0-9._-]/g, '');
  });

  $("#p_emailcontact").on('input', function() {
    let count = 0;
    if(this.value.match(/[^a-zA-Z0-9.@_-]/)  || !validateEmail(this.value)) {
      count++;
      $('#emailMsg').text('  <?= lang('md_rqf_em-f')  ?>');
      $('#p_emailcontact').addClass("is-invalid");
    } else {
      $('#emailMsg').text(' ');
      $('#p_emailcontact').removeClass("is-invalid").addClass("is-valid");
    }
    if(this.value.length == 0 && count == 0) {
      $('#p_emailcontact').removeClass("is-invalid").removeClass("is-valid");
    }
    this.value = this.value.toLowerCase();
    this.value = this.value.replace(/[^a-zA-Z0-9.@_-]/g, '');
  });

  $('#p_telcontact').on('focusout', function() {
    if(this.value.length == 0) {
      $('#p_telcontact').removeClass("is-invalid");
      $('#telMsg').text(' ');
    }
  });
  $('#p_linecontact').on('focusout', function() {
    if(this.value.length == 0) {
      $('#p_linecontact').removeClass("is-invalid");
      $('#lineMsg').text(' ');
    }
  });
  $('#p_emailcontact').on('focusout', function() {
    if(this.value.length == 0) {
      $('#p_emailcontact').removeClass("is-invalid");
      $('#emailMsg').text(' ');
    }
  });
</script>