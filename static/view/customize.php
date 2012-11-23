<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<div>
    <h2 class="title">我要定制</h2>
    <span>请详细填写您的定制需求单</span>
</div>
<form method="post" enctype="multipart/form-data">
    <div>
        <div>
            <label for="material">材质：</label>
            <input name="material" id="material" value="<?= $material ?>">
            <label for="stone">主石：</label>
            <input name="stone" id="stone" value="<?= $stone ?>">
        </div>
        <div>
            <label for="size">手寸：</label>
            <input name="size" id="size" value="<?= $size ?>">
            <label for="carve_text">刻字：</label>
            <input name="carve_text" id="carve_text" value="<?= $carve_text ?>">
        </div>
        <div>
            <label>图片：</label>
            <input type="file" name="image">
        </div>
        <div>
            <?php foreach ($images as $i): ?>
                <li><img src="<?= $i ?>"></li>
            <?php endforeach ?>
        </div>
        <div>
            <label for="remark">备注：</label>
            <input name="remark" id="remark" value="<?= $remark ?>">
        </div>
        <input type="submit" value="确定">
    </div>
</form>
