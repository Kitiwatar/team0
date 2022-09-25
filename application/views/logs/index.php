<!-- Create by: Patiphan Pansanga 14-09-2022-->
 <div id="listDiv"></div>
<script>
    loadList();

    function loadList() {
        $.ajax({
            url: 'logs/get',
            method: 'post'
        }).done(function(returnData) {
            console.log(returnData)
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
            $('#detailModalTitle').html(returnData.title);
            $('#detailModalBody').html(returnData.body);
            $('#detailModalFooter').html(returnData.footer);
            $('#detailModal').modal();
        });
    }
</script>