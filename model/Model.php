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
        } else {
            $this->id = $para;
        }
    }
    
    protected function selfCond() 
    {
        return array('id=?' => $this->id);
    }

    public function __get($name) 
    {
        if ($name == 'id') return $this->id;
        if (empty($this->info)) {
            $this->info = $this->info();
        }
        return $this->info[$name];
    }

    protected static function defaultConds($conds) 
    {
        return array_merge(array(
            'limit' => 10,
            'offset' => 0,
        ), $conds);
    }
}

?>
