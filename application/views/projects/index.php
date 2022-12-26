<!-- Create by: Patiphan Pansanga, Jiradat Pomyai 19-09-2565 -->
<div id="listDiv"></div>

<script>
  let countSec = 0;

  loadList();

  function loadList() {
    $.ajax({
      url: 'projects/get',
      method: 'post'
    }).done(function(returnData) {
      countSec = 0;
      $('#listDiv').html(returnData.html)
    })
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
    formData['p_address'] = $('#p_address').val()
    
    formData['p_telcontact'] = $('#p_telcontact').val()
    formData['p_linecontact'] = $('#p_linecontact').val()
    formData['p_emailcontact'] = $('#p_emailcontact').val()
    formData['p_othercontact'] = $('#p_othercontact').val()
    var dateInput = $('#p_createdate').val()
    if(dateInput.length == 10) {
      // darr = dateInput.split("-");
      // var dobj = new Date(parseInt(darr[2]),parseInt(darr[1])-1,parseInt(darr[0]));
      var bangkokDate = dateInput.toLocaleString("en-US", {timeZone: "Asia/Bangkok"})
      // formData['p_createdate'] = dobj.toISOString().split("T")[0]
      formData['p_createdate'] = bangkokDate.substring(6, 10) + "-" + bangkokDate.substring(3, 5) + "-" + bangkokDate.substring(0, 2);
    } else {
      formData['p_createdate'] = "";
    }
    var count = 0;
    if (!validateEmail(formData.p_emailcontact) && formData.p_emailcontact != "") {
      $('#emailMsg').text(' <?= lang('md_rqf_em') ?>');
      $('#p_emailcontact').focus();
      count++
    } else {
      $('#emailMsg').text(' ');
    }
    if (formData.p_telcontact.length > 0) {
      if (formData.p_telcontact.length != 10 || formData.p_telcontact[0] != '0') {
        $('#telMsg').text('<?= lang('md_rqf_cp') ?>');
        $('#p_telcontact').focus();
        count++
      } else {
        $('#telMsg').text(' ');
      }
    }
    if (!formData.p_createdate) {
      $('#createdateMsg').text(' <?= lang('md_rqf_sd') ?>');
      // $('#p_createdate').focus();
      count++
    } else if(formData.p_createdate == "wrongFormat") {
      $('#createdateMsg').text(' <?= lang('md_rqf_sd-f') ?>');
      count++
    } else {
      $('#createdateMsg').text(' ');
    }
    if (!formData.p_customer) {
      $('#customerMsg').text(' <?= lang('md_rqf_cm') ?>');
      $('#p_customer').focus();
      count++
    } else {
      $('#customerMsg').text(' ');
    }
    if (!formData.p_detail) {
      $('#detailMsg').text(' <?= lang('md_rqf_pd') ?>');
      $('#p_detail').focus();
      count++
    } else {
      $('#detailMsg').text(' ');
    }
    if (!formData.p_name) {
      $('#nameMsg').text(' <?= lang('md_rqf_pn') ?>');
      $('#p_name').focus();
      count++
    } else {
      $('#nameMsg').text(' ');
    }

    if (count > 0) {
      return false;
    }

    var mainMsg;
    var detailMsg;
    if (p_id == "new") {
      mainMsg =  '<?= lang('md_ap_main-msg') ?>' ;
      detailMsg = '<?= lang('md_ap_detail-msg') ?>';
    } else {
      mainMsg = '<?= lang('md_ep_main-msg')?>';
      detailMsg = '<?= lang('md_ep_detail-msg') ?>';
    }
    swal({
      title: mainMsg,
      text: detailMsg,
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: '<?= lang('bt_confirm')?>',
      cancelButtonText: '<?= lang('bt_cancel') ?>',
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
              title: "<?= lang('md_vm-suc') ?>",
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
              title: "<?= lang('md_vm-fail')?>",
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
      mainMsg = '<?= lang('md_dp_main-msg') ?>';
      detailMsg = '<?= lang('md_dp_detail-msg') ?>';
    } else {
      mainMsg = '<?= lang('md_rp_main-msg') ?>';
      detailMsg = '<?= lang('md_rp_detail-msg') ?>';
    }
    swal({
      title: mainMsg,
      text: detailMsg,
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: '<?= lang('bt_confirm')?>',
      cancelButtonColor: "#E4E4E4",
      cancelButtonText: "<font style='color:black'>" + '<?= lang('bt_cancel')?>' + "</font>",
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
              title: '<?= lang('md_v,-suc')?>',
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
          } else {
            swal({
              title: '<?= lang('md_v,-fail')?>',
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
          let newTime = new Date(seconds * 1000).toISOString().slice(11, 16);
          restore[i].innerHTML = lang('md_rp') +" <span style='font-size:16px;'>" + newTime + "</span> ชม.";
        }
      }
    }, 1000);
  }

  runTime()
</script>