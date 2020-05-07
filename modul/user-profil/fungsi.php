<?php
function tampilkan(){
    global $link;
    $query = "SELECT * FROM user";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilID($id){
    global $link;
    $query = "SELECT * FROM user WHERE id_user = '$id'";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    // die(print_r($query));
    return $result;
}
function simpanData($nama,$username,$password,$role,$email,$img){
    $query = "INSERT INTO user (id_user,nama,username,password,role,email,img) VALUES 
    ('$nama','$username','$password','$role','$email','$img')";
    // die(print_r($query));
    return run($query);
}
function ubahData($id,$nama,$username,$password,$role){
    $query = "UPDATE user SET nama='$nama',username='$username',password='$password',role='$role',email='$email',img='$img' WHERE id_user='$id'";
    // die(print_r($query));
    return run($query);
}
function hapusData($id){
    $query = "DELETE FROM user WHERE id_user='$id'";
    // die(print_r($query));
    return run($query);
}
function run($query){
    global $link;
    if(mysqli_query($link, $query) or die('Error: ' . mysqli_error($link))) return true;
    else return false;
}
?>