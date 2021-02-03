	<?php
		$t = $this->session->userdata('valid_session')['type'];
		$uarl = $t == 1 ? 'admin' : ($t == 2 ? 'manager' : ($t == 3 ? 'leader' : '')); 
	?>
	<thead>
		<tr>
			<th>#</th>
			<th>Work Date</th>
			<th>Project Name</th>
			<th>Activity</th>
			<th>Word Count</th>
			<th>Proof Read</th>
			<!-- <th>Approved By</th> -->
		</tr>
	</thead>
	<tbody>
	<?php $words=0; $i=1; foreach ($inputs as $work) { ?>
		<?php if($work->input_type == 3) { ?>

			<?php if($activity == 'proof') {?>
				<?php if($work->proofread != null) {?>
					<tr>
						<td><?=$i++;?></td>
						<td><?=date('jS, M Y', strtotime($work->date))?></td>
						<td><a href="<?=$uarl?>/project_details/<?=$work->project_id?>"><?=$work->project_name?></a></td>
						<td><?=$work->activity?></td>
						<td><?=$work->numbers?$work->numbers:'---'?></td>
						<td><?=$work->proof_name?$work->proof_name:'---'?></td>
						<!-- <td><?=$work->approved_through?></td> -->
					</tr>
					<?php $words += $work->numbers; ?>
				<?php } ?>
			<?php } ?>
			<?php if($activity == 'content') {?>
				<?php if($work->proofread == null) {?>
					<tr>
						<td><?=$i++;?></td>
						<td><?=date('jS, M Y', strtotime($work->date))?></td>
						<td><a href="<?=$uarl?>/project_details/<?=$work->project_id?>"><?=$work->project_name?></a></td>
						<td><?=$work->activity?></td>
						<td><?=$work->numbers?$work->numbers:'---'?></td>
						<td><?=$work->proof_name?$work->proof_name:'---'?></td>
						<!-- <td><?=$work->approved_through?></td> -->
					</tr>
					<?php $words += $work->numbers; ?>
				<?php } ?>
			<?php } ?>
			<?php if($activity == '') {?>
				<tr>
					<td><?=$i++;?></td>
					<td><?=date('jS, M Y', strtotime($work->date))?></td>
					<td><a href="<?=$uarl?>/project_details/<?=$work->project_id?>"><?=$work->project_name?></a></td>
					<td><?=$work->activity?></td>
					<td><?=$work->numbers?$work->numbers:'---'?></td>
					<td><?=$work->proof_name?$work->proof_name:'---'?></td>
					<!-- <td><?=$work->approved_through?></td> -->
				</tr>
				<?php $words += $work->numbers; ?>
			<?php } ?>

		<?php } ?>
	<?php } ?>	
	</tbody>
	<tfoot>
		<tr>
			<th colspan="3">Total Words:</th>
			<th>
				<?=$words?>					
			</th>
			<th></th>
		</tr>
	</tfoot>	