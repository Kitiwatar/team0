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
          <input type="hidden" id="t_p_id" value="<?= isset($getData) ? $getData->t_p_id : $p_id ?>">
          <div class="form-group">
            <label for="p_detail" class="form-label">กิจกรรมโครงการ<?= isset($detail) ? '' : $required ?></label>
            <select class="form-select" name="inputValue[]" id="t_tl_id" <?= isset($detail) ? "disabled" : '' ?>>
              <option selected disabled value="">เลือกกิจกรรม</option>
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
            <label for="p_detail" class="form-label">รายละเอียดกิจกรรม<?= isset($detail) ? '' : $required ?></label>
            <textarea class="form-control" name="inputValue[]" rows="3" id="t_detail" <?= isset($detail) ? "disabled" : '' ?> placeholder="กรอกรายละเอียดของกิจกรรม (เสนอราคา...)"><?= isset($getData) ? $getData->t_detail : '' ?></textarea>
            <font id="detailMsg" class="small text-danger"></font>
          </div>
          <div class="form-group">
            <label for="p_createdate" class="form-label">วันดำเนินการ<?= isset($detail) ? '' : $required ?></label>
            <div class="input-group mb-3">
              <input type="date" style="cursor: pointer;" onfocus="this.showPicker()" class="form-control" name="inputValue[]" <?= isset($detail) ? "disabled" : '' ?> value="<?= isset($getData) ? $getData->t_createdate : '' ?>" id="t_createdate">
              <span class="input-group-text fs-5" id="basic-addon1"><i class="mdi mdi-calendar-range"></i></span>
            </div>
            <font id="createdateMsg" class="small text-danger"></font>
          </div>
          <div class="form-group">
            <label class="form-label">ผู้เพิ่มกิจกรรม</label>
            <input type="text" class="form-control" value="<?= isset($getData) ? $getData->u_firstname . " " . $getData->u_lastname : $_SESSION['u_fullname'] ?>" disabled>
          </div>
        </div>
      </form>
      <div class="mx-4">
        <h4>เอกสารที่เกี่ยวข้อง</h4>
        <div class="col-md-6 <?= isset($detail) ? "d-none" : '' ?>">
          <button type="button" class="btn btn-success" id="uploadBtn"><i class="mdi mdi-plus-circle-outline"></i> เพิ่มเอกสารที่เกี่ยวข้อง</button>
          <input type="file" name="files" id="files" class="d-none" accept="" multiple />
        </div>
        <div style="clear:both"></div>
        <div class="table-responsive my-2">
          <table class="display table table-striped table-bordered dt-responsive nowrap">
            <thead>
              <tr>
                <th>ชื่อของเอกสาร</th>
                <th>วันที่อัปโหลด</th>
                <th class="text-center <?= isset($detail) ? "d-none" : '' ?>">ปุ่มดำเนินการ</th>
              </tr>
            </thead>
            <tbody id="uploaded">
              <?php if (isset($getFiles)) {
                if (is_array($getFiles)) {
                  for ($i = 0; $i < count($getFiles); $i++) { ?>
                    <tr id="<?= $getFiles[$i]->f_name ?>">
                      <td class="d-none"><input type="checkbox" name="fileNames" value="<?= $getFiles[$i]->f_name ?>" checked></td>
                      <td onclick="openInNewTab('<?= base_url() . 'upload/' . $getFiles[$i]->f_name ?>')" class="name" style="cursor:pointer;"><u><?= substr($getFiles[$i]->f_name, 15) ?></u></td>
                      <td><?= thaiDate($getFiles[$i]->f_createdate) ?></td>
                      <td class="text-center <?= isset($detail) ? "d-none" : '' ?>"><button type="button" class="btn btn-danger" title="ลบไฟล์" onclick="remove('<?= $getFiles[$i]->f_name ?>')"><i class="mdi mdi-delete"></i></button></td>
                    </tr>
              <?php }
                }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('#uploadBtn').click(function(e) {
    e.preventDefault();
    $('#files').click();
  });

  function remove(name) {
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
      //  if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1) {
      //   error += "Invalid " + count + " Image File"
      //  }
      //  else {
      form_data.append("files[]", files[count]);
      //  }
    }
    if (error == '') {
      $.ajax({
        url: "<?php echo base_url(); ?>tasks/uploadFiles", //base_url() return http://localhost/tutorial/codeigniter/
        method: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
          //  $('#uploaded_images').html("<label class='text-success'>Uploading...</label>");
        },
        success: function(data) {
          var text = document.getElementById("uploaded").innerHTML;
          text += data.output;
          document.getElementById("uploaded").innerHTML = text
          //  $('#uploaded_images').html(data);
          $('#files').val('');
        }
      })
    } else {
      alert(error);
    }
  });
  $("#p_name").keydown(function(event) {
    var name = document.getElementById("p_name");
    name.value = name.value;
  });
  $("#p_linecontact").keydown(function(event) {
    var line = document.getElementById("p_linecontact");
    line.value = line.value.toLowerCase();
  });
  $("#p_emailcontact").keydown(function(event) {
    var email = document.getElementById("p_emailcontact");
    email.value = email.value.toLowerCase();
  });
</script>