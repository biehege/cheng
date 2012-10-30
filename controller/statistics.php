<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

$p = _get('p') ?: 1;
$per_page = 50;
$total = Price::total();
$paging = new Paginate($per_page, $total);
$paging->setCurPage($p);
$prices = Price::history(array(
    'limit' => $total,
    'offset' => $paging->offset()));
$matter = $view;
$view = 'board.admin?master';
