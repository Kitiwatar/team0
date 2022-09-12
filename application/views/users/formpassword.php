<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="" id="pwdForm" autocomplete="off">
                <div class="card-body">
                    <?php if (isset($personPassword)) { ?>
                        <h4 class='card-title'> เปลี่ยนรหัสผ่าน</h4>
                        <div class='card-subtitle'> เปลี่ยนรหัสผ่านในการเข้าสู่ระบบ</div>

                        <div class="form-group">
                            <label for="pwd" class="form-label">โปรดกรอกรหัสผ่านบัจุบัน</label>
                            <input type="password" class="form-control" name="inputValue[]" id="curPwd" placeholder="รหัสผ่านปัจจุบัน">
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="pwd" class="form-label">โปรดกรอกรหัสผ่านใหม่</label>
                        <input type="password" class="form-control" name="inputValue[]" id="pwd" placeholder="รหัสผ่าน">
                    </div>
                    <div class="form-group">
                        <label for="cfPwd" class="form-label">โปรดกรอกรหัสผ่านใหม่อีกครั่ง</label>
                        <input type="password" class="form-control" name="inputValue[]" id="cfPwd" placeholder="ยืนยันรหัสผ่าน">
                    </div>
                    <?php if (isset($personPassword)) { ?>
                        <div align="right">
                            <i id="fMsgIcon"></i><span id="fMsg"></span>
                            <button  id="save" type="button" class="btn btn-success" onclick="submitPersonPassword()" >บันทึก</button>
                            <button type="button" class="btn btn-primary">ยกเลิก</button>
                        </div>

                    <?php } ?>


                </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#checkBoxPwd').click(function() {
            if ($(this).is(':checked')) {
                $('#pwd').attr('type', 'text');
                $('#cfPwd').attr('type', 'text');
            } else {
                $('#pwd').attr('type', 'password');
                $('#cfPwd').attr('type', 'password');
            }
        });
    });

    function submitPersonPassword() {
    // $('#fMsg').addClass('text-warning');
    // $('#fMsg').text('กำลังดำเนินการ ...');
    var formData = {};
    $('[name^="inputValue"]').each(function() {
      formData[this.id] = this.value;
    });
    if (!formData.pwd || !formData.cfPwd) {
      $('#errMsg').addClass('text-danger');
      $('#errMsg').text('กรุณาระบุข้อมูลให้ครบถ้วน');
      !formData.pwd ? $('#cfPwd').focus() : '';
      !formData.cfPwd ? $('#pwd').focus() : '';
      return false;
    } else if (formData.pwd != formData.cfPwd) {
      $('#errMsg').addClass('text-danger');
      $('#errMsg').text('รหัสผ่านไม่ตรงกัน');
      return false;
    }
    swal({
      title: "ยืนยันการเปลี่ยนรหัสผ่าน",
      text: "คุณต้องการเปลี่ยนรหัสผ่านใช่หรือไม่",
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ยกเลิก",
    }).then(function(isConfirm) {
      if (isConfirm.value) {
        $.ajax({
          method: "post",
          url: 'updatePassword',
          data: formData
        }).done(function(returnData) {
          if (returnData.status == 1) {
            swal({
              title: "สำเร็จ",
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            });
            $('#pwdForm')[0].reset();
            $('#mainModal').modal('hide');
          } else {
            swal({
              title: "ล้มเหลว",
              text: returnData.msg,
              type: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 2000,
            });
            $('#pwdForm')[0].reset();
            $('#mainModal').modal('hide');
          }
        });
      }
    });
  }
</script>