<?php
require __DIR__ . '/vendor/autoload.php';
use HackSC\Makeup;
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Upload a photo and see what the func is going to happen!</title>

    </head>
    <body>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="photoUp" id="photoUp" />
            <input type="number" name="r" placeholder="R Value"></input>
            <input type="number" name="g" placeholder="G Value"></input>
            <input type="number" name="b" placeholder="B Value"></input>
            <input type="number" name="a" placeholder="A Value"></input>
            <input type="submit" name="submit" value="Upload"></input>
        </form>
        <?php
        $uploadedPhoto = $_FILES['photoUp'];
        $uploadedRGBA = [$_POST['r'],$_POST['g'],$_POST['b'],$_POST['a']];
        function showImage($photo, $rgba, $remoteURI){
            if($photo['error'] > 0){
                echo "Error dealing upload file";
            }
            $imageB64 = base64_encode(file_get_contents($photo['tmp_name']));
            echo Makeup::imageAsTag($imageB64);
            $returnedData = Makeup::getDealtImageB64($imageB64,$rgba,$remoteURI);
            if($returnedData !== null){
                echo Makeup::imageAsTag($returnedData);
            }else{
                echo('Failed fetching data');
            }
        }
        if(!empty($uploadedPhoto)){
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
                showImage($uploadedPhoto,$uploadedRGBA,"http://localhost:5000/");
            }
        }
    ?>
    </body>
</html>