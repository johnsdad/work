<form action="leader/save_input2" method="post"> 
<input type="hidden" name="project_id" value="<?=$project_id?>" required> 
<input type="hidden" name="input_type" value="2" required> 
  <div class="border p-3 mt-2">
    <div class="row form-group">
      <div class="col-sm-4">
        <label class="control-label" >Work Date :</label>
        	<input type="date" name="date" class="form-control" value="<?=date('Y-m-d')?>" required>
        	<small class="text-warning">Date should be between today to previous 7 days.</small>
      </div>
      <div class="col-sm-4">
        <label class="control-label" >Activity :</label>
        	<select name="activity" class="form-control" required>
        		<option value=""> - Select Activity- </option>
            <?php foreach ($this->config->item('input2') as $key => $activity) { ?>
          		<option value="<?=$key?>"> <?=$activity?> </option>
          	<?php } ?>
        	</select>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
            <label class="control-label" >Amount Numbers:</label>
            <input type="number" class="form-control"  id="numbers" name="numbers">   
        </div>   
      </div>  
    </div>
     <div class="form-group row">
          <label class="control-label col-sm-1" >Links:</label>
          <div class="col-sm-11">              
            <textarea class="form-control" name="links"></textarea> 
            <small class="text-warning">Add Links with enter key saperated.</small>
            <input type="submit" name="input2" value="Submit" class="mt-2 btn btn-success float-right">
          </div>
      </div> 
  </div>
</form>
