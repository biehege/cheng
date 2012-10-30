<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Price
{
    public static $table = 'price';

    public static function current($type) 
    {
        return Pdb::fetchRow(
            'price', 
            self::$table, 
            array('type=?' => $type), 
            'ORDER BY id desc');
    }

    public static function history($conds = array())
    {
        extract(self::defaultConds($conds));
        if (empty($type)) {
            $cond = null;
        } else {
            $cond = array('type=?' => $type);
        }
        $tail = "LIMIT $limit OFFSET $offset";
        return Pdb::fetchAll(
            '*',
            self::$table,
            $cond,
            'id desc',
            $tail);
    }

    public static function total()
    {
        return Pdb::count(self::$table);
    }

    public static function update($type, $price)
    {
        Pdb::insert(
            array(
                'type' => $type,
                'price' => $price,
                'time=NOW()' => null),
            self::$table);
    }

    private static function defaultConds($conds)
    {
        return array_merge(array(
            'limit' => 50,
            'offset' => 0,
            'type' => ''
        ), $conds);
    }
}
