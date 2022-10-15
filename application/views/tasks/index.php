<!-- Create by: Patiphan Pansanga 14-10-2565 -->
<div id="listDiv"></div>
<script>
  loadList(<?= $p_id ?>);

  function loadList(p_id = <?= $p_id ?>) {
    $.ajax({
      url: "<?php echo base_url(); ?>tasks/get",
      method: 'post',
      data: {
        p_id: p_id
      }
    }).done(function(returnData) {
      $('#listDiv').html(returnData.html)
    })
  }

  function updatePermission(u_id, p_id) {
    swal({
      title: "ยืนยันการลบพนักงานในโครงการ",
      text: "คุณต้องการลบพนักงานในโครงการใช่หรือไม่",
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ยกเลิก",
    }).then(function(isConfirm) {
      if (isConfirm.value) {
        $.ajax({
          method: "post",
          url: '<?= base_url() ?>permissions/remove',
          data: {
            u_id: u_id,
            p_id: p_id
          }
        }).done(function(returnData) {
          loadList();
          if (returnData.status == 1) {
            swal({
              title: "สำเร็จ",
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
          } else {
            swal({
              title: "ล้มเหลว",
              text: returnData.msg,
              type: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
          }
        });
      }
    })
  }


  function saveFormSubmit(t_id) {
    // $('#fMsg').addClass('text-warning');
    // $('#fMsg').text('กำลังดำเนินการ ...');
    var formData = {};
    formData['t_id'] = t_id;
    formData['t_detail'] = $('#t_detail').val()
    formData['t_createdate'] = $('#t_createdate').val()
    formData['t_tl_id'] = $('#t_tl_id').val()
    formData['t_p_id'] = $('#t_p_id').val()
    // $('[name^="inputValue"]').each(function() {
    //   formData[this.id] = this.value;
    //   console.log(formData['p_name'])
    // });
    let fileNames = []
    let checkBoxNames = document.getElementsByName('fileNames');
    for (var checkbox of checkBoxNames) {
      if (checkbox.checked)
        fileNames.push(checkbox.value)
    }

    console.log(formData);
    var count = 0;
    if (!formData.t_createdate) {
      $('#createdateMsg').text(' กรุณาเลือกวันที่ดำเนินการ');
      // $('#p_createdate').focus();
      count++
    } else {
      $('#createdateMsg').text(' ');
    }
    if (!formData.t_detail) {
      $('#detailMsg').text(' กรุณากรอกรายระเอียดกิจกรรม');
      $('#t_detail').focus();
      count++
    } else {
      $('#detailMsg').text(' ');
    }
    if (!formData.t_tl_id) {
      $('#nameMsg').text(' กรุณาเลือกกิจกรรม');
      $('#t_tl_id').focus();
      count++
    } else {
      $('#nameMsg').text(' ');
    }
    if (count > 0) {
      return false;
    }

    var mainMsg;
    var detailMsg;
    if (t_id == "new") {
      mainMsg = "ยืนยันการเพิ่มกิจกรรม";
      detailMsg = "คุณต้องการเพิ่มกิจกรรมในระบบใช่หรือไม่";
    } else {
      mainMsg = "ยืนยันการแก้ไขกิจกรรม";
      detailMsg = "คุณต้องการแก้ไขกิจกรรมในระบบใช่หรือไม่";
    }
    swal({
      title: mainMsg,
      text: detailMsg,
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ยกเลิก",
    }).then(function(isConfirm) {
      if (isConfirm.value) {
        $.ajax({
          method: "post",
          url: '<?= base_url() ?>tasks/add',
          data: {
            formData: formData,
            fileNames: fileNames
          }
        }).done(function(returnData) {
          loadList();
          if (returnData.status == 1) {
            swal({
              title: "สำเร็จ",
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
            // $('#projectsForm')[0].reset();
            $('#mainModalTitle').html("");
            $('#mainModalBody').html("");
            $('#mainModalFooter').html("");
            $('#mainModal').modal('hide');
          } else {
            swal({
              title: "ล้มเหลว",
              text: returnData.msg,
              type: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
            // $('#projectsForm')[0].reset();
            $('#mainModalTitle').html("");
            $('#mainModalBody').html("");
            $('#mainModalFooter').html("");
            $('#mainModal').modal('hide');
          }
        });
      }
    });
  }

  function view(t_id) {
    $.ajax({
      method: "post",
      url: '<?= base_url() ?>tasks/getDetailForm',
      data: {
        t_id: t_id
      }
    }).done(function(returnData) {
      $('#detailModalTitle').html(returnData.title);
      $('#detailModalBody').html(returnData.body);
      $('#detailModalFooter').html(returnData.footer);
      $('#detailModal').modal();
    });
  }

  function edit(t_id) {
    $('#detailModal').modal('hide');
    $.ajax({
      method: "post",
      url: '<?= base_url() ?>tasks/getEditForm',
      data: {
        t_id: t_id
      }
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  }

  function deleteFile(name) {
    $.ajax({
      method: "post",
      url: '<?php echo base_url(); ?>tasks/deleteFile',
      data: {
        fileName: name
      }
    }).done(function(returnData) {
      document.getElementById(name).remove();
    });
  }

  function closeModalTask(action) {
    swal({
      title: "ยกเลิกการ" + action,
      text: "คุณต้องการยกเลิกการ" + action + "ใช่หรือไม่",
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ยกเลิก",
    }).then(function(isConfirm) {
      // $('#usersForm')[0].reset();
      if (isConfirm.value) {
        let tmpFiles = document.getElementsByClassName("tmpFiles");
        for (var checkbox of tmpFiles) {
          deleteFile(checkbox.value)
        }
        $('#mainModalTitle').html("");
        $('#mainModalBody').html("");
        $('#mainModalFooter').html("");
        $('#mainModal').modal('hide');
      }
    })

  }

  function changeStatus(t_id, t_status, p_id) {
    var mainMsg;
    var detailMsg;
    if (t_status == 1) {
      mainMsg = "ยืนยันการลบกิจกรรม";
      detailMsg = "คุณต้องการลบกิจกรรมใช่หรือไม่";
    } else {
      mainMsg = "ยืนยันการกู้คืนกิจกรรม";
      detailMsg = "คุณต้องการกู้คืนกิจกรรมใช่หรือไม่";
    }
    swal({
      title: mainMsg,
      text: detailMsg,
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: "ยืนยัน",
      cancelButtonColor: "#E4E4E4",
      cancelButtonText: "<font style='color:black'>" + "ยกเลิก" + "</font>",
    }).then(function(isConfirm) {
      if (isConfirm.value) {
        $.ajax({
          method: "POST",
          url: '<?= base_url() ?>tasks/updateStatus',
          data: {
            t_id: t_id,
            p_id: p_id
          }
        }).done(function(returnData) {
          loadList();
          if (returnData.status == 1) {
            swal({
              title: "สำเร็จ",
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
          } else {
            swal({
              title: "ล้มเหลว",
              text: returnData.msg,
              type: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
          }
        })
      }
    })

  }
</script>