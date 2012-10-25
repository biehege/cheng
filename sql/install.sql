-- 创建数据库

CREATE DATABASE IF NOT EXISTS jewelry CHARACTER SET UTF8 COLLATE utf8_general_ci;

USE jewelry;

-- user
CREATE TABLE IF NOT EXISTS `user`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` CHAR(20) NOT NULL COMMENT 'username',
    `password` CHAR(32) NOT NULL,
    `type` ENUM("SuperAdmin", "Admin", "Customer") NOT NULL DEFAULT 'Customer',
    `realname` CHAR(40) NOT NULL DEFAULT '',
    `phone` CHAR(20) NOT NULL DEFAULT '',
    `email` CHAR(40) NOT NULL DEFAULT '',
    `create_time` DATETIME,
    PRIMARY KEY(id)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- root user
INSERT INTO `user` (name, password, type, create_time) 
            VALUES ('root', md5('root'), 'SuperAdmin', NOW()) ON DUPLICATE KEY UPDATE name='root';

-- customer
CREATE TABLE IF NOT EXISTS `customer`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user` INT(10) UNSIGNED NOT NULL,
    `adopted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否被通过',
    PRIMARY KEY(id)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- address
CREATE TABLE IF NOT EXISTS `address`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` CHAR(20) NOT NULL COMMENT '姓名',
    `phone` CHAR(20) NOT NULL,
    `detail` TEXT NOT NULL,
    PRIMARY KEY(id)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- product_combine
CREATE TABLE IF NOT EXISTS `product_combine`
(
    `group` INT(10) UNSIGNED NOT NULL COMMENT 'group id',
    `product` INT(10) UNSIGNED NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- order_
CREATE TABLE IF NOT EXISTS `order_`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `products` INT(10) UNSIGNED NOT NULL, -- product_combine
    `customer` INT(10) UNSIGNED NOT NULL, -- user
    `factory` INT(10) UNSIGNED NOT NULL, -- factory
    `state` ENUM(
        "ToBeConfirmed",
        "InFactory",
        "FactoryConfirmed",
        "FactoryDone",
        "Done"
    ) NOT NULL DEFAULT 'ToBeConfirmed',
    `create_time` DATETIME,
    `to_factory_time` DATETIME,
    `factory_confirm_time` DATETIME,
    `factory_done_time` DATETIME,
    `all_done_time` DATETIME,
    PRIMARY KEY(id)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- factory
CREATE TABLE IF NOT EXISTS `factory`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` CHAR(60) NOT NULL,
    PRIMARY KEY(id)
) ENGINE=MyISAM AUTO_INCREMENT=101;
