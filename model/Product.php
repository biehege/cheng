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
        $conds = self::buildDbConds($conds);
        return Pdb::count(self::$table, $conds);
    }

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

    public function estimatePrice()
    {
        // todo 
        $info = $this->info();
        $material = $info['material'];
        return 
            $info['weight'] * (1 + Setting::get('wear_tear')) * Price::current($material) * ($material === 'PT950' ? Setting::get('weight_ratio') : 1)
                + Setting::get('labor_expense')
                + $info['small_stone'] * (Setting::get('st_expense') + Setting::get('st_price'));
    }

    private static function buildDbConds($conds)
    {
        extract(array_merge(
            array(
                'name' => '',
                'no' => '',
                'type' => ''),
            $conds));
        $ret = array();
        if ($name) {
            $ret['name LIKE ?'] = '%' . $name . '%';
        }
        if ($no) {
            $ret['no LIKE ?'] = '%' . $no . '%';
        }
        if ($type) {
            $ret['type=?'] = $type;
        }
        return $ret;
    }
}
