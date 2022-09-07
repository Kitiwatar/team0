<div class="row justify-content-md-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">เข้าสู่ระบบ</h4>
                <p id="alert" style="color: red;"></p>
                <form class="mt-4" id="loginform">
                    <div class="form-group">
                        <input type="email" id="u_email" name="u_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="อีเมล" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="u_password" name="u_password" class="form-control" id="exampleInputPassword1" placeholder="รหัสผ่าน" required>
                    </div>
                    <button type="submit" id="loginBtn" class="btn btn-primary text-white">เข้าสู่ระบบ</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#loginform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            method: "post",
            url: 'login/checkLogin',
            data: {
                u_email: $('#u_email').val(),
                u_password: $('#u_password').val()
            },
        }).done(function(returnData) {
            if (returnData.status == 0) {
                $('#alert').html('ไม่พบอีเมลนี้ในระบบ');
            } else if(returnData.status == 1) {
                location.replace("home")
            } else {
                $('#alert').html('รหัสผ่านไม่ถูกต้อง');
            }
        });
    });
</script>