<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<div>请完善您的个人信息</div>
<form method="post" class="info">
    <div>
        <label for="">账户：</label>
        <span><?= $user->name ?></span>
    </div>
    <div>
        <label for="realname">姓名：</label>
        <input name="realname" type="text" value="<?= $user->realname ?>" class="">
    </div>
    <div>
        <label for="phone">电话：</label>
        <input name="phone" type="text" value="<?= $user->phone ?>" class="">
    </div>
    <div>
        <label for="gender">性别：</label>
        <?php foreach ($genders as $key => $value): ?>
            <input name="gender" id="gender-<?= $key ?>" type="radio" value="<?= $key ?>" <?= $customer->gender == $key ? 'checked' : '' ?>  class="">
            <label for="gender-<?= $key ?>"><?= $value ?></label> 
        <?php endforeach ?>
    </div>
    <div>
        <label for="qq">QQ：</label>
        <input name="qq" type="text" value="<?= $customer->qq ?>" class="qq">
    </div>
    <div>
        <label for="email">邮箱：</label>
        <input name="email" type="text" value="<?= $user->email ?>" class="email">
    </div>
    <div>
        <label for="address">地址：</label>
        <input name="address" type="text" value="<?= $customer->defaultAddress()->detail ?>" class="">
    </div>
    <input type="submit" value="确定">
</form>
