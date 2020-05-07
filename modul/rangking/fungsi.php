<?php
function tampilhistory(){
    global $link;
    $query = "SELECT kode_penilaian,tgl_penilaian,id_penilaian,bidang,id_user,jml_guru,COUNT(x.bidang)AS jm  FROM
    (SELECT a.bidang,b.* FROM (guru a JOIN penilaian_dt c ON a.id_guru=c.id_guru)
    JOIN penilaian b ON b.id_penilaian=c.id_penilaian GROUP BY a.id_guru,b.id_penilaian) x GROUP BY id_penilaian,bidang";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilKriteria(){
    global $link;
    $query = "SELECT * FROM kriteria";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilNilai($id_penilaian,$id_guru){
    global $link;
    $query = "SELECT a.id_guru,a.nama_guru,b.*,c.bobot_kriteria,d.keterangan FROM 
    ((guru a JOIN penilaian_dt b ON a.id_guru=b.id_guru) 
    JOIN kriteria c ON b.id_kriteria=c.id_kriteria)
    JOIN crips d ON b.id_crips=d.id_crips
    WHERE b.id_penilaian='$id_penilaian' AND a.id_guru='$id_guru' ORDER BY b.id_kriteria ASC";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    // die(print_r($query));
    return $result;
}
function tampilguru($id_penilaian,$bidang){
    global $link;
    $query = "SELECT a.id_guru,a.nama_guru,b.* FROM guru a RIGHT JOIN penilaian_dt b
    ON a.id_guru=b.id_guru WHERE a.bidang = '$bidang' AND id_penilaian = $id_penilaian GROUP BY a.id_guru";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}

function tampiRangkingguru($id_penilaian,$bidang){
    global $link;
    $query = "SELECT a.*,b.* FROM (guru a JOIN penilaian_dt c ON a.id_guru=c.id_guru)
    JOIN penilaian b ON b.id_penilaian=c.id_penilaian WHERE a.bidang='$bidang' AND b.id_penilaian = '$id_penilaian' 
    GROUP BY a.id_guru,b.id_penilaian ORDER BY a.nilai_guru DESC";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function cekPenilaian($id_penilaian,$bidang){
    global $link;
    $query = "SELECT a.*,b.kode_penilaian FROM penilaian_bidang a JOIN penilaian b ON a.id_penilaian=b.id_penilaian WHERE b.id_penilaian = '$id_penilaian' AND a.bidang = '$bidang'";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    return $result;
}
function tampilMax($id_penilaian,$id_kriteria){
    global $link;
    $query = "SELECT MAX(nilai) AS max FROM penilaian_dt WHERE id_penilaian='$id_penilaian' AND id_kriteria='$id_kriteria' ORDER BY id_kriteria ASC";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    // die(print_r($query));
    return $result;
}
function cekbatas($id_penilaian,$bidang){
    global $link;
    $query = "SELECT id_penilaian FROM penilaian_bidang WHERE id_penilaian='$id_penilaian' AND bidang='$bidang'";
    $result = mysqli_query($link, $query) or die('Error: ' . mysqli_error($link));
    // die(print_r($query));
    return $result;
}
function ubahbatas($id_penilaian,$bidang,$batas){
    global $link;
    $query = "UPDATE penilaian_bidang SET jml_guru = $batas WHERE id_penilaian='$id_penilaian' AND bidang='$bidang';";
    $query .= "UPDATE penilaian_bidang SET status = 0 WHERE id_penilaian='$id_penilaian' AND bidang='$bidang'";
    global $link;
    if(mysqli_multi_query($link, $query) or die('Error: ' . mysqli_error($link))) return true;
    else return false;
}
function simpanbatas($id_penilaian,$batas,$bidang){
    global $link;
    $query = "INSERT INTO penilaian_bidang (bidang,id_penilaian,status,jml_guru) VALUES ('$bidang','$id_penilaian',0,$batas)";
    global $link;
    if(mysqli_query($link, $query) or die('Error: ' . mysqli_error($link))) return true;
    else return false;
}
function run($query){
    global $link;
    if(mysqli_query($link, $query) or die('Error: ' . mysqli_error($link))) return true;
    else return false;
}
?>