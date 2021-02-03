<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?=base_url()?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Divik Prakash">

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

          <div class="card shadow mb-4">
            <div class="card-header py-3 m-0 h4 font-weight-bold text-dark">
              Project Works Report         
            </div>

            <div class="card-body">
               <select class="form-control" onchange="load_work(this.value)">
                 <option value=""> - Select Project - </option>
                 <?php foreach($projects as $project){ ?>
                  <option value="<?=$project->id?>"> <?=$project->name?> </option>
                 <?php } ?>
               </select>

               <div id="form_div" class="mb-5"> </div>

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
<script type="text/javascript">
  function load_work(project_id) {
    if(project_id) {
      $.ajax({
          url: 'common/project_works/'+project_id,
          type: 'POST',
          success: function (response) {
              $("#form_div").html(response);
              $('#dataTable').DataTable();
              $('#dataTable2').DataTable();
              $('#dataTable3').DataTable();
          }
        })
    } else {
      $("#form_div").html('');
    }
  }

</script>

</body>
</html>
