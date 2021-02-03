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
              Users
              <a href="admin/add_user" class="mt-0 btn btn-sm btn-dark float-right"><i class="fa fa-plus"></i></a>
            </div>

            <div class="card-body">
              <div class="table-responsive">
               
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>User ID</th>
                      <th>Name</th>
                      <th>Department</th>
                      <th>Position</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>User ID</th>
                      <th>Name</th>
                      <th>Department</th>
                      <th>Position</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach ($users as $user) { ?>
            
                    <tr>
                      <td><a href="admin/user_work/<?=$user->id?>"><?=$user->user_id?></a></td>
                      <td><?=$user->name?></td>
                      <td><?=$user->department_name?$user->department_name:'---'?></td>
                      <td><?=$user->type==4?'Agent':($user->type==3?'Team Leader':($user->type==2?'Manager':'Unknown'))?></td>
                      <td><?=$user->email?></td>
                      <td>
                        <a onclick="change_status(<?=$user->id?>)" class="btn">
                          <div id="<?=$user->id?>">
                            <span class="badge badge-<?=$user->status?'success':'warning'?>">
                            <?=$user->status?'Active':'Inactive'?>
                            </span>
                          </div>
                        </a>
                      </td>
                      <td>
                        <a href="admin/edit_user/<?=$user->id?>"><i class="fa fa-edit text-secondary "></i></a>
                        <a onclick="view_user(<?=$user->id?>)"><i class="fa fa-eye text-dark p-1"></i> </a>
                        <a onclick="disable_user(<?=$user->id?>)"><i class="fa fa-ban text-danger "></i> </a>
                      </td>
                    </tr>
                    
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


          <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-gradient-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">User Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body" id="usermodalBody">

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
        url: 'admin/user_status/' + id,
        type: 'POST',
        success: function (response) {
            $("#"+id).html(response);
        }
    })
  }

  function view_user(id) {
    $.ajax({
        url: 'admin/show_user/' + id,
        type: 'POST',
        success: function (response) {
            $("#usermodalBody").html(response);
            $('#userModal').modal('show');
        }
    })
  }

  function disable_user(user_id) {
    $.confirm({
        title: 'Confirm!',
        content: 'Sure you want to Disable Permanently!',
        buttons: {
          disable: {
            btnClass: 'btn-danger',
            action: function () {
              $.ajax({
                  url: 'admin/disable_user/' + user_id,
                  type: 'POST',
                  success: function (response) {
                      $("#dataTable").load(location.href + " #dataTable>*", "");
                  }
              });
            }
          },
          cancel: function () {
          }
        }
    });
  }
</script>
</html>
