
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <div class="header">
                    <?php
                        require_once('modul/core/koneksi.php');
                        require_once('modul/penilaian/fungsi.php');
                        $idmenu = $_GET['id'];
                        $fatchid = explode('-',$idmenu);
                        $idnilai = $fatchid[0];
                        $idguru = $fatchid[1];
                        $showguru = tampilHeader($idguru);
                        $rs = mysqli_fetch_assoc($showguru);
                    ?>
                        <h2>Data Guru</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button id="btnAdd" class="btn bg-success waves-effect">Add Penilaian</button>
                            </li>
                        </ul>
                        <br>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-4">
                                    <input type="hidden" class="form-control" id="txtid" name="txtid" value="<?php echo empty($rs['id_guru']) ? "" : $rs['id_guru']?>" required="">
                                    <input type="hidden" id="crudmethod" value="N"> 
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="nama">Nama Guru</label>
                                        <input type="text" class="form-control focus" id="nama" name="nama" value="<?php echo empty($rs['nama_guru']) ? "" : $rs['nama_guru']?>" required="">
                                    </div>
                                </div>
                                <div class="form-group hidden">
                                    <div class="form-line">
                                        <label for="jk">Jenis Kelamin</label>
                                        <input type="text" class="form-control" id="jk" name="jk" value="<?php echo empty($rs['jk']) ? "" : $rs['jk']?>" required="" disabled>
                                    </div>
                                </div>
                                <div class="form-group hidden">
                                    <div class="form-line">
                                        <label for="alamat">Alamat</label>
                                        <textarea type="text" class="form-control" id="alamat" name="alamat" required="" disabled><?php echo empty($rs['alamat']) ? "" : $rs['alamat']?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="bidang">Kategori Guru</label>
                                        <input type="text" class="form-control focus" id="bidang" name="bidang" required="" value="<?php echo empty($rs['bidang']) ? "" : $rs['bidang']?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <br>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Form Penilaian</h2>
                        </div>
                        <div class="body">
                            <!-- <form id="frm"> -->
                            <table class="table table-striped" id="">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kriteria</th>
                                        <th>Ketegori</th>
                                        <th width="150">Nilai</th>
                                    </tr>
                                </thead>
                                <!-- <tbody> -->
                                    <?php
                                        $no =1;
                                        $showKriteria = tampilKriteria();
                                        // for($i=0;$i<count($showKriteria);$i++); 
                                        while($rKt = mysqli_fetch_assoc($showKriteria)):
                                        $id_kriteria = $rKt['id_kriteria'];
                                    ?>
                                        <tr>
                                            <td><?php echo $no;?> <input type="hidden" value="<?php echo $rKt['id_kriteria']?>" class="kriteria"></td>
                                            <td><b>(<span ><?php echo $rKt['kode_kriteria']?></span>)</b> <?php echo $rKt['nama_kriteria']?></td>
                                            <td><?php echo $rKt['kategori']?></td>
                                            <td>
                                                <select class="nilai form-control" data-placeholder="Pilih Nilai" name="nilai">
                                                    <option value="">Pilih Nilai</option>
                                                    <?php
                                                        $showPrferensi = tampilCrips($id_kriteria);
                                                        // die(print_r(mysqli_fetch_assoc($showPrferensi)));
                                                        while($rPf = mysqli_fetch_assoc($showPrferensi)):
                                                        $idcrips=$rPf['id_crips'];
                                                        $sgetKdCrips = getKdCrips($idnilai,$idguru,$idcrips);
                                                        $rCr = mysqli_fetch_assoc($sgetKdCrips);
                                                    ?>
                                                    <option <?php if($rCr['id_crips'] == $idcrips) echo ' selected'?> value="<?php echo $rPf['nilai_bobot'].'|'.$rPf['id_crips']?>"><?php echo $rPf['keterangan']?></option>
                                                    <?php endwhile;?>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php $no++; endwhile;?>
                                <!-- </tbody> -->
                            </table>
                            <button id="simpan" class="btn btn-small btn-primary">Simpan Data</button>
                            <button id="Addguru" class="btn bg-teal waves-effect">Tambah Data guru</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="header">
                            <h2>Penilaian Detail</h2>
                        </div>
                        <div class="body">
                            <!-- <form id="frm"> -->
                            <table class="table table-striped" id="">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Penilaian</th>
                                    <th>Tanggal Penilaian</th>
                                    <th>Nama guru</th>
                                    <th>Bidang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no1 =1;
                                    $tampilhistory1 = tampilhistoryID($idnilai);
                                    while($rh1 = mysqli_fetch_assoc($tampilhistory1)):
                                ?>
                                <tr>
                                    <td><?php echo $no1?></td>
                                    <td><?php echo $rh1['kode_penilaian']?></td>
                                    <td><?php echo $rh1['tgl_penilaian']?></td>
                                    <td><?php echo $rh1['nama_guru']?></td>
                                    <td><?php echo $rh1['bidang']?></td>
                                    <td><a href="index.php?menu=penilaian&id=<?php echo $rh1['id_penilaian'].'-'.$rh1['id_guru']?>" class="btn btn-sm btn-primary">Lihat</a></td>
                                </tr>
                                <?php $no1++; endwhile;?>
                            </tbody>
                        </table>
                        </div>
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
        $("#show").click(function(){
            $("#modalinput").modal("show");
            $("#modalinput").on("shown.bs.modal",function(){
                $("#tabelData").dataTable();
            });
        });
        $('#nama').autocomplete({
            source: function(request, response){
            $.ajax({
                url : 'modul/penilaian/proses.php',
                dataType: "json",
                method: 'post',
                data:{
                name_startsWith: request.term,
                op: 'atutocomplate',
                row_num : 1
                },
                success: function(data){
                response( $.map(data, function(item){
                    var code = item.split("|");
                    return {
                    label: code[2],
                    value: code[2],
                    data : item
                    }
                }));
                }
                });
            },
                autoFocus: true,	      	
                minLength: 0,
            select: function(event,ui) {
                var names = ui.item.data.split("|");	
                // alert(names[0]);			
                $('#txtid').val(names[0]);
                $('#nama').val(names[2]);
                $('#jk').val(names[3]);
                $('#alamat').val(names[4]);
                $('#bidang').val(names[5]);
            }		      	
        });
        $('.tanggal').datepicker({
            autoclose: true
        });

        $("#tabelData").dataTable();
        //button tambah
        $("#btnAdd").click(function(){
            window.location.href="index.php?menu=penilaian&id=0-0";
        });
        $("#Addguru").click(function(){
            window.location.href="index.php?menu=penilaian&id=<?php echo $idnilai?>-0";
        });
        //button simpan di modal

        $('#simpan').click(function(){
            var id = $("#txtid").val();
            var nilaiselect = $('select.nilai').val();
            if(id == ""){
                swal("Warning","Data tidak boleh kosong","warning");
                $("#nama").focus();
                // return;
            }else if(nilaiselect==""){
                swal("Warning","Data tidak boleh kosong","warning");
                $("#nama").focus();
            }else{
                var kriteria = [];
                var nilai = [];
                $('.kriteria').each(function(){
                    kriteria.push($(this).val());
                });

                $('select.nilai').each(function(){
                    nilai.push($(this).val());
                });
                var value = {
                    op: 'simpannilai',
                    idnilai:<?php echo $idnilai.','?>
                    kriteria: kriteria,
                    nilai: nilai,
                    idguru: id
                };
                $.ajax({
                    url : "modul/penilaian/proses.php",
                    type: "POST",
                    data : value,
                    cache:false,
                    success:function(msg,data, textStatus, jqXHR){
                        var result = msg.split('|');
                        var idurl = result[1]+'-'+result[2];
                        if(result[0]=='sukses'){
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
                                if (isConfirm) {
                                        window.location.href="index.php?menu=penilaian&id="+idurl;
                                }
                                    // });
                            });
                        }else{
                            swal("Perhatian","Data guru boleh kosong","error");
                        }
                    }
                });
            }
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
                url : "modul/data-guru/proses.php",
                type: "POST",
                data : value,
                success: function(data, textStatus, jqXHR){
                    var data = jQuery.parseJSON(data);
                    $("#crudmethod").val("E");
                    $("#txtid").val(data.id);
                    $("#nama").val(data.nama);
                    $("#tgl_lahir").val(data.tgl_lahir);
                    $("#alamat").val(data.alamat);
                    $("#tempat").val(data.tempat);
                    $("#jk").val(data.jk);
                    $("#bidang").val(data.bidang);
                    $("#no_tlp").val(data.no_tlp);
                    
                    $("#nama").focus();
                    $("#modalinput").modal("show");
                    $("#nama").focus();
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
                    url : "modul/data-guru/proses.php",
                    type: "POST",
                    data : value,
                    success: function(msg){
                        if(msg=='sukses'){
                            window.location.href="index.php?menu=data-guru&menu=master-data&ic=widgets";
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