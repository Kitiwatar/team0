<!-- Createby: Jiradat Pomyai, Patiphan Pansanga 07-09-2565 -->
 <?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="usersForm" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
              <label for="u_firstname" class="form-label"><?= lang('md_aes_ufn') ?><?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->u_firstname : '' ?>" id="u_firstname" placeholder="<?= lang('md_aes_ph-ufn') ?>" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="fnameMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="u_lastname" class="form-label"><?= lang('md_aes_uln') ?><?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->u_lastname : '' ?>" id="u_lastname" placeholder="<?= lang('md_aes_ph-uln') ?>" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="lnameMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="u_email" class="form-label"><?= lang('md_aes_uem') ?><?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="email" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->u_email : '' ?>" id="u_email" placeholder="<?= lang('md_aes_ph-uem') ?>" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="emailMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="u_tel" class="form-label"><?= lang('md_aes_upn') ?><?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="text" class="form-control" name="inputValue[]" maxlength="10" value="<?= isset($getData) ? $getData->u_tel : '' ?>" id="u_tel" placeholder="<?= lang('md_aes_ph-upn') ?>" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="telMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="u_role" class="form-label"><?= lang('md_aes_upm') ?><?php if(!isset($detail)) { echo $required; } ?></label>
              <?php if(!isset($detail)) { ?>
              <style>select:invalid { color: gainsboro; }</style>
              <select class="form-control form-select" name="inputValue[]" id="u_role" tabindex="1" <?php if(isset($detail)){echo "disabled";}?> >
                <?php if(isset($getData->u_role)) {
                  if($getData->u_role > 3 || $getData->u_role < 1) { 
                    echo '<option value="" selected disabled>'.lang('md_aes_ph-upm') .'</option>';
                  }
                  foreach($arrayRole as $key=>$value) { 
                    if($getData->u_role == $key){ 
                      echo '<option value="'.$key.'" selected>'.$value.'</option>';
                    } else { 
                      echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                  } 
                } else { 
                  echo '<option value="" selected disabled hidden>'.lang('md_aes_ph-upm') .'</option>';
                  foreach($arrayRole as $key=>$value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                  } 
                } ?> 
              </select>
              <font id="roleMsg" class="small text-danger"></font>
              <?php } else {
                $role = "คนในความลับ";
                foreach($arrayRole as $key=>$value) {
                  if($getData->u_role == $key){ 
                    $role = $value;
                  }
                } 
              ?>
                <input type="text" class="form-control" value="<?= $role ?>" <?php if(isset($detail)){echo "disabled";}?> >
              <?php } ?>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
   function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
  }

  $('#u_tel').on('input', function() {
    if(this.value.match(/[^0-9]/)) {
      $('#telMsg').text('  <?= lang('md_rqf_pn-f')  ?>');
      $('#u_tel').addClass("is-invalid");
    } else if(this.value.length < 10 || this.value[0] != "0") {
      $('#u_tel').addClass("is-invalid");
    } else {
      $('#telMsg').text(' ');
      $('#u_tel').removeClass("is-invalid").addClass("is-valid");
    }
    this.value = this.value.replace(/[^0-9]/g, '');
  });

  $('#u_email').on('input', function() {
    if(this.value.match(/[^a-zA-Z0-9.@_-]/)  || !validateEmail(this.value)) {
      $('#emailMsg').text('  <?= lang('md_rqf_em-f')  ?>');
      $('#u_email').addClass("is-invalid");
    } else {
      $('#emailMsg').text(' ');
      $('#u_email').removeClass("is-invalid").addClass("is-valid");
    }
    this.value = this.value.toLowerCase();
    this.value = this.value.replace(/[^a-zA-Z0-9.@_-]/g, '');
  });
</script>