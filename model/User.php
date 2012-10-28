<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class User extends Model
{
    public static $table = 'user';

    protected function info()
    {
        return Pdb::fetchRow('*', self::$table, $this->selfCond());
    }

    public function find($username)
    {
        return Pdb::exists(self::$table, array('name=?' => $username));
    }

    public function check($username, $password)
    {
        return Pdb::exists(self::$table, array(
            'name=?' => $username,
            'password=?' => md5($password)));
    }

    public function getByName($username)
    {
        $cond = array('name=?' => $username);
        return new self(Pdb::fetchRow('*', self::$table, $cond));
    }

    public function login()
    {
        $_SESSION['se_user_id'] = $this->id;

        // log it
        UserLog::log($this->id);
    }

    public function logout()
    {
        $_SESSION['se_user_id'] = 0;
    }

    public function instance()
    {
        switch ($this->type) {
            case 'SuperAdmin':
                return new SuperAdmin($this->id);
                break;
            case 'Admin':
                return new Admin($this->id);
                break;
            case 'Customer':
                return new Customer($this->id);
                break;
            default:
                throw new Exception("unknown user type: $this->type");
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
    public static function register($kvs)
    {
        extract($kvs);
        $type = 'customer';
        Pdb::insert(
            array(
                'name' => $username,
                'password' => md5($password),
                'type' => $type,
                'realname' => $realname,
                'phone' => $phone,
                'email' => $email,
                'create_time=NOW()' => null,
            ),
            self::$table
        );
        return new self(Pdb::lastInsertId());
    }

    public static function loginHistory()
    {
        $cond = array('user=?' => $this->id);
        $tail = "LIMIT $limit OFFSET $offset";
        return Pdb::fetchAll('*', UserLog::$table, $cond, null, $tail);
    }
}
