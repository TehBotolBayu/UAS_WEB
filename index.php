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
        <link rel="stylesheet" href="index.css">
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
                <a href="listartikel.php">Artikel</a>
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
        
        
        <div class="hero">
            <div class="slogan">
                <h1 style="font-weight: bold">Welcome to Indonesia</h1>
                <p>
                    Start Your Journey!
                </p>
                <div class="search-container">
                    <form action="cari.php" method="POST">
                        <input type="text" placeholder="Cari Destinasi" name="cari">
                        <button type="submit" name="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>       
            </div>

        </div>

        <div class="bg">
            <div class="navcard">
                <a href="#history"><img src="asset/149235.png" height="50px"><p>History</p></a>
                <a href="#Destination"><img src="asset/149226.png" height="50px"><p>Destination</p></a>
                <a href="#News"><img src="asset/149366.png" height="50px"><p>News</p></a>
            </div>
        </div>

        <div id="history">     
            <div id="text1">
                <h1 style="font-weight: bold">Explore</h1>
                Travel opens your heart, broadens your mind, and fills your life with stories to tell.
                <hr>
            </div>
        </div>

        <div class="destination">
            <h1 style="font-weight: bold">
                Discover New Place
            </h1>


            
        

        <!----------
        slider
            ------------->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                $sql = "SELECT JUMLAH, ID_DESTINASI, GAMBAR, NAMA, RATING, LEFT(DESKRIPSI, 80) AS DESKRIPSI FROM DESTINASI LIMIT 9";
                $res = mysqli_query($db, $sql);
				while ($des = mysqli_fetch_assoc($res)) {
                ?>
                <div class="card swiper-slide" style="width: 18rem;">
                <?php
                        if($des['JUMLAH'] > 0){
                          $n = $des['RATING']/$des['JUMLAH'];
                          $n = round($n, 2);
                        }
                        else{
                          $n = 0;
                        }
                          ?>    
                
                <div class="rating"><?=$n?><img src="asset/star.png" height="25px"></div>
                    <img class="card-img-top" src="asset/<?=$des['GAMBAR']?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold"><?=$des['NAMA']?></h5>
                    <p class="card-text"><?=$des['DESKRIPSI']?>...</p>
                    <a href="destinasi.php?id=<?=$des['ID_DESTINASI']?>" class="card-link">See More ›</a>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
            </div>

        </div>
        <div class="centerbuton text-center">
            <a type="button" class="btn btn-secondary" href="listdestinasi.php">Find More</a>
        </div>
            
        <div class="news">
            <h1>What's Happening?</h1>
            <p>See Article from our Community</p>
        </div>

        <?php
            $sql = "SELECT ID_NEWS, JUDUL, KATEGORI, GAMBAR, ID_AKUN, LEFT(ISI, 80) AS ISI FROM NEWS LIMIT 3";
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


        <div class="centerbuton text-center">
            <a type="button" class="btn btn-secondary" href="listartikel.php">Find More</a>
        </div>

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

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    
        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            slidesPerGroup: 3,
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            });
        </script>
    </body>
</html>