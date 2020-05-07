<?php
function tampilhistory(){
    global $link;
    $query = "SELECT tgl_penilaian,kd_penilaian,bidang,id_user,jml_guru,COUNT(x.bidang)AS jm  FROM
    (SELECT a.bidang,b.* FROM (guru a JOIN penilaian_dt c ON a.id_guru=c.id_guru)
    JOIN penilaian b ON b.kd_penilaian=c.kd_penilaian GROUP BY a.id_guru,b.kd_penilaian) x GROUP BY kd_penilaian,bidang";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilKriteria(){
    global $link;
    $query = "SELECT * FROM kriteria";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilNilai($kd_penilaian,$id_guru){
    global $link;
    $query = "SELECT a.id_guru,a.nama_guru,b.*,c.bobot_kriteria,d.keterangan FROM 
    ((guru a JOIN penilaian_dt b ON a.id_guru=b.id_guru) 
    JOIN kriteria c ON b.id_kriteria=c.id_kriteria)
    JOIN crips d ON b.kd_crips=d.kd_crips
    WHERE b.kd_penilaian='$kd_penilaian' AND a.id_guru='$id_guru' ORDER BY b.id_kriteria ASC";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    // die(print_r($query));
    return $result;
}
function tampilguru($kd_penilaian,$bidang){
    global $link;
    $query = "SELECT a.id_guru,a.nama_guru,b.* FROM guru a JOIN penilaian_dt b
    ON a.id_guru=b.id_guru WHERE a.bidang = '$bidang' GROUP BY a.id_guru";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function cekPenilaian($kd_penilaian){
    global $link;
    $query = "SELECT * FROM penilaian WHERE kd_penilaian = '$kd_penilaian'";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function run($query){
    global $link;
    if(mysqli_query($link, $query) or die('Error: ' . mysqli_error($link))) return true;
    else return false;
}
?>