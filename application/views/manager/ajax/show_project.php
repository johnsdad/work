<table class="mt-3 mb-3 table border">
	<tr>
		<th>Project ID:</th>
		<td><?=$project->project_id?></td>
		<th>Project Name:</th>
		<td><?=ucwords($project->name)?></td>
	</tr>
	<tr>
		<th>Start On:</th>
		<td><?=date('jS, M Y', strtotime($project->created))?></td>
		<th>Closed On:</th>
		<td><?php if($project->status==2) { ?><?=date('jS, M Y H:i:s', strtotime($project->modified))?> <?php } ?></td>
	</tr>
	<tr>
		<th>Assign Departments :</th>
		<td>
              <?=$this->viewer->get_department($project->departments)?> <br>
		</td>	
		<th>Added By:</th>
		<td><?=ucwords($project->added_name)?></td>
	</tr>
	<tr>
		<th>Status :</th>
		<td>
			<span class="badge badge-<?=$project->status==1?'info':($project->status==2?'success':($project->status==0?'warning':''))?>">
			<?=$project->status==1?'Running':($project->status==2?'Closed':($project->status==0?'Onhold':''))?>
			</span>	
		</td>
		<th></th>	
		<td></td>	
	</tr>
</table>