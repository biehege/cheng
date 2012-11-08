<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

// we will del this file

$msg = '';
$ERROR_INFO = $config['error']['info'];
switch ($target) {
    case 'admin':
        if (!isset($user) || $user->type !== 'SuperAdmin')
            die('not permit');
        $username = _post('username');
        $password = _post('password');
        if (!$by_post) 
            break;
        if (empty($username)) {
            $msg = $ERROR_INFO['USERNAME_EMPTY'];
        } elseif (empty($password)) {
            $msg = $ERROR_INFO['PASSWORD_EMPTY'];
        } elseif (User::find($username)) {
            $msg = $ERROR_INFO['USER_ALREADY_EXISTS'];
        } else {
            $superadmin->createAdmin(
                compact(
                    'username', 
                    'password'
                ));
            redirect('my');
        }
        break;
    default:
        exit("can not create $target");
}

$view .= '?master';
