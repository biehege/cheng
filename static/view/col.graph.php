<?php
!defined('IN_PTF') && exit('Access Denied');
/**
 * @file    chart2d
 * @author  ryan <cumt.xiaochi@gmail.com>
 * @created Jul 5, 2012 9:14:52 PM
 */
?>
<?php if ($data): ?>
    <?php 
    $max_view_height = 300; // px
    $max = max($data);
    $ratio = $max_view_height / $max;
    $sum = 0;
    foreach ($data as $v) {
        $sum += $v;
    }
    ?>
    <h4><?php echo $title; ?></h4>
    <span><?php echo $start.'到'.$end; ?></span>
    <ul class="curve" style="height: <?php echo $max_view_height+70; ?>px">
        <?php
        foreach ($data as $date=>$value) {
            $height = $value*$ratio;
            $height++;
            $pos = - $max_view_height + $height;
            $week_day = date('w', strtotime($date));
            $is_weekend = ($week_day==0 || $week_day==6);
            $friendly_date = substr($date, 5);
            ?>
        <li>
            <span class="date" style="bottom: <?php echo -$max_view_height-30; ?>px<?php echo $is_weekend?';color:red':''; ?>"><?php echo $friendly_date; ?></span>
            <span class="value" title="<?php echo $value; ?>" style="height: <?php echo $height; ?>px; bottom: <?php echo $pos; ?>px"><span><?php echo $value; ?></span></span>
        </li>
        <?php } ?>
    </ul>
<?php else: ?>
    <div>还没有数据</div>
<?php endif ?>

