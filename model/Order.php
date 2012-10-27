<?php

/**
 * I am the small order
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Order extends Model 
{
    public static $table = 'small_order'; // when came across a key word

    public static function create(Customer $cus, Product $prd, $opts)
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
        return new self(Pdb::lastInsertId());
    }

    public function submit()
    {
        Pdb::update(
            array(
                'state' => 'TobeConfirmed',
                'submit_time=NOW()' => null),
            self::$table);
    }
}
