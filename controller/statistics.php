<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

switch ($target) {
    case 'gold_price':
        $time_start = _get('time_start');
        $time_end = _get('time_end');
        $type = _get('type');

        $material_types = $config['material_type_map'];

        $p = _get('p') ?: 1;
        $per_page = 50;
        $total = Price::total($type);
        $paging = new Paginate($per_page, $total);
        $paging->setCurPage($p);
        $prices = Price::history(array(
            'type' => $type,
            'limit' => $per_page,
            'offset' => $paging->offset()));
        break;

    case 'sale':
        $divide = _get('divide') ?: 'day'; // day or month

        $data = Statistics::saleRecord(compact('divide'));

        break;
    
    default:
        throw new Exception("unkown target: $target");
        break;
}


$matter = $view . '.' . $target;
$view = 'board?master';
