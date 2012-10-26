<?php

/**
 * I am the small order
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Order extends Model 
{
    public static $table = 'small_order'; // when came across a key word

    public static function creat(Customer $cus, Product $prd, $opts)
    {
        Pdb::insert(
            array_merge(
                $opts,
                array(
                    'customer' => $cus->id,
                    'product' => $prd->id,
                    'state' => 'InCart',
                    'add_cart_time=NOW()' => null)),
            self::$table);
    }

    public function submit()
    {
        Pdb::update(
            array(
                'state' => 'TobeConfirmed',
                'submit_time=NOW()' => null),
            slef::$table);
    }
}
