<?php
include __DIR__ . '/vendor/autoload.php';
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
    <!-- <link href="./css/home.css" rel="stylesheet"> -->
    <link href="./css/list.css" rel="stylesheet">
    <link href="./css/iconfont.css" rel="stylesheet">

    <title>list</title>
  </head>
  <body>
    <div class="header">
        <div class="icon">
            <!-- img src="img/lipstickLogo.png" alt="lipstick icon" height="50" -->
            <div class="title"><a href="index.php">LIPSTICK STORE</a></div>
            <div class="nav-items nav-items-current">Lipstick Lists</div>
        </div>
        <div class="menu">
            <button class="button">
                <i class="iconfont icon-chaxun"></i>
            </button>
            <button class="button">
                <i class="iconfont icon-fasong"></i>
            </button>
            <?php if(!UserSystem::$iscurrentSessionLogin){ ?>
            <button onclick="window.location.href = './signin.php?URL=list.php'" class="button">
                <i class="iconfont icon-touxiang"></i>
            </button>
            <?php }else{ ?>
                <button onclick="window.location.href = './user.php'" class="button">
                <i class="iconfont icon-touxiang"></i>
            </button>
            <button onclick="window.location.href = '?logout'" class="button">
                <i class="iconfont icon-sign-out"></i>
            </button>
            <?php } ?>
        </div>
    </div>
    <div class="library">
        <ul class="grid">
            <li class="article cell">
                <div class="image o1">
                </div>
                <div class="content">
                    <div class="content-headline">
                        #6759FF
                    </div>
                    <div class="content-des">
                        This color is frequently used by victoria secret's super model.
                    </div>
                </div>
            </li>
            <li class="article cell">
                <div class="image o2">
                </div>
                <div class="content">
                    <div class="content-headline">
                        #2345DF
                    </div>
                    <div class="content-des">
                        This color is frequently used by your ex-girlfriend.
                    </div>
                </div>
            </li>
            <li class="article cell">
                <div class="image o3">
                </div>
                <div class="content">
                    <div class="content-headline">
                        #A435DF
                    </div>
                    <div class="content-des">
                        This color is frequently used by your mother.
                    </div>
                </div>
            </li>
            <li class="article cell">
                <div class="image o4">
                </div>
                <div class="content">
                    <div class="content-headline">
                        #2BD34F
                    </div>
                    <div class="content-des">
                        This color is frequently used by your daughter.
                    </div>
                </div>
            </li>
        </ul>
    </div>


  </body>
</html>