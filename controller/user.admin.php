<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */


switch ($target) {
    case '':
        $admins = $superadmin->listAdmin();
        break;

        case 'add':
        $username = _post('username');
        $password = _post('password');

        $msg = '';
        if ($by_post) {
            $superadmin->createAdmin(compact('username', 'password'));
            redirect('user');
        }
        break;
    
    default:
        throw new Exception("unkown target: $target");
        break;
}


$matter = "$view.admin" . ($target? ".$target" : '');
