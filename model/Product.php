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
        $this->info['price_estimate'] = $this->estimatePrice();
        return $this->info;
    }

    public static function count()
    {
        return Pdb::count(self::$table);
    }

    public static function listProduct($conds = array()) 
    {
        extract(self::defaultConds($conds));
        $tail = "LIMIT $limit OFFSET $offset";
        return safe_array_map(function ($id) {
            return new Product($id);
        }, Pdb::fetchAll('id', self::$table, null, null, $tail));
    }

    public static function types()
    {
        return Pdb::fetchAll('name', 'product_type');
    }

    private function estimatePrice()
    {
        // todo 
        $info = $this->info;
        return 
            $info['weight'] * (1 + Setting::get('wear_tear')) * Price::current('PT950') 
                + Setting::get('labor_expense')
                + $info['small_stone'] * (Setting::get('st_expense') + Setting::get('st_price'));
    }
}
