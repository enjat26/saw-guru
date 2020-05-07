<?php
session_start();
require_once("../vendor/autoload.php");
require_once('../core/koneksi.php');

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L','margin_top' =>30]);
$mpdf->mirrorMargins = 1; 

ob_start();
?>
    <table>
        <tr>
            <th class="kolom">No</th>
            <th class="kolom">No Tes</th>
            <th class="kolom">Nama</th>
            <th class="kolom">Jenis Kelamin</th>
            <th class="kolom">Tempat, Tgl Lahir</th>
            <th class="kolom">Alamat</th>
            <th class="kolom">No Tlp/Hp</th>
            <th class="kolom">bidang</th>
        </tr>
        <?php
            $q= "SELECT * FROM guru";
            $res = mysqli_query($link,$q);
            $no=1;
            while($r=mysqli_fetch_assoc($res)) :
        ?>
            <tr>
                <td class="kolom">'.$no.'</td>
                <td class="kolom">'.$r["no_tes"].'</td>
                <td class="kolom">'.$r["nama_guru"].'</td>
                <td class="kolom">'.$r["jk"].'</td>
                <td class="kolom">'.$r["tempat"].', '.date("d M y", strtotime($r["tgl_lahir"])).'</td>
                <td class="kolom">'.$r["alamat"].'</td>
                <td class="kolom">'.$r["no_tlp"].'</td>
                <td class="kolom">'.$r["bidang"].'</td>
            </tr>
        <?php $no++; endwhile; ?>
    </table>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->SetTitle('Laporan Data guru');
$mpdf->WriteHTML($html,2);


$mpdf->Output();
exit;
?>
    