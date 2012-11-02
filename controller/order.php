<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

list(
    $name,
    $product_no,
    $no,
    $type,
    $time_start,
    $time_end,
    $state) = _get(
        'name',
        'product_no',
        'no',
        'type',
        'time_start',
        'time_end',
        'state');

if (!isset($_GET['state']))
    $state = $target;
if ($state === 'all')
    $state = '';

$conds = compact(
    'name',
    'product_no',
    'no',
    'time_start',
    'time_end',
    'type',
    'state');

switch ($user_type) {
    case 'Customer':
        $customer = $customer->id;
        break;

    case 'Admin':
    case 'SuperAdmin':
        list(
            $customer,
            $username,
            $factory) = _get(
                'customer',
                'username',
                'factory');
        $conds = array_merge(
            $conds,
            compact(
                'username',
                'factory'));
        break;
    
    default:
        throw new Exception("unkown user type: $user_type");
        break;
}
$conds['customer'] = $customer;

$types = Product::types();
$state_map = $config['order_states'];
$next_button_map = $config['next_button_map'];

$per_page = 50;
$total = Order::count($conds);
$paging = new Paginate($per_page, $total);
$paging->setCurPage(_get('p') ?: 1);
$orders = Order::listOrder(array_merge(
    array(
    'limit' => $per_page,
    'offset' => $paging->offset()),
    $conds));

// we don't need this two lines
if (empty($orders)) 
    $orders = array();

$matter = $view;
$view = 'board?master';
