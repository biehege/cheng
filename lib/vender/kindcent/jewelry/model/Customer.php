<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');

require_once Pf::model('Model');

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Customer extends ListableModel 
{
    public static $table = 'customer';

    public function listProducts($conds)
    {
        $conds = self::defaultConds($conds);
        $limit = $conds['limit'];
        $offset = $conds['offset'];
        $tail = "LIMIT $limit OFFSET $offset";
        return array_map(function ($id) {
            return new Product($id);
        }, Pdb::fetchALL('id', Product::$table, array(), array(), $tail));
    }

    public function address() 
    {
        $id = Pdb::fetchRow(
            'address', 
            customer_address, 
            array('customer=?' => $this->id));

        // if not found, create one
        if ($id === false) {

            // insert to address db
            Pdb::insert(array(), Address::$table);
            $id = Pdb::lastInsertId();

            // insert to relationship db
            Pdb::insert(
                array('customer' => $this->id, 'address' => $id), 
                customer_address);
        }
        return new Address($id);
    }

    public function cart()
    {
        return new Cart(Pdb::fetchRow('cart', self::$table, $this->selfCond()));
    }

    public function listOrders($conds)
    {
        extract(slef::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        return array_map(
            function ($info) {
                $pb = new productCombine($info['products']);
                $info['products'] = $pb->products();
                $info['customer'] = new Customer($info['customer']);
                $info['factory'] = new Factory($info['factory']);
            }
            Pdb::fetchALL('*', Order::$table, $tail);
        ;
    }
    
    public submitCart(Cart $cart) 
    {
        $prd_combine = $cart->productCombine();
        Pdb::insert(
            array(
                'products' => $prd_combine->id,
                'state'    => 'ToBeConfirmed',
                'customer' => $this->id,
                'create_time=NOW()' => null), 
            Order::$table,);
        return new Order(Pdb::lastInsertId());
    }
}
