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
<a href="<?= ROOT ?>login?back=<?= $request_uri ?>">login</a>
<a href="<?= ROOT ?>register?back=<?= $request_uri ?>">register</a>
