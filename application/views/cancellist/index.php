 <!-- Create by: Patiphan Pansanga 25-01-2565 -->
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
      url: 'cancellist/get',
      method: 'post'
    }).done(function(returnData) {
      $('#listDiv').html(returnData.html)
    })
  }

  function saveFormSubmit(tl_id) {
     var formData = {};
     formData['tl_id'] = tl_id;
     formData['tl_name'] = $('#tl_name').val()
     if (!formData.tl_name) {
       $('#tlnameMsg').addClass('text-danger');
       $('#tlnameMsg').text('กรุณากรอกชื่อกิจกรรม');
       !formData.tl_name ? $('#tl_name').focus() : '';
       return false;
     } else {
       $('#tlnameMsg').text(' ');
     }
     $.ajax({
       url: 'tasklist/checkRepeat',
       data: {
         tl_name: formData['tl_name']
       },
       method: 'post'
     }).done(function(returnData) {
       if (returnData.status == 0) {
         $('#tlnameMsg').text(returnData.msg);
         $('#tl_name').addClass('is-invalid');
         return;
       } else {
         $('#tlnameMsg').text(returnData.msg);
         $('#tl_name').removeClass('is-invalid');
         
         var mainMsg;
         var detailMsg;
         if (tl_id == "new") {
           mainMsg = "ยืนยันการเพิ่มรายชื่อกิจกรรม";
           detailMsg = "คุณต้องการเพิ่มรายชื่อกิจกรรมใช่หรือไม่";
         } else {
           mainMsg = "ยืนยันการแก้ไขรายชื่อกิจกรรม";
           detailMsg = "คุณต้องการแก้ไขรายชื่อกิจกรรมใช่หรือไม่";
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
               url: 'tasklist/add',
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
                 $('#formtasklist')[0].reset();
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
                 $('#formtasklist')[0].reset();
                 $('#mainModal').modal('hide');
                 loadList();
               }
             });
           }
         });
       }
     })
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