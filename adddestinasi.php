<?php
require 'config.php';

session_start();

if($_SESSION['STATUS'] != 'admin'){
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
                Destinasi
            </div>
            <input type="hidden" name="tabel" value="DESTINASI">
            <div class="form-group">
              <label for="exampleFormControlInput1">Nama Destinasi</label>
              <input type="text" name="nama" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Deskripsi</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" name="deskripsi" rows="3"></textarea>
            </div>
            
            <div class="form-group">
              <label for="exampleFormControlFile1">Gambar</label>
              <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
            </div>

            <input type="submit" name="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
        </form>
    </body>
</html>