<?php

session_start();

require 'config.php';

$status = $_SESSION['STATUS'];
$id_akun = $_SESSION['ID_AKUN'];

if ($status == 'user' || $status == 'admin') {

} else{
    header('Location: index.php');
}

if(isset($_POST['submit'])){
    $tabel = $_POST['tabel'];
    if($tabel == "NEWS"){
        $judul =  $_POST['judul'];
        $kategori = $_POST['kategori'];
        $isi = $_POST['isi'];

        $filename = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];
        $folder = "./asset/" . $filename;

        $res = mysqli_query($db, "INSERT INTO NEWS(JUDUL, KATEGORI, ISI, GAMBAR, ID_AKUN) VALUES('$judul', '$kategori', '$isi', '$filename', '$id_akun')");
        if($res){
            $res2 = move_uploaded_file($tempname, $folder);
            if($res2){
                echo "<script>
                    alert('Data Berhasil Ditambahkan!');
                </script>";
                if($status == 'user'){
                    echo " <script>
                    document.location.href = 'dashboard.php';
                    </script>";
                } else {
                    echo " <script>
                    document.location.href = 'admin.php';
                    </script>";
                }
            }else{
                echo "<script>
                alert('Data Gagal Ditambahkan!');
            </script>";
            if($status == 'user'){
                echo " <script>
                document.location.href = 'dashboard.php';
                </script>";
            } else {
                echo " <script>
                document.location.href = 'admin.php';
                </script>";
            }
            }
        } else {
            echo "<script>
            alert('Data Gagal Ditambahkan!');
        </script>";
        if($status == 'user'){
            echo " <script>
            document.location.href = 'dashboard.php';
            </script>";
        } else {
            echo " <script>
            document.location.href = 'admin.php';
            </script>";           
        }
        }
    }
    else if($tabel == "DESTINASI"){
        $nama = $_POST['nama'];
        $desk = $_POST['deskripsi'];

        $filename = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];
        $folder = "./asset/" . $filename;
        
        
        $res = mysqli_query($db, "INSERT INTO DESTINASI(GAMBAR, NAMA, DESKRIPSI) VALUES('$filename', '$nama', '$desk')");
        if($res){
            $res2 = move_uploaded_file($tempname, $folder);
            if($res2){
                echo "<script>
                    alert('Data Berhasil Ditambahkan!');
                </script>";
                if($status == 'user'){
                    echo " <script>
                    document.location.href = 'dashboard.php';
                    </script>";
                } else {
                    echo " <script>
                    document.location.href = 'admin.php';
                    </script>";
                }
            }else{
                echo "<script>
                alert('Data Gagal Ditambahkan!');
            </script>";
            if($status == 'user'){
                echo " <script>
                document.location.href = 'dashboard.php';
                </script>";
            } else {
                echo " <script>
                document.location.href = 'admin.php';
                </script>";
            }
            }
        } else {
            echo "<script>
            alert('Data Gagal Ditambahkan!');
        </script>";
        if($status == 'user'){
            echo " <script>
            document.location.href = 'dashboard.php';
            </script>";
        } else {
            echo " <script>
            document.location.href = 'admin.php';
            </script>";           
        }
        }

        
    }
    else if($tabel == "AKUN"){
        //Edit akun
        $username = $_POST['nama'];
        $email = $_POST['email'];
        $pw = $_POST['pw'];
        $birth = $_POST['birth'];
        $status = $_POST['status'];
        $real = $_POST['real'];

        $filename = $_FILES["file"]["name"];
        $tempname = $_FILES["file"]["tmp_name"];
        $folder = "./asset/" . $filename;
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

    </body>
</html>