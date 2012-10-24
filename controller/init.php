<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @file    init
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

$logging_user = User::loggingUser();

if ($logging_user === false) {
    $has_login = false;
} else {
    $has_login = true;
    $user = $logging_user;
    $type = $user->type;
    $$type = $user->instance();
}

$request_uri = urlencode($_SERVER['REQUEST_URI']);

$page['description'] = 'PHP Tiny Frame 很小很小的 PHP 框架';
$page['keywords'] = array('PHP', '开源', '框架', 'MVC');

Pdb::setConfig($config['db']);
