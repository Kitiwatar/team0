<style>
    .rectangle {
        width: 80px;
        height: 100%;
        border-width: 40px;
        border-color: #05ABF5 #05ABF5 white #05ABF5;
        border-style: solid;
        background-color: #05ABF5;
    }
    .bgLogin {
        /* height: 100%; */
        background-color: #03A9F3;
        /* For browsers that do not support gradients */
        background-image: linear-gradient(to right, #03A9F3, #87CEEB);
    }
</style>
<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-9">
            <div class="card" style="border-radius: 25px;">
                <div class="row g-0">
                    <div class="col-md-6 col-lg-6 d-none d-md-block text-center bgLogin" style="border-top-left-radius: 25px; border-bottom-left-radius: 25px;">
                        <!-- <div class="row">
                            <div class="col-2">
                                <div class="rectangle mx-4"></div>
                            </div>
                            <div class="col">
                                <div style="margin-top: 150px; margin-bottom: 100px; font-size: 100px;">PMS</div>
                            </div>
                        </div> -->
                        <div class="text-start text-secondary fw-bold m-5">
                            <div style="font-size: 60px;">Project</div>
                            <!-- <div style="height: 5px; width: 100%; background-color:white;"></div> -->
                            <div style="font-size: 60px;">Monitoring</div>
                            <!-- <div style="height: 5px; width: 100%; background-color:white;"></div> -->
                            <div style="font-size: 60px;">System</div>
                            <!-- <div style="height: 5px; width: 100%; background-color:white;"></div> -->
                            <!-- <img src="http://www.ivsoft.co.th/img/team/seksan2.jpg" alt="user"> -->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 d-flex align-items-center" style="border-top-right-radius: 25px; border-bottom-right-radius: 25px;">
                        <div class="card-body p-4 p-lg-5 text-black">
                            <!-- <h2 class="text-center fw-bold text-info">Project Monitoring System</h2> -->
                            <div class="text-center">
                                <img src="https://icons-for-free.com/iconfiles/ico/256/avatar+human+male+man+men+people+person+profile+user+users-1320196163635839021.ico" height="200px" alt="user" class="rounded-circle">
                                <!-- <img src="http://www.ivsoft.co.th/img/team/seksan2.jpg" alt="user" class="rounded-circle" height="200px" width="200px"> -->
                            </div>
                            <p id="alert" class="text-center text-danger mt-5"></p>
                            <form id="loginForm">
                                <div class="form-group">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text mdi mdi-account fs-4"></span>
                                        <input type="text" class="form-control fs-4" placeholder="อีเมล" id="u_email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text mdi mdi-key-variant fs-4"></span>
                                        <input type="password" class="form-control fs-4" placeholder="รหัสผ่าน" id="u_password">
                                        <div class="input-group-text toggle-password" style="cursor: pointer;">
                                            <span class="mdi mdi-eye-outline-off fs-4"></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="loginBtn" style="width: 100%;" class="btn btn-info btn-lg btn-block fs-3">เข้าสู่ระบบ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.toggle-password').click(function() {
        $(this).children().toggleClass('mdi-eye-outline mdi-eye-outline-off');
        let input = $(this).prev();
        input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
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