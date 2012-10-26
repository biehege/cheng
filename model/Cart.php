<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Cart
{
    public static $table = 'customer';

    public static function createFromCustomer(Customer $cus)
    {
        $this->customer_id = $cus->id;
    }

    public function listProduct($conds) {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limt OFFSET $offset";
        return Pdb::fetchAll('id', cart_product);
    }

    public function count() 
    {
        return Pdb::count(cart_product, array('cart=?' => $this->id));
    }

    public function del(Product $prd)
    {
        Pdb::del(cart_product, array(
            'cart=?' => $this->id, 
            'product=?' => $prd->id));
    }
}
