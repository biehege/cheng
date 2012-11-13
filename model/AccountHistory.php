<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class AccountHistory extends Model
{
    public static $table = 'account_log';

    public function info()
    {
        return Pdb::fetchAll('*', self::$table, array('account=?' => $this->id));
    }

    public function order()
    {
        return new Order($this->order);
    }
}
