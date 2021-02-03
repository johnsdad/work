	<?php
		$t = $this->session->userdata('valid_session')['type'];
		$uarl = $t == 1 ? 'admin' : ($t == 2 ? 'manager' : ($t == 3 ? 'leader' : '')); 
	?>
	<thead>
		<tr>
			<th>#</th>
			<th>Work Dates</th>
			<th>Project Name</th>
			<th>Activity</th>
			<th>Count</th>
			<!-- <th>Approved By</th> -->
			<th>#</th>
		</tr>
	</thead>
	<?php $num=0; $i=1; foreach ($inputs as $work) { ?>
		<?php if($work->input_type == 2) { ?>

				<?php if($work->activity == $activity) { ?>
				<tr>
					<td><?=$i++;?></td>
					<td><?=date('jS, M Y', strtotime($work->date))?></td>
					<td><a href="<?=$uarl?>/project_details/<?=$work->project_id?>"><?=$work->project_name?></a></td>
					<td><?=$work->activity?></td>
					<td><?=$work->numbers?></td>
					<!-- <td><?=$work->approved_through?></td> -->
					<td>
						<?php if($work->links != null) { ?>
							<button class="btn btn-sm btn-dark" onclick="view_links(<?=$work->id?>)">
								<i class="fa fa-eye"></i>
							</button>
						<?php } ?>
					</td>
				</tr>
				<?php $num += $work->numbers; ?>
				<?php } ?>

				<?php if($activity == '') { ?>
				<tr>
					<td><?=$i++;?></td>
					<td><?=date('jS, M Y', strtotime($work->date))?></td>
					<td><a href="<?=$uarl?>/project_details/<?=$work->project_id?>"><?=$work->project_name?></a></td>
					<td><?=$work->activity?></td>
					<td><?=$work->numbers?></td>
					<!-- <td><?=$work->approved_through?></td> -->
					<td>
						<?php if($work->links != null) { ?>
							<button class="btn btn-sm btn-dark" onclick="view_links(<?=$work->id?>)">
								<i class="fa fa-eye"></i>
							</button>
						<?php } ?>
					</td>
				</tr>
				<?php $num += $work->numbers; ?>
				<?php } ?>

		<?php } ?>
	<?php } ?>
	<tfoot>
		<tr>
			<th colspan="3">Total Count:</th>
			<th>
				<?=$num?>					
			</th>
			<th></th>
		</tr>	
	</tfoot>