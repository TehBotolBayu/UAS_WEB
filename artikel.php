<?php

session_start();

require 'config.php';

if(isset($_GET['id'])){
  $id_destinasi = $_GET['id'];
  $sql = "SELECT * FROM NEWS WHERE ID_NEWS = $id_destinasi";
  $res = mysqli_query($db, $sql);
  $des = mysqli_fetch_assoc($res);
}






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
    <link rel="stylesheet" href="artikel.css">
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
                <a href="index.php">Home</a>
                <a href="listdestinasi.php">Destination</a>
                <a href="dashboard.php">Dashboard</a>
            </div>
        </header>
        <main>
            <article>
        <div class="card px-3 pt-3" style="max-width: 52rem">
            <!-- News block -->
            <div>
                <?php
                    $IDAC = $des['ID_AKUN'];
                    $s = "SELECT USERNAME, PHOTO FROM AKUN WHERE ID_AKUN = $IDAC";
                    $r = mysqli_query($db, $s);
                    $d = mysqli_fetch_assoc($r);
                ?>
                <div id="author">
                    <img id="pp" src="asset/<?=$d['PHOTO']?>">
                    <p class="username"><?=$d['USERNAME']?></p>
                </div>

              <!-- Featured image -->
              <div class="bg-image hover-overlay shadow-1-strong ripple rounded-5 mb-4" data-mdb-ripple-color="light">
                <img src="asset/<?=$des['GAMBAR']?>" class="img-fluid" />
                <a href="#!">
                  <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
              </div>
          
              <!-- Article data -->
              <div class="row mb-3">
                <div class="col-6">
                  <a href="" class="text-info">
                    <i class="fas fa-plane"></i>
                    Travels
                  </a>
                </div>
          
                <div class="col-6 text-end">
                  <u> 15.07.2020</u>
                </div>
              </div>
          
              <!-- Article title and description -->
              
                <h5 style="font-weight: bold;  font-size: 30px;"><?=$des['JUDUL']?></h5>
          
                <p>
                <?=$des['ISI']?>
                </p>
              
          
              <hr />
            </article>

            </div>
            <!-- News block -->
          </div>
        
          <div class="siderekom">

            <div class="card px-3 pt-3" style="min-width: 14rem; max-width: 52rem;">

            <?php
            $sql = "SELECT ID_NEWS, JUDUL, KATEGORI, GAMBAR, ID_AKUN, LEFT(ISI, 80) AS ISI FROM NEWS LIMIT 3";
            $res = mysqli_query($db, $sql);
			while ($art = mysqli_fetch_assoc($res)) {
                
            ?>          
                <!-- News -->
                <a href="artikel.php?id=<?=$art['ID_NEWS']?>" class="text-dark">
                    <div class="row mb-4 border-bottom pb-2">
                    <div class="col-3">
                        <img src="asset/<?=$art['GAMBAR']?>"
                        class="img-fluid shadow-1-strong rounded" alt="Skyscrapers" />
                    </div>
            
                    <div class="col-9">
                        <p class="mb-2"><strong><?=$art['JUDUL']?></strong></p>
                        <p>
                        <u> 15.07.2020</u>
                        </p>
                    </div>
                    </div>
                </a>
                <?php
            }
            ?>

                <a href="listartikel.php" style="text-decoration: none; margin-bottom: 5px;" class="text-center">Find More ›</a>
            </div>
            </div>
        </main>

        <br><hr><br>
        <!--footer-->
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