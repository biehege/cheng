<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */

class Customer extends Model 
{
    public static $table = 'customer';

    protected function info() {
        $ret = Pdb::fetchRow('*', self::$table, $this->selfCond());
        if ($ret === false) {
            throw new Exception("no customer, id: $this->id");
        }
        $ret['user'] = new User($ret['user']);
        return $ret;
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

    // cart is a Cart
    public function cart()
    {
        return Cart::createFromCustomer($this);
    }

    public function addProductToCart(Product $prd, $opts)
    {
        // make an new order
        $order = Order::create($this->id, $prd, $opts);

        Pdb::insert(
            array(
                'customer' => $this->id,
                'small_order' => $order->id,),
            Cart::$table);
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

    public function submitCart(Cart $cart)
    {
        // big order
        $bigOrder = BigOrder::createFromCart($cart);

        $prd_combine = $cart->productCombine();
        Pdb::insert(
            array(
                'state'    => 'ToBeConfirmed',
                'customer' => $this->id,
                'create_time=NOW()' => null), 
            Order::$table
        );
        return new Order(Pdb::lastInsertId());
    }

    public function register($kvs) {
        $user = User::register($kvs);
        Pdb::insert(
            array('user' => $user->id, 'adopted' => 0), 
            self::$table);
        return new self(Pdb::lastInsertId());
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
}
