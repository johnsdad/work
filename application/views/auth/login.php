<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?=base_url()?>">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-dark">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-5 col-md-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <?php $this->load->view('inc/alert'); ?>
                    <div style="pointer-events:none;">
                      <!-- <iframe src="http://free.timeanddate.com/clock/i77e708w/n176/szw110/szh110/hoc000/hbw4/hfceee/cf100/hncccc/fdi76/mqc000/mql10/mqw4/mqd98/mhc000/mhl10/mhw4/mhd98/mmc000/mml10/mmw1/mmd98" frameborder="0" width="110" height="110" ></iframe> -->
                    </div>
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" method="post" action="login">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    
                    <button class="btn bg-gradient-dark btn-user btn-block text-white" type="submit" name="submitForm" value="submitForm">
                      Login
                    </button>
    
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
 

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
    // //var today = new Date().toLocaleString();
    // var date = new Date();
    // var today = date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear()+' '+date.getHours()+':'+date.getMinutes()+':'+date.getSeconds()+' '+date.getTimezoneOffset();
    // document.getElementById('time').innerHTML=today;
    
    // window.onload = function(e){
    //    $.ajax({
    //     url: 'http://ip-api.com/json',
    //     method: 'get',
    //     success: function (response) {
    //           $('#info1').html(response);
    //          // console.log('User\'s Location Data is ', response);
    //           $('#info').html(response.country);
    //     }
    //   });
    // }

    function randomNumber(min, max) {  
      return Math.floor(Math.random() * (max - min) + min); 
    }  

    $(document).ready(function() {
      firstvalue = randomNumber(10, 20);
      secondvalue = randomNumber(1, 10);
      $("#first").val(firstvalue);
      $("#second").val(secondvalue);
    });

    function captcha(){
      first =parseInt($("#first").val());
      second =parseInt($("#second").val());
      result =parseInt($("#result").val());
      
      if((first + second) == result) {
          $("#wrngmsg").html('');
          return true;
      } else {
          //alert('Enter a Vaild Result.');
          $("#wrngmsg").html('Please Enter a Vaild Result.');
          $("#result").focus();
          return false;
      }
    }
  </script>
</body>

</html>
