<?php
require 'config.php';

session_start();

if($_SESSION['STATUS'] != 'admin'){
    header('Location: index.php');
}

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $q = mysqli_query($db, "SELECT * FROM AKUN WHERE ID_AKUN = $id");
  $data = mysqli_fetch_assoc($q);
}

if(isset($_POST['submit'])){

    $stat =  $_POST['status'];
    
    $res = mysqli_query($db, "UPDATE AKUN SET STATUS = '$stat' WHERE ID_AKUN = $id");

    
    if($res){
        echo "<script>
        alert('Data Berhasil Diubah!');
        document.location.href='admin.php';
        </script>";
    } else {
        echo "<script>
        alert('Data Gagal Diubah!');
        document.location.href='admin.php';
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
                Status Akun <?=$data['USERNAME']?>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Status</label>
              <select class="form-control" name="status" id="exampleFormControlSelect1">
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="ban">Ban</option>
              </select>
            </div>
            <input type="submit" name="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
            <a href="admin.php" class="btn btn-primary">Cancel</a>
        </form>
    </body>
</html>