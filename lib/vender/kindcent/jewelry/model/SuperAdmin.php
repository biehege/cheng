<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');

include_once Pf::model('Model');

/**
 *
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class SuperAdmin extends Model 
{
    public static $table = 'super_admin';
    
    public function createAdmin() 
    {
        return new Admin();
    }
}

?>
