<?php
session_start();
$q = $_SESSION['STATUS'];

if($_SESSION['STATUS'] == 'admin' || $_SESSION['STATUS'] == 'user'){
}else {
    header('Location: index.php');
}

require 'config.php';

if(isset($_GET['id'])){
    $ss = $_GET['id'];
    $sql = mysqli_query($db, "SELECT * FROM REVIEW WHERE ID_REVIEW = $ss");
    $edit = mysqli_fetch_assoc($sql);
}

$id_akun = $_SESSION['ID_AKUN'];

$query = " select * from akun where ID_AKUN = '$id_akun'";
$result = mysqli_query($db, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="destinasi.css">
    <link rel="stylesheet" href="dashboard.css">
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
                <a href="listartikel.php">Artikel</a>
                <a href="listdestinasi.php">Destinasi</a>
                
            </div>
        </header>

<!--form review-->
<section class="form-review">
                <div class="container my-5 py-5 text-dark">
                  <div class="row d-flex justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-6">
                        <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="closereview()"></button>
                      <div class="card">
                        
                        <div class="card-body p-4">
                            
                          <div class="d-flex flex-start w-100">
                            <img class="rounded-circle shadow-1-strong me-3"
                              src="asset/<?=$data['PHOTO']?>" alt="avatar" width="65"
                              height="65" />
                              
                            <div class="w-100">
                              <h5>Add a Review</h5>
                              <form action="editrating.php" method="POST">
                                <input type="hidden" name="destinasi" value='<?=$edit['ID_DESTINASI']?>'>
                                <input type="hidden" name="id" value='<?=$edit['ID_REVIEW']?>'>
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
                                  <input name="isi" type="text" class="form-control" id="textAreaExample" rows="4" value='<?=$edit['DESKRIPSI']?>'>
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
<!---->

    
        <div class="hero" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('asset/borobudur.jpg');">
        </div>

        <div class="foto-profil">
            <img src="asset/<?=$data['PHOTO']?>">
        </div>
        <div class="name">
            <h1 style="font-weight: bold;"><?=$data['USERNAME']?><span style="font-size: 0.8em; font-weight:lighter; margin-left: 10px;"></span></h1>
            <h4><?=$data['REAL_NAME']?><h4 style="display:inline;"><?=$data['BIRTH']?></h4></h4>
        </div>
        <a href="editakun.php" class="edit">
            <img src="asset/edit.png">
        </a>
        
        <section class="bg" style="background-color: #F2F2F2;">
        <a href="addartikel.php" class="btn btn-primary" style="position: absolute; right: 10%; top: 550px; font-size: 30px;">Write Article</a>    
            <main>
            <article>
                
                <div class="card px-3 pt-3" style="max-width: 40rem">
                    <h1 class="text-center" style="font-weight: bold; font-size: 30px; margin-top: 15px; margin-bottom: -70px;">Review</h1>
                    <section class="komentar">
                    
                        <div class="container my-5 py-5 text-dark ">
                        <div class="row d-flex justify-content-left ">
                            <div class="col-md-11 col-lg-9 col-xl-7 komen">
                            <?php
                            $res = mysqli_query($db, "SELECT * FROM REVIEW WHERE ID_AKUN = $id_akun");
                            while($rev = mysqli_fetch_assoc($res)){
                                $id_des = $rev['ID_DESTINASI'];
                                $res2 = mysqli_query($db, "SELECT * FROM DESTINASI WHERE ID_DESTINASI = $id_des");
                                $data_des = mysqli_fetch_assoc($res2);
                            ?>

                                <div class="d-flex flex-start mb-4 ">
                             
                                    <a href="dashboard.php?id=<?=$rev['ID_REVIEW']?>" class="ed">
                                        <img src="asset/edit.png" height="25px">
                                    </a>
                                    <a href="delete.php?id=<?=$rev['ID_REVIEW']?>&tabel=REVIEW&namaid=ID_REVIEW" class="ed" style="display: inline;">
                                        <img src="asset/delete.png" height="25px">
                                    </a>
    

                                    <div class="card w-100 ">
                                    <div class="card-body p-4 ">
                                        <div class="">
                                            <div class="col-3 " style="float: left; margin-right: 10px;">
                                                <img src="asset/<?=$data_des['GAMBAR']?>"
                                                class="img-fluid shadow-1-strong rounded" alt="Hollywood Sign on The Hill" />
                                            </div>
                                        <h5><?=$data_des['NAMA']?></h5>
                                        <p class="small"><img src="asset/star.png" height="30px"><span class="rate">
                                        <?=$rev['NILAI']?>
                                            /5 </span>3 hours ago</p>
                                        <p>
                                            <?=$rev['DESKRIPSI']?>
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
                            <?php
                            }
                            ?>


                            </div>
                        </div>
                        </div>
                        <div class="text-center" style="margin-bottom: 50px;">
                            <a href="" style="text-decoration: none; margin-bottom: 5px;" class="text-center">Load More Review<p>⌄</p></a>
                        </div>
                    </section>
                    
            </article>
            
            <div class="siderekom">

                <div class="card px-3 pt-3" style="min-width: 16rem; max-width: 40rem;">
                
                <?php
                $res3 = mysqli_query($db, "SELECT * FROM NEWS WHERE ID_AKUN = $id_akun");
                while($data_news = mysqli_fetch_assoc($res3)){

                ?>
                
                    <!-- News -->
                    <a href="artikel.php?id=<?=$data_news['ID_NEWS']?>" class="text-dark">
                        <div class="row mb-4 border-bottom pb-2">
                        <div class="col-3">
                            <img src="asset/<?=$data_news['GAMBAR']?>"
                            class="img-fluid shadow-1-strong rounded" alt="Skyscrapers" />
                        </div>
                
                        <div class="col-9">
                            <p class="mb-2"><strong><?=$data_news['JUDUL']?></strong></p>
                            <p>
                            <u>    
                            <a href="delete.php?id=<?=$data_news['ID_NEWS']?>&tabel=NEWS&namaid=ID_NEWS" class="ed">
                                    <img src="asset/delete.png" height="25px">
                                </a> 
                                <a href="editartikel.php?id=<?=$data_news['ID_NEWS']?>" class="ed">
                                    <img src="asset/edit.png" height="25px">
                                </a>
                               
                            </u>
                            
                            </p>
                        </div>
                        
                        </div>
                        
                    </a>
                    
                <?php
                }
                ?>

                </div>
            </div>
            </main>
        </section>
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
            function closereview(){
                    var x = document.getElementsByClassName('form-review');
                    x[0].style.display = "none";
                }
        </script>
    </body>
</html>

<?php
if(isset($_GET['id'])){
    echo "<script>
        var x = document.getElementsByClassName('form-review');
        x[0].style.display = 'block';
    </script>";
}
?>