<?php
require_once("../vendor/autoload.php");
require_once('../core/koneksi.php');

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L','margin_top' =>5]);
$mpdf->mirrorMargins = 1; 
$stylesheet =file_get_contents('style.css');

$html = '<br><h2 style="font-family:arial; text-align:center;">Laporan Rangking</h2>';

$id_penilaian=$_GET['kp'];
$bidang=$_GET['jr'];
$cari = $_GET['l'];
if($cari == 'Lulus'){
    $q = "SELECT a.* FROM guru a JOIN penilaian_dt b
    ON a.id_guru=b.id_guru WHERE a.bidang = '$bidang' AND b.id_penilaian='$id_penilaian' 
    AND a.status_guru ='LULUS' GROUP BY a.id_guru";
}else if($cari == 'Tidak Lulus'){
    $q = "SELECT a.* FROM guru a JOIN penilaian_dt b
    ON a.id_guru=b.id_guru WHERE a.bidang = '$bidang' AND b.id_penilaian='$id_penilaian' 
    AND a.status_guru ='TIDAK LULUS' GROUP BY a.id_guru";
}else{
    $q = "SELECT a.* FROM guru a JOIN penilaian_dt b
    ON a.id_guru=b.id_guru WHERE a.bidang = '$bidang' AND b.id_penilaian='$id_penilaian' 
    GROUP BY a.id_guru";
}


$html .='<table>
            <tr>
                <td width="150" class="kolom">Kode Penilaian</td>
                <td width="10" class="kolom">&nbsp;:&nbsp;</td>
                <td class="kolom">'.$id_penilaian.'</td>
            </tr>
            <tr>
                <td class="kolom">bidang</td>
                <td class="kolom">&nbsp;:&nbsp;</td>
                <td class="kolom">'.$bidang.'</td>
            </tr>
        </table>
        
        <table>
        <tr>
            <th class="kolom">No</th>
            <th class="kolom">No Tes</th>
            <th class="kolom">Nama</th>
            <th class="kolom">Jenis Kelamin</th>
            <th class="kolom">Tempat, Tgl Lahir</th>
            <th class="kolom">Alamat</th>
            <th class="kolom">No Tlp/Hp</th>
            <th class="kolom">Nilai</th>
            <th class="kolom">Status</th>
            ';
$html .='</tr>';

            $no=1;
            $tampilKriteria = mysqli_query($link,$q);
            while($rPl=mysqli_fetch_assoc($tampilKriteria)):
$html .='
<tr>';
            $html .='
            <td class="kolom">'.$no.'</td>
            <td class="kolom">'.$rPl["no_tes"].'</td>
            <td class="kolom">'.$rPl["nama_guru"].'</td>
            <td class="kolom">'.$rPl["jk"].'</td>
            <td class="kolom">'.$rPl["tempat"].', '.date("d M y", strtotime($rPl["tgl_lahir"])).'</td>
            <td class="kolom">'.$rPl["alamat"].'</td>
            <td class="kolom">'.$rPl["no_tlp"].'</td>
            <td class="kolom">'.$rPl["nilai_guru"].'</td>
            <td class="kolom">'.$rPl["status_guru"].'</td>';
            $no++;
$html .='</tr>';
            endwhile;

$html .='</table><br><br>';
$html .='<div style="float:left; width:700px;">&nbsp;</div>
        <div style="float:width:200px;">Serang, '.date('d M Y').'<br>Kepala Sekolah</div>
        <div style="display:block;clear:both;content:"";">&nbsp;</div>
        
        <br>
        <br>
        <br>

        <div style="float:left; width:700px;">&nbsp;</div>
        <div style="float:width:200px;"><b><u>Fauziah, SE.,M.Si</u></b><br>NIP. 19641208 19860 32 001</div>
';
$mpdf->SetTitle('Laporan Data Rangking');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);


$mpdf->Output();
exit;
?>
    