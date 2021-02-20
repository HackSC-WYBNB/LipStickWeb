<?php
require __DIR__ . '/vendor/autoload.php';
use HackSC\UserSystem;
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

    <title>Wuhoooo~</title>
  </head>
  <body class="text-center">
	<main class="form-signin">
	  <div>
	  	<h1 class="h1 mb-4 fw-normal">Welcome to HackSC!</h1>
	  </div>
	  
	  <?php
	  	$rEmail = $_POST['email'];
		$rPassword = $_POST['password'];
		$jumpBack = $_GET['URL'];
		if(empty($rEmail) && empty($rPassword)){
	  ?>
	  <form action="" method="post">
	    <img class="mb-4" src="" alt="" width="72" height="57">
	    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
	    <label for="inputEmail" class="visually-hidden">Username</label>
	    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
	    <label for="inputPassword" class="visually-hidden">Password</label>
	    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
	    <div class="checkbox mb-3">
	      <label>
	        <input type="checkbox" value="remember-me"> Remember me
	      </label>
	    </div>
	    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
	    <p class="text-link">
			<a href="signup.html">Doesn't have an account?</a>
		</p>
	    <p class="mt-5 mb-3 text-muted">&copy; 2021.2.19</p>
	  </form>
	  <?php
		}else{
			$rEmail = trim($rEmail);
			$rPassword = trim($rPassword);
			if(empty($jumpBack)){
				$jumpBack = "dashboard.php";
			}
			$pwdRst = UserSystem::checkPassword($rEmail,$rPassword);
			$ctime = time();
			if($pwdRst){
				$TokenDuration = 3600 * 24;
				$newToken = UserSystem::createToken($rEmail,$ctime,$TokenDuration);
				setcookie('token',$newToken,$TokenDuration);
			?>
				<h1 class="h3 mb-3 fw-normal">Successfully landed, now redirecting you to the page before login</h1>
			<?php
				echo "<script type='text/javascript'>window.location.href='$jumpBack'</script>";
			}
		}
	  ?>
	</main>
  </body>
</html>
