<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @file    common
 * @author  ryan <cumt.xiaochi@gmail.com>
 * @created Jun 30, 2012 10:38:22 AM
 */

if (isset($_SERVER['HTTP_APPNAME'])) { // on server
    define('ON_SERVER', TRUE);
    
    define('DEBUG', TRUE);
    
    define('UP_DOMAIN', 'xxxx');
} else {
    define('ON_SERVER', FALSE);
    
    define('DEBUG', TRUE);
    
    define('JS_VER',  time());
    define('CSS_VER', time());
}

define('ROOT', '/');

define('DEFAULT_LOGIN_REDIRECT_URL', ROOT); // 登录后的默认导向页面

$config['site']['name'] = 'EnMond';

$config['db'] = array(
    'host' => 'localhost',
    'dbname' => 'jewelry',
    'username' => 'root',
    'password' => 'xiaosan'
);

if (ON_SERVER) {
    // 会覆盖之前的配置
    $config['db'] = array(
        'master' => array('host' => SAE_MYSQL_HOST_M),
        'slave'  => array('host' => SAE_MYSQL_HOST_S),
        'port'   => SAE_MYSQL_PORT,
        'dbname' => SAE_MYSQL_DB,
        'username' => SAE_MYSQL_USER,
        'password' => SAE_MYSQL_PASS
    );
    include 'server.php';
}

// 数据库名
define('cart_product', 'cart_product');
define('customer_address', 'customer_address');

// error info
$config['error']['info'] = array(
    'PASSWORD_EMPTY' => 'plz enter password',
    'REPASSWORD_EMPTY' => 'plz reEnter your password to confirm',
    'PASSWORD_NOT_SAME' => 'sorry, password not the same, plz reEnter',
    'USERNAME_EMPTY' => 'username empty',
    'USERNAME_OR_PASSWORD_INCORRECT' => 'user name or password not right',
    'USER_ALREADY_EXISTS' => 'username already exists, choose another one',
    'REALNAME_EMPTY' => '请填写真实姓名',
    'PHONE_EMPTY' => '请填写手机号码',
    'EMAIL_EMPTY' => '请填写您的电子邮箱', );

// pages need login
$config['controllers_need_login'] = array(
    'index',
    'cart',
    'my',
    'order',
    'statistics',
    'setting');

// navs
// $config['navs'] = array(
//     'my' => array(
//         'title' => '我的资料',
//         'defalut' => 'info',
//         'children' => array(
//             'info' => array(
//                 'title' => ))),
//     'order' => array(),
//     'product' => array());
$config['navs']['default'] = '
我的订单 order
 - 待确认 tobeconfirmed
 - 已交工厂 infactory
 - 工厂完工 done
 + 全部订单 all
我的资料 my 
 + 个人资料 info
 - 修改密码 password
';
$config['navs']['admin'] = '
订单管理 order
 - 待确认 tobeconfirmed
 - 已交工厂 infactory
 - 工厂完工 done
 - 已取消 cancel
 + 全部订单 all
货品管理 product
 + 货品列表 
 - 单品上传 upload
 - 批量上传 batch
用户管理 user
 + 用户列表 
 - 审核用户 adopt
 - 新增用户 add
工厂管理 factory
 - 工厂列表 
 - 审核用户 adopt
 - 新增用户 add
数据统计 statistics
 - 历史金价 gold_price
 + 销量统计 sale
系统设置 setting
 + 全局设置
 - 修改密码 password
';
