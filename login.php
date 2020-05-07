<?php
	session_start();
	require_once 'koneksi.php';

	if (isset($_SESSION['userSession'])!="") {
		header("Location: index.php?menu=home");
		exit;
	}

	if (isset($_POST['btlogin'])) {
			// header("Location: index.php");
		
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		// $password = strip_tags($_POST['password']);
		
		$username = mysqli_real_escape_string($link,$username);
		$password = mysqli_real_escape_string($link,$password);
		
		$query = "SELECT * FROM user WHERE username='$username'";
		$result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
		$row=mysqli_fetch_array($result);
		// die(print_r($query));
		$count = mysqli_num_rows($result); // if username/password are correct returns must be 1 row
		
		if (password_verify($password, $row['password']) && $count==1) {
			$_SESSION['userIDSession'] = $row['id_user'];
			$_SESSION['userSession'] = $row['username'];
			$_SESSION['role'] = $row['role'];
			header("Location: index.php?menu=home");
		} else {
			echo '<script>alert("gagal login !")</script>';
		}
    }
    require_once("url.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Halaman Login</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo $url?>/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="<?php echo $url?>/plugins/font-material/Roboto.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url?>/plugins/font-material/material-icon.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo $url?>/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo $url?>/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo $url?>/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo $url?>/css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg"><h4>Sistem Pendukung Keputusan <br> Penilaian Kinerja Guru <br> (SAW)</h4></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <!-- <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label> -->
                        </div>
                        <div class="col-xs-4">
                            <input type="submit" name="btlogin" class="btn btn-block bg-success waves-effect" value="Login">
                        </div>
                    </div>
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

    <!-- Custom Js -->
    <script src="<?php echo $url?>/js/admin.js"></script>
    <script src="<?php echo $url?>/js/pages/examples/sign-in.js"></script>
</body>

</html>