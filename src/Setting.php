<?php
namespace HackSC;
class Setting{
    const DBName = empty(getenv('DATABASE_NAME')) ? 'hacksc' : getenv('DATABASE_NAME');
    const HOST = empty(getenv('DATABSE_HOST')) ? '127.0.0.1' : getenv('DATABASE_HOST');
    const PORT = 3306;
    const USERNAME = empty(getenv('DATABSE_USER')) ? 'hacksc' : getenv('DATABASE_USER');
    const PASSWORD = empty(getenv('DATABASE_PWD')) ? '123456' : getenv('DATABASE_PWD');

    const DOMAIN = empty(getenv('DOMAIN')) ? 'localhost' : getenv('DOMAIN');
    const TOKEN_DOMAIN = '.' . self::DOMAIN;
}