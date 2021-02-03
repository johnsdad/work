<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?=base_url()?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Divik Prakash">

  <title>Leader Dashboard</title>

  <?php $this->load->view('inc/css'); ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('leader/inc/side_bar'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php $this->load->view('leader/inc/top_header'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php $this->load->view('inc/alert'); ?>

          <div class="card shadow mb-4">
            <div class="card-header py-3 m-0 h4 font-weight-bold text-dark">
              Department Works         
            </div>

            <div class="card-body">
              <div class="row">                 
                   <div class="col-xl-3 col-md-3 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?=ucwords($department->name)?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-eye fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>                 
              </div>

              <div class="border p-3 mt-3">
                <div class="row">
                  <div class="col-sm-8">
                    <div class="row form-group align-middle">
                      <div class="col-sm-4">
                        <label class="control-label" >From Work Date :</label>
                          <input type="date" name="fromdate" id="fromdate" class="form-control input-sm" value="<?=date('Y-m-d')?>" required>                
                      </div>
                      <div class="col-sm-4 align-middle">
                        <label class="control-label" >To Work Date :</label>
                          <input type="date" name="todate" id="todate" class="form-control input-sm" value="<?=date('Y-m-d')?>" required>
                      </div>
                      <div class="col-sm-4 align-bottom">
                        <button class="btn btn-success" onclick="range_filter(<?=$department->id?> ,$('#fromdate').val(), $('#todate').val())"> Show</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-2">
                        <button class="btn btn-success" onclick="range_filter(<?=$department->id?> , '<?=date('Y-m-d', strtotime('-1 days'))?>', '<?=date('Y-m-d', strtotime('-1 days'))?>')"> Yesterday</button>
                  </div>
                  <div class="col-sm-2">
                        <button class="btn btn-success" onclick="range_filter(<?=$department->id?> , '<?=date('Y-m-d', strtotime('-7 days'))?>', '<?=date('Y-m-d')?>')"> Last 7 Days</button>
                  </div>
                </div>
              </div>


              <div id="cbody"> </div>

            </div>
          </div>
          
          <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-gradient-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">X</span>
                </button>
              </div>
              <div class="modal-body" id="inputBody">

              </div>
            </div>
          </div>
        </div>

        </div>

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php $this->load->view('leader/inc/footer'); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<?php $this->load->view('inc/js'); ?>
<script type="text/javascript">
$(document).ready(function() {
    $.ajax({
        url: 'common/department_works/<?=$department->id?>',
        type: 'POST',
        success: function (response) {
            $("#cbody").html(response);
        }
    })
  });

function range_filter(department, start_date, end_date) {
  $.ajax({
        url: 'common/department_works/'+department,
        type: 'POST',
        data: ({start_date : start_date, end_date : end_date}),
        success: function (response) {
            $("#cbody").html(response);
        }
    })
}
</script>

</body>
</html>
