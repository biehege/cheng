<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1>
    <a href="<?= ROOT ?>" title="<?= $config['site']['name'] ?>"><?= $config['site']['name'] ?></a>
</h1>
<span>with layout, but without style, without 文案</span>
<?php if ($has_login): ?>
<a href="<?= ROOT ?>my"><?= $user->name ?></a>
<a href="<?= ROOT ?>login?logout=1">logout</a>
<?php else: ?>
<a href="<?= ROOT ?>login?back=<?= $request_uri ?>">login</a>
<a href="<?= ROOT ?>register?back=<?= $request_uri ?>">register</a>
<?php endif; ?>
