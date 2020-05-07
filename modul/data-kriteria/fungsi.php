<?php
function tampilkan(){
    global $link;
    $query = "SELECT * FROM kriteria";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilID($id){
    global $link;
    $query = "SELECT * FROM kriteria WHERE id_kriteria = '$id'";
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
function simpanData($id,$nama,$bobot,$atribut,$kategori){
    $kode=kode_otomatis();
    $query = "INSERT INTO kriteria (id_kriteria,nama_kriteria,bobot_kriteria,atribut,kategori,kode_kriteria) VALUES 
    (0,'$nama','$bobot','$atribut','$kategori','$kode')";
    // die(print_r($query));
    return run($query);
}
function ubahData($id,$nama,$bobot,$atribut,$kategori){
    $query = "UPDATE kriteria SET nama_kriteria='$nama',bobot_kriteria='$bobot',atribut='$atribut',kategori='$kategori' WHERE id_kriteria='$id'";
    // die(print_r($query));
    return run($query);
}
function hapusData($id){
    $query = "DELETE FROM kriteria WHERE id_kriteria='$id'";
    // die(print_r($query));
    return run($query);
}
function run($query){
    global $link;
    if(mysqli_query($link, $query) or die('Error: ' . mysqli_error($link))) return true;
    else return false;
}
function kode_otomatis(){
    global $link;
    $query = "SELECT max(kode_kriteria) as maxKode FROM kriteria";
    $hasil = mysqli_query($link,$query);
    $data = mysqli_fetch_array($hasil);
    $kode = $data['maxKode'];
    $noUrut = (int) substr($kode, 3, 3);
    $noUrut++;
    $char = "KDR";
    $kode = $char . sprintf("%03s", $noUrut);
    return $kode;
}
?>