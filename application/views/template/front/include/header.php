<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="<?=base_url()?>">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
        <meta name="description" content="Bootstrap Admin Template" />
        <meta name="keywords" content="admin" />
        <meta name="author" content="" />
        <meta name="robots" content="noindex, nofollow" />
        <title>DY Immigration ERP</title>

        <link rel="shortcut icon" type="image/x-icon" href="<?= $organisation_settings->oraganisation_favicon ?>"/>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/css/line-awesome.min.css" />
        <!--<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css" />-->
        <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" />
        <link rel="stylesheet" href="assets/css/select2.min.css" />
        <link rel="stylesheet" href="assets/plugins/morris/morris.css" />
        <link rel="stylesheet" href="assets/css/uimin.css">
        <link rel="stylesheet" href="assets/css/style.css" />
        <!--  bar Graph  Js-->
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
  </head>
    <body>
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left">
                    <a href="index.html" class="logo">

                        <img src="<?= ($organisation_settings->oraganisation_logo)?$organisation_settings->oraganisation_logo:'assets/img/logo.png' ?>" width="190" height="" alt="" />
                    </a>
                </div>

                <a id="toggle_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>

                <div class="page-title-box">
                    <h3><?= $organisation_settings->oraganisation_name ?></h3>
                </div>

                <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

                <ul class="nav user-menu">

                    <li class="nav-item dropdown has-arrow main-drop">
                        <a href="Javascript:void(0)" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="user-img"><img src="<?= ($logged_in_user->user_image)?$logged_in_user->user_image:'assets/img/user.jpg' ?>" alt="" /> <span class="status online"></span></span>
                            <span><?= $logged_in_user->USER_NAME ?></span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="profile.html/<?= $logged_in_user->USER_ID ?>">My Profile</a>
                        <a class="dropdown-item" href="changepassword.html">Change Password</a>

                            <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                            <a class="dropdown-item" href="javascript:void(0)" id="logout">Logout</a>
                        </div>
                    </li>
                </ul>

                <div class="dropdown mobile-user-menu">
                    <a href="Javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="profile.html">My Profile</a>
                        
                        <!-- <a class="dropdown-item" href="settings.php">Settings</a> -->
                        <a class="dropdown-item" href="login.php">Logout</a>
                    </div>
                </div>
            </div>
   
