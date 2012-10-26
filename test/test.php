<?php

require 'lib/test.php'; // test functions

require_once APP_ROOT . 'lib/function.php';
require_once APP_ROOT . 'lib/autoload.php';
include_once APP_ROOT . 'config/common.php';

$all_pass = true;

// case 1 autoload
$id = 101;
$model = new Model($id);
test($model->id, $id, array(
    'name' => 'spl_autoload_register'));

// case 2 test for kind_of_equal()
$a = array('z' => 3, 'a' => 42);
$b = array('a' => 42, 'z' => 3);
test(kind_of_equal($a, $b), true, array('name' => 'test for kind_of_equal()'));

Pdb::setConfig($config['db']);

// case 3 register customer, user db
$username = 'test_user';
$password = 'password';
$realname = '小池';
$phone = '13711231212';
$email = 'cumt.xiaochi@gmail.com';
Customer::register(
    compact(
        'username',
        'password',
        'realname',
        'phone',
        'email'));
$ideal_arr = array(
    'name' => $username,
    'password' => md5($password),
    'type' => 'Customer',
    'realname' => $realname,
    'phone' => $phone,
    'email' => $email,
);

$id = Pdb::lastInsertId();
$customer = new Customer($id);
$id = $customer->user->id;
$real_arr = Pdb::fetchRow('*', User::$table, array('id=?' => $id));
unset($real_arr['create_time']);
unset($real_arr['id']);
test($real_arr, $ideal_arr, array('name' => 'register customer, db'));
Pdb::del(User::$table, array('name=?' => $username)); // clear side effect
Pdb::del(Customer::$table, array('user=?' => $id));

// case 3 Super Admin create Admin, db

$username = 'test_admin';
$password = 'password';
$user = User::getByName('root');
$superadmin = $user->instance();
$superadmin->createAdmin(compact('username', 'password'));
$ideal_arr = array(
    'name' => $username,
    'password' => md5($password),
    'type' => 'Admin');
$id = Pdb::lastInsertId();
$real_arr = Pdb::fetchRow('name, password, type', User::$table, array('id=?' => $id));
test($real_arr, $ideal_arr, array('name' => 'Super Admin create Admin, db'));
Pdb::del(User::$table, array('name=?' => $username));
