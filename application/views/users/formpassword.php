<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="" id="pwdForm" autocomplete="off">
                <div class="card-body">
                <h4 class='card-title'> เปลี่ยนรหัสผ่าน</h4>
                <div class='card-subtitle'> เปลี่ยนรหัสผ่านในการเข้าสู่ระบบ</div>

                <div class="form-group">
                        <label for="pwd" class="form-label">โปรดกรอกรหัสผ่านบัจุบัน</label>
                        <input type="password" class="form-control" name="inputValue[]" id="pwd" placeholder="รหัสผ่าน">
                    </div>

                    <div class="form-group">
                        <label for="pwd" class="form-label">โปรดกรอกรหัสผ่านใหม่</label>
                        <input type="password" class="form-control" name="inputValue[]" id="pwd" placeholder="รหัสผ่าน">
                    </div>
                    <div class="form-group">
                        <label for="cfPwd" class="form-label">โปรดกรอกรหัสผ่านใหม่อีกครั่ง</label>
                        <input type="password" class="form-control" name="inputValue[]" id="cfPwd" placeholder="ยืนยันรหัสผ่าน">
                    </div>
                    <div class="modal-footer" id="mainModalFooter">
                    <i id="fMsgIcon"></i><span id="fMsg"></span>
                    <button type="button" class="btn btn-success" onclick="saveFormSubmit('#checkBoxPwd');">บันทึก</button>
                    <button type="button" class="btn btn-primary" onclick="saveFormSubmit('new');">ยกเลิก</button>
                </div>
                        
        
                </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#checkBoxPwd').click(function() {
            if($(this).is(':checked')) {
                $('#pwd').attr('type', 'text');
                $('#cfPwd').attr('type', 'text');
            } else {
                $('#pwd').attr('type', 'password');
                $('#cfPwd').attr('type', 'password');
            }
        });
    });
</script>