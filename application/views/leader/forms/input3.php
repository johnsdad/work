<form action="leader/save_input3" method="post"> 
<input type="hidden" name="project_id" value="<?=$project_id?>" required>
<input type="hidden" name="input_type" value="3" required> 
  <div class="border p-3 mt-2">
    <div class="row form-group">
      <div class="col-sm-3">
        <label class="control-label" >Work Date :</label>
          <input type="date" name="date" class="form-control" value="<?=date('Y-m-d')?>" required>
          <small class="text-warning">Date should be between today to previous 7 days.</small>
      </div>
      <div class="col-sm-7">
        <label class="control-label" >Topic :</label>
          <input type="text" name="activity" class="form-control" required>
      </div>
      <div class="col-sm-2">
        <div class="form-group">
            <label class="control-label" >Word Counts:</label>
            <input type="number" class="form-control"  id="numbers" name="numbers" required>   
        </div>   
      <input type="submit" name="input3" value="Submit" class="btn btn-success float-right">
      </div>
    </div>
  </div>
</form>

<form action="leader/save_input3" method="post"> 
<input type="hidden" name="project_id" value="<?=$project_id?>" required>
<input type="hidden" name="input_type" value="3" required> 
  <div class="border p-3 mt-2">
    <div class="row form-group">
      <div class="col-sm-3">
        <label class="control-label" >Work Date :</label>
          <input type="date" name="date" class="form-control" value="<?=date('Y-m-d')?>" required>
          <small class="text-warning">Date should be between today to previous 7 days.</small>
      </div>
      <div class="col-sm-3">
        <label class="control-label" >Proof Read :</label>
          <select name="proofread" class="form-control" required>
              <option value="">- Select -</option>
              <?php foreach ($users as $user) { ?>
                <option value="<?=$user->id?>"><?=$user->name?></option>
              <?php } ?>
          </select>
      </div>
      <div class="col-sm-6">
        <label class="control-label" >Topic :</label>
          <input type="text" name="activity" class="form-control" required>
      <input type="submit" name="input3" value="Submit" class="btn btn-success float-right mt-3">
      </div>
    </div>
  </div>
</form>