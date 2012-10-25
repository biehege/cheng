<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

if (!$has_login) 
    redirect('login?back=my');

$user_type = $user->type;
switch ($user_type) {
    case 'SuperAdmin':
        $admins = $superadmin->listAdmin();
        break;
    
    default:
        # code...
        break;
}

$view = 'my.' . strtolower($user_type) . '?master';
