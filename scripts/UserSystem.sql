CREATE TABLE IF NOT EXISTS `users` (
    `email` VARCHAR(50) NOT NULL,
    `password` CHAR(64) NOT NULL,
    PRIMARY KEY ( `email` )
)ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `tokens` (
    `email` VARCHAR(50) NOT NULL,
    `token_str` CHAR(32) NOT NULL,
    `issued` UNSIGNED INT NOT NULL,
    `expires` UNSIGNED INT NOT NULL,
    PRIMARY KEY ( `token_str` )
)ENGINE=InnoDB CHARSET=utf8;