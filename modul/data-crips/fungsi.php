<?php
function tampilkan(){
    global $link;
    $query = "SELECT a.*, b.nama_kriteria,b.kode_kriteria FROM crips a JOIN kriteria b ON a.id_kriteria=b.id_kriteria";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilID($id){
    global $link;
    $query = "SELECT * FROM crips WHERE id = '$id'";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    // die(print_r($query));
    return $result;
}
function tampilkriteria(){
    global $link;
    $query = "SELECT * FROM kriteria";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    // die(print_r($query));
    return $result;
}
function ubahKdCrips(){
    $query="UPDATE crips SET id_crips=CONCAT('CR-',id_kriteria,id)";
    return run($query);
}
function simpanData($id_kriteria,$keterangan,$nilai){
    $query = "INSERT INTO crips (id_kriteria,keterangan,nilai_bobot) VALUES 
    ('$id_kriteria','$keterangan','$nilai')";
    // die(print_r($query));
    return run($query);
}
function ubahData($id,$id_kriteria,$keterangan,$nilai){
    $query = "UPDATE crips SET id_kriteria='$id_kriteria',keterangan='$keterangan',nilai_bobot='$nilai' WHERE id='$id'";
    // die(print_r($query));
    return run($query);
}
function hapusData($id){
    $query = "DELETE FROM crips WHERE id='$id'";
    // die(print_r($query));
    return run($query);
}
function run($query){
    global $link;
    if(mysqli_query($link, $query) or die('Error: ' . mysqli_error($link))) return true;
    else return false;
}
?>