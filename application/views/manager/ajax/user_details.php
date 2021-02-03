<?php //echo '<pre>'; print_r($user); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-8 col-md-6">
                            <h3 class="mb-0 text-truncated"><?=$user->name?></h3>
                            <p class="lead">
                            	<?=$user->type==4?'Agent':($user->type==3?'Team Leader':($user->type==2?'Manager':($user->type==1?'Admin':'Unknown')))?>
                            </p>
                            <p> 
                            	<span class="badge badge-<?=$user->status==1?'success':'warning'?> tags"><?=$user->status==1?'Active':'Inactive'?></span> 
                            </p>
                        </div>
                        <div class="col-12 col-lg-4 col-md-6 text-center">
                            <img src="<?=$user->image?$user->image:'https://placebeard.it/100x100'?>" alt="<?=$user->name?>" class="mx-auto rounded-circle img-fluid">
                        </div>
                        <div class="col-12 col-lg-4">
                            <!-- <h3 class="mb-0"></h3> -->
                            <small>Department</small>
                            <button class="btn btn-block btn-outline-success"><?=$user->department_name?></button>
                        </div>
                        <div class="col-12 col-lg-4">
                            <!-- <h3 class="mb-0">245</h3> -->
                            <small>Super Member</small>
                            <button class="btn btn-outline-info btn-block"><span class="fa fa-user"></span> <?=$user->parent_name?></button>
                        </div>
                        <div class="col-12 col-lg-4">
                            <!-- <h3 class="mb-0">43</h3> -->
                            <small>Last Login</small>
                            <button type="button" class="btn btn-outline-primary btn-block"><span class="fa fa-gear"></span> 
                            	<small><?=date('d-m-Y h:i:s', strtotime($user->last_login))?></small>
                            </button>
                        </div>
                        <!--/col-->
                    </div>
                    <!--/row-->
                </div>
                <!--/card-block-->
            </div>
        </div>
    </div>
</div>