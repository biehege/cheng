<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

if ($user_type !== 'Admin')
    throw new Exception("have not permmition");

switch ($target) {
    case '':
        $factories = $admin->listFactory();
        break;

    case 'add':
        $name = _post('name');
        $contact = _post('contact');
        $phone = _post('phone');
        $qq = _post('qq');
        $email = _post('email');
        $address = _post('address');
        $remark = _post('remark');

        if ($by_post) {
            $admin->addFactory(compact(
                'name',
                'contact',
                'phone',
                'qq',
                'email',
                'address',
                'remark'));
            redirect('facotry'); // to list
        }
        break;
    
    default:
        throw new Exception("unkown: $target");
        break;
}

$matter = $view . ($target? ".$target" : '');
$view = 'board?master';
