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
}
