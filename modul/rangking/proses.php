<?php
// session_start();
require_once('../core/koneksi.php');
require_once('fungsi.php');

$op = $_POST['op'];
if($op =='ubahbatas'){
    $id_penilaian = $_POST['idnilai'];
    $batas = $_POST['batas'];
    $bidang = $_POST['bidang'];
    $cekbatas = cekbatas($id_penilaian,$bidang);
    if(mysqli_num_rows($cekbatas) > 0){
        $ubahbatas = ubahbatas($id_penilaian,$bidang,$batas);
        if($ubahbatas){
            echo 'sukses';
        }else{
            echo 'gagal';
        }
    }else{
        $simpanbatas = simpanbatas($id_penilaian,$batas,$bidang);
        if($simpanbatas){
            echo 'sukses';
        }else{
            echo 'gagal';
        }
    }
}elseif($op =='prosesrangking'){
    $idguru = $_POST['idguru'];
    $hasil = $_POST['hasil'];
    $statusguru = $_POST['statusguru'];
    $id_penilaian = $_POST['id_penilaian'];
    $bidang = $_POST['bidang'];
    $q2 = '';
    for($i=0; $i<count($idguru);$i++){
        $cleanidguru = mysqli_real_escape_string($link,$idguru[$i]);
        $cleanhasil = mysqli_real_escape_string($link,$hasil[$i]);
        $cleanstatusguru = mysqli_real_escape_string($link,$statusguru[$i]);
        $q2 .= "UPDATE guru SET nilai_guru = $cleanhasil, status_guru='$cleanstatusguru' WHERE id_guru = '$cleanidguru';";
        $q2 .= "UPDATE penilaian_bidang SET status = 1 WHERE id_penilaian='$id_penilaian' AND bidang ='$bidang';";

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