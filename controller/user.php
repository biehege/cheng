<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

switch ($user_type) {
    case 'Admin':
        include FrameFile::controller('user.customer');
        break;

    case 'SuperAdmin':
        include FrameFile::controller('user.admin');
        break;

    case 'Customer':
        die('no permission');
        break;
    
    default:
        throw new Exception("unkown user type: $user_type");
        break;
}
    
$view = 'board?master';

$page['scripts'][] = 'jquery.validate.min';
