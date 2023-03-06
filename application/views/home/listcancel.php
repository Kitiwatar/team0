<!-- Create by : Kitiwat Arunwong 24/09/2565 -->
<div class="row py-0">
	<div class="col-12">
		<div class="card">
			<div class="card-body py-0">
				<div class="table-responsive">
					<table class="display table dt-responsive nowrap" id="tableCancel">
						<thead>
							<tr>
								<th class="text-center"><?= lang('tl_no.') ?></th>
								<th><?= lang('cause') ?></th>
								<th class="text-center"><?= lang('Amount') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php if (is_array($listcancel)) : $count = 1; ?>
								<?php date_default_timezone_set("Asia/Bangkok"); ?>
								<?php for ($i = 0; $i < 5; $i++) :
									if (isset($listcancel[$i]) && $listcancel[$i] > 0) { ?>
										<tr>
											<td class="text-center"><?= $count++ ?></td>
											<td><?= $listCancelName[$i] ?></td>
											<td class="text-center"><?= $listcancel[$i] ?></td>
										</tr>
									<?php } else { ?>
										<tr>
											<td class="text-center"><?= $count++ ?></td>
											<td class="text-center">-</td>
											<td class="text-center">-</td>
										</tr>
									<?php }?>
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
	$('#tableCancel').DataTable({
		"dom": 't',
		"order": [
			[2, "desc"]
		],
		"language": {
			"oPaginate": {
				"sPrevious": "<?= lang('b_project_previous') ?>",
				"sNext": "<?= lang('b_project_next') ?>"
			},
			"sInfo": "<?= lang('tl_project_pj-numbershow') ?> _START_ ถึง _END_ จาก _TOTAL_ <?= lang('tl_project_pj-list') ?>",
			"sInfoEmpty": "<?= lang('tl_project_pj-numbershow') ?> 0 ถึง 0 จาก 0 <?= lang('tl_project_pj-list') ?>",
			"sLengthMenu": "<?= lang('tl_project_pj-numbershow') ?> _MENU_ <?= lang('tl_project_pj-list') ?>",
			"sSearch": "<?= lang('in_project_search') ?> ",
			"sInfoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)",
			"sZeroRecords": "<?= lang('in_project_zerorecords') ?>"
		},
	});
</script>