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
                      <th>Date</th>
                      <th>Project</th>
                      <th>Hours</th>
                      <th>Minute</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Date</th>
                      <th>Project</th>
                      <th>Hours</th>
                      <th>Minute</th>
                      <th>Status</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php foreach ($projects as $input) { ?>
            
                   <tr>
                      <td><?=date('jS, M Y H:i:s', strtotime($input->created))?></td>
                      <td><?=$input->project_name?></td>
                      <td><?=$input->hours?></td>
                      <td><?=$input->minutes?></td>
                      <td><span class="badge badge-warning">Pending</span></td>
                    </tr>
                    
                  <?php } ?>
                  </tbody>
                </table>
              <?php } ?>
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
  function load_form(project_id) {
    if(project_id) {
      $.ajax({
          url: 'leader/get_input_form',
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
</script>

</body>
</html>
