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
}

if(isset($_POST['submit'])){
    $isi = $_POST['isi'];
    $rate =  $_POST['stars'];
    $akun =  $_POST['akun'];
    $destinasi = $_POST['destinasi'];
}


$sql = "INSERT INTO REVIEW (NILAI, DESKRIPSI, ID_AKUN, ID_DESTINASI) VALUES ('$rate', '$isi', '$akun', '$destinasi')";
$res = mysqli_query($db, $sql);

$sql = "UPDATE DESTINASI SET JUMLAH = JUMLAH+1 WHERE ID_DESTINASI = $destinasi";
$res = mysqli_query($db, $sql);

$sql = "UPDATE DESTINASI SET RATING = RATING+$rate WHERE ID_DESTINASI = $destinasi";
$res = mysqli_query($db, $sql);

if($res){
    echo"<script>
        alert('Review berhasil ditambahkan!');
        document.location.href = 'destinasi.php?id=$destinasi';
    </script>";
} else {
    echo"<script>
    alert('Review gagal ditambahkan!');
    document.location.href = 'destinasi.php?id=$destinasi';
    </script>";
}


?>

