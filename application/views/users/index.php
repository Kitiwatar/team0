<!-- 
  Author: Patiphan Pansanga, Jiradat Pomyai 
  Create: 2022-09-07
 -->
<div id="listDiv"></div>

<script>
  loadList();
  const strNumber = string => [...string].every(c => '0123456789'.includes(c));
  const strThai = string => [...string].every(c => 'กิ่ขี้ฃึ๊คื๋ฅัฆ็ง์จฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮะาเแำไใฤฦๅ'.includes(c));
  const strEmail = string => [...string].every(c => 'abcdefgijklmnopqrstuvwxyz@.-1234567890'.includes(c));
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
    $('[name^="inputValue"]').each(function() {
      formData[this.id] = this.value;
    });

    console.log(formData);
    if (!formData.u_firstname || !formData.u_lastname || !formData.u_email || !formData.u_tel || !formData.u_role) {
      $('#fMsg').addClass('text-danger');
      $('#fMsg').text('กรุณาระบุข้อมูลให้ครบถ้วน');
      !formData.u_role ? $('#u_role').focus() : '';
      !formData.u_tel ? $('#u_tel').focus() : '';
      !formData.u_email ? $('#u_email').focus() : '';
      !formData.u_lastname ? $('#u_lastname').focus() : '';
      !formData.u_firstname ? $('#u_firstname').focus() : '';
      return false;
    } else {
      var count = 0;
      var regex = /\d+/g;
      $('#fMsg').text(' ');
      if ((formData.u_firstname).match(regex)) {
        $('#fnameMsg').text(' กรอกได้เพียงตัวอักษรเท่านั้น');
        $('#u_firstname').focus();
        count++
      } else {
        $('#fnameMsg').text(' ');
      }
      if ((formData.u_lastname).match(regex)) {
        $('#lnameMsg').text(' กรอกได้เพียงตัวอักษรเท่านั้น');
        $('#u_lastname').focus();
        count++
      } else {
        $('#lnameMsg').text(' ');
      }
      if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/).test(formData.u_email)) {
        $('#emailMsg').text(' รูปแบบของอีเมลไม่ถูกต้อง');
        $('#u_email').focus();
        count++
      } else {
        $('#emailMsg').text(' ');
      }
      if (!strNumber(formData.u_tel) || (formData.u_tel).length != 10) {
        $('#telMsg').text(' กรอกได้เพียงตัวเลข 10 หลักเท่านั้น');
        $('#u_tel').focus();
        count++
      } else {
        $('#telMsg').text(' ');
      }
      if (count > 0) {
        return false;
      }
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
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
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