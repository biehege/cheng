<?php

/**
 *
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

namespace kindcent\jewelry\model;

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
