<?php
namespace HackSC;

use MysqliDb;

class UserSystem{
    const DBName = '';
    const HOST = '127.0.0.1';
    const PORT = 3306;
    const USERNAME = '';
    const PASSWORD = '';

    public static MysqliDb $database;
    public static function connect() : void{
        self::$database = new MysqliDb(self::HOST,self::USERNAME,self::PASSWORD,self::DBName,self::PORT);
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
}