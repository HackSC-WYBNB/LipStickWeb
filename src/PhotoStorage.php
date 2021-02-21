<?php
namespace HackSC;

use MysqliDb;

class PhotoStorage{
    public static function getUserImage(string $email) : ?string{
        GlobalConn::$database->where('email',$email);
        $photoData = GlobalConn::$database->getValue('photos','photo');
        if(empty($photoData)){
            return null;
        }else{
            return gzuncompress($photoData);
        }
    }
    public static function isUserImage(string $email) : bool{
        GlobalConn::$database->where('email',$email);
        $count = GlobalConn::$database->getValue('photos','count(*)');
        return $count >= 1;
    }
    public static function saveUserImage(string $email,string $imageData) : void{
        $dataArr = ['photo' => gzcompress($imageData)];
        if(self::isUserImage($email)){
            GlobalConn::$database->where('email',$email);
            GlobalConn::$database->update('photos',$dataArr);
        }else{
            $dataArr['email'] = $email;
            GlobalConn::$database->insert('photos',$dataArr);
        }
    }
}
GlobalConn::tryConn();