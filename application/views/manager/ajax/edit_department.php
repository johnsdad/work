 <form action="manager/departments" method="post">
  <input type="hidden" name="id" value="<?=$department->id?>" required>
  <div class="form-group">
    <label class="control-label col-sm-5" for="psd0">Department Name:</label>
    <div class="col-sm-12">
      <input type="text" class="form-control" id="psd0" name="department" value="<?=$department->name?>" placeholder="Enter Here" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="ps">Estimate Time:</label>
    <div class="col-sm-12">
      <input type="number" class="form-control" id="ps" name="estimate" value="<?=$project->estimate?>" placeholder="Enter Here (Optional) .hrs">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="psd0">Input Type:</label>
    <div class="col-sm-12">
      <select class="form-control" name="type" required>
        <?php foreach ($this->config->item('inputs') as $key => $msg) { ?>
          <option value="<?=$key?>" <?=$key==$department->input_type?'selected':''?> > <?=$msg?> </option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-12">
      <button type="reset" class="btn btn-danger" >Clear</button>
      <button type="submit" class="btn btn-success float-right" name="addDepartment" value="addDepartment">Update</button>
    </div>
  </div>
</form>