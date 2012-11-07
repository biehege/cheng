<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Statistics
{
    public static function saleRecord($opts)
    {
        extract($opts);

        $interval = DateInterval::createFromDateString("1 $divide");

        $date = new DateTime();
        $ret = array();
        for ($i=69; $i >= 0; $i--) { 
            $date->sub($interval);
            if ($divide === 'day') {
                $ret[$i] = self::daySaleInfo($date->format('Y-m-d'));
            } elseif ($divide === 'month') {
                $ret[$i] = self::monthSaleInfo($date->format('Y-m'));
            }
        }
        return $ret;
    }

    public static function daySaleInfo($day_string) // a day
    {
        return self::saleInfo($day_string, 'DATE(done_time)=?');
    }

    public static function monthSaleInfo($month_str)
    {
        return self::saleInfo($month_str, "DATE_FORMAT(done_time,'%Y-%c')=?");
    }

    private static function saleInfo($date_str, $format)
    {
        $arr = Pdb::fetchAll(
            'paid', 
            Order::$table, 
            array($format => $date_str));
        return array(
            'count' => count($arr),
            'sum' => array_sum($arr));
    }

}
