<?php
// session_start();
require_once('../core/koneksi.php');
require_once('fungsi.php');

$op = $_POST['op'];
if($op == 'simpan'){
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $tempat = $_POST["tempat"];
    $tgl_lahir = date("Y/m/d", strtotime($_POST["tgl_lahir"]));
    $jk = $_POST["jk"];
    $no_tlp = $_POST["no_tlp"];
    $bidang = $_POST["bidang"];

    $crud=$_POST["crud"];
    if($crud =='N'){
        $simpan = simpanData($nama,$tempat,$tgl_lahir,$alamat,$jk,$no_tlp,$bidang);
        if($simpan){
            echo 'sukses';
        }else{
            echo 'eror';
        }
    }else{
        $ubah = ubahData($id,$nama,$tempat,$tgl_lahir,$alamat,$jk,$no_tlp,$bidang);
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
        $array['id']= $data['id_guru'];
        $array['nama']= $data['nama_guru'];
        $array['tempat']= $data['tempat'];
        $array['tgl_lahir']= $data['tgl_lahir'];
        $array['alamat']= $data['alamat'];
        $array['no_tlp']= $data['no_tlp'];
        $array['jk']= $data['jk'];
        $array['bidang']= $data['bidang'];
    }
    // die(print_r($array));
    echo json_encode($array);
}

?>