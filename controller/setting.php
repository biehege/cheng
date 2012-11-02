<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

if ($user_type !== 'Admin')
    die('no permission');

$settings = Setting::get();
$name_map = $config['setting_name_map'];

$matter = $view . ($target? ".$target" : '');
$view = 'board?master';
