<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @file    index
 * @author  ryan <cumt.xiaochi@gmail.com>
 * @created Jun 27, 2012 6:24:01 PM
 */

if ($user_type === 'Admin') {
    redirect('order/all');
}
if ($user_type === 'SuperAdmin') {
    redirect('admin');
}

list(
    $name, 
    $no, 
    $stone_size,
    $type
) = _get(
    'name',
    'no',
    'stone_size',
    'type');

$cur_page = _get('p') ?: 1;

$per_page = 10;
$conds = compact(
    'name',
    'no',
    'stone_size',
    'type');
$total = Product::count($conds);
$paging = new Paginate($per_page, $total);
$paging->setCurPage($cur_page);

$products = Product::listProduct(array_merge(
    $conds,
    array(
        'limit' => $per_page,
        'offset' => $paging->offset())));

$types = Product::types();

$view .= '?master';

$page['scripts'][] = 'widget';
