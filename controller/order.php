<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

switch ($user_type) {
    case 'Customer':
        $view .= '.customer';
        break;

    case 'Admin':
    case 'SuperAdmin':
        break;
    
    default:
        throw new Exception("unkown user type: $user_type");
        break;
}

$view .= '.' . strtolower($user_type) . '?master';
