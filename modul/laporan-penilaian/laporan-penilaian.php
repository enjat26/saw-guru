
<section class="content">
    <div class="container-fluid">
        <?php require_once('modul/core/breadcrumbs.php')?>
        <div class="card">
            <div class="header bg-grey">
                <h2>
                    <?php echo $lk?> <small>Menu ini digunakan untuk mengelola <?php echo $lk?></small>
                </h2>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-cyan">
                        <h2>
                            LAPORAN PENILAIAN
                        </h2>
                    </div>
                    <div class="body">
                        <!-- <form id="frm"> -->
                        <table class="table table-striped" id="tabelData">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Penilaian</th>
                                    <th>Tanggal Penilaian</th>
                                    <th>bidang</th>
                                    <th>Jumlah Pelamar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no =1;
                                    $tampilhistory = tampilhistory();
                                    while($rh = mysqli_fetch_assoc($tampilhistory)):
                                ?>
                                <tr>
                                    <td><?php echo $no?></td>
                                    <td><?php echo $rh['kd_penilaian']?></td>
                                    <td><?php echo $rh['tgl_penilaian']?></td>
                                    <td><?php echo $rh['bidang']?></td>
                                    <td><?php echo $rh['jm']?></td>
                                    <td><a target="_blank" href="modul/laporan-penilaian/cetak.php?kp=<?php echo $rh['kd_penilaian'].'&jr='.$rh['bidang']?>" class="btn btn-sm btn-warning">Cetak</a></td>
                                </tr>
                                <?php $no++; endwhile;?>
                            </tbody>
                        </table>
                        <!-- <a href="index.php?link=rangking-penilaian&menu=transaksi&ic=update&kp=" class="btn btn-sm btn-warning">Cetak Semua</a> -->
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Jquery Core Js -->
<script src="<?php echo $url?>/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo $url?>/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo $url?>/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo $url?>/plugins/node-waves/waves.js"></script>

<!-- Jquery Ui Plugin -->
<script src="<?php echo $url;?>/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="<?php echo $url?>/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo $url?>/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

<!-- SweetAlert Plugin Js -->
<script src="<?php echo $url?>/plugins/sweetalert/sweetalert.min.js"></script>

<!-- SweetAlert Plugin Js -->
<script src="<?php echo $url?>/plugins/datepicker/bootstrap-datepicker.min.js"></script>

<!-- Custom Js -->
<script src="<?php echo $url?>/js/admin.js"></script>

<script>
    $(function(){
        $("#tabelData").dataTable();
    });

    
</script>   

</body>
</html>