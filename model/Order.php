<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');

include_once Pf::model('Model');

/**
 *
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Order extends Model 
{
    public static $table = 'order_'; // when came across a key word
}
