<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Admin extends Model 
{
    public static $table = 'admin';
    
    public function editOrder(Order $order, $settings)
    {
        Pdb::update($settings, Order::$table, array('id=?' => $order->id));
    }

    public function setOrderState(Order $order, $state)
    {
        $this->editOrder($order, array('state' => $state));
    }

    public function addCustomer($info) 
    {
        $user_info = array(
            'username' => i($info['username']),
            'password' => i($info['password']),
            'realname' => i($info['realname']),
            'phone' => i($info['phone']),
            'email' => i($info['email']),
            'create_time=NOW()' => null);
        $cus = Customer::register($user_info);
        $cus_info = array(
            'qq' => i($info['qq']),
            'remark' => i($info['remark']),
            'adopted' => 1);
        $cus->edit($cus_info);
    }

    public function adoptCustomer(Customer $cus)
    {
        Pdb::update(array('adopted' => 1), Customer::$table, array('id=?' => $cus->id));
    }

    // why not customers()
    public function listCustomer($conds = array())
    {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        $conds = array();
        if (isset($adopted)) {
            $conds['adopted=?'] = $adopted ? 1 : 0;
        }
        $cus_infos = Pdb::fetchAll('*', Customer::$table, $conds, null, $tail);
        return safe_array_map(function ($info) {
            $info['user'] = new User($info['user']);
            return new Customer($info);
        }, $cus_infos);
    }

    public function addFactory($para)
    {
        Pdb::insert(
            array_merge(
                $para,
                array('create_time=NOW()' => null)),
            Factory::$table);
    }

    public function listFactory($conds = array()) 
    {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        return safe_array_map(function ($id) {
            return new Factory($id);
        }, Pdb::fetchAll('id', Factory::$table, null, null, $tail));
    }

    public function postProduct($info)
    {
        Pdb::insert(
            array_merge(
                $info,
                array('post_time=NOW()' => null)),
            Product::$table);
        return new Product(Pdb::lastInsertId());
    }

    public function updatePrice($type, $price)
    {
        Price::update($type, $price);
    }

}
