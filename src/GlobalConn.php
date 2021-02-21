<?php
namespace HackSC;

use mysqli;
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
        if(!file_exists(__DIR__ . '/../install.lock') && False){
            file_put_contents(__DIR__ . '/../install.lock','1');
            self::$database->mysqli()->query(
                'CREATE TABLE IF NOT EXISTS `users` (
                `email` VARCHAR(50) NOT NULL,
                `password` CHAR(64) NOT NULL,
                PRIMARY KEY ( `email` )
                )ENGINE=InnoDB CHARSET=utf8;'
            );
            self::$database->mysqli()->query(
                'CREATE TABLE IF NOT EXISTS `tokens` (
                    `email` VARCHAR(50) NOT NULL,
                    `token_str` CHAR(32) NOT NULL,
                    `issued` INT UNSIGNED NOT NULL,
                    `expires` INT UNSIGNED NOT NULL,
                    PRIMARY KEY ( `token_str` )
                )ENGINE=InnoDB CHARSET=utf8;'
            );
            self::$database->mysqli()->query(
                'CREATE TABLE IF NOT EXISTS `photos` (
                    `email` VARCHAR(50) NOT NULL,
                    `photo` MEDIUMBLOB NOT NULL
                );'
            );
        }
    }
}