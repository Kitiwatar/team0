 <!-- Create by: Patiphan Pansanga 25-01-2565 -->
 <div id="listDiv"></div>

<script>
  loadList();
  
  // new button on click and then show modal
  $('#addBtn').click(function(e) {
    e.preventDefault();
    $.ajax({
      method: "post",
      url: 'announ/getAddForm'
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  });

  function loadList() {
    $.ajax({
      url: 'announ/get',
      method: 'post'
    }).done(function(returnData) {
      $('#listDiv').html(returnData.html)
    })
  }

  function saveFormSubmit(an_id) {
     var formData = {};
     formData['an_id'] = an_id;
     formData['an_text'] = $('#an_text').val()
     if (!formData.an_text) {
       $('#clnameMsg').addClass('text-danger');
       $('#clnameMsg').text('กรุณาข้อความ');
       !formData.an_text? $('#an_text').focus() : '';
       return false;
     } else {
       $('#amnameMsg').text(' ');
     }
     $.ajax({
       url: 'announ/checkRepeat',
       data: {
         an_text: formData['an_text']
       },
       method: 'post'
     }).done(function(returnData) {
       if (returnData.status == 0) {
         $('#clnameMsg').text(returnData.msg);
         $('#cl_text').addClass('is-invalid');
         return;
       } else {
         $('#clnameMsg').text(returnData.msg);
         $('#cl_name').removeClass('is-invalid');
         
             $.ajax({
               method: "post",
               url: 'announ/add',
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
                 $('#formaannouce')[0].reset();
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
                 $('#formaannouce')[0].reset();
                 $('#mainModal').modal('hide');
                 loadList();
               }
               if(an_text.length>50){
                
               }
             });
           }
         });
       }

  function edit(an_id) {
    $.ajax({
      method: "post",
      url: 'announ/getEditForm',
      data: {
        an_id: an_id      }
    }).done(function(returnData) {
      $('#mainModalTitle').html(returnData.title);
      $('#mainModalBody').html(returnData.body);
      $('#mainModalFooter').html(returnData.footer);
      $('#mainModal').modal();
    });
  }

  function changeStatus2(an_id, an_status) {
    var status = document.getElementById("status" + an_id)
    if (an_status == 1) {
      status.checked = false;
      an_status++
    } else {
      status.checked = true;
      an_status--
    }
    $.ajax({
      method: "POST",
      url: 'announ/updateStatus',
      data: {
        an_id: an_id,
        an_status: an_status
      }
    }).done(function(returnData) {
      if (returnData.status == 1) {
        loadList();
        $.toast({
          heading: '<?= "สำเร็จ" ?>',
          text: returnData.msg,
          position: 'top-right',
          icon: 'success',
          hideAfter: 3500,
          stack: 6
        });
      } else {
        $.toast({
          heading: '<?= "ล้มเหลว"?>',
          text: returnData.msg,
          position: 'top-right',
          icon: 'error',
          hideAfter: 3500,
          stack: 6
        });
      }
    })

  }

  function deleteAnnoun(an_id) {
    var mainMsg;
    var detailMsg;
    mainMsg = '<?=  "ยืนยันการลบข้อความจากระบบ"?>';
    detailMsg = '<?="คุณต้องการลบข้อความจากระบบใช่หรือไม่" ?>';
    an_status = 0;
    
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
          url: 'announ/updateStatus',
          data: {
            an_id: an_id,
            an_status: an_status
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
          } else if (returnData.status == 2) {
            loadList();
            swal({
              title: '<?= "ประกาศสำเร็จ"?>',
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