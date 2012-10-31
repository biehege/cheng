<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

list(
    $name,
    $no,
    $type,
    $sort1,
    $sort2) = _get(
        'name',
        'no',
        'type',
        'sort1',
        'sort2');

$sort = $sort1 ? $sort1 . ' ' . $sort2 : '';

$types = Product::types();

$p = _get('p') ?: 1;
$per_page = 50;
$total = Product::count(array(
    'name' => $name,
    'no'   => $no,
    'type' => $type));
$paging = new Paginate($per_page, $total);
$paging->setCurPage($p);
$products = Product::listProduct(array(
    'limit' => $per_page,
    'offset' => $paging->offset(),
    'name' => $name,
    'no'   => $no,
    'type' => $type,
    'sort' => $sort));

$matter = $view;
$view = 'board.admin?master';
