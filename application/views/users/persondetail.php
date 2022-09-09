<div class="row">
    <div class="col-12">
        <div class="card">
            <form class="" id="persondeatilForm">
                <div class="card-body">
                <h4 class='card-title'>ข้อมูลพนักงาน</h4>
                    <div class="form-group">
                        <label for="fn" class="form-label">ชื่อ</label>
                        <input type="text" class="form-control"  id="fn" value="<?= isset($getData) ? $getData->u_firstname : '' ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="ln" class="form-label">นามสกุล</label>
                        <input type="text" class="form-control"  id="ln" value="<?= isset($getData) ? $getData->u_lastname : '' ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">อีเมล</label>
                        <input type="email" class="form-control" id="email" value="<?= isset($getData) ? $getData->u_email : '' ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control"  id="tel" value="<?= isset($getData) ? $getData->u_tel : '' ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="position" class="form-label">ตำแหน่ง</label>
                        <input type = "text" class="form-control"  disabled name="inputValue[]" id="u_role"
                            <?php if(isset($getData->u_role)) {
                               foreach($arrayRole as $key=>$value) { 
                                if($getData->u_role == $key){ 
                                  echo 'value="'.$value.'"';
                                } 
                              } 
                            } 
                            ?> >
                    </div>                   
                </div>
            </form>
        </div>
    </div>
</div>