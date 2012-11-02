<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class Customer extends Model 
{
    public static $table = 'customer';

    public static function createFromUser($user)
    {
        $user_id = $user->id;
        $info = Pdb::fetchRow('*', self::$table, array('user=?' => $user_id));
        if (empty($info))
            throw new Exception("no customer, user_id: $user_id");
        $info['user'] = $user;
        return new self($info);
    }

    protected function info() 
    {
        $ret = Pdb::fetchRow('*', self::$table, $this->selfCond());
        if ($ret === false) {
            throw new Exception("no customer, id: $this->id");
        }

        return $ret;
    }

    public function edit($para)
    {
        Pdb::update($para, self::$table, $this->selfCond());
    }

    public function listProducts($conds)
    {
        $conds = self::defaultConds($conds);
        $limit = $conds['limit'];
        $offset = $conds['offset'];
        $tail = "LIMIT $limit OFFSET $offset";
        return safe_array_map(function ($info) {
            return new Product($info);
        }, Pdb::fetchALL('*', Product::$table, array(), array(), $tail));
    }

    public function addresses() 
    {
        $ids = Pdb::fetchAll(
            'address', 
            customer_address, 
            array('customer=?' => $this->id));

        // if not found, create one
        if ($ids === false) {

            // insert to address db
            Pdb::insert(array('name' => ''), Address::$table);
            $id = Pdb::lastInsertId();
            $ids = array($id);

            // insert to relationship db
            Pdb::insert(
                array('customer' => $this->id, 'address' => $id), 
                customer_address);
        }
        return array_map(function ($id) {
            return new Address($id);
        }, $ids);
    }

    public function defaultAddress()
    {
        $default_addr = Pdb::fetchRow(
            'address',
            customer_address,
            array(
                'customer=?' => $this->id,
                'is_default=?' => 1));
        if ($default_addr) {
            return new Address($default_addr);
        } else {
            $addresses = $this->addresses();
            $addr = $addresses[0];
            $addr->setDefault();
            return $addr;
        }
    }

    // this function can be integreted in __get() ???
    public function cart()
    {
        return Cart::createFromCustomer($this);
    }

    public function addProductToCart(Product $prd, $opts)
    {
        // make an new order
        $order = Order::create($this, $prd, $opts);

        Pdb::insert(
            array(
                'customer' => $this->id,
                'small_order' => $order->id),
            Cart::$table);
        return $order;
    }

    public function delProductFromCart(Order $order)
    {
        Pdb::del(
            Cart::$table,
            array('small_order=?' => $order->id)); // this id for customer? not need
    }

    public function listOrders($conds)
    {
        extract(slef::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        return safe_array_map(
            function ($info) {
                $pb = new productCombine($info['products']);
                $info['products'] = $pb->products();
                $info['customer'] = new Customer($info['customer']);
                $info['factory'] = new Factory($info['factory']);
            },
            Pdb::fetchALL('*', Order::$table, $tail)
        );
    }

    public function submitCart()
    {
        $cart = $this->cart();

        // big order
        $bigOrder = BigOrder::createFromCart($cart);

        $this->emptyCart();

        return $bigOrder;
    }

    public static function create($info)
    {

        $user_info = array(
            'username' => i($info['username']),
            'password' => i($info['password']),
            'realname' => i($info['realname']),
            'phone' => i($info['phone']),
            'email' => i($info['email']),
            'create_time=NOW()' => null);
        $user = User::register($user_info);

        // new an account
        $account = Account::create();

        Pdb::insert(
            array(
                'user' => $user->id, 
                'account' => $account->id,
                'adopted' => 0,
                'qq' => i($info['qq']),
                'remark' => i($info['remark']),
                'adopted' => i($info['adopted'])),
            self::$table);
        return new self(Pdb::lastInsertId());
    }

    public static function register($info) 
    {
        return self::create(array_merge(
            $info,
            array('adopted' => 0)));
    }

    public function visitProduct(Product $prd)
    {
        $expire = '20'; //???
        if (!in_array($prd->id, self::visitingProducts())) {
            Pdb::insert(
                array(
                    'user' => $this->user->id,
                    'time=NOW()' => null,
                    'action' => 'visitProduct',
                    'target' => $prd->id,
                    ),
                UserLog::$table
            );
            self::addVisitingProduct($prd);
        }
    }

    public function visitingProducts() {
        if (isset($_COOKIE['visiting_products'])) {
            return json_decode($_COOKIE['visiting_products']);
        } else {
            return array();
        }
    }

    public function addVisitingProduct($prd)
    {
        $prd_id = $prd->id;
        if (!isset($_COOKIE['visiting_products'][$prd_id])) {
            setcookie(
                'visiting_products[' . $prd_id . ']',
                '1',
                strtotime('+30min'), 
                '/'
            );
        }
    }

    public function emptyCart() 
    {
        Pdb::del(Cart::$table, array('customer' => $this->id));
    }

    public function dealTimes()
    {
        return Pdb::count(
            UserLog::$table, 
            array(
                'subject=?' => $this->id,
                'action=?' => 'DoneBill'));
    }

    public function orderTimes()
    {
        return Pdb::count(
            UserLog::$table,
            array(
                'subject=?' => $this->id,
                'action=?' => 'StartBill'));
    }

    public function undoneTimes()
    {
        return $this->orderTimes() - $this->dealTimes();
    }



    public function account()
    {
        return new Account($this->account);
    }

    public function user()
    {
        return new User($this->user);
    }

}
