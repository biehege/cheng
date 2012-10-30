<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<h2>customer list</h2>
<table>
    <tr>
        <th>帐号</th>
        <th>客户名</th>
        <th>性别</th>
        <th>电话</th>
        <th>QQ</th>
        <th>区域</th>
        <th>登录</th>
        <th>成交</th>
        <th>未结清</th>
        <th>活跃</th>
        <th>活跃地区</th>
        <th>状态</th>
        <th>修改</th>
    </tr>
    <?php foreach ($customers as $cus): ?>
    <tr>
        <td><?= $cus->user->name ?></td>
        <td><?= $cus->gender ?></td>
        <td><?= $cus->user->phone ?></td>
        <td><?= $cus->qq ?></td>
        <td><?= $cus->city ?></td>
        <td><?= $cus->login ?></td>
        <td><?= $cus->deal ?></td>
        <td><?= $cus->undone ?></td>
        <td><?= $cus->adopted? '审核通过' : '未审核' ?></td>
        <td>修改<?php if (!$cus->adopted): ?><a href='<?= ROOT . 'customer/' . $cus->id ?>?a=accept'>审核通过此人</a><?php endif; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
