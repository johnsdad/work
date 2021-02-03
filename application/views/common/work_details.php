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

<table class="mt-3 mb-3 table border">
	<tr>
		<th>Project ID:</th>
		<td><?=ucwords($project->project_id)?></td>
		<th>Project Name:</th>
		<td><?=ucwords($project->name)?></td>
	</tr>
	<tr>
		<th>Start On:</th>
		<td><?=date('jS, M Y', strtotime($project->created))?></td>
		<th>Closed On:</th>
		<td><?php if($project->status==2) { ?><?=date('jS, M Y H:i:s', strtotime($project->modified))?> <?php } ?></td>
	</tr>

	<?php if($project->estimate){ ?>
	<tr>
		<th>Estimated Time:</th>
		<td><?=sprintf("%02d", $project->estimate)?>:00 hrs</td>
		<th>Taking:</th>
		<td id="t_time"></td>
	</tr>
	<?php } ?>

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
	<div class="border p-3 mt-3">
        <div class="row">
          
          <div class="col-sm-6">
            <div class="row form-group align-middle">
              <div class="col-sm-4">
                <label class="control-label" >From Work Date :</label>
                  <input type="date" name="fromdate" id="fromdate" class="form-control input-sm" value="<?=date('Y-m-d', strtotime($project->created))?>" required>                
              </div>
              <div class="col-sm-4 align-middle">
                <label class="control-label" >To Work Date :</label>
                  <input type="date" name="todate" id="todate" class="form-control input-sm" value="<?=date('Y-m-d')?>" required>
                  
              </div>
              <div class="col-sm-4 align-bottom">
                <button class="btn btn-success" onclick="date_filter(<?=$project->id?>, $('#fromdate').val(), $('#todate').val())"> Show</button>
              </div>
            </div>
          </div>
          <div class="col-sm-3 align-middle">
            <button class="btn btn-success align-middle" onclick="date_filter(<?=$project->id?>, '<?=date('Y-m-d', strtotime('-7 days'))?>', '<?=date('Y-m-d')?>')"> Previous 7 days</button>
          </div>
          <div class="col-sm-3 align-middles">
            <button class="btn btn-success" onclick="date_filter(<?=$project->id?>, '<?=date('Y-m-d', strtotime('-30 days'))?>', '<?=date('Y-m-d')?>')"> Previous 30 days</button>
          </div>

        </div>
    </div>


<div id="flcontent">
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

</div>

        <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header bg-gradient-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body" id="showBody">

              </div>
            </div>
          </div>
        </div>

<script type="text/javascript">
	function view_links(id) {
		$.ajax({
	        url: 'common/show_links/' + id,
	        type: 'POST',
	        success: function (response) {
	            $("#showBody").html(response);
	            $("#showModal").modal('show');
	        }
	    })
	}

	function view_content(id) {
		$.ajax({
	        url: 'common/show_content/' + id,
	        type: 'POST',
	        success: function (response) {
	            $("#showBody").html(response);
	            $("#showModal").modal('show');
	        }
	    })
	}

	function date_filter(project_id, startdate, enddate) {
		$.ajax({
	        url: 'common/project_work_range/'+project_id+'/'+startdate+'/'+enddate,
	        type: 'POST',
	        success: function (response) {
	            $("#flcontent").html(response);
	        	$('#dataTable').DataTable( {
	                dom: 'Bfrtip',
	                buttons: [
                    	'copy', 'csv', 'excel', 'pdf', 'print'
                	]
	            });
	            $('#dataTable1').DataTable( {
	                dom: 'Bfrtip',
	                buttons: [
	                    'copy', 'csv', 'excel', 'pdf', 'print'
	                ]
	            });
	            $('#dataTable2').DataTable( {
	                dom: 'Bfrtip',
	                buttons: [
	                    'copy', 'csv', 'excel', 'pdf', 'print'
	                ]
	            });
	            $('#dataTable3').DataTable( {
	                dom: 'Bfrtip',
	                buttons: [
	                    'copy', 'csv', 'excel', 'pdf', 'print'
	                ]
	            });
	        }
	    });
	}

	function filter_project_work_type2(project_id, activity, startdate, enddate) {
		$.ajax({
	        url: 'common/project_work_type2',
	        type: 'POST',
	        data: ({project_id : project_id, activity : activity, startdate : startdate, enddate : enddate}),
	        success: function (response) {
	            $("#dataTable2").html(response);
	        }
	    })
	}

	function filter_project_work_type3(project_id, activity, startdate, enddate) {
		$.ajax({
	        url: 'common/project_work_type3',
	        type: 'POST',
	        data: ({project_id : project_id, activity : activity, startdate : startdate, enddate : enddate}),
	        success: function (response) {
	            $("#dataTable3").html(response);	            
	        }
	    })
	}
</script>