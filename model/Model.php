<?php

/**
 * @author ryan
 */

class Model 
{
    protected $id = null;
    protected $info = null;
    
    public function __construct($para) 
    {
        if (is_array($para) && isset($para['id'])) {
            $this->id = $para['id'];
            $this->info = $para;
        } elseif (is_numeric($para)) {
            $this->id = $para;
        } else {
            d($para);
            throw new Exception("not good arg for construct");
        }
    }
    
    public function selfCond() 
    {
        return array('id=?' => $this->id);
    }

    public function edit($key_or_array, $value = null)
    {
        if($value !== null) { // given by key => value
            $arr = array($key_or_array => $value);
        } else {
            $arr = $key_or_array;
        }

        // why we need that, fuck!
        $class_vars = get_class_vars(get_class($this));
        $table = $class_vars['table'];

        Pdb::update($arr, $table, $this->selfCond()); // why we need that? that doesn't make any sense
    }

    public function __get($name) 
    {
        if ($name === 'id') return $this->id;
        if (empty($this->info))
            $this->info = $this->info();
        return $this->info[$name];
    }

    protected static function defaultConds($conds = array()) 
    {
        return array_merge(array(
            'limit' => 10,
            'offset' => 0,
        ), $conds);
    }
}
