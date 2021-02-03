<?php $actn = $this->session->userdata('valid_session')['type']==1?'admin':($this->session->userdata('valid_session')['type']==2?'manager':($this->session->userdata('valid_session')['type']==3?'leader':($this->session->userdata('valid_session')['type']==4?'agent':'logout'))); ?>
<form action="<?=$actn?>/update_input" method="post"> 
<input type="hidden" name="id" value="<?=$input->id?>" required> 
  <div class="border p-3 mt-2">
    <div class="row form-group">
      <div class="col-sm-6">
        <label class="control-label" >Activity :</label>
        <div class="col-sm-12">
          <textarea name="data[activity]" class="form-control" required><?=$input->activity?></textarea>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="row form-group">
          <div class="col-sm-6">
            <label class="control-label" >Hours:</label>
            <input type="range" class="form-control-range" min="0" max="10" id="hours" value="<?=$input->hours?>" name="data[hours]">
            <div id="hrs"></div>
          </div>
          <div class="col-sm-6">
            <label class="control-label" >Minute:</label>
            <input type="range" class="form-control-range" min="0" max="59" id="minutes" value="<?=$input->minutes?>" name="data[minutes]">
            <div id="mnts"></div>
          </div>
        </div>   
      <input type="submit" name="input" value="Update" class="btn btn-success float-right">
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
