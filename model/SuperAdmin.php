<?php

/**
 *
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class SuperAdmin extends Model 
{
    public static $table = 'super_admin';
    
    public function createAdmin($opts)
    {
        Pdb::insert(
            array(
                'name' => $opts['username'],
                'password' => md5($opts['password']),
                'type' => 'Admin',
                'create_time=NOW()' => null
            ),
            User::$table
        );
        return new Admin(Pdb::lastInsertId());
    }
}
