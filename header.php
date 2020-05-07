<?php  
    session_start();
    if(!isset($_SESSION['userIDSession'])){
        echo "<script>location.href='logout.php'</script>";
    }
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once('url.php');?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>SPK SAW Kinerja Guru</title>

    <!-- Google Fonts -->
    <link href="<?php echo $url?>/plugins/font-material/Roboto.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url?>/plugins/font-material/material-icon.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo $url?>/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo $url?>/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo $url?>/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="<?php echo $url?>/plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />
    
    <!-- Sweetalert Css -->
    <link href="<?php echo $url?>/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <!-- jqury ui Css -->
    <link href="<?php echo $url?>/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="<?php echo $url?>/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- JQuery Datepicker Css -->
    <link href="<?php echo $url?>/plugins/datepicker/datepicker.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="<?php echo $url?>/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo $url?>/css/themes/all-themes.css" rel="stylesheet" />
</head>
