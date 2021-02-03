<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?=base_url()?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Manager - Dashboard</title>

  <?php $this->load->view('inc/css'); ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('manager/inc/side_bar'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php $this->load->view('manager/inc/top_header'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php $this->load->view('inc/alert'); ?>
         


          <!-- Page Heading -->
        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 m-0 h4 font-weight-bold text-dark">
              Add User Details
              <a href="manager/users" class="mt-0 btn btn-sm btn-dark float-right"><i class="fa fa-list"></i></a>
            </div>

            <div class="card-body">
              
              <form class="form-horizontal" method="post" action="manager/users">
                <div class="form-group row">
                  <label class="control-label col-sm-3" for="name">User Type:</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="type" onchange="selecttype(this.value)" required>
                      <option value=""> -Select Type- </option>
                      <!-- <option value="2">Manager</option> -->
                      <option value="3">Team Leader</option>
                      <option value="4">Agent</option>
                    </select>
                  </div>
                </div>

                <div id="fields"> </div>

                <div class="form-group row">
                  <label class="control-label col-sm-3" for="uid">User ID:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="uid" name="user_id" placeholder="Enter Here" maxlength="15">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-3" for="name">Name:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Here" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-3" for="eml">Email: <small class="text-info"></small></label>
                  <div class="col-sm-9">
                    <input type="email" class="form-control" id="eml" name="email" placeholder="Enter Here" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="control-label col-sm-3" for="psd">Password:</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="psd" name="password" minlength="6" placeholder="Enter Here (Min 6 Char)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-3" for="psd2">Re-Password:</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="psd2" name="re_password" minlength="6" placeholder="Enter Here (Min 6 Char)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="reset" class="btn btn-danger" >Clear</button>
                    <button type="submit" class="btn btn-success float-right" name="addUser" value="addUser">
                      <i class="fa fa-plus-square"></i> Add 
                    </button>
                  </div>
                </div>
              </form>

            </div>
          </div>

      </div>

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php $this->load->view('manager/inc/footer'); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



<?php $this->load->view('inc/js') ?>
<script type="text/javascript">
  function selecttype(type) {
    if(type == 2) {
      $('#fields').html('');
    } else if(type == ''){
      $('#fields').html('');
    }else{
      $.ajax({
        url: 'manager/add_user_fields',
        type: 'POST',
        data: ({type: type}),
        success: function (response) {
            $("#fields").html(response);
        }
      })      
    }
  }
</script>
</body>

</html>
