<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<div class="indicator">
    <span>选购货品</span>
    <span>核对货品及收件地址</span>
    <span>提交订单</span>
</div>
<div>
    <h2>我的购物车</h2>
    <a>返回继续选购</a>
</div>
<h3>确认订单信息</h3>
<div>
    <span class="col name title">货品名称</span>
    <span class="col info title">详细参数</span>
    <span class="col price title">预计价格</span>
    <span class="col del title">删除</span>
</div>
<?php foreach ($orders as $order): ?>
    <?php $prd = $order->product; ?>
    <div>
        <div class="col name">
            <img />
            <span><?= $prd->name ?></span>
            <span>货号：<?= $prd->no ?></span>
        </div>
        <div class="col info">
            <span>材质：<?= $prd->material ?></span>
            <span>手寸：<?= $order->size ?></span>
            <span>刻字：<?= $order->carve_text ?></span>
            <span>镶口：<?= $prd->rabbet_start ?>-<?= $prd->rabbet_end ?> ct</span>
            <span>辅石：<?= $order->small_stone ?>粒</span>
            <span>工费：<?= $order->labor_expense ?>元/件</span>
            <span>损耗：<?= $order->wear_tear ?>%</span>
        </div>
        <div class="col price">
            <div>英格预估价</div>
            <div><?= $prd->price_estimate ?>元</div>
        </div>
        <div class="col del">
            <span>删除</span>
        </div>
    </div>
    <div class="remark">填写备注信息&gt;</div>
<?php endforeach ?>
<div class="total-info">
    <div>共计<?= $cart->count() ?>件</div>
    <div>预估总价<?= $cart->totalPrice() ?>元</div>
</div>
<form method="post">
    <div>
        <span>请确认您的收件地址：</span>
        <span>编辑</span>
    </div>
    <?php foreach ($addresses as $addr): ?>
        <div>
            <input type="radio" name="address" value="<?= $addr->id ?>" id="addr<?= $addr->id ?>">
            <label for="addr<?= $addr->id ?>"><?= $addr->name ?></label>
            <span><?= $addr->phone ?></span>
            <span><?= $addr->detail ?></span>
    <?php endforeach ?>
    <input type="submit" value="提交订单" />
</form>

