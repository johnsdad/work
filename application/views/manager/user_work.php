<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?=base_url()?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Manager Dashboard</title>

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
          <!-- <h1 class="h3 mb-2 text-gray-800">Users</h1> -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 m-0 h4 font-weight-bold text-dark">
              User Details Works              
            </div>

            <div class="card-body"> 
              <div class="container">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12 col-lg-8 col-md-6">
                            <h3 class="mb-0 text-truncated"><?=$user->name?></h3>
                            <p class="lead"><?=$user->user_id?></p>
                            <p class="lead">
                              <?=$user->type==4?'Agent':($user->type==3?'Team Leader':($user->type==2?'Manager':($user->type==1?'Admin':'Unknown')))?>
                            </p>
                            <p> 
                              <span class="badge badge-<?=$user->status==1?'success':'warning'?> tags"><?=$user->status==1?'Active':'Inactive'?></span> 
                            </p>
                          </div>
                          <div class="col-12 col-lg-4 col-md-6 text-center">
                            <img src="<?=$user->image?$user->image:'https://placebeard.it/100x100'?>" alt="<?=$user->name?>" class="mx-auto rounded-circle img-fluid">
                          </div>
                          <div class="col-12 col-lg-4">
                            <!-- <h3 class="mb-0"></h3> -->
                            <small>Department</small>
                            <button class="btn btn-block btn-outline-success"><?=$user->department_name?></button>
                          </div>
                          <div class="col-12 col-lg-4">
                            <!-- <h3 class="mb-0">245</h3> -->
                            <small>Super Member</small>
                            <button class="btn btn-outline-info btn-block"><span class="fa fa-user"></span> <?=$user->parent_name?></button>
                          </div>
                          <div class="col-12 col-lg-4">
                            <!-- <h3 class="mb-0">43</h3> -->
                            <small>Last Login</small>
                            <button type="button" class="btn btn-outline-primary btn-block"><span class="fa fa-gear"></span> 
                              <small><?=date('d-m-Y h:i:s', strtotime($user->last_login))?></small>
                            </button>
                          </div>
                          <!--/col-->
                        </div>
                        <!--/row-->
                      </div>
                      <!--/card-block-->
                    </div>
                  </div>
                </div>
              </div>

              <div class="border p-3 mt-3">
                <div class="row">
                  
                  <div class="col-sm-6 border-right">
                    <div class="row form-group align-middle">
                      <div class="col-sm-5">
                        <input type="date" name="fromdate" id="fromdate" class="form-control input-sm" value="<?=date('Y-m-d')?>" required><label class="control-label" >From Work Date :</label>
                      </div>
                      <div class="col-sm-5 align-middle">
                        <input type="date" name="todate" id="todate" class="form-control input-sm" value="<?=date('Y-m-d')?>" required>
                        <label class="control-label" >To Work Date :</label>                          
                      </div>
                      <div class="col-sm-2 align-bottom ">
                        <button class="btn btn-success btn-sm align-bottom float-left" onclick="show_date_work(<?=$user->id?>, $('#fromdate').val(), $('#todate').val())">Show</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-2 text-align-bottom">
                    <button class="btn btn-success btn-sm text-align-bottom" onclick="show_date_work(<?=$user->id?>, '<?=date('Y-m-d', strtotime('-1 days'))?>', '<?=date('Y-m-d', strtotime('-1 days'))?>')"> Previous Day</button>
                  </div>
                  <div class="col-sm-2 text-align-bottom">
                    <button class="btn btn-success btn-sm text-align-bottom" onclick="show_date_work(<?=$user->id?>, '<?=date('Y-m-d', strtotime('-7 days'))?>', '<?=date('Y-m-d')?>')"> Previous 7 Days</button>
                  </div>
                  <div class="col-sm-2">
                    <button class="btn btn-success btn-sm" onclick="show_date_work(<?=$user->id?>, '<?=date('Y-m-d', strtotime('-30 days'))?>', '<?=date('Y-m-d')?>')"> Previous 30 Days</button>
                  </div>

                </div>
              </div>

              <div id="body">
                
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
</div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<?php $this->load->view('inc/js'); ?>

<script type="text/javascript">
  $(document).ready(function() {
    $.ajax({
        url: 'common/user_work_details/<?=$user_id?>',
        type: 'POST',
        success: function (response) {
            $("#body").html(response);
            $('#dataTable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('#dataTable1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('#dataTable2').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('#dataTable3').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        }
    })
  });

  function show_date_work(user, from_date, to_date) {
      $.ajax({
        url: 'common/user_work_range_details/'+user+'/'+from_date+'/'+to_date,
        type: 'POST',
        success: function (response) {
          $("#body").html(response);
          $('#dataTable').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('#dataTable1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('#dataTable2').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
            $('#dataTable3').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        }
      })
    }
</script>

</body>
</html>
