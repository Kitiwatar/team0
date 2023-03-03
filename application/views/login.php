<div class="form-group ">
</div>
<div class="card-body text-black">
    <form id="loginForm">
        <div class="row" style="margin-top: -20px;">
            <div class="col-10 p-0">
                <div class="card p-0 rounded" style="background-color: #03a9f3; text-align: center; height: 80%;">
                    <div class="card-body collapse show p-0">
                        <img src="<?= base_url() ?>assets/images/pms-logo-full.png" height="85" class="light-logo" alt="homepage" />
                    </div>
                </div>
            </div>
            <div class="col ps-2 pe-0">
                <button type="button" class="btn btn-danger" style="height: 80%; width: 100%;" data-dismiss="modal" aria-hidden="true"><i class="mdi mdi-close fs-2"></i></button>
            </div>
        </div>
        <p id="alert" class="text-center text-danger"></p>
        <div class="form-group ">
            <p><?= lang('Email') ?></p>
            <div class="input-group input-group-lg">
                <input type="text" class="form-control fs-4" placeholder="<?= lang('p_login_email') ?>" id="u_email">
            </div>
        </div>
        <div class="form-group">
            <p><?= lang('Password') ?></p>
            <div class="input-group input-group-lg">
                <input type="password" class="form-control fs-4" placeholder="<?= lang('p_login_password') ?>" id="u_password">

            </div>
        </div>
        <div class="form-group">
            <input class="form-check-input" type="checkbox" id="checkBoxPwd">
            <label class="form-check-label" for="checkBoxPwd"><?= lang('md_cp-cb') ?></label>
        </div>
        <button type="submit" id="loginBtn" style="width: 100%;" class="btn btn-info btn-lg btn-block fs-3"><?= lang('b_login') ?></button>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#checkBoxPwd').click(function() {
            if ($(this).is(':checked')) {
                $('#u_password').attr('type', 'text');
            } else {
                $('#u_password').attr('type', 'password');

            }
        });
    });
    $("#u_email").keyup(function(event) {
        var email = document.getElementById("u_email");
        email.value = email.value.toLowerCase();
    });
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            method: "post",
            url: 'login/checkLogin',
            data: {
                u_email: $('#u_email').val(),
                u_password: $('#u_password').val(),
            },
        }).done(function(returnData) {
            if (returnData.status == 1) {
                location.replace("home");
            } else {
                $('#alert').html(returnData.msg);
            }
        });
    });
</script>