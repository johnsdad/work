<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?=base_url()?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - Dashboard</title>

  <?php $this->load->view('inc/css'); ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('admin/inc/side_bar'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php $this->load->view('admin/inc/top_header'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php $this->load->view('inc/alert'); ?>
         


          <!-- Page Heading -->
        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 m-0 h4 font-weight-bold text-dark">
              Edit User Details
              <a href="admin/users" class="mt-0 btn btn-sm btn-dark float-right"><i class="fa fa-list"></i></a>
            </div>

            <div class="card-body">
      <?php if($user){ ?>        
              <form class="form-horizontal" method="post" action="admin/update_user">
                <input type="hidden" name="id" value="<?=$user->id?>" required>
                <div class="form-group row">
                  <label class="control-label col-sm-3" for="uid">User ID:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="uid" name="user_id" value="<?=$user->user_id?>" placeholder="Enter Here">
                  </div>
                </div> 
                <div class="form-group row">
                  <label class="control-label col-sm-3" for="name">Name:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" value="<?=$user->name?>" placeholder="Enter Here" required>
                  </div>
                </div>                
                <div class="form-group row">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="reset" class="btn btn-danger" >Clear</button>
                    <button type="submit" class="btn btn-success float-right" name="updateUser" value="updateUser"> Update </button>
                  </div>
                </div>
              </form>
      <?php } else { ?>
              <div class="text text-info"><center><h3>No User Record Found.</h3></center></div>
      <?php } ?>
            </div>
          </div>

      </div>

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php $this->load->view('admin/inc/footer'); ?>
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
    }else{
      $.ajax({
        url: 'admin/add_user_fields',
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
