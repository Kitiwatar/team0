<!-- Create by: Patiphan Pansanga 14-10-2565 -->
<div id="listDiv"></div>
<script>
  loadList();

  function loadList() {
    let getUrl = window.location.href;
    let url = new URL(getUrl);
    let p_id = url.searchParams.get("p_id");
    $.ajax({
      url: "tasks/get",
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
      title: "<?= lang('md_dep_main-msg') ?>",
      text: "<?= lang('md_dep_detail-msg') ?>",
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: '<?= lang('bt_confirm')?>',
      cancelButtonText: '<?= lang('bt_cancel')?>',
    }).then(function(isConfirm) {
      if (isConfirm.value) {
        $.ajax({
          method: "post",
          url: hostname + 'permissions/remove',
          data: {
            u_id: u_id,
            p_id: p_id
          }
        }).done(function(returnData) {
          loadList();
          if (returnData.status == 1) {
            swal({
              title: '<?= lang('md_vm-suc')?>',
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
          } else {
            swal({
              title: '<?= lang('md_vm-fail')?>',
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
    var formData = {};
    formData['t_id'] = t_id;
    formData['t_detail'] = $('#t_detail').val()
    t_createtime = $('#t_createtime').val()
    formData['t_tl_id'] = $('#t_tl_id').val()
    formData['t_p_id'] = $('#t_p_id').val()
    var dateInput = $('#t_createdate').val()
    if(dateInput.length == 10) {
      var bangkokDate = dateInput.toLocaleString("en-US", {timeZone: "Asia/Bangkok"})
      formData['t_createdate'] = bangkokDate.substring(6, 10) + "-" + bangkokDate.substring(3, 5) + "-" + bangkokDate.substring(0, 2) + " " + t_createtime;
    } else {
      formData['t_createdate'] = "";
    }
    let fileAdd = []
    
    let checkBoxAdd = document.getElementsByName('fileAdd');
    for (var checkbox of checkBoxAdd) {
      if (checkbox.checked)
        fileAdd.push(checkbox.value)
    }

    let fileRemove = []
    let checkBoxRemove = document.getElementsByName('fileRemove');
    for (var checkbox of checkBoxRemove) {
      if (checkbox.checked)
        fileRemove.push(checkbox.value)
    }
    var count = 0;
    if (!t_createtime) {
      $('#createtimeMsg').text(' <?= lang('md_at_rqf_imt') ?>');
      count++
    } else {
      $('#createtimeMsg').text(' ');
      $('#t_createtime').removeClass("is-invalid");
      $('#t_createtime').addClass("is-valid");
    }
    if (!formData.t_createdate) {
      $('#createdateMsg').text(' <?= lang('md_at_rqf_imd') ?>');
      count++
    } else {
      $('#createdateMsg').text(' ');
      $('#t_createdate').removeClass("is-invalid");
      $('#t_createdate').addClass("is-valid");
    }
    if (!formData.t_detail) {
      $('#detailMsg').text(' <?= lang('md_at_rqf_td') ?>');
      $('#t_detail').focus();
      $('#t_detail').addClass("is-invalid"); 
      count++
    } else {
      $('#detailMsg').text(' ');
      $('#t_detail').removeClass("is-invalid");
      $('#t_detail').addClass("is-valid");

    }
    if (!formData.t_tl_id) {
      $('#nameMsg').text(' <?= lang('md_at_rqf_tl') ?>');
      $('#t_tl_id').focus();
      $('#t_detail').addClass("is-invalid"); 
      count++
    } else {
      $('#nameMsg').text(' ');
      $('#t_tl_id').removeClass("is-invalid");
      $('#t_tl_id').addClass("is-valid");
    }
    if (count > 0) {
      return false;
    }

    // var mainMsg;
    // var detailMsg;
    // if (t_id == "new") {
    //   mainMsg = '<?= lang('md_at_main-msg') ?>';
    //   detailMsg =  '<?= lang('md_at_detail-msg') ?>';
    // } else {
    //   mainMsg = '<?= lang('md_et_main-msg') ?>';
    //   detailMsg = '<?= lang('md_et_detail-msg') ?>';
    // }
    // swal({
    //   title: mainMsg,
    //   text: detailMsg,
    //   type: "warning",
    //   showCancelButton: true,
    //   showConfirmButton: true,
    //   confirmButtonText: '<?= lang('bt_confirm')?>',
    //   cancelButtonText: '<?= lang('bt_cancel')?>',
    // }).then(function(isConfirm) {
    //   if (isConfirm.value) {
        $.ajax({
          method: "post",
          url: hostname + 'tasks/add',
          data: {
            formData: formData,
            fileAdd: fileAdd,
            fileRemove: fileRemove
          }
        }).done(function(returnData) {
          loadList();
          if (returnData.status == 1) {
            swal({
              title: '<?= lang('md_vm-suc')?>',
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
            $('#mainModalTitle').html("");
            $('#mainModalBody').html("");
            $('#mainModalFooter').html("");
            $('#mainModal').modal('hide');
          } else {
            swal({
              title: '<?= lang('md_vm-fail')?>',
              text: returnData.msg,
              type: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
            $('#mainModalTitle').html("");
            $('#mainModalBody').html("");
            $('#mainModalFooter').html("");
            $('#mainModal').modal('hide');
          }
        });
      }
  //   });
  // }

  function view(t_id) {
    $.ajax({
      method: "post",
      url: 'tasks/getDetailForm',
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

  $('.fc-content').click(function(e) {
    e.preventDefault();
    console.log($('.fc-content'))
    // $.ajax({
    //   method: "post",
    //   url: 'users/getAddForm'
    // }).done(function(returnData) {
    //   $('#mainModalTitle').html(returnData.title);
    //   $('#mainModalBody').html(returnData.body);
    //   $('#mainModalFooter').html(returnData.footer);
    //   $('#mainModal').modal();
    // });
  });

  function edit(t_id) {
    $('#detailModal').modal('hide');
    $.ajax({
      method: "post",
      url: 'tasks/getEditForm',
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
      url: 'tasks/deleteFile',
      data: {
        fileName: name
      }
    }).done(function(returnData) {
      document.getElementById(name).remove();
    });
  }

  function closeModalTask(action) {
    let tmpFiles = document.getElementsByClassName("tmpFiles");
    for (var checkbox of tmpFiles) {
      deleteFile(checkbox.value)
    }
    $('#mainModalTitle').html("");
    $('#mainModalBody').html("");
    $('#mainModalFooter').html("");
    $('#mainModal').modal('hide');

  }

  function changeStatus(t_id, t_status, p_id) {
    var mainMsg;
    var detailMsg;
    if (t_status == 1) {
      mainMsg = "<?= lang('md_dt_main-msg')?>";
      detailMsg = "<?= lang('md_dt_detail-msg')?>";
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
      confirmButtonText: '<?= lang('bt_save')?>',
      cancelButtonColor: "#E4E4E4",
      cancelButtonText: "<font style='color:black'>" + "ยกเลิก" + "</font>",
    }).then(function(isConfirm) {
      if (isConfirm.value) {
        $.ajax({
          method: "POST",
          url: 'tasks/updateStatus',
          data: {
            t_id: t_id,
            p_id: p_id
          }
        }).done(function(returnData) {
          loadList();
          if (returnData.status == 1) {
            swal({
              title: '<?= lang('md_vm-suc')?>',
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
          } else {
            swal({
              title: '<?= lang('md_vm-fail')?>',
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

  function viewProject(p_id) {
    $.ajax({
      method: "post",
      url: hostname + 'projects/getDetailForm',
      data: {
        p_id: p_id
      }
    }).done(function(returnData) {
      $('#detailModalTitle').html(returnData.title);
      $('#detailModalBody').html(returnData.body);
      $('#detailModalFooter').html(returnData.footer);
      $('#detailModal').modal();
    });
  }

  function editProject(p_id) {
    $('#detailModal').modal('hide');
    $.ajax({
      method: "post",
      url: hostname + 'projects/getEditForm',
      data: {
        p_id: p_id
      }
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  }

  function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
  }
  
  function saveFormProjectSubmit(p_id) {
    var formData = {};
    formData['p_id'] = p_id;
    formData['p_name'] = $('#p_name').val()
    formData['p_detail'] = $('#p_detail').val()
    formData['p_customer'] = $('#p_customer').val()
    formData['p_createdate'] = $('#p_createdate').val()
    formData['p_telcontact'] = $('#p_telcontact').val()
    formData['p_linecontact'] = $('#p_linecontact').val()
    formData['p_emailcontact'] = $('#p_emailcontact').val()
    formData['p_othercontact'] = $('#p_othercontact').val()
    var count = 0;
    if (formData.p_telcontact.length > 0) {
      if (formData.p_telcontact.length != 10) {
        $('#telMsg').text(' กรุณากรอกเบอร์โทรศัพท์ให้ครบ 10 หลัก');
        $('#p_telcontact').focus();
        count++
      } else {
        $('#telMsg').text(' ');
      }
    }
    if (!formData.p_createdate) {
      $('#createdateMsg').text(' กรุณาเลือกวันที่เริ่มโครงการ');
      // $('#p_createdate').focus();
      count++
    } else {
      $('#createdateMsg').text(' ');
    }
    if (!formData.p_customer) {
      $('#customerMsg').text(' กรุณากรอกชื่อลูกค้า');
      $('#p_customer').focus();
      count++
    } else {
      $('#customerMsg').text(' ');
    }
    if (!formData.p_detail) {
      $('#detailMsg').text(' กรุณากรอกรายระเอียดโครงการ');
      $('#p_detail').focus();
      count++
    } else {
      $('#detailMsg').text(' ');
    }
    if (!formData.p_name) {
      $('#nameMsg').text(' กรุณากรอกชื่อโครงการ');
      $('#p_name').focus();
      count++
    } else {
      $('#nameMsg').text(' ');
    }
    if (!validateEmail(formData.p_emailcontact) && formData.p_emailcontact != "") {
      $('#emailMsg').text(' กรุณากรอกอีเมลให้ถูกต้อง');
      $('#p_emailcontact').focus();
      count++
    } else {
      $('#emailMsg').text(' ');
    }
    if (count > 0) {
      return false;
    }


        $.ajax({
          method: "post",
          url: hostname + 'projects/add',
          data: formData
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
</script>