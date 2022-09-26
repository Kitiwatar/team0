<!-- 
  Author: Jiradat Pomyai, Patiphan Pansanga 
  Create: 2022-09-07
 -->
 <?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="formtasklist" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
              <label for="tl_name" class="form-label">รายการกิจกรรม</label>
              <input type="text" class="form-control" onkeypress="checkOnlyText('tl_name)" name="inputValue[]" value="<?= isset($getData) ? $getData->tl_name : '' ?>" id="tl_name" placeholder="กรอกรายกิจกรรม" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="fnameMsg" class="small text-danger"></font>
            </div>
</div>

<script>
  function checkOnlyText(id) {
    var dom = document.getElementById(id);
    if(strNumber(String.fromCharCode(event.which)) || dom.value.length > 99){
      event.preventDefault();
    }
  }

  function checkEmailValid(id) {
    var dom = document.getElementById(id);
    if(!strEmail(String.fromCharCode(event.which)) || dom.value.length > 99){
      event.preventDefault();
    }
  }

  function checkTelValid(id) {
    var dom = document.getElementById(id);
    if(!strNumber(String.fromCharCode(event.which)) || dom.value.length > 9){
      console.log($(id).val());
      event.preventDefault();
    }
  }
</script>