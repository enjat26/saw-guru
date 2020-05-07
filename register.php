<?php
	session_start();

    require_once("url.php");
    require_once("koneksi.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo $url?>/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="<?php echo $url?>/plugins/font-material/Roboto.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url?>/plugins/font-material/material-icon.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo $url?>/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- JQuery Datepicker Css -->
    <link href="<?php echo $url?>/plugins/datepicker/datepicker.css" rel="stylesheet">
    
    <!-- Waves Effect Css -->
    <link href="<?php echo $url?>/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo $url?>/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo $url?>/css/style.css" rel="stylesheet">
</head>

<body class="signup-page">
<div class="signup-box">
    <div class="logo">
        <a href="javascript:void(0);">Admin<b>BSB</b></a>
        <small>Admin BootStrap Based - Material Design</small>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_up" action="ragister-hasil.php" method="POST">
                <div class="msg">Register guru Baru</div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control focus" id="nama" name="nama" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="tempat">Tempat</label>
                        <input type="text" class="form-control" id="tempat" name="tempat" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="tgl_lahir">Tgl Lahir</label>
                        <input type="text" class="tanggal form-control" id="tgl_lahir" name="tgl_lahir" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="alamat">alamat</label>
                        <textarea type="text" class="form-control" id="alamat" name="alamat" required=""></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-control" id="jk" name="jk" required="">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>                            
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="no_tlp">No Tlp</label>
                        <input type="text" class="form-control" id="no_tlp" name="no_tlp" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="bidang">bidang</label>
                        <select class="form-control" id="bidang" name="bidang" required="">
                            <?php 
                                $j ="SELECT bidang FROM bidang";
                                $showJ = mysqli_query($link,$j);
                                // $noj = 1;
                                while($rj = mysqli_fetch_assoc($showJ)) :
                            ?>
                                <option value="<?php echo $rj['bidang']?>"><?php echo $rj['bidang']?></option>
                            <?php endwhile;?>               
                        </select>
                    <div>
                </div>
                <input type="submit" class="btn btn-block btn-lg bg-pink waves-effect" value="Daftar">
            </form>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="<?php echo $url?>/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo $url?>/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo $url?>/plugins/node-waves/waves.js"></script>

<!-- Validation Plugin Js -->
<script src="<?php echo $url?>/plugins/jquery-validation/jquery.validate.js"></script>


<!-- SweetAlert Plugin Js -->
<script src="<?php echo $url?>/plugins/datepicker/bootstrap-datepicker.min.js"></script>

<!-- Custom Js -->
<script src="<?php echo $url?>/js/admin.js"></script>
<script>
    $(function(){
        $('.tanggal').datepicker({
            autoclose: true
        });
    });
</script>
</body>

</html>