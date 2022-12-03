<?php
require 'config.php';

session_start();

if($_SESSION['STATUS'] == 'admin'){
} else {
    header('Location: index.php');
}

if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <header>
            <div class="logo">
                TRAVEL
            </div>
            <a class="signin">
                Sign In
            </a>
            <div class="navigasi">
                <a href="listartikel.php">Artikel</a>
                <a href="listdestinasi.php">Destinasi</a>
                <a href="dashboard.php">Dashboard</a>
            </div>
        </header>

        <div class="sidemenu">
            <div class="jdl">
                Admin Menu
            </div>
            <div class="menu" onclick="tabel(1)">
                Account Data
            </div>
            <div class="menu" onclick="tabel(2)">
                Article Data
            </div>
            <div class="menu" onclick="tabel(3)">
                Destination Data
            </div>
            <div class="menu" onclick="tabel(4)">
                Review Data
            </div>
        </div>

        <form action="" method="GET">
            <input type="text" placeholder="<?=$cari?>" name="cari" style="margin-top: 30px; width: 20%; margin-left: 20px;">
            <button type="submit" name="submit"><i class="fa fa-search"></i></button>
        </form>
        <form action="" method="GET" >
            <input type="hidden" value="" name="cari">
            <button type="submit" name="submit" style="margin-left: 20px;">Show All</button>
        </form>

        <div class="container tabel akun">
                <div class="table-wrapper" style="overflow-x: auto;">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-8"><h2>Akun <b>Details</b></h2></div>
                            <a href="regis.php" class="col-sm-4">
                                <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                            </a>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Birth Date</th>
                                <th>Status</th>
                                <th>Photo</th>
                                <th>Real Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res1 = mysqli_query($db, "SELECT * FROM AKUN WHERE USERNAME LIKE '%$cari%' OR STATUS LIKE '%$cari%' OR EMAIL LIKE '%$cari%'");
                            while($data1 = mysqli_fetch_assoc($res1)){

                            ?>
                            <tr class="ss">
                                <td><?=$data1['ID_AKUN']?></td>
                                <td><?=$data1['USERNAME']?></td>
                                <td><?=$data1['EMAIL']?></td>
                                <td><?=$data1['BIRTH']?></td>
                                <td><?=$data1['STATUS']?></td>
                                <td><img height="50px" width="50px" src='asset/<?=$data1['PHOTO']?>'></td>
                                <td><?=$data1['REAL_NAME']?></td>
                                <td>
                                    <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                                    <a href="editstatus.php?id=<?=$data1['ID_AKUN']?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                    <a href="delete.php?id=<?=$data1['ID_AKUN']?>&tabel=AKUN&namaid=ID_AKUN" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
   
                        </tbody>
                    </table>
                </div>
        </div>
        <div class="container tabel artikel">
            <div class="table-wrapper" style="overflow-x: auto;">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Article <b>Details</b></h2></div>
                        <a href='addartikel.php' class="col-sm-4">
                            <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                        </a>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                            <th>Id Akun</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $res2 = mysqli_query($db, "SELECT * FROM NEWS  WHERE JUDUL LIKE '%$cari%' OR KATEGORI LIKE '%$cari%' OR ISI LIKE '%$cari%'");
                            while($data2 = mysqli_fetch_assoc($res2)){
                        ?>
                        <tr>
                            <td><?=$data2['ID_NEWS']?></td>
                            <td><?=$data2['JUDUL']?></td>
                            <td><?=$data2['ISI']?></td>
                            <td><?=$data2['KATEGORI']?></td>
                            <td><img height="50px" width="90px" src='asset/<?=$data2['GAMBAR']?>'></td>
                            <td><?=$data2['ID_AKUN']?></td>
                            <td>
                                <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                                <a href="editartikel.php?id=<?=$data2['ID_NEWS']?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="delete.php?id=<?=$data2['ID_NEWS']?>&tabel=NEWS&namaid=ID_NEWS" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>   
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container tabel destinasi">
        <div class="table-wrapper" style="overflow-x: auto;">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Destination <b>Details</b></h2></div>
                    <a href="adddestinasi.php" class="col-sm-4">
                        <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                        </a>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Rating</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $res3 = mysqli_query($db, "SELECT * FROM DESTINASI WHERE NAMA LIKE '%$cari%' OR DESKRIPSI LIKE '%$cari%'");
                        while($data3 = mysqli_fetch_assoc($res3)){
                    ?>
                    <tr>
                        <td><?=$data3['ID_DESTINASI']?></td>
                        <td><img height="50px" width="90px" src='asset/<?=$data3['GAMBAR']?>'></td>
                        <td><?=$data3['NAMA']?></td>
                        <td><?=$data3['RATING']?></td>
                        <td><?=$data3['DESKRIPSI']?></td>
                        <td><?=$data3['JUMLAH']?></td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a href="editdestinasi.php?id=<?=$data3['ID_DESTINASI']?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a href="delete.php?id=<?=$data3['ID_DESTINASI']?>&tabel=DESTINASI&namaid=ID_DESTINASI" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?> 
                </tbody>
            </table>
        </div>
        </div>
        <div class="container tabel review">
            <div class="table-wrapper" style="overflow-x: auto;">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Review <b>Details</b></h2></div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nilai</th>
                            <th>Deskripsi</th>
                            <th>Id Akun</th>
                            <th>Id Destinasi</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $res4 = mysqli_query($db, "SELECT * FROM REVIEW  WHERE DESKRIPSI LIKE '%$cari%' OR NILAI LIKE '%$cari%'");
                        while($data4 = mysqli_fetch_assoc($res4)){
                    ?>
                        <tr>
                            <td><?=$data4['ID_REVIEW']?></td>
                            <td><?=$data4['NILAI']?></td>
                            <td><?=$data4['DESKRIPSI']?></td>
                            <td><?=$data4['ID_AKUN']?></td>
                            <td><?=$data4['ID_DESTINASI']?></td>
                            <td>
                                <a href="delete.php?id=<?=$data4['ID_REVIEW']?>&tabel=REVIEW&namaid=ID_REVIEW" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>   
            function tabel(x){
                let a = document.getElementsByClassName('tabel');
                if(x == 1){
                    a[0].style.display = 'block';
                    a[1].style.display = 'none';
                    a[2].style.display = 'none';
                    a[3].style.display = 'none';
                }
                if(x == 2){
                    a[0].style.display = 'none';
                    a[1].style.display = 'block';
                    a[2].style.display = 'none';
                    a[3].style.display = 'none';
                }
                if(x == 3){
                    a[0].style.display = 'none';
                    a[1].style.display = 'none';
                    a[2].style.display = 'block';
                    a[3].style.display = 'none';
                }
                if(x == 4){
                    a[0].style.display = 'none';
                    a[1].style.display = 'none';
                    a[2].style.display = 'none';
                    a[3].style.display = 'block';
                }
                
            }
        </script>
    </body>
</html>