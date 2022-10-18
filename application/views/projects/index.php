<!-- Create by: Patiphan Pansanga, Jiradat Pomyai 19-09-2565 -->
<div id="listDiv"></div>

<script>
  
  loadList();

  function loadList() {
    $.ajax({
      url: 'projects/get',
      method: 'post'
    }).done(function(returnData) {
      $('#listDiv').html(returnData.html)
    })
  }

  function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
  }

  function saveFormProjectSubmit(p_id) {
    // $('#fMsg').addClass('text-warning');
    // $('#fMsg').text('กำลังดำเนินการ ...');
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
    });
  }

  function view(p_id) {
    $.ajax({
      method: "post",
      url: 'projects/getDetailForm',
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
      url: 'projects/getEditForm',
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

  function changeStatus(p_id, p_status) {
    var mainMsg;
    var detailMsg;
    if (p_status < 1) {
      mainMsg = "ยืนยันการลบโครงการ";
      detailMsg = "คุณต้องการลบโครงการใช่หรือไม่";
    } else {
      mainMsg = "ยืนยันการกู้คืนโครงการ";
      detailMsg = "คุณต้องการกู้คืนโครงการใช่หรือไม่";
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
          url: 'projects/updateStatus',
          data: {
            p_id: p_id,
            p_status: p_status
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

  let countSec = 0;

  function runTime() {
    var downloadTimer = setInterval(function() {
      let restore = document.getElementsByName("restore")
      countSec++
      $('[data-toggle="tooltip"]').tooltip();
      for (let i = 0; i < restore.length; i++) {
        let time = restore[i].id;
        time = time.substring(time.length - 8);
        var a = time.split(':');
        var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]);
        seconds -= countSec;
        if (seconds <= 0) {
          loadList();
          // let id = restore[i].id.substring(0, restore[i].id.length-9);
          // document.getElementById("project"+id).style.display = "none"
          // var rows = table.rows( '#project'+id ).remove().draw();
        } else {
          let newTime = new Date(seconds * 1000).toISOString().slice(11, 19);
          restore[i].innerHTML = "เหลือเวลากู้คืน" + newTime;
        }
      }
    }, 1000);
  }

  runTime()
</script>