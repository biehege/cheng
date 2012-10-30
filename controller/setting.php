<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

if ($user_type !== 'Admin')
    die('no permission');

Setting::getAll();
$view .= '?master';
