<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

if ($user_type !== 'Admin')
    die('no permission');

$customers = $admin->listCustomer();

$matter = $view . ($target? ".$target" : '');
$view = 'board.admin?master';
