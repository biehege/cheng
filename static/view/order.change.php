<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<h3>工厂价格计算</h3>
<span>订单号： <?= $order->order_no ?></span>
<span>姓名：<?= $order->customer()->user()->name ?></span>
<span>工厂名称：<?= $order->facotry()->name ?></span>
<div>
    <span>合计价格：</span>
    <span><?= $order->price ?></span>
    <span>修改</span>
</div>
<div>
    <div>
        <div class="total1"></div>
        <div>
            <label for="gold_weight">金重：</label>
            <input type="text" value="<?= $order->gold_weight ?>" name="gold_weight" id="gold_weight">
        </div>
        <div>
            <label for="wear_teaar">损耗：</label>
            <input type="text" value="<?= $order->wear_teaar ?>" name="wear_teaar" id="wear_teaar">
        </div>
        <div>
            <label for="gold_price">金价：</label>
            <input type="text" value="<?= $order->gold_price ?>" name="gold_price" id="gold_price">
        </div>
    </div>
    <div>(金重+金重*损耗）*金价</div>
</div>
<div>
    <div>
        <div class="total2"></div>
        <div>
            <label for="labor_expense">工费：</label>
            <input type="text" value="<?= $order->labor_expense ?>" name="labor_expense" id="labor_expense">
        </div>
        <div>
            <label for="small_stone">辅石数量：</label>
            <input type="text" value="<?= $order->small_stone ?>" name="small_stone" id="small_stone">
        </div>
        <div>
            <label for="st_expense">辅石工费：</label>
            <input type="text" value="<?= $order->st_expense ?>" name="st_expense" id="st_expense">
        </div>
    </div>
    <div>工费+辅石数量*辅石工费</div>
</div>
<div>
    <div>
        <div class="total3"></div>
        <div>
            <label for="st_price">辅石价：</label>
            <input type="text" value="<?= $order->st_price ?>" name="st_price" id="st_price">
        </div>
        <div>
            <label for="st_weight">辅石重量：</label>
            <input type="text" value="<?= $order->st_weight ?>" name="st_weight" id="st_weight">
        </div>
    </div>
    <div>辅石价*重量</div>
</div>
<div>
    <div>
        <div class="total4"></div>
        <div>
            <label for="model_expense">起版费：</label>
            <input type="text" value="<?= $order->model_expense ?>" name="model_expense" id="model_expense">
        </div>
        <div>
            <label for="risk_expense">风险费：</label>
            <input type="text" value="<?= $order->risk_expense ?>" name="risk_expense" id="risk_expense">
        </div>
    </div>
    <div>版费+风险费</div>
</div>
<div>
    <span>客户下单当天的金价为</span>
    <span>PT950：<?= Price::get('PT950', $order->submit_time) ?>元/克</span>
    <span>AU750：<?= Price::get('AU750', $order->submit_time) ?>元/克</span>
</div>
<input type="submit" value="确定">
