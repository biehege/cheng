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
        $this->info = $this->info();
        $material = $this->info['material'];
        $cur_price = Price::current($material);
        Pdb::update(
            array(
                'state' => 'TobeConfirmed',
                'submit_time=NOW()' => null,
                'gold_price' => $cur_price,
                'labor_expense' => Setting::get('labor_expense'),
                'wear_tear' => Setting::get('wear_tear'),
                'st_price' => Setting::get('st_price'),
                'st_expense' => Setting::get('st_expense'),
                'weight_ratio' => Setting::get('weight_ratio'),),
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

    public static function count($conds)
    {
        $conds = self::buildDbConds($conds);
        $tables = array(self::$table . ' as o', Product::$table . ' as p');
        return Pdb::count($tables, $conds);
    }

    public static function listOrder($conds)
    {
        extract(self::defaultConds($conds));
        $tables = array(self::$table . ' as o', Product::$table . ' as p');
        $conds = self::buildDbConds($conds);
        $order = array();
        $tail = "LIMIT $limit OFFSET $offset";
        return safe_array_map(function ($id) {
            return new Order($id);
        }, Pdb::fetchAll('o.id', $tables, $conds, $order, $tail));
    }

    private static function buildDbConds($conds = array())
    {
        extract(array_merge(
            array(),
            $conds));
        $ret = array();
        if ($name)
            $ret['p.name LIKE ?'] = '%' . $name . '%';
        if ($product_no) {
            $ret['p.no=?'] = $product_no;
        }
        if ($no) {
            $ret['o.no=?'] = $no;
        }
        if ($time_start)
            $ret['o.submit_time >= ?'] = $time_start;
        if ($time_end)
            $ret['o.submit_time <= ?'] = $time_end;
        if ($type) {
            $ret['p.type=?'] = $type;
        }
        if ($state) {
            $ret['o.state=?'] = $state;
        } else {
            $ret['o.state <> ?'] = 'InCart'; // for all
        }
        if ($username) {
            $user = User::createByName($username);
            $customer = $user->instance();
            $ret['o.customer=?'] = $customer->id;
        }
        if ($factory) {
            $factory = Factory::createByName($factory);
            $ret['o.factory=?'] = $factory->id;
        }
        if ($customer) {
            if (is_numeric($customer)) {
                $ret['o.customer=?'] = $customer;
            }
        }
        return $ret;
    }
}
