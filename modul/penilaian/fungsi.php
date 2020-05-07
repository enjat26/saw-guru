<?php
function getKdCrips($idnilai,$idguru,$idcrips){
    global $link;
    $query = "SELECT id_crips FROM penilaian_dt WHERE id_penilaian = '$idnilai' AND id_guru='$idguru' AND id_crips='$idcrips'";
    // die(print_r($query));
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function autoComplate($kode){
    global $link;
    $query = "SELECT * FROM guru WHERE nama_guru LIKE '$kode%' LIMIT 10";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilhistory(){
    global $link;
    $query = "SELECT a.*,b.* FROM (guru a JOIN penilaian_dt c ON a.id_guru=c.id_guru)
    JOIN penilaian b ON b.id_penilaian=c.id_penilaian GROUP BY a.id_guru,b.id_penilaian";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilhistoryID($idnilai){
    global $link;
    $query = "SELECT a.*,b.* FROM (guru a JOIN penilaian_dt c ON a.id_guru=c.id_guru)
    JOIN penilaian b ON b.id_penilaian=c.id_penilaian 
    WHERE b.id_penilaian ='$idnilai' GROUP BY a.id_guru,b.id_penilaian";
    // die(print_r($query));
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilHeader($idguru){
    global $link;
    $query = "SELECT * FROM guru WHERE id_guru='$idguru'";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilIDdanguru($idpenilaian,$idguru){
    global $link;
    $query = "SELECT a.id FROM penilaian_dt a JOIN penilaian b ON a.id_penilaian=b.id_penilaian
    WHERE a.id_penilaian = '$idpenilaian' AND a.id_guru='$idguru'";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilID($idpenilaian){
    global $link;
    $query = "SELECT a.id FROM penilaian_dt a WHERE a.id_penilaian = '$idpenilaian'";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilKriteria(){
    global $link;
    $query = "SELECT * FROM kriteria";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilCrips($id_kriteria){
    global $link;
    $query = "SELECT * FROM crips WHERE id_kriteria='$id_kriteria'";
    // die(print_r($query));
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function simpanheader(){
    if(!isset($_SESSION)){ 
        session_start(); 
        $user = $_SESSION['userIDSession'];
    } 
    global $link;
    $tgl = date('Y-m-d');
    $kode = kode_otomatis();
    $query = "INSERT INTO penilaian (tgl_penilaian,id_user,kode_penilaian) VALUES ('$tgl','$user','$kode')";
    // die(print_r($query));
    return run($query);
}
function run($query){
    global $link;
    if(mysqli_query($link, $query) or die('Error: ' . mysqli_error($link))) return true;
    else return false;
}
function kode_otomatis(){
    global $link;
    $query = "SELECT max(kode_penilaian) as maxKode FROM penilaian";
    $hasil = mysqli_query($link,$query);
    $data = mysqli_fetch_array($hasil);
    $kode = $data['maxKode'];
    $noUrut = (int) substr($kode, 3, 3);
    $noUrut++;
    $char = "PNL";
    $kode = $char . sprintf("%03s", $noUrut);
    return $kode;
}
?>