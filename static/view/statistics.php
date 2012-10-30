<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?> 
<div class="search">
    <form>
        <div>
            <label>查询时间：</label>
            <input name="time_start" type="text" value="<?= $time_start ?>" /> - <input name="time_end" type="text" value="<?= $time_end ?>" />
        </div>
        <div>
            <label>类型：</label>
            <select name="type">
                <option value="all" <?= $type == 'all' ? 'selected' : '' ?> >全部</option>
                <?php foreach ($material_types as $key => $value): ?>
                    <option value="<?= $key ?>" <?= $type == $key ? 'selected' : '' ?> ><?= $value ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <input value="搜索" type="submit" />
    </form>
</div>
<div>
    <span>发布金价</span>
    <div class="paging"></div>
</div>
<div>
    <span>时间</span>
    <span>价格（元/克）</span>
</div>
<?php foreach ($prices as $price): ?>
    <div>
        <span><?= $price['time'] ?></span>
        <span><?= $price['type'] . '：' . $price['price'] ?></span>
    </div>
<?php endforeach ?>
