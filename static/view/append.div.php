<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
if (!isset($div_name))
    $div_name = '';

?>
<div class="<?= $div_name ?> append-div">
    <span class="close-btn">X</span>
    <?php include smart_view($view_name); ?>
</div>
