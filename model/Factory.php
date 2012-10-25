<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');

require_once Pf::model('Model');

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Customer extends ListableModel 
{
    public static $table = 'customer';
}
