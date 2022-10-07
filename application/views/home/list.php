<!-- Create by : Kitiwat Arunwong 24/09/2565 -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class='card-title'>ลำดับพนักงานที่รับผิดชอบงานมากที่สุด</h4>
                <div class="table-responsive">
                    <table class="display table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">ลำดับ</th>
                                <th>ชื่อพนักงาน</th>
                                <th class="text-center">จำนวนงานที่รับผิดชอบ</th>
                                <th class="text-center">อัปเดตลำดับล่าสุดวันที่</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (is_array($listProject)) : $count = 1; ?>
                                <?php for ($i = 0; $i < 5; $i++) : ?>
                                    <tr>
                                        <td class="text-center"><?= $count++ ?></td>
                                        <td><?= $listName[$i] ?></td>
                                        <td class="text-center"><?= $listProject[$i] ?></td>
                                        <td class="text-center"><?=thaiDate(date("d/m/Y")) ?></td>
                                    </tr>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.table').DataTable({
        "dom": 't',
        "order": [[2, "desc"]],
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
</script>