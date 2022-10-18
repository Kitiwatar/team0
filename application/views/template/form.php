<!-- Createby: Patiphan Pansanga 07-09-2565 -->
<?php $required = '<span class="text-danger">*</span>'; ?>
<div class="row">
  <div class="col-12">
    <div class="card">
      <form class="" id="usersForm" autocomplete="off">
        <div class="card-body">
            <div class="form-group">
              <label for="u_firstname" class="form-label">ชื่อ<?php if(!isset($detail)) { echo $required; } ?></label>
              <input type="text" class="form-control" name="inputValue[]" value="<?= isset($getData) ? $getData->u_firstname : '' ?>" id="u_firstname" placeholder="กรอกชื่อของพนักงาน (สมศักดิ์)" <?php if(isset($detail)){echo "disabled";}?> >
              <font id="fnameMsg" class="small text-danger"></font>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>