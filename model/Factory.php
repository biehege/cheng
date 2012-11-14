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

    public function account()
    {
        $account_id = $this->account;
        if (empty($account_id)) {
            $account = Account::create();
            $this->edit('account', $account->id);
            return $account;
        }
        return new Account($this->account);
    }

    public function stAccount()
    {
        $account_id = $this->account;
        if (empty($account_id)) {
            $account = Account::create();
            $this->edit('st_account', $account->id);
            return $account;
        }

        return new Account($this->st_account);
    }
}
