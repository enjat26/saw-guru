<?php
$menu = $_GET['menu'];
$menumenu = $_GET['menu'];
?>
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.php?menu=home&menu=dashboard">Penilaian Kinerja Guru - Sistem Pendukung Keputusan </a>
                
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo $url?>/index.php?menu=home"><b>Home</b></a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <b>Master Data</b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="<?php echo $url?>/index.php?menu=data-guru">Data Guru</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $url?>/index.php?menu=data-bidang">Data Kategori Guru</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $url?>/index.php?menu=data-kriteria">Data Kriteria</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $url?>/index.php?menu=data-crips">Data Crips</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <b>Transaksi</b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="<?php echo $url?>/index.php?menu=penilaian&id=0-0">Penilaian</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $url?>/index.php?menu=rangking">Rangking</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <b>Laporan</b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="<?php echo $url?>/modul/laporan-guru/index.php" target="_blank">Laporan Data Guru</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $url?>/index.php?menu=laporan-rangking">Laporan Rangking</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="logout.php"><b>Logout</b></a></li>
                </ul>
            </div>
        </div>
    </nav>