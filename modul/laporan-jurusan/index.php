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
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            .:: <?php echo strtoupper($lk)?> ::.
                        </h2>
                    </div>
                    <div class="body">
                        <form action="modul/laporan-bidang/cetak.php" method="get">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="bidang">Cetak Berdasarkan bidang</label>
                                    <select class="form-control" id="bidang" name="bidang" required="">
                                        <option value="">Pilih bidang</option>
                                        <?php $showJ = tampilbidang();
                                            $noj = 1;
                                            while($rj = mysqli_fetch_assoc($showJ)) :
                                        ?>
                                            <option value="<?php echo $rj['bidang']?>"><?php echo $rj['bidang']?></option>
                                        <?php $no++; endwhile;?>               
                                    </select>
                                <div>
                            </div>
                    </div>
                    <br>
                    <input type="submit" class="btn bg-teal waves-effect" name="cetak" value="Cetak">
                    </form>
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
                            window.location.href="index.php?link=data-crips&menu=master-data&ic=widgets";
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
                            window.location.href="index.php?link=data-crips&menu=master-data&ic=widgets";
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