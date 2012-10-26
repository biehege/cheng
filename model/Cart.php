<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Cart
{
    public static $table = 'cart';

    public static function createFromCustomer(Customer $cus)
    {
        $this->owner_id = $cus->id;
    }

    public function orders() {
        return array_map(function ($id) {
            return new Order($id);
        }, Pdb::fetchAll('id', self::$table); // no paging here
    }

    public function count()
    {
        return Pdb::count(
            self::$table, 
            array('customer=?' => $this->owner_id));
    }

    public function del(Order $order)
    {
        Pdb::del(
            self::$table, 
            array(
                'customer=?' => $this->owner_id, 
                'order=?' => $order->id));
    }
}
