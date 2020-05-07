<?php
if(isset($_POST['nama'])){
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $tempat = $_POST["tempat"];
    $tgl_lahir = date("Y/m/d", strtotime($_POST["tgl_lahir"]));
    $jk = $_POST["jk"];
    $no_tlp = $_POST["no_tlp"];
    $bidang = $_POST["bidang"];

    $q = "INSERT INTO guru (nama_guru,tempat,tgl_lahir,alamat,jk,no_tlp,bidang) VALUES 
    ('$nama','$tempat','$tgl_lahir','$alamat','$jk','$no_tlp','$bidang');";
    $q .="UPDATE guru SET no_tes = CONCAT('TES-',id_guru);";
    $q .="INSERT INTO user (nama,username,password,role,img) VALUES ('$nama','$nama','$2y$10$41UtNJc5QFJbgLWtqDZm..ziGXPFlKziMHowHFT68PfsCzvuuIfLW','guru','avatar.png')";

    require_once('koneksi.php');
    $link;
    $res=mysqli_multi_query($link, $q);
    if($res){
        $al = ' <div class="alert alert-success">
                    <strong>Selamat!</strong> Anda berhasil melakukan registrasi...
                </div>
                <div class="well">
                    Gunakan usernmane dana password ini untuk login..</br>
                    username : '.$nama.'<br>
                    Password : adm123<br>  
                    <br>
                    <em>*harap ganti password default setelah login</em>
                </div>';
    }else{
        $al = ' <div class="alert alert-danger">
                    <strong>Perhatian!</strong> Gagal...
                </div>';
    }   
}

?>
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
    <div class="card">
        <div class="body">
            <?php
                echo $al;
            ?>
            <a class="btn btn-sm btn-success" href="login.php">Kembali</a>
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