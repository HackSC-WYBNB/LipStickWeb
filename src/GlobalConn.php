<?php
namespace HackSC;

use MysqliDb;

class GlobalConn{
    public static ?MysqliDb $database = null;
    public static function connect() : void{
        self::$database = new MysqliDb(Setting::HOST,Setting::USERNAME,Setting::PASSWORD,Setting::DBName,Setting::PORT);
    }
    public static function tryConn() : void{
        if(self::$database == null){
            self::connect();
        }
    }
}