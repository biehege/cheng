<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<?php
$nav_id = 'admin';
include smart_view('nav');
?>
<div class="right-frame">
    <?php include smart_view('crumb'); ?>
    <h2>价格计算的基础设置</h2>
    <form>
        <ul>
            <li>
                <label for="labor_expense"><?= $name_map['labor_expense'] ?>：</label>
                <input name="labor_expense" value="<?= $settings['labor_expense'] ?>" id="labor_expense" />
                <span>元</span>
            </li>
            <li>
                <label for="wear_tear"><?= $name_map['wear_tear'] ?>：</label>
                <input name="wear_tear" value="<?= $settings['wear_tear'] ?>" id="wear_tear" />
                <span>%</span>
            </li>
            <li>
                <label for="st_expense"><?= $name_map['st_expense'] ?>：</label>
                <input name="st_expense" value="<?= $settings['st_expense'] ?>" id="st_expense" />
                <span>元</span>
            </li>
            <li>
                <label for="st_price"><?= $name_map['st_price'] ?>：</label>
                <input name="st_price" value="<?= $settings['st_price'] ?>" id="st_price" />
                <span>元/克拉</span>
            </li>
            <li>
                <label for="weight_ratio"><?= $name_map['weight_ratio'] ?>：</label>
                <input name="weight_ratio" value="<?= $settings['weight_ratio'] ?>" id="weight_ratio" />
                <span>铂金/K金</span>
            </li>
        </ul>
    </form>
</div>
