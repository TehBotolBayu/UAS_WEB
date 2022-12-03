<?php
require 'config.php';

session_start();

if($_SESSION['STATUS'] == 'admin' || $_SESSION['STATUS'] == 'user'){
}else {
    header('Location: index.php');
}

$id_akun = $_SESSION['ID_AKUN'];

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $q = mysqli_query($db, "SELECT * FROM AKUN WHERE ID_AKUN = $id_akun");
  $data = mysqli_fetch_assoc($q);
}

if(isset($_POST['submit'])){
    
    $username = $_POST['nama'];


    
    $q2 = mysqli_query($db, "SELECT * FROM AKUN WHERE USERNAME = '$username'");
    // echo "<script>alert('ff');</script>";
    if(mysqli_num_rows($q2)>0){
        echo "<script>
            alert('Username telah digunakan');
            document.location.href='dashboard.php';
            </script>";      
    }
    // echo "<script>alert('ff');</script>";
    $birth = $_POST['birth'];
    $real = $_POST['real'];

    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "./asset/" . $filename;

    

    if($filename == ""){
        $res = mysqli_query($db, "UPDATE AKUN SET USERNAME='$username', BIRTH='$birth', REAL_NAME='$real' WHERE ID_AKUN = $id_akun");
      } else {
        $res = mysqli_query($db, "UPDATE AKUN SET USERNAME='$username', BIRTH='$birth', REAL_NAME='$real', PHOTO='$filename' WHERE ID_AKUN = $id_akun");
        // echo "<script>alert('ff');</script>";
        $res2 = move_uploaded_file($tempname, $folder);
    }
    if($res){
        echo "<script>
        alert('Data Berhasil Diubah!');
        document.location.href='dashboard.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Diubah!');
        document.location.href='dashboard.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="form.css">
    </head>
    <body>
        <form method="POST" class="form" action="" enctype="multipart/form-data">
            <div class="judul">
                Nama Form
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Username</label>
              <input type="text" name="nama" class="form-control" id="exampleFormControlInput1" required>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Date of Birth</label>
              <input type="date" name="birth" class="form-control" id="exampleFormControlInput1" required>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Real Name</label>
              <input type="text" name="real" class="form-control" id="exampleFormControlInput1">
            </div>
            
            <div class="form-group">
              <label for="exampleFormControlFile1">Profile Picture</label>
              <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
            </div>

            <input type="submit" name="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
            <a href='dashboard.php' class="btn btn-primary" style="margin-top: 10px;">Cancel</button>
        </form>
    </body>
</html>