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
        // but big order need customer or something else??
        Pdb::insert(
            array('id=id' => null), 
            self::$table);

        $id = Pdb::lastInsertId();
        foreach ($cart->orders() as $order) {
            Pdb::insert(
                array(
                    'big' => $id,
                    'small' => $order->id),
                'big_to_small_order');
            $order->submit();
        }
    }
}
