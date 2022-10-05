<!-- Createby: Jiradat Pomyai, Patiphan Pansanga 07-09-2565 -->
 <?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="usersForm" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
              <label for="u_firstname" class="form-label">ชื่อ<?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->u_firstname : '' ?>" id="u_firstname" placeholder="กรอกชื่อของพนักงาน (สมศักดิ์)" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="fnameMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="u_lastname" class="form-label">นามสกุล<?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->u_lastname : '' ?>" id="u_lastname" placeholder="กรอกนามสกุลของพนักงาน (รักงาน)" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="lnameMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="u_email" class="form-label">อีเมล<?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="email" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->u_email : '' ?>" id="u_email" placeholder="กรอกอีเมลของพนักงาน (example@email.com)" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="emailMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="u_tel" class="form-label">เบอร์โทรศัพท์<?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="text" class="form-control" name="inputValue[]" maxlength="10" value="<?= isset($getData) ? $getData->u_tel : '' ?>" id="u_tel" placeholder="กรอกเบอร์โทรศัพท์ของพนักงาน (0987654321)" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="telMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="u_role" class="form-label">สิทธิ์ในการใช้งานระบบ<?php if(!isset($detail)) { echo $required; } ?></label>
              <?php if(!isset($detail)) { ?>
              <style>select:invalid { color: gainsboro; }</style>
              <select class="form-control form-select" name="inputValue[]" id="u_role" tabindex="1" <?php if(isset($detail)){echo "disabled";}?> >
                <?php if(isset($getData->u_role)) {
                  if($getData->u_role > 3 || $getData->u_role < 1) { 
                    echo '<option value="" selected disabled>เลือกสิทธิ์ของผู้ใช้งาน</option>';
                  }
                  foreach($arrayRole as $key=>$value) { 
                    if($getData->u_role == $key){ 
                      echo '<option value="'.$key.'" selected>'.$value.'</option>';
                    } else { 
                      echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                  } 
                } else { 
                  echo '<option value="" selected disabled hidden>เลือกสิทธิ์ของผู้ใช้งาน</option>';
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
  $("#u_tel").keyup(function (event) {
    var tel = document.getElementById("u_tel");
    tel.value = tel.value.replace(/[^0-9]+/, '');
  });

  $("#u_email").keyup(function (event) {
    var email = document.getElementById("u_email");
    email.value = email.value.toLowerCase();
  });
</script>