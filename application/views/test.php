<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-6">
                        <div class="card">
                            <div class="table-responsive">
                                <table id="tb" class="display table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th class="text-center">เลือก</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < 10; $i++) : ?>
                                            <tr>
                                                <td class="align-middle" id="name<?= $i ?>"><?= "ชื่อ-นามสกุล" . $i ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success" onclick="addTo('<?=$i?>')">เลือก</button>
                                                </td>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <div class="col-6">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="display table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th class="text-center">เลือก</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list">
                                            
                                                
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="ok">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#tb').DataTable({
        "language": {
            "oPaginate": {
                "sPrevious": "ถอยกลับ",
                "sNext": "ถัดไป"
            },
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 รายการ",
            "sLengthMenu": "แสดง _MENU_ รายการ",
            "sSearch": "ค้นหา ",
            "sInfoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
            "sZeroRecords": "ไม่พบข้อมูล"
        },
    });
    $('#ok').click(function(e) {
        const checked = document.querySelectorAll('input[type="checkbox"]:checked');
        console.log([...checked].map(c => c.value))
    });

    function addTo(id) {
        var name = document.getElementById("name"+id).innerHTML
        var str = `<tr><td>`+name+`</td><td class="text-center"><button type="button" class="btn btn-danger" onclick="delete(`+id+`)">นำออก</button></td></tr>`
        document.getElementById("list").innerHTML += str
    }

    function checking(id) {
        if(document.getElementById('per'+id).checked == true) {
            document.getElementById("label"+id).innerHTML = "เลือก"
        } else {
            document.getElementById("label"+id).innerHTML = ""
        }
        
    }
</script>