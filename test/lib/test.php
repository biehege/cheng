<?php

function begin_test()
{
    echo '<hr><!-- test begin -->' . PHP_EOL;
}

function test($I_got, $u_thought, $options = array())
{
    $options = array_merge( // default options
        array(
            'name' => 'test',
            'compare' => 'equal'), // compare method
        $options);
    $name = $options['name'];
    $compare = $options['compare'];

    switch ($compare) {
        case 'equal':
            $success = kind_of_equal($I_got, $u_thought);
            break;

        case 'in':
            $success = array_contain($I_got, $u_thought);
            break;
        
        default:
            throw new Exception("bad compare method: $compare");
            break;
    }
    $fail = !$success;
    if ($fail)
        $GLOBALS['all_pass'] = false;

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

function array_contain($big_arr, $small_arr)
{
    if (!is_array($big_arr) || !is_array($small_arr)) {
        return false;
    }
    foreach ($small_arr as $key => $value) {
        if (!isset($big_arr[$key]) || $big_arr[$key] != $small_arr[$key]) {
            return false;
        }
    }
    return true;
}

// remove all entries
// which cannot be refered by $ref_table by $ref_key 
// in $master_table
function clear_db($master_table, $ref_table, $ref_key, $back_key = 'id', $ref_id = 'id')
{
    $all = Pdb::fetchAll('*', $master_table);
    if ($all === false)
        return;
    foreach ($all as $info) 
        if (!Pdb::exists($ref_table, array($ref_id . '=?' => $info[$ref_key])))
            Pdb::del($master_table, array($back_key . '=?' => $info[$back_key]));
}

function clear_11_db($master_table, $slave_table, $ref_key = null)
{
    if ($ref_key === null)
        $ref_key = $slave_table;
    $ids = Pdb::fetchAll('id', $slave_table);
    if (empty($ids))
        return;
    foreach ($ids as $id) {
        if (!Pdb::exists($master_table, array("$ref_key = ?" => $id))) {
            Pdb::del($slave_table, array('id = ?' => $id));
        }
    }
}

function clear_1m_db($master_table, $ref_table, $ref_key = null)
{
    if ($ref_key === null)
        $ref_key = $master_table;
    $ids = Pdb::fetchAll($ref_key, $ref_table);
    if (empty($ids))
        return;
    foreach ($ids as $id) {
        if (!Pdb::exists($master_table, array('id = ?' => $id))) {
            Pdb::del($ref_table, array("$ref_key = ?" => $id));
        }
    }
}

function clear_relation_db($main_table, $ref_table, $relation_table = null, $key_main = null, $key_ref = null)
{
    if ($relation_table === null)
        $relation_table = $main_table . '_' . $ref_table;
    if ($key_main === null)
        $key_main = $main_table;
    if ($key_ref === null)
        $key_ref = $ref_table;
    $all = Pdb::fetchAll('*', $relation_table);
    if ($all === false) {
        Pdb::del($ref_table);
        return;
    }

    // del in relation table
    foreach ($all as $info) {
        if (!Pdb::exists($main_table, array('id=?' => $info[$key_main]))) {
            Pdb::del($relation_table, array($key_main . '=?' => $info[$key_main]));
        }
    }

    // del in ref table
    $all = Pdb::fetchAll('*', $ref_table);
    if (empty($all))
        return;
    foreach ($all as $info) {
        $id = $info['id'];
        if (!Pdb::exists($relation_table, array($key_ref . '=?' => $id)))
            Pdb::del($ref_table, array('id=?' => $id));
    }
}
