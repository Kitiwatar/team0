<!-- Create by: Natakorn Phongsarikit, Patiphan Pansanga 07-09-2565-->
<?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="" id="pwdForm" autocomplete="off">
                <div class="card-body">
                    <?php if (isset($personPassword)) { ?>
                        <div class="form-group">
                            <label for="curPwd" class="form-label"><?= lang('md_cp_ph-psc') ?><?= isset($detail) ? '' : $required ?></label>
                            <input type="password" class="form-control" name="inputValue[]" id="curPwd" onblur="checkCurrentPassword()" placeholder="<?= lang('md_cp_psc') ?>">
                            <font id="curPwdMsg" class="small text-danger"></font>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="pwd" class="form-label"><?= lang('md_cp_ph-psn') ?><?= isset($detail) ? '' : $required ?></label>
                        <input type="password" class="form-control" name="inputValue[]" id="pwd" placeholder="<?= lang('md_cp_psn') ?>">
                        <!-- <font id="pwdMsg" class="small text-danger"></font> -->
                    </div>
                    <div class="form-group">
                        <label for="cfPwd" class="form-label"><?= lang('md_cp_ph-psng') ?><?= isset($detail) ? '' : $required ?></label>
                        <input type="password" class="form-control" name="inputValue[]" id="cfPwd" onblur="checkConfirmPassword()" placeholder="<?= lang('md_cp_psng') ?>">
                        <font id="cfPwdMsg" class="small text-danger"></font>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkBoxPwd">
                        <label class="form-check-label" for="checkBoxPwd"><?= lang('md_cp-cb') ?></label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function checkCurrentPassword() {
        $.ajax({
            method: "post",
            url: hostname + 'Users/checkCurrentPassword',
            data: {
                pwd: $('#curPwd').val()
            }
        }).done(function(returnData) {
            if (returnData.result == 0) {
                $('#curPwdMsg').text('<?= lang('md_cp_rqf-curp') ?>');
            } else {
                $('#curPwdMsg').text(' ');
            }
        })
    }

    function checkConfirmPassword() {
        if ($('#pwd').val() != $('#cfPwd').val()) {
            // $('#pwdMsg').text('<?= lang('md_cp_rqf-npnm') ?>');
            $('#cfPwdMsg').text('<?= lang('md_cp_rqf-npnm') ?>');
        } else {
            $('#pwdMsg').text(' ');
            $('#cfPwdMsg').text(' ');
        }
    }

    $(document).ready(function() {
        $('#checkBoxPwd').click(function() {
            if ($(this).is(':checked')) {
                $('#curPwd').attr('type', 'text');
                $('#pwd').attr('type', 'text');
                $('#cfPwd').attr('type', 'text');
            } else {
                $('#curPwd').attr('type', 'password');
                $('#pwd').attr('type', 'password');
                $('#cfPwd').attr('type', 'password');
            }
        });
    });

    function submitPersonPassword() {
        // $('#fMsg').addClass('text-warning');
        // $('#fMsg').text('กำลังดำเนินการ ...');
        var formData = {};
        var result = null;
        $('[name^="inputValue"]').each(function() {
            formData[this.id] = this.value;
        });
        $.ajax({
            method: "post",
            url: hostname + 'Users/checkCurrentPassword',
            data: {
                pwd: $('#curPwd').val()
            }
        }).done(function(returnData) {
            result = returnData.result;
        })

        if (!formData.pwd || !formData.cfPwd) {
            $('#errMsg').addClass('text-danger');
            $('#errMsg').text('<?= lang('md_cp_rqf') ?>');
            !formData.pwd ? $('#cfPwd').focus() : '';
            !formData.cfPwd ? $('#pwd').focus() : '';
            !formData.pwd ? $('#curPwd').focus() : '';
            return false;
        } else if (result == 0) {
            $('#errMsg').addClass('text-danger');
            $('#errMsg').text('<?= lang('md_cp_rqf-curp') ?>');
            !formData.pwd ? $('#curPwd').focus() : '';
            return false;
        } else if (formData.pwd != formData.cfPwd) {
            $('#errMsg').addClass('text-danger');
            $('#errMsg').text('<?= lang('md_cp_rqf-cpns') ?>');
            return false;
        }


        $.ajax({
            method: "post",
            url: 'Users/updatePassword',
            data: formData
        }).done(function(returnData) {
            if (returnData.status == 1) {
                swal({
                    title: "<?= lang('md_vm-suc') ?>",
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
                    title: "<?= lang('md_vm-fail') ?>",
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
</script>