<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

if ($user_type !== 'Admin')
    die('no permission');



switch ($target) {
    case '':
        $customers = $admin->listCustomer();
        break;
    case 'add':
        list(
            $username,
            $password,
            $realname,
            $phone,
            $qq,
            $email,
            $address,
            $remark
        ) = _post(
            'username',
            'password',
            'realname',
            'phone',
            'qq',
            'email',
            'address',
            'remark');
        if ($by_post) {
            $admin->addCustomer(compact(
                'username',
                'password',
                'realname',
                'phone',
                'qq',
                'email',
                'address',
                'remark'));
            redirect('user');
        }
        break;
    default:
        throw new Exception("unknown: $target");
        break;
}

$matter = $view . ($target? ".$target" : '');
$view = 'board.admin?master';
