<?php session_start(); 
if (!isset($_SESSION['svn_id'])) {
  header("Location: login");
  exit(); // Make sure to exit to prevent further script execution
}
date_default_timezone_set('Asia/Bangkok');
$cur_date = date('Y-m-d');
$cur_date_th = date('d/m/').(date('Y')+543);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="author" content="Mescha">
    <title>Sivanat Store | Mescha.</title>

    <meta name="description" content="Sivanat Store" />
    <meta property="og:title" content="Sivanat Store" />
    <meta property="og:description" content="ระบบบริหารจัดการร้านศิวนาถ" />
    <meta property="og:image" content="../assets/img/icons/logo_original.jpg">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">

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
    <link rel="stylesheet" href="../assets/css/js-snackbar.min.css" />
    <link rel="stylesheet" href="../libs/evo-calendar/css/evo-calendar.min.css" />
    <link rel="stylesheet" href="../libs/evo-calendar/css/evo-calendar.midnight-blue.min.css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

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
    
    #canlendar{
      font-size:10px !important
    }
    .text-center {
      text-align: center !important;
    }

    .btn.btn-sm {
      position: relative;
      height:30px;
    }

    .btn.btn-sm i {
      position: absolute;
      
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  </style>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index" class="app-brand-link">
              <div class="app-brand-logo demo">
                <img src="../assets/img/favicon/icon.png" width="25px" >
              </div>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Sivanat</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
           
            <li class="menu-item" id="menu_index" data-menu="menu_index">
              <a href="index" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">หน้าแรก</div>
              </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">ระบบ Admin</span>
            </li>
          <!-- Product -->
            <li class="menu-item" id="menu_product">
              <a href="javascript:void(0);" class="menu-link menu-toggle" >
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Account Settings">จัดการสินค้า</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item" id="menu_product_category" data-menu="menu_product">
                  <a href="product_category" class="menu-link"  >
                    <div data-i18n="Account">หมวดหมู่สินค้า</div>
                  </a>
                </li>
              </ul>
              <ul class="menu-sub">
                <li class="menu-item" id="menu_product_list" data-menu="menu_product">
                  <a href="product_list" class="menu-link" >
                    <div data-i18n="Account">เพิ่ม/แก้ไขสินค้า</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item" id="menu_user">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Authentications">จัดการพนักงาน</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item" id="menu_user_list"  data-menu="menu_user">
                  <a href="user_list" class="menu-link">
                    <div data-i18n="Basic">เพิ่ม/แก้ไขพนักงาน</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item" id="menu_branch">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-store"></i>
                <div data-i18n="Misc">จัดการสาขา</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item" id="menu_branch_list" data-menu="menu_branch">
                  <a href="branch_list" class="menu-link">
                    <div data-i18n="Error">เพิ่ม/ลดสาขา</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Truck Delivery -->
            
            <li class="menu-header small text-uppercase"><span class="menu-header-text">ระบบจัดส่งสินค้า</span></li>
         
            <li class="menu-item" id="menu_delivery_task" data-menu="menu_delivery_task">
              <a href="delivery_task" class="menu-link">
                <i class="menu-icon tf-icons bx bx-spreadsheet"></i> 
                <div data-i18n="Basic">รายการจัดส่งน้ำ</div>
              </a>
            </li>
            
            <li class="menu-item" id="menu_delivery_task" data-menu="menu_delivery_task">
              <a href="delivery_t" class="menu-link">
                <i class="menu-icon tf-icons bx bx-location-plus"></i>
                <div data-i18n="Basic">เพิ่มนัดหมาย</div>
              </a>
            </li>
        
            <li class="menu-item" id="menu_delivery">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-truck"></i>
                <div data-i18n="Extended UI">จัดการข้อมูลจัดส่ง</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item" id="menu_delivery_list" data-menu="menu_delivery">
                  <a href="delivery_list" class="menu-link">
                    <div data-i18n="Perfect Scrollbar">ข้อมูลสินค้าจัดส่ง</div>
                  </a>
                </li>
              </ul>
              <ul class="menu-sub">
                <li class="menu-item" id="menu_delivery_customer" data-menu="menu_delivery">
                  <a href="delivery_customer" class="menu-link">
                    <div data-i18n="Perfect Scrollbar">ข้อมูลลูกค้าจัดส่ง</div>
                  </a>
                </li>
              </ul>
            </li>
            
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
     
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                  <?= @$_SESSION['svn_fname']." | ".@$_SESSION['svn_branch_name'];?>
                </li>
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/user/<?= @$_SESSION['svn_img']; ?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/user/<?= @$_SESSION['svn_img']; ?>" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?= @$_SESSION['svn_fname']; ?></span>
                            <small class="text-muted"><?= @$_SESSION['svn_position']; ?></small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-key me-2"></i>
                        <span class="align-middle" onclick="change_password();">เปลี่ยนรหัสผ่าน</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle" onclick="logout();">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->