<?php
session_start();
$_SESSION['tipe'] = 'null';
error_reporting(E_ERROR);

require 'config.php';

if(isset($_POST['submit'])){

	$acc = $_POST['u/e'];
  $password = $_POST['password'];
	
	$res = mysqli_query($db, "SELECT * FROM akun WHERE EMAIL='$acc' or USERNAME='$acc'");
	$data = mysqli_fetch_assoc($res);
  if(mysqli_num_rows($res) <= 0) {
    echo "<script>
        alert('Akun belum terdaftar, silahkan registrasi terlebih dahulu');
        document.location.href = 'login.php';
        </script>";
  }
	if(password_verify($password, $data['PW'])){
        $_SESSION['STATUS'] = $data['STATUS'];
        $_SESSION['ID_AKUN'] = $data['ID_AKUN'];
        echo "<script>
        alert ('Selamat Datang!');
        document.location.href = 'index.php';
        </script>";
	}
	else{
		echo "<script>
			alert('Maaf, password salah!');
		</script>";
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
                    Log In
                </div>
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="text" name="u/e" id="form2Example1" class="form-control" />
                  <label class="form-label" for="form2Example1">Email address/Username</label>
                </div>
              
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example2" class="form-control" />
                  <label class="form-label" for="form2Example2">Password</label>
                </div>
                            
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
              
                <!-- Register buttons -->
                <div class="text-center">
                  <p>Not a member? <a href="regis.php">Register</a></p>
                </div>
              </form>
        </div>
    </body>
</html>

