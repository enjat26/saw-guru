<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Tabel Crips</h2>
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
                                    <th>No</th>
                                    <th>Kriteria</th>
                                    <th>Keterangan</th>
                                    <th>Nilai</th>
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
                                        <td><?php echo '<b>('.$r["kode_kriteria"].')</b>'.' '.$r["nama_kriteria"];?></td>
                                        <td><?php echo $r['keterangan'];?></td>
                                        <td><?php echo $r['nilai_bobot'];?></td>
                                        <td>
                                            <button type="button" class="btnubah btn btn-sm btn-warning" idubah="<?php echo $r['id']?>"><i class="material-icons">mode_edit</i> Ubah</button>
                                            <button type="button" class="btnhapus btn btn-sm btn-danger" idhapus="<?php echo $r['id']?>"><i class="material-icons">delete</i> Hapus</button>
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
            <div class="modal-header">
                <h4 class="modal-title" id="modalinputLabel">From Crips</h4>
            </div>
            <div class="modal-body">
                <div class="form-group hidden">
                    <label for="txtid">ID</label>
                    <input type="text" class="form-control" id="txtid" name="txtid" required="">
                    <input type="hidden" id="crudmethod" value="N"> 
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="kriteria">Kriteria</label>
                        <select class="form-control" id="kriteria" name="kriteria" required="">
                            <option value="">Pilih Kriteria</option>
                            <?php $showJ = tampilkriteria();
                                while($rj = mysqli_fetch_assoc($showJ)) :
                            ?>
                                <option value="<?php echo $rj['id_kriteria']?>"><?php echo $rj['nama_kriteria']?></option>
                            <?php endwhile;?>               
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="nilai">Nilai</label>
                        <input type="text" class="form-control numbersOnly" id="nilai" name="nilai" required="">
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
        $('.numbersOnly').keyup(function(){
            if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
            this.value = this.value.replace(/[^0-9\.]/g, '');
            }
        });
        
        $('.tanggal').datepicker({
            autoclose: true
        });

        $("#tabeldata").dataTable();
        //button tambah
        $("#btnAdd").click(function(){
            $("#modalinput").modal("show");
                
            $("#crudmethod").val("N");
            $("#keterangan").val("");
            $("#nilai").val("");
            $("#kriteria").val("");
            $("#modalinput").on("shown.bs.modal",function(){
                $("#kriteria").focus();
            });
        });
        //button simpan di modal

        $('#simpan').click(function(){
        // alert('hj');
            var id = $("#txtid").val();
            var keterangan = $("#keterangan").val();
            var nilai = $("#nilai").val();
            var kriteria = $("#kriteria").val();
            var crud=$("#crudmethod").val();
            if(keterangan == "" || nilai =="" || kriteria==""){
                swal("Warning","Data tidak boleh kosong","warning");
                $("#keterangan").focus();
                return;
            }
            var op = 'simpan';
            var value = {
                id:id,
                keterangan:keterangan,
                kriteria:kriteria,
                nilai:nilai,
                op:op,
                crud:crud
            };
            $.ajax({
                url : "modul/data-crips/proses.php",
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
                            window.location.href="index.php?menu=data-crips";
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
                url : "modul/data-crips/proses.php",
                type: "POST",
                data : value,
                success: function(data, textStatus, jqXHR){
                    var data = jQuery.parseJSON(data);
                    $("#crudmethod").val("E");
                    $("#txtid").val(data.id);
                    $("#keterangan").val(data.keterangan);
                    $("#nilai").val(data.nilai);
                    $("#kriteria").val(data.kriteria);
                    
                    $("#modalinput").modal("show");
                    $("#modalinput").on("shown.bs.modal",function(){
                        $("#kriteria").focus();
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
                    url : "modul/data-crips/proses.php",
                    type: "POST",
                    data : value,
                    success: function(msg){
                        if(msg=='sukses'){
                            window.location.href="index.php?menu=data-crips";
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