<!-- Create by: Patiphan Pansanga 19-12-2565 -->
<div id="listDiv"></div>

<script>
  loadList();

  function loadList() {
    $.ajax({
      url: hostname + 'reports/getProjects',
      method: 'post',
      data: {
        begindate: $('#begindate').val(),
        enddate: $('#enddate').val()
      }
    }).done(function(returnData) {
      $('#listDiv').html(returnData.html)
    })
  }

  function changeYear() {
    loadList();
  }
</script>