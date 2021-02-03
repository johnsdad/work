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
                 <?php foreach($departments as $department){ ?>
                   <?php if($this->session->userdata('valid_session')['department'] == $department->id ) { ?>
                   <a href="leader/department_works/<?=$department->id?>">
                     <div class="col-xl-3 col-md-3 mb-4">
                      <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?=ucwords($department->name)?></div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                              <a href="leader/department_works/<?=$department->id?>">
                                <i class="fas fa-eye fa-2x text-gray-300"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> 
                    </a>
                   <?php } ?>
                   <?php if($this->session->userdata('valid_session')['department'] == 2 && $department->id == 3) { ?>
                    <a href="leader/department_works/<?=$department->id?>">
                     <div class="col-xl-3 col-md-3 mb-4">
                      <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?=ucwords($department->name)?></div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                              <a href="leader/department_works/<?=$department->id?>">
                                <i class="fas fa-eye fa-2x text-gray-300"></i>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                     </div> 
                    </a>
                   <?php } ?>                  
                 <?php } ?>                  
              </div>
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

</script>

</body>
</html>
