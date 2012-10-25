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

    public function listCustomer($conds)
    {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        $conds = array();
        if (isset($adopted)) {
            $conds['adopted=?'] = $adopted ? 1 : 0;
        }
        return array_map(function ($info) {
            return new Customer($info);
        }, Pdb::fetchAll('*', Customer::$table, $conds, $tail));
    }
}
