<form action="agent/save_input1" method="post"> 
<input type="hidden" name="project_id" value="<?=$project_id?>" required> 
<input type="hidden" name="input_type" value="1" required> 
  <div class="border p-3 mt-2">
    <div class="row form-group">
      <div class="col-sm-4">
        <label class="control-label" >Work Date :</label>
          <input type="date" name="date" class="form-control" value="<?=date('Y-m-d')?>" required>
          <small class="text-warning">Date should be between today to previous 7 days.</small>
      </div>
      <div class="col-sm-4">
        <label class="control-label" >Activity :</label>
        <div class="col-sm-12">
          <textarea name="activity" class="form-control" required></textarea>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="row form-group">
          <div class="col-sm-6">
            <label class="control-label" >Hours:</label>
            <input type="range" class="form-control-range" min="0" max="10" id="hours" name="hours">
            <div id="hrs"></div>
          </div>
          <div class="col-sm-6">
            <label class="control-label" >Minute:</label>
            <input type="range" class="form-control-range" min="0" max="59" id="minutes" name="minutes">
            <div id="mnts"></div>
          </div>
        </div>   
      <input type="submit" name="input1" value="Submit" class="btn btn-success float-right">
      </div>
    </div>
  </div>
</form>

<script>
  var slider1 = document.getElementById("hours");
  var output1 = document.getElementById("hrs");
  output1.innerHTML = slider1.value;
  slider1.oninput = function() {
    output1.innerHTML = this.value;
  }

  var slider2 = document.getElementById("minutes");
  var output2 = document.getElementById("mnts");
  output2.innerHTML = slider2.value;
  slider2.oninput = function() {
    output2.innerHTML = this.value;
  }
</script>
