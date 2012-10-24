<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');

include_once Pf::model('Model');

/**
 *
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Admin extends Model 
{
    public static $table = 'admin';
    
    public function editOrder(Order order, $settings)
    {

    }

}
