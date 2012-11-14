<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<form>
    <label>下单时间：</label>
    <input type="text" name="time_start" value="<?= $time_start ?>">
    <input type="text" name="time_end" value="<?= $time_end ?>">
    <label>类型：</label>
    <?php $field_name = 'type'; include smart_view('widget.select') ?>
    <?php $field_name = 'sort'; $data = $sorts; $no_default = 1; include smart_view('widget.select') ?>
    <input type="submit" value="搜索">
</form>
<div>
    <span>账户：</span>
    <span><?= $user_->name ?></span>
    <span>用户名：</span>
    <span><?= $user_->realname ?></span>
    <span>账户余额：</span>
    <span><?= $account->remain ?></span>
</div>
<?php include smart_view('paging'); ?>
<table>
    <tr>
        <td>创建时间</td>
        <td>名称|备注</td>
        <td>相关订单</td>
        <td>金额</td>
        <td>类型</td>
        <td>账户余额</td>
        <td>支付方式</td>
    </tr>
    <?php foreach ($history as $entry): ?>
        <tr>
            <td><?= $entry->time ?></td>
            <td><?= $entry->name ?></td>
            <td><?= $entry->order()->order_no ?></td>
            <td><?= $entry->money ?></td>
            <td><?= $entry->type ?></td>
            <td><?= $entry->remain ?></td>
            <td><?= $entry->pay_type ?></td>
        </tr>
    <?php endforeach ?>
</table>
