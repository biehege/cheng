<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

// this file is for admin to get ajax divs to control the orders 

$order_id = $target;
$order = new Order($order_id);

switch ($action) {

    case 'get_action_div': 
        $view_name = 'order.control';
        include smart_view('append.div');
        break;

    case 'get_info_div':
        if (!is_numeric($target)) // to del
            throw new Exception("unkown id: $target");
        
        $cus = $order->customer();
        $product = $order->product();
        $materials = $product->materials();

        $div_name = 'order-edit';
        $view_name = 'order.edit';
        include smart_view('append.div');
        break;

    case 'get_detail_div':
        $cus = $order->customer();
        include smart_view('order.detail');
        break;

    case 'get_price_div':
        if (is_numeric($target)) {
            $title = _get('title');
            $type = _get('type');

            $order_id = $target;
            $order = new Order($order_id);
            
            $div_name = 'order-change';
            $view_name = 'order.change';
            include smart_view('append.div');
            exit;
        } else {
            throw new Exception("unknown to get: $target");
        }
        break;

    case 'get_pay_div':
        $order_id = $target;
        $order = new Order($order_id);
        $cus = $order->customer(); // danger! we rewrite
        $account = $cus->account();

        $should_pay = $order->priceData('customer')->finalPrice();
        $paid = $order->paid;
        $unpaid = $should_pay - $paid;

        $div_name = 'order-pay';
        $view_name = 'order.pay';
        include smart_view('append.div');
        break;

    case 'get_stone_div':
        $stone = $order->stone();

        $view_name = 'order.stone';
        include smart_view('append.div');
        break;

    case 'get_factory_div':
        $factories = Factory::names();
        $view_name = 'order.factory';
        include smart_view('append.div');
        break;

    default:
        throw new Exception("ajax action get_XX_div not allowed: $action");
        break;
}
exit;
