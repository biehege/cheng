<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<div>请妥善保存您的密码，以防被盗！</div>
<form method="post">
    <?php if ($msg): ?>
        <div><?= $msg ?></div>
    <?php endif ?>
    <div>
        <label>原密码</label>
        <input name="password" type="password" class="required">
        <span>*必须知道原密码才可以修改！</span>
    </div>
    <div>
        <label>新密码</label>
        <input name="new_password" type="text" class="required">
        <span>*</span>
    </div>
    <div>
        <label>确认密码</label>
        <input name="re_password" type="password" class="required">
        <span>*</span>
    </div>
    <input type="submit" value="确定">
</form>
