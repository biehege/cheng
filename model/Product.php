<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Product extends Model 
{
    public static $table = 'product';

    protected function info()
    {
        $this->info = Pdb::fetchRow('*', self::$table, $this->selfCond());
        return $this->info;
    }

    public static function count($conds = array())
    {
        list($tables, $conds) = self::buildDbArg($conds);
        return (int) Pdb::count($tables, $conds);
    }

    // rename to read, so we will delete this function
    public static function listProduct($conds = array())
    {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        $conds = self::buildDbConds($conds);
        $order = (isset($sort) && trim($sort))? $sort : null;
        return safe_array_map(function ($id) {
            return new Product($id);
        }, Pdb::fetchAll('id', self::$table, $conds, $order, $tail));
    }

    public static function read($conds = array())
    {
        list($tables, $conds, $order, $tail) = self::buildDbArg($conds);
        return safe_array_map(function ($info) {
            return new Product($info);
        }, Pdb::fetchAll('*', $tables, $conds, $order, $tail));
    }

    public static function addCustomized($info) {
        Pdb::insert(
            array_merge(
                $info, 
                array('is_customized' => 1)),
            self::$table);
        return new self(Pdb::lastInsertId());
    }

    public static function types()
    {
        $arr = Pdb::fetchAll('id,name', 'product_type');
        if (empty($arr))
            throw new Exception("no type");

        // we should write a function for this
        $ret = array();
        foreach ($arr as $e) {
            $key = $e['id'];
            $value = $e['name'];
            $ret[$key] = $value;
        }
        return $ret;
    }

    public function materials()
    {
        return json_decode($this->material);
    }

    public function countSold()
    {
        return Pdb::count(
            Order::$table, 
            array(
                'product=?' => $this->id,
                'state=?' => 'Done'));
    }

    public function countView()
    {
        return Pdb::count(
            UserLog::$table,
            array(
                'target=?' => $this->id,
                'action=?' => 'ViewProduct'));
    }

    public function estimatePrice($opts = array())
    {
        extract($opts);
        $info = $this->info();
        if (!isset($material))
            $material =  reset(json_decode($info['material']));
        $price = $info['weight'] * (1 + Setting::get('wear_tear')) * Price::current($material) * ($material === 'PT950' ? Setting::get('weight_ratio') : 1)
                + Setting::get('labor_expense')
                + $info['small_stone'] * (Setting::get('st_expense') + Setting::get('st_price'));
        return round($price, 2);
    }

    private static function buildDbConds($conds)
    {
        extract(array_merge(
            array(
                'name' => '',
                'no' => '',
                'type' => '',
                'stone_size' => ''),
            $conds));
        $ret = array('is_customized = ?' => 0);
        if ($name) {
            $ret['name LIKE ?'] = '%' . $name . '%';
        }
        if ($no) {
            $ret['no LIKE ?'] = '%' . $no . '%';
        }
        if ($type) {
            $ret['type=?'] = $type;
        }
        if ($stone_size) {
            $ret['rabbet_start <= ?'] = $stone_size;
            $ret['rabbet_end >= ?'] = $stone_size;
        }
        return $ret;
    }

    private static function buildDbArg($conds = array())
    {
        $conds = self::defaultConds($conds);
        extract(array_merge(
            array(
                'name' => '',
                'no' => '',
                'type' => '',
                'stone_size' => ''),
            $conds));
        $conds = array('is_customized = ?' => 0);
        if ($name) {
            $conds['name LIKE ?'] = '%' . $name . '%';
        }
        if ($no) {
            $conds['no LIKE ?'] = '%' . $no . '%';
        }
        if ($type) {
            $conds['type=?'] = self::typeId($type);
        }
        if ($stone_size) {
            $conds['rabbet_start <= ?'] = $stone_size;
            $conds['rabbet_end >= ?'] = $stone_size;
        }
        return array(self::$table, $conds, array(), "LIMIT $limit OFFSET $offset");
    }

    private static function typeId($name = '')
    {
        $id = Pdb::fetchRow('id', 'product_type', array('name = ?' => $name));
        if (empty($id)) {
            throw new Exception("no type: $name");
        }
        return $id;
    }
}
