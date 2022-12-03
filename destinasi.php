<?php

session_start();

require 'config.php';

if(isset($_GET['id'])){
  $id_destinasi = $_GET['id'];
  $sql = "SELECT * FROM DESTINASI WHERE ID_DESTINASI = $id_destinasi";
  $res = mysqli_query($db, $sql);
  $des = mysqli_fetch_assoc($res);
}

$status = $_SESSION['STATUS'];
$id_akun = $_SESSION['ID_AKUN'];
$pp = mysqli_query($db, "SELECT * FROM AKUN WHERE ID_AKUN = $id_akun");
$pp = mysqli_fetch_assoc($pp);
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
    <link rel="stylesheet" href="destinasi.css">
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
        <main>
            <section class="form-review">
                <div class="container my-5 py-5 text-dark">
                  <div class="row d-flex justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-6">
                        <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="closereview()"></button>
                      <div class="card">
                        
                        <div class="card-body p-4">
                            
                          <div class="d-flex flex-start w-100">
                            <img class="rounded-circle shadow-1-strong me-3"
                              src="asset/<?=$pp['PHOTO']?>" alt="avatar" width="65"
                              height="65" />
                              
                            <div class="w-100">
                              <h5>Add a Review</h5>
                              <form action="rating.php" method="POST">
                                <input type="hidden" name="akun" value='<?=$id_akun?>'>
                                <input type="hidden" name="destinasi" value='<?=$id_destinasi?>'>
                                <div class="rating">
                                  <label>
                                    <input type="radio" name="stars" value="1" />
                                    <span class="icon">★</span>
                                  </label>
                                  <label>
                                    <input type="radio" name="stars" value="2" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                  </label>
                                  <label>
                                    <input type="radio" name="stars" value="3" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>   
                                  </label>
                                  <label>
                                    <input type="radio" name="stars" value="4" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                  </label>
                                  <label>
                                    <input type="radio" name="stars" value="5" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                  </label>
                                </div>
                                <div class="form-outline">
                                  <input name="isi" type="text" class="form-control" id="textAreaExample" rows="4">
                                  <label class="form-label" for="textAreaExample">What is your view?</label>
                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                  <input type="submit" name="submit" class="btn btn-danger">
                                  </button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
        <article>
            <div class="card px-3 pt-3" style="max-width: 50rem">
                <!-- News block -->
                <div>

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
                        Indonesia
                    </a>
                    </div>
            
                    <div class="col-6 text-end">
                     
                        <?php
                        if($des['JUMLAH'] > 0){
                          $n = $des['RATING']/$des['JUMLAH'];
                          $n = round($n, 2);
                        }
                        else
                          $n = 0;
                          ?>
                          <?=$n?> 
                          <?php
                        $nn = floor($n);
                        $i = 0;
                        while($i < $nn){
                        ?>
                        <img src="asset/star.png" height="30px" style="font-size: 0px">
                        <?php
                        $i += 1;
                        }
                        if($nn < $n){
                          $n+=1;
                          $nn = floor($n);
                          ?>
                          <img src="asset/star-half.png" height="30px" style="font-size: 0px">
                        <?php
                        }


                        $x = 5-$nn;
                        $i = 0;
                        while($i < $x){
                        ?>
                        <img src="asset/dark-star.png" height="30px" style="font-size: 0px">
                        <?php
                        $i += 1;
                        }
                        ?>               
                    
                    </div>
                </div>
            
                <!-- Article title and description -->
                
                    <h5 style="font-weight: bold; font-size: 30px;"><?=$des['NAMA']?></h5>
            
                    <p>
                    <?=$des['DESKRIPSI']?>
                    </p>
                <?php
                if($status == 'user' || $status == 'admin'){
                  $idd = $des['ID_DESTINASI'];
                  // echo "<script>alert('$idd')</script>";
                  $jumrev = mysqli_query($db, "SELECT * FROM REVIEW WHERE ID_AKUN = $id_akun AND ID_DESTINASI = $idd");
                  if(mysqli_num_rows($jumrev) <= 0){
                ?>
                <div class="text-center tulis">
                    <button type="button" class="btn btn-outline-secondary" onclick="review()">Write Review</button>
                </div>
                <?php
                  }
                }
                ?>      
                <hr />

                <section class="komentar">
                  <?php
                  $sql = "SELECT * FROM REVIEW WHERE ID_DESTINASI = $id_destinasi";
                  $res = mysqli_query($db, $sql);
                  while($review = mysqli_fetch_assoc($res)){
                    

                  ?>

                    <div class="container my-5 py-5 text-dark ">
                      <div class="row d-flex justify-content-left ">
                        <div class="col-md-11 col-lg-9 col-xl-7 komen">
                          <div class="d-flex flex-start mb-4 ">
                          <?php
                                  $acc = $review['ID_AKUN'];
                                  $ss = "SELECT * FROM AKUN WHERE ID_AKUN = $acc";
                                  $profil = mysqli_query($db, $ss);
                                  $profil_data = mysqli_fetch_assoc($profil);
                                  
                                  ?>
                            <img class="rounded-circle shadow-1-strong me-3"
                              src="asset/<?=$profil_data['PHOTO']?>" alt="avatar" width="65"
                              height="65" />
                            <div class="card w-100 ">
                              <div class="card-body p-4 ">
                                <div class="">
                                  <h5>

                                <?php
                                echo $profil_data['USERNAME'];
                                ?>
                                  </h5>
                                  <p class="small"><img src="asset/star.png" height="30px"><span class="rate"><?=$review['NILAI']?>/5 </span></p>
                                  <p>
                                    <?=$review['DESKRIPSI']?>
                                  </p>
                  
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                      <a href="#!" class="link-muted me-2"><i class="fas fa-thumbs-up me-1"></i>132</a>
                                      <a href="#!" class="link-muted"><i class="fas fa-thumbs-down me-1"></i>15</a>
                                    </div>
                                    <a href="#!" class="link-muted"><i class="fas fa-reply me-1"></i> Reply</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                  

                        </div>
                      </div>
                    </div>

                  <?php
                  }
                  ?>

                    <div class="text-center" style="margin-bottom: 50px;">
                        <a href="" style="text-decoration: none; margin-bottom: 5px;" class="text-center">Load More Review<p>⌄</p></a>
                    </div>
                  </section>
                  
        </article>
        
          <div class="siderekom">

            <div class="card px-3 pt-3" style="min-width: 16rem; max-width: 40rem;">

                <!-- News -->
                <div class="text-center ti">
                    <h1 style="font-weight: bold; font-size: 20px">Reccomendation</h1>
                </div>
                <?php
                    $sql = "SELECT JUMLAH, ID_DESTINASI, GAMBAR, NAMA, RATING, LEFT(DESKRIPSI, 80) AS DESKRIPSI FROM DESTINASI LIMIT 5";
                    $rs = mysqli_query($db, $sql);
                    while ($ds = mysqli_fetch_assoc($rs)) {
                ?>
                <a href="destinasi.php?id=<?=$ds['ID_DESTINASI']?>" class="text-dark ">
                    <div class="row mb-4 border-bottom pb-2">
                    <div class="col-3 ">
                        <img src="asset/<?=$ds['GAMBAR']?>"
                        class="img-fluid shadow-1-strong rounded" alt="Hollywood Sign on The Hill" />
                    </div>
            
                    <div class="col-9">
                        <p class="mb-2"><strong><?=$ds['NAMA']?></strong></p>
                        <p>
                        <?php
                        if($ds['JUMLAH'] > 0){
                          $n = $ds['RATING']/$ds['JUMLAH'];
                          $n = round($n, 2);
                        }
                        else{
                          $n = 0;
                        }
                          ?>
                        <u><?=$n?><img src="asset/star.png" height="20px"></u>
                        </p>
                    </div>
                    </div>
                </a>

                <?php
                }
                ?>
            
                <a href="listdestinasi.php" style="text-decoration: none; margin-bottom: 5px;" class="text-center">Find More ›</a>
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
        <script>
            function review(){
                var x = document.getElementsByClassName('form-review');
                x[0].style.display = "block";
            }
            function closereview(){
                var x = document.getElementsByClassName('form-review');
                x[0].style.display = "none";
            }
        </script>
    </body>

</html>