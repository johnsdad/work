<div class="form-group row">
  <label class="control-label col-sm-3" for="name">Super Member:</label>
  <div class="col-sm-9">
    <select class="form-control" name="parent" required>
      <option value="">- Select Super - </option>
      <?php foreach ($parents as $parent) { ?>
      	<?php if($parent->status) { ?>
      		<option value="<?=$parent->id?>"><?=ucwords($parent->name)?></option>
      	<?php } ?>
      <?php } ?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label class="control-label col-sm-3" for="name">Department:</label>
  <div class="col-sm-9">
    <select class="form-control" name="department" required>
      <option value="">-Select Department-</option>
      <?php foreach ($departments as $department) { ?>
      	<?php if($department->status) { ?>
      		<option value="<?=$department->id?>"><?=ucwords($department->name)?></option>
      	<?php } ?>
      <?php } ?>
    </select>
  </div>
</div>