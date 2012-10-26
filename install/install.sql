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

-- address never del(for bill to ref)
CREATE TABLE IF NOT EXISTS `address`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `is_del` TINYINT(1) NOT NULL DEFAULT '0',
    `name` CHAR(20) NOT NULL COMMENT '姓名',
    `phone` CHAR(20) NOT NULL,
    `detail` TEXT NOT NULL,
    PRIMARY KEY(id)
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
    `type` CHAR(20) NOT NULL,
    `material` CHAR(120) NOT NULL COMMENT 'JSON', 
    `weight` DECIMAL(10, 2),
    `rabbet_start` DECIMAL(2, 2) NOT NULL,
    `rabbet_end` DECIMAL(2, 2) NOT NULL,
    `small_stone` TINYINT NOT NULL,
    `remark` TEXT,
    `carve_allow` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
    `create_time` DATETIME,
    PRIMARY KEY(id)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- cart
CREATE TABLE IF NOT EXISTS `cart`
(
    `customer` INT(10) UNSIGNED NOT NULL,
    `small_order` INT(10) UNSIGNED NOT NULL,
    `num` SMALLINT(2) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=MyISAM;

-- big_order is relation between order and order_entry
CREATE TABLE IF NOT EXISTS `big_order`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- relation between big and small orders
CREATE TABLE IF NOT EXISTS `big_to_small_order`
(
    `big` INT(10) UNSIGNED NOT NULL,
    `small` INT(10) UNSIGNED NOT NULL
) ENGINE=MyISAM;

-- small_order
CREATE TABLE IF NOT EXISTS `small_order`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `order_no` CHAR(20) NOT NULL COMMENT '订单号',
    `product` INT(10) UNSIGNED NOT NULL, -- product
    `customer` INT(10) UNSIGNED NOT NULL, -- user
    `address` INT(10) UNSIGNED NOT NULL, -- address, since address will chang by user
    `factory` INT(10) UNSIGNED NOT NULL, -- factory

    `product` INT(10) UNSIGNED NOT NULL,
    `size` SMALLINT(4) UNSIGNED NOT NULL,
    `carve_text` VARCHAR(120),
    `material` CHAR(20) NOT NULL,
    `create_time` DATETIME,

    `state` ENUM(
        'InCart',
        'ToBeConfirmed',
        'InFactory',
        'FactoryConfirmed',
        'FactoryDone',
        'Done'
    ) NOT NULL DEFAULT 'ToBeConfirmed',

    `gold_weight` DECIMAL(4, 2) NOT NULL,
    `wear_tear` TINYINT(2) NOT NULL,
    `gold_price` DECIMAL(4, 2) NOT NULL,

    `work_fee` DECIMAL(4, 2) NOT NULL,
    `small_stone` DECIMAL(4, 2) NOT NULL,
    `small_stone_fee` DECIMAL(4, 2),

    `st_price` DECIMAL(6, 2),
    `st_weight` DECIMAL(4, 2),

    `model_fee` DECIMAL(6, 2),
    `risk_fee` DECIMAL(6, 2),

    `factory_st` TINYINT(2),
    `factory_st_weight` DECIMAL(4, 2),

    `create_time` DATETIME,
    `to_factory_time` DATETIME,
    `factory_confirm_time` DATETIME,
    `factory_done_time` DATETIME,
    `all_done_time` DATETIME,

    `factory_price` DECIMAL(8, 2) NOT NULL,
    `real_price` DECIMAL(8, 2) NOT NULL,

    `customer_remark` TEXT,
    `admin_remark` TEXT,

    PRIMARY KEY(id)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- factory
CREATE TABLE IF NOT EXISTS `factory`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` CHAR(60) NOT NULL,
    PRIMARY KEY(id)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- setting 全局设定
CREATE TABLE IF NOT EXISTS `setting`
(
    `key` CHAR(30) NOT NULL,
    `value` CHAR(30) NOT NULL
) ENGINE=MyISAM;

-- price
CREATE TABLE IF NOT EXISTS `price`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `type` CHAR(10) NOT NULL, -- ENUM('PT950', 'AU750')
    `price` DECIMAL(8,2) NOT NULL,
    `time` DATETIME NOT NULL,
    PRIMARY KEY(id)
) ENGINE=MyISAM AUTO_INCREMENT=101;

-- login history
CREATE TABLE IF NOT EXISTS `user_log`
(
    `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user` INT(10) UNSIGNED NOT NULL,
    `action` ENUM('Login', 'StartBill', 'DoneBill', 'ViewProduct') NOT NULL,
    `target` INT(10) UNSIGNED,
    `time` DATETIME NOT NULL,
    PRIMARY KEY(id)
) ENGINE=MyISAM AUTO_INCREMENT=101;
