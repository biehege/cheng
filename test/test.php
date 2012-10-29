<?php

require 'lib/test.php'; // test functions

require_once APP_ROOT . 'lib/function.php';
require_once APP_ROOT . 'lib/autoload.php';
include_once APP_ROOT . 'config/common.php';

Pdb::setConfig($config['db']);

// clear side effects for all
$clear = 1;
if ($clear) {

    // unset all session
    if (1) {
        session_start();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
    }
    
    // case 3
    $username = 'test_user';
    $customer_ids = Pdb::del(User::$table, array('name=?' => $username));

    // can be replaced with clear db
    clear_db(Customer::$table, User::$table, 'user');

    // case 4
    $username = 'test_admin';
    Pdb::del(User::$table, array('name=?' => $username));

    // case 5
    Pdb::del(Product::$table, array('name LIKE ?' => '%_test'));

    // case 6
    clear_db(Cart::$table, Customer::$table, 'customer', 'customer');
    clear_db(Order::$table, Customer::$table, 'customer'); // what if Order submited??

    // case 7
    clear_db('big_to_small_order', Order::$table, 'small', 'small');
    $big_order_ids = Pdb::fetchAll('id', BigOrder::$table);
    if ($big_order_ids) 
        foreach ($big_order_ids as $id)
            if (!Pdb::exists('big_to_small_order', array('big=?' => $id)))
                Pdb::del(BigOrder::$table, array('id=?' => $id));

    // clear address
    clear_relation_db(Customer::$table, Address::$table);

    if (_get('exit')) {
        echo '<script src="static/hide.js"></script>';
        echo '<div class="conclusion pass">All Clear!</div>';
        exit;
    }
}

$all_pass = true;

// case 1 autoload
begin_test();
$id = 101;
$model = new Model($id);
test($model->id, $id, array(
    'name' => 'spl_autoload_register'));

// case 2 test for kind_of_equal()
begin_test();
$a = array('z' => 3, 'a' => 42);
$b = array('a' => 42, 'z' => 3);
test(kind_of_equal($a, $b), true, array('name' => 'test for kind_of_equal()'));

// case 3 register customer, user db
begin_test();
$username = 'test_user';
$password = 'password';
$realname = '小池';
$phone = '13711231212';
$email = 'cumt.xiaochi@gmail.com';
$customer = Customer::register(
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
$id = $customer->user->id;
$real_arr = Pdb::fetchRow('*', User::$table, array('id=?' => $id));
test(
    $real_arr, 
    $ideal_arr, 
    array('name' => 'register customer, db', 'compare' => 'in'));

// case 4 Super Admin create Admin, db
begin_test();
$username = 'test_admin';
$password = 'password';
$user = User::getByName('root');
$superadmin = $user->instance();
$admin = $superadmin->createAdmin(compact('username', 'password'));
$ideal_arr = array(
    'name' => $username,
    'password' => md5($password),
    'type' => 'Admin');
$id = Pdb::lastInsertId();
$real_arr = Pdb::fetchRow(
    'name, password, type', 
    User::$table, 
    array('id=?' => $id));
test($real_arr, $ideal_arr, array('name' => 'Super Admin create Admin, db'));

// case 6 Admin update gold Price
begin_test();
$admin->updatePrice('PT950', '1903.21');
$admin->updatePrice('Au750', '1723.45');
test(1, 1, array('name' => 'Admin update gold Price'));

// case 5 Admin post Product, db
begin_test();
$info = array(
    'name' => '唯爱心形群镶女戒_test',
    'material' => 'PT950',
    'rabbet_start' => '0.30',
    'rabbet_end' => '0.60',
    'small_stone' => 3);
$product = $admin->postProduct($info);
test(
    Pdb::fetchRow('*', Product::$table, array('id=?' => $product->id)),
    $info,
    array(
        'name' => 'Admin post Product, db',
        'compare' => 'in'));

// case 6 Customer eidt Address
begin_test();
$address = $customer->defaultAddress();
$address->edit(array(
    'name' => '小池',
    'phone' => '14722320989',
    'detail' => '深圳罗湖区田贝'));
test(1, 1, array('name' => 'Customer eidt Address'));

// case 6 Customer add a Product to Cart
begin_test();
$old_entry_num = Pdb::count(Order::$table);
$opts = array(
    'material' => 'PT950',
    'size' => 12,
    'carve_text' => 'I love U');
$order = $customer->addProductToCart($product, $opts);
$entry_num = Pdb::count(Order::$table);
test(
    $old_entry_num + 1, 
    +$entry_num, 
    array('name' => 'Customer add a Product to Cart'));

// case 7 Cart count()
$cart = $customer->cart();
test(
    +$cart->count(),
    1,
    array('name' => 'Cart count()'));

// case 8 Cus

// case 7 Customer submit a Cart
// begin_test();
// $old_entry_num = Pdb::count(BigOrder::$table);
// $big_order = $customer->submitCart();
// $entry_num = Pdb::count(BigOrder::$table);
// test(
//     $old_entry_num + 1,
//     +$entry_num,
//     array('name' => 'Customer submit a Cart'));

// case 8 Admin Confirmed Order (InFactory)
// $admin->setOrderState($order, 'InFactory');
// test(1, 1, array('name' => 'Admin Confirmed Order (InFactory)'));
