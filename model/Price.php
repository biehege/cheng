<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Price
{
    public static $table = 'product';
    // public static $types = array('gold', 'pt');

    public static function current($type) 
    {
        return Pdb::fetchRow(
            'price', 
            self::$table, 
            array('type=?' => $type), 
            'ORDER BY id desc');
    }

    public static function history($type)
    {
        return Pdb::fetchAll(
            '*',
            self::$table,
            array('type=?' => $type),
            'ORDER BY id desc');
    }

    public static update($type, $price)
    {
        Pdb::insert(
            array(
                'type' => $type,
                'price' => $price,
                'time=NOW()' => null),
            self::$table);
    }
}
