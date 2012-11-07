<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<div class="search">
    <div class="e">
        <label for="name">客户名：</label>
        <input name="name" id="name" value="<?= $name ?>" />
    </div>
    <div class="e">
        <label for="username">帐号：</label>
        <input name="username" id="username" value="<?= $username ?>" />
    </div>
    <div class="e">
        <label for="">登录次数：</label>
        <?= $user->loginTimes() ?>
    </div>
    <div class="e">
        <label for="time_start">下单时间：</label>
        <input name="time_start" id="time_start" value="<?= $time_start ?>" />
        <input name="time_end" id="time_end" value="<?= $time_end ?>" />
    </div>
    <div class="e">
        <label for="">状态：</label>
        <?php
        $field_name = 'state';
        $data = $customer_states;
        include smart_view('widget.select');
        ?>
    </div>
    <input type="submit" value="搜索" />
</div>
<div>
    <?php include smart_view('paging'); ?>
    <span>共找到<?= $total ?>条</span>
</div>
<div>
    <span class="col title">帐号</span>
    <span class="col title">客户名</span>
    <span class="col title">性别</span>
    <span class="col title">电话</span>
    <span class="col title">QQ</span>
    <span class="col title">区域</span>
    <span class="col title">登录</span>
    <span class="col title">成交</span>
    <span class="col title">未结清</span>
    <span class="col title">状态</span>
    <span class="col title">修改</span>
</div>
<?php foreach ($customers as $cus): $user_ = $cus->user(); $account = $cus->account() ?>
    <div class="entry" data-id="<?= $cus->id ?>">
        <div class="col "><?= $user_->name ?></div>
        <div class="col "><?= $user_->realname ?></div>
        <div class="col "><?= $cus->gender ?></div>
        <div class="col "><?= $user_->phone ?></div>
        <div class="col "><?= $cus->qq ?></div>
        <div class="col "><?= $cus->city ?></div>
        <div class="col "><?= $user_->loginTimes() ?></div>
        <div class="col "><?= $cus->dealTimes() ?></div>
        <div class="col "><?= $cus->undoneTimes() ?></div>
        <div class="col "><?= $customer_states[$cus->state] ?></div>
        <div class="col "><span class="edit-btn">修改</span></div>
    </div>
    <div>
        <table class="login-info">
            <tr>
                <td>注册信息</td>
                <td><?= $user_->create_time ?></td>
            </tr>
            <tr>
                <td>登录历史</td>
                <td>
                    <?php foreach ($user_->loginHistory() as $entry): ?>
                        <div><?= $entry['time'] ?> <?= $entry['ip'] ?></div>
                    <?php endforeach ?>
                </td>
            </tr>
        </table>
        <table class="detail-info">
            <tr>
                <td>用户姓名</td><td><?= $user->realname ?></td>
            </tr>
            <tr>
                <td>账户余额</td><td><?= $account->remain ?></td>
            </tr>
            <tr>
                <td>成交金额</td><td><?= $account->done ?></td>
            </tr>
            <tr>
                <td>未结清金额</td><td><?= $account->undone ?></td>
            </tr>
            <tr>
                <td>成交次数</td><td><?= $cus->dealTimes() ?></td>
            </tr>
            <tr>
                <td>下单次数</td><td><?= $cus->orderTimes() ?></td>
            </tr>
            <tr>
                <td>邮箱</td><td><?= $user->email ?></td>
            </tr>
            <tr>
                <td>地址</td><td><?= $cus->defaultAddress()->detail ?></td>
            </tr>
            <tr>
                <td>用户备注</td><td><?= $cus->remark ?></td>
            </tr>
        </table>
        <br class="clear-fix">
    </div>
<?php endforeach; ?>
</table>
