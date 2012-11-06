<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Account extends Model 
{
    public static $table = 'account';

    public function info()
    {
        return Pdb::fetchRow('*', self::$table, $this->selfCond());
    }

    public static function create()
    {
        Pdb::insert(
            array(
                'remain' => 0,
                'done' => 0,
                'undone' => 0,),
            Account::$table);
        return new self(Pdb::lastInsertId());
    }

    public function deduct($money)
    {
        Pdb::update(
            array(
                "remain = remain-'$money'" => null), // !!! injection
            self::$table);
    }
}
