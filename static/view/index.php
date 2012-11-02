<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @file    index
 * @author  ryan <cumt.xiaochi@gmail.com>
 * @created Jul 17, 2012 9:51:11 AM
 */
?>
<div class="search">
    <form>
        <div class="type">
            <span>分类：</span>
            <ul class="types">
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
    <?php foreach ($products as $prd): $materials = $prd->materials(); ?>
        <li data-id="<?= $prd->id ?>">
            <div class="left">
                <img />
                <img />
                <img />
            </div>
            <div class="mid">
                <div><?php $stop = 1; ?>
                    <strong class="name"><?= $prd->name ?></strong>
                    <span>货号：<?= $prd->no ?></span>
                </div>
                <div>镶口：<?= $prd->rabbet_start ?>-<?= $prd->rabbet_end ?> ct</div>
                <div>
                    <span>材质：</span>
                    <ul class="type-selector">
                        <?php foreach ($materials as $id => $value): ?>
                            <li data-id="<?= $id ?>"><?= $value ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div>
                    <label for="size">手寸：</label>
                    <input type="text" name="size" id="size" />
                </div>
                <div>
                    <span>刻字：</span>
                    <div class="carve">
                        <span class="trigger">输入&gt;</span>
                        <span class="text"></span>
                        <div class="carve-box">
                            <div>刻字内容</div>
                            <input type="text" name="carve_text" />
                            <span class="s1">三</span>
                            <span class="s2">&amp;</span>
                            <button class="ok-btn">确定</button>
                        </div>
                    </div>
                    <span>由字母、数字、图形（两种）组成;至多5个字符。</span>
                </div>
                <div>
                    <span>辅石：</span>
                    <span><?= $prd->small_stone ?>粒</span>
                </div>
                <div>
                    <span>工费：</span>
                    <span><?= Setting::get('labor_expense') ?>元/件</span>
                    <span> 损耗：</span>
                    <span><?= Setting::get('wear_tear') ?>%</span>
                </div>
            </div>
            <div class="right">
                <div class="already">已下单 <span class="num"></span></div>
                <div class="add btn">下订单</div>
                <div class="estimate">英格预估价<?= $prd->estimatePrice() ?></div>
            </div>
            <br class="clear-fix" />
        </li>
    <?php endforeach ?>
</ul>
