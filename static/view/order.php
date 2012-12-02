<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<form action="<?= ROOT ?>order">
    <div class="search">
        <div>
            <div class="e">
                <label for="name">名称：</label>
                <input class="ti" type="text" name="name" id="name" />
            </div>
            <div class="e">
                <label for="product_no">款号：</label>
                <input class="ti" type="text" name="product_no" id="product_no" />
            </div>
            <div class="e">
                <label for="order_no">订单号：</label>
                <input class="ti" type="text" name="order_no" id="order_no" />
            </div>
            <div class="e">
                <label for="type">分类：</label>
                <?php
                $data = $types;
                include smart_view('widget.select');
                ?>
            </div>
        </div>
        <div>
            <?php if ($user_type === 'Admin'): ?>
                <div class="e">
                    <label for="customer">客户名：</label>
                    <input class="ti" type="text" name="customer" id="customer" />
                </div>
                <div class="e">
                    <label for="username">用户名：</label>
                    <input class="ti" type="text" name="username" id="username" />
                </div>
                <div class="e">
                    <label for="factory">工厂名：</label>
                    <input class="ti" type="text" name="factory" id="factory" />
                </div>
            <?php endif ?>
            <div class="e">
                <label for="time">下单时间：</label>
                <input class="ti" type="text" name="time_start" id="time" />
                -
                <input class="ti" type="text" name="time_end" id="time_end" />
            </div>
            <div class="e">
                <label for="state">状态：</label>
                <?php 
                $field_name = 'state'; 
                $data = $state_map;
                include smart_view('widget.select'); ?>
            </div>
            <input type="submit" value="搜索" class="mbtn" />
        </div>
    </div>
</form>
<div>
    <?php include smart_view('paging'); ?>
</div>
<div class="order">
    <div class="title">
        <span class="col title name">名称</span>
        <span class="col title info">详细规格</span>
        <span class="col title price-estimate">预估价</span>
        <?php if ($user_type === 'Admin'): ?>
            <span class="col title stone">主石</span>
        <?php endif ?>
        <?php if ($user_type === 'Admin'): ?>
            <span class="col title factory-name">工厂名称</span>
            <span class="col title price-factory">工厂价格</span>
            <span class="col title price-real">实际售价</span>
            <span class="col title paid">客户已付</span>
        <?php else: ?>
            <span class="col title price-real">实际价格</span>
        <?php endif ?>
        <span class="col title state">状态</span>
        <?php if ($user_type == 'Admin'): ?>
            <span class="col title control">操作</span>
        <?php endif ?>
    </div>
    <?php foreach ($orders as $order): ?>
        <?php 
        $cus = $order->customer(); 
        $user = $cus->user();
        $prd = $order->product(); 
        $customer_price = $order->priceData('customer');
        ?>
        <div class="entry" data-id="<?= $order->id ?>">
            <div class="brief-info">
                <input type="checkbox" id="order-no-<?= $order->id ?>" />
                <label for="order-no-<?= $order->id ?>" class="e">订单号：<?= $order->order_no ?></label>
                <span class="e">下单时间：<?= $order->submit_time ?></span>
                <span>收件人：<?= $user->realname ?></span>
                <?php if ($user_type === 'Admin'): ?>
                    <span class="edit-info-btn">修改</span>
                <?php endif ?>
            </div>
            <div class="col name">
                <img src="<?= $prd->image1_thumb ?>" alt="缩略图" />
                <div class="text-wrap">
                    <span class="text"><?= $prd->name ?></span>
                    <span>款号：<?= $prd->no ?></span>
                </div>
            </div>
            <div class="col info">
                <span>材质：<?= $order->material ?></span>
                <span>手寸：<?= $order->size ?></span>
                <span>刻字：<?= $order->carve_text ?></span>
                <span>镶口：<?= $prd->rabbet_start . '-' . $prd->rabbet_end ?>ct</span>
                <span>辅石：<?= $customer_price->small_stone ?>粒</span>
                <span>工费：<?= $customer_price->labor_expense ?></span>
                <span>损耗：<?= $customer_price->wear_tear ?></span>
            </div>
            <div class="col price-estimate">
                ￥<?= fp($order->estimate_price) ?>
            </div>
            <?php if ($user_type === 'Admin'): ?>
                <div class="col stone">
                    <?php if (!$order->stoneExists()): ?>
                        <span class="stone-btn tbtn empty-holder">填写</span>
                    <?php else: ?>
                        <?php $stone = $order->stone(); ?>
                        <span class="stone-detail-btn" data-id="<?= $stone->id ?>" title="点击可以查看详情"><?= $stone->weight ?>ct</span>
                        <div class="stone-detail popup"></div>
                    <?php endif ?>
                </div>
            <?php endif ?>
            <?php if ($user_type === 'Admin'): ?>
                <?php $factory = $order->factory(); ?>
                <div class="col factory-name">
                    <?php if ($factory->exists()): ?>
                        <span class="text choose-factory-btn tbtn"><?= $factory->name ?></span>
                    <?php else: ?>
                        <span class="choose-factory-btn tbtn empty-holder">选择</span>
                    <?php endif ?>
                </div>
                <div class="col price-factory">
                    <span class="price-change-btn tbtn" data-title="工厂价格计算" data-type="Factory">
                        ￥<?= fp($order->factory_price) ?>
                    </span>
                </div>
                <div class="col price-real">
                    <span class="price-change-btn tbtn" data-title="实际售价计算" data-type="Customer">
                        ￥<?= fp($order->real_price) ?>
                    </span>
                </div>
                <div class="col paid">
                    <span class="pay-btn tbtn"><?= fp($order->paid) ?></span>
                </div>
            <?php else: ?>
                <div class="col price-real">
                    ￥<?= fp($order->real_price) ?>
                    <img class="price-detail-btn" title="价格详情" alt="价格详情" src="<?= ROOT ?>static/img/i.gif" />
                </div>
            <?php endif ?>
            <div class="col state">
                <div><?= $state_map[$order->state] ?></div>
                <?php if ($user_type === 'Admin'): ?>
                    <div class="detail-btn">查看详情</div>
                <?php endif ?>
            </div>
            <?php if ($user_type == 'Admin'): ?>
                <div class="col control">
                    <?php $caption = $next_button_map[$order->state]; ?>
                    <?php if ($caption): ?>
                        <button class="next-btn mbtn"><?= $caption ?></button>
                    <?php endif ?>
                </div>
            <?php endif ?>
            <div class="remark">
                <span>备注：</span>
                <span><?= $order->customer_remark ?></span>
            </div>
            <?php if ($user_type === 'Admin'): ?>
                <div class="remark">
                    <span>管理员备注：</span>
                    <span><?= $order->admin_remark ?></span>
                </div>
            <?php endif ?>
            <div class="order-detail"></div>
        </div>
    <?php endforeach ?>
</div>
<div>
    <?php include smart_view('paging'); ?>
    <input type="checkbox" />
    <button>批量导出</button>
</div>
