<?php
namespace HackSC;

use MysqliDb;

class PhotoStorage{
    public static ?MysqliDb $database = null;
    public static function connect() : void{
        self::$database = new MysqliDb(Setting::HOST,Setting::USERNAME,Setting::PASSWORD,Setting::DBName,Setting::PORT);
    }
    public static function getUserImage(string $email) : ?string{
        self::$database->where('email',$email);
        $photoData = self::$database->getValue('photos','photo');
        if(empty($photoData)){
            return null;
        }else{
            return gzuncompress($photoData);
        }
    }
    public static function isUserImage(string $email) : bool{
        self::$database->where('email',$email);
        $count = self::$database->getValue('photos','count(*)');
        return $count >= 1;
    }
    public static function saveUserImage(string $email,string $imageData) : void{
        $dataArr = ['photo' => gzcompress($imageData)];
        if(self::isUserImage($email)){
            self::$database->where('email',$email);
            self::$database->update('photos',$dataArr);
        }else{
            $dataArr['email'] = $email;
            self::$database->insert('photos',$dataArr);
        }
    }
}
if(PhotoStorage::$database == null){
    PhotoStorage::connect();
}