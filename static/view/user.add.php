<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<div>请填写详细的用户信息</div>
<form method="post" class="add">
    <div>
        <label>帐号：</label>
        <input name="username" type="name" value="<?= $username ?>" class="required" />
    </div>
    <div>
        <label>密码：</label>
        <input name="password" type="name" value="<?= $password ?>" class="required" />
    </div>
    <div>
        <label>姓名：</label>
        <input name="realname" type="name" value="<?= $realname ?>" class="required" />
    </div>
    <div>
        <label>联系电话：</label>
        <input name="phone" type="name" value="<?= $phone ?>" class="phone" />
    </div>
    <div>
        <label>QQ：</label>
        <input name="qq" type="name" value="<?= $qq ?>" class="qq" />
    </div>
    <div>
        <label>邮箱：</label>
        <input name="email" type="name" value="<?= $email ?>" class="email" />
    </div>
    <div>
        <label>收件地址：</label>
        <input name="address" type="name" value="<?= $address ?>" class="" />
    </div>
    <div>
        <label>备注：</label>
        <input name="remark" type="name" value="<?= $remark ?>" class="" />
        <span>客户不可见</span>
    </div>
    <input type="submit" value="确定" />
</form>
