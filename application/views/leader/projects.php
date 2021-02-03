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
              <a class="mt-0 btn btn-sm btn-dark float-right"  onclick="$('#projectModal').modal('show');">
                <i class="fa fa-plus text-white"></i>
              </a>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <button class="float-right btn btn-sm btn-primary ml-2" onclick="exportTableToExcel('dataTable', 'Projects')">
                    <i class="fa fa-download"></i> Excel Sheet</button>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Assign Departments</th>
                      <th>Start Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Assign Departments</th>
                      <th>Start Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $i=1; foreach ($projects as $project) { ?>
            
                    <tr>
                      <td><?=$i++?></td>
                      <td><a href="leader/project_details/<?=$project->id?>"><?=$project->project_id?></a></td>
                      <td><?=$project->name?></td>
                      <td>
                          <?=$this->viewer->get_department($project->departments)?> <br>
                      </td>
                      <td><?=date('jS, M Y', strtotime($project->created))?></td>
                      <td>
                          <div id="<?=$project->id?>">
                            <span class="badge badge-<?=$project->status?'success':'warning'?>">
                            <?=$project->status?'Active':'Onhold'?>
                            </span>
                          </div>
                      </td>
                      <td>
                        <button class="btn btn-sm btn-dark" onclick="show_project(<?=$project->id?>)">
                          <i class="fa fa-eye text-white"></i>
                        </button>
                        <a onclick="edit_project(<?=$project->id?>)" class="p-2">
                          <i class="fa fa-edit text-dark"></i>
                        </a>
                      </td>
                    </tr>
                    
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

      <!-- password Modal-->
        <div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-gradient-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Project</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">X</span>
                </button>
              </div>
              <div class="modal-body" id="projectsBody">

              <form action="leader/projects" method="post">
                  <div class="form-group">
                    <label class="control-label col-sm-5" for="psd0">Project Name:</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="psd0" name="project" placeholder="Enter Here" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-5" for="psd0">Estimate Time:</label>
                    <div class="col-sm-12">
                      <input type="number" class="form-control" id="psd0" name="estimate" placeholder="Enter Here (Optional) .hrs">
                    </div>
                  </div>
                  <?php if($this->session->userdata('valid_session')['type'] == 3 && $this->session->userdata('valid_session')['department'] == 2){ ?>
                    <div class="form-group">
                      <?php foreach ($departments as $key => $department) { ?>
                        <?php if($department->id == $this->session->userdata('valid_session')['department'] || $department->id == 3){ ?>
                          <div class="custom-control custom-switch">
                            <input type="radio" class="custom-control-input" id="switch<?=$key?>" name="departments" value="<?=$department->id?>" required>
                            <label class="custom-control-label" for="switch<?=$key?>"><?=ucwords($department->name)?></label>
                          </div>
                        <?php } ?>
                      <?php } ?>
                    </div>
                  <?php } ?>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-12">
                      <button type="reset" class="btn btn-danger" >Clear</button>
                      <button type="submit" class="btn btn-success float-right" name="addProject" value="addProject">Add</button>
                    </div>
                  </div>
                </form>

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
  function show_project(id) {
    $.ajax({
        url: 'leader/show_project/' + id,
        type: 'POST',
        success: function (response) {
            $("#projectsBody").html(response);
            $("#projectModal").modal('show');
        }
    })
  }

  function edit_project(id) {
    $.ajax({
        url: 'leader/edit_project/' + id,
        type: 'POST',
        success: function (response) {
            $("#projectsBody").html(response);
            $("#projectModal").modal('show');
        }
    })
  }
</script>

</body>
</html>
