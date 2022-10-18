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
    display: none;
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
              <label for="p_detail" class="form-label">รายละเอียดโครงการ<?php if(!isset($detail)) { echo $required; } ?></label>
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
              <div class="input-group mb-3" onclick="pickDate()">
              <input type="date" onfocus="this.showPicker()" style="cursor: pointer;" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_createdate : '' ?>" id="p_createdate" <?php if(isset($detail)){echo "disabled";}?> >
                <span class="input-group-text fs-5" style="cursor: pointer;"><i class="mdi mdi-calendar-range"></i></span>               
              </div>
              <font id="createdateMsg" class="small text-danger"></font>
            </div>
            <label class="form-label">ช่องทางติดต่อลูกค้า</label>
            <table width="100%">
              <tr>
                <td width="80px" class="ps-3"><label for="p_telcontact" class="form-label">เบอร์โทร:</label></td>
                <td>
                  <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_telcontact : '' ?>" maxlength="10" id="p_telcontact" placeholder="กรอกเบอร์โทรศัพท์ 10 หลักสำหรับติดต่อลูกค้า (0987654321)" <?php if(isset($detail)){echo "disabled";}?> >
                </td>
              </tr>
              <tr><td class="py-2"></td><td><font id="telMsg" class="small text-danger"></font></td></tr>
              <tr>
                <td class="ps-3"><label for="p_linecontact" class="form-label">ไลน์:</label></td>
                <td>
                  <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_linecontact : '' ?>" id="p_linecontact" placeholder="กรอกไอดีไลน์สำหรับติดต่อลูกค้า (example0101)" <?php if(isset($detail)){echo "disabled";}?> >                 
                </td>
              </tr>
              <tr><td class="py-2"></td><td><font id="lineMsg" class="small text-danger"></font></td></tr>
              <tr>
                <td class="ps-3"><label for="p_emailcontact" class="form-label">อีเมล:</label></td>
                <td>
                  <input type="email" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->p_emailcontact : '' ?>" id="p_emailcontact" placeholder="กรอกอีเมลสำหรับติดต่อลูกค้า (eaxmple@gmail.com)" <?php if(isset($detail)){echo "disabled";}?> >
                </td>
              </tr>
              <tr><td class="py-2"></td><td><font id="emailMsg" class="small text-danger"></font></td></tr>
              <tr>
                <td class="align-top ps-3"><label for="p_othercontact" class="form-label">เพิ่มเติม:</label></td>
                <td><textarea class="form-control" name="inputValue[]" rows="3" id="p_othercontact" placeholder="กรอกข้อมูลสำหรับติดต่อลูกค้าเพิ่มเติม" <?php if(isset($detail)){echo "disabled";}?>><?= isset($getData) ? $getData->p_othercontact : '' ?></textarea></td>
              </tr>
            </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  function pickDate() {
    let date = document.getElementById("p_createdate")
    date.showPicker()
  }
  $('#p_telcontact').on('input', function() {
    if(this.value.match(/[^0-9]/)) {
      $('#telMsg').text(' สามารถกรอกได้เพียงตัวเลข 0-9 เท่านั้น');
    } else {
      $('#telMsg').text(' ');
    }
    this.value = this.value.replace(/[^0-9]/g, '');
  });

  $('#p_linecontact').on('input', function() {
    if(this.value.match(/[^a-zA-Z0-9._-]/)) {
      $('#lineMsg').text(' สามารถกรอกได้เพียง a-z, 0-9 และ - . _ เท่านั้น');
    } else {
      $('#lineMsg').text(' ');
    }
    this.value = this.value.toLowerCase();
    this.value = this.value.replace(/[^a-zA-Z0-9._-]/g, '');
  });

  $("#p_emailcontact").on('input', function() {
    if(this.value.match(/[^a-zA-Z0-9.@_-]/)) {
      $('#emailMsg').text(' สามารถกรอกได้เพียง a-z, 0-9 และ - . _ @ เท่านั้น');
    } else {
      $('#emailMsg').text(' ');
    }
    this.value = this.value.toLowerCase();
    this.value = this.value.replace(/[^a-zA-Z0-9.@_-]/g, '');
  });
</script>