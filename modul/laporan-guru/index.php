<?php
require_once("../vendor/autoload.php");
require_once('../core/koneksi.php');

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L','margin_top' =>5]);
$mpdf->mirrorMargins = 1; 
$stylesheet =file_get_contents('style.css');

$html = '<br><h2 style="font-family:arial; text-align:center;">Laporan Data guru</h2>';
$html .='
        <table>
            <tr>
                <th class="kolom">No</th>
                <th class="kolom">Nama</th>
                <th class="kolom">Jenis Kelamin</th>
                <th class="kolom">Tempat, Tgl Lahir</th>
                <th class="kolom">Alamat</th>
                <th class="kolom">No Tlp/Hp</th>
                <th class="kolom">Kategori Guru</th>
            </tr>';
        $q= "SELECT * FROM guru";
        $res = mysqli_query($link,$q);
        $no=1;
        while($r=mysqli_fetch_assoc($res)){
            $html .='
            <tr>
                <td class="kolom">'.$no.'</td>
                <td class="kolom">'.$r["nama_guru"].'</td>
                <td class="kolom">'.$r["jk"].'</td>
                <td class="kolom">'.$r["tempat"].', '.date("d M y", strtotime($r["tgl_lahir"])).'</td>
                <td class="kolom">'.$r["alamat"].'</td>
                <td class="kolom">'.$r["no_tlp"].'</td>
                <td class="kolom">'.$r["bidang"].'</td>
            </tr>
            ';
        $no++;
        }
$html .='</table><br><br>';
$html .='<div style="float:left; width:700px;">&nbsp;</div>
        <div style="float:width:200px;">Serang, '.date('d M Y').'<br>Kepala Sekolah</div>
        <div style="display:block;clear:both;content:"";">&nbsp;</div>
        
        <br>
        <br>
        <br>

        <div style="float:left; width:700px;">&nbsp;</div>
        <div style="float:width:200px;"><b><u>Hj. Dedeh Komarawati, S.Pd., MM</u></b><br>NIP. 19641208 19860 32 001</div>
';
$mpdf->SetTitle('Laporan Data guru');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);


$mpdf->Output();
exit;
?>
    