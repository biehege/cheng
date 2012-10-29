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
    PRIMARY KEY(`id`),
    UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- root user
INSERT INTO `user` (name, password, type, create_time) 
            VALUES ('root', md5('root'), 'SuperAdmin', NOW()) 
                ON DUPLICATE KEY UPDATE name=name;

-- customer
CREATE TABLE IF NOT EXISTS `customer`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user` INT(10) UNSIGNED NOT NULL,
    `adopted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '是否被通过',
    PRIMARY KEY(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- customer_address
CREATE TABLE IF NOT EXISTS `customer_address`
(
    `customer` INT(10) UNSIGNED NOT NULL,
    `address` INT(10) UNSIGNED NOT NULL
) ENGINE=MyISAM;

-- address never del(for bill to ref)
CREATE TABLE IF NOT EXISTS `address`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `is_del` TINYINT(1) NOT NULL DEFAULT '0',
    `name` CHAR(20) NOT NULL COMMENT '姓名',
    `phone` CHAR(20) NOT NULL,
    `detail` TEXT NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- product, actually, it's product type
CREATE TABLE IF NOT EXISTS `product`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `no` CHAR(20) NOT NULL COMMENT '款号',
    `name` CHAR(60) NOT NULL,
    `image1` VARCHAR(100),
    `image2` VARCHAR(100),
    `image3` VARCHAR(100),
    `type` CHAR(20) NOT NULL, -- new a table?
    `material` CHAR(120) NOT NULL COMMENT 'JSON', 
    `weight` DECIMAL(10, 2),
    `rabbet_start` DECIMAL(2, 2) NOT NULL COMMENT '镶口',
    `rabbet_end` DECIMAL(2, 2) NOT NULL COMMENT '镶口',
    `small_stone` TINYINT(2) NOT NULL,
    `remark` TEXT COMMENT '说明', 
    `carve_allow` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
    `post_time` DATETIME,
    PRIMARY KEY(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- product_type
CREATE TABLE IF NOT EXISTS `product_type`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` CHAR(60) NOT NULL,
    PRIMARY KEY(`id`),
    UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=101;

INSERT INTO `product_type` -- default types
    (name) 
    VALUES 
    ('女戒'), ('男戒'), ('对戒'), ('吊坠'), ('耳坠'), ('手镯/手链')
        ON DUPLICATE KEY UPDATE name=name;

-- cart
CREATE TABLE IF NOT EXISTS `cart`
(
    `customer` INT(10) UNSIGNED NOT NULL,
    `small_order` INT(10) UNSIGNED NOT NULL
) ENGINE=MyISAM;

-- big_order is relation between order and order_entry
CREATE TABLE IF NOT EXISTS `big_order`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- relation between big and small orders
CREATE TABLE IF NOT EXISTS `big_to_small_order`
(
    `big` INT(10) UNSIGNED NOT NULL,
    `small` INT(10) UNSIGNED NOT NULL
) ENGINE=MyISAM;

-- small_order
CREATE TABLE IF NOT EXISTS `small_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` char(20) NOT NULL COMMENT '订单号',
  `product` int(10) unsigned NOT NULL,
  `customer` int(10) unsigned NOT NULL,
  `address` int(10) unsigned NOT NULL,
  `factory` int(10) unsigned NOT NULL,
  `size` smallint(4) unsigned NOT NULL,
  `carve_text` varchar(120) DEFAULT NULL,
  `material` char(20) NOT NULL,
  `state` enum('InCart','ToBeConfirmed','InFactory','FactoryConfirmed','FactoryDone','Done') NOT NULL DEFAULT 'ToBeConfirmed',
  `gold_weight` decimal(4,2) NOT NULL,
  `weight_ratio` decimal(2,2) NOT NULL DEFAULT '0.99',
  `wear_tear` tinyint(2) NOT NULL,
  `gold_price` decimal(4,2) NOT NULL,
  `labor_expense` decimal(4,2) NOT NULL,
  `small_stone` decimal(4,2) NOT NULL,
  `st_expense` decimal(4,2) DEFAULT NULL,
  `st_price` decimal(6,2) DEFAULT NULL,
  `st_weight` decimal(4,2) DEFAULT NULL,
  `model_expense` decimal(6,2) DEFAULT NULL,
  `risk_expense` decimal(6,2) DEFAULT NULL,
  `factory_st` tinyint(2) DEFAULT NULL,
  `factory_st_weight` decimal(4,2) DEFAULT NULL,
  `add_cart_time` datetime DEFAULT NULL,
  `submit_time` datetime DEFAULT NULL,
  `to_factory_time` datetime DEFAULT NULL,
  `factory_confirm_time` datetime DEFAULT NULL,
  `factory_done_time` datetime DEFAULT NULL,
  `all_done_time` datetime DEFAULT NULL,
  `factory_price` decimal(8,2) NOT NULL,
  `real_price` decimal(8,2) NOT NULL,
  `customer_remark` text,
  `admin_remark` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_no` (`order_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101;

-- factory
CREATE TABLE IF NOT EXISTS `factory`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` CHAR(60) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- setting 全局设定
CREATE TABLE IF NOT EXISTS `setting`
(
    `key` CHAR(30) NOT NULL,
    `value` CHAR(30) NOT NULL,
    UNIQUE KEY (`key`)
) ENGINE=MyISAM;

INSERT INTO `setting` -- default settings
    (`key`, `value`) 
    VALUES 
    ('labor_expense', '15'),
    ('wear_tear', '14'),
    ('st_expense', '20'),
    ('st_price', '2300'),
    ('weight_ratio', '1.2')
        ON DUPLICATE KEY UPDATE `key`=`key`;

-- price
CREATE TABLE IF NOT EXISTS `price`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `type` CHAR(10) NOT NULL, -- ENUM('PT950', 'AU750')
    `price` DECIMAL(8,2) NOT NULL,
    `time` DATETIME NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- login history
CREATE TABLE IF NOT EXISTS `user_log`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user` INT(10) UNSIGNED NOT NULL,
    `action` ENUM('Login', 'StartBill', 'DoneBill', 'ViewProduct') NOT NULL,
    `target` INT(10) UNSIGNED,
    `time` DATETIME NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101;
