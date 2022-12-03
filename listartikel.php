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

?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="listartikel.css">
</head>
<body>
<header>
            <div class="logo">
                TRAVEL
            </div>
            <?php
            if($status != "admin" && $status != "user"){
            ?>
            <a class="signin" href="login.php">
                Sign In
            </a>
            <?php
            } else {
            ?>
             <a class="signin" href="logout.php">
                Log Out
            </a>           
            <?php
            }
            ?>
            <div class="navigasi">
                <a href="index.php">Home</a>
                <a href="listdestinasi.php">Destinasi</a>
                <?php
            if($status == "admin" || $status == "user"){
            ?>              
                <a href="dashboard.php">Dashboard</a>
                </a>
            <?php
            }
            ?>
                 <?php
            if($status == "admin"){
            ?>              
                <a href="admin.php">Admin Menu</a>
                </a>
            <?php
            }
            ?>           
            </div>
        </header>

    <div class="hero" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('asset/n3.jpg');">
        <div class="slogan">
            <h1 style="font-weight: bold">Our Community Article</h1>
            <p>
                Start Your Journey!
            </p>
        </div>
    </div>

    <div class="news text-center">
        <h1>News</h1>
        <p>See Article from our Community</p>
    </div>

    <?php
            $sql = "SELECT ID_NEWS, JUDUL, KATEGORI, GAMBAR, ID_AKUN, LEFT(ISI, 80) AS ISI FROM NEWS";
            $res = mysqli_query($db, $sql);
			while ($art = mysqli_fetch_assoc($res)) {
                $IDAC = $art['ID_AKUN'];
                $s = "SELECT USERNAME, PHOTO FROM AKUN WHERE ID_AKUN = $IDAC";
                $r = mysqli_query($db, $s);
                $d = mysqli_fetch_assoc($r);
        ?>
        <div class="berita">
            <div class="gambar" style="background-image: url('asset/<?=$art['GAMBAR']?>');">
            </div>
            <div class="isi">
                <h1 style="font-weight: bold;"><?=$art['JUDUL']?></h1>
                <p><?=$art['ISI']?><a href="artikel.php?id=<?=$art['ID_NEWS']?>">...Read More</a></p>
                <img src="asset/<?=$d['PHOTO']?>">
                <p class="username"><?=$d['USERNAME']?></p>
            </div>
        </div>

        <?php
            }
        ?>
    

    <!-- footer -->
    <footer class="text-center text-lg-start bg-light text-muted">
        <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <!-- Content -->
                <h5 class="text-uppercase fw-bold mb-4">
                <i class="fas fa-gem me-3"></i>TRAVEL
                </h5>
                <p>
                    Find Your Journey!
                </p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                Community
                </h6>
                <p>
                <a href="#!" class="text-reset">Article</a>
                </p>
                <p>
                <a href="#!" class="text-reset">FAQs</a>
                </p>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold mb-4">
                    Support
                </h6>
                <p>
                <a href="#!" class="text-reset">Help & Support</a>
                </p>
                <p>
                <a href="#!" class="text-reset">User Agreement</a>
                </p>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                <p><i class="fas fa-home me-3"></i> Samarinda, Indonesia</p>
                <p>
                <i class="fas fa-envelope me-3"></i>
                bayuuabdur2903@gmail.com
                </p>
                <p><i class="fas fa-phone me-3"></i> + 62 823 5338 6739</p>
            </div>
            </div>
        </div>
        </section>
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2020 - 2021 Copyright:
            <a class="text-reset fw-bold" href="#">UAS Pemrograman WEB Unmul</a>
        </div>
    </footer>
</body>
</html>