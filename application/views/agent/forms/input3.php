<form action="agent/save_input3" method="post"> 
<input type="hidden" name="project_id" value="<?=$project_id?>" required>
<input type="hidden" name="input_type" value="3" required> 
  <div class="border p-3 mt-2">
    <div class="row form-group">
      <div class="col-sm-3">
        <label class="control-label" >Work Date :</label>
        	<input type="date" name="date" class="form-control" value="<?=date('Y-m-d')?>" required>
        	<small class="text-warning">Date should be max 7 days old.</small>
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
      </div>
      <div class="col-sm-12 row">
        <div class="col-sm-2">
            <label class="control-label text-dark text-strong" >
              <input type="checkbox" id="is_content" onchange="expend('is_content', 'cont1')"> Is Content?
            </label>
        </div>
        <div class="col-sm-10">
            <div id="cont1"></div>
        </div>
        <div class="col-sm-12">
          <input type="submit" name="input3" value="Submit" class="btn btn-success float-right">
        </div>
      </div>
    </div>
  </div>
</form>

<form action="agent/save_input3" method="post"> 
<input type="hidden" name="project_id" value="<?=$project_id?>" required>
<input type="hidden" name="input_type" value="3" required> 
  <div class="border p-3 mt-2">
    <div class="row form-group">
      <div class="col-sm-3">
        <label class="control-label" >Work Date :</label>
          <input type="date" name="date" class="form-control" value="<?=date('Y-m-d')?>" required>
          <small class="text-warning">Date should be max 7 days old.</small>
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
      </div>      
    </div>
    <div class="col-sm-12 row">
        <div class="col-sm-2">
            <label class="control-label text-dark text-strong" >
              <input type="checkbox" id="is_content2" onchange="expend('is_content2', 'cont2')"> Is Content?
            </label>
        </div>
        <div class="col-sm-10">
            <div id="cont2"></div>
        </div>
        <div class="col-sm-12">
          <input type="submit" name="input3" value="Submit" class="btn btn-success float-right mt-3">
        </div>
      </div>
  </div>
</form>

<script type="text/javascript">
  function expend(id, ex_id) {
      val1 = '<textarea name="content" id="content_new" required></textarea>';
      val2 = '<textarea name="content" id="content_new2" required></textarea>';
      if(ex_id == 'cont2') {
        val = val2;
      } else {
        val = val1;
      }
      
      if($('#' + id).is(":checked")) {   
          $("#" + ex_id).html(val);
          CKEDITOR.replace('content_new');
          CKEDITOR.replace('content_new2');
      } else {
          $("#" + ex_id).html('');
      }
  }
</script>