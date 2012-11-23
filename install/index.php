<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$root = __DIR__ . '/..';

if (isset($_SERVER['HTTP_APPNAME']))
    define('ON_SAE', 1);
else 
    define('ON_SAE', 0);

require '$root/config/common.php';
require '$root/lib/class/Pdb.php';

Pdb::setConfig($config['db']);

$sqls = explode(';', file_get_contents('install.sql'));
foreach ($sqls as $sql) {
    if (ON_SAE && preg_match('/USE|CREATE\sDATABASE/', $sql)) {
        continue;
    }
    Pdb::exec($sql);
}

$sqls = explode(';', file_get_contents('default_data.sql'));
foreach ($sqls as $sql) {
    Pdb::exec($sql);
}
?>
<p>install ok</p>
<p><a href="/">index</a></p>
