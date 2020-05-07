<?php
session_start();
require_once("../mpdf/mpdf.php");
require_once('../core/koneksi.php');
require_once('fungsi.php');

$kd_penilaian = $_GET['ID'];
$mpdf=new mPDF('c', 'A4','','',10,10,45,10,10,10);
//right,left,top,bottom,header,footer
$mpdf->mirrorMargins = 1; 
// Define the Headers before writing anything so they appear on the first page
$stylesheet .=file_get_contents('style.css');
$header='<div style="width:100%; text-align:center"><img src="kop.png" width="80%" /></div><hr>';

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLHeader($header,'E');
// $mpdf->SetHTMLFooter($footer);
// $mpdf->SetHTMLFooter($footerE,'E');
$cari = $_GET['bidang'];
if($cari == ''){
    $q= "SELECT tgl_penilaian,kd_penilaian,bidang,id_user,jml_guru,COUNT(x.bidang)AS jm  FROM
        (SELECT a.bidang,b.* FROM (guru a JOIN penilaian_dt c ON a.id_guru=c.id_guru)
        JOIN penilaian b ON b.kd_penilaian=c.kd_penilaian GROUP BY a.id_guru,b.kd_penilaian) x GROUP BY kd_penilaian,bidang";
}else{
    $q= "SELECT tgl_penilaian,kd_penilaian,bidang,id_user,jml_guru,COUNT(x.bidang)AS jm  FROM
        (SELECT a.bidang,b.* FROM (guru a JOIN penilaian_dt c ON a.id_guru=c.id_guru)
        JOIN penilaian b ON b.kd_penilaian=c.kd_penilaian GROUP BY a.id_guru,b.kd_penilaian) x WHERE bidang = '$cari' GROUP BY kd_penilaian,bidang";
}
$html = '<h2 style="font-family:arial; text-align:center;">Laporan Data bidang</h2>';
$html .='
        <table>
            <tr>
                <th class="kolom">No</th>
                <th class="kolom">Kode Penilaian</th>
                <th class="kolom">Tanggal Penilaian</th>
                <th class="kolom">bidang</th>
                <th class="kolom">Batas Jumlah guru</th>
                <th class="kolom">Jumlah Pelamar</th>
            </tr>';

        
        $res = mysqli_query($link,$q);
        $no=1;
        while($r=mysqli_fetch_assoc($res)){
            $html .='
            <tr>
                <td class="kolom">'.$no.'</td>
                <td class="kolom">'.$r["kd_penilaian"].'</td>
                <td class="kolom">'.$r["tgl_penilaian"].'</td>
                <td class="kolom">'.$r["bidang"].'</td>
                <td class="kolom">'.$r["jml_guru"].'</td>
                <td class="kolom">'.$r["jm"].'</td>
            </tr>
            ';
        $no++;
        }
$html .='</table><br>';
$html .='<div style="float:left; width:500px;">&nbsp;</div>
        <div style="float:width:200px;">Serang, '.date('d M Y').'<br>Kepala Sekolah</div>
        <div style="display:block;clear:both;content:"";">&nbsp;</div>
        
        <br>
        <br>
        <br>

        <div style="float:left; width:500px;">&nbsp;</div>
        <div style="float:width:200px;"><b><u>Fauziah, SE.,M.Si</u></b><br>NIP. 19641208 19860 32 001</div>
';
$mpdf->SetTitle('Laporan Data bidang');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);


$mpdf->Output();
exit;
?>
    