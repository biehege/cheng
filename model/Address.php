<?php

/**
 *
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Address extends Model 
{
    public static $table = 'address';

    public function edit($key_or_array, $value = null)
    {
        if($key !== null) { // give by key => value
            $arr = array($key_or_array, $value);
        } else {
            $arr = $key_or_array;
        }
        Pdb::update($arr, self::$table, $this->selfCond());
    }
}
