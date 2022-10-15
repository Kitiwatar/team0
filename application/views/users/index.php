<!-- Create by: Patiphan Pansanga, Jiradat Pomyai  07-09-2565-->
<div id="listDiv"></div>

<script>
  loadList();
  // new button on click and then show modal
  $('#addBtn').click(function(e) {
    e.preventDefault();
    $.ajax({
      method: "post",
      url: 'users/getAddForm'
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  });

  function loadList() {
    $.ajax({
      url: 'users/get',
      method: 'post'
    }).done(function(returnData) {
      $('#listDiv').html(returnData.html)
    })
  }

  function saveFormSubmit(u_id) {
    // $('#fMsg').addClass('text-warning');
    // $('#fMsg').text('กำลังดำเนินการ ...');
    var formData = {};
    formData['u_id'] = u_id;
    formData['u_firstname'] = $('#u_firstname').val()
    formData['u_lastname'] = $('#u_lastname').val()
    formData['u_email'] = $('#u_email').val()
    formData['u_tel'] = $('#u_tel').val()
    formData['u_role'] = $('#u_role').val()
    // $('[name^="inputValue"]').each(function() {
    //   formData[this.id] = this.value;
    // });

    // console.log(formData);

    var count = 0;
    var regex = /\d+/g;
    if (!formData.u_role) {
      $('#roleMsg').text(' กรุณาเลือกสิทธิ์ของพนักงาน');
      $('#u_role').focus();
      count++
    } else {
      $('#roleMsg').text(' ');
    }
    if (!formData.u_tel || (formData.u_tel).length != 10) {
      $('#telMsg').text(' กรุณากรอกตัวเลข 10 หลัก');
      $('#u_tel').focus();
      count++
    } else {
      $('#telMsg').text(' ');
    }

    if (!formData.u_email) {
      $('#emailMsg').text(' กรุณากรอกอีเมลให้ถูกต้อง');
      $('#u_email').focus();
      count++
    } else {
      $('#emailMsg').text(' ');
    }
    if (!formData.u_lastname) {
      $('#lnameMsg').text(' กรุณากรอกนามสกุล');
      $('#u_lastname').focus();
      count++
    } else {
      $('#lnameMsg').text(' ');
    }
    if (!formData.u_firstname) {
      $('#fnameMsg').text(' กรุณากรอกชื่อ');
      $('#u_firstname').focus();
      count++
    } else {
      $('#fnameMsg').text(' ');
    }

    if (count > 0) {
      return false;
    }

    var mainMsg;
    var detailMsg;
    if (u_id == "new") {
      mainMsg = "ยืนยันการเพิ่มพนักงาน";
      detailMsg = "คุณต้องการเพิ่มข้อมูลพนักงานในระบบใช่หรือไม่";
    } else {
      mainMsg = "ยืนยันการแก้ไขพนักงาน";
      detailMsg = "คุณต้องการแก้ไขข้อมูลพนักงานในระบบใช่หรือไม่";
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
          url: 'users/add',
          data: formData
        }).done(function(returnData) {
          if (returnData.status == 1) {
            swal({
              title: "สำเร็จ",
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
            $('#fMsg').addClass('text-success');
            $('#fMsg').text(returnData.msg);
            $('#usersForm')[0].reset();
            $('#mainModal').modal('hide');
            loadList();
          } else {
            swal({
              title: "ล้มเหลว",
              text: returnData.msg,
              type: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
            $('#fMsg').addClass('text-success');
            $('#fMsg').text(returnData.msg);
            $('#usersForm')[0].reset();
            $('#mainModal').modal('hide');
            loadList();
          }
        });
      }
    });
  }

  function view(u_id) {
    $.ajax({
      method: "post",
      url: 'users/getDetailForm',
      data: {
        u_id: u_id
      }
    }).done(function(returnData) {
      $('#detailModalTitle').html(returnData.title);
      $('#detailModalBody').html(returnData.body);
      $('#detailModalFooter').html(returnData.footer);
      $('#detailModal').modal();
    });
  }

  function edit(u_id) {
    $('#detailModal').modal('hide');
    $.ajax({
      method: "post",
      url: 'users/getEditForm',
      data: {
        u_id: u_id
      }
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  }

  function submitPwdForm(u_id) {
    // $('#fMsg').addClass('text-warning');
    // $('#fMsg').text('กำลังดำเนินการ ...');
    var formData = {};
    formData['u_id'] = u_id;
    $('[name^="inputValue"]').each(function() {
      formData[this.id] = this.value;
    });

    // console.log(formData);
    if (!formData.pwd || !formData.cfPwd) {
      $('#errMsg').addClass('text-danger');
      $('#errMsg').text('กรุณาระบุข้อมูลให้ครบถ้วน');
      !formData.pwd ? $('#cfPwd').focus() : '';
      !formData.cfPwd ? $('#pwd').focus() : '';
      return false;
    } else if (formData.pwd != formData.cfPwd) {
      $('#errMsg').addClass('text-danger');
      $('#errMsg').text('รหัสผ่านไม่ตรงกัน');
      return false;
    }
    swal({
      title: "ยืนยันการเปลี่ยนรหัสผ่าน",
      text: "คุณต้องการเปลี่ยนรหัสผ่านใช่หรือไม่",
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: "ยืนยัน",
      cancelButtonText: "ยกเลิก",
    }).then(function(isConfirm) {
      if (isConfirm.value) {
        $.ajax({
          method: "post",
          url: 'users/updatePassword',
          data: formData
        }).done(function(returnData) {
          if (returnData.status == 1) {
            swal({
              title: "สำเร็จ",
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
            $('#fMsg').addClass('text-success');
            $('#fMsg').text(returnData.msg);
            $('#pwdForm')[0].reset();
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
            $('#fMsg').addClass('text-success');
            $('#fMsg').text(returnData.msg);
            $('#pwdForm')[0].reset();
            $('#mainModal').modal('hide');
          }
        });
        loadList();
      }
    });
  }

  function changePassword(u_id) {
    $.ajax({
      method: "post",
      url: 'users/getPasswordForm',
      data: {
        u_id: u_id
      }
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  }

  function changeRole(u_id) {
    swal({
      title: "เปลี่ยนสิทธิ์การใช้งาน",
      text: "คุณต้องการเปลี่ยนสิทธิ์การใช้งานใช่หรือไม่",
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: "ยืนยัน",
      cancelButtonColor: "#E4E4E4",
      cancelButtonText: "<font style='color:black'>" + "ยกเลิก" + "</font>",
    }).then(function(isConfirm) {
      if (isConfirm.value) {
        // console.log($('#roleInput' + u_id).val())
        $.ajax({
          method: "post",
          url: 'users/updateRole',
          data: {
            u_id: u_id,
            u_role: $('#roleInput' + u_id).val(),
          }
        }).done(function(returnData) {
          if (returnData.status == 1) {
            loadList();
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
      loadList();
    })

  }

  function changeStatus(u_id, u_status) {
    var status = document.getElementById("status" + u_id)
    if (u_status == 1) {
      status.checked = false;
    } else {
      status.checked = true;
    }
    $.ajax({
      method: "POST",
      url: 'users/updateStatus',
      data: {
        u_id: u_id,
        u_status: u_status
      }
    }).done(function(returnData) {
      if (returnData.status == 1) {
        loadList();
        $.toast({
          heading: 'สำเร็จ',
          text: returnData.msg,
          position: 'top-right',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
        });
      } else {
        $.toast({
          heading: 'สำเร็จ',
          text: returnData.msg,
          position: 'top-right',
          icon: 'error',
          hideAfter: 3500,
          stack: 6
        });
      }
    })

  }
</script>