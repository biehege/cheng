<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @file    index
 * @author  ryan <cumt.xiaochi@gmail.com>
 * @created Jul 17, 2012 9:51:11 AM
 */
?>
<div>index!!!</div>
<div class="search">
    <form>
        <div class="type">
            <span>分类：</span>
            <ul>
                <?php foreach (Product::types() as $type): ?>
                    <li><?= $type ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div>
            <label>名称：</label>
            <input type="text" name="name" value="<?= $name ?>" />
            <label>款号：</label>
            <input type="text" name="no" value="<?= $no ?>" />
            <label>主石大小：</label>
            <input type="text" name="stone_size" value="<?= $stone_size ?>" />
            <input type="submit" value="搜索" />
        </div>
    </form>
</div>
<div class="page-info">
    <div class="paging">
    </div>
    <div>共有<?= $total ?>款</div>
    <div class="view-switch">
        <span class="list-mode btn" title="列表模式"></span>
        <span class="image-mode btn" title="大图模式"></span>
    </div>
</div>
<ul class="product-list">
    <?php foreach ($products as $prd): ?>
        <li>
            <div class="left">
                <img />
                <img />
                <img />
            </div>
            <div class="mid">
                <div>
                    <strong class="name"><?= $prd->name ?></strong>
                    <span>货号：<?= $prd->sn ?></span>
                </div>
                <div>镶口：<?= $prd->rabbet_start ?>-<?= $prd->rabbet_end ?> ct</div>
                <div>手寸：</div>
                <div>刻字：</div>
                <div>辅石：<?= $prd->small_stone ?></div>
                <div>
                    <span>工费：<?= $setting::get('labor_expense') ?></span>
                    <span> 损耗：<?= $setting::get('wear_tear') ?></span>
                </div>
            </div>
            <div class="right">
            </div>
        </li>
    <?php endforeach ?>
</ul>
