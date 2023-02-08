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
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('/public/assets') ?>/assets/images/favicon.png">
    <title>CSM</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo ASSETS ?>/assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS ?>/assets/node_modules/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="<?php echo ASSETS ?>/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!--c3 CSS -->
    <link href="<?php echo ASSETS ?>/assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo ASSETS ?>/css/style.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="<?php echo ASSETS ?>/css/pages/dashboard1.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo ASSETS ?>/css/colors/default.css" id="theme" rel="stylesheet">
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

<body class="card-no-border">
    
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">CSM</p>
        </div>
    </div>

        