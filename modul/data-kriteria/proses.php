<?php
// session_start();
require_once('../core/koneksi.php');
require_once('fungsi.php');

$op = $_POST['op'];
if($op == 'simpan'){
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $atribut = $_POST["atribut"];
    $bobot = $_POST["bobot"];
    $kategori = $_POST["kategori"];

    $crud=$_POST["crud"];
    if($crud =='N'){
        $simpan = simpanData($id,$nama,$bobot,$atribut,$kategori);
        if($simpan){
            echo 'sukses';
        }else{
            echo 'eror';
        }
    }else{
        $ubah = ubahData($id,$nama,$bobot,$atribut,$kategori);
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
        $array['id']= $data['id_kriteria'];
        $array['nama']= $data['nama_kriteria'];
        $array['bobot']= $data['bobot_kriteria'];
        $array['atribut']= $data['atribut'];
        $array['kategori']= $data['kategori'];
    }
    // die(print_r($array));
    echo json_encode($array);
}

?>