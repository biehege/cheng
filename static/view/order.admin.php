<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<div class="search">
    <div>
        <label for="name">名称：</label>
        <input type="text" name="name" id="name" />
    </div>
    <div>
        <label for="product_no">款号：</label>
        <input type="text" name="product_no" id="product_no" />
    </div>
    <div>
        <label for="no">订单号：</label>
        <input type="text" name="no" id="no" />
    </div>
    <div>
        <label for="type">分类：</label>
        <select>
            <option value="">请选择</option>
            <?php foreach ($types as $t): ?>
                <option value="<?= $t ?>" <?= $type == $t ? 'selected' : '' ?> ><?= $t ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div>
        <label for="customer">客户名：</label>
        <input type="text" name="customer" id="customer" />
    </div>
    <div>
        <label for="username">用户名：</label>
        <input type="text" name="username" id="username" />
    </div>
    <div>
        <label for="factory">工厂名：</label>
        <input type="text" name="factory" id="factory" />
    </div>
    <div>
        <label for="time">下单时间：</label>
        <input type="text" name="time_start" id="time" />
        <input type="text" name="time_end" id="time" />
    </div>
    <div>
        <label for="state">状态：</label>
        <input type="text" name="state" id="state" />
    </div>
    <input type="submit" value="搜索" />
</div>
<div>
    <div class="title">
        <span class="col">名称</span>
        <span class="col">详细规格</span>
        <span class="col">姓名</span>
        <span class="col">预估价</span>
        <span class="col">工厂价格</span>
        <span class="col">实际价格</span>
        <span class="col">客户已付</span>
        <span class="col">状态</span>
        <span class="col">状态</span>
        <span class="col">操作</span>
    </div>
    <?php foreach ($orders as $order): ?>
        <div>
            <div>
                <input type="checkbox" />
                <span>订单号：<?= $order->order_no ?></span>
                <span>下单时间：<?= $order->submit_time ?></span>
                <span>修改</span>
            </div>
            <div class="col name">
                <img />
                <span><?= $order->product->name ?></span>
                <span>款号：<?= $order->product->no ?></span>
            </div>
            <div class="col info">
                <span>材质：<?= $order->material ?></span>
                <span>手寸：<?= $order->size ?></span>
                <span>刻字：<?= $order->carve_text ?></span>
                <span>镶口：<?= $order->product->rabbet_start . '-' . $order->product->rabbet_end ?>ct</span>
                <span>辅石：<?= $order->small_stone ?></span>
                <span>工费：<?= $order->labor_expense ?></span>
                <span>损耗：<?= $order->wear_tear ?></span>
            </div>
            <div class="col realname">
                <?= $order->customer->user->realname ?>
            </div>
            <div class="col price-estimate">
                <?= $order->estimate_price ?>
            </div>
            <div class="col price-real">
                <?= $order->factory_price ?>
            </div>
            <div class="col price-real">
                <?= $order->real_price ?>
            </div>
            <div class="col paid">
                <?= $order->paid ?>
            </div>
            <div class="col state">
                <?= $state_map[$order->state] ?>
            </div>
            <div class="col control">
                <button><?= $next_button_map[$order->state] ?></button>
            </div>
            <div class="remark">备注
            </div>
            <div class="detail-info"></div>
        </div>
    <?php endforeach ?>
</div>
<div>
    <input type="checkbox" />
    <button>批量导出</button>
    <div class="paging"></div>
</div>
