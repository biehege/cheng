<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<form method="post" class="add">
    <?php if ($msg): ?><div><?= $msg ?></div><?php endif; ?>
    <div>
        <input name="username" type="text" value="<?= $username ?>" placeholder="username" class="required" />
    </div>
    <div>
        <input name="password" type="text" value="<?= $password ?>" placeholder="password" class="required" />
    </div>
    <div><input type="submit" value="创建管理员" /></div>
</form>
