<!-- 
  Author: Natakorn Phongsarikit, Patiphan Pansanga 
  Create: 2022-09-07
 -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="usersForm" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
              <label for="u_firstname" class="form-label">ชื่อ<font id="fnameMsg" class="text-danger"></font></label>
              <input type="text" class="form-control" onkeypress="checkOnlyThai('u_firstname')" name="inputValue[]" value="<?= isset($getData) ? $getData->u_firstname : '' ?>" id="u_firstname" placeholder="กรอกชื่อของพนักงาน" <?php if(isset($detail)){echo "disabled";}?> >
            </div>
            <div class="form-group">
              <label for="u_lastname" class="form-label">นามสกุล<font id="lnameMsg" class="text-danger"></font></label>
              <input type="text" class="form-control" onkeypress="checkOnlyThai('u_lastname')" name="inputValue[]" value="<?= isset($getData) ? $getData->u_lastname : '' ?>" id="u_lastname" placeholder="กรอกนามสกุลของพนักงาน" <?php if(isset($detail)){echo "disabled";}?> >
            </div>
            <div class="form-group">
              <label for="u_email" class="form-label">อีเมล<font id="emailMsg" class="text-danger"></font></label>
              <input type="email" class="form-control" onkeypress="checkEmailValid('u_email')" name="inputValue[]" value="<?= isset($getData) ? $getData->u_email : '' ?>" id="u_email" placeholder="กรอกอีเมลของพนักงาน" <?php if(isset($detail)){echo "disabled";}?> >
            </div>
            <div class="form-group">
              <label for="u_tel" class="form-label">เบอร์โทรศัพท์<font id="telMsg" class="text-danger"></font></label>
              <input type="text" class="form-control" onkeypress="checkTelValid('u_tel')" name="inputValue[]" value="<?= isset($getData) ? $getData->u_tel : '' ?>" id="u_tel" placeholder="กรอกเบอร์โทรศัพท์ของพนักงาน" <?php if(isset($detail)){echo "disabled";}?> >
            </div>
            <div class="form-group">
              <label for="u_role" class="form-label">สิทธิ์ในการใช้งานระบบ</label>
              <style>select:invalid { color: gray; }</style>
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
            </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>

  function checkOnlyThai(id) {
    var dom = document.getElementById(id);
    if(!strThai(String.fromCharCode(event.which)) || dom.value.length > 99){
      event.preventDefault();
    }
  }

  function checkEmailValid(id) {
    var dom = document.getElementById(id);
    if(!strEmail(String.fromCharCode(event.which)) || dom.value.length > 99){
      event.preventDefault();
    }
  }

  function checkTelValid(id) {
    var dom = document.getElementById(id);
    if(!strNumber(String.fromCharCode(event.which)) || dom.value.length > 9){
      console.log($(id).val());
      event.preventDefault();
    }
  }

  // $('#u_firstname').keypress(function(event) {
  //   console.log($('#u_firstname').val());
  //   if(!checkText(String.fromCharCode(event.which)) || $('#u_firstname').val().length > 99){
  //     event.preventDefault();
  //   }
  // });

  // $('#u_lastname').keypress(function(event) {
  //   console.log($('#u_lastname').val());
  //   if(!checkText(String.fromCharCode(event.which)) || $('#u_lastname').val().length > 99){
  //     event.preventDefault();
  //   }
  // });
  
  // $('#u_email').keypress(function(event) {
  //   console.log($('#u_email').val());
  //   if(!checkEmail(String.fromCharCode(event.which)) || $('#u_email').val().length > 99){
  //     event.preventDefault();
  //   }
  // });

  // $('#u_tel').keypress(function(event) {
  //   console.log($('#u_tel').val());
  //   if(event.which != 8 && isNaN(String.fromCharCode(event.which)) || $('#u_tel').val().length > 9){
  //     event.preventDefault();
  //   }
  // });
</script>