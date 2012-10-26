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

    case 'Admin':
        $customers = $admin->listCustomer();
        break;
    
    default:
        throw new Exception('should not be here, user type: ' . $user_type);
        break;
}

$view = 'my.' . strtolower($user_type) . '?master';
