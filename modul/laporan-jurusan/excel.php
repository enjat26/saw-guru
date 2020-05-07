<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=hasil.xls");
session_start();
require_once('../core/koneksi.php');
require_once('fungsi.php');
?>
<table id="sample-table-1"class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th class="kolom">No</th>
            <th class="kolom">Pelamar</th>
            <th class="kolom">Alamat</th>
            <th class="kolom">No Tlp/Hp</th>
            <th class="kolom">Bagian</th>
            <?php
            require_once('../core/koneksi.php');
            require_once('fungsi.php');
            $kd_penilaian = $_SESSION['penilaian'];
            $tampilKriteria = tampilKriteria($kd_penilaian);
            while($rPl=mysqli_fetch_assoc($tampilKriteria)):?>
                <th style="display:none"><?php echo $rPl['nama_kriteria']?>(<?php echo $rPl['kd_kriteria']?>)</th>
            <?php endwhile;?>
            <th>Nilai Rangking</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $kd_penilaian = $_SESSION['penilaian'];
            $tampilPelamar = tampilPelamar($kd_penilaian);
            $no =1;
            while($rPl=mysqli_fetch_assoc($tampilPelamar)):
            $no_pelamar = $rPl['no_pelamar']?>
            <tr>
                <td><?php echo$no?></td>
                <td><?php echo $rPl['nama_pelamar']?></td>
                <td><?php echo $rPl['alamat']?></td>
                <td><?php echo $rPl['no_tlp']?></td>
                <td><?php echo $rPl['bagian']?></td>
                <?php 
                $tampilNilai = tampilNilai($kd_penilaian,$no_pelamar);
                $hasil =0;
                while($rNl=mysqli_fetch_assoc($tampilNilai)):
                $kd_kriteria=$rNl['kd_kriteria']?>
                    <?php 
                    $tampilMax = tampilMax($kd_penilaian,$kd_kriteria);
                    // 
                    while($rMax=mysqli_fetch_assoc($tampilMax)):?>
                    <td style="display:none"><?php echo $rNl['nilai']/$rMax['max']?></td>
                    <?php $hasil += number_format(($rNl['nilai']/$rMax['max'])*$rNl['bobot_kriteria'],2); endwhile;?>
                <?php endwhile;?>
                    <td><?php echo $hasil?></td>
            </tr>
            <?php $no++; endwhile;?>
    </tbody>
</table>

    