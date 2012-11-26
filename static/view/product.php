<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?> 
<form>
    <div class="search">
        <div class="e">
            <label for="name">名称</label>
            <input name="name" id="name" value="<?= $name ?>" />
        </div>
        <div class="e">
            <label for="no">款号</label>
            <input name="no" id="no" value="<?= $no ?>" />
        </div>
        <div class="e">
            <label for="">分类</label>
            <?php
            $data = $types;
            include smart_view('widget.select');
            ?>
        </div>
        <div class="e">
            <label for="">排序</label>
            <select name="sort1" class="">
                <option selected="" value="">排序条件</option>
                <option value="count_sold">已售数量</option>
            </select>
            <select name="sort2" class="">
                <option selected="" value="desc">降序</option>
                <option value="asc">升序</option>
            </select>
        </div>
        <input type="submit" value="搜索" />
    </div>
</form>
<div>
    <?php include smart_view('paging'); ?>
    <span>共找到：<?= $total ?>条</span>
</div>
<table>
    <tr>
        <th><input type="checkbox" name="" class="group all" /></th>
        <th>名称</th>
        <th>款号</th>
        <th>分类</th>
        <th>镶口</th>
        <th>辅石</th>
        <th>估重（K金）</th>
        <th>估价</th>
        <th>说明</th>
        <th>已售</th>
        <th>操作</th>
    </tr>

    <?php foreach ($products as $prd): $materials = implode('&nbsp;', $prd->materials()) ?>
        <tr data-id="<?= $prd->id ?>">
            <td><input type="checkbox" class="group" /></td>
            <td><img src="<?= $prd->image1_thumb ?>" /><?= $prd->name ?></td>
            <td><?= $prd->no ?></td>
            <td><?= $types[$prd->type] ?></td>
            <td><?= $prd->rabbet_start . '-' . $prd->rabbet_end ?>ct</td>
            <td><?= $prd->small_stone ?></td>
            <td><?= $prd->weight ?></td>
            <td><?= $prd->estimatePrice() ?></td>
            <td><?= $prd->remark ?></td>
            <td><?= $prd->sold_count ?></td>
            <td>编辑</td>
        </tr>
    <?php endforeach ?>
</table>
<div>
    <?php include smart_view('paging'); ?>
    <input type="checkbox" class="group all" />
    <button class="">批量导出</button>
    <button class="del">批量删除</button>
</div>
