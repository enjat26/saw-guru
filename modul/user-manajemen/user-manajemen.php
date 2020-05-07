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
                        <div class="align-right">
                            <button type="button" class="btn bg-teal waves-effect" id="btnAdd"><i class="material-icons">add_box</i> TAMBAH DATA</button>
                        </div>
                    </div>
                    <div class="body">
                        <table class="table table-striped" id="tabeldata">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>role</th>
                                    <th>Email</th>
                                    <th>Img</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $show = tampilkan();
                                    $no = 1;
                                    while($r = mysqli_fetch_assoc($show)) :
                                ?>
                                    <tr>
                                        <td><?php echo $no;?></td>
                                        <td><?php echo $r['nama'];?></td>
                                        <td><?php echo $r['role'];?></td>
                                        <td><?php echo $r['email'];?></td>
                                        <td><?php echo $r['img'];?></td>
                                        <td>
                                            <button type="button" class="btnubah btn btn-sm btn-warning" idubah="<?php echo $r['id_user']?>"><i class="material-icons">mode_edit</i> Ubah</button>
                                            <button type="button" class="btnhapus btn btn-sm btn-danger" idhapus="<?php echo $r['id_user']?>"><i class="material-icons">delete</i> Hapus</button>
                                        </td>
                                    </tr>
                                <?php $no++; endwhile;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalinput" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:grey; color:#fff">
                <h4 class="modal-title" id="modalinputLabel"><?php echo $lk?></h4>
            </div>
            <div class="modal-body">
                <div class="form-group hidden">
                    <label for="txtid">ID</label>
                    <input type="text" class="form-control" id="txtid" name="txtid" required="">
                    <input type="hidden" id="crudmethod" value="N"> 
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="nama">Nama User</label>
                        <input type="text" class="form-control focus" id="nama" name="nama" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="password">password</label>
                        <input type="password" class="form-control" id="password" name="password" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="role">role</label>
                        <select class="form-control" id="role" name="role" required="">
                            <option value="Administrator">Administrator</option>
                            <option value="Siswa">Siswa</option>
                            <option value="Panitia">Panitia</option>
                        </select>
                    </div>                            
                </div>
            </div>
            <div class="modal-footer">
                <button id="simpan" class="btn btn-small btn-primary">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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
        $('.tanggal').datepicker({
            autoclose: true
        });

        $("#tabeldata").dataTable();
        //button tambah
        $("#btnAdd").click(function(){
            $("#modalinput").modal("show");
                
            $("#crudmethod").val("N");
            $("#nama").val("");
            $("#role").val("");
            $("#username").val("");
            $("#password").val("");
            $("#modalinput").on("shown.bs.modal",function(){
                $("#nama").focus();
            });
        });
        //button simpan di modal

        $('#simpan').click(function(){
        // alert('hj');
            var id = $("#txtid").val();
            var nama = $("#nama").val();
            var username = $("#username").val();
            var password = $("#password").val();
            var role = $("#role").val();
            var crud=$("#crudmethod").val();
            if(nama == "" || username =="" || password == "" || role == ""){
                swal("Warning","Data tidak boleh kosong","warning");
                $("#nama").focus();
                return;
            }
            var op = 'simpan';
            var value = {
                id:id,
                nama:nama,
                role:role,
                username:username,
                password:password,
                op:op,
                crud:crud
            };
            $.ajax({
                url : "modul/user-manajemen/proses.php",
                type: "POST",
                data : value,
                cache:false,
                success:function(msg,data, textStatus, jqXHR){
                // var data = jQuery.parseJSON(data);
                    if(msg=='sukses'){
                        swal({
                        title: "Success!",
                        text: "Berhasi disimpan",
                        type: "success",
                        confirmButtonColor: "#DDa1d9f26B55",
                        confirmButtonText: "OK",
                        closeOnConfirm: false
                        },
                        function(){
                            window.location.href="index.php?link=user-manajemen&menu=pengaturan&ic=settings";
                        });
                    }else{
                        swal("Alert!","Gagal","error");
                    }
                }
            });
        });
        //button edit di grid
        $(document).on('click','.btnubah',function(){
            var id=$(this).attr("idubah");
            var op = 'tampilID';
            var value = {
                id: id,
                op:op
            };
            $.ajax({
                url : "modul/user-manajemen/proses.php",
                type: "POST",
                data : value,
                success: function(data, textStatus, jqXHR){
                    var data = jQuery.parseJSON(data);
                    $("#crudmethod").val("E");
                    $("#txtid").val(data.id);
                    $("#nama").val(data.nama);
                    $("#username").val(data.username);
                    $("#role").val(data.role);
                    
                    $("#modalinput").modal("show");
                    $("#modalinput").on("shown.bs.modal",function(){
                        $("#nama").focus();
                    });
                    $("#txtid").attr("disabled","true");
                },
                error: function(jqXHR, textStatus, errorThrown){
                    swal("Error!", textStatus, "error");
                }
            });
        });
        //button delete di grid
        $(document).on('click','.btnhapus',function(){
            var id = $(this).attr("idhapus");
            var parent = $(this).parent("td").parent("tr");
            var op = "hapus";
            var value = {
                id : id,
                op : op
            };	
            swal({
                title: "Confirm?",
                text: "Yakin Akan dihapus?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OK",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                    url : "modul/user-manajemen/proses.php",
                    type: "POST",
                    data : value,
                    success: function(msg){
                        if(msg=='sukses'){
                            window.location.href="index.php?link=user-manajemen&menu=pengaturan&ic=settings";
                        }else{
                            swal("Alert!","Gagal","error");
                        }
                    }
                    });
                }else{
                    swal("Cancelled", "Dibatalkan!", "error");
                }
            });
        });
    });
</script>   

</body>
</html>