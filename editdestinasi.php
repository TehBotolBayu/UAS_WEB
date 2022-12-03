<?php
require 'config.php';

session_start();

if($_SESSION['STATUS'] != 'admin'){
    header('Location: index.php');
}

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $q = mysqli_query($db, "SELECT * FROM DESTINASI WHERE ID_DESTINASI = $id");
  $data = mysqli_fetch_assoc($q);
}

if(isset($_POST['submit'])){
  $nama = $_POST['nama'];
  $desk = $_POST['deskripsi'];

  $filename = $_FILES["file"]["name"];
  $tempname = $_FILES["file"]["tmp_name"];
  $folder = "./asset/" . $filename;

  if($filename == ""){
    $res = mysqli_query($db, "UPDATE DESTINASI SET NAMA='$nama', DESKRIPSI='$desk' WHERE ID_DESTINASI = $id");
  } else {
    $res = mysqli_query($db, "UPDATE DESTINASI SET GAMBAR='$filename', NAMA='$nama', DESKRIPSI='$desk' WHERE ID_DESTINASI = $id");
    move_uploaded_file($tempname, $folder);
  }
  if($res){
    echo "<script>
    alert('Data Berhasil Ditambahkan!');
    document.location.href='admin.php';
    </script>";
  } else {
    echo "<script>
    alert('Data Gagal Ditambahkan!');
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
                Destinasi
            </div>
            <input type="hidden" name="tabel" value="DESTINASI">
            <div class="form-group">
              <label for="exampleFormControlInput1">Nama Destinasi</label>
              <input type="text" name="nama" class="form-control" id="exampleFormControlInput1" value=<?=$data['NAMA']?>>
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Deskripsi</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" name="deskripsi" rows="3"><?=$data['DESKRIPSI']?></textarea>
            </div>
            
            <div class="form-group">
              <label for="exampleFormControlFile1">Gambar</label>
              <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
            </div>

            <input type="submit" name="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
        </form>
    </body>
</html>