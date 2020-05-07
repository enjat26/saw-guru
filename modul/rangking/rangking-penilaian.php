
<section class="content">
    <div class="container-fluid">
        <div class="hidden">
            <?php
                $id_penilaian=$_GET['kp'];
                $bidang=$_GET['jr'];
                require_once('modul/core/koneksi.php');
                require_once('fungsi.php');
                $cekPenilaian = cekPenilaian($id_penilaian,$bidang);
                $rC = mysqli_fetch_assoc($cekPenilaian);
                $status = $rC['status'];
                $jm = $rC['jml_guru'];
            ?>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    
                    <div class="header">
                        <h2>
                            HASIL PENILAIAN
                        </h2>
                    </div>
                    <div class="body">
                        <!-- <form id="frm"> -->
                        <table width="50%" class="table table-striped table-bordered">
                            <tr>
                                <td width="200">Kode Penilaian</td>
                                <td width="10">:</td>
                                <td><?php echo $_GET['kode']?></td>
                            </tr>
                            <tr>
                                <td>Kategori Guru</td>
                                <td>:</td>
                                <td><?php echo $bidang?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Klasifikasi</td>
                                <td>:</td>
                                <td><input style="width:10%" type="text" id="batas" class="form-control" value="<?php echo $jm?>"> <em>Jumlah ini menunjukan batas jumlah guru yang masuk klasifikasi</em></td>
                            </tr>
                            <tr>
                                <td colspan="3"><button id="ubahbatas" class="btn btn-small btn-primary">Ubah Jumlah</button></td>
                            </tr>
                        </table>
                        <table id="sample-table-1"class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Nama Gruru</th>
										<?php
										$tampilKriteria = tampilKriteria($id_penilaian);
										while($rPl=mysqli_fetch_assoc($tampilKriteria)):?>
											<th><?php echo $rPl['nama_kriteria']?>(<?php echo $rPl['id_kriteria']?>)</th>
										<?php endwhile;?>
									</tr>
								</thead>
								<tbody>
									<?php
										$tampilguru = tampilguru($id_penilaian,$bidang);
										while($rPl=mysqli_fetch_assoc($tampilguru)):
										$id_guru = $rPl['id_guru']?>
										<tr>
											<td><?php echo $rPl['nama_guru']?></td>
											<?php 
											$tampilNilai = tampilNilai($id_penilaian,$id_guru);
											while($rNl=mysqli_fetch_assoc($tampilNilai)):?>
												<td><?php echo $rNl['keterangan']?></td>
											<?php endwhile;?>
										</tr>
										<?php endwhile;?>
								</tbody>
							</table>
                            <?php 
                            if($jm == 0){
                             echo '
                                <div class="alert bg-red alert-dismissible" role="alert">
                                    Perhatian! jumlah klasifikasi masih 0, silahakan isi datanya terlebih dahulu untuk melanjutkan proses rangking
                                </div>
                             ';
                            }
                            ?>
                            <?php 
                            if($status == 0){
                             echo '
                                <div class="alert bg-red alert-dismissible" role="alert">
                                    Perhatian! data ini belum melakukan proses rangking. Klik tombol<b> PROSES RANGKING</b> untuk me-rangking guru
                                </div>
                                <button id="prosesrangking" class="btn btn-small btn-primary">Proses Rangking</button>
                             ';
                            }
                            ?>
                              
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix <?php if($status == 0){echo 'hidden';}?>">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    
                    <div class="header">
                        <h2>
                            HASIL RANGKING
                        </h2>
                    </div>
                    <div class="body">
                        <!-- <form id="frm"> -->
                        <table id="sample-table-1"class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Gruru</th>
                                    <th>Alamat</th>
                                    <th>Tlp/Hp</th>
                                    <th>Nilai</th>
                                    <th>Rangking</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no=1;
                                    $tampiRangkingguru = tampiRangkingguru($id_penilaian,$bidang);
                                    while($rg=mysqli_fetch_assoc($tampiRangkingguru)):?>
                                    <tr>
                                        <td><?php echo $rg['nama_guru']?></td>
                                        <td><?php echo $rg['alamat'];?></td>
                                        <td><?php echo $rg['no_tlp'];?></td>
                                        <td><?php echo $rg['nilai_guru'];?></td>
                                        <td><?php echo $no;?></td>
                                        <td>
                                        <?php 
                                            if($no <= $jm){
                                                echo '<span class="statusguru label label-success">Masuk Klasifikasi</span>';
                                            }else{
                                                echo '<span class="statusguru label label-danger">Tidak Masuk Klasifikasi</span>';
                                            }
                                        ?>
                                        </td>
                                    </tr>
                                <?php $no++; endwhile;?>
                            </tbody>
                        </table>
                        <button id="modal" class="btn btn-small btn-primary">Lihat Perhitungan SAW</button>
                        <a href="index.php?menu=rangking" class="btn btn-small btn-danger">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL -->
        <div class="modal fade" id="modalinput" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalinputLabel">Hasil Perhitungan SAW</h4>
                    </div>
                    <div class="modal-body">
                        <h3>Hasil Penilaian</h3>
                        <table id="sample-table-1"class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Gruru</th>
                                    <?php
                                    $tampilKriteria = tampilKriteria($id_penilaian);
                                    while($rPl=mysqli_fetch_assoc($tampilKriteria)):?>
                                        <th><?php echo $rPl['nama_kriteria']?>(<?php echo $rPl['id_kriteria']?>)</th>
                                    <?php endwhile;?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $tampilguru = tampilguru($id_penilaian,$bidang);
                                    while($rPl=mysqli_fetch_assoc($tampilguru)):
                                    $id_guru = $rPl['id_guru']?>
                                    <tr>
                                        <td><?php echo $rPl['nama_guru']?></td>
                                        <?php 
                                        $tampilNilai = tampilNilai($id_penilaian,$id_guru);
                                        while($rNl=mysqli_fetch_assoc($tampilNilai)):
                                            $id_kriteria=$rNl['id_kriteria']?>
                                                <?php 
                                                $tampilMax = tampilMax($id_penilaian,$id_kriteria);
                                                while($rMax=mysqli_fetch_assoc($tampilMax)):?>
                                                <td><?php echo number_format($rNl['nilai'],2)?></td>
                                                <?php endwhile;?>
                                        <?php endwhile;?>
                                    </tr>
                                    <?php endwhile;?>
                            </tbody>
                        </table>
                        <h3>Hasil Normalisasi</h3>
                        <table id="sample-table-1"class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Gruru</th>
                                    <?php
                                    $tampilKriteria = tampilKriteria($id_penilaian);
                                    while($rPl=mysqli_fetch_assoc($tampilKriteria)):?>
                                        <th><?php echo $rPl['nama_kriteria']?>(<?php echo $rPl['id_kriteria']?>)</th>
                                    <?php endwhile;?>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $tampilguru = tampilguru($id_penilaian,$bidang);
                                    while($rPl=mysqli_fetch_assoc($tampilguru)):
                                    $id_guru = $rPl['id_guru']?>
                                    <tr>
                                        <td class="hidden idguru"><?php echo $rPl['id_guru']?></td>
                                        <td><?php echo $rPl['nama_guru']?></td>
                                        <?php 
                                        $tampilNilai = tampilNilai($id_penilaian,$id_guru);
                                        while($rNl=mysqli_fetch_assoc($tampilNilai)):
                                            $id_kriteria=$rNl['id_kriteria']?>
                                                <?php 
                                                $tampilMax = tampilMax($id_penilaian,$id_kriteria);
                                                $hasil = 0;
                                                while($rMax=mysqli_fetch_assoc($tampilMax)):?>
                                                <td><?php echo number_format($rNl['nilai']/$rMax['max'],2)?></td>
                                                <?php $hasil += number_format(($rNl['nilai']/$rMax['max'])*$rNl['bobot_kriteria'],2); endwhile;?>
                                        <?php endwhile;?>
                                        <td class="hasil"><?php echo $hasil;?></td>
                                    </tr>
                                    <?php endwhile;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        $("#modal").click(function(){
            $("#modalinput").modal("show");
        });
    });

    $('#ubahbatas').click(function(){
        var batas = $("#batas").val();
        if(batas == "" || batas == 0){
            swal("Warning","Data jumlah batas guru tidak boleh kosong","warning");
            $("#batas").focus();
            // return;
        }else{
            var value = {
                op: 'ubahbatas',
                idnilai:<?php echo $id_penilaian.','?>
                bidang:'<?php echo $bidang ?>',
                batas: batas
            };
            $.ajax({
                url : "modul/rangking/proses.php",
                type: "POST",
                data : value,
                cache:false,
                success:function(msg,data, textStatus, jqXHR){
                    if(msg=='sukses'){
                        swal({
                            title: "Berhasil!",
                            text: "Data berhasil disimpan",
                            type: "success",
                            confirmButtonColor: "#1f91f3",
                            confirmButtonText: "OK",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm){
                            if (isConfirm){
                                    window.location.href="index.php?menu=rangking-penilaian&kode=<?php echo $_GET['kode']?>&kp=<?php echo $id_penilaian.'&jr='.$bidang?>";
                            }
                        });
                    }else{
                        swal("Perhatian","Gagal menyimpan data","error");
                    }
                }
            });
        }
    });

    $('#prosesrangking').click(function(){
        var batas = $("#batas").val();
        if(batas == "" || batas == 0){
            swal("Warning","Data jumlah klasifikasi tidak boleh kosong","warning");
            $("#nama").focus();
            // return;
        }else{
            var idguru = [];
            var hasil = [];
            var statusguru = [];
            $('.idguru').each(function(){
                idguru.push($(this).text());
            });

            $('.hasil').each(function(){
                hasil.push($(this).text());
            });

            $('.statusguru').each(function(){
                statusguru.push($(this).text());
            });
            var value = {
                op: 'prosesrangking',
                idguru: idguru,
                hasil: hasil,
                statusguru:statusguru,
                id_penilaian:<?php echo $id_penilaian;?>,
                bidang:'<?php echo $bidang;?>'
            };
            $.ajax({
                url : "modul/rangking/proses.php",
                type: "POST",
                data : value,
                cache:false,
                success:function(msg,data, textStatus, jqXHR){
                    if(msg=='sukses'){
                        swal({
                            title: "Berhasil!",
                            text: "Data berhasil disimpan",
                            type: "success",
                            confirmButtonColor: "#1f91f3",
                            confirmButtonText: "OK",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm){
                            if (isConfirm){
                                    window.location.href="index.php?menu=rangking-penilaian&kode=<?php echo $_GET['kode']?>&kp=<?php echo $id_penilaian.'&jr='.$bidang?>";
                            }
                        });
                    }else{
                        swal("Perhatian","Gagal menyimpan data","error");
                    }
                }
            });
        }
    });
</script>   

</body>
</html>