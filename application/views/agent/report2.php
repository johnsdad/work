<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?=base_url()?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Agent Dashboard</title>

  <?php $this->load->view('inc/css'); ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('agent/inc/side_bar'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php $this->load->view('agent/inc/top_header'); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php $this->load->view('inc/alert'); ?>

          <div class="card shadow mb-4">
            <div class="card-header py-3 m-0 h4 font-weight-bold text-dark">
              Projects Reports         
            </div>

            <div class="card-body">
               <select class="form-control" onchange="load_form(this.value)">
                 <option value=""> - Select Project - </option>
                 <?php foreach($projects as $project){ ?>
                  <option value="<?=$project->id?>"> <?=$project->name?> </option>
                 <?php } ?>
               </select>

               <div id="form_div" class="mb-5"> </div>

              <?php if($inputs){ ?>
             
              <table class="table table-bordered pt-5" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Work Date</th>
                      <th>Project</th>
                      <th>Activity</th>
                      <th>Amount No.</th>
                      <th>Status</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Work Date</th>
                      <th>Project</th>
                      <th>Activity</th>
                      <th>Amount No.</th>
                      <th>Status</th>
                      <th>#</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php foreach ($inputs as $input) { ?>
            
                   <tr>
                      <td><?=date('jS, M Y', strtotime($input->date))?></td>
                      <td><a href="agent/my_project_work/<?=$input->project_id?>"><?=$input->project_name?></a></td>
                      <td><?=$input->activity?></td>
                      <td><?=$input->numbers?></td>
                      <td><span class="badge badge-warning">Pending</span></td>
                      <td>
                        <a onclick="edit_input(<?=$input->id?>)"><i class="fa fa-edit"></i></a>
                        <a onclick="delete_input(<?=$input->id?>)"><i class="fa fa-trash pl-2"></i></a>
                      </td>
                    </tr>
                    
                  <?php } ?>
                  </tbody>
                </table>
              <?php } ?>
            </div>
          </div>

          <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-gradient-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
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
      <?php $this->load->view('agent/inc/footer'); ?>
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
  function load_form(project_id) {
    if(project_id) {
      $.ajax({
          url: 'agent/get_input_form',
          type: 'POST',
          data: ({project_id: project_id}),
          success: function (response) {
              $("#form_div").html(response);
          }
        })
    } else {
      $("#form_div").html('');
    }
  }

  function edit_input(input_id) {
    $.ajax({
      url: 'agent/get_edit_input_form/'+input_id,
      type: 'POST',
      success: function (response) {
          $("#inputBody").html(response);
          $("#inputModal").modal('show');
      }
    })
  }

  function delete_input(input_id) {
    $.confirm({
        title: 'Confirm!',
        content: 'Sure you want to delete!',
        buttons: {
          delete: {
            btnClass: 'btn-danger',
            action: function () {
              $.ajax({
                  url: 'agent/delete_input/' + input_id,
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

</body>
</html>
