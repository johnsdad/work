	<?php 
// echo '<pre>';
// print_r($works);
$type1 = 0;
$type2 = 0;
$type3 = 0;
foreach ($works as $work) { $work->input_type==1?$type1++:($work->input_type==2?$type2++:($work->input_type==3?$type3++:'')); }
$t = $this->session->userdata('valid_session')['type'];
$uarl = $t == 1 ? 'admin' : ($t == 2 ? 'manager' : ($t == 3 ? 'leader' : '')); 
?>
	<?php if($type1) { ?>
	<div class="mt-3 mb-1 h4 text-center"> Work Type 1</div>

	<table class="table table-bordered" id="dataTable">
		<thead>
			<tr>
				<th>#</th>
				<th>Work Date</th>
				<th>Activity</th>
				<th>Duration</th>
				<?php if($this->session->userdata('valid_session')['type'] != 4){ ?><th>Agent</th><?php } ?>
				<th>Approved By</th>
			</tr>
		</thead>
		<tbody>
		<?php $minutes=0; $i=1; foreach ($works as $work) { ?>
			<?php if($work->input_type == 1) { ?>
			<tr>
				<td><?=$i++?></td>
				<td data-order="<?=date('ymd', strtotime($work->date))?>"><?=date('jS, M Y', strtotime($work->date))?></td>
				<td><?=$work->activity?></td>
				<td><?=sprintf("%02d", $work->hours)?> : <?=sprintf("%02d", $work->minutes)?> Hrs.</td>
				<?php if($this->session->userdata('valid_session')['type'] != 4){ ?>
					<td><a href="<?=$uarl?>/user_work/<?=$work->user_id?>"><?=$work->agent_name?></a></td>
				<?php } ?>
				<td><?=$work->approved_through?></td>
			</tr>
			<?php  $minutes += ($work->hours*60) + $work->minutes; ?>
			<?php } ?>
		<?php } ?>
		</tbody>	
		<tfoot>
			<tr>
				<th colspan="3">Total Time:</th>
				<th>
					<?=floor($minutes / 60)?> : <?= sprintf("%02d", $minutes%60); ?> Hrs.									
				</th>
				<?php if($this->session->userdata('valid_session')['type'] != 4){ ?><th></th><?php } ?>
				<th></th>
			</tr>
		</tfoot>	
	</table>

		<?php 
			$est_minute = $project->estimate*60;
			$cls = $minutes>$est_minute?"danger":($minutes == $est_minute?"warning":"success");
			$cont = '<span class="text-'. $cls.'">'; 
			$cont .= $minutes>$est_minute?floor(($minutes-$est_minute)/ 60).":".sprintf("%02d",($minutes-$est_minute)% 60)." Extra":($minutes == $est_minute?"00:00 Remaining": floor(($est_minute-$minutes)/ 60).":".sprintf("%02d",($est_minute-$minutes)% 60)." Remaining");
			$cont .= '</span>';
		?>
		<script type="text/javascript">
			$(document).ready(function() { 
		 	  	cal = '<?=floor($minutes / 60)?>:<?=sprintf("%02d", $minutes%60)?> Hrs. | <?=$cont?>';
		    	$("#t_time").html(cal);
		    });
		</script>
		
	<?php } ?>

	<?php if($type2) { ?>
	<hr>
	<div class="border mt-2 p-2">
	    <div class="row form-group">
	      	<div class="col-sm-3">
	        	<label class="control-label text-middle h3" >Activity Filter:</label>
	      	</div>
	        <div class="col-sm-9">
	          <select class="form-control" onchange="filter_project_work_type2(<?=$project->id?>, this.value, '<?=$startdate?>', '<?=$enddate?>')">
	          	<option value=""> - All - </option>
	          	<?php foreach ($this->config->item('input2') as $key => $activity) { ?>
	          	<option value="<?=$key?>"> <?=$activity?> </option>
	          <?php } ?>
	          </select>
	        </div>
	    </div>
	</div>

	<table class="table table-bordered" id="dataTable2">
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
				<td><?=$i++?></td>
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
				<?php if($this->session->userdata('valid_session')['type'] != 4){ ?><th></th><?php } ?>
				<th></th>
			</tr>
		</tfoot>	
	</table>
	<?php } ?>

	<?php if($type3) { ?>
	<hr>
	<!-- <div class="border mt-2 p-2">
	    <div class="row form-group">
	      	<div class="col-sm-3">
	        	<label class="control-label text-middle h3" >Activity Filter:</label>
	      	</div>
	        <div class="col-sm-9">
	          <select class="form-control" onchange="filter_project_work_type3(<?=$project->id?>, this.value)">
	          	<option value=""> - All - </option>
	          	<option value="content"> Content write </option>
	          	<option value="proof"> Proof read </option>
	          </select>
	        </div>
	    </div>
	</div> -->
	<div class="row form-group ml-2"> 
		<button class="btn btn-sm btn-dark p-2 mr-3" onclick="filter_project_work_type3(<?=$project->id?>, '', '<?=$startdate?>', '<?=$enddate?>')"> All </button> 
		<button class="btn btn-sm btn-dark p-2 mr-3 ml-3" onclick="filter_project_work_type3(<?=$project->id?>, 'content', '<?=$startdate?>', '<?=$enddate?>')">Content</button> 
		<button class="btn btn-sm btn-dark ml-3 p-2" onclick="filter_project_work_type3(<?=$project->id?>, 'proof', '<?=$startdate?>', '<?=$enddate?>')">Proof Read</button> 
	</div>
	<table class="mt-3 table table-bordered" id="dataTable3">
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
			<tr>
				<td><?=$i++?></td>
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
		</tbody>	
		<tfoot>
			<tr>
				<th colspan="3">Total Words:</th>
				<th></th>
				<th>
					<?=$words?>					
				</th>
				<?php if($this->session->userdata('valid_session')['type'] != 4){ ?><th></th><?php } ?>
				<th></th>
				<th></th>
			</tr>
		</tfoot>
	</table>
	<?php } ?>