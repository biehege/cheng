<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');

// 左边栏导航

if (!isset($nav_id))
    $nav_id = 'default';
?>
<dl class="main-nav">
    <?php foreach ($navs[$nav_id] as $top_key => $sub): ?>
        <dt><a href="<?= ROOT . $top_key . '/' . $sub['default'] ?>"><?= $sub['title'] ?></a></dt>
        <?php foreach ($sub['sub'] as $entry): ?>
            <dd><a href="<?= ROOT . $top_key . '/' . $entry['link'] ?>"><?= $entry['name'] ?></a></dd>
        <?php endforeach ?>
    <?php endforeach ?>
</dl>
