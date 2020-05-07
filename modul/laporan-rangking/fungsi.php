<?php
function tampilhistory(){
    global $link;
    $query = "SELECT tgl_penilaian,id_penilaian,bidang,id_user,jml_guru,x.kode_penilaian,COUNT(x.bidang)AS jm  FROM
    (SELECT a.bidang,b.* FROM (guru a JOIN penilaian_dt c ON a.id_guru=c.id_guru)
    JOIN penilaian b ON b.id_penilaian=c.id_penilaian GROUP BY a.id_guru,b.id_penilaian) x GROUP BY id_penilaian,bidang";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilKriteria(){
    global $link;
    $query = "SELECT * FROM kriteria";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilNilai($id_penilaian,$id_guru){
    global $link;
    $query = "SELECT a.id_guru,a.nama_guru,b.*,c.bobot_kriteria,d.keterangan FROM 
    ((guru a JOIN penilaian_dt b ON a.id_guru=b.id_guru) 
    JOIN kriteria c ON b.id_kriteria=c.id_kriteria)
    JOIN crips d ON b.kd_crips=d.kd_crips
    WHERE b.id_penilaian='$id_penilaian' AND a.id_guru='$id_guru' ORDER BY b.id_kriteria ASC";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    // die(print_r($query));
    return $result;
}
function tampilguru($id_penilaian,$bidang){
    global $link;
    $query = "SELECT a.id_guru,a.nama_guru,b.* FROM guru a JOIN penilaian_dt b
    ON a.id_guru=b.id_guru WHERE a.bidang = '$bidang' GROUP BY a.id_guru";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}

function tampiRangkingguru($id_penilaian,$bidang){
    global $link;
    $query = "SELECT a.*,b.* FROM (guru a JOIN penilaian_dt c ON a.id_guru=c.id_guru)
    JOIN penilaian b ON b.id_penilaian=c.id_penilaian WHERE a.bidang='$bidang' AND b.id_penilaian = '$id_penilaian' 
    GROUP BY a.id_guru,b.id_penilaian ORDER BY a.nilai_guru DESC";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function cekPenilaian($id_penilaian){
    global $link;
    $query = "SELECT * FROM penilaian WHERE id_penilaian = '$id_penilaian'";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilMax($id_penilaian,$id_kriteria){
    global $link;
    $query = "SELECT MAX(nilai) AS max FROM penilaian_dt WHERE id_penilaian='$id_penilaian' AND id_kriteria='$id_kriteria' ORDER BY id_kriteria ASC";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    // die(print_r($query));
    return $result;
}
function ubahbatas($id_penilaian,$batas){
    global $link;
    $query = "UPDATE penilaian SET jml_guru = '$batas' WHERE id_penilaian='$id_penilaian'";
    // die(print_r($query));
    return run($query);
}
function run($query){
    global $link;
    if(mysqli_query($link, $query) or die('Error: ' . mysqli_error($link))) return true;
    else return false;
}
?>