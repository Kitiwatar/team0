
    <div class="card-body text-black">
        <p id="alert" class="text-center text-danger mt-5"></p>
        <form id="loginForm">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span class="input-group-text mdi mdi-account fs-4"></span>
                    <input type="text" class="form-control fs-4" placeholder="<?= lang('p_login_email') ?>" id="u_email">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <span class="input-group-text mdi mdi-key-variant fs-4"></span>
                    <input type="password" class="form-control fs-4" placeholder="<?= lang('p_login_password') ?>" id="u_password">
                    <div class="input-group-text toggle-password" style="cursor: pointer;">
                        <span class="mdi mdi-eye-outline-off fs-4"></span>
                    </div>
                </div>
            </div>
            <button type="submit" id="loginBtn" style="width: 100%;" class="btn btn-info btn-lg btn-block fs-3"><?= lang('b_login') ?></button>
        </form>
    </div>
    <script>
        $('.toggle-password').click(function() {
            $(this).children().toggleClass('mdi-eye-outline mdi-eye-outline-off');
            let input = $(this).prev();
            input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
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