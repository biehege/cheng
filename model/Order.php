<?php

/**
 * I am the small order
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Order extends Model 
{
    public static $table = 'small_order'; // when came across a key word

    public function info()
    {
        $ret = Pdb::fetchRow('*', self::$table, $this->selfCond());
        $ret['product'] = new Product($ret['product']);
        $ret['address'] = new Address($ret['address']);
        $ret['factory'] = new Factory($ret['factory']);
        $ret['customer'] = new Customer($ret['customer']);
        return $ret;
    }

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

    public function price()
    {
        $info = $this->info();
        $prd = $info['product'];
        return 
            $prd->weight * (1 + $info['wear_tear']) * $info['gold_price'] 
            + $info['labor_expense']
            + $prd->small_stone * ($info['st_expense'] + $info['st_price']);
    }
}
