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
        return Customer::create(array_merge(
            $info,
            array('adopted' => 1)));
    }

    public function adoptCustomer(Customer $cus)
    {
        Pdb::update(array('adopted' => 1), Customer::$table, array('id=?' => $cus->id));
    }

    public function countCustomer($conds = array())
    {
        $conds = self::buildDbConds($conds);
        $tables = array(
            Customer::$table . ' as c',
            User::$table . ' as u',
            Order::$table . ' as o');
        return Pdb::count($tables, $conds);
    }

    // why not customers()
    public function listCustomer($conds = array())
    {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        $conds = self::buildDbConds($conds);
        if (isset($adopted)) {
            $conds['adopted=?'] = $adopted ? 1 : 0;
        }
        $tables = array(
            Customer::$table . ' as c',
            User::$table . ' as u',
            Order::$table . ' as o');
        $cus_infos = Pdb::fetchAll('c.id', $tables, $conds, null, $tail);
        return safe_array_map(function ($id) {
            return new Customer($id);
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

    public function delProduct($arg) {
        $prds = is_array($arg) ? $arg : array($arg);
        foreach ($prds as $prd) {
            if ($prd instanceof Product) {
                $id = $prd->id;
            } elseif (is_numeric($id)) {
                $id = $prd;
            } else {
                d($arg);
                throw new Exception("not good arg for del Product");
            }
            Pdb::del(
                Product::$table,
                array('id=?' => $id));
        }
    }

    public function updatePrice($type, $price)
    {
        Price::update($type, $price);
    }

    private static function buildDbConds($conds = array()) 
    {
        extract($conds);
        if ($name)
            $ret['u.realname LIKE ?'] = '%' . $name . '%';
        if ($username)
            $ret['u.name LIKE ?'] = '%' . $username . '%';

        // a little bit difficult
        if ($time_start)
            $ret['o.submit_time >= ?'] = $time_start;
        if ($time_end) 
            $ret['o.submit_time <= ?'] = $time_end;
        if ($time_start || $time_end)
            $ret['o.customer=c.id'] = null;

        if ($state)
            $ret['u.adopted=?'] = $state;

        $ret['c.user=u.id'] = null;
        return $ret;
    }
}
