<div id="listDiv"></div>
<script>
    loadList();

    function loadList() {
        $.ajax({
            url: 'logs/get',
            method: 'post'
        }).done(function(returnData) {
            $('#listDiv').html(returnData.html)
        })
    }

    function view(id) {
        $.ajax({
        method: "post",
        url: 'logs/getDetailForm',
        data: {
            l_id: id
        }
        }).done(function(returnData) {
            $('#mainModalTitle').html(returnData.title);
            $('#mainModalBody').html(returnData.body);
            $('#mainModalFooter').html(returnData.footer);
            $('#mainModal').modal();
        });
    }
</script>