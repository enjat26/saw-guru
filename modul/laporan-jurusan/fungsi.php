<?php
function tampilbidang(){
    global $link;
    $query = "SELECT * FROM bidang";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilhistory(){
    global $link;
    $query = "SELECT tgl_penilaian,kd_penilaian,bidang,id_user,jml_guru,COUNT(x.bidang)AS jm  FROM
    (SELECT a.bidang,b.* FROM (guru a JOIN penilaian_dt c ON a.id_guru=c.id_guru)
    JOIN penilaian b ON b.kd_penilaian=c.kd_penilaian GROUP BY a.id_guru,b.kd_penilaian) x GROUP BY kd_penilaian,bidang";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
?>