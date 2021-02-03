<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?=base_url()?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Divik Prakash">

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
              Date Wise Works Report         
            </div>
            <div class="card-body">

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
                        <button class="btn btn-success" onclick="show_date_work($('#fromdate').val(), $('#todate').val())"> Show</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <button class="btn btn-success" onclick="show_date_work('<?=date('Y-m-d', strtotime('-1 days'))?>', '<?=date('Y-m-d', strtotime('-1 days'))?>')"> Yesterday</button>
                  </div>
                  <div class="col-sm-2">
                    <button class="btn btn-success" onclick="show_date_work('<?=date('Y-m-d', strtotime('-7 days'))?>', '<?=date('Y-m-d')?>')"> Last 7 Days</button>
                  </div>

                </div>
              </div>

              <div id="databody">
                    <?php 
                      $type1 = 0;
                      $type2 = 0;
                      $type3 = 0;
                      foreach ($works as $work) { $work->input_type==1?$type1++:($work->input_type==2?$type2++:($work->input_type==3?$type3++:'')); } 
                    ?>
                    <?php if($type1) { ?>
                    <hr class="mt-3">
                    
                    <table class="table table-bordered" id="dataTable">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Activity</th>
                          <th>Duration</th>
                          <!-- <th>Approved By</th> -->
                        </tr>
                      </thead>
                      <tbody>
                      <?php $hours =0; $minutes = 0; foreach ($works as $work) { ?>
                        <?php if($work->input_type == 1) { ?>
                        <tr>
                          <td><?=date('jS, M Y', strtotime($work->date))?></td>
                          <td><?=$work->activity?></td>
                          <td><?=sprintf("%02d", $work->hours)?> : <?=sprintf("%02d", $work->minutes)?> Hrs.</td>
                          <!-- <td><?=$work->approved_through?></td> -->
                        </tr>
                          <?php  $minutes += ($work->hours*60) + $work->minutes; ?>
                        <?php } ?>
                      <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="2">Total Time:</th>
                          <th>
                            <?=floor($minutes / 60)?> : <?= sprintf("%02d",$minutes%60); ?> Hrs.                  
                          </th>
                        </tr>
                      </tfoot>  
                    </table>
                    <?php } ?>

                    <?php if($type2) { ?>
                    <hr class="mt-3">
                    
                    <table class="table table-bordered" id="dataTable2">
                      <thead>
                        <tr>
                          <th>Work Date</th>
                          <th>Activity</th>
                          <th>Count</th>
                          <!-- <th>Approved By</th> -->
                          <th>#</th>
                        </tr>
                      </thead>
                      <?php $num=0; foreach ($works as $work) { ?>
                        <?php if($work->input_type == 2) { ?>
                        <tr>
                          <td><?=date('jS, M Y', strtotime($work->date))?></td>
                          <td><?=$work->activity?></td>
                          <td><?=$work->numbers?></td>
                          <!-- <td><?=$work->approved_through?></td> -->
                          <td>
                            <?php if($work->links != null) { ?>
                              <button class="btn btn-sm btn-dark" onclick="view_links(<?=$work->id?>)">
                                <i class="fa fa-eye"></i>
                              </button>
                            <?php } ?>
                          </td>
                        </tr>
                        <?php $num += $work->numbers; ?>
                        <?php } ?>
                      <?php } ?>
                      <tfoot>
                        <tr>
                          <th colspan="2">Total Count:</th>
                          <th>
                            <?=$num?>         
                          </th>
                          <th></th>
                        </tr> 
                      </tfoot>
                    </table>
                    <?php } ?>

                    <?php if($type3) { ?>
                    <hr class="mt-3">
                    
                    <table class="mt-3 table table-bordered" id="dataTable3">
                      <thead>
                        <tr>
                          <th>Work Date</th>
                          <th>Activity</th>
                          <th>Word Count</th>
                          <th>Proof Read</th>
                          <!-- <th>Approved By</th> -->
                          <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $words=0; foreach ($works as $work) { ?>
                        <?php if($work->input_type == 3) { ?>
                        <tr>
                          <td><?=date('jS, M Y', strtotime($work->date))?></td>
                          <td><?=$work->activity?></td>
                          <td><?=$work->numbers?$work->numbers:'---'?></td>
                          <td><?=$work->proof_name?$work->proof_name:'---'?></td>
                          <!-- <td><?=$work->approved_through?></td> -->
                          <td>        
                            <?php if($work->content) { ?>
                              <button class="btn btn-sm btn-dark" onclick="view_content(<?=$work->id?>)">
                                <i class="fa fa-eye"></i>
                              </button>
                            <?php } ?>
                          </td>
                        </tr>
                        <?php $words += $work->numbers; ?>
                        <?php } ?>
                      <?php } ?>  
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="2">Total Words:</th>
                          <th>
                            <?=$words?>         
                          </th>
                          <th></th>
                          <th></th>
                        </tr>
                      </tfoot>  
                    </table>
                    <?php } ?>
                </div>

            </div>
          </div>
          
          <div class="modal fade" id="agentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header bg-gradient-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">X</span>
                </button>
              </div>
              <div class="modal-body" id="modalBody">

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
  function show_date_work(from_date, to_date) {
      $.ajax({
        url: 'agent/date_wise_work',
        type: 'POST',
        data: ({from_date : from_date, to_date : to_date}),
        success: function (response) {
          $("#databody").html(response);
          //$("#databody").load(location.href + " #databody>*", "");
        }
      })
    }

  function view_links(id) {
    $.ajax({
          url: 'common/show_links/' + id,
          type: 'POST',
          success: function (response) {
              $("#modalBody").html(response);
              $("#agentModal").modal('show');
          }
      })
  }

  function view_content(id) {
    $.ajax({
          url: 'common/show_content/' + id,
          type: 'POST',
          success: function (response) {
              $("#modalBody").html(response);
              $("#agentModal").modal('show');
          }
      })
  }

</script>

</body>
</html>
