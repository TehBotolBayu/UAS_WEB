<?php
require 'config.php';

session_start();

if($_SESSION['STATUS'] != 'admin'){
    header('Location: index.php');
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $tabel = $_GET['tabel'];
    $nama_id = $_GET['namaid'];
}

if($tabel == 'REVIEW'){

    $n = mysqli_query($db, "SELECT * FROM REVIEW WHERE ID_REVIEW = $id");
    $n = mysqli_fetch_assoc($n);
    $id_des = $n['ID_DESTINASI'];
    $nilai = $n['NILAI'];
    $q = mysqli_query($db, "UPDATE DESTINASI SET JUMLAH=JUMLAH-1, RATING=RATING-$nilai WHERE ID_DESTINASI = $id_des");
}

$q = mysqli_query($db, "DELETE FROM $tabel WHERE $nama_id = $id");
if($q){
    echo "<script>
        alert('DATA TERHAPUS!');
        history.back();
        </script>";
} else {
    echo "<script>
    alert('DATA GAGAL TERHAPUS');
    history.back();
    </script>";
}



?>