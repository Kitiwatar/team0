<!-- Create by: Patiphan Pansanga 14-10-2565 -->
<style>
  input[type="time"] {
    position: relative;
}

input[type="time"]::-webkit-calendar-picker-indicator {
    display: none;
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" rel="stylesheet">
<?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="projectsForm" autocomplete="off">
        <div class="card-body">
          <input type="hidden" id="t_p_id" value="<?= isset($getData) ? $getData->t_p_id : $p_id ?>">
          <div class="form-group">
            <label for="p_detail" class="form-label"><?= lang('md_at-tl') ?><?= isset($detail) ? '' : $required ?></label>
            <select class="form-select" name="inputValue[]" id="t_tl_id" <?= isset($detail) ? "disabled" : '' ?>>
              <option selected disabled value=""><?= lang('md_at_ph-t') ?></option>
              <?php foreach ($tasks as $key => $value) { ?>
                <?php if (isset($getData)) {
                  if ($getData->t_tl_id == $value->tl_id) { ?>
                    <option value="<?= $value->tl_id ?>" selected><?= $value->tl_name ?></option>;
                <?php continue;
                  }
                } ?>
                <option value="<?= $value->tl_id ?>"><?= $value->tl_name ?></option>';
              <?php } ?>
            </select>
            <font id="nameMsg" class="small text-danger"></font>
          </div>
          <div class="form-group">
            <label for="p_detail" class="form-label"><?= lang('md_at-dtl') ?><?= isset($detail) ? '' : $required ?></label>
            <textarea class="form-control" name="inputValue[]" rows="3" id="t_detail" <?= isset($detail) ? "disabled" : '' ?> placeholder="<?= lang('md_at_ph-dtl') ?>"><?= isset($getData) ? $getData->t_detail : '' ?></textarea>
            <font id="detailMsg" class="small text-danger"></font>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="p_createdate" class="form-label"><?= lang('md_at-imd') ?><?= isset($detail) ? '' : $required ?></label>
                <div class="input-group date" data-provide="datepicker" data-date-format="dd-mm-yyyy">
                  <?php if (isset($getData)) : $newDate = date("d-m-Y", strtotime($getData->t_createdate));
                  endif; ?>
                  <input type="text" class="form-control" id="t_createdate" name="inputValue[]" value="<?= isset($getData) ? $newDate : '' ?>" <?= isset($detail) ? "disabled" : '' ?> placeholder="<?= lang('md_at_ph-ps') ?> (<?= date("d-m-Y") ?>)" maxlength="10" minlength="10" autocomplete="off" required>
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </div>
                  <span class="input-group-text fs-5" onclick="pickDate()" style="cursor: pointer;"><i class="mdi mdi-calendar-range"></i></span>
                </div>
                <font id="createdateMsg" class="small text-danger"></font>
              </div>
            </div>
            <div class="col-6">
            <div class="form-group">
            <label class="form-label"><?= lang('md_at-time') ?><?= isset($detail) ? '' : $required ?></label>
                <div class="input-group">
                <input type="time" step="300" class="form-control" id="t_createtime" name="inputValue[]" value="<?= isset($getData) ? substr($getData->t_createdate,11) : '' ?>" <?= isset($detail) ? "disabled" : '' ?>>
                  <span class="input-group-text fs-5" onclick="pickTime()" style="cursor: pointer;"><i class="mdi mdi-clock"></i></span>
                </div>
                <font id="createtimeMsg" class="small text-danger"></font>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label"><?= lang('md_at-ad') ?></label>
            <input type="text" class="form-control" value="<?= isset($getData) ? $getData->u_firstname . " " . $getData->u_lastname : $_SESSION['u_fullname'] ?>" disabled>
          </div>
        </div>
      </form>
      <div class="mx-4">
        <h4><span class="m-2"><?= lang('md_at-dc') ?></span><i class="mdi mdi-information-outline" style="color:#C5C5C5;" title="สามารถเพิ่มไฟล์ได้ตามนี้ (รูปภาพ ,excel ,pdf ,text ,word ,powerpoint) และขนาดไฟล์ต้องไม่เกิน 5 MB"></i></h4>
        <div class="col-md-6 <?= isset($detail) ? "d-none" : '' ?>">
          <button type="button" class="btn btn-success" id="uploadBtn"><i class="mdi mdi-plus-circle-outline"></i> <?= lang('md_at_bt-dc') ?></button>
          <input type="file" name="files" id="files" class="d-none" accept=".doc,.docx,application/msword, .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/vnd.ms-powerpoint, 
          application/vnd.openxmlformats-officedocument.presentationml.slideshow, application/vnd.openxmlformats-officedocument.presentationml.presentation , text/plain, application/pdf, image/*" multiple />
        </div>
        <div style="clear:both"></div>
        <div class="table-responsive my-2">
          <table class="display table table-bordered dt-responsive nowrap">
            <thead>
              <tr>
                <th><?= lang('md_at_dc-name') ?></th>
                <th><?= lang('md_at_dc-updt') ?></th>
                <th class="text-center"><?= lang('md_at_ab') ?></th>
              </tr>
            </thead>
            <tbody id="uploaded">
              <?php if (isset($getFiles)) {
                if (is_array($getFiles)) { ?>
                  <div id="listRemove" class="d-none"></div>
                  <?php for ($i = 0; $i < count($getFiles); $i++) { ?>
                    <tr id="<?= $getFiles[$i]->f_name ?>">
                      <td class="d-none"><input type="checkbox" name="fileAdd" value="<?= $getFiles[$i]->f_name ?>" checked></td>
                      <td onclick="openInNewTab('<?= base_url() . 'upload/' . $getFiles[$i]->f_name ?>')" class="name" style="cursor:pointer;"><u><?= substr($getFiles[$i]->f_name, 18) ?></u></td>
                      <td><?= thaiDate($getFiles[$i]->f_createdate) ?></td>
                      <td class="text-center">
                        <a class="btn btn-sm btn-info" title="ดาวน์โหลดไฟล์" href="<?= base_url() . 'upload/' . $getFiles[$i]->f_name ?>" target="_blank" download="<?= substr($getFiles[$i]->f_name, 18) ?>"><i class="mdi mdi-download"></i></a>
                        <button type="button" class="btn btn-sm btn-danger <?= isset($detail) ? "d-none" : '' ?>" title="ลบไฟล์" onclick="remove('<?= $getFiles[$i]->f_name ?>')"><i class="mdi mdi-delete"></i></button>
                      </td>
                    </tr>
              <?php }
                }
              } ?>
            </tbody>
          </table>
          <div id="loadingFile" class="text-center"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script>
  function pickDate() {
    let elm = document.getElementById("t_createdate")
    elm.focus();
  }
  function pickTime() {
    let elm = document.getElementById("t_createtime")
    elm.showPicker()
  }
  $('#uploadBtn').click(function(e) {
    e.preventDefault();
    $('#files').click();
  });

  $('#t_createdate').on('change', function() {
    $('.datepicker').hide();
  });

  $('#t_createtime').on('change', function() {
    if ($("#t_createtime").val() == "") {
      $('#t_createtime').removeClass("is-valid");
      $('#t_createtime').addClass("is-invalid");
    } else {
      $('#t_createtime').removeClass("is-invalid");
      $('#t_createtime').addClass("is-valid");
      $('#createtimeMsg').html('');
    }
  });

  $('#t_tl_id').on('change', function() {
    $('#nameMsg').hide();
  });

  $('#t_detail').on('input', function() {
    if ($("#t_detail").val() == "") {
      $('#t_detail').removeClass("is-valid");
      $('#t_detail').addClass("is-invalid");
    } else {
      $('#t_detail').removeClass("is-invalid");
      $('#t_detail').addClass("is-valid");
      $('#detailMsg').html('');
    }
  });

  function remove(name) {
    let listRemove = document.getElementById("listRemove");
    listRemove.innerHTML += `<input type="checkbox" name="fileRemove" value="` + name + `" checked>`
    document.getElementById(name).remove();
  }

  function openInNewTab(url) {
    window.open(url, '_blank').focus();
  }

  $('#files').change(function() {
    var files = $('#files')[0].files;
    var error = '';
    var form_data = new FormData();
    for (var count = 0; count < files.length; count++) {
      var name = files[count].name;
      var extension = name.split('.').pop().toLowerCase();
      form_data.append("files[]", files[count]);
    }
    if (error == '') {
      $.ajax({
        url: "tasks/uploadFiles",
        method: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
          document.getElementById("loadingFile").innerHTML = '<div class="spinner-border text-info" role="status"><span class="sr-only">Loading...</span></div>';
        },
        success: function(data) {
          document.getElementById("loadingFile").innerHTML = "";
          var text = document.getElementById("uploaded").innerHTML;
          text += data.output;
          document.getElementById("uploaded").innerHTML = text
          $('#files').val('');
        }
      })
    } else {
      alert(error);
    }
  });

  $("#t_createdate").on('change', function() {
    this.value = this.value.replace(/[^0-9]-/g, '');
    if ($("#t_createdate").val() == "" || $("#t_createdate").val().length < 10) {
      $('#t_createdate').removeClass("is-valid");
      $('#t_createdate').addClass("is-invalid");
    } else {
      $('#t_createdate').removeClass("is-invalid");
      $('#t_createdate').addClass("is-valid");
      $('#createdateMsg').html('');
    }
  });
</script>