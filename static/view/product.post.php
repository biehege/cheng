materail[<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<div class="left">
    <h3>产品图片上传</h3>
    <span>图片尺寸要求不小于：400px *400px</span>
    <form>
        <span>主图：</span>
        <input type="file" name="image1" />
        <span> 默认采用主图显示在产品列表中</span>
    </form>
    <form>
        <span>附图1：</span>
        <input type="file" name="image1" />
    </form>
    <form>
        <span>附图2：</span>
        <input type="file" name="image1" />
    </form>
    <img />
    <img />
    <img />
</div>
<div class="right">
    <form method="post">
        <div>
            <label for="name">标题：</label>
            <input name="name" type="text" value="<?= $name ?>" id="name" />
        </div>
        <div>
            <label for="no">款号：</label>
            <input name="no" type="text" value="<?= $no ?>" id="no" />
        </div>
        <div>
            <label for="type">分类：</label>
            <input name="type" type="text" value="<?= $type ?>" id="type" />
        </div>
        <div>
            <label for="material">材质：</label>
            <div>
                <input name="material[0]" type="checkbox" value="PT950" id="material0" /><label for="material0">PT950</label>
                <input name="material[1]" type="checkbox" value="黄18K金" id="material1" /><label for="material1">黄18K金</label>
                <input name="material[2]" type="checkbox" value="白18K金" id="material2" /><label for="material2">白18K金</label>
                <input name="material[3]" type="checkbox" value="红18K金" id="material3" /><label for="material3">红18K金</label>
            </div>
        </div>
        <div>
            <label for="weight">重量：</label>
            <input name="weight" type="text" value="<?= $weight ?>" id="weight" />
        </div>
        <div>
            <label for="">镶口：</label>
            <input name="rabbet_start" type="text" value="<?= $rabbet_start ?>" id="rabbet_start" />
            <input name="rabbet_end" type="text" value="<?= $rabbet_end ?>" id="rabbet_end" />
        </div>
        <div>
            <label for="small_stone">辅石：</label>
            <input name="small_stone" type="text" value="<?= $small_stone ?>" id="small_stone" />
        </div>
        <div>
            <label for="remark">说明：</label>
            <input name="remark" type="text" value="<?= $remark ?>" id="remark" />
        </div>
        <input type="submit" value="发布产品" />
    </form>
</div>
