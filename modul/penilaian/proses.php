<?php
// session_start();
require_once('../core/koneksi.php');
require_once('fungsi.php');

$op = $_POST['op'];
if($op == 'simpannilai'){
    // die();
    $idpenilaian = $_POST['idnilai'];
    $idguru = $_POST["idguru"];
    $kriteria=$_POST['kriteria'];
    $nilai=$_POST['nilai'];
    $tampilid = tampilID($idpenilaian);
    if(mysqli_num_rows($tampilid) > 0){
        $tampilidguru = tampilIDdanguru($idpenilaian,$idguru);
        if(mysqli_num_rows($tampilidguru) > 0){
            //ubah detail
            $q2 = '';
            for($i=0; $i<count($kriteria);$i++){
                $cleankriteria = mysqli_real_escape_string($link,$kriteria[$i]);
                $cleannilai = mysqli_real_escape_string($link,$nilai[$i]);
                $arrnilai = explode('|',$cleannilai);
                $nilaiNew = $arrnilai[0];
                $kdcrips = $arrnilai[1];
                $q2 .= "UPDATE penilaian_dt SET nilai = '$nilaiNew', id_crips = '$kdcrips'
                WHERE id_penilaian = '$idpenilaian' AND id_guru = '$idguru' AND id_kriteria='$cleankriteria';";
                $q2 .="UPDATE penilaian SET status=0 WHERE id_penilaian = '$idpenilaian';";
        
            }
            // die(print_r($q2));
            $s2 = mysqli_multi_query($link,$q2);
            if($s2){
                echo 'sukses'.'|'.$idpenilaian.'|'.$idguru;
            }else{
                echo 'gagal';
            }
        }else{
            //detail
            $q = '';
            for($i=0; $i<count($kriteria);$i++){
                $cleankriteria = mysqli_real_escape_string($link,$kriteria[$i]);
                $cleannilai = mysqli_real_escape_string($link,$nilai[$i]);
                $arrnilai = explode('|',$cleannilai);
                $nilaiNew = $arrnilai[0];
                $kdcrips = $arrnilai[1];
                $q .= "INSERT INTO penilaian_dt (id_penilaian,id_guru,id_kriteria,nilai,id_crips) VALUES ('".$idpenilaian."','".$idguru."','".$cleankriteria."','".$nilaiNew."','".$kdcrips."');";
                $q .="UPDATE penilaian SET status=0 WHERE id_penilaian = '$idpenilaian';";
            }
            $s = mysqli_multi_query($link,$q);
            if($s){
                echo 'sukses'.'|'.$idpenilaian.'|'.$idguru;
            }else{
                echo 'gagal';
            }
        }
    
    }else{
        //simpan header & detail
        // die('sas');
        $simpanheader = simpanheader();
        $kdpenilaian = mysqli_insert_id($link);
        $q = '';
        for($i=0; $i<count($kriteria);$i++){
            $cleankriteria = mysqli_real_escape_string($link,$kriteria[$i]);
            $cleannilai = mysqli_real_escape_string($link,$nilai[$i]);
            $arrnilai = explode('|',$cleannilai);
            $nilaiNew = $arrnilai[0];
            $kdcrips = $arrnilai[1];
            $q .= "INSERT INTO penilaian_dt (id_penilaian,id_guru,id_kriteria,nilai,id_crips) VALUES ('".$kdpenilaian."','".$idguru."','".$cleankriteria."','".$nilaiNew."','".$kdcrips."');";
            $q .="UPDATE penilaian SET status=0 WHERE id_penilaian = '$kdpenilaian';";
        }
        // die(print_r($q));
        $s = mysqli_multi_query($link,$q);
        // die(print_r($s));
        if($s){
            echo 'sukses'.'|'.$kdpenilaian.'|'.$idguru;
        }else{
            echo 'gagal';
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
}elseif($op == 'atutocomplate'){
	$row_num = $_POST['row_num'];
	$kode = $_POST['name_startsWith'];
    $show2 = autoComplate($kode);
	$data = array();
	while ($row = mysqli_fetch_assoc($show2)) {
		$name = $row['id_guru'].'|tes|'.$row['nama_guru'].'|'.$row['jk'].'|'.$row['alamat'].'|'.$row['bidang'].'|'.$row_num;
		array_push($data, $name);	
	}	
	echo json_encode($data);
}

?>