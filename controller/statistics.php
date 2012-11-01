<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

$time_start = _get('time_start');
$time_end = _get('time_end');
$type = _get('type');

$material_types = $config['material_type_map'];

$p = _get('p') ?: 1;
$per_page = 50;
$total = Price::total($type);
$paging = new Paginate($per_page, $total);
$paging->setCurPage($p);
$prices = Price::history(array(
    'type' => $type,
    'limit' => $total,
    'offset' => $paging->offset()));

$matter = $view . '.' . $target;
$view = 'board.admin?master';
