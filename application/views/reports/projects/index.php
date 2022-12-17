<!-- Create by: Patiphan Pansanga, Jiradat Pomyai 19-09-2565 -->
<div id="listDiv"></div>

<script>
  loadList();

  function loadList() {
    console.log($('#begindate').val())
    $.ajax({
      url: '<?= base_url() ?>reports/getProjects',
      method: 'post',
      data: {
        begindate: $('#begindate').val()
      }
    }).done(function(returnData) {
      $('#listDiv').html(returnData.html)
    })
  }

  function changeYear() {
    loadList();
  }
</script>