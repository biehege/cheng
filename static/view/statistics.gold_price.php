<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<form>
    <div class="search">
        <div>
            <label>查询时间：</label>
            <input name="time_start" type="text" value="<?= $time_start ?>" /> - <input name="time_end" type="text" value="<?= $time_end ?>" />
        </div>
        <div>
            <label>类型：</label>
            <?php
            $field_name = 'type';
            $default_value = '';
            $data = $material_types;
            include smart_view('widget.select');
            ?>
        </div>
        <input value="搜索" type="submit" />
    
    </div>
</form>
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