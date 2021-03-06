<?php
include __DIR__ . '/vendor/autoload.php';
use HackSC\UserSystem;
error_reporting(E_ERROR);
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
    <link href="./css/home.css" rel="stylesheet">
    <link href="./css/iconfont.css" rel="stylesheet">

    <title>home</title>
  </head>
  <body>
      <div class="header">
            <div class="icon">
                <div class="title">LIPSTICK STORE</div>
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
                    <button onclick="window.location.href = './user.php'" class="button">
                        <i class="iconfont icon-touxiang"></i>
                    </button>
                    <button onclick="window.location.href='?logout'" class="button">
                        <i class="iconfont icon-sign-out"></i>
                    </button>
                <?php } ?>
            </div>
        </div>
        <div class="box">
            <div class="left">
                <h1 class="topic">Top Choices</h1>
                <p class="lead">Find the lipsticks you like here at lipstick store. We'll provide the 
                    hottest trends and offer the best deals!
                </p>
                <button onclick="window.location.href = './signup.php'" class="signup lead">
                    SignUp now!
                </button>
            </div>
            <div class= "right" style="background:url(img/main.jpg);background-size:100%;
            background-position:center;">
                <!-- <div id="mainpic">
                    <img src="img/main.jpg" style="width:580px;">
                </div> -->
            </div>
        </div>
        <div class="box">
            <div class="left1" style="background:url(img/office.jpg);background-size:100%;
            background-position:center;">
                <h1 class="limited">Limited Offer</h1>
                <p class="office lead">Check out Microsoft Office Limited Lipsticks!</p>              
            </div>
            <div class= "right1">
            </div>
        </div>
        
  </body>
</html>