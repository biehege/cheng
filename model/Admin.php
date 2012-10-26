<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Admin extends Model 
{
    public static $table = 'admin';
    
    public function editOrder(Order $order, $settings)
    {

    }

    public function adoptCustomer(Customer $cus)
    {
        Pdb::update(array('adopted' => 1), Customer::$table, array('id=?' => $cus->id));
    }

    public function listCustomer($conds = array())
    {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        $conds = array();
        if (isset($adopted)) {
            $conds['adopted=?'] = $adopted ? 1 : 0;
        }
        return array_map(function ($info) {
            $info['user'] = new User($info['user']);
            return new Customer($info);
        }, Pdb::fetchAll('*', Customer::$table, $conds, null, $tail));
    }

    public function listFactory($conds) 
    {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        return array_map(function ($id) {
            return new Factory($id);
        }, Pdb::fetchAll('id', Factory::$table, null, null, $tail));
    }

    public function postProduct($info)
    {
        Pdb::insert(
            array_merge(
                $info,
                array('post_time=NOW()' => null)),
            Product::$table);
    }
}
