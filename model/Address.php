<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Address extends Model 
{
    public static $table = 'address';

    public function info()
    {
        return Pdb::fetchRow('*', self::$table, $this->selfCond());
    }

    public function edit($key_or_array, $value = null)
    {
        if($value !== null) { // give by key => value
            $arr = array($key_or_array, $value);
        } else {
            $arr = $key_or_array;
        }
        Pdb::update($arr, self::$table, $this->selfCond());
    }

    public function setDefault()
    {
        Pdb::update(
            array('is_default' => 1),
            'customer_address',
            array('address=?' => $this->id));
    }
}
