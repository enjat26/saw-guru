<?php
// session_start();
require_once('../core/koneksi.php');
require_once('fungsi.php');

$op = $_POST['op'];
if($op == 'simpan'){
    $id = $_POST["id"];
    $kriteria = $_POST["kriteria"];
    $keterangan = $_POST["keterangan"];
    $nilai = $_POST["nilai"];

    $crud=$_POST["crud"];
    if($crud =='N'){
        $simpan = simpanData($kriteria,$keterangan,$nilai);
        if($simpan){
            echo 'sukses';
        }else{
            echo 'eror';
        }
    }else{
        $ubah = ubahData($id,$kriteria,$keterangan,$nilai);
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
        $array['id']= $data['id'];
        $array['kriteria']= $data['id_kriteria'];
        $array['keterangan']= $data['keterangan'];
        $array['nilai']= $data['nilai_bobot'];
    }
    // die(print_r($array));
    echo json_encode($array);
}

?>