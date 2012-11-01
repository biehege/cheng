<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

if ($user_type !== 'Admin')
    die('no permission');

switch ($target) {
    case '':

        $name = _get('name');
        $username = _get('username');
        $time_start = _get('time_start');
        $time_end = _get('time_end');
        $state = _get('state');

        $conds = compact(
            'name',
            'username',
            'time_start',
            'time_end',
            'state');

        $limit = 50;
        $total = $admin->countCustomer($conds);
        $paging = new Paginate($limit, $total);
        $paging->setCurPage(_get('p') ?: 1);

        $conds = array_merge(
            $conds,
            array(
                'limit' => $limit,
                'offset' => $paging->offset()));

        $customers = $admin->listCustomer($conds);

        $states = array(
            '0' => '未审核',
            '1' => '已经审核',);
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

    case 'adopt':
        break;
    default:
        throw new Exception("unknown: $target");
        break;
}

$matter = $view . ($target? ".$target" : '');
$view = 'board.admin?master';
