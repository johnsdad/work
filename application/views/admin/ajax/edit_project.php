
<form action="admin/projects" method="post">
  <input type="hidden" name="id" value="<?=$project->id?>" required>
  <div class="form-group">
    <label class="control-label col-sm-5" for="psd0">Project Name:</label>
    <div class="col-sm-12">
      <input type="text" class="form-control" id="psd0" name="project" placeholder="Enter Here" value="<?=$project->name?>" required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="ps">Estimate Time:</label>
    <div class="col-sm-12">
      <input type="number" class="form-control" id="ps" name="estimate" value="<?=$project->estimate?>" placeholder="Enter Here (Optional) .hrs">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-5" for="psd0">Assign Departments:</label>
    <div class="col-sm-12">
      <?php foreach ($departments as $key => $department) { ?>
          <div class="custom-control custom-switch">
            <input type="radio" class="custom-control-input" id="switch<?=$key?>" name="departments" value="<?=$department->id?>" <?=$project->departments == $department->id ? 'checked' : ''?> >
            <label class="custom-control-label" for="switch<?=$key?>"><?=ucwords($department->name)?></label>
          </div>
      <?php } ?>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-12">
      <button type="reset" class="btn btn-danger" >Clear</button>
      <button type="submit" class="btn btn-success float-right" name="addProject" value="addProject">Update</button>
    </div>
  </div>
</form>