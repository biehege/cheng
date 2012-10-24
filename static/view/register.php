<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<form action="?back=<?= _get('back') ?>" method="post">
    <?php if ($msg): ?>
    <div><?= $msg ?></div>
    <?php endif; ?>
    <div><input type="text" name="username" value="<?= $username ?>" placeholder="username" /></div>
    <div><input type="password" name="password" value="<?= $password ?>" placeholder="password" /></div>
    <div><input type="password" name="repassword" value="<?= $repassword ?>" placeholder="retype to confirm you password" /></div>
    <div><input type="submit" value="register" /></div>
</form>
