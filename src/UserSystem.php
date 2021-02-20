<?php
namespace HackSC;

use MysqliDb;

class UserSystem{
    public static ?MysqliDb $database = null;
    public static bool $iscurrentSessionLogin = false;
    public static function connect() : void{
        self::$database = new MysqliDb(Setting::HOST,Setting::USERNAME,Setting::PASSWORD,Setting::DBName,Setting::PORT);
    }

    public static function isUser(string $email) : bool{
        self::$database->where('email',$email);
        $count = self::$database->getValue('users','count(*)');
        return $count >= 1;
    }

    public static function register(string $email, string $password) : bool{
        if(self::isUser($email)){
            return false;
        }
        self::$database->insert(
            'users',
            array(
                'email' => $email,
                'password' => hash('sha256',$password)
            )
        );
        return true;
    }
    public static function checkPassword(string $email, string $password) : bool{
        if(!self::isUser($email)){
            return false;
        }
        self::$database->where('email',$email);
        $dataRow = self::$database->getOne('users');
        return hash('sha256',$password) == $dataRow['password'];
    }
    public static function createToken(string $email, int $currentTime, int $availableDuration) : string{
        $tokenStr = bin2hex(random_bytes(16));
        self::$database->insert(
            'tokens',
            array(
                'email' => $email,
                'issued' => $currentTime,
                'expires' => $currentTime + $availableDuration,
                'token_str' => $tokenStr
            )
        );
        return $tokenStr;
    }
    public static function checkToken(string $tokenStr, int $currentTime, string $email) : bool{
        self::$database->where('email',$email);
        self::$database->where('expires',$currentTime, '>');
        self::$database->where('token_str',$tokenStr);
        $count = self::$database->getValue('tokens','count(*)');
        return $count >= 1;
    }
    public static function verifyLogin() : bool{
        $ctime = time();
        $token = $_COOKIE['token'];
        $email = $_COOKIE['email'];
        if(empty($token) && empty($email)){
            return false;
        }
        return self::checkToken($token,$ctime,$email);
    }
    public static function logOut() : void{
        setcookie('token',null,0,'/',Setting::TOKEN_DOMAIN);
        setcookie('email',null,0,'/',Setting::TOKEN_DOMAIN);
        self::$iscurrentSessionLogin = false;
    }
}
if(UserSystem::$database == null){
    UserSystem::connect();
}
if(isset($_GET['logout'])){
    UserSystem::logOut();
}else{
    UserSystem::$iscurrentSessionLogin = UserSystem::verifyLogin();
}