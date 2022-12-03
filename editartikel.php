<?php
require 'config.php';

session_start();

if($_SESSION['STATUS'] != 'admin'){
    header('Location: index.php');
}

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $q = mysqli_query($db, "SELECT * FROM NEWS WHERE ID_NEWS = $id");
  $data = mysqli_fetch_assoc($q);
}

if(isset($_POST['submit'])){

  

    $judul =  $_POST['judul'];
    
    $kategori = $_POST['kategori'];
    $isi = $_POST['isi'];
    
    

    $filename = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder = "./asset/" . $filename;

    if($filename == ""){
        $res = mysqli_query($db, "UPDATE NEWS SET JUDUL = '$judul', KATEGORI = '$kategori', ISI = '$isi' WHERE ID_NEWS = $id");
      } else {
        $res = mysqli_query($db, "UPDATE NEWS SET JUDUL = '$judul', KATEGORI = '$kategori', ISI = '$isi', GAMBAR = '$filename' WHERE ID_NEWS = $id");
        move_uploaded_file($tempname, $folder);
    }
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
                Artikel
            </div>
            <input type="hidden" name="tabel" value="NEWS">
            <div class="form-group">
              <label for="exampleInputEmail1">Judul</label>
              <input type="text" name="judul" class="form-control" id="exampleInputEmail1" value=<?=$data['JUDUL']?>>
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
              <textarea class="form-control" id="exampleFormControlTextarea1" name="isi" rows="3"><?=$data['ISI']?></textarea>
            </div>
            <div class="form-group">
              <label for="exampleFormControlFile1">Gambar</label>
              <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
        </form>
    </body>
</html>