        <nav class="navbar navbar-expand navbar-light bg-gradient-dark topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>



          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
             
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1"> 
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1"> 
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- <span class="mr-2 d-none d-lg-inline text-white-600 small"><?=$this->session->userdata('valid_session')['name']?></span> -->
                <img class="img-profile rounded-circle" src="assets/img/profile.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#passwordModal">
                  <i class="fa fa-cog fa-sm fa-fw mr-2 text-gray-400"></i> Change Password
                </a>
              </div>
            </li>

          </ul>

        </nav>

          <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-gradient-dark text-white">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

            <!-- password Modal-->
  <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-gradient-dark text-white">
          <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="admin/update_password" method="post">
            <div class="form-group">
              <label class="control-label col-sm-5" for="psd0">Old Password:</label>
              <div class="col-sm-12">
                <input type="password" class="form-control" id="psd0" name="old_password" placeholder="Enter Here" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-5" for="psd">Password:</label>
              <div class="col-sm-12">
                <input type="password" class="form-control" id="psd" name="password" placeholder="Enter Here" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-5" for="psd2">Re-Password:</label>
              <div class="col-sm-12">
                <input type="password" class="form-control" id="psd2" name="re_password" placeholder="Enter Here" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-12">
                <button type="reset" class="btn btn-danger" >Clear</button>
                <button type="submit" class="btn btn-success float-right" name="addForm" value="addForm">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>