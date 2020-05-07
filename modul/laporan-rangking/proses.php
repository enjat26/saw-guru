<?php
// session_start();
require_once('../core/koneksi.php');
require_once('fungsi.php');

$op = $_POST['op'];
if($op =='ubahbatas'){
    $id_penilaian = $_POST['idnilai'];
    $batas = $_POST['batas'];
    $ubahbatas = ubahbatas($id_penilaian,$batas);
    if($ubahbatas){
        echo 'sukses';
    }else{
        echo 'gagal';
    }
}elseif($op =='prosesrangking'){
    $idguru = $_POST['idguru'];
    $hasil = $_POST['hasil'];
    $id_penilaian = $_POST['id_penilaian'];
    $q2 = '';
    for($i=0; $i<count($idguru);$i++){
        $cleanidguru = mysqli_real_escape_string($link,$idguru[$i]);
        $cleanhasil = mysqli_real_escape_string($link,$hasil[$i]);
        $q2 .= "UPDATE guru SET nilai_guru = $cleanhasil WHERE id_guru = '$cleanidguru';";
        $q2 .= "UPDATE penilaian SET status = 1 WHERE id_penilaian='$id_penilaian';";

    }
    // die(print_r($q2));
    $s2 = mysqli_multi_query($link,$q2);
    if($s2){
        echo 'sukses';
    }else{
        echo 'gagal';
    }
}
?>