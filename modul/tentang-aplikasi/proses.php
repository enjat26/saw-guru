<?php

require_once('../core/url.php');
require_once('../core/koneksi.php');
require_once('fungsi.php');

    if(isset($_POST['simpan'])){
        $fileSize = $_FILES['image']['size'];
        // die(print_r($_POST['simpan']));
        if($fileSize > 524280){
            echo '<script>alert("Gagal! Ukuran Gambar harus kurang dari 500kb"); 
            window.location.href="'.$url.'/index.php?link=user-profil&menu=pengaturan&ic=settings"; </script>';
            // header('location:'.$url.'/index.php?link=user-profil&menu=pengaturan&ic=settings');

        }else{
            $id=$_POST['iduser'];
            $pathimg=$_POST['pathimg'];
            // die(print_r($_POST['pathimg']));
            $nama=$_POST['nama'];
            $email=$_POST['email'];
            
            $fileData = pathinfo(basename($_FILES["image"]["name"]));
            $fileName = uniqid() . '.' . $fileData['extension'];

            $uname = strip_tags($_POST['username']);
            $upass = strip_tags($_POST['password']);
            $ulang = strip_tags($_POST['ulangi']);
            
            $username = mysqli_real_escape_string($link,$uname);
            $upass =  mysqli_real_escape_string($link,$upass);
            
            $password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version_compare
                
            if($upass != $ulang){
                echo '<script>alert("Gagal! Password tidak sama"); 
                window.location.href="'.$url.'/index.php?link=user-profil&menu=pengaturan&ic=settings"; </script>';
            }else{
                $u = "UPDATE user SET img='$fileName',nama='$nama',username='$username',password='$password',email ='$email' WHERE id_user='$id'";
                // die(print_r($u));
                $ubah = mysqli_query($link,$u);
            // die($ubah);
                if($ubah){
                    unlink("../../images/".$pathimg);
                    move_uploaded_file($_FILES['image']['tmp_name'], "../../images/".$fileName);
                    echo '<script>alert("Berhasil! Data berhasil disimpan"); 
                    window.location.href="'.$url.'/index.php?link=user-profil&menu=pengaturan&ic=settings"; </script>';
                }
            }
        }
    }
?>