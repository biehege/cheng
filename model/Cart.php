<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Cart extends Model 
{
    public static $table = 'customer';

    public function add(Product $prd, $opts) 
    {
        $num = i($opts['num']) ?: 1;
        Pdb::insert(array(
            'product' => $prd->id,
            'num' => $num
        ), cart_product);
    }

    public listProduct($conds) {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limt OFFSET $offset";
        return Pdb::fetchAll('id', cart_product);
    }

    public count() 
    {
        return Pdb::count(cart_product, array('cart=?' => $this->id));
    }

    public del(Product $prd)
    {
        Pdb::del(cart_product, array(
            'cart=?' => $this->id, 
            'product=?' => $prd->id));
    }
}
