<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Tabel Kategori Guru</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button type="button" class="btn bg-teal waves-effect" id="btnAdd">Add</button>
                            </li>
                        </ul>
                        <br>
                    </div>
                    <div class="body">
                        <table class="table table-striped" id="tabeldata">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kategori Guru</th>
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
                                    <td><?php echo $r['bidang'];?></td>
                                    <td>
                                        <button type="button" class="btnubah btn btn-sm btn-warning" idubah="<?php echo $r['id_bidang']?>"><i class="material-icons">mode_edit</i> Ubah</button>
                                        <button type="button" class="btnhapus btn btn-sm btn-danger" idhapus="<?php echo $r['id_bidang']?>"><i class="material-icons">delete</i> Hapus</button>
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
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalinputLabel">Form Kategori Guru</h4>
            </div>
            <div class="modal-body">
                <div class="form-group hidden">
                    <label for="txtid">ID</label>
                    <input type="text" class="form-control" id="txtid" name="txtid" required="">
                    <input type="hidden" id="crudmethod" value="N"> 
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="nama">Nama Kategori Guru</label>
                        <input type="text" class="form-control" id="nama" name="nama" required="">
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

<!-- datepicker Plugin Js -->
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
            $("#modalinput").on("shown.bs.modal",function(){
                $("#nama").focus();
            });
        });
        //button simpan di modal

        $('#simpan').click(function(){
        // alert('hj');
            var id = $("#txtid").val();
            var nama = $("#nama").val();
            var crud=$("#crudmethod").val();
            if(nama == ""){
                swal("Warning","Data tidak boleh kosong","warning");
                $("#nama").focus();
                return;
            }
            var op = 'simpan';
            var value = {
                id:id,
                nama:nama,
                op:op,
                crud:crud
            };
            $.ajax({
                url : "modul/data-bidang/proses.php",
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
                            window.location.href="index.php?menu=data-bidang";
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
                url : "modul/data-bidang/proses.php",
                type: "POST",
                data : value,
                success: function(data, textStatus, jqXHR){
                    var data = jQuery.parseJSON(data);
                    $("#crudmethod").val("E");
                    $("#txtid").val(data.id);
                    $("#nama").val(data.nama);
                    
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
                    url : "modul/data-bidang/proses.php",
                    type: "POST",
                    data : value,
                    success: function(msg){
                        if(msg=='sukses'){
                            window.location.href="index.php?menu=data-bidang";
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