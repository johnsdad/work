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
                        </tr>
                      </tfoot>  
                    </table>
                    <?php } ?>