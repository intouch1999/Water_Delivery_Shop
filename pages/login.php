<?php session_start(); 
session_destroy();
?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
  notranslate
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <meta name="author" content="Mescha">
    <title>Sivanat Store | Mescha.</title>

    <meta name="description" content="Sivanat Store" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.png" />
    <link href="../assets/img/favicon/favicon.png" rel="icon">
     <link href="../assets/img/favicon/favicon.png" rel="apple-touch-icon">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>
  <style>
     @font-face {
            font-family: 'Th_light';
            src: url('../assets/fonts/Kanit-Light.ttf') format('truetype');
        }
      
    body {
          font-family: 'Th_light', sans-serif;
      }
  </style>
  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
              <a href="#" class="app-brand-link">
              <div class="app-brand-logo demo">
                <img src="../assets/img/favicon/icon.png" width="25px" >
              </div>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Sivanat Store</span>
            </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">เข้าสู่ระบบ</h4>
              <p class="mb-4">ระบุรหัสพนักงานและรหัสผ่านเพื่อเข้าสู่ระบบ</p>

              <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">รหัสพนักงาน</label>
                  <input
                    type="text"
                    class="form-control"
                    id="inp_username"
                    name="username"
                    placeholder="ระบุรหัสพนักงาน"
                    autocomplete="off"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">ระบุรหัสผ่าน</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="inp_password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="button" onclick="chk_login();">Log in</button>
                </div>
              </form>
              <p class="text-center">
                <span id="login-warning">&nbsp;</span>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>


    <!-- Core  -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
<script>
  function chk_login(){
    let username = $("#inp_username").val();
    let password = $("#inp_password").val();
    $("#login-warning").html("&nbsp;");
    if(username.length<3){
      $("#login-warning").html("<font color='brown'>กรุณาระบุรหัสพนักงาน</font>");
      return false;
    } 
    if(password.length==0){
      $("#login-warning").html("<font color='brown'>กรุณาระบุรหัสผ่าน</font>");
      return false;
    }

    fetch('../api/user?chk_login', {
      method: 'POST',
      body: JSON.stringify({
      case: 'chk_login',
      username:username,
      password:password
      })
      })
      .then(function (response) {
          fetch_status = response.status;
          return response.json();
      }) 
      .then(function (json) {
        if(json[0].status=="0"){
          $("#login-warning").html("<font color='brown'>"+json[0].error_message+"</font>");
        }else{
          $("#login-warning").html("<font color='yellowgreen'>"+json[0].user_fname+"</font>")
          setTimeout(function(){
            window.location.href="index";
          },1000);
        }
      })
      .catch(error => console.error(error));
  }
  
  $("#inp_username").keyup(function(event) {
    // Check if the pressed key is Enter (key code 13)
    if (event.keyCode === 13) {
      // Trigger the chk_login function
      $("#inp_password").focus();
    }
  });

  $("#inp_password").keyup(function(event) {
    // Check if the pressed key is Enter (key code 13)
    if (event.keyCode === 13) {
      // Trigger the chk_login function
      chk_login();
    }
  });
</script>