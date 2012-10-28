<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @file    index
 * @author  ryan <cumt.xiaochi@gmail.com>
 * @created Jun 27, 2012 6:24:01 PM
 */

if (!$has_login) {
    redirect('login');
}

list(
    $name, 
    $no, 
    $stone_size) = _get(
    'name',
    'no',
    'stone_size');

$cur_page = _get('p') ?: 1;

$total = Product::count();
$per_page = 10;
$paging = new Paginate($per_page, $total);
$paging->setCurPage($cur_page);

$products = Product::listProduct(
    array(
        'limit' => $per_page,
        'offset' => $paging->offset()));


$view .= '?master';

$page['scripts'][] = 'widget';
