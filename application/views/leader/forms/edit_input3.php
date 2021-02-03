<?php if($input->numbers) { ?>
<form action="leader/save_input3" method="post"> 
<input type="hidden" name="id" value="<?=$input->id?>" required> 
  <div class="border p-3 mt-2">
    <div class="row form-group">
      <div class="col-sm-8">
        <label class="control-label" >Topic :</label>
          <input type="text" name="data[activity]" class="form-control" value="<?=$input->activity?>" required>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
            <label class="control-label" >Word Counts:</label>
            <input type="number" class="form-control"  id="numbers" name="data[numbers]" value="<?=$input->numbers?>" required>   
        </div>   
      <input type="submit" name="input3" value="Submit" class="btn btn-success float-right">
      </div>
    </div>
  </div>
</form>
<?php } ?>

<?php if($input->proofread) { ?>
<form action="leader/save_input3" method="post"> 
<input type="hidden" name="id" value="<?=$input->id?>" required>  
  <div class="border p-3 mt-2">
    <div class="row form-group">
      <div class="col-sm-6">
        <label class="control-label" >Topic :</label>
          <input type="text" name="data[activity]" class="form-control" value="<?=$input->activity?>" required>
      <input type="submit" name="input3" value="Submit" class="btn btn-success float-right mt-3">
      </div>
    </div>
  </div>
</form>
<?php } ?>