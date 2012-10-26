<?php

/**
 *
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class BigOrder extends Model 
{
    public static $table = 'big_order';

    public function createFromCart(Cart $cart)
    {
        Pdb::insert(array(), self::$table);
        $id = Pdb::lastInsertId();
        foreach ($cart->orders() as $order) {
            Pdb::insert(
                array(
                    'big_order' => $id,
                    'small_order' => $order->id),
                'big_to_small_order');
            $order->submit();
        }
    }
}
