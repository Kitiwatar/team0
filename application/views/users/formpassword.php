<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="" id="pwdForm" autocomplete="off">
                <div class="card-body">
                    <div class="form-group">
                        <label for="pwd" class="form-label">รหัสผ่าน</label>
                        <input type="password" class="form-control" name="inputValue[]" id="pwd" placeholder="รหัสผ่าน">
                    </div>
                    <div class="form-group">
                        <label for="cfPwd" class="form-label">ยืนยันรหัสผ่าน</label>
                        <input type="password" class="form-control" name="inputValue[]" id="cfPwd" placeholder="ยืนยันรหัสผ่าน">
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkBoxPwd">
                        <label class="form-check-label" for="checkBoxPwd"> แสดงรหัสผ่าน</label>
                    </div>
                </div>
            </form>
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