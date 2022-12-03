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