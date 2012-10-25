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
        <span>create in: <?= $cus->adopted ?></span>
    </li>
    <?php endforeach; ?>
</ul>
