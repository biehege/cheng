<?php

namespace kindcent;

use kindcent\Pdb;
use kindcent\jewelry\model\Model;
use kindcent\jewelry\model\User;

require 'lib/test.php'; // test functions

require_once APP_ROOT . 'lib/function.php';
require_once APP_ROOT . 'lib/autoload.php';
include_once APP_ROOT . 'config/common.php';



// case 1 autoload
$id = 101;
$model = new Model($id);
test($model->id, $id, array(
    'name' => 'spl_autoload_register'));

Pdb::setConfig($config['db']);

// case 2 register user db
$username = 'test_user';
$password = 'password';
User::register($username, $password);
$db_arr = array(
    'name' => $username,
    'password' => md5($password),
    'type' => 'Customer'
);

$id = Pdb::lastInsertId();
$real_db_arr = Pdb::fetchRow('*', User::$table, array('id=?' => $id));
unset($real_db_arr['create_time']);
unset($real_db_arr['id']);
test($real_db_arr, $db_arr, array('name' => 'register user db'));

// case 2 login session 

// case 3 login db
