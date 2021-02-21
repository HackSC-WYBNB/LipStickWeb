CREATE TABLE IF NOT EXISTS `users` (
    `email` VARCHAR(50) NOT NULL,
    `password` CHAR(64) NOT NULL,
    PRIMARY KEY ( `email` )
)ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tokens` (
    `email` VARCHAR(50) NOT NULL,
    `token_str` CHAR(32) NOT NULL,
    `issued` INT UNSIGNED NOT NULL,
    `expires` INT UNSIGNED NOT NULL,
    PRIMARY KEY ( `token_str` )
)ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `photos` (
    `email` VARCHAR(50) NOT NULL,
    `photo` MEDIUMBLOB NOT NULL
);