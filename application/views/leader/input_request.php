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

          <div class="card shadow mb-4">
            <div class="card-header py-3 m-0 h4 font-weight-bold text-dark">
              Pending Requests         
            </div>
            <div class="card-body">
                <?php 
                // echo '<pre>';
                // print_r($works);
                $type1 = 0;
                $type2 = 0;
                $type3 = 0;
                foreach ($inputs as $work) { $work->input_type==1?$type1++:($work->input_type==2?$type2++:($work->input_type==3?$type3++:'')); } 
                ?>
              <?php if($type1){ ?>
              <table class="table table-bordered pt-5" id="dataTable1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Work Date</th>
                      <th>Submitted By</th>
                      <th>Project</th>
                      <th>Activity</th>
                      <th>Duration</th>
                      <th>Status</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Work Date</th>
                      <th>Submitted By</th>
                      <th>Project</th>
                      <th>Activity</th>
                      <th>Duration</th>
                      <th>Status</th>
                      <th>#</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php foreach ($inputs as $input) { ?>
                      <?php if($input->input_type == 1) { ?>
                       <tr>
                          <td><?=date('jS, M Y', strtotime($input->date))?></td>
                          <td><a href="leader/user_work/<?=$input->user_id?>"><?=$input->agent_name?></a></td>
                          <td><a href="leader/project_details/<?=$input->project_id?>"><?=$input->project_name?></a></td>
                          <td><?=$input->activity?></td>
                          <td><?=$input->hours.' : '.$input->minutes?></td>
                          <td><span class="badge badge-warning">Pending</span></td>
                          <td>
                            <!-- <a onclick="input_view(<?=$input->id?>)"><i class="fa fa-eye text-secondary p-2"></i></a> -->
                            <a onclick="input_edit(<?=$input->id?>)"><i class="fa fa-edit text-secondary p-2"></i></a>
                            <button class="btn btn-sm btn-success  ml-3" onclick="input_action(<?=$input->id?>, 2, 1)">
                              <i class="fa fa-check-square"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="input_action(<?=$input->id?>, 0, 1)">
                              <i class="fa fa-window-close"></i>
                            </button>
                          </td>
                        </tr>
                      <?php } ?>
                      <?php } ?>
                  </tbody>
                </table>
              <?php } ?>

              <?php if($type2){ ?>
              <div class="m-5"></div>
              <table class="table table-bordered pt-5 mt-3" id="dataTable2" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Work Date</th>
                      <th>Submitted By</th>
                      <th>Project</th>
                      <th>Activity</th>
                      <th>Numbers</th>
                      <th>Status</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Work Date</th>
                      <th>Submitted By</th>
                      <th>Project</th>
                      <th>Activity</th>
                      <th>Numbers</th>
                      <th>Status</th>
                      <th>#</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php foreach ($inputs as $input) { ?>
                      <?php if($input->input_type == 2) { ?>
                       <tr>
                          <td><?=date('jS, M Y', strtotime($input->date))?></td>
                          <td><a href="leader/user_work/<?=$input->user_id?>"><?=$input->agent_name?></a></td>
                          <td><a href="leader/project_details/<?=$input->project_id?>"><?=$input->project_name?></a></td>
                          <td><?=$input->activity?></td>
                          <td><?=$input->numbers?></td>
                          <td><span class="badge badge-warning">Pending</span></td>
                          <td>
                            <!-- <a onclick="input_view(<?=$input->id?>)"><i class="fa fa-eye text-secondary p-2"></i></a> -->
                            <a onclick="input_edit(<?=$input->id?>)"><i class="fa fa-edit text-secondary p-2"></i></a>
                            <button class="btn btn-sm btn-success  ml-3" onclick="input_action(<?=$input->id?>, 2, 2)">
                              <i class="fa fa-check-square"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="input_action(<?=$input->id?>, 0, 2)">
                              <i class="fa fa-window-close"></i>
                            </button>
                          </td>
                        </tr>
                      <?php } ?>
                      <?php } ?>
                  </tbody>
                </table>
              <?php } ?>

              <?php if($type3){ ?>
              <div class="m-5"></div>
              <table class="table table-bordered pt-5 mt-3" id="dataTable3" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Work Date</th>
                      <th>Submitted By</th>
                      <th>Project</th>
                      <th>Topic</th>
                      <th>Proof Read</th>
                      <th>Numbers</th>
                      <th>Status</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Work Date</th>
                      <th>Submitted By</th>
                      <th>Project</th>
                      <th>Topic</th>
                      <th>Proof Read</th>
                      <th>Numbers</th>
                      <th>Status</th>
                      <th>#</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      <?php foreach ($inputs as $input) { ?>
                      <?php if($input->input_type == 3) { ?>
                       <tr>
                          <td><?=date('jS, M Y', strtotime($input->date))?></td>
                          <td><a href="leader/user_work/<?=$input->user_id?>"><?=$input->agent_name?></a></td>
                          <td><a href="leader/project_details/<?=$input->project_id?>"><?=$input->project_name?></a></td>
                          <td><?=$input->activity?></td>
                          <td><?=$input->proof_name?$input->proof_name:'---'?></td>
                          <td><?=$input->numbers?$input->numbers:'---'?></td>
                          <td><span class="badge badge-warning">Pending</span></td>
                          <td>
                            <!-- <a onclick="input_view(<?=$input->id?>)"><i class="fa fa-eye text-secondary p-2"></i></a> -->
                            <a onclick="input_edit(<?=$input->id?>)"><i class="fa fa-edit text-secondary p-2"></i></a>
                            <button class="btn btn-sm btn-success  " onclick="input_action(<?=$input->id?>, 2, 3)">
                              <i class="fa fa-check-square"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="input_action(<?=$input->id?>, 0, 3)">
                              <i class="fa fa-window-close"></i>
                            </button>
                          </td>
                        </tr>
                      <?php } ?>
                      <?php } ?>
                  </tbody>
                </table>
              <?php } ?>


            </div>
          </div>

          <!-- modal -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header bg-gradient-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">User Request Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body" id="viewBody">

              </div>
            </div>
          </div>
        </div>
        <!-- modal close -->


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
  function input_view(input_id) {
    if(input_id) {
      $.ajax({
          url: 'leader/view_input/'+input_id,
          type: 'POST',
          success: function (response) {
              $("#viewBody").html(response);
              $("#viewModal").modal('show');
          }
        })
    } else {
      alert('Invalid Action');
    }
  }
  function input_edit(input_id) {
    if(input_id) {
      $.ajax({
          url: 'leader/edit_input/'+input_id,
          type: 'POST',
          success: function (response) {
              $("#viewBody").html(response);
              $("#viewModal").modal('show');
              CKEDITOR.replace('content_new');
          }
        })
    } else {
      alert('Invalid Action');
    }
  }
  function input_action(input_id , valu, idn){
    if(valu==0){
      $.confirm({
          title: 'Confirm!',
          content: 'Sure you want to unapprove!',
          buttons: {
            unapprove: {
              btnClass: 'btn-danger',
              action: function () {
                $.ajax({
                    url: 'leader/input_action/' + input_id  +'/' + valu,
                    type: 'POST',
                    success: function (response) {
                        $("#dataTable"+idn).load(location.href + " #dataTable"+idn+">*", "");
                        $("#viewModal").modal('hide');
                    }
                });
              }
            },
            cancel: function () {
            }
          }
      });
    }
    if(valu==2) {
      $.ajax({
          url: 'leader/input_action/' + input_id  +'/' + valu,
          type: 'POST',
          success: function (response) {
              $("#dataTable"+idn).load(location.href + " #dataTable"+idn+">*", "");
              $("#viewModal").modal('hide');
          }
      });
    }
    return;
  }
</script>

</body>
</html>
