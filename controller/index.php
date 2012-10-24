<?php
!defined('IN_PTF') && exit('ILLEGAL EXECUTION');
/**
 * @file    index
 * @author  ryan <cumt.xiaochi@gmail.com>
 * @created Jun 27, 2012 6:24:01 PM
 */

require_once Pf::lib('Pdb');
Pdb::setConfig($config['db']);

$view .= '?master';

$page['scripts'][] = 'widget';

?>
