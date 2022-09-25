<!-- Create by: Jiradat Pomyai, Patiphan Pansanga 24-09-2565 -->
 <?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="usersForm" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
              <label for="p_name" class="form-label">ชื่อโครงการ<?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_name : '' ?>" id="p_name" placeholder="กรอกชื่อของโครงการ (Project Monitoring System)" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="nameMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="p_detail" class="form-label">รายระเอียดโครงการ<?php if(!isset($detail)) { echo $required; } ?></label>
              <textarea class="form-control" name="inputValue[]" rows="3" id="p_detail" placeholder="กรอกรายละเอียดของโครงการ (Project Monitoring System เป็นระบบสำหรับ...)" <?php if(isset($detail)){echo "disabled";}?>><?= isset($getData) ? $getData->p_detail : '' ?></textarea>
              <font id="detailMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="u_email" class="form-label">ชื่อลูกค้า<?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="email" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_customer : '' ?>" id="p_customer" placeholder="กรอกชื่อของลูกค้า (ภูมิพัฒน์ เรืองรังสรรค์)" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="customerMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="p_createdate" class="form-label">วันที่เริ่มโครงการ<?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="date" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_createdate : '' ?>" id="p_createdate" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="createdateMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="u_tel" class="form-label">ช่องทางติดต่อลูกค้า<?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_contact : '' ?>" id="p_contact" placeholder="กรอกช่องทางติดต่อลูกค้า (line: phoomphat tel: 0987654321)" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="contactMsg" class="small text-danger"></font>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function checkOnlyText(id) {
    var dom = document.getElementById(id);
    if(strNumber(String.fromCharCode(event.which)) || dom.value.length > 99){
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
</script>