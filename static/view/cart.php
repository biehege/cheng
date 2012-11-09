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
    <a href="<?= ROOT ?>">返回继续选购</a>
</div>
<?php if ($orders_count): ?>
    <h3>确认订单信息</h3>
    <div>
        <span class="col name title">货品名称</span>
        <span class="col info title">详细参数</span>
        <span class="col price title">预计价格</span>
        <span class="col del title">删除</span>
    </div>
    <?php foreach ($orders as $order): ?>
        <?php $prd = $order->product(); ?>
        <div class="product-entry" data-id="<?= $order->id ?>">
            <div class="row" >
                <div class="col name">
                    <img />
                    <span><?= $prd->name ?></span>
                    <span>货号：<?= $prd->no ?></span>
                </div>
                <div class="col info">
                    <span>材质：<?= $order->material ?></span>
                    <span>手寸：<?= $order->size ?></span>
                    <span>刻字：<?= $order->carve_text ?></span>
                    <span>镶口：<?= $prd->rabbet_start ?>-<?= $prd->rabbet_end ?> ct</span>
                    <span>辅石：<?= $prd->small_stone ?>粒</span>
                    <span>工费：<?= $labor_expense ?>元/件</span>
                    <span>损耗：<?= $wear_tear ?>%</span>
                </div>
                <div class="col price">
                    <div>英格预估价</div>
                    <div><?= $order->estimate_price ?>元</div>
                </div>
                <div class="col del">
                    <div class="popup">
                        <div>确定删除？</div>
                        <span class="ok-btn">确定</span>
                        <span class="cancel-btn">取消</span>
                    </div>
                    <span class="del btn">删除</span>
                </div>
            </div>
            <div class="remark">
                <form class="remark" method="post" action="<?= ROOT ?>order">
                    <input type="hidden" name="target" value="<?= $order->id ?>" />
                    <input type="hidden" name="action" value="change_remark">
                    <input type="text" name="remark" placeholder="填写备注信息&gt;" value="<?= $order->customer_remark ?>" />
                    <input type="submit" value="确定">
                </form>
            </div>
        </div>
    <?php endforeach ?>
    <div class="total-info">
        <span>
            共计
            <strong><?= $cart->count() ?>件</strong>
        </span>
        <span>
            预估总价
            <strong><?= $cart->totalPrice() ?>元</strong>
        </span>
    </div>
<?php else: ?>
    <div>你的购物车中还没有商品</div>
<?php endif ?>

<form method="post">
    <div>
        <span>请确认您的收件地址：</span>
        <span class="edit-addr-btn">编辑</span>
    </div>
    <?php foreach ($addresses as $addr): ?>
        <div>
            <input type="radio" name="address" value="<?= $addr->id ?>" id="addr<?= $addr->id ?>" data-id="<?= $addr->id ?>" checked />
            <label for="addr<?= $addr->id ?>"><?= $addr->name ?></label>
            <span><?= $addr->phone ?></span>
            <span><?= $addr->detail ?></span>
        </div>
    <?php endforeach ?>
    <input type="submit" value="提交订单" />
</form>
