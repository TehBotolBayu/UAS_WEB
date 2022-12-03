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
    $id_rev = $_POST['id'];
    $destinasi = $_POST['destinasi'];
}

$sql = "SELECT * FROM REVIEW WHERE ID_REVIEW = $id_rev";
$res = mysqli_query($db, $sql);
$d = mysqli_fetch_assoc($res);
$nilai = $d['NILAI'];

$sql = "UPDATE DESTINASI SET RATING = RATING-$nilai WHERE ID_DESTINASI = $destinasi";
$res = mysqli_query($db, $sql);

$sql = "UPDATE REVIEW SET NILAI = '$rate', DESKRIPSI='$isi' WHERE ID_REVIEW = $id_rev";
$res = mysqli_query($db, $sql);

$sql = "UPDATE DESTINASI SET RATING = RATING+$rate WHERE ID_DESTINASI = $destinasi";
$res = mysqli_query($db, $sql);

echo "<script>alert('asd');</script>";

if($res){
    echo"<script>
        alert('Review berhasil diubah!');
        history.back();
    </script>";
} else {
    echo"<script>
    alert('Review gagal diubah!');
    history.back();
    </script>";
}


?>

