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
                    <div class="header">
                        <h2>
                            .:: <?php echo strtoupper($lk)?> ::.
                        </h2>
                    </div>
                    <?php
                        $id = $_SESSION['userIDSession'];
                        $shUser = tampilID($id);
                        $rU = mysqli_fetch_assoc($shUser);
                    ?>
                    <div class="body">
                    <form action="modul/user-profil/proses.php" method="POST" enctype="multipart/form-data">
                        <div class="form-line">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $rU['nama']?>" require>
                                        <input type="hidden" class="form-control" id="id" name="iduser" value="<?php echo $rU['id_user']?>">
                                        <input type="hidden" class="form-control" id="pathimg" name="pathimg" value="<?php echo $rU['img']?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="email">email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $rU['email']?>" require>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $rU['username']?>" require>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" require>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="ulangi">Ulangi Password</label>
                                        <input type="password" class="form-control" id="ulangi" name="ulangi" require>
                                    </div>
                                </div>
                                <p>Please Choose Image: </p><input id="uploadImage" type="file" name="image" onchange="PreviewImage();"><br>
                                <p><em>*Ukuran gambar max 500kb dan disarankan berbentuk persegi</em> </p>
                                <input type="submit" value="Simpan" name="simpan" class="btn btn-small btn-primary">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </form>
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
        function PreviewImage() {
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

            oFReader.onload = function (oFREvent) {
                document.getElementById("uploadPreview").src = oFREvent.target.result;
            };
        };
    });
</script>  

</body>
</html>