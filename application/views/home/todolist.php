<!-- Create by: Jiradat Pomyai 03-01-2566 -->

<?php if (is_array($listtodo)) : $count = 1; ?>
    <h3 class="pt-4 ps-4"><?= lang('todo') ?></h3>
    <div class="card-body">
        <div class="row">
            <?php foreach ($listtodo as $key => $value) : ?>
                <div class="col-12">
                    <div class="row my-1" style="border-left: 10px solid #03A9F3;">
                        <div class="col-lg-10 col-md-10 col-sm-12 fs-4 "> <?= $value->tl_name ?> &nbsp;&nbsp;&nbsp;&nbsp;: <?= $value->p_name ?></div>
                        <div class="col-lg-2 col-md-2 col-sm-12 fs-4" style="color: #676767;"> <?= substr($value->t_createdate, 11, 5) ?> น.</div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else : ?>
    <h3 class="pt-4 ps-4"><?= lang('todo') ?></h3>
    <div class="card-body d-flex align-items-center justify-content-center">
        <div class="fs-4" style="color:#676767;"><?= lang('no_todo') ?></div>
    </div>
    <div style="height: 58px;"></div>
<?php endif; ?>
