<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?=base_url()?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

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

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Users</h1> -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 m-0 h4 font-weight-bold text-dark">
              Projects
              <a class="mt-0 btn btn-sm btn-dark float-right"  href="leader/projects">
                <i class="fa fa-running text-white pr-1"></i><i class="fa fa-list text-white"></i></a>
            </div>

            <div class="card-body">
              <div class="table-responsive">
               
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Assign Department</th>
                      <th>Status</th>
                      <th>Created</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Assign Department</th>
                      <th>Status</th>
                      <th>Created</th>
                      <th>#</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach ($projects as $project) { ?>
            
                    <tr>
                      <td><a href="leader/project_details/<?=$project->id?>"><?=$project->project_id?></a></td>
                      <td><?=$project->name?></td>
                      <td>
                          <?=$this->viewer->get_department($project->departments)?>
                      </td>
                      <td>
                            <span class="badge badge-dark">
                            Closed
                            </span>
                      </td>
                      <td><?=date('jS, M Y', strtotime($project->created))?></td>
                      <td>
                          <i class="fa fa-eye text-dark"></i>
                      </td>
                    </tr>
                    
                    <?php } ?>
                  </tbody>
                </table>
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
</body>
</html>
