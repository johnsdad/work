<table class="table border">
	<tr>
		<th>Project Name:</th>
		<td><?=ucwords($input->project_name)?></td>
		<th>Agent Name:</th>
		<td><?=ucwords($input->agent_name)?></td>
	</tr>
	<tr>
		<th>Work Date:</th>
		<td><?=date('jS, M Y', strtotime($input->date))?></td>
		<th>Submitted On:</th>
		<td><?=date('jS, M Y H:i:s', strtotime($input->created))?></td>
	</tr>
	<tr>
		<th>Activity :</th>
		<td colspan="2"><?=$input->activity?></td>	
		<td><?=$input->numbers?></td>	
	</tr>
	<?php if($input->content) { ?>
		<tr>
			<td colspan="4"><?=$input->content?></td>
		</tr>
	<?php } ?>
	<tr>
		<th>Action :</th>
		<td>
			<button class="btn btn-sm btn-success  ml-3" onclick="input_action(<?=$input->id?>, 2)">
              <i class="fa fa-check-square"></i> Approve
            </button>
            <button class="btn btn-sm btn-danger ml-5" onclick="input_action(<?=$input->id?>, 0)">
              <i class="fa fa-window-close"></i> Disapprove
            </button>		
		</td>	
		<th>Proof Read By:</th>
		<td><?=$input->proof_name?></td>	
	</tr>
</table>