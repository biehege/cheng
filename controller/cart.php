<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

if ($user_type !== 'Customer')
    exit('no permission');

$cart = $customer->cart();
$orders = $cart->orders();

$view .= '?master';
