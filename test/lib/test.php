<?php

function test($I_got, $u_thought, $options = array())
{
    if (isset($options['name'])) {
        $name = $options['name'];
    } else if (isset($GLOBALS['name'])) {
        $name = $GLOBALS['name'];
    } else {
        $name = 'test';
    }
    
    if (kind_of_equal($I_got, $u_thought)) {
        $success = 1;
        $fail = 0;
    } else {
        $success = 0;
        $fail = 1;
        $GLOBALS['all_pass'] = false;
    }
    include 'static/entry.html';
}

// use this function to ignore sort when comparing two arrays
function kind_of_equal($a, $b)
{
    if (!is_array($a) || !is_array($b))
        return $a === $b;
    if (count($a) !== count($b))
        return false;
    foreach ($a as $key => $value) {
        if (!isset($b[$key]))
            return false;
        if (!kind_of_equal($value, $b[$key]))
            return false;
    }
    return true;
}
