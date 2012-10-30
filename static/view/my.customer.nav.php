<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
?>
<dl>
    <dt>我的订单</dt>
    <dd><a href="<?= ROOT ?>order/tobeconfirmed">待确认</a></dd>
    <dd><a href="<?= ROOT ?>order/infactory">已交工厂</a></dd>
    <dd><a href="<?= ROOT ?>order/done">工厂完工</a></dd>
    <dd><a href="<?= ROOT ?>order/all">全部订单</a></dd>
    <dt>我的资料</dt>
    <dd><a href="<?= ROOT ?>my/info">个人资料</a></dd>
    <dd><a href="<?= ROOT ?>my/password">修改密码</a></dd>
</dl>
<dl>
    <?php foreach ($nav['default'] as $top_key => $sub): ?>
        <dt><?= $sub['title'] ?></dt>
        <?php foreach ($sub as $key => $value): ?>
            <dd><a href="<?= ROOT . $top_key . '/' . $link ?>"><?= $value['name'] ?></a></dd>
        <?php endforeach ?>
    <?php endforeach ?>    
</dl>
