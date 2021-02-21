<?php
require __DIR__ . '/vendor/autoload.php';
use HackSC\UserSystem;
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href="./css/signin.css" rel="stylesheet">

    <title>还没Wuhoooo呢~</title>
  </head>
  <body class="text-center">
	<main class="form-signin">
	  <div>
	  	<h1 class="h1 mb-4 fw-normal">Welcome to HackSC!</h1>
	  </div>
	  <?php
		$rEmail = $_POST['email'];
		$rPassword = $_POST['password'];
		$ignoreForm = true;
		$formMsg = "";
		if(empty($rEmail) && empty($rPassword)){
			$ignoreForm = false;
		}else{
			$rEmail = trim($rEmail);
			$rPassword = trim($rPassword);
			$signupRst = UserSystem::register($rEmail,$rPassword);
			if(!$signupRst){
				$ignoreForm = false;
				$formMsg = "there is an existing user with email " . $rEmail;
			}
		}
		if(!$ignoreForm){
	  ?>
	  <form target="" method="post">
	    <img class="mb-4" src="./img/lipstickLogo.png" alt="" width="72" height="57">
	    <h1 class="h3 mb-3 fw-normal">Create account</h1>
	    <label for="inputEmail" class="visually-hidden">Email address</label>
	    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
	    <label for="inputPassword" class="visually-hidden">Password</label>
	    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
	    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
		<p class="text-link">
			<a href="signin.php<?php if(isset($_GET['URL'])){ echo "?URL=" . $_GET['URL']; } ?>">Already have an account?</a>
		</p>
	    <p class="mt-5 mb-3 text-muted">&copy; 2021.2.19</p>
	  </form>
	  <?php
		}else{
	  ?>
	  <img class="mb-4" src="./img/lipstickLogo.png" alt="" width="72" height="57">
	  <h1 class="h3 mb-3 fw-normal">Create account</h1>
	  <p class="mb-3 fw-normal">Account created, now you can <a href="signin.php<?php if(isset($_GET['URL'])){ echo "?URL=" . $_GET['URL']; } ?>">Signin</a></p>
	  <?php
		}
	  ?>
	</main>
  </body>
</html>
