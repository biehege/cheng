<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
?>
<dl>
    <dt>我的订单</dt>
    <dd><a href="<?= ROOT ?>order/tobeconfirmed">待确认</a></dd>
    <dd><a href="<?= ROOT ?>order/infactory">已交工厂</a></dd>
    <dd><a href="<?= ROOT ?>order/done">工厂完工</a></dd>
    <dd><a href="<?= ROOT ?>order/cancel">已取消</a></dd>
    <dd><a href="<?= ROOT ?>order/all">全部订单</a></dd>
    <dt>货品管理</dt>
    <dd><a href="<?= ROOT ?>product/">货品列表</a></dd>
    <dd><a href="<?= ROOT ?>product/upload">单品上传</a></dd>
    <dd><a href="<?= ROOT ?>product/multi_upload">批量上传</a></dd>
</dl>
