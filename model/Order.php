<?php

/**
 * I am the small order
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Order extends Model 
{
    public static $table = 'order_'; // when came across a key word

    public static function creat(Customer $cus, Product $prd, $opts)
    {
        Pdb::insert(
            array_merge(
                $opts,
                array(
                    'customer' => $cus->id,
                    'product' => $prd->id,
                    '')),

            )
    }
}
