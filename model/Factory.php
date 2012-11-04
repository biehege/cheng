<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Factory extends Model 
{
    public static $table = 'factory';

    public function info()
    {
        return Pdb::fetchRow('*', self::$table, $this->selfCond());
    }

    public static function names()
    {
        $arr = Pdb::fetchAll('id, name', self::$table);
        $ret = array();
        foreach ($arr as $entry) {
            $ret[$entry['id']] = $entry['name'];
        }
        return $ret;
    }
}
