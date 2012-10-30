<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
// my.crumb 面包屑导航
// $controller
// $target
if (!isset($nav_id))
    $nav_id = 'default';
$this_nav = $navs[$nav_id][$controller];
foreach ($this_nav['sub'] as $sub_nav) {
    if ($sub_nav['link'] == $target) {
        $sub_title = $sub_nav['name'];
        break;
    }
}
?>
<div class="crumb">
    <span><?= $this_nav['title'] ?></span>
    <span>&gt;</span>
    <span><?= $sub_title ?></span>    
</div>
