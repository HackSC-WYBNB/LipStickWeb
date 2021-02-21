<?php
include __DIR__ . '/vendor/autoload.php';
use HackSC\UserSystem;
use HackSC\LipSticks;
use HackSC\LipStick;
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
            <?php
            function generateItem(int $colorR, int $colorG, int $colorB, float $colorADec, string $headline, string $description, ?string $tryLink = null, ?string $serializedLipstick = null) : void{
                $color = 'rgba(' . $colorR . ',' . $colorG . ',' . $colorB . ',' . $colorADec . ')';
            ?>
                <li class="article cell">
                    <div class="image" style="background-color:<?php echo $color; ?>;">
                    </div>
                    <div class="content">
                        <div class="content-headline">
                            <?php echo $headline; ?>
                        </div>
                        <div class="content-des">
                            <p><?php echo $description; ?></p>
                            <?php if(!empty($tryLink)){ ?>
                            <form action="<?php echo $tryLink; ?>" method="post">
                                <?php if(!empty($serializedLipstick)){ ?>
                                    <input type="hidden" name="lipstick" value="<?php echo urlencode($serializedLipstick); ?>" />
                                    <input type="hidden" name="r" value="<?php echo $colorR; ?>" />
                                    <input type="hidden" name="g" value="<?php echo $colorG; ?>" />
                                    <input type="hidden" name="b" value="<?php echo $colorB; ?>" />
                                <?php } ?>
                                <input type="submit" value="Try it on!" />
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </li>
            <?php
            }
            function generateItemWithLipstickObj(LipStick $lipStick,?string $tryOnLink = null) : void{
                $title = $lipStick->brand . '-' . $lipStick->series . (empty($lipStick->price) ? '' : '(' . $lipStick->price . ')');
                $description = 'This color is from the ' . $lipStick->series . ' series from ' . $lipStick->brand . ', ' . (empty($lipStick->price) ? 'and there\s no price details available' : 'and it costs ' . $lipStick->price);
                generateItem($lipStick->r,$lipStick->g,$lipStick->b,1.0,$title,$description,$tryOnLink,$lipStick->serialize());
            }
            ?>
            <?php
                $lipstickList = LipSticks::getLipstickLists();
                foreach($lipstickList as $lipstick){
                    generateItemWithLipstickObj($lipstick,'conceptVerification.php');
                }
            ?>
        </ul>
    </div>


  </body>
</html>