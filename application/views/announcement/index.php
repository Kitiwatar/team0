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
     //  formData['an_begindate'] = $('#an_begindate').val()
     //  formData['an_enddate'] = $('#an_enddate').val()
     var dateInput = $('#an_begindate').val()
     if (dateInput.length == 10) {
       var bangkokDate = dateInput.toLocaleString("en-US", {
         timeZone: "Asia/Bangkok"
       })
       formData['an_begindate'] = bangkokDate.substring(6, 10) + "-" + bangkokDate.substring(3, 5) + "-" + bangkokDate.substring(0, 2);
     } else {
       formData['an_begindate'] = "";
     }
     var dateInput1 = $('#an_enddate').val()
     if (dateInput1.length == 10) {
       var bangkokDate1 = dateInput1.toLocaleString("en-US", {
         timeZone: "Asia/Bangkok"
       })
       formData['an_enddate'] = bangkokDate1.substring(6, 10) + "-" + bangkokDate1.substring(3, 5) + "-" + bangkokDate1.substring(0, 2);
     } else {
       formData['an_enddate'] = "";
     }
     count = 0;
     // console.log(formData)
     if (!formData.an_text) {
       $('#clnameMsg').addClass('text-danger');
       $('#clnameMsg').text('กรุณาข้อความ');
       count++;
     } else {
       $('#clnameMsg').text(' ');
     }
     if (!formData.an_enddate) {
       $('#enddateMsg').addClass('text-danger');
       $('#enddateMsg').text('กรุณาระบุวันที่สิ้นสุด');
       count++;
     } else {
       $('#enddateMsg').text(' ');
     }
     if (!formData.an_begindate) {
       $('#begindateMsg').addClass('text-danger');
       $('#begindateMsg').text('กรุณาระบุวันที่เริ่มต้นแสดงข้อความ');
       count++;
     } else {
       $('#begindateMsg').text(' ');
     }
     if (count != 0) {
       return;
     }
     $('.btn-success').attr("disabled", "disabled");
     $('.btn-success').html('<?= lang('bt_save') ?> <div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only">Loading...</span></div>')

     $.ajax({
       method: "post",
       url: 'announ/add',
       data: formData
     }).done(function(returnData) {
       if (returnData.status == 1) {
         swal({
           title: "<?= lang('md_vm-suc') ?>",
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
           title: "<?= lang('md_vm-fail') ?>",
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
     });
   }
   //    });
   //  }

   function edit(an_id) {
     $.ajax({
       method: "post",
       url: 'announ/getEditForm',
       data: {
         an_id: an_id
       }
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
           heading: '<?= lang('md_vm-suc') ?>',
           text: returnData.msg,
           position: 'top-right',
           icon: 'success',
           hideAfter: 3500,
           stack: 6
         });
       } else {
         $.toast({
           heading: '<?= lang('md_vm-fail') ?>',
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
     mainMsg = '<?= lang('main-announcement') ?>';
     detailMsg = '<?= lang('detail-announcement') ?>';
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
               title: '<?= "ประกาศสำเร็จ" ?>',
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