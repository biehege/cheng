<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class PriceData extends Model 
{
    public static $table = 'price_data';

    public static function create($info)
    {
        Pdb::insert($info, self::$table);
        return new self(Pdb::lastInsertId());
    }

    public function info()
    {
        return Pdb::fetchRow('*', self::$table, $this->selfCond());
    }

    public function edit($key_or_array, $value = null)
    {
        if($value !== null) { // give by key => value
            $arr = array($key_or_array, $value);
        } else {
            $arr = $key_or_array;
        }
        Pdb::update($arr, self::$table, $this->selfCond());
    }

    public function finalPrice()
    {
        if ($this->final_price === null) {
            // caculate
            return $this->gold_weight + $this->gold_weight * $this->wear_tear 
                + $this->labor_expense + $this->small_stone * $this->st_expense
                + $this->st_price * $this->st_weight
                + $this->model_expense * $this->risk_expense;
        } else {
            return $this->final_price;
        }
    }
}
