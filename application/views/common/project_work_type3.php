	<?php
		$t = $this->session->userdata('valid_session')['type'];
		$uarl = $t == 1 ? 'admin' : ($t == 2 ? 'manager' : ($t == 3 ? 'leader' : '')); 
	?>
	<thead>
		<tr>
			<th>#</th>
			<th>Work Date</th>
			<th>Activity</th>
			<th>Proof Read</th>
			<th>Word Count</th>
			<?php if($this->session->userdata('valid_session')['type'] != 4){ ?><th>Agent</th><?php } ?>
			<th>Approved By</th>
			<th>#</th>
		</tr>
	</thead>
	<tbody>
	<?php $words=0; $i=1; foreach ($works as $work) { ?>
		<?php if($work->input_type == 3) { ?>
			<?php if($activity == 'proof') {?>
				<?php if($work->proofread != null) {?>
				<tr>
					<td><?=$i++;?></td>
					<td data-order="<?=date('ymd', strtotime($work->date))?>"><?=date('jS, M Y', strtotime($work->date))?></td>
					<td><?=$work->activity?></td>
					<td><?=$work->proof_name?$work->proof_name:'---'?></td>
					<td><?=$work->numbers?$work->numbers:'---'?></td>
					<?php if($this->session->userdata('valid_session')['type'] != 4){ ?>
						<td><a href="<?=$uarl?>/user_work/<?=$work->user_id?>"><?=$work->agent_name?></a></td>
					<?php } ?>
					<td><?=$work->approved_through?></td>
					<td>				
						<?php if($work->content) { ?>
							<button class="btn btn-sm btn-dark" onclick="view_content(<?=$work->id?>)">
								<i class="fa fa-eye"></i>
							</button>
						<?php } ?>
					</td>
				</tr>
				<?php $words += $work->numbers; ?>
				<?php } ?>
			<?php } ?>
			<?php if($activity == 'content') {?>
				<?php if($work->proofread == null) {?>
				<tr>
					<td><?=$i++;?></td>
					<td data-order="<?=date('ymd', strtotime($work->date))?>"><?=date('jS, M Y', strtotime($work->date))?></td>
					<td><?=$work->activity?></td>
					<td><?=$work->proof_name?$work->proof_name:'---'?></td>
					<td><?=$work->numbers?$work->numbers:'---'?></td>
					<?php if($this->session->userdata('valid_session')['type'] != 4){ ?>
						<td><a href="<?=$uarl?>/user_work/<?=$work->user_id?>"><?=$work->agent_name?></a></td>
					<?php } ?>
					<td><?=$work->approved_through?></td>
					<td>				
						<?php if($work->content) { ?>
							<button class="btn btn-sm btn-dark" onclick="view_content(<?=$work->id?>)">
								<i class="fa fa-eye"></i>
							</button>
						<?php } ?>
					</td>
				</tr>
				<?php $words += $work->numbers; ?>
				<?php } ?>
			<?php } ?>
			<?php if($activity == '') {?>
				<tr>
					<td><?=$i++;?></td>
					<td data-order="<?=date('ymd', strtotime($work->date))?>"><?=date('jS, M Y', strtotime($work->date))?></td>
					<td><?=$work->activity?></td>
					<td><?=$work->proof_name?$work->proof_name:'---'?></td>
					<td><?=$work->numbers?$work->numbers:'---'?></td>
					<?php if($this->session->userdata('valid_session')['type'] != 4){ ?>
						<td><a href="<?=$uarl?>/user_work/<?=$work->user_id?>"><?=$work->agent_name?></a></td>
					<?php } ?>
					<td><?=$work->approved_through?></td>
					<td>				
						<?php if($work->content) { ?>
							<button class="btn btn-sm btn-dark" onclick="view_content(<?=$work->id?>)">
								<i class="fa fa-eye"></i>
							</button>
						<?php } ?>
					</td>
				</tr>
				<?php $words += $work->numbers; ?>
			<?php } ?>
		<?php } ?>
	<?php } ?>
	</tbody>	
	<tfoot>
		<tr>
			<th colspan="3">Total Words:</th>
			<th></th>
			<th>
				<?=$words?>					
			</th>
			<th></th>
			<?php if($this->session->userdata('valid_session')['type'] != 4){ ?><th></th><?php } ?>
			<th></th>
		</tr>
	</tfoot>