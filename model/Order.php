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
        return $ret;
    }

    public function customer()
    {
        return new Customer($this->customer);
    }

    public function product()
    {
        return new Product($this->product);
    }

    public function address()
    {
        return new Address($this->address);
    }

    public function factory()
    {
        // can be not set yet
        return new Factory($this->factory);
    }

    public function priceData($name)
    {
        $name = strtolower($name . '_price');
        return new Pricedata($this->__get($name));
    }

    public function changePrice($type, $info) 
    {
        $pd = $this->priceData($type);
        $pd->edit($info);
    }

    public static function create(Customer $cus, Product $prd, $opts)
    {
        Pdb::insert(
            array_merge(
                $opts,
                array(
                    'order_no' => uniqid(), // ....
                    'customer' => $cus->id,
                    'product' => $prd->id,
                    'state' => 'InCart',
                    'estimate_price' => $prd->estimatePrice(),
                    'add_cart_time=NOW()' => null)),
            self::$table);
        return new self(Pdb::lastInsertId());
    }

    public function edit($key_or_array, $value = null)
    {
        if($value !== null) { // given by key => value
            $arr = array($key_or_array => $value);
        } else {
            $arr = $key_or_array;
        }
        Pdb::update($arr, self::$table, $this->selfCond());
    }

    public function submit()
    {
        $this->info = $this->info();
        $material = $this->info['material'];
        $product = $this->product();
        $info = array(
            'small_stone' => $product->small_stone,
            'gold_price' => Price::current($material),
            'labor_expense' => Setting::get('labor_expense'),
            'wear_tear' => Setting::get('wear_tear'),
            'st_price' => Setting::get('st_price'),
            'st_expense' => Setting::get('st_expense'),
            'st_weight' => 0,
            'model_expense' => 0,
            'risk_expense' => Setting::get('risk_expense'));
        $factory_price = PriceData::create($info);
        $customer_price = PriceData::create($info);
        Pdb::update(
            array(
                'state' => 'ToBeConfirmed',
                'submit_time=NOW()' => null,
                'factory_price' => $factory_price->id,
                'customer_price' => $customer_price->id,
                'weight_ratio' => $material === 'PT950' ? Setting::get('weight_ratio') : 1),
            self::$table);
    }

    public function price() // we need that? may be not, del it !!!
    {
        // called from where?
        $customer_price = $this->priceData('customer');
        return $customer_price->finalPrice();
    }

    public static function count($conds)
    {
        $conds = self::buildDbConds($conds);
        $tables = array(self::$table . ' as o', Product::$table . ' as p');
        return (int) Pdb::count($tables, $conds);
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

    public function log()
    {
        $ret = Pdb::fetchAll(
            array(
                'info as remark',
                'time'),
            UserLog::$table,
            array(
                'action LIKE ?' => '%Order',
                'target=?' => $this->id));
        return  (empty($ret))? array() : $ret;
    }

    private static function buildDbConds($conds = array())
    {
        extract(array_merge(
            array(
                'username' => '',
                'factory' => ''),
            $conds));
        $ret = array();
        if ($name)
            $ret['p.name LIKE ?'] = '%' . $name . '%';
        if ($product_no) {
            $ret['p.no=?'] = $product_no;
        }
        if ($order_no) {
            $ret['o.order_no=?'] = $order_no;
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
