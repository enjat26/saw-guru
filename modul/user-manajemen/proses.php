<?php
// session_start();
require_once('../core/koneksi.php');
require_once('fungsi.php');

$op = $_POST['op'];
if($op == 'simpan'){
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $upass = $_POST["password"];
    $password = password_hash($upass, PASSWORD_DEFAULT);
    $role = $_POST["role"];

    $crud=$_POST["crud"];
    if($crud =='N'){
        $simpan = simpanData($nama,$password,$username,$role);
        if($simpan){
            echo 'sukses';
        }else{
            echo 'eror';
        }
    }else{
        $ubah = ubahData($id,$nama,$password,$username,$role);
        if($ubah){
            echo 'sukses';
        }else{
            echo 'eror';
        }
    }
}elseif($op == 'hapus'){
    $id = $_POST['id'];
    $hapus = hapusData($id);
    if($hapus){
        echo 'sukses';
    }else{
        echo 'eror';
    }
}elseif($op == 'tampilID'){
    $id=$_POST['id'];
    $show = tampilID($id);
    $array = array();
    while($data = mysqli_fetch_array($show)){
        $array['id']= $data['id_user'];
        $array['nama']= $data['nama'];
        $array['password']= $data['password'];
        $array['username']= $data['username'];
        $array['role']= $data['role'];
    }
    // die(print_r($array));
    echo json_encode($array);
}

?>