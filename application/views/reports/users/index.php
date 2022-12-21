<!-- Create by: Patiphan Pansanga 20-12-2565 -->
<div id="listDiv"></div>

<script>
  loadList();

  function loadList() {
    $.ajax({
      url: '<?= base_url() ?>reports/getusers',
      method: 'post',
    }).done(function(returnData) {
      $('#listDiv').html(returnData.html)
    })
  }

  function viewProjects(u_id) {
    $.ajax({
      method: "post",
      url: '<?= base_url() ?>reports/getUserProject',
      data: {
        u_id: u_id
      }
    }).done(function(returnData) {
      $('#detailModalTitle').html(returnData.title);
      $('#detailModalBody').html(returnData.body);
      $('#detailModalFooter').html(returnData.footer);
      $('#detailModal').modal();
    });
  }
</script>