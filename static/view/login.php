<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<form action="<?= ROOT ?>login?back_url=<?= _get('back') ?>" method="post" class="logreg">
    <?php if ($msg): ?><div id="error info"><?= $msg ?></div><?php endif; ?>
    <div>
        <label for="username">用户名</label>
        <input type="text" name="username" value="<?= $username ?>" id="username" placeholder="请输入您的用户名"/>
    </div>
    <div>
        <label for="password">密码</label>
        <input type="password" name="password" id="password" placeholder="请输入您的密码" />
    </div>
    <div><input type="submit" value="登录" class="ok btn" /></div>
</form>
