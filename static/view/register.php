<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<form action="<?= ROOT ?>register?back=<?= _get('back') ?>" method="post" class="logreg">
    <?php if ($msg): ?>
    <div><?= $msg ?></div>
    <?php endif; ?>
    <div>
        <label for="username">帐号：</label>
        <input type="text" name="username" value="<?= $username ?>" id="username" placeholder="username" class="required" />
    </div>
    <div>
        <label for="password">密码：</label>
        <input type="password" name="password" value="<?= $password ?>" id="password" placeholder="password" class="required" />
    </div>
    <div>
        <label for="repassword">确认密码：</label>
        <input type="password" name="repassword" value="<?= $repassword ?>" id="repassword" placeholder="retype to confirm you password" class="required" />
    </div>
    <div>
        <label for="realname">姓名：</label>
        <input type="text" name="realname" value="<?= $realname ?>" id="realname" placeholder="your real name" class="required" />
    </div>
    <div>
        <label for="phone">手机号：</label>
        <input type="text" name="phone" value="<?= $phone ?>" id="phone" placeholder="your phone number" class="required phone" />
    </div>
    <div>
        <label for="email">电子邮箱：</label>
        <input type="text" name="email" value="<?= $email ?>" id="email" placeholder="your email" class="required email" />
    </div>
    <div><input type="submit" value="注册" class="ok btn" /></div>
</form>
