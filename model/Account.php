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
        if (!is_numeric($money)) {
            throw new Exception("money must be numeric: $money");
        }
        Pdb::update(
            array("remain = remain-'$money'" => null), // !!! injection
            self::$table);
    }

    public function countHistory($conds = array())
    {
        extract(self::buildHistoryArg($conds));
        return Pdb::count(AccountHistory::$table, $conds);
    }

    public function history($conds = array())
    {
        extract($conds);
        $tail = "LIMIT $limit OFFSET $offset";
        extract(self::buildHistoryArg($conds));
        $ids = Pdb::fetchAll('id', AccountHistory::$table, $conds);
        return safe_array_map(function ($id) {
            return new AccountHistory($id);
        }, $ids);
    }

    private static function buildHistoryArg($conds)
    {
        extract($conds);
        $conds = array();
        if (isset($time_start)) {
            $conds['time >= ?'] = $time_start;
        }
        if (isset($time_end))
            $conds['time <= ?'] = $time_end;
        if (isset($type))
            $conds['type=?'] = $type;
        return compact('conds');
    }

}
