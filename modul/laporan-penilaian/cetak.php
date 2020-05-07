<?php
session_start();
require_once("../mpdf/mpdf.php");
require_once('../core/koneksi.php');
require_once('fungsi.php');

$kd_penilaian = $_GET['ID'];
$mpdf=new mPDF('c', 'A4-L','','',10,10,45,10,10,10);
//right,left,top,bottom,header,footer
$mpdf->mirrorMargins = 1; 
// Define the Headers before writing anything so they appear on the first page
$stylesheet .=file_get_contents('style.css');
$header='<div style="width:100%; text-align:center"><img src="kop.png" width="80%" /></div><hr>';

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLHeader($header,'E');
// $mpdf->SetHTMLFooter($footer);
// $mpdf->SetHTMLFooter($footerE,'E');

$html = '<br><h2 style="font-family:arial; text-align:center;">Laporan Penilaian</h2>';

$kd_penilaian=$_GET['kp'];
$bidang=$_GET['jr'];
$cekPenilaian = cekPenilaian($kd_penilaian);
$rC = mysqli_fetch_assoc($cekPenilaian);
$status = $rC['status'];
$jm = $rC['jml_guru'];

$html .='<table style="border:0" width="170px">
            <tr><td>Kode Penilaian</td><td>&nbsp;:&nbsp;</td><td>'.$kd_penilaian.'</td></tr>
            <tr><td>bidang</td><td>&nbsp;:&nbsp;</td><td>'.$bidang.'</td></tr>
        </table>

        <table>
        <tr>
            <th class="kolom">No.</th>
            <th class="kolom">Nama Pelamar</th>';
            $tampilKriteria = tampilKriteria($kd_penilaian);
            while($rPl=mysqli_fetch_assoc($tampilKriteria)):
            $html .='<th class="kolom">'.$rPl["nama_kriteria"].'('.$rPl['id_kriteria'].')</th>';
            endwhile;
        $html .='</tr>';

        $no=1;
        $tampilguru = tampilguru($kd_penilaian,$bidang);
        while($rPl=mysqli_fetch_assoc($tampilguru)):
        $id_guru = $rPl['id_guru'];
        $html .='<tr>
            <td class="kolom">'.$no.'</td>
            <td class="kolom">'.$rPl['nama_guru'].'</td>';
            $tampilNilai = tampilNilai($kd_penilaian,$id_guru);
            while($rNl=mysqli_fetch_assoc($tampilNilai)):
            $html .='<td class="kolom">'.$rNl['keterangan'].'</td>';
            endwhile;
        $html .='<tr>'; 
        $no++;
        endwhile;
$html .='</table><br><br>';
$html .='<div style="float:left; width:700px;">&nbsp;</div>
        <div style="float:width:200px;">Serang, '.date('d M Y').'<br>Kepala BBPLK Serang</div>
        <div style="display:block;clear:both;content:"";">&nbsp;</div>
        
        <br>
        <br>
        <br>

        <div style="float:left; width:700px;">&nbsp;</div>
        <div style="float:width:200px;"><b><u>Fauziah, SE.,M.Si</u></b><br>NIP. 19641208 19860 32 001</div>
';
$mpdf->SetTitle('Laporan Data guru');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);


$mpdf->Output();
exit;
?>
    