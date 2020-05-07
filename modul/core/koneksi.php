<?php
    $host="localhost"; //SESUAIKAN DENGAN WEBSERVER ANDA
    $dbname="skripsi_saw_guru"; //SESUAIKAN DENGAN WEBSERVER ANDA
    $username="root"; //SESUAIKAN DENGAN WEBSERVER ANDA
    $pass="";//SESUAIKAN DENGAN WEBSERVER ANDA

    $link = mysqli_connect($host,$username,$pass,$dbname) or die(mysqli_error());
?>