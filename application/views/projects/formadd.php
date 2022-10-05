<!-- Create by: Jiradat Pomyai, Patiphan Pansanga 24-09-2565 -->
<style>
  input {
      position: relative;
  }
  input[type="date"]::-webkit-calendar-picker-indicator {
    background-position: right;
    background-size: auto;
    cursor: pointer;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 4px;
    top: -13px;
    width: auto;
    height: 60px;
  }
</style>
<?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="projectsForm" autocomplete="off">
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
              <label for="p_customer" class="form-label">ชื่อลูกค้า<?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_customer : '' ?>" id="p_customer" placeholder="กรอกชื่อของลูกค้า (บริษัทรักงาน)" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="customerMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="p_createdate" class="form-label">วันที่เริ่มโครงการ<?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="date" onfocus="this.showPicker()" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_createdate : '' ?>" id="p_createdate" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="createdateMsg" class="small text-danger"></font>
            </div>
            <div class="form-group">
              <label for="p_telcontact" class="form-label">เบอร์โทรศัพท์ลูกค้า</label>
              <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_telcontact : '' ?>" maxlength="10" id="p_telcontact" placeholder="กรอกเบอร์โทรศัพท์ 10 หลักสำหรับติดต่อลูกค้า (0987654321)" <?php if(isset($detail)){echo "disabled";}?> >
            </div>
            <div class="form-group">
              <label for="p_linecontact" class="form-label">ไอดีไลน์ลูกค้า</label>
              <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_linecontact : '' ?>" id="p_linecontact" placeholder="กรอกไอดีไลน์สำหรับติดต่อลูกค้า (example0101)" <?php if(isset($detail)){echo "disabled";}?> >
            </div>
            <div class="form-group">
              <label for="p_emailcontact" class="form-label">อีเมลลูกค้า</label>
              <input type="email" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_emailcontact : '' ?>" id="p_emailcontact" placeholder="กรอกอีเมลสำหรับติดต่อลูกค้า (eaxmple@gmail.com)" <?php if(isset($detail)){echo "disabled";}?> >
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $("#p_name").keyup(function (event) {
    var name = document.getElementById("p_name");
    name.value = name.value;
  });
  $("#p_telcontact").keyup(function (event) {
    var tel = document.getElementById("p_telcontact");
    tel.value = tel.value.replace(/[^0-9]+/, '');
  });
  $("#p_linecontact").keyup(function (event) {
    var line = document.getElementById("p_linecontact");
    line.value = line.value.replace(/[^a-zA-Z0-9_.-]+/, '');
    line.value = line.value.toLowerCase();
  });
  $("#p_emailcontact").keyup(function (event) {
    var email = document.getElementById("p_emailcontact");
    email.value = email.value.toLowerCase();
  });
</script>