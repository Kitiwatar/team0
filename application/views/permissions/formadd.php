<!-- Create by: Patiphan Pansanga 14-10-2565 -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<table class="display table table-striped table-bordered dt-responsive nowrap" id="userTable">
					<thead>
						<tr>
							<th class="text-center">ลำดับ</th>
							<th>ชื่อ-นามสกุล</th>
				<th>อีเมล</th>
							<th class="text-center">ปุ่มดำเนินการ</th>
						</tr>
					</thead>
					<tbody>
						<?php if (is_array($users)) : $count = 1; ?>
							<?php foreach ($users as $key => $value) : $check = 0; ?>
								<?php if (is_array($users)) : ?>
									<?php foreach ($permissions as $index => $data) : ?>
										<?php if ($value->u_id == $data->per_u_id) : $check = 1;
											break; ?><?php endif; ?>
									<?php endforeach; ?>
									<?php if ($check == 1) : continue; ?><?php endif; ?>
								<?php endif; ?>
								<tr>
									<td class="text-center"><?= $count++ ?></td>
									<td><?= $value->u_firstname . " " . $value->u_lastname ?></td>
					<td><?= $value->u_email ?></td>
									<td class="text-center" id="user<?= $value->u_id ?>"><button class="btn btn-success" onclick="addPermission(<?= $value->u_id ?>,<?= $p_id ?>)">เพิ่ม</button></td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$('#userTable').DataTable({
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
		"lengthMenu": [5],
	});

	function addPermission(u_id, p_id) {
		let user = document.getElementById("user" + u_id)
		user.innerHTML = `<button class="btn btn-danger" onclick="deletePermission(` + u_id + `,` + p_id + `)">ลบ</button>`
		$.ajax({
			method: "post",
			url: '<?= base_url() ?>permissions/add',
			data: {
				u_id: u_id,
				p_id: p_id
			}
		}).done(function(returnData) {
			loadList();
			if (returnData.status == 1) {
				$.toast({
					heading: 'สำเร็จ',
					text: returnData.msg,
					position: 'top-right',
					icon: 'success',
					hideAfter: 3500,
					stack: 6
				});
			} else {
				$.toast({
					heading: 'สำเร็จ',
					text: returnData.msg,
					position: 'top-right',
					icon: 'error',
					hideAfter: 3500,
					stack: 6
				});
			}
		});
	}

	function deletePermission(u_id, p_id) {
		let user = document.getElementById("user" + u_id)
		user.innerHTML = `<button class="btn btn-success" onclick="addPermission(` + u_id + `,` + p_id + `)">เพิ่ม</button>`
		$.ajax({
			method: "post",
			url: '<?= base_url() ?>permissions/remove',
			data: {
				u_id: u_id,
				p_id: p_id
			}
		}).done(function(returnData) {
			loadList();
			if (returnData.status == 1) {
				$.toast({
					heading: 'สำเร็จ',
					text: returnData.msg,
					position: 'top-right',
					icon: 'success',
					hideAfter: 3500,
					stack: 6
				});
			} else {
				$.toast({
					heading: 'สำเร็จ',
					text: returnData.msg,
					position: 'top-right',
					icon: 'error',
					hideAfter: 3500,
					stack: 6
				});
			}
		});
	}
</script>