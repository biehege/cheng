<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Cart
{
    public static $table = 'cart';

    private function __construct($owner_id)
    {
        $this->owner_id = $owner_id;
    }

    public static function createFromCustomer(Customer $cus)
    {
        $cart = new Cart($cus->id);
        return $cart;
    }

    public function orders() {
        return array_map(function ($id) {
            return new Order($id);
        }, Pdb::fetchAll('id', self::$table)); // no paging here
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
