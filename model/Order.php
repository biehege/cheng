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

    public function stone() 
    {
        $stone_id = $this->stone;
        if (empty($stone_id)) {
            $stone = Stone::create();
            $stone_id = $stone->id;
            $this->edit('stone', $stone_id);
            $this->stone = $stone_id;
            return $stone;
        }
        return new Stone($this->stone);
    }

    public function changePrice($type, $info) 
    {
        $pd = $this->priceData($type);
        $pd->edit($info);
    }

    public static function create(Customer $cus, Product $prd, $opts)
    {
        $material = $opts['material'];
        Pdb::insert(
            array_merge(
                $opts,
                array(
                    'order_no' => uniqid(), // ....
                    'customer' => $cus->id,
                    'product' => $prd->id,
                    'state' => 'InCart',
                    'estimate_price' => $prd->estimatePrice(compact('material')),
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
            'st_weight' => $product->st_weight,
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
            self::$table,
            $this->selfCond());

        $customer = $this->customer();
        Pdb::insert(
            array(
                'subject' => $customer->id,
                'action' => 'SubmitOrder',
                'target' => $this->id,
                'time=NOW()' => null,
                'info' => $customer->user()->realname . ' 提交订单'),
            UserLog::$table);
    }

    public function price() // we need that? may be not, del it !!!
    {
        // called from where?
        $customer_price = $this->priceData('customer');
        return $customer_price->finalPrice();
    }

    public static function count($conds)
    {
            // tables and $conds
        extract(self::buildDbArgs($conds));
        return (int) Pdb::count($tables, $conds);
    }

    public static function listOrder($conds)
    {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        extract(self::buildDbArgs($conds));
        $order = array('submit_time DESC');
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

    // tables and $conds
    private static function buildDbArgs($conds = array())
    {
        extract(array_merge(
            array(
                'username' => '',
                'factory' => '',
                'factory_id' => null,
                'customer' => null,
                'name' => '',
                'product_no' => '',
                'order_no' => '',
                'time_start' => '',
                'time_end' => '',
                'type' => null,
                'state' => null),
            $conds));
        $tables = array(self::$table . ' as o');
        $conds = array();
        if ($name)
            $conds['p.name LIKE ?'] = '%' . $name . '%';
        if ($product_no) {
            $conds['p.no=?'] = $product_no;
        }
        if ($order_no) {
            $conds['o.order_no=?'] = $order_no;
        }
        if ($time_start)
            $conds['o.submit_time >= ?'] = $time_start;
        if ($time_end)
            $conds['o.submit_time <= ?'] = $time_end;
        if ($type) {
            $conds['p.type=?'] = $type;
        }
        if ($state) {
            $conds['o.state=?'] = $state;
        } else {
            $conds['o.state <> ?'] = 'InCart'; // for all
        }
        if ($username) {
            $user = User::createByName($username);
            $customer = $user->instance();
            $conds['o.customer=?'] = $customer->id;
        }
        if ($factory) {
            $factory = Factory::createByName($factory);
            if (empty($factory))
                throw new Exception("cannot find factory: $factory");
            $conds['o.factory=?'] = $factory->id;
        }
        if ($factory_id) {
            $conds['o.factory = ?'] = $factory_id;
        }
        if ($customer) {
            if (is_numeric($customer)) {
                $conds['o.customer=?'] = $customer;
            }
        }
        if ($name || $product_no || $type) {
            $tables[] = Product::$table . ' as p';
        }
        return compact('conds', 'tables');
    }
}
