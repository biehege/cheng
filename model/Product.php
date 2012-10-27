<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Product extends Model 
{
    public static $table = 'product';

    public static function count()
    {
        return Pdb::count(self::$table);
    }

    public static function listProduct($conds = array()) 
    {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        return array_map(function ($id) {
            return new Product($id);
        }, Pdb::fetchAll('id', self::$table, null, null, $tail));
    }

    public static function types()
    {
        return Pdb::fetchAll('name', 'product_type');
    }
}
