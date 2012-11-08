<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<a href="<?= ROOT ?>user/add">create admin</a>
<h2>admin list</h2>
<ul>
    <?php foreach ($admins as $admin): ?>
    <li>
        <strong><?= $admin->name ?></strong>
        <span>create in: <?= $admin->create_time ?></span>
    </li>
    <?php endforeach; ?>
</ul>
