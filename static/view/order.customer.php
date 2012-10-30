<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
?>
<div class="left">
    <?php include smart_view('my.nav'); ?>
</div>
<div class="right">
    <?php include smart_view('my.crumb'); ?>
</div>
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
        <input type="text" name="type" id="type" />
    </div>
    <div>
        <label for="time">下单时间：</label>
        <input type="text" name="time" id="time" />
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
        <span class="col">实际价格</span>
        <span class="col">状态</span>
    </div>
    <div>
        <div>
            
