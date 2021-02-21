<?php
include __DIR__ . '/vendor/autoload.php';
use HackSC\UserSystem;
use HackSC\PhotoStorage;

if(!UserSystem::$iscurrentSessionLogin){
  header('Location: signin.php?URL=user.php',true,302);
  echo("<script>window.location.href='signin.php?URL=user.php';</script>");
  exit("You must sign in before using this page, redirecting...");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- <link href="./css/home.css" rel="stylesheet"> -->
    <link href="./css/user.css" rel="stylesheet">
    <link href="./css/iconfont.css" rel="stylesheet">

    <title>user</title>
  </head>
  <body>
    <div class="header">
        <div class="icon">
            <div class="title"><a href="index.php">LIPSTICK STORE</a></div>
            <div class="nav-items"><a href="list.php">Lipstick Lists</a></div>
        </div>
        <div class="menu">
            <button class="button">
                <i class="iconfont icon-chaxun"></i>
            </button>
            <button class="button">
                <i class="iconfont icon-fasong"></i>
            </button>
            <?php if(!UserSystem::$iscurrentSessionLogin){ ?>
                <button onclick="window.location.href = './signin.php?URL=index.php'" class="button">
                    <i class="iconfont icon-touxiang"></i>
                </button>
            <?php }else{ ?>
                <button class="button">
                    <i class="iconfont icon-touxiang"></i>
                </button>
                <button onclick="window.location.href='?logout'" class="button">
                    <i class="iconfont icon-sign-out"></i>
                </button>
             <?php } ?>
        </div>
    </div>
    <div class="box" style="background:url(img/bg.jpg);background-size:150%;
    background-position:center;">
        <div class="left" style="background-color:rgba(255, 255, 255, 0.65);">
            <div class="toptext">
                Complete your personal info,
                and start your journey here.
            </div>
            <div class="image">
                <img src="img/profile.png" style="width:40vw;">
            </div>
        </div>
        <div class="right">
            <form class="port">
                <div class="input">Username</div>
                <input type="text" class="form-control" id="username" placeholder="Enter your username">
                <div class="input">Email</div>
                <input type="text" class="form-control" id="email" placeholder="Enter your email">
                <div class="input">Gender</div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">Female</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">Other</label>
                  </div>
                    <div class="form-group">
                      <label for="exampleFormControlFile1" class="input">Upload Photo</label>
                      <input type="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
    </div>
    


  </body>
</html>