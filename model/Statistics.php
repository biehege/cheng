<?php

/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class Statistics
{
    public static function saleRecord($opts)
    {
        extract($opts);

        if ($divide === 'day') {
            if (!isset($end))
                $end = strtotime('now');
            if (!isset($start))
                $start = strtotime('-3 month');
            

        } elseif ($divide === 'month') {

        } else {
            throw new Exception("we not support $divide ");
        }
    }

}
