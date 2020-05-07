    <?php
        require_once('header.php');
    ?>
    <body class="theme-deep-purple">
    <!-- Page Loader -->
    <!-- <div class="page-loader-wrapper">
        <div class="loader">
            <div class="md-preloader pl-size-md">
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
                </svg>
            </div>
            <p>Please wait...</p>
        </div>
    </div> -->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <?php
        require_once('navbar-sidebar.php');
        require_once('koneksi.php');
    ?>

    <?php
        if($_GET['menu'] =='home'){
            include "home.php";
        }else if($_GET['menu'] =='profile'){
            include "profile.php";
        }else if($_GET['menu'] =='404'){
            include "404.php";
        }else if($_GET['menu'] =='logout'){
            include "logout.php";
        }else if($_GET['menu'] =='user'){
            include "modul/user/user.php";
        }else if($_GET['menu'] =='data-bidang'){
            include "modul/data-bidang/fungsi.php";
            include "modul/data-bidang/data-bidang.php";
        }else if($_GET['menu'] =='data-guru'){
            include "modul/data-guru/fungsi.php";
            include "modul/data-guru/data-guru.php";
        }else if($_GET['menu'] =='data-kriteria'){
            include "modul/data-kriteria/fungsi.php";
            include "modul/data-kriteria/data-kriteria.php";
        }else if($_GET['menu'] =='data-crips'){
            include "modul/data-crips/fungsi.php";
            include "modul/data-crips/data-crips.php";
        }else if($_GET['menu'] =='penilaian'){
            include "modul/penilaian/fungsi.php";
            include "modul/penilaian/penilaian.php";
        }else if($_GET['menu'] =='rangking'){
            include "modul/rangking/fungsi.php";
            include "modul/rangking/rangking.php";
        }else if($_GET['menu'] =='rangking-penilaian'){
            include "modul/rangking/fungsi.php";
            include "modul/rangking/rangking-penilaian.php";
        }else if($_GET['menu'] =='laporan-guru'){
            // include "modul/laporan-guru/fungsi.php";
            include "modul/laporan-guru/index.php";
        }else if($_GET['menu'] =='laporan-bidang'){
            include "modul/laporan-bidang/fungsi.php";
            include "modul/laporan-bidang/index.php";
        }else if($_GET['menu'] =='laporan-penilaian'){
            include "modul/laporan-penilaian/fungsi.php";
            include "modul/laporan-penilaian/laporan-penilaian.php";
        }else if($_GET['menu'] =='laporan-rangking'){
            include "modul/laporan-rangking/fungsi.php";
            include "modul/laporan-rangking/laporan-rangking.php";
        }else if($_GET['menu'] =='user-manajemen'){
            include "modul/user-manajemen/fungsi.php";
            include "modul/user-manajemen/user-manajemen.php";
        }else if($_GET['menu'] =='user-profil'){
            include "modul/user-profil/fungsi.php";
            include "modul/user-profil/user-profil.php";
        }else if($_GET['menu'] =='tentang-aplikasi'){
            include "modul/tentang-aplikasi/fungsi.php";
            include "modul/tentang-aplikasi/tentang-aplikasi.php";
        }else{
            // include "home.php";
            echo '<script>window.location.href="'.$url.'/home.php</script>';
        }
    ?>

    