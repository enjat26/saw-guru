<?php
function tampilkan(){
    global $link;
    $query = "SELECT * FROM guru";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilID($id){
    global $link;
    $query = "SELECT * FROM guru WHERE id_guru = '$id'";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    // die(print_r($query));
    return $result;
}
function tampilbidang(){
    global $link;
    $query = "SELECT bidang FROM bidang";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    // die(print_r($query));
    return $result;
}
function simpanData($nama,$tempat,$tgl_lahir,$alamat,$jk,$no_tlp,$bidang){
    $query = "INSERT INTO guru (nama_guru,tempat,tgl_lahir,alamat,jk,no_tlp,bidang) VALUES 
    ('$nama','$tempat','$tgl_lahir','$alamat','$jk','$no_tlp','$bidang')";
    
    global $link;
    if(mysqli_multi_query($link, $query) or die('Error: ' . mysqli_error($link))) return true;
    else return false;
}
function ubahData($id,$nama,$tempat,$tgl_lahir,$alamat,$jk,$no_tlp,$bidang){
    $query = "UPDATE guru SET nama_guru='$nama',tempat='$tempat',tgl_lahir='$tgl_lahir',alamat='$alamat',
    jk='$jk',no_tlp='$no_tlp',bidang='$bidang' WHERE id_guru='$id'";
    // die(print_r($query));
    return run($query);
}
function hapusData($id){
    $query = "DELETE FROM guru WHERE id_guru='$id'";
    // die(print_r($query));
    return run($query);
}
function run($query){
    global $link;
    if(mysqli_query($link, $query) or die('Error: ' . mysqli_error($link))) return true;
    else return false;
}
?>