<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Product extends Model 
{
    public static $table = 'product';

    public static listProduct($conds = array()) 
    {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        return array_map(function ($id) {
            return new Product($id);
        }, Pdb::fetchAll('id', self::$table, null, null, $tail));
    }
}
