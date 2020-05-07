<?php
session_start();
require_once("../mpdf/mpdf.php");
require_once('../core/koneksi.php');

// $kd_penilaian = $_GET['ID'];
$mpdf=new mPDF('c', array(200,150),'','',10,10,10,0,0);
$id = $_GET['id'];
$q = "SELECT * FROM guru WHERE id_guru = '$id' OR nama_guru = '$id'";
$s = mysqli_query($link,$q);
$r = mysqli_fetch_assoc($s);
$html = '<div style="width:100%; text-align:center"><img src="kop.png" width="80%" /></div><hr>
<br><h2 style="font-family:arial; text-align:center;">KARTU TES</h2>';
$html .='
        <table>
            <tr>
                <td>No Tes</td><td>&nbsp; : &nbsp;</td><td>'.$r["no_tes"].'</td>
            </tr>
            <tr>
                <td>Nama</td><td>&nbsp; : &nbsp;</td><td>'.$r["nama_guru"].'</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td><td>&nbsp; : &nbsp;</td><td>'.$r["jk"].'</td>
            </tr>
            <tr>
                <td>Alamat</td><td>&nbsp; : &nbsp;</td><td>'.$r["alamat"].'</td>
            </tr>
            <tr>
                <td>No Tlp/Hp</td><td>&nbsp; : &nbsp;</td><td>'.$r["no_tlp"].'</td>
            </tr>
            <tr>
                <td>bidang</td><td>&nbsp; : &nbsp;</td><td>'.$r["bidang"].'</td>
            </tr>
        </table><br><br>';

        $html .='
        <table>
            <tr>
                <td></td>
                <td style="width:70%"></td>
                <td>Serang, '.date("d M Y").'</td>
            </tr>
            <tr>
                <td>Nama Pendaftar</td>
                <td></td>
                <td>Panitian</td>
            </tr>
            <tr>
                <td><br><br><br><br></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>'.$r["nama_guru"].'</td>
                <td></td>
                <td>(.................)</td>
            </tr>
        </table>';

        
$mpdf->SetTitle('Kartu Tes');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);


$mpdf->Output();
exit;
?>
    