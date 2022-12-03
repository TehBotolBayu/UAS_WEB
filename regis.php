<?php

require 'config.php';

$tgl = date("Y/m/d");

$msg = "";


if (isset($_POST['submit'])) {

    $username = $_POST["uname"];
    $email = $_POST["email"];
    $password = $_POST['password'];
    $con = $_POST['konfirmasi'];

    $sql = "SELECT * FROM akun WHERE EMAIL = '$email' or USERNAME = '$username'";
    $user = $db->query($sql);
    
    if(mysqli_num_rows($user) > 0) {
        echo "<script>
            alert('Email telah digunakan');
            </script>";
    } else {
        if($password == $con){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO akun (USERNAME, EMAIL, PW, STATUS) VALUES ('$username', '$email', '$password', 'user')";
            
            $res = mysqli_query($db, $sql);
            if($res){
                echo "<script>
                alert ('Anda telah terdaftar!');
                document.location.href = 'login.php';
                </script>";
            } else {
                echo "<script>
                alert ('Maaf, gagal menyimpan data anda');
                </script>";                
            }

        } else {
            echo "<script>
                alert ('Konfirmasi passsword salah');
                </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="log">
            <form action="" method="POST" autocomplete="off">
                <div style="font-weight: bold; font-size: 25px; margin-bottom: 50px;">
                    Register
                </div>

                <!-- Username input -->
                <div class="form-outline mb-4">
                  <input type="text" name="uname" id="form2Example1" class="form-control" />
                  <label class="form-label" for="form2Example1">Username</label>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" />
                  <label class="form-label" for="form2Example1">Email address</label>
                </div>
              
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example2" class="form-control" />
                  <label class="form-label" for="form2Example2">Password</label>
                </div>

                <!-- Password Confirm -->
                <div class="form-outline mb-4">
                  <input type="password" name="konfirmasi" id="form2Example2" class="form-control" />
                  <label class="form-label" for="form2Example2">Confirm</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4" name="submit">Sign Up</button>
              
                <!-- Register buttons -->
                <div class="text-center">
                  <p>Already have an account? <a href="login.php">Log In</a></p>
                  
                </div>
            </form>
        </div>
    </body>
</html>

