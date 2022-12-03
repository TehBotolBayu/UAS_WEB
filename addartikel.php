<?php

session_start();

require 'config.php';

$status = $_SESSION['STATUS'];
$id_akun = $_SESSION['ID_AKUN'];

if ($status == 'user' || $status == 'admin') {
    $sql = "SELECT * FROM akun WHERE ID_AKUN = $id_akun";

    $result = mysqli_query($db, $sql);
    $data = mysqli_fetch_assoc($result);
  
    $user = $data['USERNAME'];
    $_SESSION['USERNAME'] = $data['USERNAME'];
} else{
    header('Location: index.php');
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
        <form method="POST" class="form" action="add.php" enctype="multipart/form-data">
            <div class="judul">
                Artikel
            </div>
            <input type="hidden" name="tabel" value="NEWS">
            <div class="form-group">
              <label for="exampleInputEmail1">Judul</label>
              <input type="text" name="judul" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Kategori</label>
              <select class="form-control" name="kategori" id="exampleFormControlSelect1">
                <option value="Travel">Travel</option>
                <option value="Live-Hacks">Live-Hacks</option>
                <option value="Food">Food</option>
                <option value="Holiday">Holiday</option>
                <option value="Animal">Animal</option>
                <option value="Hotel">Hotel</option>
                <option value="Transportation">Transportation</option>
                <option value="History">History</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Isi</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" name="isi" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleFormControlFile1">Gambar</label>
              <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
        </form>
    </body>
</html>