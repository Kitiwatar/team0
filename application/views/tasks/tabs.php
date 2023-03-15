<div class="bd-example">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="task-tab" onclick="showTab('task')"><?= lang('task-h') ?></button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="calendarData-tab" onclick="showTab('calendarData')"><?= lang('Calendar') ?></button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="permission-tab" onclick="showTab('permission')"><?= lang('Em-inp') ?></button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade active show" id="task" role="tabpanel" aria-labelledby="home-tab">
      <div class="card">
        <div class="card-body">
        <?= $taskContent ?>
        <a type="button" class="btn waves-effect waves-light btn-dark" href="<?= base_url() ?>"><i class="mdi mdi-arrow-left"></i>  <?= lang('b_project_back') ?> </a>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="calendarData" role="tabpanel" aria-labelledby="calendar-tab">
      <div class="card pt-0">
        <div class="card-body p-0">
        <?= $calendarContent ?>
        <div class="p-3">        
          <a type="button" class="btn waves-effect waves-light btn-dark" href="<?= base_url() ?>"><i class="mdi mdi-arrow-left"></i>  <?= lang('b_project_back') ?> </a>
        </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="permission" role="tabpanel" aria-labelledby="contact-tab">
      <div class="card">
        <div class="card-body">
        <?= $permissionContent ?>
        <a type="button" class="btn waves-effect waves-light btn-dark" href="<?= base_url() ?>"><i class="mdi mdi-arrow-left"></i>  <?= lang('b_project_back') ?> </a>
        </div>
      </div>   
     </div>
  </div>
</div>
<script>
  function showTab(id) {
    $('#task').removeClass("active").removeClass("show")
    $('#task-tab').removeClass("active")
    $('#calendarData').removeClass("active").removeClass("show")
    $('#calendarData-tab').removeClass("active")
    $('#permission').removeClass("active").removeClass("show")
    $('#permission-tab').removeClass("active")
    $('#' + id).addClass("active show");
    $('#' + id + '-tab').addClass("active");
    loadCalendar()
  }

  function loadCalendar() {
    $('.calendarData').addClass('p-5')
    $('.fc-month-button').click();
  }
</script>