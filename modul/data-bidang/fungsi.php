<?php
function tampilkan(){
    global $link;
    $query = "SELECT * FROM bidang";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilID($id){
    global $link;
    $query = "SELECT * FROM bidang WHERE id_bidang = '$id'";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    // die(print_r($query));
    return $result;
}
function simpanData($nama){
    $query = "INSERT INTO bidang (bidang) VALUES ('$nama')";
    // die(print_r($query));
    return run($query);
}
function ubahData($id,$nama){
    $query = "UPDATE bidang SET bidang='$nama' WHERE id_bidang='$id'";
    // die(print_r($query));
    return run($query);
}
function hapusData($id){
    $query = "DELETE FROM bidang WHERE id_bidang='$id'";
    // die(print_r($query));
    return run($query);
}
function run($query){
    global $link;
    if(mysqli_query($link, $query) or die('Error: ' . mysqli_error($link))) return true;
    else return false;
}
?>