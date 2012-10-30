<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

switch ($user_type) {
    case 'Customer':
        d('cus');
        $view .= '.customer';
        break;
    
    default:
        # code...
        break;
}



$view .= '?master';
