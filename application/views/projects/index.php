<!-- Create by: Patiphan Pansanga, Jiradat Pomyai 19-09-2565 -->
 <div id="listDiv"></div>

<script>
  loadList();
  const strNumber = string => [...string].every(c => '0123456789'.includes(c));
  const strThai = string => [...string].every(c => 'กิ่ขี้ฃึ๊คื๋ฅัฆ็ง์จฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮะาเแำไใฤฦๅ'.includes(c));
  const strEmail = string => [...string].every(c => 'abcdefgijklmnopqrstuvwxyz@.-1234567890'.includes(c));
  // new button on click and then show modal
  

  function loadList() {
    $.ajax({
      url: 'projects/get',
      method: 'post'
    }).done(function(returnData) {
      $('#listDiv').html(returnData.html)
    })
  }

  function saveFormSubmit(p_id) {
    // $('#fMsg').addClass('text-warning');
    // $('#fMsg').text('กำลังดำเนินการ ...');
    var formData = {};
    formData['p_id'] = p_id;
    $('[name^="inputValue"]').each(function() {
      formData[this.id] = this.value;
    });

    console.log(formData);
    
    var mainMsg;
    var detailMsg;
    if (p_id == "new") {
      mainMsg = "ยืนยันการเพิ่มโครงการ";
      detailMsg = "คุณต้องการเพิ่มโครงการในระบบใช่หรือไม่";
    } else {
      mainMsg = "ยืนยันการแก้ไขโครงการ";
      detailMsg = "คุณต้องการแก้ไขโครงการในระบบใช่หรือไม่";
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
          url: 'projects/add',
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
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  }
  function view2(p_id) {
    $.ajax({
      method: "post",
      url: 'projects/viewProjectTasks',
      data: {
        p_id: p_id
      }
    }).done(function(returnData) {
      
      window.location='projects/viewProjectTasks'
    });
    
  }



  
  
  
  function edit(u_id) {
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

    console.log(formData);
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
        console.log($('#roleInput' + u_id).val())
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
    var mainMsg;
    var detailMsg;
    if (u_status == 1) {
      mainMsg = "ยืนยันการลบพนักงาน";
      detailMsg = "คุณต้องการลบพนักงานออกจากระบบใช่หรือไม่";
    } else {
      mainMsg = "ยืนยันการกู้คืนพนักงาน";
      detailMsg = "คุณต้องการกู้คืนข้อมูลพนักงานใช่หรือไม่";
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
          url: 'users/updateStatus',
          data: {
            u_id: u_id,
            u_status: u_status
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
        })
      }
    })

  }
</script>