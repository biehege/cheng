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
    <span class="col-name">货品名称</span>
    <span class="col-info">详细参数</span>
    <span class="col-price">预计价格</span>
    <span class="col-del">删除</span>
</div>
<?php foreach ($orders as $order): ?>
    <?php $prd = $order->product; ?>
    <div>
        <div class="col-name">
            <img />
            <span><?= $prd->name ?></span>
            <span>货号：<?= $prd->no ?></span>
        </div>
        <div class="col-info">
            <span>材质：<?= $prd->material ?></span>
            <span>手寸：<?= $order->size ?></span>
            <span>刻字：<?= $order->name ?></span>
            <span>镶口：<?= $prd->rabbet_start ?>-<?= $prd->rabbet_end ?> ct</span>

            <span>辅石：<?= $order->small_stone ?>粒</span>
            <span>工费：<?= $order->labor_expense ?>元/件</span>
            <span>损耗：<?= $order->ware_tear ?>%</span>
        </div>
        <div class="col-price">
            <div>英格预估价</div>
            <div><?= $prd->price_estimate ?>元</div>
        </div>
        <div class="col-del">
            <span>删除</span>
        </div>
    </div>
    <div class="remark">填写备注信息&gt;</div>
<?php endforeach ?>
