<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<div>请填写详细的用户信息</div>
<form>
    <div>
        <label>帐号：</label>
        <input name="username" type="name" value="<?= $username ?>" />
    </div>
    <div>
        <label>密码：</label>
        <input name="password" type="name" value="<?= $password ?>" />
    </div>
    <div>
        <label>姓名：</label>
        <input name="realname" type="name" value="<?= $realname ?>" />
    </div>
    <div>
        <label>联系电话：</label>
        <input name="phone" type="name" value="<?= $phone ?>" />
    </div>
    <div>
        <label>QQ：</label>
        <input name="qq" type="name" value="<?= $qq ?>" />
    </div>
    <div>
        <label>邮箱：</label>
        <input name="email" type="name" value="<?= $email ?>" />
    </div>
    <div>
        <label>收件地址：</label>
        <input name="address" type="name" value="<?= $address ?>" />
    </div>
    <div>
        <label>备注：</label>
        <input name="remark" type="name" value="<?= $remark ?>" />
        <span>客户不可见</span>
    </div>
</form>
<div>user.add</div>
