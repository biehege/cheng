<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');

require_once Pf::model('Model');

/**
 *
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class ListabeModel extends Model 
{
    private static function defaultConds($conds) 
    {
        return array_merge(array(
            'limit' => 10,
            'offset' => 0,
        ), $conds);
    }
}
