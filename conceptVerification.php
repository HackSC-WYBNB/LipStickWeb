<?php
require __DIR__ . '/vendor/autoload.php';

use HackSC\LipStick;
use HackSC\Makeup;
use HackSC\PhotoStorage;
use HackSC\UserSystem;
if(!UserSystem::$iscurrentSessionLogin){
    header('Location: signin.php?URL=conceptVerification.php',true,302);
    echo("<script>window.location.href='signin.php?URL=conceptVerification.php';</script>");
    exit("You must sign in before using this page, redirecting...");
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Upload a photo and see what the func is going to happen!</title>

    </head>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="number" name="r" value="<?php echo (empty($_POST['r']) ? 255 : intval($_POST['r'])); ?>" placeholder="R Value"></input>
            <input type="number" name="g" value="<?php echo (empty($_POST['g']) ? 0 : intval($_POST['g'])); ?>" placeholder="G Value"></input>
            <input type="number" name="b" value="<?php echo (empty($_POST['b']) ? 0 : intval($_POST['b'])); ?>" placeholder="B Value"></input>
            <input type="number" name="a" value="<?php echo (empty($_POST['a']) ? 120 : intval($_POST['a'])); ?>" placeholder="A Value"></input>
            <?php if(!empty($_POST['lipstick'])){ ?>
                <input type="hidden" name="lipstick" value="<?php echo $_POST['lipstick']; ?>" />
            <?php } ?>
            <input type="submit" name="submit" value="Upload"></input>
        </form>
        <?php
            if(!empty($_POST['lipstick'])){
                $lipstick = LipStick::desearialize(urldecode($_POST['lipstick']));
                echo '<p>You are trying ' . $lipstick->brand . '\'s ' . $lipstick->series . ' lipstick!</p>';
            }
            if(!PhotoStorage::isUserImage(UserSystem::getCurrentLoginEmail())){
                echo("<p>You haven't uploaded any pictures yet, <a href=\"user.php\">Click Here to Upload a photo</a></p>");
            }else{
                $uploadedRGBA = [$_POST['r'],$_POST['g'],$_POST['b'],$_POST['a']];
                function showImage($photo, $rgba, $remoteURI){
                    $imageB64 = base64_encode($photo);
                    echo Makeup::imageAsTag($imageB64,'50%');
                    $returnedData = Makeup::getDealtImageB64($imageB64,$rgba,$remoteURI);
                    if($returnedData !== null){
                        echo Makeup::imageAsTag($returnedData,'50%');
                    }else{
                        echo('Failed fetching data');
                    }
                }
                if(!empty($uploadedRGBA[3])){
                    $foundErr = false;
                    foreach($uploadedRGBA as $rgba){
                        if($rgba >= 0 && $rgba <= 255){
                            
                        }else{
                            $foundErr = true;
                            break;
                        }
                    }
                    if($foundErr){
                        echo "Request Param Error";
                    }else{
                        $webRGBA = $uploadedRGBA;
                        $webRGBA[3] /= 255.0;
                        $backgroundColor = 'rgba(' . implode(',',$webRGBA) . ')';
                        echo '<div style="width:50px;height:50px;display:box;background-color:' . $backgroundColor . ';"></div>';
                        $uploadedPhoto = PhotoStorage::getUserImage(UserSystem::getCurrentLoginEmail());
                        showImage($uploadedPhoto,$uploadedRGBA,"http://localhost:5000/");
                    }
                }
            }
        ?>
    </body>
</html>