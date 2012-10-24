<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<form action="<?= ROOT ?>login?back_url=<?= _get('back') ?>" method="post">
    <div>请输入您的用户名和密码</div>
    <div id="error info"><?= $msg ?></div>
    <div><input type="text" name="username" value="<?= $username ?>" placeholder="请输入您的用户名"/></div>
    <div><input type="password" name="password" placeholder="请输入您的密码" /></div>
    <div><input type="submit" value="登录" class="ok btn" /><div>
</form>
