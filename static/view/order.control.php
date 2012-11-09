<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?> 
<h4>处理订单</h4>

<span>订单号：</span>
<span><?= $order->order_no ?></span>
<span>当前状态：</span>
<span><?= $state_map[$order->state] ?></span>

<form method="post">
    <input type="hidden" name="target" value="<?= $order_id ?>" />
    <label>处理结果：</label>
    <input type="radio" name="action" value="confirmOrder" id="act-confirm">
    <label for="act-confirm">移交工厂</label>
    <input type="radio" name="action" value="cancelOrder" id="act-cancel">
    <label for="act-cancel">作废</label>
    <textarea name="remark"><?= $order->admin_remark ?></textarea>
    <input type="submit" value="确定" />
</form>
