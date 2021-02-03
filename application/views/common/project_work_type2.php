	<?php
		$t = $this->session->userdata('valid_session')['type'];
		$uarl = $t == 1 ? 'admin' : ($t == 2 ? 'manager' : ($t == 3 ? 'leader' : '')); 
	?>
<thead>
	<tr>
		<th>#</th>
		<th>Work Date</th>
		<?php if($this->session->userdata('valid_session')['type'] != 4){ ?><th>Agent</th><?php } ?>
		<th>Activity</th>
		<th>Amount</th>
		<th>Approved By</th>
		<th>#</th>
	</tr>
</thead>
<?php $num=0; $i=1; foreach ($works as $work) { ?>
	<?php if($work->input_type == 2) { ?>
	<tr>
		<td><?=$i++;?></td>
		<td data-order="<?=date('ymd', strtotime($work->date))?>"><?=date('jS, M Y', strtotime($work->date))?></td>
		<?php if($this->session->userdata('valid_session')['type'] != 4){ ?>
			<td><a href="<?=$uarl?>/user_work/<?=$work->user_id?>"><?=$work->agent_name?></a></td>
		<?php } ?>
		<td><?=$work->activity?></td>
		<td><?=$work->numbers?></td>
		<td><?=$work->approved_through?></td>
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
<tfoot>
	<tr>
		<th colspan="4">Total Count:</th>
		<th>
			<?=$num?>					
		</th>
		<th></th>
		<?php if($this->session->userdata('valid_session')['type'] != 4){ ?><th></th><?php } ?>
	</tr>
</tfoot>