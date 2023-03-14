 <!-- Create by: Patiphan Pansanga 25-01-2565 -->
 <div id="listDiv"></div>

 <script>
   loadList();

   // new button on click and then show modal
   $('#addBtn').click(function(e) {
     e.preventDefault();
     $.ajax({
       method: "post",
       url: 'cancel/getAddForm'
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

   function saveFormSubmit(cl_id) {
     var formData = {};
     formData['cl_id'] = cl_id;
     formData['cl_name'] = $('#cl_name').val()
     if (!formData.cl_name) {
       $('#clnameMsg').addClass('text-danger');
       $('#clnameMsg').text('กรุณากรอกชื่อกิจกรรม');
       !formData.cl_name ? $('#cl_name').focus() : '';
       return false;
     } else {
       $('#clnameMsg').text(' ');
     }
     $.ajax({
       url: 'cancel/checkRepeat',
       data: {
         cl_name: formData['cl_name']
       },
       method: 'post'
     }).done(function(returnData) {
       if (returnData.status == 0) {
         $('#clnameMsg').text(returnData.msg);
         $('#cl_name').addClass('is-invalid');
         return;
       } else {
         $('#clnameMsg').text(returnData.msg);
         $('#cl_name').removeClass('is-invalid');

         var mainMsg;
         var detailMsg;
         if (cl_id == "new") {
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
             $('.btn-success').attr("disabled", "disabled");
             $('.btn-success').html('<?= lang('bt_save') ?> <div class="spinner-border spinner-border-sm text-light" role="status"><span class="sr-only">Loading...</span></div>')

             $.ajax({
               method: "post",
               url: 'cancel/add',
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
                 $('#formcancellist')[0].reset();
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
                 $('#formcancellist')[0].reset();
                 $('#mainModal').modal('hide');
                 loadList();
               }
             });
           }
         });
       }
     })
   }

   function edit(cl_id) {
     $.ajax({
       method: "post",
       url: 'cancel/getEditForm',
       data: {
         cl_id: cl_id
       }
     }).done(function(returnData) {
       $('#mainModalTitle').html(returnData.title);
       $('#mainModalBody').html(returnData.body);
       $('#mainModalFooter').html(returnData.footer);
       $('#mainModal').modal();
     });
   }

   function changeStatus(cl_id, cl_status) {
     var mainMsg;
     var detailMsg;
     if (cl_status == 1) {
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
           url: 'cancel/updateStatus',
           data: {
             cl_id: cl_id,
             cl_status: cl_status
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