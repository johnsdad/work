<form action="agent/save_input2" method="post"> 
<input type="hidden" name="id" value="<?=$input->id?>" required> 
  <div class="border p-3 mt-2">
    <div class="row form-group">
      <div class="col-sm-8">
        <label class="control-label" >Activity :</label>
        	<select name="data[activity]" class="form-control" required>
        		<option value=""> - Select Activity- </option>
          	<?php foreach ($this->config->item('input2') as $key => $activity) { ?>
              <option value="<?=$key?>" <?=$key===$input->activity?'selected':''?> > <?=$activity?> </option>
            <?php } ?>
        	</select>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
            <label class="control-label" >Amount Numbers:</label>
            <input type="number" class="form-control" value="<?=$input->numbers?>"  id="numbers" name="data[numbers]">   
        </div>   
      </div>
    </div>
    <div class="form-group row">
          <label class="control-label col-sm-2" >Links:</label>
          <div class="col-sm-10">              
            <textarea class="form-control" name="data[links]"><?=$input->links?></textarea> 
            <small class="text-warning">Add Links with enter key saperated.</small>
            <input type="submit" name="input2" value="Submit" class="mt-2 btn btn-success float-right">
          </div>
      </div> 
  </div>
</form>
