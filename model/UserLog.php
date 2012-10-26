<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class UserLog
{
    public static $table = 'user_log';
    // public static $types = array('gold', 'pt');

    public static function history()
    {
        return array_map(function ($info) {
            $info['user'] = new User($info['user']);
            return $info;
        }, Pdb::fetchAll('*', self::$table));
    }

    public static function log($user_id)
    {
        Pdb::insert(
            array(
                'user' => $user_id,
                'action' => 'Login',
                'time=NOW()' => null
            ),
            self::$table);
    }
}