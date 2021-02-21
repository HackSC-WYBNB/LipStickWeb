<?php
namespace HackSC;
class Setting{
    public static $DBName = '';
    public static $HOST = '';
    public static int $PORT = 3306;
    public static $USERNAME = '';
    public static $PASSWORD = '';

    public static $DOMAIN = '';
    public static $TOKEN_DOMAIN = '';
}
Setting::$DBName = empty(getenv('DATABASE_NAME')) ? 'hacksc' : getenv('DATABASE_NAME');
Setting::$HOST = empty(getenv('DATABSE_HOST')) ? '127.0.0.1' : getenv('DATABASE_HOST');
Setting::$PORT = empty(getenv('DATABSE_USER')) ? 'hacksc' : getenv('DATABASE_USER');
Setting::$PASSWORD = empty(getenv('DATABASE_PWD')) ? '123456' : getenv('DATABASE_PWD');
Setting::$DOMAIN = empty(getenv('DOMAIN')) ? 'localhost' : getenv('DOMAIN');
Setting::$TOKEN_DOMAIN = '.' . Setting::$DOMAIN;