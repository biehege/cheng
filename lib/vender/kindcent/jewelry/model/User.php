<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

namespace kindcent\jewelry\model;

use kindcent\Pdb;

class User extends Model
{
    public static $table = 'user';

    public function find($username)
    {
        return Pdb::exists(self::$table, array('name=?' => $username));
    }

    public function check($username, $password)
    {
        return Pdo::exists(self::$table, array(
            'name=?' => $username,
            'password=?', $password));
    }

    public function login()
    {
        $_SESSION['se_user_id'] = $this->id;
    }

    public function instance()
    {
        switch ($this->type) {
            case 'super_admin':
                return new SuperAdmin($this);
                break;
            case 'admin':
                return new Admin($this);
                break;
            case 'customer':
                return new Customer($this);
                break;
            default:
                throw new Exception('not here');
                break;
        }
    }

    public static function loggingUser()
    {
        if (isset($_SESSION['se_user_id']) && $_SESSION['se_user_id']) {
            return new self($_SESSION['se_user_id']);
        } else {
            return false;
        }
    }

    // only customers can be reistered
    public static function register($username, $password)
    {
        $type = 'customer';
        Pdb::insert(
            array(
                'name' => $username,
                'password' => md5($password),
                'type' => $type,
                'create_time=NOW()' => null,
            ),
            self::$table
        );
        return new self(Pdb::lastInsertId());
    }
}
