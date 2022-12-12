 <!-- Create by: Natakorn Phongsarikit 15-09-2565 -->
 <div id="listDiv"></div>

<script>
  loadList();
  
  // new button on click and then show modal
  $('#addBtn').click(function(e) {
    e.preventDefault();
    $.ajax({
      method: "post",
      url: 'tasklist/getAddForm'
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  });

  function loadList() {
    $.ajax({
      url: 'tasklist/get',
      method: 'post'
    }).done(function(returnData) {
      $('#listDiv').html(returnData.html)
    })
  }

  function saveFormSubmit(tl_id) {
    // $('#fMsg').addClass('text-warning');
    // $('#fMsg').text('กำลังดำเนินการ ...');
    var formData = {};
    formData['tl_id'] = tl_id;
    formData['tl_name'] = $('#tl_name').val()
    // $('[name^="inputValue"]').each(function() {
    //   formData[this.id] = this.value;
    // });

    console.log(formData);
    if (!formData.tl_name) {
      $('#tlnameMsg').addClass('text-danger');
      $('#tlnameMsg').text('<?= lang('md_atl_rqf') ?>');
      !formData.tl_name ? $('#tl_name').focus() : '';
      return false;
      } else {
        $('#tlnameMsg').text(' ');
      }
    var mainMsg;
    var detailMsg;
    if (tl_id == "new") {
      mainMsg = '<?= lang('md_atl_main-msg') ?>';
      detailMsg = '<?= lang('md_atl_detail-msg') ?>';
    } else {
      mainMsg = '<?= lang('md_etl_main-msg') ?>';
      detailMsg = '<?= lang('md_etl_detail-msg') ?>';
    }
    swal({
      title: mainMsg,
      text: detailMsg,
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: "<?= lang('bt_confirm') ?>",
      cancelButtonText: '<?= lang('bt_cancel') ?>',
    }).then(function(isConfirm) {
      if (isConfirm.value) {
        $.ajax({
          method: "post",
          url: 'tasklist/add',
          data: formData
        }).done(function(returnData) {
          if (returnData.status == 1) {
            swal({
              title: '<?= lang('md_vm-suc') ?>',
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
            $('#fMsg').addClass('text-success');
            $('#fMsg').text(returnData.msg);
            $('#formtasklist')[0].reset();
            $('#mainModal').modal('hide');
            loadList();
          } else {
            swal({
              title: '<?= lang('md_vm-fail') ?>',
              text: returnData.msg,
              type: "error",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
            $('#fMsg').addClass('text-success');
            $('#fMsg').text(returnData.msg);
            $('#formtasklist')[0].reset();
            $('#mainModal').modal('hide');
            loadList();
          }
        });
      }
    });

  function view() {
    $.ajax({
      method: "post",
      url: 'tasklist/getDetailForm',
    }
    ).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  }
  }

  function edit(tl_id) {
    $.ajax({
      method: "post",
      url: 'tasklist/getEditForm',
      data: {
        tl_id: tl_id
      }
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  }

  function changeStatus(tl_id, tl_status) {
    var mainMsg;
    var detailMsg;
    if (tl_status == 1) {
      mainMsg = '<?= lang('md_dtl_main-msg') ?>';
      detailMsg = '<?= lang('md_dtl_detail-msg') ?>';
    } else {
      mainMsg = "ยืนยันการกู้คืนรายการกิจกรรม";
      detailMsg = "คุณต้องการกู้คืนรายการกิจกรรมใช่หรือไม่";
    }
    swal({
      title: mainMsg,
      text: detailMsg,
      type: "warning",
      showCancelButton: true,
      showConfirmButton: true,
      confirmButtonText: '<?= lang('bt_confirm') ?>',
      cancelButtonColor: "#E4E4E4",
      cancelButtonText: "<font style='color:black'>" + '<?= lang('bt_cancel') ?>' + "</font>",
    }).then(function(isConfirm) {
      if (isConfirm.value) {
        $.ajax({
          method: "POST",
          url: 'tasklist/updateStatus',
          data: {
            tl_id: tl_id,
            tl_status: tl_status
          }
        }).done(function(returnData) {
          if (returnData.status == 1) {
            loadList();
            swal({
              title: '<?= lang('md_vm-suc') ?>',
              text: returnData.msg,
              type: "success",
              showCancelButton: false,
              showConfirmButton: false,
              timer: 1000,
            });
          } else {
            swal({
              title: '<?= lang('md_vm-fail') ?>',
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