<?php
require __DIR__ . '/../vendor/autoload.php';

use HackSC\LipStick;
use HackSC\Makeup;
use HackSC\PhotoStorage;
use HackSC\UserSystem;

$API_URL = empty(getenv('PYTHON_API')) ? 'http://localhost:5000/' : getenv('PYTHON_API');

if(!UserSystem::$iscurrentSessionLogin){
    $returnArr = [
        'errNo' => 1,
        'description' => 'You must sign in before using this page'
    ];
    exit(json_encode($returnArr));
}
if(!PhotoStorage::isUserImage(UserSystem::getCurrentLoginEmail())){
    $returnArr = [
        'errNo' => 2,
        'description' => 'You need to first add a photo in your profile!'
    ];
    exit(json_encode($returnArr));
}else{
    $uploadedRGBA = [$_POST['r'],$_POST['g'],$_POST['b'],$_POST['a']];
    if(count($uploadedRGBA) === 4){
        $foundErr = false;
        foreach($uploadedRGBA as &$rgba){
            $rgba = intval($rgba);
            if($rgba >= 0 && $rgba <= 255){
                
            }else{
                $foundErr = true;
                break;
            }
        }
        if($foundErr){
            echo "Request Param Error";
        }else{
            $uploadedPhoto = PhotoStorage::getUserImage(UserSystem::getCurrentLoginEmail());
            $uploadedPhotoB64 = base64_encode($uploadedPhoto);
            unset($uploadedPhoto);
            $finishedPhotoB64 = Makeup::getDealtImageB64($uploadedPhotoB64,$uploadedRGBA,$API_URL);
            if($finishedPhotoB64 == null){
                $returnArr = [
                    'errNo' => 3,
                    'description' => 'it seems like there is an error in server setup, please contact website admin.'
                ];
                exit(json_encode($returnArr));
            }
            $returnArr = [
                'errNo' => 0,
                'data' => [
                    'original' => $uploadedPhotoB64,
                    'after' => $finishedPhotoB64
                ]
            ];
            exit(json_encode($returnArr));
        }
    }
}
?>