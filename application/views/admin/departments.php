<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?=base_url()?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin Dashboard</title>

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
          <!-- <h1 class="h3 mb-2 text-gray-800">Users</h1> -->
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 m-0 h4 font-weight-bold text-dark">
              Departments
              <a class="mt-0 btn btn-sm btn-dark float-right"  onclick="$('#departmentModal').modal('show');">
                <i class="fa fa-plus text-white"></i></a>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach ($departments as $department) { ?>
            
                    <tr>
                      <td><?=$department->name?></td>
                      <td>
                        <a onclick="change_status(<?=$department->id?>)" class="btn">
                          <div id="<?=$department->id?>">
                            <span class="badge badge-<?=$department->status?'success':'warning'?>">
                            <?=$department->status?'Active':'Inactive'?>
                            </span>
                          </div>
                        </a>
                      </td>
                      <td>
                        <a onclick="edit_department(<?=$department->id?>)">
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
        <div class="modal fade" id="departmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-gradient-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Department</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body" id="departmentBody">

                <form action="admin/departments" method="post">
                  <div class="form-group">
                    <label class="control-label col-sm-5" for="psd0">Department Name:</label>
                    <div class="col-sm-12">
                      <input type="text" class="form-control" id="psd0" name="department" placeholder="Enter Here" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-5" for="psd0">Input Type:</label>
                    <div class="col-sm-12">
                      <select class="form-control" name="type" required>
                      <?php foreach ($this->config->item('inputs') as $key => $msg) { ?>
                        <option value="<?=$key?>"> <?=$msg?> </option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
            
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-12">
                      <button type="reset" class="btn btn-danger" >Clear</button>
                      <button type="submit" class="btn btn-success float-right" name="addDepartment" value="addDepartment">Add</button>
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



<?php $this->load->view('inc/js'); ?>
</body>
<script type="text/javascript">
  function change_status(id) {
    $.ajax({
        url: 'admin/department_status/' + id,
        type: 'POST',
        success: function (response) {
            $("#"+id).html(response);
        }
    })
  }

  function edit_department(id) {
    $.ajax({
        url: 'admin/edit_department/' + id,
        type: 'POST',
        success: function (response) {
            $("#departmentBody").html(response);
            $("#departmentModal").modal('show');
        }
    })
  }
</script>
</html>
