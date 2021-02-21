<?php
namespace HackSC;

use MysqliDb;

class GlobalConn{
    public static ?MysqliDb $database = null;
    public static function connect() : void{
        self::$database = new MysqliDb(Setting::$HOST,Setting::$USERNAME,Setting::$PASSWORD,Setting::$DBName,Setting::$PORT);
    }
    public static function tryConn() : void{
        if(self::$database == null){
            self::connect();
        }
        if(!file_exists(__DIR__ . '/../install.lock')){
            file_put_contents(__DIR__ . '/../install.lock','1');
            self::$database->mysqli()->query(file_get_contents(__DIR__ . '/../scripts/UserSystem.sql'));
        }
    }
}