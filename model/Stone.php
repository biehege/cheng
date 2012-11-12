<?php

/**
 * I am the small order
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Stone extends Model 
{
    public static $table = 'stone'; // when came across a key word

    public function info()
    {
        $ret = Pdb::fetchRow('*', self::$table, $this->selfCond());
        return $ret;
    }
}
