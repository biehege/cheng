<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<h3 class="title">实际价格组成明细</h3>
<input type="hidden" name="a" value="change_price">
<input type="hidden" name="type" value="<?= $type ?>">
<span>订单号： <?= $order->order_no ?></span>
<span>姓名：<?= $order->customer()->user()->name ?></span>
<span>名称：<?= $order->product()->name ?></span>
<span>材质：<?= $order->material ?></span>
<div>
    <span>合计价格：</span>
    <span><?= $price->finalPrice() ?></span>
    <span>(原价：1928.9元，已优惠28.9元)</span>
</div>
<div class="box-wrap gold">
    <div class="box">
        <div class="total1"><?= $price->gold_weight * (1 + $price->wear_teaar) * $price->gold_price ?></div>
        <div>
            <label for="gold_weight">金重：</label>
            <input type="text" value="<?= $price->gold_weight ?>" name="gold_weight" id="gold_weight" class="required" />
        </div>
        <div>
            <label for="wear_teaar">损耗：</label>
            <input type="text" value="<?= $price->wear_tear ?>" name="wear_teaar" id="wear_teaar" class="required" />
        </div>
        <div>
            <label for="gold_price">金价：</label>
            <input type="text" value="<?= $price->gold_price ?>" name="gold_price" id="gold_price" class="required" />
        </div>
    </div>
    <div>(金重+金重*损耗）*金价</div>
</div>
<div class="box-wrap labor">
    <div class="total2"></div>
    <div>
        <label for="labor_expense">工费：</label>
        <input type="text" value="<?= $price->labor_expense ?>" name="labor_expense" id="labor_expense" class="required" />
    </div>
    <div>
        <label for="small_stone">辅石数量：</label>
        <input type="text" value="<?= $price->small_stone ?>" name="small_stone" id="small_stone" class="required" />
    </div>
    <div>
        <label for="st_expense">辅石工费：</label>
        <input type="text" value="<?= $price->st_expense ?>" name="st_expense" id="st_expense" class="required" />
    </div>
    <div>工费+辅石数量*辅石工费</div>
</div>
<div class="box-wrap small-stone">
    <div class="total3"></div>
    <div>
        <label for="st_price">辅石价：</label>
        <input type="text" value="<?= $price->st_price ?>" name="st_price" id="st_price" class="required" />
    </div>
    <div>
        <label for="st_weight">辅石重量：</label>
        <input type="text" value="<?= $price->st_weight ?>" name="st_weight" id="st_weight" class="required" />
    </div>
    <div>辅石价*重量</div>
</div>
<div class="box-wrap others">
    <div class="box">
        <div class="total4"></div>
        <div>
            <label for="model_expense">起版费：</label>
            <input type="text" value="<?= $price->model_expense ?>" name="model_expense" id="model_expense" class="required" />
        </div>
        <div>
            <label for="risk_expense">风险费：</label>
            <input type="text" value="<?= $price->risk_expense ?>" name="risk_expense" id="risk_expense" class="required" />
        </div>
    </div>
    <div>版费+风险费</div>
</div>
<?php if ($type === 'Factory'): ?>
    <div class="more-info">
        其中，工厂配石
        <input name="factory_st" value="<?= $order->factory_st ?>" class="required" />
        粒，共
        <input name="factory_st_weight" value="<?= $order->factory_st_weight ?>" class="required" />
        克拉
    </div>
<?php elseif ($type === 'Customer'): ?>
    <div class="more-info">
        <span>客户下单当天的金价为</span>
        <span>PT950：<?= Price::get('PT950', $order->submit_time) ?>元/克</span>
        <span>AU750：<?= Price::get('AU750', $order->submit_time) ?>元/克</span>
    </div>
<?php endif ?>
