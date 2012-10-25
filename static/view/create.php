<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<form method="post">
    <?php if ($msg): ?><div><?= $msg ?></div><?php endif; ?>
    <div><input name="username" type="text" value="<?= $username ?>" placeholder="username" /></div>
    <div><input name="password" type="text" value="<?= $password ?>" placeholder="password" /></div>
    <div><input type="submit" value="create admin" /></div>
</form>
