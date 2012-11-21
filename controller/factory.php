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
            
            redirect('factory'); // to list
        }
        break;
    
    default:
        if (!is_numeric($target))
            throw new Exception("unkown: $target");
        break;
}


if ($argument && $target) {

    $sorts = $config['account_sort'];
    $factory = new Factory($target);


    $time_start = _get('time_start');
    $time_end = _get('time_end');
    $type = _get('type');
    $sort = _get('sort');

    $conds = compact(
        'time_start',
        'time_end',
        'type',
        'sort');


    switch ($argument) {
        case 'stone':
            $types = $config['st_type'];
            
            $account = $factory->stAccount();
            break;

        case 'account':
            $types = $config['account_type'];

            $account = $factory->account();
            $orders = Order::listOrder(array('factory_id' => $factory->id));
            break;
        
        default:
            throw new Exception("arg: $argument", 1);
            
            break;
    }



    $per_page = 50;
    $total = $account->countHistory($conds);
    $paging = new Paginate($per_page, $total);
    $paging->setCurPage(_get('p') ?: 1);
    
    $history = $account->history(array_merge(
        $conds,
        array(
            'limit' => $per_page,
            'offset' => $paging->offset())));

    $matter = "$view.$argument";
} else {
    $matter = $view . ($target? ".$target" : '');
}

$view = 'board?master';

$page['scripts'][] = 'jquery.validate.min';
