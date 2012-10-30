<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<h2>customer list</h2>
<ul>
    <?php foreach ($customers as $cus): ?>
    <li>
        <strong><?= $cus->user->name ?></strong>
        <span><?= $cus->adopted? '审核通过' : '未审核' ?></span>
        <?php if (!$cus->adopted): ?><a href='<?= ROOT . 'customer/' . $cus->id ?>?a=accept'>审核通过此人</a><?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
