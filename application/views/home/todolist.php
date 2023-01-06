<!-- Create by : Kitiwat Arunwong 24/09/2565 -->
<style>

</style>


<?php if (is_array($listtodo)) : $count = 1; ?>
<h1 class="pt-3 ps-3">งานของฉันวันนี้</h1>
    <div class="card-body p-4">
        <div class="row">
            <?php foreach ($listtodo as $key => $value) : ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row py-0"  style="border-left: 10px solid #03A9F3;">
                            <div class="col-lg-2 col-md-4 col-sm-12 fs-4"> <?= $value->tl_name ?> </div>
                            <div class="col-lg-8 col-md-6 col-sm-12 fs-4">: <?= $value->p_name ?></div>
                            <div class="col-lg-2 col-md-2 col-sm-12 fs-4" style="color: #676767;"> 8.00 น.</div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else : ?>
    <h1 class="pt-5 ps-5">งานของฉันวันนี้</h1>
    <div class="card-body d-flex align-items-center justify-content-center">
        <div style="font-size:20px;"> ไม่มีงาน</div>
    </div>
    <div style="height: 58px;"></div>
<?php endif; ?>


<script>

</script>