<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
?>

<h1>
    <a href="<?= ROOT ?>" title="<?= $config['site']['name'] ?>"><?= $config['site']['name'] ?></a>
</h1>

<div class="price">
    <span>今日金价</span>
    <span>PT950: <?= Price::current('PT950') ?></span>
    <span>AU750: <?= Price::current('AU750') ?></span>
</div>

<div class="account">
    <?php if ($has_login): ?>
        <?php if ($user_type === 'Customer'): ?>
            <a href="<?= ROOT ?>cart">购物车 (<span><?= $cart->count() ?></span>)</a>
        <?php endif; ?>
        <a href="<?= ROOT ?>my"><?= $user->name ?></a>
        <a href="<?= ROOT ?>order/all">我的订单</a>
        <a href="<?= ROOT ?>login?logout=1">logout</a>
    <?php else: ?>
        <a href="<?= ROOT ?>login?back=<?= $request_uri ?>">登陆</a>
        <a href="<?= ROOT ?>register?back=<?= $request_uri ?>">注册</a>
    <?php endif; ?>
</div>
<span class="info">with only html structure, but without layout, without style, without 文案</span>
