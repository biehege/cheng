<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<form>
    <div class="search">
        <div class="e">
            <label for="name">名称：</label>
            <input type="text" name="name" id="name" />
        </div>
        <div class="e">
            <label for="product_no">款号：</label>
            <input type="text" name="product_no" id="product_no" />
        </div>
        <div class="e">
            <label for="order_no">订单号：</label>
            <input type="text" name="order_no" id="order_no" />
        </div>
        <div class="e">
            <label for="type">分类：</label>
            <?php
            $data = $types;
            include smart_view('widget.select');
            ?>
        </div>
        <?php if ($user_type === 'Admin'): ?>
            <div class="e">
                <label for="customer">客户名：</label>
                <input type="text" name="customer" id="customer" />
            </div>
            <div class="e">
                <label for="username">用户名：</label>
                <input type="text" name="username" id="username" />
            </div>
            <div class="e">
                <label for="factory">工厂名：</label>
                <input type="text" name="factory" id="factory" />
            </div>
        <?php endif ?>
        <div class="e">
            <label for="time">下单时间：</label>
            <input type="text" name="time_start" id="time" />
            <input type="text" name="time_end" id="time" />
        </div>
        <div class="e">
            <label for="state">状态：</label>
            <input type="text" name="state" id="state" />
        </div>
        <input type="submit" value="搜索" />
    </div>
</form>
<div>
    <?php include smart_view('paging'); ?>
    <div>共找到：<?= $total ?>条</div>
</div>
<div>
    <div class="title">
        <span class="col title name">名称</span>
        <span class="col title info">详细规格</span>
        <span class="col title realname">姓名</span>
        <span class="col title price-estimate">预估价</span>
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
            <div>
                <input type="checkbox" />
                <span>订单号：<?= $order->order_no ?></span>
                <span>下单时间：<?= $order->submit_time ?></span>
                <span class="edit-info-btn">修改</span>
            </div>
            <div class="col name">
                <img />
                <span><?= $prd->name ?></span>
                <span>款号：<?= $prd->no ?></span>
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
            <div class="col realname">
                <?= $user->realname ?>
            </div>
            <div class="col price-estimate">
                <?= $order->estimate_price ?>
            </div>
            <?php if ($user_type === 'Admin'): ?>
                <div class="col factory-name">
                    <span class="text"><?= $order->factory()->name ?></span>
                    <span class="choose-factory-btn">选择</span>
                </div>
                <div class="col price-factory">
                    <?= $order->factory_price ?>
                    <span class="price-change-btn" data-title="工厂价格计算" data-type="Factory">修改</span>
                </div>
                <div class="col price-real">
                    <?= $customer_price->finalPrice() ?>
                    <span class="price-change-btn" data-title="实际售价计算" data-type="Customer">填写</span>
                </div>
                <div class="col paid">
                    <?= $order->paid ?>
                    <span class="pay-btn">填写</span>
                </div>
            <?php else: ?>
                <div class="col price-real">
                    <?= $customer_price->finalPrice() ?>
                </div>
            <?php endif ?>
            <div class="col state">
                <?= $state_map[$order->state] ?>
            </div>
            <?php if ($user_type == 'Admin'): ?>
                <div class="col control">
                    <?php $caption = $next_button_map[$order->state]; ?>
                    <?php if ($caption): ?>
                        <button class="next-btn" data-action="<?= $next_action_map[$order->state] ?>"><?= $caption ?></button>
                    <?php endif ?>
                </div>
            <?php endif ?>
            <div class="remark">备注
            </div>
            <div class="detail-info">
                <div class="address">
                    <?php $address = $cus->defaultAddress() ?>
                    <h4>收件人信息</h4>
                    <div><?= $address->name ?> <?= $address->phone ?></div>
                    <div><?= $address->detail ?></div>
                </div>
                <div class="log">
                    <h4>订单处理日志</h4>
                    <span>跟进&nbsp;&gt;</span>
                    <?php $order_log = $order->log(); ?>
                    <?php foreach ($order_log as $entry): ?>
                        <div class=""><?= $entry['time'] ?> <?= $entry['remark'] ?></div>
                    <?php endforeach ?>
                </div>
                <br class="clear-fix" />
            </div>
        </div>
    <?php endforeach ?>
</div>
<div>
    <?php include smart_view('paging'); ?>
    <input type="checkbox" />
    <button>批量导出</button>
</div>
