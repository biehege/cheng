<?php

/**
 * 金价
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

    public static function get($type, $time)
    {
        return Pdb::fetchRow(
            'price',
            self::$table,
            array(
                'type=?' => $type,
                'time >= ?'=> $time),
            'ORDER BY time ASC');
    }

    public static function history($conds = array())
    {
        extract(self::defaultConds($conds));
        $cond = self::typeCond($type);
        $tail = "LIMIT $limit OFFSET $offset";
        return Pdb::fetchAll(
            '*',
            self::$table,
            $cond,
            'id desc',
            $tail);
    }

    public static function total($type)
    {
        return Pdb::count(self::$table, self::typeCond($type));
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

    private static function typeCond($type)
    {
        if (empty($type) || $type === 'all') {
            $cond = null;
        } else {
            $cond = array('type=?' => $type);
        }
        return $cond;
    }
}
