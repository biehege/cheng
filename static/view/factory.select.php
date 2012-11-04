<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
?>
<h2>选择工厂</h2>
<form>
    <div>
        <?php
        $field_name = 'factory_name';
        $data = $factories;
        include smart_view('widget.select');
        ?>
    </div>
    <input type="submit" value="确定" />
</form>
