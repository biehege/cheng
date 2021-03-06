<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

$order_id = $target;
$order = new Order($order_id);
switch ($action) {
    case 'edit_order':

        $material = _post('material');
        $size = _post('size');
        $carve_text = _post('carve_text');
        $customer_remark = _post('customer_remark');

        $order = new Order($order_id);

        $order->edit(compact(
            'material',
            'size',
            'carve_text',
            'customer_remark'));

        redirect('order/all');

        break;

    case 'change_price':

        if (!$by_post) {
            throw new Exception("not by post");
        }
        
        $order = new Order($target);

        $type = _post('type');
        $gold_weight = _post('gold_weight');
        $wear_tear = _post('wear_tear');
        $gold_price = _post('gold_price');
        $labor_expense = _post('labor_expense');
        $small_stone = _post('small_stone');
        $st_expense = _post('st_expense');
        $st_price = _post('st_price');
        $st_weight = _post('st_weight');
        $model_expense = _post('model_expense');
        $risk_expense = _post('risk_expense');

        $factory_st = _post('factory_st');
        $factory_st_weigth = _post('factory_st_weigth');

        $order->changePrice(
            $type, 
            compact(
                'gold_weight',
                'wear_tear',
                'gold_price',
                'labor_expense',
                'small_stone',
                'st_expense',
                'st_price',
                'st_weight',
                'model_expense',
                'risk_expense'));

        $order->edit(compact(
            'factory_st',
            'factory_st_weight'));

        redirect('order/all');
        break;

    case 'deduct':
        if (!$by_post)
            throw new Exception('not by post');
        $deduct = _post('deduct');
        $remark = _post('remark');

        // $customer = $order->customer();
        // $account = $customer->account();
        // $admin->deductAccountForOrder($account, $order, $deduct, $remark);
        // $order->edit('paid', $order->paid + $deduct);

        $admin->payOrder($order, $deduct, $remark);

        redirect('order/all');
        break;

    case 'edit_stone':
        $weight = _post('weight');
        $cut = _post('cut');
        $color = _post('color');
        $polish = _post('polish');
        $clarity = _post('clarity');
        $symmetry = _post('symmetry');
        $certificate = _post('certificate');
        $no = _post('no');
        $remark = _post('remark');

        $stone = $order->stone();
        $info = compact(
            'weight',
            'cut',
            'color',
            'polish',
            'clarity',
            'symmetry',
            'certificate',
            'no',
            'remark');
        $stone->edit($info);
        redirect('order/all');
        break;

    case 'change_factory':
        $factory_id = _post('factory_id');
        $order->edit('factory', $factory_id);
        redirect('order/all');
        exit;
    
    case '':
        // do nothing here
        break;

    case 'confirm':
        $admin->confirmOrder($order);
        redirect('order/all');
        break;

    case 'factoryDone':
        $admin->factoryDoneOrder($order);
        redirect('order/all');
        break;

    case 'done':
        $admin->doneOrder($order);
        redirect('order/all');
        break;

    case 'cancel':
        $admin->cancelOrder($order);
        redirect('order/all');
        break;

    default:
        throw new Exception("unkown action: $action");
        break;
}
exit;
