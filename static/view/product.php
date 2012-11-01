<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?> 
<form>
    <div class="search">
        <div>
            <label for="name">名称</label>
            <input name="name" id="name" value="<?= $name ?>" />
        </div>
        <div>
            <label for="no">款号</label>
            <input name="no" id="no" value="<?= $no ?>" />
        </div>
        <div>
            <label for="">分类</label>
            <?php
            $data = $types;
            include smart_view('widget.select');
            ?>
        </div>
        <div>
            <label for="">排序</label>
            <select name="sort1" class="">
                <option selected="" value="">排序条件</option>
                <option value="count_sold">已售数量</option>
                <option value="count_view">浏览人次</option>
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
    <span>共找到：<?= $total ?>条</span>
    <div class="paging"></div>
</div>
<table>
    <tr>
        <th><input type="checkbox" name="" /></th>
        <th>名称</th>
        <th>款号</th>
        <th>分类</th>
        <th>材质</th>
        <th>镶口</th>
        <th>辅石</th>
        <th>刻字</th>
        <th>说明</th>
        <th>已售</th>
        <th>浏览</th>
        <th>操作</th>
    </tr>

    <?php foreach ($products as $prd): ?>
        <tr>
            <td><input type="checkbox" /></td>
            <td><img src="<?= $prd->image ?>" /><?= $prd->name ?></td>
            <td><?= $prd->no ?></td>
            <td><?= $prd->type ?></td>
            <td><?= $prd->material ?></td>
            <td><?= $prd->rabbet_start . '-' . $prd->rabbet_end ?>ct</td>
            <td><?= $prd->small_stone ?></td>
            <td><?= $prd->carve_allow ?></td>
            <td><?= $prd->remark ?></td>
            <td><?= $prd->countSold() ?></td>
            <td><?= $prd->countView() ?></td>
            <td>编辑</td>
        </tr>
    <?php endforeach ?>
</table>
<div>
    <input type="checkbox" />
    <button>批量导出</button>
    <button>批量下架</button>
    <button>批量删除</button>
    <div class="paging"></div>
</div>
