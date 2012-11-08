<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @file    init
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

// db config
Pdb::setConfig($config['db']);

// login
$user = User::loggingUser(); // but the var here should be long such as $logging_user
if ($user === false) {
    $has_login = false;
} else {
    $has_login = true;
    $user_type = $user->type;
    $type = strtolower($user_type); // $type is a temp var
    $$type = $user->instance();

    switch ($user_type) {
        case 'Customer':
            $cart = $customer->cart();
            break;

        case 'Admin':
        case 'SuperAdmin':
            break;
        
        default:
            throw new Exception('unrecognize type: ' . $user_type);
            break;
    }
}

// login check
if (in_array($controller, $config['controllers_need_login']) && !$has_login)
    redirect("login?back=$controller/$target");

// sometimes, ? will came, so trim it
$request_uri = reset(explode('?', $_SERVER['REQUEST_URI']));

// build nav array
$navs['default'] = build_nav($config['navs']['default']);
$navs['admin'] = build_nav($config['navs']['admin']);

$page['description'] = 'PHP Tiny Frame 很小很小的 PHP 框架';
$page['keywords'] = array('PHP', '开源', '框架', 'MVC');
