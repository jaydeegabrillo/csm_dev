<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php ASSETS ?>/images/CSM_Logo.jpg">
    <title>Electronic Medical Record</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo ASSETS ?>/assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontawesome CSS -->
    <link href="<?php echo ASSETS ?>/assets/node_modules/font-awesome/font-awesome.min.css" rel="stylesheet">
    <!-- This page CSS -->
    <!-- Custom CSS -->
    <link href="<?php echo ASSETS ?>/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo ASSETS ?>/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- Sweetalert CSS Script -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" integrity="sha512-gOQQLjHRpD3/SEOtalVq50iDn4opLVup2TF8c4QPI3/NmUPNZOk2FG0ihi8oCU/qYEsw4P6nuEZT2lAG0UNYaw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Page Specific Script -->
    <?php if(isset($css_scripts)){ ?>
        <?php foreach ($css_scripts as $css_script) { ?>
            <link href="<?php echo ASSETS.$css_script ?>" rel="stylesheet">
        <?php } ?>
    <?php } ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">CSM</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php base_url() ?>">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="<?php echo ASSETS ?>/images/CSM_Logo.jpg" alt="homepage" class="dark-logo" style="width:100%"/>
                            <!-- Light Logo icon -->
                            <img src="<?php echo ASSETS ?>/images/CSM_Logo.jpg" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon --> 
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item">
                            <a class="
                                nav-link nav-toggler
                                hidden-md-up
                                waves-effect waves-dark
                            " href="javascript:void(0)"><i class="sl-icon-menu"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="
                                nav-link
                                sidebartoggler
                                hidden-sm-down
                                waves-effect waves-dark
                            " href="javascript:void(0)"><i class="sl-icon-menu"></i></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown u-pro">
                            <a class="
                                nav-link
                                dropdown-toggle
                                waves-effect waves-dark
                                profile-pic
                            " href="javascript:void(0);"><img src="<?php echo ASSETS ?>/assets/images/users/1.jpg" alt="user" class="">
                            <span class="hidden-md-down"><?= $name ?> &nbsp;<i class="fa fa-angle-down"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile_dropdown animated flipInY">
                            <ul class="dropdown-user">
                                <li>
                                <div class="dw-user-box">
                                    <div class="u-img">
                                    <img src="<?php echo ASSETS ?>/assets/images/users/1.jpg" alt="user">
                                    </div>
                                    <div class="u-text">
                                    <h4><?= $name ?></h4>
                                    <p class="text-muted"><?= $email ?></p>
                                    <a href="pages-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                    </div>
                                </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                <a href="<?= base_url('logout') ?>"><i class="fa fa-power-off"></i> Logout</a>
                                </li>
                            </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->