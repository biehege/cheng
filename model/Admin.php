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
        extract(self::buildDbArgs($conds));
        return Pdb::count($tables, $conds);
    }

    // why not customers()
    public function listCustomer($conds = array())
    {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";

        extract(self::buildDbArgs($conds)); // 数据库的条件

        if (isset($adopted)) {
            $conds['adopted=?'] = $adopted ? 1 : 0;
        }
        $cus_infos = Pdb::fetchAll('c.id', $tables, $conds, null, $tail);
        return safe_array_map(function ($id) {
            return new Customer($id);
        }, $cus_infos);
    }

    public function rechargeAccount(Account $account, $money)
    {
        $account->recharge($money);

        // log
        Pdb::insert(
            array(
                'time=NOW()' => null,
                'account' => $account->id,
                'name' => '充值',
                'money' => $money,
                'type' => 'recharge',
                'remain' => $account->remain,
                'pay_type' => '转账'),
            AccountHistory::$table);
    }

    public function deductAccountForOrder(Account $account, Order $order, $money, $remark = '')
    {
        $account->deduct($money);

        // log
        Pdb::insert(
            array(
                'subject' => $this->id,
                'action' => 'DeductAccount',
                'target' => $order->id,
                'info' => json_encode(compact('money', 'remark')),
                'time=NOW()' => null),
            UserLog::$table);
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
            } elseif (is_numeric($prd)) {
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

    private static function buildDbArgs($conds = array()) 
    {
        extract($conds);

        $conds = array();
        $tables = array(
            User::$table . ' as u',
            Customer::$table . ' as c');
        if ($name)
            $conds['u.realname LIKE ?'] = '%' . $name . '%';
        if ($username)
            $conds['u.name LIKE ?'] = '%' . $username . '%';

        // a little bit difficult
        if ($time_start)
            $conds['o.submit_time >= ?'] = $time_start;
        if ($time_end) 
            $conds['o.submit_time <= ?'] = $time_end;
        if ($time_start || $time_end) {
            $conds['o.customer=c.id'] = null;
            $tables[] = Order::$table . ' as o';
        }

        if ($state)
            $conds['u.state=?'] = $state;

        $conds['c.user=u.id'] = null;
        return compact('conds', 'tables');
    }

    public function confirmOrder(Order $order)
    {
        $state = 'InFactory';
        Pdb::update(
            array(
                'state' => $state,
                'confirm_time=NOW()' => null),
            Order::$table);

        // 记录日志
        UserLog::adminDealOrder($this, 'confirm', $order, '确认订单');

        return $state;
    }

    public function factoryDoneOrder(Order $order)
    {
        $state = 'FactoryDone';
        Pdb::update(
            array(
                'state' => $state,
                'factory_done_time=NOW()' => null),
            Order::$table);

        // 卖出去的数量 +1
        Pdb::update(
            array('sold_count=sold_count+1' => null),
            Product::$table,
            array('id=?' => $order->product()->id));

        UserLog::adminDealOrder($this, 'factoryDone', $order, '工厂完成');

        return $state;
    }

    public function doneOrder(Order $order)
    {
        $state = 'Done';
        Pdb::update(
            array(
                'state' => $state,
                'done_time=NOW()' => null),
            Order::$table,
            array('id=?', $order->id));

        UserLog::adminDealOrder($this, 'done', $order, '交易完成');

        return $state;
    }
}
